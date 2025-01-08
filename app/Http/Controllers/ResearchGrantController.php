<?php

namespace App\Http\Controllers;

use App\Models\ResearchGrant;
use App\Models\Academician;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ResearchGrantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('view-research-grants')) {
            abort(403, 'You do not have permission to view research grants.');
        }

        $researchGrants = ResearchGrant::all();
        return view('researchGrants.index', compact('researchGrants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('create-research-grant')) {
            abort(403, 'You do not have permission to create a research grant.');
        }

        $academicians = Academician::all();
        return view('researchGrants.create', compact('academicians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('create-research-grant')) {
            abort(403, 'You do not have permission to create a research grant.');
        }

        $validated = $request->validate([
            'project_leader_id' => 'required|exists:academicians,id',
            'grant_amount' => 'required|numeric',
            'grant_provider' => 'required|string',
            'project_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'duration_months' => 'required|integer',
        ]);

        $researchGrant = ResearchGrant::create($validated);

        $academician = Academician::find($validated['project_leader_id']);
        $user = $academician->user;

        if ($user) {
            $user->user_level = 2;
            $user->save();
        }

        return redirect()->route('projectMembers.create')->with('success', 'Research grant created successfully and Project Leader updated.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ResearchGrant $researchGrant)
    {
        if (Gate::denies('view-research-grant', $researchGrant)) {
            abort(403, 'You do not have permission to view this research grant.');
        }

        return view('researchGrants.show', compact('researchGrant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResearchGrant $researchGrant)
    {
        if (Gate::denies('edit-research-grant', $researchGrant)) {
            abort(403, 'You do not have permission to edit this research grant.');
        }

        $academicians = Academician::all();
        return view('researchGrants.edit', compact('researchGrant', 'academicians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResearchGrant $researchGrant)
    {
        if (Gate::denies('edit-research-grant', $researchGrant)) {
            abort(403, 'You do not have permission to update this research grant.');
        }

        $validated = $request->validate([
            'project_leader_id' => 'required|exists:academicians,id',
            'grant_amount' => 'required|numeric',
            'grant_provider' => 'required|string',
            'project_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'duration_months' => 'required|integer',
        ]);

        $researchGrant->update($validated);

        $academician = Academician::find($validated['project_leader_id']);
        $user = $academician->user;

        if ($user) {
            $user->user_level = 2;
            $user->save();
        }

        return redirect()->route('researchGrants.index')->with('success', 'Research grant updated successfully and Project Leader updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResearchGrant $researchGrant)
    {
        if (Gate::denies('delete-research-grant', $researchGrant)) {
            abort(403, 'You do not have permission to delete this research grant.');
        }

        // Retrieve the project leader before deleting the grant
        $academician = Academician::find($researchGrant->project_leader_id);

        // Delete the research grant
        $researchGrant->delete();

        // Reset the user level of the project leader if they exist
        if ($academician && $academician->user) {
            $academician->user->user_level = 0;
            $academician->user->save();
        }

        return redirect()->route('researchGrants.index')->with('success', 'Research grant deleted successfully and Project Leader user level reset.');
    }
}
