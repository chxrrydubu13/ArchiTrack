<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>{{ $project->project_name }} | Admin Project Overview</title>
    @vite([
        'resources/css/app.css',
        'resources/css/dashboard.css',
        'resources/css/admin-projects.css',
        'resources/css/admin-sidebar.css',
        'resources/js/app.js'
    ])
</head>
<body>
<div class="admin-app">
    <div class="architectural-background">
        <div class="blueprint-left">
            <div class="blueprint-grid"></div>
        </div>
        <img
            src="{{ asset('images/lineart2.png') }}"
            alt=""
            class="right-building-lineart"
        >
    </div>
    <button
        type="button"
        class="mobile-sidebar-launcher"
        id="mobileSidebarLauncher"
        aria-label="Open navigation"
        aria-controls="adminSidebar"
        aria-expanded="false"
    >
        <svg viewBox="0 0 24 24">
            <path d="M4 6h16"></path>
            <path d="M4 12h16"></path>
            <path d="M4 18h16"></path>
        </svg>
    </button>
    <aside
        class="sidebar"
        id="adminSidebar"
    >
        <div class="sidebar-top">
            <a
                href="{{ route('admin.dashboard') }}"
                class="sidebar-logo"
                aria-label="ArchiTrack Admin Dashboard"
            >
                <img
                    src="{{ asset('images/arlogo.jpg') }}"
                    alt="ArchiTrack"
                >
            </a>
            <button
                type="button"
                class="sidebar-toggle"
                id="sidebarToggle"
                aria-label="Minimize sidebar"
                aria-expanded="true"
            >
                <svg viewBox="0 0 24 24">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
            </button>
        </div>
        <div class="admin-identity">
            <div class="admin-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="admin-identity-copy">
                <strong>
                    {{ auth()->user()->name }}
                </strong>
                <span>
                    System Administrator
                </span>
            </div>
            <span class="admin-online-dot"></span>
        </div>
        <div class="sidebar-divider"></div>
        <nav class="admin-sidebar-nav">
            <p class="menu-title">
                MAIN
            </p>
        <a
            href="{{ route('admin.dashboard') }}"
            class="menu-link"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
        <rect x="3" y="3" width="7" height="7" rx="1"></rect>
        <rect x="14" y="3" width="7" height="7" rx="1"></rect>
        <rect x="3" y="14" width="7" height="7" rx="1"></rect>
        <rect x="14" y="14" width="7" height="7" rx="1"></rect>
    </svg>
            </span>
            <span class="menu-text">
                Dashboard
            </span>
        </a>
        <a
            href="{{ route('admin.architects.index') }}"
            class="menu-link"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
        <circle cx="9" cy="7" r="4"></circle>
        <path d="M2 21a7 7 0 0 1 14 0"></path>
        <circle cx="17" cy="8" r="3"></circle>
        <path d="M16 14a6 6 0 0 1 6 6"></path>
    </svg>
            </span>
            <span class="menu-text">
                Architects
            </span>
        </a>
        <a
            href="{{ route('admin.projects.index') }}"
            class="menu-link active"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
        <path d="M3 7h7l2 2h9v10H3z"></path>
        <path d="M3 7V5h7l2 2"></path>
    </svg>
            </span>
            <span class="menu-text">
                Projects Overview
            </span>
        </a>
            <p class="menu-title">
                PLANNED
            </p>
        <a
            href="{{ route('admin.financial.index') }}"
            class="menu-link"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
        <path d="M4 20V10"></path>
        <path d="M10 20V4"></path>
        <path d="M16 20v-7"></path>
        <path d="M22 20V7"></path>
    </svg>
            </span>
            <span class="menu-text">
                Financial Overview
            </span>
        </a>
        <a
            href="{{ route('admin.reports.index') }}"
            class="menu-link"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M6 3h9l4 4v14H6z"></path>
                    <path d="M15 3v5h5"></path>
                    <path d="M9 12h6"></path>
                    <path d="M9 16h6"></path>
                </svg>
            </span>
            <span class="menu-text">
                Reports Center
            </span>
        </a>
            <p class="menu-title">
                MONITORING
            </p>
        <a
            href="{{ route('admin.audit-logs.index') }}"
            class="menu-link"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
        <rect x="5" y="4" width="14" height="17" rx="2"></rect>
        <path d="M9 4V2h6v2"></path>
        <path d="M9 9h6"></path>
        <path d="M9 13h6"></path>
        <path d="M9 17h4"></path>
    </svg>
            </span>
            <span class="menu-text">
                Audit Logs
            </span>
        </a>
        <a
            href="{{ route('admin.bearo-analytics.index') }}"
            class="menu-link"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
        <path d="M4 19h16"></path>
        <path d="M6 16l3-5 3 2 4-7 2 3"></path>
    </svg>
            </span>
            <span class="menu-text">
                Bearo Analytics
            </span>
        </a>
            <p class="menu-title">
                ACCOUNT
            </p>
        <a
            href="{{ route('admin.bearo-settings.edit') }}"
            class="menu-link"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
        <path d="M5 5h14v10H9l-4 4z"></path>
        <path d="M8 9h8"></path>
        <path d="M8 12h5"></path>
    </svg>
            </span>
            <span class="menu-text">
                Bearo Settings
            </span>
        </a>
        <a
            href="{{ route('admin.settings') }}"
            class="menu-link"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="3"></circle>
        <circle cx="12" cy="12" r="8"></circle>
    </svg>
            </span>
            <span class="menu-text">
                Settings
            </span>
        </a>
        </nav>
        <form
            method="POST"
            action="{{ route('logout') }}"
            class="logout-form"
        >
            @csrf
            <button
                type="submit"
                class="logout-btn"
            >
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24">
        <path d="M10 17l5-5-5-5"></path>
        <path d="M15 12H3"></path>
        <path d="M13 4h7v16h-7"></path>
    </svg>
                </span>
                <span class="menu-text">
                    Log Out
                </span>
            </button>
        </form>
    </aside>
    <button
        type="button"
        class="sidebar-backdrop"
        id="sidebarBackdrop"
        aria-label="Close navigation"
    ></button>
    <main class="main-content">
        <header class="topbar admin-studio-topbar">
            <button type="button" class="topbar-menu-button" id="topbarMenuButton" aria-label="Open navigation">
                <svg viewBox="0 0 24 24"><path d="M4 6h16"></path><path d="M4 12h16"></path><path d="M4 18h16"></path></svg>
            </button>
            <div class="studio-topbar-copy"><span>ADMINISTRATION / PROJECTS</span><h1>Project Records</h1></div>
            <div class="studio-topbar-meta">
                <div><span>{{ now('Asia/Manila')->format('l, F j, Y') }}</span><strong>{{ now('Asia/Manila')->format('h:i A') }} PH</strong></div>
                <div class="studio-admin-chip">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            </div>
        </header>
        @php
            $isRetained = in_array($project->admin_architect_account_state, ['archived', 'deleted'], true);
            $progressValue = max(0, min(100, (int) ($project->progress ?? 0)));
        @endphp
        <div class="record-shell">
            <div class="record-breadcrumb"><a href="{{ route('admin.projects.index') }}">Projects Overview</a><span>/</span><span>Project #{{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}</span></div>
            <section class="record-header">
                <div class="record-header-main">
                    <div class="record-eyebrow">PROJECT RECORD <span class="record-eyebrow-separator">/</span> #{{ str_pad($project->id, 3, '0', STR_PAD_LEFT) }}</div>
                    <h2>{{ $project->project_name }}</h2>
                    <p>{{ $project->description ?: 'No project description has been provided.' }}</p>
                    <div class="record-header-tags">
                        <span class="record-status-tag">Project: {{ ucwords(str_replace('_', ' ', $project->status ?? 'Not set')) }}</span>
                        @if($isRetained)
                            <span class="record-archive-tag">Archived record · Admin only</span>
                        @endif
                        <span class="record-view-tag">Read-only view</span>
                    </div>
                </div>
                <div class="record-progress-block">
                    <span class="record-progress-label">OVERALL PROGRESS</span>
                    <strong>{{ $progressValue }}<small>%</small></strong>
                    <progress value="{{ $progressValue }}" max="100" aria-label="Overall project progress">{{ $progressValue }}%</progress>
                    <span class="record-progress-foot">Current phase: {{ $currentPhaseName }}</span>
                </div>
            </section>
            @if($isRetained)
                <div class="record-preservation-note"><strong>Preserved for administrative purposes.</strong> Lead architect: {{ $project->admin_architect_name }}. Original project status and historical records remain unchanged.</div>
            @endif
            <div class="record-stats">
                <div><span>PHASES COMPLETED</span><strong>{{ $completedPhases }} <small>/ {{ $totalPhases }}</small></strong></div>
                <div><span>MILESTONES</span><strong>{{ $completedMilestones }} <small>/ {{ $totalMilestones }}</small></strong></div>
                <div><span>PROJECT FILES</span><strong>{{ $project->files_count }}</strong></div>
                <div><span>REVISIONS</span><strong>{{ $project->revisions_count }}</strong></div>
                <div><span>MEETINGS</span><strong>{{ $project->meetings_count }}</strong></div>
            </div>
            <div class="record-workspace">
                <aside class="record-navigation" aria-label="Project record sections">
                    <div class="record-navigation-heading"><span>WORKSPACE</span><strong>Record sections</strong></div>
                    <nav class="record-navigation-list">
                        <button type="button" class="record-nav-item is-active" data-archive-target="overview" aria-selected="true"><span class="record-nav-index">01</span><span>Overview</span></button>
                        <button type="button" class="record-nav-item" data-archive-target="Project Files" aria-selected="false"><span class="record-nav-index">02</span><span>Project files</span><span class="record-nav-count">{{ $project->files->count() }}</span></button>
                        <button type="button" class="record-nav-item" data-archive-target="Messages" aria-selected="false"><span class="record-nav-index">03</span><span>Messages</span></button>
                        <button type="button" class="record-nav-item" data-archive-target="Revision Requests" aria-selected="false"><span class="record-nav-index">04</span><span>Revisions</span></button>
                        <button type="button" class="record-nav-item" data-archive-target="Meetings" aria-selected="false"><span class="record-nav-index">05</span><span>Meetings</span></button>
                        <button type="button" class="record-nav-item" data-archive-target="AI History" aria-selected="false"><span class="record-nav-index">06</span><span>AI history</span></button>
                        <button type="button" class="record-nav-item" data-archive-target="Phases & Milestone Details" aria-selected="false"><span class="record-nav-index">07</span><span>Milestones</span></button>
                        <button type="button" class="record-nav-item" data-archive-target="Meeting Action Notes" aria-selected="false"><span class="record-nav-index">08</span><span>Action notes</span></button>
                        <button type="button" class="record-nav-item" data-archive-target="Project Expenses" aria-selected="false"><span class="record-nav-index">09</span><span>Expenses</span></button>
                        <button type="button" class="record-nav-item" data-archive-target="Project Audit Logs" aria-selected="false"><span class="record-nav-index">10</span><span>Audit trail</span><span class="record-nav-count">{{ $auditLogs->count() }}</span></button>
                    </nav>
                    <div class="record-navigation-note">Administrative access only. This workspace does not modify project data.</div>
                </aside>
                <div class="record-content">
                    <section class="record-panel" data-archive-panel="overview">
                        <div class="record-section-head"><div><span>PROJECT INFORMATION</span><h3>Project overview</h3></div><span class="record-head-meta">Read-only</span></div>
                        <div class="record-overview-grid">
                            <div class="record-info"><span>LEAD ARCHITECT</span><strong>{{ $project->admin_architect_name }}</strong><small>{{ $project->architect?->email ?? 'No email available' }}</small></div>
                            <div class="record-info"><span>CLIENT</span><strong>{{ $project->client?->name ?? $project->client_name ?? 'Not assigned' }}</strong><small>{{ $project->client?->email ?? $project->client_email ?? 'No email available' }}</small></div>
                            <div class="record-info"><span>START DATE</span><strong>{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M d, Y') : 'Not set' }}</strong></div>
                            <div class="record-info"><span>TARGET DATE</span><strong>{{ $project->target_date ? \Carbon\Carbon::parse($project->target_date)->format('M d, Y') : 'Not set' }}</strong></div>
                            <div class="record-info"><span>ARCHITECT ACCOUNT</span><strong>{{ ucwords(str_replace('_', ' ', $project->admin_architect_account_state)) }}</strong></div>
                            <div class="record-info"><span>MESSAGES</span><strong>{{ $project->messages_count }}</strong></div>
                        </div>
                        <div class="record-subsection"><h4>Phase progress</h4>
                            @forelse($project->phases as $phase)
                                <div class="record-phase-row"><div class="record-phase-name"><strong>{{ $phase->phase_name }}</strong><small>{{ $phase->milestones->where('status', 'completed')->count() }} / {{ $phase->milestones->count() }} milestones completed</small></div><span class="record-phase-status">{{ ucwords(str_replace('_', ' ', $phase->status ?? 'pending')) }}</span></div>
                            @empty
                                <p class="record-empty">No project phases recorded.</p>
                            @endforelse
                        </div>
                        <div class="record-subsection"><h4>Project collaborators</h4>
                            @forelse($project->collaborators as $collaborator)
                                <div class="record-person"><span class="record-person-avatar">{{ strtoupper(substr($collaborator->name, 0, 1)) }}</span><div><strong>{{ $collaborator->name }}</strong><small>{{ ucwords(str_replace('_', ' ', $collaborator->pivot->role ?? 'Collaborator')) }}</small></div></div>
                            @empty
                                <p class="record-empty">No collaborators recorded.</p>
                            @endforelse
                        </div>
                    </section>
                @php
                    $recordSections = [
                        ['title' => 'Project Files', 'records' => $project->files, 'fields' => ['id', 'file_name', 'original_name', 'description', 'version_group', 'version_number', 'is_latest', 'is_archived', 'created_at']],
                        ['title' => 'Messages', 'records' => $project->messages, 'fields' => ['id', 'sender_id', 'message', 'content', 'body', 'created_at']],
                        ['title' => 'Revision Requests', 'records' => $project->revisions, 'fields' => ['id', 'title', 'description', 'request', 'status', 'response', 'created_at']],
                        ['title' => 'Meetings', 'records' => $project->meetings, 'fields' => ['id', 'title', 'agenda', 'meeting_date', 'scheduled_at', 'status', 'notes', 'created_at']],
                        ['title' => 'AI History', 'records' => $project->aiHistories, 'fields' => ['id', 'type', 'client_id', 'prompt', 'result_text', 'version_number', 'parent_history_id', 'sent_to_architect', 'created_at']],
                        ['title' => 'Meeting Action Notes', 'records' => $project->meetingActions, 'fields' => ['id', 'title', 'description', 'action', 'status', 'due_date', 'created_at']],
                        ['title' => 'Project Expenses', 'records' => $project->expenses, 'fields' => ['id', 'description', 'category', 'amount', 'expense_date', 'created_at']],
                    ];
                @endphp

                @foreach($recordSections as $section)
                    <section class="admin-history-section record-panel" data-archive-panel="{{ $section['title'] }}" hidden>
                        <div class="record-section-head"><h3>{{ $section['title'] }}<span>({{ $section['records']->count() }})</span></h3></div>
                        @forelse($section['records'] as $record)
                            <article class="admin-history-record">
                                <div class="admin-history-record-title">Record #{{ $record->getKey() }}</div>
                                <dl>
                                    @foreach($section['fields'] as $field)
                                        @if(!is_null($record->getAttribute($field)) && is_scalar($record->getAttribute($field)))
                                            <div>
                                                <dt>{{ ucwords(str_replace('_', ' ', $field)) }}</dt>
                                                <dd>{{ $record->getAttribute($field) }}</dd>
                                            </div>
                                        @endif
                                    @endforeach
                                </dl>
                                @if($section['title'] === 'Project Files')
                                    <a href="{{ route('project.files.secure.download', ['projectId' => $project->id, 'fileId' => $record->getKey()]) }}">Download file (authorized access)</a>
                                    @php
                                        $fileVersions = $record->version_group
                                            ? $project->files->filter(fn ($file) =>
                                                (string) $file->version_group === (string) $record->version_group
                                            )->sortByDesc('version_number')
                                            : collect([$record]);
                                    @endphp
                                    @if($fileVersions->count() > 1)
                                        <div class="admin-history-versions">
                                            Versions in this group: {{ $fileVersions->count() }}
                                            @foreach($fileVersions as $version)
                                                <div>
                                                    Version {{ $version->version_number ?? 'N/A' }}
                                                    @if($version->is_latest) (Latest) @endif
                                                    @if($version->is_archived) (Archived file) @endif
                                                    — <a href="{{ route('project.files.secure.download', ['projectId' => $project->id, 'fileId' => $version->id]) }}">Download this version</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @elseif($section['title'] === 'AI History')
                                    @if($record->getAttribute('image_path'))
                                        <a href="{{ route('project.ai-history.reference.secure.view', ['projectId' => $project->id, 'historyId' => $record->getKey()]) }}">View reference image</a>
                                    @endif
                                    @if($record->getAttribute('generated_image_path'))
                                        <a href="{{ route('project.ai-history.generated.secure.view', ['projectId' => $project->id, 'historyId' => $record->getKey()]) }}">View generated image</a>
                                    @endif
                                @elseif($section['title'] === 'Messages' && $record->getAttribute('attachment_path'))
                                    <a href="{{ route('project.messages.attachments.secure.download', ['projectId' => $project->id, 'messageId' => $record->getKey()]) }}">Download attachment</a>
                                @elseif($section['title'] === 'Revision Requests' && $record->getAttribute('attachment_path'))
                                    <a href="{{ route('project.revisions.attachments.secure.download', ['projectId' => $project->id, 'revisionId' => $record->getKey()]) }}">Download attachment</a>
                                @endif
                            </article>
                        @empty
                            <p class="admin-history-empty">No records in this section.</p>
                        @endforelse
                    </section>
                @endforeach

                <section class="admin-history-section record-panel" data-archive-panel="Phases & Milestone Details" hidden>
                    <div class="record-section-head"><h3>Phases &amp; Milestone Details<span>({{ $totalMilestones }} milestones)</span></h3></div>
                    @forelse($project->phases as $phase)
                        <article class="admin-history-record">
                            <div class="admin-history-record-title">{{ $phase->phase_name }} — {{ $phase->status }}</div>
                            @forelse($phase->milestones as $milestone)
                                <div class="admin-milestone-row">
                                    <strong>{{ $milestone->title ?? $milestone->name ?? ('Milestone #'.$milestone->id) }}</strong>
                                    <span>{{ $milestone->status ?? 'Not set' }}</span>
                                    @if($milestone->getAttribute('proof_file'))
                                        <a href="{{ route('project.milestones.proof.secure.download', ['projectId' => $project->id, 'milestoneId' => $milestone->getKey()]) }}">Download proof</a>
                                    @endif
                                </div>
                            @empty
                                <p class="admin-history-empty">No milestones recorded.</p>
                            @endforelse
                        </article>
                    @empty
                        <p class="admin-history-empty">No phases recorded.</p>
                    @endforelse
                </section>
                <section class="admin-history-section record-panel" data-archive-panel="Project Audit Logs" hidden>
                    <div class="record-section-head"><h3>Project Audit Logs<span>({{ $auditLogs->count() }})</span></h3></div>
                    @forelse($auditLogs as $auditLog)
                        <article class="admin-history-record">
                            <div class="admin-history-record-title">
                                {{ $auditLog->action ?? 'Activity' }}
                            </div>
                            <dl>
                                <div>
                                    <dt>Recorded User</dt>
                                    <dd>{{ $auditLog->user_name ?: ($auditLog->user?->name ?? 'Unknown user') }}</dd>
                                </div>
                                <div>
                                    <dt>Recorded At</dt>
                                    <dd>{{ $auditLog->created_at?->format('M d, Y h:i A') ?? 'Not recorded' }}</dd>
                                </div>
                                @if(filled($auditLog->details))
                                    <div>
                                        <dt>Details</dt>
                                        <dd>{{ is_scalar($auditLog->details) ? $auditLog->details : json_encode($auditLog->details) }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </article>
                    @empty
                        <p class="admin-history-empty">No audit logs recorded for this project.</p>
                    @endforelse
                </section>

                    <div class="record-bottom-note">Records are displayed for administrative review. Downloads use the existing protected file routes.</div>
                </div>
            </div>
        </div>
    </main>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

// Records workspace navigation — presentation only, no writes or mutations.
(function () {
    const tabs = Array.from(document.querySelectorAll('[data-archive-target]'));
    const panels = Array.from(document.querySelectorAll('[data-archive-panel]'));
    if (!tabs.length || !panels.length) return;

    function selectSection(name) {
        tabs.forEach(function (tab) {
            const selected = tab.dataset.archiveTarget === name;
            tab.classList.toggle('is-active', selected);
            tab.setAttribute('aria-selected', selected ? 'true' : 'false');
        });
        panels.forEach(function (panel) {
            const selected = panel.dataset.archivePanel === name;
            panel.hidden = !selected;
            
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            selectSection(tab.dataset.archiveTarget);
        });
    });
    selectSection('overview');
})();

    const body = document.body;
    const sidebar = document.getElementById('adminSidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    const mobileSidebarLauncher = document.getElementById('mobileSidebarLauncher');
    const topbarMenuButton = document.getElementById('topbarMenuButton');
    const desktopMedia =
        window.matchMedia('(min-width: 701px)');
    function setDesktopCollapsed(collapsed) {
        if (!desktopMedia.matches) {
            return;
        }
        body.classList.toggle(
            'sidebar-collapsed',
            collapsed
        );
        sidebarToggle?.setAttribute(
            'aria-expanded',
            collapsed ? 'false' : 'true'
        );
        sidebarToggle?.setAttribute(
            'aria-label',
            collapsed
                ? 'Maximize sidebar'
                : 'Minimize sidebar'
        );
        localStorage.setItem(
            'architrackAdminSidebarCollapsed',
            collapsed ? '1' : '0'
        );
    }
    function openMobileSidebar() {
        if (desktopMedia.matches) {
            return;
        }
        body.classList.add(
            'mobile-sidebar-open'
        );
        mobileSidebarLauncher?.setAttribute(
            'aria-expanded',
            'true'
        );
    }
    function closeMobileSidebar() {
        body.classList.remove(
            'mobile-sidebar-open'
        );
        mobileSidebarLauncher?.setAttribute(
            'aria-expanded',
            'false'
        );
    }
    function syncSidebarForViewport() {
        closeMobileSidebar();
        if (desktopMedia.matches) {
            setDesktopCollapsed(
                localStorage.getItem(
                    'architrackAdminSidebarCollapsed'
                ) === '1'
            );
        } else {
            body.classList.remove(
                'sidebar-collapsed'
            );
        }
    }
    sidebarToggle?.addEventListener(
        'click',
        function () {
            if (desktopMedia.matches) {
                setDesktopCollapsed(
                    !body.classList.contains(
                        'sidebar-collapsed'
                    )
                );
            } else {
                closeMobileSidebar();
            }
        }
    );
    mobileSidebarLauncher?.addEventListener(
        'click',
        openMobileSidebar
    );
    topbarMenuButton?.addEventListener(
        'click',
        openMobileSidebar
    );
    sidebarBackdrop?.addEventListener(
        'click',
        closeMobileSidebar
    );
    document.addEventListener(
        'keydown',
        function (event) {
            if (
                event.key === 'Escape'
                &&
                body.classList.contains(
                    'mobile-sidebar-open'
                )
            ) {
                closeMobileSidebar();
            }
        }
    );
    sidebar?.querySelectorAll('a').forEach(
        function (link) {
            link.addEventListener(
                'click',
                function () {
                    if (!desktopMedia.matches) {
                        closeMobileSidebar();
                    }
                }
            );
        }
    );
    if (desktopMedia.addEventListener) {
        desktopMedia.addEventListener(
            'change',
            syncSidebarForViewport
        );
    } else {
        desktopMedia.addListener(
            syncSidebarForViewport
        );
    }
    syncSidebarForViewport();
});
</script>
@include('partials.session-timeout-warning')
</body>
</html>
