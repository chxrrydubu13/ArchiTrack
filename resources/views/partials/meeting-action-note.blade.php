@php

    $isOverdue =
        $action->due_date
        && $action->status !== 'done'
        && $action->due_date->isPast();

    $isDueToday =
        $action->due_date
        && $action->status !== 'done'
        && $action->due_date->isToday();

    $typeLabel =
        match($action->type) {
            'revision' => 'Revision',
            'submission' => 'Submission',
            'follow_up' => 'Follow Up',
            default => 'Task',
        };

@endphp


<article
    class="
        sticky-note
        sticky-type-{{ $action->type }}
        {{ $isOverdue ? 'sticky-overdue' : '' }}
    "
    draggable="true"

    data-action="{{ $action->id }}"
    data-project="{{ $action->project_id }}"
    data-status="{{ $action->status }}"
>

    <div class="sticky-note-top">

        <span class="sticky-note-type">
            {{ $typeLabel }}
        </span>


        @if($action->priority === 'high')

            <span class="sticky-priority high">
                High
            </span>

        @elseif($action->priority === 'low')

            <span class="sticky-priority low">
                Low
            </span>

        @endif

    </div>


    <h4>
        {{ $action->title }}
    </h4>


    @if($action->notes)

        <p class="sticky-note-description">
            {{ $action->notes }}
        </p>

    @endif


    @if($action->meeting)

        <div class="sticky-related-meeting">

            <span>
                From meeting
            </span>

            <strong>
                {{ $action->meeting->meeting_date
                    ? $action->meeting->meeting_date->format('M d')
                    : 'Meeting'
                }}
            </strong>

        </div>

    @endif


    <div class="sticky-note-footer">

        <div class="sticky-due">

            @if($isOverdue)

                <span class="due-overdue">
                    OVERDUE
                </span>

                <strong>
                    {{ $action->due_date->format('M d') }}
                </strong>


            @elseif($isDueToday)

                <span class="due-today">
                    DUE TODAY
                </span>


            @elseif($action->due_date)

                <span>
                    Due
                </span>

                <strong>
                    {{ $action->due_date->format('M d') }}
                </strong>


            @else

                <span>
                    No due date
                </span>

            @endif

        </div>


        <span class="sticky-drag-handle" title="Drag note">

            <svg viewBox="0 0 24 24">
                <circle cx="9" cy="7" r="1"></circle>
                <circle cx="15" cy="7" r="1"></circle>
                <circle cx="9" cy="12" r="1"></circle>
                <circle cx="15" cy="12" r="1"></circle>
                <circle cx="9" cy="17" r="1"></circle>
                <circle cx="15" cy="17" r="1"></circle>
            </svg>

        </span>

    </div>

</article>