<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $project->project_name }} | ArchiTrack
    </title>

    @vite([
        'resources/css/app.css',
        'resources/css/show-architect-project.css',
        'resources/css/architect-project-phases.css',
        'resources/css/architect-project-team.css',
        'resources/css/architect-project-financial.css',
        'resources/css/architect-project-analytics.css',
        'resources/css/architect-project-uniform.css',
        'resources/css/architect-dashboard.css',
        'resources/js/app.js'
    ])


    <style>
    .workspace-logout-form { margin-left:auto; }
    .workspace-logout-button { border:1px solid #e4d7cb; background:#fff; color:#a94e20; border-radius:9px; padding:10px 16px; font-weight:700; cursor:pointer; }
    .workspace-logout-button:hover { background:#fff3e9; }
    .workspace-request-count { display:inline-flex; align-items:center; justify-content:center; min-width:20px; height:20px; padding:0 6px; margin-left:7px; border-radius:20px; background:#e66b27; color:#fff; font-size:11px; font-weight:800; }
    #project-chat .messenger-drawer-section-content .meetings-panel { display:block !important; width:100%; min-width:0; padding:0; margin:0; background:transparent; }
    #project-chat .messenger-drawer-section-content .meetings-panel .section-header { display:flex; flex-wrap:wrap; gap:10px; align-items:start; }
    #project-chat .messenger-drawer-section-content .meetings-panel .section-header h2 { font-size:17px; }
    #project-chat .messenger-drawer-section-content .meetings-panel .section-header p { font-size:12px; }
    #project-chat .messenger-drawer-section-content .meetings-panel * { max-width:100%; box-sizing:border-box; }
    #project-chat .messenger-drawer-section-content .meetings-panel input,
    #project-chat .messenger-drawer-section-content .meetings-panel select,
    #project-chat .messenger-drawer-section-content .meetings-panel textarea { min-width:0; }

/* File-upload modals: scoped layout repair; other workspace sections unchanged */
#versionModal .upload-modal-card, #uploadModal .upload-modal-card {
  box-sizing: border-box; width: min(680px, calc(100vw - 32px)); max-width: 680px;
  max-height: min(90vh, 850px); overflow-y: auto; overflow-x: hidden;
}
#versionModal .upload-modal-header, #uploadModal .upload-modal-header {
  display: flex; justify-content: space-between; align-items: flex-start;
  gap: 18px; padding: 26px 28px 20px;
}
#versionModal .upload-modal-header > div, #uploadModal .upload-modal-header > div {
  flex: 1; min-width: 0;
}
#versionModal .upload-modal-header p, #uploadModal .upload-modal-header p {
  overflow-wrap: anywhere; line-height: 1.6;
}
#versionModal .modal-close, #uploadModal .modal-close {
  flex: 0 0 42px; width: 42px; height: 42px;
}
#versionModal .version-current-file {
  display: grid; grid-template-columns: 100px minmax(0,1fr); gap: 5px 18px;
  align-items: center; margin: 0 28px 22px; padding: 16px 18px;
  border: 1px solid #e5e0d9; border-radius: 12px; background: #f7f5f1;
}
#versionModal .version-current-file > span {
  grid-row: 1 / span 2; font-size: 11px; font-weight: 800;
  letter-spacing: .07em; color: #bc5b21;
}
#versionModal .version-current-file > strong {
  display: block; min-width: 0; overflow-wrap: anywhere;
  font-size: 14px; line-height: 1.45; color: #273747;
}
#versionModal .version-current-file > small {
  display: block; min-width: 0; font-size: 12px; line-height: 1.45;
  color: #677585; overflow-wrap: anywhere;
}
#versionModal .upload-form, #uploadModal .upload-form { padding: 0 28px 26px; }
#versionModal .upload-drop-label, #uploadModal .upload-drop-label { max-width: 100%; overflow-wrap: anywhere; }
#versionModal .upload-drop-label strong, #uploadModal .upload-drop-label strong {
  display: block; max-width: 100%; overflow-wrap: anywhere;
}
#uploadModal #selectedFileText { overflow-wrap: anywhere; max-height: 110px; overflow-y: auto; }
@media (max-width: 520px) {
  #versionModal .upload-modal-header, #uploadModal .upload-modal-header { padding: 20px 18px 16px; }
  #versionModal .upload-form, #uploadModal .upload-form { padding: 0 18px 20px; }
  #versionModal .version-current-file { margin: 0 18px 18px; grid-template-columns: 1fr; gap: 7px; }
  #versionModal .version-current-file > span { grid-row: auto; }
}

        /* =========================================================
           TWO-WAY MEETING APPROVAL
        ========================================================= */

        .meeting-approval-banner {
            margin: 16px 0 0;
            padding: 14px 16px;
            border: 1px solid #e3ddd5;
            border-left: 4px solid #f47a1f;
            background: #fffaf5;
        }

        .meeting-approval-banner.waiting-client {
            border-left-color: #8d969e;
            background: #f7f8f8;
        }

        .meeting-approval-banner strong {
            display: block;
            margin-bottom: 4px;
            color: #28323b;
            font-size: 13px;
        }

        .meeting-approval-banner span {
            display: block;
            color: #65717b;
            font-size: 13px;
            line-height: 1.55;
        }

        .meeting-approval-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .meeting-approval-action {
            min-height: 36px;
            padding: 0 12px;
            border: 1px solid #d8d0c8;
            border-radius: 2px;
            background: #ffffff;
            color: #39434c;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .meeting-approval-action.approve {
            border-color: #4d7e61;
            background: #4d7e61;
            color: #ffffff;
        }

        .meeting-approval-action.reject {
            border-color: #d6aaa5;
            background: #fff7f6;
            color: #984d45;
        }

        .meeting-approval-action.reschedule {
            border-color: #efb184;
            background: #fff8f1;
            color: #c45e17;
        }

        .meeting-response-badge {
            display: inline-flex;
            align-items: center;
            min-height: 24px;
            padding: 0 8px;
            border: 1px solid #e6ddd5;
            border-radius: 2px;
            background: #fff9f3;
            color: #c55f18;
            font-size: 12pxNone;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .meeting-response-badge.waiting-client {
            border-color: #dce0e3;
            background: #f6f7f8;
            color: #69737b;
        }

        .meeting-status-note {
            margin-top: 7px;
            color: #68737c;
            font-size: 13pxNone;
            line-height: 1.45;
        }

        @media (max-width: 760px) {
            .meeting-approval-actions {
                flex-direction: column;
            }

            .meeting-approval-action {
                width: 100%;
            }
        }
    

/* =========================================================
   REVISION - REVISED FILE UPLOAD
========================================================= */

.revision-attachment-section {
    margin-top: 22px;
    padding-top: 20px;
    border-top: 1px solid #e7e1da;
}

.revision-attachment-heading {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 10px;
}

.revision-attachment-heading label {
    display: block;
    margin: 0 0 3px;
    color: #111827;
    font-size: 14px;
    line-height: 1.35;
    font-weight: 750;
}

.revision-attachment-heading p {
    margin: 0;
    color: #7a8491;
    font-size: 13px;
    line-height: 1.45;
}

.revision-attachment-picker {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    min-height: 70px;
    padding: 12px 14px;
    gap: 13px;
    border: 1px solid #ddd6ce;
    border-left: 3px solid #f36c21;
    border-radius: 2px;
    background: #fbfaf8;
    cursor: pointer;
    box-sizing: border-box;
    transition:
        border-color .18s ease,
        background .18s ease,
        box-shadow .18s ease;
}

.revision-attachment-picker:hover {
    border-color: #f1b38e;
    border-left-color: #f36c21;
    background: #fffaf6;
    box-shadow: 0 3px 12px rgba(17, 24, 39, .05);
}

.revision-attachment-input {
    position: absolute;
    width: 1px;
    height: 1px;
    opacity: 0;
    overflow: hidden;
    pointer-events: none;
}

.revision-attachment-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 42px;
    width: 42px;
    height: 42px;
    border: 1px solid #f2dfd2;
    border-radius: 2px;
    background: #fff5ed;
}

.revision-attachment-icon svg {
    width: 20px;
    height: 20px;
    fill: none;
    stroke: #f36c21;
    stroke-width: 1.8;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.revision-attachment-details {
    display: flex;
    flex: 1 1 auto;
    min-width: 0;
    flex-direction: column;
    justify-content: center;
    gap: 3px;
}

.revision-attachment-details strong {
    display: block;
    overflow: hidden;
    color: #1f2937;
    font-size: 13px;
    line-height: 1.35;
    font-weight: 750;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.revision-attachment-details small {
    display: block;
    overflow: hidden;
    color: #8a929d;
    font-size: 13pxNone;
    line-height: 1.4;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.revision-attachment-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 auto;
    min-width: 96px;
    height: 36px;
    padding: 0 14px;
    border: 1px solid #f36c21;
    border-radius: 2px;
    background: #fff;
    color: #ef641b;
    font-size: 13pxNone;
    line-height: 1;
    font-weight: 800;
    letter-spacing: .02em;
    text-transform: uppercase;
}

.revision-attachment-picker:hover .revision-attachment-action {
    background: #f36c21;
    color: #fff;
}

.revision-attachment-error {
    margin-top: 7px;
    color: #c0392b;
    font-size: 13px;
    font-weight: 600;
}

@media (max-width: 720px) {
    .revision-attachment-picker {
        min-height: 68px;
        padding: 11px 12px;
    }

    .revision-attachment-icon {
        flex-basis: 38px;
        width: 38px;
        height: 38px;
    }

    .revision-attachment-action {
        min-width: auto;
        padding: 0 11px;
        font-size: 12pxNone;
    }

    .revision-attachment-details small {
        white-space: normal;
    }
}

@media (max-width: 520px) {
    .revision-attachment-picker {
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .revision-attachment-details {
        width: calc(100% - 54px);
        min-width: calc(100% - 54px);
    }

    .revision-attachment-action {
        margin-left: 51px;
    }
}


.revision-current-file {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
    padding: 12px 14px;
    border: 1px solid #d9e2dc;
    border-left: 3px solid #6b8f71;
    border-radius: 2px;
    background: #f8fbf8;
}

.revision-current-file-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 40px;
    width: 40px;
    height: 40px;
    border: 1px solid #dce8df;
    background: #fff;
}

.revision-current-file-icon svg {
    width: 19px;
    height: 19px;
    fill: none;
    stroke: #557a5c;
    stroke-width: 1.7;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.revision-current-file-info {
    display: flex;
    flex: 1;
    min-width: 0;
    flex-direction: column;
    gap: 2px;
}

.revision-current-file-info span {
    color: #6f7f73;
    font-size: 11pxNone;
    font-weight: 800;
    letter-spacing: .08em;
}

.revision-current-file-info strong {
    overflow: hidden;
    color: #1f2937;
    font-size: 13px;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.revision-current-file-info small {
    color: #87908a;
    font-size: 12pxNone;
}

.revision-current-file-download {
    flex: 0 0 auto;
    padding: 8px 12px;
    border: 1px solid #cdd9d0;
    background: #fff;
    color: #46684c;
    font-size: 12pxNone;
    font-weight: 800;
    text-decoration: none;
    text-transform: uppercase;
}

.revision-current-file-download:hover {
    border-color: #6b8f71;
    background: #f1f7f2;
}

@media (max-width: 560px) {
    .revision-current-file {
        flex-wrap: wrap;
    }

    .revision-current-file-download {
        margin-left: 52px;
    }
}


/* Meetings: comfortable, readable Project Info workspace */
#project-chat .messenger-info-drawer { width:min(680px, 96%) !important; max-width:calc(100% - 12px); }
#project-chat .messenger-drawer-body { overflow-y:auto; overflow-x:hidden; min-height:0; padding-bottom:24px; }
#project-chat .messenger-drawer-section-content { padding:0 20px 20px; }
#project-chat .messenger-drawer-section-content .meetings-panel { width:100% !important; overflow:visible; }
#project-chat .meetings-panel .section-header { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:18px 0 16px; }
#project-chat .meetings-panel .section-header > div { flex:1 1 260px; min-width:0; }
#project-chat .meetings-panel .section-header h2 { font-size:22px !important; line-height:1.25; margin:5px 0 7px; }
#project-chat .meetings-panel .section-header p { font-size:13px !important; line-height:1.55; max-width:400px; }
#project-chat .meetings-panel .meeting-create-button { flex-shrink:0; white-space:nowrap; padding:11px 15px; border-radius:10px; }
#project-chat .meetings-panel .meeting-summary-grid { display:grid !important; grid-template-columns:repeat(3,minmax(0,1fr)) !important; gap:10px !important; margin:12px 0 20px; }
#project-chat .meetings-panel .meeting-summary-card { min-width:0; padding:13px 12px !important; border-radius:12px; }
#project-chat .meetings-panel .meeting-summary-card strong { font-size:23px; display:block; margin:4px 0; }
#project-chat .meetings-panel .meeting-summary-card p { font-size:11px; line-height:1.35; }
#project-chat .meetings-panel .meeting-list { display:flex; flex-direction:column; gap:14px; }
#project-chat .meetings-panel .meeting-card { min-width:0; width:100%; padding:18px !important; border-radius:15px; box-shadow:0 2px 12px rgba(30,25,20,.045); }
#project-chat .meetings-panel .meeting-simple-row { display:flex; align-items:flex-start; flex-wrap:wrap; gap:13px; }
#project-chat .meetings-panel .meeting-date-block { flex:0 0 66px; min-width:66px; }
#project-chat .meetings-panel .meeting-simple-info { flex:1 1 210px; min-width:0; overflow-wrap:anywhere; }
#project-chat .meetings-panel .meeting-simple-info h3 { font-size:16px; line-height:1.4; }
#project-chat .meetings-panel .meeting-simple-actions { flex:1 1 100%; display:flex; flex-wrap:wrap; align-items:center; gap:8px; }
#project-chat .meetings-panel .meeting-details-grid { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:10px; }
#project-chat .meetings-panel .meeting-approval-actions { display:flex; flex-wrap:wrap; gap:8px; }
#project-chat .meetings-panel .meeting-approval-action { white-space:normal; min-height:38px; }
#project-chat .meetings-panel .meeting-expanded-details { overflow-wrap:anywhere; }
@media (max-width:700px) {
  #project-chat .messenger-info-drawer { width:100% !important; max-width:100%; border-radius:0; }
  #project-chat .messenger-drawer-section-content { padding:0 12px 16px; }
  #project-chat .meetings-panel .section-header { align-items:stretch; }
  #project-chat .meetings-panel .meeting-create-button { width:100%; }
  #project-chat .meetings-panel .meeting-summary-grid { grid-template-columns:repeat(2,minmax(0,1fr)) !important; }
  #project-chat .meetings-panel .meeting-details-grid { grid-template-columns:1fr; }
  #project-chat .meetings-panel .meeting-card { padding:12px !important; }
}
</style>

<style>

/* ARCHITRACK — legible, spacious phase roadmap redesign */
.project-phases-panel {
  font-family: Inter, "Segoe UI", Arial, sans-serif;
  color: #263244;
  -webkit-font-smoothing: antialiased;
}
.project-phases-panel, .project-phases-panel * { box-sizing: border-box; }
.project-phases-panel .standard-phase-card {
  background: #fff !important;
  border: 1px solid #e4e9ef !important;
  border-radius: 18px !important;
  box-shadow: 0 4px 18px rgba(20,34,55,.045) !important;
  margin-bottom: 18px !important;
  overflow: visible;
}
.project-phases-panel .standard-phase-card.standard-phase-in_progress {
  border-color: #edaa7b !important;
  box-shadow: 0 5px 24px rgba(210,101,36,.09) !important;
}
.project-phases-panel .standard-phase-card.standard-phase-completed {
  border-color: #c9e4d4 !important;
}
.project-phases-panel .standard-phase-card.standard-phase-locked {
  opacity: 1 !important;
  filter: none !important;
  background: #f6f7f9 !important;
  border-color: #e1e4e8 !important;
  box-shadow: none !important;
}
.project-phases-panel .standard-phase-card.standard-phase-locked .standard-phase-title h3,
.project-phases-panel .standard-phase-card.standard-phase-locked .standard-phase-title > p {
  color: #89919d !important;
}
.project-phases-panel .standard-phase-content { min-width: 0; }
.project-phases-panel .standard-phase-top.phase-dropdown-trigger {
  gap: 14px !important;
  padding: 20px 22px !important;
  border-radius: 17px !important;
}
.project-phases-panel .standard-phase-title { min-width: 0; }
.project-phases-panel .standard-phase-title h3 {
  font-family: Inter, "Segoe UI", Arial, sans-serif !important;
  font-size: clamp(19px, 1.65vw, 24px) !important;
  line-height: 1.32 !important;
  font-weight: 750 !important;
  letter-spacing: -.02em !important;
  margin: 7px 0 8px !important;
  overflow-wrap: anywhere;
  color: #202b3a !important;
}
.project-phases-panel .standard-phase-title > p {
  color: #5f6d7e !important;
  font-size: 14px !important;
  line-height: 1.65 !important;
  font-weight: 400 !important;
  margin: 0 !important;
}
.project-phases-panel .phase-small-label {
  font-size: 12px !important;
  font-weight: 750 !important;
  letter-spacing: .08em !important;
  color: #bc5a26 !important;
}
.project-phases-panel .phase-status {
  font-family: Inter, "Segoe UI", Arial, sans-serif !important;
  font-size: 12px !important;
  line-height: 1.35 !important;
  font-weight: 700 !important;
  letter-spacing: 0 !important;
  white-space: normal !important;
  text-align: center;
}
.project-phases-panel .phase-dropdown-details {
  border-top: 1px solid #edf0f4;
  padding-top: 18px;
}
.project-phases-panel .phase-progress-dashboard,
.project-phases-panel .phase-final-completion {
  background: #fafbfc !important;
  border: 1px solid #e5eaf0 !important;
  border-radius: 15px !important;
  padding: 20px !important;
  margin-bottom: 20px !important;
}
.project-phases-panel .phase-completion-blocked {
  background: #fff8f1 !important;
  border: 1px solid #f2d8bd !important;
  border-radius: 12px !important;
  padding: 17px 19px !important;
  display: flex;
  flex-direction: column;
  gap: 7px;
}
.project-phases-panel .phase-completion-blocked strong {
  color: #854314 !important;
  font-size: 15px !important;
  line-height: 1.5 !important;
}
.project-phases-panel .phase-completion-blocked span,
.project-phases-panel .phase-final-note small {
  font-size: 13px !important;
  line-height: 1.7 !important;
  color: #685d55 !important;
}
.project-phases-panel .phase-final-note label {
  display: block;
  font-size: 14px !important;
  font-weight: 700 !important;
  color: #263244 !important;
  margin-bottom: 9px;
}
.project-phases-panel .phase-final-note textarea {
  display: block;
  width: 100% !important;
  min-height: 120px;
  padding: 13px 15px !important;
  font: 14px/1.6 Inter, "Segoe UI", Arial, sans-serif !important;
  color: #273346;
  border: 1px solid #cdd6e0 !important;
  border-radius: 10px !important;
  background: #fff !important;
  resize: vertical;
}
.project-phases-panel .phase-final-note textarea:focus {
  outline: 3px solid rgba(225,112,45,.15) !important;
  border-color: #d97537 !important;
}
.project-phases-panel .phase-final-note small { display: block; margin-top: 9px; }
.project-phases-panel button,
.project-phases-panel input,
.project-phases-panel select,
.project-phases-panel textarea { font-family: Inter, "Segoe UI", Arial, sans-serif; }
@media (max-width: 760px) {
  .project-phases-panel .standard-phase-top.phase-dropdown-trigger { padding: 16px !important; gap: 10px !important; }
  .project-phases-panel .standard-phase-title h3 { font-size: 19px !important; }
  .project-phases-panel .standard-phase-title > p { font-size: 13px !important; }
  .project-phases-panel .phase-progress-dashboard,
  .project-phases-panel .phase-final-completion { padding: 15px !important; }
}

</style>
</head>


<body>


@php

    /*
    |--------------------------------------------------------------------------
    | ACTIVE WORKSPACE TAB
    |--------------------------------------------------------------------------
    */

    $activeTab =
        request('tab', 'overview') === 'meetings'
            ? 'messages'
            : request('tab', 'overview');


    /*
    |--------------------------------------------------------------------------
    | FILE VIEW
    |--------------------------------------------------------------------------
    */

    $showArchived =
        request('view') === 'archived';


    $activeFiles =
        $project->files
            ->filter(function ($file) {

                return !$file->is_archived;

            });


    $archivedFiles =
        $project->files
            ->filter(function ($file) {

                return $file->is_archived;

            });


    $displayFiles =
        $showArchived
            ? $archivedFiles
            : $activeFiles;


    /*
    |--------------------------------------------------------------------------
    | MESSAGES
    |--------------------------------------------------------------------------
    */

    $messages =
        isset($messages)
            ? $messages
            : collect();


    /*
    |--------------------------------------------------------------------------
    | PRESENCE
    |--------------------------------------------------------------------------
    */

    $workspacePendingRevisions = collect($revisions ?? [])->where('status', 'pending')->count();
    $workspacePendingMeetings = collect($meetings ?? [])->where('status', 'pending')->count();

    $presenceStatus =
        auth()->user()->presence_status
        ?? 'online';


    /*
    |--------------------------------------------------------------------------
    | TEMPORARY AI HISTORY
    |--------------------------------------------------------------------------
    |
    | These will later come from the actual AI History model.
    |
    */

    $clientAiSuggestions =
        isset($clientAiSuggestions)
            ? $clientAiSuggestions
            : collect();


    $clientAiImages =
        isset($clientAiImages)
            ? $clientAiImages
            : collect();

@endphp



<div class="project-workspace">


    <!-- =====================================================
        PROJECT HEADER
    ====================================================== -->

    <header class="workspace-header">


        <div class="header-top">


            <a
                href="{{ route('architect.projects.index') }}"
                class="back-link"
            >

                <span class="back-arrow">
                    ←
                </span>

                Back to Projects

            </a>


            <form method="POST" action="{{ route('logout') }}" class="workspace-logout-form">
                @csrf
                <button type="submit" class="workspace-logout-button" title="Log out">
                    <span>Logout</span>
                </button>
            </form>

            <div class="header-brand">

                <img
                    src="{{ asset('images/arlogo.jpg') }}"
                    alt="ArchiTrack"
                >

            </div>

        </div>



        <div class="project-heading">


            <!-- LEFT -->
            <div class="heading-copy">


                <span class="workspace-label">
                    PROJECT WORKSPACE
                </span>


                <div class="heading-status">


                    <span
                        class="
                            status-badge
                            status-{{ $project->status }}
                        "
                    >

                        {{ ucwords(
                            str_replace(
                                '_',
                                ' ',
                                $project->status
                            )
                        ) }}

                    </span>


                    <span class="project-number">

                        PROJECT #

                        {{ str_pad(
                            $project->id,
                            4,
                            '0',
                            STR_PAD_LEFT
                        ) }}

                    </span>

                </div>


                <h1>
                    {{ $project->project_name }}
                </h1>


                <p class="project-description">

                    {{ $project->description
                        ?: 'Manage project information, files, communication, revisions, meetings, and project activity from one organized workspace.'
                    }}

                </p>



                <div class="project-summary">


                    <div class="summary-item">

                        <span>
                            CLIENT
                        </span>

                        <strong>
                            {{ $project->client_name }}
                        </strong>

                    </div>


                    <div class="summary-item">

                        <span>
                            PROGRESS
                        </span>

                        <strong class="summary-progress">
                            {{ $project->progress ?? 0 }}%
                        </strong>

                    </div>


                    <div class="summary-item">

                        <span>
                            TARGET DATE
                        </span>

                        <strong>

                            {{ $project->target_date
                                ? \Carbon\Carbon::parse(
                                    $project->target_date
                                )->format('M d, Y')
                                : 'Not set'
                            }}

                        </strong>

                    </div>

                </div>

            </div>



            <!-- RIGHT IMAGE -->
            <div class="header-project-visual">


                @if(!empty($project->project_image))


                    <img
                        src="{{ asset(
                            'uploads/projects/'
                            . $project->project_image
                        ) }}"
                        alt="{{ $project->project_name }}"
                        class="header-project-image"
                    >


                    <div class="project-image-overlay">

                        <span>
                            ARCHITECTURAL PROJECT
                        </span>

                        <strong>
                            {{ $project->project_name }}
                        </strong>

                    </div>


                @else


                    <div class="header-default-image">


                        <div class="image-grid"></div>

                        <div class="orange-circle"></div>


                        <img
                            src="{{ asset('images/lineart2.png') }}"
                            alt=""
                        >


                        <div class="image-caption">

                            <span>
                                ARCHITECTURAL PROJECT
                            </span>

                            <strong>
                                {{ $project->project_name }}
                            </strong>

                        </div>

                    </div>


                @endif

            </div>

        </div>



        <div class="header-progress">


            <div class="progress-info">

                <span>
                    PROJECT PROGRESS
                </span>

                <strong>
                    {{ $project->progress ?? 0 }}%
                </strong>

            </div>


            <div class="progress-track">

                <div
                    class="progress-fill"
                    style="
                        width:
                        {{ min(
                            max(
                                $project->progress ?? 0,
                                0
                            ),
                            100
                        ) }}%;
                    "
                ></div>

            </div>

        </div>

    </header>



    <!-- =====================================================
        WORKSPACE TABS
    ====================================================== -->

    <nav class="workspace-tabs">


        <a
            href="{{ route(
                'architect.projects.show',
                ['id' => $project->id]
            ) }}?tab=overview"
            class="
                workspace-tab
                {{ $activeTab === 'overview' ? 'active' : '' }}
            "
        >

            <span class="tab-icon">

                <svg viewBox="0 0 24 24">

                    <rect
                        x="4"
                        y="4"
                        width="16"
                        height="16"
                        rx="2"
                    />

                    <path d="M8 9h8"/>
                    <path d="M8 13h8"/>
                    <path d="M8 17h5"/>

                </svg>

            </span>

            Overview

        </a>



        <a
            href="{{ route(
                'architect.projects.show',
                ['id' => $project->id]
            ) }}?tab=financial"
            class="
                workspace-tab
                {{ $activeTab === 'financial' ? 'active' : '' }}
            "
        >

            <span class="tab-icon">

                <svg viewBox="0 0 24 24">

                    <path d="M4 20V10"/>
                    <path d="M10 20V4"/>
                    <path d="M16 20v-7"/>
                    <path d="M22 20V7"/>

                </svg>

            </span>

            Financials

        </a>



        <a
            href="{{ route(
                'architect.projects.show',
                ['id' => $project->id]
            ) }}?tab=phases"
            class="
                workspace-tab
                {{ $activeTab === 'phases' ? 'active' : '' }}
            "
        >
            <span class="tab-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="6" cy="6" r="2"/>
                    <circle cx="18" cy="12" r="2"/>
                    <circle cx="6" cy="18" r="2"/>
                    <path d="M8 6h4a4 4 0 0 1 4 4"/>
                    <path d="M16 14a4 4 0 0 1-4 4H8"/>
                </svg>
            </span>
            Phases
        </a>

        <a
            href="{{ route(
                'architect.projects.show',
                ['id' => $project->id]
            ) }}?tab=files"
            class="
                workspace-tab
                {{ $activeTab === 'files' ? 'active' : '' }}
            "
        >

            <span class="tab-icon">

                <svg viewBox="0 0 24 24">

                    <path d="M3 7h6l2 2h10v10H3z"/>
                    <path d="M3 7V5h7l2 2"/>

                </svg>

            </span>

            Files

        </a>



        <a
            href="{{ route(
                'architect.projects.show',
                ['id' => $project->id]
            ) }}?tab=messages#project-chat"
            class="
                workspace-tab
                {{ $activeTab === 'messages' ? 'active' : '' }}
            "
        >

            <span class="tab-icon">

                <svg viewBox="0 0 24 24">

                    <path d="M4 5h16v12H8l-4 4z"/>
                    <path d="M8 9h8"/>
                    <path d="M8 13h5"/>

                </svg>

            </span>

            Messages
            @if($workspacePendingMeetings > 0)
                <span class="workspace-request-count" title="Pending meeting requests">{{ $workspacePendingMeetings }}</span>
            @endif

        </a>



        <a
            href="{{ route(
                'architect.projects.show',
                ['id' => $project->id]
            ) }}?tab=revisions"
            class="
                workspace-tab
                {{ $activeTab === 'revisions' ? 'active' : '' }}
            "
        >

            <span class="tab-icon">

                <svg viewBox="0 0 24 24">

                    <path d="M20 11a8 8 0 1 0-2 5.3"/>
                    <path d="M20 4v7h-7"/>

                </svg>

            </span>

            Revisions
            @if($workspacePendingRevisions > 0)
                <span class="workspace-request-count">{{ $workspacePendingRevisions }}</span>
            @endif

        </a>



        <a
            href="{{ route(
                'architect.projects.show',
                ['id' => $project->id]
            ) }}?tab=ai"
            class="
                workspace-tab
                {{ $activeTab === 'ai' ? 'active' : '' }}
            "
        >

            <span class="tab-icon">

                <svg viewBox="0 0 24 24">

                    <path
                        d="
                            M12 3
                            l1.5 4.5
                            L18 9
                            l-4.5 1.5
                            L12 15
                            l-1.5-4.5
                            L6 9
                            l4.5-1.5
                            z
                        "
                    />

                </svg>

            </span>

            AI History

        </a>

    </nav>



    <!-- =====================================================
        MAIN CONTENT
    ====================================================== -->

    <main class="workspace-content">



        <!-- =================================================
            OVERVIEW
        ================================================== -->

        @if($activeTab === 'overview')

            <section class="tab-panel">


                <div class="section-header">

                    <div>

                        <span class="section-label">
                            PROJECT OVERVIEW
                        </span>

                        <h2>
                            Project Information
                        </h2>

                        <p>
                            Review the client's account,
                            project schedule, and current progress.
                        </p>

                    </div>

                </div>



                <div class="overview-grid">


                    <!-- CLIENT -->
                    <article class="overview-card">


                        <div class="card-accent"></div>


                        <span class="overview-label">
                            CLIENT ACCOUNT
                        </span>


                        <div class="client-profile">


                            <div class="client-avatar">

                                {{ strtoupper(
                                    substr(
                                        $project->client_name,
                                        0,
                                        1
                                    )
                                ) }}

                            </div>


                            <div class="client-details">

                                <h3>
                                    {{ $project->client_name }}
                                </h3>

                                <p>
                                    {{ $project->client_email }}
                                </p>

                            </div>

                        </div>


                        <div class="connected-status">

                            <span class="connected-dot"></span>

                            Client account connected

                        </div>

                    </article>



                    <!-- SCHEDULE -->
                    <article class="overview-card">


                        <div class="card-accent"></div>


                        <span class="overview-label">
                            PROJECT SCHEDULE
                        </span>


                        <div class="detail-row">

                            <span>
                                Start Date
                            </span>

                            <strong>

                                {{ $project->start_date
                                    ? \Carbon\Carbon::parse(
                                        $project->start_date
                                    )->format('M d, Y')
                                    : 'Not set'
                                }}

                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Target Date
                            </span>

                            <strong>

                                {{ $project->target_date
                                    ? \Carbon\Carbon::parse(
                                        $project->target_date
                                    )->format('M d, Y')
                                    : 'Not set'
                                }}

                            </strong>

                        </div>


                        <div class="detail-row">

                            <span>
                                Status
                            </span>

                            <strong class="orange-text">

                                {{ ucwords(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $project->status
                                    )
                                ) }}

                            </strong>

                        </div>

                    </article>



                    <!-- PROGRESS -->
                    <article class="overview-card">


                        <div class="card-accent"></div>


                        <span class="overview-label">
                            PROJECT PROGRESS
                        </span>


                        <div class="large-progress">

                            <strong>
                                {{ $project->progress ?? 0 }}
                            </strong>

                            <span>
                                %
                            </span>

                        </div>


                        <div class="overview-progress-track">

                            <div
                                class="overview-progress-fill"
                                style="
                                    width:
                                    {{ min(
                                        max(
                                            $project->progress ?? 0,
                                            0
                                        ),
                                        100
                                    ) }}%;
                                "
                            ></div>

                        </div>


                        <p class="progress-description">
                            Current overall project completion.
                        </p>

                    </article>

                </div>





                <!-- =================================================
                    PROJECT ANALYTICS
                ================================================== -->

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | PROJECT ANALYTICS
                    |--------------------------------------------------------------------------
                    |
                    | These values are calculated only from the current project's
                    | already-loaded relationships.
                    |
                    */

                    $analyticsPhases =
                        $project->phases
                            ->sortBy('phase_order')
                            ->values();


                    $analyticsCompletedPhases =
                        $analyticsPhases
                            ->where(
                                'status',
                                'completed'
                            )
                            ->count();


                    $analyticsCurrentPhase =
                        $analyticsPhases
                            ->firstWhere(
                                'status',
                                'in_progress'
                            );


                    $analyticsNextPhase =
                        null;


                    if (!$analyticsCurrentPhase) {

                        $analyticsNextPhase =
                            $analyticsPhases
                                ->where(
                                    'status',
                                    'pending'
                                )
                                ->sortBy(
                                    'phase_order'
                                )
                                ->first();
                    }


                    $analyticsMilestones =
                        $analyticsPhases
                            ->flatMap(
                                function ($phaseItem) {

                                    return
                                        $phaseItem->milestones
                                        ?? collect();
                                }
                            );


                    $analyticsCompletedMilestones =
                        $analyticsMilestones
                            ->where(
                                'status',
                                'completed'
                            )
                            ->count();


                    $analyticsActiveFiles =
                        $project->files
                            ->where(
                                'is_archived',
                                false
                            )
                            ->count();


                    $analyticsArchivedFiles =
                        $project->files
                            ->where(
                                'is_archived',
                                true
                            )
                            ->count();


                    $analyticsOpenRevisions =
                        $revisions
                            ->whereIn(
                                'status',
                                [
                                    'pending',
                                    'in_progress'
                                ]
                            )
                            ->count();


                    $analyticsUpcomingMeetings =
                        $meetings
                            ->filter(
                                function ($meeting) {

                                    if (
                                        $meeting->status
                                        !==
                                        'scheduled'
                                    ) {
                                        return false;
                                    }


                                    $meetingDate =
                                        $meeting->meeting_date
                                            ? $meeting->meeting_date->format('Y-m-d')
                                            : null;


                                    if (!$meetingDate) {
                                        return false;
                                    }


                                    return
                                        $meetingDate
                                        >=
                                        now('Asia/Manila')
                                            ->format('Y-m-d');
                                }
                            )
                            ->count();


                    $analyticsTotalExpenses =
                        isset($totalExpenses)
                            ? (float) $totalExpenses
                            : (float) $project->expenses
                                ->sum('amount');


                    $analyticsBudget =
                        $project->budget !== null
                            ? (float) $project->budget
                            : null;


                    $analyticsRemainingBudget =
                        $analyticsBudget !== null
                            ? $analyticsBudget
                                - $analyticsTotalExpenses
                            : null;


                    $analyticsBudgetUsage =
                        $analyticsBudget !== null
                        &&
                        $analyticsBudget > 0
                            ? min(
                                100,
                                round(
                                    (
                                        $analyticsTotalExpenses
                                        /
                                        $analyticsBudget
                                    )
                                    * 100
                                )
                            )
                            : 0;


                    $analyticsProjectRole =
                        $isLeadArchitect
                            ? 'Lead Architect'
                            : 'Project Collaborator';


                    $analyticsPhaseLabel =
                        ($project->progress ?? 0) >= 100
                            ? 'Project Complete'
                            : (
                                $analyticsCurrentPhase
                                    ? $analyticsCurrentPhase->phase_name
                                    : (
                                        $analyticsNextPhase
                                            ? 'Ready for '
                                                . $analyticsNextPhase->phase_name
                                            : 'Not Started'
                                    )
                            );

                @endphp


                <section class="project-analytics-card">


                    <div class="project-analytics-header">


                        <div>

                            <span class="section-label">
                                PROJECT ANALYTICS
                            </span>

                            <h3>
                                Project Performance Overview
                            </h3>

                            <p>
                                Live project metrics based on phases,
                                milestones, files, revisions, meetings,
                                communication, and financial records.
                            </p>

                        </div>


                        <div class="project-analytics-role">

                            <span>
                                YOUR ROLE
                            </span>

                            <strong>
                                {{ $analyticsProjectRole }}
                            </strong>

                        </div>

                    </div>



                    <div class="project-analytics-primary-grid">


                        <article class="project-analytics-primary">


                            <span>
                                OVERALL PROGRESS
                            </span>


                            <div class="project-analytics-big-number">

                                <strong>
                                    {{ $project->progress ?? 0 }}
                                </strong>

                                <small>
                                    %
                                </small>

                            </div>


                            <div class="project-analytics-progress-track">

                                <span
                                    style="
                                        width:
                                        {{ min(
                                            max(
                                                $project->progress ?? 0,
                                                0
                                            ),
                                            100
                                        ) }}%;
                                    "
                                ></span>

                            </div>


                            <p>
                                Weighted completion across the ten
                                standard project phases.
                            </p>

                        </article>



                        <article class="project-analytics-primary">


                            <span>
                                CURRENT STAGE
                            </span>

                            <strong class="project-analytics-stage">
                                {{ $analyticsPhaseLabel }}
                            </strong>

                            <div class="project-analytics-stage-meta">

                                <span>
                                    {{ $analyticsCompletedPhases }}
                                    /
                                    {{ $analyticsPhases->count() }}
                                    phases complete
                                </span>

                                <span>
                                    {{ $analyticsCompletedMilestones }}
                                    /
                                    {{ $analyticsMilestones->count() }}
                                    milestones complete
                                </span>

                            </div>

                        </article>



                        <article class="project-analytics-primary">


                            <span>
                                BUDGET POSITION
                            </span>


                            @if($analyticsBudget !== null)

                                <strong class="project-analytics-money">
                                    ₱{{ number_format(
                                        $analyticsRemainingBudget,
                                        2
                                    ) }}
                                </strong>

                                <small>
                                    Remaining from
                                    ₱{{ number_format(
                                        $analyticsBudget,
                                        2
                                    ) }}
                                </small>


                                <div class="project-analytics-progress-track budget">

                                    <span
                                        class="
                                            {{ $analyticsTotalExpenses
                                                > $analyticsBudget
                                                    ? 'over-budget'
                                                    : ''
                                            }}
                                        "
                                        style="
                                            width:
                                            {{ $analyticsBudgetUsage }}%;
                                        "
                                    ></span>

                                </div>


                                <p>
                                    ₱{{ number_format(
                                        $analyticsTotalExpenses,
                                        2
                                    ) }}
                                    recorded expenses
                                </p>

                            @else

                                <strong class="project-analytics-stage">
                                    No Budget Set
                                </strong>

                                <p>
                                    Budget analytics will update once the
                                    lead architect records a project budget.
                                </p>

                            @endif

                        </article>

                    </div>



                    <div class="project-analytics-metric-grid">


                        <div class="project-analytics-metric">

                            <span>
                                ACTIVE FILES
                            </span>

                            <strong>
                                {{ $analyticsActiveFiles }}
                            </strong>

                            <small>
                                {{ $analyticsArchivedFiles }}
                                archived
                            </small>

                        </div>


                        <div class="project-analytics-metric">

                            <span>
                                MESSAGES
                            </span>

                            <strong>
                                {{ $messages->count() }}
                            </strong>

                            <small>
                                Project conversation
                            </small>

                        </div>


                        <div class="project-analytics-metric">

                            <span>
                                REVISIONS
                            </span>

                            <strong>
                                {{ $revisions->count() }}
                            </strong>

                            <small>
                                {{ $analyticsOpenRevisions }}
                                open
                            </small>

                        </div>


                        <div class="project-analytics-metric">

                            <span>
                                MEETINGS
                            </span>

                            <strong>
                                {{ $meetings->count() }}
                            </strong>

                            <small>
                                {{ $analyticsUpcomingMeetings }}
                                upcoming
                            </small>

                        </div>


                        <div class="project-analytics-metric">

                            <span>
                                PHASES
                            </span>

                            <strong>
                                {{ $analyticsCompletedPhases }}
                                /
                                {{ $analyticsPhases->count() }}
                            </strong>

                            <small>
                                Completed
                            </small>

                        </div>


                        <div class="project-analytics-metric">

                            <span>
                                MILESTONES
                            </span>

                            <strong>
                                {{ $analyticsCompletedMilestones }}
                                /
                                {{ $analyticsMilestones->count() }}
                            </strong>

                            <small>
                                Completed
                            </small>

                        </div>

                    </div>



                    <div class="project-analytics-phase-list">


                        <div class="project-analytics-subhead">

                            <div>

                                <span>
                                    TEN-PHASE WORKFLOW
                                </span>

                                <strong>
                                    Phase Completion
                                </strong>

                            </div>

                            <small>
                                Each completed phase contributes its
                                assigned percentage to project progress.
                            </small>

                        </div>


                        @php

                            $analyticsPhaseWeights = [
                                1 => 5,
                                2 => 5,
                                3 => 10,
                                4 => 15,
                                5 => 10,
                                6 => 10,
                                7 => 10,
                                8 => 20,
                                9 => 10,
                                10 => 5,
                            ];

                        @endphp


                        <div class="project-analytics-phase-grid">


                            @foreach($analyticsPhases as $analyticsPhase)

                                @php

                                    $analyticsPhaseWeight =
                                        $analyticsPhaseWeights[
                                            $analyticsPhase->phase_order
                                        ]
                                        ?? 0;


                                    $analyticsPhaseCompleted =
                                        $analyticsPhase->status
                                        ===
                                        'completed';


                                    $analyticsPhaseCurrent =
                                        $analyticsPhase->status
                                        ===
                                        'in_progress';

                                @endphp


                                <div
                                    class="
                                        project-analytics-phase
                                        {{ $analyticsPhaseCompleted
                                            ? 'completed'
                                            : (
                                                $analyticsPhaseCurrent
                                                    ? 'current'
                                                    : ''
                                            )
                                        }}
                                    "
                                >


                                    <div class="project-analytics-phase-top">

                                        <span>
                                            {{ str_pad(
                                                $analyticsPhase->phase_order,
                                                2,
                                                '0',
                                                STR_PAD_LEFT
                                            ) }}
                                        </span>

                                        <strong>
                                            {{ $analyticsPhaseWeight }}%
                                        </strong>

                                    </div>


                                    <p>
                                        {{ $analyticsPhase->phase_name }}
                                    </p>


                                    <small>

                                        @if($analyticsPhaseCompleted)

                                            Completed

                                        @elseif($analyticsPhaseCurrent)

                                            In Progress

                                        @else

                                            Pending

                                        @endif

                                    </small>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </section>



                <!-- =================================================
                    PROJECT TEAM
                ================================================== -->

                @if(session('success'))

                    <div class="project-team-success">

                        <strong>
                            Project updated
                        </strong>

                        <span>
                            {{ session('success') }}
                        </span>

                    </div>

                @endif


                @if(
                    $errors->has('architect_id')
                    ||
                    $errors->has('role')
                    ||
                    $errors->has('discipline')
                )

                    <div class="project-team-error">

                        <strong>
                            Please check the project team details.
                        </strong>

                        <ul>

                            @foreach(
                                [
                                    'architect_id',
                                    'role',
                                    'discipline'
                                ]
                                as $teamField
                            )

                                @foreach(
                                    $errors->get($teamField)
                                    as $teamError
                                )

                                    <li>
                                        {{ $teamError }}
                                    </li>

                                @endforeach

                            @endforeach

                        </ul>

                    </div>

                @endif


                <section class="project-team-card">

                    <div class="project-team-head">

                        <div>

                            <span class="section-label">
                                PROJECT TEAM
                            </span>

                            <h3>
                                Architects Assigned
                            </h3>

                            <p>
                                View the lead architect and any additional
                                architects collaborating on this project.
                            </p>

                        </div>


                        @if($isLeadArchitect)

                            <button
                                type="button"
                                class="project-team-add"
                                onclick="openProjectTeamModal()"
                            >
                                + Add Team Member
                            </button>

                        @endif

                    </div>


                    <div class="project-team-list">

                        <!-- LEAD ARCHITECT -->
                        <div class="project-team-member">

                            <div class="project-team-avatar lead">

                                {{ strtoupper(
                                    substr(
                                        $project->architect?->name
                                        ?? 'A',
                                        0,
                                        1
                                    )
                                ) }}

                            </div>


                            <div class="project-team-copy">

                                <strong>
                                    {{ $project->architect?->name ?? 'Lead Architect' }}
                                </strong>

                                <span>
                                    Lead Architect
                                </span>

                                <small>
                                    Project Owner
                                </small>

                            </div>


                            <span class="project-team-badge">
                                Lead
                            </span>

                        </div>


                        <!-- COLLABORATORS -->
                        @foreach($projectTeam as $teamMember)

                            <div class="project-team-member">

                                <div class="project-team-avatar">

                                    {{ strtoupper(
                                        substr(
                                            $teamMember->architect?->name
                                            ?? 'A',
                                            0,
                                            1
                                        )
                                    ) }}

                                </div>


                                <div class="project-team-copy">

                                    <strong>
                                        {{ $teamMember->architect?->name ?? 'Architect' }}
                                    </strong>

                                    <span>
                                        {{ $teamMember->role }}
                                    </span>

                                    <small>
                                        {{ $teamMember->discipline ?: 'General Project Collaboration' }}
                                    </small>


                                    @if($isLeadArchitect)

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'architect.projects.team.destroy',
                                                [
                                                    'id' => $project->id,
                                                    'teamMember' => $teamMember->id
                                                ]
                                            ) }}"
                                            onsubmit="return confirm('Remove this architect from the project team?');"
                                        >

                                            @csrf
                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="project-team-remove"
                                            >
                                                Remove from Project
                                            </button>

                                        </form>

                                    @endif

                                </div>


                                <span class="project-team-badge">
                                    Team
                                </span>

                            </div>

                        @endforeach

                    </div>


                    @if(
                        !$isLeadArchitect
                        &&
                        $projectTeam
                            ->where(
                                'architect_id',
                                auth()->id()
                            )
                            ->isNotEmpty()
                    )

                        <div class="project-team-access-note">

                            You are viewing this project as an assigned collaborator.

                        </div>

                    @endif

                </section>


                <!-- =================================================
                    ADD PROJECT TEAM MEMBER MODAL
                ================================================== -->

                @if($isLeadArchitect)

                    <div
                        class="project-team-modal"
                        id="projectTeamModal"
                    >

                        <div
                            class="project-team-backdrop"
                            onclick="closeProjectTeamModal()"
                        ></div>


                        <div class="project-team-modal-card">

                            <div class="project-team-modal-header">

                                <div>

                                    <span class="section-label">
                                        PROJECT COLLABORATION
                                    </span>

                                    <h3>
                                        Add Team Member
                                    </h3>

                                    <p>
                                        Assign another active architect to
                                        {{ $project->project_name }}.
                                    </p>

                                </div>


                                <button
                                    type="button"
                                    class="project-team-close"
                                    onclick="closeProjectTeamModal()"
                                >
                                    ×
                                </button>

                            </div>


                            <form
                                method="POST"
                                action="{{ route(
                                    'architect.projects.team.store',
                                    ['id' => $project->id]
                                ) }}"
                                class="project-team-form"
                            >

                                @csrf


                                <div class="project-team-field">

                                    <label for="team_architect_id">
                                        Architect
                                        <span>*</span>
                                    </label>


                                    <select
                                        name="architect_id"
                                        id="team_architect_id"
                                        required
                                        {{ $availableArchitects->isEmpty() ? 'disabled' : '' }}
                                    >

                                        <option value="">
                                            Select an architect
                                        </option>


                                        @foreach($availableArchitects as $availableArchitect)

                                            <option
                                                value="{{ $availableArchitect->id }}"
                                                {{ (string) old('architect_id') === (string) $availableArchitect->id
                                                    ? 'selected'
                                                    : ''
                                                }}
                                            >
                                                {{ $availableArchitect->name }}
                                                ·
                                                {{ $availableArchitect->email }}
                                            </option>

                                        @endforeach

                                    </select>


                                    @if($availableArchitects->isEmpty())

                                        <small class="project-team-field-note">
                                            No other active architect account is available to add.
                                        </small>

                                    @endif

                                </div>


                                <div class="project-team-field">

                                    <label for="team_role">
                                        Project Role
                                        <span>*</span>
                                    </label>


                                    <select
                                        name="role"
                                        id="team_role"
                                        required
                                    >

                                        <option
                                            value="Co-Architect"
                                            {{ old('role', 'Co-Architect') === 'Co-Architect' ? 'selected' : '' }}
                                        >
                                            Co-Architect
                                        </option>

                                        <option
                                            value="Project Architect"
                                            {{ old('role') === 'Project Architect' ? 'selected' : '' }}
                                        >
                                            Project Architect
                                        </option>

                                        <option
                                            value="Design Architect"
                                            {{ old('role') === 'Design Architect' ? 'selected' : '' }}
                                        >
                                            Design Architect
                                        </option>

                                        <option
                                            value="Junior Architect"
                                            {{ old('role') === 'Junior Architect' ? 'selected' : '' }}
                                        >
                                            Junior Architect
                                        </option>

                                        <option
                                            value="Consultant"
                                            {{ old('role') === 'Consultant' ? 'selected' : '' }}
                                        >
                                            Consultant
                                        </option>

                                        <option
                                            value="Other"
                                            {{ old('role') === 'Other' ? 'selected' : '' }}
                                        >
                                            Other
                                        </option>

                                    </select>

                                </div>


                                <div class="project-team-field">

                                    <label for="team_discipline">
                                        Discipline / Specialization
                                    </label>


                                    <input
                                        type="text"
                                        name="discipline"
                                        id="team_discipline"
                                        value="{{ old('discipline') }}"
                                        maxlength="150"
                                        placeholder="Example: Architectural Design"
                                    >

                                </div>


                                <div class="project-team-permission-note">

                                    <strong>
                                        Collaborator Access
                                    </strong>

                                    <span>
                                        Added architects can open this project workspace.
                                        The lead architect remains the project owner and
                                        controls team membership.
                                    </span>

                                </div>


                                <div class="project-team-actions">

                                    <button
                                        type="button"
                                        class="project-team-cancel"
                                        onclick="closeProjectTeamModal()"
                                    >
                                        Cancel
                                    </button>


                                    <button
                                        type="submit"
                                        class="project-team-save"
                                        {{ $availableArchitects->isEmpty() ? 'disabled' : '' }}
                                    >
                                        Add Team Member
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                @endif


                <section class="description-card">


                    <div>

                        <span class="section-label">
                            PROJECT DESCRIPTION
                        </span>

                        <h3>
                            Project Scope
                        </h3>

                    </div>


                    <p>

                        {{ $project->description
                            ?: 'No detailed project description has been added yet.'
                        }}

                    </p>

                </section>



                <section class="activity-card">


                    <span class="section-label">
                        PROJECT ACTIVITY
                    </span>

                    <h2>
                        Recent Activity
                    </h2>


                    <div class="empty-small">


                        <div class="empty-icon">

                            <svg viewBox="0 0 24 24">

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                />

                                <path d="M12 7v5l4 2"/>

                            </svg>

                        </div>


                        <div>

                            <strong>
                                No project activity yet
                            </strong>

                            <p>
                                File uploads, revisions, meetings,
                                messages and project updates
                                will appear here.
                            </p>

                        </div>

                    </div>

                </section>

            </section>

        @endif



<!-- =================================================
    PROJECT FINANCIALS
================================================== -->

@if($activeTab === 'financial')

    @php

        $financialExpenses =
            isset($expenses)
                ? $expenses
                : $project->expenses;

        $financialTotalExpenses =
            isset($totalExpenses)
                ? (float) $totalExpenses
                : (float) $financialExpenses->sum('amount');

        $financialRemainingBudget =
            isset($remainingBudget)
                ? $remainingBudget
                : (
                    $project->budget !== null
                        ? (float) $project->budget - $financialTotalExpenses
                        : null
                );

        $financialBudget =
            $project->budget !== null
                ? (float) $project->budget
                : null;

        $financialUsagePercent =
            $financialBudget !== null
            && $financialBudget > 0
                ? min(
                    100,
                    round(
                        ($financialTotalExpenses / $financialBudget)
                        * 100
                    )
                )
                : 0;

    @endphp


    <section class="tab-panel project-financial-panel">


        <div class="section-header">

            <div>

                <span class="section-label">
                    PROJECT FINANCIALS
                </span>

                <h2>
                    Budget & Expenses
                </h2>

                <p>
                    Monitor the project budget, recorded expenses,
                    and remaining balance.
                </p>

            </div>


            @if(!$isLeadArchitect)

                <span class="financial-view-only-badge">
                    View Only
                </span>

            @endif

        </div>



        @if(session('success'))

            <div class="financial-success-message">

                <strong>
                    Financial record updated
                </strong>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif



        @if(
            $errors->has('budget')
            ||
            $errors->has('category')
            ||
            $errors->has('description')
            ||
            $errors->has('amount')
            ||
            $errors->has('expense_date')
            ||
            $errors->has('notes')
        )

            <div class="financial-error-message">

                <strong>
                    Please check the financial details.
                </strong>

                <ul>

                    @foreach(
                        [
                            'budget',
                            'category',
                            'description',
                            'amount',
                            'expense_date',
                            'notes'
                        ]
                        as $financialField
                    )

                        @foreach(
                            $errors->get($financialField)
                            as $financialError
                        )

                            <li>
                                {{ $financialError }}
                            </li>

                        @endforeach

                    @endforeach

                </ul>

            </div>

        @endif



        @if($isLeadArchitect)

            <section class="financial-management-card">

                <div class="financial-management-head">

                    <div>

                        <span class="section-label">
                            LEAD ARCHITECT CONTROL
                        </span>

                        <h3>
                            Project Budget
                        </h3>

                        <p>
                            Set the approved project budget once. Once saved, it cannot be edited.
                        </p>

                    </div>

                </div>


                @if($project->budget === null)
                <form
                    method="POST"
                    action="{{ route(
                        'architect.projects.budget.update',
                        ['id' => $project->id]
                    ) }}"
                    class="financial-budget-form"
                >

                    @csrf
                    @method('PUT')


                    <div class="financial-field">

                        <label for="project_budget">
                            Budget Amount
                        </label>

                        <div class="financial-money-input">

                            <span>
                                ₱
                            </span>

                            <input
                                type="number"
                                name="budget"
                                id="project_budget"
                                value="{{ old(
                                    'budget',
                                    $project->budget
                                ) }}"
                                min="0"
                                max="999999999.99"
                                step="0.01"
                                placeholder="0.00"
                            >

                        </div>

                        <small>
                            Leave this blank if the project has no recorded budget yet.
                        </small>

                    </div>


                    <button
                        type="submit"
                        class="financial-primary-button"
                    >
                        Save Budget
                    </button>

                </form>
                @else
                    <div class="financial-field">
                        <label>Approved Budget (Locked)</label>
                        <div class="financial-money-input">
                            <span>₱</span>
                            <input type="text"
                                   value="{{ number_format((float) $project->budget, 2) }}"
                                   readonly
                                   aria-label="Approved project budget, locked">
                        </div>
                        <small>
                            This budget has already been saved and can no longer be edited.
                        </small>
                    </div>
                @endif

            </section>



            <section class="financial-management-card">

                <div class="financial-management-head">

                    <div>

                        <span class="section-label">
                            NEW EXPENSE
                        </span>

                        <h3>
                            Record Project Expense
                        </h3>

                        <p>
                            Add an expense that belongs to this project.
                        </p>

                    </div>

                </div>


                <details class="financial-expense-collapse">
                    <summary class="financial-expense-collapse-toggle">
                        <span class="financial-expense-collapse-title">＋ &nbsp; Record a New Expense</span>
                        <span class="financial-expense-collapse-action">
                            <span class="financial-expense-label-closed">Click to expand</span>
                            <span class="financial-expense-label-open">Click to minimize</span>
                        </span>
                    </summary>
                <form
                    method="POST"
                    action="{{ route(
                        'architect.projects.expenses.store',
                        ['id' => $project->id]
                    ) }}?tab=financial"
                    class="financial-expense-form"
                    @if($financialRemainingBudget !== null)
                        onsubmit="return validateExpenseBudget(this, {{ json_encode(max(0, (float) $financialRemainingBudget)) }})"
                    @endif
                >

                    @csrf


                    <div class="financial-form-grid">


                        <div class="financial-field">

                            <label for="expense_category">
                                Category
                                <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="category"
                                id="expense_category"
                                value="{{ old('category') }}"
                                maxlength="100"
                                list="expenseCategories"
                                placeholder="Example: Materials"
                                required
                            >

                        </div>



                        <div class="financial-field">

                            <label for="expense_date">
                                Expense Date
                                <span>*</span>
                            </label>

                            <input
                                type="date"
                                name="expense_date"
                                id="expense_date"
                                min="{{ now('Asia/Manila')->format('Y-m-d') }}"
                                value="{{ old(
                                    'expense_date',
                                    now('Asia/Manila')->format('Y-m-d')
                                ) }}"
                                required
                            >

                        </div>



                        <div class="financial-field financial-field-wide">

                            <label for="expense_description">
                                Description
                                <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="description"
                                id="expense_description"
                                value="{{ old('description') }}"
                                maxlength="255"
                                placeholder="Describe the expense"
                                required
                            >

                        </div>



                        <div class="financial-field">

                            <label for="expense_amount">
                                Amount
                                <span>*</span>
                            </label>

                            <div class="financial-money-input">

                                <span>
                                    ₱
                                </span>

                                <input
                                    type="number"
                                    name="amount"
                                    id="expense_amount"
                                    value="{{ old('amount') }}"
                                    min="0.01"
                                    max="999999999.99"
                                    step="0.01"
                                    placeholder="0.00"
                                    required
                                >

                            </div>

                        </div>



                        <div class="financial-field financial-field-wide">

                            <label for="expense_notes">
                                Notes
                            </label>

                            <textarea
                                name="notes"
                                id="expense_notes"
                                rows="3"
                                maxlength="2000"
                                placeholder="Optional additional notes..."
                            >{{ old('notes') }}</textarea>

                        </div>

                    </div>


                    @if($financialRemainingBudget !== null)
                        <p class="financial-budget-hint" style="margin: 10px 0; font-size: 13px; color: #675d55;">
                            Available budget: ₱{{ number_format(max(0, (float) $financialRemainingBudget), 2) }}
                        </p>
                    @endif

                    <div class="financial-form-actions">

                        <button
                            type="submit"
                            class="financial-primary-button"
                        >
                            Add Expense
                        </button>

                    </div>

                </form>


                <datalist id="expenseCategories">
                    <option value="Equipment"></option>
                    <option value="Labor"></option>
                    <option value="Materials"></option>
                    <option value="Miscellaneous"></option>
                    <option value="Permits"></option>
                    <option value="Printing"></option>
                    <option value="Professional Fees"></option>
                    <option value="Supplies"></option>
                    <option value="Transportation"></option>
                </datalist>

                </details>

            </section>

        @else

            <div class="financial-collaborator-note">

                <strong>
                    Financial records are view only.
                </strong>

                <span>
                    Only the lead architect can set the project budget
                    or add and delete project expenses.
                </span>

            </div>

        @endif



        <div class="financial-summary-grid">


            <article class="financial-summary-card">

                <span>
                    PROJECT BUDGET
                </span>

                <strong>

                    @if($financialBudget !== null)

                        ₱{{ number_format(
                            $financialBudget,
                            2
                        ) }}

                    @else

                        Not set

                    @endif

                </strong>

                <p>
                    Approved project budget
                </p>

            </article>



            <article class="financial-summary-card">

                <span>
                    TOTAL EXPENSES
                </span>

                <strong>
                    ₱{{ number_format(
                        $financialTotalExpenses,
                        2
                    ) }}
                </strong>

                <p>
                    {{ $financialExpenses->count() }}
                    {{ $financialExpenses->count() === 1
                        ? 'recorded expense'
                        : 'recorded expenses'
                    }}
                </p>

            </article>



            <article class="financial-summary-card">

                <span>
                    REMAINING BUDGET
                </span>

                <strong
                    class="
                        {{ $financialRemainingBudget !== null
                            && $financialRemainingBudget < 0
                                ? 'financial-negative'
                                : ''
                        }}
                    "
                >

                    @if($financialRemainingBudget !== null)

                        ₱{{ number_format(
                            $financialRemainingBudget,
                            2
                        ) }}

                    @else

                        —

                    @endif

                </strong>

                <p>
                    Budget less recorded expenses
                </p>

            </article>



            <article class="financial-summary-card">

                <span>
                    BUDGET USED
                </span>

                <strong>
                    {{ $financialBudget !== null
                        && $financialBudget > 0
                            ? $financialUsagePercent . '%'
                            : '—'
                    }}
                </strong>

                <div class="financial-budget-track">

                    <span
                        class="
                            {{ $financialBudget !== null
                                && $financialTotalExpenses > $financialBudget
                                    ? 'over-budget'
                                    : ''
                            }}
                        "
                        style="width: {{ $financialUsagePercent }}%;"
                    ></span>

                </div>

            </article>

        </div>




<style>
.financial-expense-collapse { margin-top: 12px; border: 2px solid #dc8c49; border-radius: 12px; overflow: hidden; background: #fff; }
.financial-expense-collapse-toggle { cursor: pointer; display: flex; justify-content: space-between; align-items: center; gap: 12px; padding: 18px 20px; background: #fff3e8; color: #693b1e; font-weight: 800; list-style: none; transition: background .2s ease; }
.financial-expense-collapse-toggle::-webkit-details-marker { display: none; }
.financial-expense-collapse-toggle:hover, .financial-expense-collapse-toggle:focus-visible { background: #ffe6d1; }
.financial-expense-collapse-title { font-size: 15px; }
.financial-expense-collapse-action { display: inline-flex; align-items: center; gap: 12px; font-size: 13px; font-weight: 700; color: #9a4f19; }
.financial-expense-chevron { display: inline-block; font-size: 23px; line-height: 1; transition: transform .2s ease; }
.financial-expense-label-open { display: none; }
.financial-expense-collapse[open] .financial-expense-label-open { display: inline; }
.financial-expense-collapse[open] .financial-expense-label-closed { display: none; }
.financial-expense-collapse[open] .financial-expense-chevron { transform: rotate(180deg); }
.financial-expense-collapse[open] > .financial-expense-collapse-toggle { border-bottom: 1px solid #f0d6bf; }
.financial-expense-collapse > .financial-expense-form { padding: 18px 20px 8px; }
@media (max-width: 600px) { .financial-expense-collapse-toggle { padding: 14px; } .financial-expense-collapse-title { font-size: 13px; } .financial-expense-collapse-action { font-size: 11px; gap: 5px; } }
</style>
        <section id="recorded-expenses" class="financial-expense-register" style="scroll-margin-top: 90px;">


            <div class="financial-register-head">

                <div>

                    <span class="section-label">
                        EXPENSE REGISTER
                    </span>

                    <h3>
                        Recorded Expenses
                    </h3>

                    <p>
                        Complete expense history for this project.
                    </p>

                </div>


                <span class="financial-record-count">

                    {{ $financialExpenses->count() }}

                    {{ $financialExpenses->count() === 1
                        ? 'Record'
                        : 'Records'
                    }}

                </span>

            </div>



            @if($financialExpenses->count() > 0)

                <div class="financial-table-wrap">

                    <table class="financial-expense-table">

                        <thead>

                            <tr>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Recorded By</th>
                                <th>Amount</th>

                                @if($isLeadArchitect)
                                    <th>Actions</th>
                                @endif
                            </tr>

                        </thead>


                        <tbody>

                            @foreach($financialExpenses as $expense)

                                <tr>

                                    <td>
                                        {{ $expense->expense_date
                                            ? $expense->expense_date->format('M d, Y')
                                            : '—'
                                        }}
                                    </td>

                                    <td>
                                        <span class="financial-category-badge">
                                            {{ $expense->category }}
                                        </span>
                                    </td>

                                    <td>

                                        <strong class="financial-expense-description">
                                            {{ $expense->description }}
                                        </strong>

                                        @if($expense->notes)

                                            <span class="financial-expense-note">
                                                {{ $expense->notes }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $expense->recordedBy?->name
                                            ?? 'Architect'
                                        }}
                                    </td>

                                    <td>
                                        <strong class="financial-expense-amount">
                                            ₱{{ number_format(
                                                (float) $expense->amount,
                                                2
                                            ) }}
                                        </strong>
                                    </td>


                                    @if($isLeadArchitect)

                                        <td>

                                            <div class="financial-row-actions">


                                                <button
                                                    type="button"
                                                    class="financial-edit-button"
                                                    onclick="if (confirm('Do you want to edit this recorded expense?')) toggleExpenseEdit({{ $expense->id }})"
                                                >
                                                    Edit
                                                </button>



                                                <form
                                                    method="POST"
                                                    action="{{ route(
                                                        'architect.projects.expenses.destroy',
                                                        [
                                                            'id' => $project->id,
                                                            'expense' => $expense->id
                                                        ]
                                                    ) }}"
                                                    onsubmit="return confirm(
                                                        'Delete this project expense?'
                                                    );"
                                                >

                                                    @csrf
                                                    @method('DELETE')


                                                    <button
                                                        type="submit"
                                                        class="financial-delete-button"
                                                    >
                                                        Delete
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    @endif

                                </tr>




                                @if($isLeadArchitect)

                                    <tr
                                        class="financial-edit-row"
                                        id="expenseEditRow{{ $expense->id }}"
                                    >

                                        <td
                                            colspan="6"
                                        >

                                            <form
                                                method="POST"
                                                onsubmit="return confirm('Save changes to this recorded expense?')"
                                                action="{{ route(
                                                    'architect.projects.expenses.update',
                                                    [
                                                        'id' => $project->id,
                                                        'expense' => $expense->id
                                                    ]
                                                ) }}"
                                                class="financial-inline-edit-form"
                                            >

                                                @csrf
                                                @method('PUT')


                                                <div class="financial-form-grid">


                                                    <div class="financial-field">

                                                        <label>
                                                            Category
                                                        </label>

                                                        <input
                                                            type="text"
                                                            name="category"
                                                            value="{{ $expense->category }}"
                                                            maxlength="100"
                                                            list="expenseCategories"
                                                            required
                                                        >

                                                    </div>



                                                    <div class="financial-field">

                                                        <label>
                                                            Expense Date
                                                        </label>

                                                        <input
                                                            type="date"
                                                            name="expense_date"
                                                            min="{{ now('Asia/Manila')->format('Y-m-d') }}"
                                                            value="{{ $expense->expense_date
                                                                ? $expense->expense_date->format('Y-m-d')
                                                                : ''
                                                            }}"
                                                            required
                                                        >

                                                    </div>



                                                    <div class="financial-field financial-field-wide">

                                                        <label>
                                                            Description
                                                        </label>

                                                        <input
                                                            type="text"
                                                            name="description"
                                                            value="{{ $expense->description }}"
                                                            maxlength="255"
                                                            required
                                                        >

                                                    </div>



                                                    <div class="financial-field">

                                                        <label>
                                                            Amount
                                                        </label>

                                                        <div class="financial-money-input">

                                                            <span>
                                                                ₱
                                                            </span>

                                                            <input
                                                                type="number"
                                                                name="amount"
                                                                value="{{ $expense->amount }}"
                                                                min="0.01"
                                                                max="999999999.99"
                                                                step="0.01"
                                                                required
                                                            >

                                                        </div>

                                                    </div>



                                                    <div class="financial-field financial-field-wide">

                                                        <label>
                                                            Notes
                                                        </label>

                                                        <textarea
                                                            name="notes"
                                                            rows="3"
                                                            maxlength="2000"
                                                        >{{ $expense->notes }}</textarea>

                                                    </div>

                                                </div>


                                                <div class="financial-inline-actions">

                                                    <button
                                                        type="button"
                                                        class="financial-secondary-button"
                                                        onclick="toggleExpenseEdit(
                                                            {{ $expense->id }}
                                                        )"
                                                    >
                                                        Cancel
                                                    </button>

                                                    <button
                                                        type="submit"
                                                        class="financial-primary-button"
                                                    >
                                                        Save Changes
                                                    </button>

                                                </div>

                                            </form>

                                        </td>

                                    </tr>

                                @endif

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="financial-empty-state">

                    <strong>
                        No expenses recorded yet
                    </strong>

                    <p>

                        @if($isLeadArchitect)

                            Add the first project expense using the form above.

                        @else

                            Expenses recorded by the lead architect
                            will appear here.

                        @endif

                    </p>

                </div>

            @endif

        </section>


    </section>


    <script>


            row.classList.toggle(
                'show'
            );
        }

    </script>

@endif



<!-- =================================================
    PROJECT PHASES & MILESTONES
================================================== -->

@if($activeTab === 'phases')

    @php

        /*
        |--------------------------------------------------------------------------
        | PROJECT PHASES
        |--------------------------------------------------------------------------
        */

        $projectPhases =
            $project->phases
                ->sortBy('phase_order')
                ->values();


        /*
        |--------------------------------------------------------------------------
        | FIXED PHASE WEIGHTS
        |--------------------------------------------------------------------------
        */

        $phaseWeights = [
            1 => 5,
            2 => 5,
            3 => 10,
            4 => 15,
            5 => 10,
            6 => 10,
            7 => 10,
            8 => 20,
            9 => 10,
            10 => 5,
        ];


        /*
        |--------------------------------------------------------------------------
        | COMPLETED PHASE COUNT
        |--------------------------------------------------------------------------
        */

        $completedPhaseCount =
            $projectPhases
                ->where(
                    'status',
                    'completed'
                )
                ->count();


        /*
        |--------------------------------------------------------------------------
        | CURRENT PHASE
        |--------------------------------------------------------------------------
        */

        $currentPhase =
            $projectPhases
                ->firstWhere(
                    'status',
                    'in_progress'
                );


        /*
        |--------------------------------------------------------------------------
        | NEXT AVAILABLE PHASE
        |--------------------------------------------------------------------------
        */

        $nextPhase =
            null;


        if (!$currentPhase) {

            foreach (
                $projectPhases
                as $phaseItem
            ) {

                if (
                    $phaseItem->status !==
                    'pending'
                ) {
                    continue;
                }


                $previousCompleted =
                    $projectPhases
                        ->filter(
                            function ($previousPhase) use ($phaseItem) {

                                return
                                    $previousPhase->phase_order
                                    <
                                    $phaseItem->phase_order;
                            }
                        )
                        ->every(
                            function ($previousPhase) {

                                return
                                    $previousPhase->status
                                    ===
                                    'completed';
                            }
                        );


                if ($previousCompleted) {

                    $nextPhase =
                        $phaseItem;

                    break;
                }
            }
        }

    @endphp


    <section class="tab-panel project-phases-panel">

        <style>
            /* =========================================================
               PROJECT PHASES — COLLAPSIBLE ROADMAP
            ========================================================= */

            .project-phases-panel .standard-phase-card {
                transition:
                    box-shadow .22s ease,
                    transform .22s ease,
                    border-color .22s ease;
            }

            .project-phases-panel .standard-phase-top.phase-dropdown-trigger {
                position: relative;
                display: grid;
                grid-template-columns: minmax(0, 1fr) auto auto;
                align-items: center;
                gap: 16px;
                cursor: pointer;
                user-select: none;
                border-radius: 12px;
                transition:
                    background .18s ease,
                    box-shadow .18s ease;
            }

            .project-phases-panel .standard-phase-top.phase-dropdown-trigger:hover {
                background: rgba(232, 126, 45, 0.055);
            }

            .project-phases-panel .standard-phase-top.phase-dropdown-trigger:focus-visible {
                outline: 3px solid rgba(232, 126, 45, 0.24);
                outline-offset: 5px;
            }

            /* Bigger, clearer phase names */
            .project-phases-panel .standard-phase-title h3 {
                margin-top: 8px;
                margin-bottom: 7px;
                font-size: clamp(22px, 2vw, 29px) !important;
                line-height: 1.16 !important;
                font-weight: 800 !important;
                letter-spacing: -0.025em;
                color: #24211f;
            }

            .project-phases-panel .standard-phase-title > p {
                font-size: 14px;
                line-height: 1.65;
                max-width: 780px;
            }

            .project-phases-panel .phase-small-label {
                font-size: 13px;
                font-weight: 800;
                letter-spacing: .11em;
            }

            .project-phases-panel .phase-status {
                white-space: nowrap;
            }

            /* Dropdown arrow */
            .project-phases-panel .phase-dropdown-chevron {
                width: 38px;
                height: 38px;
                flex: 0 0 38px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border: 1px solid rgba(35, 31, 28, 0.12);
                border-radius: 10px;
                background: rgba(255, 255, 255, 0.72);
                transition:
                    transform .24s ease,
                    background .18s ease,
                    border-color .18s ease;
            }

            .project-phases-panel .phase-dropdown-chevron svg {
                width: 19px;
                height: 19px;
                fill: none;
                stroke: currentColor;
                stroke-width: 2.2;
                stroke-linecap: round;
                stroke-linejoin: round;
            }

            .project-phases-panel .phase-dropdown-open .phase-dropdown-chevron {
                transform: rotate(180deg);
                background: rgba(232, 126, 45, 0.08);
                border-color: rgba(232, 126, 45, 0.24);
            }

            /* Collapsible content */
            .project-phases-panel .phase-dropdown-details {
                display: block;
                animation: archiPhaseOpen .22s ease;
            }

            .project-phases-panel .phase-dropdown-closed .phase-dropdown-details {
                display: none;
            }

            .project-phases-panel .phase-dropdown-closed .standard-phase-content {
                padding-bottom: 0;
            }

            .project-phases-panel .phase-dropdown-closed .standard-phase-top {
                margin-bottom: 0;
            }

            .project-phases-panel .phase-dropdown-closed.standard-phase-card {
                min-height: 0;
            }

            @keyframes archiPhaseOpen {
                from {
                    opacity: 0;
                    transform: translateY(-5px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 820px) {
                .project-phases-panel .standard-phase-top.phase-dropdown-trigger {
                    grid-template-columns: minmax(0, 1fr) auto;
                }

                .project-phases-panel .phase-status {
                    grid-column: 1 / 2;
                    justify-self: start;
                }

                .project-phases-panel .phase-dropdown-chevron {
                    grid-column: 2 / 3;
                    grid-row: 1 / 3;
                }

                .project-phases-panel .standard-phase-title h3 {
                    font-size: 21px !important;
                }
            }
        </style>

        <script>
            function toggleProjectPhase(phaseId, trigger)
            {
                const card = document.getElementById(
                    'phase-card-' + phaseId
                );

                if (!card) {
                    return;
                }

                const isOpen =
                    card.classList.contains(
                        'phase-dropdown-open'
                    );

                if (isOpen) {
                    card.classList.remove(
                        'phase-dropdown-open'
                    );

                    card.classList.add(
                        'phase-dropdown-closed'
                    );

                    if (trigger) {
                        trigger.setAttribute(
                            'aria-expanded',
                            'false'
                        );
                    }

                    return;
                }

                card.classList.remove(
                    'phase-dropdown-closed'
                );

                card.classList.add(
                    'phase-dropdown-open'
                );

                if (trigger) {
                    trigger.setAttribute(
                        'aria-expanded',
                        'true'
                    );
                }
            }
        </script>


        <!-- =================================================
            PAGE HEADER
        ================================================== -->

        <div class="phase-page-header">

            <div>

                <span class="section-label">
                    PROJECT ROADMAP
                </span>

                <h2>
                    Project Phases
                </h2>

                <p>
                    Track each project stage using accomplishments,
                    milestone reports, and supporting proof. A phase
                    can only be completed after its milestones have
                    been properly documented.
                </p>

            </div>

        </div>



        <!-- =================================================
            SUCCESS
        ================================================== -->

        @if(session('success'))

            <div class="phase-success-message">

                <div class="phase-message-icon">
                    ✓
                </div>

                <div>

                    <strong>
                        Project updated
                    </strong>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            </div>

        @endif



        <!-- =================================================
            ERRORS
        ================================================== -->

        @if($errors->any())

            <div class="phase-error-message">

                <strong>
                    Please check the project update.
                </strong>

                <ul>

                    @foreach(
                        $errors->all()
                        as $error
                    )

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif



        <!-- =================================================
            PROJECT PROGRESS
        ================================================== -->

        <div class="phase-progress-dashboard">


            <div class="phase-progress-main">


                <div class="phase-progress-number">

                    <strong>
                        {{ $project->progress ?? 0 }}
                    </strong>

                    <span>
                        %
                    </span>

                </div>



                <div class="phase-progress-copy">

                    <span>
                        PROJECT COMPLETION
                    </span>


                    @if(
                        ($project->progress ?? 0)
                        >=
                        100
                    )

                        <h3>
                            Project Complete
                        </h3>

                        <p>
                            All ten project phases have been completed.
                        </p>


                    @elseif($currentPhase)

                        <h3>
                            {{ $currentPhase->phase_name }}
                        </h3>

                        <p>
                            Current phase ·
                            {{ $completedPhaseCount }}
                            of
                            {{ $projectPhases->count() }}
                            phases completed
                        </p>


                    @elseif($nextPhase)

                        <h3>
                            Ready for {{ $nextPhase->phase_name }}
                        </h3>

                        <p>
                            {{ $completedPhaseCount }}
                            of
                            {{ $projectPhases->count() }}
                            phases completed
                        </p>


                    @else

                        <h3>
                            Project Roadmap
                        </h3>

                        <p>
                            Start the next available phase to continue.
                        </p>

                    @endif

                </div>

            </div>



            <div class="phase-progress-bar">

                <div
                    class="phase-progress-bar-fill"
                    style="
                        width:
                        {{ min(
                            max(
                                $project->progress ?? 0,
                                0
                            ),
                            100
                        ) }}%;
                    "
                ></div>

            </div>

        </div>



        <!-- =================================================
            INFO
        ================================================== -->

        <div class="phase-weight-note">


            <div class="phase-weight-note-icon">
                %
            </div>


            <div>

                <strong>
                    How phase completion works
                </strong>

                <span>
                    Each phase must contain at least one milestone.
                    Every milestone must be completed with a report
                    and supporting proof before the whole phase can
                    be marked as completed.
                </span>

            </div>

        </div>



        <!-- =================================================
            ROADMAP
        ================================================== -->

        <div class="standard-phase-roadmap">


            @foreach(
                $projectPhases
                as $phase
            )


                @php

                    /*
                    |--------------------------------------------------------------------------
                    | PHASE WEIGHT
                    |--------------------------------------------------------------------------
                    */

                    $phaseWeight =
                        $phaseWeights[
                            $phase->phase_order
                        ]
                        ?? 0;


                    /*
                    |--------------------------------------------------------------------------
                    | PREVIOUS PHASES
                    |--------------------------------------------------------------------------
                    */

                    $previousPhases =
                        $projectPhases
                            ->filter(
                                function ($previousPhase) use ($phase) {

                                    return
                                        $previousPhase->phase_order
                                        <
                                        $phase->phase_order;
                                }
                            );


                    $previousCompleted =
                        $previousPhases
                            ->every(
                                function ($previousPhase) {

                                    return
                                        $previousPhase->status
                                        ===
                                        'completed';
                                }
                            );


                    /*
                    |--------------------------------------------------------------------------
                    | PHASE STATE
                    |--------------------------------------------------------------------------
                    */

                    $isCompleted =
                        $phase->status ===
                        'completed';


                    $isCurrent =
                        $phase->status ===
                        'in_progress';


                    $isReady =
                        !$currentPhase
                        &&
                        $phase->status ===
                        'pending'
                        &&
                        $previousCompleted;


                    $isLocked =
                        !$isCompleted
                        &&
                        !$isCurrent
                        &&
                        !$isReady;


                    /*
                    |--------------------------------------------------------------------------
                    | STATUS LABEL
                    |--------------------------------------------------------------------------
                    */

                    if ($isCompleted) {

                        $phaseStatusLabel =
                            'Completed';

                    } elseif ($isCurrent) {

                        $phaseStatusLabel =
                            'Current Phase';

                    } elseif ($isReady) {

                        $phaseStatusLabel =
                            'Ready to Start';

                    } else {

                        $phaseStatusLabel =
                            'Locked';
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | MILESTONE COUNTS
                    |--------------------------------------------------------------------------
                    */

                    $milestoneCount =
                        $phase->milestones->count();


                    $completedMilestoneCount =
                        $phase->milestones
                            ->where(
                                'status',
                                'completed'
                            )
                            ->count();


                    /*
                    |--------------------------------------------------------------------------
                    | FULLY COMPLETED MILESTONES
                    |--------------------------------------------------------------------------
                    */

                    $fullyCompletedMilestones =
                        $phase->milestones
                            ->filter(
                                function ($milestone) {

                                    return
                                        $milestone->status === 'completed'
                                        &&
                                        !empty($milestone->completion_report)
                                        &&
                                        !empty($milestone->proof_file);
                                }
                            )
                            ->count();


                    /*
                    |--------------------------------------------------------------------------
                    | CAN COMPLETE PHASE
                    |--------------------------------------------------------------------------
                    */

                    $canCompletePhase =
                        $isCurrent
                        &&
                        $milestoneCount >= 1
                        &&
                        $fullyCompletedMilestones === $milestoneCount;

                @endphp



                <article
                    class="
                        standard-phase-card

                        @if($isCompleted)
                            standard-phase-completed
                        @elseif($isCurrent)
                            standard-phase-in_progress
                        @elseif($isReady)
                            standard-phase-ready
                        @else
                            standard-phase-locked
                        @endif

                        @if($isCurrent)
                            phase-dropdown-open
                        @else
                            phase-dropdown-closed
                        @endif
                    "
                    id="phase-card-{{ $phase->id }}"
                >


                    <!-- =================================================
                        PHASE NUMBER
                    ================================================== -->

                    <div class="standard-phase-number">


                        <div class="phase-number-circle">


                            @if($isCompleted)

                                <svg viewBox="0 0 24 24">
                                    <path d="M5 12l4 4L19 6"/>
                                </svg>


                            @else

                                {{ str_pad(
                                    $phase->phase_order,
                                    2,
                                    '0',
                                    STR_PAD_LEFT
                                ) }}

                            @endif

                        </div>


                        @if(!$loop->last)

                            <div class="phase-connector"></div>

                        @endif

                    </div>



                    <!-- =================================================
                        PHASE CONTENT
                    ================================================== -->

                    <div class="standard-phase-content">


                        <!-- =================================================
                            HEADER
                        ================================================== -->

                        <div
                            class="standard-phase-top phase-dropdown-trigger"
                            role="button"
                            tabindex="0"
                            aria-expanded="{{ $isCurrent ? 'true' : 'false' }}"
                            aria-controls="phase-details-{{ $phase->id }}"
                            aria-disabled="{{ $isLocked ? 'true' : 'false' }}"
                            onclick="toggleProjectPhase({{ $phase->id }}, this)"
                            onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); toggleProjectPhase({{ $phase->id }}, this); }"
                        >


                            <div class="standard-phase-title">


                                <div class="standard-phase-label-row">


                                    <span class="phase-small-label">

                                        PHASE
                                        {{ $phase->phase_order }}

                                    </span>

                                </div>


                                <h3>
                                    {{ $phase->phase_name }}
                                </h3>


                                <p>
                                    {{ $phase->description }}
                                </p>

                            </div>



                            <span
                                class="
                                    phase-status

                                    @if($isCompleted)
                                        phase-status-completed
                                    @elseif($isCurrent)
                                        phase-status-in_progress
                                    @elseif($isReady)
                                        phase-status-ready
                                    @else
                                        phase-status-locked
                                    @endif
                                "
                            >


                                @if($isCompleted)

                                    <svg viewBox="0 0 24 24">
                                        <path d="M5 12l4 4L19 6"/>
                                    </svg>


                                @elseif($isCurrent)

                                    <span class="current-phase-dot"></span>


                                @elseif($isReady)

                                    <svg viewBox="0 0 24 24">
                                        <path d="M8 5l8 7-8 7"/>
                                    </svg>


                                @else

                                    <svg viewBox="0 0 24 24">

                                        <rect
                                            x="5"
                                            y="10"
                                            width="14"
                                            height="10"
                                            rx="2"
                                        />

                                        <path d="M8 10V7a4 4 0 0 1 8 0v3"/>

                                    </svg>

                                @endif


                                {{ $phaseStatusLabel }}

                            </span>


                            <span
                                class="phase-dropdown-chevron"
                                aria-hidden="true"
                            >
                                <svg viewBox="0 0 24 24">
                                    <path d="M6 9l6 6 6-6"/>
                                </svg>
                            </span>

                        </div>



                        <div class="phase-dropdown-details" id="phase-details-{{ $phase->id }}">

                        <!-- PHASE COMPLETION REQUIREMENT -->
                        <div class="phase-completion-requirement" style="padding:14px 16px;margin:12px 0;border:1px solid #e2e8f0;border-radius:12px;background:#f8fafc;">
                            <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;">
                                <strong style="font-size:13px;color:#334155;">Milestone completion</strong>
                                <strong style="font-size:14px;color:#0f766e;">{{ $milestoneCount > 0 ? round(($fullyCompletedMilestones / $milestoneCount) * 100) : 0 }}% / 100%</strong>
                            </div>
                            <div style="height:7px;background:#e2e8f0;border-radius:99px;overflow:hidden;margin-top:10px;">
                                <div style="height:100%;width:{{ $milestoneCount > 0 ? round(($fullyCompletedMilestones / $milestoneCount) * 100) : 0 }}%;background:#0f766e;border-radius:99px;"></div>
                            </div>
                            <small style="display:block;margin-top:9px;color:#64748b;line-height:1.5;">
                                {{ $fullyCompletedMilestones }} of {{ $milestoneCount }} milestones completed with reports and supporting files.
                                @if($isLocked) Finish the previous phase at 100% to unlock this phase. @endif
                            </small>
                        </div>

                        <!-- =================================================
                            PHASE ACTION
                        ================================================== -->

                        <div class="phase-action-area">


                            <!-- =================================================
                                COMPLETED PHASE
                            ================================================== -->

                            @if($isCompleted)


                                <div class="phase-completed-proof">


                                    <div class="phase-completed-proof-header">


                                        <div class="completed-proof-check">

                                            <svg viewBox="0 0 24 24">
                                                <path d="M5 12l4 4L19 6"/>
                                            </svg>

                                        </div>


                                        <div>

                                            <span>
                                                PHASE COMPLETED
                                            </span>

                                            <strong>
                                                Completion verified
                                            </strong>

                                        </div>

                                    </div>



                                    <div class="completed-proof-grid">


                                        <div class="completed-proof-detail">

                                            <span>
                                                COMPLETED BY
                                            </span>

                                            <strong>
                                                {{ $phase->completedBy?->name ?? 'Architect' }}
                                            </strong>

                                        </div>



                                        <div class="completed-proof-detail">

                                            <span>
                                                COMPLETED DATE
                                            </span>

                                            <strong>

                                                {{ $phase->completed_date
                                                    ? $phase->completed_date->format('M d, Y')
                                                    : 'Completed'
                                                }}

                                            </strong>

                                        </div>



                                    @if($phase->completion_note)

                                        <div class="completed-note-box">

                                            <span>
                                                ARCHITECT COMPLETION NOTE
                                            </span>

                                            <p>
                                                {{ $phase->completion_note }}
                                            </p>

                                        </div>

                                    @endif

                                </div>



                            <!-- =================================================
                                CURRENT PHASE
                            ================================================== -->

                            @elseif($isCurrent)


                                <div class="phase-current-summary">


                                    <div>

                                        <span>
                                            CURRENT PROJECT PHASE
                                        </span>

                                        <strong>
                                            {{ $phase->phase_name }}
                                        </strong>

                                        <small>

                                            {{ $fullyCompletedMilestones }}
                                            of
                                            {{ $milestoneCount }}
                                            milestone(s) fully documented

                                        </small>

                                    </div>

                                </div>



                            <!-- =================================================
                                READY PHASE
                            ================================================== -->

                            @elseif($isReady)


                                <div class="phase-ready-area">


                                    <div>

                                        <span>
                                            READY TO BEGIN
                                        </span>

                                        <strong>
                                            Start this phase when project work begins.
                                        </strong>

                                    </div>



                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'architect.projects.phases.update',
                                            [
                                                'project' =>
                                                    $project->id,

                                                'phase' =>
                                                    $phase->id
                                            ]
                                        ) }}"
                                    >

                                        @csrf
                                        @method('PUT')


                                        <input
                                            type="hidden"
                                            name="status"
                                            value="in_progress"
                                        >


                                        <button
                                            type="submit"
                                            class="start-phase-button"
                                        >

                                            Start Phase

                                            <svg viewBox="0 0 24 24">
                                                <path d="M8 5l8 7-8 7"/>
                                            </svg>

                                        </button>

                                    </form>

                                </div>



                            <!-- =================================================
                                LOCKED PHASE
                            ================================================== -->

                            @else


                                <div class="phase-locked-message">


                                    <div class="phase-lock-icon">

                                        <svg viewBox="0 0 24 24">

                                            <rect
                                                x="5"
                                                y="10"
                                                width="14"
                                                height="10"
                                                rx="2"
                                            />

                                            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>

                                        </svg>

                                    </div>


                                    <div>

                                        <strong>
                                            Phase locked
                                        </strong>

                                        <span>
                                            Complete the previous phase first.
                                        </span>

                                    </div>

                                </div>


                            @endif

                        </div>



                        <!-- =================================================
                            MILESTONES
                        ================================================== -->

                        <div class="phase-milestone-section">


                            <div class="phase-milestone-header">


                                <div>

                                    <span class="phase-small-label">
                                        ACCOMPLISHMENTS
                                    </span>

                                    <strong>
                                        Phase Milestones
                                    </strong>

                                    <small>

                                        Add only meaningful accomplishments.
                                        At least one completed milestone with
                                        report and proof is required before
                                        completing this phase.

                                    </small>

                                </div>


                                @if(
                                    !$isLocked
                                    &&
                                    !$isCompleted
                                )

                                    <button
                                        type="button"
                                        class="add-milestone-button"
                                        onclick="openMilestoneModal(
                                            {{ $phase->id }},
                                            @js($phase->phase_name)
                                        )"
                                    >
                                        + Add Milestone
                                    </button>

                                @endif

                            </div>



                            <!-- =================================================
                                MILESTONE LIST
                            ================================================== -->

                            <div class="milestone-list">


                                @forelse(
                                    $phase->milestones
                                    as $milestone
                                )


                                    @php

                                        $milestoneStatusLabel =
                                            match(
                                                $milestone->status
                                            ) {

                                                'in_progress' =>
                                                    'In Progress',

                                                'completed' =>
                                                    'Completed',

                                                default =>
                                                    'Pending'
                                            };


                                        $milestoneFullyCompleted =
                                            $milestone->status === 'completed'
                                            &&
                                            !empty($milestone->completion_report)
                                            &&
                                            !empty($milestone->proof_file);

                                    @endphp



                                    <div
                                        class="
                                            milestone-card

                                            @if($milestoneFullyCompleted)
                                                milestone-card-completed
                                            @elseif($milestone->status === 'in_progress')
                                                milestone-card-progress
                                            @endif
                                        "
                                    >


                                        <!-- =================================================
                                            MILESTONE HEADER
                                        ================================================== -->

                                        <div class="milestone-card-header">


                                            <div class="milestone-card-title">


                                                <span
                                                    class="
                                                        milestone-dot
                                                        milestone-dot-{{ $milestone->status }}
                                                    "
                                                ></span>


                                                <div>

                                                    <strong>
                                                        {{ $milestone->milestone_name }}
                                                    </strong>


                                                    @if($milestone->description)

                                                        <p>
                                                            {{ $milestone->description }}
                                                        </p>

                                                    @endif


                                                    <small>

                                                        Target:

                                                        {{ $milestone->target_date
                                                            ? $milestone->target_date->format('M d, Y')
                                                            : 'Not set'
                                                        }}

                                                    </small>

                                                </div>

                                            </div>



                                            <span
                                                class="
                                                    milestone-status
                                                    milestone-status-{{ $milestone->status }}
                                                "
                                            >
                                                {{ $milestoneStatusLabel }}
                                            </span>

                                        </div>



                                        <!-- =================================================
                                            COMPLETED MILESTONE
                                        ================================================== -->

                                        @if($milestoneFullyCompleted)


                                            <div class="milestone-proof-area">


                                                <div class="milestone-proof-meta">


                                                    <div>

                                                        <span>
                                                            COMPLETED BY
                                                        </span>

                                                        <strong>
                                                            {{ $milestone->completedBy?->name ?? 'Architect' }}
                                                        </strong>

                                                    </div>



                                                    <div>

                                                        <span>
                                                            COMPLETED
                                                        </span>

                                                        <strong>

                                                            {{ $milestone->completed_at
                                                                ? $milestone->completed_at->timezone('Asia/Manila')->format('M d, Y · h:i A')
                                                                : 'Completed'
                                                            }}

                                                        </strong>

                                                    </div>

                                                </div>



                                                <div class="milestone-report-box">

                                                    <span>
                                                        COMPLETION REPORT
                                                    </span>

                                                    <p>
                                                        {{ $milestone->completion_report }}
                                                    </p>

                                                </div>



                                                <div class="milestone-proof-file">


                                                    <div>

                                                        <span>
                                                            SUPPORTING PROOF
                                                        </span>

                                                        <strong>
                                                            {{ $milestone->proof_file_name ?? 'Supporting File' }}
                                                        </strong>

                                                    </div>


                                                    <a
                                                        href="{{ route(
                                                            'project.milestones.proof.secure.view',
                                                            [
                                                                'projectId' =>
                                                                    $project->id,

                                                                'milestoneId' =>
                                                                    $milestone->id
                                                            ]
                                                        ) }}"
                                                        target="_blank"
                                                        rel="noopener"
                                                    >
                                                        View Proof
                                                    </a>

                                                </div>

                                            </div>



                                        <!-- =================================================
                                            MILESTONE ACTIONS
                                        ================================================== -->

                                        @elseif(
                                            !$isCompleted
                                            &&
                                            !$isLocked
                                        )


                                            <div class="milestone-action-area">


                                                @if(
                                                    $milestone->status ===
                                                    'pending'
                                                )

                                                    <form
                                                        method="POST"
                                                        action="{{ route(
                                                            'architect.projects.phases.milestones.update',
                                                            [
                                                                'project' =>
                                                                    $project->id,

                                                                'phase' =>
                                                                    $phase->id,

                                                                'milestone' =>
                                                                    $milestone->id
                                                            ]
                                                        ) }}"
                                                    >

                                                        @csrf
                                                        @method('PUT')


                                                        <input
                                                            type="hidden"
                                                            name="status"
                                                            value="in_progress"
                                                        >


                                                        <button
                                                            type="submit"
                                                            class="milestone-start-button"
                                                        >
                                                            Start Milestone
                                                        </button>

                                                    </form>

                                                @endif



                                                @if(
                                                    $milestone->status ===
                                                    'in_progress'
                                                )

                                                    <button
                                                        type="button"
                                                        class="milestone-complete-button"
                                                        onclick="openMilestoneCompleteModal(
                                                            {{ $phase->id }},
                                                            {{ $milestone->id }},
                                                            @js($milestone->milestone_name)
                                                        )"
                                                    >
                                                        Complete Milestone
                                                    </button>

                                                @endif

                                            </div>


                                        @endif

                                    </div>


                                @empty


                                    <div class="milestone-empty">

                                        <span>
                                            No milestones yet
                                        </span>

                                        <small>
                                            Add at least one meaningful accomplishment
                                            for this phase.
                                        </small>

                                    </div>


                                @endforelse

                            </div>



                            <!-- =================================================
                                PHASE COMPLETION
                            ================================================== -->

                            @if($isCurrent)


                                <div class="phase-final-completion">


                                    @if(
                                        $milestoneCount ===
                                        0
                                    )

                                        <div class="phase-completion-blocked">

                                            <strong>
                                                Phase completion locked
                                            </strong>

                                            <span>
                                                Add at least one milestone before
                                                completing this phase.
                                            </span>

                                        </div>


                                    @elseif(
                                        !$canCompletePhase
                                    )

                                        <div class="phase-completion-blocked">

                                            <strong>
                                                Complete all milestone documentation first
                                            </strong>

                                            <span>
                                                The next phase stays locked until this phase reaches 100%. Every milestone needs a completion report, supporting proof file, and verified completion details.
                                            </span>

                                        </div>


                                    @else


                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'architect.projects.phases.update',
                                                [
                                                    'project' =>
                                                        $project->id,

                                                    'phase' =>
                                                        $phase->id
                                                ]
                                            ) }}"
                                            class="phase-final-completion-form"
                                        >

                                            @csrf
                                            @method('PUT')


                                            <input
                                                type="hidden"
                                                name="status"
                                                value="completed"
                                            >


                                            <div class="phase-final-note">


                                                <label>
                                                    Phase Completion Note
                                                    <span>*</span>
                                                </label>


                                                <textarea
                                                    name="completion_note"
                                                    rows="4"
                                                    minlength="10"
                                                    maxlength="3000"
                                                    placeholder="Summarize the work completed during this phase..."
                                                    required
                                                >{{ old('completion_note') }}</textarea>


                                                <small>
                                                    100% milestone completion is required. Each milestone must have a completion report and supporting proof file. Add a detailed final phase summary as the phase completion record.
                                                </small>

                                            </div>



                                            <div class="phase-final-submit">


                                                <div>

                                                    <strong>
                                                        Ready to complete phase
                                                    </strong>

                                                    <span>

                                                        {{ $milestoneCount }}

                                                        milestone(s) verified with
                                                        report and proof.

                                                    </span>

                                                </div>


                                                <button
                                                    type="submit"
                                                    class="complete-phase-button"
                                                    onclick="
                                                        return confirm(
                                                            'Complete this phase? Once completed, it will be locked and the next phase will become available.'
                                                        );
                                                    "
                                                >

                                                    <svg viewBox="0 0 24 24">
                                                        <path d="M5 12l4 4L19 6"/>
                                                    </svg>

                                                    Complete Phase

                                                </button>

                                            </div>

                                        </form>


                                    @endif

                                </div>


                            @endif

                        </div><!-- /phase-action-area -->

                        </div><!-- /phase-dropdown-details -->

                    </div><!-- /standard-phase-content -->

                </article>


            @endforeach

        </div>



        <!-- =================================================
            ADD MILESTONE MODAL
        ================================================== -->

        <div
            class="phase-modal"
            id="milestoneModal"
        >


            <div
                class="phase-modal-backdrop"
                onclick="closeMilestoneModal()"
            ></div>


            <div class="phase-modal-card">


                <div class="phase-modal-header">


                    <div>

                        <span class="section-label">
                            PHASE ACCOMPLISHMENT
                        </span>

                        <h3>
                            Add Milestone
                        </h3>

                        <p id="milestonePhaseName">
                            Add an accomplishment to this phase.
                        </p>

                    </div>


                    <button
                        type="button"
                        class="phase-modal-close"
                        onclick="closeMilestoneModal()"
                    >
                        ×
                    </button>

                </div>



                <form
                    method="POST"
                    action=""
                    class="phase-form"
                    id="milestoneForm"
                >

                    @csrf


                    <div class="phase-form-group">

                        <label>
                            Milestone Name
                            <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="milestone_name"
                            minlength="3"
                            maxlength="255"
                            placeholder="Example: Finalize proposed floor plan"
                            required
                        >

                    </div>



                    <div class="phase-form-grid">


                        <div class="phase-form-group">

                            <label>
                                Starting Status
                                <span>*</span>
                            </label>

                            <select
                                name="status"
                                required
                            >

                                <option value="pending">
                                    Pending
                                </option>

                                <option value="in_progress">
                                    In Progress
                                </option>

                            </select>

                        </div>



                        <div class="phase-form-group">

                            <label>
                                Target Date
                            </label>

                            <input
                                type="date"
                                name="target_date"
                            >

                        </div>

                    </div>



                    <div class="phase-form-group">

                        <label>
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            maxlength="2000"
                            placeholder="Briefly describe what this milestone should accomplish..."
                        ></textarea>

                    </div>



                    <div class="phase-modal-actions">


                        <button
                            type="button"
                            class="phase-cancel-button"
                            onclick="closeMilestoneModal()"
                        >
                            Cancel
                        </button>


                        <button
                            type="submit"
                            class="phase-save-button"
                        >
                            Add Milestone
                        </button>

                    </div>

                </form>

            </div>

        </div>



        <!-- =================================================
            COMPLETE MILESTONE MODAL
        ================================================== -->

        <div
            class="phase-modal"
            id="milestoneCompleteModal"
        >


            <div
                class="phase-modal-backdrop"
                onclick="closeMilestoneCompleteModal()"
            ></div>


            <div class="phase-modal-card">


                <div class="phase-modal-header">


                    <div>

                        <span class="section-label">
                            ACCOMPLISHMENT PROOF
                        </span>

                        <h3>
                            Complete Milestone
                        </h3>

                        <p id="completeMilestoneName">
                            Submit the accomplishment report and proof.
                        </p>

                    </div>


                    <button
                        type="button"
                        class="phase-modal-close"
                        onclick="closeMilestoneCompleteModal()"
                    >
                        ×
                    </button>

                </div>



                <form
                    method="POST"
                    action=""
                    enctype="multipart/form-data"
                    class="phase-form"
                    id="milestoneCompleteForm"
                >

                    @csrf
                    @method('PUT')


                    <input
                        type="hidden"
                        name="status"
                        value="completed"
                    >



                    <div class="phase-form-group">

                        <label>
                            Completion Report
                            <span>*</span>
                        </label>

                        <textarea
                            name="completion_report"
                            rows="6"
                            minlength="20"
                            maxlength="5000"
                            placeholder="Explain what was completed, what was accomplished, and any important result of this milestone..."
                            required
                        ></textarea>

                        <small>
                            Minimum of 20 characters.
                        </small>

                    </div>



                    <div class="phase-form-group">

                        <label>
                            Supporting Proof
                            <span>*</span>
                        </label>


                        <input
                            type="file"
                            name="proof_file"
                            id="milestoneProofFile"
                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                            onchange="validateSelectedUpload(this)"
                            required
                        >


                        <small>
                            JPG, JPEG, PNG, PDF, Word, or Excel file.
                            Up to 100 MB per file. Select multiple files at once.
                        </small>

                    </div>



                    <div class="phase-form-group">

                        <label
                            for="clientCanViewMilestoneProof"
                            style="
                                display: flex;
                                align-items: flex-start;
                                gap: 10px;
                                cursor: pointer;
                            "
                        >

                            <input
                                type="hidden"
                                name="client_can_view"
                                value="0"
                            >

                            <input
                                type="checkbox"
                                name="client_can_view"
                                id="clientCanViewMilestoneProof"
                                value="1"
                                @checked(
                                    old(
                                        'client_can_view',
                                        '1'
                                    ) === '1'
                                )
                                style="
                                    width: 18px;
                                    height: 18px;
                                    margin-top: 2px;
                                    flex: 0 0 auto;
                                "
                            >

                            <span>

                                <strong style="display: block;">
                                    Allow client to view this proof
                                </strong>

                                <small
                                    style="
                                        display: block;
                                        margin-top: 4px;
                                    "
                                >
                                    Uncheck this if the proof should only
                                    be visible to the architect team.
                                </small>

                            </span>

                        </label>

                    </div>



                    <div class="milestone-proof-warning">

                        <strong>
                            Required accomplishment evidence
                        </strong>

                        <span>
                            This milestone will only be marked completed
                            after both the report and proof file are submitted.
                        </span>

                    </div>



                    <div class="phase-modal-actions">


                        <button
                            type="button"
                            class="phase-cancel-button"
                            onclick="closeMilestoneCompleteModal()"
                        >
                            Cancel
                        </button>


                        <button
                            type="submit"
                            class="phase-save-button"
                        >
                            Submit & Complete
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </section>



    <!-- =================================================
        PHASE / MILESTONE JAVASCRIPT
    ================================================== -->

    <script>

        /*
        |--------------------------------------------------------------------------
        | ADD MILESTONE MODAL
        |--------------------------------------------------------------------------
        */

        function openMilestoneModal(
            phaseId,
            phaseName
        ) {
            const modal =
                document.getElementById(
                    'milestoneModal'
                );


            const form =
                document.getElementById(
                    'milestoneForm'
                );


            const label =
                document.getElementById(
                    'milestonePhaseName'
                );


            if (
                !modal
                ||
                !form
            ) {
                return;
            }


            form.action =
                "{{ url('/architect/projects/' . $project->id . '/phases') }}"
                +
                '/'
                +
                phaseId
                +
                '/milestones';


            if (label) {

                label.textContent =
                    'Add an accomplishment under '
                    +
                    phaseName
                    +
                    '.';
            }


            modal.classList.add(
                'show'
            );


            document.body.classList.add(
                'modal-open'
            );
        }



        function closeMilestoneModal()
        {
            const modal =
                document.getElementById(
                    'milestoneModal'
                );


            if (!modal) {
                return;
            }


            modal.classList.remove(
                'show'
            );


            document.body.classList.remove(
                'modal-open'
            );
        }



        /*
        |--------------------------------------------------------------------------
        | COMPLETE MILESTONE MODAL
        |--------------------------------------------------------------------------
        */

        function openMilestoneCompleteModal(
            phaseId,
            milestoneId,
            milestoneName
        ) {
            const modal =
                document.getElementById(
                    'milestoneCompleteModal'
                );


            const form =
                document.getElementById(
                    'milestoneCompleteForm'
                );


            const label =
                document.getElementById(
                    'completeMilestoneName'
                );


            if (
                !modal
                ||
                !form
            ) {
                return;
            }


            form.action =
                "{{ url('/architect/projects/' . $project->id . '/phases') }}"
                +
                '/'
                +
                phaseId
                +
                '/milestones/'
                +
                milestoneId;


            if (label) {

                label.textContent =
                    milestoneName
                    +
                    ' — submit the completion report and supporting proof.';
            }


            modal.classList.add(
                'show'
            );


            document.body.classList.add(
                'modal-open'
            );
        }



        function closeMilestoneCompleteModal()
        {
            const modal =
                document.getElementById(
                    'milestoneCompleteModal'
                );


            if (!modal) {
                return;
            }


            modal.classList.remove(
                'show'
            );


            document.body.classList.remove(
                'modal-open'
            );
        }



        /*
        |--------------------------------------------------------------------------
        | ESCAPE KEY
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key ===
                    'Escape'
                ) {

                    closeMilestoneModal();

                    closeMilestoneCompleteModal();
                }
            }
        );

    </script>

@endif


        <!-- =================================================
            FILES
        ================================================== -->

        @if($activeTab === 'files')

            <section class="tab-panel">


                <div class="section-header">


                    <div>

                        <span class="section-label">
                            FILE MANAGEMENT
                        </span>

                        <h2>
                            Project Files
                        </h2>

                        <p>
                            Upload and organize architectural drawings,
                            documents and other project files.
                        </p>

                    </div>


                    @if(!$showArchived)

                        <button
                            type="button"
                            class="orange-button"
                            onclick="openUploadModal()"
                        >
                            + Upload File
                        </button>

                    @endif

                </div>



                <div class="files-view-switch">


                    <a
                        href="{{ route(
                            'architect.projects.show',
                            ['id' => $project->id]
                        ) }}?tab=files"
                        class="{{ !$showArchived ? 'active' : '' }}"
                    >

                        Active Files

                        <span>
                            {{ $activeFiles->count() }}
                        </span>

                    </a>


                    <a
                        href="{{ route(
                            'architect.projects.show',
                            ['id' => $project->id]
                        ) }}?tab=files&view=archived"
                        class="{{ $showArchived ? 'active' : '' }}"
                    >

                        Archived

                        <span>
                            {{ $archivedFiles->count() }}
                        </span>

                    </a>

                </div>



                @if(session('success'))

                    <div class="success-message">


                        <div class="success-icon">
                            ✓
                        </div>


                        <div>

                            <strong>
                                Success
                            </strong>

                            <span>
                                {{ session('success') }}
                            </span>

                        </div>

                    </div>

                @endif



                @if($errors->any())

                    <div class="file-error-message">


                        <strong>
                            Please check the following:
                        </strong>


                        <ul>

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif



                @if($displayFiles->count() > 0)


                    <div class="file-summary-row">


                        <div class="file-summary-card">

                            <span>

                                {{ $showArchived
                                    ? 'ARCHIVED FILES'
                                    : 'ACTIVE FILES'
                                }}

                            </span>

                            <strong>
                                {{ $displayFiles->count() }}
                            </strong>

                            <p>

                                {{ $showArchived
                                    ? 'Files stored in archive'
                                    : 'Current project files'
                                }}

                            </p>

                        </div>



                        <div class="file-summary-card">

                            <span>
                                DRAWINGS
                            </span>

                            <strong>

                                {{ $displayFiles
                                    ->where(
                                        'category',
                                        'drawing'
                                    )
                                    ->count()
                                }}

                            </strong>

                            <p>
                                Architectural drawings
                            </p>

                        </div>



                        <div class="file-summary-card">

                            <span>
                                DOCUMENTS
                            </span>

                            <strong>

                                {{ $displayFiles
                                    ->where(
                                        'category',
                                        'document'
                                    )
                                    ->count()
                                }}

                            </strong>

                            <p>
                                Project documents
                            </p>

                        </div>



                        <div class="file-summary-card">

                            <span>
                                OTHER FILES
                            </span>

                            <strong>

                                {{ $displayFiles
                                    ->whereNotIn(
                                        'category',
                                        [
                                            'drawing',
                                            'document'
                                        ]
                                    )
                                    ->count()
                                }}

                            </strong>

                            <p>
                                References and other files
                            </p>

                        </div>

                    </div>



                    <div class="file-list-card">


                        <div class="file-list-header">


                            <div>

                                <span class="section-label">

                                    {{ $showArchived
                                        ? 'ARCHIVED LIBRARY'
                                        : 'PROJECT LIBRARY'
                                    }}

                                </span>

                                <h3>

                                    {{ $showArchived
                                        ? 'Archived Files'
                                        : 'Uploaded Files'
                                    }}

                                </h3>

                            </div>


                            <span class="file-count">

                                {{ $displayFiles->count() }}

                                {{ $displayFiles->count() === 1
                                    ? 'File'
                                    : 'Files'
                                }}

                            </span>

                        </div>



                        <div class="file-table-wrapper">


                            <table class="file-table">


                                <thead>

                                    <tr>

                                        <th>
                                            File
                                        </th>

                                        <th>
                                            Category
                                        </th>

                                        <th>
                                            Size
                                        </th>

                                        <th>
                                            Uploaded By
                                        </th>

                                        <th>
                                            Date
                                        </th>

                                        <th class="actions-column">
                                            Actions
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>


                                @foreach(
                                    $displayFiles
                                        ->sortByDesc('created_at')
                                    as $file
                                )


                                    @php

                                        $extension =
                                            strtolower(
                                                $file->file_type
                                                ?? ''
                                            );


                                        $fileSize =
                                            $file->file_size
                                            ?? 0;


                                        if (
                                            $fileSize >= 1073741824
                                        ) {

                                            $formattedSize =
                                                number_format(
                                                    $fileSize
                                                    / 1073741824,
                                                    2
                                                )
                                                . ' GB';

                                        } elseif (
                                            $fileSize >= 1048576
                                        ) {

                                            $formattedSize =
                                                number_format(
                                                    $fileSize
                                                    / 1048576,
                                                    2
                                                )
                                                . ' MB';

                                        } elseif (
                                            $fileSize >= 1024
                                        ) {

                                            $formattedSize =
                                                number_format(
                                                    $fileSize
                                                    / 1024,
                                                    1
                                                )
                                                . ' KB';

                                        } else {

                                            $formattedSize =
                                                $fileSize
                                                . ' B';
                                        }

                                    @endphp



                                    <tr
                                        class="
                                            {{ $file->is_archived
                                                ? 'archived-file-row'
                                                : ''
                                            }}
                                        "
                                    >


                                        <!-- FILE -->
                                        <td>

                                            <div class="file-information">


                                                <div
                                                    class="
                                                        file-type-icon
                                                        file-type-{{ $extension }}
                                                    "
                                                >


                                                    @if($extension === 'pdf')

                                                        <span>
                                                            PDF
                                                        </span>


                                                    @elseif(
                                                        in_array(
                                                            $extension,
                                                            ['dwg', 'dxf']
                                                        )
                                                    )

                                                        <span>
                                                            CAD
                                                        </span>


                                                    @elseif(
                                                        in_array(
                                                            $extension,
                                                            ['doc', 'docx']
                                                        )
                                                    )

                                                        <span>
                                                            DOC
                                                        </span>


                                                    @elseif(
                                                        in_array(
                                                            $extension,
                                                            ['xls', 'xlsx']
                                                        )
                                                    )

                                                        <span>
                                                            XLS
                                                        </span>


                                                    @elseif(
                                                        in_array(
                                                            $extension,
                                                            [
                                                                'jpg',
                                                                'jpeg',
                                                                'png',
                                                                'webp'
                                                            ]
                                                        )
                                                    )

                                                        <svg viewBox="0 0 24 24">

                                                            <rect
                                                                x="3"
                                                                y="4"
                                                                width="18"
                                                                height="16"
                                                                rx="2"
                                                            />

                                                            <circle
                                                                cx="9"
                                                                cy="10"
                                                                r="2"
                                                            />

                                                            <path d="M21 15l-5-5L5 20"/>

                                                        </svg>


                                                    @else

                                                        <svg viewBox="0 0 24 24">

                                                            <path d="M5 3h9l5 5v13H5z"/>

                                                            <path d="M14 3v6h6"/>

                                                        </svg>

                                                    @endif

                                                </div>



                                                <div class="file-name-area">

                                                    <div class="file-name-version-row">
                                                        <strong>{{ $file->original_name }}</strong>
                                                        <span class="file-version-badge">V{{ $file->version_number ?? 1 }}</span>
                                                        @if($file->is_latest)
                                                            <span class="file-latest-badge">Latest</span>
                                                        @endif
                                                    </div>

                                                    <span>
                                                        {{ $file->description
                                                            ?: strtoupper(
                                                                $extension
                                                                ?: 'FILE'
                                                            )
                                                        }}
                                                    </span>

                                                </div>

                                            </div>

                                        </td>



                                        <td>

                                            <span class="category-badge">

                                                {{ ucwords(
                                                    str_replace(
                                                        '_',
                                                        ' ',
                                                        $file->category
                                                    )
                                                ) }}

                                            </span>

                                        </td>



                                        <td>

                                            <span class="file-size">
                                                {{ $formattedSize }}
                                            </span>

                                        </td>



                                        <td>

                                            <div class="uploader-info">


                                                <div class="uploader-avatar">

                                                    {{ strtoupper(
                                                        substr(
                                                            $file
                                                                ->uploader
                                                                ->name
                                                                ?? 'U',
                                                            0,
                                                            1
                                                        )
                                                    ) }}

                                                </div>


                                                <div class="uploader-copy">

                                                    <strong>

                                                        {{ $file
                                                            ->uploader
                                                            ->name
                                                            ?? 'Unknown User'
                                                        }}

                                                    </strong>

                                                    <span>

                                                        {{ ucfirst(
                                                            $file
                                                                ->uploader
                                                                ->role
                                                                ?? 'User'
                                                        ) }}

                                                    </span>

                                                </div>

                                            </div>

                                        </td>



                                        <td>

                                            <div class="upload-date">

                                                <strong>

                                                    {{ $file
                                                        ->created_at
                                                        ->format('M d, Y')
                                                    }}

                                                </strong>

                                                <span>

                                                    {{ $file
                                                        ->created_at
                                                        ->format('h:i A')
                                                    }}

                                                </span>

                                            </div>

                                        </td>



                                        <td>

                                            <div class="file-actions">


                                                <!-- DOWNLOAD -->
                                                <a
                                                    href="{{ route(
                                                        'architect.projects.files.download',
                                                        [
                                                            'id' =>
                                                                $project->id,

                                                            'file' =>
                                                                $file->id
                                                        ]
                                                    ) }}"
                                                    class="
                                                        file-action-btn
                                                        download-btn
                                                    "
                                                    title="Download File"
                                                >

                                                    <svg viewBox="0 0 24 24">

                                                        <path d="M12 3v12"/>
                                                        <path d="M7 10l5 5 5-5"/>
                                                        <path d="M5 20h14"/>

                                                    </svg>

                                                </a>



                                                @if(!$file->is_archived)

                                                    @if($file->is_latest)
                                                        <!-- UPLOAD NEW VERSION -->
                                                        <button
                                                            type="button"
                                                            class="file-action-btn version-btn"
                                                            title="Upload New Version"
                                                            onclick="openVersionModal({{ $file->id }}, @js($file->original_name), {{ $file->version_number ?? 1 }})"
                                                        >
                                                            <svg viewBox="0 0 24 24">
                                                                <path d="M12 16V4"/>
                                                                <path d="M7 9l5-5 5 5"/>
                                                                <path d="M5 20h14"/>
                                                            </svg>
                                                        </button>
                                                    @endif

                                                    <!-- ARCHIVE -->
                                                    <form
                                                        method="POST"
                                                        action="{{ route(
                                                            'architect.projects.files.archive',
                                                            [
                                                                'id' =>
                                                                    $project->id,

                                                                'file' =>
                                                                    $file->id
                                                            ]
                                                        ) }}"
                                                    >

                                                        @csrf


                                                        <button
                                                            type="submit"
                                                            class="
                                                                file-action-btn
                                                                archive-btn
                                                            "
                                                            title="Archive File"
                                                        >

                                                            <svg viewBox="0 0 24 24">

                                                                <rect
                                                                    x="4"
                                                                    y="5"
                                                                    width="16"
                                                                    height="4"
                                                                    rx="1"
                                                                />

                                                                <path d="M6 9v10h12V9"/>

                                                                <path d="M10 13h4"/>

                                                            </svg>

                                                        </button>

                                                    </form>


                                                @else


                                                    <!-- RESTORE -->
                                                    <form
                                                        method="POST"
                                                        action="{{ route(
                                                            'architect.projects.files.restore',
                                                            [
                                                                'id' =>
                                                                    $project->id,

                                                                'file' =>
                                                                    $file->id
                                                            ]
                                                        ) }}"
                                                    >

                                                        @csrf


                                                        <button
                                                            type="submit"
                                                            class="
                                                                file-action-btn
                                                                restore-btn
                                                            "
                                                            title="Restore File"
                                                        >

                                                            <svg viewBox="0 0 24 24">

                                                                <path d="M4 9a8 8 0 1 1 2 8"/>

                                                                <path d="M4 4v5h5"/>

                                                            </svg>

                                                        </button>

                                                    </form>



                                                    <!-- DELETE -->
                                                    <form
                                                        method="POST"
                                                        action="{{ route(
                                                            'architect.projects.files.destroy',
                                                            [
                                                                'id' =>
                                                                    $project->id,

                                                                'file' =>
                                                                    $file->id
                                                            ]
                                                        ) }}"
                                                        onsubmit="
                                                            return confirm(
                                                                'Permanently delete this file?'
                                                            );
                                                        "
                                                    >

                                                        @csrf
                                                        @method('DELETE')


                                                        <button
                                                            type="submit"
                                                            class="
                                                                file-action-btn
                                                                delete-btn
                                                            "
                                                            title="Delete Permanently"
                                                        >

                                                            <svg viewBox="0 0 24 24">

                                                                <path d="M4 7h16"/>

                                                                <path d="M9 7V4h6v3"/>

                                                                <path d="M7 7l1 14h8l1-14"/>

                                                            </svg>

                                                        </button>

                                                    </form>


                                                @endif

                                            </div>

                                        </td>

                                    </tr>


                                @endforeach


                                </tbody>

                            </table>

                        </div>

                    </div>



                @elseif(!$showArchived)


                    <!-- EMPTY ACTIVE FILES -->

                    <div class="files-empty-panel">


                        <div class="files-visual-area">


                            <div class="files-visual-grid"></div>

                            <div class="files-soft-circle"></div>


                            <img
                                src="{{ asset('images/lineart2.png') }}"
                                alt=""
                                class="files-lineart"
                            >


                            <div class="floating-file floating-pdf">
                                <span>PDF</span>
                            </div>


                            <div class="floating-file floating-doc">

                                <svg viewBox="0 0 24 24">

                                    <path d="M6 3h8l4 4v14H6z"/>

                                    <path d="M14 3v5h5"/>

                                    <path d="M9 12h6"/>

                                </svg>

                            </div>


                            <div class="floating-file floating-sheet">
                                <span>XLS</span>
                            </div>


                            <div class="floating-file floating-folder">

                                <svg viewBox="0 0 24 24">
                                    <path d="M3 7h6l2 2h10v10H3z"/>
                                </svg>

                            </div>


                            <div class="orbit-line orbit-one"></div>

                            <div class="orbit-line orbit-two"></div>

                        </div>



                        <div class="files-empty-content">


                            <div class="files-folder-main">

                                <svg viewBox="0 0 24 24">
                                    <path d="M3 7h6l2 2h10v10H3z"/>
                                </svg>

                            </div>


                            <span class="files-small-label">
                                PROJECT FILES
                            </span>


                            <h3>
                                No files uploaded yet
                            </h3>


                            <p>
                                Upload architectural drawings,
                                design documents, presentations,
                                references, and other files related
                                to this project.
                            </p>


                            <button
                                type="button"
                                class="files-upload-first"
                                onclick="openUploadModal()"
                            >

                                <svg viewBox="0 0 24 24">

                                    <path d="M12 3v12"/>
                                    <path d="M7 8l5-5 5 5"/>
                                    <path d="M5 17v3h14v-3"/>

                                </svg>

                                Upload First File

                            </button>

                        </div>

                    </div>



                @else


                    <!-- EMPTY ARCHIVE -->

                    <div class="archive-empty-state">


                        <div class="archive-empty-icon">

                            <svg viewBox="0 0 24 24">

                                <rect
                                    x="4"
                                    y="5"
                                    width="16"
                                    height="4"
                                    rx="1"
                                />

                                <path d="M6 9v10h12V9"/>

                                <path d="M10 13h4"/>

                            </svg>

                        </div>


                        <span class="section-label">
                            ARCHIVED FILES
                        </span>


                        <h3>
                            Archive is empty
                        </h3>


                        <p>
                            Files that you archive will appear here.
                        </p>


                        <a
                            href="{{ route(
                                'architect.projects.show',
                                ['id' => $project->id]
                            ) }}?tab=files"
                            class="archive-back-button"
                        >
                            View Active Files
                        </a>

                    </div>


                @endif



                <!-- =================================================
                    FILE UPLOAD MODAL
                ================================================== -->

                <div
                    class="upload-modal"
                    id="uploadModal"
                >


                    <div
                        class="upload-modal-backdrop"
                        onclick="closeUploadModal()"
                    ></div>


                    <div class="upload-modal-card">


                        <div class="upload-modal-header">


                            <div>

                                <span class="section-label">
                                    PROJECT FILE
                                </span>

                                <h3>
                                    Upload File
                                </h3>

                                <p>
                                    Add a file to
                                    {{ $project->project_name }}.
                                </p>

                            </div>


                            <button
                                type="button"
                                class="modal-close"
                                onclick="closeUploadModal()"
                            >
                                ×
                            </button>

                        </div>



                        <form
                            method="POST"
                            action="{{ route(
                                'architect.projects.files.store',
                                ['id' => $project->id]
                            ) }}"
                            enctype="multipart/form-data"
                            class="upload-form"
                            id="newProjectFilesForm"
                        >

                            @csrf
                            @if ($errors->any())
                                <div role="alert" style="padding:12px 14px;margin-bottom:14px;background:#fff2ec;color:#9c351d;border:1px solid #f3c7b4;border-radius:8px;">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <div class="upload-form-group">

                                <label>
                                    File
                                    <span>*</span>
                                </label>


                                <div class="upload-drop-area">


                                    <input
                                        type="file"
                                        multiple
                                        name="files[]"
                                        id="projectFileInput"
                                        required
                                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                                        onchange="if (validateSelectedUpload(this)) showSelectedFile()"
                                    >


                                    <label
                                        for="projectFileInput"
                                        class="upload-drop-label"
                                    >


                                        <div class="upload-icon">

                                            <svg viewBox="0 0 24 24">

                                                <path d="M12 3v12"/>

                                                <path d="M7 8l5-5 5 5"/>

                                                <path d="M5 17v3h14v-3"/>

                                            </svg>

                                        </div>


                                        <strong id="selectedFileName">
                                            Choose Project Files
                                        </strong>


                                        <span id="selectedFileText">
                                            Click to select multiple files
                                        </span>


                                        <small>
                                            JPG, JPEG, PNG, PDF, Word, or Excel only.
                                            Up to 100 MB per file. Select multiple files at once.
                                        </small>

                                    </label>

                                </div>

                            </div>



                            <div class="upload-form-group">


                                <label for="category">

                                    File Category

                                    <span>*</span>

                                </label>


                                <select
                                    name="category"
                                    id="category"
                                    required
                                >

                                    <option value="general">
                                        General
                                    </option>

                                    <option value="drawing">
                                        Architectural Drawing
                                    </option>

                                    <option value="document">
                                        Document
                                    </option>

                                    <option value="presentation">
                                        Presentation
                                    </option>

                                    <option value="reference">
                                        Reference
                                    </option>

                                    <option value="other">
                                        Other
                                    </option>

                                </select>

                            </div>



                            <div class="upload-form-group">

                                <label for="file_description">
                                    Description
                                </label>


                                <textarea
                                    name="description"
                                    id="file_description"
                                    rows="4"
                                    maxlength="500"
                                    placeholder="Optional description of this file..."
                                ></textarea>

                            </div>



                            <div class="upload-form-actions">


                                <button
                                    type="button"
                                    class="modal-cancel"
                                    onclick="closeUploadModal()"
                                >
                                    Cancel
                                </button>


                                <button
                                    type="submit"
                                    class="modal-upload"
                                >
                                    Upload Selected Files
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

                <!-- =================================================
                    UPLOAD NEW VERSION MODAL
                ================================================== -->
                <div class="upload-modal" id="versionModal">
                    <div class="upload-modal-backdrop" onclick="closeVersionModal()"></div>

                    <div class="upload-modal-card">
                        <div class="upload-modal-header">
                            <div>
                                <span class="section-label">FILE VERSION</span>
                                <h3>Upload New Version</h3>
                                <p id="versionModalDescription">Upload a revised version of this project file.</p>
                            </div>
                            <button type="button" class="modal-close" onclick="closeVersionModal()">×</button>
                        </div>

                        <div class="version-current-file">
                            <span>CURRENT FILE</span>
                            <strong id="versionCurrentFileName">Project File</strong>
                            <small id="versionCurrentNumber">Current version: V1</small>
                        </div>

                        <form method="POST" action="" enctype="multipart/form-data" class="upload-form" id="versionUploadForm">
                            @csrf

                            <div class="upload-form-group">
                                <label>New Version File <span>*</span></label>
                                <div class="upload-drop-area">
                                    <input
                                        type="file"
                                        name="file"
                                        id="versionFileInput"
                                        required
                                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                                        onchange="if (validateSelectedUpload(this)) showSelectedVersionFile()"
                                    >
                                    <label for="versionFileInput" class="upload-drop-label">
                                        <div class="upload-icon">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M12 3v12"/>
                                                <path d="M7 8l5-5 5 5"/>
                                                <path d="M5 17v3h14v-3"/>
                                            </svg>
                                        </div>
                                        <strong id="selectedVersionFileName">Choose Revised File</strong>
                                        <span id="selectedVersionFileText">Click here to browse your computer</span>
                                        <small>JPG, JPEG, PNG, PDF, Word, or Excel only. Up to 100 MB per file. Upload one revised file (100 MB maximum).</small>
                                    </label>
                                </div>
                            </div>

                            <div class="upload-form-group">
                                <label for="version_description">Version Description</label>
                                <textarea
                                    name="description"
                                    id="version_description"
                                    rows="4"
                                    maxlength="500"
                                    placeholder="Optional note about what changed in this version..."
                                ></textarea>
                            </div>

                            <div class="version-upload-note">
                                <strong>Version history will be preserved.</strong>
                                <span>The current file will remain available as an older version and this upload will become the latest version.</span>
                            </div>

                            <div class="upload-form-actions">
                                <button type="button" class="modal-cancel" onclick="closeVersionModal()">Cancel</button>
                                <button type="submit" class="modal-upload">Upload New Version</button>
                            </div>
                        </form>
                    </div>
                </div>

            </section>

        @endif



        <!-- =================================================
            MESSAGES
        ================================================== -->

        @if($activeTab === 'messages')

            <section
                class="tab-panel"
                id="project-chat"
            >

                <style>
                    /* =========================================================
                       ARCHITRACK PROJECT MESSAGES — COMPACT REDESIGN
                    ========================================================= */

                    #project-chat {
                        --chat-orange: #f36f21;
                        --chat-ink: #252a30;
                        --chat-muted: #7b858d;
                        --chat-line: #dedbd5;
                        --chat-paper: #fffdfa;
                        --chat-soft: #f7f4ee;
                    }

                    /* Two-column workspace:
                       left = client + AI activity
                       right = conversation
                    */
                    #project-chat .messenger-layout {
                        display: grid !important;
                        grid-template-columns: 290px minmax(0, 1fr) !important;
                        grid-template-areas:
                            "client chat"
                            "ai     chat" !important;
                        align-items: start !important;
                        gap: 18px !important;
                        width: 100% !important;
                    }

                    #project-chat .chat-sidebar {
                        grid-area: client !important;
                        width: 100% !important;
                        min-width: 0 !important;
                        height: auto !important;
                        align-self: start !important;
                        padding: 22px !important;
                        border: 1px solid var(--chat-line) !important;
                        border-radius: 18px !important;
                        background: var(--chat-soft) !important;
                    }

                    #project-chat .client-ai-panel {
                        grid-area: ai !important;
                        width: 100% !important;
                        min-width: 0 !important;
                        height: auto !important;
                        max-height: 520px !important;
                        overflow-y: auto !important;
                        align-self: start !important;
                        padding: 20px !important;
                        border: 1px solid var(--chat-line) !important;
                        border-radius: 18px !important;
                        background: var(--chat-paper) !important;
                    }

                    #project-chat .chat-main {
                        grid-area: chat !important;
                        width: 100% !important;
                        min-width: 0 !important;
                        height: auto !important;
                        min-height: 650px !important;
                        overflow: hidden !important;
                        border: 1px solid var(--chat-line) !important;
                        border-radius: 18px !important;
                        background: var(--chat-paper) !important;
                        display: flex !important;
                        flex-direction: column !important;
                    }

                    /* Left client card */
                    #project-chat .chat-sidebar-heading {
                        margin-bottom: 16px !important;
                    }

                    #project-chat .chat-sidebar-heading h3 {
                        margin: 7px 0 0 !important;
                        font-size: 21px !important;
                        line-height: 1.2 !important;
                    }

                    #project-chat .chat-client-card {
                        display: flex !important;
                        align-items: center !important;
                        gap: 12px !important;
                        padding: 16px 0 !important;
                        margin: 0 !important;
                        border-top: 1px solid var(--chat-line) !important;
                        border-bottom: 1px solid var(--chat-line) !important;
                    }

                    #project-chat .chat-client-avatar {
                        width: 46px !important;
                        height: 46px !important;
                        min-width: 46px !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        border-radius: 8px !important;
                        font-size: 16px !important;
                    }

                    #project-chat .chat-client-info {
                        min-width: 0 !important;
                    }

                    #project-chat .chat-client-info strong {
                        display: block !important;
                        overflow: hidden !important;
                        text-overflow: ellipsis !important;
                        white-space: nowrap !important;
                    }

                    #project-chat .chat-client-details {
                        padding: 16px 0 4px !important;
                    }

                    #project-chat .chat-detail {
                        margin-bottom: 13px !important;
                    }

                    #project-chat .chat-detail strong {
                        display: block !important;
                        margin-top: 4px !important;
                        font-size: 13px !important;
                        overflow-wrap: anywhere !important;
                    }

                    #project-chat .chat-info-box {
                        margin-top: 8px !important;
                        padding: 12px !important;
                    }

                    /* AI activity compact */
                    #project-chat .client-ai-header {
                        display: block !important;
                        padding-bottom: 14px !important;
                        margin-bottom: 14px !important;
                        border-bottom: 1px solid var(--chat-line) !important;
                    }

                    #project-chat .client-ai-header h3 {
                        margin: 6px 0 5px !important;
                        font-size: 20px !important;
                    }

                    #project-chat .client-ai-header p {
                        margin: 0 !important;
                        font-size: 14px !important;
                        line-height: 1.55 !important;
                    }

                    #project-chat .client-ai-section {
                        padding: 14px 0 !important;
                    }

                    #project-chat .client-ai-section-title {
                        margin-bottom: 10px !important;
                    }

                    #project-chat .client-ai-section img {
                        max-width: 100% !important;
                        height: auto !important;
                        border-radius: 10px !important;
                    }

                    /* Conversation header */
                    #project-chat .chat-header {
                        flex: 0 0 auto !important;
                        min-height: 78px !important;
                        padding: 16px 20px !important;
                        border-bottom: 1px solid var(--chat-line) !important;
                    }

                    #project-chat .chat-header-avatar {
                        width: 42px !important;
                        height: 42px !important;
                        min-width: 42px !important;
                    }

                    /* Conversation scroll area */
                    #project-chat .chat-body {
                        flex: 1 1 auto !important;
                        height: 480px !important;
                        min-height: 480px !important;
                        max-height: 480px !important;
                        overflow-y: auto !important;
                        overflow-x: hidden !important;
                        padding: 22px 24px !important;
                        scroll-behavior: smooth !important;
                    }

                    /* Each message should stay readable and not stretch full width */
                    #project-chat .chat-message-row {
                        width: 100% !important;
                        display: flex !important;
                        align-items: flex-end !important;
                        gap: 9px !important;
                        margin: 0 0 18px !important;
                    }

                    #project-chat .chat-message-row.message-client {
                        justify-content: flex-start !important;
                    }

                    #project-chat .chat-message-row.message-mine {
                        justify-content: flex-end !important;
                    }

                    #project-chat .message-user-avatar {
                        width: 32px !important;
                        height: 32px !important;
                        min-width: 32px !important;
                        border-radius: 7px !important;
                        font-size: 13px !important;
                    }

                    #project-chat .message-mine .message-user-avatar {
                        order: 2 !important;
                    }

                    #project-chat .message-content {
                        width: auto !important;
                        max-width: min(68%, 620px) !important;
                        min-width: 0 !important;
                    }

                    #project-chat .message-mine .message-content {
                        display: flex !important;
                        flex-direction: column !important;
                        align-items: flex-end !important;
                    }

                    #project-chat .message-client .message-content {
                        display: flex !important;
                        flex-direction: column !important;
                        align-items: flex-start !important;
                    }

                    #project-chat .message-sender {
                        margin: 0 4px 5px !important;
                        font-size: 13px !important;
                    }

                    #project-chat .message-bubble {
                        width: auto !important;
                        max-width: 100% !important;
                        min-width: 54px !important;
                        padding: 11px 14px !important;
                        border-radius: 15px !important;
                        overflow: hidden !important;
                        box-shadow: none !important;
                    }

                    #project-chat .message-client .message-bubble {
                        border: 1px solid #ddd9d2 !important;
                        background: #ffffff !important;
                        border-bottom-left-radius: 5px !important;
                    }

                    #project-chat .message-mine .message-bubble {
                        border: 1px solid var(--chat-orange) !important;
                        background: var(--chat-orange) !important;
                        color: #ffffff !important;
                        border-bottom-right-radius: 5px !important;
                    }

                    #project-chat .message-text {
                        margin: 0 !important;
                        font-size: 14px !important;
                        line-height: 1.55 !important;
                        overflow-wrap: anywhere !important;
                    }

                    /* Critical fix: image attachments no longer dominate chat */
                    #project-chat .message-image-link {
                        display: block !important;
                        width: auto !important;
                        max-width: 360px !important;
                        margin: 0 !important;
                        padding: 0 !important;
                        overflow: hidden !important;
                        border-radius: 11px !important;
                    }

                    #project-chat .message-attached-image {
                        display: block !important;
                        width: auto !important;
                        max-width: 360px !important;
                        max-height: 270px !important;
                        object-fit: cover !important;
                        border-radius: 10px !important;
                    }

                    #project-chat .message-file-card {
                        width: min(340px, 100%) !important;
                        max-width: 100% !important;
                    }

                    #project-chat .message-meta {
                        margin: 5px 4px 0 !important;
                        font-size: 12px !important;
                    }

                    #project-chat .message-mine .message-meta {
                        justify-content: flex-end !important;
                    }

                    #project-chat .chat-date-divider {
                        margin: 18px 0 !important;
                    }

                    /* Composer always belongs directly under conversation */
                    #project-chat .chat-composer {
                        flex: 0 0 auto !important;
                        width: 100% !important;
                        padding: 14px 16px !important;
                        border-top: 1px solid var(--chat-line) !important;
                        background: #fbfaf7 !important;
                    }

                    #project-chat .message-form {
                        width: 100% !important;
                        display: grid !important;
                        grid-template-columns: 48px minmax(0, 1fr) auto !important;
                        align-items: stretch !important;
                        gap: 10px !important;
                    }

                    #project-chat .message-attach-button {
                        width: 48px !important;
                        min-width: 48px !important;
                        height: 48px !important;
                        align-self: end !important;
                        margin: 0 !important;
                        border-radius: 10px !important;
                    }

                    #project-chat .message-input-wrapper {
                        width: 100% !important;
                        min-width: 0 !important;
                        margin: 0 !important;
                    }

                    #project-chat .message-input-wrapper textarea {
                        width: 100% !important;
                        min-height: 46px !important;
                        max-height: 130px !important;
                        padding: 12px 14px !important;
                        resize: none !important;
                    }

                    #project-chat .message-input-bottom {
                        padding: 5px 12px 7px !important;
                    }

                    #project-chat .message-send-button {
                        min-width: 102px !important;
                        height: 48px !important;
                        align-self: end !important;
                        margin: 0 !important;
                        padding: 0 18px !important;
                        border-radius: 10px !important;
                    }

                    /* Responsive */
                    @media (max-width: 1100px) {
                        #project-chat .messenger-layout {
                            grid-template-columns: 250px minmax(0, 1fr) !important;
                        }

                        #project-chat .message-content {
                            max-width: 76% !important;
                        }
                    }

                    @media (max-width: 820px) {
                        #project-chat .messenger-layout {
                            display: flex !important;
                            flex-direction: column !important;
                        }

                        #project-chat .chat-sidebar,
                        #project-chat .client-ai-panel,
                        #project-chat .chat-main {
                            width: 100% !important;
                        }

                        #project-chat .chat-main {
                            order: 1 !important;
                        }

                        #project-chat .chat-sidebar {
                            order: 2 !important;
                        }

                        #project-chat .client-ai-panel {
                            order: 3 !important;
                            max-height: none !important;
                        }

                        #project-chat .chat-body {
                            height: 440px !important;
                            min-height: 440px !important;
                            max-height: 440px !important;
                            padding: 18px 14px !important;
                        }

                        #project-chat .message-content {
                            max-width: 84% !important;
                        }

                        #project-chat .message-image-link,
                        #project-chat .message-attached-image {
                            max-width: 280px !important;
                        }

                        #project-chat .message-form {
                            grid-template-columns: 44px minmax(0, 1fr) !important;
                        }

                        #project-chat .message-send-button {
                            grid-column: 1 / -1 !important;
                            width: 100% !important;
                        }
                    }

                    /* =========================================================
                       COMPLETE MESSAGES REDESIGN V2
                       Clean architectural messenger
                    ========================================================= */

                    #project-chat {
                        padding: 0 !important;
                        background: transparent !important;
                    }

                    #project-chat .messages-page-header {
                        display: flex !important;
                        align-items: center !important;
                        justify-content: space-between !important;
                        gap: 24px !important;
                        margin: 0 0 18px !important;
                        padding: 0 2px 18px !important;
                        border-bottom: 1px solid #dedbd4 !important;
                    }

                    #project-chat .messages-page-header h2 {
                        margin: 5px 0 5px !important;
                        font-size: 27px !important;
                        line-height: 1.15 !important;
                        letter-spacing: -.035em !important;
                    }

                    #project-chat .messages-page-header p {
                        margin: 0 !important;
                        font-size: 13px !important;
                        color: #707981 !important;
                    }

                    #project-chat .messenger-layout {
                        display: grid !important;
                        grid-template-columns: 265px minmax(0, 1fr) !important;
                        grid-template-rows: auto auto !important;
                        grid-template-areas:
                            "client chat"
                            "ai chat" !important;
                        gap: 14px !important;
                        padding: 0 !important;
                        background: transparent !important;
                    }

                    /* LEFT PROFILE */
                    #project-chat .chat-sidebar {
                        grid-area: client !important;
                        position: static !important;
                        padding: 0 !important;
                        overflow: hidden !important;
                        border: 1px solid #dedbd4 !important;
                        border-radius: 14px !important;
                        background: #fffdfa !important;
                        box-shadow: 0 8px 24px rgba(42, 37, 32, .035) !important;
                    }

                    #project-chat .chat-sidebar-heading {
                        padding: 18px 18px 14px !important;
                        margin: 0 !important;
                        background: #f6f2eb !important;
                        border-bottom: 1px solid #e3dfd8 !important;
                    }

                    #project-chat .chat-sidebar-heading .section-label {
                        font-size: 12px !important;
                        letter-spacing: .13em !important;
                    }

                    #project-chat .chat-sidebar-heading h3 {
                        margin: 5px 0 0 !important;
                        font-size: 17px !important;
                        font-weight: 800 !important;
                    }

                    #project-chat .chat-client-card {
                        margin: 0 !important;
                        padding: 17px 18px !important;
                        border: 0 !important;
                        background: #fffdfa !important;
                    }

                    #project-chat .chat-client-avatar {
                        width: 42px !important;
                        height: 42px !important;
                        min-width: 42px !important;
                        border-radius: 50% !important;
                        background: #f36f21 !important;
                        color: white !important;
                    }

                    #project-chat .chat-client-info strong {
                        font-size: 14px !important;
                    }

                    #project-chat .chat-client-info span {
                        font-size: 13px !important;
                        color: #8b9297 !important;
                    }

                    #project-chat .chat-client-details {
                        margin: 0 18px !important;
                        padding: 15px 0 7px !important;
                        border-top: 1px solid #eeeae4 !important;
                    }

                    #project-chat .chat-detail {
                        display: grid !important;
                        grid-template-columns: 58px minmax(0,1fr) !important;
                        gap: 8px !important;
                        align-items: start !important;
                        margin: 0 0 10px !important;
                    }

                    #project-chat .chat-detail span {
                        font-size: 11px !important;
                        letter-spacing: .08em !important;
                        color: #9aa0a5 !important;
                    }

                    #project-chat .chat-detail strong {
                        margin: 0 !important;
                        font-size: 13px !important;
                        line-height: 1.45 !important;
                        text-align: right !important;
                        color: #41474c !important;
                    }

                    #project-chat .chat-info-box {
                        margin: 8px 18px 18px !important;
                        padding: 10px 11px !important;
                        border: 0 !important;
                        border-radius: 9px !important;
                        background: #f4f6f4 !important;
                        font-size: 12px !important;
                        line-height: 1.45 !important;
                    }

                    /* AI CARD */
                    #project-chat .client-ai-panel {
                        grid-area: ai !important;
                        padding: 0 !important;
                        max-height: 335px !important;
                        overflow: hidden auto !important;
                        border: 1px solid #dedbd4 !important;
                        border-radius: 14px !important;
                        background: #fffdfa !important;
                        box-shadow: 0 8px 24px rgba(42, 37, 32, .035) !important;
                    }

                    #project-chat .client-ai-header {
                        position: sticky !important;
                        top: 0 !important;
                        z-index: 2 !important;
                        padding: 14px 16px !important;
                        margin: 0 !important;
                        background: #fffdfa !important;
                        border-bottom: 1px solid #eeeae4 !important;
                    }

                    #project-chat .client-ai-header .section-label {
                        display: none !important;
                    }

                    #project-chat .client-ai-header h3 {
                        margin: 0 0 2px !important;
                        font-size: 14px !important;
                    }

                    #project-chat .client-ai-header p {
                        font-size: 12px !important;
                        line-height: 1.4 !important;
                        color: #8b9297 !important;
                    }

                    #project-chat .client-ai-section {
                        padding: 13px 16px !important;
                        border-bottom: 1px solid #f0ede8 !important;
                    }

                    #project-chat .client-ai-section-title {
                        gap: 8px !important;
                        margin: 0 0 8px !important;
                    }

                    #project-chat .client-ai-section-title strong {
                        font-size: 13px !important;
                    }

                    #project-chat .client-ai-section-title span {
                        font-size: 12px !important;
                    }

                    /* MAIN MESSENGER */
                    #project-chat .chat-main {
                        grid-area: chat !important;
                        min-height: 630px !important;
                        height: 630px !important;
                        border: 1px solid #dcd8d1 !important;
                        border-radius: 14px !important;
                        overflow: hidden !important;
                        background: #ffffff !important;
                        box-shadow: 0 10px 34px rgba(42, 37, 32, .05) !important;
                    }

                    #project-chat .chat-header {
                        min-height: 68px !important;
                        height: 68px !important;
                        padding: 11px 17px !important;
                        background: #fffdfa !important;
                        border-bottom: 1px solid #e6e2dc !important;
                    }

                    #project-chat .chat-header-avatar {
                        width: 38px !important;
                        height: 38px !important;
                        min-width: 38px !important;
                        border-radius: 50% !important;
                    }

                    #project-chat .chat-header-user strong {
                        font-size: 13px !important;
                    }

                    #project-chat .chat-header-user span {
                        margin-top: 2px !important;
                        font-size: 12px !important;
                        color: #93999e !important;
                    }

                    #project-chat .chat-project-badge {
                        padding: 6px 9px !important;
                        font-size: 11px !important;
                        border-radius: 999px !important;
                    }

                    /* Remove graph-paper visual noise inside chat */
                    #project-chat .chat-body {
                        flex: 1 1 auto !important;
                        height: auto !important;
                        min-height: 0 !important;
                        max-height: none !important;
                        padding: 24px 28px !important;
                        background-color: #faf9f6 !important;
                        background-image: none !important;
                        overflow-y: auto !important;
                    }

                    #project-chat .chat-body::-webkit-scrollbar {
                        width: 7px !important;
                    }

                    #project-chat .chat-body::-webkit-scrollbar-track {
                        background: transparent !important;
                    }

                    #project-chat .chat-body::-webkit-scrollbar-thumb {
                        background: #d4d0ca !important;
                        border-radius: 999px !important;
                    }

                    #project-chat .chat-date-divider {
                        display: flex !important;
                        align-items: center !important;
                        gap: 12px !important;
                        margin: 16px 0 22px !important;
                        color: #a0a4a7 !important;
                        font-size: 11px !important;
                        font-weight: 800 !important;
                        text-transform: uppercase !important;
                        letter-spacing: .08em !important;
                    }

                    #project-chat .chat-date-divider::before,
                    #project-chat .chat-date-divider::after {
                        content: "" !important;
                        flex: 1 !important;
                        height: 1px !important;
                        background: #e7e3dd !important;
                    }

                    #project-chat .chat-message-row {
                        display: flex !important;
                        width: 100% !important;
                        gap: 8px !important;
                        margin: 0 0 16px !important;
                    }

                    #project-chat .message-user-avatar {
                        width: 28px !important;
                        height: 28px !important;
                        min-width: 28px !important;
                        border-radius: 50% !important;
                        font-size: 11px !important;
                        box-shadow: none !important;
                    }

                    #project-chat .message-content {
                        width: fit-content !important;
                        max-width: min(62%, 560px) !important;
                    }

                    #project-chat .message-sender {
                        margin: 0 3px 4px !important;
                        font-size: 11px !important;
                        font-weight: 700 !important;
                        color: #858d93 !important;
                    }

                    #project-chat .message-bubble {
                        display: block !important;
                        width: fit-content !important;
                        min-width: 0 !important;
                        max-width: 100% !important;
                        padding: 9px 12px !important;
                        border-radius: 13px !important;
                        font-size: 13px !important;
                        line-height: 1.45 !important;
                    }

                    #project-chat .message-client .message-bubble {
                        color: #30363b !important;
                        background: #ffffff !important;
                        border: 1px solid #dfdcd6 !important;
                        border-bottom-left-radius: 3px !important;
                    }

                    #project-chat .message-mine .message-bubble {
                        color: #ffffff !important;
                        background: #f36f21 !important;
                        border: 1px solid #f36f21 !important;
                        border-bottom-right-radius: 3px !important;
                    }

                    #project-chat .message-text {
                        font-size: 13px !important;
                        line-height: 1.45 !important;
                    }

                    #project-chat .message-meta {
                        gap: 5px !important;
                        margin: 4px 3px 0 !important;
                        color: #9ba0a4 !important;
                        font-size: 11px !important;
                    }

                    /* Attachments become neat cards instead of huge blocks */
                    #project-chat .message-image-link {
                        display: block !important;
                        width: auto !important;
                        max-width: 300px !important;
                        border-radius: 10px !important;
                        overflow: hidden !important;
                        background: transparent !important;
                    }

                    #project-chat .message-attached-image {
                        display: block !important;
                        width: auto !important;
                        max-width: 300px !important;
                        height: auto !important;
                        max-height: 220px !important;
                        object-fit: cover !important;
                        border-radius: 9px !important;
                    }

                    #project-chat .message-file-card {
                        width: 285px !important;
                        max-width: 100% !important;
                        padding: 10px !important;
                        border-radius: 10px !important;
                    }

                    /* COMPOSER */
                    #project-chat .chat-composer {
                        padding: 11px 13px !important;
                        background: #fffdfa !important;
                        border-top: 1px solid #e5e1da !important;
                    }

                    #project-chat .message-form {
                        display: grid !important;
                        grid-template-columns: 42px minmax(0,1fr) 88px !important;
                        gap: 8px !important;
                        align-items: end !important;
                    }

                    #project-chat .message-attach-button {
                        width: 42px !important;
                        min-width: 42px !important;
                        height: 42px !important;
                        padding: 0 !important;
                        border: 1px solid #dcd8d1 !important;
                        border-radius: 9px !important;
                        background: #ffffff !important;
                    }

                    #project-chat .message-attach-button:hover {
                        border-color: #f36f21 !important;
                        color: #f36f21 !important;
                    }

                    #project-chat .message-input-wrapper {
                        overflow: hidden !important;
                        border: 1px solid #dcd8d1 !important;
                        border-radius: 9px !important;
                        background: #ffffff !important;
                    }

                    #project-chat .message-input-wrapper textarea {
                        min-height: 41px !important;
                        height: 41px !important;
                        max-height: 100px !important;
                        padding: 10px 12px 5px !important;
                        border: 0 !important;
                        outline: 0 !important;
                        background: transparent !important;
                        font-size: 14px !important;
                    }

                    #project-chat .message-input-bottom {
                        min-height: 17px !important;
                        padding: 0 10px 5px !important;
                        font-size: 11px !important;
                        color: #a0a5a9 !important;
                    }

                    #project-chat .message-send-button {
                        width: 88px !important;
                        min-width: 88px !important;
                        height: 42px !important;
                        padding: 0 13px !important;
                        border-radius: 9px !important;
                        background: #f36f21 !important;
                        font-size: 13px !important;
                    }

                    /* Presence control: quieter and smaller */
                    #project-chat .presence-control {
                        transform: scale(.88) !important;
                        transform-origin: right center !important;
                    }

                    @media (max-width: 980px) {
                        #project-chat .messenger-layout {
                            grid-template-columns: 220px minmax(0, 1fr) !important;
                        }

                        #project-chat .message-content {
                            max-width: 72% !important;
                        }
                    }

                    @media (max-width: 760px) {
                        #project-chat .messages-page-header {
                            align-items: flex-start !important;
                            flex-direction: column !important;
                        }

                        #project-chat .messenger-layout {
                            display: flex !important;
                            flex-direction: column !important;
                        }

                        #project-chat .chat-main {
                            order: 1 !important;
                            width: 100% !important;
                            height: 610px !important;
                        }

                        #project-chat .chat-sidebar {
                            order: 2 !important;
                            width: 100% !important;
                        }

                        #project-chat .client-ai-panel {
                            order: 3 !important;
                            width: 100% !important;
                            max-height: 350px !important;
                        }

                        #project-chat .chat-body {
                            padding: 18px 13px !important;
                        }

                        #project-chat .message-content {
                            max-width: 82% !important;
                        }

                        #project-chat .message-image-link,
                        #project-chat .message-attached-image {
                            max-width: 240px !important;
                        }

                        #project-chat .message-form {
                            grid-template-columns: 42px minmax(0,1fr) !important;
                        }

                        #project-chat .message-send-button {
                            grid-column: 1 / -1 !important;
                            width: 100% !important;
                        }
                    }

                
                    /* =========================================================
                       MESSENGER V3 — FULL CHAT + SLIDE-OUT PROJECT INFO
                    ========================================================= */

                    #project-chat {
                        position: relative !important;
                        overflow: visible !important;
                    }

                    #project-chat .messages-page-header {
                        display: none !important;
                    }

                    #project-chat .messenger-layout {
                        position: relative !important;
                        display: block !important;
                        width: 100% !important;
                        min-height: 680px !important;
                        padding: 0 !important;
                    }

                    /* Main chat now gets the entire workspace */
                    #project-chat .chat-main {
                        position: relative !important;
                        width: 100% !important;
                        height: 680px !important;
                        min-height: 680px !important;
                        margin: 0 !important;
                        border: 1px solid #ddd9d2 !important;
                        border-radius: 16px !important;
                        overflow: hidden !important;
                        background: #fff !important;
                        box-shadow: 0 10px 30px rgba(43, 38, 33, .045) !important;
                    }

                    #project-chat .chat-header {
                        height: 72px !important;
                        min-height: 72px !important;
                        padding: 12px 18px !important;
                        background: #fffdfa !important;
                        border-bottom: 1px solid #e8e4dd !important;
                    }

                    #project-chat .chat-header-avatar {
                        width: 42px !important;
                        height: 42px !important;
                        min-width: 42px !important;
                        border-radius: 10px !important;
                    }

                    #project-chat .chat-header-user strong {
                        font-size: 14px !important;
                    }

                    #project-chat .chat-header-user span {
                        font-size: 12px !important;
                    }

                    /* Make room for the info button */
                    #project-chat .chat-header::after {
                        content: "ⓘ  Project Info";
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        height: 34px;
                        margin-left: 10px;
                        padding: 0 12px;
                        border: 1px solid #ddd9d2;
                        border-radius: 9px;
                        color: #555e65;
                        background: #fff;
                        font-size: 12pxNone;
                        font-weight: 800;
                        letter-spacing: .02em;
                        cursor: pointer;
                    }

                    /* Hide old permanent left columns; JS moves them into drawer */
                    #project-chat .chat-sidebar,
                    #project-chat .client-ai-panel {
                        display: none !important;
                    }

                    /* Chat canvas */
                    #project-chat .chat-body {
                        height: auto !important;
                        min-height: 0 !important;
                        max-height: none !important;
                        flex: 1 1 auto !important;
                        padding: 28px 34px !important;
                        background: #fbfaf8 !important;
                        background-image: none !important;
                        overflow-y: auto !important;
                    }

                    #project-chat .chat-message-row {
                        margin-bottom: 18px !important;
                    }

                    #project-chat .message-content {
                        width: fit-content !important;
                        max-width: min(56%, 610px) !important;
                    }

                    #project-chat .message-user-avatar {
                        width: 31px !important;
                        height: 31px !important;
                        min-width: 31px !important;
                        border-radius: 8px !important;
                    }

                    #project-chat .message-bubble {
                        width: fit-content !important;
                        padding: 10px 13px !important;
                        border-radius: 14px !important;
                    }

                    #project-chat .message-client .message-bubble {
                        color: #2f3438 !important;
                        background: #f0f1f2 !important;
                        border: 0 !important;
                        border-bottom-left-radius: 4px !important;
                    }

                    #project-chat .message-mine .message-bubble {
                        color: #fff !important;
                        background: #f36f21 !important;
                        border: 0 !important;
                        border-bottom-right-radius: 4px !important;
                    }

                    #project-chat .message-text {
                        font-size: 13px !important;
                        line-height: 1.5 !important;
                    }

                    #project-chat .message-image-link {
                        max-width: 390px !important;
                        border-radius: 12px !important;
                    }

                    #project-chat .message-attached-image {
                        max-width: 390px !important;
                        max-height: 290px !important;
                        border-radius: 12px !important;
                        object-fit: cover !important;
                    }

                    #project-chat .chat-date-divider {
                        margin: 6px 0 25px !important;
                    }

                    /* Messenger composer */
                    #project-chat .chat-composer {
                        padding: 12px 16px !important;
                        background: #fffdfa !important;
                        border-top: 1px solid #e7e3dc !important;
                    }

                    #project-chat .message-form {
                        grid-template-columns: 44px minmax(0, 1fr) 92px !important;
                        gap: 9px !important;
                    }

                    #project-chat .message-attach-button {
                        width: 44px !important;
                        height: 44px !important;
                        min-width: 44px !important;
                        border-radius: 50% !important;
                    }

                    #project-chat .message-input-wrapper {
                        border-radius: 22px !important;
                        background: #f7f7f6 !important;
                    }

                    #project-chat .message-input-wrapper textarea {
                        height: 43px !important;
                        min-height: 43px !important;
                        padding: 11px 17px 5px !important;
                    }

                    #project-chat .message-input-bottom {
                        padding-left: 17px !important;
                        padding-right: 17px !important;
                    }

                    #project-chat .message-send-button {
                        width: 92px !important;
                        min-width: 92px !important;
                        height: 44px !important;
                        border-radius: 22px !important;
                    }

                    /* =========================================================
                       OFF-CANVAS DRAWER
                    ========================================================= */

                    #project-chat .messenger-info-overlay {
                        position: absolute;
                        inset: 0;
                        z-index: 90;
                        display: none;
                        background: rgba(32, 31, 29, .18);
                        border-radius: 16px;
                        backdrop-filter: blur(1px);
                    }

                    #project-chat.messenger-drawer-open .messenger-info-overlay {
                        display: block;
                    }

                    #project-chat .messenger-info-drawer {
                        position: absolute;
                        z-index: 100;
                        top: 0;
                        right: 0;
                        bottom: 0;
                        width: min(355px, 92%);
                        display: flex;
                        flex-direction: column;
                        transform: translateX(calc(100% + 20px));
                        transition: transform .24s ease;
                        border-left: 1px solid #e0dcd5;
                        border-radius: 0 16px 16px 0;
                        background: #fffdfa;
                        box-shadow: -18px 0 42px rgba(39, 35, 31, .11);
                        overflow: hidden;
                    }

                    #project-chat.messenger-drawer-open .messenger-info-drawer {
                        transform: translateX(0);
                    }

                    #project-chat .messenger-drawer-head {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        min-height: 66px;
                        padding: 0 18px;
                        border-bottom: 1px solid #e9e5de;
                    }

                    #project-chat .messenger-drawer-head strong {
                        font-size: 14px;
                        color: #2e3439;
                    }

                    #project-chat .messenger-drawer-close {
                        width: 34px;
                        height: 34px;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        border: 0;
                        border-radius: 9px;
                        background: #f3f1ed;
                        color: #626a70;
                        font-size: 19px;
                        cursor: pointer;
                    }

                    #project-chat .messenger-drawer-body {
                        flex: 1;
                        min-height: 0;
                        overflow-y: auto;
                        padding: 17px;
                    }

                    #project-chat .messenger-drawer-section {
                        margin-bottom: 14px;
                        border: 1px solid #e5e1da;
                        border-radius: 12px;
                        background: #fff;
                        overflow: hidden;
                    }

                    #project-chat .messenger-drawer-section-button {
                        width: 100%;
                        min-height: 49px;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        gap: 10px;
                        padding: 0 14px;
                        border: 0;
                        background: #fff;
                        color: #30363a;
                        font-size: 13pxNone;
                        font-weight: 800;
                        text-align: left;
                        cursor: pointer;
                    }

                    #project-chat .messenger-drawer-section-button:hover {
                        background: #faf7f2;
                    }

                    #project-chat .messenger-drawer-section-button span:last-child {
                        color: #f36f21;
                        font-size: 15px;
                        transition: transform .2s ease;
                    }

                    #project-chat .messenger-drawer-section.open
                    .messenger-drawer-section-button span:last-child {
                        transform: rotate(90deg);
                    }

                    #project-chat .messenger-drawer-section-content {
                        display: none;
                        padding: 0 14px 14px;
                    }

                    #project-chat .messenger-drawer-section.open
                    .messenger-drawer-section-content {
                        display: block;
                    }

                    /* Re-enable original content only inside drawer */
                    #project-chat .messenger-drawer-section-content .chat-sidebar,
                    #project-chat .messenger-drawer-section-content .client-ai-panel {
                        display: block !important;
                        width: 100% !important;
                        max-height: none !important;
                        margin: 0 !important;
                        padding: 0 !important;
                        border: 0 !important;
                        border-radius: 0 !important;
                        box-shadow: none !important;
                        background: transparent !important;
                    }

                    #project-chat .messenger-drawer-section-content
                    .chat-sidebar-heading {
                        display: none !important;
                    }

                    #project-chat .messenger-drawer-section-content
                    .chat-client-card {
                        padding: 8px 0 14px !important;
                    }

                    #project-chat .messenger-drawer-section-content
                    .chat-client-details {
                        margin: 0 !important;
                    }

                    #project-chat .messenger-drawer-section-content
                    .chat-info-box {
                        margin: 8px 0 0 !important;
                    }

                    #project-chat .messenger-drawer-section-content
                    .client-ai-header {
                        display: none !important;
                    }

                    #project-chat .messenger-drawer-section-content
                    .client-ai-section {
                        padding: 12px 0 !important;
                    }

                    @media (max-width: 760px) {
                        #project-chat .chat-main {
                            height: 650px !important;
                            min-height: 650px !important;
                        }

                        #project-chat .chat-body {
                            padding: 20px 13px !important;
                        }

                        #project-chat .message-content {
                            max-width: 82% !important;
                        }

                        #project-chat .message-image-link,
                        #project-chat .message-attached-image {
                            max-width: 260px !important;
                        }

                        #project-chat .message-form {
                            grid-template-columns: 42px minmax(0, 1fr) !important;
                        }

                        #project-chat .message-send-button {
                            grid-column: 1 / -1 !important;
                            width: 100% !important;
                        }
                    }


                    /* =========================================================
                       MESSENGER FINAL POLISH — TYPOGRAPHY + SPACING
                    ========================================================= */

                    #project-chat,
                    #project-chat button,
                    #project-chat input,
                    #project-chat textarea,
                    #project-chat select {
                        font-family: "Segoe UI", Inter, Arial, sans-serif !important;
                        -webkit-font-smoothing: antialiased;
                        text-rendering: optimizeLegibility;
                    }

                    /* Header */
                    #project-chat .chat-header {
                        padding: 12px 20px !important;
                    }

                    #project-chat .chat-header-user strong {
                        display: block !important;
                        margin: 0 !important;
                        color: #24282d !important;
                        font-size: 15px !important;
                        font-weight: 700 !important;
                        line-height: 1.25 !important;
                        letter-spacing: -.01em !important;
                    }

                    #project-chat .chat-header-user span {
                        display: block !important;
                        margin-top: 3px !important;
                        color: #7d858c !important;
                        font-size: 13px !important;
                        font-weight: 400 !important;
                        line-height: 1.35 !important;
                    }

                    #project-chat .chat-project-badge {
                        color: #596269 !important;
                        font-size: 12px !important;
                        font-weight: 600 !important;
                        letter-spacing: 0 !important;
                    }

                    #project-chat .chat-header::after {
                        content: "Project Info" !important;
                        height: 36px !important;
                        padding: 0 13px !important;
                        color: #4d555b !important;
                        font-family: "Segoe UI", Inter, Arial, sans-serif !important;
                        font-size: 13px !important;
                        font-weight: 600 !important;
                        letter-spacing: 0 !important;
                        border-radius: 10px !important;
                    }

                    /* Chat canvas */
                    #project-chat .chat-body {
                        padding: 26px 30px 30px !important;
                    }

                    #project-chat .chat-date-divider {
                        margin: 4px 0 24px !important;
                        color: #9aa0a5 !important;
                        font-size: 12px !important;
                        font-weight: 600 !important;
                        letter-spacing: .03em !important;
                        text-transform: none !important;
                    }

                    #project-chat .message-sender {
                        margin: 0 4px 5px !important;
                        color: #747c82 !important;
                        font-size: 12px !important;
                        font-weight: 600 !important;
                        line-height: 1.3 !important;
                    }

                    #project-chat .message-bubble {
                        padding: 10px 14px !important;
                    }

                    #project-chat .message-text,
                    #project-chat .message-bubble {
                        font-family: "Segoe UI", Inter, Arial, sans-serif !important;
                        font-size: 13.5px !important;
                        font-weight: 400 !important;
                        line-height: 1.5 !important;
                        letter-spacing: 0 !important;
                    }

                    #project-chat .message-meta {
                        margin-top: 5px !important;
                        color: #949ba0 !important;
                        font-size: 11px !important;
                        font-weight: 400 !important;
                        line-height: 1.25 !important;
                        letter-spacing: 0 !important;
                    }

                    #project-chat .message-user-avatar {
                        font-size: 12px !important;
                        font-weight: 700 !important;
                    }

                    /* Composer */
                    #project-chat .message-input-wrapper textarea {
                        color: #30363b !important;
                        font-family: "Segoe UI", Inter, Arial, sans-serif !important;
                        font-size: 13px !important;
                        font-weight: 400 !important;
                        line-height: 1.45 !important;
                    }

                    #project-chat .message-input-wrapper textarea::placeholder {
                        color: #9aa1a6 !important;
                        opacity: 1 !important;
                    }

                    #project-chat .message-input-bottom {
                        color: #a0a6aa !important;
                        font-size: 11px !important;
                        font-weight: 400 !important;
                        line-height: 1.25 !important;
                    }

                    #project-chat .message-send-button {
                        font-size: 14px !important;
                        font-weight: 700 !important;
                        letter-spacing: 0 !important;
                    }

                    /* Drawer */
                    #project-chat .messenger-drawer-head {
                        min-height: 64px !important;
                        padding: 0 20px !important;
                    }

                    #project-chat .messenger-drawer-head strong {
                        color: #252a2e !important;
                        font-size: 15px !important;
                        font-weight: 700 !important;
                        line-height: 1.25 !important;
                        letter-spacing: -.01em !important;
                    }

                    #project-chat .messenger-drawer-section-button {
                        min-height: 50px !important;
                        padding: 0 15px !important;
                        color: #343a3f !important;
                        font-size: 14px !important;
                        font-weight: 600 !important;
                        line-height: 1.3 !important;
                        letter-spacing: 0 !important;
                    }

                    #project-chat .messenger-drawer-section-content {
                        padding: 2px 15px 16px !important;
                    }

                    /* Client details inside drawer */
                    #project-chat .messenger-drawer-section-content .chat-client-card {
                        gap: 12px !important;
                        padding: 10px 0 16px !important;
                    }

                    #project-chat .messenger-drawer-section-content .chat-client-avatar {
                        width: 44px !important;
                        height: 44px !important;
                        min-width: 44px !important;
                        font-size: 14px !important;
                        font-weight: 700 !important;
                    }

                    #project-chat .messenger-drawer-section-content .chat-client-info strong {
                        color: #292e32 !important;
                        font-size: 13px !important;
                        font-weight: 700 !important;
                        line-height: 1.3 !important;
                    }

                    #project-chat .messenger-drawer-section-content .chat-client-info span {
                        margin-top: 3px !important;
                        color: #838b91 !important;
                        font-size: 12px !important;
                        font-weight: 400 !important;
                    }

                    #project-chat .messenger-drawer-section-content .chat-detail {
                        grid-template-columns: 62px minmax(0, 1fr) !important;
                        gap: 10px !important;
                        margin-bottom: 11px !important;
                    }

                    #project-chat .messenger-drawer-section-content .chat-detail span {
                        color: #999fa4 !important;
                        font-size: 11px !important;
                        font-weight: 600 !important;
                        line-height: 1.35 !important;
                        letter-spacing: .045em !important;
                    }

                    #project-chat .messenger-drawer-section-content .chat-detail strong {
                        color: #4b5359 !important;
                        font-size: 12px !important;
                        font-weight: 500 !important;
                        line-height: 1.45 !important;
                    }

                    #project-chat .messenger-drawer-section-content .chat-info-box {
                        color: #737b81 !important;
                        font-size: 12px !important;
                        font-weight: 400 !important;
                        line-height: 1.5 !important;
                    }

                    /* AI history typography */
                    #project-chat .messenger-drawer-section-content .client-ai-section-title strong {
                        color: #343a3f !important;
                        font-size: 13px !important;
                        font-weight: 650 !important;
                        line-height: 1.35 !important;
                    }

                    #project-chat .messenger-drawer-section-content .client-ai-section-title span {
                        color: #8c9398 !important;
                        font-size: 11px !important;
                        font-weight: 400 !important;
                    }

                    #project-chat .messenger-drawer-section-content .client-ai-section {
                        color: #697177 !important;
                        font-size: 12px !important;
                        line-height: 1.5 !important;
                    }

                    /* Avoid oversized or bold inherited typography */
                    #project-chat p,
                    #project-chat span,
                    #project-chat strong,
                    #project-chat button,
                    #project-chat textarea {
                        text-shadow: none !important;
                    }

                    @media (max-width: 760px) {
                        #project-chat .chat-header-user strong {
                            font-size: 14px !important;
                        }

                        #project-chat .message-text,
                        #project-chat .message-bubble {
                            font-size: 13px !important;
                        }

                        #project-chat .chat-body {
                            padding: 20px 14px 24px !important;
                        }
                    }


                    /* =========================================================
                       MESSAGES — DIRECT TO CHAT
                       Remove redundant intro and availability/status controls.
                    ========================================================= */

                    #project-chat .messages-page-header,
                    #project-chat .project-communication-header,
                    #project-chat .project-tab-heading,
                    #project-chat .presence-control,
                    #project-chat .status-control,
                    #project-chat .availability-control,
                    #project-chat .architect-status-control {
                        display: none !important;
                    }

                    #project-chat > .section-label,
                    #project-chat > h1,
                    #project-chat > h2,
                    #project-chat > p {
                        display: none !important;
                    }

                    #project-chat {
                        margin-top: 0 !important;
                        padding-top: 0 !important;
                    }

                    #project-chat .messenger-layout,
                    #project-chat .chat-main {
                        margin-top: 0 !important;
                    }

</style>


                <!-- MESSAGE PAGE HEADING -->
                <div class="section-header">

                    <!-- =================================================
                        PRESENCE
                    ================================================== -->

                    <form
                        method="POST"
                        action="{{ route(
                            'architect.presence.update'
                        ) }}"
                        class="presence-control"
                        id="presenceForm"
                    >

                        @csrf


                        <div class="presence-current">


                            <span
                                class="
                                    presence-indicator
                                    presence-{{ $presenceStatus }}
                                "
                                id="presenceIndicator"
                            ></span>


                            <div class="presence-copy">

                                <span class="presence-small-label">
                                    YOUR STATUS
                                </span>

                                <strong id="presenceCurrentText">
                                    {{ ucfirst($presenceStatus) }}
                                </strong>

                            </div>

                        </div>



                        <div class="presence-select-wrapper">


                            <select
                                name="presence_status"
                                id="presenceSelect"
                                aria-label="Architect presence status"
                            >

                                <option
                                    value="online"
                                    {{ $presenceStatus === 'online'
                                        ? 'selected'
                                        : ''
                                    }}
                                >
                                    Online
                                </option>


                                <option
                                    value="idle"
                                    {{ $presenceStatus === 'idle'
                                        ? 'selected'
                                        : ''
                                    }}
                                >
                                    Idle
                                </option>


                                <option
                                    value="away"
                                    {{ $presenceStatus === 'away'
                                        ? 'selected'
                                        : ''
                                    }}
                                >
                                    Away
                                </option>

                            </select>


                            <svg viewBox="0 0 24 24">
                                <path d="M7 9l5 5 5-5"/>
                            </svg>

                        </div>

                    </form>

                </div>



                <!-- MESSAGE ERROR -->

                @error('message')

                    <div class="message-error">

                        <strong>
                            Message could not be sent.
                        </strong>

                        <span>
                            {{ $message }}
                        </span>

                    </div>

                @enderror


                @error('attachment')

                    <div class="message-error">

                        <strong>
                            Attachment could not be sent.
                        </strong>

                        <span>
                            {{ $message }}
                        </span>

                    </div>

                @enderror



                <!-- =================================================
                    MESSENGER
                ================================================== -->

                <div class="messenger-layout">



                    <!-- =================================================
                        LEFT SIDE
                    ================================================== -->

                    <aside class="chat-sidebar">


                        <div class="chat-sidebar-heading">

                            <span class="section-label">
                                CONVERSATION WITH
                            </span>

                            <h3>
                                Project Client
                            </h3>

                        </div>



                        <div class="chat-client-card">


                            <div class="chat-client-avatar">

                                {{ strtoupper(
                                    substr(
                                        $project->client_name,
                                        0,
                                        1
                                    )
                                ) }}

                            </div>


                            <div class="chat-client-info">

                                <strong>
                                    {{ $project->client_name }}
                                </strong>

                                <span>
                                    Client
                                </span>

                            </div>

                        </div>



                        <div class="chat-client-details">


                            <div class="chat-detail">

                                <span>
                                    EMAIL
                                </span>

                                <strong>
                                    {{ $project->client_email }}
                                </strong>

                            </div>


                            <div class="chat-detail">

                                <span>
                                    PROJECT
                                </span>

                                <strong>
                                    {{ $project->project_name }}
                                </strong>

                            </div>


                            <div class="chat-detail">

                                <span>
                                    MESSAGES
                                </span>

                                <strong>
                                    {{ $messages->count() }}
                                </strong>

                            </div>

                        </div>



                        <div class="chat-info-box">


                            <div class="chat-info-icon">

                                <svg viewBox="0 0 24 24">

                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                    />

                                    <path d="M12 11v5"/>

                                    <path d="M12 8h.01"/>

                                </svg>

                            </div>


                            <p>
                                This conversation is connected
                                only to this project.
                            </p>

                        </div>

                    </aside>



                    <!-- =================================================
                        CENTER CHAT
                    ================================================== -->

                    <div class="chat-main">


                        <!-- CHAT HEADER -->

                        <div class="chat-header">


                            <div class="chat-header-user">


                                <div class="chat-header-avatar">

                                    {{ strtoupper(
                                        substr(
                                            $project->client_name,
                                            0,
                                            1
                                        )
                                    ) }}

                                </div>


                                <div>

                                    <strong>
                                        {{ $project->client_name }}
                                    </strong>

                                    <span>
                                        {{ $project->project_name }}
                                    </span>

                                </div>

                            </div>



                            <div class="chat-project-tag">

                                <span class="chat-project-dot"></span>

                                Project Conversation

                            </div>

                        </div>



                        <!-- =================================================
                            CHAT BODY
                        ================================================== -->

                        <div
                            class="chat-body"
                            id="chatBody"
                        >


                            @if($messages->count() > 0)


                                @php

                                    $lastDate = null;

                                @endphp



                                @foreach(
                                    $messages
                                        ->sortBy('created_at')
                                    as $projectMessage
                                )


                                    @php

                                        $messageDate =
                                            $projectMessage
                                                ->created_at
                                                ->format('Y-m-d');


                                        $isMine =
                                            $projectMessage
                                                ->sender_id
                                            ===
                                            auth()->id();


                                        $messageFileType =
                                            strtolower(
                                                $projectMessage
                                                    ->attachment_type
                                                ?? ''
                                            );


                                        $isMessageImage =
                                            in_array(
                                                $messageFileType,
                                                [
                                                    'jpg',
                                                    'jpeg',
                                                    'png',
                                                    'webp'
                                                ]
                                            );

                                    @endphp



                                    <!-- DATE DIVIDER -->

                                    @if($lastDate !== $messageDate)


                                        <div class="chat-date-divider">

                                            <span>


                                                @if(
                                                    $projectMessage
                                                        ->created_at
                                                        ->isToday()
                                                )

                                                    Today


                                                @elseif(
                                                    $projectMessage
                                                        ->created_at
                                                        ->isYesterday()
                                                )

                                                    Yesterday


                                                @else

                                                    {{ $projectMessage
                                                        ->created_at
                                                        ->format('F d, Y')
                                                    }}

                                                @endif

                                            </span>

                                        </div>


                                        @php

                                            $lastDate =
                                                $messageDate;

                                        @endphp


                                    @endif



                                    <!-- MESSAGE -->

                                    <div
                                        class="
                                            chat-message-row
                                            {{ $isMine
                                                ? 'message-mine'
                                                : 'message-client'
                                            }}
                                        "
                                    >


                                        @if(!$isMine)


                                            <div class="message-user-avatar">

                                                {{ strtoupper(
                                                    substr(
                                                        $projectMessage
                                                            ->sender
                                                            ->name
                                                        ?? $project
                                                            ->client_name,
                                                        0,
                                                        1
                                                    )
                                                ) }}

                                            </div>


                                        @endif



                                        <div class="message-content">


                                            <div class="message-sender">

                                                {{ $isMine
                                                    ? 'You'
                                                    : (
                                                        $projectMessage
                                                            ->sender
                                                            ->name
                                                        ?? $project
                                                            ->client_name
                                                    )
                                                }}

                                            </div>



                                            <div class="message-bubble">


                                                @if(
                                                    !empty(
                                                        $projectMessage
                                                            ->message
                                                    )
                                                )

                                                    <div class="message-text">

                                                        {!! nl2br(
                                                            e(
                                                                $projectMessage
                                                                    ->message
                                                            )
                                                        ) !!}

                                                    </div>

                                                @endif



                                                <!-- MESSAGE ATTACHMENT -->

                                                @if(
                                                    !empty(
                                                        $projectMessage
                                                            ->attachment_path
                                                    )
                                                )


                                                    @if($isMessageImage)


                                                        <a
                                                            href="{{ route(
                                                                'project.messages.attachments.secure.view',
                                                                [
                                                                    'projectId' =>
                                                                        $project->id,

                                                                    'messageId' =>
                                                                        $projectMessage->id
                                                                ]
                                                            ) }}"
                                                            target="_blank"
                                                            class="message-image-link"
                                                        >

                                                            <img
                                                                src="{{ route(
                                                                    'project.messages.attachments.secure.view',
                                                                    [
                                                                        'projectId' =>
                                                                            $project->id,

                                                                        'messageId' =>
                                                                            $projectMessage->id
                                                                    ]
                                                                ) }}"
                                                                alt="{{ $projectMessage
                                                                    ->attachment_name
                                                                }}"
                                                                class="message-attached-image"
                                                            >

                                                        </a>


                                                    @else


                                                        <a
                                                            href="{{ route(
                                                                'project.messages.attachments.secure.download',
                                                                [
                                                                    'projectId' =>
                                                                        $project->id,

                                                                    'messageId' =>
                                                                        $projectMessage->id
                                                                ]
                                                            ) }}"
                                                            target="_blank"
                                                            class="message-file-card"
                                                        >


                                                            <div class="message-file-icon">

                                                                <svg viewBox="0 0 24 24">

                                                                    <path d="M5 3h9l5 5v13H5z"/>

                                                                    <path d="M14 3v6h6"/>

                                                                </svg>

                                                            </div>


                                                            <div>

                                                                <strong>
                                                                    {{ $projectMessage
                                                                        ->attachment_name
                                                                    }}
                                                                </strong>

                                                                <span>

                                                                    {{ strtoupper(
                                                                        $projectMessage
                                                                            ->attachment_type
                                                                    ) }}

                                                                </span>

                                                            </div>

                                                        </a>


                                                    @endif


                                                @endif

                                            </div>



                                            <!-- MESSAGE META -->

                                            <div class="message-meta">


                                                <span>

                                                    {{ $projectMessage
                                                        ->created_at
                                                        ->format('h:i A')
                                                    }}

                                                </span>


                                                @if($isMine)


                                                    <span class="message-read-status">


                                                        @if(
                                                            $projectMessage
                                                                ->is_read
                                                        )

                                                            <span class="read-check">
                                                                ✓✓
                                                            </span>

                                                            Read


                                                        @else

                                                            <span>
                                                                ✓
                                                            </span>

                                                            Sent

                                                        @endif

                                                    </span>


                                                @endif

                                            </div>

                                        </div>



                                        @if($isMine)


                                            <div
                                                class="
                                                    message-user-avatar
                                                    architect-avatar
                                                "
                                            >

                                                {{ strtoupper(
                                                    substr(
                                                        auth()
                                                            ->user()
                                                            ->name,
                                                        0,
                                                        1
                                                    )
                                                ) }}

                                            </div>


                                        @endif

                                    </div>


                                @endforeach



                            @else


                                <!-- EMPTY CHAT -->

                                <div class="chat-empty-state">


                                    <div class="chat-empty-visual">


                                        <div class="chat-line-circle"></div>


                                        <div
                                            class="
                                                floating-chat-bubble
                                                bubble-one
                                            "
                                        >

                                            <svg viewBox="0 0 24 24">

                                                <path d="M4 5h16v12H8l-4 4z"/>

                                                <path d="M8 9h8"/>

                                            </svg>

                                        </div>


                                        <div
                                            class="
                                                floating-chat-bubble
                                                bubble-two
                                            "
                                        >

                                            <svg viewBox="0 0 24 24">

                                                <path d="M4 5h16v12H8l-4 4z"/>

                                            </svg>

                                        </div>


                                        <img
                                            src="{{ asset(
                                                'images/lineart1.png'
                                            ) }}"
                                            alt=""
                                        >

                                    </div>


                                    <span class="section-label">
                                        PROJECT CONVERSATION
                                    </span>


                                    <h3>
                                        Start the conversation
                                    </h3>


                                    <p>
                                        Send your first project message
                                        to {{ $project->client_name }}.
                                    </p>

                                </div>


                            @endif

                        </div>



                        <!-- =================================================
                            MESSAGE COMPOSER
                        ================================================== -->

                        <div
                            class="chat-composer"
                            id="messageComposer"
                        >


                            <form
                                method="POST"
                                action="{{ route(
                                    'architect.projects.messages.store',
                                    ['id' => $project->id]
                                ) }}"
                                enctype="multipart/form-data"
                                class="message-form"
                                id="messageForm"
                            >

                                @csrf



                                <!-- HIDDEN FILE INPUT -->

                                <input
                                    type="file"
                                    name="attachment"
                                    id="messageAttachment"
                                    class="message-file-input"
                                    accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                                >



                                <!-- ATTACH BUTTON -->

                                <label
                                    for="messageAttachment"
                                    class="message-attach-button"
                                    title="Attach file or image"
                                >

                                    <svg viewBox="0 0 24 24">

                                        <path d="M21 11.5L12.5 20a6 6 0 0 1-8.5-8.5L13 2.5a4 4 0 0 1 5.5 5.5L9.5 17a2 2 0 0 1-3-3l8-8"/>

                                    </svg>

                                </label>



                                <!-- INPUT CARD -->

                                <div class="message-input-wrapper">


                                    <!-- FILE PREVIEW -->

                                    <div
                                        class="message-attachment-preview"
                                        id="messageAttachmentPreview"
                                    >


                                        <div
                                            class="attachment-preview-icon"
                                            id="attachmentPreviewIcon"
                                        >

                                            <svg
                                                id="attachmentDefaultIcon"
                                                viewBox="0 0 24 24"
                                            >

                                                <path d="M5 3h9l5 5v13H5z"/>

                                                <path d="M14 3v6h6"/>

                                            </svg>


                                            <img
                                                id="attachmentImagePreview"
                                                src=""
                                                alt="Attachment preview"
                                            >

                                        </div>



                                        <div class="attachment-preview-info">

                                            <strong
                                                id="messageSelectedFileName"
                                            >
                                                File name
                                            </strong>

                                            <span
                                                id="messageSelectedFileSize"
                                            >
                                                0 KB
                                            </span>

                                        </div>



                                        <button
                                            type="button"
                                            class="attachment-remove-button"
                                            id="removeAttachmentButton"
                                            title="Remove attachment"
                                        >
                                            ×
                                        </button>

                                    </div>



                                    <textarea
                                        name="message"
                                        id="messageInput"
                                        rows="1"
                                        maxlength="5000"
                                        placeholder="Write a message to {{ $project->client_name }}..."
                                    >{{ old('message') }}</textarea>



                                    <div class="message-input-bottom">


                                        <div class="message-input-tip">

                                            <svg viewBox="0 0 24 24">

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="9"
                                                />

                                                <path d="M12 11v5"/>

                                                <path d="M12 8h.01"/>

                                            </svg>


                                            <span>
                                                Enter to send · Shift + Enter for new line
                                            </span>

                                        </div>


                                        <span
                                            class="message-character-count"
                                            id="messageCharacterCount"
                                        >
                                            0 / 5000
                                        </span>

                                    </div>

                                </div>



                                <!-- SEND BUTTON -->

                                <button
                                    type="submit"
                                    class="message-send-button"
                                    id="messageSendButton"
                                >

                                    <span>
                                        Send
                                    </span>

                                    <svg viewBox="0 0 24 24">

                                        <path d="M22 2L11 13"/>

                                        <path d="M22 2l-7 20-4-9-9-4z"/>

                                    </svg>

                                </button>

                            </form>

                        </div>

                    </div>



                    <!-- =================================================
                        RIGHT: CLIENT AI HISTORY
                    ================================================== -->

                    <aside class="client-ai-panel">


                        <div class="client-ai-header">


                            <span class="section-label">
                                CLIENT AI HISTORY
                            </span>


                            <h3>
                                AI Activity
                            </h3>


                            <p>
                                View-only history of suggestions
                                and images generated by the client.
                            </p>

                        </div>



                        <!-- AI SUGGESTIONS -->

                        <div class="client-ai-section">


                            <div class="client-ai-section-title">


                                <div class="client-ai-section-icon">

                                    <svg viewBox="0 0 24 24">

                                        <path d="M12 3l1.5 4.5L18 9l-4.5 1.5L12 15l-1.5-4.5L6 9l4.5-1.5z"/>

                                    </svg>

                                </div>


                                <div>

                                    <strong>
                                        AI Suggestions
                                    </strong>

                                    <span>
                                        {{ $clientAiSuggestions->count() }}
                                    </span>

                                </div>

                            </div>



                            @if(
                                $clientAiSuggestions->count()
                                > 0
                            )


                                <div class="client-ai-list">


                                    @foreach(
                                        $clientAiSuggestions->take(5)
                                        as $history
                                    )


                                        <article class="client-ai-item">


                                            <span class="client-ai-type">
                                                SUGGESTION
                                            </span>


                                            @if(!empty($history->prompt))


                                                <p class="client-ai-prompt">

                                                    <strong>
                                                        Client:
                                                    </strong>

                                                    {{ $history->prompt }}

                                                </p>


                                            @endif


                                            @if(
                                                !empty(
                                                    $history
                                                        ->result_text
                                                )
                                            )


                                                <p class="client-ai-result">

                                                    {{ $history
                                                        ->result_text
                                                    }}

                                                </p>


                                            @endif


                                            <span class="client-ai-date">

                                                {{ $history
                                                    ->created_at
                                                    ->format(
                                                        'M d, Y · h:i A'
                                                    )
                                                }}

                                            </span>

                                        </article>


                                    @endforeach

                                </div>


                            @else


                                <div class="client-ai-empty">


                                    <div class="client-ai-empty-icon">

                                        <svg viewBox="0 0 24 24">

                                            <path d="M12 3l1.5 4.5L18 9l-4.5 1.5L12 15l-1.5-4.5L6 9l4.5-1.5z"/>

                                        </svg>

                                    </div>


                                    <strong>
                                        No AI suggestions yet
                                    </strong>


                                    <span>
                                        Client AI suggestions
                                        will appear here.
                                    </span>

                                </div>


                            @endif

                        </div>



                        <!-- AI IMAGES -->

                        <div class="client-ai-section">


                            <div class="client-ai-section-title">


                                <div class="client-ai-section-icon">

                                    <svg viewBox="0 0 24 24">

                                        <rect
                                            x="3"
                                            y="4"
                                            width="18"
                                            height="16"
                                            rx="2"
                                        />

                                        <circle
                                            cx="9"
                                            cy="10"
                                            r="2"
                                        />

                                        <path d="M21 15l-5-5L5 20"/>

                                    </svg>

                                </div>


                                <div>

                                    <strong>
                                        Generated Images
                                    </strong>

                                    <span>
                                        {{ $clientAiImages->count() }}
                                    </span>

                                </div>

                            </div>



                            @if(
                                $clientAiImages->count()
                                > 0
                            )


                                <div class="client-ai-images">


                                    @foreach(
                                        $clientAiImages->take(6)
                                        as $history
                                    )


                                        @if(
                                            !empty(
                                                $history->generated_image_path
                                            )
                                        )


                                            <a
                                                href="{{ route(
                                                    'project.ai-history.generated.secure.view',
                                                    [
                                                        'projectId' =>
                                                            $project->id,

                                                        'historyId' =>
                                                            $history->id
                                                    ]
                                                ) }}"
                                                target="_blank"
                                                rel="noopener"
                                                class="client-ai-image-card"
                                            >

                                                <img
                                                    src="{{ route(
                                                        'project.ai-history.generated.secure.view',
                                                        [
                                                            'projectId' =>
                                                                $project->id,

                                                            'historyId' =>
                                                                $history->id
                                                        ]
                                                    ) }}"
                                                    alt="Client generated image"
                                                >


                                                <div class="client-ai-image-overlay">

                                                    <span>
                                                        View
                                                    </span>

                                                </div>

                                            </a>


                                        @endif


                                    @endforeach

                                </div>


                            @else


                                <div class="client-ai-empty">


                                    <div class="client-ai-empty-icon">

                                        <svg viewBox="0 0 24 24">

                                            <rect
                                                x="3"
                                                y="4"
                                                width="18"
                                                height="16"
                                                rx="2"
                                            />

                                            <circle
                                                cx="9"
                                                cy="10"
                                                r="2"
                                            />

                                            <path d="M21 15l-5-5L5 20"/>

                                        </svg>

                                    </div>


                                    <strong>
                                        No generated images
                                    </strong>


                                    <span>
                                        Client-generated AI images
                                        will appear here.
                                    </span>

                                </div>


                            @endif

                        </div>



                        <div class="client-ai-view-only">


                            <svg viewBox="0 0 24 24">

                                <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="3"
                                />

                            </svg>


                            <div>

                                <strong>
                                    View only
                                </strong>

                                <span>
                                    AI generation is available
                                    only on the client side.
                                </span>

                            </div>

                        </div>

                    </aside>

                </div>

            </section>

        @endif



        <!-- =================================================
            REVISIONS
        ================================================== -->

        @if($activeTab === 'revisions')

    <section class="tab-panel revisions-panel">


        <div class="section-header">

            <div>

                <span class="section-label">
                    REVISION MANAGEMENT
                </span>

                <h2>
                    Client Revisions
                </h2>

                <p>
                    Review client revision requests, update their status,
                    and provide your response or progress notes.
                </p>

            </div>

        </div>


        @if(session('success'))

            <div class="revision-success-message">

                <div class="revision-success-icon">
                    ✓
                </div>

                <div>

                    <strong>
                        Revision updated
                    </strong>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            </div>

        @endif


        @if($errors->any())

            <div class="revision-error-message">

                <strong>
                    Please check the revision update.
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- =================================================
            REVISION SUMMARY
        ================================================== -->

        <div class="revision-summary-grid">


            <div class="revision-summary-card">

                <div class="revision-summary-icon revision-icon-all">

                    <svg viewBox="0 0 24 24">

                        <path d="M4 7h16"/>
                        <path d="M4 12h16"/>
                        <path d="M4 17h10"/>

                    </svg>

                </div>


                <div>

                    <span>
                        TOTAL REQUESTS
                    </span>

                    <strong>
                        {{ $revisions->count() }}
                    </strong>

                    <p>
                        All client revision requests
                    </p>

                </div>

            </div>


            <div class="revision-summary-card">

                <div class="revision-summary-icon revision-icon-pending">

                    <svg viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 7v5"/>
                        <path d="M12 16h.01"/>

                    </svg>

                </div>


                <div>

                    <span>
                        PENDING
                    </span>

                    <strong>
                        {{ $pendingRevisions }}
                    </strong>

                    <p>
                        Waiting for review
                    </p>

                </div>

            </div>


            <div class="revision-summary-card">

                <div class="revision-summary-icon revision-icon-progress">

                    <svg viewBox="0 0 24 24">

                        <path d="M20 11a8 8 0 1 0-2 5.3"/>
                        <path d="M20 4v7h-7"/>

                    </svg>

                </div>


                <div>

                    <span>
                        IN PROGRESS
                    </span>

                    <strong>
                        {{ $inProgressRevisions }}
                    </strong>

                    <p>
                        Currently being worked on
                    </p>

                </div>

            </div>


            <div class="revision-summary-card">

                <div class="revision-summary-icon revision-icon-resolved">

                    <svg viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="9"/>
                        <path d="M8 12l3 3 5-6"/>

                    </svg>

                </div>


                <div>

                    <span>
                        RESOLVED
                    </span>

                    <strong>
                        {{ $resolvedRevisions }}
                    </strong>

                    <p>
                        Completed revision requests
                    </p>

                </div>

            </div>

        </div>


        <!-- =================================================
            REVISION LIST
        ================================================== -->

        @if($revisions->count() > 0)


            <div class="revision-list">


                @foreach($revisions as $revision)


                    @php

                        $revisionStatusLabel =
                            match($revision->status) {

                                'pending' =>
                                    'Pending',

                                'in_progress' =>
                                    'In Progress',

                                'resolved' =>
                                    'Resolved',

                                default =>
                                    ucfirst(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $revision->status
                                        )
                                    )
                            };

                    @endphp


                    <article
                        class="
                            revision-card
                            revision-card-{{ $revision->status }}
                        "
                        id="revision-{{ $revision->id }}"
                    >


                        <!-- =================================================
                            REVISION HEADER
                        ================================================== -->

                        <div class="revision-card-header">


                            <div class="revision-title-area">


                                <div class="revision-number">

                                    REVISION #

                                    {{ str_pad(
                                        $revision->id,
                                        3,
                                        '0',
                                        STR_PAD_LEFT
                                    ) }}

                                </div>


                                <h3>
                                    {{ $revision->title }}
                                </h3>


                                <div class="revision-meta">


                                    <span>

                                        Requested by

                                        <strong>

                                            {{ $revision->client->name
                                                ?? $project->client_name
                                            }}

                                        </strong>

                                    </span>


                                    <span class="revision-meta-dot"></span>


                                    <span>

                                        {{ $revision->created_at
                                            ->format('M d, Y · h:i A')
                                        }}

                                    </span>

                                </div>

                            </div>



                            <span
                                class="
                                    revision-status-badge
                                    revision-status-{{ $revision->status }}
                                "
                            >

                                {{ $revisionStatusLabel }}

                            </span>

                        </div>



                        <!-- =================================================
                            CLIENT REQUEST
                        ================================================== -->

                        <div class="revision-request-box">


                            <div class="revision-request-label">

                                <div class="revision-request-icon">

                                    <svg viewBox="0 0 24 24">

                                        <path d="M4 5h16v12H8l-4 4z"/>
                                        <path d="M8 9h8"/>
                                        <path d="M8 13h6"/>

                                    </svg>

                                </div>


                                <div>

                                    <span>
                                        CLIENT REQUEST
                                    </span>

                                    <strong>
                                        Revision Details
                                    </strong>

                                </div>

                            </div>


                            <p>
                                {{ $revision->description }}
                            </p>


                            @if(!empty($revision->attachment_path))

                                @php

                                    $revisionAttachmentExtension =
                                        strtolower(
                                            pathinfo(
                                                $revision->attachment_name
                                                ?? $revision->attachment_path,
                                                PATHINFO_EXTENSION
                                            )
                                        );


                                    $revisionAttachmentIsImage =
                                        in_array(
                                            $revisionAttachmentExtension,
                                            [
                                                'jpg',
                                                'jpeg',
                                                'png'
                                            ]
                                        );

                                @endphp


                                <div
                                    style="
                                        margin-top: 18px;
                                        padding-top: 16px;
                                        border-top: 1px solid rgba(0, 0, 0, 0.08);
                                    "
                                >

                                    <span
                                        style="
                                            display: block;
                                            margin-bottom: 10px;
                                            font-size: 13pxNone;
                                            font-weight: 700;
                                            letter-spacing: .08em;
                                            text-transform: uppercase;
                                        "
                                    >
                                        Client Attachment
                                    </span>


                                    @if($revisionAttachmentIsImage)

                                        <a
                                            href="{{ route(
                                                'project.revisions.attachments.secure.view',
                                                [
                                                    'projectId' =>
                                                        $project->id,

                                                    'revisionId' =>
                                                        $revision->id
                                                ]
                                            ) }}"
                                            target="_blank"
                                            rel="noopener"
                                            style="
                                                display: inline-block;
                                                max-width: 320px;
                                                text-decoration: none;
                                            "
                                        >

                                            <img
                                                src="{{ route(
                                                    'project.revisions.attachments.secure.view',
                                                    [
                                                        'projectId' =>
                                                            $project->id,

                                                        'revisionId' =>
                                                            $revision->id
                                                    ]
                                                ) }}"
                                                alt="{{ $revision->attachment_name ?? 'Revision attachment' }}"
                                                style="
                                                    display: block;
                                                    width: 100%;
                                                    max-height: 220px;
                                                    object-fit: cover;
                                                    border-radius: 10px;
                                                    border: 1px solid rgba(0, 0, 0, 0.08);
                                                "
                                            >

                                        </a>

                                    @endif


                                    <div
                                        style="
                                            display: flex;
                                            align-items: center;
                                            justify-content: space-between;
                                            gap: 14px;
                                            margin-top: 10px;
                                            padding: 11px 12px;
                                            border: 1px solid rgba(0, 0, 0, 0.08);
                                            border-radius: 9px;
                                            background: rgba(255, 255, 255, 0.7);
                                        "
                                    >

                                        <div
                                            style="
                                                min-width: 0;
                                            "
                                        >

                                            <strong
                                                style="
                                                    display: block;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    white-space: nowrap;
                                                "
                                            >
                                                {{ $revision->attachment_name ?? 'Revision Attachment' }}
                                            </strong>

                                            <span
                                                style="
                                                    display: block;
                                                    margin-top: 3px;
                                                    font-size: 13pxNone;
                                                    opacity: .65;
                                                "
                                            >
                                                {{ strtoupper(
                                                    $revisionAttachmentExtension
                                                    ?: 'FILE'
                                                ) }}
                                            </span>

                                        </div>


                                        <div
                                            style="
                                                display: flex;
                                                gap: 8px;
                                                flex: 0 0 auto;
                                            "
                                        >

                                            <a
                                                href="{{ route(
                                                    'project.revisions.attachments.secure.view',
                                                    [
                                                        'projectId' =>
                                                            $project->id,

                                                        'revisionId' =>
                                                            $revision->id
                                                    ]
                                                ) }}"
                                                target="_blank"
                                                rel="noopener"
                                                style="
                                                    padding: 8px 12px;
                                                    border-radius: 7px;
                                                    background: #f47a1f;
                                                    color: #fff;
                                                    font-size: 13px;
                                                    font-weight: 700;
                                                    text-decoration: none;
                                                "
                                            >
                                                View Attachment
                                            </a>


                                            <a
                                                href="{{ route(
                                                    'project.revisions.attachments.secure.download',
                                                    [
                                                        'projectId' =>
                                                            $project->id,

                                                        'revisionId' =>
                                                            $revision->id
                                                    ]
                                                ) }}"
                                                style="
                                                    padding: 8px 12px;
                                                    border-radius: 7px;
                                                    border: 1px solid rgba(0, 0, 0, 0.12);
                                                    color: inherit;
                                                    font-size: 13px;
                                                    font-weight: 700;
                                                    text-decoration: none;
                                                "
                                            >
                                                Download
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        </div>



                        <!-- =================================================
                            ARCHITECT UPDATE FORM
                        ================================================== -->

                        <form
                            method="POST"
                            action="{{ route(
                                'architect.projects.revisions.update',
                                [
                                    'id' => $project->id,
                                    'revision' => $revision->id
                                ]
                            ) }}"
                            class="revision-update-form"
                            enctype="multipart/form-data"
                        >

                            @csrf
                            @method('PUT')


                            <div class="revision-form-grid">


                                <div class="revision-form-group revision-status-group">

                                    <label
                                        for="revision_status_{{ $revision->id }}"
                                    >
                                        Revision Status
                                    </label>


                                    <div class="revision-select-wrap">

                                        <select
                                            name="status"
                                            id="revision_status_{{ $revision->id }}"
                                            required
                                        >

                                            <option
                                                value="pending"
                                                {{ $revision->status === 'pending'
                                                    ? 'selected'
                                                    : ''
                                                }}
                                            >
                                                Pending
                                            </option>


                                            <option
                                                value="in_progress"
                                                {{ $revision->status === 'in_progress'
                                                    ? 'selected'
                                                    : ''
                                                }}
                                            >
                                                In Progress
                                            </option>


                                            <option
                                                value="resolved"
                                                {{ $revision->status === 'resolved'
                                                    ? 'selected'
                                                    : ''
                                                }}
                                            >
                                                Resolved
                                            </option>

                                        </select>


                                        <svg viewBox="0 0 24 24">
                                            <path d="M7 9l5 5 5-5"/>
                                        </svg>

                                    </div>

                                </div>



                                <div class="revision-form-group revision-response-group">

                                    <label
                                        for="architect_response_{{ $revision->id }}"
                                    >
                                        Architect Response / Progress Notes
                                    </label>


                                    <textarea
                                        name="architect_response"
                                        id="architect_response_{{ $revision->id }}"
                                        rows="4"
                                        maxlength="5000"
                                        placeholder="Add your response, progress update, or note for the client..."
                                    >{{ old(
                                        'architect_response',
                                        $revision->architect_response
                                    ) }}</textarea>

                                </div>

                            </div>


                            <!-- ARCHITECT REVISED FILE -->
                            <div class="revision-attachment-section">

                                <div class="revision-attachment-heading">
                                    <div>
                                        <label for="revised_file_{{ $revision->id }}">
                                            Revised File
                                        </label>
                                        <p>
                                            Attach the updated drawing, document, or file for this revision.
                                        </p>
                                    </div>
                                </div>

                                @if($revision->architect_file_path)
                                    <div class="revision-current-file">
                                        <div class="revision-current-file-icon">
                                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                                <path d="M14 2v6h6"/>
                                            </svg>
                                        </div>

                                        <div class="revision-current-file-info">
                                            <span>UPLOADED REVISED FILE</span>
                                            <strong>
                                                {{ $revision->architect_file_name ?? 'Revised File' }}
                                            </strong>
                                            <small>
                                                {{ strtoupper($revision->architect_file_type ?? 'FILE') }}
                                                @if($revision->architect_file_size)
                                                    ·
                                                    {{ number_format($revision->architect_file_size / 1024, 1) }} KB
                                                @endif
                                            </small>
                                        </div>

                                        <a
                                            href="{{ route(
                                                'architect.projects.revisions.file.download',
                                                [
                                                    'id' => $project->id,
                                                    'revision' => $revision->id
                                                ]
                                            ) }}"
                                            class="revision-current-file-download"
                                        >
                                            Download
                                        </a>
                                    </div>
                                @endif


                                <label
                                    for="revised_file_{{ $revision->id }}"
                                    class="revision-attachment-picker"
                                >
                                    <input
                                        type="file"
                                        name="revised_file"
                                        id="revised_file_{{ $revision->id }}"
                                        class="revision-attachment-input"
                                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                                        onchange="showRevisionFileName(this, {{ $revision->id }})"
                                    >

                                    <span class="revision-attachment-icon">
                                        <svg viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M12 16V4"/>
                                            <path d="M7 9l5-5 5 5"/>
                                            <path d="M5 20h14"/>
                                        </svg>
                                    </span>

                                    <span class="revision-attachment-details">
                                        <strong id="revision_file_name_{{ $revision->id }}">
                                            Upload Revised File
                                        </strong>
                                        <small id="revision_file_text_{{ $revision->id }}">
                                            JPG, PNG, PDF, Word or Excel · Max 100 MB per file
                                        </small>
                                    </span>

                                    <span class="revision-attachment-action">
                                        Choose File
                                    </span>
                                </label>

                                @error('revised_file')
                                    <div class="revision-attachment-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>



                            <div class="revision-form-footer">


                                <div class="revision-resolution-info">


                                    @if(
                                        $revision->status === 'resolved'
                                        &&
                                        $revision->resolved_at
                                    )

                                        <span class="resolved-check">

                                            <svg viewBox="0 0 24 24">

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="9"
                                                />

                                                <path d="M8 12l3 3 5-6"/>

                                            </svg>

                                        </span>


                                        <div>

                                            <strong>
                                                Resolved
                                            </strong>

                                            <span>

                                                {{ $revision
                                                    ->resolved_at
                                                    ->format(
                                                        'M d, Y · h:i A'
                                                    )
                                                }}

                                            </span>

                                        </div>


                                    @else

                                        <span class="revision-note-icon">

                                            <svg viewBox="0 0 24 24">

                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="9"
                                                />

                                                <path d="M12 11v5"/>
                                                <path d="M12 8h.01"/>

                                            </svg>

                                        </span>


                                        <span>
                                            Updating the status will be visible
                                            in this revision record.
                                        </span>

                                    @endif

                                </div>



                                <button
                                    type="submit"
                                    class="revision-update-button"
                                >

                                    <svg viewBox="0 0 24 24">

                                        <path d="M4 12l5 5L20 6"/>

                                    </svg>

                                    Update Revision

                                </button>

                            </div>

                        </form>

                    </article>


                @endforeach

            </div>


        @else


            <!-- =================================================
                EMPTY REVISIONS
            ================================================== -->

            <div class="revision-empty-state">


                <div class="revision-empty-visual">


                    <div class="revision-empty-grid"></div>

                    <div class="revision-empty-circle"></div>


                    <img
                        src="{{ asset('images/lineart3.png') }}"
                        alt=""
                    >


                    <div class="revision-floating-card revision-float-one">

                        <svg viewBox="0 0 24 24">

                            <path d="M4 5h16v12H8l-4 4z"/>
                            <path d="M8 9h8"/>

                        </svg>

                    </div>


                    <div class="revision-floating-card revision-float-two">

                        <svg viewBox="0 0 24 24">

                            <path d="M20 11a8 8 0 1 0-2 5.3"/>
                            <path d="M20 4v7h-7"/>

                        </svg>

                    </div>

                </div>


                <div class="revision-empty-copy">


                    <span class="section-label">
                        CLIENT REVISION REQUESTS
                    </span>


                    <h3>
                        No revision requests yet
                    </h3>


                    <p>
                        When the client submits a revision request,
                        it will appear here for review, tracking,
                        response, and resolution.
                    </p>


                    <div class="revision-empty-note">

                        <svg viewBox="0 0 24 24">

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path d="M12 11v5"/>
                            <path d="M12 8h.01"/>

                        </svg>


                        <span>
                            Revision requests are initiated by the client.
                        </span>

                    </div>

                </div>

            </div>


        @endif

    </section>

@endif

        <!-- =================================================
            MEETINGS
        ================================================== -->

        @if($activeTab === 'messages')

            @php
                $todayDate = now('Asia/Manila')->format('Y-m-d');

                $pendingMeetings =
                    $meetings
                        ->where('status', 'pending')
                        ->count();
            @endphp

            <section
                class="tab-panel meetings-panel"
                id="project-meetings"
                style="display:none"
            >

                <div class="section-header">

                    <div>

                        <span class="section-label">
                            MEETING MANAGEMENT
                        </span>

                        <h2>
                            Project Meetings
                        </h2>

                        <p>
                            Request, review, and manage meeting schedules with
                            {{ $project->client_name }}.
                        </p>

                    </div>

                    <button
                        type="button"
                        class="meeting-create-button"
                        onclick="openMeetingModal()"
                    >
                        Request Meeting
                    </button>

                </div>


                @if(session('success'))

                    <div class="meeting-success-message">
                        {{ session('success') }}
                    </div>

                @endif


                @if($errors->any())

                    <div class="meeting-error-message">

                        @foreach($errors->all() as $error)

                            <div>
                                {{ $error }}
                            </div>

                        @endforeach

                    </div>

                @endif


                <div class="meeting-summary-grid">

                    <div class="meeting-summary-card">
                        <span>TOTAL</span>
                        <strong>{{ $meetings->count() }}</strong>
                        <p>All meetings</p>
                    </div>

                    <div class="meeting-summary-card">
                        <span>PENDING</span>
                        <strong>{{ $pendingMeetings }}</strong>
                        <p>Waiting for approval</p>
                    </div>

                    <div class="meeting-summary-card">
                        <span>SCHEDULED</span>
                        <strong>{{ $scheduledMeetings }}</strong>
                        <p>Upcoming meetings</p>
                    </div>

                    <div class="meeting-summary-card">
                        <span>COMPLETED</span>
                        <strong>{{ $completedMeetings }}</strong>
                        <p>Completed meetings</p>
                    </div>

                    <div class="meeting-summary-card">
                        <span>CANCELLED</span>
                        <strong>{{ $cancelledMeetings }}</strong>
                        <p>Cancelled meetings</p>
                    </div>

                </div>


                @if($meetings->count() > 0)

                    <div class="meeting-list">

                        @foreach($meetings as $meeting)

                            @php
                                $meetingEnd =
                                    $meeting->end_time
                                        ?: $meeting->start_time;

                                $meetingDateTime =
                                    \Carbon\Carbon::parse(
                                        $meeting->meeting_date->format('Y-m-d')
                                        . ' '
                                        . $meetingEnd
                                    );

                                $isPastMeeting =
                                    $meetingDateTime->isPast();

                                $meetingStatusLabel =
                                    match($meeting->status) {
                                        'scheduled' => 'Scheduled',
                                        'completed' => 'Completed',
                                        'cancelled' => 'Cancelled',
                                        default => ucfirst($meeting->status)
                                    };

                                $meetingTypeLabel =
                                    $meeting->meeting_type === 'online'
                                        ? 'Online'
                                        : 'In Person';


                                /*
                                |--------------------------------------------------------------------------
                                | CURRENT MEETING PROPOSAL OWNER
                                |--------------------------------------------------------------------------
                                |
                                | Legacy Pending records without proposed_by were
                                | Client requests before the proposal fields existed.
                                |
                                */

                                $meetingProposalOwner =
                                    $meeting->proposed_by;

                                if (
                                    !$meetingProposalOwner
                                    &&
                                    $meeting->status === 'pending'
                                ) {
                                    $meetingProposalOwner =
                                        'client';
                                }


                                $waitingForArchitectApproval =
                                    $meeting->status === 'pending'
                                    &&
                                    $meetingProposalOwner === 'client';


                                $waitingForClientApproval =
                                    $meeting->status === 'pending'
                                    &&
                                    $meetingProposalOwner === 'architect';


                                if ($meeting->status === 'pending') {

                                    $meetingStatusLabel =
                                        'Pending Approval';
                                }
                            @endphp


                            <article
                                class="
                                    meeting-card
                                    meeting-card-{{ $meeting->status }}
                                    {{ $isPastMeeting ? 'meeting-card-past' : '' }}
                                "
                                id="meeting-{{ $meeting->id }}"
                            >

                                <div class="meeting-simple-row">

                                    <div class="meeting-date-block">

                                        <span>
                                            {{ $meeting->meeting_date->format('M') }}
                                        </span>

                                        <strong>
                                            {{ $meeting->meeting_date->format('d') }}
                                        </strong>

                                        <small>
                                            {{ $meeting->meeting_date->format('Y') }}
                                        </small>

                                    </div>


                                    <div class="meeting-simple-info">

                                        <span class="meeting-number">
                                            MEETING #
                                            {{ str_pad(
                                                $meeting->id,
                                                3,
                                                '0',
                                                STR_PAD_LEFT
                                            ) }}
                                        </span>

                                        <h3>
                                            {{ $meeting->title }}
                                        </h3>

                                        <div class="meeting-simple-meta">

                                            <span>
                                                {{ \Carbon\Carbon::parse(
                                                    $meeting->start_time
                                                )->format('h:i A') }}

                                                @if($meeting->end_time)
                                                    –
                                                    {{ \Carbon\Carbon::parse(
                                                        $meeting->end_time
                                                    )->format('h:i A') }}
                                                @endif
                                            </span>

                                            <span class="meeting-meta-dot"></span>

                                            <span>
                                                {{ $meetingTypeLabel }}
                                            </span>

                                            @if($isPastMeeting)

                                                <span class="meeting-meta-dot"></span>

                                                <span class="meeting-past-label">
                                                    Past
                                                </span>

                                            @endif

                                        </div>

                                    </div>


                                    <div class="meeting-simple-actions">

                                        <span
                                            class="
                                                meeting-status-badge
                                                meeting-status-{{ $meeting->status }}
                                            "
                                        >
                                            {{ $meetingStatusLabel }}
                                        </span>

                                        @if($waitingForArchitectApproval)

                                            <span class="meeting-response-badge">
                                                Your Approval Needed
                                            </span>

                                        @elseif($waitingForClientApproval)

                                            <span class="meeting-response-badge waiting-client">
                                                Waiting for Client
                                            </span>

                                        @endif

                                        <button
                                            type="button"
                                            class="meeting-details-toggle"
                                            id="meetingToggleButton{{ $meeting->id }}"
                                            onclick="toggleMeetingDetails({{ $meeting->id }})"
                                        >
                                            <span>
                                                View Details
                                            </span>

                                            <svg viewBox="0 0 24 24">
                                                <path d="M7 9l5 5 5-5"/>
                                            </svg>
                                        </button>

                                    </div>

                                </div>


                                <div
                                    class="meeting-expanded-details"
                                    id="meetingDetails{{ $meeting->id }}"
                                >

                                    <div class="meeting-details-grid">

                                        <div class="meeting-detail-card">

                                            <span>
                                                {{ $meeting->meeting_type === 'online'
                                                    ? 'MEETING LINK'
                                                    : 'LOCATION'
                                                }}
                                            </span>

                                            @if($meeting->meeting_type === 'online')

                                                @if($meeting->meeting_link)

                                                    @if(!$isPastMeeting)

                                                        <a
                                                            href="{{ $meeting->meeting_link }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                        >
                                                            Open Meeting Link
                                                        </a>

                                                    @else

                                                        <strong>
                                                            Meeting ended
                                                        </strong>

                                                    @endif

                                                @else

                                                    <strong>
                                                        Not provided
                                                    </strong>

                                                @endif

                                            @else

                                                <strong>
                                                    {{ $meeting->location ?: 'Not provided' }}
                                                </strong>

                                            @endif

                                        </div>


                                        <div class="meeting-detail-card">

                                            <span>
                                                CLIENT
                                            </span>

                                            <strong>
                                                {{ $meeting->client->name
                                                    ?? $project->client_name
                                                }}
                                            </strong>

                                        </div>

                                    </div>


                                    <div class="meeting-agenda">

                                        <span>
                                            MEETING AGENDA
                                        </span>

                                        <p>
                                            {{ $meeting->agenda
                                                ?: 'No meeting agenda has been added.'
                                            }}
                                        </p>

                                    </div>


                                    @if($meeting->notes)

                                        <div class="meeting-history-notes">

                                            <span>
                                                MEETING NOTE
                                            </span>

                                            <p>
                                                {{ $meeting->notes }}
                                            </p>

                                        </div>

                                    @endif


                                    @if($isPastMeeting)

                                        <div class="meeting-past-notice">

                                            <strong>
                                                Past Meeting
                                            </strong>

                                            <span>
                                                This meeting is now view only.
                                            </span>

                                        </div>

                                        @if($meeting->notes)

                                            <div class="meeting-history-notes">

                                                <span>
                                                    MEETING NOTES
                                                </span>

                                                <p>
                                                    {{ $meeting->notes }}
                                                </p>

                                            </div>

                                        @endif

                                    @else

                                        @if($waitingForArchitectApproval)

                                            <div class="meeting-approval-banner">

                                                <strong>
                                                    Client meeting request requires your response
                                                </strong>

                                                <span>
                                                    Review the proposed schedule. Approving confirms
                                                    the meeting. If you change the date, time, type,
                                                    link, location, or meeting details, the edited
                                                    version becomes your new proposal and the client
                                                    must approve it.
                                                </span>


                                                <div class="meeting-approval-actions">

                                                    <button
                                                        type="button"
                                                        class="meeting-approval-action approve"
                                                        onclick="prepareMeetingResponse(
                                                            {{ $meeting->id }},
                                                            'scheduled'
                                                        )"
                                                    >
                                                        Approve
                                                    </button>


                                                    <button
                                                        type="button"
                                                        class="meeting-approval-action reject"
                                                        onclick="prepareMeetingResponse(
                                                            {{ $meeting->id }},
                                                            'cancelled'
                                                        )"
                                                    >
                                                        Reject
                                                    </button>


                                                    <button
                                                        type="button"
                                                        class="meeting-approval-action reschedule"
                                                        onclick="prepareMeetingResponse(
                                                            {{ $meeting->id }},
                                                            'pending',
                                                            true
                                                        )"
                                                    >
                                                        Propose New Schedule
                                                    </button>

                                                </div>

                                            </div>


                                        @elseif($waitingForClientApproval)

                                            <div class="meeting-approval-banner waiting-client">

                                                <strong>
                                                    Waiting for client approval
                                                </strong>

                                                <span>
                                                    You proposed this meeting schedule. The client
                                                    must approve it before the meeting becomes
                                                    confirmed. You may still edit the proposal or
                                                    withdraw it while it is pending.
                                                </span>

                                            </div>

                                        @endif


                                        <div class="meeting-edit-bar">

                                            <div>

                                                <strong>
                                                    {{ $waitingForArchitectApproval
                                                        ? 'Review Meeting Request'
                                                        : (
                                                            $waitingForClientApproval
                                                                ? 'Pending Meeting Proposal'
                                                                : 'Meeting Settings'
                                                        )
                                                    }}
                                                </strong>

                                                <span>
                                                    @if($waitingForArchitectApproval)
                                                        Approve, reject, or propose a new schedule.
                                                    @elseif($waitingForClientApproval)
                                                        Edit your proposal or withdraw the request.
                                                    @else
                                                        Edit this meeting when needed.
                                                    @endif
                                                </span>

                                            </div>

                                            <button
                                                type="button"
                                                class="meeting-edit-button"
                                                onclick="toggleMeetingEdit({{ $meeting->id }})"
                                            >
                                                {{ $waitingForArchitectApproval
                                                    ? 'Review Request'
                                                    : 'Edit Meeting'
                                                }}
                                            </button>

                                        </div>


                                        <div
                                            class="meeting-edit-section"
                                            id="meetingEdit{{ $meeting->id }}"
                                        >

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'architect.projects.meetings.update',
                                                    [
                                                        'id' => $project->id,
                                                        'meeting' => $meeting->id
                                                    ]
                                                ) }}"
                                                class="meeting-update-form"
                                            >

                                                @csrf
                                                @method('PUT')

                                                <div class="meeting-edit-grid">

                                                    <div class="meeting-form-group">

                                                        <label>
                                                            Meeting Title
                                                        </label>

                                                        <input
                                                            type="text"
                                                            name="title"
                                                            value="{{ $meeting->title }}"
                                                            maxlength="255"
                                                            required
                                                        >

                                                    </div>


                                                    <div class="meeting-form-group">

                                                        <label>
                                                            Status
                                                        </label>

                                                        <div class="meeting-select-wrap">

                                                            <select
                                                                name="status"
                                                                id="meetingStatus{{ $meeting->id }}"
                                                                required
                                                            >

                                                                @if($waitingForArchitectApproval)

                                                                    <option
                                                                        value="pending"
                                                                        {{ $meeting->status === 'pending'
                                                                            ? 'selected'
                                                                            : ''
                                                                        }}
                                                                    >
                                                                        Pending Review
                                                                    </option>

                                                                    <option value="scheduled">
                                                                        Approve / Scheduled
                                                                    </option>

                                                                    <option value="cancelled">
                                                                        Reject / Cancelled
                                                                    </option>


                                                                @elseif($waitingForClientApproval)

                                                                    <option
                                                                        value="pending"
                                                                        selected
                                                                    >
                                                                        Pending Client Approval
                                                                    </option>

                                                                    <option value="cancelled">
                                                                        Withdraw / Cancel
                                                                    </option>


                                                                @else

                                                                    <option
                                                                        value="scheduled"
                                                                        {{ $meeting->status === 'scheduled'
                                                                            ? 'selected'
                                                                            : ''
                                                                        }}
                                                                    >
                                                                        Scheduled
                                                                    </option>

                                                                    <option
                                                                        value="completed"
                                                                        {{ $meeting->status === 'completed'
                                                                            ? 'selected'
                                                                            : ''
                                                                        }}
                                                                    >
                                                                        Completed
                                                                    </option>

                                                                    <option
                                                                        value="cancelled"
                                                                        {{ $meeting->status === 'cancelled'
                                                                            ? 'selected'
                                                                            : ''
                                                                        }}
                                                                    >
                                                                        Cancelled
                                                                    </option>

                                                                @endif

                                                            </select>

                                                            <svg viewBox="0 0 24 24">
                                                                <path d="M7 9l5 5 5-5"/>
                                                            </svg>

                                                        </div>

                                                    </div>


                                                    <div class="meeting-form-group">

                                                        <label>
                                                            Meeting Type
                                                        </label>

                                                        <div class="meeting-select-wrap">

                                                            <select
                                                                name="meeting_type"
                                                                class="meeting-type-select"
                                                                required
                                                            >

                                                                <option
                                                                    value="online"
                                                                    {{ $meeting->meeting_type === 'online'
                                                                        ? 'selected'
                                                                        : ''
                                                                    }}
                                                                >
                                                                    Online
                                                                </option>

                                                                <option
                                                                    value="in_person"
                                                                    {{ $meeting->meeting_type === 'in_person'
                                                                        ? 'selected'
                                                                        : ''
                                                                    }}
                                                                >
                                                                    In Person
                                                                </option>

                                                            </select>

                                                            <svg viewBox="0 0 24 24">
                                                                <path d="M7 9l5 5 5-5"/>
                                                            </svg>

                                                        </div>

                                                    </div>


                                                    <div class="meeting-form-group">

                                                        <label>
                                                            Date
                                                        </label>

                                                        <input
                                                            type="date"
                                                            name="meeting_date"
                                                            id="meetingDate{{ $meeting->id }}"
                                                            value="{{ $meeting->meeting_date->format('Y-m-d') }}"
                                                            min="{{ $todayDate }}"
                                                            required
                                                        >

                                                    </div>


                                                    <div class="meeting-form-group">

                                                        <label>
                                                            Start Time
                                                        </label>

                                                        <input
                                                            type="time"
                                                            name="start_time"
                                                            value="{{ \Carbon\Carbon::parse(
                                                                $meeting->start_time
                                                            )->format('H:i') }}"
                                                            required
                                                        >

                                                    </div>


                                                    <div class="meeting-form-group">

                                                        <label>
                                                            End Time
                                                        </label>

                                                        <input
                                                            type="time"
                                                            name="end_time"
                                                            value="{{ $meeting->end_time
                                                                ? \Carbon\Carbon::parse(
                                                                    $meeting->end_time
                                                                )->format('H:i')
                                                                : ''
                                                            }}"
                                                        >

                                                    </div>


                                                    <div
                                                        class="
                                                            meeting-form-group
                                                            meeting-online-field
                                                        "
                                                    >

                                                        <label>
                                                            Meeting Link
                                                        </label>

                                                        <input
                                                            type="url"
                                                            name="meeting_link"
                                                            value="{{ $meeting->meeting_link }}"
                                                            placeholder="https://meet.google.com/..."
                                                        >

                                                    </div>


                                                    <div
                                                        class="
                                                            meeting-form-group
                                                            meeting-location-field
                                                        "
                                                    >

                                                        <label>
                                                            Location
                                                        </label>

                                                        <input
                                                            type="text"
                                                            name="location"
                                                            value="{{ $meeting->location }}"
                                                            maxlength="500"
                                                            placeholder="Meeting location"
                                                        >

                                                    </div>


                                                    <div
                                                        class="
                                                            meeting-form-group
                                                            meeting-full-field
                                                        "
                                                    >

                                                        <label>
                                                            Agenda
                                                        </label>

                                                        <textarea
                                                            name="agenda"
                                                            rows="3"
                                                            maxlength="3000"
                                                            placeholder="Meeting agenda..."
                                                        >{{ $meeting->agenda }}</textarea>

                                                    </div>


                                                    <div
                                                        class="
                                                            meeting-form-group
                                                            meeting-full-field
                                                        "
                                                    >

                                                        <label>
                                                            Meeting Notes
                                                        </label>

                                                        <textarea
                                                            name="notes"
                                                            rows="3"
                                                            maxlength="3000"
                                                            placeholder="Notes or follow-up items..."
                                                        >{{ $meeting->notes }}</textarea>

                                                    </div>

                                                </div>


                                                <div class="meeting-edit-actions">

                                                    <button
                                                        type="button"
                                                        class="meeting-edit-cancel"
                                                        onclick="toggleMeetingEdit({{ $meeting->id }})"
                                                    >
                                                        Cancel
                                                    </button>

                                                    <button
                                                        type="submit"
                                                        class="meeting-update-button"
                                                    >
                                                        Save Changes
                                                    </button>

                                                </div>

                                            </form>


                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'architect.projects.meetings.destroy',
                                                    [
                                                        'id' => $project->id,
                                                        'meeting' => $meeting->id
                                                    ]
                                                ) }}"
                                                class="meeting-delete-form"
                                                onsubmit="return confirm('Delete this meeting?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="meeting-delete-button"
                                                >
                                                    Delete Meeting
                                                </button>

                                            </form>

                                        </div>

                                    @endif

                                </div>

                            </article>

                        @endforeach

                    </div>

                @else

                    <div class="meeting-empty-state">

                        <h3>
                            No meeting requests yet
                        </h3>

                        <p>
                            Send your first meeting request to
                            {{ $project->client_name }}.
                        </p>

                        <button
                            type="button"
                            class="meeting-empty-button"
                            onclick="openMeetingModal()"
                        >
                            Request Meeting
                        </button>

                    </div>

                @endif


                <!-- CREATE MEETING MODAL -->

                <div
                    class="meeting-modal"
                    id="meetingModal"
                >

                    <div
                        class="meeting-modal-backdrop"
                        onclick="closeMeetingModal()"
                    ></div>

                    <div class="meeting-modal-card">

                        <div class="meeting-modal-header">

                            <div>

                                <span class="section-label">
                                    MEETING REQUEST
                                </span>

                                <h3>
                                    Request a Meeting
                                </h3>

                                <p>
                                    Propose a meeting schedule to
                                    {{ $project->client_name }} for approval.
                                </p>

                            </div>

                            <button
                                type="button"
                                class="meeting-modal-close"
                                onclick="closeMeetingModal()"
                            >
                                ×
                            </button>

                        </div>


                        <form
                            method="POST"
                            action="{{ route(
                                'architect.projects.meetings.store',
                                ['id' => $project->id]
                            ) }}"
                            class="meeting-create-form"
                            id="createMeetingForm"
                        >

                            @csrf

                            <div class="meeting-modal-grid">

                                <div
                                    class="
                                        meeting-form-group
                                        meeting-full-field
                                    "
                                >

                                    <label>
                                        Meeting Title
                                        <span>*</span>
                                    </label>

                                    <input
                                        type="text"
                                        name="title"
                                        value="{{ old('title') }}"
                                        maxlength="255"
                                        placeholder="Example: Design Review"
                                        required
                                    >

                                </div>


                                <div class="meeting-form-group">

                                    <label>
                                        Meeting Type
                                        <span>*</span>
                                    </label>

                                    <div class="meeting-select-wrap">

                                        <select
                                            name="meeting_type"
                                            id="createMeetingType"
                                            required
                                        >

                                            <option
                                                value="online"
                                                {{ old('meeting_type') === 'online'
                                                    ? 'selected'
                                                    : ''
                                                }}
                                            >
                                                Online
                                            </option>

                                            <option
                                                value="in_person"
                                                {{ old('meeting_type') === 'in_person'
                                                    ? 'selected'
                                                    : ''
                                                }}
                                            >
                                                In Person
                                            </option>

                                        </select>

                                        <svg viewBox="0 0 24 24">
                                            <path d="M7 9l5 5 5-5"/>
                                        </svg>

                                    </div>

                                </div>


                                <div class="meeting-form-group">

                                    <label>
                                        Date
                                        <span>*</span>
                                    </label>

                                    <input
                                        type="date"
                                        name="meeting_date"
                                        id="createMeetingDate"
                                        value="{{ old('meeting_date') }}"
                                        min="{{ $todayDate }}"
                                        required
                                    >

                                </div>


                                <div class="meeting-form-group">

                                    <label>
                                        Start Time
                                        <span>*</span>
                                    </label>

                                    <input
                                        type="time"
                                        name="start_time"
                                        id="createMeetingStartTime"
                                        value="{{ old('start_time') }}"
                                        required
                                    >

                                </div>


                                <div class="meeting-form-group">

                                    <label>
                                        End Time
                                    </label>

                                    <input
                                        type="time"
                                        name="end_time"
                                        id="createMeetingEndTime"
                                        value="{{ old('end_time') }}"
                                    >

                                </div>


                                <div
                                    class="
                                        meeting-form-group
                                        meeting-full-field
                                    "
                                    id="createOnlineField"
                                >

                                    <label>
                                        Meeting Link
                                        <span>*</span>
                                    </label>

                                    <input
                                        type="url"
                                        name="meeting_link"
                                        value="{{ old('meeting_link') }}"
                                        placeholder="https://meet.google.com/..."
                                    >

                                </div>


                                <div
                                    class="
                                        meeting-form-group
                                        meeting-full-field
                                    "
                                    id="createLocationField"
                                >

                                    <label>
                                        Location
                                        <span>*</span>
                                    </label>

                                    <input
                                        type="text"
                                        name="location"
                                        value="{{ old('location') }}"
                                        maxlength="500"
                                        placeholder="Meeting location"
                                    >

                                </div>


                                <div
                                    class="
                                        meeting-form-group
                                        meeting-full-field
                                    "
                                >

                                    <label>
                                        Agenda
                                    </label>

                                    <textarea
                                        name="agenda"
                                        rows="4"
                                        maxlength="3000"
                                        placeholder="Meeting agenda..."
                                    >{{ old('agenda') }}</textarea>

                                </div>


                                <div
                                    class="
                                        meeting-form-group
                                        meeting-full-field
                                    "
                                >

                                    <label>
                                        Notes
                                    </label>

                                    <textarea
                                        name="notes"
                                        rows="3"
                                        maxlength="3000"
                                        placeholder="Optional notes..."
                                    >{{ old('notes') }}</textarea>

                                </div>

                            </div>


                            <div
                                class="meeting-date-warning"
                                id="meetingDateWarning"
                                style="display:none;"
                            >

                                <span>!</span>

                                <p>
                                    Please select a valid future schedule.
                                </p>

                            </div>


                            <div class="meeting-modal-actions">

                                <button
                                    type="button"
                                    class="meeting-cancel-button"
                                    onclick="closeMeetingModal()"
                                >
                                    Cancel
                                </button>

                                <button
                                    type="submit"
                                    class="meeting-save-button"
                                >
                                    Send Meeting Request
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </section>

        @endif


        <!-- =================================================
            AI HISTORY
        ================================================== -->

        @if($activeTab === 'ai')

    <section class="tab-panel ai-history-panel">

        <div class="section-header">

            <div>
                <span class="section-label">
                    CLIENT AI ACTIVITY
                </span>

                <h2>
                    AI History
                </h2>

                <p>
                    Review AI suggestions and generated images created
                    by the client for this project.
                </p>
            </div>

            <div class="ai-view-only-badge">
                View Only
            </div>

        </div>


        <!-- SUMMARY -->

        <div class="ai-summary-grid">

            <div class="ai-summary-card">
                <span>AI SUGGESTIONS</span>

                <strong>
                    {{ $clientAiSuggestions->count() }}
                </strong>

                <p>
                    Client conversations
                </p>
            </div>


            <div class="ai-summary-card">
                <span>GENERATED IMAGES</span>

                <strong>
                    {{ $clientAiImages->count() }}
                </strong>

                <p>
                    AI design references
                </p>
            </div>


            <div class="ai-summary-card">
                <span>TOTAL ACTIVITY</span>

                <strong>
                    {{
                        $clientAiSuggestions->count()
                        +
                        $clientAiImages->count()
                    }}
                </strong>

                <p>
                    Recorded AI activity
                </p>
            </div>

        </div>


        <!-- TABS -->

        <div class="ai-history-tabs">

            <button
                type="button"
                class="ai-history-tab active"
                data-ai-tab="suggestions"
            >
                Suggestions

                <span>
                    {{ $clientAiSuggestions->count() }}
                </span>
            </button>


            <button
                type="button"
                class="ai-history-tab"
                data-ai-tab="images"
            >
                Generated Images

                <span>
                    {{ $clientAiImages->count() }}
                </span>
            </button>

        </div>


        <!-- =====================================================
            SUGGESTIONS
        ====================================================== -->

        <div
            class="ai-history-content active"
            id="ai-suggestions"
        >

            @forelse($clientAiSuggestions as $history)

                <article class="ai-conversation-card">

                    <div class="ai-conversation-header">

                        <div class="ai-client-avatar">
                            {{
                                strtoupper(
                                    substr(
                                        $history->client->name ?? 'C',
                                        0,
                                        1
                                    )
                                )
                            }}
                        </div>


                        <div class="ai-conversation-user">

                            <strong>
                                {{ $history->client->name ?? 'Client' }}
                            </strong>

                            <span>
                                {{
                                    $history->created_at
                                        ->format('M d, Y • h:i A')
                                }}
                            </span>

                        </div>


                        <span class="ai-type-badge">
                            AI Suggestion
                        </span>

                    </div>


                    @if($history->prompt)

                        <div class="ai-message-row client">

                            <div class="ai-message-label">
                                Client
                            </div>

                            <div class="ai-message-bubble client-message">
                                {{ $history->prompt }}
                            </div>

                        </div>

                    @endif


                    @if($history->result_text)

                        <div class="ai-message-row assistant">

                            <div class="ai-message-label">
                                AI Assistant
                            </div>

                            <div class="ai-message-bubble ai-message">
                                {!! nl2br(e($history->result_text)) !!}
                            </div>

                        </div>

                    @endif

                </article>


            @empty

                <div class="ai-empty-state">

                    <div class="ai-empty-icon">
                        AI
                    </div>

                    <h3>
                        No AI suggestions yet
                    </h3>

                    <p>
                        AI suggestions created by the client will
                        appear here.
                    </p>

                </div>

            @endforelse

        </div>


        <!-- =====================================================
            GENERATED IMAGES
        ====================================================== -->

        <div
            class="ai-history-content"
            id="ai-images"
        >

            @if($clientAiImages->count() > 0)

                <div class="ai-image-grid">

                    @foreach($clientAiImages as $history)

                        <article class="ai-image-card">

                            <div class="ai-generated-image">

                                @if($history->generated_image_path)

                                    <img
                                        src="{{ route(
                                            'project.ai-history.generated.secure.view',
                                            [
                                                'projectId' =>
                                                    $project->id,

                                                'historyId' =>
                                                    $history->id
                                            ]
                                        ) }}"
                                        alt="AI generated design"
                                    >

                                @else

                                    <div class="ai-image-placeholder">
                                        No Image
                                    </div>

                                @endif


                                <span class="ai-image-badge">
                                    AI Generated
                                </span>

                            </div>


                            <div class="ai-image-info">

                                <div class="ai-image-user">

                                    <div class="ai-small-avatar">
                                        {{
                                            strtoupper(
                                                substr(
                                                    $history->client->name ?? 'C',
                                                    0,
                                                    1
                                                )
                                            )
                                        }}
                                    </div>


                                    <div>

                                        <strong>
                                            {{ $history->client->name ?? 'Client' }}
                                        </strong>

                                        <span>
                                            {{
                                                $history->created_at
                                                    ->format('M d, Y • h:i A')
                                            }}
                                        </span>

                                    </div>

                                </div>


                                @if($history->prompt)

                                    <div class="ai-image-prompt">

                                        <span>
                                            PROMPT
                                        </span>

                                        <p>
                                            {{ $history->prompt }}
                                        </p>

                                    </div>

                                @endif


                                <button
                                    type="button"
                                    class="ai-image-view-button"
                                    onclick="openAIImage(
                                        @js(
                                            route(
                                                'project.ai-history.generated.secure.view',
                                                [
                                                    'projectId' =>
                                                        $project->id,

                                                    'historyId' =>
                                                        $history->id
                                                ]
                                            )
                                        )
                                    )"
                                    {{ !$history->generated_image_path ? 'disabled' : '' }}
                                >
                                    View Image
                                </button>

                            </div>

                        </article>

                    @endforeach

                </div>


            @else

                <div class="ai-empty-state">

                    <div class="ai-empty-icon">
                        IMG
                    </div>

                    <h3>
                        No generated images yet
                    </h3>

                    <p>
                        Images generated by the client will
                        appear here.
                    </p>

                </div>

            @endif

        </div>


        <!-- VIEW ONLY NOTICE -->

        <div class="ai-readonly-notice">

            <strong>
                Architect View
            </strong>

            <span>
                This section shows the client's AI activity.
                AI generation is only available on the client side.
            </span>

        </div>


        <!-- IMAGE PREVIEW -->

        <div
            class="ai-image-modal"
            id="aiImageModal"
        >

            <div
                class="ai-image-modal-backdrop"
                onclick="closeAIImage()"
            ></div>


            <div class="ai-image-modal-content">

                <button
                    type="button"
                    class="ai-image-modal-close"
                    onclick="closeAIImage()"
                >
                    ×
                </button>


                <img
                    src=""
                    alt="AI generated design preview"
                    id="aiImagePreview"
                >

            </div>

        </div>

    </section>

@endif

    </main>

</div>



<!-- =====================================================
    JAVASCRIPT
====================================================== -->

<script>

/* =========================================================
   PROJECT TEAM MODAL
========================================================= */

function openProjectTeamModal()
{
    const modal =
        document.getElementById(
            'projectTeamModal'
        );

    if (!modal) {
        return;
    }

    modal.classList.add(
        'show'
    );

    document.body.classList.add(
        'modal-open'
    );
}


function closeProjectTeamModal()
{
    const modal =
        document.getElementById(
            'projectTeamModal'
        );

    if (!modal) {
        return;
    }

    modal.classList.remove(
        'show'
    );

    document.body.classList.remove(
        'modal-open'
    );
}


/* =========================================================
   FILE UPLOAD MODAL
========================================================= */

function openUploadModal()
{
    const modal =
        document.getElementById(
            'uploadModal'
        );

    if (!modal) {
        return;
    }

    modal.classList.add(
        'show'
    );

    document.body.classList.add(
        'modal-open'
    );
}


function closeUploadModal()
{
    const modal =
        document.getElementById(
            'uploadModal'
        );

    if (!modal) {
        return;
    }

    modal.classList.remove(
        'show'
    );

    document.body.classList.remove(
        'modal-open'
    );
}


/* =========================================================
   FILE VERSION MODAL
========================================================= */

function openVersionModal(fileId, fileName, currentVersion)
{
    const modal = document.getElementById('versionModal');
    const form = document.getElementById('versionUploadForm');
    const currentFileName = document.getElementById('versionCurrentFileName');
    const currentNumber = document.getElementById('versionCurrentNumber');
    const description = document.getElementById('versionModalDescription');

    if (!modal || !form) return;

    form.action =
        @json(url('/architect/projects/' . $project->id . '/files'))
        + '/' + fileId + '/version';

    if (currentFileName) currentFileName.textContent = fileName;

    if (currentNumber) {
        currentNumber.textContent =
            'Current version: V' + currentVersion
            + ' · New upload: V' + (Number(currentVersion) + 1);
    }

    if (description) {
        description.textContent =
            'Upload a revised version of ' + fileName + '.';
    }

    modal.classList.add('show');
    document.body.classList.add('modal-open');
}

function closeVersionModal()
{
    const modal = document.getElementById('versionModal');
    const form = document.getElementById('versionUploadForm');
    const fileName = document.getElementById('selectedVersionFileName');
    const fileText = document.getElementById('selectedVersionFileText');

    if (!modal) return;

    modal.classList.remove('show');
    document.body.classList.remove('modal-open');

    if (form) form.reset();
    if (fileName) fileName.textContent = 'Choose Revised File';
    if (fileText) fileText.textContent = 'Click here to browse your computer';
}

function showSelectedVersionFile()
{
    const input = document.getElementById('versionFileInput');
    const fileName = document.getElementById('selectedVersionFileName');
    const fileText = document.getElementById('selectedVersionFileText');

    if (!input || !input.files || input.files.length === 0) return;

    const file = input.files[0];

    if (fileName) fileName.textContent = file.name;
    if (fileText) fileText.textContent = formatFileSize(file.size);
}


/* =========================================================
   SELECTED PROJECT FILE
========================================================= */

function showSelectedFile()
{
    const input = document.getElementById('projectFileInput');
    const title = document.getElementById('selectedFileName');
    const detail = document.getElementById('selectedFileText');
    if (!input || !input.files || !input.files.length) return;
    const files = Array.from(input.files);
    if (title) title.textContent = files.length === 1 ? files[0].name : `${files.length} files selected`;
    if (detail) detail.textContent = files.map(file => `${file.name} (${formatFileSize(file.size)})`).join(' • ');
}

function validateSelectedUpload(input)
{
    if (!input || !input.files || !input.files.length) return true;
    const allowed = ['jpg','jpeg','png','pdf','doc','docx','xls','xlsx'];
    const maxBytes = 100 * 1024 * 1024;
    for (const file of input.files) {
        const ext = (file.name.split('.').pop() || '').toLowerCase();
        if (!allowed.includes(ext)) {
            alert(`${file.name}: unsupported file type.`);
            input.value = '';
            return false;
        }
        if (file.size > maxBytes) {
            alert(`${file.name}: exceeds the 100 MB per-file limit.`);
            input.value = '';
            return false;
        }
    }
    return true;
}

/* =========================================================
   FILE SIZE FORMATTER
========================================================= */

function formatFileSize(bytes)
{
    if (bytes >= 1073741824) {

        return (
            bytes / 1073741824
        ).toFixed(2)
        + ' GB';

    }


    if (bytes >= 1048576) {

        return (
            bytes / 1048576
        ).toFixed(2)
        + ' MB';

    }


    if (bytes >= 1024) {

        return (
            bytes / 1024
        ).toFixed(1)
        + ' KB';

    }


    return bytes + ' B';
}


/* =========================================================
   CLEAR MESSAGE ATTACHMENT
========================================================= */

function clearMessageAttachment()
{
    const input =
        document.getElementById(
            'messageAttachment'
        );

    const preview =
        document.getElementById(
            'messageAttachmentPreview'
        );

    const image =
        document.getElementById(
            'attachmentImagePreview'
        );

    const icon =
        document.getElementById(
            'attachmentPreviewIcon'
        );

    const fileName =
        document.getElementById(
            'messageSelectedFileName'
        );

    const fileSize =
        document.getElementById(
            'messageSelectedFileSize'
        );


    if (input) {

        input.value =
            '';

    }


    if (preview) {

        preview.classList.remove(
            'show'
        );

    }


    if (image) {

        image.src =
            '';

    }


    if (icon) {

        icon.classList.remove(
            'image-selected'
        );

    }


    if (fileName) {

        fileName.textContent =
            '';

    }


    if (fileSize) {

        fileSize.textContent =
            '';

    }
}


/* =========================================================
   MEETING MODAL
========================================================= */


    /*
    |--------------------------------------------------------------------------
    | PREPARE MEETING RESPONSE
    |--------------------------------------------------------------------------
    |
    | Opens the existing meeting editor and prepares the requested response.
    | The same ArchitectProjectMeetingController@update handles approval,
    | rejection, and counter-proposals.
    |
    */

    function prepareMeetingResponse(
        meetingId,
        status,
        focusSchedule = false
    ) {
        const editSection =
            document.getElementById(
                'meetingEdit' + meetingId
            );

        const statusSelect =
            document.getElementById(
                'meetingStatus' + meetingId
            );

        if (editSection) {
            editSection.classList.add('show');
        }

        if (statusSelect) {
            statusSelect.value =
                status;
        }

        if (focusSchedule) {

            const dateInput =
                document.getElementById(
                    'meetingDate' + meetingId
                );

            dateInput?.focus();
        }

        editSection?.scrollIntoView({
            behavior: 'smooth',
            block: 'nearest'
        });
    }


    function openMeetingModal()
{
    const modal =
        document.getElementById(
            'meetingModal'
        );


    if (!modal) {
        return;
    }


    modal.classList.add(
        'show'
    );


    document.body.classList.add(
        'modal-open'
    );


    updateCreateMeetingFields();
}


function closeMeetingModal()
{
    const modal =
        document.getElementById(
            'meetingModal'
        );


    if (!modal) {
        return;
    }


    modal.classList.remove(
        'show'
    );


    document.body.classList.remove(
        'modal-open'
    );
}


/* =========================================================
   VIEW MEETING DETAILS
========================================================= */

function toggleMeetingDetails(meetingId)
{
    const details =
        document.getElementById(
            'meetingDetails'
            + meetingId
        );

    const button =
        document.getElementById(
            'meetingToggleButton'
            + meetingId
        );


    if (
        !details
        ||
        !button
    ) {
        return;
    }


    const isOpen =
        details.classList.contains(
            'show'
        );


    if (isOpen) {

        details.classList.remove(
            'show'
        );


        button.classList.remove(
            'active'
        );


        const buttonText =
            button.querySelector(
                'span'
            );


        if (buttonText) {

            buttonText.textContent =
                'View Details';

        }

    } else {

        details.classList.add(
            'show'
        );


        button.classList.add(
            'active'
        );


        const buttonText =
            button.querySelector(
                'span'
            );


        if (buttonText) {

            buttonText.textContent =
                'Hide Details';

        }
    }
}


/* =========================================================
   EDIT MEETING
========================================================= */

function toggleMeetingEdit(meetingId)
{
    const editSection =
        document.getElementById(
            'meetingEdit'
            + meetingId
        );


    if (!editSection) {
        return;
    }


    editSection.classList.toggle(
        'show'
    );
}


/* =========================================================
   CREATE MEETING TYPE
========================================================= */

function updateCreateMeetingFields()
{
    const type =
        document.getElementById(
            'createMeetingType'
        );

    const onlineField =
        document.getElementById(
            'createOnlineField'
        );

    const locationField =
        document.getElementById(
            'createLocationField'
        );


    if (
        !type
        ||
        !onlineField
        ||
        !locationField
    ) {
        return;
    }


    const onlineInput =
        onlineField.querySelector(
            'input[name="meeting_link"]'
        );


    const locationInput =
        locationField.querySelector(
            'input[name="location"]'
        );


    if (
        type.value ===
        'online'
    ) {

        onlineField.style.display =
            'block';


        locationField.style.display =
            'none';


        if (onlineInput) {

            onlineInput.required =
                true;

        }


        if (locationInput) {

            locationInput.required =
                false;

        }

    } else {

        onlineField.style.display =
            'none';


        locationField.style.display =
            'block';


        if (onlineInput) {

            onlineInput.required =
                false;

        }


        if (locationInput) {

            locationInput.required =
                true;

        }
    }
}


/* =========================================================
   VALIDATE CREATE MEETING
========================================================= */

function validateMeetingSchedule()
{
    const date =
        document.getElementById(
            'createMeetingDate'
        );

    const start =
        document.getElementById(
            'createMeetingStartTime'
        );

    const end =
        document.getElementById(
            'createMeetingEndTime'
        );

    const warning =
        document.getElementById(
            'meetingDateWarning'
        );


    if (
        !date
        ||
        !start
    ) {
        return true;
    }


    if (warning) {

        warning.style.display =
            'none';

    }


    if (
        !date.value
        ||
        !start.value
    ) {
        return true;
    }


    const startDateTime =
        new Date(
            date.value
            + 'T'
            + start.value
        );


    const currentDateTime =
        new Date();


    if (
        startDateTime <=
        currentDateTime
    ) {

        if (warning) {

            warning.style.display =
                'flex';


            const warningText =
                warning.querySelector(
                    'p'
                );


            if (warningText) {

                warningText.textContent =
                    'You cannot schedule a meeting in the past.';

            }
        }


        return false;
    }


    if (
        end
        &&
        end.value
    ) {

        const endDateTime =
            new Date(
                date.value
                + 'T'
                + end.value
            );


        if (
            endDateTime <=
            startDateTime
        ) {

            if (warning) {

                warning.style.display =
                    'flex';


                const warningText =
                    warning.querySelector(
                        'p'
                    );


                if (warningText) {

                    warningText.textContent =
                        'End time must be later than the start time.';

                }
            }


            return false;
        }
    }


    return true;
}


/* =========================================================
   AI IMAGE PREVIEW
========================================================= */

function openAIImage(imageUrl)
{
    if (!imageUrl) {
        return;
    }


    const modal =
        document.getElementById(
            'aiImageModal'
        );

    const preview =
        document.getElementById(
            'aiImagePreview'
        );


    if (
        !modal
        ||
        !preview
    ) {
        return;
    }


    preview.src =
        imageUrl;


    modal.classList.add(
        'show'
    );


    document.body.classList.add(
        'modal-open'
    );
}


/* =========================================================
   CLOSE AI IMAGE PREVIEW
========================================================= */

function closeAIImage()
{
    const modal =
        document.getElementById(
            'aiImageModal'
        );

    const preview =
        document.getElementById(
            'aiImagePreview'
        );


    if (!modal) {
        return;
    }


    modal.classList.remove(
        'show'
    );


    document.body.classList.remove(
        'modal-open'
    );


    if (preview) {

        preview.src =
            '';

    }
}


/* =========================================================
   PHASE & MILESTONE MODALS
========================================================= */

function openPhaseModal()
{
    const modal = document.getElementById('phaseModal');

    if (!modal) return;

    modal.classList.add('show');
    document.body.classList.add('modal-open');
}

function closePhaseModal()
{
    const modal = document.getElementById('phaseModal');

    if (!modal) return;

    modal.classList.remove('show');
    document.body.classList.remove('modal-open');
}

function openMilestoneModal(phaseId, phaseName)
{
    const modal = document.getElementById('milestoneModal');
    const form = document.getElementById('milestoneForm');
    const label = document.getElementById('milestonePhaseName');

    if (!modal || !form) return;

    form.action =
        @json(url('/architect/projects/' . $project->id . '/phases'))
        + '/' + phaseId + '/milestones';

    if (label) {
        label.textContent =
            'Add a milestone under ' + phaseName + '.';
    }

    modal.classList.add('show');
    document.body.classList.add('modal-open');
}

function closeMilestoneModal()
{
    const modal = document.getElementById('milestoneModal');

    if (!modal) return;

    modal.classList.remove('show');
    document.body.classList.remove('modal-open');
}


/* =========================================================
   MAIN DOM READY
========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function ()
    {

        @if(
            $errors->has('architect_id')
            ||
            $errors->has('role')
            ||
            $errors->has('discipline')
        )

            openProjectTeamModal();

        @endif

        /* =====================================================
           MESSAGE ELEMENTS
        ===================================================== */

        const messageInput =
            document.getElementById(
                'messageInput'
            );

        const messageForm =
            document.getElementById(
                'messageForm'
            );

        const chatBody =
            document.getElementById(
                'chatBody'
            );

        const messageComposer =
            document.getElementById(
                'messageComposer'
            );

        const characterCount =
            document.getElementById(
                'messageCharacterCount'
            );

        const attachmentInput =
            document.getElementById(
                'messageAttachment'
            );

        const attachmentPreview =
            document.getElementById(
                'messageAttachmentPreview'
            );

        const attachmentName =
            document.getElementById(
                'messageSelectedFileName'
            );

        const attachmentSize =
            document.getElementById(
                'messageSelectedFileSize'
            );

        const attachmentImage =
            document.getElementById(
                'attachmentImagePreview'
            );

        const attachmentIcon =
            document.getElementById(
                'attachmentPreviewIcon'
            );

        const removeAttachmentButton =
            document.getElementById(
                'removeAttachmentButton'
            );


        /* =====================================================
           PRESENCE ELEMENTS
        ===================================================== */

        const presenceSelect =
            document.getElementById(
                'presenceSelect'
            );

        const presenceText =
            document.getElementById(
                'presenceCurrentText'
            );

        const presenceIndicator =
            document.getElementById(
                'presenceIndicator'
            );

        const presenceForm =
            document.getElementById(
                'presenceForm'
            );


        /* =====================================================
           MESSAGE PAGE SCROLL RESTORATION
        ===================================================== */

        const savedPageScroll =
            sessionStorage.getItem(
                'architrackMessagePageScroll'
            );

        const returnToComposer =
            sessionStorage.getItem(
                'architrackReturnToComposer'
            );


        if (
            savedPageScroll !==
            null
        ) {

            const restorePosition =
                function ()
                {

                    window.scrollTo(
                        0,
                        Number(
                            savedPageScroll
                        )
                    );

                };


            requestAnimationFrame(
                restorePosition
            );


            setTimeout(
                restorePosition,
                80
            );


            sessionStorage.removeItem(
                'architrackMessagePageScroll'
            );
        }


        /* =====================================================
           CHAT SCROLL TO BOTTOM
        ===================================================== */

        if (chatBody) {

            const scrollChatToBottom =
                function ()
                {

                    chatBody.scrollTop =
                        chatBody.scrollHeight;

                };


            requestAnimationFrame(
                scrollChatToBottom
            );


            setTimeout(
                scrollChatToBottom,
                100
            );
        }


        /* =====================================================
           RETURN TO MESSAGE COMPOSER
        ===================================================== */

        if (
            returnToComposer ===
            '1'
            &&
            messageComposer
        ) {

            setTimeout(
                function ()
                {

                    messageComposer
                        .scrollIntoView({
                            behavior: 'auto',
                            block: 'nearest'
                        });


                    if (chatBody) {

                        chatBody.scrollTop =
                            chatBody.scrollHeight;

                    }


                    sessionStorage.removeItem(
                        'architrackReturnToComposer'
                    );

                },
                120
            );
        }


        /* =====================================================
           MESSAGE AUTO RESIZE
        ===================================================== */

        function updateMessageInput()
        {
            if (!messageInput) {
                return;
            }


            messageInput.style.height =
                'auto';


            messageInput.style.height =
                Math.min(
                    messageInput.scrollHeight,
                    150
                )
                + 'px';


            if (characterCount) {

                characterCount.textContent =
                    messageInput.value.length
                    + ' / 5000';

            }
        }


        if (messageInput) {

            messageInput.addEventListener(
                'input',
                updateMessageInput
            );


            updateMessageInput();
        }


        /* =====================================================
           ENTER TO SEND MESSAGE
        ===================================================== */

        if (
            messageInput
            &&
            messageForm
        ) {

            messageInput.addEventListener(
                'keydown',
                function (event)
                {

                    if (
                        event.key ===
                        'Enter'
                        &&
                        !event.shiftKey
                    ) {

                        event.preventDefault();


                        const hasText =
                            messageInput
                                .value
                                .trim()
                                .length > 0;


                        const hasAttachment =
                            attachmentInput
                            &&
                            attachmentInput
                                .files
                                .length > 0;


                        if (
                            !hasText
                            &&
                            !hasAttachment
                        ) {
                            return;
                        }


                        messageForm
                            .requestSubmit();
                    }
                }
            );
        }


        /* =====================================================
           MESSAGE SUBMIT
        ===================================================== */

        if (messageForm) {

            messageForm.addEventListener(
                'submit',
                function ()
                {

                    sessionStorage.setItem(
                        'architrackMessagePageScroll',
                        String(
                            window.scrollY
                        )
                    );


                    sessionStorage.setItem(
                        'architrackReturnToComposer',
                        '1'
                    );


                    const sendButton =
                        document.getElementById(
                            'messageSendButton'
                        );


                    if (sendButton) {

                        sendButton.disabled =
                            true;


                        sendButton.style.opacity =
                            '.7';

                    }
                }
            );
        }


        /* =====================================================
           MESSAGE ATTACHMENT PREVIEW
        ===================================================== */

        if (attachmentInput) {

            attachmentInput.addEventListener(
                'change',
                function ()
                {

                    if (
                        !this.files
                        ||
                        this.files.length ===
                        0
                    ) {

                        clearMessageAttachment();

                        return;
                    }


                    const file =
                        this.files[0];


                    if (
                        !validateSelectedUpload(
                            this
                        )
                    ) {

                        clearMessageAttachment();

                        return;
                    }


                    if (attachmentPreview) {

                        attachmentPreview
                            .classList
                            .add(
                                'show'
                            );

                    }


                    if (attachmentName) {

                        attachmentName.textContent =
                            file.name;

                    }


                    if (attachmentSize) {

                        attachmentSize.textContent =
                            formatFileSize(
                                file.size
                            );

                    }


                    if (
                        file.type
                        &&
                        file.type.startsWith(
                            'image/'
                        )
                    ) {

                        const reader =
                            new FileReader();


                        reader.onload =
                            function (event)
                            {

                                if (attachmentImage) {

                                    attachmentImage.src =
                                        event.target.result;

                                }


                                if (attachmentIcon) {

                                    attachmentIcon
                                        .classList
                                        .add(
                                            'image-selected'
                                        );

                                }
                            };


                        reader.readAsDataURL(
                            file
                        );

                    } else {

                        if (attachmentImage) {

                            attachmentImage.src =
                                '';

                        }


                        if (attachmentIcon) {

                            attachmentIcon
                                .classList
                                .remove(
                                    'image-selected'
                                );

                        }
                    }
                }
            );
        }


        /* =====================================================
           REMOVE MESSAGE ATTACHMENT
        ===================================================== */

        if (removeAttachmentButton) {

            removeAttachmentButton
                .addEventListener(
                    'click',
                    function ()
                    {

                        clearMessageAttachment();

                    }
                );
        }


        /* =====================================================
           PRESENCE STATUS
        ===================================================== */

        if (
            presenceSelect
            &&
            presenceForm
        ) {

            presenceSelect.addEventListener(
                'change',
                function ()
                {

                    const newStatus =
                        this.value;


                    if (presenceText) {

                        presenceText.textContent =
                            newStatus
                                .charAt(0)
                                .toUpperCase()
                            +
                            newStatus
                                .slice(1);

                    }


                    if (presenceIndicator) {

                        presenceIndicator
                            .classList
                            .remove(
                                'presence-online',
                                'presence-idle',
                                'presence-away'
                            );


                        presenceIndicator
                            .classList
                            .add(
                                'presence-'
                                + newStatus
                            );

                    }


                    sessionStorage.setItem(
                        'architrackMessagePageScroll',
                        String(
                            window.scrollY
                        )
                    );


                    presenceForm.submit();
                }
            );
        }


        /* =====================================================
           CREATE MEETING ELEMENTS
        ===================================================== */

        const createMeetingType =
            document.getElementById(
                'createMeetingType'
            );

        const createMeetingDate =
            document.getElementById(
                'createMeetingDate'
            );

        const createMeetingStartTime =
            document.getElementById(
                'createMeetingStartTime'
            );

        const createMeetingEndTime =
            document.getElementById(
                'createMeetingEndTime'
            );

        const createMeetingForm =
            document.getElementById(
                'createMeetingForm'
            );


        if (createMeetingType) {

            createMeetingType
                .addEventListener(
                    'change',
                    updateCreateMeetingFields
                );


            updateCreateMeetingFields();
        }


        if (createMeetingDate) {

            createMeetingDate
                .addEventListener(
                    'change',
                    validateMeetingSchedule
                );
        }


        if (createMeetingStartTime) {

            createMeetingStartTime
                .addEventListener(
                    'change',
                    validateMeetingSchedule
                );
        }


        if (createMeetingEndTime) {

            createMeetingEndTime
                .addEventListener(
                    'change',
                    validateMeetingSchedule
                );
        }


        if (createMeetingForm) {

            createMeetingForm
                .addEventListener(
                    'submit',
                    function (event)
                    {

                        if (
                            !validateMeetingSchedule()
                        ) {

                            event.preventDefault();

                            return false;
                        }
                    }
                );
        }


        /* =====================================================
           EXISTING MEETING ONLINE / IN PERSON
        ===================================================== */

        document
            .querySelectorAll(
                '.meeting-type-select'
            )
            .forEach(
                function (select)
                {

                    const form =
                        select.closest(
                            '.meeting-update-form'
                        );


                    if (!form) {
                        return;
                    }


                    const onlineField =
                        form.querySelector(
                            '.meeting-online-field'
                        );


                    const locationField =
                        form.querySelector(
                            '.meeting-location-field'
                        );


                    const onlineInput =
                        onlineField
                            ? onlineField.querySelector(
                                'input[name="meeting_link"]'
                            )
                            : null;


                    const locationInput =
                        locationField
                            ? locationField.querySelector(
                                'input[name="location"]'
                            )
                            : null;


                    function updateMeetingFields()
                    {
                        if (
                            !onlineField
                            ||
                            !locationField
                        ) {
                            return;
                        }


                        if (
                            select.value ===
                            'online'
                        ) {

                            onlineField.style.display =
                                'block';


                            locationField.style.display =
                                'none';


                            if (onlineInput) {

                                onlineInput.required =
                                    true;

                            }


                            if (locationInput) {

                                locationInput.required =
                                    false;

                            }

                        } else {

                            onlineField.style.display =
                                'none';


                            locationField.style.display =
                                'block';


                            if (onlineInput) {

                                onlineInput.required =
                                    false;

                            }


                            if (locationInput) {

                                locationInput.required =
                                    true;

                            }
                        }
                    }


                    select.addEventListener(
                        'change',
                        updateMeetingFields
                    );


                    updateMeetingFields();
                }
            );


        /* =====================================================
           AI HISTORY TABS
        ===================================================== */

        const aiTabs =
            document.querySelectorAll(
                '.ai-history-tab'
            );

        const aiContents =
            document.querySelectorAll(
                '.ai-history-content'
            );


        if (
            aiTabs.length > 0
            &&
            aiContents.length > 0
        ) {

            aiTabs.forEach(
                function (button)
                {

                    button.addEventListener(
                        'click',
                        function ()
                        {

                            const target =
                                button.getAttribute(
                                    'data-ai-tab'
                                );


                            if (!target) {
                                return;
                            }


                            aiTabs.forEach(
                                function (tab)
                                {

                                    tab.classList.remove(
                                        'active'
                                    );

                                }
                            );


                            aiContents.forEach(
                                function (content)
                                {

                                    content.classList.remove(
                                        'active'
                                    );

                                }
                            );


                            button.classList.add(
                                'active'
                            );


                            const targetContent =
                                document.getElementById(
                                    'ai-'
                                    + target
                                );


                            if (targetContent) {

                                targetContent.classList.add(
                                    'active'
                                );

                            }
                        }
                    );
                }
            );
        }


        /* =====================================================
           CLOSE MODALS USING ESCAPE
        ===================================================== */

        document.addEventListener(
            'keydown',
            function (event)
            {

                if (
                    event.key ===
                    'Escape'
                ) {

                    const projectTeamModal =
                        document.getElementById(
                            'projectTeamModal'
                        );


                    const uploadModal =
                        document.getElementById(
                            'uploadModal'
                        );


                    const versionModal =
                        document.getElementById(
                            'versionModal'
                        );


                    const meetingModal =
                        document.getElementById(
                            'meetingModal'
                        );


                    const aiImageModal =
                        document.getElementById(
                            'aiImageModal'
                        );


                    if (
                        projectTeamModal
                        &&
                        projectTeamModal.classList.contains(
                            'show'
                        )
                    ) {

                        closeProjectTeamModal();

                    }


                    if (
                        uploadModal
                        &&
                        uploadModal.classList.contains(
                            'show'
                        )
                    ) {

                        closeUploadModal();

                    }


                    if (
                        versionModal
                        &&
                        versionModal.classList.contains(
                            'show'
                        )
                    ) {
                        closeVersionModal();
                    }


                    if (
                        meetingModal
                        &&
                        meetingModal.classList.contains(
                            'show'
                        )
                    ) {

                        closeMeetingModal();

                    }


                    if (
                        aiImageModal
                        &&
                        aiImageModal.classList.contains(
                            'show'
                        )
                    ) {

                        closeAIImage();

                    }
                }
            }
        );

    }
);



function showRevisionFileName(input, revisionId)
{
    const nameEl = document.getElementById(
        'revision_file_name_' + revisionId
    );

    const textEl = document.getElementById(
        'revision_file_text_' + revisionId
    );

    if (!input || !input.files || input.files.length === 0) {
        if (nameEl) nameEl.textContent = 'Choose Revised File';
        if (textEl) textEl.textContent = 'JPG, JPEG, PNG, PDF, Word, or Excel';
        return;
    }

    const file = input.files[0];
    const allowed = [
        'jpg', 'jpeg', 'png', 'pdf',
        'doc', 'docx', 'xls', 'xlsx'
    ];

    const extension = file.name.includes('.')
        ? file.name.split('.').pop().toLowerCase()
        : '';

    if (!allowed.includes(extension)) {
        alert('Only JPG, JPEG, PNG, PDF, DOC, DOCX, XLS, and XLSX files are allowed.');
        input.value = '';
        if (nameEl) nameEl.textContent = 'Choose Revised File';
        if (textEl) textEl.textContent = 'JPG, JPEG, PNG, PDF, Word, or Excel';
        return;
    }

    const isImage = ['jpg', 'jpeg', 'png'].includes(extension);
    const maxSize = isImage
        ? 100 * 1024 * 1024
        : 10 * 1024 * 1024;

    if (file.size > maxSize) {
        alert(
            isImage
                ? 'Files cannot be larger than 100 MB.'
                : 'Files cannot be larger than 100 MB.'
        );

        input.value = '';
        if (nameEl) nameEl.textContent = 'Choose Revised File';
        if (textEl) textEl.textContent = 'JPG, JPEG, PNG, PDF, Word, or Excel';
        return;
    }

    if (nameEl) {
        nameEl.textContent = file.name;
    }

    if (textEl) {
        const size = file.size < 1024 * 1024
            ? (file.size / 1024).toFixed(1) + ' KB'
            : (file.size / (1024 * 1024)).toFixed(1) + ' MB';

        textEl.textContent = size + ' · Ready to upload';
    }
}

</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const projectChat = document.getElementById('project-chat');

    if (!projectChat) {
        return;
    }

    const layout = projectChat.querySelector('.messenger-layout');
    const chatMain = projectChat.querySelector('.chat-main');
    const clientPanel = projectChat.querySelector('.chat-sidebar');
    const aiPanel = projectChat.querySelector('.client-ai-panel');
    const chatHeader = projectChat.querySelector('.chat-header');

    if (!layout || !chatMain || !chatHeader) {
        return;
    }

    // Build one slide-out panel so the chat can use the full workspace.
    const overlay = document.createElement('div');
    overlay.className = 'messenger-info-overlay';

    const drawer = document.createElement('aside');
    drawer.className = 'messenger-info-drawer';
    drawer.setAttribute('aria-hidden', 'true');

    drawer.innerHTML = `
        <div class="messenger-drawer-head">
            <strong>Project Conversation</strong>
            <button
                type="button"
                class="messenger-drawer-close"
                aria-label="Close project information"
            >×</button>
        </div>

        <div class="messenger-drawer-body"></div>
    `;

    layout.appendChild(overlay);
    layout.appendChild(drawer);

    const drawerBody = drawer.querySelector('.messenger-drawer-body');

    function createDrawerSection(title, contentNode, openByDefault) {
        if (!contentNode) {
            return;
        }

        const section = document.createElement('section');
        section.className =
            'messenger-drawer-section' +
            (openByDefault ? ' open' : '');

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'messenger-drawer-section-button';
        button.innerHTML = `
            <span>${title}</span>
            <span>›</span>
        `;

        const content = document.createElement('div');
        content.className = 'messenger-drawer-section-content';

        content.appendChild(contentNode);
        section.appendChild(button);
        section.appendChild(content);
        drawerBody.appendChild(section);

        button.addEventListener('click', function () {
            section.classList.toggle('open');
        });
    }

    createDrawerSection(
        'Client Details',
        clientPanel,
        true
    );

    const meetingsPanel = document.getElementById('project-meetings');
    if (meetingsPanel) {
        meetingsPanel.style.display = '';
        const meetingModal = document.getElementById('meetingModal');
        if (meetingModal) {
            // Keep the fixed-position modal outside the transformed drawer.
            document.body.appendChild(meetingModal);
        }
        createDrawerSection(
            'Meetings' + (@json($workspacePendingMeetings) > 0 ? ' (' + @json($workspacePendingMeetings) + ' pending)' : ''),
            meetingsPanel,
            @json(request('tab') === 'meetings' || request('panel') === 'meetings')
        );
    }

    createDrawerSection(
        'AI Activity & History',
        aiPanel,
        false
    );

    // Clicking the Project Info area in the chat header opens the drawer.
    chatHeader.addEventListener('click', function (event) {
        const rect = chatHeader.getBoundingClientRect();

        // Only use the right side of the header as the Project Info hit area.
        if (event.clientX >= rect.right - 155) {
            projectChat.classList.add('messenger-drawer-open');
            drawer.setAttribute('aria-hidden', 'false');
        }
    });

    function closeDrawer() {
        projectChat.classList.remove('messenger-drawer-open');
        drawer.setAttribute('aria-hidden', 'true');
    }

    if (@json(request('tab') === 'meetings' || request('panel') === 'meetings')) {
        projectChat.classList.add('messenger-drawer-open');
        drawer.setAttribute('aria-hidden', 'false');
    }

    overlay.addEventListener('click', closeDrawer);

    drawer
        .querySelector('.messenger-drawer-close')
        .addEventListener('click', closeDrawer);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeDrawer();
        }
    });
});
</script>

<style>
/* ARCHITRACK — unified phase interface: ALL phase states, including locked 4–6 */
.project-phases-panel {width:100%!important;max-width:1500px!important;margin:0 auto!important;font-family:Inter,"Segoe UI",Arial,sans-serif!important;color:#273142!important}
.project-phases-panel,.project-phases-panel * {box-sizing:border-box!important}
.project-phases-panel .standard-phase-roadmap {display:flex!important;flex-direction:column!important;gap:0!important;width:100%!important;max-width:100%!important;margin:20px 0!important;padding:0!important;border:1px solid #d9dee7!important;border-radius:0!important;background:#fff!important;box-shadow:none!important}
.project-phases-panel .standard-phase-roadmap > article.standard-phase-card,
.project-phases-panel .standard-phase-roadmap > article.standard-phase-card.standard-phase-locked,
.project-phases-panel .standard-phase-roadmap > article.standard-phase-card.standard-phase-in_progress,
.project-phases-panel .standard-phase-roadmap > article.standard-phase-card.standard-phase-completed,
.project-phases-panel .standard-phase-roadmap > article.standard-phase-card.standard-phase-ready {display:block!important;position:relative!important;flex:none!important;float:none!important;width:100%!important;min-width:0!important;max-width:100%!important;min-height:0!important;height:auto!important;margin:0!important;padding:0!important;opacity:1!important;transform:none!important;filter:none!important;border:0!important;border-bottom:1px solid #e0e5eb!important;border-radius:0!important;box-shadow:none!important;background:#fff!important;overflow:hidden!important}
.project-phases-panel .standard-phase-roadmap > article.standard-phase-card:last-child {border-bottom:0!important}
.project-phases-panel .standard-phase-roadmap > article.standard-phase-card.standard-phase-locked {background:#f6f7f9!important}
.project-phases-panel .standard-phase-roadmap > article.standard-phase-card.phase-dropdown-open {border-left:3px solid #e87331!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-number,.project-phases-panel .standard-phase-roadmap .phase-connector {display:none!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-content {display:block!important;width:100%!important;min-width:0!important;margin:0!important;padding:0!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-top.phase-dropdown-trigger {display:flex!important;grid-template-columns:none!important;align-items:center!important;gap:12px!important;min-height:62px!important;width:100%!important;margin:0!important;padding:12px 16px!important;border:0!important;border-radius:0!important;box-shadow:none!important;background:transparent!important;cursor:pointer!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-top.phase-dropdown-trigger:hover {background:#edf1f5!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-top.phase-dropdown-trigger:focus-visible {outline:2px solid #e87331!important;outline-offset:-2px!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-title {display:flex!important;align-items:center!important;flex:1 1 auto!important;min-width:0!important;gap:13px!important;margin:0!important;padding:0!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-label-row {flex:0 0 64px!important;display:block!important;margin:0!important;padding:0!important}
.project-phases-panel .standard-phase-roadmap .phase-small-label {font-size:11px!important;font-weight:700!important;letter-spacing:.04em!important;color:#777f8d!important;white-space:nowrap!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-title h3 {flex:1!important;min-width:0!important;margin:0!important;padding:0!important;font-size:15px!important;font-weight:650!important;line-height:1.45!important;letter-spacing:0!important;color:#263242!important;overflow-wrap:anywhere!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-title > p {display:none!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-locked .standard-phase-title h3 {color:#747d8a!important}
.project-phases-panel .standard-phase-roadmap .phase-status {display:inline-flex!important;align-items:center!important;justify-content:center!important;gap:5px!important;flex:0 0 105px!important;width:105px!important;min-width:0!important;padding:5px 7px!important;border-radius:0!important;box-shadow:none!important;font-size:11px!important;font-weight:650!important;line-height:1.3!important;white-space:nowrap!important}
.project-phases-panel .standard-phase-roadmap .phase-status svg {width:12px!important;height:12px!important;flex:none!important}
.project-phases-panel .standard-phase-roadmap .phase-dropdown-chevron {display:flex!important;grid-column:auto!important;grid-row:auto!important;flex:0 0 20px!important;align-items:center!important;justify-content:center!important;width:20px!important;height:20px!important;border:0!important;border-radius:0!important;background:none!important;box-shadow:none!important;transform:none!important}
.project-phases-panel .standard-phase-roadmap .phase-dropdown-chevron svg {width:16px!important;height:16px!important;transition:transform .15s ease!important}
.project-phases-panel .standard-phase-roadmap .phase-dropdown-open .phase-dropdown-chevron svg {transform:rotate(180deg)!important}
.project-phases-panel .standard-phase-roadmap .phase-dropdown-details {display:block!important;width:100%!important;min-width:0!important;margin:0!important;padding:16px 18px 20px!important;border-top:1px solid #e0e5eb!important;border-radius:0!important;background:#fcfcfd!important;box-shadow:none!important}
.project-phases-panel .standard-phase-roadmap .phase-dropdown-closed .phase-dropdown-details {display:none!important}
.project-phases-panel .standard-phase-roadmap .standard-phase-locked .phase-dropdown-details {background:#f7f8fa!important}
.project-phases-panel .standard-phase-roadmap .phase-completion-requirement {margin:0 0 14px!important;padding:12px 14px!important;border:1px solid #e0e5eb!important;border-radius:0!important;background:#fff!important}
.project-phases-panel .standard-phase-roadmap .phase-progress-dashboard,.project-phases-panel .standard-phase-roadmap .phase-final-completion,.project-phases-panel .standard-phase-roadmap .phase-completion-blocked {max-width:100%!important;border-radius:0!important;box-shadow:none!important}
.project-phases-panel .standard-phase-roadmap p,.project-phases-panel .standard-phase-roadmap label,.project-phases-panel .standard-phase-roadmap li {font-size:13px!important;line-height:1.55!important}
.project-phases-panel .standard-phase-roadmap input,.project-phases-panel .standard-phase-roadmap select,.project-phases-panel .standard-phase-roadmap textarea,.project-phases-panel .standard-phase-roadmap button {max-width:100%!important;border-radius:0!important;font-family:inherit!important}
@media(max-width:600px){.project-phases-panel{max-width:100%!important}.project-phases-panel .standard-phase-roadmap .standard-phase-top.phase-dropdown-trigger{gap:7px!important;padding:10px!important}.project-phases-panel .standard-phase-roadmap .standard-phase-title{gap:6px!important}.project-phases-panel .standard-phase-roadmap .standard-phase-label-row{flex-basis:48px!important}.project-phases-panel .standard-phase-roadmap .phase-small-label{font-size:9px!important}.project-phases-panel .standard-phase-roadmap .standard-phase-title h3{font-size:13px!important}.project-phases-panel .standard-phase-roadmap .phase-status{flex-basis:74px!important;width:74px!important;font-size:9px!important;padding:4px!important}.project-phases-panel .standard-phase-roadmap .phase-dropdown-details{padding:12px!important}}
</style>
</body>

</html>
<script>
function validateExpenseBudget(form, remainingBudget) {
    const amount = Number(form.querySelector('[name="amount"]')?.value || 0);
    if (Number.isFinite(amount) && amount > remainingBudget) {
        alert('Insufficient Budget. The expense exceeds the remaining project budget.');
        return false;
    }
    return true;
}
</script>



