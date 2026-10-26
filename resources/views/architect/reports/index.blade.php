<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Architect Reports | ArchiTrack</title>
    @vite([
        'resources/css/app.css',
        'resources/css/architect-dashboard.css',
        'resources/css/architect-reports.css',
        'resources/js/app.js'
    ])
    <style>
        /* =========================================================
           ARCHITECT REPORTS — DESIGN STANDARDIZATION
           Sidebar V4 / off-white + orange + charcoal
        ========================================================= */
        :root {
            --reports-bg: #f4f0e9;
            --reports-surface: #fffdf9;
            --reports-surface-2: #f8f4ee;
            --reports-border: #ded7ce;
            --reports-border-strong: #cfc6bc;
            --reports-text: #2a3137;
            --reports-muted: #737b80;
            --reports-orange: #f47a1f;
            --reports-orange-dark: #c95d14;
            --reports-green: #557b65;
            --reports-red: #a85248;
            --reports-sidebar: #eee7dd;
            --reports-sidebar-deep: #e6ddd1;
        }
        html,
        body {
            background: var(--reports-bg);
            color: var(--reports-text);
            font-family: "Segoe UI", Arial, sans-serif;
        }
        body {
            min-height: 100vh;
        }
        .architect-layout {
            min-height: 100vh;
            background:
                linear-gradient(rgba(58, 65, 71, .035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(58, 65, 71, .035) 1px, transparent 1px),
                var(--reports-bg);
            background-size: 36px 36px;
        }
        /* ---------------- SIDEBAR V4 ---------------- */
        .sidebar {
            background:
                linear-gradient(180deg, rgba(255,255,255,.18), transparent 180px),
                var(--reports-sidebar) !important;
            border-right: 1px solid #d5ccc1 !important;
            box-shadow: none !important;
        }
        .sidebar-top {
            border-bottom: 1px solid rgba(87, 78, 68, .09);
        }
        .sidebar-logo {
            background: transparent !important;
        }
        .sidebar-logo img {
            border-radius: 0 !important;
        }
        .sidebar-toggle {
            border: 1px solid #d3c8bc !important;
            background: #f7f2eb !important;
            color: #5d6367 !important;
            border-radius: 2px !important;
        }
        .architect-identity {
            background: transparent !important;
        }
        .identity-avatar {
            border-radius: 2px !important;
            background: #2f353a !important;
            color: #ffffff !important;
        }
        .identity-info strong {
            color: #2f353a !important;
        }
        .identity-info span,
        .menu-title {
            color: #77736e !important;
        }
        .menu-title {
            font-size: 13px !important;
            letter-spacing: .11em !important;
        }
        .menu-link,
        .logout-btn {
            border-radius: 2px !important;
            color: #535b61 !important;
            transition: background .16s ease, color .16s ease !important;
        }
        .menu-link:hover,
        .logout-btn:hover {
            background: rgba(255,255,255,.55) !important;
            color: #2d3338 !important;
        }
        .menu-link.active {
            position: relative;
            background: #fffdf9 !important;
            color: #292f34 !important;
            box-shadow: inset 3px 0 0 var(--reports-orange) !important;
        }
        .menu-link.active .menu-icon {
            color: var(--reports-orange) !important;
        }
        .menu-icon svg {
            stroke-width: 1.7 !important;
        }
        .sidebar .menu-link .sidebar-badge {
            margin-left: auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 21px;
            height: 21px;
            padding: 0 6px;
            font-size: 11px;
            font-weight: 700;
            line-height: 1;
            flex-shrink: 0;
        }
        .sidebar-collapsed .sidebar .menu-link .sidebar-badge {
            position: absolute;
            top: 2px;
            right: 2px;
            min-width: 17px;
            height: 17px;
            padding: 0 3px;
            font-size: 9px;
        }
        .sidebar .menu-link .sidebar-badge {
            border-radius: 999px !important;
            background: #ef4444 !important;
            color: #fff !important;
        }
        .status-button {
            border-radius: 50% !important;
        }
        /* ---------------- MAIN ---------------- */
        .main-content {
            position: relative;
            background: transparent !important;
        }
        .topbar {
            min-height: 78px !important;
            padding: 15px 28px !important;
            border-bottom: 1px solid var(--reports-border) !important;
            background: rgba(255,253,249,.94) !important;
            backdrop-filter: blur(8px);
            box-shadow: none !important;
        }
        .workspace-label {
            color: var(--reports-orange-dark) !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            letter-spacing: .12em !important;
        }
        .topbar-heading h1 {
            margin-top: 3px !important;
            color: #262d32 !important;
            font-size: 25px !important;
            font-weight: 650 !important;
            letter-spacing: -.025em !important;
        }
        .top-date {
            min-width: 190px;
            padding-left: 18px;
            border-left: 1px solid var(--reports-border);
        }
        .top-date span {
            color: var(--reports-muted) !important;
            font-size: 13px !important;
        }
        .top-date strong {
            color: #30373c !important;
            font-size: 13px !important;
        }
        .architect-reports-content {
            width: min(1500px, calc(100% - 48px));
            margin: 0 auto !important;
            padding: 34px 0 48px !important;
        }
        /* ---------------- FLASH ---------------- */
        .reports-flash {
            margin-bottom: 16px !important;
            padding: 13px 15px !important;
            border-radius: 2px !important;
            box-shadow: none !important;
        }
        .reports-flash-success {
            border: 1px solid #cbd9cf !important;
            border-left: 4px solid var(--reports-green) !important;
            background: #f4f8f5 !important;
        }
        .reports-flash-error {
            border: 1px solid #e0c7c3 !important;
            border-left: 4px solid var(--reports-red) !important;
            background: #fff7f6 !important;
        }
        /* ---------------- INTRO ---------------- */
        .reports-intro {
            position: relative;
            min-height: 170px;
            margin-bottom: 18px !important;
            padding: 30px 32px !important;
            display: flex;
            align-items: flex-end !important;
            justify-content: space-between !important;
            gap: 30px;
            overflow: hidden;
            border: 1px solid var(--reports-border) !important;
            border-radius: 2px !important;
            background:
                linear-gradient(90deg, rgba(255,253,249,.98) 0%, rgba(255,253,249,.94) 62%, rgba(244,122,31,.08) 100%) !important;
            box-shadow: none !important;
        }
        .reports-intro::before {
            content: "";
            position: absolute;
            top: -70px;
            right: 70px;
            width: 230px;
            height: 230px;
            border: 1px solid rgba(244,122,31,.20);
            border-radius: 50%;
        }
        .reports-intro::after {
            content: "";
            position: absolute;
            right: 28px;
            bottom: 24px;
            width: 190px;
            height: 80px;
            background:
                linear-gradient(rgba(50,58,64,.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(50,58,64,.08) 1px, transparent 1px);
            background-size: 18px 18px;
            opacity: .7;
        }
        .reports-intro > * {
            position: relative;
            z-index: 2;
        }
        .reports-kicker,
        .reports-panel-heading > div > span,
        .reports-financial-heading > div > span,
        .reports-export-note > div > span {
            color: var(--reports-orange-dark) !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            letter-spacing: .10em !important;
        }
        .reports-intro h2 {
            margin: 6px 0 7px !important;
            color: #262d32 !important;
            font-size: 31px !important;
            line-height: 1.05 !important;
            font-weight: 650 !important;
            letter-spacing: -.035em !important;
        }
        .reports-intro p {
            max-width: 690px;
            margin: 0 !important;
            color: #687179 !important;
            font-size: 13px !important;
            line-height: 1.6 !important;
        }
        .reports-access-note {
            min-width: 220px;
            padding: 13px 15px !important;
            border: 1px solid #dfd5ca !important;
            border-radius: 2px !important;
            background: rgba(255,255,255,.75) !important;
            text-align: left !important;
        }
        .reports-access-note span {
            color: #8a8178 !important;
            font-size: 13px !important;
            letter-spacing: .08em !important;
        }
        .reports-access-note strong {
            display: block;
            margin-top: 4px;
            color: #343b40 !important;
            font-size: 13px !important;
        }
        /* ---------------- FILTERS ---------------- */
        .reports-filter-card {
            margin-bottom: 18px !important;
            padding: 16px 18px !important;
            border: 1px solid var(--reports-border) !important;
            border-radius: 2px !important;
            background: var(--reports-surface) !important;
            box-shadow: none !important;
        }
        .reports-filter-form {
            display: grid !important;
            grid-template-columns: minmax(180px, .8fr) minmax(220px, 1.2fr) auto !important;
            align-items: end !important;
            gap: 14px !important;
        }
        .report-filter-field label {
            margin-bottom: 6px !important;
            color: #676f74 !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            letter-spacing: .04em !important;
            text-transform: uppercase;
        }
        .report-filter-field select {
            min-height: 42px !important;
            padding: 0 12px !important;
            border: 1px solid #d7cfc6 !important;
            border-radius: 2px !important;
            background: #fff !important;
            color: #333a3f !important;
            font-size: 13px !important;
        }
        .report-filter-field select:focus {
            border-color: #e9a16e !important;
            box-shadow: 0 0 0 2px rgba(244,122,31,.08) !important;
        }
        .report-filter-actions {
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        .report-filter-button,
        .report-reset-button,
        .reports-pdf-button,
        .reports-drive-save-button,
        .reports-drive-connect-button,
        .reports-drive-disconnect-button {
            min-height: 40px !important;
            padding: 0 15px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 2px !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            transition: .16s ease !important;
        }
        .report-filter-button,
        .reports-pdf-button,
        .reports-drive-save-button.active,
        .reports-drive-connect-button {
            border: 1px solid var(--reports-orange) !important;
            background: var(--reports-orange) !important;
            color: white !important;
        }
        .report-filter-button:hover,
        .reports-pdf-button:hover,
        .reports-drive-save-button.active:hover,
        .reports-drive-connect-button:hover {
            background: #df6818 !important;
        }
        .report-reset-button,
        .reports-drive-disconnect-button {
            border: 1px solid #d6cec5 !important;
            background: #fff !important;
            color: #5f676c !important;
        }
        /* ---------------- SUMMARY CARDS ---------------- */
        .reports-summary-grid {
            display: grid !important;
            grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
            gap: 12px !important;
            margin-bottom: 18px !important;
        }
        .report-summary-card {
            position: relative;
            min-height: 122px;
            padding: 18px 18px 16px !important;
            overflow: hidden;
            border: 1px solid var(--reports-border) !important;
            border-radius: 2px !important;
            background: var(--reports-surface) !important;
            box-shadow: none !important;
        }
        .report-summary-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 46px;
            height: 3px;
            background: var(--reports-orange);
        }
        .report-summary-card span {
            color: #7b7f80 !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            letter-spacing: .08em !important;
        }
        .report-summary-card strong {
            display: block;
            margin: 10px 0 3px !important;
            color: #282f34 !important;
            font-size: 30px !important;
            font-weight: 650 !important;
            line-height: 1 !important;
        }
        .report-summary-card p {
            margin: 0 !important;
            color: #7a8287 !important;
            font-size: 13px !important;
        }
        /* ---------------- PANELS ---------------- */
        .reports-panel,
        .reports-financial-panel,
        .reports-export-note {
            border: 1px solid var(--reports-border) !important;
            border-radius: 2px !important;
            background: var(--reports-surface) !important;
            box-shadow: none !important;
        }
        .reports-panel {
            margin-bottom: 18px !important;
            padding: 0 !important;
            overflow: hidden;
        }
        .reports-panel-heading,
        .reports-financial-heading {
            padding: 18px 20px !important;
            border-bottom: 1px solid #e6e0d9 !important;
            background: #fbf8f4 !important;
        }
        .reports-panel-heading h3,
        .reports-financial-heading h3 {
            margin: 3px 0 0 !important;
            color: #2d3439 !important;
            font-size: 18px !important;
            font-weight: 650 !important;
        }
        .reports-panel-heading p,
        .reports-financial-heading p {
            color: #7b8388 !important;
            font-size: 13px !important;
        }
        /* ---------------- TABLE ---------------- */
        .reports-table-wrap {
            overflow-x: auto !important;
        }
        .reports-table {
            width: 100% !important;
            border-collapse: collapse !important;
            min-width: 1050px;
        }
        .reports-table th {
            padding: 11px 13px !important;
            border-bottom: 1px solid #d9d1c8 !important;
            background: #f2ede7 !important;
            color: #686f73 !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            letter-spacing: .06em !important;
            text-align: left !important;
            text-transform: uppercase;
        }
        .reports-table td {
            padding: 13px !important;
            border-bottom: 1px solid #ebe5de !important;
            color: #41494e !important;
            font-size: 13px !important;
            vertical-align: middle !important;
        }
        .reports-table tbody tr:nth-child(even) {
            background: #fcfaf7 !important;
        }
        .reports-table tbody tr:hover {
            background: #fff7ef !important;
        }
        .report-project-link {
            color: #293138 !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            text-decoration: none !important;
        }
        .report-project-link:hover {
            color: var(--reports-orange-dark) !important;
        }
        .report-project-client {
            display: block !important;
            margin-top: 3px !important;
            color: #8a9093 !important;
            font-size: 13px !important;
        }
        .report-assignment-badge,
        .report-status-badge {
            display: inline-flex !important;
            min-height: 24px !important;
            align-items: center !important;
            padding: 0 8px !important;
            border: 1px solid #ded7cf !important;
            border-radius: 2px !important;
            background: #f7f4f0 !important;
            color: #60686d !important;
            font-size: 13px !important;
            font-weight: 700 !important;
        }
        .report-assignment-badge.lead {
            border-color: #e8c5a8 !important;
            background: #fff5eb !important;
            color: #bd5c19 !important;
        }
        .report-progress-cell strong {
            color: #333a3f !important;
            font-size: 13px !important;
        }
        .report-progress-track {
            width: 90px !important;
            height: 5px !important;
            margin-top: 6px !important;
            overflow: hidden;
            background: #e8e2dc !important;
            border-radius: 0 !important;
        }
        .report-progress-track span {
            display: block;
            height: 100%;
            background: var(--reports-orange) !important;
        }
        .reports-empty-state {
            padding: 46px 20px !important;
            text-align: center;
        }
        /* ---------------- LOWER PANELS ---------------- */
        .reports-two-column {
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 18px !important;
            margin-bottom: 18px !important;
        }
        .reports-two-column .reports-panel {
            margin-bottom: 0 !important;
        }
        .phase-report-list {
            padding: 8px 18px 16px !important;
        }
        .phase-report-row {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 15px;
            padding: 10px 0 !important;
            border-bottom: 1px solid #ece6df !important;
        }
        .phase-report-row:last-child {
            border-bottom: 0 !important;
        }
        .phase-report-row span {
            color: #525a60 !important;
            font-size: 13px !important;
        }
        .phase-report-row strong {
            min-width: 30px;
            text-align: right;
            color: #282f34 !important;
            font-size: 13px !important;
        }
        .report-activity-grid {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 0 !important;
        }
        .report-activity-grid > div {
            min-height: 100px;
            padding: 18px !important;
            border-right: 1px solid #ebe5de;
            border-bottom: 1px solid #ebe5de;
            background: #fffdf9 !important;
        }
        .report-activity-grid > div:nth-child(2n) {
            border-right: 0;
        }
        .report-activity-grid > div:nth-last-child(-n+2) {
            border-bottom: 0;
        }
        .report-activity-grid span,
        .reports-financial-grid span {
            color: #83888a !important;
            font-size: 13px !important;
            font-weight: 700 !important;
            letter-spacing: .06em !important;
        }
        .report-activity-grid strong {
            display: block;
            margin-top: 8px !important;
            color: #2c3338 !important;
            font-size: 26px !important;
            font-weight: 650 !important;
        }
        /* ---------------- FINANCIAL ---------------- */
        .reports-financial-panel {
            margin-bottom: 18px !important;
            overflow: hidden;
        }
        .reports-financial-heading {
            display: flex !important;
            align-items: flex-end !important;
            justify-content: space-between !important;
            gap: 20px;
        }
        .reports-financial-heading > strong {
            color: #747b80 !important;
            font-size: 13px !important;
            font-weight: 600 !important;
        }
        .reports-financial-grid {
            display: grid !important;
            grid-template-columns: repeat(3, 1fr) !important;
        }
        .reports-financial-grid > div {
            min-height: 110px;
            padding: 20px !important;
            border-right: 1px solid #e9e3dc !important;
            background: #fffdf9 !important;
        }
        .reports-financial-grid > div:last-child {
            border-right: 0 !important;
        }
        .reports-financial-grid strong {
            display: block;
            margin-top: 9px !important;
            color: #2e353a !important;
            font-size: 21px !important;
            font-weight: 650 !important;
        }
        .reports-financial-grid strong.negative {
            color: var(--reports-red) !important;
        }
        /* ---------------- EXPORT ---------------- */
        .reports-export-note {
            padding: 20px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 24px !important;
            background:
                linear-gradient(90deg, #fffdf9 0%, #fffaf5 100%) !important;
        }
        .reports-export-note > div:first-child {
            max-width: 700px;
        }
        .reports-export-note > div > strong {
            display: block;
            margin-top: 4px !important;
            color: #30373c !important;
            font-size: 15px !important;
        }
        .reports-export-note p {
            margin: 5px 0 0 !important;
            color: #788086 !important;
            font-size: 13px !important;
        }
        .reports-drive-status {
            margin-top: 12px !important;
            padding: 10px 12px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 9px !important;
            border: 1px solid #cddbd1 !important;
            border-radius: 2px !important;
            background: #f5f8f6 !important;
        }
        .reports-drive-status-dot {
            width: 7px !important;
            height: 7px !important;
            border-radius: 50% !important;
            background: var(--reports-green) !important;
        }
        .reports-drive-status strong {
            font-size: 13px !important;
        }
        .reports-drive-status small {
            color: #7d8589 !important;
            font-size: 13px !important;
        }
        .reports-export-actions {
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            flex-wrap: wrap !important;
            gap: 8px !important;
        }
        .reports-pdf-button svg {
            width: 16px !important;
            height: 16px !important;
            margin-right: 7px !important;
        }
        /* ---------------- RESPONSIVE ---------------- */
        @media (max-width: 1120px) {
            .reports-summary-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
            .reports-filter-form {
                grid-template-columns: 1fr 1fr !important;
            }
            .report-filter-actions {
                grid-column: 1 / -1;
            }
            .reports-export-note {
                align-items: flex-start !important;
                flex-direction: column !important;
            }
            .reports-export-actions {
                justify-content: flex-start !important;
            }
        }
        @media (max-width: 820px) {
            .architect-reports-content {
                width: min(100% - 28px, 1500px);
                padding-top: 20px !important;
            }
            .topbar {
                padding: 14px 16px !important;
            }
            .top-date {
                display: none !important;
            }
            .reports-intro {
                min-height: auto;
                padding: 24px 20px !important;
                align-items: flex-start !important;
                flex-direction: column !important;
            }
            .reports-access-note {
                width: 100%;
            }
            .reports-filter-form {
                grid-template-columns: 1fr !important;
            }
            .report-filter-actions {
                grid-column: auto;
            }
            .reports-two-column,
            .reports-financial-grid {
                grid-template-columns: 1fr !important;
            }
            .reports-financial-grid > div {
                border-right: 0 !important;
                border-bottom: 1px solid #e9e3dc !important;
            }
            .reports-financial-grid > div:last-child {
                border-bottom: 0 !important;
            }
        }
        @media (max-width: 560px) {
            .reports-summary-grid {
                grid-template-columns: 1fr !important;
            }
            .report-filter-actions,
            .reports-export-actions {
                align-items: stretch !important;
                flex-direction: column !important;
            }
            .report-filter-button,
            .report-reset-button,
            .reports-pdf-button,
            .reports-drive-save-button,
            .reports-drive-connect-button,
            .reports-drive-disconnect-button {
                width: 100% !important;
            }
            .reports-intro h2 {
                font-size: 27px !important;
            }
        }
        html, body, button, input, textarea, select, option {
            font-family: "Segoe UI", Arial, sans-serif !important;
        }
</style>
</head>
<body>
<div class="architect-layout">
<button
        type="button"
        class="mobile-sidebar-launcher"
        id="mobileSidebarLauncher"
        aria-label="Open navigation"
        aria-controls="architectSidebar"
        aria-expanded="false"
    >
        <svg viewBox="0 0 24 24">
            <path d="M4 6h16"/>
            <path d="M4 12h16"/>
            <path d="M4 18h16"/>
        </svg>
    </button>
    <!-- =====================================================
         SIDEBAR
    ====================================================== -->
    <aside class="sidebar" id="architectSidebar">
        <div class="sidebar-top">
            <a
                href="{{ route('architect.dashboard') }}"
                class="sidebar-logo"
                aria-label="ArchiTrack Architect Dashboard"
            >
                <img
                    src="{{ asset('images/arlogo.jpg') }}"
                    alt="Vero Designs"
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
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </button>
        </div>
        <!-- ARCHITECT IDENTITY -->
        <div class="architect-identity">
            <div class="identity-top">
                <div class="identity-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="identity-info">
                    <strong>
                        {{ $user->name }}
                    </strong>
                    <span>
                        Architect
                    </span>
                </div>
                <button
                    type="button"
                    class="status-button status-active"
                    title="Active"
                >
                    <span class="status-dot"></span>
                </button>
            </div>
        </div>
        <div class="sidebar-divider"></div>
        <!-- WORKSPACE -->
        <p class="menu-title">
            WORKSPACE
        </p>
        <!-- DASHBOARD -->
        <a
            href="{{ route('architect.dashboard') }}"
            class="menu-link {{ request()->routeIs('architect.dashboard') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
            </span>
            <span class="menu-text">
                Dashboard
            </span>
        </a>
        <!-- PROJECTS -->
        <a
            href="{{ route('architect.projects.index') }}"
            class="menu-link {{ request()->routeIs('architect.projects.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M3 7h6l2 2h10v10H3z"/>
                    <path d="M3 7V5h7l2 2"/>
                </svg>
            </span>
            <span class="menu-text">
                Projects
            </span>
        </a>
        <!-- PROJECT TOOLS -->
        <p class="menu-title">
            PROJECT TOOLS
        </p>
        <!-- FILES -->
        <a
            href="{{ route('architect.files.index') }}"
            class="menu-link {{ request()->routeIs('architect.files.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M3 6h6l2 2h10v10H3z"/>
                </svg>
            </span>
            <span class="menu-text">
                Files
            </span>
        </a>
        <!-- REVISIONS -->
        <a
            href="{{ route('architect.revisions.index') }}"
            class="menu-link {{ request()->routeIs('architect.revisions.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 4h16v12H7l-3 3z"/>
                    <path d="M8 8h8"/>
                    <path d="M8 12h5"/>
                </svg>
            </span>
            <span class="menu-text">
                Revisions
            </span>
            @if(($pendingRevisionCount ?? 0) > 0)
                <span class="sidebar-badge" aria-label="{{ $pendingRevisionCount }} pending revision requests">
                    {{ $pendingRevisionCount > 99 ? '99+' : $pendingRevisionCount }}
                </span>
            @endif
        </a>
        <!-- MEETINGS -->
        <a
            href="{{ route('architect.meetings.index') }}"
            class="menu-link {{ request()->routeIs('architect.meetings.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                    <path d="M8 3v4"/>
                    <path d="M16 3v4"/>
                    <path d="M3 10h18"/>
                </svg>
            </span>
            <span class="menu-text">
                Meetings
            </span>
            @if(($pendingMeetingCount ?? 0) > 0)
                <span class="sidebar-badge" aria-label="{{ $pendingMeetingCount }} pending meeting requests">
                    {{ $pendingMeetingCount > 99 ? '99+' : $pendingMeetingCount }}
                </span>
            @endif
        </a>
        <!-- REPORTS -->
        <a
            href="{{ route('architect.reports.index') }}"
            class="menu-link {{ request()->routeIs('architect.reports.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 20V10"/>
                    <path d="M10 20V4"/>
                    <path d="M16 20v-7"/>
                    <path d="M22 20V7"/>
                </svg>
            </span>
            <span class="menu-text">
                Reports
            </span>
        </a>
        <!-- ACCOUNT -->
        <p class="menu-title">
            ACCOUNT
        </p>
        <!-- SETTINGS -->
        <a
            href="{{ route('architect.settings.index') }}"
            class="menu-link {{ request()->routeIs('architect.settings.*') ? 'active' : '' }}"
        >
            <span class="menu-icon">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/>
                    <circle cx="12" cy="12" r="8"/>
                </svg>
            </span>
            <span class="menu-text">
                Settings
            </span>
        </a>
        <!-- LOGOUT -->
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
                        <path d="M10 17l5-5-5-5"/>
                        <path d="M15 12H3"/>
                        <path d="M13 4h7v16h-7"/>
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
        <header class="topbar">
            <button
                type="button"
                class="topbar-menu-button"
                id="topbarMenuButton"
                aria-label="Open navigation"
            >
                <svg viewBox="0 0 24 24">
                    <path d="M4 6h16"/>
                    <path d="M4 12h16"/>
                    <path d="M4 18h16"/>
                </svg>
            </button>
            <div class="topbar-heading">
                <span class="workspace-label">ARCHITECT WORKSPACE</span>
                <h1>Reports Center</h1>
            </div>
            <div class="top-date">
                <span>{{ now('Asia/Manila')->format('l, F j, Y') }}</span>
                <strong>{{ now('Asia/Manila')->format('h:i A') }} PH</strong>
            </div>
        </header>
        <div class="architect-reports-content">
            @if(session('success'))
                <div class="reports-flash reports-flash-success">
                    <strong>
                        Success
                    </strong>
                    <span>
                        {{ session('success') }}
                    </span>
                </div>
            @endif
            @if(session('error'))
                <div class="reports-flash reports-flash-error">
                    <strong>
                        Google Drive
                    </strong>
                    <span>
                        {{ session('error') }}
                    </span>
                </div>
            @endif
            <section class="reports-intro">
                <div>
                    <span class="reports-kicker">PROJECT REPORTING</span>
                    <h2>Architect Reports</h2>
                    <p>
                        Review your assigned projects, phase progress,
                        project activity, and financial summaries.
                    </p>
                </div>
                <div class="reports-access-note">
                    <span>ASSIGNMENT ACCESS</span>
                    <strong>
                        {{ $leadProjects }} Lead ·
                        {{ $collaboratorProjects }} Collaborator
                    </strong>
                </div>
            </section>
            <section class="reports-filter-card">
                <form
                    method="GET"
                    action="{{ route('architect.reports.index') }}"
                    class="reports-filter-form"
                >
                    <div class="report-filter-field">
                        <label for="report_status">Project Status</label>
                        <select name="status" id="report_status">
                            <option value="">All Statuses</option>
                            <option value="planning" {{ request('status') === 'planning' ? 'selected' : '' }}>Planning</option>
                            <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="on_hold" {{ request('status') === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="report-filter-field">
                        <label for="report_phase">Current Phase</label>
                        <select name="phase" id="report_phase">
                            <option value="">All Phases</option>
                            @foreach($phaseNames as $phaseName)
                                <option
                                    value="{{ $phaseName }}"
                                    {{ request('phase') === $phaseName ? 'selected' : '' }}
                                >
                                    {{ $phaseName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="report-filter-actions">
                        <button type="submit" class="report-filter-button">
                            Apply Filters
                        </button>
                        <a
                            href="{{ route('architect.reports.index') }}"
                            class="report-reset-button"
                        >
                            Reset
                        </a>
                    </div>
                </form>
            </section>
            <section class="reports-summary-grid">
                <article class="report-summary-card">
                    <span>TOTAL PROJECTS</span>
                    <strong>{{ $totalProjects }}</strong>
                    <p>All accessible projects</p>
                </article>
                <article class="report-summary-card">
                    <span>PLANNING</span>
                    <strong>{{ $planningProjects }}</strong>
                    <p>Projects preparing to start</p>
                </article>
                <article class="report-summary-card">
                    <span>ONGOING</span>
                    <strong>{{ $ongoingProjects }}</strong>
                    <p>Active project work</p>
                </article>
                <article class="report-summary-card">
                    <span>COMPLETED</span>
                    <strong>{{ $completedProjects }}</strong>
                    <p>Finished projects</p>
                </article>
            </section>
            <section class="reports-panel">
                <div class="reports-panel-heading">
                    <div>
                        <span>PROJECT REPORT</span>
                        <h3>Project Progress</h3>
                        <p>
                            {{ $projects->count() }}
                            filtered {{ $projects->count() === 1 ? 'project' : 'projects' }}
                        </p>
                    </div>
                </div>
                @if($projects->count() > 0)
                    <div class="reports-table-wrap">
                        <table class="reports-table">
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Assignment</th>
                                    <th>Status</th>
                                    <th>Current Phase</th>
                                    <th>Progress</th>
                                    <th>Files</th>
                                    <th>Revisions</th>
                                    <th>Meetings</th>
                                    <th>Messages</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                    @php
                                        $currentPhase =
                                            $project->phases
                                                ->sortBy('phase_order')
                                                ->first(function ($phase) {
                                                    return
                                                        strtolower((string) $phase->status)
                                                        !==
                                                        'completed';
                                                });
                                        if (!$currentPhase) {
                                            $currentPhase =
                                                $project->phases
                                                    ->sortBy('phase_order')
                                                    ->last();
                                        }
                                        $isLead =
                                            (int) $project->architect_id
                                            ===
                                            (int) $user->id;
                                    @endphp
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route(
                                                    'architect.projects.show',
                                                    ['id' => $project->id]
                                                ) }}"
                                                class="report-project-link"
                                            >
                                                {{ $project->project_name }}
                                            </a>
                                            <span class="report-project-client">
                                                {{ $project->client_name }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="
                                                    report-assignment-badge
                                                    {{ $isLead ? 'lead' : 'collaborator' }}
                                                "
                                            >
                                                {{ $isLead ? 'Lead' : 'Collaborator' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="report-status-badge">
                                                {{ ucwords(
                                                    str_replace(
                                                        '_',
                                                        ' ',
                                                        $project->status
                                                    )
                                                ) }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $currentPhase?->phase_name ?? 'Not started' }}
                                        </td>
                                        <td>
                                            <div class="report-progress-cell">
                                                <strong>{{ $project->progress ?? 0 }}%</strong>
                                                <div class="report-progress-track">
                                                    <span
                                                        style="width: {{
                                                            min(
                                                                max(
                                                                    $project->progress ?? 0,
                                                                    0
                                                                ),
                                                                100
                                                            )
                                                        }}%;"
                                                    ></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $project->files_count }}</td>
                                        <td>{{ $project->revisions_count }}</td>
                                        <td>{{ $project->meetings_count }}</td>
                                        <td>{{ $project->messages_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="reports-empty-state">
                        <strong>No projects match the selected filters.</strong>
                        <p>Reset the filters to view all accessible projects.</p>
                    </div>
                @endif
            </section>
            <section class="reports-two-column">
                <div class="reports-panel">
                    <div class="reports-panel-heading">
                        <div>
                            <span>PHASE DISTRIBUTION</span>
                            <h3>Current Project Phases</h3>
                        </div>
                    </div>
                    <div class="phase-report-list">
                        @foreach($phaseSummary as $phaseData)
                            <div class="phase-report-row">
                                <span>{{ $phaseData['phase'] }}</span>
                                <strong>{{ $phaseData['count'] }}</strong>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="reports-panel">
                    <div class="reports-panel-heading">
                        <div>
                            <span>ACTIVITY SUMMARY</span>
                            <h3>Filtered Project Activity</h3>
                        </div>
                    </div>
                    <div class="report-activity-grid">
                        <div><span>FILES</span><strong>{{ $totalFiles }}</strong></div>
                        <div><span>REVISIONS</span><strong>{{ $totalRevisions }}</strong></div>
                        <div><span>MEETINGS</span><strong>{{ $totalMeetings }}</strong></div>
                        <div><span>MESSAGES</span><strong>{{ $totalMessages }}</strong></div>
                    </div>
                </div>
            </section>
            <section class="reports-financial-panel">
                <div class="reports-financial-heading">
                    <div>
                        <span>PROJECT FINANCIALS</span>
                        <h3>Financial Summary</h3>
                        <p>
                            Summary across all projects accessible to your account.
                        </p>
                    </div>
                    <strong>
                        {{ $projectsWithBudget }}
                        {{ $projectsWithBudget === 1
                            ? 'project with budget'
                            : 'projects with budget'
                        }}
                    </strong>
                </div>
                <div class="reports-financial-grid">
                    <div>
                        <span>TOTAL BUDGET</span>
                        <strong>₱{{ number_format($totalBudget, 2) }}</strong>
                    </div>
                    <div>
                        <span>TOTAL EXPENSES</span>
                        <strong>₱{{ number_format($totalExpenses, 2) }}</strong>
                    </div>
                    <div>
                        <span>REMAINING</span>
                        <strong class="{{ $totalRemaining < 0 ? 'negative' : '' }}">
                            ₱{{ number_format($totalRemaining, 2) }}
                        </strong>
                    </div>
                </div>
            </section>
            <section class="reports-export-note">
                <div>
                    <span>
                        REPORT EXPORT
                    </span>
                    <strong>
                        Download your report or connect Google Drive.
                    </strong>
                    <p>
                        The current Status and Phase filters will also be used in the PDF.
                    </p>
                    @if($googleDriveConnection)
                        <div class="reports-drive-status">
                            <span class="reports-drive-status-dot"></span>
                            <div>
                                <strong>
                                    Google Drive Connected
                                </strong>
                                <small>
                                    {{ $googleDriveConnection->google_email
                                        ?: 'Connected Google account'
                                    }}
                                </small>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="reports-export-actions">
                    <a
                        href="{{ route(
                            'architect.reports.pdf',
                            array_filter([
                                'status' => request('status'),
                                'phase' => request('phase')
                            ])
                        ) }}"
                        class="reports-pdf-button"
                    >
                        <svg viewBox="0 0 24 24">
                            <path d="M12 3v12"/>
                            <path d="M7 10l5 5 5-5"/>
                            <path d="M5 20h14"/>
                        </svg>
                        Download PDF
                    </a>
                    @if($googleDriveConnection)
                        <form
                            method="POST"
                            action="{{ route(
                                'architect.reports.google-drive.save'
                            ) }}"
                        >
                            @csrf
                            <input
                                type="hidden"
                                name="status"
                                value="{{ request('status') }}"
                            >
                            <input
                                type="hidden"
                                name="phase"
                                value="{{ request('phase') }}"
                            >
                            <button
                                type="submit"
                                class="reports-drive-save-button active"
                            >
                                Save to Google Drive
                            </button>
                        </form>
                        <form
                            method="POST"
                            action="{{ route(
                                'architect.google-drive.disconnect'
                            ) }}"
                            onsubmit="return confirm(
                                'Disconnect this Google Drive account from ArchiTrack?'
                            );"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="reports-drive-disconnect-button"
                            >
                                Disconnect
                            </button>
                        </form>
                    @else
                        <a
                            href="{{ route(
                                'architect.google-drive.connect'
                            ) }}"
                            class="reports-drive-connect-button"
                        >
                            Connect Google Drive
                        </a>
                    @endif
                </div>
            </section>
        </div>
    </main>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const sidebar = document.getElementById('architectSidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    const mobileSidebarLauncher = document.getElementById('mobileSidebarLauncher');
    const topbarMenuButton = document.getElementById('topbarMenuButton');
    const desktopMedia = window.matchMedia('(min-width: 701px)');
    function setDesktopCollapsed(collapsed) {
        if (!desktopMedia.matches) {
            return;
        }
        body.classList.toggle('sidebar-collapsed', collapsed);
        if (sidebarToggle) {
            sidebarToggle.setAttribute(
                'aria-expanded',
                collapsed ? 'false' : 'true'
            );
            sidebarToggle.setAttribute(
                'aria-label',
                collapsed ? 'Maximize sidebar' : 'Minimize sidebar'
            );
        }
        localStorage.setItem(
            'architrackArchitectSidebarCollapsed',
            collapsed ? '1' : '0'
        );
    }
    function openMobileSidebar() {
        if (desktopMedia.matches) {
            return;
        }
        body.classList.add('mobile-sidebar-open');
        mobileSidebarLauncher?.setAttribute('aria-expanded', 'true');
    }
    function closeMobileSidebar() {
        body.classList.remove('mobile-sidebar-open');
        mobileSidebarLauncher?.setAttribute('aria-expanded', 'false');
    }
    function syncSidebarForViewport() {
        closeMobileSidebar();
        if (desktopMedia.matches) {
            const savedCollapsed =
                localStorage.getItem(
                    'architrackArchitectSidebarCollapsed'
                ) === '1';
            setDesktopCollapsed(savedCollapsed);
        } else {
            body.classList.remove('sidebar-collapsed');
        }
    }
    sidebarToggle?.addEventListener('click', function () {
        if (desktopMedia.matches) {
            setDesktopCollapsed(
                !body.classList.contains('sidebar-collapsed')
            );
        } else {
            closeMobileSidebar();
        }
    });
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
    document.addEventListener('keydown', function (event) {
        if (
            event.key === 'Escape'
            &&
            body.classList.contains('mobile-sidebar-open')
        ) {
            closeMobileSidebar();
        }
    });
    sidebar?.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (!desktopMedia.matches) {
                closeMobileSidebar();
            }
        });
    });
    if (desktopMedia.addEventListener) {
        desktopMedia.addEventListener(
            'change',
            syncSidebarForViewport
        );
    } else {
        desktopMedia.addListener(syncSidebarForViewport);
    }
    syncSidebarForViewport();
});
</script>
</body>
</html>
