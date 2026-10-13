<?php

namespace App\Http\Controllers;

use App\Models\Project;

class AdminFinancialController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->with([
                'architect:id,name,email',
                'client:id,name,email',
            ])
            ->withSum('expenses', 'amount')
            ->latest('updated_at')
            ->get();

        $totalBudget = $projects->sum(function ($project) {
            return (float) ($project->budget ?? 0);
        });

        $totalExpenses = $projects->sum(function ($project) {
            return (float) ($project->expenses_sum_amount ?? 0);
        });

        $totalRemaining = $totalBudget - $totalExpenses;

        $projectsWithBudget = $projects
            ->filter(function ($project) {
                return $project->budget !== null;
            })
            ->count();

        return view('admin.financial', compact(
            'projects',
            'totalBudget',
            'totalExpenses',
            'totalRemaining',
            'projectsWithBudget'
        ));
    }
}
