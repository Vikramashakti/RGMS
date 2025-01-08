<?php

namespace App\Http\Controllers;

use App\Models\ProjectMilestone;
use App\Models\ResearchGrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectMilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gate check: Only Admin Executive or Staff can view the list of milestones
        if (Gate::denies('view-project-milestones')) {
            abort(403, 'You do not have permission to view project milestones.');
        }

        $projectMilestones = ProjectMilestone::all();
        return view('projectMilestones.index', compact('projectMilestones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate check: Only Project Leader can create project milestones
        if (Gate::denies('create-project-milestone')) {
            abort(403, 'You do not have permission to create project milestones.');
        }

        $user = auth()->user();

        // Get research grants where the user is the project leader (user_level 4 or 2)
        if (in_array($user->user_level, [4, 2])) {
            $researchGrants = ResearchGrant::where('project_leader_id', $user->id)->get();
        } else {
            $researchGrants = collect(); // Empty collection if the user doesn't have the right level
        }

        return view('projectMilestones.create', compact('researchGrants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Gate check: Only Project Leader can store project milestones
        if (Gate::denies('create-project-milestone')) {
            abort(403, 'You do not have permission to store project milestones.');
        }

        $request->validate([
            'research_grant_id' => 'required|exists:research_grants,id',
            'milestone_name' => 'required|string|max:255',
            'target_completion_date' => 'required|date',
            'deliverable' => 'required|string',
            'status' => 'required|in:Not Started,In Progress,Completed',
        ]);

        ProjectMilestone::create([
            'research_grant_id' => $request->research_grant_id,
            'milestone_name' => $request->milestone_name,
            'target_completion_date' => $request->target_completion_date,
            'deliverable' => $request->deliverable,
            'status' => $request->status,
            'remark' => $request->remark,
        ]);

        return redirect()->route('projectMilestones.index')->with('success', 'Project milestone created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectMilestone $projectMilestone)
    {
        // Gate check: Admin Executive, Staff, or Project Leader can view the milestone
        if (Gate::denies('view-project-milestone', $projectMilestone)) {
            abort(403, 'You do not have permission to view this project milestone.');
        }

        return view('projectMilestones.show', compact('projectMilestone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectMilestone $projectMilestone)
{
    // Gate check: Only Project Leader or Admin Executive can edit the milestone
    if (Gate::denies('edit-project-milestone', $projectMilestone)) {
        abort(403, 'You do not have permission to edit this project milestone.');
    }

    // Get the project leader associated with this project milestone
    $projectLeaderId = $projectMilestone->researchGrant->project_leader_id; // Assuming you have a relationship 'researchGrant' on ProjectMilestone

    // Filter research grants to only those where the current user is the project leader
    $researchGrants = ResearchGrant::where('project_leader_id', $projectLeaderId)->get();

    return view('projectMilestones.edit', compact('projectMilestone', 'researchGrants'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectMilestone $projectMilestone)
    {
        // Gate check: Only Project Leader or Admin Executive can update the milestone
        if (Gate::denies('edit-project-milestone', $projectMilestone)) {
            abort(403, 'You do not have permission to update this project milestone.');
        }

        $request->validate([
            'research_grant_id' => 'required|exists:research_grants,id',
            'milestone_name' => 'required|string|max:255',
            'target_completion_date' => 'required|date',
            'deliverable' => 'required|string',
            'status' => 'required|in:Not Started,In Progress,Completed',
        ]);

        $projectMilestone->update([
            'research_grant_id' => $request->research_grant_id,
            'milestone_name' => $request->milestone_name,
            'target_completion_date' => $request->target_completion_date,
            'deliverable' => $request->deliverable,
            'status' => $request->status,
            'remark' => $request->remark,
        ]);

        return redirect()->route('projectMilestones.index')->with('success', 'Project milestone updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectMilestone $projectMilestone)
    {
        // Gate check: Only Admin Executive can delete project milestones
        if (Gate::denies('delete-project-milestone', $projectMilestone)) {
            abort(403, 'You do not have permission to delete this project milestone.');
        }

        $projectMilestone->delete();

        return redirect()->route('projectMilestones.index')->with('success', 'Project milestone deleted successfully');
    }
}
