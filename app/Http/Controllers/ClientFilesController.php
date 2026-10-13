<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientFilesController extends Controller
{
    public function index(Request $request)
    {
        $client = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | CLIENT PROJECTS + FILES
        |--------------------------------------------------------------------------
        |
        | Only projects owned by the logged-in client are loaded.
        | This keeps centralized Files isolated from other clients.
        |
        */

        $projects = Project::with([
                'architect',
                'files.uploader',
            ])
            ->where('client_id', $client->id)
            ->orderBy('project_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | ALL CLIENT FILES
        |--------------------------------------------------------------------------
        */

        $allFiles = $projects
            ->flatMap(function ($project) {

                return $project->files
                    ->map(function ($file) use ($project) {

                        $file->project_data = $project;

                        return $file;
                    });
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | COUNTS
        |--------------------------------------------------------------------------
        |
        | Counts are calculated before filters so the summary cards always
        | describe the client's complete file library.
        |
        */

        $totalCount = $allFiles->count();

        $activeCount = $allFiles
            ->filter(function ($file) {
                return !$file->is_archived;
            })
            ->count();

        $archivedCount = $allFiles
            ->filter(function ($file) {
                return $file->is_archived;
            })
            ->count();

        $recentCount = $allFiles
            ->filter(function ($file) {

                return $file->created_at
                    &&
                    $file->created_at->gte(
                        now()->subDays(7)
                    );
            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | RECENT UPLOADS
        |--------------------------------------------------------------------------
        */

        $recentFiles = $allFiles
            ->sortByDesc('created_at')
            ->take(5)
            ->values();


        /*
        |--------------------------------------------------------------------------
        | FILTER VALUES
        |--------------------------------------------------------------------------
        */

        $search = trim(
            $request->search ?? ''
        );

        $projectId =
            $request->project;

        $type =
            $request->type;

        $status =
            $request->status;

        $view =
            $request->view ?? 'all';

        $sort =
            $request->sort ?? 'newest';


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($search !== '') {

            $searchText =
                strtolower($search);

            $allFiles = $allFiles
                ->filter(function ($file) use ($searchText) {

                    $fileName = strtolower(
                        $file->original_name
                        ??
                        $file->file_name
                        ??
                        ''
                    );

                    $projectName = strtolower(
                        $file->project_data->project_name
                        ??
                        ''
                    );

                    $uploaderName = strtolower(
                        $file->uploader->name
                        ??
                        ''
                    );

                    $category = strtolower(
                        $file->category
                        ??
                        ''
                    );

                    $description = strtolower(
                        $file->description
                        ??
                        ''
                    );

                    return str_contains(
                        $fileName,
                        $searchText
                    )
                    ||
                    str_contains(
                        $projectName,
                        $searchText
                    )
                    ||
                    str_contains(
                        $uploaderName,
                        $searchText
                    )
                    ||
                    str_contains(
                        $category,
                        $searchText
                    )
                    ||
                    str_contains(
                        $description,
                        $searchText
                    );
                })
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | PROJECT FILTER
        |--------------------------------------------------------------------------
        |
        | Because $allFiles came only from the logged-in client's projects,
        | the requested project filter cannot expose another client's files.
        |
        */

        if ($projectId) {

            $allFiles = $allFiles
                ->filter(function ($file) use ($projectId) {

                    return (int) $file->project_id
                        ===
                        (int) $projectId;
                })
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | TYPE FILTER
        |--------------------------------------------------------------------------
        */

        if ($type) {

            $allFiles = $allFiles
                ->filter(function ($file) use ($type) {

                    $extension = strtolower(
                        pathinfo(
                            $file->original_name
                            ??
                            $file->file_name
                            ??
                            '',
                            PATHINFO_EXTENSION
                        )
                    );

                    $imageTypes = [
                        'jpg',
                        'jpeg',
                        'png',
                        'webp',
                        'gif',
                    ];

                    $documentTypes = [
                        'pdf',
                        'doc',
                        'docx',
                        'xls',
                        'xlsx',
                        'ppt',
                        'pptx',
                        'txt',
                    ];

                    if ($type === 'image') {

                        return in_array(
                            $extension,
                            $imageTypes
                        );
                    }

                    if ($type === 'document') {

                        return in_array(
                            $extension,
                            $documentTypes
                        );
                    }

                    if ($type === 'pdf') {

                        return $extension === 'pdf';
                    }

                    if ($type === 'other') {

                        return !in_array(
                            $extension,
                            array_merge(
                                $imageTypes,
                                $documentTypes
                            )
                        );
                    }

                    return true;
                })
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($status === 'active') {

            $allFiles = $allFiles
                ->filter(function ($file) {

                    return !$file->is_archived;
                })
                ->values();
        }

        if ($status === 'archived') {

            $allFiles = $allFiles
                ->filter(function ($file) {

                    return $file->is_archived;
                })
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | QUICK VIEW FILTERS
        |--------------------------------------------------------------------------
        */

        if ($view === 'recent') {

            $allFiles = $allFiles
                ->filter(function ($file) {

                    return $file->created_at
                        &&
                        $file->created_at->gte(
                            now()->subDays(7)
                        );
                })
                ->values();
        }

        if ($view === 'images') {

            $allFiles = $allFiles
                ->filter(function ($file) {

                    $extension = strtolower(
                        pathinfo(
                            $file->original_name
                            ??
                            $file->file_name
                            ??
                            '',
                            PATHINFO_EXTENSION
                        )
                    );

                    return in_array(
                        $extension,
                        [
                            'jpg',
                            'jpeg',
                            'png',
                            'webp',
                            'gif',
                        ]
                    );
                })
                ->values();
        }

        if ($view === 'documents') {

            $allFiles = $allFiles
                ->filter(function ($file) {

                    $extension = strtolower(
                        pathinfo(
                            $file->original_name
                            ??
                            $file->file_name
                            ??
                            '',
                            PATHINFO_EXTENSION
                        )
                    );

                    return in_array(
                        $extension,
                        [
                            'pdf',
                            'doc',
                            'docx',
                            'xls',
                            'xlsx',
                            'ppt',
                            'pptx',
                            'txt',
                        ]
                    );
                })
                ->values();
        }

        if ($view === 'archived') {

            $allFiles = $allFiles
                ->filter(function ($file) {

                    return $file->is_archived;
                })
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | SORTING
        |--------------------------------------------------------------------------
        */

        if ($sort === 'oldest') {

            $allFiles = $allFiles
                ->sortBy('created_at')
                ->values();
        }

        elseif ($sort === 'name') {

            $allFiles = $allFiles
                ->sortBy(function ($file) {

                    return strtolower(
                        $file->original_name
                        ??
                        $file->file_name
                        ??
                        ''
                    );
                })
                ->values();
        }

        elseif ($sort === 'project') {

            $allFiles = $allFiles
                ->sortBy(function ($file) {

                    return strtolower(
                        $file->project_data->project_name
                        ??
                        ''
                    );
                })
                ->values();
        }

        else {

            $allFiles = $allFiles
                ->sortByDesc('created_at')
                ->values();
        }


        /*
        |--------------------------------------------------------------------------
        | RETURN CENTRALIZED CLIENT FILES VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'client.files',
            compact(
                'client',
                'projects',
                'allFiles',
                'recentFiles',
                'totalCount',
                'activeCount',
                'archivedCount',
                'recentCount',
                'search',
                'projectId',
                'type',
                'status',
                'view',
                'sort'
            )
        );
    }
}
