<?php

namespace App\Http\Controllers;

use App\Models\ProjectMember;
use App\Models\ResearchGrant;
use App\Models\Academician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('view-project-members')) {
            abort(403, 'You do not have permission to view project members.');
        }

        $researchGrants = ResearchGrant::with('projectMembers')->get();
        return view('projectMembers.index', compact('researchGrants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('create-project-member')) {
            abort(403, 'You do not have permission to create project members.');
        }

        $researchGrants = ResearchGrant::all();
        $academicians = Academician::all();
        $selectedGrant = session('selected_research_grant_id')
            ? ResearchGrant::with('projectLeader')->find(session('selected_research_grant_id'))
            : null;

        return view('projectMembers.create', compact('researchGrants', 'academicians', 'selectedGrant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('create-project-member')) {
            abort(403, 'You do not have permission to store project members.');
        }

        $request->validate([
            'research_grant_id' => 'required|exists:research_grants,id',
            'academicians' => 'required|array',
            'academicians.*' => 'exists:academicians,id',
        ]);

        $researchGrant = ResearchGrant::findOrFail($request->research_grant_id);
        $existingMembers = ProjectMember::where('research_grant_id', $request->research_grant_id)
                                        ->pluck('academician_id')
                                        ->toArray();

        foreach ($request->academicians as $academicianId) {
            if (!in_array($academicianId, $existingMembers)) {
                $role = ($researchGrant->projectLeader->id == $academicianId) ? 2 : 1; // 2 for Leader, 1 for Member

                ProjectMember::create([
                    'research_grant_id' => $request->research_grant_id,
                    'academician_id' => $academicianId,
                    'user_role' => $role,
                ]);
            }
        }

        return redirect()->route('projectMembers.index')->with('success', 'Project members added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectMember $projectMember)
    {
        if (Gate::denies('view-project-member', $projectMember)) {
            abort(403, 'You do not have permission to view this project member.');
        }

        return view('projectMembers.show', compact('projectMember'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectMember $projectMember)
    {
        if (Gate::denies('edit-project-member', $projectMember)) {
            abort(403, 'You do not have permission to edit this project member.');
        }

        $researchGrants = ResearchGrant::all();
        $academicians = Academician::all();
        return view('projectMembers.edit', compact('projectMember', 'researchGrants', 'academicians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectMember $projectMember)
    {
        if (Gate::denies('edit-project-member', $projectMember)) {
            abort(403, 'You do not have permission to update this project member.');
        }

        $request->validate([
            'research_grant_id' => 'required|exists:research_grants,id',
            'academician_id' => 'required|exists:academicians,id',
        ]);

        $role = ($projectMember->researchGrant->projectLeader->id == $request->academician_id) ? 2 : 1;

        $projectMember->update([
            'research_grant_id' => $request->research_grant_id,
            'academician_id' => $request->academician_id,
            'user_role' => $role,
        ]);

        return redirect()->route('projectMembers.index')->with('success', 'Project member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectMember $projectMember)
    {
        if (Gate::denies('delete-project-member', $projectMember)) {
            abort(403, 'You do not have permission to delete this project member.');
        }

        $projectMember->delete();
        return redirect()->route('projectMembers.index')->with('success', 'Project member deleted successfully');
    }
}
