<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectArchitect;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArchitectProjectTeamController extends Controller
{
    public function store(Request $request, $projectId)
    {
        // Only the lead architect can add project team members
        $project = Project::where('id', $projectId)
            ->where('architect_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'architect_id' => [
                'required',
                'integer',

                Rule::exists('users', 'id')
                    ->where(function ($query) {
                        $query->where('role', 'architect')
                            ->where('status', 'active');
                    }),
            ],

            'role' => [
                'required',
                'string',
                'max:100',
            ],

            'discipline' => [
                'nullable',
                'string',
                'max:150',
            ],
        ]);


        // Prevent adding the lead architect again
        if (
            (int) $request->architect_id
            ===
            (int) $project->architect_id
        ) {
            return back()
                ->withErrors([
                    'architect_id' =>
                        'The lead architect is already part of this project.',
                ])
                ->withInput();
        }


        // Prevent duplicate collaborator
        $alreadyAdded = ProjectArchitect::where(
            'project_id',
            $project->id
        )
            ->where(
                'architect_id',
                $request->architect_id
            )
            ->exists();


        if ($alreadyAdded) {
            return back()
                ->withErrors([
                    'architect_id' =>
                        'This architect is already a member of the project team.',
                ])
                ->withInput();
        }


        ProjectArchitect::create([
            'project_id' =>
                $project->id,

            'architect_id' =>
                $request->architect_id,

            'role' =>
                trim(
                    $request->role
                ),

            'discipline' =>
                $request->filled('discipline')
                    ? trim(
                        $request->discipline
                    )
                    : null,
        ]);


        return redirect()
            ->route(
                'architect.projects.show',
                [
                    'id' =>
                        $project->id,

                    'tab' =>
                        'overview',
                ]
            )
            ->with(
                'success',
                'Project team member added successfully.'
            );
    }


    public function destroy(
        $projectId,
        $teamMemberId
    ) {
        // Only the lead architect can remove members
        $project = Project::where(
            'id',
            $projectId
        )
            ->where(
                'architect_id',
                auth()->id()
            )
            ->firstOrFail();


        $teamMember = ProjectArchitect::where(
            'id',
            $teamMemberId
        )
            ->where(
                'project_id',
                $project->id
            )
            ->firstOrFail();


        $teamMember->delete();


        return redirect()
            ->route(
                'architect.projects.show',
                [
                    'id' =>
                        $project->id,

                    'tab' =>
                        'overview',
                ]
            )
            ->with(
                'success',
                'Project team member removed.'
            );
    }
}