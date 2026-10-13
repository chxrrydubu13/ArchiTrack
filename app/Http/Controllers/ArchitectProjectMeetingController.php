<?php



namespace App\Http\Controllers;



use App\Models\Project;

use App\Models\ProjectMeeting;

use App\Notifications\ProjectActivityNotification;



use Illuminate\Http\Request;

use Carbon\Carbon;



class ArchitectProjectMeetingController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | GET PROJECT WITH ARCHITECT ACCESS

    |--------------------------------------------------------------------------

    |

    | The lead architect and assigned project collaborators can manage

    | project meetings.

    |

    */



    private function getProjectForArchitect(

        $projectId,

        array $with = []

    ) {

        return Project::where(

            'id',

            $projectId

        )

            ->where(

                function ($query) {



                    $query

                        ->where(

                            'architect_id',

                            auth()->id()

                        )

                        ->orWhereHas(

                            'projectArchitects',

                            function ($teamQuery) {



                                $teamQuery->where(

                                    'architect_id',

                                    auth()->id()

                                );

                            }

                        );

                }

            )

            ->with($with)

            ->firstOrFail();

    }





    /*

    |--------------------------------------------------------------------------

    | REDIRECT TO PROJECT MEETINGS

    |--------------------------------------------------------------------------

    */



    private function meetingRedirect(

        Project $project,

        ?ProjectMeeting $meeting = null

    ) {

        $url =

            route(

                'architect.projects.show',

                ['id' => $project->id]

            )

            . '?tab=meetings';



        if ($meeting) {

            $url .= '#meeting-' . $meeting->id;

        } else {

            $url .= '#project-meetings';

        }



        return redirect()->to($url);

    }





    /*

    |--------------------------------------------------------------------------

    | STORE MEETING REQUEST

    |--------------------------------------------------------------------------

    |

    | Architect-created meetings are now REQUESTS.

    | The client must approve the proposed schedule before it becomes

    | a scheduled meeting.

    |

    */



    public function store(Request $request, $id)

    {

        $project =

            $this->getProjectForArchitect(

                $id,

                [

                    'client',

                ]

            );





        /*

        |--------------------------------------------------------------------------

        | VALIDATION

        |--------------------------------------------------------------------------

        */



        $request->validate([



            'title' => [

                'required',

                'string',

                'max:255',

            ],



            'agenda' => [

                'nullable',

                'string',

                'max:3000',

            ],



            'meeting_type' => [

                'required',

                'in:online,in_person',

            ],



            'meeting_date' => [

                'required',

                'date',

                'after_or_equal:today',

            ],



            'start_time' => [

                'required',

                'date_format:H:i',

            ],



            'end_time' => [

                'nullable',

                'date_format:H:i',

                'after:start_time',

            ],



            'meeting_link' => [

                'nullable',

                'url',

                'max:500',

            ],



            'location' => [

                'nullable',

                'string',

                'max:500',

            ],



            'notes' => [

                'nullable',

                'string',

                'max:3000',

            ],



        ]);





        /*

        |--------------------------------------------------------------------------

        | ONLINE MEETING VALIDATION

        |--------------------------------------------------------------------------

        */



        if (

            $request->meeting_type === 'online'

            &&

            !$request->filled('meeting_link')

        ) {



            return back()

                ->withInput()

                ->withErrors([

                    'meeting_link' =>

                        'Meeting link is required for online meetings.'

                ]);

        }





        /*

        |--------------------------------------------------------------------------

        | IN-PERSON MEETING VALIDATION

        |--------------------------------------------------------------------------

        */



        if (

            $request->meeting_type === 'in_person'

            &&

            !$request->filled('location')

        ) {



            return back()

                ->withInput()

                ->withErrors([

                    'location' =>

                        'Location is required for in-person meetings.'

                ]);

        }





        /*

        |--------------------------------------------------------------------------

        | PREVENT PAST DATE + TIME

        |--------------------------------------------------------------------------

        */



        $meetingDateTime = Carbon::createFromFormat(

            'Y-m-d H:i',

            $request->meeting_date

            . ' '

            . $request->start_time,

            'Asia/Manila'

        );



        if (

            $meetingDateTime->lte(

                Carbon::now('Asia/Manila')

            )

        ) {



            return back()

                ->withInput()

                ->withErrors([

                    'meeting_date' =>

                        'Please select a future date and time.'

                ]);

        }





        /*

        |--------------------------------------------------------------------------

        | CREATE PENDING MEETING REQUEST

        |--------------------------------------------------------------------------

        */



        $projectMeeting = ProjectMeeting::create([



            'project_id' =>

                $project->id,



            'architect_id' =>

                auth()->id(),



            'client_id' =>

                $project->client_id,



            'proposed_by' =>

                'architect',



            'proposed_by_user_id' =>

                auth()->id(),



            'title' =>

                trim($request->title),



            'agenda' =>

                $request->filled('agenda')

                    ? trim($request->agenda)

                    : null,



            'meeting_type' =>

                $request->meeting_type,



            'meeting_date' =>

                $request->meeting_date,



            'start_time' =>

                $request->start_time,



            'end_time' =>

                $request->filled('end_time')

                    ? $request->end_time

                    : null,



            'meeting_link' =>

                $request->meeting_type === 'online'

                    ? trim($request->meeting_link)

                    : null,



            'location' =>

                $request->meeting_type === 'in_person'

                    ? trim($request->location)

                    : null,



            /*

             * Pending means the receiving party still needs

             * to approve the current proposal.

             */

            'status' =>

                'pending',



            'notes' =>

                $request->filled('notes')

                    ? trim($request->notes)

                    : null,



        ]);





        /*

        |--------------------------------------------------------------------------

        | NOTIFY CLIENT - MEETING REQUEST

        |--------------------------------------------------------------------------

        */



        if ($project->client) {



            $formattedDate =

                Carbon::parse(

                    $projectMeeting->meeting_date

                )->format('M d, Y');



            $formattedTime =

                Carbon::parse(

                    $projectMeeting->start_time

                )->format('g:i A');



            $project->client->notify(



                new ProjectActivityNotification(



                    'Meeting Request from Architect',



                    'Your architect requested "' .

                    $projectMeeting->title .

                    '" for ' .

                    $formattedDate .

                    ' at ' .

                    $formattedTime .

                    ' for ' .

                    $project->project_name .

                    '. Please review and approve, reject, or propose a new schedule.',



                    'meeting',



                    $project->id,



                    route(

                        'client.meetings.index'

                    )



                )



            );

        }





        /*

        |--------------------------------------------------------------------------

        | SUCCESS

        |--------------------------------------------------------------------------

        */



        return $this

            ->meetingRedirect(

                $project,

                $projectMeeting

            )

            ->with(

                'success',

                'Meeting request sent to the client for approval.'

            );

    }





    /*

    |--------------------------------------------------------------------------

    | UPDATE MEETING

    |--------------------------------------------------------------------------

    |

    | Meeting approval rules:

    |

    | CLIENT PROPOSAL

    | - Architect may approve it.

    | - Architect may reject it.

    | - If Architect changes the proposal, it becomes a new Architect

    |   proposal and goes back to Pending for Client approval.

    |

    | ARCHITECT PROPOSAL

    | - Architect cannot approve their own proposal.

    | - Architect may edit or withdraw it while it is still Pending.

    |

    | SCHEDULED MEETING

    | - Changing the schedule/details creates a new Architect proposal.

    | - The meeting returns to Pending until the Client approves it.

    |

    */



    public function update(

        Request $request,

        $id,

        $meeting

    ) {

        $project =

            $this->getProjectForArchitect(

                $id,

                [

                    'client',

                ]

            );



        $projectMeeting =

            ProjectMeeting::where(

                'id',

                $meeting

            )

                ->where(

                    'project_id',

                    $project->id

                )

                ->firstOrFail();





        /*

        |--------------------------------------------------------------------------

        | VALIDATION

        |--------------------------------------------------------------------------

        */



        $request->validate([



            'title' => [

                'required',

                'string',

                'max:255',

            ],



            'agenda' => [

                'nullable',

                'string',

                'max:3000',

            ],



            'meeting_type' => [

                'required',

                'in:online,in_person',

            ],



            'meeting_date' => [

                'required',

                'date',

                'after_or_equal:today',

            ],



            'start_time' => [

                'required',

                'date_format:H:i',

            ],



            'end_time' => [

                'nullable',

                'date_format:H:i',

                'after:start_time',

            ],



            'meeting_link' => [

                'nullable',

                'url',

                'max:500',

            ],



            'location' => [

                'nullable',

                'string',

                'max:500',

            ],



            'status' => [

                'required',

                'in:pending,scheduled,completed,cancelled',

            ],



            'notes' => [

                'nullable',

                'string',

                'max:3000',

            ],



        ]);





        /*

        |--------------------------------------------------------------------------

        | ONLINE MEETING VALIDATION

        |--------------------------------------------------------------------------

        */



        if (

            $request->meeting_type === 'online'

            &&

            !$request->filled('meeting_link')

        ) {



            return back()

                ->withInput()

                ->withErrors([

                    'meeting_link' =>

                        'Meeting link is required for online meetings.'

                ]);

        }





        /*

        |--------------------------------------------------------------------------

        | IN-PERSON MEETING VALIDATION

        |--------------------------------------------------------------------------

        */



        if (

            $request->meeting_type === 'in_person'

            &&

            !$request->filled('location')

        ) {



            return back()

                ->withInput()

                ->withErrors([

                    'location' =>

                        'Location is required for in-person meetings.'

                ]);

        }





        /*

        |--------------------------------------------------------------------------

        | SAVE OLD VALUES

        |--------------------------------------------------------------------------

        */



        $oldTitle =

            $projectMeeting->title;



        $oldAgenda =

            $projectMeeting->agenda;



        $oldMeetingType =

            $projectMeeting->meeting_type;



        $oldMeetingDate =

            $projectMeeting->meeting_date

                ? $projectMeeting->meeting_date->format('Y-m-d')

                : null;



        $oldStartTime =
            $projectMeeting->start_time
                ? Carbon::parse(
                    $projectMeeting->start_time
                )->format('H:i')
                : null;

        $oldEndTime =
            $projectMeeting->end_time
                ? Carbon::parse(
                    $projectMeeting->end_time
                )->format('H:i')
                : null;



        $oldMeetingLink =

            $projectMeeting->meeting_link;



        $oldLocation =

            $projectMeeting->location;



        $oldStatus =

            $projectMeeting->status;



        $oldNotes =

            $projectMeeting->notes;



        $oldProposedBy =

            $projectMeeting->proposed_by;



        $oldProposedByUserId =

            $projectMeeting->proposed_by_user_id;





        /*

        |--------------------------------------------------------------------------

        | NORMALIZE NEW VALUES

        |--------------------------------------------------------------------------

        */



        $newTitle =

            trim($request->title);



        $newAgenda =

            $request->filled('agenda')

                ? trim($request->agenda)

                : null;



        $newMeetingType =

            $request->meeting_type;



        $newMeetingDate =

            $request->meeting_date;



        $newStartTime =

            $request->start_time;



        $newEndTime =

            $request->filled('end_time')

                ? $request->end_time

                : null;



        $newMeetingLink =

            $request->meeting_type === 'online'

                ? trim($request->meeting_link)

                : null;



        $newLocation =

            $request->meeting_type === 'in_person'

                ? trim($request->location)

                : null;



        $newNotes =

            $request->filled('notes')

                ? trim($request->notes)

                : null;





        /*

        |--------------------------------------------------------------------------

        | CHECK WHAT THE ARCHITECT CHANGED

        |--------------------------------------------------------------------------

        */



        $scheduleChanged =

            $oldMeetingDate !== $newMeetingDate

            ||

            $oldStartTime !== $newStartTime

            ||

            $oldEndTime !== $newEndTime;



        $proposalDetailsChanged =

            $oldTitle !== $newTitle

            ||

            $oldAgenda !== $newAgenda

            ||

            $oldMeetingType !== $newMeetingType

            ||

            $oldMeetingLink !== $newMeetingLink

            ||

            $oldLocation !== $newLocation;



        $proposalChanged =

            $scheduleChanged

            ||

            $proposalDetailsChanged;



        $notesChanged =

            $oldNotes !== $newNotes;





        /*

        |--------------------------------------------------------------------------

        | LEGACY PENDING RECORD SUPPORT

        |--------------------------------------------------------------------------

        |

        | Before proposed_by existed, Client requests were already stored

        | as Pending while Architect-created meetings were stored directly

        | as Scheduled.

        |

        | Therefore a legacy Pending meeting with no proposed_by value is

        | treated as a Client proposal.

        |

        */



        $currentProposedBy =

            $oldProposedBy;



        if (

            !$currentProposedBy

            &&

            $oldStatus === 'pending'

        ) {

            $currentProposedBy =

                'client';

        }





        /*

        |--------------------------------------------------------------------------

        | DETERMINE FINAL STATUS + CURRENT PROPOSER

        |--------------------------------------------------------------------------

        */



        $finalStatus =

            $request->status;



        $finalProposedBy =

            $oldProposedBy;



        $finalProposedByUserId =

            $oldProposedByUserId;



        $architectApprovedClientRequest =

            false;



        $architectRejectedClientRequest =

            false;



        $architectCreatedCounterProposal =

            false;



        $architectUpdatedOwnProposal =

            false;





        /*

        |--------------------------------------------------------------------------

        | PENDING CLIENT PROPOSAL

        |--------------------------------------------------------------------------

        */



        if (

            $oldStatus === 'pending'

            &&

            $currentProposedBy === 'client'

        ) {



            /*

             * If Architect changes any proposal detail, this is no longer

             * an approval. It becomes a counter-proposal requiring Client

             * approval.

             */

            if (
                $request->input('approval_action') ===
                'approve_client_request'
            ) {

                $finalStatus =
                    'scheduled';

                $finalProposedBy =
                    $oldProposedBy ?: 'client';

                $finalProposedByUserId =
                    $oldProposedByUserId;

                $architectApprovedClientRequest =
                    true;

                /*
                 * Confirm means approve exactly what the client proposed.
                 * Keep the stored proposal values so formatting differences
                 * cannot turn this into a counter-proposal.
                 */
                $newTitle =
                    $oldTitle;

                $newAgenda =
                    $oldAgenda;

                $newMeetingType =
                    $oldMeetingType;

                $newMeetingDate =
                    $oldMeetingDate;

                $newStartTime =
                    $oldStartTime;

                $newEndTime =
                    $oldEndTime;

                $newMeetingLink =
                    $oldMeetingLink;

                $newLocation =
                    $oldLocation;

                $newNotes =
                    $oldNotes;

            } elseif ($proposalChanged) {



                $finalStatus =

                    'pending';



                $finalProposedBy =

                    'architect';



                $finalProposedByUserId =

                    auth()->id();



                $architectCreatedCounterProposal =

                    true;



            } elseif (

                $request->status === 'scheduled'

            ) {



                $finalStatus =

                    'scheduled';



                $architectApprovedClientRequest =

                    true;



            } elseif (

                $request->status === 'cancelled'

            ) {



                $finalStatus =

                    'cancelled';



                $architectRejectedClientRequest =

                    true;



            } elseif (

                $request->status === 'completed'

            ) {



                return back()

                    ->withInput()

                    ->withErrors([

                        'status' =>

                            'A pending meeting request cannot be marked as completed.'

                    ]);



            } else {



                $finalStatus =

                    'pending';

            }

        }





        /*

        |--------------------------------------------------------------------------

        | PENDING ARCHITECT PROPOSAL

        |--------------------------------------------------------------------------

        */



        elseif (

            $oldStatus === 'pending'

            &&

            $currentProposedBy === 'architect'

        ) {



            /*

             * Architect cannot approve their own request.

             */

            if (

                $request->status === 'scheduled'

            ) {



                return back()

                    ->withInput()

                    ->withErrors([

                        'status' =>

                            'This meeting request is waiting for client approval. The architect cannot approve their own request.'

                    ]);

            }



            if (

                $request->status === 'completed'

            ) {



                return back()

                    ->withInput()

                    ->withErrors([

                        'status' =>

                            'A pending meeting request cannot be marked as completed.'

                    ]);

            }



            if (

                $request->status === 'cancelled'

            ) {



                $finalStatus =

                    'cancelled';



            } else {



                $finalStatus =

                    'pending';



                $finalProposedBy =

                    'architect';



                $finalProposedByUserId =

                    auth()->id();



                if (

                    $proposalChanged

                    ||

                    $notesChanged

                ) {

                    $architectUpdatedOwnProposal =

                        true;

                }

            }

        }





        /*

        |--------------------------------------------------------------------------

        | SCHEDULED MEETING

        |--------------------------------------------------------------------------

        */



        elseif ($oldStatus === 'scheduled') {



            /*

             * Any proposal change means the previously approved schedule

             * is no longer final. The Architect is proposing a new version,

             * so Client approval is required again.

             */

            if ($proposalChanged) {



                $finalStatus =

                    'pending';



                $finalProposedBy =

                    'architect';



                $finalProposedByUserId =

                    auth()->id();



                $architectCreatedCounterProposal =

                    true;



            } elseif (

                $request->status === 'pending'

            ) {



                return back()

                    ->withInput()

                    ->withErrors([

                        'status' =>

                            'A scheduled meeting can only return to Pending when a new meeting proposal is made.'

                    ]);

            }

        }





        /*

        |--------------------------------------------------------------------------

        | COMPLETED / CANCELLED MEETING

        |--------------------------------------------------------------------------

        */



        elseif (

            in_array(

                $oldStatus,

                [

                    'completed',

                    'cancelled',

                ],

                true

            )

        ) {



            if ($proposalChanged) {



                return back()

                    ->withInput()

                    ->withErrors([

                        'meeting_date' =>

                            'Completed or cancelled meetings can no longer be rescheduled.'

                    ]);

            }

        }





        /*

        |--------------------------------------------------------------------------

        | PREVENT PAST DATE + TIME

        |--------------------------------------------------------------------------

        |

        | Only Pending and Scheduled meetings need a future schedule.

        |

        */



        if (

            in_array(

                $finalStatus,

                [

                    'pending',

                    'scheduled',

                ],

                true

            )

        ) {



            $newMeetingDateTime =

                Carbon::createFromFormat(

                    'Y-m-d H:i',

                    $newMeetingDate

                    . ' '

                    . $newStartTime,

                    'Asia/Manila'

                );



            if (

                $newMeetingDateTime->lte(

                    Carbon::now('Asia/Manila')

                )

            ) {



                return back()

                    ->withInput()

                    ->withErrors([

                        'meeting_date' =>

                            'Please select a future date and time.'

                    ]);

            }

        }





        /*

        |--------------------------------------------------------------------------

        | UPDATE

        |--------------------------------------------------------------------------

        */



        $projectMeeting->update([



            'title' =>

                $newTitle,



            'agenda' =>

                $newAgenda,



            'meeting_type' =>

                $newMeetingType,



            'meeting_date' =>

                $newMeetingDate,



            'start_time' =>

                $newStartTime,



            'end_time' =>

                $newEndTime,



            'meeting_link' =>

                $newMeetingLink,



            'location' =>

                $newLocation,



            'status' =>

                $finalStatus,



            'proposed_by' =>

                $finalProposedBy,



            'proposed_by_user_id' =>

                $finalProposedByUserId,



            'notes' =>

                $newNotes,



        ]);



        $projectMeeting->refresh();





        /*

        |--------------------------------------------------------------------------

        | NOTIFY CLIENT

        |--------------------------------------------------------------------------

        */



        if ($project->client) {



            $formattedDate =

                Carbon::parse(

                    $projectMeeting->meeting_date

                )->format('M d, Y');



            $formattedTime =

                Carbon::parse(

                    $projectMeeting->start_time

                )->format('g:i A');





            /*

            |--------------------------------------------------------------------------

            | ARCHITECT APPROVED CLIENT REQUEST

            |--------------------------------------------------------------------------

            */



            if ($architectApprovedClientRequest) {



                $notificationTitle =

                    'Meeting Request Approved';



                $notificationMessage =

                    'Your meeting request "' .

                    $projectMeeting->title .

                    '" for ' .

                    $project->project_name .

                    ' has been approved for ' .

                    $formattedDate .

                    ' at ' .

                    $formattedTime .

                    '.';





            /*

            |--------------------------------------------------------------------------

            | ARCHITECT REJECTED CLIENT REQUEST

            |--------------------------------------------------------------------------

            */



            } elseif ($architectRejectedClientRequest) {



                $notificationTitle =

                    'Meeting Request Rejected';



                $notificationMessage =

                    'Your meeting request "' .

                    $projectMeeting->title .

                    '" for ' .

                    $project->project_name .

                    ' was not approved by the architect.';





            /*

            |--------------------------------------------------------------------------

            | ARCHITECT PROPOSED A NEW VERSION / RESCHEDULE

            |--------------------------------------------------------------------------

            */



            } elseif ($architectCreatedCounterProposal) {



                $notificationTitle =

                    $oldStatus === 'scheduled'

                        ? 'Meeting Reschedule Request'

                        : 'New Meeting Proposal';



                $notificationMessage =

                    'Your architect proposed "' .

                    $projectMeeting->title .

                    '" for ' .

                    $formattedDate .

                    ' at ' .

                    $formattedTime .

                    ' for ' .

                    $project->project_name .

                    '. Please review the new proposal.';





            /*

            |--------------------------------------------------------------------------

            | ARCHITECT UPDATED THEIR PENDING REQUEST

            |--------------------------------------------------------------------------

            */



            } elseif ($architectUpdatedOwnProposal) {



                $notificationTitle =

                    'Meeting Request Updated';



                $notificationMessage =

                    'Your architect updated the pending meeting request "' .

                    $projectMeeting->title .

                    '" for ' .

                    $project->project_name .

                    '. Please review the latest details.';





            /*

            |--------------------------------------------------------------------------

            | CANCELLED / WITHDRAWN

            |--------------------------------------------------------------------------

            */



            } elseif (

                $oldStatus !== $projectMeeting->status

                &&

                $projectMeeting->status === 'cancelled'

            ) {



                $notificationTitle =

                    'Meeting Cancelled';



                $notificationMessage =

                    '"' .

                    $projectMeeting->title .

                    '" for ' .

                    $project->project_name .

                    ' has been cancelled.';





            /*

            |--------------------------------------------------------------------------

            | COMPLETED

            |--------------------------------------------------------------------------

            */



            } elseif (

                $oldStatus !== $projectMeeting->status

                &&

                $projectMeeting->status === 'completed'

            ) {



                $notificationTitle =

                    'Meeting Completed';



                $notificationMessage =

                    '"' .

                    $projectMeeting->title .

                    '" for ' .

                    $project->project_name .

                    ' has been marked as completed.';





            /*

            |--------------------------------------------------------------------------

            | OTHER UPDATE

            |--------------------------------------------------------------------------

            */



            } elseif (

                $proposalChanged

                ||

                $notesChanged

                ||

                $oldStatus !== $projectMeeting->status

            ) {



                $notificationTitle =

                    'Meeting Updated';



                $notificationMessage =

                    'Your architect updated the meeting "' .

                    $projectMeeting->title .

                    '" for ' .

                    $project->project_name .

                    '.';



            } else {



                $notificationTitle =

                    null;



                $notificationMessage =

                    null;

            }





            if (

                $notificationTitle

                &&

                $notificationMessage

            ) {



                $project->client->notify(



                    new ProjectActivityNotification(



                        $notificationTitle,



                        $notificationMessage,



                        'meeting',



                        $project->id,



                        route(

                            'client.meetings.index'

                        )



                    )



                );

            }

        }





        /*

        |--------------------------------------------------------------------------

        | SUCCESS MESSAGE

        |--------------------------------------------------------------------------

        */



        if ($architectApprovedClientRequest) {



            $successMessage =

                'Meeting request approved successfully.';



        } elseif ($architectRejectedClientRequest) {



            $successMessage =

                'Meeting request rejected successfully.';



        } elseif ($architectCreatedCounterProposal) {



            $successMessage =

                'Updated meeting proposal sent to the client for approval.';



        } elseif (

            $oldStatus === 'pending'

            &&

            $currentProposedBy === 'architect'

            &&

            $finalStatus === 'cancelled'

        ) {



            $successMessage =

                'Meeting request withdrawn successfully.';



        } elseif (

            $finalStatus === 'pending'

            &&

            $currentProposedBy === 'architect'

        ) {



            $successMessage =

                'Meeting request updated. It is still waiting for client approval.';



        } else {



            $successMessage =

                'Meeting updated successfully.';

        }





        return $this

            ->meetingRedirect(

                $project,

                $projectMeeting

            )

            ->with(

                'success',

                $successMessage

            );

    }





    /*

    |--------------------------------------------------------------------------

    | DELETE MEETING

    |--------------------------------------------------------------------------

    */



    public function destroy($id, $meeting)

    {

        $project =

            $this->getProjectForArchitect(

                $id,

                [

                    'client',

                ]

            );



        $projectMeeting =

            ProjectMeeting::where(

                'id',

                $meeting

            )

                ->where(

                    'project_id',

                    $project->id

                )

                ->firstOrFail();





        /*

        |--------------------------------------------------------------------------

        | PREVENT DELETE OF PAST MEETING

        |--------------------------------------------------------------------------

        */



        $existingEndTime =

            $projectMeeting->end_time

                ?: $projectMeeting->start_time;



        $meetingDateTime =

            Carbon::parse(

                $projectMeeting->meeting_date->format('Y-m-d')

                . ' '

                . $existingEndTime,

                'Asia/Manila'

            );



        if (

            $meetingDateTime->isPast()

        ) {



            return $this

                ->meetingRedirect(

                    $project,

                    $projectMeeting

                )

                ->withErrors([

                    'meeting_date' =>

                        'Past meeting records cannot be deleted.'

                ]);

        }





        /*

        |--------------------------------------------------------------------------

        | SAVE MEETING INFORMATION BEFORE DELETE

        |--------------------------------------------------------------------------

        */



        $meetingTitle =

            $projectMeeting->title;





        /*

        |--------------------------------------------------------------------------

        | DELETE MEETING

        |--------------------------------------------------------------------------

        */



        $projectMeeting->delete();





        /*

        |--------------------------------------------------------------------------

        | NOTIFY CLIENT - MEETING REMOVED

        |--------------------------------------------------------------------------

        */



        if ($project->client) {



            $project->client->notify(



                new ProjectActivityNotification(



                    'Meeting Removed',



                    'The meeting "' .

                    $meetingTitle .

                    '" for ' .

                    $project->project_name .

                    ' has been removed.',



                    'meeting',



                    $project->id,



                    route(

                        'client.meetings.index'

                    )



                )



            );

        }





        /*

        |--------------------------------------------------------------------------

        | SUCCESS

        |--------------------------------------------------------------------------

        */



        return $this

            ->meetingRedirect(

                $project

            )

            ->with(

                'success',

                'Meeting deleted successfully.'

            );

    }

}
