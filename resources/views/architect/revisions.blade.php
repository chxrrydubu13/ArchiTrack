<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisions | Architect</title>
    @vite([
        'resources/css/app.css',
        'resources/css/architect-dashboard.css',
        'resources/js/app.js'
    ])
<style>
/* =========================================================
   ARCHITECT REVISIONS
   CONTENT REDESIGN — SAME DASHBOARD / PROJECTS VISUAL LANGUAGE
   Sidebar remains the accepted Sidebar V4 already in this Blade.
========================================================= */
:root {
    --rev-bg: #f5f1eb;
    --rev-panel: #fffdfa;
    --rev-panel-soft: #f8f4ee;
    --rev-border: #ddd5cc;
    --rev-border-dark: #cec5bb;
    --rev-text: #293237;
    --rev-muted: #778086;
    --rev-orange: #f47a1f;
    --rev-orange-dark: #c85f17;
    --rev-green: #597664;
    --rev-amber: #c58a54;
    --rev-charcoal: #30383d;
}
html,
body {
    background: var(--rev-bg);
    color: var(--rev-text);
    font-family: "Segoe UI", Arial, sans-serif;
}
.main-content {
    background:
        linear-gradient(rgba(65, 71, 76, .022) 1px, transparent 1px),
        linear-gradient(90deg, rgba(65, 71, 76, .022) 1px, transparent 1px),
        var(--rev-bg) !important;
    background-size: 36px 36px !important;
}
/* =========================================================
   TOPBAR
========================================================= */
.topbar {
    min-height: 76px !important;
    padding: 13px 28px !important;
    border-bottom: 1px solid var(--rev-border) !important;
    background: #fffdfa !important;
    box-shadow: none !important;
}
.workspace-label {
    color: var(--rev-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .12em !important;
}
.topbar-heading h1 {
    margin-top: 3px !important;
    color: #273036 !important;
    font-size: 24px !important;
    font-weight: 650 !important;
    letter-spacing: -.03em !important;
}
.top-date {
    padding-left: 18px !important;
    border-left: 1px solid var(--rev-border) !important;
}
.top-date span {
    color: var(--rev-muted) !important;
    font-size: 13px !important;
}
.top-date strong {
    color: var(--rev-charcoal) !important;
    font-size: 12px !important;
}
/* =========================================================
   PAGE WRAPPER
========================================================= */
.revisions-page {
    width: min(1460px, calc(100% - 48px)) !important;
    margin: 0 auto !important;
    padding: 28px 0 46px !important;
}
/* =========================================================
   INTRO / OVERVIEW
========================================================= */
.revisions-page-head {
    position: relative;
    display: grid !important;
    grid-template-columns: minmax(0, 1.2fr) minmax(430px, .8fr) !important;
    align-items: center !important;
    gap: 34px !important;
    min-height: 184px !important;
    margin-bottom: 16px !important;
    padding: 28px 30px !important;
    overflow: hidden;
    border: 1px solid var(--rev-border) !important;
    border-radius: 2px !important;
    background:
        linear-gradient(
            92deg,
            #fffdfa 0%,
            #fffdfa 62%,
            #fff6ed 100%
        ) !important;
    box-shadow: none !important;
}
.revisions-page-head::after {
    content: "";
    position: absolute;
    right: 26px;
    bottom: 22px;
    width: 230px;
    height: 92px;
    background:
        linear-gradient(rgba(61, 67, 72, .075) 1px, transparent 1px),
        linear-gradient(90deg, rgba(61, 67, 72, .075) 1px, transparent 1px);
    background-size: 18px 18px;
    opacity: .5;
}
.revisions-heading,
.revisions-counts {
    position: relative;
    z-index: 2;
}
.revisions-heading {
    display: flex !important;
    align-items: flex-start !important;
    gap: 15px !important;
}
.revisions-heading-icon {
    width: 48px !important;
    height: 48px !important;
    flex: 0 0 48px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border: 1px solid #e6c5aa !important;
    border-radius: 0 !important;
    background: #fff1e5 !important;
    color: var(--rev-orange-dark) !important;
}
.revisions-heading-icon svg {
    width: 21px !important;
    height: 21px !important;
    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 1.7 !important;
}
.revisions-overline {
    margin: 0 0 5px !important;
    color: var(--rev-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .11em !important;
}
.revisions-heading h2 {
    margin: 0 !important;
    color: #263036 !important;
    font-size: 31px !important;
    line-height: 1.08 !important;
    font-weight: 650 !important;
    letter-spacing: -.035em !important;
}
.revisions-description {
    max-width: 620px;
    margin: 8px 0 0 !important;
    color: #727b80 !important;
    font-size: 13px !important;
    line-height: 1.6 !important;
}
/* summary cards */
.revisions-counts {
    display: grid !important;
    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    gap: 10px !important;
}
.revision-count-item {
    min-height: 82px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
    padding: 13px 14px !important;
    border: 1px solid #ded6ce !important;
    border-radius: 2px !important;
    background: rgba(255,255,255,.82) !important;
    box-shadow: none !important;
}
.revision-count-item strong {
    display: block !important;
    color: #2d353a !important;
    font-size: 24px !important;
    line-height: 1 !important;
    font-weight: 650 !important;
}
.revision-count-item span {
    display: block !important;
    margin-top: 6px !important;
    color: #7a8287 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .04em !important;
    text-transform: uppercase !important;
}
.revision-count-item:first-child {
    box-shadow: inset 0 3px 0 #8b9499 !important;
}
.revision-count-item.count-pending {
    box-shadow: inset 0 3px 0 var(--rev-amber) !important;
}
.revision-count-item.count-approved {
    box-shadow: inset 0 3px 0 #7c9787 !important;
}
.revision-count-item.count-complete {
    box-shadow: inset 0 3px 0 #58705f !important;
}
/* =========================================================
   CONTROLS
========================================================= */
.revisions-controls {
    display: flex !important;
    align-items: flex-end !important;
    justify-content: space-between !important;
    gap: 22px !important;
    margin-bottom: 14px !important;
    padding: 16px 18px !important;
    border: 1px solid var(--rev-border) !important;
    border-radius: 2px !important;
    background: var(--rev-panel) !important;
    box-shadow: none !important;
}
.revisions-section-label {
    color: var(--rev-orange-dark) !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    letter-spacing: .10em !important;
}
.revisions-controls h3 {
    margin: 4px 0 0 !important;
    color: #30383d !important;
    font-size: 17px !important;
    font-weight: 650 !important;
}
.revisions-control-actions {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
}
.revision-search {
    position: relative;
    min-width: 280px;
}
.revision-search svg {
    position: absolute !important;
    left: 12px !important;
    top: 50% !important;
    width: 16px !important;
    height: 16px !important;
    transform: translateY(-50%) !important;
    fill: none !important;
    stroke: #91989c !important;
    stroke-width: 1.7 !important;
}
.revision-search input,
#revisionSort {
    min-height: 40px !important;
    border: 1px solid #d7cfc6 !important;
    border-radius: 2px !important;
    background: #ffffff !important;
    color: #343c41 !important;
    font-family: inherit !important;
    font-size: 13px !important;
    outline: none !important;
}
.revision-search input {
    width: 100% !important;
    padding: 0 11px 0 37px !important;
}
#revisionSort {
    min-width: 165px;
    padding: 0 10px !important;
}
.revision-search input:focus,
#revisionSort:focus {
    border-color: #dfa16f !important;
    box-shadow: 0 0 0 2px rgba(244,122,31,.07) !important;
}
/* =========================================================
   PROJECT REVISION LIST
========================================================= */
.revisions-project-list {
    display: grid !important;
    gap: 10px !important;
}
.revision-project-card {
    display: grid !important;
    grid-template-columns:
        minmax(245px, 1fr)
        minmax(300px, 1.35fr)
        minmax(260px, .95fr)
        minmax(210px, .7fr) !important;
    align-items: stretch !important;
    overflow: hidden;
    border: 1px solid var(--rev-border) !important;
    border-radius: 2px !important;
    background: var(--rev-panel) !important;
    box-shadow: none !important;
    transition:
        border-color .15s ease,
        background .15s ease !important;
}
.revision-project-card:hover {
    border-color: #d8c9bb !important;
    background: #fffaf5 !important;
}
.revision-project-identity,
.revision-project-request,
.revision-project-statuses,
.revision-project-footer {
    position: relative !important;
    z-index: 10 !important;
    pointer-events: auto !important;
    min-width: 0;
    padding: 17px 18px !important;
}
.revision-project-identity,
.revision-project-request,
.revision-project-statuses {
    border-right: 1px solid #e7e0d8 !important;
}
/* project info */
.revision-project-identity {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}
.revision-project-thumb {
    width: 60px !important;
    height: 60px !important;
    flex: 0 0 60px !important;
    overflow: hidden !important;
    border: 1px solid #dcd4cc !important;
    border-radius: 0 !important;
    background: #eee8e2 !important;
}
.revision-project-thumb img,
.revision-project-thumb-fallback {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
}
.revision-project-thumb-fallback {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: #30383d !important;
    color: #ffffff !important;
    font-size: 18px !important;
    font-weight: 700 !important;
}
.revision-project-name {
    min-width: 0;
}
.revision-project-name > span {
    color: #8a9094 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .06em !important;
    text-transform: uppercase !important;
}
.revision-project-name h3 {
    margin: 4px 0 3px !important;
    overflow: hidden !important;
    color: #30383d !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    white-space: nowrap !important;
    text-overflow: ellipsis !important;
}
.revision-project-name p {
    margin: 0 !important;
    color: #7f878b !important;
    font-size: 12px !important;
}
/* request */
.revision-project-request {
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
}
.revision-project-request > span {
    color: var(--rev-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .07em !important;
}
.revision-project-request p {
    margin: 7px 0 0 !important;
    color: #566065 !important;
    font-size: 13px !important;
    line-height: 1.55 !important;
}
/* status summary */
.revision-project-statuses {
    display: grid !important;
    grid-template-columns: repeat(3, minmax(70px, 1fr)) !important;
    align-content: center !important;
    gap: 7px !important;
}
.revision-status-pill {
    min-height: 60px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
    padding: 9px !important;
    border: 1px solid #ded6ce !important;
    border-radius: 2px !important;
    background: #faf7f3 !important;
    text-align: left !important;
}
.revision-status-pill strong {
    display: block !important;
    color: #30383d !important;
    font-size: 18px !important;
    font-weight: 650 !important;
}
.revision-status-pill span {
    display: block !important;
    margin-top: 3px !important;
    color: #7c8489 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
}
.revision-status-pill.pending {
    border-top: 3px solid #cf905c !important;
}
.revision-status-pill.approved,
.revision-status-pill.in-progress {
    border-top: 3px solid #7b9786 !important;
}
.revision-status-pill.implemented,
.revision-status-pill.resolved {
    border-top: 3px solid #56705f !important;
}
/* footer */
.revision-project-footer {
    position: relative !important;
    z-index: 10 !important;
    pointer-events: auto !important;
    min-width: 0;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    gap: 12px !important;
    background: #fbf8f4 !important;
}
.revision-project-meta {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 8px !important;
}
.revision-project-meta span {
    color: #8b9195 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .06em !important;
    text-transform: uppercase !important;
}
.revision-project-meta strong {
    display: block !important;
    margin-top: 4px !important;
    color: #31393e !important;
    font-size: 13px !important;
}
.revision-open-button {
    position: relative !important;
    z-index: 30 !important;
    pointer-events: auto !important;
    cursor: pointer !important;
    min-height: 37px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 7px !important;
    padding: 0 12px !important;
    border: 1px solid var(--rev-orange) !important;
    border-radius: 2px !important;
    background: var(--rev-orange) !important;
    color: #ffffff !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    text-decoration: none !important;
}
.revision-open-button:hover {
    background: #df6918 !important;
}
.revision-open-button svg {
    width: 14px !important;
    height: 14px !important;
    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 1.8 !important;
}
/* =========================================================
   EMPTY STATE
========================================================= */
.revisions-empty {
    padding: 58px 20px !important;
    border: 1px solid var(--rev-border) !important;
    border-radius: 2px !important;
    background: var(--rev-panel) !important;
    text-align: center !important;
}
.revisions-empty-icon {
    width: 54px !important;
    height: 54px !important;
    margin: 0 auto 13px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 0 !important;
    background: #fff1e5 !important;
    color: var(--rev-orange-dark) !important;
}
.revisions-empty h3 {
    margin: 0 !important;
    color: #30383d !important;
    font-size: 16px !important;
}
.revisions-empty p {
    margin: 7px 0 0 !important;
    color: #80878b !important;
    font-size: 13px !important;
}
/* =========================================================
   REVISION DRAWER
========================================================= */
.revision-drawer-layer {
    position: fixed !important;
    inset: 0 !important;
    z-index: 9999 !important;
    display: flex !important;
    justify-content: flex-end !important;
    background: rgba(36, 32, 29, .28) !important;
    pointer-events: auto !important;
}
.revision-drawer-backdrop {
    position: absolute !important;
    inset: 0 !important;
    z-index: 1 !important;
    display: block !important;
}
.revision-drawer-panel {
    position: relative !important;
    z-index: 2 !important;
    width: min(620px, 94vw) !important;
    height: 100vh !important;
    overflow-y: auto !important;
    pointer-events: auto !important;
    border-left: 1px solid #d5ccc2 !important;
    background: #fffdfa !important;
    box-shadow: -18px 0 40px rgba(39,35,31,.12) !important;
}
.revision-drawer-header {
    border-bottom: 1px solid var(--rev-border) !important;
    background: #f4efe8 !important;
}
.revision-drawer-header h2 {
    color: #2f373c !important;
}
.revision-drawer-tabs {
    border-bottom: 1px solid var(--rev-border) !important;
    background: #faf7f3 !important;
}
.revision-drawer-tabs a {
    border-radius: 0 !important;
    color: #697278 !important;
}
.revision-drawer-tabs a.active {
    color: var(--rev-orange-dark) !important;
    box-shadow: inset 0 -2px 0 var(--rev-orange) !important;
}
.revision-request-card {
    border: 1px solid #e1dad2 !important;
    border-radius: 2px !important;
    background: #ffffff !important;
    box-shadow: none !important;
}
.revision-client-request-box,
.revision-ai-box,
.revision-request-details {
    border-radius: 2px !important;
}
/* =========================================================
   REVISION ATTACHMENT
========================================================= */
.revision-attachment-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-top: 12px;
    padding: 13px 14px;
    border: 1px solid #ded6ce;
    border-radius: 2px;
    background: #faf7f3;
}
.revision-attachment-info {
    min-width: 0;
}
.revision-attachment-label {
    display: block;
    margin-bottom: 4px;
    color: var(--rev-orange-dark);
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .07em;
}
.revision-attachment-info strong {
    display: block;
    overflow: hidden;
    color: #30383d;
    font-size: 13px;
    font-weight: 650;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.revision-attachment-info small {
    display: block;
    margin-top: 3px;
    color: #858c90;
    font-size: 13px;
}
.revision-attachment-actions {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
}
.revision-attachment-actions a {
    min-height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 10px;
    border: 1px solid #d8cfc6;
    border-radius: 2px;
    background: #ffffff;
    color: #4c555a;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
}
.revision-attachment-actions a:hover {
    border-color: var(--rev-orange);
    color: var(--rev-orange-dark);
}
@media (max-width: 560px) {
    .revision-attachment-box {
        align-items: flex-start;
        flex-direction: column;
    }
}
/* =========================================================
   REVISION DRAWER — COMPLETE LAYOUT FIX
========================================================= */
.revision-drawer-panel {
    width: min(560px, 94vw) !important;
    max-width: 560px !important;
    display: flex !important;
    flex-direction: column !important;
    overflow: hidden !important;
}
.revision-drawer-header {
    min-height: 92px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 18px !important;
    padding: 20px 22px !important;
    flex: 0 0 auto !important;
}
.revision-drawer-header > div {
    min-width: 0 !important;
}
.revision-drawer-header span {
    display: block !important;
    margin-bottom: 4px !important;
    color: var(--rev-orange-dark) !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    letter-spacing: .10em !important;
}
.revision-drawer-header h2 {
    margin: 0 !important;
    font-size: 20px !important;
    line-height: 1.2 !important;
    font-weight: 650 !important;
}
.revision-drawer-header p {
    margin: 4px 0 0 !important;
    color: var(--rev-muted) !important;
    font-size: 12px !important;
}
.revision-drawer-x {
    width: 38px !important;
    height: 38px !important;
    flex: 0 0 38px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 !important;
    border: 1px solid var(--rev-border) !important;
    border-radius: 2px !important;
    background: #fffdfa !important;
    color: #4e575c !important;
    text-decoration: none !important;
    overflow: hidden !important;
}
.revision-drawer-x:hover {
    border-color: var(--rev-orange) !important;
    color: var(--rev-orange-dark) !important;
}
.revision-drawer-x svg {
    width: 16px !important;
    height: 16px !important;
    max-width: 16px !important;
    max-height: 16px !important;
    display: block !important;
    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 1.8 !important;
    stroke-linecap: round !important;
}
.revision-drawer-tabs {
    min-height: 46px !important;
    display: flex !important;
    align-items: stretch !important;
    gap: 0 !important;
    padding: 0 18px !important;
    flex: 0 0 auto !important;
    overflow-x: auto !important;
}
.revision-drawer-tabs a {
    min-width: max-content !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 12px !important;
    font-size: 12px !important;
    font-weight: 650 !important;
    text-decoration: none !important;
}
.revision-drawer-content {
    flex: 1 1 auto !important;
    min-height: 0 !important;
    overflow-y: auto !important;
    padding: 16px 18px 28px !important;
    background: #f8f4ee !important;
}
.revision-request-card {
    overflow: hidden !important;
    margin-bottom: 12px !important;
}
.revision-request-card-head {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 12px !important;
    padding: 12px 14px !important;
    border-bottom: 1px solid #e7e0d8 !important;
    background: #faf7f3 !important;
}
.revision-request-card-head > div {
    min-width: 0 !important;
}
.revision-request-card-head strong {
    display: block !important;
    color: #30383d !important;
    font-size: 13px !important;
    font-weight: 700 !important;
}
.revision-request-card-head > div > span {
    display: block !important;
    margin-top: 3px !important;
    color: #858d91 !important;
    font-size: 13px !important;
}
.drawer-status {
    min-height: 26px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 9px !important;
    border: 1px solid #ddd5cc !important;
    border-radius: 999px !important;
    background: #fffdfa !important;
    color: #646d72 !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .03em !important;
    white-space: nowrap !important;
}
.drawer-status.pending {
    border-color: #e2c2a6 !important;
    background: #fff4e9 !important;
    color: #a65b22 !important;
}
.drawer-status.in_progress {
    border-color: #bdcec4 !important;
    background: #f1f6f3 !important;
    color: #526f5d !important;
}
.drawer-status.resolved {
    border-color: #b8c9bd !important;
    background: #edf4ef !important;
    color: #476653 !important;
}
.revision-request-card-body {
    padding: 15px !important;
}
.revision-request-card-body > h3 {
    margin: 0 0 12px !important;
    color: #293237 !important;
    font-size: 15px !important;
    line-height: 1.35 !important;
    font-weight: 650 !important;
}
.revision-client-request-box {
    padding: 13px 14px !important;
    border: 1px solid #e1dad2 !important;
    background: #fffdfa !important;
}
.revision-client-request-box > span,
.revision-ai-box span,
.revision-request-details span {
    color: var(--rev-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .07em !important;
}
.revision-client-request-box p {
    margin: 6px 0 0 !important;
    color: #505a5f !important;
    font-size: 13px !important;
    line-height: 1.6 !important;
    white-space: pre-wrap !important;
}
.revision-ai-box {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 14px !important;
    margin-top: 12px !important;
    padding: 12px 14px !important;
    border: 1px solid #e4c5ab !important;
    background: #fff6ed !important;
}
.revision-ai-left {
    min-width: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}
.revision-ai-icon {
    width: 32px !important;
    height: 32px !important;
    flex: 0 0 32px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border: 1px solid #e6c5aa !important;
    background: #fffdfa !important;
    color: var(--rev-orange-dark) !important;
}
.revision-ai-icon svg {
    width: 15px !important;
    height: 15px !important;
    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 1.7 !important;
}
.revision-ai-left strong {
    display: block !important;
    margin-top: 3px !important;
    color: #4f585d !important;
    font-size: 12px !important;
}
.view-ai-button {
    min-height: 32px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 11px !important;
    border: 1px solid var(--rev-orange) !important;
    border-radius: 2px !important;
    background: var(--rev-orange) !important;
    color: #fff !important;
    font: inherit !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    cursor: pointer !important;
}
.revision-request-details {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 8px !important;
    margin-top: 12px !important;
}
.revision-request-details > div {
    padding: 11px 12px !important;
    border: 1px solid #e1dad2 !important;
    background: #faf7f3 !important;
}
.revision-request-details strong {
    display: block !important;
    margin-top: 4px !important;
    color: #353e43 !important;
    font-size: 12px !important;
    font-weight: 650 !important;
}
.revision-drawer-empty {
    padding: 46px 20px !important;
    border: 1px solid #e1dad2 !important;
    background: #fffdfa !important;
    text-align: center !important;
}
.revision-drawer-empty h3 {
    margin: 0 !important;
    font-size: 14px !important;
    color: #30383d !important;
}
.revision-drawer-empty p {
    margin: 6px 0 0 !important;
    font-size: 12px !important;
    color: #7b8489 !important;
}
@media (max-width: 600px) {
    .revision-drawer-panel {
        width: 100vw !important;
        max-width: 100vw !important;
    }
    .revision-drawer-header {
        padding: 17px 16px !important;
    }
    .revision-drawer-tabs {
        padding: 0 8px !important;
    }
    .revision-drawer-content {
        padding: 12px !important;
    }
    .revision-request-details {
        grid-template-columns: 1fr !important;
    }
}
/* =========================================================
   AI MODAL
========================================================= */
.revision-ai-modal {
    position: fixed !important;
    inset: 0 !important;
    z-index: 100000 !important;
    display: none !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 24px !important;
    background: rgba(31, 35, 38, .52) !important;
    pointer-events: none !important;
}
.revision-ai-modal.show {
    display: flex !important;
    pointer-events: auto !important;
}
.revision-ai-modal-card {
    position: relative !important;
    z-index: 100001 !important;
    width: min(620px, calc(100vw - 40px)) !important;
    max-height: min(720px, calc(100vh - 48px)) !important;
    overflow: hidden !important;
    display: flex !important;
    flex-direction: column !important;
    background: #fffdfa !important;
    border: 1px solid var(--rev-border) !important;
    border-radius: 2px !important;
    box-shadow: 0 20px 50px rgba(39,35,31,.16) !important;
}
.revision-ai-modal-head {
    border-bottom: 1px solid var(--rev-border) !important;
    background: #f4efe8 !important;
}
.revision-ai-modal-footer {
    border-top: 1px solid var(--rev-border) !important;
    background: #faf7f3 !important;
}
.revision-ai-modal-head {
    display: flex !important;
    align-items: flex-start !important;
    justify-content: space-between !important;
    gap: 18px !important;
    padding: 18px 20px !important;
}
.revision-ai-modal-head span {
    display: block !important;
    color: var(--rev-orange-dark) !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    letter-spacing: .08em !important;
}
.revision-ai-modal-head h3 {
    margin: 4px 0 0 !important;
    color: #30383d !important;
    font-size: 18px !important;
}
#closeAiModal {
    width: 34px !important;
    height: 34px !important;
    flex: 0 0 34px !important;
    border: 1px solid #d8d0c7 !important;
    border-radius: 2px !important;
    background: #fff !important;
    color: #4d565b !important;
    font-size: 22px !important;
    line-height: 1 !important;
    cursor: pointer !important;
}
.revision-ai-modal-body {
    overflow-y: auto !important;
    padding: 20px !important;
}
.revision-view-only {
    display: inline-flex !important;
    margin-bottom: 12px !important;
    padding: 5px 8px !important;
    border: 1px solid #e6c5aa !important;
    background: #fff6ed !important;
    color: var(--rev-orange-dark) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: .08em !important;
}
#aiSuggestionText {
    margin: 0 !important;
    color: #3f484d !important;
    font-size: 12px !important;
    line-height: 1.7 !important;
    white-space: pre-wrap !important;
}
.revision-ai-modal-footer {
    display: flex !important;
    justify-content: flex-end !important;
    padding: 13px 20px !important;
}
#closeAiModalButton {
    min-height: 36px !important;
    padding: 0 16px !important;
    border: 1px solid var(--rev-orange) !important;
    border-radius: 2px !important;
    background: var(--rev-orange) !important;
    color: #fff !important;
    font: inherit !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    cursor: pointer !important;
}
.view-ai-button {
    position: relative !important;
    z-index: 10 !important;
    pointer-events: auto !important;
    cursor: pointer !important;
}
.revision-ai-source {
    display: none !important;
}
/* =========================================================
   RESPONSIVE
========================================================= */
@media (max-width: 1240px) {
    .revisions-page-head {
        grid-template-columns: 1fr !important;
    }
    .revisions-counts {
        grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
    }
    .revision-project-card {
        grid-template-columns: 1fr 1fr !important;
    }
    .revision-project-request {
        border-right: 0 !important;
    }
    .revision-project-statuses,
    .revision-project-footer {
        border-top: 1px solid #e7e0d8 !important;
    }
}
@media (max-width: 840px) {
    .revisions-page {
        width: calc(100% - 28px) !important;
        padding-top: 20px !important;
    }
    .top-date {
        display: none !important;
    }
    .revisions-controls {
        align-items: stretch !important;
        flex-direction: column !important;
    }
    .revisions-control-actions {
        width: 100%;
    }
    .revision-search {
        min-width: 0;
        flex: 1;
    }
    .revision-project-card {
        grid-template-columns: 1fr !important;
    }
    .revision-project-identity,
    .revision-project-request,
    .revision-project-statuses {
        border-right: 0 !important;
        border-bottom: 1px solid #e7e0d8 !important;
    }
}
@media (max-width: 560px) {
    .revisions-page-head {
        padding: 22px 18px !important;
    }
    .revisions-heading h2 {
        font-size: 26px !important;
    }
    .revisions-counts {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    .revisions-control-actions {
        flex-direction: column !important;
    }
    .revision-search,
    #revisionSort {
        width: 100% !important;
    }
    .revision-project-statuses {
        grid-template-columns: 1fr !important;
    }
}
</style>
<style>
html, body, button, input, textarea, select, option {
    font-family: "Segoe UI", Arial, sans-serif !important;
}
</style>
</head>
<body>
@php
    $authUser = auth()->user();
    $architectName = $authUser?->name ?: 'Architect';
    $projectsWithRevisions = $projectsWithRevisions ?? collect();
    $totalRevisionCount = $totalRevisionCount ?? 0;
    $pendingRevisionCount = $pendingRevisionCount ?? 0;
    $inProgressRevisionCount = $inProgressRevisionCount ?? 0;
    $resolvedRevisionCount = $resolvedRevisionCount ?? 0;
    $selectedProject = $selectedProject ?? null;
    $selectedRevisions = $selectedRevisions ?? collect();
    $revisionFilter = $revisionFilter ?? 'all';
@endphp
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
    {{-- =========================================================
        SIDEBAR
        EXACT SAME STRUCTURE AS DASHBOARD CSS
    ========================================================== --}}
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
                    {{ strtoupper(substr($architectName, 0, 1)) }}
                </div>
                <div class="identity-info">
                    <strong>
                        {{ $architectName }}
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
    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <main class="main-content">
        {{-- =====================================================
            TOPBAR
            SAME DASHBOARD CLASSES
        ====================================================== --}}
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
                <span class="workspace-label">
                    ARCHITECT WORKSPACE
                </span>
                <h1>
                    Revisions
                </h1>
            </div>
            <div class="top-date">
                <span>
                    {{ now()->format('l') }}
                </span>
                <strong>
                    {{ now()->format('F d, Y') }}
                </strong>
            </div>
        </header>
        {{-- =====================================================
            REVISIONS CONTENT
        ====================================================== --}}
        <div class="revisions-page">
            {{-- PAGE INTRO --}}
            <section class="revisions-page-head">
                <div class="revisions-heading">
                    <div class="revisions-heading-icon">
                        <svg viewBox="0 0 24 24">
                            <path d="M4 4h16v12H7l-3 3z"></path>
                            <path d="M8 8h8"></path>
                            <path d="M8 12h5"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="revisions-overline">
                            REVISION MANAGEMENT
                        </p>
                        <h2>
                            Client Revision Requests
                        </h2>
                        <p class="revisions-description">
                            Track and review client revision requests
                            across all of your projects.
                        </p>
                    </div>
                </div>
                {{-- COUNTS --}}
                <div class="revisions-counts">
                    <div class="revision-count-item">
                        <strong>
                            {{ $totalRevisionCount ?? 0 }}
                        </strong>
                        <span>
                            Total
                        </span>
                    </div>
                    <div class="revision-count-item count-pending">
                        <strong>
                            {{ $pendingRevisionCount ?? 0 }}
                        </strong>
                        <span>
                            Pending
                        </span>
                    </div>
                    <div class="revision-count-item count-approved">
                        <strong>
                            {{ $inProgressRevisionCount ?? 0 }}
                        </strong>
                        <span>
                            In Progress
                        </span>
                    </div>
                    <div class="revision-count-item count-complete">
                        <strong>
                            {{ $resolvedRevisionCount ?? 0 }}
                        </strong>
                        <span>
                            Resolved
                        </span>
                    </div>
                </div>
            </section>
            {{-- =================================================
                PROJECT TOOLBAR
            ================================================== --}}
            <section class="revisions-controls">
                <div>
                    <span class="revisions-section-label">
                        PROJECTS
                    </span>
                    <h3>
                        Projects with Revision Requests
                    </h3>
                </div>
                <div class="revisions-control-actions">
                    {{-- SEARCH --}}
                    <div class="revision-search">
                        <svg viewBox="0 0 24 24">
                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                            ></circle>
                            <path d="M20 20l-4.5-4.5"></path>
                        </svg>
                        <input
                            id="revisionSearch"
                            type="text"
                            placeholder="Search project"
                        >
                    </div>
                    {{-- SORT --}}
                    <select id="revisionSort">
                        <option value="latest">
                            Last Updated
                        </option>
                        <option value="most">
                            Most Requests
                        </option>
                        <option value="pending">
                            Most Pending
                        </option>
                    </select>
                </div>
            </section>
            {{-- =================================================
                PROJECT LIST
            ================================================== --}}
            <section
                class="revisions-project-list"
                id="revisionProjectList"
            >
                @forelse($projectsWithRevisions as $project)
                    @php
                        $projectRevisions =
                            $project->revisions ?? collect();
                        $total =
                            $project->revision_total
                            ?? $projectRevisions->count();
                        $pending =
                            $project->revision_pending
                            ?? $projectRevisions
                                ->where('status', 'pending')
                                ->count();
                        $inProgress =
                            $project->revision_in_progress
                            ?? $projectRevisions
                                ->where('status', 'in_progress')
                                ->count();
                        $resolved =
                            $project->revision_resolved
                            ?? $projectRevisions
                                ->where('status', 'resolved')
                                ->count();
                        $lastRevision =
                            $project->last_revision
                            ?? $projectRevisions
                                ->sortByDesc('created_at')
                                ->first();
                        $clientName =
                            optional($project->client)->name
                            ?? $project->client_name
                            ?? 'Client';
                        $latestRequest =
                            optional($lastRevision)->request
                            ?? optional($lastRevision)->description
                            ?? optional($lastRevision)->revision_request
                            ?? 'Client submitted a revision request for this project.';
                    @endphp
                    <article
                        class="revision-project-card"
                        data-project="{{ strtolower((string) ($project->project_name ?? '')) }}"
                        data-total="{{ $total }}"
                        data-pending="{{ $pending }}"
                        data-date="{{ optional($lastRevision)->created_at?->timestamp ?? 0 }}"
                    >
                        {{-- PROJECT --}}
                        <div class="revision-project-identity">
                            <div class="revision-project-thumb">
                                @if(!empty($project->project_image))
                                    <img
                                        src="{{ asset('storage/' . $project->project_image) }}"
                                        alt="{{ $project->project_name ?? 'Untitled Project' }}"
                                        onerror="
                                            this.style.display='none';
                                            this.nextElementSibling.style.display='flex';
                                        "
                                    >
                                    <div
                                        class="revision-project-thumb-fallback"
                                        style="display:none;"
                                    >
                                        {{ strtoupper(
                                            substr(
                                                $project->project_name,
                                                0,
                                                1
                                            )
                                        ) }}
                                    </div>
                                @else
                                    <div class="revision-project-thumb-fallback">
                                        {{ strtoupper(
                                            substr(
                                                $project->project_name,
                                                0,
                                                1
                                            )
                                        ) }}
                                    </div>
                                @endif
                            </div>
                            <div class="revision-project-name">
                                <span>
                                    PROJECT #{{ str_pad(
                                        $project->id,
                                        4,
                                        '0',
                                        STR_PAD_LEFT
                                    ) }}
                                </span>
                                <h3>
                                    {{ $project->project_name ?? 'Untitled Project' }}
                                </h3>
                                <p>
                                    {{ $clientName }}
                                </p>
                            </div>
                        </div>
                        {{-- LATEST REQUEST --}}
                        <div class="revision-project-request">
                            <span>
                                LATEST CLIENT REQUEST
                            </span>
                            <p>
                                {{ $latestRequest }}
                            </p>
                        </div>
                        {{-- STATUS COUNTS --}}
                        <div class="revision-project-statuses">
                            <div class="revision-status-pill pending">
                                <strong>
                                    {{ $pending }}
                                </strong>
                                <span>
                                    Pending
                                </span>
                            </div>
                            <div class="revision-status-pill approved in-progress">
                                <strong>
                                    {{ $inProgress }}
                                </strong>
                                <span>
                                    In Progress
                                </span>
                            </div>
                            <div class="revision-status-pill implemented resolved">
                                <strong>
                                    {{ $resolved }}
                                </strong>
                                <span>
                                    Resolved
                                </span>
                            </div>
                        </div>
                        {{-- FOOTER --}}
                        <div class="revision-project-footer">
                            <div class="revision-project-meta">
                                <div>
                                    <span>
                                        TOTAL REQUESTS
                                    </span>
                                    <strong>
                                        {{ $total }}
                                    </strong>
                                </div>
                                <div>
                                    <span>
                                        LAST UPDATED
                                    </span>
                                    <strong>
                                        @if(optional($lastRevision)->created_at)
                                            {{ $lastRevision
                                                ->created_at
                                                ->format('M d, Y')
                                            }}
                                        @else
                                            No activity
                                        @endif
                                    </strong>
                                </div>
                            </div>
                            <a
                                href="{{ route('architect.revisions.index', [
                                    'project' => $project->id
                                ]) }}"
                                class="revision-open-button"
                            >
                                View Requests
                                <svg viewBox="0 0 24 24">
                                    <path d="M9 18l6-6-6-6"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="revisions-empty">
                        <div class="revisions-empty-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 4h16v12H7l-3 3z"></path>
                                <path d="M8 8h8"></path>
                                <path d="M8 12h5"></path>
                            </svg>
                        </div>
                        <h3>
                            No revision requests yet
                        </h3>
                        <p>
                            Revision requests submitted by clients
                            will appear here.
                        </p>
                    </div>
                @endforelse
            </section>
        </div>
    </main>
    {{-- =========================================================
        REVISION DRAWER
    ========================================================== --}}
    @if($selectedProject)
        <div class="revision-drawer-layer">
            <a
                href="{{ route('architect.revisions.index') }}"
                class="revision-drawer-backdrop"
                aria-label="Close"
            ></a>
            <aside class="revision-drawer-panel">
                {{-- HEADER --}}
                <div class="revision-drawer-header">
                    <div>
                        <span>
                            PROJECT REVISIONS
                        </span>
                        <h2>
                            {{ $selectedProject->project_name }}
                        </h2>
                        <p>
                            Project #{{ str_pad(
                                $selectedProject->id,
                                4,
                                '0',
                                STR_PAD_LEFT
                            ) }}
                        </p>
                    </div>
                    <a
                        href="{{ route('architect.revisions.index') }}"
                        class="revision-drawer-x"
                    >
                        <svg viewBox="0 0 24 24">
                            <path d="M6 6l12 12"></path>
                            <path d="M18 6L6 18"></path>
                        </svg>
                    </a>
                </div>
                {{-- TABS --}}
                <div class="revision-drawer-tabs">
                    <a
                        href="{{ route('architect.revisions.index', [
                            'project' => $selectedProject->id,
                            'revision_status' => 'all'
                        ]) }}"
                        class="{{ ($revisionFilter ?? 'all') === 'all' ? 'active' : '' }}"
                    >
                        All
                    </a>
                    <a
                        href="{{ route('architect.revisions.index', [
                            'project' => $selectedProject->id,
                            'revision_status' => 'pending'
                        ]) }}"
                        class="{{ ($revisionFilter ?? '') === 'pending' ? 'active' : '' }}"
                    >
                        Pending
                    </a>
                    <a
                        href="{{ route('architect.revisions.index', [
                            'project' => $selectedProject->id,
                            'revision_status' => 'in_progress'
                        ]) }}"
                        class="{{ ($revisionFilter ?? '') === 'in_progress' ? 'active' : '' }}"
                    >
                        In Progress
                    </a>
                    <a
                        href="{{ route('architect.revisions.index', [
                            'project' => $selectedProject->id,
                            'revision_status' => 'resolved'
                        ]) }}"
                        class="{{ ($revisionFilter ?? '') === 'resolved' ? 'active' : '' }}"
                    >
                        Resolved
                    </a>
                </div>
                {{-- REQUEST LIST --}}
                <div class="revision-drawer-content">
                    @forelse($selectedRevisions as $revision)
                        <article class="revision-request-card">
                            <div class="revision-request-card-head">
                                <div>
                                    <strong>
                                        REV-{{ str_pad(
                                            $revision->id,
                                            3,
                                            '0',
                                            STR_PAD_LEFT
                                        ) }}
                                    </strong>
                                    <span>
                                        {{ optional($revision->created_at)
                                            ->format('M d, Y • h:i A')
                                        }}
                                    </span>
                                </div>
                                <span
                                    class="drawer-status {{ strtolower(
                                        $revision->status ?? 'pending'
                                    ) }}"
                                >
                                    {{ ucwords(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $revision->status ?? 'pending'
                                        )
                                    ) }}
                                </span>
                            </div>
                            <div class="revision-request-card-body">
                                <h3>
                                    {{ $revision->title
                                        ?? 'Revision Request'
                                    }}
                                </h3>
                                {{-- CLIENT REQUEST --}}
                                <div class="revision-client-request-box">
                                    <span>
                                        CLIENT REQUEST
                                    </span>
                                    <p>
                                        {{
                                            $revision->request
                                            ?? $revision->description
                                            ?? $revision->revision_request
                                            ?? 'Client submitted a revision request.'
                                        }}
                                    </p>
                                </div>
                                {{-- REVISION ATTACHMENT --}}
                                @if(!empty($revision->attachment_path))
                                    <div class="revision-attachment-box">
                                        <div class="revision-attachment-info">
                                            <span class="revision-attachment-label">ATTACHMENT</span>
                                            <strong>{{ $revision->attachment_name ?? 'Revision attachment' }}</strong>
                                            @if(!empty($revision->attachment_size))
                                                <small>{{ number_format($revision->attachment_size / 1024, 1) }} KB</small>
                                            @endif
                                        </div>
                                        <div class="revision-attachment-actions">
                                            <a
                                                href="{{ route('project.revisions.attachments.secure.view', [
                                                    'projectId' => $selectedProject->id,
                                                    'revisionId' => $revision->id
                                                ]) }}"
                                                target="_blank"
                                                rel="noopener"
                                            >
                                                View
                                            </a>
                                            <a
                                                href="{{ route('project.revisions.attachments.secure.download', [
                                                    'projectId' => $selectedProject->id,
                                                    'revisionId' => $revision->id
                                                ]) }}"
                                            >
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                {{-- AI STRUCTURED REVISION --}}
                                @if(!empty(trim((string) $revision->ai_structured_feedback)))
                                <div class="revision-ai-box">
                                    <div class="revision-ai-left">
                                        <div class="revision-ai-icon">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M12 3l1.8 4.4L18 9l-4.2 1.6L12 15l-1.8-4.4L6 9l4.2-1.6z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <span>
                                                CLIENT AI SUGGESTION
                                            </span>
                                            <strong>
                                                View only
                                            </strong>
                                        </div>
                                    </div>
                                    <button
                                        type="button"
                                        class="view-ai-button"
                                        onclick="openAiSuggestion('ai-suggestion-{{ $revision->id }}'); return false;"
                                    >
                                        View
                                    </button>
                                    <div
                                        id="ai-suggestion-{{ $revision->id }}"
                                        class="revision-ai-source"
                                        hidden
                                    >{{ $revision->ai_structured_feedback }}</div>
                                </div>
                                @endif
                                {{-- DETAILS --}}
                                <div class="revision-request-details">
                                    <div>
                                        <span>
                                            REQUESTED BY
                                        </span>
                                        <strong>
                                            {{ optional($revision->client)->name
                                                ?? 'Client'
                                            }}
                                        </strong>
                                    </div>
                                    <div>
                                        <span>
                                            PRIORITY
                                        </span>
                                        <strong>
                                            {{ ucfirst(
                                                $revision->priority
                                                ?? 'Normal'
                                            ) }}
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="revision-drawer-empty">
                            <h3>
                                No revision requests
                            </h3>
                            <p>
                                No requests were found under this status.
                            </p>
                        </div>
                    @endforelse
                </div>
            </aside>
        </div>
    @endif
    {{-- =========================================================
        AI MODAL
    ========================================================== --}}
    <div
        class="revision-ai-modal"
        id="aiModal"
    >
        <div class="revision-ai-modal-card">
            <div class="revision-ai-modal-head">
                <div>
                    <span>
                        CLIENT AI SUGGESTION
                    </span>
                    <h3>
                        AI Recommendation
                    </h3>
                </div>
                <button
                    type="button"
                    id="closeAiModal"
                >
                    ×
                </button>
            </div>
            <div class="revision-ai-modal-body">
                <div class="revision-view-only">
                    VIEW ONLY
                </div>
                <p id="aiSuggestionText">
                    No AI suggestion available.
                </p>
            </div>
            <div class="revision-ai-modal-footer">
                <button
                    type="button"
                    id="closeAiModalButton"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
    {{-- =========================================================
        PAGE JAVASCRIPT
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            /*
            |--------------------------------------------------------------------------
            | SEARCH
            |--------------------------------------------------------------------------
            */
            const search =
                document.getElementById('revisionSearch');
            const cards =
                document.querySelectorAll('.revision-project-card');
            if (search) {
                search.addEventListener('input', function () {
                    const keyword =
                        this.value
                            .toLowerCase()
                            .trim();
                    cards.forEach(function (card) {
                        const project =
                            card.dataset.project || '';
                        card.style.display =
                            project.includes(keyword)
                                ? ''
                                : 'none';
                    });
                });
            }
            /*
            |--------------------------------------------------------------------------
            | SORT
            |--------------------------------------------------------------------------
            */
            const sort =
                document.getElementById('revisionSort');
            const projectList =
                document.getElementById('revisionProjectList');
            if (sort && projectList) {
                sort.addEventListener('change', function () {
                    const projectCards =
                        Array.from(
                            projectList.querySelectorAll(
                                '.revision-project-card'
                            )
                        );
                    projectCards.sort(function (a, b) {
                        if (sort.value === 'most') {
                            return (
                                Number(b.dataset.total) -
                                Number(a.dataset.total)
                            );
                        }
                        if (sort.value === 'pending') {
                            return (
                                Number(b.dataset.pending) -
                                Number(a.dataset.pending)
                            );
                        }
                        return (
                            Number(b.dataset.date) -
                            Number(a.dataset.date)
                        );
                    });
                    projectCards.forEach(function (card) {
                        projectList.appendChild(card);
                    });
                });
            }
            /*
            |--------------------------------------------------------------------------
            | AI MODAL
            |--------------------------------------------------------------------------
            */
            const aiModal =
                document.getElementById('aiModal');
            const aiText =
                document.getElementById('aiSuggestionText');
            const closeAiModal =
                document.getElementById('closeAiModal');
            const closeAiModalButton =
                document.getElementById('closeAiModalButton');
            window.openAiSuggestion = function (sourceId) {
                const source = document.getElementById(sourceId);
                const suggestion = source ? source.textContent.trim() : '';
                if (aiText) {
                    aiText.textContent = suggestion ||
                        'No AI suggestion was provided for this revision request.';
                }
                if (aiModal) {
                    aiModal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            };
            function closeModal() {
                if (aiModal) {
                    aiModal.classList.remove('show');
                    document.body.style.overflow = '';
                }
            }
            if (closeAiModal) {
                closeAiModal.addEventListener(
                    'click',
                    closeModal
                );
            }
            if (closeAiModalButton) {
                closeAiModalButton.addEventListener(
                    'click',
                    closeModal
                );
            }
            if (aiModal) {
                aiModal.addEventListener(
                    'click',
                    function (event) {
                        if (event.target === aiModal) {
                            closeModal();
                        }
                    }
                );
            }
            document.addEventListener(
                'keydown',
                function (event) {
                    if (event.key === 'Escape') {
                        closeModal();
                    }
                }
            );
        });
    </script>
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
        mobileSidebarLauncher?.setAttribute(
            'aria-expanded',
            'true'
        );
    }
    function closeMobileSidebar() {
        body.classList.remove('mobile-sidebar-open');
        mobileSidebarLauncher?.setAttribute(
            'aria-expanded',
            'false'
        );
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
        desktopMedia.addListener(
            syncSidebarForViewport
        );
    }
    syncSidebarForViewport();
});
</script>
</body>
</html>
