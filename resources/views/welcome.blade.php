<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta
        name="description"
        content="ArchiTrack - Architectural Project Management System for Vero Designs Architectural Services"
    >

    <title>ArchiTrack | Vero Designs</title>

    @vite([
        'resources/css/app.css',
        'resources/css/landing.css',
        'resources/js/app.js'
    ])

    <style>
        /* =========================================================
           LANDING PAGE READABILITY + SPACING REFRESH
        ========================================================== */

        html {
            scroll-behavior: smooth;
        }

        body {
            font-size: 16px;
            line-height: 1.65;
        }

        .main-header {
            padding-left: clamp(24px, 4vw, 64px);
            padding-right: clamp(24px, 4vw, 64px);
        }

        .main-nav {
            gap: clamp(16px, 2vw, 30px);
        }

        .main-nav a {
            font-size: 14px;
        }

        .hero-content {
            width: min(1120px, 88vw);
            max-width: 1120px;
        }

        .hero-content h1 {
            max-width: 920px;
            font-size: clamp(42px, 5vw, 68px);
            line-height: 1.02;
            letter-spacing: -0.035em;
        }

        .hero-content > p:not(.hero-note) {
            max-width: 760px;
            font-size: clamp(16px, 1.45vw, 19px);
            line-height: 1.75;
        }

        .hero-label,
        .section-label,
        .section-title > span,
        .architects-eyebrow,
        .vero-about-kicker {
            font-size: 11px;
            letter-spacing: .18em;
        }

        .about-section,
        .features-section,
        .contact-section,
        .privacy-section,
        .terms-section {
            padding-left: clamp(28px, 6vw, 90px);
            padding-right: clamp(28px, 6vw, 90px);
        }

        .refreshed-about {
            padding-top: 108px;
            padding-bottom: 118px;
            background:
                linear-gradient(rgba(255,255,255,.95), rgba(255,255,255,.95)),
                linear-gradient(90deg, rgba(223,112,43,.05) 1px, transparent 1px),
                linear-gradient(rgba(223,112,43,.05) 1px, transparent 1px);
            background-size: auto, 64px 64px, 64px 64px;
        }

        .refreshed-section-title {
            max-width: 1180px;
            margin: 0 auto 56px;
        }

        .refreshed-section-title h2 {
            max-width: 900px;
            margin: 12px 0 22px;
            font-size: clamp(38px, 4.4vw, 64px);
            line-height: 1.03;
            letter-spacing: -.035em;
        }

        .refreshed-section-title p {
            max-width: 900px;
            margin: 0;
            font-size: 17px;
            line-height: 1.8;
            color: #66615b;
        }

        .vero-about-grid {
            width: min(1180px, 100%);
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 44px;
            align-items: stretch;
        }

        .vero-about-story,
        .vero-about-focus {
            border: 1px solid rgba(25,25,25,.10);
            background: rgba(255,255,255,.88);
            padding: clamp(30px, 4vw, 54px);
        }

        .vero-about-story h3 {
            max-width: 700px;
            margin: 12px 0 22px;
            font-size: clamp(30px, 3vw, 44px);
            line-height: 1.08;
            font-weight: 500;
            letter-spacing: -.025em;
            color: #1c1c1c;
        }

        .vero-about-story p,
        .vero-principal-card p,
        .vero-portfolio-head p {
            font-size: 16px;
            line-height: 1.85;
            color: #68635d;
        }

        .vero-about-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            margin-top: 38px;
            background: rgba(25,25,25,.10);
            border: 1px solid rgba(25,25,25,.10);
        }

        .vero-stat {
            min-height: 130px;
            padding: 22px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #faf9f6;
        }

        .vero-stat strong {
            font-size: clamp(28px, 3vw, 42px);
            line-height: 1;
            font-weight: 500;
            color: #df702b;
        }

        .vero-stat span {
            margin-top: 18px;
            font-size: 12px;
            line-height: 1.45;
            letter-spacing: .04em;
            color: #5f5a55;
        }

        .vero-sector-list {
            display: grid;
            gap: 0;
            margin-top: 20px;
            border-top: 1px solid rgba(25,25,25,.12);
        }

        .vero-sector-list span {
            padding: 17px 0;
            border-bottom: 1px solid rgba(25,25,25,.10);
            font-size: 16px;
            color: #222;
        }

        .vero-principal-card {
            margin-top: 34px;
            padding: 24px;
            background: #1d1d1d;
            color: #fff;
        }

        .vero-principal-card small {
            display: block;
            margin-bottom: 12px;
            font-size: 10px;
            letter-spacing: .17em;
            color: #ef8a49;
        }

        .vero-principal-card strong {
            display: block;
            font-size: 21px;
            font-weight: 500;
        }

        .vero-principal-card p {
            margin: 8px 0 0;
            color: rgba(255,255,255,.68);
        }

        .vero-portfolio-panel {
            width: min(1180px, 100%);
            margin: 42px auto 0;
            padding: clamp(30px, 4vw, 52px);
            background: #f2f0eb;
            border: 1px solid rgba(25,25,25,.08);
        }

        .vero-portfolio-head {
            display: grid;
            grid-template-columns: 1.1fr .8fr;
            gap: 50px;
            align-items: end;
            margin-bottom: 32px;
        }

        .vero-portfolio-head h3 {
            max-width: 680px;
            margin: 10px 0 0;
            font-size: clamp(27px, 2.7vw, 40px);
            line-height: 1.1;
            font-weight: 500;
            letter-spacing: -.025em;
        }

        .vero-project-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            border-top: 1px solid rgba(25,25,25,.12);
            border-left: 1px solid rgba(25,25,25,.12);
        }

        .vero-project-list span {
            min-height: 86px;
            padding: 20px;
            display: flex;
            align-items: center;
            border-right: 1px solid rgba(25,25,25,.12);
            border-bottom: 1px solid rgba(25,25,25,.12);
            background: rgba(255,255,255,.58);
            font-size: 14px;
            line-height: 1.55;
            color: #302e2b;
        }

        .features-section .feature-banner-heading,
        .architects-heading {
            max-width: 1180px;
            margin-left: auto;
            margin-right: auto;
        }

        .feature-banner-heading h2,
        .architects-heading h2 {
            font-size: clamp(38px, 4.4vw, 64px);
        }

        .feature-banner-heading p,
        .architects-heading p {
            font-size: 16px;
            line-height: 1.75;
        }

        .feature-banner-card p,
        .architect-slide-copy p,
        .privacy-copy > p,
        .term-card p,
        .contact-left p {
            font-size: 16px;
            line-height: 1.75;
        }

        .refreshed-highlight {
            padding: 110px clamp(28px, 7vw, 110px);
        }

        .refreshed-highlight-content {
            width: min(1060px, 100%);
            margin: 0 auto;
        }

        .refreshed-highlight-content h2 {
            max-width: 920px;
            font-size: clamp(38px, 4.6vw, 66px);
            line-height: 1.03;
        }

        .refreshed-highlight-content p {
            max-width: 920px;
            font-size: 17px;
            line-height: 1.85;
        }

        .workspace-pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 34px;
        }

        .workspace-pill-row span {
            padding: 10px 14px;
            border: 1px solid rgba(255,255,255,.28);
            font-size: 12px;
            letter-spacing: .04em;
            color: rgba(255,255,255,.88);
        }

        .refreshed-contact {
            width: 100%;
            max-width: none;
            padding-top: 110px;
            padding-bottom: 110px;
            display: grid;
            grid-template-columns: minmax(0,.8fr) minmax(0,1.2fr);
            gap: clamp(44px, 7vw, 100px);
            align-items: start;
        }

        .refreshed-contact-intro {
            max-width: 540px;
        }

        .refreshed-contact-intro h2 {
            margin: 10px 0 20px;
            font-size: clamp(42px, 5vw, 68px);
            line-height: 1;
            letter-spacing: -.04em;
        }

        .refreshed-contact-intro p {
            font-size: 17px;
            line-height: 1.8;
        }

        .contact-office-note {
            margin-top: 34px;
            padding-top: 20px;
            border-top: 1px solid rgba(25,25,25,.12);
        }

        .contact-office-note span,
        .contact-detail-row small {
            display: block;
            font-size: 10px;
            letter-spacing: .16em;
            color: #9a9288;
        }

        .contact-office-note strong {
            display: block;
            margin-top: 7px;
            font-size: 15px;
            font-weight: 600;
        }

        .refreshed-contact-card {
            padding: 0;
            border: 1px solid rgba(25,25,25,.10);
            background: #fff;
        }

        .contact-detail-row {
            display: grid;
            grid-template-columns: 48px 1fr auto;
            gap: 18px;
            align-items: center;
            min-height: 112px;
            padding: 22px 26px;
            border-bottom: 1px solid rgba(25,25,25,.10);
            text-decoration: none;
            color: inherit;
        }

        .contact-detail-row:last-child {
            border-bottom: 0;
        }

        a.contact-detail-row {
            transition: background .2s ease, transform .2s ease;
        }

        a.contact-detail-row:hover {
            background: #fbf7f2;
        }

        .contact-detail-no {
            font-size: 11px;
            letter-spacing: .12em;
            color: #df702b;
        }

        .contact-detail-row strong {
            display: block;
            margin-top: 7px;
            font-size: 16px;
            line-height: 1.55;
            font-weight: 600;
            word-break: break-word;
        }

        .contact-detail-row strong a {
            color: inherit;
            text-decoration: none;
        }

        .contact-number-divider {
            margin: 0 8px;
            color: #bbb3aa;
        }

        .contact-detail-arrow {
            font-size: 20px;
            color: #df702b;
        }

        .privacy-copy h2,
        .terms-section .section-title h2,
        .cta-content h2 {
            font-size: clamp(38px, 4.4vw, 62px);
        }

        .privacy-copy > p,
        .terms-section .section-title p,
        .cta-content p {
            font-size: 16px;
            line-height: 1.8;
        }

        @media (max-width: 980px) {
            .vero-about-grid,
            .vero-portfolio-head,
            .refreshed-contact {
                grid-template-columns: 1fr;
            }

            .vero-project-list {
                grid-template-columns: repeat(2, 1fr);
            }

            .refreshed-contact-intro {
                max-width: 760px;
            }
        }

        @media (max-width: 700px) {
            body {
                font-size: 15px;
            }

            .main-nav a {
                font-size: 13px;
            }

            .hero-content {
                width: min(92vw, 760px);
            }

            .hero-content h1 {
                font-size: clamp(38px, 11vw, 54px);
            }

            .refreshed-about,
            .refreshed-contact,
            .refreshed-highlight {
                padding-top: 82px;
                padding-bottom: 82px;
            }

            .vero-about-stats {
                grid-template-columns: 1fr;
            }

            .vero-project-list {
                grid-template-columns: 1fr;
            }

            .vero-portfolio-head {
                gap: 20px;
            }

            .contact-detail-row {
                grid-template-columns: 36px 1fr;
            }

            .contact-detail-arrow {
                display: none;
            }

            .contact-number-divider {
                display: block;
                height: 6px;
                font-size: 0;
            }
        }
    </style>


<style>
/* =========================================================
   INTERACTIVE VERO STORY
========================================================== */

.interactive-vero-about {
    padding-top: 100px;
    padding-bottom: 110px;
}

.vero-story-shell {
    width: min(1180px, 100%);
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(0, 1.35fr) minmax(300px, .65fr);
    border: 1px solid rgba(24,24,24,.10);
    background: #f8f7f3;
    box-shadow: 0 24px 60px rgba(30,30,30,.06);
}

.vero-story-visual {
    position: relative;
    min-height: 580px;
    overflow: hidden;
    background: #1b1b1b;
    color: #fff;
}

.vero-story-grid {
    position: absolute;
    inset: 0;
    opacity: .14;
    background-image:
        linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px);
    background-size: 56px 56px;
    transform: scale(1.04);
}

.vero-story-index {
    position: absolute;
    top: 34px;
    left: 38px;
    right: 38px;
    z-index: 4;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 11px;
    letter-spacing: .16em;
    color: rgba(255,255,255,.48);
}

.vero-story-index i {
    width: 56px;
    height: 1px;
    background: rgba(255,255,255,.22);
}

.vero-story-stage {
    position: relative;
    min-height: 580px;
}

.vero-story-slide {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 94px 72px 78px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(22px);
    transition:
        opacity .55s ease,
        transform .65s cubic-bezier(.22,.61,.36,1),
        visibility .55s ease;
}

.vero-story-slide.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.vero-story-kicker {
    margin-bottom: 18px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .18em;
    color: #ef8a49;
}

.vero-story-slide h3 {
    max-width: 700px;
    margin: 0 0 26px;
    font-size: clamp(38px, 4vw, 60px);
    line-height: 1.02;
    font-weight: 400;
    letter-spacing: -.04em;
}

.vero-story-slide p {
    max-width: 720px;
    margin: 0;
    font-size: 17px;
    line-height: 1.8;
    color: rgba(255,255,255,.68);
}

.vero-story-metric {
    margin-top: 44px;
    padding-top: 24px;
    border-top: 1px solid rgba(255,255,255,.14);
}

.vero-story-metric strong {
    display: block;
    font-size: clamp(44px, 5vw, 72px);
    line-height: 1;
    font-weight: 300;
    color: #ef8a49;
}

.vero-story-metric span {
    display: block;
    margin-top: 8px;
    font-size: 12px;
    letter-spacing: .10em;
    text-transform: uppercase;
    color: rgba(255,255,255,.48);
}

.vero-sector-cloud,
.vero-portfolio-mini {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 38px;
}

.vero-sector-cloud span,
.vero-portfolio-mini span {
    padding: 10px 13px;
    border: 1px solid rgba(255,255,255,.20);
    font-size: 12px;
    line-height: 1.35;
    color: rgba(255,255,255,.88);
    background: rgba(255,255,255,.025);
}

.vero-story-progress {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 5;
    height: 3px;
    background: rgba(255,255,255,.10);
}

.vero-story-progress-fill {
    display: block;
    width: 0;
    height: 100%;
    background: #df702b;
}

.vero-story-progress-fill.run {
    animation: veroStoryProgress 6s linear forwards;
}

@keyframes veroStoryProgress {
    from { width: 0; }
    to { width: 100%; }
}

.vero-story-nav {
    display: flex;
    flex-direction: column;
    background: #f4f2ed;
}

.vero-story-tab {
    flex: 1;
    width: 100%;
    min-height: 120px;
    display: grid;
    grid-template-columns: 46px 1fr;
    gap: 16px;
    align-items: center;
    padding: 24px 28px;
    border: 0;
    border-bottom: 1px solid rgba(25,25,25,.10);
    background: transparent;
    text-align: left;
    cursor: pointer;
    transition: background .25s ease, padding-left .25s ease;
}

.vero-story-tab:last-child {
    border-bottom: 0;
}

.vero-story-tab:hover,
.vero-story-tab.active {
    background: #fff;
    padding-left: 34px;
}

.vero-story-tab > span {
    font-size: 11px;
    letter-spacing: .12em;
    color: #c3b8ad;
}

.vero-story-tab.active > span {
    color: #df702b;
}

.vero-story-tab strong,
.vero-story-tab small {
    display: block;
}

.vero-story-tab strong {
    font-size: 16px;
    line-height: 1.3;
    color: #242220;
}

.vero-story-tab small {
    margin-top: 5px;
    font-size: 12px;
    color: #8c857d;
}

@media (max-width: 900px) {
    .vero-story-shell {
        grid-template-columns: 1fr;
    }

    .vero-story-visual,
    .vero-story-stage {
        min-height: 520px;
    }

    .vero-story-nav {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .vero-story-tab {
        min-height: 105px;
    }
}

@media (max-width: 640px) {
    .vero-story-slide {
        padding: 90px 30px 66px;
    }

    .vero-story-index {
        left: 30px;
        right: 30px;
    }

    .vero-story-slide h3 {
        font-size: clamp(34px, 10vw, 46px);
    }

    .vero-story-slide p {
        font-size: 16px;
    }

    .vero-story-nav {
        grid-template-columns: 1fr;
    }

    .vero-story-tab {
        min-height: 90px;
    }
}
</style>


<style>
/* =========================================================
   ABOUT VERO DESIGNS — PREMIUM VISUAL UPGRADE
   Keeps the current content and interaction, improves design only.
========================================================== */

.interactive-vero-about {
    position: relative;
    overflow: hidden;
    padding-top: 118px;
    padding-bottom: 126px;
    background:
        radial-gradient(circle at 14% 10%, rgba(223,112,43,.08), transparent 28%),
        radial-gradient(circle at 90% 88%, rgba(25,25,25,.04), transparent 28%),
        linear-gradient(180deg, #fbfaf7 0%, #f4f1eb 100%);
}

.interactive-vero-about::before,
.interactive-vero-about::after {
    content: "";
    position: absolute;
    pointer-events: none;
}

.interactive-vero-about::before {
    inset: 0;
    opacity: .42;
    background-image:
        linear-gradient(rgba(30,30,30,.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(30,30,30,.035) 1px, transparent 1px);
    background-size: 72px 72px;
    mask-image: linear-gradient(to bottom, transparent, #000 14%, #000 86%, transparent);
}

.interactive-vero-about::after {
    top: 92px;
    left: clamp(28px, 6vw, 90px);
    right: clamp(28px, 6vw, 90px);
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(25,25,25,.16), transparent);
}

.interactive-vero-about .refreshed-section-title {
    position: relative;
    z-index: 2;
    width: min(1180px, 100%);
    margin-bottom: 64px;
    display: grid;
    grid-template-columns: minmax(0, 1.15fr) minmax(280px, .85fr);
    gap: 54px;
    align-items: end;
}

.interactive-vero-about .refreshed-section-title > span {
    grid-column: 1 / -1;
    margin-bottom: -22px;
    color: #d56d2c;
}

.interactive-vero-about .refreshed-section-title h2 {
    margin: 0;
    max-width: 780px;
    font-size: clamp(42px, 4.7vw, 68px);
    line-height: .98;
    letter-spacing: -.045em;
    font-weight: 500;
    color: #1a1a1a;
}

.interactive-vero-about .refreshed-section-title p {
    margin: 0;
    max-width: 520px;
    font-size: 16px;
    line-height: 1.85;
    color: #6a645e;
}

.vero-story-shell {
    position: relative;
    z-index: 2;
    width: min(1180px, 100%);
    margin: 0 auto;
    display: grid;
    grid-template-columns: minmax(0, 1.42fr) minmax(310px, .58fr);
    border: 1px solid rgba(25,25,25,.10);
    background: #fff;
    box-shadow:
        0 28px 70px rgba(25,25,25,.08),
        0 2px 0 rgba(255,255,255,.9) inset;
}

.vero-story-shell::before {
    content: "VERO / 2010";
    position: absolute;
    top: -24px;
    right: 0;
    z-index: 4;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .18em;
    color: #9b948c;
}

.vero-story-visual {
    min-height: 610px;
    background:
        linear-gradient(145deg, rgba(255,255,255,.02), transparent 30%),
        #181818;
}

.vero-story-grid {
    opacity: .11;
    background-size: 64px 64px;
}

.vero-story-visual::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 34%;
    height: 100%;
    z-index: 1;
    background: linear-gradient(90deg, transparent, rgba(223,112,43,.045));
    pointer-events: none;
}

.vero-story-visual::after {
    content: "";
    position: absolute;
    right: 42px;
    top: 42px;
    width: 86px;
    height: 86px;
    border-top: 1px solid rgba(255,255,255,.20);
    border-right: 1px solid rgba(255,255,255,.20);
    pointer-events: none;
    z-index: 3;
}

.vero-story-index {
    top: 38px;
    left: 44px;
    right: 44px;
    color: rgba(255,255,255,.42);
}

.vero-story-index #veroStoryCurrent {
    color: #ef8a49;
    font-weight: 700;
}

.vero-story-stage {
    min-height: 610px;
}

.vero-story-slide {
    padding: 104px 78px 84px;
}

.vero-story-kicker {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
    font-size: 10px;
    letter-spacing: .20em;
}

.vero-story-kicker::before {
    content: "";
    width: 26px;
    height: 1px;
    background: #ef8a49;
}

.vero-story-slide h3 {
    max-width: 680px;
    margin-bottom: 24px;
    font-size: clamp(40px, 4.2vw, 62px);
    line-height: .99;
    letter-spacing: -.043em;
    text-wrap: balance;
}

.vero-story-slide p {
    max-width: 660px;
    font-size: 16px;
    line-height: 1.9;
    color: rgba(255,255,255,.66);
}

.vero-story-metric {
    position: relative;
    margin-top: 46px;
    padding-top: 24px;
    padding-left: 22px;
    border-top: 1px solid rgba(255,255,255,.13);
}

.vero-story-metric::before {
    content: "";
    position: absolute;
    left: 0;
    top: 23px;
    width: 2px;
    height: 48px;
    background: #df702b;
}

.vero-story-metric strong {
    font-size: clamp(48px, 5vw, 76px);
    color: #f28b4a;
}

.vero-sector-cloud,
.vero-portfolio-mini {
    gap: 8px;
    margin-top: 34px;
}

.vero-sector-cloud span,
.vero-portfolio-mini span {
    position: relative;
    overflow: hidden;
    padding: 11px 14px;
    border-color: rgba(255,255,255,.16);
    background: rgba(255,255,255,.035);
    font-size: 11px;
    letter-spacing: .03em;
    transition:
        background .25s ease,
        border-color .25s ease,
        transform .25s ease;
}

.vero-sector-cloud span:hover,
.vero-portfolio-mini span:hover {
    transform: translateY(-2px);
    border-color: rgba(239,138,73,.55);
    background: rgba(239,138,73,.08);
}

.vero-story-progress {
    height: 2px;
    background: rgba(255,255,255,.08);
}

.vero-story-progress-fill {
    background: linear-gradient(90deg, #df702b, #f2a36c);
}

.vero-story-nav {
    position: relative;
    background:
        linear-gradient(180deg, #f6f3ee 0%, #efebe4 100%);
}

.vero-story-nav::before {
    content: "EXPLORE";
    position: absolute;
    top: 22px;
    right: 24px;
    font-size: 9px;
    letter-spacing: .18em;
    color: #b4aaa0;
    pointer-events: none;
}

.vero-story-tab {
    position: relative;
    min-height: 136px;
    grid-template-columns: 50px 1fr;
    gap: 16px;
    padding: 28px 30px;
    border-bottom: 1px solid rgba(25,25,25,.09);
    transition:
        background .28s ease,
        padding-left .28s ease,
        color .28s ease;
}

.vero-story-tab::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: transparent;
    transition: background .25s ease;
}

.vero-story-tab::after {
    content: "↗";
    position: absolute;
    right: 24px;
    bottom: 22px;
    font-size: 14px;
    color: #c4bbb2;
    opacity: 0;
    transform: translate(-4px, 4px);
    transition: .25s ease;
}

.vero-story-tab:hover,
.vero-story-tab.active {
    background: #fff;
    padding-left: 36px;
}

.vero-story-tab:hover::after,
.vero-story-tab.active::after {
    opacity: 1;
    transform: translate(0, 0);
    color: #df702b;
}

.vero-story-tab.active::before {
    background: #df702b;
}

.vero-story-tab > span {
    align-self: start;
    padding-top: 2px;
    font-size: 10px;
    color: #b9afa5;
}

.vero-story-tab.active > span {
    color: #df702b;
}

.vero-story-tab strong {
    padding-right: 30px;
    font-size: 17px;
    font-weight: 600;
    color: #23211f;
}

.vero-story-tab small {
    margin-top: 6px;
    padding-right: 30px;
    font-size: 12px;
    line-height: 1.45;
    color: #8b837b;
}

/* subtle floating blueprint marks */
.interactive-vero-about .vero-story-shell::after {
    content: "";
    position: absolute;
    left: -22px;
    bottom: 22px;
    width: 44px;
    height: 44px;
    border-left: 1px solid rgba(223,112,43,.38);
    border-bottom: 1px solid rgba(223,112,43,.38);
    pointer-events: none;
}

@media (max-width: 980px) {
    .interactive-vero-about .refreshed-section-title {
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .interactive-vero-about .refreshed-section-title > span {
        margin-bottom: 0;
    }

    .interactive-vero-about .refreshed-section-title p {
        max-width: 760px;
    }

    .vero-story-shell {
        grid-template-columns: 1fr;
    }

    .vero-story-nav {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .vero-story-tab {
        min-height: 118px;
    }
}

@media (max-width: 700px) {
    .interactive-vero-about {
        padding-top: 86px;
        padding-bottom: 90px;
    }

    .interactive-vero-about .refreshed-section-title {
        margin-bottom: 40px;
    }

    .interactive-vero-about .refreshed-section-title h2 {
        font-size: clamp(38px, 11vw, 52px);
    }

    .vero-story-visual,
    .vero-story-stage {
        min-height: 560px;
    }

    .vero-story-slide {
        padding: 96px 30px 70px;
    }

    .vero-story-slide h3 {
        font-size: clamp(35px, 10vw, 46px);
    }

    .vero-story-nav {
        grid-template-columns: 1fr;
    }

    .vero-story-tab {
        min-height: 94px;
    }

    .vero-story-shell::before,
    .vero-story-shell::after {
        display: none;
    }
}
</style>


<style>
/* =========================================================
   ABOUT VERO — LANDSCAPE ARCHITECTURAL SLIDE TRANSITION
========================================================== */

.vero-story-visual {
    overflow: hidden;
}

.vero-story-stage {
    position: relative;
    overflow: hidden;
}

/* Every panel behaves like a wide architectural presentation board */
.vero-story-slide {
    position: absolute;
    inset: 0;
    opacity: 1;
    visibility: visible;
    transform: translateX(100%);
    transition:
        transform .85s cubic-bezier(.22,.61,.36,1),
        opacity .5s ease;
    will-change: transform;
}

/* Current board */
.vero-story-slide.active {
    transform: translateX(0);
    z-index: 3;
}

/* Board that already passed to the left */
.vero-story-slide.is-prev {
    transform: translateX(-100%);
    z-index: 2;
}

/* Incoming board waits on the right */
.vero-story-slide.is-next {
    transform: translateX(100%);
    z-index: 1;
}

/* Architectural drawing-board overlay during movement */
.vero-story-visual::before {
    background:
        linear-gradient(90deg, transparent 0%, rgba(239,138,73,.04) 74%, rgba(239,138,73,.08) 100%);
}

.vero-story-stage::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    z-index: 6;
    width: 1px;
    background: linear-gradient(
        to bottom,
        transparent 0%,
        rgba(255,255,255,.08) 15%,
        rgba(255,255,255,.08) 85%,
        transparent 100%
    );
    pointer-events: none;
}

.vero-story-stage::after {
    content: "A-01  /  STORY BOARD";
    position: absolute;
    right: 28px;
    bottom: 18px;
    z-index: 7;
    font-size: 8px;
    letter-spacing: .16em;
    color: rgba(255,255,255,.26);
    pointer-events: none;
}

/* Make the horizontal motion feel like switching architectural sheets */
.vero-story-slide .vero-story-kicker,
.vero-story-slide h3,
.vero-story-slide p,
.vero-story-slide .vero-story-metric,
.vero-story-slide .vero-sector-cloud,
.vero-story-slide .vero-portfolio-mini {
    transition:
        transform .8s cubic-bezier(.22,.61,.36,1),
        opacity .55s ease;
}

.vero-story-slide:not(.active) .vero-story-kicker,
.vero-story-slide:not(.active) h3,
.vero-story-slide:not(.active) p,
.vero-story-slide:not(.active) .vero-story-metric,
.vero-story-slide:not(.active) .vero-sector-cloud,
.vero-story-slide:not(.active) .vero-portfolio-mini {
    opacity: .45;
    transform: translateX(26px);
}

.vero-story-slide.is-prev .vero-story-kicker,
.vero-story-slide.is-prev h3,
.vero-story-slide.is-prev p,
.vero-story-slide.is-prev .vero-story-metric,
.vero-story-slide.is-prev .vero-sector-cloud,
.vero-story-slide.is-prev .vero-portfolio-mini {
    transform: translateX(-26px);
}

/* Small "next board" marker on the active right edge */
.vero-story-slide.active::after {
    content: "NEXT  →";
    position: absolute;
    right: 34px;
    top: 50%;
    transform: translateY(-50%) rotate(90deg);
    transform-origin: center;
    font-size: 8px;
    letter-spacing: .18em;
    color: rgba(255,255,255,.28);
    pointer-events: none;
}

/* Make right-side navigation feel like sheet index tabs */
.vero-story-tab {
    overflow: hidden;
}

.vero-story-tab::after {
    content: "→";
}

.vero-story-tab.active {
    box-shadow: inset 3px 0 0 #df702b;
}

@media (max-width: 700px) {
    .vero-story-slide.active::after,
    .vero-story-stage::before,
    .vero-story-stage::after {
        display: none;
    }
}
</style>


<style>
/* =========================================================
   PRIVACY CARDS — VISUAL DESIGN REFINEMENT ONLY
   ========================================================= */

.privacy-points {
    display: grid !important;
    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    gap: 14px !important;
    margin-top: 30px !important;
    align-items: stretch !important;
}

.privacy-point {
    position: relative !important;
    width: 100% !important;
    min-height: 132px !important;
    height: 100% !important;

    display: grid !important;
    grid-template-columns: 52px minmax(0, 1fr) !important;
    align-items: start !important;
    gap: 16px !important;

    padding: 20px 19px !important;

    border: 1px solid rgba(51, 61, 69, 0.12) !important;
    border-radius: 0 !important;

    background: rgba(255, 255, 255, 0.76) !important;
    box-shadow: none !important;

    text-align: left !important;
    overflow: hidden !important;

    transition:
        border-color .18s ease,
        background .18s ease,
        box-shadow .18s ease,
        transform .18s ease !important;
}

.privacy-point::before {
    content: "" !important;
    position: absolute !important;
    left: 0 !important;
    top: 0 !important;
    width: 3px !important;
    height: 100% !important;
    background: transparent !important;
    transition: background .18s ease !important;
}

.privacy-point::after {
    content: "" !important;
    position: absolute !important;
    left: 0 !important;
    bottom: 0 !important;
    width: 100% !important;
    height: 2px !important;
    background: transparent !important;
    transition: background .18s ease !important;
}

.privacy-point:hover {
    transform: translateY(-2px) !important;
    border-color: rgba(223, 112, 43, 0.34) !important;
    background: #fffdfb !important;
    box-shadow: 0 12px 28px rgba(45, 53, 59, 0.07) !important;
}

.privacy-point.active {
    border-color: rgba(223, 112, 43, 0.42) !important;
    background:
        linear-gradient(
            135deg,
            rgba(255, 248, 242, 0.98),
            rgba(255, 255, 255, 0.98)
        ) !important;
    box-shadow: 0 14px 30px rgba(45, 53, 59, 0.08) !important;
}

.privacy-point.active::before {
    background: #df702b !important;
}

.privacy-point.active::after {
    background: #df702b !important;
}

.privacy-point-icon {
    width: 52px !important;
    height: 52px !important;
    min-width: 52px !important;

    display: grid !important;
    place-items: center !important;

    margin: 0 !important;

    border: 1px solid rgba(223, 112, 43, 0.26) !important;
    border-radius: 0 !important;

    background: #fff7f0 !important;
    color: #df702b !important;

    transform: none !important;
    transition:
        background .18s ease,
        color .18s ease,
        border-color .18s ease !important;
}

.privacy-point:hover .privacy-point-icon {
    border-color: rgba(223, 112, 43, 0.48) !important;
}

.privacy-point.active .privacy-point-icon {
    border-color: #df702b !important;
    background: #df702b !important;
    color: #ffffff !important;
}

.privacy-point-icon svg {
    width: 21px !important;
    height: 21px !important;
    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 1.65 !important;
    stroke-linecap: round !important;
    stroke-linejoin: round !important;
}

.privacy-point-text {
    display: block !important;
    min-width: 0 !important;
    padding-top: 2px !important;
}

.privacy-point-text strong {
    display: block !important;
    margin: 0 0 7px !important;

    color: #273139 !important;

    font-family: "Segoe UI", Inter, Arial, sans-serif !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    line-height: 1.3 !important;
    letter-spacing: -0.01em !important;
}

.privacy-point-text small {
    display: block !important;
    margin: 0 !important;

    color: #6d7881 !important;

    font-family: "Segoe UI", Inter, Arial, sans-serif !important;
    font-size: 12px !important;
    font-weight: 400 !important;
    line-height: 1.65 !important;
}

@media (max-width: 1100px) {
    .privacy-point {
        grid-template-columns: 46px minmax(0, 1fr) !important;
        gap: 14px !important;
        padding: 18px 16px !important;
    }

    .privacy-point-icon {
        width: 46px !important;
        height: 46px !important;
        min-width: 46px !important;
    }
}

@media (max-width: 760px) {
    .privacy-points {
        grid-template-columns: 1fr !important;
        gap: 12px !important;
    }

    .privacy-point {
        min-height: 0 !important;
    }
}
</style>


<style>
/* =========================================================
   PRIVACY SECTION — COMPACT ARCHITECTURAL REDESIGN
   CSS ONLY. ROTATING SHIELD / JS REMAINS UNCHANGED.
   ========================================================= */

/* Make the whole privacy composition cleaner and less oversized */
.privacy-section.privacy-orbit-section {
    align-items: center !important;
    column-gap: clamp(34px, 5vw, 76px) !important;
}

/* Copy side */
.privacy-copy {
    max-width: 620px !important;
}

.privacy-copy > .section-label {
    margin-bottom: 12px !important;
}

.privacy-copy > h2 {
    max-width: 600px !important;
    margin-bottom: 16px !important;
    line-height: 1.08 !important;
}

.privacy-copy > p {
    max-width: 570px !important;
    margin-bottom: 0 !important;
    line-height: 1.7 !important;
}

/* ---------------------------------------------------------
   Replace large "cards" with compact architectural index rows
   --------------------------------------------------------- */

.privacy-points {
    display: grid !important;
    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    gap: 0 !important;

    margin-top: 27px !important;

    border-top: 1px solid rgba(46, 57, 65, .14) !important;
    border-left: 1px solid rgba(46, 57, 65, .14) !important;
}

.privacy-point {
    position: relative !important;

    width: 100% !important;
    min-width: 0 !important;
    min-height: 0 !important;
    height: auto !important;

    display: grid !important;
    grid-template-columns: 28px minmax(0, 1fr) !important;
    align-items: start !important;
    gap: 11px !important;

    padding: 15px 15px 14px !important;
    margin: 0 !important;

    border: 0 !important;
    border-right: 1px solid rgba(46, 57, 65, .14) !important;
    border-bottom: 1px solid rgba(46, 57, 65, .14) !important;
    border-radius: 0 !important;

    background: rgba(255,255,255,.30) !important;
    box-shadow: none !important;

    text-align: left !important;
    overflow: hidden !important;

    transform: none !important;

    transition:
        background .18s ease,
        color .18s ease !important;
}

/* Kill previous card accents */
.privacy-point::before,
.privacy-point::after {
    display: none !important;
    content: none !important;
}

.privacy-point:hover {
    transform: none !important;
    border-color: rgba(46, 57, 65, .14) !important;
    background: rgba(223, 112, 43, .055) !important;
    box-shadow: none !important;
}

.privacy-point.active {
    transform: none !important;
    border-color: rgba(46, 57, 65, .14) !important;

    background:
        linear-gradient(
            110deg,
            rgba(223,112,43,.12),
            rgba(255,255,255,.48)
        ) !important;

    box-shadow:
        inset 3px 0 0 #df702b !important;
}

/* Small technical icon marker instead of large icon box */
.privacy-point-icon {
    width: 28px !important;
    height: 28px !important;
    min-width: 28px !important;

    display: grid !important;
    place-items: center !important;

    margin: 0 !important;

    border: 0 !important;
    border-radius: 0 !important;

    background: transparent !important;
    color: #df702b !important;

    transform: none !important;
}

.privacy-point-icon svg {
    width: 17px !important;
    height: 17px !important;

    fill: none !important;
    stroke: currentColor !important;
    stroke-width: 1.6 !important;
    stroke-linecap: round !important;
    stroke-linejoin: round !important;
}

.privacy-point.active .privacy-point-icon,
.privacy-point:hover .privacy-point-icon {
    width: 28px !important;
    height: 28px !important;
    min-width: 28px !important;

    border: 0 !important;
    background: transparent !important;
    color: #df702b !important;
}

/* Text */
.privacy-point-text {
    display: block !important;
    min-width: 0 !important;
    padding: 0 !important;
}

.privacy-point-text strong {
    display: block !important;

    margin: 0 0 4px !important;

    color: #273139 !important;

    font-family: "Segoe UI", Inter, Arial, sans-serif !important;
    font-size: 12.5px !important;
    font-weight: 700 !important;
    line-height: 1.3 !important;
    letter-spacing: -.01em !important;
}

.privacy-point-text small {
    display: block !important;

    margin: 0 !important;

    color: #707b84 !important;

    font-family: "Segoe UI", Inter, Arial, sans-serif !important;
    font-size: 10.5px !important;
    font-weight: 400 !important;
    line-height: 1.5 !important;
}

/* Small number labels for a more architectural/system feel */
.privacy-point:nth-child(1) .privacy-point-text strong::before { content: "01  "; }
.privacy-point:nth-child(2) .privacy-point-text strong::before { content: "02  "; }
.privacy-point:nth-child(3) .privacy-point-text strong::before { content: "03  "; }
.privacy-point:nth-child(4) .privacy-point-text strong::before { content: "04  "; }
.privacy-point:nth-child(5) .privacy-point-text strong::before { content: "05  "; }
.privacy-point:nth-child(6) .privacy-point-text strong::before { content: "06  "; }

.privacy-point-text strong::before {
    color: #df702b !important;
    font-size: 8px !important;
    font-weight: 800 !important;
    letter-spacing: .08em !important;
    vertical-align: 1px !important;
}

/* Keep rotating visual intact, just don't let the left side make it feel huge */
.privacy-orbit-panel {
    align-self: center !important;
}

/* Active principle panel becomes slightly tighter */
.privacy-status-panel {
    margin-top: 15px !important;
}

.privacy-status-panel p {
    line-height: 1.55 !important;
}

/* Responsive */
@media (max-width: 1050px) {
    .privacy-section.privacy-orbit-section {
        column-gap: 30px !important;
    }

    .privacy-point {
        padding: 13px 12px !important;
        grid-template-columns: 25px minmax(0, 1fr) !important;
        gap: 9px !important;
    }

    .privacy-point-icon,
    .privacy-point.active .privacy-point-icon,
    .privacy-point:hover .privacy-point-icon {
        width: 25px !important;
        height: 25px !important;
        min-width: 25px !important;
    }

    .privacy-point-icon svg {
        width: 15px !important;
        height: 15px !important;
    }

    .privacy-point-text strong {
        font-size: 12px !important;
    }

    .privacy-point-text small {
        font-size: 10px !important;
    }
}

@media (max-width: 760px) {
    .privacy-points {
        grid-template-columns: 1fr !important;
    }

    .privacy-point {
        padding: 14px !important;
    }
}
</style>


<style>
/* =========================================================
   PRIVACY — LANDSCAPE + SMALL FONT
   DESIGN/CSS ONLY. ROTATING SHIELD AND JS UNTOUCHED.
   ========================================================= */

/* Wider landscape composition */
.privacy-section.privacy-orbit-section {
    display: grid !important;
    grid-template-columns: minmax(0, 1.35fr) minmax(320px, .65fr) !important;
    align-items: center !important;
    gap: clamp(28px, 4vw, 62px) !important;
}

/* Left side uses the available horizontal space */
.privacy-copy {
    width: 100% !important;
    max-width: none !important;
}

.privacy-copy > h2 {
    max-width: 760px !important;
}

.privacy-copy > p {
    max-width: 760px !important;
    font-size: 12px !important;
    line-height: 1.6 !important;
}

/* Six principles become one landscape strip: 3 columns x 2 rows */
.privacy-points {
    width: 100% !important;

    display: grid !important;
    grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    gap: 0 !important;

    margin-top: 24px !important;

    border-top: 1px solid rgba(46,57,65,.14) !important;
    border-left: 1px solid rgba(46,57,65,.14) !important;
}

/* Smaller, flatter principle blocks */
.privacy-point {
    min-height: 92px !important;
    height: auto !important;

    grid-template-columns: 22px minmax(0, 1fr) !important;
    gap: 8px !important;

    padding: 12px 11px !important;

    border: 0 !important;
    border-right: 1px solid rgba(46,57,65,.14) !important;
    border-bottom: 1px solid rgba(46,57,65,.14) !important;

    background: rgba(255,255,255,.28) !important;
}

.privacy-point:hover {
    background: rgba(223,112,43,.05) !important;
}

.privacy-point.active {
    background:
        linear-gradient(
            110deg,
            rgba(223,112,43,.11),
            rgba(255,255,255,.42)
        ) !important;

    box-shadow: inset 2px 0 0 #df702b !important;
}

/* Much smaller icons */
.privacy-point-icon,
.privacy-point.active .privacy-point-icon,
.privacy-point:hover .privacy-point-icon {
    width: 22px !important;
    height: 22px !important;
    min-width: 22px !important;

    border: 0 !important;
    background: transparent !important;
    color: #df702b !important;
}

.privacy-point-icon svg {
    width: 14px !important;
    height: 14px !important;
    stroke-width: 1.55 !important;
}

/* Smaller typography */
.privacy-point-text strong {
    margin: 0 0 3px !important;

    font-size: 11px !important;
    line-height: 1.25 !important;
}

.privacy-point-text strong::before {
    font-size: 7px !important;
    letter-spacing: .06em !important;
}

.privacy-point-text small {
    font-size: 9px !important;
    line-height: 1.45 !important;
}

/* Right rotating shield stays intact; only give it a clean landscape column */
.privacy-orbit-panel {
    width: 100% !important;
    max-width: 430px !important;
    justify-self: center !important;
}

/* Slightly tighter status copy */
.privacy-status-panel {
    margin-top: 12px !important;
}

.privacy-status-label {
    font-size: 8px !important;
}

.privacy-status-panel strong {
    font-size: 13px !important;
}

.privacy-status-panel p {
    font-size: 10px !important;
    line-height: 1.5 !important;
}

/* Tablet */
@media (max-width: 1100px) {
    .privacy-section.privacy-orbit-section {
        grid-template-columns: minmax(0, 1.15fr) minmax(300px, .85fr) !important;
        gap: 28px !important;
    }

    .privacy-points {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }
}

/* Mobile */
@media (max-width: 760px) {
    .privacy-section.privacy-orbit-section {
        grid-template-columns: 1fr !important;
    }

    .privacy-points {
        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
    }

    .privacy-orbit-panel {
        max-width: 430px !important;
    }
}

@media (max-width: 520px) {
    .privacy-points {
        grid-template-columns: 1fr !important;
    }

    .privacy-point {
        min-height: 0 !important;
    }
}
</style>


<style>
/* PRIVACY — readable font adjustment only */
.privacy-copy > p {
    font-size: 14px !important;
    line-height: 1.65 !important;
}

.privacy-point-text strong {
    font-size: 13.5px !important;
    line-height: 1.3 !important;
}

.privacy-point-text strong::before {
    font-size: 8.5px !important;
}

.privacy-point-text small {
    font-size: 11.5px !important;
    line-height: 1.55 !important;
}

.privacy-status-label {
    font-size: 9px !important;
}

.privacy-status-panel strong {
    font-size: 14px !important;
}

.privacy-status-panel p {
    font-size: 11.5px !important;
    line-height: 1.55 !important;
}
</style>

</head>

<body>


<!-- HEADER -->
<header class="main-header">

    <div class="header-logo">

        <a href="#home">
            <img
                src="{{ asset('images/arlogo.jpg') }}"
                alt="Vero Designs Logo"
            >
        </a>

    </div>


    <nav class="main-nav">

        <a href="#home">Home</a>

        <a href="#about">About Us</a>

        <a href="#architects">Architects</a>

        <a href="#features">Features</a>

        <a href="#contact">Contact</a>

        <a href="#privacy">Privacy</a>

        <a href="#terms">Terms</a>


        @auth

            <a href="{{ route('dashboard') }}" class="login-link">
                Dashboard
            </a>

        @else

            <a href="{{ route('login') }}" class="login-link">
                Log In
            </a>

        @endauth

    </nav>

</header>


<main>


<!-- HERO VIDEO -->
<section class="hero-section" id="home">

    <video
        class="hero-video"
        autoplay
        muted
        loop
        playsinline
    >
        <source
            src="{{ asset('videos/bgstart.mp4') }}"
            type="video/mp4"
        >
    </video>


    <div class="hero-overlay"></div>


    <div class="hero-content">

        <span class="hero-label">
            VERO DESIGNS ARCHITECTURAL SERVICES
        </span>


        <h1>
            Better project management
            for better architectural collaboration.
        </h1>


        <p>
            ArchiTrack brings communication, project progress, files,
            and revisions into one centralized platform, helping
            architects and clients collaborate more clearly and efficiently.
        </p>


        <div class="hero-buttons">

            @auth

                <a
                    href="{{ route('dashboard') }}"
                    class="main-btn"
                >
                    Go to Dashboard
                </a>

            @else

                <a
                    href="{{ route('login') }}"
                    class="main-btn"
                >
                    Log In to ArchiTrack
                </a>

            @endauth


            <a
                href="#about"
                class="outline-btn"
            >
                Explore ArchiTrack
            </a>

        </div>


        <p class="hero-note">
            Public registration is not available.
            Accounts are created by authorized administrators
            or through project invitations.
        </p>

    </div>


    <div class="scroll-down">

        <span>
            SCROLL TO EXPLORE
        </span>

        <div class="scroll-line"></div>

    </div>

</section>


<!-- ABOUT -->
<section class="about-section refreshed-about interactive-vero-about" id="about">

    <div class="section-title refreshed-section-title">
        <span>ABOUT VERO DESIGNS</span>

        <h2>
            Built on experience. Designed around people.
        </h2>

        <p>
            Founded in 2010, Vero Designs Architectural Services is a
            Philippine-based architectural practice specializing in retail,
            residential, commercial, hospitality, and architectural interior design.
        </p>
    </div>


    <div class="vero-story-shell" id="veroStoryShell">

        <div class="vero-story-visual">

            <div class="vero-story-grid" aria-hidden="true"></div>

            <div class="vero-story-index">
                <span id="veroStoryCurrent">01</span>
                <i></i>
                <span>04</span>
            </div>

            <div class="vero-story-stage">

                <article class="vero-story-slide active" data-vero-slide="0">
                    <span class="vero-story-kicker">THE PRACTICE</span>

                    <h3>
                        Vero Designs Architectural Services
                    </h3>

                    <p>
                        Founded in 2010, Vero Designs is a Philippine-based
                        architectural practice creating functional, thoughtful,
                        and inspiring spaces tailored to every client’s vision.
                    </p>

                    <div class="vero-story-metric">
                        <strong>2010</strong>
                        <span>Year Established</span>
                    </div>
                </article>


                <article class="vero-story-slide" data-vero-slide="1">
                    <span class="vero-story-kicker">PRINCIPAL ARCHITECT</span>

                    <h3>
                        Ar. Rosanna “Chay” Robles
                    </h3>

                    <p>
                        A registered architect with over 32 years of professional
                        experience, leading Vero Designs across a wide range of
                        architectural and interior design projects.
                    </p>

                    <div class="vero-story-metric">
                        <strong>32+</strong>
                        <span>Years of Experience</span>
                    </div>
                </article>


                <article class="vero-story-slide" data-vero-slide="2">
                    <span class="vero-story-kicker">DESIGN EXPERTISE</span>

                    <h3>
                        Multiple sectors. One design approach.
                    </h3>

                    <p>
                        Vero Designs works across retail, residential, commercial,
                        hospitality, and architectural interior design.
                    </p>

                    <div class="vero-sector-cloud">
                        <span>Retail</span>
                        <span>Residential</span>
                        <span>Commercial</span>
                        <span>Hospitality</span>
                        <span>Architectural Interior Design</span>
                    </div>
                </article>


                <article class="vero-story-slide" data-vero-slide="3">
                    <span class="vero-story-kicker">SELECTED PORTFOLIO</span>

                    <h3>
                        Work across recognized spaces and destinations.
                    </h3>

                    <p>
                        The portfolio includes major retail, corporate, hospitality,
                        and residential projects in Metro Manila and other regions.
                    </p>

                    <div class="vero-portfolio-mini">
                        <span>SM North EDSA</span>
                        <span>SM Centerpoint</span>
                        <span>Gaisano Mall Cebu</span>
                        <span>Mitsubishi Corporation Guest House</span>
                        <span>Unilab Lobby &amp; Café</span>
                        <span>Ideal Vision Center</span>
                        <span>Eyesports, Shangri-La Plaza</span>
                        <span>Resorts &amp; Custom Residences</span>
                    </div>
                </article>

            </div>

            <div class="vero-story-progress">
                <span class="vero-story-progress-fill" id="veroStoryProgress"></span>
            </div>

        </div>


        <div class="vero-story-nav">

            <button type="button" class="vero-story-tab active" data-vero-tab="0">
                <span>01</span>
                <div>
                    <strong>The Practice</strong>
                    <small>Founded in 2010</small>
                </div>
            </button>

            <button type="button" class="vero-story-tab" data-vero-tab="1">
                <span>02</span>
                <div>
                    <strong>Principal Architect</strong>
                    <small>32+ years of experience</small>
                </div>
            </button>

            <button type="button" class="vero-story-tab" data-vero-tab="2">
                <span>03</span>
                <div>
                    <strong>Design Expertise</strong>
                    <small>5 core sectors</small>
                </div>
            </button>

            <button type="button" class="vero-story-tab" data-vero-tab="3">
                <span>04</span>
                <div>
                    <strong>Selected Portfolio</strong>
                    <small>Recognized projects</small>
                </div>
            </button>

        </div>

    </div>

</section>



<!-- ARCHITECT SPOTLIGHT -->
<section class="architects-section" id="architects">

    <div class="architects-heading">
        <div>
            <span class="architects-eyebrow">MEET THE ARCHITECTS</span>
            <h2>The people behind the projects.</h2>
        </div>

        <p>
            Get to know the architects of Vero Designs and the
            design disciplines they bring to each project.
        </p>
    </div>

    @php
        $architectSpotlights = [
            [
                'name' => 'Ar. Sofia Reyes',
                'position' => 'Principal Architect',
                'specialization' => 'Residential · Commercial · Interior',
                'experience' => '12+ Years Experience',
                'bio' => 'Focused on creating refined, functional spaces that respond to the people who use them and the context around them.',
                'image' => asset('images/architect-1.jpg'),
                'project' => 'Contemporary Residential Design',
            ],
            [
                'name' => 'Ar. Miguel Santos',
                'position' => 'Design Architect',
                'specialization' => 'Modern Residential · Space Planning',
                'experience' => '8+ Years Experience',
                'bio' => 'Combines practical planning with a clean contemporary design approach, with close attention to circulation, light, and proportion.',
                'image' => asset('images/architect-2.jpg'),
                'project' => 'Urban Home Development',
            ],
            [
                'name' => 'Ar. Andrea Villanueva',
                'position' => 'Project Architect',
                'specialization' => 'Commercial · Project Coordination',
                'experience' => '10+ Years Experience',
                'bio' => 'Experienced in coordinating design intent with project requirements, documentation, and the day-to-day realities of implementation.',
                'image' => asset('images/architect-3.jpg'),
                'project' => 'Boutique Commercial Space',
            ],
            [
                'name' => 'Ar. Paolo Mendoza',
                'position' => 'Architectural Designer',
                'specialization' => 'Concept Design · Visualization',
                'experience' => '6+ Years Experience',
                'bio' => 'Explores architecture through strong concepts, visual storytelling, and a careful balance between character and usability.',
                'image' => asset('images/architect-4.jpg'),
                'project' => 'Concept Residence Study',
            ],
        ];
    @endphp

    <div class="architect-slider" id="architectSlider" aria-label="Vero Designs architects">

        <div class="architect-slider-stage">

            @foreach($architectSpotlights as $index => $architect)

                <article
                    class="architect-slide {{ $index === 0 ? 'active' : '' }}"
                    data-architect-slide="{{ $index }}"
                    aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
                >
                    <div class="architect-slide-visual">
                        <div class="architect-image-frame">

                            <img
                                src="{{ $architect['image'] }}"
                                alt="{{ $architect['name'] }}"
                                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                onerror="this.style.display='none'; this.parentElement.classList.add('architect-image-missing');"
                            >

                            <div class="architect-image-placeholder">
                                <span>{{ strtoupper(substr($architect['name'], 4, 1)) }}</span>
                            </div>

                            <div class="architect-image-shade"></div>

                            <div class="architect-project-tag">
                                <span>Selected Work</span>
                                <strong>{{ $architect['project'] }}</strong>
                            </div>
                        </div>

                        <div class="architect-drawing-lines" aria-hidden="true">
                            <span class="architect-line line-a"></span>
                            <span class="architect-line line-b"></span>
                            <span class="architect-line line-c"></span>
                            <span class="architect-axis axis-x">A</span>
                            <span class="architect-axis axis-y">01</span>
                        </div>
                    </div>

                    <div class="architect-slide-copy">
                        <div class="architect-slide-number">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            <span></span>
                            {{ str_pad(count($architectSpotlights), 2, '0', STR_PAD_LEFT) }}
                        </div>

                        <span class="architect-role">{{ $architect['position'] }}</span>
                        <h3>{{ $architect['name'] }}</h3>

                        <div class="architect-specialization">
                            {{ $architect['specialization'] }}
                        </div>

                        <div class="architect-experience">
                            <span></span>
                            {{ $architect['experience'] }}
                        </div>

                        <p>{{ $architect['bio'] }}</p>

                        <div class="architect-detail-line">
                            <span>Vero Designs Architectural Services</span>
                            <i></i>
                        </div>
                    </div>
                </article>

            @endforeach

        </div>

        <div class="architect-slider-controls">

            <div class="architect-progress-wrap">
                <div class="architect-progress-track">
                    <span class="architect-progress-fill" id="architectProgressFill"></span>
                </div>

                <span class="architect-progress-label">
                    AUTO · 5 SEC
                </span>
            </div>

            <div class="architect-dots">
                @foreach($architectSpotlights as $index => $architect)
                    <button
                        type="button"
                        class="architect-dot {{ $index === 0 ? 'active' : '' }}"
                        data-architect-dot="{{ $index }}"
                        aria-label="Show {{ $architect['name'] }}"
                    >
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </button>
                @endforeach
            </div>

            <div class="architect-arrows">
                <button type="button" class="architect-arrow" id="architectPrev" aria-label="Previous architect">
                    <svg viewBox="0 0 24 24">
                        <path d="M19 12H5"></path>
                        <path d="m11 18-6-6 6-6"></path>
                    </svg>
                </button>

                <button type="button" class="architect-arrow" id="architectNext" aria-label="Next architect">
                    <svg viewBox="0 0 24 24">
                        <path d="M5 12h14"></path>
                        <path d="m13 6 6 6-6 6"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

</section>

<style>
.architects-section {
    position: relative;
    overflow: hidden;
    padding: 110px 7vw 120px;
    background: linear-gradient(135deg, #f7f6f2, #ffffff);
}
.architects-section::after {
    content: "";
    position: absolute;
    top: 84px;
    left: 7vw;
    right: 7vw;
    height: 1px;
    background: rgba(20,20,20,.08);
}
.architects-heading {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 1.2fr .7fr;
    gap: 70px;
    align-items: end;
    margin-bottom: 52px;
}
.architects-eyebrow {
    display: block;
    margin-bottom: 14px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .22em;
    color: #df702b;
}
.architects-heading h2 {
    margin: 0;
    font-size: clamp(42px, 5vw, 76px);
    line-height: .98;
    font-weight: 500;
    letter-spacing: -.045em;
    color: #191919;
}
.architects-heading p {
    margin: 0 0 8px;
    font-size: 14px;
    line-height: 1.8;
    color: #6d6963;
}
.architect-slider {
    position: relative;
    z-index: 2;
}
.architect-slider-stage {
    position: relative;
    min-height: 650px;
}
.architect-slide {
    position: absolute;
    inset: 0;
    display: grid;
    grid-template-columns: 1.15fr .85fr;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateX(34px);
    transition: opacity .75s ease, transform .9s cubic-bezier(.22,.61,.36,1);
}
.architect-slide.active {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateX(0);
}
.architect-slide-visual {
    position: relative;
    min-height: 650px;
    overflow: hidden;
    background: #d2cec7;
}
.architect-image-frame {
    position: absolute;
    inset: 0;
    overflow: hidden;
    background: linear-gradient(135deg, #d8d3ca, #bcb7ae);
}
.architect-image-frame img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transform: scale(1.04);
    filter: saturate(.9) contrast(1.03);
    transition: transform 5s linear;
}
.architect-slide.active .architect-image-frame img {
    transform: scale(1.10);
}
.architect-image-placeholder {
    position: absolute;
    inset: 0;
    display: none;
    place-items: center;
}
.architect-image-missing .architect-image-placeholder {
    display: grid;
}
.architect-image-placeholder span {
    font-size: 100px;
    font-weight: 300;
    color: rgba(255,255,255,.65);
}
.architect-image-shade {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 40%, rgba(8,8,8,.65) 100%);
}
.architect-project-tag {
    position: absolute;
    left: 36px;
    bottom: 32px;
    color: #fff;
}
.architect-project-tag span,
.architect-project-tag strong {
    display: block;
}
.architect-project-tag span {
    margin-bottom: 6px;
    font-size: 9px;
    letter-spacing: .18em;
    text-transform: uppercase;
    opacity: .72;
}
.architect-project-tag strong {
    font-size: 20px;
    font-weight: 500;
}
.architect-drawing-lines {
    position: absolute;
    inset: 0;
    pointer-events: none;
}
.architect-line {
    position: absolute;
    display: block;
    background: rgba(255,255,255,.4);
}
.architect-line.line-a {
    left: 34px;
    top: 34px;
    width: 140px;
    height: 1px;
}
.architect-line.line-b {
    left: 34px;
    top: 34px;
    width: 1px;
    height: 120px;
}
.architect-line.line-c {
    right: 30px;
    bottom: 30px;
    width: 110px;
    height: 1px;
}
.architect-axis {
    position: absolute;
    font-size: 9px;
    letter-spacing: .12em;
    color: rgba(255,255,255,.72);
}
.architect-axis.axis-x {
    left: 183px;
    top: 28px;
}
.architect-axis.axis-y {
    left: 28px;
    top: 162px;
    transform: rotate(-90deg);
}
.architect-slide-copy {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 650px;
    padding: 60px 60px 56px 68px;
    background: #181818;
    color: #fff;
}
.architect-slide-number {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 54px;
    font-size: 10px;
    letter-spacing: .15em;
    color: rgba(255,255,255,.42);
}
.architect-slide-number span {
    width: 46px;
    height: 1px;
    background: rgba(255,255,255,.24);
}
.architect-role {
    margin-bottom: 12px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .20em;
    text-transform: uppercase;
    color: #ef8a49;
}
.architect-slide-copy h3 {
    margin: 0 0 18px;
    font-size: clamp(38px, 4vw, 62px);
    line-height: 1;
    font-weight: 400;
    letter-spacing: -.04em;
}
.architect-specialization {
    margin-bottom: 26px;
    font-size: 13px;
    color: rgba(255,255,255,.68);
}
.architect-experience {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 30px;
    font-size: 11px;
    letter-spacing: .08em;
}
.architect-experience span {
    width: 24px;
    height: 1px;
    background: #ef8a49;
}
.architect-slide-copy p {
    margin: 0;
    font-size: 14px;
    line-height: 1.9;
    color: rgba(255,255,255,.64);
}
.architect-detail-line {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-top: 54px;
}
.architect-detail-line span {
    white-space: nowrap;
    font-size: 9px;
    letter-spacing: .16em;
    text-transform: uppercase;
    color: rgba(255,255,255,.32);
}
.architect-detail-line i {
    width: 100%;
    height: 1px;
    background: rgba(255,255,255,.1);
}
.architect-slider-controls {
    display: grid;
    grid-template-columns: 1fr auto auto;
    align-items: center;
    gap: 30px;
    padding-top: 24px;
}
.architect-progress-wrap {
    display: flex;
    align-items: center;
    gap: 13px;
}
.architect-progress-track {
    width: min(320px, 100%);
    height: 1px;
    background: rgba(20,20,20,.16);
    overflow: hidden;
}
.architect-progress-fill {
    display: block;
    width: 0;
    height: 100%;
    background: #df702b;
}
.architect-progress-fill.run {
    animation: architectProgress 5s linear forwards;
}
@keyframes architectProgress {
    from { width: 0; }
    to { width: 100%; }
}
.architect-progress-label {
    font-size: 8px;
    letter-spacing: .16em;
    color: #9c968d;
    white-space: nowrap;
}
.architect-dots {
    display: flex;
    gap: 5px;
}
.architect-dot {
    width: 40px;
    height: 40px;
    border: 1px solid transparent;
    border-radius: 50%;
    background: transparent;
    color: #aaa49b;
    font-size: 9px;
    cursor: pointer;
    transition: .25s ease;
}
.architect-dot.active,
.architect-dot:hover {
    border-color: rgba(223,112,43,.55);
    color: #df702b;
}
.architect-arrows {
    display: flex;
    gap: 8px;
}
.architect-arrow {
    display: grid;
    place-items: center;
    width: 48px;
    height: 48px;
    border: 1px solid rgba(20,20,20,.14);
    background: #fff;
    color: #222;
    cursor: pointer;
    transition: .25s ease;
}
.architect-arrow:hover {
    background: #df702b;
    border-color: #df702b;
    color: #fff;
    transform: translateY(-2px);
}
.architect-arrow svg {
    width: 18px;
    height: 18px;
    fill: none;
    stroke: currentColor;
    stroke-width: 1.7;
    stroke-linecap: round;
    stroke-linejoin: round;
}
@media (max-width: 900px) {
    .architects-heading {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    .architect-slide {
        grid-template-columns: 1fr 1fr;
    }
    .architect-slide-copy {
        padding: 44px 34px;
    }
}
@media (max-width: 720px) {
    .architects-section {
        padding: 85px 22px 90px;
    }
    .architect-slider-stage {
        min-height: 850px;
    }
    .architect-slide {
        grid-template-columns: 1fr;
    }
    .architect-slide-visual {
        min-height: 410px;
    }
    .architect-slide-copy {
        min-height: 440px;
        padding: 36px 28px;
    }
    .architect-slide-number {
        margin-bottom: 28px;
    }
    .architect-slider-controls {
        grid-template-columns: 1fr auto;
    }
    .architect-progress-wrap {
        grid-column: 1 / -1;
    }
}
</style>


<!-- FEATURES -->
<section class="features-section feature-banner-section" id="features">

    <div class="feature-banner-heading">

        <span class="section-label">
            SYSTEM FEATURES
        </span>

        <h2>
            Explore ArchiTrack features.
        </h2>

        <p>
            Drag the feature banner left or right to explore the
            tools available inside the ArchiTrack workspace.
        </p>

    </div>


    <div class="feature-banner-wrap">

        <div class="feature-banner-top">

            <div class="feature-banner-count">
                <span id="featureBannerCurrent">01</span>
                <small>/ 06</small>
            </div>

            <div class="feature-banner-drag">
                <span></span>
                DRAG LEFT / RIGHT
            </div>

            <div class="feature-banner-arrows">

                <button
                    type="button"
                    class="feature-banner-arrow"
                    id="featureBannerPrev"
                    aria-label="Previous feature"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M15 5l-7 7 7 7"></path>
                    </svg>
                </button>

                <button
                    type="button"
                    class="feature-banner-arrow"
                    id="featureBannerNext"
                    aria-label="Next feature"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

            </div>

        </div>


        <div
            class="feature-banner-stage"
            id="featureBannerStage"
            tabindex="0"
            aria-label="ArchiTrack feature carousel. Drag left or right."
        >

            <div class="feature-moving-bg">
                <span class="moving-line line-a"></span>
                <span class="moving-line line-b"></span>
                <span class="moving-circle circle-a"></span>
                <span class="moving-circle circle-b"></span>
            </div>


            <div
                class="feature-banner-track"
                id="featureBannerTrack"
            >

                <!-- 01 -->
                <article
                    class="feature-banner-card active"
                    data-feature-index="0"
                >

                    <div class="feature-banner-content">

                        <span class="feature-banner-kicker">
                            PROJECT CONTROL
                        </span>

                        <h3>
                            Project Management
                        </h3>

                        <p>
                            Organize phases, milestones, project updates,
                            and overall progress in one workspace.
                        </p>

                        <div class="feature-banner-tags">
                            <span>Phases</span>
                            <span>Milestones</span>
                            <span>Progress</span>
                        </div>

                    </div>


                    <div class="feature-banner-visual">

                        <div class="real-ui-card project-ui">

                            <div class="real-ui-head">
                                <span>Project Overview</span>
                                <small>ACTIVE</small>
                            </div>

                            <div class="real-ui-progress">

                                <div>
                                    <strong>75%</strong>
                                    <span>Overall Progress</span>
                                </div>

                                <i>
                                    <b style="width: 75%;"></b>
                                </i>

                            </div>

                            <div class="real-ui-grid">

                                <div>
                                    <small>01</small>
                                    <strong>Planning</strong>
                                    <span>Completed</span>
                                </div>

                                <div>
                                    <small>02</small>
                                    <strong>Initial Design</strong>
                                    <span>Completed</span>
                                </div>

                                <div>
                                    <small>03</small>
                                    <strong>Development</strong>
                                    <span>In Progress</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </article>


                <!-- 02 -->
                <article
                    class="feature-banner-card"
                    data-feature-index="1"
                >

                    <div class="feature-banner-content">

                        <span class="feature-banner-kicker">
                            DOCUMENT CONTROL
                        </span>

                        <h3>
                            File Management
                        </h3>

                        <p>
                            Keep project files organized while tracking
                            versions and document history.
                        </p>

                        <div class="feature-banner-tags">
                            <span>Files</span>
                            <span>Versions</span>
                            <span>History</span>
                        </div>

                    </div>


                    <div class="feature-banner-visual">

                        <div class="real-ui-card files-ui">

                            <div class="real-ui-head">
                                <span>Project Files</span>
                                <small>12 FILES</small>
                            </div>

                            <div class="file-row active">
                                <i>PDF</i>
                                <div>
                                    <strong>Floor Plan - Final</strong>
                                    <small>Version 04</small>
                                </div>
                                <span>2.4 MB</span>
                            </div>

                            <div class="file-row">
                                <i>DWG</i>
                                <div>
                                    <strong>Elevation Drawing</strong>
                                    <small>Version 03</small>
                                </div>
                                <span>5.8 MB</span>
                            </div>

                            <div class="file-row">
                                <i>IMG</i>
                                <div>
                                    <strong>Site Reference</strong>
                                    <small>Version 01</small>
                                </div>
                                <span>1.2 MB</span>
                            </div>

                        </div>

                    </div>

                </article>


                <!-- 03 -->
                <article
                    class="feature-banner-card"
                    data-feature-index="2"
                >

                    <div class="feature-banner-content">

                        <span class="feature-banner-kicker">
                            CLIENT FEEDBACK
                        </span>

                        <h3>
                            Revision Requests
                        </h3>

                        <p>
                            Keep design feedback structured, attached
                            to the correct project, and easier to review.
                        </p>

                        <div class="feature-banner-tags">
                            <span>Comments</span>
                            <span>Attachments</span>
                            <span>Status</span>
                        </div>

                    </div>


                    <div class="feature-banner-visual">

                        <div class="real-ui-card revision-ui">

                            <div class="real-ui-head">
                                <span>Revision Request</span>
                                <small>#REV-014</small>
                            </div>

                            <div class="revision-ui-body">

                                <div class="revision-ui-note">
                                    <span>01</span>
                                    Move wall approximately 250 mm.
                                </div>

                                <div class="revision-ui-note">
                                    <span>02</span>
                                    Increase window opening.
                                </div>

                                <div class="revision-ui-status">
                                    <i></i>
                                    Under Architect Review
                                </div>

                            </div>

                        </div>

                    </div>

                </article>


                <!-- 04 -->
                <article
                    class="feature-banner-card"
                    data-feature-index="3"
                >

                    <div class="feature-banner-content">

                        <span class="feature-banner-kicker">
                            TEAM COORDINATION
                        </span>

                        <h3>
                            Meeting Scheduling
                        </h3>

                        <p>
                            Request, approve, reject, or reschedule
                            meetings without leaving the project.
                        </p>

                        <div class="feature-banner-tags">
                            <span>Request</span>
                            <span>Approve</span>
                            <span>Schedule</span>
                        </div>

                    </div>


                    <div class="feature-banner-visual">

                        <div class="real-ui-card meeting-ui">

                            <div class="real-ui-head">
                                <span>Meeting Schedule</span>
                                <small>SEPTEMBER</small>
                            </div>

                            <div class="meeting-ui-date">
                                <strong>10</strong>
                                <div>
                                    <span>Thursday</span>
                                    <small>03:30 PM</small>
                                </div>
                            </div>

                            <div class="meeting-ui-row">
                                <span>Design Review</span>
                                <strong>Confirmed</strong>
                            </div>

                            <div class="meeting-ui-row">
                                <span>Client Consultation</span>
                                <strong class="pending">Pending</strong>
                            </div>

                        </div>

                    </div>

                </article>


                <!-- 05 -->
                <article
                    class="feature-banner-card"
                    data-feature-index="4"
                >

                    <div class="feature-banner-content">

                        <span class="feature-banner-kicker">
                            AI ASSISTANCE
                        </span>

                        <h3>
                            AI-Assisted Feedback
                        </h3>

                        <p>
                            Turn client input into clearer,
                            design-related revision requests.
                        </p>

                        <div class="feature-banner-tags">
                            <span>Structure</span>
                            <span>Clarify</span>
                            <span>Review</span>
                        </div>

                    </div>


                    <div class="feature-banner-visual">

                        <div class="real-ui-card ai-ui">

                            <div class="real-ui-head">
                                <span>AI Revision Assistant</span>
                                <small>READY</small>
                            </div>

                            <div class="ai-ui-input">
                                Make the living room feel more open.
                            </div>

                            <div class="ai-ui-arrow">
                                ↓
                            </div>

                            <div class="ai-ui-output">
                                <strong>Structured Request</strong>
                                <span>
                                    Review partition placement and
                                    circulation between living and dining areas.
                                </span>
                            </div>

                        </div>

                    </div>

                </article>


                <!-- 06 -->
                <article
                    class="feature-banner-card"
                    data-feature-index="5"
                >

                    <div class="feature-banner-content">

                        <span class="feature-banner-kicker">
                            PROJECT VISIBILITY
                        </span>

                        <h3>
                            Project Insights
                        </h3>

                        <p>
                            See project progress and revision activity
                            through simple, readable summaries.
                        </p>

                        <div class="feature-banner-tags">
                            <span>Overview</span>
                            <span>Activity</span>
                            <span>Reports</span>
                        </div>

                    </div>


                    <div class="feature-banner-visual">

                        <div class="real-ui-card insight-ui">

                            <div class="real-ui-head">
                                <span>Project Insights</span>
                                <small>THIS MONTH</small>
                            </div>

                            <div class="insight-ui-chart">

                                <div style="--h: 48%;">
                                    <i></i>
                                    <span>PLN</span>
                                </div>

                                <div style="--h: 64%;">
                                    <i></i>
                                    <span>DSN</span>
                                </div>

                                <div style="--h: 78%;">
                                    <i></i>
                                    <span>DEV</span>
                                </div>

                                <div style="--h: 56%;">
                                    <i></i>
                                    <span>REV</span>
                                </div>

                                <div style="--h: 88%;">
                                    <i></i>
                                    <span>PRG</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </article>

            </div>

        </div>


        <div class="feature-banner-dots" id="featureBannerDots">

            <button
                type="button"
                class="feature-banner-dot active"
                data-feature-dot="0"
                aria-label="Project Management"
            ></button>

            <button
                type="button"
                class="feature-banner-dot"
                data-feature-dot="1"
                aria-label="File Management"
            ></button>

            <button
                type="button"
                class="feature-banner-dot"
                data-feature-dot="2"
                aria-label="Revision Requests"
            ></button>

            <button
                type="button"
                class="feature-banner-dot"
                data-feature-dot="3"
                aria-label="Meeting Scheduling"
            ></button>

            <button
                type="button"
                class="feature-banner-dot"
                data-feature-dot="4"
                aria-label="AI-Assisted Feedback"
            ></button>

            <button
                type="button"
                class="feature-banner-dot"
                data-feature-dot="5"
                aria-label="Project Insights"
            ></button>

        </div>

    </div>

</section>


<!-- HIGHLIGHT -->
<section class="highlight-section refreshed-highlight">

    <div class="highlight-shape shape-one"></div>
    <div class="highlight-shape shape-two"></div>

    <div class="highlight-content refreshed-highlight-content">

        <span>
            ONE CENTRALIZED WORKSPACE
        </span>

        <h2>
            Everything important to the project stays connected.
        </h2>

        <p>
            ArchiTrack brings communication, project progress, files, and revisions
            into one centralized platform. With real-time updates, organized feedback,
            meeting scheduling, and AI-assisted revision structuring, it helps
            architects and clients collaborate more clearly and efficiently.
        </p>

        <div class="workspace-pill-row">
            <span>Project Progress</span>
            <span>Files &amp; Versions</span>
            <span>Revision Requests</span>
            <span>Meetings</span>
            <span>Real-Time Updates</span>
            <span>AI-Assisted Structuring</span>
        </div>

    </div>

</section>


<!-- CONTACT -->
<section class="contact-section refreshed-contact" id="contact">

    <div class="contact-left refreshed-contact-intro">

        <span class="section-label">
            CONTACT VERO DESIGNS
        </span>

        <h2>
            Let’s connect.
        </h2>

        <p>
            For architectural project inquiries, account concerns, project access,
            or ArchiTrack-related assistance, you may contact Vero Designs
            Architectural Services through the details below.
        </p>

        <div class="contact-office-note">
            <span>OFFICE</span>
            <strong>La Huerta, Parañaque City</strong>
        </div>

    </div>


    <div class="contact-card refreshed-contact-card">

        <a
            class="contact-detail-row"
            href="mailto:verodesigns.architects@gmail.com"
        >
            <span class="contact-detail-no">01</span>

            <div>
                <small>EMAIL ADDRESS</small>
                <strong>verodesigns.architects@gmail.com</strong>
            </div>

            <span class="contact-detail-arrow">↗</span>
        </a>


        <div class="contact-detail-row">

            <span class="contact-detail-no">02</span>

            <div>
                <small>CONTACT NUMBERS</small>
                <strong>
                    <a href="tel:+639189283527">0918-928-35-27</a>
                    <span class="contact-number-divider">/</span>
                    <a href="tel:+639178897968">0917-889-79-68</a>
                </strong>
            </div>

        </div>


        <div class="contact-detail-row">

            <span class="contact-detail-no">03</span>

            <div>
                <small>OFFICE ADDRESS</small>
                <strong>
                    5381-A M. H. Del Pilar St., La Huerta,
                    Parañaque City, Philippines
                </strong>
            </div>

        </div>


        <div class="contact-detail-row">

            <span class="contact-detail-no">04</span>

            <div>
                <small>COMPANY</small>
                <strong>Vero Designs Architectural Services</strong>
            </div>

        </div>

    </div>

</section>


<!-- PRIVACY -->
<section class="privacy-section privacy-orbit-section" id="privacy">

    <div class="privacy-copy">

        <span class="section-label">
            DATA PRIVACY
        </span>

        <h2>
            Compliance with the Data Privacy Act of 2012
            <span style="display:block; font-size:.48em; margin-top:8px; letter-spacing:.04em; color:#df702b;">
                Republic Act No. 10173
            </span>
        </h2>

        <p>
            ArchiTrack recognizes the importance of protecting personal
            and project-related information. The system follows the principles
            of the Data Privacy Act of 2012 by collecting information only
            for legitimate purposes, limiting access based on user roles,
            and applying appropriate security measures.
        </p>


        <div class="privacy-points">

            <button
                type="button"
                class="privacy-point active"
                data-privacy-point="collection"
            >
                <span class="privacy-point-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 5h16v14H4z"></path>
                        <path d="M8 9h8M8 13h6M8 17h4"></path>
                    </svg>
                </span>

                <span class="privacy-point-text">
                    <strong>Data Collection</strong>
                    <small>
                        Only necessary information is collected for account,
                        project, and communication activities.
                    </small>
                </span>
            </button>


            <button
                type="button"
                class="privacy-point"
                data-privacy-point="access"
            >
                <span class="privacy-point-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M7 11V8a5 5 0 0 1 10 0v3"></path>
                        <path d="M5 11h14v9H5z"></path>
                    </svg>
                </span>

                <span class="privacy-point-text">
                    <strong>Controlled Access</strong>
                    <small>
                        Access depends on the user's role and assigned permissions.
                    </small>
                </span>
            </button>


            <button
                type="button"
                class="privacy-point"
                data-privacy-point="security"
            >
                <span class="privacy-point-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 3l7 3v5c0 4.5-2.8 8.1-7 10-4.2-1.9-7-5.5-7-10V6z"></path>
                        <path d="M9 12l2 2 4-4"></path>
                    </svg>
                </span>

                <span class="privacy-point-text">
                    <strong>Data Security</strong>
                    <small>
                        Authentication, passwords, and role restrictions help
                        protect system information.
                    </small>
                </span>
            </button>


            <button
                type="button"
                class="privacy-point"
                data-privacy-point="rights"
            >
                <span class="privacy-point-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="3"></circle>
                        <path d="M5 20c1-4 3.5-6 7-6s6 2 7 6"></path>
                        <path d="M17 5l2 2 3-3"></path>
                    </svg>
                </span>

                <span class="privacy-point-text">
                    <strong>User Rights</strong>
                    <small>
                        Users may request access to or correction of their personal
                        information, where applicable. The DPA recognizes rights
                        such as being informed, accessing personal information,
                        and requesting correction.
                    </small>
                </span>
            </button>


            <button
                type="button"
                class="privacy-point"
                data-privacy-point="retention"
            >
                <span class="privacy-point-icon">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="8"></circle>
                        <path d="M12 8v4l3 2"></path>
                    </svg>
                </span>

                <span class="privacy-point-text">
                    <strong>Data Retention</strong>
                    <small>
                        Information is retained only as long as necessary
                        for its intended purpose.
                    </small>
                </span>
            </button>


            <button
                type="button"
                class="privacy-point"
                data-privacy-point="handling"
            >
                <span class="privacy-point-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h16v11H4z"></path>
                        <path d="M8 7V5h8v2"></path>
                        <path d="M8 12h8"></path>
                    </svg>
                </span>

                <span class="privacy-point-text">
                    <strong>Responsible Handling</strong>
                    <small>
                        Users and authorized personnel are expected to handle
                        project and client information responsibly.
                    </small>
                </span>
            </button>

        </div>

    </div>


    <div class="privacy-orbit-panel">

        <div class="privacy-blueprint-label">
            <span>DPA 2012 / PRIVACY CORE</span>
            <strong>01 / 06</strong>
        </div>


        <div
            class="shield-stage"
            id="privacyShieldStage"
            tabindex="0"
            aria-label="Interactive privacy shield. Drag to rotate."
        >

            <div class="shield-grid"></div>

            <div class="orbit orbit-one"></div>
            <div class="orbit orbit-two"></div>
            <div class="orbit orbit-three"></div>

            <div class="shield-axis axis-horizontal"></div>
            <div class="shield-axis axis-vertical"></div>

            <div class="shield-object" id="privacyShield">

                <div class="shield-depth shield-depth-back"></div>

                <div class="shield-face">
                    <svg viewBox="0 0 200 240">
                        <path
                            d="M100 12
                               L176 42
                               V103
                               C176 158
                               145 201
                               100 226
                               C55 201
                               24 158
                               24 103
                               V42
                               Z"
                        ></path>

                        <path
                            class="shield-check"
                            d="M68 116
                               L91 139
                               L137 88"
                        ></path>
                    </svg>
                </div>

                <div class="shield-depth shield-depth-front"></div>

            </div>


            <div class="shield-data-tag tag-top">
                <span>RA 10173</span>
                <strong>ROLE-BASED</strong>
            </div>

            <div class="shield-data-tag tag-bottom">
                <span>STATUS</span>
                <strong>PROTECTED</strong>
            </div>

            <div class="shield-drag-hint">
                <span class="drag-dot"></span>
                DRAG TO ROTATE
            </div>

        </div>


        <div class="privacy-status-panel">

            <span class="privacy-status-label">
                ACTIVE PRINCIPLE
            </span>

            <strong id="privacyStatusTitle">
                Data Collection
            </strong>

            <p id="privacyStatusText">
                Only necessary information is collected for account,
                project, and communication activities.
            </p>

        </div>

    </div>

</section>


<!-- TERMS -->
<section class="terms-section" id="terms">

    <div class="section-title">

        <span>
            TERMS AND CONDITIONS
        </span>

        <h2>
            Responsible use of ArchiTrack
        </h2>

        <p>
            Users are expected to use ArchiTrack only for
            authorized account and project-related activities.
        </p>

    </div>


    <div class="terms-grid">

        <div class="term-card">

            <span>01</span>

            <div class="term-icon"><svg viewBox="0 0 24 24"><path d="M7 11V8a5 5 0 0110 0v3"></path><path d="M5 11h14v9H5z"></path></svg></div>

            <h3>
                Account Security
            </h3>

            <p>
                Users must keep their login information secure
                and must not share passwords with unauthorized users.
            </p>

        </div>


        <div class="term-card">

            <span>02</span>

            <div class="term-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="3"></circle><path d="M5 20c1-4 3.5-6 7-6s6 2 7 6"></path><path d="M18 6l2 2 3-3"></path></svg></div>

            <h3>
                Authorized Access
            </h3>

            <p>
                Users may only access projects and information
                made available to their accounts.
            </p>

        </div>


        <div class="term-card">

            <span>03</span>

            <div class="term-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16v16H4z"></path><path d="M8 8h8M8 12h5"></path><path d="M16 16l2 2 3-3"></path></svg></div>

            <h3>
                Proper System Use
            </h3>

            <p>
                Malicious, illegal, harmful, or unrelated
                files and content must not be uploaded.
            </p>

        </div>


        <div class="term-card">

            <span>04</span>

            <div class="term-icon"><svg viewBox="0 0 24 24"><path d="M4 7h16v11H4z"></path><path d="M7 4h10v3"></path><path d="M8 11h8"></path></svg></div>

            <h3>
                Project Information
            </h3>

            <p>
                Project files and client information should only
                be used for authorized project purposes.
            </p>

        </div>


        <div class="term-card">

            <span>05</span>

            <div class="term-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="7" r="3"></circle><path d="M6 20c1-4 3-6 6-6s5 2 6 6"></path><path d="M18 4v6M15 7h6"></path></svg></div>

            <h3>
                User Responsibility
            </h3>

            <p>
                Users are responsible for the information and
                files submitted through their accounts.
            </p>

        </div>


        <div class="term-card">

            <span>06</span>

            <div class="term-icon"><svg viewBox="0 0 24 24"><path d="M5 5h14v14H5z"></path><path d="M8 9h8M8 13h8"></path><path d="M9 17h6"></path></svg></div>

            <h3>
                Account Status
            </h3>

            <p>
                Accounts may be deactivated when access is no
                longer authorized or permitted.
            </p>

        </div>

    </div>

</section>


<!-- CTA -->
<section class="cta-section">

    <div class="cta-gradient"></div>


    <div class="cta-content">

        <span>
            ACCESS YOUR WORKSPACE
        </span>

        <h2>
            Continue your architectural project in ArchiTrack.
        </h2>

        <p>
            Sign in using the account credentials provided by
            the administrator or through your project invitation.
        </p>

    </div>


    @auth

        <a href="{{ route('dashboard') }}">
            Go to Dashboard
        </a>

    @else

        <a href="{{ route('login') }}">
            Log In
        </a>

    @endauth

</section>


</main>


<!-- FOOTER -->
<footer class="main-footer">

    <div class="footer-logo">

        <img
            src="{{ asset('images/arlogo.jpg') }}"
            alt="Vero Designs Logo"
        >

    </div>


    <div class="footer-info">

        <strong>
            ArchiTrack
        </strong>

        <p>
            Architectural Project Management System
        </p>

        <span>
            © {{ date('Y') }} Vero Designs Architectural Services.
            All rights reserved.
        </span>

    </div>


    <div class="footer-links">

        <a href="#about">
            About Us
        </a>

        <a href="#contact">
            Contact
        </a>

        <a href="#privacy">
            Privacy
        </a>

        <a href="#terms">
            Terms
        </a>

    </div>

</footer>



<!-- BEARO LANDING CHATBOT -->
<div class="landing-chatbot" id="landingChatbot">

    <div
        class="bearo-greeting"
        id="bearoGreeting"
        aria-hidden="true"
    >
        <span class="bearo-greeting-wave">👋</span>

        <div>
            <strong id="bearoGreetingTitle">Hi! I’m Bearo.</strong>
            <small id="bearoGreetingText">Need help with ArchiTrack?</small>
        </div>
    </div>

    <button
        type="button"
        class="chatbot-launcher"
        id="chatbotLauncher"
        aria-label="Open Bearo Assistant"
        aria-expanded="false"
    >
        <span class="chatbot-launcher-icon chatbot-bearo-thumb">
            <img src="data:image/png;base64,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" alt="Bearo assistant profile">
        </span>

        <span class="chatbot-launcher-copy">
            <small>Need help?</small>
            <strong>Ask Bearo</strong>
        </span>

        <span class="chatbot-live-dot"></span>
    </button>


    <section
        class="chatbot-panel"
        id="chatbotPanel"
        aria-hidden="true"
    >

        <div class="chatbot-grid-bg"></div>


        <header class="chatbot-header">

            <div class="chatbot-header-left">

                <span class="chatbot-avatar chatbot-bearo-avatar">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAbUAAAGwCAYAAAAuZ/tuAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAEnQAABJ0Ad5mH3gAAP+lSURBVHhe7P15syxLch8G/iIiM2s75+5v631DdwMgGkCThEBpRmOyGYommw9ESn/pS8jma1DimA0pSuBAMhsCIAGQAIju914vb73v7mepU0suETF/uHtEZFZmLefUue92g79781RVZmSsHu7hER4e6tnzc48ABaXir5tAQWF7VJ6v66ATswL0sTLO8HtFlwRSG7m6Fvxm6fbEwFsDtwXSSjo0x+YLXupWKWR5BgBwzsE6B2cdrLWwzsFaB+cdvPOom5pe6VSM94D3Ht7TD6V1DEdfEspJ87KZL4FP6EgpetvTg/DU+5TW/LboWlDHpqtWPjpIyu6d57qj31Kubge11rZ+9/c6D+dd6G8Sjwr9Xd7xcN5DAVBKt8ruveN2o0sD0ArQWsNoA2M0TJbRpzEwxkApleRvqNxyX/G3nnBJkbbW38a7gRJuF34gGQUi+NcASqadVn/SvTcTDMuAbhqtYu/gf4OpJnF6qC0Bt4OioZfVs+cXRMWMbRnbD/0saROtKjkA/ZV+dOazV3TtltzrlS0I7buDQPrR/5J3A3WshFHSSxoKygOOhU5oG6WglAaUBhQJM+89CTTHAo2FmrMWjgWW5vCD8OAa2xYIsVyKvw9CytkXZrMOvHfdW704Nl3tj2663d+EVlsBA+E8VB+H6wu6Cx5Q8HxFpIMXEZRaKcxmMx64MMPppKkUCTPvHYhU2/lUUFBahXbw3rUGMSGcCH94QCl4xwOnnrDXhTogKgnal1ccGNc+2Les+4Tz0p4baL/nQTQkd/vegITbmmSMIVDV7pdaoOAUXj17cbEf/94XMqLcORj2B2Wa0C/Qhu9fH/tVCnXkvYLuiV0EQuh52tJw2vfhQZ1LPvmBQhRspBnwC60RuidBBxqhl+sSjomHWjCO3sMompLqz2cXrYoeCK/k0cDzg+F/BYVaP7ZrLhGiBx0DSrS5PeI0xpA2l2hwxpAWSHVL5SRRJTSK0BOEpqUZnHOA8q0BmbwHeJYWxGnllsR1ExwqhISsh/JwaHy7sI+wwgHh9sU+fHKoDjYR6SGS9a53CGkaBwq1bQlwLMLkdwo17IivByIw2zdjmkfE7kpJRqbdR7eObopDQj2OcCHirKfKA+Pgvx4szJyDdRZNw5qYc2iaJhJc2h6tDKg9mW37na3oL+A1wQy0rzI66KO414fdaQ9pAl0QE90v7K5QClGw9YNiUPxNAVBaQ2uVCDYSblprKK0DzdFFsah0fBUGZi4IxJb25h2l5TlFEZhhALarVNuxrxDyaDdbrPY0gjjw313b+yHEsiPOL02ohS/b0uY2Yxwq2MDvHCDUdkfcHdXuJoSdARh9AqTv3vEwXClJDgbD3Aa6iaW/h4Rat036Avl4n7UyZx0aR9OKDU8vyrRjhKJ0kzt0Wxpl48kOSPhD37sO/AG093cL+wxGFKhvD7cUPVRgOhBhxe9q1toyY2Ay0uR0ltFTDgeZiFIJd/McryK6Juqj9ULvPSCC1oOmzEMO0wHd7vLdBF2+0U5SvnT6zZHz1U6uHW/rV8/zQ9Et7za0SasvXbXR/ymLfWH74T2gnr+42PMN35OR7VrSbqG2D7oMm34czDMPxGZj8Y0t5T0+kpSS6cVIi9262QR1bgA8TUhx0ie9SxHUTcNaGWljltfHADJYUJoNB0IcHGtYg5Pf9F3pvoz13UvR91zye2zcRpzHxLHz11e3m9hHqIFj6+3fQZjRT61Ja5d4A31wQKVIi5tOpjBZRgJOa5op8A7ekYGLYnpVioiOhKTExRlhweYBaGU6ZT7+GlsfNvkGoVutqpu78Px4+dstRPYLsw1D5d2G2Azd9Lq1IsG64bbjBkJtt6bUS/QHoY9p9907PjYba7sAvx106zimzrZxWyECRykFHRbbFTx8sFoUK8blagUHGgFrrVuxt9Y6vGh/Q6lTo3vfGcoHWhh6rw/dsDcmqF8RcDm7xb8urlX32+H7ph9bywM8wevI+lGmH2WQ5RwJLOcd4IEsy6G1RmYMsjxDxpaU4LS8oynGPM/geVrcO6Ixo8koJcTr/dGF2kZZB2La5BuEVljuGt2gN8nfNlC02+PdJ0wfhsq7DSGVjfL21UoabL/83ViobWYh4vhCrfv79rDZWLvLe3NsJjAsuobuR5BQc4BS0ErLTFBYG5PLOgcLkOk+a4QhdiamSO8xXRlt96NLL1Kpgy/0IA17Y2L6FYIMCI5VZjFRO6Tut6NPo+suPwC0Lgsl2n6yxpsaLXmhc+rfxmhkWYY8z4NRCb3gobWCcxbOkmmJVgqGBSa8h3Ok4fUJNXCfuE69dkuGgVg2+UaEhJem7Qa9bt4Owb5p7B2uW4g9EaNP0xjmD4dolNcUapzwNp6GWxBqWwxFNivoZmg3Vldjui1EobIb+4WRqR/Phh/BDF8Yg3ewHoDW8J0pQ++DKVr4pCnIGEax5tdGsh7SQt8+lI1AHYTGfaOxWQf92K9tfwWFWi/d8hShj0l3B6nyUHEe0+daKWijaQ2OLSipWjxPRdIMhFbMJzzts/POd9bUUlxPY+uPaRNDTL4bVmGTP8ZsdUPvQsKId7y/b9n3DjdQ3l1oRy9f1EBNR+wj3K4h1CjRjUFZD7qNdjhSodanKcV7+zbCvoiNtX95b45jCjV63tpLZi2sbWCtbMTlylMKFoDrFtLH9gaPptPReLCe7jI4Zjo7s4jjM9svCxt1MIBNbaYPv2JCbRvNhtvEP9r9VAU6DJoax01TkzR1SdsBeEuAou9ZliHLDE1pAp3N4RLTQJ428rEbfTH1vT3E5CWsV9HIpo8/xmz1PBxEe/C/rWz7xr8tjhRD5d0XkYw81/L+EQ7lMQq1zWcRCq0AB/XLQWxIqF4oxAQ3gnczsidj6UUSVzeWbjKHIX05jbk/0sj0urkg0FPNG1V76lBeU7Txel2WcLz+IN4+xACEgil4pWDh4dWAKX4i0FpCjd/fRFzE34oQpC+O28W23F0nN7311oO9hRqumZE+3EI9h/JuE2iIBkOk9ZPZfVpXovk7z0YezDe04ulKepuEFTyMNijyHKPxCEWRw2jN63OWw3Ap92gPHwLLjfRrkkeh8zTKvkkH+EEmL2F3CTV0adNv3OnB5rLMNnqMUW4Js+O5YKi8hyCmJZHtH2lfPvcSair8oUBDSW40Rg/PJYiG0L2/ie1MoPtsSyF2QHUzm0TVTUWwX4OKKolO/jZZgQgNz1OFskFYaVoTA6gVvVewXgHsyojqiBKxlveVWbZg3DDF38gGPN8aLI9HrAX52FnVOwMwhhK9PQQqHko6MYLYTn8RG3V8Yxw3vkB+O4TQ0RFoH1vL5D02vZ50s8maGG3mpu0AWbLvTSwnFRxcUwPcf4SuY7njp+YpTZKpPPCT9kyEpFYaKu0gLaEm37YLNblUcu1CH9PeBHkDamPjRgsU7XCYfdKVshyKvli978w97wSF7ctnS6hti5LS68tOG61Etq2BbT7oAYXdK+i1ERNI09kkkn4METEhyXyr8tPJkTQC6rSqNUpFax8OUZIBdA6vNMDrCCTMWJCJOT53yn2wb7hfB3gQbfbY75F5uOdPfJlC7bggpiGU9wZiz/rT7FaLpCAN6LTWyLMMJstIyGnAKA94C0+9KnBgTzcCvWcmoy4o6848oKRq4viVAqLrzIDY9+XBdqGWfsb+PwwqZ/izFfvyqxShHnvQJyyOjb40huqvjVh7MfsxHtnEtB17JdRFX/chNXnzfhec6d0BD4BURH+k/XdvAhHIm/WgAB4ldJ+kiNN9WomJPXVocVNFVowWdVWhKktUZYm6qtCIhtaN8j/j7y7eZIHGSHvo0CUDZZ+sFzdNg6qqUZUV1mWJsqxgraNtL0pDKwOlDRTIeCTwUq/gHBmWyJgxckkSZlrrOEtyBOzq9RugQnfvHgVSn7cV/+tAHHPGMuzQ1OhO1NJ2s8kgffu0tOTepkRObhxVnrXjbY98+FlPevuOfAbL0WIiydCQ0VM77fqVulI0vJT1AtLMAOsVGksamm3ImlH27YT3DsCexf21gAfVz98lTe1Nx361nHbhODVIn3FWRytgPCqQsXGJFscB3E5yteJVAGQlLdEClaJhqbO0ny7FIZoaevrYlqAttLPajYWwL7/qQ6/GtPHjBgkMIEYb495WfxFqo/ZCu2GLUNvszH6vgiUDnU6ykejQynwSauOdm4BjStMMfyI2isnYl0g2GyFqaBE0DOwXZN3G8T335As9dQ5YrUs+6oU7qCczZpq2VBSTl/h2Y79Qvx7woIZPhVr4Jh2Da2SzH/SjyyT/Mw7DfrVM9awQ97wp3lLiebuKTLvnbDFJVpI5TU8azR2eBZsT4SZtx1P/rTZnS8k0GCjD8Sd/67t3RPjwp/UFOIBf9SGS7nAk+wjW66Bbpk1+2ge1QTEUD0XUK9T6O7LfqzA8yNlAN86WUOPvPa/dAJvxhgpMEhpKc18i2WyEfqFGFk9dm6r0U36qsNcGICMRpTS8BxpLm6XrmqZcwNMrSow9uEPTfYr7Pwu1TXhQPW8INSYQusv130fMnVY7pO72FX5D6V4XO9Nlmt0Z7pawb2kpXGf0m8xiUPZJyIH7jzFsMTkaIc/onDfqKo6tJ8lht3cOSgFaUxgFCuOc4+OXhnJJdeaZiUoejo0QY0/8+/KrIUj97cK+4a4D768v1JBUy9GF2hBacfJ3KUBfajdHWzMUSAm697vYl0jajZCm2ep10AkhxG/txqEajpn23sNaOnwzrJNxx3WWPIWEeg0dmyMTJrVnm+0X6tcDHkKDSRtxBYiGJjf6+sLmnf3rb1+h0ZfuTTCYbuiD9GUw3C1j79LuzB/1H2stNYoiy0Vj2AUXW0xqPiUgY6HWNNS/FMill9E0WISc87a1PWKevELsc7797BiIUW7Guy/PGkJ4fWcdRxxTgPsQ0674On03ge8XajLK7yImeRh6hIvq3uii+/DQdDe1tEOxL4F0Nc7+Kca2UEPCOiWHFA9rD54sHq21qBtLzoat4xaLfu4gS3UcNzFCSX9fcUY4JOyXh766vR64xlr3uCX4V1qnEUM52Lf+9hUa3XRvisF0OzQ7GO6WsVdpuV9QV+FcJ4Yj7XD0VeqRpi3JzVbOLrhIwJHz5DjLwXvkwvo/9aPttRKfpoNcjxjnsRBi861fx0OL/HfH72UwvQP7tG+s510xqq0xdsx6hgTazXBYlCwctud7C+ila79+LWwTaF3E/AlEoAE0LdI4h7puUFY16rqGbeLGUh86LMcgnSZpOA9xF7S5uP2ri33qdn8IfaTXLuwT5lcKe9PsmwUvbaY0b9LmTy6Ll8NJTQalDLM5RQZW1qNuLMqqwrqkq2ksAAVjxJGyiQNHWsFrpb8NyncHxPtS135ox3a8eANaHWJ3/F6Y0tar+9btImhqu5suytHt2Iwl8lv+sq2du1LVhz9bkLyzSwncEwdpakmH6odPDlWMhQ81yhLce6Csa55ytDzXz+sErREnQUaUUNFCUryGeE+qt+H1gV3Ys7hfIqQMu8uyD3xYO4vxxXuRAKRdd6U6WH/pi57arxcqieQWhE1fun100RfudWAzJ/3wso8zpX16EDUuKJgsh3Nk9i/aHQk+xENFvUeeGRRFjlERPZSQ0YnlkwH613nSWupOWQMqeUfW+fow+GAv+PCndecoUGEWqPskBXsnGgwT66OH1DbgdyWXdpAtFKOev7gM9T8cjAgBkA43hB2ZT6cKBsP1Pdhe1G6m+mI4FNcSaqqHUXgAvKFTKxpdShjnQV7F2XWVcx6r9Zq0LH5XGpoWqmNVpBOYm0if7a6NjTy/BtDUTH/afYyVbh2iEQ/Dw8M2FprXWaDIZNvaJnirkHPAFLsbiwyT8kzTU9QgDmzYI2WRPDI9yHfvgbqqoDW3JXuqkHdkzVRr3eq/rfKq8IdKIvNsbyj62rILz9729wi6gVgTnbtKw/ukwyRhyXMJXd45GK3oVIAiR5GRtqY4797z8TisEcp92Qeq+PKg5QGt246Uhybn6G7/s33Rettv3LkR9uZ/3GiUfHyp/XuHXGB4UNX1Jt0qn9R6P9TzlyzUOib9XdARJtvDbM18mKMm9I1+rg9hdsfDXo2ajBRbTDowIjarpz+kDbfONQMa69DUDeq6ocVqT5tGJXkPEmhxipLf7DvP6lB0GeZrQkrwXaEm9dhFEGo977Qgj0Ic7ZFyjF/OmaN9TABgbQNALE5p1GGMIX+ZYiHX4bzkeDdhXR1B1vpkdPdNOe9aZ9iprg/OLcXtq6s3Cd36GkKoj4H2PwTUM3qsW+Uz9B3PrrSIFozWyHNebzM8w6HiYMYn7aiUCD3uiy3+s63BqIwcY/fRtcDkfLT4gD35H1VlSJe+bn7HNrnQwZBcSNOh+h0IiEOEWovVDqEv8/0CZyjzhyNGfrQo923UQMlqg6CkDcLoHszIOKjzHpbPNatr2UDtoHTaGaVg3Ig8ijmKUHstAm0z/i7TSgVU91kKqkcKu1WobcFm/LS3T4SMczZ2Hk8HUSqoeMKBbHL3pCE5Nvcmt0oJHbJQC/lM7udZjizPkGc5TGaglUbDGiIJNu7AaRE9552/0wd9Oaa3i9vAoUINve10GFKhlsbapRrFmpgkphToiBsdrSSNMVCGtgU4Z+GcZ7rhNLyHUjxAUopoYUfeb0Wotb7swu6Ae/E/odUkvrS947M+udCPIblwK0KNItxV0r7M990bzvz+iBH0xX9T7N2oijIgjMwjMjxuTyhoaG0ArxKrRj6k07InEC6PD4WJn3SLhxTSWDcRal+SQMMGcXaYWedZipQ3HiLU+oJ6HmwQQ0LY6+e4Tr33sE2NqiyDc+imob2BjW345GUHZ2ntxXnPgxFC0M46iWulUYwKFHmBYlRgPB5jOp3CWhvWPiVfoj0Kg0+FWmD6bK7+JiPkO97oRbeubiLYRKgJDQ4Pxj28syGUosYH4Em4ZRnyLEOWZxiNiuCWS3xDysG7StG7SvFWm6HkGMcWavsidq/d6e7N/1pf0lmRdgl7umEvhuTCQULtxcvLkPpwMHCE20rKpNGKpO8eYSjzu8Ev9mh/xwOz/G3FBeXBQ4iaciMjd2KY7DtOG0BpNI1DVVWoq4rM9HmzJzFV2twZRzrUcO0RbPrt+kKty0BuB13C618wV2Gz6ja03z0s/5uRew84Z5N2i/WutYazDdbrFRZXV2hYQ2tsAysOo8Nhq7GtacG0nU43nwoKo9GINgRrg+lsirfeegt5liPPczhPmjs8oE2yrrYF+2pCbwqG8tutK2wJuwtRqBGGhRoA7zoDK1obU6D9apr3rE2n4zjQ4DU16t/R+Ti920tyHXjw+QHdB7cK3/6zFfsKNUEad7vZDotoSC58OUKts2Y2eI8xlPnduJ3pxjYo3zvj58VjGV2L5aFAppSgNFarktbPeCrLWfIgLoxVDEgcGxykXTKFNNbWjroDfQzk+OjWYJfYD8H+Qk0eSSeQ94hB8m+2CtWa8kjaNTEkpRTqusLiao6LiwuUZcnTjzQdGSziEuMRN2AhtwEF5Fke1lVnsxneffdd3Dm9gyzLArMEePMwv9OOYp+E3nx0NbG+Nr2uUAP3EITqG47HezJSUYqn95N1MoKCUqS5jYocRVEgY68kMhUJgMyFnIjTdlm6JfO/hkJNkLYZJXVYREP96PUKtT7B1Xevg6HM7wZP7XRvHxUi1Hakoqis1BHEGopGbgBZzTnnUFuH1apiQk47DkfD56UpRQce7oeettiFUG87ynUUpIR3E4GGjff7GGAvVKcfgH8nU4MyqCDy9nDWYrVa4vLyEucX5yjXJayL2hmN4nlkDn6Hp5Po6ikoTxkq0NqMOJ8eT8Z45+138N577yEvcmaUjiwzEwtJeT988j0cUhdvIKQswzTJIXqq9DigAYnmdVWwUAvrYskUo7dNsJIsCtKstTYUi3ds/cil6OS3W7JfH6FG065tgdP+TV/3igzAsFx4rUKt3an2FzhDmd+O16GlgRor/B2GzI2HzsnTjQrEnJqmQVVXqGuH2nl4r1t1qKS+eD0OaI90hrFPmA5CvW0v0/EghHdcgYYNmtsP9Iq8R4MK8veXaNieNLaqqrBYXGE+v8RytQpTjl6mpZBMC7PlYyrYgDhgaQkhZpJVXaNpauR5jocPH+Ldd95lDSCjtTnnURRFTKPbdoq+d7WdX0d0hfj+OOCFHnqSvknwgLM0VQkFkxmMihELNg2VSoBksCroxv7rJtTAxU6ov5VO9/c2DMmF1yTUKHSbHmIhd2Eo88PoS++2sL9Qo0Vj0s407yVzVqwaySNI4zygMzhPh3qC4yYtQdqbmHe7fBJ2E7vJIwFHsKs8xwWl1RVIh2FToAHbhVqsTxkgyDRh+3ddN7AuXS+zUB7IMgPvHdblGovFAuvVquV3Ez5u4pVhKo/TIwNGMjhJtSvOe1mWKNcltNF48OABTmYnMJlBnpMGYLRBMSrC9LWWk56NoWlTw2d88d62w4jhNUMdSqybOFywyeRj+wWPbmeiaX/wFDJ4+rmltXkyJjFakfk/D2yMia62ZF8j7bX7OyrUgFZn3/i9Z7pDcuEwofaChdrWYBykJwDdaqtnPcFa2Mz4xo1ebOFlR0d7pCZVsKmGOud5QZk2j9rGsnZWw1oyEacVMA103flIpyGOC/A6HCESQF+xd5NHxDYhcHu43mbaFH1aqwp/4u80lOY1TpouZFP8sI5Je8qstVgsF6GNnXNwlsz3R6MRlALW6zWurq4AkEbnrHihIDpM25CYrhibsMbGeU+1KWG163WJxWIBpTUePXpEApM3IBtDFnfk3cKwsCtQFAVGBX0SM82IVjhDVC/b2jkVrYRQl90HG+gLsC2tCKWOp1H20UM/KNxG9+3elH7euSl5dmzlCu9p6tHIXsK49pmZDHlOFpLG0JYMoF1lmzUlNCO/UmyGJuxb9mH48Gfjbi92CrYuvW0ItfgrPtoe6aZsIGw2/dAubUC9eHHOfXLHOH6z7RPsr6GlCJW258tDobplGwoXHqjtDeYBWLZeJAKn9TEqZ6JhSV9lzyDWWtR1g7qmk3chp1ZrHTbotmt5MxP7C6B9w+2LzbxcH0Qsm4QoGHzQQRJONraD1y89+/djIWatRdPQQILcjJGmHO/R/jKAmGNV1zw6F/ZC2tvpyQmyzKCqaqzXK1RVHdKjtKnRhVFHhq2IphTnL+nIPpREAdAoywrzqwWc87h7/x7W6zXW6zWKUY7ZdEoam6Y9bFrTBnHDB15KmY3SMJnByckpChF2IuhYY9BKAUrBOss8IOZJ8Z6sQMfsTmpzi0DMeftO9+6bBG6nvdBTBiIzgGJiapZZFq6P0E/pnlJEj6enJwDIutYzzaZdmuKiPXIS12YNt+GBwNWHmP6+2KiVveupDzEzCtvjosHfZhi6xz9YZxiORSC1GJG2t3rx/NxLZIOgoekAeF2oe3sHWkJll0DdA97HStkGxfWxS6h5TQ5QOVry6iEPQaa8WhtiprVFVdeo6wbO8r4lpcKGaw+ECYddOEyo7Rt2FyiHxwPnzYuNZjfu7u8uNp/H9koYliJm3FiLpq5pL5mlNqCz52o0iRl+Svh10wShJnHVdY3T0zvI8wx1XaMsS9R1E13EsRDzol0LPKBo6xLlj1fYpCOLraqHhoJBWdW4nC9gnce9e/dwcXmO1XqFosgxnU1RmAxFlsMomh6jKci4PUTzRl+tNQm0nLS3YlRgOpkiL3JkGa33AIDzFjozcGyh58XFr1aQVV7P64qb9Nc3lSft2g375mB/obYfNKKVs1JUdwDRnwg+bUjTz7IMJpzbRue0QUUBp72Ccg7ak9VszOlmn6ZnbYFwU8EmSLpUp32vh608NQwANwPFsu2rHG3WE5I2Vy9enO+uo16hxjf6Hu2Bowu13mJuIh1hDYX3CvBKw4GkGhEjCTXvKTGKR6GqSjR1PB7GizEBm+h7z9Mv21o8wSZTGUJ/w14PXKijQfJGPTbGvE86/c8VE62KP9A0DcqqQlVWqEUja9gRtKWN0l0tTdCEe9KZFJqmwenpCbIsh7UNyrJK3k3W5RLtzsta9J5CDV6jqhtczklTu//gAZ4+e4KyLFEUOSbTCXJjMMryeARK8EbPgk3RNJdSZE0pBguZyTAejzEaj3BycoLpdIosy+HgoDRtLg8dn6dQSVMjAxmfbPpuoyvY/rNQ6xNqcq8ocoxGBUyWET04mrpWirYAGQCwjjX7LsXHOm3fj4JtN8PeHxRn+MNIE9i/HrexOGoOmSnYDCi392N/zFs6CLT98sX5ZgpdDAm1vtt74thCbT90RwJcCektvusA8u4R8hYrkpwQOzSNRVmWYfQrz0Pl8jse3QIP49dOqCWIQmQb+HlaX8FUmteP2PR9tVphtVxitV6jqWtaA2GtjMzw26b4ofH5XK7I4ClOay1msxnyPOep5BqNpc3QntMXxsbRSG/dT6h5BecVmsbhcr6A98Cjtx7h448/RtPU5GVkMianulrzfm5ykCujfKUUCSOmZaPZlRPvfRMhd+/ePTx8+BCnp6fw8LAyJSotw31a6nW7UAOXgj4DTR+N/o6PL0uoWWthDHn+F0MSGjiQtk9CTcFbN7DXNNbyJoSe6PsxQDTc+kV5UN0kdqe3jcWlwqw/TaGsfbDJW5CkMUTBCTZf7r/3puOwPKcGHJGQqLM0TYP1usRquURVVeQjkB2iavHfx573AfAm39uA5Gzb9ZrBjHcT4pKqPRIKjJrGD/F7+i94WqHv4DW0cl1itVqFNanVeh2MdJqGXFuJkJP2JEFD9aJkCwbnVz5pI7ZMIfOzkF/OQy9FhVDDHY/ntBUbteRZTkYqSpG/QbamU4qaj9bz2B0XC+3GNmgslXFdrjFfXGG5XKKqa1RVjeVqhbPzc1xdXdGU+FYGz9oDu4PqyTIjCrJtsf3aItTL9tIrpeAsDXZpTbaiQRVraWjFkNJJpJfhFAYb59pQiGO9Ls1Kn6Rb7Wc3QTvN9v2bgOKkYeB2DKV0Ay3tS4E0UPcmFI+k2xdtrGRjBw8o3ntWVhWvtdTwHmSCbQwgx1EwAcs6CKUZjU52XfuCGDSNTrZd27rIUZFoETHNfuEqRC1EuBl+E1rrYMru+QiX1XqF9bpEVZaoqgoVe/+gRfrUUS3XL3/XiYk8tRMJNi2Wk2Li3UFf+2ze6/5uw/PZXl2BLXnKDJ3GTJt+hS6krmJ9ij4Ifr+2JOCWqyWWS9o8Pr9aoKprMlvnDhu8Z3B0jjd7Nw1N3Q5UPyMVaNvL+WWj269ueoW6D+0wAE9h4uCXBlxNw4YjSF3hbWL4yS2DiHK4WYfuv2FQauPk6wTSoK3yyHD6V6aMrXK0W27LpRSU0jAmgzYZAFpvKcsSVVmRfz6Qfz5hPmCDEDCjorUPRQxoCxH/WoA1q9atNuFswX51E4QP+1gkZkx7zcSy1MnAomdqUdqIGFREZFr03QePEvvlC9TiG3eGihXyA54FSHyFJiMRFmQq1mNvfXo4uHBas3MOVV1jXa6xLkusyzWqugagSDuVxZgWvdJvBQWw/9G9rn3Rzf/Q9SuBgUZNIDxA+IJzji1piXdY63iQsYndsafVddxKazUDdbHWs5uCSKYdk9D4QfS0B/prt5u89Cwu7HGzcLuIBDCcaw8xDolEmT60lgizZIHGgzHS3lhjAqiBYkMlURzAIH8VscnUCaSJdO8O1UXffR+uIMTYmtHyHiLP+4W0UrRBNkwucvrpv83MtNB6nkxN9r3Xd28rZMoxDIJoXY8cGHv2VsEdPeS9vwytC5Fchc6sdaiZXquKaFZcQWk5Cd2jJbjFCGUjvda/mJ/QpXZc3RiG/v3qozOQCQ1DPiJDe/D+VQ4Q0Ef9/SAhQG8fv96k6Yax/ek29Am2cOfQ/rQFPUKtv1gdPv0rgANGAGmwZARrnUPN6xR1VbN1Iz3zYGMDdrUk/Jf4Ezu85fj04OL7rwF2VrEw4O59rjAlV0J63QseZVliuVphuVqhXK/R1E3LCERp0pxbDF88qMuVCAJZX6MckpBKhZiY0Av6GG/fvT6EYoS6oF/e0346iKGBUjCqbd04WBYuj9aaDzAlRilxN42l9bUlra8tVyuUVcXbTrjcLGBJA5a1xW1lis+6Qmno398NSDljmYm0VDyBw5OT6qqk5QuaXYjLHW2CT69NUHeRlPrDHBsKKTu9fppbBduRkHDbWIntzB8zOYEInGPE3/c+lyP5m4LZabjiPQlLGlgdpg1KPiaGmIb3no4dsS7E79jiTi5ZO5Fpsy8Pm+U/GngkPoy+Wk4++dWUEloU4YXxW/bFOMfVfM5GEVUy/bg53RjN4eXigZmKlmsBLOiIwYuwoDW3Pojg6CItKZKBu3wK+wqU5h0cO8qlvWdEL8awVhU2X8vzzqUVtNF8dh+d6UZTsOQFpa5rXF5e4qOPPsLHH32Mx48f4+WrV1gul7DWQRuDLKM1YdqyEqfQOy3BuT4Q/dX0643WoEWsJRVMlkEpjaZpsFqt4RyviSd13aKfGOHmz+RW/Jq22a7rcIS8Xe/1FqJg6+ap+/t6iCb93LHbT+nesQoTwUyke/s6aOXb98Ta/u2Y2Khekze9DxtdoYCLyzl5BQl7Kzrg9Yk4uu0G6kxBpo+6SITDvlOVMhJMsclriZnvh/3S3Rdi6SUIa0YpFI1eSdi0mUFT1yirkoxyqhpVWQfv9XmeQWmNy8sLNHUdzOcprnab8rd4Dz5QHwkvyidNCSG4nxIjkuVyyWbb/H7HKpYjDdo6mXDwPzZWkbbyIHN+YzJcXS2wWq8xHo3x8tVLZJnB7GSKyWRCjo1ZgaVU+K/8TtJWUHRwqSejpiqZUXj06BGm0xmePn2C8WSEvMgxnUwwO5lhNp3h7r27OJnNgvBWvAZEXkWimX96iSBFYklKbde+pxUZ9pAmLRW1G1S+7t3t2Hhn52DrcCh0uohE37rXXT/vK4iIMYVRMSJ3aIb2sznZyyY0zPVNg2cWjoY0P9qLSV5gvPfQxnTZQT98+LM3+l/ZuLHVpH9fEP1Q2Vv3wx/C0Lok+qcfN7FPXX0p6Aq0HRn1iO6uIBZhXEHGkId0ay1Wq3XYSN3lw4R02M/Cq/W7LdB2IjCvG0DJn/RKH267jg/P2gPXOhSojGLEIeWNZ1NZVBX5RLy8vMDl/BJXV1dYLlcoy5K9g9Rkyi7n0fEeIXgRmu08EG+Qm0k+eK8R+Dt4NA3WuFNhtz+SekzS7bYqGQ/xNg/vsVhcwdkGGbvBUpTBEF5ipU8qgwg2Em68/0nRH2XE2IPo2nmPxXKJl2dnODs/w/nFBc7PzvHy5Ut88fgLfPrZ53j69Bnm8ys452EMecOgwR3n1ZBLrizLoA2571JstENrhDxtm0yLevGP2K2AHVA4sO8I0ncOTHNvqJ4u07rXF6ALeq6URt00WJdkuevZSbIO5zNKu1Ldet5baVuHENMardANTUkO/7sRwuvSp28L/fkM1btH2lqY8EZUffeOgiPFGvIX46ORQn+hwy58ljlEWwpKGzrok9ch1mWFdVkxXwkBO1cSb+tXP/YJg5sItlsYmd4UxNh4vx77FaQH0lBRwFm2LF0slri6muPq6gqLxQKr1QpluUZVlagb2ghNhiJ0ySg1CLae+hPh1b2nQL4ayfowjp698zBKIxdtSd7hbKcUkBQFAGj6ric9geLpaBKixLwWiwWstcgycmQct4F0IQnJLIPUYcyU1uCpS+7ThgZuq/Ua8/kc8/kV5vMrXM6vcHF5ibOzc7x48RLPnj/Hs2fP8Pz5c8znc6x5UKeUJiGmMzIwYUMScPuG9SJuZ1JMFbmH403j+11tKBwm2ALt90d3FGxS1iY2w3TLSZdMQssG/6oWAzSKIZ1tiGAtmPuS8Ke49tv3znFwezH3g9LbTFUB/R26Az77NwXd2f3qoYgp8UDymkiFcIxFvtFnwmmon4WHKQEorVhtV6jrBuuyQlmxayRhUoNXTCGym/5rbxwUmOtRHWEUdmwEIUtTKsGYg/ML1oiahpwGr9YrLJdLrFZLrFZrWsesKtR1haYhF1jkmJiPi+FPYQL9zCCpzE71pPVFzJjOyVIA4D15hMiLoP3RfXmBrtY9gQp/BqEULbaJxrYu1/DeI8syZBn5dVS7YuF5HrLWbWfCaE29WtHIX2mN9brEelVivVpjuVphsVxisVxhwd8vLi7x/MULPH78GE+ePMGLly8xv5rTdgBFm4Y979MkLYHqUASXF4febJFKe/zi893YDHMoTVN+uBUPe3VvdPt192qH6fKLeIG3n4AFVdOQIwGakRBHyOKWj1s47eftJn/NuKXK7YAUD+kJMc19Uu/MsdArewjDA8CZYg3pGHFzLru394S8Fyurrmus1sRMm8by1OSbDWLg162DW4ZHx1gmTksBHtY2qKoSa9YgFosF7QGsKlhLAkyO7pFN0MJQI2Ol+6QxpPFzBpJPRQH5Hj9p7UWL62QKQJ6T1mTF72MIlsS3gciwtoG2IPCaEzlk5Dpi/47higm1GXybfYqmKhO6YS3T02GWWZah5sNqZeqqqRusVissFgssl0uU6zXKdYnlcolXr17h6dOnePLFE7x8+RLLZTwklYwbaKo2LasC1z2fHG7Zk4u0UexrQ9dxcahAfN3wYZpbQ2kD7z3KqgpT7bK+q5QirQyeBxeiHUs8vNXF2luXdAppF7qdduuinWZyv+9mgjb3PpLQ2cBtxLkFQ1VOIx9HDMQQMa1WKywXS/IQAjobDVxx+1z7ojuivjUkgwfK3v55PBY8PJqmZg3EhFOdvXdYr9dYLJZYLJaBYda1eF4gl1f0Lgswa2Eb8r+YpgDIVFvqEYSEgQiFtH2og3CbsccHhDbkTdeeLALzLIc2htLdhcC49wB78PCcl8wY9upuaMoEgErW++hG8j0gVRUpfc/rMOm+STrrKwf4nD8bjuWJPjHFKfRyucLlBa1jLhYLXFxe4tmzZ/jkk0/wxRdfYLVaQmmNrCgCI6Z4iAFro8mSMstoawVrizeBtFX3XtqObxq6/GHo0tqQ5uZBAwRFlqtVXYetF9SmFGekc15OBa+psgu118VeAnN9A+teEIWa6hnfBOK5eSlu9raAmNVN4UEjyrDTvyYGrHm/DtHHERJKwYQYx9RHBjcR5frLpTwFOeuMOqp4Y1kuyYXTcrngqcYl1mtaM2uaOmyHaJqave7TXrQQLze+MG2xVm0xOgqx8U4XnrUyMZene0Bm6GBOgJh2KrRYfITf1wGlSwI4yzJMxmPkeU4tJWl5+SNpxU8pjQILP3qxHcrT9JbSZAAF3ugt2ihY4HvvwxE76/Wa1pNZY7u6usLl5SUuLi7w6tUrPHv2HK9evcJisexsb+EBgpiuaz6dm7ck3BRhOrGnGVvPep6/uSCe6pkeANKwxUikaRpUFe2Pda7NjWjQkqwly+DtNZW/VdVHkAtdUFdsx0kiSOTQbtyyocjNY4gQgXazivRyOnUl3hZoDhtixSXz8kCS1vXTayHlU8eEQpLvI+X1htCazLmrqsJyuQgawHJJ/hplupE+SzTsKUQ6eQqPWCwavfI0WBpGmENP8YcEG/hZ3HgMPgeL8i5aVQsbNw5EGKlrZJnBaESHe1L6RCDB8q31YsdKhaHkj3R8pgISNJSeZ6843WlbhP2VpOE5T+1VrknIrXiz+3w+x9nZGV68eIEXL17g/OyMLPa8i9aOcvKBVBBrpcdAoO2eZmz117R+5Puu67WhnWgYYACBJmR6MQo2MiARS+yU9lTYr8iGQa8Zt5lin2ALd7b0ZUGPoQih795hoBiOM4hIBdo1IFzRK3gvXkIqNE0NANBh8ymBLLq6aXV/f/mQEcwxhh/HhAdCp1yvVjzdSNaMJMDEi75YMpLxhzDBMNUiZuUdQScMIb0rgo5oZbM+2veYESfPZD3LaNqzRXuA+iWYD38OBBsqCQMzbCpPJtkyK0KnJlN4btmwAch3EpYBqTBFFs5ByJBjZs9ThTS6p+r0nrzekKyMa5J00CpNCZOAWwfN7eLiAi9evMDTp09xdnaG9XoNyAyH4mNYuM6891yO61RUP7bRuQg3EX7p723/Xg+66aROjZNnNCPOgwQP21jU7GQg9A1xDMD9g+i6G/+vPob4/eadTeghkpPuM/S8H1LBTFhbcrDN9JkQ42oXMM3ZUA7ju/RUpkmAurGoG4vGOpBDfWIGwgi8vH5spHHKnPgNEJl0ty6uc23eobvXATGzJRshhOnFukZTN2FtJ2gNooAE91Dc5sxsNRSUMoDXANgijB35eli6PBmlBC0EzOTbVMTWeAbKsxATolAAjAK0gteKvHEk62liZeiVh1M8gcwm9ZHKPJTszRNBwQwn+BVVgDKaiqIA8NpuOC1AaWiv2EMAXbEdUvs5B+U9tHcwHjBQyJRmF1tRYFt4WO9BokUF03yA+kFV054/oUWZsgRbOtJaZ4myrFCuK6yWa1xdLXB2do4nXzzBq1evsFqR9SaZ/PPUo6GLBopx8BBxHEobwusTVvtA8pJSI/0WWgZ4kAEZcHD/Vor4lbWwzsNDQWnaK6i0oX7RsjDt1qvULX2Pm6PbPWP42hccnvMcroPiwEb6ke/35WmYbtSrs8uBp30ZGgga0FbL+mLYC9yo7fflV9JQSRhikvSeZm/jNkwfydoOnXPk2C+jPPMd6asUMdXd5WWiHArGI8aN728YPGsmwbqKy6VC50Iw3DDaEFMPU4C0NqS15v1mNG1Vlms0bOQhWlmTCrOQcvpVfnfrScE7De8VtHHQGXtacOw3UWkor8k8PzSsB22cEkVPwUHDew0NB1qmd7AKsFoYDIgxKwXlaJraOUvl539OnCh7wPCo0HvAyhQfPLShOlFaobak+dA+vbhe6z0A3k4A70Aim0ruPZ28TnlyABy8tySmPJ+YDACenOVCGUAZOK/ROKBsLObLFb73/e9jdnoH/+pf/ktcnp3h/p07ODk9wWg0omNuMjL4UCTP40DJUybIepW2vWRZjjzLaD9dbnA6mwLwmE6nePjWI7z16C0UxYg0NKYN54imqGLj8UsQn6lMB7KWNIStfeyW0E0zDiK3Y7gYbYYsU8yC+JSn1XngS+vGctZejswYeq6I6RNPcex+pmsVTGua0haet6tsgJuoBR/+bIWE6KsdysruOCLiQJRebb+b3huu5671Ywu+59oPkrHrIgo0iakbG4+uwyeAsFGU2ZUjggAUGmtRVjXKqgbxIzFJjqNI+S0RyghqJ4aCdYTYmyrQBEGgaZnGih4lpIzSsaXjGE2nLCsAVVlitVxgvVqhaXh6t4oHdtrEC4gMRxW4N4U67Gtr8IZeQ5qWF4p2AIjRI13LiS+FK2pSoPg9Owzmdzw8vAKcAqyns8Ucm1U7thC0loxYnCcG4r2FdxbaWRg4GN+g0B4jo5ApwNsGTd3QHjieMoJWJBhFRCpAGd48K8X2COIt0mhKR1IW0gyVB5TzgKM6lbZxSZmkdpxXwZ0WESgPQlkww/P0aFijUXAsrJuajBfKssJqtcbl5RzLxYI0t1dnePrsGc7OzlFVNfVfNrjynrcZKA3LexODAAt0sB2KOtNrxc3SFDpOr+2I1Bv1caED54G6cSirGlXdgHqOBjwN9JRiQZfQPMUkwi3xhcplS/917xyC/Up3W0jLG68tQu1QHKtoEs+2+HguJ/mkfT+0kZqCUCPKNEpd18RUE/JJEVLbc0Q2CM7WocTxZSOs9QiZBwHmwqhSJ9sdjNY0ry/7/Hgj74pP+yVPCenaWdsIZN+RL7hKtSLNSnkH7Ry08zBeQRPXhnck5uQiocEiRDn+ZG1HOTgoWNbXlAeUdzDO0uUbaGehvYUWputp5K69R+YdCjQY+QqFW2Nsl5i5JaZugYldYtysUDQlsqaCaSyMdTDOI/eA4feNtzBooGEBRXmy2qExDo12aBQ4jwoOCk4ZOGSwyPjTwKoMVhlYZeCUhkumtGgq1EF5y9+7tSqSjMJzjcXHYbzBDpKtRc3m/+t1iavFAsvVmjdvX+D5s+d49vwZzi8usFqTF3oyepDkotAN6VDFbmgtfVDUqV4rvow0A4S9gbVea4NVZMPeR2jwIBmkF7qCSfqyWFf+XcARSsm1jzjwux44HmqF7sMBxAZVvLjqPeC5scVTuWzk3Ym9000gxQ/ZP3y082aA89ziN+wRJBFqJNDI/59zDuV6jdVyifWKNo6KebhoaEFLS5zjhhRZiO6EApQSzYQFmvMwXkN7DTiFZDkLTnk4BRJqytH6Fws0qAYejoSFN/C0YAblZI2KBJv2Df3WChkvzGsAmfLQrsEIFiNfY+TWGDUL5OUFivUZ8vISRbOkZ94isxa6aaAaynfmPIxzMN5BewuFhoSatrDaotYWjXawysMqBacULDQJMRg45LDISKCBhJpTmsOwVsZTh3AWyjVQTsQdadmhnyC2tzSLkw3uPP0l74hgk+nkqqqwLksslyvM51c4v7jEq1dneP7iJc7Oz7FarcPAUtY7RWNV4Kkz7m9kBLEhdTcQhMw+15Fwa4JNmOW2uD0b34hHf0cu5chJRAMPBGvJwHcUacUSsZcqYW2tL0Ea1HXv/uriBkKNK0hx+2zW1cGgdt4VUZdy6VOmSZxzUIo6acVm+97Rhus+7YBiur4oiu9eN4YvHwrE1YQZhilClQo5MR+m6SnrbPAIcnV1hXVJHY2mqUqy2LK0BjTMsCgNJVMjgxf3Os1xidYERYYVPKXmPWsqinsq/WJdRyZ1PAlIpD1Z4mRtAuASA5nWyLVG7j1y12DkaoybJSbNEtN6jml1jmn5Cv7lx9Dnn2G0fIZZdY4TO8fMLTBxSxR2BWNXQL2C9g2UJ/EDROHiQVOD0YLKAyq1GJGwUgoNx549nFI8zShTjQ5wjoSZI+GWGtIEeGp3aR4fNlRH7RwgASSkTa94QGk4D1R1jeVKzP/XODs75z1tZ6jZzVaSRPBVSEsFbDUZnu5Gt78N/TsmDomvj8f0ocV3Bt+RQSAdK6R432dVV1iXNHB0ZO1GAwjxSsP/6FWOo9v2WzCUmzcP/Tm9gVAbjHN/RL7DjPV6owYPNoPm9SBryXPFer2Gs2xIwFORW3FgukPYZMo3ragboCcv3QuKum0wjlHsF1PT8SFapi6YudUVTTem1o1VVaKuKj4GJfTaMOBJL26x0GF3XcSmLbxmts3TaQoaSrHXeMg6YDKNygYQYYVKxUvW44LAU+D3yaLMgy33nAdsA2NrFK7C2K5wBxVOmznGqxfQrz5F9fgD6JcfA89/ATz/Bcz5J5isn2PanGPcnKNoLpHbJUaqhvY1aGKRKonS4HW+cJExBXwTwsolzMmDvrL9Z1hD8z4an8A7KMsCTupaGFyL0clv8uEomhyTDwsivpRi4wVaM3OeLCzrhk63WLD5/9n5GZ49f05ntznS0sD1KfQk9CdbGm7MTxJ0abzvYmI8OkLUB0Tfm5/EkwhAbav4Xt00WK6WWJcl1y13OSXbMygK2dZBxjtp5Ju4Du/9srCtfm8m1Ibj3QnFgowuZqrdQIeACdXxht+yrOAcRep4TnpjpCrvJWlfKw+xINeM4PawT3YUYmegfTB0Ga2RmSzs3XLO8fTiCqvVms46Y+/50QtIrGfpWMREUkKMI9C9LuXheN1JTAQ9CzWjMzqygxkjucqiS0OYMGDCYrkwnVTIRaZCwpAEpFEKuVbIvcUYDU5Vg1Nf4qRZQJ0/gX3+CfyLT2DOP8dJ9RKz9XNkl5+jef5LrL/4EO7sU4zqM5yoNWa6RGZXML6CRgPFntYVe7WHV7TVwGvuG7yi5umCj8JNBJBQM9USM65k+tE7EmhkHZXWaYIkLg+yKg2MH6mgSQWqJ4MFD9bYPKqmQc3725arFS4uLvHy5Ss8ffYcl/M5msbCsLcWn1jjBQEDUMO+xj6k5M/R06NIQ/yHQFEdSJ8MAj99LFs2nEPd0LmDlv2kekmZaR3ggY5MSXfbvw97BHkTIHUUCspIzK4OwXXeGYJU/m7q6rI78HhX3rXOo24a1DV5cadFVFpro2PUKP7QZn2DQ4584/4QFBFR+u9XEVHocDt4IhjpUNbRUfTrFflnrKqSvegn1o3ihaNl4RjrM15cS/x81+XhYeHgtIfT4HUmD68VVGagM0P+BhVtTs0U7dvKoGGQwSCDUnRBZ7TmICqcVmEdggSagoFHAYuRrzBxS5z6Je75JU6qc5iLL+BefAL/8jOYy2co1hcY1wtM7AoTt8bELlCsX0FdfgH38mPg1SfIr77AtHqFE7/AxK0wciUyV8N4S/qg99COtgfQ5fiy0Gh4fY+MV+gdNmIRTZONQVSwBOX1S1mLEYIXweY9a3IsBBMuFgWavJMyRflOU/20dwpcf2Rx3FiLqqZzwq4WV3j58iXOzs6wWCzQNA3A22uceMkI1JD+fX0I6d1KstctTbLNqCXQYn8kwzgFx+c/klGWDduVAKHr2JOCvn+9TL2x6BbnGpoaRaH6BMLBSAXaEGKDBM7Ll9zzAAm0mkxerXOhQWl9JY6+mc1y/tvpxubfH904NnBohF8SImOjER0ZC9Do31qLuqJjYsr1GnVVohGBxkY4op1578n0nYUbea0IqsC1qkOEmjWAMwpWK1gFeK2heKOvNorOE2OtzEDB8D+NDFpltFlVGUAbQEzXtaYraHdg+0Kybpw0S0ybOYrlC6hXn8E++wjN049QXD3HrL7CqV/jVFWYocJM1ThVJe5ihVN7iWL5FOrsE/hXn0BffoGiPMPYLlC4EpknoUYGKqSxaa+gnacrFWhsJUnCzZKRCVjAeQsdtjew7adMNUnVszEMV2YQZHLAaHgQPukZGZuIQOsIP00aGvkm5C0L3Bed92isQ1lWWKyWOLs4x6uzM1xezlGVVRCmLBF7KOIozGVv3K5gG8LuxDz3J6rhmE+l6PRxzW1AHpJq1E1DTiW8DzwynZZPmfavm2BL6WhPoSYvSKV2nx+CGNdugUaIXYl/S0cFfXo+xr6s2MqR553FGajW7IpITFp702UusJHaDZBocW864micRvjW0V4tMSUu+agYy7+bhrZJpBuqPasF4WDQ1jExwmUpPaaAzu/+izLIn4pGsQ5k3aiMCgJNifIFBQ0NDQMN9rygMnht4sUCTkHBeI/CW4xcjYlbY+qWOLFznDYXOLXnUGef4urTn2D+yU+Ai6cYN1c4MRYTbZH5GrnyGBc5CqORw6GAxVQ53NUOp26NYnkG9+IzVF/8EpP1GU7qS8wsm/+7FQu5CtrXZA3JPkCoPql2UpsWeNLuIGNvtgqF7zpgVrw3LY2jqx1Lu9Antb9Y3JH1qwxYQNEAio610ZpM9i07PqBTs8lridwHFNarEq9e0RrbxeUlnAe0zgD2TE8Mt5PEa+4zt5deOr2a3G0R9zCCHYBSYVBh+PTxsKwCkGsz8dbjk1ZWvKzA9gZ7JRrQppTD3hXc5N0+9OcnVrGCenU2j5xmEO2R082yJ9MMdInmtAnubtyhWlOJLKwEznssV2u+n3ZqQUyj1UGHoECaXff+m4gejTNF8OiwC4pMhj2SdQ4PsrRakdFNzXP3TVOjrirUPO0IMfcPOWGGnLaA4kQ6IOstmjakzi9h4nSXUw4uI1N9Zdn8HhrTyRQnJye01leVvIZE7j1IA+LpFk26TKU8angACq5uaJoSDtrW0M0KhS0xQY2xXyOvl1Crc8yffQa/OAfKK2TNCiM4FMrD+AZwli0Lqc6M0VBga0MFWAd4ZdBkI1R6hKUeo8xPoO+8DZw+RF3cwQo5VshRIkMDhQaKvYmQHqXlFGkPmrJzZBACXitu2EAKlDKcV6jKBufnc/zG936IO6f38K/+5b/CYrnA/ft3cXp6iqLI+agYOpQ0NouHZm1L+kmQq9wW9JXeCYNF1gLG40nwVJLlOYxWKMs1jNYo8hzj8QinJzO88/bbuH/vLrIsg3UNvHXQRsM5SzSk2UAHpBGChWuf13/K2z4EvhtRe7wJUhqOaPOddt/YB5sxMtLBiLfI8wKj8Qh5ltOAJxGoirdXyHsbcTIpcIybORRC2BOtkHu9y/wjBNsefqjt2UXDbkhTbVTEQZAOJOxvGztmcKcTBke3WKXmI9Grqg6doJ3T6+f4em+9ZuwQaIdA8YCBToKmzm0traOV5Ro1nwguDoid56lFQRBi0kbtixPpvRdB2nufAFSeZ9bEFZaiM7zyPENRZChyg3GR81WgyApkJkeej5BlBaANtMmQFTm01ijyAgYGqm6gqxLjpsSpLzGpLoCzz7H8/Ke4/PhvoC8+w2j1DNP6HDO3wNgtYZoF0KygXAWtPYoiQ14UqKoGTW1hlEYBhTE8xq7GqF5j1ixx35c4refILp7AvfgU/vwxRtUlTnSJmWkw0jUMasCxB3woOAc0jUPdOPKVIB5zeM0TorXxJbVGTI5kfGKc36pP0f6ol7SZXBhf8E1hcvRJA0uZfqQ9bI6PDnLwPB2Z5wWm0xPkeQEPOl1+sVzh1dkZLuZXqJoG2mTQWcZ9W9bzqM8TjVHuxfVdF5t3rg9J9zbQk/WDMMilucN4ANpkcN6jLMn5AWR9lK+dm9xbMp3aIf47HB0S2gNxxmBLiQMU+it2c+izgc2XrgOpmL4K6v4WhEqREZqnu9rQdAUtStNccndcMVglaU0PXW86OJ+bNdmDwYpog9w/EY1451DXFco1+XCsqwp13XF5xVpxrDL6S8x0z0RBZRDKGIJizyGZUzCOtm9pr2gPmTEoMoNRkWNU5BiPRsiyDCbPYIoCJjdQGsgMUBiPkbaY6gZTX2FmV7hjl7jnlrjbXCG/eILmyS+wfvxzNC8+AeYvoNcXMM0SmSthfA3lK8BVUL6C1g3yzGJUAKNco6lKXM3nWK7WgM6gTU7+Jp2DdhYFakzdGuPqAvnVc5izx9Dnj1HMX2BSXmBarzC1FUbOInce2vGUIU8n8Uoab8I2IDOTZJ04EXDUDum0MMUTtu/1oHU78BZhNEkISYOnl2mwQ9PS1oq3Cw2T5ZhOpxhPpzBZzvvaLC7nC7x6dY751QJ143hNU/aR0iUWocGij2cCNjtr33V97NWnrgVZbiF40LpWeu3CQLMBoBkZpWlgKpvjraXpX9HWhAy2YmeAm2CPQh4BW4RaJBBpDBndHXalbCtZG+hgsLhhpJEsdvIcsgg058hxcXoNQXKz698bh6TPHiOP7foixqdZA3bOYb1cYbFYoCrpJOqmqUnA1TVsQz4NJQLKTXuU1R1k9EKRttG35gDE5xpADo3ca3KNxbSVaY3MsGAzBkWWkdNdY2BYsCmjAeVgMiA3DrlqMEaDiV3j1K5xaleYlZcw509QPv451p99CPviExSrVzhVKxT1AlmzhHEllK+gfA2jGmTaUXy5Q2YcjPKwdY35/Apn55dYlzUar+DZRF87i6wpMbJLnNgFTupLTFYvoF59DvviU+DsKfLlBcZNiYl3KHhjuYaG1hmUzkCmIyp4EGkcWKDRWonyYNWM1zXZGwyty/RMN3WRrIvKb4g85HvUxCwww9opr73WDRpe1/GePP7nxQiTyRSj8Rg6y+EArMoKZxeXODu/wNVyiaZxtPeNB69i6LAhyILQ24V9wmzBDV8fRiLYetK4iWBTvMYm/a6W89jY4IsGGntyjQ0efrMLxMYZ+7bhfqCY2vH1CDUhoKDZ0t2h2twDmwm3Wao01WZRmV3ytIphi5+6rlGuy7ijnsO2Y/t1w7EFbpyygqfYtabprLqusOSTqWnER4wquL5KjENCbhKBtm8LKCb29ArPeJ1NPFBk2iBnjwnivNfwb6M1Mv7unYfJc2Q5ecnXmjS03JWYuDVO3QonzQXu+0vc9xcYLZ5g/fn7ePHhX2Lx+EOY5UtM/RpjX0LXK9bOGsA1UI68ReZGYZQbjHKFXLO7K98AnrSW+WKJL569wPnVChU0YDJ4peGshXENMrvG2K0xsytMqznw6gvYZ59Bnz3FdHGO03qJO77CzJcYuwojX6NgM36icppStM7BK178l4U2TwIoaFGOjubZ3s820da26TvdS757DyRGJTI9LYZEzrog2GYnJ5idnEBrg7ppsFqvcXZxiZevzrFcreDZmTLA62kefPoDGfNQ9iVPwhilJOnvfUq3HQq3Nw0JRELv6y379JzNMDQwjJaoVI8lH8LbNNF4brhgaW66uboZUsEWxyXHaStwvCl6hNrR0toDmxXXTZrmgjkkn1q9WpWo6ho0oCMLLE+Bw+XDKkH3+hXEviOsFKzlpPDMjMJ0lEARA3HWoSzXWK9XwV+mWDlaa2lfTLB0FAJlLW0jg90OMnBxs1BWeSM0T6VoTVPNWWbYmwUZ75BFHrk+04ruG2VglMFoPEGWFzB5DpNnyLTDrFA4MQ3uYI2HWOItLDBdfoHlJ/8BZz/7M6we/y2m9Ss8KhrczRuMVQXjKihXwygynjBKpjs1xnmGcW5QGAUDEmij3JDTZU1CbFE1+OLlGV7OF1hZD6szOABNXQF1CVOtMKqXOHVrPNIW95sFxvMXMC8fIzt/gunqDCfNFabNAnl9BVMvMVIWGTt2Bjy0yZimmVk57itONCnS1MgKkSBCMfQIaYq01Vh4eBn5s2YmAYJAC5aRtGlbhHpV11iXJfuGXAJQmExnuHP3Hu7eu4/JdAavFNZlhfOLSzx5+gzL1ZJP1iBtxsPTEI4d9grNvS4oFhSbdH3LOGAqMr0cz7R4Xkcly1RPJ8vXdVgD3V2PWx8eD3uU8broF2pHS7M9j9zGcOWlrzh2qwMo1HWN1YrMyonoZORBlwiyfmHGsQqh7rreIByUnZB/eksW9mlaYqDOPa2jVXxSdbkuw0nU5M8x8TEnciikwbGLsOR0+/IsDLV9L47ehKGJ9mWMQWYMezVh10qSIp+4bHQMo7WhzacsGHWmkBnAuBKnmcMdVaKYP8fy05/g6d/+CVaP/wbZ1ec4aV5h5i4wcVcY+xUKX8KgJi/6yiEzCkWmaYpTG2QADMgBsnZs7egsjZYBNA5ooLFuPM6XJV6cz3E2v0LV0NE7xjvkvkHRrDGqrjBrrnCX1/Wmy5fQLz+HOvsc2fwZRuU5pm6FqapRoKYTBOBYmFPFeSSaGsm7MDVonYX1cjoF1X+3bVq/RaCFtopTWul3oS623iHB52hTdVOTl4uyKtFYEqpKaRTFCKPxBNPZCUaTCaz3WKzWWK7WuLi4xHq9gudpS9H84GmgA1n37aGh28TBWtsww2uB+Fcch1NH4H5AAQ5LF7EjiQADz3Kla2zSuvS3py4VPblNHFqsfRDXYzeE2jGTE4G22Trya/NJGx4II0TnLMqqQlWVQDAh507YFwnfi1053o4TecP/3hhcIyutEkgFdCsigfce63KNcr2mY2PY3VUwAkj2m1EnbLuckjgEXQ1xG1rtocBrK2Qen/EaWZ5nyPIcOjOAMfC8qZ5OABbflGRarrVmt1kaWgG59phoB7W8wOLzj/Dqw7/B5Uc/RfXqY2D1FLm9wEgtUagS2q/JAAQ1DB/yUiiHsQImWmGigAJ0QoBqPGAVnDOwzmDdKKysQuUMKmdQWw2PHFUFXF2VuDhfYjFfo6kclFfIAGS+gWlWKNwSU1xh6i4wta8wrV8gnz9GfvkYo9ULzOpLTO0CebNAZlfkjUROvwavXYCn6MDamqfRe1xT2xcsuFiZj82ajvBjn6M1NXajzGk17C6rqpuw7k0nbAPFaITTu3cxm91BntOholVV4+LyEpfzOcqqDHTqXHT9lObpdeMQfqDCnx0IAduXAnWqQ/lQCMv9kwahAJSCtcQ766aOg5bt6tprxP5l3BeJUKPI1YEDk36kAq0fCtsZbYBSsA15tGjCOUJoxd3HRD3i4PVXFioh1n2wo86H4L3HcrEkz99seCPraKKBOedojYSn+0irkrSkEelTFqS7C8YbF+dWLvHVGDQwbZDxactZkSMrCujckPGHVlBGDrSUqSKFjNfTjNZQyiNTDhPtsHj2OV7+4qdYfPwh9MUXeJCXuFuscZKXmOY1JlmDUdagMA6jDBhloEM/FTDWHiPlSaBZB9U4oPGgpTaNxmqsamDtNEqnUVmF2mpAj+C8QV0rrFcNLi+XWMxXcLVD5oECDiPUmKDExC8wdRc49ed4YK5wUr3EdPUco8VzZMsXyNZnMNUljF2S/0j2Cala+42iQPNBKIkGvaujEaIISf6FKasoWKjpHbyztNfM0ZSwD+t5RD9lVaFijxdNY5FlOWazE5ycnmI2O0FejFDVNRZXV7i8uMBysYS1TdhcHPK/X/bfCJBg6t69XUgdyUka4I3tNNiIXoE2Zdn+tHFMqEBD8ut4aGlqPbLhQAiDke/D8NzwffPHwURZkUZW1hXKqgIA5EUB78kXoYeC0iak1Z6ApCs22utvuBvhUIHGnemwN6gzOEvHyNCiMluTiiALzIp8CsoU4aaWxvXL/TnUNpEEtXVv7lgAcoSyRqYVnRAg05BFUSAvcmRZzs6LZXM8M2FvAW+Dk2KtHIyi4zRdeYWzp59CV5f4yr0R3rqT4/4sw8M7Ezy6N8P9OxOczgqczEa4e2eCO6djnEwLTEYaReaQaUeuqDxpDpXXWCPHAmPM1QQXaoZ5fhfV6TtY5Kc4dxmqYoLa5CgdYI2Bz3Is6xovL+e4WpewSiEbFShGOYpcITcOI2MxySxOswb3TIl7/gqT9Qvoi8/hL75AXl1g5FbIfAW4mjyI8PE04Z9iRsbrLGwMSb1BNlZ3m4ChAD4hgHtUCBzbTd5VLEBprxpbWfLaWxCEPH0tLpzo5HAPQGEymeLO3buYTmewzqOsLS6vVrhcLLGuGnhFJzBABDWnnLb5cEm+bDCltypxM89J1wjXdUFbcmLHNMbA8/5BgJZqqqrmNpIOGb3NhNQ9EkHQyfOgteAeOR94tS3YbloLAKBg/uk//e//R4CZygCGn3SRrqFtf0vS8/InMd2XKQelDeZXV6Q98GDNedAhoEpGQxRPEtsGUkZ8bHjI0BXbRUoo35ZL86SD2kM8cV2l77cJg99nU16aLuQN1jy6V0qhaRpcXF6Qc2JLRiG0L62Gc3SoCSUnaTDDknKDOCA9pzompkZ51EpH02xmqhQhr50ZOoAzM6KV5cgyMsnPMrpn2EMFNG3gXa8rOGtx784ppuMxjPKAq/lQUICOa3HItMcEFfLyAvWrzzGuXuGuusI0a6B9xf4UPfmL1IDWHpoFItDAuxre1sg05dUrDatz2HyKpcpxiRwLM0Fz+g6+8vf+AF/7nT/A6N5DvJgv8MkXX5BmaTR0pgDlYG0DpYE7d04xO5liPMphMg1tFPJMIy9y5HkO7R0mmcbYeOQGyDMPnWn4LEOjMzTKoNZkHm+dg4OndS14QJOp/7IscXLnHpTJ8dFHHyHPMkzGY+RFEY6QIQ8o3IYsOGSAEkb0wSmy56Uz8S3JG/XhpdETwUbt67yn9mMvIzSNLFo0UbhhbXy9XqOxDlVj4bzCZDajujA8aOXBVZj2DlTOg6KU6gMt9vSxa1xQceA1dEl3o06RXpsIQcOXNgZlxxYoMY5Ljw7i/hdrCqjKCgqKpugTa0gauNJPw8cKdfNPdZBeXPb0ec8FbETVwkbYa0LyxZM3fHPgOhy73kpHjHL+D6VGHgkoh2J1R0wUQfdK44kYMA9J6e22sEug7aoRzuiuOFJsduWBS5GZPnkKkb1lZNFnrUW5XqPhUw3IETH7j2MmQpQer/iPflFeYvnkGX2PrRK8joO088AsFHmfoGNJSJAZ3muWmSjYxIGrknqS/Y8KfIiog1IunJNGO7kcMmVhfI1c1chRIcMKua6QG49M0absjIVKZhQyNi7JjIcxgDYK0B5WKzTKYK1yzH2GuZ7C3XkXJ9/6bXzld/9LZF/9PuzDb+Dt3/oxfvx//+/wo//q/4a1ybHwHqXSqI1BYzRKAKX3qLxHA7BjZTphQIH8OGa+wcSXmLklZn6JU7fAzC8xdksUbo3MV3xiNnvkB53uLUKdlC3yOuKCBxamhaQ1w3f+EdpRtDV+0LKQFAEn04KMONVFdENavpj40z5HMvOPbsXyPMd0MsHp6R1MZnfglMGqrHFxtcCrs3M01gPhYNoB50chD5HmI6UdB/vER4O27t1hKK7Xvut6kHKn9aB5Mo42souVbN3QmqcY4dHgOA4+reN+H6Pqv6T/7+B/6ZNuFN3rGBi0frxd+E5PIuYWGCLvuSirqtVxDsaOyj4GmLV2b7ex7bGiP9uC3ASataPomJa8PTjvUVcVn1hNjolpHS16odha9ymj695HnOMP8SRhZYSnNWtqQaClF62N0XcDoxUyreikGIjBCm3I90rDK8N7tgTkXYOOZOG9ZLDQ7PxXwUVuzdyEDg8FoAwcCjRqjFLPsFR3canu4iXu4IW6g6vJO8i+8kPc/d7v4d73fheTr3wXdvoQ62wGc+cdvPe938Hf+8P/Bt//8X+Jk3e/ibWZYF4r1KpA4xWs9zRgcA08X9ZaNNaicT5MngN0xhqxJzo8VHnypqK9hnK0QVt5Fb7T0TW8Eds6wMoBoUOgZzK6JxKRe/QnDFNa9+M7qcCL99lohPestS8SbFobFMUI0+kUd+/ewWQygVIK6/UaZ+fnuFpcoWkaIOkhYVCDxOLzDUEQbPte++Cg8DTIG4IC+et07FqwbuhMPOqLvM8T5GN0JzySTFG5t3GxvZULFf5cG1+SUCOI6upZEwNbNXoPmgar61b4Q7Gtkm8VHeIdzAc34MDToyBMD4hcYWHS1DXtYeGpxiZxgUXaMU1HDAu2oft9j4TzeT7KLBqDBAe4opnlOfIsR56zdxCZhtQaRtN+MSkSbekgj/vkBFiHdSMqMK2DkUCjdTE6c4zLB0fnRvN6nBym6byG9RlqP8baTzH3M1yqu1iM30Zz71sYfeO3cf8H/wD3fuP3kb33PSyKe1hmJyizE6z0FPXoLu59/Tfw+//1P8b3fve/wL33vgU/PkWFDDWvQxFpeHhL2otzFtZ5WA84HlmTEFPhNOwgzFiIKcfPXAxLXkgULbVZDy9m8Rttws3U1bxYiEm7B8G2cT++Q703/g7rbM6haeJex4r7tMzAgLdlFEWB09NTnJ6eYjQawVqLxWKB8/NzlGtxVC7r56RtkAAR7fM2exCj06eHIIPcff7tigtJfPxjZ3hgm2CjuLwHGkuWqY1tglADeHliswO30TOYkDzS52AGdkLJnxu065ck1FTcY+ZpT43sZVFGo7ENn1wt+yqGsP3pl4UN4h3A9qc3gQgRIg7SjOKIzPOmzLKqYPlQ1aZpYOXoCud42mp3/faFkE5B79P3NH1tyPjDZCTU4vQjC7eMn2UZ7VHj89Iyo2mTryBhauIDUYxRiEGn06dBrAYHv+07NIUHRULFqgy1LlDqKS7dGOXoPqZf+yG+8w/+a3zr9/8rTL/6XVST+1iqMapsBptP4Ysp6nyKpRph7nKYu+/gh//w/4o//H/8P/H93/tD1GaMZQPUnqZjwxlwGsi0gpFTpyVvnkqk4WHgYcL+uHjcjFg/KhCzoSajbk1WrB3H0ymEgUXViwUXqBWT3ySwqG09Cy2q40S4eR83fcs+ORZoclVVjbquwtYR5+iUhzzPMZvNMJlMkJkMTd3g/Jy8jTjnYDKDPM9TrneL/WcT7f58nFRDfMNSKKCd/hCE1ocFmwdN6XqPuH/N8QAWNPLV7DS7Fy1SinXhIf0xfX4IJK5Yw1SGw+v7SxJqBOeY/SlitB5AXRHxB2uenYhMK4AZ6GtB36LxDdCNa+gahtRFrBd6h71vaI01C7RazkPzxPzC4Z57CDNIB+F260M3m+QlhDW0TDZMk5DTvNE6CDtNAkyxUYPkXanIYBGs+VQ4Vy8w9iDUoghzfNymY5NbmZ4Er0sh6G4KFgYVCqzVGMWDr+DeN3+Ie9/+TeiHX8PcTHHuMlw6g6XnY2N0gVplqFSBUo9RZlMs1ARlcRd3vvpd/OY//L/gD/6b/xanj96FHk/hTQYPYvzwjg1USMAqxXnnk61lfVDDwfCn9o7dGUtZAbAIpFt0ErxtnYYckQoi0qy6Ak0GJe3PcDEDJMGWyMXEH6RtGtimIZ+QPBsgMwE2zArQGlxR5JhMxpjOphiNRwA81mWJi8sLLNjbiPC2sG6oxGgsGd+8BhDD5X54hDSJd+8fUX/asb9v8EOGdAuqK9LKKt4oXzdk7q81DTKpb7WvXQKmP9U9MdB+ffd2wfwztn6E2j4G2A9EYNsKvoHAqDWapiGzcksCrc28t1coEIMcoyStNtxyDabVDdvzbPDdvdAX8SZZ6WQjpoJC3dRYLhaoSvKdSVOOYm7Nmg1HQ9tduu1AkDuK/6Qh5Hsw7NAs0NhMPxMNjC3jjDFhqlGsIbWhd7XmE8WYeS2Xa8wXSzjv8eDBQxRFAYC2eJCbJQDwUK6Bcg15B6kWuHrxGH51iZGvaNqPBZ4CoJQnfc0DVhnUKkfpcyx8gfMmx3kzwovK4PHC4qOXc3z4+Dl+9vg5PvniGT578gyffvEUH3/+BJ9+/gSff/EEnz99jqfPX+Kjzx7j8ZOnePrsGc7OzmGrFXy9xOnIYJJ55L4GbBUEmfMKTvbqsZC1SsNpg8qMUWUTlGaCSo9Q6gLkiVJEGwk05xUa5zFfLDGdTqGUwWeffUYnGIzHKPKcfKiy1xbhdFGgMVhKiXAjWcfCDCS8qKb5JbJHimERaUdr3khfFCiKgts5C9PPho8QCnzae7LEZQMTrRSKUYE8y+Fb+/JiOkJ1kf9s9oXbAWe6rzsegOu8Slpe9+XkR8/X0JV5PlrWPiEGW9pwAJ8UKl6JHsXhNkFPhp+3IPy/e/8G+NKEmvetGoYHsC5pxACwt4jkeRiZbLl2q+f7gyp6978NdPKyEY6/9r57EKTgghZHCt+0UnwmlYLzDqvVEsvVElVNU4+NJaFGpthRoMloTj4BYljyXVIOOVC+VSbRsEio0b4zpVUw3c+znIUb+XYUAxGTsYcQ1s4kDzTtqLBYLjG/uoJzDg8fPsBoRF4pHLv1UuyUGa4BvEXmG6hmjcuXz9CsFzAgJ8Ck82Rkoq9zNKpAqXLUeoxST7BSI1z5MeYY48JmeFUDL1YNXl6t8HJ+hYurK1xdzbGYz3E1n2M+v8Tiao7Ly0vMLy9wdXWFy8s5zi/o92JxhbpcIVceuXbIeGM4+bkkAe6UAbQJZfAKqLVBYzJU2RjrfIrSjLE2I6zVCA0MH4CqAF5PdFCoHTBfLDGeTgGt8dnnn2E0yjGdjJAnQk0rOoCTBFpXCLCQawk0Ii3P56mFN7iveN7oS3HR0FuB2jMzGfKctixkeZ4INdHI48BHsb/XhreXKABFUbAhSaTHFsIgkf4mubtVSIob/fw66HtdunnfsyTt7l35GwYK8qQ1fU/d3Tl2qmA0jNkxedeJbxPU7hSIQm5riTgg2RJrEtc+2FGCWwTXuGcTUtEaPLglkgLL+tuuf1869hSsu55fH36DhGQU5j35dlyt1qjKkqaCXBNM+OPIrPM3EWjD2HwWBRILRmFYOm6oznhNjaYdqUMZbUjDY1Nj5mJcuTzdGCw5WTOQ6TOeavRh87GCVRqNyli7mWCpZ1ipGdZqhgpTrNUUSzXDUk+x0FNcmQkWZoqFmWBhxijzCV2mQKkzVErDcx6NUsjgkXlyqWUUGaU4a1E3Ft5kqKCxcgrzRuGsdFjqERZqjJUeo86ncMUM1oxgdQ7ojA4B1RpWAY1SsJpO/HbB5pumS+VikcSbroPrR9rD5j0a0D62zRZCYP2xaYV+Ohpa1M9CsJCuhE/f8bR9RLyMWGtRN3VYWrBsBWktuc8it1o14GltbTqd4vT0FLPZDFmWo6xqLK6WdBiwMMAewdbnyOFouM24GYoYyMa9w/mFtCN2ZlyB+KvjqeqGT7KXp33Yr56pLJt6tYDbcQ+o9p+doNM2dwaWMLsugVRo7CTpMw869E+YVNNYrFZrQNGmQBqpxXWCXwmEkeIW8Ij2eOir3xTkHkdrOiOtLMtw2KesnznHXtx7ouiOiHuCDINJIgo2sroMAouFnDGJ4QgLC7nS/YueIgMgAlY0Sx/Xzvi+wCmFBobXuSZY56dYFfewzO/jKruPy+wBLs0DXGQPcJ49wEX+EBf5A1xk93CZ3cVVdoorRVN+tpgCxQSqGAN5HnxQSlm9t3ANefnIDG3gdraG0iRYSw+UyLBEgaWeYJ2dYp3fxTI7wVxNsNBTrLIpqmyKMptiZaZYmQnWZoLSjFHpApXK0KgMVvHKWlj3YOaR5kf2jMl+w7T1ZC1MfmyDVLFnoZWEDwIsVDuzMImfg3rnyNUdr6uJYVJ6eS8nmecoRiNMphOc3rmDyXQK5z2uFgvW0H1c4wmWrm303bsp+gTObWAonaH7AVLxPZCBJZBMG0sbKRU2uDd8KkfbPC8m2op9W16AELrNQpgp8Mv0rC+iNBxdMWg7jj6o87N5f020ECtlFxxPUVE2iOBpsK0BXhh3HihGYzTOoSwrlGs6fHJzypEMSNCt0NeALkMfhDq2mIrMAKC260vBMdNQmp463lCtjWb3ODTiyoyBdw7L5RLzq0uslisysWanxaTlkGCTtBUVi9Ff80JqQYmCly98XwQZTz9l5E2CzPVp6tEY8iQiRiFB4CXxgHPgvYfSCs+fv8Dnjx+jrmr85g9/iNlkCudqNHUFrzyMMbTobWto5VD4Gn55gSe//AD3RxpfvX8CVCVGCvC2QgMLbzxgDFSWwWuNhh0Sr22Gqwr4yS8+wxdnc6yRwRQjcs7rgQyA9p58FWbkXNk6D+cAkxW83gUYT/vk8maFvLrECda4p0vcVSsUzRK5W2OsHNcFt6dtaJ0vy2E1bfaeZ6dYFvcx16e4VKdo1IhPwc4orFOw0Kisx5PnL3Hn7l0orfEf/uIvcPdkhof372E6naBgry2yphjt/TsMz7PGy1ONssE6CrM4bUl9VVxzES2oYNWaYzyZ4OTkBHfv3cPpnTsYjcYYFQXGkzEmkzGKPENREF1oRaeFr1YLvHj+HJeXl4BzuHv3Lr759a8jzzPaxO0sGRzxoE1UTuccbZoPper0qTcEh+ZrOHz3ZuShAD2WO1RFSXsr0aWkHencypOTE74lNEEW6rQWS1Pk5Myhm7YgpSkZnEqU6Tspb+uPq53n4XsC88/+2f9Aa2pbIUKNOdjgtRleaRpRqVA8FnBao7E87WgtjSDkHeGUIhFfJzjpPkHSh72F377oae++vHiANwxTHqiquL6Z9hWvSzVNg3W5xpoHD54dnDqZIuK1EAG1UZraJqiaUqFGL0h9SF5EsIVpRjHXN6SVZby+I5q7CEMRbFJ0Kq/BcrnE1fwKzlq89egRijyD56NfIP41Eg/l3jlAafzHv/5PuFysce+tr+Ctr30b2f13kE3vQ50+gDp9BJw+BE4ewk0eAJMHMLNHGN17B+O7byM/eQCrcyyqBmVt4UCnBEjmKG90kZUmoOBRNzW0Jk3Fw2M2neAb3/gG3vvK1/D2O2/j7oOHmN19gNHsDorTe8imd6FGJ2jMGK44QanHWKkCpS6wNlOszQwrPUWpJ6j0BE7ncF7Tehq3uRi8LJZLjIocCh5PvvgC41GBSTAUobonUUXtLu2dMgv6yqFYyPVpagSuC9HcEkZGGrmhQY2sqWkTLF4zzg/RQephiPar2rohH4YeKEY5RqMRCWVFm8xJd2OaU8Q3WmtHbyx2aF8dhD7RBwUenEiApPMM8bONW9y6HuEMQyA6yab65SUBCNFEepA4WuBsKB72tjrLRgbS+/SsG/s+2FuoUToJoxm6QodPiEymE/meNgaNc6hq2htFI8DkHc37bF6nUIv12E8AA5DOd1TskRelaGG+JQToAUBVzoYANO24Xq9RVWWyD40vGXGncYc0kpsdUBZTocb3RaiJtSNramLlmK6fiUcRKYMYCWimmZSkybWWxnK1xHw+h7MN3nr0Fgk1T97iJWee6SYKSo2/+duf4vHTF1hWFiqf4M6Dt6AmJ7D5BHU+RmMmaMwI1ozhzATeTIBsApgRxrNTFJMZnDJYrFZYVyVt9tZkmeiNgYWCZwe8wvy9t3C2QZYZ3Lt3D9/4xtfx1a99FQ/feoS79x9gdvceJqf3MLn/FsZ3HyG/8xayO28hv/sOpg+/hvzeuzB3HsGN7mDuR5i7EUpzgtrMUOspHDLenqDJSS0zDOc8lldLjIoMcA7Pnn6BcSEaURRqUVNDUtcilHxgckIdIQTdbAk4aXeZ6aTfdI/WV5kOtEGe5cEVGlnAEj3Qxnx2Zi3LE57PaGNrSEBhOpmiGI2gxbKXDymNexjbfKM7QHpTwD3loHwN8YPYAdMfyff0+WBdSFgKoGVdm+9TX44vauZBg0Xo7vjfbzGujWSw3QJv6WiVh6/9hJoIs/6sJ2BmJMGIswLgkR5oLU1pjbKqUTVN8PUYYuaK9CDXTjrpHLeCED0JhkGiGcDRhdqeeVGKmRgLryBM+A8xBponX62WYYrXWjJkkClHYgoSaesjuo3qAVVbR6jxiAw8Olc8pah5mpGsG8lAhPbD0P60tlFJHAiB6YYpB0prLJZLXM3niaaWt4VazDwUG6Z4leGXH3+KTz5/isfPXuH55QLZ9BTZyR340QyVHmGNHHQM5wg1cjQuQ201qsbDZAUms1NMpjPU1uJquULtLJzSQJbBKwPrFaAyALRHyzuLzGiMRzkePXyIb3zjm/jGN7+J0XQGnY+g8wK6mECPTlCc3oOZ3YOaPUB25xGmD7+K6aOvI7/7Dvz4DhbW4Nm8waXNYLMZmmyGGiM0Xnz6sVssT7XvrMdysUCeZYCzePb0KUbjMSbjCZ10wNslSPgHUQXFkyNU7yK8ogEISzKQOBPhJ9XNMwT8PDSEB4/uEdpQ3KCRxi5Cjekg2fohNOK9R1VXKPmA4OlsivF4BGM0nLNQ7ISXBnf9NBv6E9PrwdctgaIekgoD6Aub3lNoCfXwUMY9aWDh1+HiZ56smcW4SyfaM70nX7i+W0VI5jv5Z0xgH1Cc/S1J94ee4TasH9OpAyJ8yoJiggXPeZMVVLrZl5kQS38Rgtsyf2MwE94uPl4v9sqLIiZCnZioiQQBM5/AUzzquiIDkYZOr3Y9B39SyM35+qFBEqHTEROBlv4WwaZ0NBmmEbvsRYvRUJ+SG5F2Irq2VMzCuLN6AHVDbn8UwPvvPKANkBXQowlKb/DzTx/jn/9//lf85d++j7PlGj4bwescVuVYNw7r2qKyHo33cFAoazoL7N6du/i93/kRfvMHP8B4NA5bIaz35HdSZzAmh9YaTVOjyDP81m/+AH//7/8Y3/r2t2i9ziusGofL0uGyVliqEc5qg3Nb4BJjXOkZFtkpztwIj68sfvr5K/z1R1/g01dXqFSBWuWonELtaF+b58K3moobzjmLxjZh/yG1cSqM+Lvc8PInxtaq/Y52FtqI35N+K4IttJVoW3WNkqfBq6qkTdlWNmE3bI1Lx9jIckRRFJhMJxiPJ9DGoKorXF1dYbVaw8vp5yYLsztED8M9KPb3w/7dJhTna18o6lxttJttADJoTPkH10k6oASdxVbVDWr2vWnYmERIRfUMH4Ii1s3bXpAC8OyADyOkg3F8oZYwWi/udFh1VYr2SokPOGGqNBqneXDF00eeRwq7Gnv70x6kGsG2t9NwW67Xhh5BtiERkrDwHnVdtzQ0qVdrydGs3AtakRBVQkzyzqFIO4rWtNFXpiKDkBMNU+pSqaRnJmmycFP8Pe2ICBaA5Nw4z+m4FxX2uVF95HkOkxfQRYFiNsO6afAv//W/xr/6X/81PvnkUyil0dQ1Wwt6WG/ROAuvaMagqSvU6xVgG/zGd76DP/jxj/HeO++iKte8FUWhsQ7L1RpKaXz/N76P//If/SN85b33oBSwLuloFafIBVejM1Qqwwo5qmyCpR6hLk5QFSd4clXj//dX7+OP/uw/4j98+AmeX1VozBg2GwPZCMrkUEqMqsSDCtWZ9CUPBFP6eCRMfN7HMERgET+JYaj9OTw/o+fxvS4Pkjikj3geTFUV+RwtywpVXQXrR8vCLdS/s3worUZejDCZTjGeTAClcLVYYLla0jpb2NcW6fR1dssvC5H+03vtbrMfOIIwl8c/vdBPPLVcaG0bT7jODKMg0FB/1Hvj6EINSOpGOof89LQXQvyNUdAoXEIj8Sv7Co39QhF2huW23RnudUDorEcLAohhp/eJzxBVWGdpykYO/kzX0tiLQB8TiM3VpqwhIu6DtKMIFp1oaanpvgxihAJieaTTSJrRQitmlSqG7pCnfiT+RCk+NhrgmKz3aJxHbT1q51BZi/c//Bn++I//GD/9yU9hjEGR51BakVmz5vpU5F1FK3Ktpb3H2w8f4fvf+y6+9c2vA56sS+u6xrvvvYff/73fxw9+8AOcnMzICIL9W1pPLriQ5VD5GNaMsPYaTTaBnt7Fq1WDv/rwI/yff/5XeP+zp3hVOlRmhCaboFIZrDZoyP8IC1uqoyjG6FPWqBvvUVsL2207lkciuOS7MJV4P35SUvKd4gvfQz9PhCa3nQK/x8ZJlg8NXa/XKNfkUDs9libQqCO3bWAtYTQeYzo74X1rtN9StAiyuGTr3bC0KAM/ycSvAK6R1zB47D44CJxwQibUxKSx1U3U2JAINloauhmYojg9oZsOvR6I4wu1Tr7CSE2OFGcCDvlWPFKXrPj9G3ePIPsjSfOmJHJjdPIylJ/uSA0g7dbzKEuYBgmyxOKxxeQ6Q2y5u3lrQ7BJ0n25C51Nq2AkoLV4FpHvrJ2l7d2JjJgkuGyyBpQwr0Sgibsox0xZgw4A1cqTh35v4W0NW1fw1sPoHKvFCr/8+S/xp3/yJ/jrv/orzOeX1CuMglUeVjlYxUel8qGmGkBhNN599Ag//O538Rvf/ja+/t67+I1vfws//N538c1vfB1375xCa8kXnyenNRrnYD1PsYFOLVivl/jk04/xk5/+BB98+AGePHuCZbmChaOdpNqTR0o6Twbe14BvoJQFlKUDTWHDeWq0cRuo+dw268llszAjEVZUq2ljpwIrhqfgUdOLL4a3wj2F2ETyXnBu7GSjdYWyXGO1XoVBV9PQeX7WkbYmDrWd91BaIy8K8gs5GsE5h9V6hdV6De9pOYOzGfJMJJUMmVIauw7k/V3XDRD6+bXioQpX8eseGE5IKd5LDNAew4pPVggQWhiOY2/4vTO8F44u1NKRXFhPgSKCZk/wzjmuMCI4MSoInQjbtbQj0E8biv5sEyCvDXvnpT09K8xHqNpay45KG2YsvJZmLQkb1qBUGPH3Yei+YMsULDeS4jCyXko0Ie9R7tsxxDQjAyWBJlcMo5iE+dgZeRoORCWnv8pb5FrxCdkNnaJMp9IgNwVc4/Dh+x/g//zjP8YHH3yAy/klnPZARoKt8Q6N9/BQyDRZcCrnMTYZ3nvrLfz+7/w9/PhHfw+/96Pfxte/+h6KzKCp62D+LP4/oDUJNHhY71A3tD70yacf4z/8h7/ET9//Cc7Oz2DyDDo3sHBovIXl43GUciTI0ACoobUjIQcLr+iUAafkDgs1R0KO5kWkPkO1dn/w76QNwrfud6a35OEmJVA7OOcSLYwOqKQpSNbUZE3NRi1NIheBaTKD0XiE0XhM07mrNRaLRdDOQorBOXMboa9sZnIvxB65/d9NcfM4RKBvQ/q0LyQZ9IiRnks8PgHxYFHHS0v9cewC01m3oXaASLZNo130CDXhRvHqf10iDgpkIEAiNBmhG0BpWOvRNI4W7j09A8Dh6JKRoMIWZtlTnO7vQ3EccjwO9spL0qak6IjaQnUHTwf9NXUT1ihEsHnZHM8EC4jJW7cWZUogQU9fCG92JtND7LJ3K1kPDP+YxGK83QS7SANL2EiHkI3CjmrCOaCqGtjGoxiNkZkMTk775XVeY0gLmExnePnqDP/23/4J/uav/war5QrjYgwFciEEANAKtSMjm4yPQfHO4XQ2w9e++hXMJmNiAE0TjEecZ0exxgDeI9Mao5w2P1/N5/jrv/lr/Mmf/ilevHyJPC/ICTG4zljTEz/91lH5FM9ruKYhMc4DmnhSQawaGezE1qEA4Z+nvX1pLW62wpYn4Xac9hR68+zVRC7v6LLiMquq0FQVnbxuaa3XWk8b2D1Yy6XolSJvI+PxCFobrMsSy+UKnj3Li+l5OjD+VYWCdIzrgN5r14D8Gm7HCBL8mpUOCkrbRKq6hvM+bMexfCbeZmyqfZRCQn0pYjMFbjEYFmkpUt61cQHmn/73/8P/2L6vwtKEXBRHosKH33QvZU7W2SDQFHsZsNZhvS5hrYfSGZQhT9DE5CSnPMJIGnNTsLUysPsS7UBxWpxR+R6Z+2tGkp/udQhk/w+4xOD6LKsSi6srrFdrOOvI715y7IeMhqnzp1N5UROimOJCP8VN3xV/p1/JlBTvbSFhQZ73i7zAqCjIlDzLg+k1WBgn0bfQrheiI60MlssVruZXaBqLhw8fIjMazjVwlkaR3jkonoKkfdcGSmUwWY6z8ws8ffYM8GK4RGX1nqbtRsUI6/UaH3/8CZ5+8RTvvfMe7t29y3uvpJ7YsEbRuhtNp9HggQxveIuE0uRRI8uDsBkVIxR5jufPnuH9n/wEP/nJT/Di+XNopTEeT5BlGVuJGjhL9QOQD0utc4wmMyhFe9NIEwW8pak3sBCv+aiZ5WJFG5OtxcXZOU4mE0xGBfI8i+bvnSEt2XoK24uMMIo8+eA2T9rMcxWRMOO32AsF3eH9hwzFjFOx8+Y8L2AM7V/TmqwZSVhx/+VBiPeenQhU8PB0Dtt0RhEyA/We9q319Saiuf6r94UDcay41EYf2HbxGzwz0OVxFCBIkD1AXkOkLQFx8iB71XSbLpKBE9Uv93F6lQfSm/qTxBmymMrALVcavnUxNlMKxd98Q1iZMLSgw7UEckzRe/JuUDcWztMUkfMKUOQNoJvidkj4br6Gr5hC37cvCSr8uRHS2iC9I366xqJpyEuLZ0afrqUFIeQ5hqBlCaGGhxHd0S+/EkJLXMw0RDsTDU0r3SI22h7FnaKbVprH0JI0vZjmlUaJ3KlAB2ZCtDWvABg4p1A1DvfuP8Rv/vC38YMf/BBQgLM25M2D1g8806ytHZ58/gR/9L/9EX76tz+FrRuMxiPozMApj9o2sJ6nXmSDsLNkSKJ4jU9nbJGZIS9GKLIcy8UVPvjpT/H+3/4tHn/+OcrVGnmWY8JMWTRCJYMDpeG9RmMVaqdQW5AHESoulOPpG0/55mqA8uS+S3sPZT10WIqUukrqnJqMyCBhYvI3tkKC1k1qDwrLbE6xZxceLFCwmK5obM42sLU4Om5QW4emcbTuyAcHd7eekG/IAibL0DQWV4slGhbsHgpKGWidJT3ky4HCzQXb/kgaceNKguxEfMfxoEkGAQBN68sykuwhTgWrJEFkJlJCR3uJFrr53CuDLQy92ZdaP7wQrfyLtJ32E7Foo/u0ttM0TVLgKNlvH93ifokItZ8K2x5027nnCoMg9r0mvxV7WGj4BGsSaPE4EKr7VmoMYXbJ7x6kgqYbJI644pBHRlNpecP31qCmE3dyjxit0ExKda2Qra8Unj6FKWpt8O577+JHP/oRfvQ7P8JoPKZpQjYbB58ErPjsLussPvrlR/iTf/sn+PnPf47lYoksI20TXNdSGPKGEWcF4KltDG82r6oKT549xfvvf4APf/Yhnj1/hrKsoI1BUYyQGTpfTmkD58nBt2cjCXFOQKNjKhNZ+yV9UCV1wNmiW9LmQ/UWEeu/L1xCP/I8kEzaPiF4SFNB8iRES2k5S06Om3AydkXOjoOJvxiORMEmU8dFQUfoAB7r1Sp4+AeXQ/bDHhXXiPL1CrZhcG9MCGM3nOWBRGg7Grw17Jia1uY7G7NTycYyAtg/zWNhf6EGIdaEaJP+IrdpcZyDe1rXcVamIIQ3JZ3j2BDG2mGat4IDkiBWv0WgMcHFcMP/JGESVkkUSvGxJ3yMD1udpetqCakFpM0qN/qEDJhp8LckLskTl04EbzL9QU/4+0DbDKUp9DUEz+/Kv3A/WUds6hp5luHrX/86/vAf/SN897vfxcnshMLRAg4A8hSfGXK8rLXGz372M/z5n/853v/gA1xeXIZzwZSK6w1a0WZyQVq8+XyOjz/5BD/5CVk2XlxcwHtP2xp4nt9aR1NvxsA5mtJ0nk8i93TWVZEXNG3I60bOyzRotyXi6Nl7MZgRAUSIbZ1OHUs9pmFFmIUgQXaJSA3P5cVAZ+02C/2fM+N4xF/zyctiOCJOGWTfmrO0X03aUWuN8WiEohgBfAbjarWC57XiQRq6IRR1zhaZ7wOh/DcBgX/sUQYnxztxdSpuz3BsUMNbspRi4cZ0142Y+cDrxGFCrYW0heOlQJ3d8ybfuqnh2cms5/K51DXTkdDWEl4D0tHnTZEIs33RFi7hLplH18lIN3VcnGhs8n5KuIFjJehjEimj69Is8dl0WiIRbHsUL83bbggjjT/BUydKKVqjUrygzYMAay1GoxH+yT/5J/jDP/xHuH//AVblGibLMB5PaPM2+x3URuP09BS/+OUv8cf/3z/Gn/3Zn2G1WiHLc9R8FpjitTWhbyhFfg3zAufnF/j3//7P8ad/+qf45JNPkZkMo2IEozMAgGUB5nkvUNNYAIqMUEDMQoxMTMZ+JbnCg39E7m+E9oBBBjX0pIOkDTfre1OYtZAKL89xyT9+FtqFRjeBJ3gx8WcHAFVVoSr5qkhbE01NhJlzdLIHABiTYTyZYDQaAVAo12ucX5yjbmqiNVmz3SzxjRH76PHjfp0I5djSISNNyCAlDhpkbT7yDhZsHJ+0M0UxPIi9LdxAqG0DrQ8QQ+UCClXKPqLXiWNqbx3hKfHuunohz6/RSbyMTGX+mz9pM2tixp9csQ04jq4E43uBnLmdIpEmFzYFIBWDy8RrQum6GtRmSYn/bQqyNK0uYnfrIq4fWivndNHoPl2baZoGy9UK3/3ed/EH/8Uf4Dvf+S6urq5QN+T2ShmDLMtJoGQZTk9PUDU1/upv/hr//H/5n/Hs+QuaiswLKKVRjMaBprO8QFU3+On77+OP/4//A8+eP0eeF5hMpwAUmsayFRlNKTpHe+A86LR3bQzqukZV1cjzHHfu3MHde/cwHk9gvWdDED6FoAumTYFzLkwjRU2pt+II/DB9LO9220PaLQi0IMs6YT23iWz4dw6ev9umQV3VqBItjY5E4tmdhGYVEBhnnuUYj8e0Z817LBYLrMs1rfNozW0xVMibg8i8rwH6QbTfvXtcXCeNbeUQOmotXYBmB7x4G6mbwN+jcKP3iExurw224ehCTQoZ1tIUjyRDnUtHeA2gnnAtodGLY2hnKl43iSkIw4TR1DydYx2vyVjaFxRHuz3nH7WY1ibXG2ynzgPqU7FQSoSbCDMRaBudKElrUIjRPS+dRfpQV64qshzM85zO5uN6ai9ot/P1zrvv4sd//8f4+//gH0AbMj7wPhqOSJxKKZRliU8/+xz/4l/8C7z//gcoyxJKa9QVnQW4Lkv87Oc/w5/92b/Dz372M/ZPSHGJNbBScQoRirYTKPbu79jwI88L3Llziul0irwgDyfWsaurpO1FSIc6SCpDgSpLBjztx5t1TOC4OgKsGzwwOE9vpEJM8iPf00Ftes/xaL+pa1QVeb4hTY33srKmJoKN5COtMQJkSTqdTpGxwchytSZNN9HMbxNdKt4N0bK794+Jw9MYCirCSdpYaID6DrUFadSyv9AHa8HwrkTwmnE8oebBVljiW5CIUmqZTDqlM99YNOyFI4ozgOPbgBDRvhfnqjeuA0BMOf723gctTZgdaSzJaD1lgPJe+JN8kVE4mMHJ44RZScAogygzIthkY3dLG92z3WP8rZtRolEG04fhm+L9XWQuLhtIydWS4ukTxZ5BnHXI8wLvvvMufvu3fhvf+c53MJ3OQt1RBya6FYFUVzV+/otf4s/+7N/hp++/jzlvL3j+/AV++dFH+NmHP8PHH3+M8/OLYJLueX+ZdS5swhbhrpgJUHHo5PfZdIbZ7BRZQZogCVf2RM816HkULUirg8mMDUqSqf5Qh5ugdm1VZYJUyFEAnwi0SET8PaUd1srkoniihxsZ/IpQk02+9Izptzt1DiDLSVvL8xzWWiyXK5RVBcX7Il8LDkiGur/0g4Qf7LoOgKRxMHpeIdsIySt9Co3K/kHZzmJ5DZiHXNznI7ltcp3bxfGEGteM9+RWhRgpdRbFZyTRc7aIui0oGU0cOZWB6KKI2vffcdAtn/cedVXBWhnZsj881tCI+aQCqR+kt3Vv9txL9Cd5RkIs1n+4QJ3ikLK38hkHir0IPFV+s3GEuOQKgjWY3xNtKk2GGc553LlzF7/1W7+Nr3/9G0GwgevZe5mBoI2+RV7gww9/hj//93+B99//AE+fPsP773+A93/6AZ4/f9HSjmgzMZmoixYoVOMdMQaJN88LTMYTjCdTmIzM0slMndfWeI2Q4pCN9m3uJ21ASKb9t1Vggm77ixCJv/lTBFpa/+mo3lNMQVPjy3F+5LcINZpypUFZGP2zYKM2ok/vqXzGGBRFgaIYwTmP9WqNqizhPajujt3/eyB0fSi6HGHbv+vhsHypvvDSl3lwCEV7BMFm/uCZgrD+KV5cNqLa0XlvAWyqmF592CD15DuS9yiOxtJIDErBOw9tiLF03zouhHEOleEGuK14bwAlQyGudc+eLGTEFBlOe4R7CNqCJcazgeRWq5YGNLP0Xl90gt60AvpiJm2GpumI7gxvBHc8JWXYq4i1LlgfVnWD1WqNyWSC3/md38F3vvNdFEURNIWGNzR7NmkGgMlkiidPnuDf/Jt/gz/6oz/Cz3/+C1wtFvCsFWptwmI6TbeRR3ljMqjOSdXGZJjNTnDnzl3as8YWkTTVRkKNXRPAc9trbZjZdCogQNqcUomtv9nPh+uZ7/c9jtItCDBJwwsj86Cz7lq0w4KJ0/We1tyahpwdy/SjTY5HSqfPraO2gCJtbTKdwGQGjaW1Ssum5tdBP7VuR69A+JJBLXxYprrlEJqIbu14YAfq15C1NXY6EAYcHBvHIjeOBiarLVC8X7dzdavDyx9+TnRMGpji/QvCKFarNWwYkVIHFCsmgKalZM/NXuiO+qk+k0uc5nYbUjpS0nl2VMeXCsXEcgDIfyZ5bKnqGpY9nRNzkGkcqXdi7qKtICSpkrqK2pxc6UKxvBd+s5bjk6kHaiNa0A8eT9jiVfZckbCLZU3jlzRaz5iUaTqNnpPgSAQ7z/NbR8YC4KNXhDFSJ/Swls9bYy8lVGaKQDrmV7/yVXz/N34ArQ3KNY/+WVAppTAajVEURdiztlytkBfkDQNQaJxDbcmzecPrm57z0zQWdWNpwzAUimKEyXSGvBgBSrOVHxlTef4UbYXakgjf8dQOxHdqQjvBqwm4bZJ6lb5C7ccaPNMBkULir7GjZcnlWBMOtMKCKq1PEWyKMtR6V9Z507ThPNbrEsvlEuvVGpb9xFobz1xz7C0myzJa59QKxYiOpXHeYV2WqOqa2ooHVN0rySgQHB8nV8pr5J0dUEz3h/bf20arLAfmj4J6uGBBLe7lSJh5D56BM0Gr9tz/hNcLHzgWvPzhLptCyR/F04/EYuK/vqaMRBoriIhSkbcHdoflhHGl7zKhb2ZlCzgbmzlpkSD/78tzz8sHJB8QausWwWkckkpKqN7TNECTjm6ZYWwrdN+T7r2hPFGTEoV1mza+02kDJkj5QfTTTZHpZQiBEcofAX1P3w0Mlu+14hVGz9N31joa4ykSNG+9/TZ+6zd/Ew8fPYJzDlVZB6FHDpNpr5kxWdIPZDaChKYYmICFqNYZmoY2go/HE8xmJ5hMZiwcNZyT6UoSaJzNmH+AvJ5EXz4bDUTCo/071rUguoXeWtdboNA6NDvkLtxg+hB+IdRN+Yv5IdqlKcimalCXFU2jN3SitZb9fCSJOX6ifxmoGXa7R4ZSTWiLvh7Vdy8FvdmOYfsbEfuG+7KwO38DPJOrnWhZHjD/4Vqyjo4Vi95Dkoi6cd4SpK32V5m8hxgfyyhGCFMpUt+a9EgZoDPfnzzYVsjklV0ESG0wHEZJI6XZ2IY0bHhnWwpHwDXTEEYhI6Em9e1InLD7Si8D8/4W9dehQu2RZsr8SPi0SYgDpT/i7+R+NyVh+s551DVpTtZacv7syXu/dRZ5luPd976Cb37zW3j44CGb2jdQiUBA8IVHTBXg0Svfk2aIzaGQ5wXGvG42Go1gDIWL0zdMeEnf2Sh6TzsS4n3JJ8CbtJPBhwxG0vBSL/1Rp+0QYoVPmlixK64g6ED5pHVdDs2aGw0KxACEggrt1nzeWl3XQDKzQ91EsVZIL8k6YxBqdY2yqtg4JvWGkYDvxdrdAu6bf1dAddIj2BjUipE+vee+oGhQWDcN0ZYIPz4K6Vja2r7Nsb9QkykLocJkGgvcKa1NtLTg9I3BgnCwzgKVMbPuDxXRR7A9CA01mHCadpr6jlwk71wbobzXBBOM51GqGOjI1I4X34AJ+gRbGuY6eeFitO8NEnJXzOyHyIgjQ413ku8sMFtMmLUdYdzg76IhyNoZuc2y7L7Jkmutd9/DN775LTx69BbyvIDn/WVgV0Jk4RtBGjSb6Iv1nvcAa24np6eYTmcoioKmG2Va0bP2ETZVU4FC+UK7dRs0rVExIuH24PKGlvA+zLgk8ikB1WK8ndRZEoK+8Leu4VcIT8/JaIkFG7cFmDbFiEX2ljlHrrMq3qdnE2MzaUsvU9BsXJOZjDRdpUiolWtYa2NG+/iEAjPeIRpNcChTFr6w69oX3feGriNCoaMMKLrburj+hI6cj0db0eCDmiBU85HyqCTO7oMEews1yRfRZCRG31oslLn2zTepXjbIixBGTwPPO6BC7RMyIsnFBvYQYW0k+b0JbhJDsGjk9rBNw4vo1A5hs3H3xaT9kjvJ9+vkqfMOUx4x+PazkFIiZALT2oFAe+GK8UjEEiZeCKN7SoOZtuK1WDmwVGsScrahSTP+bRuLR48e4Xvf+x6+9rWvsdsqEkZ1Y1HVNOUVLRsp/biOByilMRqPcO/efcxmM+SJQHOO16b5+BTHnkbSKcbwmRRbIEIq/E5N+OlO53cbm3XVbps+hLbyov1JO4YQ4bsOe/RiWjR1qOgkdN52kZ56TWuPfBI2M0pZj2wJQ0XTj1lGJ6k3TYP1mjZxt7LOgukg4XRNpLxk27990X1v6N+x0Y2fhFNc8pB/nukSnozVyrKkHzcSZtd6KWBvoRYghAnqrI4PkLPWxrnvkCn67KOlwPCS+fYbIQ4e9quT6xD6MfM7gFa9bLlkYyppA7SWBt675BybQ3f296RcqsXMkvRTHFQ3PRisJ05ThEy8nTLYoVxtQTgFOY7qvbiwSu45z1MlPOpvrA1e5eua9944coxr2eKuKAq8++67+P73f4C8KKANTX1pQydOGJORhsVTZM57KG1w5+5dPHr0Fu7dvQ+tDRzvWRNhRwYPpKk0fJ4YCRepIylcXK+TuuvWEQlvCU0zKZ4SYqET60TqYpfQ2wdDMch9sqAjx7citFyiuUUtjjZl13WDqqQN2XLiMhVDjHm4nGzan+U5siyD93Ts0nq9BmQ9r5Mn6b+RQ3VD/HpD7VJzDoXQG2tnDfuGhCd+CablfUAypXv3cOwl1BQ4NUlRKIot72xDDDR6x95XsmxBbxTSIBsP+A69FIL0heX7exOzxHNMWugt22GQjm0tWTrS3izu8Ikwa71DL7buxQc4uJCxztt3A9OQek4plfPdzVsfAhMWJhbuSzFiGYlVJ8LMS1ocxieCVBi8RMgDBVqjMfCK1nic8yS0uAzFmAxIvv3t72A2OwkNaTQJNM9CVSmN6XSKBw8f4PTOHRTFKKy1xfxz+rytgAYj/Cw15ADi2kXaVILOjS4D6a1nqgL62nrMdZPekrpN6pFDboSTtqU46KkSxuY91ZUxyLKMTjaAGH9QokFLq2tUNfmDbNgxN9UtDQhccvKEUgqZeJHRCjW7QKMpXzA9dqhUcZvzd6HXLiX/+oL7+REKzK0c+hAAVFXV7mcbhDIEzhS3z3UzuJdQQ0wuJOjZ1DhOOxLRdkHl3Lw/iKQsG4Jnb2EkjDVpvCTOwTjSsOGdJK5jYKhsB0EYC60LVZVY5vHVE7b1a4DIdo2SNjU31U97ogXz9xTEwjgDkUfugSiYQizyrnwRhuyDiAtMXb53L4H3ZL6slIbRJMiIL8oJ1EQDRVHg0VuP8M677+DO3TswxrA3fUrPZBkm0wlO79zBbHaCgh0k05hQTnIOLJ9T54V3ER4yjZ+g9TMWty3EqJD0PZ3ug9SJ1JG8w3UT6oOfhfoTQSYJxPqNdd755HdSoxHveTqcfTNmJiOt1XteBytZ+MXN2E0dD7aVacmmaeBkiwS7z5LBSM4GI9ba4LUfkH7MTJdzGCD0LGE2Q/xagko6XFYPMonwNB7ZCgURZhKY/JuSdr3Zz/ZB4LfDWdyKvYWaQPFiNgA0jUwNsMVLJ/PXEmhDQuSaZYwNuF8EMfXeXNwMHNnNY42dtLENqrqKnZ3bQPHIqY+eWoxwX2wItE0w75Bf299hxilMcB/iDwy19377d4iPkmjFH3lynJYjpkkbq2WNDYh7w7Qi+vF8bMzbb7+Nr7z3Fdy9e5fqWmsUowKz2QlOT08xnUyg0z2BigYA3tNaW9hbxloYDQIoPy54AeEa4mrk2orl7asLfsgUH8vPD1OB1vN6BL/Xh3A7CEppSYK0uget9So+OmcyHmM8mWA6m+L09JT8W85mGI1GGI1GdOI3+xSsqgplVaJp6mStLTrQJW0t7sHMcton6J3Der3qz3ufYPs7jQGemN7re55AjpzhX8xz2C8kHd9O6GuPvRAoeW9o1bVSTOg5XipcitfNiPjiWo4Uhn6w6q/ke2qCNYxBIdIixs3cxRrr3ov3KTu9sROYqdw29k1jqP7F1kyxBKHpGvIun64dEeOkag/30lj5twKglA9hNROmXOD3ibHQyFgak2p3v/IMo/1+L6NNm3IHusUEkDByHn4CvMeMNnAT3UanACIAxdiGhJ1Gno9gshyNJctImYp86+13cO/eA9y//xB3797DeDyFhzghpjyFLImVoyHjBu9p/dN58rwvbiGDMOSct+Hh2Vyaf8VPBel4dPq3l98JeusGHXt8JJXerdQ0XBpD57uzKNdLzCZjfPW9t/Htb34d3/z6V/CNr38FP/j+d/G7P/od/MN/+Pfx4x//Pt566yFmswmM0WiaGsvVivw58v5ArelEa89nyVEbgXqUNtAmg9YZnNeoatrYjp5+sznQSsrDMwwDT3/tQDXUrY9d4Bphnq4QaZXqlgZ4dWNhrQeUCdPp27EZQkkCA9ggV4a6PF+0jHKlH4TwQgv8RXEGrbVYXC14VMkMsD1U7wHHsS3IvrjuqOu67x2CjTS6tU9PPdpTO9SGzFhjsM3tEfCBGc4vL3F5eRmO76jCtA3tuxLtwDlelEg2rWaZWI6ZkJZYlGmtUdU1Li4ucHZ2hsvLKwAeP/rRj1CWJZqmgTEaeZZBQazZYpzj8QgFL+BnbAyRCksl3cPTyd0bBMxTYSSQia4yk+PZ82f44vFjOO/xve9+F8VolOx5ioJd9keJgPIQT/HshzHxKUjH1JD3inRK3fEmdpdKWombMk9CzzYwstE6hJH0IgMWQUmaDdWA9x7eSVmp4FEIJmG8C95B6H2uI86ac9HLiHPAxcUcZ2cXOD+/wHx+idPTGR48vI+TkxmKIocx5MtPXCDFOmOLWc53ECCyj07y1nqeVg8Zezhn4a2F9w6//3u/h3fefpvc5UFhfrXAcrWGyXLcvXcfj956G7W1KOsaZVmhrEgjK0YjnJycYjKZkHGOVshyWo8rihyjnHxhAsDFxSVevXyF+eUVMu3xw+99G3dOptCGBg4AWecpoSlQ2VOkfLB9jwq4+bQfG/16Bw4NfwiuE/dg8LShGY7XkGUmA+zAmrRnOlA3NxrK87Q6aOBgmBaIN8n+Z+Z9SUXH/Eva9Kk7WUl/auVVW5FKCTQIOBnpkA865zya2lJQkWOpprYNyUj/ZtgjrR4cI+VBcNF601Do11jT36FIUkftkWZoB7a2AxOVlQ3XIMLzThh0nNs2mtaDJuMxptMJppMJRqMCmTHQCvDWwjY16rqCVgoPHzzE/Xv3YC0d6zGfz/H06TOsVmsYk5G12UC2D9F5KRyVKf0X6YRjYsL24TRvZqrhIMnIXKUPyG8SoqJ5Rk/3Qt0Arw0iWgx6Fhz0PRooiIWitS4IRqUMvFdw1vMzD2c9HGsV8il6jPyVdGI+SHBR5pPbrX4VYyFBKMKXPaWzoAlrrGwCT3XGl0hNjgno0C3nlWuA06eL7omAbVvXUtrJ2WlwyI3CO48e4Fvf/Cq+/c2v4SvvvY3ptIBzNc7PX+GXH/0Sf/XX/xGvXr2AtTUmkzEePLiPBw8eYDKZwXvF1pB12DYhwsd52v5QVjWgDLJ8BJMVAAyq2pLLMSX9hr/zwLtNoVKnbXiliMEePAofYgL92BjQfclIe16rF4YvBKrTNkt3oDp23D7OAc4rILjMStbgWqQtfbCtgYV0k4TlW8pO03ySwEu1syTTLSQROEcnWoOywvtQhl5kcIo7Qu0HZpzde3tdt4yNfG1BCDuUt7DY3hWGpG35ZIpMRtiRURKxZRl5M59MJphOpxhPxsjZZ6FtLHthKFFW8TwrY8gUPcty8p7Ox4JcXV1hfjlHltEILEoRTk8ItlMWKkLMV3qPGAyDGU7KRNKoiEaj8CKaYyYu/idl2lRxJ5EOFOJkVh38VsolcVK8cnnWsJBsFyBhIScgiLYX91OJUUQUtqxdSVyhNDFHad2k90RQpRat6QV0KklIKnAGEX6xnN7LPXnK7ZOydqrsXoQ4vCehmlxROyWN1JgM4/EYJycnuHvnDu7du4siLwDvsVwu8fTJE7z/0/fxtz/5CX72s5/h8ePHuLi4QN00tIeND1KtqhKLxQKLxQJluaYjamyDpiEfp1qTFSRtG7C0ztzygckzAgo01a6HOt3NQbFu9oNtOIRvfFno5pG6VzpLlzxkGpF+oLjO5bD2SGBEZEmX76A7AKEBileA04BTm5dGZ7pxgI4RwiXnIMUC7Wg/RX+6lXJd9MVDse/+d2u4ZtQxX5vMXH7RZ1uweXhy9Mrnp8k0EWkERGxZlpFLpjE54DXGAMHibI31eoXVaoX1eo26qtlVlEeWZRgVBdblOhwHItfV4oqmFjJ2A8V5AUiISB136aj7m5ho8snfwyW3wmcaA6Ua6A/8blJvoaookZAOhSKmG+rLxydUDppOTQ8XpeZJf7Pg5LqOgiIKjxZEyO5ALA+VOcQXvkeBwi8QBSV5U5SpRECHKEM9hngdCcwwXdptKf7ZLU5ad9susRyVM/3yPA/1Za1FWZa4nM/xy1/8Eh+8/yHef/99/OxnP8Pnn32Gs/NzrFZEg2VVYb1eY7G4opOu1yzYEuMecfDd2AZluebpLqmrhD7SerolUNS7GGMHh4T9MpHkM/SN9DnTmcwQkFUxnXOnNK31Q2iwRVndWLqg5x6sCbIQC5aafOlWpJ045afiy7NVC+0d4VFQ0mFkob2LWxYnXz6Esews5fBzqWNCymT5uQdUYp7d1GQhRudxCYOKa0tGGxQFWZUBwGq1wvn5Oc7PL7BcLsNR7I6n8DxY6+P1t6qusFwseJQVS0YeA4T5JsyVEegpZbwJJK/hN91kAo8lD+GY8NP6dYnnegh9cR7Fu404125NTYZkyVDDGAOjaf1Q5vOlTDLdKAxQ3FdRWNlMTJun5R44H4JQzsDkw6Nu826AypMI1iC4EqYMcI1LZLHOINOD7K+1j6ZCWXktLWiiaRvIWy3tLC1XJ0qA80ThZfrbJmdvyUGgjve2GkN1WZYlXrx4iV/8/Bf4q7/6a/zlX/wlfvKTn+CLx1+gXJfBSrJpahZqFcCDG+8dtFbI8wxaK+objgZpUopQd4nFHn0M98ubgCmie3sQCj3S4Q1D6IdSfx3OFcPxwIfXqD1NogR6DrTKgYW2Azp0FWle1t1IsKWULRf35O5tmfeS2WhKQYjUWtta+Ofh46BQOxq48K8FUon7XN13NyDkLQTRfZ4ibc3+pWvAk8EDGzd43zZKAITOPBaLBVarFRo2rVZhlEyDE9H0iDHLGh3FKR7oHU9typlklg0pJL3AXplUQh74ZshXWrTwmEf8rDFIWApPTJPC8FoQE7gYOJBnj+iVQ6waiVEaaEOeLKjs3AobgiHmJaTHAj48C8KOpticY28uzKglX9LFpQxOXJaxy6dQviSM1E2InwcvdHwK/5PvXI5NIqJ3FDP57nPJfypgI6lEWgZifwbnUdqNKS9GGuqwmxe5Q9a5ngVaWZILK3C7Kdbg6rph60ZyFQZet1+v1zg/P8cXT57go48+xs9//nM8fvwY6/U6GCaBDT4UGx9kGbV/VVdobAOXCjMiAMliKIs83yjGlwBpizchL9ugmN5pQN+5Hygxru/KlqMUHh3aSkkLgOqqYLTAGSzwyVR484pCjYVY78UdQQSaZwEWOgeH3GiIzb51fNxSGseOMrI7ZgLxZzdgclE4pp14cVDrUgfGbFkEagznZL8PWSq6YGFEbyuliQmwhRLY8lEOzqT8xjZ3ieUk+Zf0gBhWCLsTBp0g/bVJxB0q7lRGeOppDczKdCsbxgiTDowAICEmWhgzuCDk+NMY2qyb5znyouATlAuMxyOMxiOMxyOMJ2NMxhMUo4I0BAmXF8hyMpSh+GnTb3qF9FmLCxpe0OgiusxWhAQJehbkYao01TyTKcNwyZqWDADkO9NHYtxBtJB4wVekwQShx/+o+1M/D+xA8g5wq7bbHGDaBaIxiWjN7AS6qWs6WcI5GD6njugp0oa1DlVVYbVaYbFYYD6/wnw+x/n5OV6+fImLi3PaC5WUJcsMstzAOp5RYl+dit04IeQ4DlgEoV8KukvZ14X05wOwkZc3Fm1aAbrlJbqlfWtxYBrR5hBdSFTplf7yTDfpUx0EYAfdW0KQ3vGIMHROyoiKXwn8eHMUd01sieZoadwWerJHrCtUUqu+0iYaurwwiHRtCAhSz7PXbGKCjkdBxEAjo+XpN9PWsImhkGcHEVQy3awS/3tKAUi0C2G8FIfo+KnlpjAs/gSNuojZa4A/w6X5nta0sZanHqFolK5FgGTkJqkoCuQFCapUWBWjEUbj8eY1YgE2HmM8HpMxzWSCyWSK6WSKyXQS4yhGHBcLOb7kd56JoKNPufIsR57nwT9hKvxEqzDGIAvuo6g8cf2BnS4r+k4Dj9iOUqdJ6/GQ17EtGn1KPDT1xv030CXH4OVPOlLtgdBEEHbp7/Tic/6YoVne/kBaMNGr4oGICB4qn2hsgLNymgINrqqqwnq1wnw+x+XlJeqqAsDCmQcsRjZx8+CHyq2J9Sb560PkJfy5rR72RKufH4Bb4WtdRrLt2gPEG+JMEbp16IkX1Q0Z9ohBV6hSkSNCtnukq0Ba3MbF/zrzhdKCMgKOv52zYYe4LMiCC6WYWZI2EHHsRjl2fK8Fanu+pSE4YAdU912jfoDXNi35xVMSlBFG//SrowmI53S6QURJ7UZrVSTMyLosTqtBpppCvBGptiiEzbwuCDBCuySAMFqaPiRtxvBmWpqO0lpDGQOdGRpfew9tNEbjMfKioPO0Mj5XK8u4k/BYnIW94zUd6ywaZ9GEdZ2aPezL9gfHa3E8vRrW5HgqUjpta68fCS9ZW5P7UXBtCjjS+HLkeRS8Od8rioI1yByFXHmOIictkcLEcBQ3a6W8RzDLNDJDlzGaBSYJTsqXppkbEMNxXDfWWWY3cqVo//ZhMJMYKbGXDx/W6OIavLWkYTcN1W06uGrTqixr8D6mhEZJW6etRJaNTMqqiloaTz9q5k+kGURtVEolU2JDgk06C1Oo9M4bYRsPeJ2IrH/3v11Z9pCjhZILzMrSaUk+a9PaBpaFWnTQwdNPPOBQ/P7WxEWAeU0Xb9MJwu3sYhHYjijooak5Xu8VqqqJe9OE0PiSkbVMUaEzzxqR3h0iqAH0CYe+e0dCH/M+GEfKXzsG6pDzqznOzs6x5vWyuqpg+cQEZxsmLDFDZ2ETiIZyRUTIZ3lphYZPDb5//wG+8Y1v4NPPPsMHH36AV6/OMJ9f4fz8HL/7u7+L73znOzBGY7VawhgDWzfMYA2yPMN4RFqNMF3SPOIUV6hbD2QZb6ANdcVsVUbTzIBK3lbw4uULzOdz3L1zF9/+zreh+BytuqpRN/SZbqZuxMw+nJ3GJvfds7rg4VMv/wwa4fcL820dX+LoMk5huGAGENOn+iBtQkLH6cC4puhokzUFDue1SVng6cDGy8tLnJ/L5us5xpMJ7t2/h+l0ijynkwWsbah+vWj9NskfqD48pSNCQPIqU9qUF35FeIKj+vaugfYe/90/+W/xrW99kyxmlcIHH/4cnz/+Ai9eneNyvsCqrKGUgeWDJ5U2yLIcWV4gywrkRUabrUcFZqcTzE6mGI9yzKYTvP3O23j33fdAx9c4rFZrnL18gapc4t133sKjhw8xmUyglEdT11BhKpZyLeuW9Esak6ZBI4g+jgEPavt90aWfQyF0Iuij423ovp/C8wkY4bkIM0WHusZ3LbyrMSpyjEYjZBntsfW8hEE/YntA2mMwXdo/SOoUhaNYuBXP50vvnIMKEQJ1U8EYYjbUyRSWyzU6ilgCyUiSyT6kBJSe+3Qd5t95J1TgrrgGBe41ceT4lFLwztGUm6aBghPDHEoOSmucX1zg7Owci8VV9GbuyZsDTfGQGa1oGNL47cR8JASlUFc1oBQe3H+Ib3zzG/jwww/x81/8Ai9fvsL8co751RV+90c/wte+/jVorVHXFUZFEeLNMoM8pyk02Q9HWsWIPUEYan+2sCRmyue/WZqqEsEkFnI0hUrHkUBJRyBhmOc5HE9p0UkRNgoaZvx9rZMy6+RueJYiZdrS0+R3ynD6mE/fvZSpDL4vabKTY/DAg2g8pk8EEde2aUHewVkfNFA6I87yHiENpSgt0T5bWqmn87BIOFJdUFixNo3TzJYPgwRog611cp6cCLUGtqlh4PFP/vE/xre/820URQ7nPD78+S/w+MlTPH/xCucXc6zWFUw+4ilrdnulM5gsR5YVGI1pvXM8LjCZjTGe0PeT2RT379/H17/2NaIF67BarnBxcY5yvcCjhw/wzttvYzabolqv2RUczTqJ0ZNJZ53CnzbN0P1B5ncwKL5N2tgHh77bFUr7CrXue0NIqLGN1m0HuAbGKIxHIzpPkNfwhZ7g43r/ZpQxz8pHy0cnXQDcZ8g1T3v6USa3ZD5bXnDW7lWRfQwkQIU/7VDJ/b3RJ7j8wP0Otj89HMeOz3sHBQXFjEfJWV2s5ZA1Hx2IaB0dmhjapssYfYdAWHsLV9JmTdPAM6GBN2bH6bj2oaOBefIUE8TgQNY0MjqRWIeNsxVWyxUuLy/x6tUrPHv+HE+ePsEXj7/AZ599js8/f4wnT57g+fPnOHt1hvl8jtVqhaqqSKh5D2NY2+NNLnVdR8vOugHYnyMNwnwUaDJ6DCb4PG3YY8yhVNtSsguKlepZhJB0SnonudD5zZeE707bSJySd5IraQPKJ7VYyB7nQwHQPLVsjMZoVGA6neD09AT37t3F3Tt3cDKbYTqdYDIZYzIdY8ob8mfTKWazKU5mM5yenuL09BQnJyeYzqaYTKa0dliQ1i3ThZoHWSTwxJhI+EQsr9BJ2DIg59vxCNl7j0q88QfBQQRKpZf6kVISgkNoAJD8JNO/IsyhFLIMKEZjZHlBBlI6Q57zvk2uTR72JZBa3sVRDsdN4jv8Xe7ohyLlG1vAlN76xw86AemG8I54nz7YsHEr0sdKqbA5H6AZFvCp9Bpikh20MmIg4HJ5D3JPk0R4MFjYbORZ0Z+N+zvQ+8YeAu3LgudGGzLKEUi7KsXs05MGbTRNFZXrNRbzK5ydnQUzfWKCkbkGBtliiHsgsfTy3gerMllzUWyc0WXSNC1GdCJrHk3TYLVa4+pqQT75Xp3h+YsXeP78BV68eImzV+e4vJjj6uoKy+UKq9Uaq/UaZVmRhmGjdSWUglYGeV6QJ3aT8ZouP9Oa3XaRgUhmMhhNV2omHvIM+tRa1paiQCMmSbUQ+GjSmVImKt8l3hZC/XeQ3EqfSxvG3yDNgLVsald6P7Qs17dsFXB8/A18Z5DB62tk9ZlYfmY58jxrrdGNRiNMJxPMplMSdpMpCT42nJFrMpmiyGk9U/MgQ2hP1tcEQbsT4ST1m9QdCT7yE+nBlozi+SPhyVJL1EfYiCa2Dq2tcJs7B7x4/go//ekH+Ku/+gAfffQJLi7msA7QhulI8RFDkqF9OOubgAOyyFR60Ds3RR8fJkVJ835F0rGITDhsMjbfhKhbtBan2ABKK59cDko5aOWgvVixJZ2L5kQ1wP7sGjnJ9JroKyQl2vtkOwZeuEZMN8e+Se4IJ12JNCghQ5kydFguF7g4P8OL58/x9OlTPHv6FIurRfAAAhCXE6MIaaqUueyCTE+Bp6fgaZpTGI/WOqx/qWBsopm70uirrmusyzVWyxXOL85xdnaGs7MzvDo7w/nZBeaXV1itVrTxm9di85yMJ/KMGI3Wcf3NC2/nciiQdRztRctYG8xaAknWd4MgSzqN+KKL9SKaXKwHQbjHDdMnxNL4halLH2r9Dvdje2wIwgSK91DJP/qfvJ/ElWrMwQLN+2TTNX96+hTvWZqXG0h40FS3UWxUwueTiaATF2snsxOcnpzilJ0MyzWekCVpGAzz9LJns3xw21F9xToUuiLBGPNOxJccayK0IAYeXE+gt0i4y0Z85l1VWePDD3+OP/qjP8a/+F/+3/ij//3f4E//9N/hs8++wHpdwrMfW4++kWb3NzcKkdju65joiVPhMCFFQQ9756CwQwhxxHYkC1jx4Yk4kJCwPSwrZkXo2cH7BvAWGg5GAUaTZ2LvLGlqMSIuvmITWF6ItpY9dx8RPW21G2+SNnaNvEgd0iIngXgxCQowQ5BoPbu0+uUvf4lf/vKX+OzTT/Hq5QtYa7Far1A3NY3OOWx38/IBMg3ee/buQBqMmJOLKbrn9TrN/hABYk5EPsSInKNjcKqaXG45FwWXmM4XwV0Xb/ROpzE5HhEiWskma5rGdOwBRdKk0Kwh8D4tmX4LQjcIIal0sYakNbggEFJmyh1Qk3Tp1ClPn8n3xOLzUKTMPb2Q9g/Oc4BvM3Ux9afXpEbYKtGxBufYipWZB5FcKmDiM4EInIw1uyIvMCoKjEZjTMZjnJ6e4t7du3jw4CEePnyIe/fuYTabIc/zIKhovYo1R24TqS/RkLUxyLM81KXkV4w5KEtEWzTNSd6MKDxZ3op3GRHsjXV49vwl/tN/+in+8i/+I/79v/8L/G//+7/B//Q//b/wz//5/4wPP/w5qqoRRVhKnHCkhBa5tunpfv/SerwphuLsu7cNkv99cWj8XcR8cyRKToaP3oAkP0SD6UpYrPugoaX+Q7wDmhrG1chgkSkL4y1gayhXQyvZlOjBDIAYiBJv/I3tGcnsCWEQNwXHc0ijbOBNyguEyojUItMihq14qm+9XuPjjz9Glhm8++67uHv3FFprzKYTsnZsyFuDc3HfjzDbQ6BAfiKVUq1Rr2OmohSQGYMxj8rFbNoYMjwIsfCal2h1Ek611l6EcbEgC1lNBPGGYCZi9l5G5ezVw0av8zGs1GkbVCdJ/MwARdMJ2oXzgaFKdEHQ9Agg2TPWvUiobt6Pee0RkCEvXCli9ZxSm2pTXtgXF9YJ4z620DasWeuw700kW4zHI22L7VBK0d68okDGGt3JySkePXqE9957D++99x7efvttvPXW2/jqV7+GyXhCL3K9C5wjjyzOWd73RxvblaYpyTo5RklxGVp5FiMWpgfPip6zHsvlGlVlAWWQj8aYzU5x//5D/M3f/C3+9E//HZ48eYrxeMzMdJNeAgMN1/5QoPrvjZbRpYuhK4THZnwxnS0J3QD7lGMXlJSVCc57kit105DI4k6m+Hta070CDYCGQwYLbUuoeg1VlzCuRqEscu9IqCW0T4knEtXy/OdBgi10mAPe6ULiUJyn6+IYeRHcNC9buwjdJRol5leWa1ycn2M2nQK8mVpSl4V1YYgSaff3vpB2V4rWYsJ9pTAajfHg4UN885vfRFGMgmYjo+1Wh/O0MTwybhlFi0YWNaPIzNMrDUcC0FrS6LxMoTHDpk5PdRXC8xpgiF9G8C1hwhkF1ZPc6+YpZcBDkBCt+EXw7rjXzmf7meK6b13MZNKLE4+58bI4SuUTniQaLV08GEiFuotaZ0vAcTpBs2KDDMUL9VmWYVSM6FTrMU1Tnp7ewcOHD/HOu+/ga1/7GsqyxJMvnuDps2e4WlzBB6FNaWmtwz622MbU32hoQXkwJhqE8EMazCVW5Z6Po3FOwcPAe03fPa3NrlfkX/Lly1dSwM4nklaVWtxNB33oE0Q3wVB8gb31PDsGhtLdHyywkjVL28RtNf9/8v772bYku+/EPpm5zTnn2udN+aou0x5tYLpBghiAJDAzhCfoJM0oSClG0k8kgBkSGIWi/wyN5gcpGArFMBgajUI/KIZDDkGAhOsGuoH2puzz5trjtstM/bBW7rPvffe+d19VYQhJq2q/e84+26ZZ31xe+lcWv6szEuk8HWyWQG4CpQlkocUvZ8z2HrJ//y6zvR3scYaUKCWiFNvHU7yUMn75732SnvgBr6L04VyF1Ll/zhR1uel9R1VX1HVFUeTint12RE1dlY4LyhxRG1zPuAaMITF/ef7jm95XwcI6CxGapqEsS7a3t7l48SKXL1/m8uXLWCuVib1WabBaANQOxsiQaSegigMAftzGQGJbbUmCGnyP8tTDTZj1sWv2vx8Z3v21jlDfHIMV6jGwO22T2wzuOXiBI/uGtxuusHvg0p7pgXu10Ek2puEWdQwM37d/ptQXeu/037AhzOBdTVL5Jon7iCSanlGbJUrLGlURWw3wzvOcyWTM5uYmF86f5+LFi1hrmc3n7OzscF+BbRWmYui8JOdu2pquawXcNKZPVMl6f7WpJlVVGvsytqR5Q5CFuPcKdiq5+RDxATCWZVVzeDBFfaGOzIMh9aPm+Dh5CvqweYbhZF7c3+eE3z4MOvU9Ttl9nFL/pBEeNB8oynd00A8uN5zb8l0soGINzYlQL6mnBywP9qgPD2imU6qDfSk907N97WBjbB+02k+w/maPp7Mf+Xj6UK7zIVyipw/xWolJnXTNxCy6ztM2zdE4oiBxXTIYAJVS0jk68wfMU/s1/XSESQ6YpTIyl2U46/C+Yz6fMx6PuXr1KlevXpWijaMxzrnezd+kdFXqpibvJPeT52LFGgaf6dnro+CwApvjnGR4jDCyXrobnBePqfFEAlEmfwpAoe1jUyb+gafgsH2GYCJzYvBZ1a79dizvY9rnnOtdkYVpHztOU3/J9Y7ep/f2GzzDkPpv2nTp3WJcAZvRA/tnduokou+8esZVtXK5hlxYm/EIRW0/5xxFnovdbTJhsrbGSNORuUEW/tl0RohRvC0nE8ajMaPxKii38xLnhtp5xZFExjrKp6IC2DCbTejjHVNaLSnWOnAkBSNOJPP5oi9bc7oW6oSXfT902uXPQiecK2Pg+N4PiWc+jk64/GnPcpx6U4Oqe0UTmDIWySWOj+cVxSObCYFQL1nu7zHffUh9uI9rG0oCpqmxJiGlXFYe0zip4BsgGisVYE998tX+p+v/k6+XJvGHQR/elT7YgEmFPmWVsbpW8kTTbxgMeZb3sWIoQ6q1zEbnNX+a2hjkAkO1HAM99HB7PBnEZlZmGblzBO9ZzufkmdPYpXXGo5Isd4zHI4lZUsZnjUh2UQetMGBhlJmVBMn9ir+fAANvtqgqw2NbcgpIW0qzE/rYPAAFOFVThhT0q4mP++THyeU9/Q1igwxIIGfK7m2cwzoJ+nVZQZblFGUp26ikLEeSR1L/ps9lWfb5HcWbs9AQBNlW39XDM8vFHd7J5pLnZ/ruNAyBgScn6bu0b9okoXIKYciwRtOLGacu63JcAjZd/sBgQbNKUbYCsSHJcfpZOUGWix0vgX+m3qhZJp6syZu17TxdiHqWxVonXpOjEdtbm7z0wvN85jOf5o3XXuO5Z59ha2uTzFm6rqFpKoJvgYC1mhxCFyICaJGuExfxVTXyVfIBn1Kiadq3iDgILasls/mMqq4UKI/PkYGfwYdAZ2X8J9HTnivHP8UJT0HCtx699pOeUbhUIIhDfR883fpA1LkXo3LF3mXfY+lwsSOPLUVsyUNL4Rtsu2T3zm0W+3vEpiaPgZxAYQIjFzEH+4dRym1nYGQVbp1juazoUrolZUCP72VlzUe8WE4iowz+5FY43h9ptQmriXWc4gnnnUbH1S/yfiefPNx70mQ/KyVGIpc4OjDSJ6Pv6UMgzzKqasmdO7d45+23ee21V5lpdvJIZGt7m53dPVwukfnD8jG+83S+lawkRvpjuBJaMcXBdyB3DpTZxxixWSYJfcuSGKFpW+q6YVlVIqVp9W2XvAwRW5pIleolmb4jL2+EM8kqW9WRTj0rk00pMS35q6qlFLOm75AknCT1OKe5H1VqTFKP0WBqUl0yK9+jsXQ+EFgxyQgwUF0KYKrNpt9EOkxMNcoBBE3Yqj15ZKz0EuPgPkOG2d978LdPi5cusnr9R2agPGv6rNKIjrjV/eTZ0T4f0vD50sVF0h3aFOVppD8jAYlllavrIib1QV+fTtZcbdtgUl+GYRyagqi1YB1dBKzEjYUQqOqG/QNJ9dW2LUVRsrGxiXWOjc1NJpOJAGie8/wLL7C+sYkBlsuK3d09vvYnX+Xb3/4Od+/cputaNtYn6vLdcW57k8999jP80i/+ApPJiOg9gdBXxO7HYt/eUeIdU6P1fZja53ivPEqP8J0/B/ow7xGPxK1y4jsOW+hxFEzExyDJydVfI/pA7jLG4zFlnmGN9I0lYGKHCS0mdmQmkhug62iWSxazOe18ivUdLvi0/OgBN8aIme4fxC5YATWbESI0TUvbeYl1MciE6N1rH0/C4J58pLDBJx0njGU1D085PnGBM9CQCaRzTgK14Z4nrUSeTCu1j/xz9GJJYkOfL3OOql5y+/Yt3n77TV5//TUO9vc5PNjHWsvW9jnu3n9AXhQYYyRYWUX5TqUTowZ4ucEKwFb2kpU6zQIOYeoCQhHjHHmRkxU5GIv3gbbraFJsnPZLsnGYpB4KkRg9JJVQlD6MrFZp6N8V6AroJLWcS7WxkkrMpgwliWGu+iP1nTBuuVFMEqCXRL1hkO8xhICP0CioCQNfqXaPJ2fuQeIIuCUb3wqEg5YySe+jD6XPkgBNGk3G4OAYhHOkYWAiIuUeHyd6XdGWpd/SteT7CrS0nZELpri1fiEjjZ/Oks9R2mNom5RjZU7HAZgbJ/XrYowYVFrLcpyVvJLSRiJxr3jHwC4it5RntI5gMuKgEGtEYpoiogXoukDTtjRNt8oLmeeMxmOef+FF1tc3MEaKgx7s7/OVr3yFb3/rW9y5fZuubdjcWCOGjhg857c3+fznPssv/9IvsrY2IQQJEzBWxnNvo1t1Tm//W9FqbKTvjyP59cMDnZPoQ71HmrD6Zcg2e0pJIp5AwURaAtGCiTaFmuGspcwKitySOYMjYGKLDR0utjgEuGJT0SzmNIsFvm6g67BEbJSxJONKKAKmOtiPXbCEKMAWjWM6n8sUNRDol3/HptjJ9OGCGoPB8phjnxbUBseeBGgM7nYWQHvCz9LQA0+u43ftP6udIM9zqmrBrds3efvtt3njjdfZ39tlf38faw3b2+d48HBH0/4Yuk7yJKKVyWOUwolJmjG9lJuARJ9B91mQPg76jEYCr63TlXSKR9Ng2kd6JJrVZIoooCrz1NW4VXfsYbmYtPo1A0ATNWVqpRWTHoYsBDUyd+oOnkIF5O8qZVPaF/pq2Gm/OA7EmBwtVp6AvXSZkFhfMn0XRjdgaGmfNsjq6fW8I4CokkB/0cG5xz5bexzSdBA98nnVj2m/fB0eKxlGtHP6MX1UolUw6uMFdcFjV7+h7RBjlOTEaSGB0QwtmaijjUjAIu0JQAgnkbYTk4ccZo0hWkcXDaIxkgVXqmyQFQXWOmKU8CLvpR1DlDi1PC945tln2djYwDpH07Qc7O/z5a98mW9981vcvnWTrmnY2lwnRk/wLee2tvjhz3+Wv/krv8zaZLwCNW2T9I4oM49EUX0e6xE5Bm2v9Pl0kiOefNwRel+HfwjAFjkCav3u4XWfAtS8IInwImxfKsYZQ+EMZe4oM0PsagGz2BHbGl8vaBZzumpJaFpMCBI2HwM2LSQj/TMawLR7D2OIGR5LJCMYy+F8kcB0xeQenWKPkpEHPd75J9HZQe0M9DSg1jft40ne4gyANmQep5J2vWTj7N87nWmQtiNK/MaoLFkuF9y4cYN333uHj77xBvv7e+zt7RJjYGtrm/39QzIt7pnsTQbxWkUnp7OOoih6/tYz4mOfRYRKg1NX8RrLpDyrX7GHvmyIghYiDhhtC4s4IORFgdV6YZmqBhO4rZipqHpQySdJS77r6DTzfte2tL5jWVdiG1Ev0LY7mvQ4BplgCdRJko8+v7yzglAUAO9pMC8To0rS85FJewx4hjM8HJntQkcBTRikc9mRNcBRLpHOUfXskV9WPEZco4X6sZOO6T+t3tv0iXsH7TLoU7GlJeeUFLCuUnPvuDIAWQNFkbLLpG1VB80oYhlkMaRvpW0rqd/SGBKpzNL6QEDss6i6GCMVB4y1FGXJZLJGnuUY6whB6qUBXLp0mc3NTVyW0bQtu7t7fOUrX+Eb3/g6t27coG0azm1tYC34rmFzY53Pf+6z/K1f/RXW1yYErfGWcmfGJFVrf8d4urkkvduxln/k6/ul9BxPQ3L40593hOJgwB37YcUq0rs/nqIeF2KAKIski2QjMjGQO8OkzJkUjtAssaElNkva5YxqPqOrltgoYGYjmj7Qy1jS26/UkBGzuPlOzMs1TFbicVStp+48tfcCauL0v5ohp9GRVeoTjv33CGpnJWHYT6azgFrf8Sb27XNSq8Yo8Wej0YjZbMqNG+9x89ZNXn31FQ4PDtnf34MY2djY4MGDHcne4HRwqLSDukL3oKEjMDGX1b2Gg9FIMuDE8JVRJYeNiGQGcW61gk45A/MsVweB5CzgMC45F8mNQwz4ztO0DdWyolouqKqKppaCj13b0tSNVBtIyW19KkorjiMmc/i4KgkvGoHEKBODVkDWvosqLYiDSezf36p9yCTJdNAeCfjSzA0p+epAPdi3XTpWuLTu07tEBirMFdsTD7+jY0bG0GpfNJFW3dpXBw17T46NGq94fKTGgTTWHzi07ek79O+OUWcZkaTlXRLgqbQ9aFdjpCJDchIRqTvDqCNI2uecJA5O15FxJVKjQS5k1AlNgnL1ufrmTX2iXaJewUVesLYuiZdH4zEbGxuMJ5KP0ofI3t4uv/f7v8/XvvY1brz7Ll3bcG57izy3BN+xPhnzmc98mr/9q7/K1tYGwUuFbKtAK6pX6XfpywEjf4TSD0cPeD9gdBq932sdneNPSVEH0mNppXZ/EkWTbLRpAaQr5hAonWFSZqwVGbFZUE0PqGYHdMs5JnSS2zEGTBRHO2shhE7ELh0cKwc5MA++/pU4Xj9HubZBtAWzuqUJkTbq2c4y4AeP0iNS3NEJehp9aKCmczcODVPvhx55j7PRWUANVbcIndY+ss8YQ5HnHE4PBdRu3uSll17kcHrAbDojxkBZlOzt7DHWCs55IV5nKaZIHCakhZum6ZkZCgKrwS6TVb5KJpmoz+A0ADvo5E6gmTKFZOqUYRSIe29DTay7bFq6EI54IgpYic3Pdx3RC9jJeJRBL9cSFWA/Tk2k9Q24VQ/FpDbU84IWukySKsikEVua2NQSZ7IIkzfJZjMMAxg6i8Qozyk37I8VJqeQMGC8q37tn/LotNG+QaVhGRMr22YCot5DrJemBltfj07vkd5VrroC1+PjuXepln3a5Ekp2AOHcVpMcwAksLLjyXNGQtBwnx70rLSsEY/XpHYuirL/3SRPySwTe20qcuoyJuM19eQUMHSpqGcCXyMqTmOs2kpXTkijkTg0lVqdvPOer37tq3z5y1/mvXffwXcdFy+cZ1TmBN8xKgs+/alP8Hf+9t9ie2uTqJ6zPaj1k0LbZhCE30+d1Z5jf49S5MST3hc9Lbj9RQK11QCTsWuM7LOo56KFPHqq6R6xXhLbithUEDpyZ8hS4mzv8VrGJolp4mS32szdP/qd6IoJ+doGtlyjM44mGjoMOAfOKUNgMFmVjk+ctPORfY/SBwW1I1jS26uekgbXePQ9nkB6+JnOM8dALQ0W0//T/7VGUlYdHB5w48YN7ty5zcsvv8Te3i7z+YKiyNna2KStaoo8l5W1UgpGlcsagvdUlbgtp02AYOgIEYlYrMkIYQViol5cecfpJdXmlRh7EGDynhgkZZf0hKENkS4m54sVmIXgiel4HwjdCrxikNRXKc5IJDUIeDpfE43v41vE1T+l2xrGKGnxypBileS41ecAwRMGBSPFozHlEBza1KLUmOvBX98bdRRRJiOMK/Wh9GMCIZFGVOJRG1X6bSVRa77NpLqzBptnkFS1TpM4q/Qjtk65blHkep6CiZHYs7QaTmrDGOiPERWjeqIKGwDlYcY51UbLb8kZRGyaCi4gkkwYsLQUFmFSomDl5X04kAKublZBLzktlUVJkReMR2MmaxPWJlImZ219nfF4jMslcfV4PMGQ1N9qv9NrR63ztqwqbt++zVtvv8Xbb73F3Tu3WSzm5M4yGY/Y2tzgk5/4GL/yy7/E5UsXBdSi2NScNb1jnPTtSsKQbcBpVh0/+PsoHeFNpx92JnoaYOvve8bjj1BysU9fT7zGU4BaSIoqGRvGqG01BqxvsL7BNBXdYobrGlxosbHDRq9Z+PUymh/UOit8VUewkHw29//wt2MbHZQT8skm2XiNBkNnLNE6ohUvp+MviU7cR2k1sR9HHw6o6fln1O32NLjto291Bkq3Peu5R9Sj0j5pVQ69ixoomORZzv7+Hu++9y7379/nlVdeZj6f0TYNeVGwPpkQ2hYLtKrWE9tSknCEEbXqTNEz4gRE6W8vgluMdaoCGoAYA/DSv8rdiVFALG2yX0BNCkNIgKXEh6V4MYmx81qdO3SqXlRVY9elhMidVlpv6VpP5xuadon3tcQhHbOr+U5ThiVwO+IYMtivDiUxdBqNK4C6ahvZZG5ImwXNMi/fE7Al5jIAtcHUknFxDLiSOjgdo30vAGdVJadM2iBMXBm32J7UwcZqsLteL8vFOWNo/8pU4pFzEtiJ92jvpZhl2EyOtxpojZHg6yRlGWNEjdyDWnp2Gb+xT61FH1Qrx6ewjYjX9kmOHelzGvLJWmUiFEVBUZSUI6kMsLGxIYmS19cptGLy+vo6I03JNRqPRb05CM4OmgW+qioODg+5f/8ed+/c4eGD+xzs77K/t0eMno999A3+7t/521y5dKkfy8aqQ01YObXIn9jP2yGleaID5shvJ5Ec8eTjjtAJh6/u+2R6v8BmGCy+BycfvfXTgppUrAbpcKMpr0xbE5slVAtMsyTzDS50ZHjxiNT2TVw+Js2XGbb76q/Z+aPfjk10hKzEjTfI1zZosHTGEawlpjxr6RqJTpTS9IcT9x+lf2+glpjJ8f1PQ6e++8kUTUoFE/XN+54dHCVXdNaSZzl7e7vcvHmLvf1dnnnmujJlSStDCHR1Q+w6qrqmquse1EAkrKgZ/tPCQyaCTlRWwCU/CiNKq90EAgJSwAAwTK/HXl1PJDaVhLqOzgc6leC6bgBivqNra5qqpqkrWq3YHVSSatuu35rW0zYdXevxvqauZ3hfK1AJOHVdJ0HpnYCXPI8O/4gO9KSuS+8awURcn3pJyax6VJi2kFVJR/oqXVePo7+FTDb9sV8U9ICl6jkj2TKOH7cCytX1TArHOELH3kV6sgfPXnWX1HgpBMI6rBMHi/73LNNq5PI5AZt4pkp9tbwocLn8xhE1qFwzqU7TOA4JB45IbAavoCgAp+CWJFm1r3kfxB7br+QNo9GI8XhMMRK1YlGWrK+vixS3pttEspbI7wWlquTTM3sdI7U6Xn3j63/G3Tu3uX79Kr/4Cz/PxQsXelCTtYJIasmmJuM7zc6jba8HrADwz4FOAjC53/G9p9PTHk/iRieoH49e66ygJuEipld3yxy0BiwB2zXQVph6gVnOyTpJUOxihxuYbgKR0E+64y8k1wQwD//gX0dbrkE5IRRjvMtpcXRGpLSY7DMaFCpnpU4+iU7r/KP0QUDtCKDBU4Hacabw1DRgeGelaCTdj9CwfaSz01ejTDSGyGw2ZTqdip0qembzOU1dCQi0LdF7TAi0vuuZelAvLatlg7oUEByjxCklaSvopFVphGgIPgjjVeeDlJmjBy2N9xJwE6lLbBECeN6LZOU7KTszny+oq4a6qWnrGt+1+K6hrpbMZzNm00Nm0ym7O/t9z0m3pvbR9FEmw9qAswHnBnFWiH1J0jlJA0YNaRgec2QSmgQ0ssDoGZeee0RKVQbsXDaQqtJl5IMZjCdpSZH0klNKTF5zCgRgRP3a3zW97+o6/bV1WBwd1foAcfX5BL7T92OiGA2tD5roV+2PSdXaS6By0yyT2K/JZI21dQUNlYiyTAHQOfKilGwp2aqCtMSVGZyTODKXZTRdJyVikhu+LNrFTi8NqG0rf51z2EzBLSIqV60ggTGsr6+T5zkuy8nLUoqWTsaM09/JRLbRmM2tLXGmMoY8c5RlhjWwt3fAdHrA2mTChQvnRRUetejkMZtaAjXpmRMaW3tIxtnZeNDT0EmgRn+/43tPp0jq5LPRhwlqBoM1rpfsPRGjC0trIlloyXyLayuWew/J2oosdGRRnUSMzGSPmDRiDOJN3fdH4v7qqf/g9/51pJyQrW9hRms0ODqb0RorKiQrQaAiKp6FZHA+QiveLV9PaLAjdOz4o3Tslz8H78eeHgvgZ6Oo6XlcJoZuWfklQUicMqx1ErMTAtPplIODA5bLBT54qmpJU9cCKjESfUfoWkwEHyQNkKjVlJFamYCd7wideHYNAc30gLayHbRtq3N44FrvOwUjTVHlPV0rHop1XVFVS6rlkrquaeqauq5o6oqmaljMFnRNS9s2Wj6kBc0AoPxJ2kAHKKjKKkS1z0jNtRiRge/AGnVzPzI3V1+EF51h4hrEnjQYY0f6OKnbYtC4K/3d6O3S6t1IsC4m0naShilRD1JJskFeOqbOV8CNUVWeCBhZDUQ3OqzltJUHorSRgtIgfCPZ0egZmPxN9+28hGKsFg39kxLVFuUVaURlqq78KnX1CwUjqk9XlNhMHD0KrTqeZyLdiXozx7qMLM8xzmGsw6Sq5UZSkhmXntup+lLaml5NK4mS+7ACzYkZY8S6TJxDRmN1lipWBUuLktF4wsb6BkVRkGVOi5hajIE8F3DrupY8yyiLXBxX9HdZjMjYBPH8FRX7aXwgrsbhGRa90j+nj9N+HJ1+yBF60vUSnfU40rgZqB9PPO0xwsRR8BN+hKyfJWJtoH4UAGvJu4b2cB9bL7C+IY+ezIL3LQYIBrxe16U5hQgNck/519z/vd+OZrSOW98UUDMZ3jpaLB5JKSQhSxLB/WQ6Pml0Yva/pV2PWWmcYWAcoRNu+aHQhwBoaAeHGHobie4kBnHxNhi876jVxX16eEhVVZL/rtWkxt6Ly3vXYmIUm5qRtFpdnwVjJW0IALXqoqxSlvcCiF4zoQfZgpfaVeJZFOi6lqZpqKuKerkUsGpqurZlPptSVRV1tdSclK0830D6sxFsMEiGElkFC4NYqXhELSaOJ9oc8o8RJmeMZqzwkRi9qAv7AbOaZGcCsWMUdb7KGlOkKaPOB+g1QxAHEnFIODYGBmsoYwyRICnlCDJ2EygpiPSglniKnizjQkEtyvFWHScsuvDrQU2eUZ4tFVqU1GhDpwuSzUo99pLaM0QNIE7AyiqrTLpmjMrAdXEgf+Ua8k56fWsIxhIG7yntp2BoBcSsc73ElmUFWSG5MF2e43IBQpdnohp1AoRDALM2pT+TnJhYi3EGm4nTCAjAYq0AaJaR5xl5LgVpR6WoIlOB2rJMlbxH5HmmA05esiwL1tYmrK2t0bXiHCTdLup48Sk4iResxiSpz89ATxq3Ty2JPeF6ic56nOFRm9ojpz4W1PRf/Vlmr8zgpEJUyzt57MhCR+4bwnxKXEyxXU2OxyHzHyQ9m+gCLE4DuOUR9SnUDGDu/sHvRjfZxE7WCcUEbzM6Y+mweEQ/7ozBEJ4Mauao08Nw99F9p1+nP+qMgyPRUx7+ZPqQAA1kJSF8S+0fRtS5MUTyLMd7z3w+ZzadsVwsWC4WmiWkpalrMAIOtcZ2WYOq/4IkjNWs/UEzbUjwckfXNsQYCF1H19S0dUXX1Lo1dG3TS2JNXfWJg9tWQK2ta3XESLFjIjV2GvQsgJVUgjKhJZGxo7AZNpp+FWXSXxQR+oWOSERyjQHzTGCnSWqH6obhhD8+Sc/CVKIyeeH7CmoqIaHXTKo5CW1YqaRS2ET/LCrxihomvWtSVQ6km8HxepBIXeqEk84TlasEseuBR8Z2TA4Xeo4AyAp45THl2ekBSdpcQDupR0XCk3eTRzf6THJpXVnrMwznrzfq2ZpATcdeVKcawypJMmp/k8TNAk4ioWUS3+YyjMsxVpNIKwgmh5WkZsyLkqwocHlBVuQKhAKAUR1cxB4oMZTWiISXaxFTkeRGjCdrjCcjBb2SPM8IIeCcZW1twtbmpniUDvoxqPf3ySMrjb9VH56Fjo/bk+hpJLazXI+nOO4oqCFPc/zUx4Aa/WOnQaSgliCit7hGsiiqxtw3mHpBOz3AtBU5HSZ4nEp1PgqsWeOwcQhq2lYJ1O780e/HfH0LRmt0WYl3Gd44PEa9lYRRGfzpoKYXNmmCHOv+Rzv66EAY0qPHnoGeBoDOfNgZDzwDpYaX1TKSJib9GCKLxYLDA4lDa5uGpqlFMmpEMhNQEYN324iaq+ta2qahqmqapiVopeDlcklTVbRNTds0LOdzurahrZay1RWhFUDr2gbfNoTQid3Ld3hNOxW8xI9ZDbp2NnnRqbrLGMwqAYQCkbySCWCDBjkPuIH8if3qCiNJkK1BvPTUdhv8IBBWU3NZl/eWWD37hKUjZ17drEBNSNR+qr7TMiYxSOJe2SfTNx1njDxE0KoCogKXCxrkORJYpp0yP3RK9wAyVD9qORgF9/5a6f76DKnNxetRg6UH1xLJWO9pDMZErBUbxvB3ayT9lKh8xT7Ztt1A5ah2wIEkB5L2qIsek1mNV9RF2iDPY5Laus5Lvk9lYSGKKj7FRGIM0WT46ATYXCaeuEaKfWIteVFSTiaU4wkuLwjGkOWybzxZoxiNcVlOOSopx2PKosBiyFIguQJ2XogjyXg8ZrK2xtqa2A3zTDxNs8yxtjbh6uUrZGrXM32/aTzliTTs+7ONv7OCC4lhy4dTabjQexyd9b6PgtoJ93gCqDF45BhlzK/2pfaKuOgF1EJL1tXUh3vQLMhCC76lcBYTPSFKIojMZhDEH2EFavrXgLnzJ1+O+cY2IR/RmpyY5XirqseBzcdE32eSP0K6Wkt0HNROBql4Yg+dfOwT6GkA7Snucew1PhQyxvSM2Gjes+l0yv7ePrPDqdijmqa3T4Wuw5hIXS3FAaMTN/amaTicHtK0LdWyYj5fsFgsmE1nHB4eMDs8ZDGbsZjPqOZzurYG3+FiILOSvLjMHHnmyCwQA6NRKYx60J5GJQYz6OPELNHVuVfHh+QGDhB9xLfdyglGmWsPOCZNkGQspldxSxybgFrmREsQMGDcmay6Z520sV+ACQmIJlBTNa6q9/q317ZJ7ZFApAc1BKhXx+unE8ecqGLk/CRVrSoJ9NfRMZNi6WIUADKaBs30uQqHoJbsltL44gARsU6uJVXEwRjbJ3oGg1OtgTxOegdpk96zUeXSaALGyYJXFr1A8BAU1FRCjVHHRhpcoqTVa5vefuqDVqjWvvEhUjUti7qiaT3eWIzL6CLMlxVdjOTlmMn6BuubW4zX1tja3mbr3Dk21zc4t7XF9tYWRVEQY1Sboqgq81xKCpWjkQDb2hrlSBxh8izj2rWrKrEV8r7ei70tPfcR6tnpsf2Pp7OO0yFF0gQ8mR4BnRPorPc9CdQ4fo8zgBr63HKkXK8fWzoiXPRaYqajiB31dA+/nGLaChc9pTOYKKYSQ5TsR4pN6frpYhEwd/70qzHf3Ca4khpHdBnBipNIclHKrGSuXtk00kUehRNhesP9x4+gf83jdFbAAbnso3d/Mp3lHpFTHvsYneVaieRI0zMmg8TD3L93j/3dPZYLcQZpmprZdIpvG2IQxwzvxSV+uRTgms6mHM7n3H/4gHt377O3t0fXdcLkolSGNURxzAhijLXBY6MnMzDKLJkxWuYhZSfXgZckB20EWa2Kai5qmiLpYmW4RrzefApGVkkmxsQME+NXZqybHCf3Tc8rqXBknFnx5SCzBmMcnV9NimONepRUmnk8HVUJou8jkpraudSmZlQiSs9tFGRiuk9MEzttCuT9PNDvqxvJ1xMktQRWYvtKj6dqyhRmkZ5VnYtWQJauJeetnlm6CTzy6FGKZ8YAmhot6EnWOpquk3sa04PA8FlFwg0YJx5sRgEsM0YWKBgs6u6oTksCcGLbk+us2gIj9zUmI0axo4YIHuh8pOk8jQ+0IcpC22Z4TL8vGkswooIUqRmKPOPqpUtsrq+zvX2OCxcucu7CBSlPY52o6EPA5TlFWbC+scH62ro6mYht7fr1Zzh3bossy/C+k3Goj32U0ss8edQdp7OA0HFKY+5x9H6u+whFTgS14YVl5D/5RjIzxBq2Gti6xYiLAYdKa3T45Yxmvk+s5xQmkpuA9R0mBqkmovXY+mE0uA+Aufetb0S3tol3BTWWYCzROLE0qCrBKagdp5OYurLrwa1OInnNnvTQ04bNI/Q+AY1Tnvk4HRdph2SO/nMmMsl+oS6tKIOo5gvu3L7N7PBQJK7plLoW5wyxmXW0Tc1sdshiPmMxnzM9POTB7g5vvvsOVd3QtC1d57EYnNo/My3bYgnQdWRA4aB0ltIZMgNZArQgIQPiji1vLE208tiT1zWQVFGJwQExruKQYv+yjhAtPkQ6LdTovarE1NYiK3xDmWfk6Vl9JxKlgSyBndrsZEUvz9C3a+rLQVecfVyslmjp/RKoRZXUgmaZ7ysIJAavzjg9GPVtNhwxq2ft2wUBmfS3BxTlQUZBTd53xS4SqKX7GZUqjZUE07Jw0BsNwNekvlMJWP5KhQIfg9q7xO4VAd8HTOsWIp2CqahqpR+sg/G4EOlPlcLOaAkjo9+jtLBBbHn9gkBB2iArGnkXJyolHV+tD7Q+0IUopSID1D5Q+0AXDdFJVv/GR9ogW0A8PLtONEpr45K10Zit7W3OnTvPxtYWk/UNtrbPsb6+QV6URMQTbzwRB5HJ2oTJZI3xeMQz15/hwsXzjEYjDOHPCdRW/z7N6cNxdxp9YGCLnAJqidJ8V2B7zL3EpyABoIMoau00W20M2BhwtOR46JY0s3265SGlEZubU02T0zv7gSB5fOqZh9//ToyjNbzLaXD4SO9eK6tn0fM/0pCnAstqMp9OcfUU/YM96ZwVnQWYTqOznPtYUDvD+cfJ6GoWBQOIhM6z+3CHe3fvsZjNqBYL9vf3qJZLvDpwtHXFYjFnPj1kb3eH+/fvsbvzkHlVcfv+fYwmF0658sSsE8msqu5iILQNhTWM84xx7hhlst8Gj4kegpZviWL7WDHEox57qcf69EkKCiFGgpHsIanKcOMDVRfpEpMMycsPBQ+VSBBJbG1UMilzSmdxBDIiTiU3S6oKoHas9FRp/PWgq219hv6RdzkOSgpqJhU7lQVI8L63K8rvapdKwNaff1w1OlBvHn+k9IzaPv1zpMwiRiQ1ae+VJ+MQ1NJ7Jwm5v0T/HummkRD0uCFohUA0Rr0KJY6tahqWdUMXwpFNbOv63Fa8ocs8I88shcso8owyc2RWNADOGOk/fXVnxD6axlV6TqOg6qwht4LynQ+SUSZl7XcZbYS68yxbTxOgi4bOGAE2BTUfRK3pA6pqj1LJvSgl6fHWNtvb59jY2mZTt8n6OkZzUZajkslkwvr6OuPJhKtXrnL16hU2tzYgJlBbjZcVpX0n/XY2iugkOyM9CUQSPcKzn4YiTwA1ekDrZ8Ept4smSgIHA0QN2u+BTUDNEDTYusOFhnZxQLc4JAstuYJaFgMuivrbO7HtIo8hf3XSmN23vx+7bETIclrjaLqAMU6M0LoKA9NXw9GvjwEhc8IsPk5x1QKPvdYJ9LTHH6MzMb0Vz3mEznL+cTI6wCS2QqhrWm7fusXOgwfMZyKFHe7tsVwsNNZryWI+YzY9oFouuH/3Dm+99RYPH9wnH48hzzB5LmomRN2EMtvMIOrFGHDBM8ozJkXGOLOU1uCix4QOQoeNEusUUqyfMeLIMlhVx6FUFtTt20om/rSab7uOSitjz5uWRRfwmoAWddFHVZgy1yJ4j28aJqOCc+trnNtYY3MyojBIzrcQcCbiDH2uOLQPeoDr/6765Uk9lCrxylul1x5KErF3FvGaBT+52qd7J8cJkaDE6UJkSyH5uxpB6ZVj1HZOi4LkgBERVV1vfxLmlWIPkVPoWasCagKqRD1YqKpR7J4GHyw+ChhGgySbDlLh3BNZ1DUH0ykH0zmdqv9CGg/O9VUXIkjwfucprKEsciZlyWQ0YlIWlHlObkUbYAGHqCXFdrrKRWmMkdg1a3W8emLX0rSdlKExFuNyonU0ESoFtQ7LoumofaTD0EboIjRd8j+1Mm5CwOrYtM6xubXN5WvXyYuSvByxuX2O69efYX1zU5IqFzkjtbFNJhMuXbrE888/x8VLF4legoBPBjWkVRJnPe2Qx1A/Vp7i3LMA21mOOZUiZwY1nnQvE1UmRkHNaZyyLsSR3x0dNrS42BLqOd3iENMsKPASoB0CLgY8ns5BsHLDHtQ0laPZefed2LqCmOWSzLjtdPJqrIw+l57eT6zT6XG/DUltLMd3P46eeO8n01lAKXLya5zlXE4Y1yZC8J7c5b1HX9vUvPfuu+w+fMj04IDlbMpyNmeh2TYW0xnVckHT1OzsPOQHb/6AhzsP6HyHzXMq35GNRhRZLs8VI5KROJCretEFz0aZM8kdk1xALTNgguinrSZwNVYHpTytDIxeIlLmaSRm0UcDNscbR+Mj82XNwXTGbLGk7Vppt6yArCCqJxtG4pYSW4iqMsN7QtdQzWfk0XN+c51nr1zi/MYauYnY0GGiF5sgaFyLjEF51LT6l+cGTljxHv8u7xqMlrQhAmLfS1JEVLvRqgp2CsVQT2Arbp+9p2gAkU1UwpLZ+8idY9RckoZBW6xASxi92tSSPbKPH9PxlyRFVfma3ktZyJi+51TV6OkChOgIrIKefYDGe6Kx1F3HwWzOw709ohHpKCUzN7p4icqWoo5nF6GrG7wmhi7zjI21CZtrEyZlQeFEaiucE1BTm1vqOgFvaUtrIvhWNBQxijoyL0RK81oKK4jqsYuWedMyXVbMm44OQ4eli/RqyMI6TNdB1/Vqax8im9vnuHLlKuP1DYpixNrGBpevXOXCxQuSNaUomExEBXnhwnmef+F5rly9omrUE3wKAOlJ+Yv28fulpz33sUCidJZjTqQznKNvfPT7Ce8wrKCyAjPhMoOjsNFjQksWPaZdEpZT/OKQ0niy0GhFbI/HE5xWsRhct+dbD967FVtXEIzFG/Gkkolx7Jb9rEls7ynorOB11uNOog9y7gl0EoBFjjXKY2jYtTYanHESSCzRfwTf8d577/Dg3l0Od3eZHRww2z9gOZ2xnM1pqopqWbF3sM+tu7e5eec20+VcOtI5gnDh1T3UnpEZyEJHET1rmeXSxpi1zFI6KK0cYxJzVqYlk1ZezSFcOXQdozLDWkMXO0ltk5d0OGI2Yt5EHh4sebB7wGxZawYJCY7N8gJsJrYakxLkJoCTMRaC5IvMbGQxPaCaHpDjuXp+m5eevcZa4TChxeEps1yeW1s2Taa+PwaNbYykVkIXEt53Ol71rCir6hAlCbKIotImNgU4oxLOoHI2MWK19I5Vj0PJwuE1ga8Yr62RIGhZY2iexyQBKoOJCjhBKwTIc4uUlrL1S+ozkRh70NMXFJWlSIjOZUSdn0k1LEAoLRSU0UdjaUMQpaDGdrU+0gV4uH/Ag719Gh/IRxMBNGshpSAzaYTINU2U8FfBogbfNZgYFMgiZeZYn4zY3txgbTTCDlTiVp+vb+s+LCK1gwKzDsgQVja+LhqWnScYx/5iyd5sxrKLtEhcbReldKTY9ALGew3mlyWRD5GrV6+xvX1e49XWKEdjrly7xqVLl9jY3JR4trU1zp0/x0svv8S169fwXavj71GGLZRaZ7jnSWDy2B8hHXECSCQ6co8B/zvt3k+63nGSQ89+/GkUSUKfwQ6E2v53VbXbKCaHPAZsW+HnhzTTPUZWQY0GE1tC9BiXiewX9QYGyXVqLObujfuxszlBV2Mo83ikk+JKbXL8t1NJDzzrGScByVnpg5x7EqXV8pDO0r0nqS5ttBQ2J3SBEDuMjYTQ8c47b3H/7m2mu7vM9vbYu/+AxcGUZiE5HutlzcP9XW7cuc2dnQfMm4pO1UI2cyu1kxE3fUckI2LqBSMTeOb8JpcmJesZjJxh5NRobx02yzFZRrQOayA3VgYVBhcNFk+eGcDjbSRa6GyGKdfZWzTceTjnwUFN7Q3ByHWMjVgng8ugmSmUoWKEURqT4r6AGHAm0NVLFge7dMsp59ZGfPqjr7FWuj5Ld27tQHUbB/+tJnBMTglas8sggdtH8leqhCOCrWQ60eaTCad93oOBZlvxXgDQGitJgK0jaAHVJKn5GIlqf06hAeIeL310NC5NMsEEdc4xiNt7ckYxxmpNOXnePp1ZYhDpvTUriACDCOpyWAIL9SSMAaw49Pio/eFy2mCoWs+9nV0e7h9iswJXlERdfCTPR6Mqy9TORANBMn5IsutOvGsJoqqLntzB2njE5QsXWBuV2oeigs80rg3lKz7SezBaLdMkibO1vI1Kzh2GJgTaaJg3LTuHM+7tHRCzklZja72xYlcmQpDwhLREb5qWK1cE1CbjNUaTCVlesH3uHNeuP8OVq1eZrK1RjEZsJ1B75pp6fq/64Dglzf1Rkn4+mVIvPpmeJL2l8T/kfxFOfdYnXW9I/Yg7+yknkkj60gcJuOShda4ZQzACeC5AFiNZUxMWM9rpLgUNLtZYU2OQDEvWZqCLOPknZbQxmLs378fODEANXS2tjtUnE1XHU9FTSnUfBJg+yLkn0YcBaukKBouN4v2I2NqJoeO9d9/mzq0bHDx8wOHDBzy4fYdqOqVdLunajrqq2D044Nb9+zzY32XRNLQIEzBZRqeSgLWW3Eoshw0drq3ZHmW8cv0KGy6ynsEks4wyiTl0zmHzo6BWOIcNIqVn6rAgRbiAzBEzh7cFh1XHzft73N+dM6/B5pID0EfEG06W4sKMvBdnA5+cRQDNHG+tU0+5QPQts/0dQr3kuauX+MQbH2GtyLB4XJTijRILJaMyxiCqsMRkB5PVueSEoiMvJnBaJV9O10DHzbCrV8Cz2ryXGm0G+sz2UZMnp+oIknRiAGqaIV4Wg3KDoOpHr39DeoYU66UAgrGay5M+O4i8X89m+msaI8VdvReHkKj7IJX+0VhCZSAS6SMqRh8tjY882N3nwW6S1MaQArp7T8wVQxCQtUSbSTZ+xDmpl+WCFzAJHQ7YWl/n0vlzrI/H5NbgdKzhBbQMiMe1y4mqNZCW1IVIEM/cEEXH0fpIEwJNhIP5kht377P0QaqKoKm7jGgk8P5ILbS26bh8+QpbW9uMR2PK8URUjusbXLl6jWeefZaLly/h8pxLV67w4ksvcvnqVRnPaUvjpP90Gqih4+z4PvTsE394hM4CQrIwWj1BRAfyCXSW6w2pH3FPd9oRkoWt9MGpoIZ4z9oAWQjkXQvVgm62h+0WuFBhbYM1kuLPWskXKzdIc0HuYe7eehBbkx0RoNMkP24nPC42Ppb03P9/BTVIbSCR76ELmKigklli6Lh7+xY33n6Lh3dusXfvNvdu3qRdLKjnM5qqpq6WHMxm3N/fY+fgkGXb0mHwxoB11Jqs2DkBtdg14Bu2ioxnLmzz8rVL5F3FmousFY5xZsgzSU/k8hyTSSUGAxSZw2ruP4kbsnjvcVlBzDKCdSy94fvv3OLu7iFNZ8CNJXtbFLlJGJsn+FYcUaLHR/AKaj5G9fBzvUs/MWCCp15MGeeOj7/+Ea5fucg4d70zi7jUS5qsSPI6FEbfqyAQAEjPYa1U53bWCrimytypUGlMeR3FhhV1wvf2vtSFxihwSdkfqfydESNHSt9EtREYKymb6CW1FSNMHqJeKzdHlRqdE5VmGsMxirdiAqWkhgRh2EmVI88noCb5P9MzqzQcRCL0vhO1d7LlGQnd6aLBuJzD+ZIHD/fYO5ySj0aqdlSpMW0D9ZY3UpqqjfKMqf2TI42NajftWnzbcnF7m8vnz7G5NiEzUBgrjC0Gca1xOeSFSPsGZaIRogCybAEfoVbPyM5YFk3L3Yc73Hm4Q6eAFlKyCKLmNhUeZI3Fd56LFy6yvrFBWYwoyhHlaMxkfZ1zFy/xzHPP8cJLL+LygudeeIHnX3iB7XPnJLvOMDLqODCcCmrAicAWz8hNnh6ESFc+5bwk2T0NyeFPf16iJKVJT5wEahIXbQETAi5ESt/hmopuvk+oDnFhibMtzkiuWRnjosI2af6q2n0AagwmijxKMhCnDjszqL1P+9YHAaYPcu5J9EFALTVyIoOkIGqqBmsNRZ5D6Jju7/Hmd7/Nrbd/wIObN3h45ybzgz0FNcl4P50v2JlO2TucUqk9IVqHN4YuIEPGSiB1u5yD73j+8jlef+EZrmytUfia9QzWioxJYckzKe3hsqy3zRkipWYuFy9F8Vvz0WCzEvIR+/Ml3/7Bu9x9uA/ZGJuVBBwhBKq6krySbU3XVPi2oswNa5MR6xubrK9vMJ6sScaKiNS46qQCQNc2lHnG9sY6l85vc2F7UyQ0pEK1UdB2LpP2TWpEUpiAymr6uW0bvBcgLPKCsiiIIUo+zE6qBnRtK2Cm6b+Sg0jQOm1DIDIYycOpoGatI89zjBFQq2tJXZYmbcpBiIJaSEiDxJq1nagsUzX5lZ1OzhfJTFSJXqt8B69gbQSE0dyVMjlFIhMQFF4mNj+12wVRdUvuTYV8Y4lYlk0r6kbjqBvPbLlkWTfi6q/PJdW2tZiohgt0wO50xlIrlCcpvJdW1XvWAL7tqJYLrlw4z/PXr7M+LimdE7cajU8yLseVI6LLJc+sOpRE5P1b30lxWB9ouo55VbGsW+quY940vPnOu9TeryQCo2fHgGQ4kZI2MUS2N7cZj8dkWU6WFZTjMeO1dc5fvMhzL77Eax99g81z53n5I69y5epVynJE27WyYHuUJQjonMAYVof+xQI1tF3PePsj9H6eBeFQ/fw4DdQiUm/NxIj1gTJ68q4hLA9pZ7uYbkHuOpwVSc1oyJGo+sV5SmzgAXPn1oPY9aAmlDovMnBG0EDsU+kpVY0n0QcBpjOfe0bAPemYx3apvn/Uz0dBDaxzUrMsStxObsD4lu/82Z/yzve+xTvf+zbf+frXmB/sENsGoqx0Z8slh/Mls2VN46OskqOstHGSjDXGgDWBdrng4vY6rzx3jeevXGAzN2wUhvXcMMkd49ySZRbrhPlirTicxEDuDM5CTGVAXInNRkRbsj9veOfWfb7zg3dx5RpdFIDxIVJXC6YHexzu7zIuMq5evsgz1y5z7coFxqOcspQVscvEcUSYb/IqlHRYBnAmkjlD4SyWKKmdUJWmMnKZUwJiQ2ADGZ9RVY1t22AiWlakFI/TBGytVsv2fmXDUhtPUtUlxxA08YD3XkAtqXrzHFJlhaahqZu+QKvTXIjGmB7UEpMRqUm2BMbWml5SiyS1ZMSYTIKJW00cDWIrHByX1HJRhBpClPdMk1yC5GUhYJD29l7i01xW0KkqsYtIoHNAnXkUWIwRdbKO7NT+HtMHPS/rhtkijU/UQUg8XiNoRfOWzBgubG3y4vPPMilycg2uz0yUvJ6uwDopZZOlRMW6MGi9LIJa76mbltliwbKuaX1H3bbcuX+f+zs7tF2HsZKVxFidi2o2yTRQfW000UWJSP82yynHYy5cusIrr73Opz77WZ55/gVe/+jH2NjaFouBMZop/iQ6yhW0ieAIDzkObPGR8x5HTwtC6b2fRE993TNc8yR6IqghHrYmAiFig2cUA3nooJ5RHT7EdnMy25FZrSVptPCoLvSiZjtq2+4kUJOku/qpT0J5Kqj1O88GFo+jMwPTCXTWc8983PEdpw1DPTC9/UmOIgBonA5dwITAyFkKE7l3412+/42v8e2v/THv/ODb0C2JbU3wLW1TM19UzKuG6aJiWXfUXaBqg8TpRGGsQY301aLhkx99nlefv87FzQkTF9ge56zlhnFuGTmDcxIPZZxkdBCrhiezBudWqinciGDHLBp46717/ODdu8yWHrIRnYemqZjPp1TzKRfPbXLpwjZXzm9z8dw257YmjEcZudq3jLVASoGUso+kCSXOA+INJ84XmaomrdofnTK41KqpbYU16De9VvCeppHacwZDnueihkxel52n7QTYhGkP1I9BgcJ3K89IZcy9ylKdRZJ6tmlqmlrycqKSmngwGnyXPCxFSkuqxBD0qY1IVQkE0zGS7F7san1VbyOAmRIhdJ1kahHQFO9LuY8wn2Rfk2aRGnwkqdaI56t4RmrMoYYGoJJOEnh0VPeLBlQRZ6yjDVHc7TsJtq/ayLzpWDYdbRDboFT6BhMDa+MR169c4sLWBrmVwPvcGfKsBJPhXEGeF9JnCjwhRtqBtFbVDfPFgvlyTlVXNK18v3HrJofTQ7FzhkCWF+KNq1qXzDkIkSLPey856zLK8RjjHOP1TV546RW+8Jd/gi/+xF/h6jPPkhUlnS5AkvR3EsXhvNc26mOn+mOOjtPTrnUSyZHD8x9Pqc/PQk8DbEff4ez0JFDrcSZKWhsbAyWBInaYZkF18ADTLshMgzNSlzEthg0rUGs7T9u2uF//9X/8pWBs/6RGx7XQQFIbdNARMkYufHz/4+iUg88KOCfRWc8983HHd5xCRt9/tePox/RVst5HTOjIYmRkkTxniynz3XtUh7tMcsPl85tsr49Yn5SsjQomo5L1tQnjsmBUZIwyK7E/xuCirHRzE8hii/WRN165xnNXLrA1KdiaFJxbH7MxKVgbFYxGOUWRkactz8hySWycO0OeO1wuhR1dXmKzgv3DGe/euMv9B3tkWUnXdlIeZ36ACS1XLm7xsVdf5OOvv8RLz1/n6oVttjcmFA5yJ3FwouwSacGSAqq10nAMZJkl14zvmTVkuQCDdfI8LsvEQSNzuEwyQGT5sH6WbllOljkyl+G0uKRzokbL80x+081YyDIpTdL/5mSzTqVZq8ZrBXznHC6z/fHqDyK2AAOZcxS5ZNgocifnqZt+ptdzVlTAeSZqzCKXJLrJxmhTjTllHM6I80uWWbJMYr4S2Mhc1euqbbC3EypQOgXt9J+zmYRfGNdLIdaqitHIddKiQuLL9BlkDYQl4kACrAlk1lJmGROtWyZlXwzRi8RsDWTOkPWJqyMb62vKVqQKQpYVSKVz11fNlhI0stksF8/MvMBl8rsslFbAOz3Yp5rPCV2LA30HS24MubWSwNtK3FzhLLmzFHnGuBxR5jmjcsT6+joXzp/nI6+8wsb6pgBhAqkn8Y1jPw8Pl77S/55wmZMonf/ITT4EehrO3R979lOUVs+eDDOm/2f1e+KkRqM+RVvj6eollk5jBYOoKFWTIKfLX3GYCrhf+/X/4ktRbQr9DfuWfwKo6ZM9sv9x9Bg15RMHzmPorOee+bjjO06hR643+GqM/GMQOxJBsmQUFkoXaaZ7PLj1DgcP7mKaBeujjO21krXSMS4yAbEyZ208oswsRWYpnKXIHLkyn5GD0kZcbNicGF598TmuXtxia1KyvT5iY1wwKTNGZUZZJKZuyXK32jJxpXbWSlHGTNQyNiu5fe8Bt27dZ/9gQQxSVaCtK0aF4flnr/Cjn/skr770DBe2JoxzS2ECuYuY2GGkgFG/CZhFrBFwk3tCnikTdYaikHg3cdBzwoCtONc4K3YwmwnwCMA5SRPmBPCsE7DIcyk4KUxTwHsFdI5IxCWgSICWOZyCj2o8MYbeYzTL5DmyPDmhKPAZmTuZc+R5RlHkYru04rQgUrBIo84aBTQBvjzL1GNTQcPImBK3Zcnhmet7ykRerXttf/9BNQWj7ZQkQN3vrCNGkUydE0kzLebTkDWqbk1gZs0qp6MsQCRsxBHIkUS0Fslek1lLkWWMRwISMQbqaimgo+1DFCl4a3ND2zhJttkA1DJslmFdArQCl5e4oiTLS3XuGJHnuZxrDE29ZOfBfar5DEeUrCbOUWSOwjlK5xhljsJaytxR5hnjImdclpIRZTxmc2ODtckaxljG4wlr4wllWZJnmdrXozKvU4DplH3Dtk2f5PynFHcSnXSfD0pPcc3TePcTacALZTysdiujlC1K+0jChYiJHt9WUiUGSe1ngMxpBqXBNcS2HHC/9hv/+Evh2DrgrKAmUspT0GMAjSP3fXo667lnPu74jlPokevpV9kvX+STxFvlJpBHj+kqvvv1P+EH3/pTDu7fJjYLQr0gM5HCWUZFTplLifk8k8krK01D7hy5dZSZo3BRyjbgefXF53jlhWe4emGLcxtjNiYlmY3kzqikgDBF5Z7GGnCSyy93OnmTO3owGJdx4+Yd3nnnBjsP9/Bdy73bd3nm2iW+8CM/xBd/9DM8e/U8LtSYUMuzZ0aAKzFpwCBgJgG48h5OV+955gaMWzQGVqUokbByyrLopRBxxBCQcak6sgKXy8SelZcleS6lRKxzFEUu0psyejnOHJX4CrmXAOMKLAwCrlmWFgAJJLMeqEQlKNW5k+TnMmnX5OIvgCRtkiTELBtcQ9spDacQAk5BUq4noRcyJVdSX1rdJoSyRkrSWCuS1+o3TfOlhnXiypPTmgR84jUoILbqP/mcUl0lqc2A2plSXszUBkWRMx6VTMqCajmnXS7By4Kua2rGeU6RZYzygtw5QhcZFSORtPOCLC/Jy5KskOKg+agkH40pRiO10ZYURaGqRENTLbl76yZNtWRciORbFDllXjLKsh7cCidS5SjPGZcF43LEqBDgIkLXdiwWS+bTOTFGNjc2OH/unCwyojjOGZncjwLb8e9Kw+OOHvL0oCbdf8qNPgAZBihzBpLjn+IEOMYLj59uxI6fFllGtDui2fH4tlZPaI8JkrA6yxKorQSxGMUG6/7Rr/+TL0m8iRhUBahkNTh0FJFV4NHtfVE67YNeTyf305571mPPdtSx6yloH7+HJWKjFMMrCLSLKe99/9t866t/RDvbh2ZJqGbErqGra0LTQJBVc2adrjpllVkoGEjSWCgdFDZgY8uLz1zlxeeucen8JuvjknGZMS5FakiqLayVysOZqPas1pAS9VuGzRzGiRrIZSWjcozvAtWiIneGH/ncD/Fjn/8MLzx7mVERwC/Jndw/SV+G2FfdNmqjlZi0KBaZvsTM6vi+jEmSPJK6Tz0UsyzrGbg1VrzXNGbMOUnDlWWZgpyGDSjwmZT2zWa4XJwRjFkFajv1VgxRMvKLelE8Ep1zYOS5RJJbSWDSzVHUaNYyKguKsiDL5XoCaMnpQoCgKMQpxCmQ57ncR0aMuKEHTRWVF0WvmkzjXCQp+S62M/GuFNBPoRLyvuLwKE4KQXSNq8XBUJJL816zMgh4CR9IsVl2oOI0gA8dxhgZR9omxgAaWyapsxwXNjfIDcS2xYXAufU1zm9tsl6OKF1GZmSMO5dRqNpRVI85WTkiK0ZkWvU6V5DLsoyyKETdqWB/uL9HtZhD8IxHI4q8wMRIrhJkBozygklZMioKRkXOqCi0CoOMkeClMGxdNywXS/I8Z2N9g3I0ovUetM1jXCXZTgBn5J/eAWjIAY6xiH7fkH/1fOwMjOfRc46eZE445vh2/D5PD2xPvsfqXqsLm8F2ZE+URklqZQhElc7KzOBbCVdyrNLm9SYzvX5ymnL/6Nf/yZcwMlCNqhkSrUBt9fuHRelB3hcpeLwfOut9z3bUCdc75vkI4qbqYiA3kdgs2Lt3ize/9adMH94lLA/pljN8Ncc3NY0GXssEE9uAiUFUj5klt1HUPUY8BUeZobCRMoM3PvIi1y5fYHNtxLgQILQq+VirWSuS+k7BS9zaHbkTgJDUWbJycjZjPFpjY22dq5cu8+rLL/GRl5/n8sUtJgW4WONoyaxkBhEPO0/oOokZSfFVQQr8QZDgSxN1JSab02KTMp5XeQ57u45bMWCMgFryzktxYVbTS4mKcgVozom0Zq2oJp1N9jat6J0pCOpE76UyJ9KRUMS6VZVnY46CmjGRPBeAylQ1mqQbAWllACrF9Co+BWxIjhgr5xSb1KFW76O/mWRcj6tKAXLtVVC7tQNAS7kllcGIVCbPluZ04jvWiPRqdMyagW3KKs+z+u4RMG7IIDUbjaZiy2wkt4aRc5TOMCkKttYmnNvYZG00JndOkh0bq1K09o8Tm19elBSjMXk5whUCdHleiL03yyjynCLPpWyRiVTzOdPDA+rlgsl4jDPiHFRkjjLLKVxGmeWSuT+ThWKmaliiOAP5IHOuaRrqWjyQR2XJufPnyctSElSk9k4Mu3e+kTbsJQcdOT1pMz2y/xF6OnDhTNc8Gz0tsJ2V0iWHf4e30aWqfOqz10jCcRsDmYn4piL6RpKxq70tlaVKIzlo3KT7R7/+m19K72IH6g8hq1kDZOeH+b6PgMFT0P8U557tqJMPTIM8kY2RnEBOYL7/kBtvfZ93v/dt/OJQCuIt5jTLBfWyolo21HVL06ZMHDLRrDIXZ1WCyyQjeuYgc5G1SckrL7/A+e1NJuNCHBWcEd8iq0UlnThduCzTPI2rNEiZqqvSkDMmw1pRya2NJ1w4d44rl86xPi5xdJjQYPFYJI9lDOLV6H2QQGAvDLVPCpzc5DUWJbVUTNWvbarflxItD5wTTFKdJYnAyLm6WnYpjko9LYf7ekBMzF6/JxtVAinR7SWmLXF8WZYpx5c2t6oq7M/Tc4wRL0uRWFSaUaQQ5idv65ylKIt+XzomBMlF2TNIDM6pelLvEeIgfi7lSwwSRtBLpSqpwSpNVowCmNKG2p798JT5rmsY+a0vMyUMQ4BSU3zJy/Zu/1J9QTM79E4nuhARnzaMhouMioK10YiyLCQHZL9oUWlZpWxrte2LXAAtz9V5qSAvCqxK5AnwM02JFnzH7s4uB/sHTEYShyaOOHkv1eWZSoOZgKhI8JJuzoeo6wajMXGetmnAGM5duMD5S5ckG0sPatIWQQP+Zdpo2ynAJR7QfzwDZuiIevKBH5hOu8dwZ3ryD2NLlBaz8ll+s5JWD7Th9DctPeUI+LYG32o6Nq3ckc7Xxu5B7R/++j/5Ej3zkMEsJDeTQNzVng+Lzgouj5DhfUtpPMV9z3SU0bY/Yf9wnyNQmIALLfduvMNb3/0mu3dv0c4OCNWCdrmgms+YzeZUVcti2VA3nrYT1225mhhOMysqorIoyDOHiR5nIlubE5555gobGxPKkdjirBFAc6pqzDJhECKlqeueEfdjazTzCTKw+iwXrPJKEhpsaAldhVF1oyHQti1t10pcVYiSt9BHopcof+WwPYMVpplATtSTMkAF1ITZCbBZZRjWCtOTEAHpHWNWjgZOvfdWjDhJLivVnbFi+7FOVImpr1I79O7YNqk3pQJCL3ElwOrVjzKhrKosBXBX9xOSa0o/iNoMVnFLokL0Avo6P/v7u0yvo7F9KqmZ/jwJd+gdZVTVKs16tGxNr1I0unhVxmI016K8F72keOQdhNtgjOTxAwn9MDbDalkhkUaF2VgkbMXEIONT758YkUntoSBsrSUvin7BlWUirbk8V23CCtR6yRzhWc6JNsJZy+7ODrs7O5RFyagUT8wiE1Abj8dk1lEUJXkm4QKthmEI+CtwK2jFCG3T0LUd5WTMCy9/BJNlK/7YN40sRIZJFwYyMAwXOAM17wlcoycd3f0l/jyov8ep9Ljf3g+trqcj6Mi31FaQxlgEIxogRyB2NfgO60X9mGp+pDZF1Y8hBNw/+o3f/FJMUhpxlcfMGAW1pIL5cF9zNemfgj4goPEU933iUdJIMqQH4zMN7iFlBEYm0s4Pee/N73LjB9/DV3Oa2ZSuWtJUDYv5gv39GXUbaL2h6gJNF7Auk4BS1fcbkNVqnoMB71usg+1zm1y4cI7JZESeqcrKqLpLbUSiiluBguitxe6VWddPPuFu8jn4oEwPiK2WgvGiZtQYpKAZ0L03dD7StgFrxKMNY8UJXK8Z04pKg4OzXLwbExj0ajF9FJHiRCJIkpobSGQiPQ3+Dh0z7MCFUfslnTdk4GgyY8FemShWHUIEKBAwVJfIdD9pL0Tt6VbqE7mvjI0QooKUqMzyPD8iQQk4JbtVUodmOCuLChTAJGelHEOSCEAWKpkcn1RpXuPtBCiHYLwa11Emk7SNinBGMzug6aZCNJJsGCPlaGxGNJJpJkQnwd5RgbxXU67uQC+Fy+IoRgltCVHHlPaltZYsz8WGWBRkhbyTjB2jdmBJ7ZYk4sQUnV67yHOm0xkHBwfEECnLUjUaGUVRkuU5ESPSnstoO890vqDVTCXyrpG2EwedZNvpuo5l3fDRT32KUr0jU9uLhCbvG4e8xRxlIOnj0d2ngxr9sapaG1zrz5tkSCSg+LA2+veVb0lSo39Hwyo/ZDRGMuAYKRbsCOBbTNdifCt1InXxBCswXElqv/GbXxKHYFEXaPfIBNF0OonSg3wYdJzxP5YSQ3rcE2hHPGk7K5165CPPktQNg4Fw7GQXPZlv2blzg7e++21uv/sO7WJBM58z3TvgYO+Aw/0Z+4cLDuc1+7MFe4cz9g5m7B9OaTtPprFFkkcxFUQUg32WOy5eusDFSxfIeycFtcvkKwknqdhkUIktyCa3bQMglZCdk4wZxjphqFEM/4ZACC3et7RtR9t2+ADeG+o2UDWeuo103tB00HYIyPlI61WdGhHri46vthOmAsrgnJSNAVGZCdMTYAdhmivmr0CchE6VhnrVqoiAPcMxTlOEKVAZKwuEoUpW2k7UWnmRK6DK+EqTJwGoNOVABapqTqPSoaiiRCosy5KyHGGsBFnH5FBgZK65TPoqBR8nRWRKCybPtVKXyiJAsps4Te4aB6mCElAajVnrWai2R9Qg6mi0XpoR83sAupAATUCtDdB6+dsFyTpjXK7Ap8HYPc9QFqV9mT73m6pw+6mibWtdRl4UlOrZ6LIMlxcYtf1Gbe+iKHRMy3xz1hLVwaftOuazGTs7O4zHI/F61WsZ68iKgsWy4sHuLvcePOBgOmW2qKiahrqV5NshRNAsMjFEmqbiYDbntU98gnOXLpPlGZ33gwWTDr7Etgc8Jn0a/l39+nhQG5K07aN85YOSTPnTLip9lPrpg5LwzDTyhm0hbvxpTyC9ZwAj8a0Oj/EdpmswnVSEcEa0OuggigpqPkbcP/zP/0tRPyKBsHJpacSUI65/sP7TB6czA4yR53kSnfl6Z6STribjavWLGa7QtF/SY6QBYQzkBArTcfedN7nx1pvs3b8vEtp8wexgynS6YL6oaNpIGx1NMLTB0EZD23ZqZ2uIAZyV5NOBgA8dIXrG4zHXrl9hfX0sAGRRFY7YPiTbgai8ogIaRlNT2aOqqVTzLISIdStQC1ESFMfg8W1D1wlItW2kbjxNGwXIfBQG6A1VE1hWDYtlw7JuaL1W0NbBm3IWCs9WZmhEvZdUfs4gzDKlb1JJKbnv991uFNRSLTA12kuSqkhUycCopx5GbUZqi7J9Cirpzx44lZmmaUcCX6tJgwfHJ/UjagNL6kKnDLsockm5pVlC+ultZAGSVG/WSvuH3slD3zmBONKnxlgyXYCIXShIFhOf6rStBqTXMjeSf1jYQUoALNKzfPZRCsGK35kl2pRrVBIgtwFJ16bAp8sjYSp9+rOovF6l2ZSnE81Tqn2QwM0aI5KaOoFYjVVLHo8uF+kqAXqmn9P5MUhQUgiB2XzOrdu3mUzGWGtkMegcVdOwt3/A3sEhi6qi0zI8WKn5F2KkC2m8yLM7jYXqiFx//gWuPf8C4/EY770smgZzX9og+SToSEm8QP4MxtDxL2cjo2Plw6TTL5ceUDne6QeeiWSUyNWOtEfUed+PowRSkahJGpxW66Broa1VUnsU1LxqgNw//I3f+pLcLGV90Nu9X1BbtcVjt7MAFeigOQOd9biz0olXO+Ee5iRpMK1W9b8sduSx5d3vf5vb773LfH+fdllRzRYspnOWy5q2C3gyosuITqpGR7WRdF2gWtbUVUP0EZs5ooEmtNjMsX1um6vXrmAtRDzOOfIiwzhJMxSDav5jWp+Lfc6atLFaQRkZWF7VZiFACB0hSEWArmtpGnVkaSNNG1nWnmXtmVcNh7Mluwcz9g4W7B0u2D+csT+dcTBdMJ0vmVcNVdPRdJ42BLHLOJEmUwJtsZOJ04AAmthvkkjWSyxWpDQZrtr2ClhRhCiIRxaCAtzKSBPTNVZUi8aujKGmdxhJQCL9b4wuGKzR8jfSTsmelRi4qGZXhUUlyNpRt61UCwj9jfSZVupTo4sKAQlhlFmWa5DyKpmxUdVdjPQFTXspLb23Ak4XIl0CMKR+VTACXD5aPFJVusPSRmg8VF1gVrccLir2pwt2D2fsHs7Zm87Zn86kFFKQSgwdskqOVoxdKbGwMH9pP4OocSUcRRYsmaqXrY4D6W8BvryQeLU8LyUUQ3NuJind9rF4q3lXVRX3798DraiAMVR1ze7+AdPZXCpbGCv2MStSoLFW686tFhEp/6QBostYP3eBl159jY3NDRmjVkI9RG27YsQyVlbve/zv8X0nM5rT6ax886noxEsefdoTD3kKMqCTb3VZ+Zh2rMamaA5U/aigluGhraGpsepHYDS0Qtpe1Y+ngZpMzvcHauYYQz/tv7NSz1CeQGc97qx04tVOuMcQzHrGeuy7o8O2C97+7je5d+sWy+mMtqpYHs6plw1tFwnREmxOzHJsOcJmBbgclxdkLqNtPcv5kmpRiXqsdLShY219jStXr3Dh4jm8b3HOkBcSRIwm1RVVV3IXFzWiRQdFFJCL0SsYSJ9LFWW1lYWWEDq899R1Tdt21LWnrjxV7ZnOG/YOFuweTHmwu8/d+3vc350KAzycsX84Z+9gyv50xuFswaKqqOqWphVDfV6MyLIcjMWHoGmuVF2lqqnE8KR9+3kgrv3ipSBMxWkfJWajKsjhedaIN6UdSGGpz0RqFMCxVtzNZU4o+GgwtjGi9krAJapKXTGmLPyIVJGk5oiRKgE+1XUTJk+yJaZnQLoqVQxIwOicVEUIXurJCaCpxKtqRzlH3iC9io/Q+rDK72JkBIhkJlsXRTPgo2VetRzMl+wcztnZn3J/Z587D3e5v7PHzv6UvemMnYMDZnVN1bZUbUvdNvgYMZnD5pmoWaPYp1J7S3YSSVxriWSY3vEpIp7WoHMmE+/HPBcbmwRii/ej0QVIUldnKQxB823O53P29nbIsoymbdndO+DgcIpxTlJsZdlKSjWyiT/TykbmshTaIqCWjca8/tGPcf78BQFTdbRKqcYwK8/IxD0Stxj+HXKQng8Od56Fnvb4J5BBB/axvcef9oPQSWfLHdJ9lN+gjiJWtCsCah1Z9Ji2JjY1NnhJhI3YjB8BtX/0G7/1Jbn0QHRWcTodLHvTp8eTdOqHR2e93lmPexo6csWTrm+QCTYE6xNALgsd7eyAW2/9gIe3b7M8PIDWs5hOwacs1Q6bFxSjUW9bKMuC3Ek6rMLJat+3Hfv7D9nYnGCt58rlizz37DOsTcY4C2VR9J59UVf7aMyR/KPsTtVBaSBExOgvKiUBFFSNFn1H6DrauqOpPDFmLCs4mLfszRpu3d/n7Vv3ubd7yLRqWQSLz0uWwTBvA7OmY9F66mhpomHZeWZVw8FcVvw2y8lHElSLQVJMGbEnGYLaRPSZDJotdqjKWqkb7cC93yXVolUQGzhNJBtYYkaoig/1gjRGAsAztb8NR0NSA6baa85aRqMRVjPEBwUjp2VqUkonEG/WVcD0IEwgjZdk94ymd6qwRrwrjTEaMiHekskNOpWo6bP/a0XgoI4vPiL2Iu1ndNEizh4iqXXaN1WA2w8f8vbtO9y894C9+Zw6QB0hOIfJS9xoTLQZHsNsWbOzd8D9nV1myxqsE8nK5VpjTgBauk1ji3SpLGsOeaYuyF+TnDtKCbS26uDksrwPzo5RnKbQRMWZVquQ95NFxXvvvs1sNuXgYMqyqiW1VlHoQl0YqGCYSLrGiDemSH7yvM46iizDFVLr7eOf/hRXrl6RhNZpAROFsabviU+kqTbkmyexEG2ZJ3LX4amJz/z50qPXl1s+6UnPQrJAFB26vo9eOcjPah4QJxEXPS4GaFti00D06qkfxO9DFxJpvLt/+Gu/+aV0UZNWLnphAbbV66XOPnFLk/L4/hO2x5KuqtN2EkictH3YlO7db6eSgENqM2mD4crbkkVPN5vy3ne/y+7dO4TlAuM7QivG6BAN0WaSvNdZyQnoIHcSwOo0pseidiHT8d673+fy+Q1e+8jLXL9yGeIqu71BGG7bNML8jwEZuhoSFZF4FmJyjMmxWQ7O0vmOtmuIviN2Hl91tHXEd46mthwuA3d35nz33Tvc2ZtT24LG5OzMKr534zbfv32Hdx48YB4gW9+i2DzPaPs8szZw8/5D3rl9m52DKa4omC0W+BAYjUZMRmNi6Pq8kJmThL6rkaMu6OrdmFbtSX0HuuKOyk0RxpW8F1O/pPgise2od166vlxEVYiBLBOHB6+1zVDQE9Wu2HPyPCcMvQ51QDiVJKyR0idd1+LbDlSNKSmaxNJoZaZLILBmHI9oyrA8IwSpto1Kh8ZaYtCM/Z0XG1ySrrXQqNcs91IlPan/MmK0dF2k85ZgMpro2J3O+c7b7/DmzVvc2z/ksGmZtS1mPMaOx4QsY7ZJ3YoAAP/0SURBVFY33Nvd43BRsag9PjpsPsLlYxoP+4dz6qbDuULK/hhN89bbzzRBsqYW88GDVR2RAlqW5bqAkX5NnrNG62elxU1yjMGI6tDHiHGWPMv44698mXu3b9O0HUVRSgnKBGiqiY8hqqepE+/fCKHrJMOJZvLJnQPraELgsz/8ea5dv4bNrIydTKpHpPHXaTkjg4bJHOF3aWEpCP8INBznN8e3tGhOW2I4uslhj/LFIzzyGB9L433454kkk+P43sdSjycmvafu6El5li6iJag/iku/hoWYELCikaRrG4wJgJRkksWQOvlHMO/ePowYuaTcRiYYwzaIK9g7ieQZT/7tNDqxWYy83pFdT3ndD4ue+r4DQJMBJDsNULQVy3u3+MN/+f/mnW99nXrvAW1VMT2YsVzWNN4g5X8ixkZJpeRQtSB4rwUffZAK2n5OxoKf+PHP8bGPv8H29paUj9HExESP9w11U2GI6rTgBdBUWhl0LgSDiTIFgwl0dHRdg+9aQusJdcBXgaaGqjbsHCy59fCQ27tTHs6WTFvPg/0pi6pmsrbO9Zdf5MJz15ic2+L8ucuc277I2mSdIstYzmdM9x9yuP+Axd4Dpjv3mD68y8TB81cu8spzV9lay1kvHUUeyV3Q+LpS7S6aPcRl/SYJcMVBJEYZi0l12QPfYFz1kye5uusKLyggRe+1SnaHNVCWJcRI12qBQh3uXdPS6MJhNB7h1d7YdVqKJkTNQSmSc9s01FVF2zagEp+1Vq8r0luMkbb1NE1D12pSYw17qKuGpmkFtFWybpqOuvW9F2kXoG01XlBtcn3dNQwxWEKweG/x0eFNxjJE7h9OefPmTfaWc4qNdda3t1jb2mRtfZP1zS3yosD7SF011Muaal5RLSrm0ymHB4dU8xlro4Iys4ydYWtccO3CNlfOrTMpDLmqkRxiJzGp2GuMRJvjTQ6uJCvG5OUYW4zIR+uM17coJhtko3Xy0YRysobLS4xLEhcqycuio20b5gd7/M6//Bd895vf4ODgAIwVx5M8V9VvWtrJnHXWYWLAdx3Re0pNoVXkkmIu5DlmY53/3a//Op/7kR/BFQUeMHlGF0KSO+m8XzkWCbdVXtovJXWTvjuNn55EfaiVUkQXbvrtFI76CMnYGXw/cp0nU/8eT3NO8rg12i7pzUMKIZNq6QHoCBKgagLRBLIYcL4l8y1Z2xKXC9rZLgUVWayFxxq1i4ZI23ncr/3Gb30p3aQXgrX1Vnz9wwe1k+gkIDlp358bpXF2Arg+kQag1p8vDYMLLb6acePN77H/8B5dvRB1XtOK0T/LMXkp7vQao5NSWNk+dZVIYb5tqKspX/ixz/KJT7zO9vaWSl+SDoso2SlSnTVMVNuPSia9Cm7gdh4hMyKNRMKqBpiCaNcG2iZQdXAwr7lxb4fbuwfsLhtmbcft3T0663j2xRf4kS9+gZ/+2Z/hx3/yJ/ixH/9xPve5H+ajH/04zz/3PJcvXebcuXNcPH+OixfOcW5ri9xlVIslB/v7zKYz8ixne3NTkxBbjJUg4+SdKOo6DVFIq9De2WDo+DEANF3pyghPdjNV/1n9TZbu8kOMuqCQhV6muSHlu0hpRjPp+yDSXJ5JQt8+kDoGjEVyEzpLDJ6uawm+wySP0yQhaqxgRPoqhEDbdFiXiQt7lhFDpK5rvBfjeFKbSb0vVYWpba0LQb1KEzM14mSDJKpuu0gbEccQY9mdzbl59z53Hu6QjcdcuX6d688+y7Xrz/LMs8/xzDPPceXKNa5fe4bnn3+Rl158mevXrnPp0mXOnzvH+sY6zlkODw/lvZEq4k0tiyqR1KyYN63MrP7JLOp5OVALAj4kVZQWHFWJzWiIh3Xq6q/AKPt1TGjCW2MiB9MZ+4eH5GWJ7WvI6VwdeLsKsxcJ2BmjpY5kHHlryNfW+JEvfpHrzz6DdRmeuFJl9mxTJSblHT0HGbISHYvp39XIPHkbXuLo98RfPhg9LZ+To5/y3nrs8fchqaUHBwTEHp52Jdu/I2JDgK4jthUZrWQ2IkGP6qNCb1NLF5eO7e/RP8Uj3XSE5Jon/3ZmOgVIPlRQO+1S8vL6MQ21M9Lw3ARquj8NPBc9tqt59wffZffBXUK9FIaoJeixOWSFJBcuC2lLNYKn4GtrJHNC11R07YJf/qX/mEsXtzGWPq8iiPu998o85TJ9n5r0jPqcUX9CGbc8uQTGGmM01RU0TaCqO+a15/aDPW492GO/apl2nvsHU6oY+dyPfYFf+pu/ys/98i/x6c9+hmvPPsvFy5cp8jGz6YL33rvB9773Pd5+8y3eeftNbt+6yeHePjEEFosFe7t77O/uEbqOixcvsDYekecOUfRIgl+rNjTJ5pGcRkT1YDWHpVGvyB7YelA7SmZgXzOqypJmSrZlnQuarcKYBHbyuzHJO1Eyvkg6K1kQRAU6qT6QYQ1439G2DSH4vjbbyutUFx56vaAVqouipMgLrLE0reYjVMZr1EPSq+t+iGJXa5MaUtOWSf+qd58HH9RtH0sbDYfLmtv3H3L34Q4tMFpfpxxPCNGwrBuquqFuOpbLmizL2djYYmtriwvnL3DhwnmuXb/G8889x6VLF3n48AFtIzXUrDE0TU29XFAWOXmRSZYbqyNPRRl5RHVgkTgFVTkaooJZRPc78ZJ0Tmv+ZVLcOAQN5tb5kjKXZJnjzr173Lp9m/FkotfqB4D8GTgLWavFRAla507trlnG2vY2P/zFL3LtmesYJw5NOlp66WeoEehB58jQSwHGytfOsvVnHrvU8B767X3TU56a3vDM551waBr68l46BxM76kFNZeAoOWNdDJiuI3ZLstj0oCZjRq4RYsS8d2eq/SyrRTRb+pGnUIPv45j9SYzjNOoHViJz+rWf5rqPJb3HcfGbD3iPk87t9+k9C1/jqkP+9f/rv+Wtb36N9mCXbinqm64NVN7QkmO19EkkaM5CIzaYriO3FtqaMrO88uI1fvkXf4b5bIe2qSQANXS0bUWMnhg6QIpvWiuSQGLASRWVHtAYJFYkyDIpGIkPiRjqpqWqGhaLjums4t7OlG9+/10W3rJfdbz3cI+Hh3P+8f/+/8DP/o2f59lnn9XMExZMZO/ggD/54z/lf/xX/4Z/97v/jq/+yZ+wub7BZJRp+qSADR0b45KRBdqKPNT86Gc+wec/+ToXz03IqMmcJAwW21IusUeZ3Eekt0zrvwlTSwGxRm0xpNV0b2qT2WRTQl61nyVjS4xBnDQ0p6UwOk1n5b3wmij2ra5ticGLpBa87OtESs4zKVwaY6RpGpbLSip752Jji0Hc8KM6erSqthRBz1CWY6x1tE3DfL6gbpo+c0gIgbb1hCAB0nXTsqwaqqYVySeKU4mPEXB4D20X6KLD42ixkI/51vff4t07d5nVLSHLqL2nI9B0EoxsrNMM9ZYXXniRT3zik7zx+ut85tOfZlSOCN5LAu6uo1rM+epXvsIf/t6/5d6tGzx75SK0FeuF49qlc1y9sMUoN4xyS0aga2sp6pkVogqNFuPE09HmI0w+xuYjbDEmKyeUaxusbWwzWttgsr5BMZ4QjaHrOozTOnHW0LU1+zv3Odzf5Xd+53f58le+wmg0wmDI80KeWVWFyTHEGnFkCZ3Yczc3NhiNSpwx+Dzn2isf4T/9z/4zPvaJTxKMoQ1Bq8QLT4mqxkzMLakLZUmWot9WYSZy10d5x3HqAfOY+vEo6QIhDfDH0En8Dz37SeeeRKddb0gKH0cub1D1I8J/0u9iFxWX/kgkw2N9SxY8uW+hquhmDyn8lDxUuuCxGCMetKp+/M0vHblRAslhC/aM++RmlZ9P/u2xZAQATgM0OBk0nopOu0fa/wGvf+L52h6pWWzssL7lzo13Odi5T7ucy2FG/vEYonVkRa5lYfKeOUdMXzcq+o5R7rh25QJraznWBXUckcVI29aEKOqtLJekvbACNZ+kwxScq2pGE5Gs5ilVFhDUNjOdVcyrjoNZw80Hu+wvW/aWDW/dvc/kwiV+7Td/i5/+2Z/lyjPP4ooSrDiZ/PGffJX/23/zz/hv/+//D/7sa18H4NLFS1y5fJlz586zubHJeDKhLMdkeSn36+Q5F/MZV69cZmtzXSWgSNYbj1XdqI4hIpmpjVClr6HK8Xjfm7jq+ySlgarqokphgwmul9U2FPWiMRLwK+o9VZolQBy0a8o+H2Ok8x1d2xGjOCdYY0Sa8rLIEFd9kbKMMZSlhDn4zrOsKuq6JtckvSCMvOs81opKrW07mrbD+yAxf+oNFoN4Q4ZoCVEKd3RY6mjZmc555+49DpcVMc+xeUkxHjOarLG2ts7GxhabW9tMJuusrW9Q1y03btzk29/6Fg8fPmRtbY1z586ztr4Omi/00qVLrK2vM5vNefPNN1lfXydGkYLyImc8HveSrEHUkWhSZl1OS9MbqefnMgFxr/aStgtgrWbxF5f/XiDtwyHEhry7u8u7N97j4e4OVj1oYxSIMSbVrJPsMQngrE3JqWV8BSKdMbz6sY/z6c99nu3z50W1q+NLVKQaSI6M1TT3V6NuwM515/EjnkRnOdroeH/igSfQBzn3TKTt1X9l2CyDGaoTziioJY9Zh5TvMsET2yU2SBmanv3qeSFGATURolc/Psqo+zOP7VcyRx7rbHTGcx59lqegk+6hbfvI/uOU+uAJ26nXGey20VPYyO7Du9y/c4vD3YfkuaPIS5mIxoGTWl9Yq/WkJDjUapolE6F0BkdgPttjfb1kY3NMlju8byWTiBE7TpZZMvXQ6rpWPRlbOlV/RUQ9JKCuoGY127naZeq6YzpbMl82HMxq7u8ecuvhPtMucGv3gBc/+nF+6e/+z/hrf+PnuHTtGbJRSYhw++49/vt/8T/wf/yv/k985zvfpWs7zp+7wHPPPcfFCxf7zBBJ4nJZgcTGGVGTdZ693R3WJmO2NzfY3FiDGHAuyvspqBkr6qj0GWSSrLJuIGP5yN/ULeaImjEB2nBVnGacHCKAltSDRhmn2IXSajNAkHpoEoMmKkZjJNOFT+WE+rbW7PzqzBG8F1Wi/l6WI2KMVHVNXVWEGCnLEda53jMyaNaXtvPUTUvbiTrbOEmbJWAJMYpziLE50eUEm1FFePvOXe4dHDKrG5adp/EBH6EcjRiNJxTFCGMdISDu9dYJuLQtBwf7vPvuOzRty/kLF9jePkcEitGYrc0txpM1Dg8PuXf/gdqyRBIt1VYavWSnkYTKqhYUZCKiaiQjCYizvJDkxlaCqaM6fjiNYUODpyOy6JEYR8PD3Yd8+zvf4catW6wpuIoXeTK0RM3ZqVJ4DBp0LQulLHPEEFg2LV/4iZ/k9Y9/gsn6uqgek4qUFCspakyhx0BWGpqnH3GEhkc9+WghsxroT039uWd7vLPTCn36fwX+5Z6rvcrzE6ghma6chK6B98S2wviKDIlzlZMkSYMPCmp6N7nBIy04dB89hR7H3E+hs4LVWY87iU46Vxrw0f3Qt3D/Pmf5b3jOkIQlyr+WSJk5lrMpd27e4OG9O1KosCzFjVszKqRA1VwLWVqXySrSWTJnKHNL7Bqm011efPEZzp/fIMusTkjfZ7pIKseubeha8caTLBYetIbVKmOHPr6qq4KPdN6zXLZMZxV1E9k9rLjz8IC7+zNu3N/j0nMv8rM//4v87C/8EleuPYPLCsBy89Ytfue3/w3//J//c775rW/y3HPP8aM/8qN88Qtf4FOf/CQvvfwSm5sb+BBYVkthwFmGesmLROE7mmpJvVywvb3BtauXkTqdHmO8OoUkKS2tLqXxo5Z3gdSH8sFoB6W/cqywNaKqUIbxfNpvydU+2bnEO3IgqaVe7gFNACqKJ4JknYjguxRDZsQTz2j6siiLCIknFPuSNRbncvK8oGkaqqrGd548yynLkhACTdPQauC6MZam7WiaFu/FYUIcIEQSFC87iUvDZMQspzGWg6riO2+/w/5iQTFZ49K16zzz7HOsb6xLSrYoIQchSBxWKoUjdr6cqlry4MEDDg4OMMZx7fp1zaLvKEcj1tY3GI1G3Lpzh6YVtWokkucZ49EIo4440u7SnkQBJWlzeZe8KClKrXg9GkvwtKZyM07iACW5t4wDY7SeXuaoqorvfOd7vPvOe2xvb6dBhrSIqL9s6kv1PpWYwlQOx1E3DYeLip//lb/J8y+9Ql6WfWya6CzT4lAWkTLG9HFkFMkrHeMRw7H4WEo87ClxKj3H+6Get8mXD4n0iv31dP71txk00mA+G0QtbLVaCCEQ2gq6GmcjwTh1MpLQCx/A/dpv/JPHgJoC2gngcIT+IoLa+3imdM7TnGeG6q0jp61UWFY9wAiee7ducPf2DTJnKfNMioCm8h1ajkMyUORkmXi+WWMo8gxnInQNeR757Oc+ydpaqWK6FNQrcgGpEDrapqauK/GCTCmbjKha+iKYCgwWycQQOo/3ka4NLKuOZeWpmsiD/Tl3Hh7w4HDB7f0pv/L3/hf8tb/x81x+9jmCcRibcTid8T/+q3/NP/tv/hlf//qf8cUvfoGf/dmf4a//tb/GF7/wRd544w1ee/VVnn32GXwIPNzZYbpYgMslONhHvBemk2eOB/fvsbW5xosvPMtklBN8hTWiWnPqCdmbzLThxeNRpU+dHDJ+Vn/1/179JV2lDFa9EOUH+R5CwHtJEYZKdVZrjsk5SeUI0YtKK0ZhbtZqbJr3BL9y8DDGQl/qRMM1QsBEKcyaZVLyZrlc0jQN1lrGkwmZc9R1Q7Vs8J3va5nVdUvbdQioJ5ubxKpJ6zhilAB/n2Usg+fW7i7fffddxue2+cRnPstP/NRP85f+8l/mhRdf5ODgkPl8TkzAkhe9qjepfZ1zjMcjdnZ3uXvvHhubW1y8fJm8KAgBsrzg0uXLdD5w89ZtqqpSMIO1tTFFJknUYxjaMtWhKTnuGHukYOh4MqEcjcnVU9hah0010lKAu0pQTtNs3bxxg/du3GBUjjDG6P1krIiaOG0yP9KCMs9zjDU0TUuwlr/zP/9PuXjlmkgD+mySTV4ADX3mNKZ0tA14wlGecmZQAxnHx/edhd7XSSt6n3d9hHQG9l+Sje3ob7ppm0bxP1bvx6jlrwwEKUMTuxpnoubtFOkdm+EjUnpG7qFqFCOf5RkSaj7h5d4HgJwVrM563BF6H88jA+cpzxk83+MGafqlzAt27t/lzq0b+LbBhECeJKYIBnFKyNQ93Wm5kkwZgA0duYNz59b4zGc+gbEdXdeqfcdjE6C1DU1b0za1MO80yVMOwkGtMaseW03TEI3BB6jqjkXV0UXHg90ptx/sc/vhPjuzih/+S3+Fv/2f/C955fWP0kXUSGv5g9/7A/7p//n/wm//y3/FSy++yN//B3+fv/pXf5rnn39ebYIC1ufOnWdre5um6/jWd74LxuIjNHVD27ZYE+naioO9A9bXC65ducTFC1uEtsLZlEJr5b6fGtgY8YwU5xDZaRTMhOnodxkcwsiMLjwG6kc5Xi8RYx8akeJrQKSpHtDUHmZU4guaZzPdV0BxlQcy2ftiRNeiAoTJlibZM0TFuFgu8J2nKErW1kR9tlgsqKqaECS3YQiRum7ovIKAy4lYzQGpsoNxtF3Eupwuc+wtFrx56xZ3D/b5lb/3d/n7/6v/Nf/Rz/08P/RDn+EzP/QZLly4yMHBAXfu3KUsCwIRl2W9h2UKUYhErMuYzWd84xvf4LXXX2d7+xxZUYKqUC9dvsyf/tmfsbe3S55ntHXF2mTEZFSoSilQFhmWVVmaBGhpsWe0kkKuqsjJZJ3J+hpFWcqaO6ns1VM4gUue5yzmc3Z397h/954EuvsAIWCBzImWIzkIW2soioKiKDQrjWN9Y4OPfPRj/Ee/8IuMNjYlawWSwgmjuS2PeM+uuIDp/0nfV78+jl+cRP24fQp6P+ccJ7nGB7wI9G/ch+f1l5QFYL/o1M9JC2JQSS2pH0NyMGpkAW8k2XYwjuhyfNAFy3DrxQv9JFu6hZIykX47S8sdOych8pO2x9Lx53ia5xmSeeoztLWl8dN/yqn03ZJruQFjaXykGK/z7Auv8OwLL7OsO3wUd/RRWbA+GTEpc9bKjEmRsT4qpVJwLiBUlBJwOplMeO211yQTA1HcwzPR/3t1ZLAW8jxjNBrJNh4zHo0oylIN7wYfxC4jBT67PiOD1M+SVU/VeKbzmlnVsmwDweb84q/8La4/+4Ko0WyGwXLjnRv81//Vf823vv5NPvWxT/LJj32CT3/qU6yvr6lqVNIrhODBwObWJlvntmiDeK2FGOlipA2RZdNCVrC2tc6y9dx9uEcXDS4vxOlCUxP5xFStxHqF4CVY3Hdq04riWBKjeoSm9FRiS+td6KPYUtKiLjlsJNuYScG5CqJmAGghhFU2j2Rjs+r8YKDzLZ2XRYccL88sICZ2zrZt8epRmaSHtm1ZLBfEGClKSR9W1zXz+Zy6FiktRFFXNk2LtU77Wrwl0+9G1cwibeVEa1g2NQ/2drn94B6f+9Ef4S//1H/AK6+/Sj4qCIhN9pOf+Dg/9EOf5tLli9RNjbEGH1pZIFlouwY0LZTLHHmeUVVL/u2//bfs7u+LZ6pzkGWsb5/jL//UT3P9hRd5sH9IsBmHaquNiCSWclxmmZXYRIOIvYgnb9dW1Is58+kBTbXE+0YUTpplx2hdNRkLmlVCF1tXLl/l+Wefo60bbExllmTF79sW37ZYYxiVpVTMdhImgHr/bm6f42d+5mcZj9eE4VrxsrQpuXRInsXyDj0dYZgDUp71WBpoAYYkzH/Iq5+ejvPK930hpePXW133+JFCw91Rd0QN75A5qO8d5X2V0fa1/aJ15OMJrcmoo6O1BWa0znj7IlsXr3Lh2rOySDl2m5P3pKcxwy9nJJMe8MiuvzD01M+ibWA4gvyp/QddkQBWqgJ1OM5fvsazL7xCMBldgKYT9UuZZ6yPS0a5IyNI2fIoq0hnVzW5NjY3uHTpIt5LXbPEkDH0MWred6BxOmJnU5WXMlQfNCmu2nJCVEZsJbAtGqs1tAyLxrN7OMfkI378r/wHfOKHPsPa5pYExUbD7HDG7//e7/Pm935ANV9ybmObl198iYvnz1OUOYYVgEQNArdWglsjER81WFhLfDQh0MZINp6wN53z9s3btIHewWQ1EaVtrTEa1qLLLwX7NDnSvdHAaaLab+RonUAqsSnFpFIcUhRbWZLMpN00b2Yq+xK8JI7W/ugHhnqnCqDJwiM5nsSoMYYmShYFTS4dgsckBqyJqTsv3pMMGGOMonLM3CoVl0gqwgATBSAaS9N1zKolHZHPf+FHefEjLzPZWBeXePUQ3Nra5MrVK2xtbzGbz6ibis5LmaOoiwCjKiKvGVayLOOrX/0q7733HoHI2saGOD+VI15+/Q1e/MhrjDc2qVrPbFnTtF5sqannYlRfQlUHollHQofvWtpmSb2cUy/n+LYm+k5r/ImTTdvI4sGp3c8aizOWSxcu8uLzL7K9uSV2Tx8w6krurJVUWKrBELW/qHSNc2xsbvLc8y/yxsc+Lk5c/QRPdtvUB2msKBtO3f9+SXnIo9yY1TOkg55Ijz/OpH/OcsxT0dH7pnY58lLJXeM4KaAZRFcZkQwskoDaagaajFhMyNe2GG9eoNw4hxtv4CYbGv957JmNXvgR0rd72vd7+jP+AtNJbTAYFCe9q6SJMdRdYLK5zQsfeY0XPvI607pjqp5nPiKVfTNHpo4RhA5CS6YB1uNRwfnzW0zWxmrnUR1+n6dw1WlG3aRX2cRDH0MlkoWs9CPCNNPqOhopFNl68fpa1i27B4dk5Yi/+td/houXLostR/Pk3b9zl9/+l/+KtqpYH0/IrGVtvEae5XKMMv7gJS1VCIHpbMrh4YE6tHh8aFUSEEnOh4DNCw6XFXd3dql9lJRYSW2q9kfBNpG8BJNl1hiCSGloILRKaNJU4sGY4jKFpaLMdAVwwmhXk0vc4iNBbX+9Q4jqUyQVWcBHyaAf0L8xpSkTqdCHFh9bTVuWQFA2sY0m0FDgMoaYJFMFY2kDGWdWa8gZYzVo2+sAUIbQL1xE29J0HVXTYLOM555/no2NDVHbAka9AdPiI6Z3CgKoyT5LjBJIrrkxMVIO5v6D+3z3e99lb29PEjw7kcQuXb7CR159jWvPPMfBbC7emm0n3p6D4PiVtmPwF0mo3bUNTVVRLeYs53PqaknwXZ9XUoCvIXrJgWrVIWd9fZ3r1yRAvKlqQtepc0oQz2INu0iOIc5JHbe67bh87Tqf/txnuXL9OtaJloDEibUO2HDyPzrzj1LiA08+UgDhSUedhfone8zFTuJZx+ksxwzpkfsO8aT/nEad7jp+i7TTrKopRCPhT+X6FqON84w2zlGsb+JGa8SsBFeKpHb8WmlfKuC2OuJpX+2Ui/9/Kxn558gr9ftSW51EssLoArhixDMvvsyP/uWfwLucad0yXdbM65quEymjyB1l7nAmQJRg0LZeMiozzl/YJs+tZKpGeVdyZghSpsRpmZI+dkZtIZ1uEoCdDLYyUFJ9KY9UN+5CZLasmNdS/2xtc4sf+tznyfJSA4YD9aLi3bfe5o9+/w+x0bC9uYnvPHu7u8znC9pWgpejgpu1jqquee/GDd5+522sNVLSpmskC4qCWhq4jY/MqpZ53a5ilnp7oLjLp9GZPqdV/soBQKSLtD9JQSumKYwTlerEaWQlWfaHJF5Lwr40IVeTMhgFME2f1QVPFzo6/e6DAIMPnYK4BMmTkrMmSQhJ0iuS6QqIg6pDk9MGaO05lWAFwIKCsT6TSpEJcOu2oaprIrCsKnEwCZIPseskQ8P+/h43b97g4c5DynGJdaKu7nzbS5h1VWuKMBl/UWO+vvWtb/LWW2/iQycpvoqcyfo6z734Es889wIH0zkBQ9N2dD6os4vad60sVlK8mLXqpRgF2HzXUi3mzA4PWMwO6ZqaPHOURQEx0jQ1VVXRdV0fNlFkBRcvXOClF19iMZ/jW81CEYKk01KPY2utBvU7XFbg8oJXXn+Dz/3oj4lmoo+jO74N6LTp35MckObd40mY+YdBcpXHAxuc7ZGehtJ9hyjyyCUGP6yALR21+iuJ9kVaw+asbZ9nvHmObLJOzEZ4m+NtTmfzJKn10HkCHdWTxqfY5GHNifsfd8e/qHQSbJ207xEyYoDOy4LGB2wx4hOf+Twf+8zn6FzBg4Mpu9M5+/M5dduR5RnlqKTIMyyRtlmyrGbkhWV7ayLmihRf0yfflRW6c04mago0VXWjVy88Se8jzyR2v7RS1lgb9eqK1rGoahof2L54kZdffY0Lzz0rebF11Bzs7/Gdb3+bu3du09Y1zjlmizlf/drX+P73v89yUfVMy/tI3bTcun2Hr371q3zzG98AoOsa2rama2uxiQXJvuADRJvRGcd0UWG1SGYKRZBUWfIcSVITdZ0wWWG+SXpNaj9RofWSUbKFDFSjQxtJ8JGmbmgaCWqO0WCNhF8Y40R66yJdF4nYPpNHF6HzkpdREgtH8U/QEjDJiUO0ogL6iUT1KZn/0/vJs6haUUMFEpDlg6BiedfBaExSZ5R7t51nsaxYVlIT79vf/g737z2QzDZNS+g89bLiu9/5Hl/5yh/z5ltvkWWZJkaWZ0oqzkwrdNdVxWIxxxooi5zvfffbfPMbX+dwf5/NzU2tJ5ezvbXN+fMXiFH6tvOSEaXzXiQ9HbdZJum0MmfVTiYJaqwRL+KubZhPD5keHLBczOnaGmskNjOGQFNXNHXdt511lo2NDa5fu3ZEu2GM6b0cXZ6RFTkuz4nWMauW/NDnP89f+smf5PlXXqZD2k+b8xjvGtiSSNqDwa8nMroncowPnXSGH9/dUw89jwFS+f343seT6f85Sj2AJY2EUt+G/UmpmshKUgvGgs1FDYmji4a6i9Q+0ohLv3g/Cg4O7p+M4olxpP1nJAHB0886Exg8iczjO+qsNGzUx9FZj4NVZ6XBHlWHb5CEw8YYnnv+BfYPD9nZ2WW5WOI0SNUY8SpzeY54bUfK0nH9yjkuX9wQ93YrcWht0xCDlwwIRmt8eS9g12+d5HEEZcqiZrHWYTVoMWU999HSecOyCTzYm/G9t9/juVde46//3C/w0utvSPCvevndu3OX3/3d3+XN7/+AyWTCaDzGOkfV1Lzz7jsSDBwNddXw4MEOX/uzP+O/++/+n/zpn/4p88Wcpq5ZLpdUiwX1sqJT9ZGoD2G5XJAXOR979SVeunaekladH9QpIGUF0cmWvq9sZfTALYxdkzUjDD+qc4dIkyuQS7bGlPFDFgfJliYu+D4V5dT93gc6r79HUVfGPvxNVb3RaFhWWuHpWFFm2XNMTVAMRqTsZAdVqVdfFjA4J44WXZdsVOld5d4hSnXraDI8ltu7O9y4f4953fLWuzeYzhc0dUu9qLjxznv8zm//G/6v//Sf8v0fvMl4MpEs9FGCvGOImhVF3qmqaibjEX/px7/If/lbv8Uv/sLPs7GxzmQyYfvcOZ65/gzL5VJi7DKH71oOd3folnMKa9icjFiflGJx1lJDJiUJRrPEIFK5y3LyXLwfrc0IGA06b8BZsrzE5eK8kVSweZb18YOjMufunTvErsM5w3hUUpQFo/FYeJ1zNL7jcLHgR77wRX7pV3+Vj37840SXyaJEOWTyfEzdJ70gjDjxTyPsc8X++r+rHem4s9LTHv9+yTB8zkdJ3vV9gJuO9aMCj/527D9IApSkyxrMBjnCSt9a5/qYxagFRgMap5YALfVS6iT5cvan13n2xHP6hzv+w9PS/1Sg1rfz2Y476VhjxTYiKiaxcYwmE8rxGm3TsPNwh+n0kExVLhFRO2EiTVextbXG9avnOLc1IngplOe7FqLYQfr8hApoCdSCVlmOusq2TmJ7rBVwE1WWI4Bmj7DUTWC6aLi3s8+New955aMf58d/6qe5cOUqwSCpsNqGd995h3/z27/N/fv3NJu81GKLJnI4nfLg/gNu3rzNW2+9yze++S2+/OU/5s23pHhj2zZUiwVtLaEHXdPgVf1lFJwXywVFWfLRV57nteeuUNKCkYrHzlpJodPPL50Oeq6syFOmfrF5eXUXNyRV4xDM1O40yPJxFOREcpPTUkdbDOKE44MsGlAXdGszjVDUeDSM1PQaTlwFqNCD2WoJm6S3JG0flejkGjGCtRltm+ykYIwEoArYJoy0mKykxXB3d5c7e3u00RBdxoOHe/zguz/ga3/8Nb78h3/IH//Rl3lw/4FktikKoubjixgRsbw+hzHM53OuXbvCT/3kX+EXfv7nePaZ68Tgefhwh+Wy4vU3Por3kqUjs5ZmueThndvcu32T0sLW+pjNtZFWMe6QESxbsvnKZNJE1llOlheUozEuzwlRHK0CAkrileiIEbq2JUsVsbUm3d7uDjsPH9C1jRZdVRVvltEGj8lzXnntNX7xb/5NPvrJTzHe2KCNkWidZiwZMPPhX/3cT38jjNTo8atuW500GAX9pR5HTzzufQDNaXSWy6R3e/KDCb0vUNND0l/615TQF2NWmqWAEQcea0/xfjT9P2emHgSf8ry/8DRo+FPphA46SlFtNZqBHfDWUgd47uVX+dwX/xKf/PwPM97a5sH+AbuHhxzMZhzOp0znh0xnB6xvjNnYHGNtIEbxenSpsrK66Sdmvsp+Id8xA0BLMV4qnaV9IJI5RlIOBcSuNl5b5/zFC2xsbfVuXdapw8f0kLt370qC3sziTaRDEr3Wdctbb73NH/7hV/id3/13/MHv/xHf/OZ3ODycUVcNi9mc5WJJWzeEzvc2jtRyrRfJwyNxbLIq0yzoKgFHVCBL4JQ8QRW0wtBGluxkaptaqRjFESKE4UIgfV5JbUGdQ4bnpd+8h64zdJ2j6yxdZ/HeEWIGMceYEmtGWDvC2hJjCiAnkhGDI3onf6ODmEGU4GwU1GKvdkxhBavFZgI8IWEGq7k4BEkBphDBd4EYoSxGHO4f8J1vfZs/+oM/5Gt/8jXee+cGBkeW5RLqoe/YqQ0sJgk2BtquxVrLeDym1Aw5F86fZ3p4wJs/+D7OSt5Sq2rSzc1NLl++3LezMRJsbl3Wl8+RPpV37m2JvsO3LV3b4ruWzBlGZcFoVJJnGW3TMJvOxGamcXQhRuqmoWlbAMbjMa+99hrrG+v9GHaZI5jI4eyQrMj5+Cc/yd/4hV/gU5/9LKP1NZoQ6IBO50M/3rS1hQZz/cTF8Un7lAb9+EGpv8qTLvek35+CjvC6x1zXHDs2Hdr395GjlQb+HCt+mmQ2NIgq/Zfa3ohkP7jKsZZJ25PpyCT6/yXq++sx76bvfjKYJYqE0GFMIJqIR+ItmghmNObVj3+Sn/zZ/5DP/dgXKNfXWbYtB7MpO3t7PHh4n7pZsLk5Zm2tBMTBwBDEFVkLSHov8VLJiUO83QSorFEwU5VjWtUZI8GjCeiICCPXc7sY2D5/nvMXLzKeTORNdFhEJNXVw50HkpUkc0QLXQyyeU8MsJgvefhwl739QyloWbXMZgsFt4qmrghtK95oJKcDWaXLCrwgLycYjYlDV2qJGQioSRunxUMSaRKwJalMJLTYO10Mt2Q3Gm4p8XPwgbbrNFZsweHhlP39A3Z393j4cJcHD/bY2Tnk4c6UncG2vzdnNqtZLjuaBry3GFNgTYEhF2CLGUQHwUHIgEwTAhmZuspFh6CWXjxqomRA47JkeSvAl0aetGXbiioYLCFo6q7WMy7HbK5vsrm2yfbGNlubW8QIddVQVY2k5Oo6iadL+SuDVOZ2znF4cMg7b7/DzRs3uHP7Fjfee5c3f/B97ty+hXMSimI1JGV9fZ0LFy/qIkq9OFOuzsEiJX0wAApsXdfS1BV1LUVWnTWsTyZsb20xGY+JMVDXNXVdA1CUJV3X0TQ13ntclvHyyy9z8dJF8jxXhx2pmJCXBa9/7KP8xz/3c/z1//BnWdvcpAmeOng6oA1eQC0qAxUuupLcejPDv186yxPI3Dm+94PRme775ENAR/0QxJRRrT73wKZamsHYCap2V/WjXGDFLIZbzwNP3pKB9Pj+x2zpbsfp0T2Ppw+rg3pGcZySveYxdPpgHqw/lCHJqhpA8iyKqkoCtDc2Nnn9jTd49dXXeLCzw3u3bnP//n2ms0PeeP1VPv7RV9lYKwndsrefSbqmZFurJEZNA5AhqKHd9IU1rdFQVbWXGvUitFq2wXtD00TqOjCrOm7ceUA2WuP1T32Kj3zs4+SjEXXbid1sUfH973yX3/ntf0OR5WRG1IHJcSUSiEakvZRBvmladSxYUFfLQWJeYbghRJq2IcZAnjm6tmZjc8KPf/4TvHJ1i8xLQLJVl/aoTi+r8XnUUC/92v/S/xC14m5iUlGSTIj9KdUbC1IKxceMZe05nC55sHPInXs73LzzgPdu3efG7XvcvH2fG3cecPPeDjfvPuTm3YfcubfD3Qd7PNw5ZPdgzuG0YrZsqJrAeG2rN3DL9S0+ig0paj/IJF1JKjGKV6vBqlOngSipsLouqJpTPR2jLE7F6zEOUgg5uhjZm8/Ym09ZaPqnaCwmiOdk23rqWqpr++glwDqiab4CpneUsYTQsjYeMdvfZ/fhfYrc8YPvf4//4V/893zzm9/k4sWL/NW/+tcgRjKXkxlDU1fsP7zPd7/1dVzsOLe5ztb6hNDVUoZIlEioslNCFVTNKosTqXIdkLjFcjxhfUMqc49GYzCSSYUI48lYhnpazcfA+uYGDx4+5MbtW7xz4wYP9/e5+uxz/Cf/4B/wq3/37/HGJz5FdBltgGDkabSWwDFeY44EXSX2IWMsaimVFV8Yjr30ffVNLnAqD1I67deYflM+JM952tFCR9/lw6HH3bd/W/3Tqx/1t5VSXrVFq3VDWjpIu+ppxmiOTo2tlYVt6guL+7X/4je/BCuVhnnELDd4/yHz6B8i/XiM0lMd34y+ht6v3wZXPn7O0f9EBSX/rv47AiJD6jv7lO2E3/XEI5dBjz2+/9HBqBLvYBMZQZJuprRUEjQsLtvBQGcgOsvmhYu8+rGP8+prr7O+vsFiMeVzP/RJrl06j6HF+7rPdO59Q10tWFYL2qaCvjCl06rRw/uoClKBTFIKOfVOVNUXGV3naNrIvOq4c28HW4559WMf5yMf+zhuNJbM+C6nXlS8+b3v87v/+rdxEQpjyY0lj+B9y6KrqEJD3bYCaHXbB8l2TUPXdSpdiopLBBIZT85ZJqOcrl2wvTnmp77wGS5vZOIoosw7qHqVYT8aASzJaSltK6S5LYMMeoNZpbWKSF5Em+Fx4Eq6mDFbdty+v8+b79zmrXfv8PaNe9y8s8uD/QV7s5qDRcesDixaQx0zZk1g2RnqzlB1lmUTmS09+9OaB3tz7jw44ObdHd65dY8Hu1NmdYtHgpNdXmodukxCPzS5budbvA84YyjyAt+KdGWiw0QntdR88q70dNH3mWFE2raSoR8j8XMGptWCvdmUw0VFtBaPofNegqG9V9V0yoSjsytJ+yaTjUjhDLkJrI9HGN/yp1/9E/70T/6Y/b1dFvM5Fy9c5Kd+6qcEFNtOXPLbltnBHt/6s69iYsfm2piNtTF5ZnB4sa0NXPqFUWnBV1WXe5+qe4sDTVT7itjbcjInqniXCnxacbbBWrKyIB+PJCD81df4+/+b/y2//Hf+Hj/0wz/K5oWLeJuJx21EFhe9k0q2mtf9gFsxWR28+rPwk+NMIP0nS5OT6ThLPMIeSTcbkjJknTeJk0mfrbZHz9OjHnPM436j57axf1uh4YMON3o1Yewb6ijfFXVjOj0O3EZXaITOcdkb+moK8pPY2k0E92v/+W99KblMHruN3FhMMoMLy+Mcf+xHtyNNvPrPrI4Qz8pHj37kKgna0yR75Mo6sIw+9oAMJ3dKokdBSc/RT/3Wt0/ar59OOF8f6MiOiJSlN2llopeNJhKMobNGcpi5jHKyxvlz57h+9SovPnedy+e3GGVRHETocBaaeknbiCom+FZKnltx9c+clfRZ+mjWCGMyGg9kjHgNyYBwSLUisf80bWC5bJkvW27f28HmI15+/aO8+NrrmCwHmwGGrmm5c/MWX/2jr2A7z3pRsr22xtZkDDayNz9g4SXDvG/Vi9BD0JppxqB588QJIMsL8rwgzxxr45KNtZK2nrO1UfJTP/55zo2goOkZSJpQxohjTZp7oQ9clu8RNEN9UumtpNYYovSJy4kmY7Zsufdwn/du3uftG/e4fW+Pg3nLdN4xryJVa2lCRktBGzI6crwt8bagiQ5vcoLN8abAx5w2ZrTeUXeWqjMs28iyDRzMK/amcx7uH7Kzd0jVelxeiG1Jx2uS0GSYiFHHt0HD7SwxCKiFmPJwRIL5/7D3pz2aJVl+J/Yzs7s9q6+xZGRkRmRmZdbaS3V1s2c05JAzwJDgYL6BAOk7DMkBqNELfgyBbyQREDSChAEEEhIE6AVXkSyS3VXVXVVZuVWusXj47s92FzPTi3PsPo97uEdEVldXtyiezBvubneza9fuOXa2/9FoTtIEs2CkmGogYjPLom04mV1wdLYgr0pwuVSIyKQyQJYJwobLBPja2QxrMzKb4VyOszlFZhmVGbkJVLmjyh2ETiCookQfvvbaa/yX/+XfwNqMum4IWvn79PAZP/6jf0/sarYmI7YmIzITkCWF5uEZZar6XzJTWuvIcql8jZHgjc5LbbMsL8g1WMlaq+ggGXmeYbNMcjFdRjUc8fAb7/KDP/zP+K3f+wF37r9BMZoQNDo0Wkfb58/J6BuTBKyWK3ruk9fj5INWPrHeDKbP+TXI5FR5fe11rt2Uz1wKskjn9zz56s7nbvAr0g3XUVO30ObPq5sKs+eO2PzveUpa2uUrmV7guXyN9WqUzyU3xm+OdPD7P1UgX5/LIdQrfNfQ5mnqV+9pPQg303X7DWshvtn43LBfHe1+u3ryBqmKnDQ3Nn72vdH8quGg5I03Xud3fut7jMdDUJQMZy3BB1bLVe8Ez1xGXhS4LNekZInIs1ZymHoubxVmpuf6CvRr0DSCgDMBi8dFT2khi1J51nQtxnc4BFOxyDO2tibcvr1LmRtGVcbuuOL2dMit0YARkWEIVCFQ4smJOBPJMktR5pQDKScyGFQMq4pRVTKpCrYHJfuTAbujkv1xya1JxdYgw0UPUcP9NzYxvCVTnfp7vCKm6JB71XzEhGdEwyEjuiHBDlg1loPjOZ999YyPP33Mx5894svHhxyfLVk1kS5m4EpcPiArhrKVQ1wxxLiSaHOMy7FZjnEF1uWCgJK2LG050ThWbcfx2TlfPTngl198yQcff8oHn3zGl08OuVi2eFMQbEE0ec9s607hxELAR0+IkndnLVJKyMoixiLKiTMRZyCzkcxAZqTkUJUXDIoSB5RZTpnlDMqS8XDIaDhgUJWUZSGBGEVBVeYMyrz/OaxyRmXBqCyYDoZsjSbsTLa4tXOLvZ19ynLAZLzN1tae4IhGQxeCJFt3LSF2BN8QQ4uzntx5DK2+T/ky1p+TzLV++mood1HkksNpDF3XsJjPmV2cs1osCF2Hs1qNQvPe8izHqR8vz3LefPNNvvvd77G3t0ee5Rt5nutAoGTOEh/s2iLwn+gvP/3mhNqGYNhg4Zu7n2tL9DLBJtNvfYBBhUtarl9D/TEvadvs90bDlVXG5n+6yry6bfQU1VJTlnwSbAaJEnNWhJtvVswuBDkhxkCmoezeK7oEgoKQlyV5IWDF2MTm14IrRTWKDy9ls67/FvMOgMfaSOGgcJFxlWO6Gr9aQttggggWQiDPHdvbE16/d4fMRQa5YVw6poVlp8q5PRywV5Rs5RnjPGNUZFRFzmBQMRqNGI5HDEdDxqMR0/GIyaBiXBZsjyr2xgO2q4x7uxPeurvHziAnix0mekwMUoJGDbpGIxx5LgIyvUsp0hl81Dds6LqIDxnBlMxXka8OTvnFR1/wwUdf8PjglGUDthhRDCZEW2KziryUv4vBmKIaUwwm5OUImw/A5lhXiGBzmZgSVaDhnG7SFq3D5AXGFQST0XjD42fH/PT9j/jZB5/w+eNnHJ/N8dERTI6Pji4Y2iCgz13wYkqMglIi2oMKgogIgiiRpI6Ai6EvsmhCJLcZw6KidJBhqLKcUVUxVNBr2UqqsqSqCqqqYFAVDCoRaMOB/CydY2c04dbWDtuTbQbFgDIvcTZjd/cWd1+7jw+SS9Z5CWhp2kb8v+0Sazy5izjnMXQKYJy+kagZR+vfk9CzRoCMiyKTfhYFMXjm8xnn52csFos+T80aMUdBVDO8oWtbZhcXzGYXEvmqleBTQE4MQTVFmS5RBV1yylxHiXdd5hMvoa9x6H8UdJWv/jrohlfyGxFqIluef6j1ZHg5Xdv/y5bJDRvwy6943fVSW2RDMG30Ttquf5bnaWOqb7jZQJM3SVqT5DL1oxADJnoyC84E2maBwYugi5GubWnqmrIUVPayrLQ6cC6JiClsW0GCjXUYzd8xzkkeh/6ewuQVroEuyCraqllpOqyoZxfMTo9pl3NoG5rlUnD3gme6NeUb33hbIjtjR+EiVQaTwnF/b49boxGTLGecZWwPB2yNBoyqUqsRlGyNhuyMx+yMRmxVFTuDkjvTCXujIQMD93Z3ee/NN9kaDkRDDKKpWWVuifHARpSgVUQU9dHJ+EqaQttFMVfZHFeOOZt3fPDxl/zoTz7gl188YdkC2YBytMVgskNWjihHU8bbe2zt3WZ7/zaTnT0Gky3K4ZhiOKYcjSmHY2xWqoYmFZqjERxN+SkFDJMPq+kC3lhMluONwxUDoit5/OyU//Djn/Fv/+hPODxb0pmCYEvqYGm8RMyaLJNcQCtfrw+ahqDoKQZBos96bS2Q2UiVZeTWMixytsdjdsYTMmBQ5AyLkkGeU+UZVZ5TFbrlOVWWUeWOQZExKByDwjEsHIPMsj2qxC82qNieThgNh8QQ2d/f58GDh7Rtx6quaepa5u1qyenJESdHR+QWCmega3DpfSIlRkRDW6+9NB5A3WMe78WcaS1UVUlVFpgYaeoVi/kFy/mM1XJJ14q52hkJLArek2cZi/mcg4NnhOBpmwaMmK7Sgkhqs6lPWn02N5EhMbibecJ1vOYyZ/mPn2Scrrb+GuiawX3xG/tzpjXbfzWKrJP3RDD8apvcdK07XW27jp6bsypEn6drOqaXF0YsH4BoacL0BPVbJrlFEPujb1jMTmmWM5yJBA1pTvW1yrLUCCAFF055VClRVpm57QWa/LSZ+BisyzDOYjKHyx15WZCXOdWgZDQsGZQZ+zsT2uWMs2cHLM/OIAS6uoYgBRXH4zEPHj4Q+KnQ4ZsVvllQOcOtyYTbkyn7ozE7wyHTqmKqJsZxWTCuCiZlwShzDK1jqyjYG47YH43YLkq6ixnTouTNu/fIMRIZZ6JGyK1NUmkxI1zQiPCIRqIuvUT/GZeLAImGLhqMK3l6dM6fvP8JH332iNnK48oxthwx2t5jsnOLyc4+O7fvsnfnNbZv3WG6u8doa5vBZMpgMmEwnVKORtiiJNoMW5S4vNoQboKlmbZoJQIxGEN0UgOqwxJsRmcygiux5ZDgSg7PFvzJLz7hy6enzFsITrDtWiwtkTZ4OgImc5qSIeVQ8iwjdxmFy8idU8EWyAiUmWOY50wHQ/amU25tbRGbBtN12OAxvsPGQGYNmbXk1pBbIwEhFgoHZQZVBoPcMBlmlFnExgYTWzIXyZ2w6uFwwHQyIYbIcrGUUPvVisVsxuz0jNC2DMuKQV7goiQwFHlGUWTrn5mjyN36p27OWqwBoid0LaFrcCZS5o7cGULXsJhfSPX01UqEVoh9vlzUCN2ubVgtlxo4ZeVD3cgHTEwp6uLpOr7QC7RXoE2+1VOavxtN/zGT+Q09sPvv/97f/wfcKFx0NXH1RVxz5POkV7zh+Kt+tOfucwMlQZJOvxweeg2l/Rvbdf3BXGk1OrGfOye9lGuvonT1ppd/k/W0FQbXX0fMRRme0gba2QmzwyfU81Ny4yE0WBvJMwkCSWgXfgMOK0aJ6jFWhJnL8rWfLW1aC6r/W82PaA6UjRA7T9d6QogcH58w2d7h3hsP2Ln7Gj4aMa2pMMmIfPCnf0JoVhQmMMwtVVFisTgjFbazjbIxzlmKzJA7Q0FkkDmmRcG0zNkqCiZljgsNZ8+e8o2Hb/KD3/ktSusxfoGj7d//+tswa7NqQhcwRgJDjGhMNiswNsNmJRHH8fmSn/zsE756esKy9tiiZDjdZry9x2R7j+nOHpPtXcZbO4zGE4bjKdVoRFEOsHmOzbJe68WpeTdqVQQNBpL3zDrqywgGaoiiqQeg0whFiT7tdVAChrYLLJuOLM8ZT6aUVSn5dTFo1KqgpMiCSL+HKLOyv3uUqsHWiNCTACGxDjSd58nBAS7PKXOpsO6Mkwrr1pBZo7XHILOyJSFXOhjljiqTskgGSds4v5iTlxXfeO+bPHz7G0QjlaN9CMSm5vTwgA9/9hOeffU579x/jdf2dxgXlsxEisySuwSBJqZCSc5OWJdqXbAZNs/J8pKs0OCiQgCIrZMczKB4m9aIEHRaqbtH9ekFl2E8mWCsVDiIqGVDa8VJKsAatebq9351UZv+unrcVeoX0emqvwY+n977b5rWY/Bqd5cn/jM+sC40siylKV2+3J+vULtivtuk61qvW/Rckn1XOrO56nluAaAPJD24/N9zdM0zJdPjpXFRRn6p7RVIjpf8lbWGloSbUTEXyOiojMd1KxYnz5ifHEC3IjMeGztyZzSU30tSqYbFh+Al6xBlAAoim2CDkrlRtrUpMm19AixGsPIU+Nh7KVi5bDuysuLt73xHmCmy4rXGMigLzk+P+eVHH1Ivl0wnY2yWEUzEZgaXW7LckjkoCihzGGSRQRYZZpGtyrIzzJlUlmEOZRaYnx8xGmR877vf5N133iL4JTY2WNOpcSGNoWg/a23IEYzDZDk2q7B5ATYnywfYrMS4gsWy4ePPHvOLTz5n1UZcWTAYT5ju7rG9t894a4vxdIvJdIvxeEw5GFBWlQDfZincHbCRaCLRSBBBDFGwDIyEkEcUZiumZHZhmj54LUkjc9sr7FaIto9mjEZCy6MVrXowHLC9u4uxhryQ0ijWOrx+HJGUy7X+WgwaGaomNAkmh2g14T7LODw+AqDIc6qylFQRa0Wg6SZBJiLQcmspnKWwhiqzGjQk6B2ruubLR4948PAtvvntb7N/6xbed3RtjQkdoV7w6LNP+KN//S/YGRW8c/819qdDBpmhzC2ZU0GqKQXJr5XyKcXvKwsJ52RcsryQrSgFFzKTyEhjLV2nlShU+xIAbAEYEMEObdcxmU5xWr0ajcQVobP+wtM3v0lGdvS/p0X61eNupEsH6sP+GegGzvbnTl9XqCX6M/X2klBL72B9xT8/8+NVIfMqdCUSsv/VbIyZ/p4E2hWFT2hDmL0K3Xxcrw/2eSk33PEllPJYNme+iLJ0VWHTgcJBs7hgNT8ndCspPxMkjN8oWGvbtjRNS9t2EpkVwRhFDEkamsuwmQQuJMHVmyLTqjeTemvGWYxzmowcMc6QF46qyrh7Z4/V8pyPPvgp7dkxxneY4KVqsPcMR2P+F3/1rzHd2WW2qjlbLFl2DT62GNtRFJHR0LC7lXN7p+TOds7tqePO2HJ36rg9seyPDTsDGOUttpvRrk75re++yztvv4G14ri3VqqEo5qGaD7qs7IZ0WVEl2PykqwaUYwmFKMpxXBKPhxTjrbwZDw7ueDTLx7R+IjJcorBiNHWNtPtXabbO0y2thhNJgwmI4bTMcPxiHJQkpcZrrDkpaOocooqJy8dLjcYJyjzfSFTm2aKIpiwFm5B4cd8RMCjA9RdlCRsHK13NN4S3Ih8tMfS5xycr1gFSzXdYbp/h8nuHoOtKcPJBFeWuCKX6Eo1vUp2i5ZT0RQPazzOeDLjGRaG27sT3n14n1Fhsb6hdDAuc0pnKKyhMIbcyO+lNZRGf6q2Zon4TuqctU3NYjGnWS15495d7uzvYkOHCy22qzHtktXZMUePvuDw8Ze88+br3NqZUmWOwlmGVUmZZ+S5pBHkWgHbOSMxNipgxb8WJULYd/i2wXct0XeaO+fER1iVFHlO2zTMZzMWswtWiyW+lTxHZ6Tydb1acnZ6IogjKRcuLVo1XD1FzG6SfL4bbb8KS7iGbuJC/9HSr+GBY//Pmv58NLVLGtr1x17fes2ODXv21cm02X6p/6/Sxw26aka43CZRHl/nelfJqK8MkhlKg0P0ko4OFz15bClizdnBVzQXx1i/JLZLCgeZkcKMq8VSHO++05W4BH6kkiwpnyeZUTbNi/TmRhEQRk2Vxhi6thPNr2n6MjAxeIpCQIpVsnDrzh15Is01cwZu395nUOZ8/tkv+eDDD9jZ3aZpa63qHHEOysIxHhSMq5xxkTEqHKMiozCewkYcHfVyxvHxAZNxxR/8wfe5d+8OIbR07RLnpO5Y0tB8lPI40ahAsxlkOVk5IK9GspUjsmJIXgyphlMODk/42fsf8tmXT8iKEXk1ZLK1ze7ePts7uwzHY4aTCYPhUKonO6fvHl2Y9MZEfOj6wpkk9Hovlbe91/pput97L2H4wRMVILhtW+qmoeuStiMI/iFEumCwRUUxHDPempAVOaenp9y6vc9wNKAoSvI8E2T6LCfLinUpnJgS2VWgSmKboJIYQ9IZrbNs7+zw6KuvmM9nVEXJaDiUqEmL+tYMmYlkiPmxcIbCWTIrWh+I7/L0/JynTw74vd/7PX7/93+f/f09KezZLCkdxGbJ5x//nC8+fp+9Sck33rzL7rhkkEUKF8iT4HJJeGkR1BSslZBv1Pwo5kK5d6PFRq1zZHlOURQURUVRDgRRxWtErEFAt/OMqIVoOx9o2obtnR2qqpL7abBVVFYjgg4x5SY+s2Gt2dTQrnKIF8q6qwcjN7yu+VVI7v+rnv2r06+qqZH6+/VPu6Sp9e9iY+yuF2ppMvXCydzM3JNJ7tI5uuPSz8t0XetVc2L/zEk7T39cmTBpV3/stVe/Qhv9vq5dxiAN1itc70ZKgy5/JcQHNBrLWUNhArmJVNYTl+fMj5/SLk9xoaawgdDV+EbqRAmsVOhx9cTkoiUYSO9ANC/RHmRfEnxG/Q4RjZBMsFadoj50Lb6V6LI+mTvPwEROT08Zj8eMBgNKzROySFTi/v4uZZFzcnLCJ7/8mMlUyqobTYp0MULXEeoVtA0uBAoLuYXY1VxcnHB+fkSWwd/4G3+VN964R547vNdimkbCrqN1EjqfV+AKgsswWUE2GFGNp4y2thlOtimHU/JqTF5J2H3Twc9/8TF/+vMPaDqIJqcajJlOt5juiIZWDgZkudTVkgCcKNWSg4xR17X4rqNtJDS9rlfUdU3wnmYllaB9J2PYtRLxJ2V/pBBniJGmbUVjU66Z0MalRI18BB6LNxm2qJhuTZlMp/ohR8qyoCxFE5GE9ZIsK8iyApcVfd05ee86v63MwRg6TGal9hiRspJgo+ViwcnJMSZ6rInYGLExYLwnti2xayXyNHhJNek6ujbSdpGDg0Pm8wXvvfdNfvCDH7C9NSV2Db5d4WKLX834/OP3efTpB+RxxXffe5P9rYqtYcagMJRZENNjJmZFqT4tW55lghKSZVq/TQS3saqVaoBVCDKXI+CsI8tLopFyNEUpCeX6KWLVfOkyWeCt6obhaNSbmI0Vs2TKTRNaOwpu4gVXW18m0C7tT5iSL6PrhJ4ylqsxCl+XTM87ErPd3LfBwDbaLvPO53r2SmSE4V7Zrh4llEbJIJab4DuIkOl8kYPi9UJt3dlNkaZBCLqnp+vaYPNqV9qFrsqSS4f1gmlTmq17ePX99XtfVaCxeY/Lbf2dn+vgr0JyDYMMtt0I5TdG8qeKzAmaQmjI/Ir58VOW58+gmZMhkWXtainaU9sSg1TrzXP5MMXcpWYTs9bMpG0jF82k3DSZNLKiV7gpHwhtA8FD6OQnwuCck8z9zFmIkbpeYRAoq8w5yX8ikOcZ060JW9tb1PWKH/3oj1guF+IBi5HQNNA20LbQSiK3CR3Ncs7jx18yn5+xt7/NH/zB93n33bcoq4zgJVk3dVu0zQxjc8gLTFGSlQPK4YRqNKUcTSiHU4rBqBd6xkme2eHRGT//4GM+++IR1lXk5ZCiHDIajxlNpgwGQ1yRS66fMSLwOwHSTcm5XdcKoG7T0DRSC65ereg6T1NL6RxBk296RPmUUxgRodxpQI+Aryo+ozrYIhLk0AUD+QBvHMPRiO2dHUbDAadnJwyqgqqqKAqpL2bVv+SyAucKnDJ/mb7JbC4+W0lkNlIaJQpjKMsSaw2r5YLDZwe6oBEBZgT5GLoWmyoe+Jam7pjNljx+8ozhcMR3vvtdvvfd73Brf4/MQuhq2npOPT/j2aPPOD34ioKGO7sj7uyOGZeGYWkoXMAZr2ZGMYUn31dvgehh3QRMACOV3SXC1KmAS2kx6+8LK5ps0VexEPt98tFZzRWISAWIsiwpq0rfVQQEqsuYlP+nv1/hRmm7jvogtqvbn4Wu4bcmaZZX2oWucsuX03XXMemf63aC9uJF+2+m54fnZsEmDxqBQNMo4HbT9lXPV3X9akJNrvXrFWrw3JOs2zYbrjl987T16ckV/op0g1BLbb+aUHu+V3LFdbiw0Si9FJ5eWMhpsd2SuLzg/OgRYXmGpcHFlq5e0tYrCB4DZDYjL3KyXP1hah4xyf5vJcS7F3CKdZjeU+w3CWSIMQrz6lpJ1DURa6PmCIlQy5yl1OTprmkIbYNva91WEFosgcmw4tb+Lvs72xwfHDIqB4S24/z4hJPDI+r5iuVswcXZBRen58zmczrvsc5x994dvvPdb/Pd3/oO1aAghE40CzWVRSN5WtgckxXYoiKvRlSjKdV4SjWaUAzH5NUQW1QCfWVzEYAm55Nffs4HH37C0fE5WVbibImxEmyQFyIcYpQ6ZG3TCbBv3dDWLc2qoV6tWM6XzGZz6mXNYrHUcPWGrulYLVd0Wh6l69re5yilbgThJCiElFetTf7WktgIqHDwEW8MZAVNiJRFxs7WFjvbWxwfHohQK8UHVZQFBiOAwblsEiihZsYY8Gp67IVcMu9pEn9eZAwHFXme0ayWWAyhbWgWC+rFgq5eEtqarllSL2csFxesVksGgyHj8YhvffMdfut73+LW3haEBt8saFYX1PMz6tkJq9kphenY2xqxvzNmkBuq3FFkGpCigkY0S6v4pCJQko9L+quBTcbh8lyEeIruzXJNYVHzKxaXl5oMv7ZSbIIPGCeVJayztF1Hnuda5Fa4SPr+ZRGQvugXMNskPjZzZ6/hCJucoacXX/Z5usJzpb8bDZfoSkdela459jl+eYlk341H3NzB5+jlR8qCvKlX1KuVCDPdmrr5CxZqV0gmjx5/NafjBjLa383+vxL92oXaTcdfuUvSoqKYHDM8RWwxzZLV+SGL0wOsX5LRgV/RLOf4riHLLHlW6CaMCxVmGAGgtanopyaO9qvTHopLKKqQjbrZGLBRAGXXABgGm4lgy52hzB2DomBYlYS2YbWYsZids1xc0DU1RE/0DWXhePP1+3znvW9ze/c2Xd1wcnjE/PQCEyDUYqpr6haw7N++zfd+63t8/wff5+1vPCDPBQE+xFb8O0ai1TogukwCQYoBxWBMOZoyGE+phhPy4RhbDTG54BkaW4DLwWQ0beDHP/kZv/zsS5bLBmtzvDdEL9GGPkQ6H1jVDctVzXK5YrlYspgvWC1XLOZL5hdzLi7OuTi/YLVcMZ8tWC1qEXxNS71cKlCzCLTe9BgkNSIFinTBC+p94oDoz6i10UIkOknKrruAtYbJaMT+3i7z2Tm5sxSZoyxyyrIkIsj1WSaM3iqijI8KpxU8MXqsVbQMawUP0QrElLOGwaBia3vK3u4Ow6rCxkhXr2hXCzU9doS2xncCb1XkOe998z1+8Pu/xze+8ZDxsMS3K9rVBV09o11e4FczbGjYHhfsTodsjUqGuSV3UOUSOSkBIGI2Sos90coNhg1Tus7llIKShJlEPqrZ1QmajviLJeJVckDl2kkTRBd9NlOgYmNouw5jLWVZMhwORXPuX81lzvIywaYf5cu36875mnSpi/14Xd2kz/IUr36P/jmvO+W6ts25fA31w3j97q9Joqmt1PzfNPrNdWLmN18enPfYmr3Tsx9gQcMACAS4ToBd1wYvfkiJen6O0sshqe43UH/lvp9J/3g1um5ibrZdP/bPt1ymFzwvEYsiFiRtSvEVs9hShBV+fsLRo1/Szg+x7QwTloR2TrNcQAwMy5LcFthoBZE9dJIYqsEgtv/41x+O0Zwdebb18wU0mCCK6csGT0HA+E4YoZGK25EgmHg+YqLtC1s2naWzGR2OZRfooqEDqmqgPrcxZTbARkuznHN6dMjB48ecHZ0QWlkVjwYjhuMBWzsThuOKaBs6vyDSYkzAmEDoPCaALSpaLOQleTlgMJTcMTEzlpisgCwXIQb6DgRyw3dwfjrj//Z//Z/5xfsf4T1YMgwZWVbKaj3PKIcDiqqkqCqqQYVzjqZusAi0UlR/2WIp5W9851muRFPDRGbzGd53RO8JnRybao8FpGxKALwWQA0RCRgKkjjvtQCnNQ6yihrLqg2Mypy33nid7//Wt2gXJ9iw4tbOkNdubzEZlTiD5HeZDIJUfF4t5yxmFyzmsuhoVnN8s4Ku0+oW9JWyXVHgjZNK2Ehun++kntr8Ys756SmLxYwsc0y3p+zs77C1vUM1npCXFW1T07aymAldqzltEmySW+0bQf0fQfLgjPhDYkjfraGLEkQji631Twl6QfP4nORJ2hxcKablYoDLB3Q4Og8eA9mAYrhDcCXOScHTrND8QivpDK7IsXkufEaP2drd5c0HD+hUs055jxJ0s/E5K8UrjRHlbZdar6er597U9lJK52zI4cuUrik/f5V7pPfy4rbL/O/yfRT9p//r6rnX03XHSZu4R2azC+rlSszlCoNmrf0NCrUNORI3tnSE7Fsfe9MjP3csyJVewVP6Qu3rynNsyIA1Ra7cd5OuPO8VStdL0XOFjdjQUBpPXJ6xPHrM6cHn0Jzjl6fEsMKaTkBqowhFEyzG6yqcIHlgTgJFZIUuYxDTqs3ajcklq7aoE04YhiCQuBgoLYS2pgkdHqmlJbBEARcNmXEYk9E0gRAt3ji8zQgKB9X06PuW3JUEL8LUEmSl7z1d0yrgbiYo+UTy3IENRNNibIuxgYjUgzOIsI62IGQVthxRDUYMRhMGowmmqASFXsu24DJArHkxGgwOouXw4Jj/4//hH/HxR59SFUMyW9C1EknZBU8wkJWFVA2wlqoaUJQlhECR5RAjvtUAka4leCmC2rYtne8IMbBqVvggBVqjVz+l91olOgpjRBD1fYQuBNqNIqReFx/OWILL6TRXLYuB/Z1tfvvb7zIqDKGZsb8z5I17u2xPh2RZSpTOMFGERR/EoubCZrlgObvANw2kKuOI5QWjtcOsk9I30RKixUaDS1Ud0teq/lWXZ2RF3qcuoFGwuTMSXm+i9knC741MNojyjCFI/qPRsjFYgw9dP383BZu8z5T+4mg9ItzIwBVkxZByOJXEeiN5ijGrIBth8gFOUx0wRqM+Jc8vLwtcURCArCiJBspBxWv37jHZ2pJySOmdxSAPucE/0ne0SYk9vJwTPX+utqb/vx5FOel6zpOuprzh2vu+nCLr93F921X+179Nee9XOnfd9a7SzccEKW81v6BpGtHOtJyXMeY3ZH7sBcT6LhHRxpJi0XP96y/Wkxwi97x0+A2TyaR/ro7qBsmu9X6jK4vLZ6S/brrOy/Zv7IrC6HMTcKGhPjtifvyEdnGG8QtCOyeGDmcF1d6oaUo0JnnqQMS4tVnFKARQElg8Z4bQkdNBSo9sNN3Amii4eiYSTArKkJdjrRX8PE38dikB2QhOpbMRS0cWg6Dx4yG2GFqsaXC2I88CeR5xOWS5IcsMeQ7GeDAd1nZSJSCLBN+CERBaYyxkOeVoSjWaMhxPKYeioenF5KeTkjh9ugRWEDSwnJ6e8cMf/ntOjk4oXEHQwqV1U7NqatqupfXy93IlJo1aTZDNasVquaRermhWtdSDazt856mbhnrV0IWOxrcSxn+perZowumdiA9N/XZeUPeFWUsof5qnAU2SxkDwZMYwLKXQZuxahlXOZFSR55qDZvtJLGw4pXqob8pYg0S1y0diUkmbqIU5jcFa6UnmLLmTcjKDImdYZj2QcVVmFIUlz6EqIHcCSiwBHx25DeQukFsJAJHMuwC+7eG30KhCSTtJyDa6IEvmMiN97ueuWjewTjRwI1ieUgUgFXgVM2OeFxTVEJuX2KzoIynFvClWCowEh2QaQCIlkCSBvvOe8WTSR9MJSLYuADa+7Ru/8ht3XKbrD7u+9WWUOPCvdvarUeIXmze5fL/01/pn4tPXyYirf19H/T2fowhEura5FKWaBPZvRKhdFRps5IGkh38Zpf7Jkdec8VyDUGLmL6KrGpzRvj3fuvnzKt28Pwlb0aB0ve4bKhfpljMWJwcsTg8JzQwTGmwUjUUYjbyshFjhjEMqvoJ14kdL/Y8bocHCEDSKTB8mPebm85n0/gwEYwjWie8qyyUwwyRGIhqZxDQYohPYJ1BUcyKFJujaKH0X/1zAOo+xHuM8xnQYPNYEnJWxcDZiEvK+MaJlmYxoCowtyYoRo+kOg9GYcjDEFOUGkogi4RvNBLRidrRaN81EODk65Y//wx9zcXZOnhV0XSsJ7G1D3dasmhV1W9O0Te+HaruWul7SthLp2Da1nLcR0di28neIgS50eH1PMRU9VaB5DW7UiEcRap1WQbcu1QUTrS4FTcg7BBcjmVmjeeQmMhwUjAZS1yzL1Q+F+uU0N9BcQeWQcHgrhVV16xdvBow1ElWbCe5i7qyWq4m6uJLhNjZg8JI7SZD9aBoA4gN1Gp1mtDoAUeeIFd1H5JIGNKmwScIYRJClBY3RYCcpdCvpKQL9lut8NHRB66phxNdWDAQk2koyvHW2D+FPvk25j95fBzu90+Fw2FdWjvrynuMjmx/RJl39+ya6kW9evsRNx2xSOuZVjn1luuZiN/eYF/TiBWfduGNN158tc6XzYjVJ2lxUjfU3JNSuOeLqJNmg61rT0TeKwGsbN5/lZrp6jNHuPd+6+fMqvXh/VCehNVFKp8SWwgSW50csTg5pZ6eEZkFmOjIr5VVClEADWUk7cutwRhMOXVrNCuPsBZox8hFrhJvVj1aYl7z8fix7pmcEUcSJQIuZmvNsJn6WdaEXWfWbXs5hN+CUcgNZZJ0SkASa63rTok0bwhwzK2VKiV40WK0DF8nAluTFmOF4m+FkSlZWkBe9EOuFmpqXZK5J/L/RFT0Bzs8u+MmPfsLF2QV5ltN1kjjd+pbFcsHF/ILZfMayWYoJ1cm4dpqAHjpNTO/UGR0l3L8PBIkBTyRoqHyMQEyasyxmgkJhRSOBKUEOIfhA3TSsVjVd12GtpchzIgIuLIU3DRmS/DwockYq1MoyI88FeUNMgZqisWHukTB+i8sKmYOqLsaQri/HOWeoylKQPKwItMyA6xcnsTcNmyhgAS5IWRsbZUEi6R1yTwHvTsEgiCc3ja1FTHoWjFOflSxzdTGmgm3jb1DfscvJi5K8qHB5gbE5ARFsIn8MMVU+QAJFrFavFqEm2rMPgS54Efbpo9DcTWMtVQIM15zO5/hVGl+uMIrN36+hftF5pb2nq7zoRv66prT/Zcd9HTLPM8CX0NfvxXNj96qkFdK7VqwjaVTTYsj993/v7/+Dq925JNT6KMSvK9TQ86/Zu3nDq9sNw/I8WM0V0n5sbvaatmu3K8eh6QFGr5sYeoJnkgOVcZi4MVU3ychKmMTgpNXS4Yynch7bzpkdP6G9OMKsLgj1jMpGMhM0EbqDaCjzgjyTD4wgsEtWTSa9iUvfj1OTpOTypHB+uXdEpRjpueQn1mgtNieAwCRtSSLOnBFAWWvWphxBd5CoSmc1YRYjuUxEnBOTUkCi7yJihktRmoK2nnw2qS8Ce9V48DhcMaQabzHa2saVA8ik4rFIUzU59snk62vIA6t0CdDUDT/50U84PjrVkPeMuulYNi2n5xccn5xwfjHj5PSUs/MLYohUVUVVlQT1jaUX2HUdBiPBOk1L12pds7TiT76NiJyj3ZBFhyTeS2SioFmcnp1xdHzM+eyCummIQJYL4n5mBWA6M4Y8M7T1gmGVs701ZDIZMChziiLTxGVZ7KT7yDuW9xsQgWpdLkIf0cxcpmNn0Bwxh0U0PJe0LiuLMIMgulhryJ2FoPXtZPrINZPZ08izG02MNahmZh1R8UlBzH2iCakqm7qsG/0wRmkxSRMrycuKoqwoB0PyUpKtW+9ZNS3LpiMgJX+cdTiNFI5EncdrrczahAspvM46S9u0DAYDBtWAPJdUj7Uw2uBD6bm1b/KnfPM9m+gP0/m5cWrijZvHpWuv/17z0KvHrY+/iQcl2nC4pZ8vIeGJzwud69rWdOOOG+nF17uBdM61bYPvvFg8jMxpay3u7/zdv/8P+uv2q6KNs9NvVyLr0vbC/ty0/0UDfOkZZaJtTpDrKL34q/+tz3p+k+OT6LrclhKGAXGcq0CTn2ZDkAkrNWbtD9nokcbfqY/DSLJybjsy05KHJSdPPuXi4HO62RFZO6egw3QNsZVyGbnLKIsSa60mSXti6ERIpKgsuR0YFWYbqAzWWnzQAB8rAqof0JRakDanmpiaqpx1ZCp8hDFkZClr38iTySYCsBcqVrQ+Y8WfZVTLdC6T5Fks4rRToakJ4mLEcgSbEUyOq4YMp1sMtrZxVSUlXly+Tr5OWpqoi3pPjQB1l94qTd3ysz/9GUfHpwQPPhhWXeB8vuJitmBZt2K+irCYL7k4v6CuG4aDAdbI2BNlZlgFyzUqswjCyIlR/C/q4Em+mBgV+JiUvySBB6u65uTslKcHBzTBi19HtzzPpbqBsdgY5J17AXTe3h6xvT1hMh5QVjlFoYsd5CNJ32hSykQjdPiYoNJUyBEJxuBVu0nzU6pnr82IUhGddQVqtAgpslq2TpOkM13o9AvEze9Qqhj0Kr5+d846cieLJXoYql7V1bb0bSHfnlVQcCMwaWSZCLmqIisKMIKnGdGcNkVT6TSBPssygcvKBOu0bdt11fQYcS7rfTN5UVAWJTFGMpf1gsPonBe/oDyb+HY2xkifxZD4QmrRPDhSUvfz8ui5thfJKyVjRAPe5JeXb5Iu/IqUjr3m3kZ5Zc/fr2XS15x4AxnS+Zvbxv7r2mKkaZo+jD8tHI14ZjaiHtfnPEf9i7iyvZhe/cGup43zX3izNIle/b/rju7bos4Fvb0YyyzBOEKP26gcrQ/U1g+x74tsNspmkEgwR8D4msXZIfPTp3TLE0w7w3ULbLeCtsa0HRmGwhUUtiB24DtF4zceTCRELQqp5sasF2QyUCFIIEJyjGPXTNNkUr7D5jkmc0SbmBuARL3JZnBxPTYRC0aEirUF1hRYKxWfcYK9SFFgikLCpl2GtTnWFBBzDAXGiMlItEJ1+mMkas0W4kfLK4rBhHI8pRyPccMRFBXkpeahCfp+NE5goKNqrIkZCstW7MlAXmRMt7aoqkoQO3ykC5ZATiCn6wxN7fGdRGZ2TeDs9Iyjo2MZjwRlhZquvKfrPL6TYJDkLDM+Yjb+jqq1SlkT2TCC1H9+cc7J6akKn0C00BGofUcbPHmWkztB0nA2EmNL260wLki8BFIlIb0beXOyUMAagvpIvZGFAlmGKUtMWWGqAaYaEfMK7woBgrZFXzbHypqnz1lMyfiiuak1IJNcLyNSEJIfTFfLmYbJW60GLmgnBZnLReM3DmdkjmVGgkgyRRCRzYiv0CaBKlsIHW1bs6qXLOslbdeAhaIqGI1HTLamjCdjjAHftjSrFc1qRdc0Evwzm1EvFxA8RZaRZ07yCxuBO+uaBkNktVwwv7igXq3UQhKwGp0KqnlvKJmyQFu/jfUyb0PN07cEIuATS9vkFze1vWiTE3ThlDbzfBtfhyNvnnQD3dTXl554DT1/jef3X/f7+lbS4Shc6j/Rc2TomSNJSMWIixGnQsoG8XXYaDDRalTiOqAiGqmX5o0hmCi5V7TY2BKbJbPjQ7r5HNt1GI2Wa7uOLgailgYx1oqpqi85LysS6aJqlik6MQWEICYoH8Rs1gskDWKgVypldS4J26loaCpuqf40kzYR5sEI/JCY/qTwps21llVWYLJc9mnZlLTfZDk4KZRpnCBAGKfaVpbMiJles6AYjBhMJMrRFKX40foaZk4BloWJJIoIjFMInujFPxcJhCjVjvf2dxkOB/iuVQYtkaXWRsATNEAkyxxZ7ui6luPjY7quU5OuILekla+YVvUeitqRtDMJRkioIXqUpk9E4Oz8nNPzU5q2kfIZkjvR53JVRUFVFaIJGfFbQiDLLFVRUBZ5D5O2jhKUxWxaifWLNDXVOGspskzLzBQMhwMqRRJJ2j1aASGZeGUR5wgkc+96M1kJmQjEqJW+g877qGWAevOwc4KInLTRTAONLAQb8TZKwdMsk00kqWzGJMkmzxQh+kDXdrR1TbOsBZ+z6ciMZTIYsLu1xaAsIQaatqZuFL8zeFb1iuVqRdN2YAxZnhMjEg27qrVidkvXtCznc5bzGUaXJNGIkSEYxIdK1IoLUS04aq24QhvT5lLbnz+tBee65TdAv5Gb3Ez/SajdRGpiNH1klxpOYsRGVLgZjG5itNFNBVowFm8t0YKxkcx5jK9p5xeszs+ITY3zAeODBCIETzTgyhyTO3yUIAIfvHzMauLC0IcqW2vFoNHvVx+bQjEZY2U1GaTib0i5UUEYrDVOAHEVGNe5QnwvKpxwopmJwFPtyIhwkZDsJKCEsXksXTSSBOsybF70CdJGy+DITwEittnG/izHlSWjaSqrUq2jL7lighDJ3DN0CSrgkhkwKmCzyyx3795mPBrQNCusgTx3EhKvRVezzPbxJnkuY7tcLFgul4QQL5lqe2Gik6LXxpJQVaEmP1W7U6Hmg+fwSECAjZqHrTX4riV4T1WW7O3tUmSZYnF6qfLsO6aTMePJSARSJUj9VoOFknzXYemHSwSbCMfMGorcUZUl49GI0XBIWYrZzriMgJFFGVZAlQEfjQTmm4xoc6LR3ERX6N/aZjPJXTRWNmvxxuCtLOw8EW8CwUSiFaEWHHgb8USis0SbNin0mpaUooDLA/bmzRCJnadZrVicXzA/P6dZLLExMixLxsMBRZFjYpSk+Ch+XqOABJ1q2xJEk+F9YDFfMLuYsVws8F1LvVwwuzinbWqMlcWpJxBNBKfPpMJu08S8Kdgu8fe1JfU3R1dvlr6hq+2/Kl1zHcNlU+Fvmv6TULuWkjq0/pn8bL05sdfSjPrmrCT7alCJmNTE9i9RYB2F9fjVjOXpEXG1IPMe23X4pqZpGlk5ViW2KIgYmq7rUeCDQigRBYk8CTSjq8NeM1CmmgSZoPqrhtYHUaRgjQQGiwpkJ2bWKOZIjWkDmwBkc0V1sFILLJp+8xs/PRLwISt9LQtjc7AF0eQEI8xQcBzVnOgKXCHgxOVoii0GYHOC0UhHlFuo4O79LlfM8Enr8b5TR3KLc4Z79+6ys7NF1zW0zRKrofHjUUVVZlgTyTPxwVgrfq08zzk/P6eum+e1MFm7E826TXwxyZ+21tS87u9C4Pziok/GltQCybVp64bcOW7t7fHG6/eIoYPQEWOn8FQdt/f32NmaMh6JUCuKXKNck49DmVYiFfryawpWspKAnBfkZUVWCAam19D4aDPaaGkDtNERbEGwOU0wrLpIEwzBFAST48nxRreY4aNTk24mNdyNw+PoMLRRtg5Z7AVj8RgaH6i979vku1G7o1V/qW7WOEVpiZIvEQKh7agXS+Zn51ycnnJxcspyNqMqcnZ3thiPR8TgWS4WOOsoq4osy/qFnTGWshqQ5wVt23J+dka9WNLWNfVyycXpCYcHT8X0mRYtBlzmJFfUiiosSfXhOcF2VXMz1zW+gDatEb8arS06Gy0qeP6s1/6LF2DXkfs7GtIvfbvau42BuLrrVejaa64vK+z1+e3SoemjvGbfJslxLzriCl3XN21LtnADG0ERukKMa53MkASFFqvsc6U2rm+kVlhhGmJ9zuLoKYujp5jVDFZz2vk5bb3EmEA1HFJUJQEpf9G1CrWk5jTnLEVRkBe5rmJTv9OAyhhE0s414ohzWR/wYTT3p9+srM6jcfq3FhvVoqNSw0p+76sN57ngDebiN+lBZouSPBcsPmtTgVLFJVTBmK5nbE7dBKLJsHlFVg7JB1ouphyKH81ktJ3fEOD6jMo4QtLM0MAMBX6+tCBVoX58dMTBk6ecnJ3hCulbjL5H4O+6FmO0+rKOZZ4XTKdTilyStr3vNOhgwzRtEM1QzYxRzYzqRVNTpZQdWjU15xcXtF3bCx2JqIR33n6b7333u1RZxuHTx5jQEbuG4Fum4yFvPbjPnf1dJuMBVZFR5oLGb43OfyN+HunD2u8DGsyja4GE1ELS4BXVpPMBH40E+Th5r6Kpi1bt8hKXV9iskJQLRKM3Jr3X5EPTv9WfJu86pV5oTqEKLqnEntG0ns4HeVXqhooky4P4iL3u952nbQNt4+m6QNcFfJdMki2rpqUYjCjKgSZYG+qmYVnrwrGUkj3BGNAUEmsd3gv0EjFgEf+hBbrgGU4nmEzQT1A/tg8KU2cM6Lvv+WQ/+eQX5R6pceO3F5MIpP7TvpletC/RBi/tf/5KjP0yXSfYrmv7dZEMhdSX9J1o4f0+YzBfPT2XluuY/Mbfv9KzX3vN3pLwSgsWkyJsWCtOz1OaWM/f60a6rm+9UJM8K0Pso/IgaWX0uTlo/6I65L1RNPkU6AUYAgVLqjijPnnE7Mlj6sMDWF7QXZzQLc7ABAajkvHWBG8Nre/omo62EczBzEBZSKRbnjuMsxoEcrXz8pH2TmtlHIJSvqmVSb/FnyamRIG7SoncknTaea9lHaTKtgRIiJnUe4/3moisJtE0HqK3ih8ny1JVgSRMRWhkKjTb1qsJrMIVJUU1Ih+MQJO/gxEIpZSgDRqBqs8b0yLEIE+maBnR60o8GkIHvg18+P5H/PN/9i/5V//634Ei/ccIXdtRNw2PnzxlPp8DBudyjDGUZcHr914XoFvvBSpLzVkSKS7CQvLXRAMLUfwtPqrvRaMQfQicnJ3z5OlTVquVzm3BBH33nXf53vd+i1u39jl8/JiDL7/A10tC1zAaVrz18A2+/d47vHZ3n93tMaNBSZFbDBFjo4xLShlIQUL6vcRoCV7qjpkgVgdH1EKeNfVSEPnreglRUEVkEZEsACKevQ8yN1sPUeZIjMmKID5NnYLiD7TJTK6BTJmUMHJWfJTOSaVr61wfmk0MxCDVDaJXQGavvuRgMMYRgqHz0HlD00HdRtoOiSx0GbYYsXXnHsOtXYajCS7LmS1rjs/PMS5nMJ4wGI5SNjkuL3DOslotefrkMcv5jPFoyO7ONltbW1TTMduv3WV6ax9XlARE8Ded7/19qJVEFrsRo5GbBgNRVrnqzNBlp/wVUQm+QZtt8j1e2nP98Wr+fBEZNELw6vkbQuFXpZc9x9el685NbTKSgfl8Rr1aSQAdOqb2L1yoPb9vk8zmS73iaL1Kv06hhiYGG2JvgjNoVGQSakmkaB5bHxmZBJoRz4TBU4YFbnXExdNPWTw7oD07oZufUZ8fY0PLYFgymY4phxWLuqbVHKi2afvAgUFVkGeyMhcHtZo6NjpvNBfIJLT+hMhgRQOTB0zHSSiyD4GmCyybTqCbOsE0bBqpVdQoLFTnN+CfNAQ6VX6W9pSLJp3yTSeBKIrmIPlthsxllGVBVQ56s894ssVoIhBYw8kW5WgiIMVWgkti7IixlchPfYY09vLOZLwNqjGJuqLz3NA1Hrzh7PScn/7Jz/h//r/+37z/0S8phxOGgxFVNaCqBhyfnPDo0RMuLmZEEI3TOm7fvk1VlngfpEaaYjym0TeI9hCjamcxqj9KNLQk1LrgOT094+nBAUst81IWBbdv3eZ3fvu3uX37NvWq5skXn7E4PaJdziiLnHuv3eW733mP+/fusrM1Zms6ZDQoFJ1mHaYrPjuZG76PBjVEHG1nCEHTTDQPLXqPbxvFhpwxn89oG6l63rUNTdvQNoK00nYNbStJ61HTTQxJi5Cfm4EtwutTJWsN/U9BLVqPL9cFT57l5EUhaSROoL9ES1LfcAhqdkRQRUwGZPhoadrIsvas6o6mC/gA3uaUkx0mO/vs37nL1s4u0WacnF8wr1uwGUU1pBoOe4tEWRZ47zl69pRHX30JwbO9tcWdW/tM9nYptybs3XuN4WSKdTnRWtoQxQ+p4xC15hy9UEuzQ5iCtFjlfOnrTdr0Jq3bLgs1oeeEkL7/l4k1o+c+J9SuESBfl1IPNq9zXdur0nV9+sst1JALvuxZdbpcc4WrJJNqs78vpev6dkmoJcORmkp6LU0GdK2ppcAQ2SL0KPM2iru96C5ojz/n4skvWZ2e0Jyfszw7pp6dMh2V7OxuM56M8ERmiyWtF2zBEALOCtJDmedYI6vBziskk5FxTGZEa8VfkvJnBElBkOtDgm6SVy/CrBYki8Wq4Xy+YNW0rLT0Sl3X6kiXAo5S7sNR5FLehOTiQvoklaE7Ou/xnefibCYmIS9m1LaTit3WGmFieYHLpdClywsmWzvcuvMad+69znRnn+n2LsPxhLwsBWPSdpI6oUJM5hAqzNJTiVALIWjwjgCVdHVL8JHo4fjohH/77/6Yf/R/+p+IJmMy2WJra5vt7V3GkymPHz/hq68ec3p2jjGWoiiZTqaan9ZJlKSXSLok2IyxAkSIBg8kTS0Jtg1Nbb6Y8+jRY1bLJWVesLuzw/d/93fY391jMZ9zeHjI6uKU1fkJufG8dvcO7733Dd579232draoqozRoGRQ5RhkMaGfu9zTbwq19I5yWm+JZDJWIRBaCYRYzmcsLi44Pzvh9PiY1WKmFdZrKXbaCZyY9x3GSGJ4VZSMqgF5JsnfRVmIWbxfvCi/UNNwUJOtCEYpyxNS/qRq7tVgoJGZOYOqpCpKyiLDGcnrIqpZMooWbV2JsalqBKzqjvmyZr5csWg83uaMd/a5/do9bt15jdHWNriCs/mCs9kCHw3TrR2qwYAsy6kqKZY6Pz/n888+4dmTJ5R5xt3bt9m7e4dya8L27dvs7N9iOJ4QjKWL0CnjEEQXCKGTOaHMTVqTQLtGU7sqoLgitDYsVaR5/9w5a0vFc7s2SF7J80KNNIOuaf86dF3f5K+vf+3r+vOXX6ixseK+iaKuAq+2b1BMvO1l17pK1/VtQ6jJhiY5rz8s02tqojWISU+c22IWiyLMTMDFTvxpzRnHn/6M1dFXrC7OWJydMTs7pqsX3L21y61b+5RVwXwxp/OBxWpJjJGiKBhUFSCRi1FrY3nVkowKMamnJcJM0Br0I1ITY4xgFP2jaVuePHnKl18+Yj6fk2U5k60txlvbFNWAQTVkOBwxHA2pyoosz+WaOr5yHRkMYZrJCLoxA6PBd1KepWkaAQherWiahvliztmp5Gg9Ozrmj3/0Y/79H33CyRz2duE73/s2r7/5kLffeY933/smbz58i739bbb3phKhQ+JuYhILMWxAbBmsywhtS9TEO/FJis9IzFeWi9mK/90//N/zw3//x3gf2N3ZYzzZ4uHDt9je2WOxXPHpp5/z0UefsLe7S54XNG1LXddqdhUN1QdB1Mhsvr6fEUGWzI7yM/nWoG1bfvnLX0KMvH7vHg/feIOt6YTFbMbp6SmL+ZzYLDk/esLD+3f57d/+Ht/65nvs7W2zNRlJxKaFPJO6aG3Xps99rakp6n9vfrQFLh/TecN8dsHx0RFHzw54+tVXPHv6mJOjQ44Pn3H0bI41cOdWxRv373Hvtbvs7UrV7eFo0EddlnlOmecbn29698pYNj5tSTNJzDv231zn09xoqFc1Z2dnWsNuxmIxo61XOGuZjEZMp1OmkynDwVAtBhDJsFlBUY0ZjKYEHBezJUfHpxyentMEiy0GbO3ucevua+zdfo3p7h4dlpPzGWezBS7LmUy3GI1GVKVUybYm8uSrL/j5T/+U1WLB3vY2t++9xv69u2SDAbdfu8f+7bsE6+gAKWOL+gcN3rfEDaEmZNbfpD5/r6mp//USbbTdyNcunbfhy3uBYDPcLNRIs+iGfa9CEenXdXSd8H4RXdeXVxZqjw7O43qqXaV1601jK4dcv/P61nVfBYqJ547cvNdNPWPjOmxe4aqwSuap5yjd+3KbULws1IwwcoMOaBRNzhgw1uE1ox0rxQ9t9OQmMHBRGNTjTzj65KcwP2a1nDO7OGcxO8PayHvfeJvpeESzWnIxm4ljPEbyPKccSKTWarWgrmtiWpVraHheFBRlSZalMiAGEK0NDEEBc60Vv4UxlhAidSNVnUME56SMSCqyaI0cLyvu9bVksMSUFHWSyvjLZBKNLSEzgIlyr97fgn6gUTSW1nvaTsqvrJqWs9mcw6MTnh4ecz5bcHB4xOHRCXXTsr0z5Z133+bb3/km3/nOt3n9/r21RoAk5WJkwlsjiPTEiFGs0xiSYJNcvbaDz798yr/6//yQH/7w3/Ho0RPG4ylb021u33mN3b1bjMdTnMtYLld8/NHHPDs8pG40UrFrCUE06RBFK8xsRgzQpahH1ZyME2zBoM8fCSwWS8o8ZzIeURU50XsW8xmrlELQLPjet97mO998h4dvvsHe3o7mlhVk1mgicsAaI6Vv1BQdInQ+EDH9z7ZtOTy+4MNPvuTxkyOOjw6ZXZwTuobCOSbDAdvTMdPxkPGgYjSsKDMnof8ajJISoa0xOCdbJkjF/dRIPjgS49FPKQR5CcLT4vorChrQohYEMe0Guq4RTa4T0ztRkEucdTJHNdm+6SI+WvJywGiyTTmcKPyZ5/RiweHxOeeLGo9hPN3m3psPuffgLYrBCI9ltqw5u5hRFAXD4YhBVVKWJZVWAP/pT37Ck0dfYkJgZ3+Pe2/cZ2tvj+29ffZu32V7f58mSuHaTiNbjTVSoqunjUCdNffo/b5GFyPXU9rzHJMSuiLUeOn19EpX3DjyWi6fdV3bi6i/65VTNts3e/Zinn79tRJFwESZJ8v5nLaVyGQMMl8MuL/z9/43Pfbj87Te87wAUFJN6rrtJloPrhyVtLH+PBVML3r4RHFjVbh5bmrQOzy/9cdduvMlStqObIgzVpENUP9v1IFOibgOrWgdWky3ork44ezxZ3Qnz/DzM1bLBavVgqar2d3fZW9vlxgDi9kM37WYCIWGk1sroLpt1+KDgOdGRRFxCveTZxlOEGNlxAzrqEbEdCgI57qiBJzREh1lqZBBGXmeKSyWorvrCIhUSD6qlIelWIh9wrG0izYpMFHp9xglxcAgEWUGed/WSuLreDJh79Yed+/e5d79+9x/4z5vPnjA/fuvc+vWPpPJhBACH338ET/68Y+p65o7t++ws72F77REjUVWaNBjCaagHiNflAph1ZeMYTSesLu3T1mWLOZznjx+Qr0SP+JqKSVmDIbz83POTs+oV7UU8uxHMc0jYbjqSpH76CKzZ2jajkJDFZlsJkZBvFguWM3nLBdzyszxrffe4T//K7/Hu28/YH9/l/Gooiwzityl2Ab1zMgCx9oElBzwqeCovrbTszN+/JOf8k//6b/i2bMjrDHs7u5w//XXefjgTd568wH379/jtbu32dvdYTysGJQFVe4onCG3mugROmz0Yn0wnhgaMC3WeIgC4xVDA7GDKLiQxI7Q1QLzlTaf5ols8q4iRDFD5gqd1W+ZQLYZkwCiRRttvVYQ773f4PKC4XjMeLpFlguAc9NKkFM0RgKm8oK8LMnyAoNcU9mBmMatpSxymuWSs5MTTk9P6NqGzFoBlzaS7jEej/s+pTlldMG3pvQV6UxMfCTNyxfS9Txpky7vfdn19Ph1F9ZtV+i6thfTC85I3ZLpDy/j6i95jDSivtOUHS++/P6aSahtnnSZ1rd/mVD71UjPvXrxTcF0DfXPrYekI3XMLgnLGwf8pfcQhnUVKUDusV7uCN9aX8chJTkyAu38nNNnTzh98hV+fka7uGCxXLBsVhhreOPNNymrUmp2rVY4Y8msFdOONXS+pW5qfPCaLC0CLc9zyqKUqEIFsk29W0c+ypaKcXrVmJIZIP0bNdrMOavajn6kwqE3NhVgyojQ6K4+Wk3TDmQtKjXRYuyUeQlDC75VpHupQea1ejdE8rJkPJ2wu7vDrVv73Lt3jzffvM+DN9/g9dfv4fKcpm25ffsWb731kJ2dbYk200i79KZFqGnduP4x1PyVNixZXjIeT9jemjIajYTRxsB8NuPi/JyL83POz844OzmhXq20OKjv3/PGiGMx6+g9VIDp3IshdUJWmKnoq4me0DY0qwXNak6ZO27t7fDNd9/hD//gd3n3Gw/Z2R5RVQV57qRitHN9IIZVH05U03JE0f+D+NUihhAji8WKZ8+OODk+5e7du7zz1kPefushD964z/3X7rK/t81kNKTMHCZ0dPWK6BtM6PoN32KSUEMAjoMXw1uK64sxLWik5IxBhFWvqQd5NzEohFj62ZuHE+KNBlvolgqMRk1iXwfDaJCGtbQ+SCQihrwsGQ0njMZbFEUJWNqukzp5bYfLcgpNSUm5nkQp6ipQWFCVBQY4Pz/j+OiIViG0xFICeZ5TDYYU1UCCmVRE9ULuEk/sudGl3+Tny7cbSb/5Fx5zhdKxr37O1d5cv62f9uq+jTblt+sv9abtuutc3eiL4QYFpthggX9xQs2AOPPTw25e5AUCJwmXFEHJ5lBcOe9GezQvu4e0p5WV+MpQYaY90PFN+0SAGDIiNnSUFmYnhzz9/FMuDh7Tzc/xyzmzxYxV1zDZmvL6G/fpfMdqsSR2nUSDOdGWfPQaddb1qO4GQ5blDKoBZSkFEPsVrJpxEjM1aowIUao0+67TFbyiY2jEmjDcoJGVa0kgAmythYlwSva89RZjgKS99UzJE0ISairYfEfwIthiihBzokkaDe02WoQ0KFMs8oyd7S3efvttfut3fpff/f7v8Z1vf5u9vV3JJbNS2iT5bZIQu/a9RlkUpC8gywq6rmM8HvHGG/d5+PABeZYzOz/n4uKC5XzOxcWFBIV06yhPY1RwpmsqQstaO0r+I9Eeo4b+OyMIwzYK0xdk5ZboW3JneOvBG/zBD77Pf/aHv8/bD+8zGhVkmZSEyXMnwMWq6kqY/NrPKWZQEeYiK4Txex9wNmN3b5+HD9/iW9/6Fm/cv8d0Mia3RoKhoid2Db6t8W1N7GqMCjETO9XQOmzwSCp1wJooviP1ZcqY65zxAjCbBF7waV6IfTSGSPRJmKUK4dJ32S+CTGwPkZAsFL2JVRdoRgEqraP1gbpp+4hgazO2t3eZTLYoyorOe87OL5gtFrg87wWac46izEX762TBFUOgLAqqsmC1XHJ6ciJWlKahrWsAnMtxecHO3h4uz4kaEJS0Pnn5iS/on8owLu02smB+4fYiurT/JcduHPHyI3nlo9Z03fHrtrUw+3WQQMr1Qm1zKP4ihZrQFZ/axoVeJpCu/mmuEVJXr3Hp72uOX5OaJNLxRts27iP3NJJIbKwmsYqmVlhLFgMHj7/ki08+5PzoGaFeEtqa09kFwUQevv0Wo/GQ2WxGs1r1mk+RZ/iupe0aMa/EQNdJjFWe5wwGgtknwKobIc9BPqok4Pqw+06iEb0X0yXIyl6qZa+fCyNMKWi+TX9N9RtFXXFnToJmktmxlyQq4MJGIEXU1XZKIBdtKMp71+hM6zKKstQk7kyYjsvkLQQJNlnVDcZmjCdbDIeVAN9qzbOkZVrnCLpaXzOQtS80veqovrc0XkZBesfjEe+8/Rbj0ZCjw2d8+cXnxOApy5xWowAN4t9JJlYJGlkz3KgmzhhFuDtrhUEnzN8okFfRN9TLOW29YDTI+S/+87/CH/6V3+Mb7zxkazoiyyJl4cgLK6VlcjEx+6ACQ0PjQwygGllMMj1C23nazhO8LGCKomI4GEmZnFYCS6wxeN/JvNO5Jxq2LEKCF2iuXmPSpZ64bo3AnBnb52Cl9xVU4Fu1EqRxJq13JPiyP1Y2eVtrS4CY8iUHTvPgooyx976PKI1IUrnXIqFd14n5eNWS5xXj8RbjyZQsz5kvFlxczDFaHTsrCoyRwqgGg4ky16OXRP+qrIghMpvNOHj6BGehaxs8YLOcvKq4dfc1uijRrmgOaM8oZT3c8wmdfMo/fo2ki9NXuW7a/7Lj1tQ/wUs3Q+rAi9tevL3qseLe+P8JoWb0PtL0gqte2SWP+nw/NoXY5n2kQc65kYzptbLUJythGGpyEaZpFJvQ2kxKaPgAXla0jz//jM8++RhfL/D1kvnsjNZ3bO3s8NZbD1ktV6yWkvAqYLMZPnRintNClimptyxLhsMhZSmlMAQBQ0L/E2NNgRlroSSahUz8hKCuz5yEkDKQzrcSdKCQXJLjpEOBnGs0IKAXYmgQgAo8wZWU/rRqrvMa4u99IKiJzqC5c1bKhmQ9KHKGNRkRgzVO/H55gXM51XAstbSytUBLUarGpOfpe6sBLuJXlLeXvGGyYPGdl6ASfXbvO5w17O3v8tbDB7xx/x5d1/Cnf/IT5rML8fdkGQTJVQuhz1CSK+t4CDMX0F0R6J1oL74j+paLsxNCu+Le3X1+8P3f5q/91T/k29/6Bnfv7InvrLBUVdYXALWp8qYuHoxdh497L5GwsogRYdF1a81HNBBZ2NRNR0TRUjB4LyH1mRPEjRBkQdLqvOp0HhjEF2UUYDhg8Jr8HKKMcRIsUU2h1kjErdc0B0EzUbEpQ0XYQDghyrNIIkSaQ2vN2BpZBIH8TM8aNiI9RVhGybNsPJ2HGCxlWTEajcjygsVqSdt2WEXmMcZKLqgK+VRmyHddnyJT1zWPH30lBWONIK50MWKLgvsPHzKYjMFJLHSWZxoQ1H86Ot3Sf2sOdJUd/Vqodztc3SF06d6vRK9+5E1khNG+GhnNE3opPa+ppXuYv2xCbaP5BTe84XCdNJuNfct1Auy6tg3SgEc5wtCbRNasUiJFIhbv9f7GgI9kBgpnOTk84NEXn3F2dEi9uODs9JjBcMTr9++zvb3Fcr4g+E4c0NYQgpf8oE4ETPLj5HkyOZZgJKKtaSRKrOtUoKnpS1btasYhJb1K4qvVSR+NCoGeGevvuuKTnyIYjJEaZVZ/XuJESTBqnpr3Ah/lQ+j9gMlXIv4SEVZ9OZKsoBwMqAZDympIlhcavSmVAwjgNUJysVixWNVYayiLXGILgxchHSMhrisS9D+jvkRQoZb6jX4MSUNZX6soMoaDkq2tKbdv7XNrf5+yLFgtF5yfn1GvljKGKtRijIowIs8MMlfE/yJmxtC1+LaB0LG/t8V3v/Mev/vb3+Xb3/oGb9y/y87WiNGwoCgsRW4pCtf7ClOfjb4TeVYxKbddJ8Ij5SCGtSDB2A3NKHJ8ckari4sktExCm9Fk/YjOHRWhoPfU/MsQBZXER6kuTcLPSAIK+jbERdX7m9K02TxWdD/dn/7r55T61VIx3tSn/sOUuSn3t9Ivr1BawRC8oesCzmUMRkNGo5HmCS5o2pZoIs7a3hLSr/gVhitGyLMcg+Xs/Iyjw6c0XcOqbTFFzutvPuCtd98lqyp8jHREhZuT/FGZhekJ12hERrU1eRYd5BfQKxxyDV0v2FLTNbtuoFc/knT0Nadc03SZZJCEXlGoXR8oEmWsHx1cvOAy6+5cN0ggO27a9UJSk8O1I2FuvmGaDJudljG53I+bTI3JBLfZdpVShKN83nKM6QWadMJoPJ8A/Ip5HwO0gVFhKE3Hsy8+4aM//Q989osfc3HwBc3smLcePODb33yPqsxZzs+JoZOCzjbg25q2WYofoRMzkHOO4XBENRD0Ax8iTdvQtU1vPhOhpVWMo4ydtVbwHnMxE6XV/SbDAl31K5bdmnsII5PxWWs7BsEp1DNB/Tl+I1k8jVpyo0itDvlDhBs92LM3FrKM6DLaEKm7QNN2NK2XSMS6pa1b6q5jtmpovec73/0mP/j932V3d0rTCjCx8Hp9V2oOU+wMeZyYojAV0iuKWdMggxGj5LH1/fOBrpUV/2y24Be/+JD33/+Izz77gqOjU+aLmlXdAhbn8jXGo86pGIJAnAVPkeeMhwOm4zFbW2Pu33+Nt996kzt39hiPBxSF1WoBEiovkZyijaAaVIxBtL8omohoxEHHfG3CCz7StF4iIIMw59Wq5uDwmH/3H35MiApPpYDNVVWSZxllkVFkDmcizkQJDIlibSicIc9sX0stMwaneXIijugLiMpHLd+OCGH5JCL6/tN6aNM1m95B+jajSMNkuiZqOgiocDV0IRLJiDi6aGm9oU3PHgBbYuyQrBiyu7/P3Xv32N7b52Kx4ONPP+Xo9AyXF2zv7TMcj/FBxrwsSgaDocwemzEaSgDRx598wB/9h3+NczDe2ePBO9/gD/6Lv8aDd9+DvKCNUlFRBkGeWOaW5ISJwSdV89BPgiC1cl+FlGdt8rzLdPmr7lsTr1NKt0thAYmuHidtbJzxdShZTF7WprTJm9HF78soepp6xXJxoSH9af7pwvwvSqiZwPr6Vy4uf8oXcbVzaaw322Uq/TqFWhChZiQ0HLSGWmLvuuoK+lGlWPUQ5bkmFVgfyLoFy9OnfPaLH/PL9/+YbnHC67dvc3f/FvV8Jmjx0WNzwHjqZkHbLgm+gRDIjKEqK4bDIdZmdD7SeBUivkPC2bUydQoaQYRclolDHKumuGR23Jz+RsfJWkEe0TFbT2gd6GhEQMRIUzdEHW9hVFLeJaj/T1baKvCVsfpWYL+aWsLll3XDsulYti2zumbRtJzNF8wWKzrvmc2WEka/bOhaz6JeUXcd83rJ3/7b/w3/q//1/5LvfPebrFYzjAkaFShahCy4FSxXgJZ6H40UVpXozRgCzpi+7zaZokIELMEHmrrD2ZyuC8xmSx49ecb7P/+Qn/7sFzx9esh8vhRQWydlgoyTHI+g9e+cNdze2+PBm2/w1sMHvP76XbamI8rCqTAzUm4sMzgXVQmRTKcQBYgtmXYNiJ/Uax5UlIjLtlV4rgBd62maTvxLXp7x4mLGz3/xMf/z//3/wbKW2nC9b7Yqe7iqQVUyGpQMq4LMiqWhKjLNVcsoslSPLaPMDIPC4RDEGYnGRAqxRClimzTNnuFGmVhx4+ONOrciMkdDepAo2jNBzbdBBZvRORUgarHaEOUb9MHQdkEqDZiC1md4csrBgJ29Pe7eu8d0Z4enh4d8+fgxF/MF461ttnf36EKgrltclrG3u0dRVBisIPq7jPOLYz755H1GkwGvP3yLd775bR68+02WraeJhmC1dqIX83P/9aSAlyBlqkCicoOBznwNoUYau5tIx/gqXTkn3e7/z4Ua6wdTHneVjPRKaCP452UkQo3nBJo0re95XeeuazNXhOv6Gpfb10LtJpGmb10HSX7IsZseGvlOHT4I3mNSDKwKwAxPZTqsaSEuoD2D40ecPX7C2dNnrGZnmNCR2Ug0HXW7ZLG8wNhADGKSrPKc4WBInmV0nVckcy8mRiNMMAm0FA1njJGwZQ35Tyv+9ViunzqNY8rhicaoAJOtn9haXidGNGk7qGkrqf3yuwAdiwlosVhxcT7j+OiYw4NnHD474uz0lMV8ybJthAEB5WjE9v4+23v7jLa2GQyGgglZlGQ2x+jKvPEdi9WK9957m+//3u+wt79N263InO39eLlqskaFmjxHMmutc+ZiFNxDZ530uxMfTtT8tuSnJFqplBCAaAnBUNcd83nNF1884kc//gk//dn7nJ1faCVvAXHe2pry9sMHfOPtt/poQ2fA+1a1M4e8LumTy0wfeRqivF9w6p4VjR2F2SLGPjCpblox0WoIv+8i88US5wra1tM0AkZ9djHnP/zoT6lbMWVnLiNGwfg0RHzbUq9WrJZz6uWC6NveD0iQYJHcWaqyZDQYMB5V3NnfZjyqGA2HDAYD8kKjZ2MgRoETIwbyPJPppxGSMlfSpFnPHfGfpdAeeuEmH1ryFUesy2k78Zl1wdB5g3EFzpWEaDXUP6PzjiZImkNeVuzducObb79FtI5Hj5/y+OkzbJZz997rWJtxenbGqq7Z27vFZDolS1BumcNmhm999z2297bIh2OizVh1nmXrcUVFNAIwvqYNc5hqaqlclYlSldybgL8qXS7RVe6Uxu5F5zy/L7I54GvetUlJk77MJzf++Jp0XR+va7ukeGi30gLmhRQDbb0U5JlLQk1Z3aOD2fN3u/TUKrSujvE1nQI59ZrW5+i595k6tf5ls/GldG1fkKd87mVtyOGeNo6LG9czyGRc03rCgiEG8SlIVV85wgLOQB4aMt/gzBLijPrRJxx+8QWzg2eEekFuAi56utjQdiu6rpYVb/RkzlIWEijR+U7qonWqZRiI1mAzMTEK0nmmfi8JwnCZALVmeY4PUd/2hqAyGm0WxReA1ZVyUjvTytI4RekPFEXZ+9mI4IOnqRtOz864uLjg6OiIZ4eHHD475MP3f0EMkdFwxPbWFlvTLaqqYjCoGIzGDMYjquGQ6c4O4+mU4XTKYDymHAzxEbKiwLlM+h2lYnbXesqqYDiqMCbStCvKMgf1Z6UgCNEW1/5FVKglU14M8n4TC42I72/tBxThR4SuacXH4sXE532kayPnF3MePXrKhx99ws9+/gFHx2fMF0u+8Y23+MM//APee/dtqiqnKqQYqTESgJAqWusrSJ+y9kL8ZfL5KeqGBv30lRFSUE6fkxYwxuE9tI1EPXZdlNIsbUvbelofuJgvCIhf1elc9wqxZaP8vlrMWcxntLXUE/NdCyEIBmSjOJBNzXw+Y7GcUdcrBlXF7s4Oe3s77OxsM52OGQxKyiKnzDOsMirJUxT/b545YoI1sxZrIm27IoZO2oxo3iCadNQIyhAVgiwImkiIBh8sgQyMbMakMjc5bRdYNC1dhNHWNndev894a4emCxydnHFycsb29i57u7eYLxYcHR9jreP+G29QDQbYXOZfzCyvv/UGrz98QDkYad05XXTo64uqSVtrNPdS3BioCdJGgw0GF6XYaEfA9yv7TdrkNYnTbDLLq4xTKM2iy43aEvWfmOb95jEb19/g3em7eVVKt9j46znabH2O/yrF6zTSyxcnBs/F2Qm+E4QflF8nv7B5fDC/IkM3HsboP9qDqze7KkjSX88JrGvouoeS21255k3C6ipdd9w1JkZZ01537FVNT30zKZHXyLkpWdgg8EgmgW3YDJwGYahQc74j8y2VWUJ3ytHnv+Dkiy9ojo9xXUNhPPiGpl3S+hXGRImwQ6r0ZploX3Wzom0bbNB6Ac5g8gwyBS1OVbCdBFiYvoCoIPb32ppCZ2EUE1LVfbG4qVt7Q+2UFVAmz6dlP9rWM5vNOTs/4+TkhKPjY87Ozon6cUQgM5ZuuaRwGaPRiOnWFtPpWFBSnCXLc/KyICtyquGQ0WRMOZRk1mI4IFpLMEgtLpdBtORZRQxGxt6IucsHSQBOSCFWkeFFW1BBpj40CS1P7SlCT86OSDCF16jPELreryNBHuIzjF0QBSIY6rrl5PSCX372BT/+8c/47LOvODub8YPf/13+5t/6r3n48HVBBjSCAypeF+m7TLBNH6YwRBFqCCNUTThuCLROgZSDT5USpN8YR9cG2kZQ6jsfaRsvzL8LrOoarBWsSjWJGQ2LdppugA90Tc35+Sm+keKq0YvfMarWFGOk7RrmywXLtqFuGw2qEJ8fiAZsDQwHA27t7jIdjwR6S3EVY5AFWwhynjNievXdghAExcUgCc0hRIlI1AUKxtB6r8JNCtKGaKU4aXCARNQ6m5EXJRjLou1YNC3BZkx2b7F35y7VYMyq7jg5PsPiuHv3HjHC0dExJ6en3H/jPuOtKXlVYjKLzzMmt/Z5+N43GY4n+CDW/KjWUqM8L8SIcSLMgoFwSaiBC5YsJKHmX6CpJU60np+bfPkqT9Qps3GeHtlz9mT+TVicV2hD+MnedFc97xWo7+MrHn8TXafRXW2LoeP89JjQtX2UttkYF/d3/t7/eH30o5F/9Me1dHVw16/i5XTdMVevd1PbtXTNcdede61AQ87f3CPnyid2aQz0p9FbGlQQWKeNelwUDMiMSEaHX55y+uwRy9NTaGpyI/BDoWto2hU+dGQJFsg5nIbOd23Lql5JYINBal1lAmK8TqLWFa9iPFqJNiBq2HcI8sGlUH1hUkCUHCevFYAlagyimvAMopF1nWexWHDw7Bkff/wRv/jFz3n8+JFgWC5mED2jYcX29pQ7t/d5/bU7fPPdd3j44A1ef/0ut/Z32ZpOGA4LitzhsoQlCDF6rNOAFYv0Aw1ND9KX4MVPpzEDRMSvaJBcMdFmRMsS6SoMuNfY+py79HHIS4oqyFI+4Fq7Sxqdx8SkaWgwSdSgDA3aWCyXnJyc8ezZEctlzdtvP+C73/020+kIayPOIj4mE8Xvic41k+aWGuWi+B2Shpj6m/xooq3J7722lrQXHyQ3re3wXt6l92JWDV40IuOsnK8pHxI1q5Gz6lckBurVUiJBkaARZw1FnjEoc4ZVwWhQMp0MuXVrhzu3d9nbmTIZDxhWWkXCt/iuwTcNy8Wcg4OnnJ2dsVqtNG9OBI8AbVsEB1ogvkIUP3VQH5n4z4xEXepxYe1204WUTZEX8h1GxFFgLHlR4jIpqFu3HU3X4Vwhpvm8xGBp2o7hYKgBIpHTs1OMNRRlQV5KZQrjpIjUdHuboqyAyxGf/WdvRP1OMHrIq+/3WzU/osEi9Ivuq9t6jl4SEsqTNvamHc/xtc2/0t6eX12lfqG10bT5yzWnXCU57DoT2K+BUh/StWPoUV5gnfKRvvMbhJq+nI0/r6OrQiP9dcPhl+i6Y65e76a2a+nqcTe9wOvIyD+bR79IqKVfLevQWankK/tlBedxIZAZyGiZnx5wevAV9fk5tmsprIHQ0dZL6mZFxFOUUtYlOdi976ibmqZpwEQRei6TvKFsneyZBFtfN83IRxe0PlokRcgF+RDVdJVU/RgN1ohGFHR133ViWjw5PeXZ02c8fvSYzz//jPff/zlffvkFZZHx5oP7vPP2Q9599x3eeutN7r/+Grf2d6U0SpGTO1lVNc2S5WpGvVrQtmJmDaETDcsIskieix/QZRlo9Jm1DmvEjIpGXi6XCw6fPePTT3/JarWgLHMya/u8JkjCTBm4T0JNTa3pjUaJ3Ow0ly5o5CYmCUIP6vjvBaSOoZTUCTRNy8VszrNnR3z11WOWyxVvvfOQb3/7Paoq3wBa1mg+nVdrgSZMS66vgSAhJbun+4l2loR3D5kWZDGS3nHXiqDquoDBslyuODh4xtHRMVmWERFB3D9HMuuFQOgE7SUGT9usVEuTvDp8h9U4X4LCZdlIloNzkTJ3TMYD9na3uLW3w53b+9y9c5vt6ZSmaXj06BGHh4fMZnOpx9YFlnUjgTDR4KNGNHqv+W4i0GIUS0PbSURjChIJQRYesn5JofKyALMaHGR0/md5roKtoAuRVdNiVIsrigrnHG3TkucFo6H4rs/Pz1gul1TDiqqqcJlUtG+8Z7y1xWAwxGWZjqUI2uS9NT0b0u9KeYNJtg/tb9Qjenl1LZsSHpB+u9T8HK15V98Pvfj6cNlz7emblC6gR8sZyvReevIr3eFr08bXIn2IkaZeEVKuqJWI3rSA1Ty1yx0Rib7ZsPnHmq4KnPTXDYdfoqvHXL1Wopvan6PN476OQNN7XD063dfo72mSGh0cCVuW/C0QjMg0SWVl73ExkBtwtJw8/YKL4yd08zmZ9+Qm0tUrVssFnW+xmaWsStUQUh5GKzk1BLIsFwDjXND0Q5TPQpik5pOlfCL1tUiwgzyFVxR0eTZLSCH4MRKDoW09eSYJqavliqdPnvJv/82/5Z/843/Mj3/0Y9q24eGDB/zu93+H//q/+ut8/3d/h3uv3WE6GZM5yJzBdw11vSD6hrZeEtqGtm1om5WsrEIrK3lNdvYK0JxlOWVVURRln7/Wdp4sK6iqIWBo6obPPvuUf/bP/in/6B/9I/7hP/xHPH36Be+9+y57+3u9j0YYmgSrJJOdCHAZB0NaiIi/pu8HGoaOCBkRiIK4kTS1mASaakXL5YrTszMePX7Kk6cH1E3Dw7fe4N1336GqCsQlKGgcIALKKjivTJS0AFLTpzLs2L8XXXwkLS0J5412ybGSdygLFmiahk9/+Sn//F/8C/7Vv/xXHDx7pgLbkGUZWZYLJqjCWSXzdfSd5Bt2LTF0UjMweCyBzCJWBxtxLgpoMZ7oW0LbQPDkzhFDoMhytramvP7aPX77t3+bN998wHQyZbFc8tHHn/DDH/4pjx5/RecD1UDyE2MU/1TbRdou4j10IWIUsSeoea/rZGGWJIb8rlYKI4JNND6xnmRFQVENKcoKHzRC2coYZJkUgQ0hUhYFZVnivefo6FAK2VYleZERjaGNQUzl4zHloOxzA/tZZRKzkBcb+5SgdbOJGiCXFEqdh3J+Yt39RYT0JjJnbtoSD9PzN/tFLxs3r7pBGzt1i1yWAdKsV7v+Ir8RSn2IMTC7uBBTqpFo4xCCRHvfZH58To5c/VvpqsDZHISX0XoMXzxYV+9xI/XCpn+Vr0zX3SMxPrmW7E8CTSiCrhGJV4QaUp5GTI8R65ccfvVL6tkR1DW2a8G3rBaiveCgHIjASoy2baXydQgBl+cUpeQUGQxe/S9GoxadVrtOAi2kJNQ+GVWYIDGuE23VaeycfNzBR7768hE/+qM/5l//63/D+z9/n62tKb/7O7/LH/zBH/Ctb32TW7f2GaTAjK4WR61v8W1N8CKwTOwkkL5rsUTBgVRBFoLWIVP0CBlPg80cRVExGAwZDMZkeYF1OWdnF7z//gf8s3/2z/mf/i//Z/7JP/nH/PDf/huODg95/d4t/ubf+m949xvvMBhIzbn0joKXQqpdJ8EJoGgqSYvVsUiBF0G1KPFDCiMJChXlu04WAP14ikbUtp5lXXN2ds7Tp894dnhE27Y8ePgm33jnLYajUnPoUqi+RDaK5qezRIVnMoNe1iiTBrdhQo0bgk/77Gym2lpH6MR02dQtMULXtiyXSw4PD/nwww/58suvODk+oWlqre6Q/LFi6m6bhraRHMgkzEz0mNCJudyISZ3YEUOLMwpeHAUIGC8rZwku6ehaCbIBGAxH7O7ucefuXd548x5bW9ucz+Z89sWXHBwc4GOkKAe4XKMYu4gPRnPuokTgGinUmiRI1OT8GNRPrmUzfIhauFcEmytyqmpAXlZilo9gjKMsK/Isx3tP5pwuqgxPD54SoifPM8qyxGYZ0VqMc4wnE8aTkUTEGjHfp3nXyx00mAuhntfFDd5khGekhZgcs8lt5G8Rfsp/dBMQhbXrYVOgpev399zow4toQ2/s+f915xjkm+23a+gyn/x6lHjCi863FgZVKd95J5XYjZWczqqsMI8O5uunQZ5kzZ6Fkhp9uVU7sPl3+nn1wGvIXHP+dfQqxwCaXPxqx/bUv7znz1vf166jH5U5gSy5TDQ4BP/OaygABvWLeIroKfC4+pgPf/wvaM+ewGyOWS6JzYrFxSm+W1GNSkbTIZlzEmXWilDz3gukz0DC850RLTDEIKHGThOsNUowREFoF0aZerrGp8TKShYjuW1dCMznCw6fHfPJJ59hbUauYK9FUXLnzm2m0ylFkeu0F/OehJ+LSc0YMZNGdfxDhCBRg0bhj1p9ntYr/FKMwmxUeG3t7rGzf4fRZIdgMg5PzvnRn/yUX3zwEadnFwyGAyKRwaBkOBoynU64e/cO3/ve97h9+5YsBrRgp1XG1yaBplBQTuGgREiIU0YEn2AJSrK6aFHysTR0TQsJ21GFWtMGmsZT1x3nswWPHj/hT3/6C372818wmy/463/9r/Lf/rd/i/39LZwNZBkSIBET7FOKLlUtTYNYfNAFiGrqVoVvr3WGK4EiakoOXqCikvkxeFitGto2cHZ+wdHRMcenZzw7PFRh3NK2LRbY29vjjdfvc2tvl0FZELuWZjlncXFOaJdqaQhS6NYZcmdwBpn7Tj/0jYjbJCyiFsy1NiNEgZCTunJWw/EDTdMJyPBsoeZViaysygHbW1uMhiMxw4tjFWsEQ1MACayOT7I+CEC1cznWZHRYWizB5biioBiMGE23yKsR81XDctViXM7W1g5FUdF2HVVZMRoN6bznT/7kJ6zamr29Xe7ee43h9jYhL7CDIQ/efod7Dx5ILmCQNAuDLJisFTYRUyEqZYQ6ZH0EJOpTuxRUDT2HFUGmP5M6qO1yyvO8Lm4cpy1rQaX7rh4hpMdtXM5EOcfI7hfS8/cVunTH6w95Ib3ofGsiw6qkXs6ZzefUq5pIpCxKRqPhFfPjTQLy2sbnBU7664bDL9G1UTjX0NV73ETCLL4mGa4VaFy6r65+dAWRBjstJmRCS+5JikMw+gFmBGzsCMsLnn35MdQX0DSE1ZJ6MWMxvwACZVWSVwUhCkqEQE55MIInV5QCvprCuwERclr4Ew1jlyACYXpJQ5MVrvjbUlXstu24uJhxrCH4JycnzGYzptMpr79+jwcP3uTea68xmYxwzhJVw4q+w/tWQHmDamBd2/tjktk1eE/XdLSNCLOuE+EhPhWP90hQikavGVvQtpGDo2N++vNf8OOf/Ak//8UHHB0fMxyO+Oa33uO73/02v/1b3+N73/su3/n2t3jnnbfZ2pqSOQkPR8GUkxBI49QjqyjHiQpEnLRGOU5Mc9aIQzQo/p9oeckHtdbSuk5KnazqhrPzC54eHHDw7JC6rnnwQMyPw0FJxGOtCCZhMElQiU9IBNqGjzNtuiLpNbTNrV+0yDlN0/bnBq9BL0G0+KqqmG5ts7e7y97uLru7O5RFQds2XJxfsFwsWS5XzOdzmqbBWUcIgWZV0zaNBIyYxBRFG+qTi43tE92tQmZJsrtoogaZd0ERZxKWqVdfapY5SfgeSZqHQFgtaRuBPhI/YStzd9OvqTlJyTISI/LuXIbLcvK8FG3PiM+uCzLWzuUMhyOczSQ4qPOgNdysdQqS7YDAydkJ52enhOipKoFyM04WgaPxmMl0SxaRiT8oPqUkoEv0SFShZdjwb21oapox80Iyyocub8nVcKVdx7w/D5GK6ffNfUIbkuJKP9J9139c3v8qdOm+v47zN/phrGFQFX1QXZY5irxgNBpSVYMNTa1n8DKBN+nPQ1P7tQu1tEz6OnSTUNto33QD9ysrEzSkXyaqtQKVJdafiHXgTKAILbZd0Z095sM/+ueY+TNYLukuLpifn7KYnTEYFEx3JlTjSkxIbYdvhdlaJ6gGeZn3KCIGKIqcalCBvpNLPhkvYd1qYSNzmQAGa9XgtuuYXcw4OHjG+ewC6xz7+7d5/d59OUYDFgRXsqPIMzAS+EIMmuzYqeVBtDST0OsVBzIGqFctda2gy14Q1rsuaKKwlAzB5Ribsaw7LpZLnp2c8uXjp7Qh8u3v/Rbf+va3eePBQ27t79F1TV+GxFqjOJgIQ8rEbNh1Yk5MEzVpX87lymAlYtF3DZ2X6tURQMFrncuIUfyZXdvgOzGlBq100LWSAF+3a03tq0dP+NOf/pwPPviIi4s5f+Nv/DX+u//ub3NrfwvrgiCFyFvCIAgr9OC+uhhRAZUEl6x+xWcjbSmpfR3UIlukVlNj1KrXbdtJzp1qcL4TIW+MlPkJMbJcrjg5PePpkwOePH7CYjFnOKi4d+cOk+EAF2UxlplA4dDfI1VuKbM1jmgIQQKbVMN1WSYaSlQdQU1sq0ZRaNRELtGOEtkpQslhXUkIMJvNOT89Y7lYkruM6WTCYFBS5BlZZsXEjZibUi5bDCLUymJAVQ7JqgG1j8yXDcumJVrHcDxld/82WVGxrFtmiyWdj4zHU4ajEVVViUXCwKeffcpnn3+Kc47XXrvL7fv3qSZbeJdx7+FD3nj7HbJqQJAYUV3gilALGnAkQk1Zq7JUG4wii7xYU9ukxP8uHWvsZa4VZWGE+tm1Sf/u/xIysliSPbr3Sj9EQK75eH+N57t3o6Z2lV71uBdRWjBYExkNKkxcVx5RhgQx4v7u3/sf/8GNzD3RDbuuCpye519qvYHUjvwyunqPm+hVj7tE1z33lTZZK6jAVJPAuu6YzAhnJQzdy0zqYYMyAsa3+MUZx48/Ja4uiE1Dt1qxnM9o6hVFmVMOK0wmME2+XZvNcq1ubZ1VLafDWktVVeTqFJVwbtGApLZXEm6yqrXWUeYFGMPp6Rkff/QRX331FePxhIcPHvLWW2+xs70tWovvBFC5bURQmUjmLCD5Wl3bCHyYAi+3TSORCVFSD8SvI+althVNpqk79Yk4QhCEdx8sITjaFo5OLvjjH/0JP/nTn7FsWv7KH/5n/M2//bf5we//Pm8+eEA1rFgsZipkGiDiMkeWifZlrQR8dF1LjFJ+JEZB9siyTE2PTgRJWAuGrtMy8KKkyWpXtYzel+ZFiIr2LJqgmAIFhqpeNZyenfP06QFHRyeXNbVhRZbJ2AlDEA1RNDGZN1G+QVCtbVMbiSlQpA9a0feafk95at6rpqSMDRE2bDAlYbri6wohkDnH1tY2r919jTt3X2M0GnExm/HRhx9ydHREjBI4UZRSHTpEESJO0fq9huZnLpfEfREzdF5MgWtBHWi7FmcNxgo6Stu2vfYvgl4YbNtKFYGyyNmaTtnd2cEaODo85OLiHGsMo9GwZ9wxiraWfGQ+yGJJciAHDEZjVk0jddY0t80gEGHWOtrWs5gvcM4JykqeUmkM8/mM09MT2npF5pwsLAv5hkbjMaPJhCwvCKgFxIi2hkkvNPGRTV6o6CLaInUYN464xIbWAsBqdQzQOWrEj795ttFTer61YU2U/Ze53FVWafp/kH5uXD/teo5P/gWQQaxlRgu5ymJPfLbJdeC9x/3d/+F/+w9u7LCRETDIYHJF5b1Km4NwifTctBk1Jzw3umnAN4+/ga4ed11/rqXNZ9js6QZj2yRDL8lkqvVqqPy0xopJSI8WoQYmenICdC2LkwPOD76ivTilns9p5nPq1YK6WTGejBhPxuRlIcJMTUkGcEZyZLrOU7cNUeuZFXmu/h3xj3gF423blroWn1xEhGJZllxcXHBw8IyL83NGoxGv33udne1t8jwnhuRsVY3LSP5YMqGCRAF2XSuCq22kn1FQzpPJKgggX689tG0QKKwuCqRRB00TCSFjueh4+vSYDz/6jF9++iXVcMI3vvktfvf7v8+3vvNdpjtbRKDzLa2XStkoVqMA8q4/9DSxQ1+YUsJ7+3IpCi/VaTRp23otCCnapmhy4nP0CkTcNrUiuHQYXQUH1Xo6HxW1Q0LTz84vODw65tmzI7qu48033+Ab77zFeDJSk2injEKuEfpISolQTWZNadc8Qi0ZI9p30tLk9164xUgMop0mzS2ZNpOglPuKVSRVSBcGnICSoaoGjCcThkOJMnUuYz5fcDGb0TSt1LrLNAgpIiVjMBg0/UO1zIRaYyQDXkWVml5VlZT5ld5dxIrOrvwlMU/6GnSZywSBpiqAyGq1pPOtmN80R1PuJaZG+fDkqoPhSAQRhroRzNEETpCEsZjCJSBEFqIyv5rViqPDZ7R1Te4EtFpq/mUMRxMmW1uMplMZ3RRKvqGJmP6fNSXekhizsJTEi2QMNoWjPJoR37l8iCyXK549e8bhs0NOjk85Oj7h6PCY0xOBn2vqWr4DvW5Z5GKa1gkhiz5JcLc2gZzLe5LIUb2/+tMSL5QnWz/fTW0vovSuro7LjWTEzGiT20DH1xgjwNpOVI2EooQujzAG93f/h+ejH3vSwX7VjqTDrh4uL3Q9aaVxPWiXSI99KV057lWF2o3H3XhfmYgi0PQ1GvoVjVXkjYi8BKmpJSpybiKxqZkfH3D+9Ev8/IxusaRdLKjrJSEEtne2GI5H4IwIIxVQ4ngWRtR0EjTinCUvRPtYm6PEzyLh3bpyibKqzpxExjVNA4iPZTwaSUSXlaeSCS79lTQFMa1KIIgIPNGSRBDEIEUUnZVE4qQRxiiRaII32NG0QZDTG0/TBEJ0+OA4PDznk19+wePHh2T5gKIckZdDCb/OS3b2drGZExTzGAiIX8dErXJtrcI8ySTuVKMiIgLPOUnmVu6QBETbdb226zspFWOMmK2NamhidhQBLs8qgiZqNF/biFBcNa0ItWXD2dk5z54dcXp2Ttd53nzzDd555y1GwwFecRMTE++FT1TzsArLuKF9RdW0pbZd0swUwisJtt5UKWbnpP1dEmhRPnNkamuMUwQNajCa95XlBcvViidPDvjyiy/7pH4iLFc1h0dHRNBqD2Jm9wJrr/cUZmVtWkSI6Q2SeXHdIZlvm0VJ131Mn5VRARiDzEHRuFUzdwpQnYSnVjPwIUrlh5ScbQzVYCiJ11EWe6vlCh8gywryolB0HEmZkTSHTC0AjqauOTk6oq1XOOTZykFFUZYMx2Mm29tsbe/SxVQcVP1XKkyEtylPUV6O2nskt1WePPF4mc1ctgDpgDgn5XEOnj3j888+4+jomKOjI05PTzk/O+P87IKzs3POz885Pzvn9PSEk+MTrdoee2zELMsEh7O/v/AsmSepw8lCILmOlzjiFfl1Pa98Mck5ryhPVKgbk4KqRPgmoeasjFqSLZvP8hsTalfp0oBt0o3CZYOuEYjX3eM6uva4a66H2Xz+ze3Sbmz6LEW9IUbR1JyJ5ER8vWR2+JjzJ18QFud0qxXNcklTr7CZZXdvl8FwgI9arqQXakYAd4nUtUT3FHlOqRV7W/VVCXNb+1wg+ZlE+AUvdcaKohBTpprrTO/ctrgUyaYFGmV1rYERbdNHYhIlp0kYjEAZSfkTYdBN29E0LT5A3QbaViPzushy2fDo0QHPDk+4uFgAjvFki6KqqNuOg4MDnj47IMTAaDLG6erZWENmHRZwxqr2KJ9kMiem1anLBInFpCACZf6+U+GsBTCDPr98L2uTo/jbUgj/ZtSj14hUKYvTtp7OR5Z1w+m5CLXZbEHXel5//TUePnjAaDToo0PRvoYQiGkREORDFcG13kTz0YAhPccHNX1u5KtFXcgEL0IyCbXEANJXLsMl89aoMLBOCrAaa1mtVnzyySf8/Oc/5+jwUMLYi4Iiz4kElsulgADUDUSp+izXXKcrmFS4VGQhGGGY0o94mSNohERimum7E6a1dgaLgFZN01oyJ8Ec6VKiaYhQ60LQyhAafBOhKCvJXbOiUa5WNfWqUeZeiKbmPXVTqwlSBZu1+Lbh5PiYerkS87qR65VVxWA8YrKzw87+Hm0I4htWHiAMds1JhF2s/7O6Xw7Y5DdJmInd0LAORMuc5ejoiC8+/4InT59QrwSMQXzVKQdTFndd21GvViyXK1arJU3TsFgsaZq6jwY2WjVdNr27uhB6yUASFv3sudxdpfWzvDqlt/+i89KM2RxNWRytU3Mytx7n/iSlXyG64s+RXvCgm3Tlcf7M9Nz1TFpFyj+G9QSQ1Ze+lBThtDFJ0pZQQYLv+mgywRAUHMGu82Quo6wqXJ4T1UwWgkyu1CevYdgiUEQTCclM1spETiHzEhAgDEDCnhFmoACyjSZ7x9CJNmkBhZzyoaPzjSZGq2amddskGVcEQbERdWkUP9F34kPr2oDAJlqCl1Ig3hua2vP4yTPef/9Dzs/n3Lp1hzfefEjnI2dnF8xnc05Pz/jk40/4F//iX/LlF18yn816M2dQ5IA0WWMIeI2klBX9WnCkYJXgJYm4a1tafY41I0goK1KNO2lhXZOqiUux06Amwq5dMxBZSGg+YBD/WoIZsy6j7TzL5aqvQB00l6rRaFDvU2K8bF1fGTz57uT+IoTlGdNP2S/+vbWWnsyZycynDCppQrp4cdZJwrGTxU6R51RFybODZ7z/s5/zy08+wRjDarWi1vJC48mU+2+8ATbj6cERjw4OOZ8vaYEuBrro8QQ8gTZ0tN6nVLE+92/9UUtgjMFK8VYBR4RgJCE5ak4cXioVavkaI/ZfiaoNkk/Wm6SQ7y9E8IjW2qqgms1nrOoVxkhO02BQ0bUNy8WC1XKBb5tee+06Xbh1kltnVJiYGPBNQ7NcsprPaJYLuqYmdPI9qqW139ZsRL5eCSSTYDKTOtxT+mNDoOmWLmUVJ/3g4ClHR4fEECjLgvF4xGAgiCej0YDpdMJoOKQaSK5nVUoQ2fn5OUdHhzx+/JgvPv+czz//nKOjY+bzBV0n1o1eK46CniMWHgl+2aSbBFHffs2+F9FzPPcSiVYm/61JxlnMxHLDNGaX6S+VUFvL5b8E9IIXdXUYe4GWBr5/ARCDp6lrYUZtYkiysszyQhKNFXQ4hI0qxhiij2KSDJJHZdV+L4mtijjSNDR1I1qeJle7VF8sBkLoxEfUCOq69x3GRJyDGCU/CETgNY0ggEjQh1TfjkQBIc4yKVevmIeN3rvtPE0nNbzEFARN24GxlGXFarXil59+yocffsjb77zNW289IM8zzs9OqVcLrW8WuLW/x639Pb764jH/7oc/5ODJU3zrMdhee+1nSK+NqPnUGEyUBUTbtrRNI+OiiCapgriYAnUVHEWT67xXP5r4J0WAqTnQpxQLNfFuaERtKwEwBqkwjTLstvEslzXBi+aa3rdET0pUa/DJR7dOv1gLtqRZrjXHTSGWNPJ0jaDaajKTRrFrqu6QBJtEB2IcqJmw857z83Pe//nPODh4yrCqmIxHjIcDCJ66XvVQRHfv3uWtt9/GYPj0s894dngIVqKB2yDvv/VerA2aI9h5iSwVU+SmsTFFfW5sSC6hQKUVmiu5hj2Sdy/aGWrmC0GqEARN40hBPcF3NE3DfD5jPp/RtA15njOdjMmzjKZesZjPqVcrQAKhksbvvadrGqKXZHITIWptvK6uWS0WdBocFYJEIst0FOabrAjKFa4wkcsMRTShNSXNNC1IUFNblsFkPMbpIvn11+8xmYw5Pz/n4vycum44Oj7i4OCAJ0+e8OjxI54eHDCbz4lEyrKUxPMso2s7Dp4+5cnjxxw+O2R2cUHwUt3COfHdvYDtvVCwyb5rdv5ZKY1Lr1yse6gyWYZsg/7CzI/X0UuPU0l9Hd3UfpUuHXfT9S61pxemwqxvTp/pen/aJ4mikQxPM59x8vhLFkcH+MWFlPRoJJx8OB4x3d7COMuqbcXR23rJ+Iny4XZdBwYBWHWOoOVeul5ACmMEBEqrlBpQKNiv7PeCZmENw+GAshDHu3yEkbpeCYPYCDZIjNKYFBYvmJMYAZ9t2466Ee3Q+0CtAk7GyOFD5Isvv+Lo+ISiKLh//z5VVdE0NU1d0/lWUPaNpECMxiP29nfZ3p7w4YcfsFwuKcuKrekWRZbLCtknDUpNcJF1IIIyATHbbWg/KQQ+fRzp9aHh8iokeiHiPUE1wOC95GspPFMSUstVQ910NE3H+cWMx4+fsqpbgo9MJxNu3d5nb29H8C2DrIiNBorEEIk+mRRVMG341UQjkTFNJklh7rF/VlHIUnvKaVMmjDKCtPSKSDJ0NAoWDG3nOT+/4Ic//CGff/Y5WWbZ39tlNKzIndUADgFjzp3DEiiLnPF4xHBQUS8XrOYzyrLooYki4HpfpoxvjPSru17/SOkMm8INwf/EID46UtmdKNqd+uysFXxVm4JEoJ+f4oOWnDljBRYOjYqTCNicxWJJ23ZY6yiKQqweEQKxF6hSvihwdnzCYj6HEETQFjl5UTDZ2Wb3zh229/boolRwl+eU5GvTP3Ky3Fw29fVtaZD6H2kBogxcj8syy2AwotGcvdfv3eP09Kxf5C1XK87Pz8nznOFo1Af2yAI4sFytaLsWkJzX4WAggTHGyHzSSFlrFR2JDUZnnuf9L5IH8kw37LyGzDXX3yQZp/UBMg+sgLobiSa9jv5yCDUdy80HuJauO+ZVz1W61JfrzpM3s/FubhZqbHgG1v0QX4MlkkVPu5yLUDs8oJtd0K5WdHWDDx2T6YTRdAzWULcNzaohtB6n0ysqgoR1ljwXk4D34re6FPWmiBiF1l+zChnTdSKoMJJmkGXiOzBmM/+pVXu7hGODhmR7YYziuxBhFrWGmgi0hk4hkILmSKGfZtt5njx5ymol9bYSKomspnVFHaRCcl5kDIYDJtMxOzs73Lq1TzWoePxIAIIHgyGDshK0e02wDiqsUBPiWrAhCb6636sfanOc+g85otpSMvGtNSURNCLckilSTLwdnQ8iwKJhPl/y5OAZjx89pesieVbgrKEqC+7de61PfwhB/XRq7kzCNGlpIayT5hOiiA+CWp/6nIRb0saSxhiDCrCND7wX3irsowIH26zA+8Dx8Qkf/OIDfvbTn1HkGft7e0wmI/CCzr8WaIYic+TOkmeOQVEyHFSURU70HXW9AiAvC6xLqQQbUGxBgjr6eaU/Q0SEWy/UxFzpk8BOfjcjgVJRy9B4ZcCoEI3ImFjNWZPzxKecNMWUWJ1lOfWqpm5arCLmuFyK6IpQE+zHPHOYCOenpyxnM6L3mlYjOJKTnV327t5h9/YdmhDwKrQ3hfmao6yfXZhDvwS+zPuTumFS8JLwkxSNmcz9mXNY4xhUA0IIzGZzZvMZWZZx69ZtMkXNcWpVqaqKshT/aKZ+Q1mgJveEBN4YtXb0Zt0oi9m+t5t9lTdz9UE39n1dunKtSxfYvLf20Ul0c5pN19FfGqH2nHC5Srr7ueNe5dwN6vvywuttPsT6xV4WavJrf76uOuRHBDxZDLTLOaePv+Li4DHd/JxmuaJZLWl9x9bOlkBAGajbhrauCZ3HGSOrbTUpOScvkyiam/h9xMcDiONUc9qyLIMoSdHiC5OP3qljXS4dxSypJsTOe2EgqNNbNQFSQVBtE+arxSc7MYclhhQR02nTNszmC1arFePxmK3plLLINS9MTIAx+h5tYzAomUyGTCYTtne2uXvnLm/cf4PZxZyDp884OTrFWcOgqiQiM0hUnU9lU0ISHIpkkoSTalprrSeZ6kSYoBBeSaAln5UIHhnfpOWmVICukxIvTetpu8Czw2O+/PIRR0cngKUsKrpOEDH29nYUy1NMuYK8sr7mJVOiCrWYohqjmEV7gZaEV/qpv0PP3WU5obJtU6hFICBFVpsucnBwwAcffMgvfvEBIQRev/cau7s7ZNbQ1rVglhrIrSHPLGWeS1i7EdDqIhckkDzLZbyi+BMzTdwXBplqxa2Z/WZXY+pn2owU/1QsewxuPR+NhZT3FsW3Kow4fYopTUA+UKtmyk7H0ShMWpZJkdmmbkDL0uRF2fcl4TwWWQ4hcn52xnK2kO8xz8AabJ6xtbfH7dfvs3fnLm0MBPUtb7KVF3GjtN/Ig8jT6OID1DRuNJxdwQVCEE0yzwuapmE8nuCcY7lc0rYte7t7jEcTTs/OqFcr1VgtzlnKouyDxooi10hPDSTTdAE5PnEyGZCUfyh9fl4G9ALvOrqh+TrSWdLfwyCaO1F2pnsYJFJZUnpeKtSeR+nv6S9aqG02veCYa9tvoE2hdu156XH7XesBj8+1qxM4IkNs0vU9JngyPN1qwdnTR5w+/opudk69XFIvlrRtw+7+LuWwIhLFR1XXmFQIVKSIfMgpsiyu4ZuSqc9qknGRCyByMiukoIMYA86tzTXCJEUwNX0gSKTIK0jpCfqgZpOhJJNZEMaeglqSmSzGSNO1LJZLlqsVd27fZTqZ4pyUhZHwbAihVYEWyAvHYFAyHo+YTMZsTbfZ37/FrVu3uHPnNU6OT/j5z97n5OSYqhT8yZSflPLTREhKyLtEhF4upBl1DFOEqAg3+Wh8lypFi7aWtKfQJl+WCMumFq3Ud17TFTzHJ6d88eVXPHryhKbusCbDWhHeTSPoJ8NhKRqiCt1O0wREQ1sLtyRwg2qTvofHUrOjqGwq9JQJqqb2HOmqX4SH7A/R0gZ49OSQn/7pT3n/5+9T1zXvvfsud+/cocwyuqbGt7Um3BsyK1raoMxxRlD6JWheUiuGgzHj4ZgYIk1d90nu1rp+DjkteZM+qoiWjFFrwKZQi4pNaoykDoh4SlqdMnplvOl3q4nIcgf9W/OWQhTNzqq/rsg1Z61u8EEqQxRlJfmlWr0gz3Mp0hsjs/MLFosFoRXAgxRZtXP7NvcePmD79h06jAAdr0NypX/9y7hMia/0z6DvKGGqcuXZ5LoGHzwuk6jU/y91f/ZsSZIe9oE/d4/tLHe/N2/uVVlbV6OBBkCApAACNJE2Q4mymdGfISzkSDYSaaLGZGqbZ80/IZsnGd9oWmaB0aghIQIEutEAurvQtWdVbjfvfs8Wi7vPw/d5nLg3s6oLpDij8bTIe05EHA93j8+/fTHG4r1nMp6QaRzq3u4enY98+eUTZrMZxgij2bZS2dwZCTovy5KiLERj45S4pYLCIPtLB2GlEOBg7F81q1fbX4ZmDFt6Rq86v4GjrTo8OWXwv+oRKqmlzlKT769KNV9/wPrFDtu/FlG7cU66uH6PAMbP6FubajT6Pl43Jtk0cuMgLFQfLvE3IoWhNrXUqbwGYzTha5DM5o5AVy85ff6M4ydPaBcrlsua+WJJ3bXcOjykGo8ApERLXfdDjJogORAJVv8Gr1KOOGsYY8nUq60oxLMNJCGvVwO6s44QJZ2Rc4JwmlXdO0REzYuX56U4zvXqTFmfGMUr02s2jOuSoiBiYhTHjKYhc4693V3yPNPaXB1ELxk/gni2GaAoMjamE/LMsbWxwXS6IbnbRiNG4zEHh7e4//ABJrP883/x+5ycvqTrPHlRkBclwSNq02B6Dj+lhhJiIO74vYQTU3CY6EtjgNCJRCQu/FHc5HunDFFFtm2g81ISpWkDq8azWLV89MnnfPbFE67mK/KiIhpHF8RlOsTA8ckxIUQ2phsURVpbxLYVQIXW/iA5w+jRS2MRdUxYEzJROa5hNklFAp1JrZeIBzRt4M/+/Cf88R//gMeffcaoGvHLv/SL3LtzB0NktZxTLxdE73HWkDuxW+RafT0VCpVge0NVlFgj2oSykiSyGJF2UDd8l2XkRd4TVqW1MsbEBCrOCaBxcynHpsCg6W1RA4lVZ57ouVR2F+bKaGxnFyLGOVrfYbAURUlZjrA2Y7msaVqPdY5qNJboMVXt5VlG5hzRB2azGYuFeAlGZ4nO0VrD/t27PHzrHbZ298RWqdqPNKYbr6P/rhpFwSrpfhCCluZ1zZ6WMItkgEnrUOQ5UU0L21ub7O7usFwuObh1i6vLS1arJcZIxo2iyLFWCFrKQGTUIzrPMok1NQJfaYyJ6c0ySS03mIqO+GbrIfHa2YQ3r/1C5/Szm/zK9P9JW6tjvyFR6x9uFLmnN9O/oW/QVP2wfjNJQnjdcaOZ9NtXWzr76iIPzqUCkDcXzgC9sTYdN3xx03FtERKnor2p8wcpSFm6xSBcjahAkFx5JkoxxejFacQHfvCHf8RytmCxapmvGroQOLxzh8lEKu52zWpA1AzeQBMDTfQEE/Ex4IPYpGKMGKwU0FSvyLR2MWrQqxIno+oXa5145NUNbdNBtGRZQVmOKPJKvAODEs4grvQoIQ19KhoJ3iR52nnZkMYg2UvU0C55GltRNyJYO8bkeGLIs5yqLChV1z8aVVSjirIqyIqMrHDko4Lxxphbd25x/+F9/ud/+Qd8/vkXnJ1f0rYRY3PKYgwmJ3jo2kjw4lzgfSBoWqvkKdo1ragdg0jXvgu0dUvXdKKWWtW0tZRKSbFjXYdmRDHUTeByXvP85Rk/+ouPeXp0wrL21F3k7HLG/q1DmuC5uLpkvlySlyWnp2ecnl7QNJ4iG5FnFb6NOC3IKoRNck1GH3FYLAbfSoma0KU1FhWz91JGRyozSPAzCJEUYU7gNstKjHHM5yu+/OIZP/zhn/GDH/yQs9MzDg8O+Pb73+Lu7dsa9iDSevAdzlpilNANpzbYTAmbqLASZw8QJFBft4rVLC9p74UoyQB6aVO9ezUzmbbr+1LUw2JzZeDIpBtcCTjyQGNEs6AMqDEObCZEqle1697QyhTGZiyWK4Ix5KXW70tprvRf7jIAFssFl1dXzJcLOmdZxshV03LnjUe88/775NWILspYBMeteaZriDwqtYtSjsoogxU1hCeieSydxTpLVFua1Vyq6a8gccE9VVlgTJDQHBuZTiYUecHOzjYxBmaXFzglZpmVDERFJqE4ompMYxMpMdnss1zgylpD1HAaayFTdR8geVajEL80b8GFyoD0+FQeIaE/azTKNfycLqwPo3hYbHyC1ULwqlaWoGthnL5W/TiQ1Azrp6bBJXQ5EK2/7ug/DaSeV4/Xt7RI1871x7XV6K9hUoZquUfODW7VBV7Tq7W+/3rv678xOWqkTowuotEKwEbOgWyYKMwOxCjZLlLFYBPJMoML8OmHn3J2cslstWLZepqu5dbhLSaTESYEfL2k61rp2xo6Aw3QxSgZyQ1qk+pkSOIjidE4JCHuMuCkbgtaZ8pYA1GqCzeNZKqwRiQ85yS/n2/b6xhH555UYrI6qo5UghE1nZfR9FVWAS74BqLHGOVCNXYqak7GPJM4qSLPGFfijenyjLzIKKqCfKTErSoYbYzZ3d9nY2OLqpowX9Q8f/GSo6MTVqsOoiNGdavH0LWC+KMGpEouzVTfSyTM6CNdo9Wim/X50Et2EIKREjNNYL5oeXl6yeMnL/jk8VOOz664WjRgczZ39nnrnXf5xV/9FR4+eoOt3R0CcH5xhfdRSsCczzg7vaRtPCaKsZ9gwEtarxgEbogQk6OKOoQMUkeCbmx6DjhtbaOqY4kNvDif8fjxEz744EM+/PATTk5OGVUV9+/d4+1Hjzi8dQtnTV9RoVmtaJsGZwXGrNXcmcoVZ06C2tcMVMRYPQwaJqEAo3+EuYr6LpTgInA43HfpiKi3ozq+pD5l+yb1j0qr/W9Soi1JkJ1scMaIStAaobjGOmxW4LKcRV0ToiEvS8qiEvW9FalFHFwcLnPMFwtOzs84u7piFSMz7zl48JDv/pVf4a133pPnWsnKErFE5YGVz9BFULwZZaQpkwoqnQYj65QIG+oIFtVByzmNydLfKabBOQP6nvLMkucZIYjUPB2PxU4fg5gzNBVcUq+KtDNwFrEG5wwu0/Rzlh4L9tBl5LmJ4KS3FoLiwn7O6cu6JdIzRCvru27CgUiLMl9F04hvgTWaUSgJMcg4X9euEbX+jxl8GXx6fRc3mz7SfPVDv6p9NVF7laDJtfQc+Ta4MPh8/bfyjOtzM6xXPfV1bSi6sdI5KXthJe7HaGqefrNFuqAGdOdwWY5zGaumZVYvWbQNMXNsbm9yeOuAalQSfEu7WhK85Bq0KIILwv5ZNYC7GLFR6rhJXJSujtF5GeGgQp95QhA81/IfdkQkr55LRUdTsT3FnNc4z4RNdW7Bq8ouiHOIcGLCrcaokkeQsjmkfa2bWzZqpvp82WTVqBIJ0FlcnlGORpSjETYXJJQVBePxhEePHnGwfwAGzk5Pef78OaenJzR1rTFVtThkeLEj+hTYHFTa6qQWWttFQpAilE0jDh+dD7ReYuzaEGm6wLJuuZjNOT674OnREU9evODJiyOev3zJfNUwmk65c/8e737rW3znF3+Bh2+/yb03HnB4+zaT6ZS6bQjAxdUVZ+fnXM5mNF3DcrViWdfUXUsXI8GAFGORSs9dlJRPXUTCkI1BWSnEZzxJJ0YJmXierlY1l5eXHB0d88mnn/Lhhx/x5OlT6qZhe2eHt995hzfeeMje3i555mibRuyMnQSn+06Cjo1Kackg3/81ivCUiIlkJjBoUA77Na0/n8DoK1pQpyfpU5qMRzUrAtwCY3o9eTuiTJ0wdwKLVtdKCFxGnhVkRclq1RCjIc8lfss4h83W4SrBgMkzgjPyXpwln4zZv32bv/LX/ho//91fZGdvnzYEoknVBlDNznU8sp5HOqn7SpG9bIuk7VA8FVM2oWQuSHeDUScco4yCcw7rNAGCFwZ2NB6xtblBWRSyD1N/vcQtxCxLuS77v8Pcj7JXE1cv2oSgOTKTDVHs2uv33s9SfjNAAKJaTXet1+XmN9IS3SBqKEG11koKvDXmu/bb1Myzl/OYBjSAkRuPVvG5P/N1TQf6tURNsdyN9rqN0Q/+xqXhuZvxCmkeEZ3MQFLrN0j6rjcOu4+6SftuTVR1i3weIhW0jqFgHbARYmhwBHIHRWbIYmB+fsbHH/yYTz/8KavZBXf3tpi6SFic01ye0l6d4ZuluFM7qdrb9QRCpcQo5Q8NStSsxOQIwArAgRA2r6mukvolaHXkrvM4l1FVI7JM9Oyt5ncUtYd4RHlV48nCyOoIwQq0jaqIejdgTVEUNHBYA7pjcjJJdiMM1ogKJG3aPMsFoWSOvKqY7uwy3dklG03IRiNcIUQPHDHAs6fP+dGf/5g/+ZMf8vmnn+NsxnRjys7OFrs7O+zu7lCVkt8vL8RjLEQdQxQbTJblmIg4dCin3GiQe9NJSqj5YsHF1YyT03OevzymaQMmy+gCdD7yrfd/ju/8wnd58MYbuCKjDi3TzQmjckSzWvHF54/5k+9/nx/96Z9RL+aMihIHRN+xvTllf3eX3Z0tNqYTqjInzzOKPBO7Tpb1yDsRDlFY6f+JcVHvzcViwfn5BcfHJxy/PObk5JSmadne2eHe3fvcPjxk/2APZ8Rpp2ulIGezWlHXkrKtrVcCA4ia3RlJGpupxJYOgRFJSdZz9UZzMWoTW6CMVaQlQcKv2fKgpzstjwPqRKI2E5EmnCJyiZ8EIWjCWBowkvorwZaxsnfFYcRiXEZZjSmqMafnl7RdZDTeYHNzW4LSlWmIgHGOfFSyvbeLdY5Fs6IJkQdvvc073/422zt7YCyN95r7RJxFsBkRI1mzdFJr3DKQ0nRdEsoQoiUSSq/tUFzjrBFGV5G6SFKiRWpb1dgY8B7aNuA7WWCnTOPZ2SlHRy9ZLpaAvLPxaCTp5JIUnjnyQuBOnEOkjzwvxG6PvJO2bRlPJr1trus8re/kfek7F6kzYVLFGQq1CZ8qCh3ccx3zWoPGzqWexARirTjzOHV6u4nzh+0aUZMz6Tnrh/3/kqjZ15wD7Vsv3ZzgWm2oy/KXJGoy+OuLLYRFPgeMGIn1ESGq2AxIRQ1PpvkfLQFnxPMvI0DXYLoW41dcffkZn/z5n3D5/Evi4gK/mhO7lsxK/5169Yn6M2Bih0VrmSnb3KsTMt34vVFdCJKzDh+Sy7ogDjGcS268oC76XdeqJCWxQV3n6XyH0Qwl/bkk7aXsJZnWIFN7nLipd4SYckhCDAIT1jqc1VgZVREZY8jzHJNnZGXJeGubrb0DyukmrqrAZRKAa0XNFEOkXrWcnpzyoz//MT/8wQ958vQJdV2r8VtK84wnEybTKaPxhLIaY11OlhUYmxGCeJQGTRxc1zXzxYLlqqZpJfP++cUFq7rBFSVN25EVJbcO7/Ctb/8cjx69w63D24zGEyKw6hpWvmGyOWEykgrmoe2olyuOnj/n048+5oMf/YiffvABBM94VEkmCy+erFtbG4zHku5oczoly8TAXxalQF9QhkpDNZaLBbP5jMV8zuXlJWdnZywWSwCqquLw8A53797l8PCQra1tijxXggVdJ162XvNgLmYzlosZbVOD1syzBoFfKxy9ELS19GbUO07olewVo0cv2SuHvt7Tqn14ddsTQcNKkn1KHH2SlGE1sXeCQfmNOMSIelEIX/K+NEbK5VibqVelELWsrDi7uKLzStS2dzA2k/ykKnnZPMcWOb/wy7/Ie++/z9aeJC62RUk0jrppaX0Qz0ljaH3QSt9i85TEB+uJCeSnietf3b8SqiHMpzGIFGWM2s69hFCUORYlGiHoPhL7YzINgNSUC1ESjHvN6lKVFTFGlqsVV5dXXF3NMFZT5+WS4DjLb3hBam7FsiwlXVqELJP4t7aVCgmS4CETm+kg3EII2xrvouNWQPnGRE3efXIEkXWzmtjaOWGebuL8YXuVqJGetX7Y/9qI2k3J7eYE/82J2vq3w5WRU5pFID1HzEwYfUaQBCDkFoiBqO7s1kasjeQxUpiA7WqWz77gp3/yrzh5/DHdxQmxXmJDR+FEX+812Fl7FqIWOyEGTuxsRvO1CVETZBCSykIlr0bTP8UoHFhVVb00kIiQ96JKsFZUWlKjrZP6VFmOMVYJmgR+o9kanMvEiWUY6OzFhV2ImiySUc805zIytc30RNRKMUlXFky3d9k+uEU53cAVFSbLiVY2Uh8A3XjapmMxX/LsyTOePHnCl198wePPH3N1daXwJ7YUl1fkRUWISV2sWTVCh3GCiJo+SF0SRS9XK1Z1jctzdnb3eOPRIx4+fJPDwzvs7O6xubmFcznWSUb7Nnjm9ZxiVDLSWncWQ7tqaOuG+WzG2ckJL54948XzZ3z6ySecHB+xWknC3KoqNRxD3meeZZhocUayQsTghdM3yrYEyXRSr1Y9Eiirku3tbQ4ODtje2dGA91IQSYxkxmARmPRdR9s2fcqo5XzGarkgdK0Qr1TeQ+06SUoTSUKlCd2CX0/UbrTXndPmVf2Iqh9jVC9QnXciWF2n8XuItCbPdlL5Wm1FRssIOZeLNOccRTXG5SUXlzO6CKPJBptbu9gsF/VzCARjsEVOPqr41nd+jne//T57h7e0eraqhINs9jwv6dT+mlKJdGttf98MqIox4ZIeE6nNW87FGEQSEaOSOFbFoEkXJMQnSUPrfapZapSwyNopztM9nLxJhantWGnAvDAL4pySpO/195SFJdPUeR1lKeEEXdeSFyVlWfb73XtNHjAYX0KIwmSLKCoK0m9A1LzIsToTUIk9xdVxrY/rLRLXRG19Usfzv2aiduPczQn+mxO1tf2Mwd2CFkTvHjUfq7FSHDSmDRslCakz4pMffcA4wEHUgOzSRMrQsDp6yo/+8F9w8vlHhMsT/PyKLHpKJ3XUggYIR6JwLrGThK8WbG6JakxPxCEi+Q9TkKp1wnnVjaTVstZSVWOqqoKBLS1xfLKuhqCFR30MfdCnUU60bRp1nxYvPGPlfG9ni0N7XhSCNiRqylGL04GoFCIRD7iiYLq9w9b+AdV0k6ysMC4nOkteFvgoxKxrPQSDxbJarLi8uOTl0UuePHkq9aaOT7mcLZjNF5xfLvDBgs2JCFEjc3gCOJG2g47ZWsvO7i47e7tsbG0y3djk4OCAg1uH7OzsMB5PyJzYSIlq6zGGLnpq3+CKvM/eYI3krPSdx7eSj3C5WHB+fsbRixe8fHnExfkZ89mMJ0+fsJjP8aGTNbEZNoqXmZRi8YSuI3qvRK3DGcN0MmY6mbC1tcF0Y8p0IrX5yrIUCdoIcTAhUjgHnTIawYsKsl6xXCxYzGeSh9N3OHXtFiktETMhbImoJQbOpL14k6hFRHmkxOdaU0R3s0X1iSEx9mjNt1SBITFQ3su9/Z5LRC05P0jgdghRiJoR9WMxkvJGl7MFAct4usF0aweXFdSdp+46PFCMR1SbG3zr57/D2++9y9b+Lm0XsC4jRiGWIUqRVN9FZWxkPcRpZI1rdGY633RW8Kg4NAqDYhRp50VG17YcHx+xWi25c/uQalQJIo+6SMg7dU4kQlmPRC4SsReHm5SYGq2wnsJxQp+ZZe3gZUzKgC9w7TQXp/eBWu3Vu7t7orZuO1yWMZ1M6FICA9+JN6dK1z3ujWpz/EsRNYFT06uvxSQjRE2IecLbw9/KXG86imgT3CaLRHrsdeHoa5oO9GuJ2uvbTWL1unMylhv33RibrOngzPCjIu6bl24+uff4STPSHHQG0z/e6LPEyC2HBTHCIqdMcoM1QgkdhsxYXAz4esWLL79gcXkObU2nKiDRtK0RbuLQBGEIwTVWbQ86EqO6aK+5IKPONXn+hRA0PVBBluXEQXaSNZCv7WLei80sU8Ilj1Y7G2KvSHaUdfYLRTRqJxCOXzhsa9R1Wp0OrNrVxOgsY3V5RlFVFKVULrDOiYcZkuoLDSqNWqA0pf6pqpKN6YTd3R32D/aZbEzZ2NykGo1pvOf84pK67VgsV1zNFizqmkXbMq8blk3DsmlZ1DWzuubW3bv8/Hd/kV/6lV/lnffe441Hb7G7t894skFZVjiVWm2qVIBs4CzLGJUVZV4Il2us2AuVEbLWUZQlk8kGu3t77O3ts7O7x2g65bPHjzk6OeFqvmDVtNRNS1O31HVLXdes6ppaHWKi91Rlxf7uDnfv3GF/b5dbhwfs7+2yoUl7rVs7dQgHDplKeSnrfV/4tZPKDITQe5ddcx5QoiaqKVUZ626RvTAganoWhKDBGhFf22HXkNEay/SOH+n88LdG1GLpu9jUGEhr6RAmSpxEBHaty6RSdTSa+zGjLEeUZSXEyUt2/2gMeVWRjyruPLjP3sEBeVXRhoDLhECKNKKYQeE54YM03CGGWU816XySfVGJW9rTVvaK956zszOOXx6xWCwoi4I8l1CZ1I/gnTR/6TmpgyW4XzQpXSdMEgihCN73xDEm79oBXkmMmtgnZQ0hslwsOXr5kr29PbIsZzabM1/MGU+mmmpL5tFjo8H76Jvi3eHaXF+p9W1hiOcUvpyGPFgrY3pt09NfQ9TSt7WEdv2ur2r6439bRO0198BgffTy9QVNl2SBbi7rtb8RdScW1YBBFkt+tY4Hk/8jIYrNC0UYxkjdL+GyRU7JbG+uwCEcsAuB2Na8fPaExeU5oVnhuxrvu94gjNoGeoKm1Z2NclUhSpwLyJiDFgoNGv8CUng0OXw4l5EXhW4eyWfYaV02kWCVqKlKI3HHKAcunLMQVJvy8mnWfnHflhbCuoyFcNBZnzrJqAdXcg9PmMBYS5ZLQuYsL7CZqJREYg190dAYJB2UeOQJgEe1OxZlzvb2Nts72+zs7bOzv8dkusHp+SWLZc3VbM7F1RXnixnn8wXn8znnVzM5ZnPOLq+YbG7y3s99m/d/7juMp5ti0zPilOMyyTgRUWKtMGaNEOrxaEyVF2RGkEKeSRYLjWjAGkdQVZtxGS4vWK4a/uCP/ojHT55wcnHBxdWc2dVcEMd8zuWV2EKauqZeraiqkocP7vPu229zsL/HdDpVJ5OcPHOE0IGJ6ummRChK1nlrTW+Ib9uaRp1DpMiq3NMTNicu3r0NzSgz128UJW7XCNqrLfb/cWO3DQ4lUGnPDpk4IZzpl0JcUcIw1B31BC39tZqZxFqsyyVgXyuFW5dRlSMKJWpN29GFgHEZeVniyoJ7Dx+wc3BAVpa9Db3zkp9S5izakWFTDfYrLU0/pikrbsgGjF0MWkneWbLccXl1yQ9+8AOMMWxsbFJVFQa5b+iUA7IfnQFMKprryTIhkNamKgTiWOK9JvvuS2B1dI2YFYQZjhglVN57FvMFxycnHB8fS/aZquL8/JzT01PKqqQaidYn7c2o9i+R6NP7TK/+mxG1ntArUTNWPaf7Pm8StevfdXUEKQ+bDufauf9/atcAKbUbAGdQAHvlspAzcd0XVexwA/UtRq2/JKmFnDUSS6JcmNHOk/dfqticcgjmRYXNCowTRLlqOvXGu/5G+u8D9+4oDLeqMJKHoXgneh8kQ4Zm0w8hrLnqPrXVIOmvF8cPoZtKvCJqdF/r7pPbtTVrlUWMwln1zJ5gG71HKmQLcUsIZ4AcjdgMJQmxVLD23lOvlqwWC+rVUpBu0E2oSYylsjXismMiWe6oqoKqKrAuUo1Ltnc2uHf/Dr/6V/8K/5u/87d5860HHN454O6920zGYymTEjyNHm0IBODPf/wTPvr4U+rWY3MJKagmE8bTKUVZgrOUVSVVE8qSoiqlJA+xz+QSNDBVMp4EjLXkRU5WiJRnrAS+dz7w5dOnfP75F6xWdU8kItCEjtY3QKQsC0ajCu87Hr35Jm8/esT25iZ55igyR1XkOE2eXBY5eWYlODd6CF0fBO+9lOVpdU3TEVVd3La1SsCDmDR9zz0cpvgzfd9rFDF4qde+D69LGxKtmOBd+5FnCTNHXBMrlFlK/YpEtoa3NfwhjkVK0IxRTYFWajfJXV6P3DmxMTZae69pFWYlYYHVIGarISfWZb0WpVXbsoxNTGv0M1VGNDUjaxVVzZ/nUmzVGENZFIzHFS4TL+ZRNaLIc45Pjvkf/8f/gY8++oi6btR9f6CR0SoamcvAQKc14XzwUlg4Rg1zkX0jsaUCn+izrUqfq2XN6dkZT58847NPP+///uSDv+DFiyPu3bvPdDrF+8DVbM7p2RkvXhwpIU/7esBYDKb9OkL/s1pM62fQ96144yvacKndP/iH/+fvvQJ6AxsUPZd0HUT7lkadDuS7fBr8wgwPs94N+j1tnJvnhs+WTb++bdiEXFwfxzXbWt9/35NsmtcNzYgThuhw1nnoMOts4VFzMhojnJIsumyw/pGD0acpK5+JUYns5NkTLk9e0syvCG1DTG7VVqTCzoureQihdwhJXoVpSjERI43PEqIkhEZUEOqgoZKP10rGEptGT7h8JwHJXlnOsixFPZj6H6QvguRira7lShx9JzbAshTbk9j6JM+i7zxuUISw68RdWZYsZVZwvWSU5TmZIhTjpA6YwIRyrEpgh+AnEm7EZU5c+quSrZ1txtMJPnq60LG7v09Zjem6qDXbxJPTqJ1xd3ePNx+9yfvvfxswlKU41qSHJGQsmSuMZnvx5FpANSgCznJBjIk5EgQSND4Qnj15yv/0z/4Zjx9/LrBhZK0zayitYzoaMRmPGJUFk1HJL333F3j37bfZ2dqgzDPGVUFRZOQaOOss17PeGCSmzIDt1V1ip5IconIk+4WzUnZG1lVta2Zoa9FNgkjhRoBc357+u8ng6M66ScSAHo4SHK8/yFokBKkXtR/5LM8WKdjruV5CsOoQZCQ4O2koBEaFEBS5ODu0bcfV5RVt14masizY3dvnjUdvsbW9g1FvRk1GI8/V/S7SiAwtwV8aakLyGJE05Aa5ZpEKHJn+PtnAnbVkGcxmM2bzOYeHt/ilX/5ljl4c8eL5c2KU0kbpgUbXQ9TIbe84llSImXoodp3U/kOloKhxq2nfppdorVQFL8qSzkuqrI2NTfb299na2qbtPJ8/fswXX3zJcrlke3ubza0tTdwdZQ1V+5IYO6N5OIdjfmWxbjTfiYe3qFzFnpaYaEjmHm3rrns4df/gH/4XmqV/2LluCORFfOXj9R59V3L9dQTt2r3p+pqopTM379WP60+vDGDdhhuMmwTtWpMe1UQD6spwbRbGEK0RBxDdQEY3kEFelLWWSMRlqkYzaUqaNXwwGNkA6ZvY3YrMYpzh4vlzLo6PWF6e0y4XdPVKS38IRx80kFq4LUXaipzMAHlE9RRLHkmo6sZ7SWgsG15UZp3XAouDgFfi2mU/hChFGwutldW77QoEGSMLHDUvpGwayWCCqq6KIsdZSfsjrvOiokxlSdB6b2kSaUPaXt1nJfg6zwVJWUkqu7ar6AbWV2yI4jhjxd08KzJcLg435bhiMp2QFeJo0LQdh3fuUlVjJead9isEe1XXVNWIf+ff+TXKotTAXAUN9U4T4gteQydCDCKJOasZYIzEAVpVn0aJ+wghkmUZF+fn/OkPf8g//af/lNVyqe8LiixnYzxhczphMipx1jAelbz15pu8/9673NrbZVwVvat9ImTqMLtWneuaoARq7XSioRddh1fOPnlXWgF9jBIVa4cE7TpRS8HKRgBEQT8i5G2wvW/sPyF0ab/q79cda5NBXNuT6YiJcRE7b0gekgOPWmMzonFgJKg6y3IpPdM0+M6TZ7m8V2NZagLuLojzR1GN2NkXoraxtQUIMeviQH346lDXUxjgFXQ900wGpzEh4Exi6daIO4TAyckxi/mcu3fvcufuHUajiqZpOD4+5ujoSMZflTgn4SlJEoOUBEJ6DQkX6KsRT2rBCZ0mJY/qAd007bqkVYSgcbDWZhhjadqW0zNROzZNw3Qy4fbtO2xvb7OqxRM3xEjmXO8JMiTsSdOV4Gu9HsOVQfaxMs5GGcjkICKwpCYepzZ6Xd/+RYijSCJq6WL6kwBL2/BlabsJsPSv79Xz0tfgfH/bDZJ245zcNhzI65tRbnh94vXjG/Q4ONb3GcHXBA2sNFF9HvvNDlpeTMBREbAEYiesoIgtqTFBwgAMRCMAJ84kkfnpCVenL5mfndIu5oR6hQuRzGZkVjN+qMowkpCqqCAS55s2dlTJKalpjBGJJm12ISbq9dimNFeaoQBoO6n+DFBWFZlbu/0LoZQ1UtzYb6guOZYoB1/k4jlllEPvNDkwPXdrQIMqY1QDg9p8ZC1lDTOtC5WkNFR6FWKmI1fAjvo+jJbpcRoqYIzUl6pU6imKnLZuyF3B9nSDjfGIqsgoncMZyJ1ldnmJb1vefvQmB/v7FHmu9jNBQCCINaBB7iDJjDOxIWIlGN2od2UcbB6n/f/wBz/g//3P/hkfffwX5Ejy4HFZsjWdsLO5wca4pMgsG+MR9+/e5v333uFgd5vxqKTIHJkzWCMxZdZEdQwZOIgoUugZLCUmMaiatGvpmkYlNsk8kfaDwLtw/LLea4kEvWa1NElEmaqBBNbfiL6bgWpwvetk3wksKEwP9iHxBl5YP7z/TUweh0rokpoR64jGYawEITtNTFDXNTFEikJqp3nvubqaiSNVBJyjrEbcvnuXB2+8STUd90HSAfV21tHE4SyHA9V1Hg5+vRrSLBGj9nGQ/IqiejQcHx9zcnKMNXD79m1GVcX29jZlUVCvlpyfn3N5dSUB1VFK0mSZJDKPUTVFaW92ElITETd5SSG33s/BS3xp13bUtZShkqOlC5G289RNy2olSdhn8zmdD+RFwXRjg/F0Qtt1nJ2d0XadlLnJM2HghvhYNUFpDfqleQ1+FscTnYS2LBONB7qXTMp4kpgitFMl6O4/+4f/6DWOImukn+5/5fE3idTwwuvO37hf7rrRg5H/hudsoiY/q91YIIH7mz9czyhdTkhxeFVsV6J5VMYc1FU/SVwxSgcpaBPlztG0WTJh2YA+Rrro0XJlotP2nix4uuWC+ekJs5OXdMsFNA1GVYa5uo+H8GocTwiSxTZGsZ0Fldb6vIHI3EAAwFi1QQC+FU4t7T+ZjyQ77roO6xyj0QhjxYVZ7ETCPQkCu07Q2k7cea21WjFAqgpHlcbS9V5KM2oLjFGd+YfvQmyGxhhsJrEyNnNC2FQdNZQcBJGvX6CoegS4o1WVhLoDTyYjdna22RhPefL5F4yLisP9PW7v7zMdj6RuGOC7Vt3vz7lz+zYbG1Mp+6HrHoEudCR3nNa3dDFgMovNHSazdEFKA0XWKaUSMfmT73+f/+G/++/4o3/1BxRkjMqC7Y0pe9vb7G1tsTGpcARGRcajNx/wnW9/izuHB5Lhw0mdM+fE6eMaQVOeSoTa9XdjNEMACiudx6daem2qniAaBJOkNLW3rFXrQ/u0hHOkfRFJKsc1YZPfKKLtm3QQexpv+n2iL219jrRL9Zzut0RkwRDUVR1VPTordcQwGdE6jGbWcJlk8m8bycZTlSW5y2iblqvLK/HeVc1APhrx9nvvcXj3HnlVioRmwafhsca3/XL0X3RB1uB47bIcOqugyc5NUpuJl/Tjx49ZLhZsb2+zt7cn6x4CG9Mptw4PmU4nfPzxxzx98oTFYkmW5VSVJFIwQyYjaMJkZYi9ql5jzwRLoLbEo6bE02ISWK0alquGVd2wXNWs6kbswxqI7bKcGGG5WvLixQtmszlVVbGxuYnLRHrsV0PhY7ge67/XVhCjsa8MbH7GrIO/IXUo/Q1hq+8pqk3t2kntrP88ON+3ryRoDF7f4MzX3r9uZkh5B+e+URveZ25870+lcwJE6Wnrs+sxWCccqwUyo4eVQ3CoGNetkSAVHwKaUP0akpXODDYzBEXyIYinWZVlmBC4OD7i9Pkz/GpFbFt8UxOjkcDnvMSnuBwjnca45vSiGu4TkRDjv7zsJJmJi66MKaoHmNd4H0E8IqXVTYMBylLz4mmsUBozqrpAAarrvHB2mrInEbQ82SE6T9NIZe2o9bXERieb3xjUnrP26CRxeOpd5jQvn7jQJzXE2pU+cWwClKJ+XEtGeo8RPb9zlulkzMHePtPRhMeffkq9WnDrYJ+7t28zqgpBCyEwv7riw5/+lKdPnrC9tcXu9jajqoQoDhld1xG6jlYzc0wmY1W5aj2x4CVGUTnL4DsWsyt+8Ed/zP/tv/lv+NMffJ8cw+72Frf29zjY3WF7c8qkKnEmUK9mvPPWG7z37tvcurVP5ixlmek7Fz0CUTKsi1ejrN/Q7picUox6sjFQPbatOI2EtiUm78gE+4YBA5FslmviY5IXolI5wS2CKOW/RAiFA+zxkAoSqa33X+Lqdd/014fn9JsSS9kHa/vKTUlN1CmS69BaJ7beECjyXBkUw2K5ZL5YCrK3DpvlVJMJv/BLv8zu4S3IHE0MYoZQTUtCqDIWnU+anJ5TsJO/Kn9ePyQ5rzPChCUGJCHp6WTMxuYGo1EFyWNRkyNsTDd46+23mUwm/OQnH/Av/+UfUDcN9+8/EFyhITlRbU9BiVgicLHXvIiUlojf+l1GOh8VlwlT2zQSZ7nS8JLlaiUJCpYrmqZhd2+Pg4NbjCcTZfpEUktamaD7O+Hk9VtO73LdotrinMaygmRaQRNLxCiap0Q4QRZ93UvEvHg5G7ym9Fa+ohn572vuGLy6wZlX+lwDAaSXf/MeaQkZf10zPSKU/wxDm1r/3/pElLuGt8ihZ2LEhw5jIs5IILU1iZONvVoxYKi9x+aFprWS51onhmUUoKOJKqVFCcjuIrn3jGLErlZ8+eMf8uH3/4Djzz+hPj+mmV2QZ47tzU02tjZpupambfHRi8df6MhtxEXxZJKXLQ4aKaGvsUayVCRVnDH9mkvVasnrZtXms1qtaH3HqKqYTjcoSslG0WlarKCeVl3XCZcOtE3LYiVIoSgKqtGIqixxzhKC5Bism4bOi5NLWY16QE0bOwQxClsrziA44bBdXlKOx4ymG4ymG+TjMa6syPJCn6/ELUl+RpG91XVOb9ZI9npjHESVooMjtJYvHz/jj/74+3z62eds7exSjcYslzXnV1e8eHnCF0+ecjVfUIxGVJMxj955l3/v7/77bO1IJn6MIJzzy0t++tFPKcqSe/fusX9wACFiMcxnc14eHfHTD/6CP/rDP2RxNcO3DVVesDEZM64qJlWFNYbYdbRNQ4wd3/n597n/4C5bW5uSdqsTeEQdPYSbTTkFtcUoCGVg40p/27qRUjxdS7NasdJitV3TEL3HplAUxBbb29IGBnrdOhjlqNN+EaIltt9E1JLnYFSKNpTmUjMJqfUIb7hPda9dR04CPwN7WqdqeacJuiUEJSO4HJeXFGVJ5jKpwtB1jKoRo9GYrut49vwFF1czyVxTVlSbW9x/+23+vf/wP2Tj4BYUOa0mnBZm6UbTwQ2gTXHL9Xuuz0psm86C0ZhLlMEzxvD8xXOyzLG9va15FiU9VVBNR5ZLSE7TtJxfXPD8+Qs+++wxP/3ph3z3u7/I+996j+2dbWKMLJfLtUZFU7IZYzWUR0wCneY6TZJc13XUTYePgt/Exi6EJhJ0/QHE1jUajyRR9u4ueZ6rR7JRh6TEdEsasAQ7AgjoN8FL62sKQ1H2c4yB8XgEKhAYA0WeK/7qVxQZkfzOvHh5NXgNhgS4r7SvITzX2w3gfO3v5EWm66/coV+kp5u/lXZtQv0j12f/Mo4i6Tnpu42e6FtJS2Uiuap90oJHJG7FR0MXDSYr8VaJmmYX8EHUQhjJ32hzKxyLl1QkRYjYpqX0HWeff8xHP/hXfPjDP6Y5P6GbX+KsYXtzg93dXbrgWTU1PiSi1pKbIEQtaKVnLSAqeRelDlOWZ2S5eOShHH6MEe+F60mt8x2LxRzjLJsbm0ynG2Izitdj2cBImhzdbE3TSnXgGBlPxozHY60wHPG+lez5TUsETa1T9cTVIParEDpVwTiMU45AY7jysuoJWzndICsr8qLEZYUQqUTUrHLREuwgpTkUwowmcxapVaWL6LBkrJYtn3/+mA8//Jhnz15wcTlnNJ6QFxV103J0fMrZxSUn5xdczmbYouDOvXu4ohDOFwhEVvWKo5dH2MyxubnFdDJVuDI0dU1b1yzmCy7OzhiVBVvTDTYmY0ZlQW4thECzWmKB6WTCrcN93nn3EZPpSAzvmvOxT5mWNr6Al7QeUahaVz+DqK/aWgq2tk1DvVpSL1c0qxW+Gcao2XVdQlXdriWj9a41SapL6klVy4p6S+BkTdRkbELU1kRKuhQJBQa21DTqa8Ra/2owv1E39KGt2WUZmZOA/Wgygs3IyzFlVQpT4ANd0zKdTBiNxsxncz765BNWbUdejTDViN3bd/jlX/t1/upv/ibZxgadNbTGYJxIu0RBGrION8TONMSERwbj799Rf0+QuDJhjTCq7p3PZ1xeXTIej9neFsKErm0QDxDRWlhx7Q8hslzVvHx5wk//4kPa1uOcZWNzg7t37zIejcAYqcSgqeCMsbTqFNK2ndi7WyVo3tO2QtQChi4gmYGiwIL3HVkmnstoDcW7d+9w5+4dxuPRANUKIZO4WnH3TBKcrE1/W//O+xPqCRqCp6lrlssFRVEwHo8oywKXqZYmKjylUkUIfJi192Nychj0f6O9Km19VdMZp29f9bv+ea8jaAk0voqk6ZXhmNPGGz7+tc9e97s+5L50t8NTGo/zS2KzoF1e0cwvWM7OWM3PaVcLom/7/HhG87jFKM4Owp1IZhCxyQknLB5oBoMk9MUHHAYTOuYX5zz+/DPauhZO3BhcljOeTHF53qcFMliRHFVeDDHV3xIVoejHNc2MivGgqaC8qCZj8mYMwv00Tc2qXpHlOVU1Is9z6csLQUsB3d7LZ6NxRF3rxbFE3f+LosA6J2PRfrvOg7EqYWkqryAeetYoo4DqefV9mqFa0RiR3LIcM4gdSsazmDwjBoZp60QHHxFkkbxWLWpz0fRjxlk2tjbY2t4ihMDl5QWL+VwIt3NMJhP2dnbY2dpmc7qBxXBy9JLTo5ecvjzm+PlzXj57ztnLE9rFkma+5OrklOPnLzh78ZLToyOuzs7oljWjsuDe4SGH+/tsb0wZFQWOiG8bfNtQFhn7ezu88fA+b7/9JhsbUzLNEoFyuxJAe30Dp7kP99M1NYXozDTOT2OxNB4raJFXq+uUtCIGfQekZ2h30GOkGNfSRU/0EqJZG98wRgiACiSKuJBdl9RG2ofqNda/1dvXJ4SooerKpE4TeBHY6D0jjaUoSwqFO3lWpKpKjDHMrq549vyFBNUXObYouHX3Dr/6a7/G1q0DYp7RGWjTmqgr/qvtOsVKr4K0jnpP+pwOUVjIHpWsPXB8fExRFownY/JcYXjgCZhajEKAQpByMFtb2xwe3sXajPl8weXlFfP5nIvLiz75uLUS6hC0en2S1oJ6LAuzm7wihUx4xRXyTCFMwuiI9qeqKu7eu8t4MhYHD2VahLFZNzNQrQ7XoF+oQUummxCkHtzV1SXL5RIQr+FkX0trkw5IqvJE1F7T+c02XNSvb+tXydf8TvbKa4jWNf3ojf00aELUhif0y+vOXWsyvjRKWaD1FYAsdmTdEpaXzM6POXv5lJfPvuTk6AknR0+5PD+hWS5ExaQbKYTQO3OIqkKM78YqQIeodY0FGZsINgpRzK2hXix48sUXrJYLjEp6WMN4MqUcjSULt3ogOiOqC2IiNimIeu1eHxVYe0KinFji+EIUDj6pH5qmpdKgYoPB99n7Rf0QFOBDUE5Ky4B477FOUkAlL0FZC5EKvA9Y6yiLAmuF4In6LMGGSFfDZt2aaIHBOEdWlFr3SpGXsZLy1CTvHQ2Wj2JfSfYcwX6JmdDK0iHIIjpxBa/GFbcO9plOJ5yennB+cipu9j7gsIyKkul4ws7mNocHBzy4c497t+9we/+AWzviaHK4t8+9g0Pu7B9wZ++Auwe3eHD7Dvdv3+b2/j57W9tsTiYU1mJCILQ19WpJs1pS5BlvPLzPO2+/xf37d5lMRyI9KYIU1V5a62Q3Q9ZHgLiH3uTtRjRCXNQttOukZloKMPZdR/TJezL5wOq+UKQhCOw1+0gRnFXmQ6TgNVEbtnUIxvp8z1mDSNsJaV//6bWtLCeU2VGiFlIgOOuQFYEpi8ly8qKStHBOAq+dk8TYTdNwenrK6fk55agiL0smW1s8+tZ7/LW/8etQFnhnCdbSWfEWlhi+m2MaDlhVaPpeBL8pntPbknZIQi4MpHhUA3Vd8/zFM3a2txmNKmIUlT1Jwh2YYmKMvZ0qIrUCrck4PNzn8PAOzjm+fPKETz/9lOVqpdKsSM9t00pmlF5bI7DT4w4vSQgCoqqPcbjOCd+JvX9ra4vDw0MZR++BnSR1tacpfkpgsIZUXof9pXqFpvpqNF9q2zRiftESNEUhVSyUgkpfRkJQQoy4/+wf/KPvyQK/+gAAVUa8Atdf3a7f+LrffRWhA/nBzauvfE8Qoy3KSUiqASPYIM0qFdlcb1y9ouMQ7bGo8zI6cr/g6sVjzp5+ztnLJ8zPj+mWV9SzM2ZnLzl78Yynjz/l8SefkAH72zuU0w1y62jbFpfJG/RagVrWz4gbvhKVxE2HECjyjFFVErzniy+/IPhA04rH4Gg8ZTKZEkKkbbV8TJTS8Kgdw/t1EuGUeSMi6k+XCVHrggRaJqCLKq11bceqaei8ZzyZkGW5OJ5ozaROs5MkIpY4Y+Hc5LzTnJK5clFBDbqt1ivLXEZRCoccvNqEFJmmJiAo78WotyZpM9uMspK8i5I9XIhawiJGXiIG4d7Fo09DGdANp+VbDOCDEH7hCuWac5a93V0ePrjPzs4Os6srfvLjH/Ps6RNC14o611mKLJOSIJljVBZMRxWbkzFbkwnT0YjNyYQtjTEbFQWWgI0BgqdrVtTLOSfHR8yvLhiVJe++8xZ/5Zd+kTcePmB3Z4uyyDEmatHOZFsQZJHl4miTCElCdmkVZXuLnY2EQBW+Q9cS2oauUVf+tl3fkzxKZQX1fShhS/tqoG1LxCsRtXRf0gIM6ZpRxCtTEVUR8paFoKXR695NOxKEERnOAqOwgcCfhLXo+J247UdriEZTmhWqPcgyfIzkZYHLCy6uZhwdn7BqO8rxhNp73nzvPf7qb/wGu/fvSwHQLKNDirYWWY6NMuaI4tEB0KU5yXxl78uIr0to/doiMWNO7d2LxZLPP/+M8/Nz9vf3mG5s9KVg0LVPRBvde+t3L71LBQtR/25sbPDozTd58803aLuWjz/6iA8//JC6rrHWkeeyLlhHXbesarF7dyHQ+UjbRZrOiy4oSjhA1NyxAiGRqiy4detA7XeqWlQGrLe7RSGcIfo+uUG/AP23AbCo2jHLhPldLubM5nOKIsNoxpS2abHGMBqNdH0EbkVDhuDff/AP/9H3+ofpS7MpHYuqJdfvcACQP6sNJKBXzt88l9prrsmmunHIrdfO9UxpYm+1LxvlyKLBBsnRhzr7RAtZJlKPo6UwLba5Yv7yC04+/xCzvCCno7SBPLSYbknW1eTRk/uWbjHn8ccfUxjYmkzIqxHei7rNI5kH0Ez5RjlfEZE107S15IXUNnJZTlmNODk+4ez0jOVyRegCddOyt7ePdTnBQ+iEzUiYw6dK1F687bxvJS2S1SSnDoSvExVWp665aF7I1UoAuhqNqUYj0LyQyYbmvcS7dOoxZawkiO2RFaiXpmTcEG8rz2q5pNGUQ1VZkmcZXddBr04RDlBhXyDMiGoDRZxGc2caY8iLEmsdmdZjs8p5x6AOE0TijXirRBBk40SIssFQDjnqZjVRXd29Z1SV7G5vc+fObR4+fMDOzhbnZ6d89tknPPnyc+azC5p6SbOa0zZLQie1yYLvCKEjdA1Ns2K1nLOYXzGfXXJxfsrxyxecvHxB7gwP79/l537ufb7z7fd54+ED9vd2KMtCkYBm4te5COIWu1EiGFG5d2Eu1olpjTozyZwGzI/vaFYLutWKZlWLc4h64JoB84dRO1raQ7rR0vvSJZVng3pI6upqoG9QBiKNtUfM8vN1HwrDUaUOcYIa4JdBZXeR5qzkG0WYw6A5QE1KLu0c0Tmis2AdLivI8xKbS+miNkby0ZhgDM+PTzg6OcUVJfOm5Y133uWv/o3f4P1f+C6uKvvin8IoypqKxKlETRcrIkQNhUAUVuW9qTokSaWDBRSbt+R5NFiOXh7zwz/5E95771s0TcP52RnL1UrusVbhV9bNa3gNuua+E5u6LKqkwQKRwAE2phNuaZWJxWLJT3/6IR9//ClXV3PyomI83SDLJXSh6QKtDwSs1kB0EjaUZpgKmRrDdDrhjTcf4pwFIwyjbmEdq9rVWMMQg3c7ZASG0BGiaABWqyXz2RVtKx7ZxshvfddpeSk5aY2sIxgWywWzqyvcf/qf/sPvWbtWi4FwQ7puot6JwtLJuF4lPK9tOoib515ztm9p4j/rHOhC9Z8F0IL2H3UTJgktiwYXRN2XVAFB748RbOzITUfWzWkuXnD+5FPM/Jyp9VQOMjy2W0GzJNZzTLMi9w1ZCCwuLzg/OSFEw9bWLqONTamDZoSoBWPovIjNiaslRIIafU3KvpTljEZjNqYbrBYrlssVs9mc45MTNje3NaGpw7eBtm56g2pM6a00Bir4TpCepADGZVbTOAW64GlTTIqPGnAp+SbL0YiskAS83gdRPWB006ihuncAUDudIq9MkxbLfhbkVq/Enpayi1grnpNChNYvThwEdF3SEaUfIWryXGczSeOjJel1efsYKx2QIHeAhPilM0gJkaMGfCvBkPtNQlfkeUZZ5Iyqko2NKQcHexzc2uPWrX3297fZ3JBK1c5EfFdTL+csZlfU9ZLlfM5yOaNtlhADRe6Yjkfs7mxy5/CAhw/v8e47b/HuO2/z8MF99vd2GY1KSTyMEtbk2Zj+DgjzEBHIqDWAfWCEt4h3nSSIks+Ejma5xGtcmu+63mtSJBDdm4l4pY2V9uvgZEwIm7UjSbq2ltTS2qsqWSBVx6+dD+xuCV4xayZGNnXCS6qOVgYbZXhM1DGr8To4i7dC1CQN1liqlWMgc5STCS/Ozvjs8ZdC1MoRb7zzLr/+N/9d3v/ud5nu7OKNkQPp26bYN4SAraFLx9jbAqVZ6zAKvzFKLKn8NOEr+WSMhMBczWa8fHmMD4F3332Hq8tLvvjyS14eHWGtkdgvzTWZbIgCt+ldiK01Bq1kEUWql0z9EavVIsqyYjQas7mxyWg0pm46nr044tPPPufFy2MWyxqPqPrBYXCShB1NiqDTtdYwnY45uLXP3v6u4KGh113fEkSic37dLQLXw+9RfQHq1ZLFfN4zeWnNfAhi1lBiHtVMMpvNWMwX1E2D+0/+4//se8n4pqCqLy991gFdezHfoH0FUXvl3KC9joC97hwoMPef5Y9VIMck70ZZyrSg0UgtNG8gWOgQRJjhyY2nnV9x/uIZp8+eUDnDKJdciyDIs2sbmqYWe0SMkl/OOo5OzrlctWSTDQ7u3KPB4I3rCSfK6QlBE9izyvWsZxcpMsfO3i5VWZBXJbbI8M5wcPcO5cYEb2DZ1Ky6JdF4sEGeEYNkA9Hkpd6nbPaGLCuIQSQ670EEFYPvxLPRd8I1StodibHyPtm9NK7OS9xL2uDWSFbuhFCd1nOTdRIpr2lqguarzDLJ0t95tc8pk5SIvE1sJQmfD5GjSHRRPR1ThogEF0E5ySS9JELbE4K+H0EyIeU+TAREYUwcDOQ9RGR8LnNsbGxw995dHjx8wL27d9nf3+Pg1gF7+7tsbm0ynU6YbEzY2Nxkujlla2uD3b0dDm/d4s7d29y7e4cHDx/w1qM3eevtR9y7d4+9vV3G45FImhrvKDtODvE4SwhKj/66NJNGGhQRJPV62q96awyB0HWSHPpaBpF+q/f/Gek0XVqvjTIaci2tbdpqaXelIa+vozCTxqo93vhLPy9RgYrK2KgtUAY50KVqXCMIYVt3J4RPCK2UlqmqMWQZ3hhMnrOxuyvSnLVMtrZ59K1v8Wt/8zf5hV/5FbYPb+GdxRtDayLRSRD90CtTR3O9KR+WLogji4yzN0qtb1XkLEeeOZ4/e87JyQmPHr3J7u4ubdvy8uVLLi4u2NraYntLXPsN6hgh9EzWWBlPYTjls8DEGr6TacJax3g8YW9P8jhiDFezmVZ4r5kvpIr6xeUli/kC33kuL6/Etkwgy6Xqg3OGvf09bt++RVHk/btTEBq0hJ+HGH+9FnJlDVPpu8wrslxK2InsAXRmCmQauyfxth1107BYLGjblhgj5pNPnsTJdEO91lDOQx4R9W1JfIxyvd+0vY6Ave5cal9x7RsRtUELWkVZetMyJQFcjIDo3Lsgudy8gcx4SttSxoarZ495/vEHXD7/gsOtMZuFI8sl71/XrphfXTCfXaoKp2XZRtqYc3Sx5KJz7D58l7/xv/0PGO/fJpQjITjOkOeO0EntGReNVCHWvIiwRrhZCIzyHNqW5cUZxy+ec/ryBaMyZ3F1ybPHX3D05Zd0s0tcuyALDTZGQteyWsxolku6ekXXrjDRU40qxpMxESmZEXqEI2J820qy5LzIGU1GuNwRg4QgECNmQIis5jJMxMsHyaxPhLyQoGtrrdi0fMdqtSLGSFlIeQrnHK3a7tDS9XlRKFFTNZba+ZDXK0TUGqJ1ZOWY8eYmm9s7YnMopBCmuJiqx5u6ndATqbXaY72hhEAkGLea5dwmN/EuxQ6J7aZpPUUu9sDkLZaKJ66WEojadZI7Lw4QlozdXnsmMWrMkWRRiVFsCF3X6g7Xzdq2Ci/q3RqSAnmw/XvgF+QljJLINVErNATtq61rlldXtPVK3oEyZSbtOJXQesQpmAaj+89q6iJ5P8ltf/2OEmGT+ch4orpaZ5mkeluPV+5bo5I0Ly1XZJzWoEuplSUPK9aIP1CUoqcEsR2KAkHCQMhzyHNsVjGd7lBNNqHI6SyQ57z97W9xcPuOevXB7bv3ODi8Dc7RGSNOIQYaH8jKXPZ9JzYlIbX9kBGFsLyK9ftNjg6iPl5rAhLBlvU2iDt8CIEf/fhHXFyc8zd/8zcxVpL5fv74c87OTnnw4AGbm5t9Gqyk3rXGqRlBKJw4cggBS+ufsoUkgd/7KHZ6LzkuQ4S67ZgvlpxdXPDJp5/yxRdfcjWbU5UjdjZ3qVc1zll2dre5d+82o1HJaFzy4MF97ty9TYwSN3Z9b63XaLBAMoj1SWW6FBCGP4qRrmu4vLhgdnXVayP6tUeZL21WGWqreMkA7nd+5//4vVwRUn+2X3r5Iwb9oZD9M5q+wJ95LrWvIGjwzYiauaZGMaquSFfW96TN0QVx4ogGcgd59FjfcPb8KcdffkGsF5Q2kNFpf4KAmq6jCxGPpQ2w9NCZnNbk1CZnESzLLnD7wRuUozFOy49bk2wEllxLe1hj5GX1aY7WHmUhBorRiK3DW9x++JC9B/c5OLzFvF7y/OiI1WrBajknduIRFBW4fSeVqbtWyrgHH/s0W4lpVI2WSEtRa6zlIv2gAY5evRzF8SSFB0iqqWQPDBofFzXDvVXHBa+/Edd/SXGTEFvbidQX1MVYNqu2IUJUwivrHvF6JCcJiVMS6aaXsBTRJC8s6VI2TRxIa0Ik1jaqHjhAQxbUexSxIYTkeajSVMrgEaPov/LMUVYFk+mE6XTCaFxRFrk6AVgtELuO2xuuW9JqBQ3HSMRA/q5Vj2ns11GHutQjEo1JiDOqdKZVzdu2pV2tqFcrTWCspXF04mnPJGIsDNYQ0az3YIyyZrJugxv6dyWnEwGMSmgTwk99pa05PE9SMSkzgSqdhEGVLd0zKSptR7XzxohWvxbbdJaXVKMNos1E4ioLxpub/PXf/E3eeOcdbr3xkMN795hsb0NZ0EaoY5DsIYArc3yIhKQiVa3PGpvcaEqzDf0igarHzdAharB2eZ7z+PFjLi8u2d7e5vD2ocI+7OzscPfePcbjCVVViafm6Rl13TAajcU8BLRtR9M2xMQsDQr/RsW3bSexaMnL2YfAaiWpr+pGvAqrasS9e/d46+23ePjGG2xvbXN1eclkPKYalYzHI/b2d/G+4/D2LQ4ODqhGpU7+Ohykf+vFSrBx3c1fAOU6TTGq6lzMFywWElpjjew1o08yA3h0g6TaueIYY8D99m//ve8VRSliszHqSi0AlKAveYl95Uulf9o1YnOtfdV5ElDcuGrWg39tu0nUlLChyYT7CzqN5EgSSGVlxCaQEbChI4+e8xfPOH76BbFZkIWaXBSU4ipuHdFlNNHQBEtDhs9GFBu7ZNMd3GQHygmLNvD86CWt75iMSjbGFURJDmqtk6rPMRC9ZIjoM6o7cZM1RsrP4xw+QheDnM8cTdcxW8w5PXlJqGtCUwOGzOUQoV41tI0EVYqjh1axVUKQVBVJvWdSMUhN/iuelBLnlhCtbEIhJlmWY5I1E+LTAAD/9ElEQVTqsU+dpchU11y4RDmMVoSWUiuSncBrwVJrRS3pdSOLg4ki74g6IWifOtb0MkXFKSrRZLgeIlJpilxYI+IYU7CmEkv1EkWVG957gsYOCYK/jryjco0JgcQkSWnAe9e1tG1D14k0FqMnqETrfSeB8yaFQqSgdvFWTevt07oPpB2ZW5qHwLMMS+Z0TV0ZJCat6zp829G1HV3T0NaiNg9qj5Glvb6/jK5LUl0abu7B9TpeR2asN9uAqMmDBnckOLn+WJ2KUelYjojgkrRfoxVkabXSQfCBoA5MMWosY17i8gKXVdh8RDAZqxAoJmPe+c53eOtb72GrigB0MdJG8W5sEXUjzokGR1RWwwCc60OWhbk5jf77+n5dIwE4PdLHyE9/+lNcnvHwjTfIi4JVXevta+as816cs6yjrmuOjl4ym88BqcmWuUyD0EWlnMwPaCxpsolL9hDJKJL2uddMIU3bsqprvA8sl0tePH/B9tYWd27fZndvh8lkTJY5irLgzp3bbGxOsVZhRQn3zcUQApMu6vyvXX/9X2sMF+cXEpuW1gz1ztW+opodjNZrTAKZ2G+VqEnNquRCKq9kCMwJadx8iZBesHx4zdykvY5opTb47deeu9kGQGUjOPVylBxtalTWGxIRC+qdR8+ZRhwB5ztyAlcvjzh59gS/uCQLK0obRFQ3lg4rtjJbYKoJ+WSbfGOHkE/w+QifjWhNznzVcH55yYsXz/FNzXQsaaeSx6EJ4o1GDBgrG1/MBzLILor9yBtLC7Qh0BHBOWzm6Lzn9OVL6qsrYtP0XmK+kxpZyVYmqa20enWWS0mXQYZuAUghVmm9g19nJ5H70j0S75ZlmRCD4MXNN0rGAGOU8VGEJlKHAKPTpLJR6z7JhhMAdJkEg0b14AtBHFQMigB7fCB9wdqZoutEf54rI7BGtmukKgRrjUQSMYd1jA8y9X5eUSWgiKph1Ws06t8QJV4sBC8ee1r5XOwYHh+klEtE7mk7IXI+SPqyGKSPGLTfnkDI/MWGuQ79SPNaz0lmmA6zniBR3a/bpqGpJeN6Wzd0jRzBe/XIW68vfZ8KBop45b81eqZXGyavtvXaMtjf8lNd+9Sx/Hywp4f/y48S/BvWDFgkMaPrZOEGI+us4S0hADbDZSVZXuKKEptVGFcSbIYbVRzcv8d3fvmX2NjfoyHSQW8/81acuoKxih9kZJIvVcaWiPywrVfl+rFWM66ZjJjsvDrDGCNnZ2e8fHnE5uYWt2/fxjknkokGlyfnLtmDoiERTYWj7TyXF5diD1vVazW9wkoIyeYkOED2llbLUHtb13V9EdtWTRG+8+K4cnTEndt3mGgQuMss1ln29/c5PLylUprkUl3P6muI22vWClSNqHQvvf0YvGT9b2rFKWscJBtT5iOELF2TWOEkEbvf/u2//z3h1sVVOpFe2fSAZhmPN0TFvvUv8avbkEC+0l5H8F537mYbEDWTtBPIBlgTtDVXKMoMaeK0IUjBaXxabiLzizMujl+yvDoXb0gL3ma9ijHmY/LNXcY7txjtHGDHWyy8pSanjo46GGq1rxwfv+Ty/AwbOnZ2tqlGY1GwBK/JiNMLNb2RO0TElVZzFAquMvLyMBQuI7cZcdlw9PkXmMZDgNBpLFkX6FoB1pQax1hDpt6HkUCnkkPQfGwCJ7IWQ+lMiJaqCV1GlomHY4ziRjyU0jCD7BMI4CUCYrXyNSCellrTyVqHNZI9XTKiiGowvS15mQmpy9mEIGTDClErcp1bUs8lBKRzkjVUpKL2oBiHXnmKPPsxSxciOUpml5gynWvV4DXhVk/KJKGqKjhEUbNKRhZR+Xl1qkmIKvaEKCEiXQNFQgKe6+u6GPpXpmjT+pO8HCWdVr2SFFhNXdM2tcQLdsJIxaTm09+l8TNQ8fTP6PeOfrg2lvQb6S/dlZB2r8bUHk2CEQF6nZ/2icC5MKN6KBGNvWZFkWDy9lWiFjHYvCArKmxRYvMSXEHMCrx1bB8e8vb77/PGO2/jqpI2CnMrKjx5hjGapUThzVlHZsAGMCoEp/36dc0k3KJQlWAu7Sn0ffng+fTTTzHWsb+/z+bWJuhy2CzFog3gUTUXWZZTjcYQoyQXXtWsVitWq6Vm9pGYTmut4IG2VXubMkwh0GrNxJT+LoXqxCgB4LO5lOK5dbDf41SroUcPHtxnc3MqKQO1gnhUuFlTAXlP8knP93AkcGCMUdVsulcREdDUNZeXl3ReC46m+pSJydX5ZOrUBqKytFbjVhNRA1ET5bkYR5ORXcFNkcZriJq+6VfO32j/3yRqMm4lyLKK6NYAfUG9+TBGMiOJgTMi3WrJ4uqS+cUpufFYE2jIaE0B5YTRzi22bj9g89Zd8ukujcm5aiLL6Ki9pQ7ycoJm0L86O+H06DnWOe7cu4/LM5wxUk3YqLHZiS1AwijE9wuMeqerhOQygpdkyKOiYneyyac/+YCwqPGtJ3QiMbVNR1PXwu1HT902BCJZkWGcEU87VX1FTQ4qjofCWQe/RrRB1VS5BjxnLsNZ10tzUVUXglQToEo1gKgZUYLmmhOiZmiappfgklaAvsKBSicK4GL7E0eApIrpVX6a/SCGSFFIde4eOStCWONM5VR7KUn6EmlAEMYagdxAQgpgibNNKkT5ndyTAuxFwpK/a2Km3p7pUE45zSc9d53aTOfQE4418QMhFDLH9EfjHvV3MQS6VrIw1KslTVPTtq0GWms/UfajFW5GTw9VkrIeqZnEeF0bx4DAJlSmfRrW3LTcJ/0IYhKV8k18EGMyC4iUZowgqCiIQO7RHJMxaGxW6wVeTYYrKrJyhCsqYpYTbE5wBaYY8ei9d3n/uz/PaGuLmEmWkJiyZSCCq+2zX8gJh+3jW03QAfb5RdctzUN2wPUjvb/0DuMA+Xdtx49+/GMOb9/m1uEheZ7TeakKL33KvCOaOEAeprZk0U5sbGwyHk/ovOfo6AXz+ZyoTCgm7b+kHg9qIxRYq5tWEzEIs6aj5Wo2Y7Vasbu7S1kUxBCwFoo8YzIe8fDhffJMiIkQI9mbw5bmeLOl925ILlhynxlcIwZmsxnL5YIYJZm8UaI4fIqspWL0KGtjjWoSkg0zcZgJ1sS5oYcn6F/U9ZYG9a/d0ib4X6BFVFXBq4NNgGYQQuaMIbNrTiNGkfBGkymbu3uYckRNRmMrWjeiy0ZQbVJsHVBu7pNPdyk2dhht71NubENeErMcmxfYTFS5ZVkynUy5vLjkv/8n/4Sjp18SmhWFhTIX6UWA1NB56IIAcfJWQmPqkvu/IQMy8mLC7u37/Opf/w2q6TarDjpygslpg8HmFdFY2s7jXNarE0EA0aaKyU4COyVDRzZAQrJSScNkFHH2IQmxdzFUgFMOKR2Dc94nKUw3WG/PkzkGf/2zbEK1C4VA162lwq4T9YjXis1t3fTJgru6oWtFGonev3JIYPraVuU7T103dI3YnNpG+o46Zt8J4bE2E3WepgtLsNK2LXUjFQiaumG1lGTByTGj06oGqHrXJoSsq5aQnKyHIB2iSK+SsFfWWVR4rx4SVC0IOCQvu0RUtSRO+jsMSO8xwzU8pNi9J6Dr7dNvozj4Qd/HmrjFgR3uZkt9DrvgWt/rc72Pp0qU/XyJWH1G1PUSxgOwUt3BOEdUU0EDLL1n/94dHr7zDru3bxOso+4idRfoglBway15pnFlnaxnZhyxC/g2EDuJ9XODkJObLa1rkjyjMi39vrGiujOKdGNU2NYMPnme03YdxohNu+uDq4WACT7JiFEcrTrve3WsdRk7u7t85zs/z8M33uTs7Iwf/umf8pOffEDXdX2GIBTmxKamDIjGm/bExhjqWpigzc0NvO/6SurJA3I8zpAqMCkOTpmem4uCEqrh9/5YP69nmAaMTl3XGIzkxtV7UTgawqfsZSXaqjUSU4TB/f2/9x9/L6jXnZRuEBd2uVkgTrqVh6cjPewbNSP/XfvFjUm/0vTiV941vJ4WR7m95CiSFjzJbgbhxBMQRsFi4mKPFOmDyNXVJZezGW20tNkYqk3cZJvWlJhygivHuHIkBMQ66lY4nxAhKDIR25kXZBM8z58/ZWdrk+3NTTIr1WEDBqzr86wlHb6olWRuMURCEAJijYNosT6wu7lFCJGLqyvOLy/BSgqqtm1om5rgO0EGJlIUmVSj1qDloGUbrBXgsdbSdUF4KGU0BBkL1xejcGRJyhDCOyRSiTiparD1NJoBPG0gjNjs0m8w4nlJhNWqVilOYt6SZuD6oUxXTAlZW6J61xlNnZSAO7UYhcu1VuwRgicFGTonm13UvMn2ofNQ6bFrO7pOimpKqrCEhAfqIf1N13m5L0liXlWWXn6f+k/2sv5Zg78hZZ1X4iuchcBwGqPAs8EkJ4C2k0DtEKXw52rFcr5gtVrSadJiAxrMnQjFYM5KVQw6N32XPSG68R7kpJyHhCAHcJL2VbpmxB7SI6deLbdWB4uKTBIUSKFPiBqOYDQbvDhFWELn1T4oiB9jyUrZh521dNYS84K9u3f5pb/+17nz6E1x6zdAZunURuOseopKAg7ZD0mSUFWpNXoP6mTW4xyZY1ozPd03p5UVRFUNnSYVNsZwNbvik08+UfvUIWUllSuMEftz1HUbInurNfqE2In2JoQgjhKq2rfOsrm5xe7uLtY6vvzyCZ9//hiAPCsGyYzFwYqkIfHiN3B1dUXXeSbjCZOx2NKyzFHkOVvbW9y/f08lStFQmLXTMXwFYbvWUlq1nnYoA5tUo52nrmsuLy7Ulk2vXdOn6Ln035pwGmvJkyd1jLjf/d2//72oC5RnOXkhKsgeMNO/1MG6z79cu0m5vyFR/Nr7kni6/tLHqA1u0ewKihCS6Kwb10Sp64XWCjJOXPe/ePqclgw73sZNtuhsRWMyghOdvc1LsrwAa1nVUu+sbTu6tqHIJI0TXYdvGpbzGV8+/oxRmbG3vcPW1qYU4AOCcf2mAeEYZcy61olAC70lRjDRUoxGjMqS5arm5OyM2WwmCCN4gm+JvgUCMXoyZyiLjLLIcDalGfI9dy1ERhDEEG/Js+X5scdjitATIRts6hilL5GsxM6XNp4xmqnECxJLmziEKBWYUyFRvVcIhti2hshUCIYwXCYRLB1BUp/2Y+l/m5DtWsVpjcRlJiIjEmK6TwmQSkJrQqTdx+vqnRgknKInVj0BU0lsQPyDl35IQeY9UVtzn0SREBiozUHThlkrdc8ikuZLD9+1dHUtddKWS7q2heToQ6I4qaf11/TujC5a7G/4iqMfjRLcm/szMpCy6BHz+r4E6LrOUQmrRZxuYhQvZiKEQGYdeZbhnJQQatuWelUTUjJxl2FcRswyvHXUPlADv/63/zaPvv1tRjubeGfozDqkJwV2G9YELY1seCQVZCJovfpRYSztn3S/DFkkG6I4bgksSRICA5yfn/P548e8961vMd2YClFSj86Xx8c8e/aMZ8+e8/z5C549e87jx1/w2eef6/GYzz/7nI8+/pgPPvgLmrZha2sL5zK6zpO5jDwvhAHIxFywXK44O7vg4vySumkEflwm2hRjRFsUAs+fv8Bay+7OrjKWYIiMJyP29nbZ2dkmRjAmwYiE2KxX4KvbOhfpEA7W795oLszlcslCE8XzSq/KROj5iHivgxA1kUjlvPud3/n730uqkizLKMtSfpYQWhLO+u7+NdtridrPPr72PpUqpMMhQVsTYL0kklpUzseoGi1x+krEjYOsyMjyghcvj+mCwVRTbDVlFSxdzOhMhrEZNsvJMgke7rpWVD5NTT2/oplfcXn8gsuXz1mcvaRZXLC8OmU1O2dnc4N7tyWTtoQKSLZ5zxppmLimalFLgHndSyLkRPLMUE1GZGVOFzpOz0+5uroUYEnELYp7t+m9EPPe/V9cfxO3bnAuJ6ISuhIefVFgTF9OJBGLhKRjXK+7EAQ5fE+8lJs0ku3cB+FejXKgXr31vMa1SdJUddseOHig7yiqylKhukeOvSOHcpIJsQoBXtuxpFlMVLtdEOKLEpcEF+kQQpzmK+eEOA3UYF7VgKkfJexCpOS6jF3VU0o0E6GUZwsSR4m1SBJKGNLfXpoQxsRr4cekjq1XK+rlShI6q4Qm3LHCdz//6y3tE5D7+vOvv31NtNY7Ufro718zE8O9mHarYb3/5D2K6iR4kTolvZ3cmec5WZ4DlqaROmB10yKCmoMsJziHtxZblkx2drj36BG//rf/NtO9PWLm8EqQAmtESAiaMHk9/zR8HbY0/W0ibMM1GdwyOCQ1Vc84opJEnrNcLDk9PaVpW95+5+2+egAxcnp6xj/+x/+Y589fUGsR19nVjKurGbMrSQG1Wi5ZLBaslivmczkXvGd7e4fgJQVejJHMSQmpoqxo227gVFJjjGU2XzKbzWlq8ba8uLzk/PyC8XjM1va2anlEM7K7s83hrQOxsWnOShOjaE5ewbNJk5DODQhR+iA3ylVVLQvD65nNZrRNcw22bvykb5E1QyVETdL0Abjf+a3f/V5QDs06SZfU209A3+LN4f9rtFeImnpr/Iz2Cic4bH2fvZ5RpI01qZP9ki4NZpIQhVUgj0SMs7iyoBqP6QLMljV1cHhX0sSMJjqizZWg5b2uPHQdvq2ZX15w9OQxL774nGeff8LJsy9oZ+dMC8fGKOPs5TNGZcGdw9tsbG5hslzsABHJuwa9E4vs90i0hmDE2tBLEyYSXcSVklZre2+HxWLOZ599RttKdncTJTtB6LlFITBFLkGT4kGoaa4y4XaDuoSLHU7eu1B8IVhCaNKRnC4G41VcF3pJJjmTCKHyqmqIUWwawhB4KYWSXP1typ6Q1JtCGASRyzyICj86phRcKodk6I+KWIMS0ZjG2v9WiFoiTqnfvum9kornugebSGH6u5S9o1VJLa4lSbmWpLF0TRkBVeGm8/3iKfFxNpXWkHGs71E1bydFFNtGbIvJ47FtJBtJT8Ci/hdF7c7P2MVpjrJHbl5NTcZ8DSNc86KQscZ+713f++mWfs4EYpCE0A51pEKkiKIUjUgIkcWyFieHIKr7gBW1o7EE69i5dYvv/uqv8Lf+7t9l5/ZtOmdpY8DbCNbihXUUfvF1Y1PCx0AqS3b63l4/mPPwr9EPzrqeoNF7Dzuss7x48YLTszMePnzA9va2ED0jDlQffvgh//V//X+lLEoevfmIB/cfsrOzw+HhIffv3uX+/fvcv3ePB/fv88477/DOO+9wfHzMhx9+yNbWFpPJRu/53HWe5bKmaVs2pptsb+9SVhWLxYqm8b0kOF8ssNbx5OlTxqMxW5qSy/sOYwJVkXH78JBbB/u9+n/4zqNqvWTq6V2um8DQABtHOalvF5Qw0ns9XvS2Ovm9XFv/vz4iX0PUfus/+p3v9Z0oR5EX+XXK2j/gxsm/THuFqF0f5FcdX3ufLlAEhVKjIZP6pGuAu96sxqRNKP0ngpa4MZvlTKebLJY1s7pj1UG0BdFm2KwQET/LyCzkFnyz5NkXn/HH//M/55//3v+D3UnBO/cP+cX3HvHd9x7x8M4+O9OK7UklSWXrhjfefFOKfxoj5nFryZyRirgR4YZNxDqDzcQu4Qw4Z7A2EkKLzST4eDKu2N/f58WLFxy9OGK+WBB8YNW04BxNF/ABjXXLJeN/jFp7S4iNtepenxDtAOfIefXgi4qMVXKJxIG5JhGS9YHa54xN3Kv0nQBS7FbrqrwpgFIIuD5TbWU9QUMQHigRTl6H6sYsT5B1DCl8YtCMsaIy1N8FlfC4JkFpv51cS+uCzn9NDNcqwJgksxuELKQFSmuSjHMx2bp0sEmailGy6/eEVv6m53m1KzWrmsV8RrNaqbNM20uCol6PYrPyYkccSq+vO15BSte/9i0i64PCyeCC9q9/r7OX+kn+H8JLCoMwoAyQJUaLsTl5MSaYjHnTcTFfUodIi8VkBdEVLLvIvOnYuX2Hv/Ybf5Nf/1t/i52794RBQ5IaGOUUvZdkCpKuV6RdO2Cuk0TWoxht6rfVt/WMbnxOKs0Y8a1I0ck+HEKUDCKXl3znOz+vOSrFueHq8pIPPviA3/yN32RnZ4d79+7z/vvvc+/uXTY2Ntjb32dzc5PJeMxoJNXlR6OKrc1NFvM5/6/f+z1+6Zd+GYxIs76TsJnlctW77hssk8mUqhpRVSOyXHLCruqap0+ecvf+fZHSotjhDYG93W0OD28xnVZ4L6FdIYTehd53Mr+b67Fel7Wkppt+8Fn2UeYswXsWiwVXV1dCOFV7du3zK32v+3s9UdPcbgZJ4lqWpcKnACa95NZ395dvX0nUvr59vaRGovmDHag685u9G70nnVT1l3EWH2VhgtZAS5vy+PiEs8s5q8aDErQYDaFtIHSMcsfy6pz/53//T/iz7/8hG6Xj7/zNX+MXv/UWt7dGTGxH3i1wfoWLLRme5WzO7OIcYuTO3bsSl9K/fhl7lAFgrEiSElMXsHhyApkNmNiRZ1Y2rW7Une0dQjRczudcXM0J1jHZ2qGcbGDygroLLJt27VGl3pdRJaOYVIPKAiS8KteS1JTUggkpKb5WJN7j70QEQL3AVNqLCtGa8aDTlFpRpWZn1cYY1ohYuhFClo7UEqIOWtk7EdugRnAhWjIOk+ApirOMECyRZkOQsh1BXe+D93peuO6k1pTB6fjSef2NGUpkawOdEib9nYhooJLOukM5DLLwQeciG9oQfaBrJEuIb8Xbs6lr5rMrcQhRqVtemBKK9E4TR63v42t2FHyD6/QSsE4sTTG5VSe8sb69v0kuv0pQTVKr4ojRgS0weYU3GfMucrFqmbUBn5XYakJrMmE284qtgzu8+53v8vCd95js7OMyKUjrfYdB4CoqMFtjMEHyR65jypSx1ImLUkwXIo15sCivoBKdqlEmK2hYR1BHqaIoePr0GYv5nN29Pe7evaM2clnHp0+e8sff/2P+zt/5O2xsbHJycsL52TkPHj7Ae89qtWK5XNJ5L4kMguR1dJqIPAKffPoZ29u7jEcj1cAIvwSW4Nf7rOtkX42qEWVZsVqtyLKcg4MD8rzA+0DmLFXhuHf3kK3tLXFQ0+QD6LuSd53e2zdrad8m2DAaLlbXDfPZFavVqvc0HfZp0n+DQ9CI3nuTqP32b/3u94ztySIGQ1GV2lOUV94ToG86/Ne0f4tETT4mB5DkYjHovZ/LwLjYV8tVd3rN4B/UWyvLHGdnZ5yez1jWHTYridFKQtDoccGzml3wP/3e/53F+Use3t7nF957xFt39plYj2tmsLrE1jPy2BLbJS4GTAjUiwXHJ8fs37rFZGOKcRldjGpHSGMWd8hE0Ez05CaQm0jmAsYEgm9YXl1xenLM6ekpddOBdZTVmOnWLnu3brN3+y6T7T1cIYGnUi8JrYmWuMiERMNA7zKUlpIEJ9LNGhklXKzfk/Smn0OP0MW9OT0rKmAL4UlpfbSop3J+157Rqxw1s0LvSKJSjtqMgk+IVj63baryPPBKRAYtlX813CFRYhQDy0Nl3oqk0u9BbGBJQuwlNP2LrlmS1np7mRK6GGSuw+fI+5Vxo3aGqPBgEeTh246mlnpoTVPT1pL6ajlfyrtLz0jSohfPQlk3eaE6el2hV4+vvTg4ImtJ7VrTdy8f5Z0JU5I+yz0CS2pbTETNWkK0RDKsK3HlGLKKVYBFB43JsaMpG/u3GO/sM97aZXPvFnt37nNw9wGb+4dQVsyajqvZjDLPKFzKVypMiFVckjwbRacj5yKq1kfTcgkXIPMy/X/91/4Y3qJMSWKujHqGGmP48Y9/jLWWhw8fitAQpTDtxcUFT58+pWs7fumXfpHJZMrJySmnp6fsbO8wqipl/joaVTUXRaHrFigKiVn76Ycfk2UF4/GEsqzEfV9nGELULEOipm8asaUtVzWffvoZ9+7fZzKZYq0FLM7B9taU27cPqKpK9ohsyn7isiTr9fsmbYjL0ydDZLFYMJvNRfJTyWzYXveEGOX58Dqi9tu/+z1rpR4R+hpzzdIgCIQbr/Ffs/1bJWpJzlF1R1ROfr1yPWuVuotKrI2FzutYjKR7MtZhbcaybjg+u+TsckaeF8qNdxS0LM6O+PEP/oDjLz7mu996k1/5zns8vLVD5lf45SVxNYNmie0abAz4psEQJBLee87Oz5ktFuzs7THZ2MBkmbi+9xKJjM8CDimPU8SAjR20De3sivn5GefHJ5y9POb87ILZfIGxOcV4ymhzm/H2NuXGJq6qCNZJnjsvsTD0EpAShE7SOMnaxF5CSxJXjEIQUtCm3Jdws1xf29hSfFqyQwlmjYp0g/6m06BjiaNbB8Gu+44qLUbo4+WSO/1ALamI0/fPE0mtbVtBBFpDLOVVTEhVpCyZjxEQVZBRe2HQ1FdK8GNCztcCrlVS04B0IVxJQkqIWwnNgOAJkYtiT4pC6NL3HpdGIehdK1lCFvMF9Upi89qmkeTVTbsmylGJ6GCsRlU4MQ5lpxtNNN39c39WE6K2tn0w2GrpdaPP6+cqP1wTuzTOkAiJIxiR0Gw+whQjWlNIxh6TEasJ1fYeo519iuk24609NnZvMd29RbW5TchKFl3kqu7ompbMe8JiRgyezDkyhR2DptVLtjudcy+J9fhmfS19H34aHjBYO7XDGiJZJqkHr66u+OKLL9ja2ubBgwe9VqDIcz777DOefPmEd995h8PDQ6qywncdl5dXHB0dcffOHcqiJMZIWzesVivKssRpQnRrDOPxhLppefnyGDBsbm5htMhpVGenrpN4TFH3CyN5fnHJs+fPefudd8QTWSUvayN37xyws7OBc04Z2YGTjTYrHkjXzn1l67Vq6z6slYrd8/mM5WKBGSZ/1vsGb2Pwe9VmfRVR+93f/nvfw8qPUjN9ItoU4S7dDl/sX7r9WydqqjToCwvK9TWwortX9xxAHGSVMPrSVGrtAri84PjskqOXpzjjIHRk0RPrGV9+9BP++F/8U/79v/Vr/OrPv8vetMA0c/LY4nyNCw1Z6MhCR/QtMXRYzY6eazaNP/vRj9je3WX/8JDxxpYSNSsZxzW7f2ajSGfRY5oVLK5oLi84evIlZy+PWFzOJL9fG2i6QN0F5k3HrPXUIbKKkZUPtD7Shkijqraukxgm4VpTpWWNGRpIZgKyqo7UBKuRxB3I4sZkA1OkFaOka0qEp4c/dSBB1YOtFg31SpyMxsxJp9pfFInHaAA4KpWJWnGdISQ9Swi2OpB0nqYVopYCqNtOEgibaKRStZfEAwJDMptEfCSOJyUcViksPa+3x6lKVtdPCF4iYkNiJshd1iNJdanPRISS9CPOJr4LNE1DrV5vi8WCpq7pOpmL78SGRiJKSTJECdxgh30dURtsjW/YZB79/dpx6och8Upz66+l8zqmqE4fJgNXYrKKaEvqmLEIlhUZvhhjJ5u4ySZdVtJlJTEria6kczne5Hib0+KgGLE9mbI6fcnxF49ZLVeUeS7p1NA4OB1H74yTppBgWmEVdF1NPzs5d+NYT1okqqAOUhJDFvnkk08pioLbtw/Z3NoiBklsHaPnJz/+MUdHL/n1X/s1qmqEMYbJeErbtPyrP/xDbt++w+bmBlmWq1ZDJPaUyNurR/HDh2/yySefcXFxSVlVTCdTmqYVxtFL4ue6aWjbjiIvmM0XnF9cMBpPODi4JXG2PmCsoSwdb7xxj6pU34qYJF3RtsC6YkYK7egX7CvaNeyvH51zLJcL5rM5Tduog6LgfPkr76RHNcPX87VE7Xf/njiKmLXxPcZIWVX9jSFGJRSDgf2lmowkUVlUSvom/X1zopZ6ExEaBkZfvRedm7GIbSyIDUjUfHJPVAnFWUOR53RdEAA4PaawEdM1PP7pj5ifPOM/+Nu/wbfevIepr/D1jMx6MuPJLMTQEbtO9PhWswM4eWmJyy2rivliSTWecuv2XUxeirSiwazGQEYU6Wx1RX3yjMsnH3H8xUcsT58TlzOscvZ109L4SBMMTYj4KKrU+WLZqxyjdfgQuZov6LqAMRJsbxCbQ4wRH9RzMepa9gsj9hLhQlWqNQbQKulRFjz9S1k5QhBkavsAXbk5BinHkgiIScGuStR6oqoEIUlxMdLbz3xSjUZB5KJmaXXMVr6rN1iyJ3gfiZ0gHd8lwhTVG0DoSlCCEtQBJAykCiNARAzq0j90EBkSvcFnnYicT3avdK4nltelrbYWR5DVcslqsWAxX9CsJHMJA4eS/rMSkQTqpmci1QYql17bZE43zw5b/4L7Iwb5awV1KEJJmUWSbVg8VhNnKW8pSW3r9fI4YlZBMSa4kjoYLlaeqzbS5SOoJoS8ZOUjrqjwOBpvCCanHG+AKwhY8iJjc2PMrY2SxcsnuNWMZrVgdnVJvarZmG5QFBWZE5uyywydN+oIotgSGT8k5Y7Cf38tSfWJCZIlMboyrZaCSWEUi8Wc7//x93n06BEHBwcEr9Xgs4znz55zdnbO9s4u77z7Lk0jsZpFXlBWFRj4/d//fe7eucvOzg4hBJbLFR9+9DEARSFOa9bmhGg5OLjD8ckJn336OXfu3cMku7WXJOdN3dLUDXlR8eLFEWdn57z11lsSXkQEAlVVcufOLe4cHgCyN5LmSPauvHCD5s/s4aZfjUFL5wRXyL1rO1yWOeazGYvFHN91vSe6stD628E6D1qM6wBDY0UIE3wUcb/zu39fXPqjDlb1wJl1wg1YcZ02Zq2BXh/X/0Ea+Hri/d36+/Q9cfTrwQ9aT6y+KVEbnkgZvdOcZaLpsLoDDUnVmAia3mfAEcmNwSF5z2LwHD3/EuNbZucvCfMLbm9OeP/RfdqrU2y3xLmAcwHrwGaCwEMwBG/oIrTR08UA0ZNbKZ6ZuZzL8ysWy5o8H7F75w4mF0bCoMlpry5gecny+Cn10aeEs89wy2Oy5SlZcynk22V0AZpo6XAqYazTJvmuo/ORLlgCji4Ylk2gbju6KPa1zIkrvdSag2icJHqN6ufcx09JfkeT3ml6ryot2GgxUcpbJBPU8E3I3IR7SJBg1EMyEa6+TxKOF/XJEFYET66dT2KUGLcsK/qwAO8lINt7caWnd+OX5M9t02kOwSDnUlovoexCTI0E0g69Gy3XPd1iCDI7Jfwk2qR2tV7l6UVNmSYmhDE5eCASdNvSrhq6WuugLZfUyxVtXRO10KwQQsm4n3aUdqp7OBEagWnZ2grzCS8NDvnlcB+u+9W3oExPUrOK+jpNVgvE6Dl5OTEYgofgU2+CiIK6uktMoXjpmXJMqMbUtmQZDIvOsIiW2hZ0WYnPtPhnXmBsBsZJeZlsTIhW4kaNYVzC9gS2XMvJZx8wsS2jsiBXT735fMXL43O1kwdwJdnI9oWFg4mSqiuIjVPgVCAxRJGuQKSWmJxvdH1AFqtpaowBZy1t03ByfMxsdsWD+/fZ3Jjq+gih+LM//3NCiLz56C02Njb7klERgeU8L/jRj3+CyzI2NjaZTDfxIbC/d8D2zp4GXQc6D2cXM+rGc3R0zIvnR8znc3Z2dzX7zpqxc65gPltyfnFJnuXcuXuPtmtx1pLnjs2NMXfv3KKqcrFICXLU+a1xZ5p2Yiivgc+1Jveafn/L/AFWqwVXV5danQDQzP+6SES1NSfUPOxSmF/ZhFariKCMhPut35Y4NaNZl42RdEtGa1455ZxNz7UP2jX/V5msPDsRlcG1fnH06Kl+um/QviFRk0s3+r3RlyBNvWKSXlgp3rWf9CPHxUgWIzYIV5XlFnzL2cvnnDz7kg0XeXN/l40cwvKKLDZY67FZwGWSiy5aK/kaY6alayJd7MgIFA7JlGBzfBc4Pbtkvmp5+OA+eVVSNyvOzk55/vwFL5885urFU/zFEdniOaPVM7LVCWV7Se7nUqbG5nQml1g6XO/c0HvRRfDR0kaHjw5PRhsMrQ80rRQPDF4cJqJ1krorGFUVGmxcZ6VIarckJQlcCWdugsV64Q6jWIdA331CsqZfeuHypY+195toC+SOMIh3C+pKbNLGQDaYSNsiWRojuWNCNH0OR+/DOvltAIIh+iilWeqGtm7XRyN5Gzv9m6QiSZO1tpkRgtjiBja52GsTRfrvpdSkEgwJqQvSTFJgTC76bUtTr1gtVzTLmnalRy22M99JSRti7AlbVHV2LyGSCE3aA2tpMUl2MYG6ItckSQp9Sr9f75v+5n6CgtCDEnJr1AVcEUoMgegNoTOEIL2EIBkjYvREAp1K6BiLdTkxr1hQcOUN8zay9LDC0dgCn1eQ58Qsx1hhsqQg6AiTTcA4tbUGtseG7bIjXL2gPXvGRh6pikLS0gXD54+f8uXTI16eXnIxX3G5XBJtDkWBcYJGxfqQAt+13rXRa+ppDNcJWmIeUgJrlHmez2Z8/vnnHB4eagBziUVg4/Jqxmeffc7m5jZvvPEIo5oFH5Ux0UTnRVHy5z/6MefnF+R5wfn5JVezOcfHp3z55VMeP/6CL758zmefP+XycsliseRqPuP4+JhHj94EA50GZvsuUlVjnj8/IoTI7u4+k/EY5yzGRiaTiv39HfZ2d8g0BrcnYf3na0hT0ebw3OuPpFrs91AMqlKf03WNqDGj2NetoU/DJb0rl6awDoLHxWygWXacOARBxP327/zu98RmoTncNJ7DGNFTZplkkBcf1PQYbdcIjj508PU6YbrxW6WyrxA0XvfbV9uaoP0lmiLVn9V0bQgBTObIy5JRVXL84jlPHn/OZlVw72AHXy/IrcfhMTZineQzdFYPk2FNJshXCYxB03Ip8cBmXM4XXM4WZEVOWZWcnJ7y5MkzvnzyjJfPn/Ly6RfQLhmxpAwLYrPABnEQaGJGG3NMNqKNGY0XF16lN+pkAQHJKJ9KsDtnIAbapma5nEvtLR8I1hFtQcBJ5V9N4xViIJhIF1pClMraiaMVu5zVt7FOjm0QZGrUOG8TgRtsjsSZDuEGBMFKJpDklSmxdNaJzVR+k+x/IlUJTh5KRylrvpS1iUF+E2MU+4I6kTSN1B5r6pqmbqhrrUWm+Si73nYmz5HkxUObmrpyJxticmLRDSyETT4nAtap80rQ+LrlQrNFLBY0Q2eQVqubq3SQVqonZEYD4dOzouyrNM+o64g6/PSEK0mYQ2IYE/GSdzZ8nlyTrwpS6/2kXiZBs8GLZ6k+V0uteN8SCETj6HB0NsdnY7pszMxnnNcdsyZSd5E2GLzJMHmByQutYrGWgo212KzAugJnwRlPTsfexDIxNedPv6DCUzmHzUqCyZnVHT/88U85OrtitmqZNR3LuqYNgbwoKPKcLNMUZAqbBlW7oZp49T0QGNY10TtjFMekJDWEELg4P+fp06d8+/33mUwmPexH4OjlEccnJ+zt73P7zm2xL2tFCBCVaNd57ty5w+///u/z5MlTItC0LVeXV1xcXDC7mrFarqibjtWqIS9LKULbSQHiBw8fYIz006kt2RrD0dELqqrk4GAfTKAsc6yJbO1scuvWPpPJSPdvamm//hs0hbMepozUV1ytFnStxKmizNI1hzFdY2uSYHStU7k2SMUH4H77d5JNLVEKIXB5XlCWkkdM1DnpphvNDM8rANwgVuvBDH//FUTtK3+7bq8jkkYn/XWH3HftZ69tqf9ojGQZyRxFlkEMvHj2JYUJ7EwqTGioMrB4jIlYq0TNZTiX45ysXYwaOBvpMycY9XTEWHCOuun48ukTfAg8f3HEi+NTzi5nzC7OOXnxDOtrpq5hYmqsX2FDA6GlDiKBmWJMGwtq75Ck70KMUq62EIMUtUQyiGRZhtXkxl3XsmpqVl1H00EXHcbkGJthrJOChbHTrFReNjiqglNiZdVryhAwiagFJWqKEPvfyCeiemYlJNkjS/0SoyDzEAaptcyQaxOVXZ/xIxUP1Hcs652IXupYVKXpd96nTP0Dwtb/rYnJ6SV5Oep6iapo7Qwj9jl1/9cYpeA1ybFXL8/O0zQ19aqmrlfi4NN1tHXNfD7XkjErkRZbuRa81HBbL6ASrAGCCFGJdkxrKZQn9IyBEq9XDiWCgyMRbuGm9ZwyCv3vANOre5R5UKedXnIOomI0VhkiteuZvCTm4tlYm4p5yDlZtpzOG+pgkARNDluUuHKEcbmk2TFrguZchnUSi5ZZcLRMctgpItnqgtMnj9muCnIM2ILaR54cnfEnP/opDRkUJTErMFlG07W4zDEej5hOqj6e0ihMowyh0XXvYVDXQhy6ZH93XUeeOfIsZ7Vccn5+hg+et99+S7yeVXgw1nJ+ds7x6QnT6Qa7e7vKcEZJdQV0PrJcLqmqET/+8U+4vLqiLCt2tncYj8dsbGyys7PLrVuH3L59h/2DA24dHrKqlzRtzTvvvMVoVNF5rRyhYS1nZ2d9Jv6NjSkQyHJLUWTs7+2wt79LnktC5v/Fmjp2KXnBGLGnOWd6x6cEdwlXJ7gK6nTTMxNGTEYChdeJmgTSR9x/9Fu/873kLBCCcFabG5ts7+wwGo8xGPUoe436sW96XhHOTUKVCIp+67u5eZ+e/IZE7Wefe137WbcZUClVFlDNSeTOcvtwn8wEwmpBM7+kcBEXO1zsMAac0QW2jiwrybJSuEwsncZgQMCHls53apOS6ggxSDXcjz7+GOec6Mmv5swuLojtisXlGRuZZ3+SYdoFLtYYX9N4g48O40Z0pqSNGQFLQNJeoV5WPkoMl3gKSXkcp8Dg8oxFs8JjaT1cXi15eXJGiAaX52RFhiscZIbWd2DBGofT7A9C0AyRQIjiOm8xvZeZUheBwdivMihnmraPnJG3L4g0SSBCmOTKdS4uJIcN3RTXPXZ1byqiT4jK6HtKyEn6kGBs79clZNqmVSIm57xmLGmahrYVd/qkpgxesvGLFCeeib6TWmZd28pvm4blciFZ9JdLmlXdB1HXy5VIhirNS3YQJWg6iURUhp9FbaPnB/YHuW8gvb3meN15nyRS7TsRbVnrJIFFohH1dE+w9XyIiA05RLoQaWPEA95YcBmmnNC5irm3vLhc8ex8wawD7wrqEIkmwxWlED+XkZeVJuAVhjnPCkkkbkS1mRlPHjt2JzlVN6c5eUZzccq0zMmdwxYjrpYtP/rpp3z69IhYjAkup7MZRVWR5TkxBqbjEdubm+QZdJ1KC6mqkq6rD5JH1armxRgj9cW0OGuC4cw5jl684PLyknfffZetzU3yoSND5tjY3OSHf/qnNE3D3v4eRVnSdYEsE81OShwwny/45//iX/DO2+/wv//f/R/Y3pGUV7vbO4QQOT074+pq1mfP//yzzzg9O+Xb3/62OGD4jtVqRdd1VGXJRx9+xK1bB2xtbRBjwGUGYyJbW1P293eZbkxEO9Krn9ftdTj2dedeaQqTqdRXiIEss5RlSVmVEJGcj7pH+30dYw/Lxog2qHcYU7JmlND1+zlJap3vsM4ynU7Y2dlhPB5R5DnOikuq7yQy/qspgp7/iuvDiX/tIrxGcrt5v3x9tY+b931V+6rbZHppjiJ7a0FcUeUFT5E5JlUOXcNydkFsl+BrcifpXqwRQ7y1OS5TCddKwLC1iXFo8aEFxbViKwlkaiRdrZa0XUfTBdpgib4jtC1Xp8eMTcveOGOcBZxfYPwSH43UZIsZwY7oKAkmw5tcuXcPRiQn5+jzPGpKA+F884x8NGbVdSxrj4+WLC+ZL1ZczRfMmxXBQFYVtEHqORkjyYastSL5OQc24rXqc2Ydto+niIKX0feb1lgZKYNIT/qffl8j3Ri1xtmAIBpUCvMqcagkYYzaa2MyAQ2yigQV17RPcXq4IYUk5w61HbZtQ9O0fY7FphmqKCXn4mq5IoZA27SiNqxrCZJOwdK1SGbNqma1VGmsaZTwJaLYISK2zDloqIGsQSJOeqiqUZCAbHq5R5d7zT3ItbSu/ec1cRweEbUBpr0waPIMGV5Q4heihlV4CX/oOiFk3jiCyyErCC7DG0dnJXfq+bLj6GLBi6sV8+AI5ZSQV8ybDleMKEZjstGIohqTlaVUstCJGSMMo1WnphgjOR3jLLI3csTLI5bPH+PaFVXmKLKcjoxnxxf88IMPWcWMWI6JeUk2mrCxvc3m5iYhBMaadmpUOWKQvZFWxig/H1MSXy1bYzVRQHp/Tu1QbdtyenZKDIFHjx5h1PHDOXUgi5G8KAjAxcUFl5eXPHjwULwJQ+zLNoUA/+L3f5/t7R2+9d632JhucDWb41zGy5fHLFcrirySROV5wfnlBYvFnOl0wv7+fh/6ERS+V6sVF+fn3Dq8xWhcAQHnDHluuX3nkJ3dLfJcqsgLbL2KLAdb92vP3Wx9TJs6diRUa4yhqkrKsuhT3CXvcGsttq9wnRhSJWiqIk/N6b0A7rd+63e+VxQFk8mE6WRKNarIes4o2SckIehXj1rPv45iDAlV/7nffdfa6whWf04X7XULDa9uwq9qr7vt1edKVoFWHMz0uRGnST5LB91qzvHRU2zoKJ0hsxaHOAQYIx5ZWHEYsdaRuZwYwMdODzGIxuCxIYhjihqYV3VN3UW8zbHG4Nuaej4j90s2ssjuNCfzMzK/IGga/9Y7ghvj7Yhgc1oKJWodGC8anOR/bTP1bjTyXl2GqypBQtHSeck8kjL3175l0a5Y1DVtDEQjklqqhm1AEHH0eCQ1UWacVA5OED90KtJzgigSDRrAhODPHvkKJyxIO/WCOpmIei0Rqf5XPa5ONrd1gLKMdUjI+vNySVUfsrl8J4eoBNe2sLYTSa6pG81aoirMOtnmVppwWA/93NS1FBFN8XGJ2A5UfjGIN+F6rkPCrQhHF8EopYlBJxzlflnbwfzS9XR/imG4dqQ+db8NzvbLlIiaqjdl3EiIDJZgHN46vM3wNqOJhnnnuVy1nM1WnMxrZt7QuBG1LZiT0SK2r6yoyKqKrKyweS5VLHQVejhKHrIABPLYslXA1HR0J89oj59SRM+4LHFZzqzxfPb0iB9+8BFxtEEoJ9iyotrYZnd/n92dHZaLBdPxmIODPcpSM5CkdVSCZmyy6+gwVA2ZbKRRM4RkmePF8+csl0u2NrfY398T+FMTQIxS5suHwHgy4eXxMc+fP2dvb5/xZKL2SGESzs7O+b3f+z1+7ud+ngcPHtI2LYvlislkwmpVE7zYmTGGLMv5yQcf4H3H7du3cc5QNzXL5RKihBo8e/aM8WjM5uYGuVT7xDnY2Jhw+/YBk3HVM8Dy4tNOGzaj/4aXX3fuekses6IqlLR5IUjuSOccmdMSQ1ZssEGzDIlgpYuu+L8naikEwBisEwbbAO4//k/+T9+bTCZMxhOKQkqppCMhFGna8etams1gkv2nIRW5RpTWm+jVa4PTaTxf/XTgdYTp9e31RO36yahz0cQbWIPWY4tk1jAqcwyBk+Mjuqbuq2hb3fSkTWgNOFXxGSe2BTp1GxbEE5KzhXK9WeakjEgb8NGQGUNXN4RmRVxdkcWW27sT8jDHxRqQWKDGG0I2ImQVnc2l9hsRohI0XcNorEhZ6tkq3JDYKcqqJM9yWUVVERgL0QTaIIb1pvM0PtJ6QxctHoM3ErbQoeEA0aqDidGEzVZSkCGIVra4SgZJQlJkLVxZQqCxp0Xpb7+2KuUNCZoPquIcQosSCfk4gGUj79ak9x/7h64JnhKCpAaV5+lnzRspqsmW0HqxXahzRyKAop5Ur8q+asI6Vm2dtSI9WxCf08Kacuhl+a9HIWmPJsIu45e+9M+AGGr/rxy6vgl2jTiLJYIixAp8WHujelUxJi1BxPXagSZmrKJl7g2zJnCx6jhfNlwsG2arjjpYTDnCFBWdsbSI+r0cjciLkry34yeJQYkJQlnEaU3WxJpIERt2K4dbXtKevsBcnlBaQ1WNiDbj5HLJx0+e8+EXz7GTLagmZOWYyeY2t27dYmM6YXZ5wc7WJvdvH1JkYiOTpZSCavKsdcorVDIQR6uGoCVmxAvT8hd/8Rf4znPnzm0mk6nCZ5KuRY3Wdp6qqqjrmrOzM05OTrhz5y7oc+aLJX/xFz/l6OVLfv4XfoHJZMrl5UykmRCxxonGYFWT5TlXV1d89PHHTMYT7ty5Q6224eViQYxQ1w1HL464c/s2RZ6DEXtgllkObx+ytbWJy0Q9aIx4MH+TFq+nXfmKc6J5MKSgbV1LxcdRA+GrqiLLMyXqql1RtWPqR7a3vIP0LgzJQU8ltf/yv/yvvjcajzROSR6QNlPa+6hRv0cUr2um/+/afV9N1JBd99rz2hSYfnYbcHI/o93sToZ983eiv7ei3lbnhnXxvzx3lGWBIXB2fAzBS+oddZzoe3EOmzmJoYhGwyLEYy29aN+1GN/hgrpsa964tovUjSJRdeeuZ+fEdsXd/SljV1OalSyhb+miw7uKkI1obUFtcqLmjnSqb5a5OrAafOpUnWOlQkGW51RFwXg8YjSqWK4WEsOSC9KxWc68bpivOmarlnndUnehR3KdqqVEi6au9ciRVFa+d2pQTh9BvEEJm/BQcr8IMXJfer89bJKcTFSbEMX7DoW5hPTlAf126H8vCGgId4koDA5FVHKXEoykrkxETl3zkxrRd52ojIdB2YrQkieo9C3PEEiTvoVoXR+nzhqTfqYwm64nFWoYEOO+y0S4EkJNDMCAqIUgKyPnEjFTATIdAboQNNZRMtN0Wi4pBMnZ2EVHHSzzNnK+6jhdNpwsak7mS67qQBMtZBXZeIqrRjQhErOMcjJmPJliXU5ZjSiKApsps9VPOtlTHE5tTtZEnIlUpmNvlNOdvySev6RqF4zyjKwo8Vi+PD7noy9fcLxoCNUUU22QjUZMt7a5c/s2FqgXcw4P9nhw7xZZJmtnjCGaAEZCSWTd9a+Rw3fiNEQicsByseDDDz/EGsPBrQNG1UidT9I8EmzLftjY3CQS+YM//EPu3LlLNRqTZTnPXxzxh3/4h/zqr/5VDg9vs1guuby8wlrH0YsjXJYxny9YLlZMJlN+8Cd/ChgOD2+xsbGhNdTE6ajVvJEA+/v7gu6MpPEqq4I333yIyxzEoHZEhSEBvq88xLowUJ98xbkEkLJ6ci5zjlxjgGNyuHFOGBonTKZ4zXbyg/7H2gH0yUIMkghd5gDuv/re/+V7WSaZJXojXL+hNS7ISiLfYYdf3YbXB4jlFcKV+nvdtcH5VwjO69u/DlEzN08MmtdSKMl7T9LS6I9iIMszNjc2ePLFY3wndaAyLMZIKQXh8qT0hTVSVdxpXaWIVHv26kkXfQtBCiRG30ksC5nYyppGkVukW80gduxvluyMoTKN/Ca0eJvjXTkgagUYS64OITbZI2wmHmXGqopLvTa17FBmJdvBZFIxrgraZonvVmQWJpMR48kEl2W0ARZ1x9VyxcVsydViyWKlYQFYglUpDiMSHNCpl5wfejZZRajJCQH6kjghIimUosRMCsiYHphFekrShnjbXb9HNkcvrQzerzBLQ9vdmghIDwKiCaHJvhwSg/RsIUQ94dC+jO7DZAeQv1qtALH1JQlSSZaMS9OjBY2Rk9PrZ/ZjVNFqeC6NHSWQQnz1vsEh90r3vfScukSkL5HKlFlRQtaGIFJ6hJgVdMbResOiCVwsOk5nK05mK04XNeerlkXnsUWFyQqcK0SdbayURLKGvCzJyhKMYTKZkilCE2FM9l2mjJfY0hx5Ifc7ApnxjIznYJRRHz+H2TkbxjMZjTF5wSoYPvjsCR98/pRQTAjVFMoxRVmxsbXN4cE+q/kVhTXcuXWL2wd7VIWsi8ClxNZlzmnFcoljs0YM7W3bgtZMS278jx8/pixKRqNR71S0tbUtDIg6NFknZZ5AGMmiKDHW8ed//mfcvXuPsqz47LPP+MlPPuDXfu3XKYqC+WxBjIHdnV1WyxXLxZIQAtPJlCwv+G//2/+WR2+9xb1794gasnJ6esZkOuXy8pKL80sePHgg6Q+d7TMmbW1tcvfuHYEXZR4Fjl6PF2+24Z7qm+LUnmKYgYe0+h7ohuo/Jw9fH0SCLYqCECPLxVITHQtujXqvYUjUJOWWcxnEiPtH//l/8T1RUw3HlCijIoX+fBIDZSMM23UCsf77eqKkv5WRXSdoeq4/f+3Sjb7S73uC9rpnXW/fhKgZtUmI2lH+6lLIy++z+TtGoxEvnj1nOZuT6fpYa8VxxEnCZGuTasL0HmUpxillaDDR44wRyS0EsccFerdv2Uia2PbiiPcf3aa0DTF4chMxecGs9oSsxGcjuqwipnyJfT5yUeGQvC6tIc8Mee7IM0fmDGWRUxYFeWaYjkqq3JLhJYyAQFnk5FlGXo3JRlPIxT162ULdeRarhuOzcxZ1Q915VsHTBFG6Yi0BsReEGERqRYmCQoUPkc7HXrUVlDglD7uoEpl46SmCXsthPVz2fwGi6TdtCuaOCGFJUmNMThk3WhrfNZDVawI/ApcCL2sIlb+JgOhYh0QJ3WdJVkuPWX+QdVGCKTa+QT86j/TERE9FDasMglCpfl1lkA60kG4q2uqjqI0D0PlAo4cQsth/b0Kk1cw1ywDHVzOen17y4nTGybzmqpVs+j4viXkJTgKmx+MxZZ6rmt5RlSXTyZTReEI1qhhVI5yqHK2aeUUSQ5IO2xSbKGuVZxmZCRJaUxjGsaE5PSKr50yt5Gz1NmPhDX/x+BmfPDum2N4narqtjc1N7ty5zZ3DA+bn51TO4kwktB1FMWI0kqw+1sr+DZ2/JhUYxOW8XtUaqiPv03cd3//+D3j4xkPuP7hPpaVdXr58SZZnvXmn1cK96f0XRc7GdJPPPvuMLMs5Ozvj4uKS23du887b75JlOWVZsjHdpKpKRqMxo/GIyXhMvar5yU9+Qus9b7/9DqPRmNVqRdO0GETNd3FxSd00HOztE9VtPsbIZDrmrbceUVYFsj0FLwS959+oJU2Dkb3hktpRv4MAbdpf6VSSZK2zlEVJWZaCL7SgauayXjUt+ED3soI3GNx//o/+i+/121RpyHDj9q0fiWL3G+0mAUq9fO3iDJDAzXM3u3rNnTfOv/Kr17ZvQtQAiTtDOQI5AQgxk5Q68pK2NjY5Oz1lcXlFbKXGEcETQ0tMQdkqKSV7AFE89yLJiaEjRkl47PQgWoyWemnaVuLaDCxWKy6On/Kdt+8ydh4bO0yo8RiWHmJeCFeaT8FIeRlJ+DVEDMI0WBOwNuK0bptVw2yWOZyBcenI8P8f5v60V7bsvO8Ef2vaQ0xnvOcOOTKZZJJMSqJMypLLKqukKhgoVL1ooIHy1+g33TDtfuFvVUCjG2hUFwxYlixLlkiRzDnzzvecE3PsYQ394lk7TpybN5NJWqrude8+EbFix57X81/P9H+YVZZppel2G2LwFGWJLkekcgSuJuiC5EqMK1HG4ZNi03Wsmi3brqfPArP1ndSZSpGEhIKjslkyk66GzD8ppkvRFMRElvIgyJodg7aRAS0/kyFKQMkAYilJnpFoIhkMUrqZoB08y3Kf93/2fa9ahkHLEJU1hDS8+nE6AMz8ut+vCOpbz24e5EMe4CGoDueUZcEeJIfzFKC/Abk0aGd5PzEH2PiQr3lmsYgp+8riQDCs8Ul4RH2CNkDTR3a9Z9X2PF2uuNo0bHpFrwqiG9GbEm9Koi3AFmhrqcoCpxVWQWkN47rez8Stc5ncwea8Ny3jLvvLBq1IKfHRDlEb1mgcntokTkqN3S2JyysK31GrBNpi6glX24YPH7/g+aalPDqTiV5RcnJ6wr2LC6Z1xWZ+xchZrALfSYCPcwWuKISgIKdFiJwZCLdTDhJqM3AofO+5vrrm8vIF73zrHU6OT0QIW0sIgdVqRdu2+3qVcci/ypPjoigBxUcffsQHH35Iion33vse1jnWmw3r5Yrrqyu+ePgFjx494tNPPuVXv/qAn//8Z3z8yae8/8Pf4eLiHlprdruG7XbH0dExz549o206jo6OmIzHe7AuCsfx8bFoaQcgFrPz+mvl9m/YNAozmPv38j0/0MNDnv02SmWHZk51KgopyJwyh2UQ/0TOe7s5xsFPB2B++q//7b87HE+8EkBuHcZBG4ajCMnbTUDu5d5bPV8Dar++T/7c9Msx/rr2TUBtf7b7a5F7lJxnQnwPWmlxSMfIbr1mvVyiUiRGTwgdiZQTkskck1kFH7Y5OPr3fHpRYCchj0I2wzVdT8rb6LynWV3yxsWMo9pgdQLf4VESSq0s0Y1JxUScglgSQwi/zucgocWauBceRp64XDhVBnlpFCb2TFziqExUJkpwSmiAhLYO5xzGOcqyzqG5JbYs8CnSeE/be9q+pw8BH+R1KAETsrnR+0iffXExTxxCDjoRn5qYJiICWPEQsDKAxUO/UL6PN+A2gN/NEzxETqVhjpafJ/lyv9rLH261fcbCzR5v+tXwOe8H8j2/vfbL7/MWcq88c/vv9kA2fB5C6wdrZB6jg5YLhDT4vySQx0e51j4m8YFmLc0nCfbpIng0HkWXoPWJbR/ZtD3rpmO5bZnvGq53Da3S4Gp0OYayBlugdNb4LYwtjE2iSj1jo5lVBeO6lohZ7dDWCRlx9pflIXEAaFnIKU1SEuWncwX4MnkmNnLqIC5eoHcLiuQpUsQrjRlP+eJyzueXS9ZRYcYzei2pK/cv7nD3/BTte5rlnLEzFEZBDPR9S0w++9LAZveBpLBk03CQ8Pgh1ckYy3q94YMPPuDi4i53796TYp5AWZS4oqRpW7qcBN227V7jUEi8QgJOTk749LNP+eSTT1iv11RVxYvnz6VY8dUl8+trFvM5q9WKzXrNbrclxsjx8THf+973sc7t2XFCiNR1zeNHTyjLkrt372bBL8vsaMqd8zMm08keYEUWZZN4Boh/iKb2ZnW5v19eRHsbjgE1DAEJiCmLck9YHIL4CF+WqSrnByulMP/6p//2393I9TyYZOy91AZQuz385Jt8dDcdvBqIblRSEDR+5Tq3PsufX7ue7PRWz6vay4d5q2PfL+e3n0On4eoLKCSliTkZXaOYjif4rmV++YLtdiUaEEKbpYn44DN5spggTbYPo6TadkqBmIR7MXqPTkkGUD6azvf4KJFTSWscPUVqOD8aMyoMOnVybFrTJ4U3NakYo21FVJakhASWXGRzuHZai7PdaJVNpVp8btplUudEgUe1C0Zpy9sPzpmUivX1c5qmQ9sSV1ZUoymmrMQnl0HO1RWuquhTZLNraLoWZaRaQYiBkGeDfe/3M7BI9qGhBNCyMB4GW9r748TENgBVyoENKQ224uFxOICx4ZnMy/DLNKDEAaAcPt379V7170BLuhUhtP/t8EaOKeW3+xGUQegGpA+2d/D9PvI/CXAPmlVKSAj4ft2bRTSyDGrxxi/mQ8THrBEfaMNCiJ3oYqTxgV0faPrItvMstg3zzY7FtmG1a1n3AVWNUPUYVY7wuiIog7IF2jpKCyMLM6coQ8vMwsm45qiu0ChCBKULtKvAViTEivEyoA3mKnluB1DRGCK18sxs4sgE2svHuH5LIZQD9GhCOeLDR894utrRu4pU1PTKMDk65o0H9zk/ntGuFvjtispoCqNwVlMWToh210sSkaoqcNZJIN1g3vWe3S4HaSHP1dXlJT//+7/nJz/+CXVd0bZS7gilsbbg9OwMax1XV9c8fvSYuq4RKSiaSUyJqqqp65rdbsejR494/OgRi8WCtuswWjOZTLi4c4f79+7yrW99ix/+4Af8/o9+xA9+8D5t17FrGrbbLSFERqMx8+s5PkROTk6YHc0kAlEnisJy584ZFxd3xMSawUSGgrzX+pUg8Bs3lYekOTA93lr2klv+DhGvZItCiAFjDPVoRFlWoBRt09wA4Z5EAfHXGY356U9f0tTIg/92x17UK0Qg5NUEE+RPnlUp5N9LLffftG8GaupV6/Dl9W4uz9e33wTUUCCwJYA2rCvCSRIwow+UrqC0Ft81fPH5p8IMbvOVij7biI3419CYbMZI++1lto+cq3bDEA4+RQmHz+p3RFFbWF8+4e7pjNmowCmP1kZYHhJ4XRHtCFOMCMqRtASNoOww/UVpMDphjNivTc53UQP4kTAxMCo0Lmyx3ZKxS5yMHWOniCHQdw1V4RiNRuLQV1H8INbkyE9LWVbZ3CK12MqqpKpqnHMkFH1Ioj2ESB9C1iJuFvE9isNetJIBzAaZIjmF+e0eGOLgL4pybfdaW35GYgxf2pYsGVS+1P91ixzJl/pf2gaofKdvAGoQJgOwDcctIC3g7bNWG7KGte8bNLY8EYiDb+wQ/HKwTlD5NR1EMEbJR5Q6fJ5dL0sTEts+sG56Vk3Ppg9sO+mPxmHrMW4yAVuAdijrKKyjMJpCRWp6Rqmlii0npea4cpI3pjVtH0imQBU1uDLXUJOxIeHeN6YkmYXn51YZVNbSLJGpDhybQO03+MUz6tRRZDAMtqAxBT///BFXu55UTQimAFdwcnbOGw/uMqtLrp58QaUTNvYopDK20uAKS4yBptnlStMlzpUyBn2gbZs9qFlnWa/WLBYLppMpb775JjEmPv/iC549fc7Z6RnaSOUMYwxHsyPOzs54/OgRz5+/IAGj0XgfaFKWFd/61tv84T/9Q/7ZH/0zfvyTH/OD73+fb3/727z2QErQjMdjnLX0Xc9quWQ+v2bXdvgoaSUAVVXzd3/3d9y5c4ejoyOxBKkEKXB8POPuvQuOj6fyzO1NoXkcZc3qG4jTr2x75SXLaQlWGzDjENwOFJ28v+Al+XoIYOwzN6QxlqqqKauS7WaD1komupmCS2upj2d++m/+rXA/HjaR9gfntEevw7UO2qB9fcX3XwKg3F7V/wpQ+1J71e/4mv0ftG8CanC4KYWEi+TtD7tRcoUUMgupnMGoxGa5YL1aYvKMU4SjMHyL6cTgjBWQM1oWJaCpEb7EFIT/DS2aSlQyIwkp0neB0KxpVldcnMyYVo5S5erNGZS8qQi6QrkR0VR4XZK0FQZ+QdYhXiA75cU5bDLJckRjlKIsLE4nbL/F+g0uttSqZ1bAbFRS2cR2ecVmeU1dGEaFpbSGsiiwtsAVJYVzOFdQVRXaWEJKpKQyr6SEXielsxlMBLa8ZjPlnurpJsjiBoxuAO0QPGISk+UQkBJTnjbsge3m3/DrxMETLw9G/u6btAG85F+G0WwaPVwyaGXlcACfuNc+RYOKGXhkuQ3ysojfMaREVPm6JfYTgv6Wrww8SoI+glQ+73MQiI9CZ9XHRJeXNkpR2Z3PS4gCZrbAViNMPUa5AjKLvNFCAlzqxEhHqtgyjjtOTOBiXHJaO2ojwNuFSBMUqpqQyppoCpJxaGdJekh0ziZ6bcQUrg0YC9qiUTilKBBAO6JFba4o2iUj1WffsCaVIxYefvnwGSufUPWM5Ep0UXJ+fs798xNM7Hj08QdUKlJqGaspBHrfCy2gUsKSkxKb9YZd0+IK8YW1jUQkl4Xk1D1+9JjFcskPf/hDidqLkauraxbLFcZavvjiEVVOVxiiUSfjMZPJmLZtefH8BavVMp+zECIrJHn6kIu0bVr6vqNpdux2O9p2R/A9MUV2zY6mbdBG7bknt7std+7coaoKYgqI2zLx4LV7nJ0d4wqLyn5onXNWySJR/VdYH1+W2SIjyYw2Xze0MsDpPJnJK8aDNDOVq8nUo5oYIr3viVGUhsI5MUP+9KevADVe3rGI72GW+3LbazIvtwPh/8r2KnD6BqD2qr79zn5N+6agJrlkwwncXGC1n3UPPXJVjFa4HPY/v3xOCh5F1ryGSColJWcKkwmF96kUomWREqEXvkGZY98ISCT+BN9HYrOj3a6YjSqOxyWTQnJMrJF9dBQ5eGNEtMK1l5QhDtpYVjq1lnB+rTVEMNplAlmLIuGMwmkoYoPtNtAsOXKRqekZO8W0hLrQEDp8u0OnRF3VlFWNccIQ4VyBsTYXZZRXcq0zn8Qvh5H8I21yYmA+Jm0lglTnJPUbE8kAXhlIBmBIcq0HYNsDYF4npcFUJyYOuY/D3RyehV83gXt1kxy7YR8Z5NJNyPywhJQygcjNMQ9aWEhZI0vCoLI3Fea+w/eDOVJ8jy8DYN5G3n9I0PSBPpt4h9lM0oakxH8WEvQoGh/pIjRewKxLEG2BKipUJgJmIO1WMvlxCioVGNEz1Z4zF7ko4aTUjK3CpoBPil5peu1IxYhQ1CRTgClQRpOUgJrOKUR6IAcw4n/DGKySgJNKRU5MzzRsYfmCcWoZqV6EsTWEouajZ3Mezrf0pkTXU7AlaMPdu3c5mVT4zYKrJ18wKUS71INcUdDnCulDXmEIkabr8/2V9RQa5yxd1zO/nqO14Z1vv4P3QcyHDx/z+MkTAciUsNbicnBMCAFnZHI7BMuEGNluN2w2G3zv5bFUEhARgrDV9F0nla+7ds9g473kn3V9R+d7yqIAFE+ePGEyEdJioeeSgLDRqOa11+4xmYxBDU/qEJAzBFtkv9Zv2V6WzwrhxR3cOdLynl8y28u1HX4vF2FIzxnGv9aawhU5AV7y2WKQVImiKDA//en//dWgNjSR/LLRl850EPPDOajs1D748jagDbJCDcf7W4DaV4LksOGvb98E1NLAfrG/oAfHcXAOCiQiL3p0DDijGNclu82KzWpB6HsJSSZb/wA7FGC1FmWGQZtBM0oSLyBhESmQZLTJdY0KgpLAkN2G0sDJuOJkUqJzVn5K0FHS6wpva1I5xZuKqIW+CIXkAO0jy7IjPArgamvBClWQmBQTBQHdd/jNgtORpUodhe6YlIGTWUVVaKJvCV0HHpyrsOUI44RyTei0hEjZWgdInk6IIpyNdcImURSSQ2OENdw5i7UyewXQKl8rle+L3MA9gCSEy5K9Jpf2g+cQ3GK8qZoLgpC3h1ZuOUn+1iK2yZcWxNeXJyAp+15ugFT6X9bMZMkMJTkqcwigEfOirCMAdQNSe59ZBvZA/i6DeMzryfeJkLUkCciQyZQydq8h3+ShJVofRGtLENBgC0xZ53wzB9ZhtaHUliKBI1CmwJiOme45LxJ3SsWpS1QaKdAZYYehMRWhmuDLkdRJswYlNPt5IiO+s0FLk7EhmpoyEpHrSNQqcaQ6Rv2atLliagIlPUlDMoZWF/zVrz5lnRyqmkAxQtkCZQwPHtynVJHN9XO6zZJJYbFJiNxFfimZYOT7AuImCSmitFghikIIlQtX8OLykq7vOT465vj4mDCA2qNHXM3nTCdTuq5jvdkIi79zVFUpZjKtqcqKgfxCgjwkqrJpm5wy4LG5rIokIwthQ8pFhL0PRBJtLzXqrHW0bcvTZ8948OCBJLMblSm8NHfunHF+55SisMToIeXkckWO0M7Rh79lEzF5W6YqpPDyIajJu5vxebOuuLeG3n0dz/1Kgjc6p0IMASQpJZwrmEwmX6OpHbRElspZY9sfiLoBNNnZ4G+Ti/Ql8Ml9w4G/Yo2vB7VXbXPf1Jcu5qvaNwE1lPgoxOcl58XB1oc9yU3K4BN6tIKqdNSF5emTRzSbDVYpyLRHEFFpABOhoBITiwSNpJjQiMM8pkBIXs5ZZ0do1NhksCR820DoORmXnE/HYu5MMivsdYnXJb2uUfUxna0JyhDUTYRZPjVJCEZjosIpg7IWZaXcjiscMQSKlHAh0C+vOKsUo7SjYEut1lQ2MBuXnB5N6Jue+eWKkDS6GKNsLTNU6ySE20g5G20s2hYoY+m8RxuDdRbnHK6wlM5SFo7CWZwVc4w1QtpqrcU4h7HCFydmk3w9c/5dvrFwCD0pQ9wB4InvSoCA/L28DlreIVBkre+Vi2hZg0lRNne4/qGp8WC75ACZl4AupCEy8SZ4JuU5TVKZ9SMHLGVGvYN+TVL5eQJCfpbRFm2ESUZMzIo+BDofcoRqoA2BNidXR21QZYWrxwJorpTaZq6g0JYKTZmgSJ5aeY504E6RuCgSJzYypcemiLGOLsIay87WMD4ilCOCKwTUzD4qBJXZbbTKdfOGsZFN5wZwREYmMks76naJ61ZMtMeljqAgGs06Gv78Zx+QRieY0ZRgSrCWsiy5f/cusVmzeP6YUkVqo7BIikck0fU9ESXXSmdWixgxzjE7OmY8HkuVC60x1vHZp5/jnOPu3XsZ/8SUv95ssNbyxhtv8Pe/+AWLxYLVak1Mift375FixBnhX4wxURYl0+mUqqro+o6rqysur17gvRerjs5kA0GqYJAEdFOUen/b3RZXlvR9z3K5IobIvbt3sU6SrZ2zjOqK11+/z3hcg5IobdSBaW8PO4cw883bV8lTsVgN8vKw3YDXIbjFnH85RDeG/FkSrEXJiDFgjYT8i8+zYDQaMRlPMD/96b/5taCmuNFYUHLOe/A6XCvPdOTjK+BHHZ70PySoDfsdlpdbvlyDMM+f1U3H7bY/D9mbEuvfzR4OdqM1aFIOnE/o5NG+ZbO4ZLua0+3WaJWwVks4Wj6URE4LMBJUkZQ4PcWMJaJKablG+5uqLU6L7y76Ft9umFaG40mJUZEYeozVRFsRjKPXBXp0LLlDWsL9JW9NzkFnb6FGCFGVtiStMr2WzO60StQGXEqkRqptH5WJ0vTosIAoZK6jsuDi7JTpuOLZkyes1itSSoxKw3RSM6orXFlgXIE2bj/7dnnWG5PwwtVVxaiuKAons0tjqIqSqiypykLKVRQCfs5ZrBMSWWONFHnUSpJ8M2uC0VrMWFoCDWQA31RH2IPV3heXzYN7/9ftJRwkNh9qWUmJ9jTMRxPqhhll3y9VoAdN6ka7EvYOAbqbfUukZBYJuar3TRSrERMiAgpKi39WNJybmYsC4fs0YmqMCXofaLqebdOy7Tpa70VTQ7HzAeXEf2bLWiYfWp4brRVGQ5kCo9hR91umuudipHl9VnBRwUz3jFSgUhGtpSBorwq2qqSxNamaEouK5AqJVtMKcsi8EBTozCiih7A5ATylKYiUqWOiPGO/pu4WVHFHkTp08gRt6Y1l4Q1/+8kz0ugUqhHBFmhnmc1mnB7P2C1esH7xmLHVxHZLocE5KYbce0/TtJADFZy1REBby/nFBXU92vv8Fos5V/NrCf44P6Pr+2xONFxcXHD37gXL5YLlYsGdM2HNXywWFM6xXCyxVvzNSut9/lVMibquOTo+ZjQa433gww8/5NHjx/R9T1GWwpyB3Mfee3xMbHYN06Mj5tcLri6veeON16nrOk8SoCgtp6dHvPH6PUhJajoqEUQ6VxAZzPpf1Q4l7KGklSdbxtXL3yukQPDAEHN7g/L5Bs5y/m7K1UNyjbTB6iGP9JAgngN7ci5gWUo6URJGkcPox5cP5+bQb9RBQfYhFFTvNRkZzPJuv8G82YOD3ptvDtZS3BqEQ98tQBv6Xt72XmDc+PQyFA0fDk7jy7biW7OHA7SKeYYt9FdyY1IYqlbLajqr6kZBQcKGnrhd8eLhZ4Tdin63pNstMIPNPmVVWk5OSiXkchTKKKwzEsBh8j7yEZrsaxKetIBRAZN6Ur+lspFJbahrR+9bIgmvHV5pmqihHBFNCdoRdbEHa6OsgHFKGGNJWhOUFkAbKG10lPSEJKUbK+tpVy+obcCoDkuDs0ZAUYFTPZPCc3pUk0LLdnmF71ZYGykqh60qTCn+Nu0qbCHBI9YVhCgFNEP01FVF4QqssThtKayjtBZntGhuebFO4QpLUWjh43SWwmhKaymsaHwus39LUULRAPYO+aGenBFTFznFQrQtBYjWI6Bz4/uKey3qAOyC5NtJHaxEShK67n3Ce/FzxaiyX+wmZUHyyW6W4f7IcWZzobYoZdFKTLdghGg4g28eOlmoSJ6jWJTkWU7Z79aHkPMFBVD7bJZsU6JXkKzD1DW2GucCnZVoTwmsVpQGKpOY0FG3cy5cz4OJ5v5Ic+Y8o7SjjA2WgNGKpAt6Cjbe0NsRenSCHc2ItiRaJ34zM5yjwyiLzYnayiiU1SQjfh6jFFUKjGLLTHWM+gVFe02ROhzCLN8ZxyZonm0jDxeeNDojuJJOa1xZcOfOKZWD5uoZfnnFpDDY5CmM0CyJaVCePWFuydXNgTff/hYn53dwLnPkKvjFL3/BbDbj/OKcspJnWOe6gigwRlOVJVop5tfXTMY1dVHwH//8L7i8vOb580usLTg7O8dax2K1put6dPZ973YNMSamsyMmkwld73n0+DFPnj1nsVzThyDMQ8pgXYUPMJ8v6H3g4uICpRLOapSKjOqSN15/QFkUqL3rIacWDQIyibx5VXtVr0JktPw6I2LKz1/20xklPnGJLXj5Wc1P6KApKoXUZ5SJt0CFbHfAGMj7OMCGG0wRWW7+zU//7b+TjX/1P2lyo4ZNDydDBpV9GzJPDw/i4KsBQg63LNs9+Jz75OWg9ytAbUCZAVT3Tan9iQ4nLRfjAMj2v8hHkC+WD1FC3TOgacBZRQwCeOSblULEpIRqG5r5FddPHrK+fEJoVqR+Swpb+q6lMA6dZ9wM5iMQp7gd/AdiahwIXUEY+GOQ0ikxekJsSaGVwqShQ8cOozxlMTCxQtBWGCGUo1cFKecDRV2SEP5Ho23WLiMoTdCyMACaAqUjSmVxqwW02uUzRi5S6J6CBomVTBQqUugdtVkzrjRH4xGj0uHDjtVmQet7cMI8UlRjinqKcQVFKcmprnBoK7yZ3vcooLQFdVlTuYLKGQon/jZjlfjcCktRGonStEYEb65SXtrBfCl2d2ssZq/RSdTXAGbaGKlSnqNS0bnCAGTT3s1ITNlXtX9V7PXdFHUGQ7UvxhfTjcamcuWCwTwoi2heUndPfEiicQ0D3eY0i4NE+uE5QpGQAAuj9B4SIXNpBqnI3XuftTEBNIl6JPvOEl4pkjPoqgJXSVVo7SSXDI0zmlIrSgIFPTN2vDaCB3XkokycW89UtdSpoaTPAR6WZCu6VNJSEooJuj5GlWOCtUR7EzkpDOsOox1Wg9OgrSI5DVaLH1pp6tQzSS2TsKPsF1T9kgKPpDlrOl2wDorHS89Va/HlEdE5grMUpePexRmh3dBev0A3a0YGAeAMijpPcuqqxhoHeYLjior3f+9HVOOJRCYaTdd1fPLpJ9x/cJ/jkyPQYJyE5YuckadiALa6Kjk9OcFqxePHTyjLEet1w9HRCbPZMV88fMjPfv5znj57xnqzJYEUadbyvKIkxxNlcK4iotg1LcvVmuVyQx/g8mqB94Gj2YzZdCITYA1VYSWM/0LIjHUWjXv5ngbpK9raq0TsXkpmvWB4zmQ7A2HEkI4k29aDLAGUyn7sLy3DUShUPo4hQ3fAqZs1btorDnHfsk/t61YZ2pBX9mXAugVqw9G+apMH3bcO8ivBakDo4YP8+fKass8v9X8pIVZU5P0xHhyNfCefU+bKG1R3xY0MCiGRJPUaS8RGj/EN7fwFy6cPWT5/RNguSLsNJvaYFPBth831y+TSiXBMKckMMSd3aq2x2dSjUBCFBLXvekIYKjxLZJwaNAjfEYOnzCU7lDJEVZBUQTA1bXKoYoJ2YzC1CEjEXDU8lBhDVGKeGmZYSu3xV3KDlKKIHWF9yUh5Su0pEEJlpQZtJ19zZZlMjphNJhid6Lotu82aZrdFERkVwixRF058Z4WjqApsKabItvOEBEo7rKtwZUlVl1Kl10qQjct+t8rlHCltscpQuoIiM50468Sn4AzGaqxTWCfantYStGOsCDLR5g6IvQUaEL/njSlTDYCfZ7s6hx+rfMH2M85hJURtUvKDQZrIy+EMNf9mWLKb9WYShCLlCg8pSxalBXrN8LvsP5Pw/kQbkoTkx0ifFAEtbCFR0UWpRh21BVdgigrravG9KYvF4JRipCKjFBjHjqnqOLWei1LzxtGYE6cZaaiIkvispTQT2oJ1BFuzUwWdqwn1lDiaEsuK4BwYqRUoQOJkUqE1RksxW2Wkzp/WGqsMTmmq5Jngcd2Gol9Thi1OwllIQKcdyz7y+fWGDRW9G5OcRTnLqCq5d37KdnFNv7rGhZ7CKAqbzZ1ZO4pJ4YoKW0j+nKtKzu/f493vfQ+dfbmJxPX8ms12w2uvPWA0HgMJa4TOad+SmNOKsmQ2nTHKbCqukFpvCcWdO+egEn/xF39BjOyDxoxxTMZHOFuwWKzZ7TqUslTViKKoURj6LtC0Hd4HQoi8ePGCuqq4e/cOxgxWNKmXdn52xmwmZXBArFCHZr9BFqabt7faoaR8Vf+tvgHIdH7GYdjyV7f914dy+bdrvzmoHSKrGuywh7/PB/WKTe4vzMsg9vLngzYAzdf33YLIw+4vNfntq5Z8YOTjyaXHlVL7Cti+F7+PWAcDNvRUKtItr1k++4LNi8ekZgXNBtXvUH2PDh6rNX3v98JrCEQQ/4FoB8aIEHbW5ll2IoVEzAUqo/d5FqhkRm8sCbUHNWctVVGglcnJ1o6gKjoKlBtj3AhlR5Aj3hhIQUmYoiSixG9y8EAOtaRszg0p6Um7JS5sKVRHqTsJgjFS3E98IBJFlXpPqeFoOuZoNsL3LZcvnhH6Hg0UzjEej4RMuawwhUM5hy0rjCsJGDovdduMtdSjAmuF1dw5meWX1opZUluKnCohgCYAb61oZ9ZqjFMYKylP1hrxveWK3daIBmfyq5j95FmRIBUhqJb32ddoxFdnsn8lo5SA3ODj2s+I8ufsd3v50VMqK195G0qlTM+E+DiV5OMNSqCYDoZ0DGE6VzlozadEl9lB2oSYFlHoQvyqAeF0DGiULTFFLb4zV6GMQyuHswWlsdRKM1aROjRMU8tFBa8fFbw+qzkymipFitjjosepiFXiCEi5QGhvKhpd4KsJaTwjjmbEUtICUg620FpLUWKdfWrZlaa0JuVgEYvCAXXyjOkxzRLn14xSK0EeOQGm1Y6rpueTZwt8eUzvRiSt0IVjNh5xdjRj8fwpYbOm1onCQF06CisacsrJ6wmFdmIuP7t7wffef5+j01OUlWCmpm347LPPqKqK4+MjyqpCGyP6otYSyHHA7aoQQm5yUvT52Tmr9Zqjoxnn5+esVkv+8i//kv/mn/9z3nzrbaqypm09TdOjleOjDz9lPl+hlCUEaJoO0JRFxXQyYzY7Zte0bDYbZrMJJyfHOdJSntvj42POz88k4jGb85L8OWg3su9Vbeh++ev9570IzRPi/aSNbEP7ClDbdw9RGgfy+LdsvzWo3R6Z2f4J3/zivAxMXwFsX1rvK/oOL4csg2r80lpf8dt8APJJifCDnBsxfDH4KmKPCT21TvSray4ffkwzfw7NinZ5hQktqm/omy2xa7Ba07RtZlvP9bW4cdAymKcQh7mci+RgpCi+PImWHGqfafqImBKBGAK7bZNLXBgCDkyJLqdsvSEoyVuLpmAo3ik5YfJMJRTKCIWWFkNa1rjkfov5QFMkjw07/HaOiTtqG7BaZyCORJVQRuGMxaRIoRXGQF057l6cc356TLNZ8uLZE9aLOWVhmYzHlFVFWVcUVY11BdVogi1KtCnoQmS+uKbrG8aTmtFkSlkJJZdKaZ8iYXVOBXAyMbDWYLOGJiHNogEIKAmgiWly8OsMSZ9Ze7BC7OycgJoEnmistTfpBianG+w1LQGyYfIyzJ/UEKGpMw3Q0K9uNDqlxC6kBh9E3o6I7MHkKcEj+5QMsc6hs+YfcmJ1F6FH45XG50rUfYTWR/qowRS4akxRjbFljbFierXaUBcFpdJMFIwJ1H7HmQm8fTrmzeOa8yJQ9A1VChQxUBIoVaLQ2T2sFMk6ki3xxYidqQijmUQ9VuM9swcHiduiHUsgzzA3yoiN0hoHuARV7KlDg2mWlH7DiBanc6Sq0myxvNh2fPpiRaiP6W1NVOCc4/R4Sm00m6tLdN8wdprSKlSUfNJ8o0BJZKiPiWoy4vW33+K9998nDrmkCpbLJR988AHL5YKr+TXGGI5PjiiGHDTncvIw+2fMe0/bSgFZbTQnZyecnBxTVRKxuNs1fPjhR1xdXvPFw8d89vkXXF7OefH8mv/9//PvefL0GZPxlDt37uJ92C9KiS/www8+YDQecXx8jLWG4KUszmw65fz8nOl0TO+lmOmrm3wzyGC5Joff3H4voJgtPcN3e0DLzz4H4+ArQO22tjjs/6uP8pu0fwBQGwRjPrhveEyvApdv2sdLAChHJLRVty+gCOfDLby8PVlTDnr/ldqf7o0pbhD2wWNjwEVP2My5fvQp7fwZcTsn7ZbEdk3qtsR2C0EKgPq+pygLuU7ZHyfmRiMOciv+BJAgBmMc1ji0MsSY5y8qm8W0+FdC1CQlvqEUEm3byW9tAa4GW+JVQa9KcDWqyLNxm0O6k2hUxuSEbCUBHzo7dVG5xM4w4NHY1FPS066uMWFHbQKl1QgXrKQfaCM+EJOreSsCWnlU6hnXjvOTKUeTmtDtePLwC7zvKYuSqqpwZU1RyVKNJphCmFCUUcQU6fqOhKasakb1SIJAdDYdmgxk1uKcwTiDduYmqMRmMDNqHzQyLHu2F52TvTOIWXujpQ2mSik7n7W7LIRRSiYcBykG+yVrdQJ4AlYma32Dxnez7k1QhM4BO2JgzGMsP5/yXB74L3LEZgg39c580gRl6JWVVA5TSPSrrfaAlrLvUGsldfQU1CSq5Cm7LWPfcL/WfPt8wt0SZghbyFhFKqDUitooSp2wKgpBtlZEU+BtQWtrmmJEHB8RR5KfFm2RS9LYm2jHg2thTTbzao2ykuBdACVQx46iXVG0S6q4o0bq/MUEQRmWQfFs0/Fk0xMzqKESReE4nU6IzQ6/WVHEntpAaZVwtGbpJQwVgT5E1s2OO/fu8t7vvM/dB68REhR1zXa75Xp+TVEWnJ+f89FHH/KrX/6S5XLJxcUFReEAJQEmuWht8FLIFSSqTxtF7zt87EhJgksmkwlVVTEaT1gslly+mAOKX/7iV1hbYF3JbtewWq959OgJMUaslQjh3W7LRx9/yJ2Lc45ms/x8iI/13t27nJ2d4JzL5VvycB7a8FAdCO7bsvWmqVsmy5tXwQSyInEDi/m/rJPXPmy3TLW5/R8HajKZlLevBLUv4+2vay+Di3TevqBf2QciSG4+ZAemyheZLA7yxTz4+eF+9+ac4U7vbwIyCznwL5ESKXgsEZd60nbF+vkjdtdP8csXpGaF7jfQ7Uj9DhWkLppKYnZQVu8j5wQncsYpYoIUn4JQRxVFReHKG4aNJCHv3ke63tP7RBcUnRfz5GACbtseV1SYakxUllUTaKKi9QqPJNK6okJpi7EuawLiT5Drkgd51gSinHa+UBqbPKUK9NsF2u+otd8LBlKQmbbJdF9JPDjOJKz2aHpKlxhXhtmoYjqqKKyhbVo22x0+gi1HVOMJxT6c3KGLgrKqQElCc9v3tG0HCY4mU6qixFmTgYA9oBmn0UOkZNYiRFsToSlJ3UaALpfbsc5mH5vKACYgttfUrCSw7gFtv2Qwy+ZM0fyyiTJHXN70ZfPl8L1WQpW239YgkAbNQSJS5TkVP5p4XeTpSVJmXHytEfokWlpQlh5DjyEoK+TBpsS4GpNNjTFJKkdhLU6B8R3Ot9Sx47xQvDGrePOo4o4LzGiY0jKhpU4SHFVoocdyWqo9GCUavzcFnXHsTIkfzYiTI2I1EWJh49C5zpqkW8i1G7RlrTPhd6Zs0wOopcQotNjdnKpfU6UdFQ0KOW+vLddd4umm57pTxPoIb0u0VlRlwayuaFcLVNdQEKh0pDAKo8QPKNynElrf+kBSim9//z3e/73fpZqMCUrjyprHTx7z/Plz3nrrTabT6b5EzXK55IsvPufB/QcS2CGKjFgwQh73+SbGFAixQ2mhcSMliqKkKCrq0Ti7IkqMcXRtT9sKFVTf9Tx5+oz1ek3hCsajEcEHPv/ic6qy5Oz8jLIqUZnhaDwece/+XabTicixPRTdSGuRd3Jcw19ZT9ZRe9n6MqAN3w+YMMjdG+1sL0v3+/n17f8wUFP5z/7UX4L725B2c5m+bruDEP3Ssgexb9LHwZ4GkMt34LAdfB5AbT9BkV7ZQu4TqMk3M8l7kySM3iVP2i3ZXT1l8+IxYTOn21wTujWEhhRbgu9giBokgdZ4qa4modgH4dxJGZQSbjulpTJwTIq261mut1xdzbm8vuby6poXl/J6db1kudyyXG7YrrdSCbfpWK62EhzgFYttx5PrFZerhheLDS8WKy4XaxbLNU0jpS+GzAGrhIlEKSXCKc+4hjwpcmi7JVDqSOy26CD5QaVRuSpBzMJZzC5KayGYzOTGg3nTaE1dlRxPJ5wcTTEq0e7WNNslvt9RGEVdOgnRLxxVJSVtnBUg9j6y3XW0XZ+5IwtMIXlIylps4QTQXA7fz8Ax+G9MDmqxzqEGk6KzuFKCSgZNzVkjuXIDiGWwEkDL28oAZTIrjLMShTkAmc1J7APQDYJ7MGWKlpb9mIPZUeXAkxwpMpguJSk/R5TlCnkqSSBRSpqQF9HQHFG7gwoNFuNqtK2wtsBoi0oJR6Q2MFKeKmwpuxUnpuduBW8cFbxxVHJWRKq4o0odpY4UWsALJL3FmojRUqZFiKwd3pZ0umLnapidEcbHxGKEN1JvT8L3JclaQE381iprGFqJbVWeRyhTpEqeOuxwuzl12FDTUKYWiHLe2vGiiTzd9KwpiNWUXhc4o6kLx8go2sU1NvSUKggY54waa8RCIgnY0PjA2d27/M7v/z7f+t57xBwy33aex48f0bYt77zzLQDu3b3g7PwMgKvrK15//XV0HgNighzyTwdQg5gCES+SMw35jsJfKDypNaPxiKJwTKYTEomyKlAanj9/SiJyfHzEZDpmu9vwyacf8+6771BV1T6gyVrNnYs7nJ2dShg/QM6F3bcvydUsR9Uwm92vJu0lxWroHxSdvQIwCNKMDSrlwKabzi9vLLd/CFBTy8XmFSjwcsvSHYbTvmGYz8mjwzUYtIZh3fzrL7eci/CldksD+5o+bvoVw+HleUheeT+vOEgl+NIUQjolrDV/pZNkA6mYCEnYrZ2W8vFht2T99CGbZw9JuwXd8pJufUUKjZSAiR7ftaLxJIUeqgVHJBE1JLou0AfQtsIVMnOW6DPRzrres9lumc/nXF9fstms8Jnnre87Qh8gCBOITh5CR/QtSgW0imJiNJouKpmtK8fWw7aHqAvu3H+Dt975Dq+98SZn53eoJ1O8kmgzm4uGJp1LkkDOAdRUccs0rmH+BerqI0a7R5wUnoodNjZ7LrmUJB2CoYyEIlMyKZKyRFXSJ8suOGJ5xGfPVvzdx0/47HKLmd7h5ME7VMd3qSYnJFux2+5odzua7YbtYs76+ort4opuveDBnRMeXJxwMq0pLKjUoVIPKcgSgmizwRN9hDxrTlrRB0+IA0WSxodA23XCI6cN1jq898LD6KXy9qDBkxOnU6a16n3I2rf0+yAk0ykHcMSUc9xiFBtCymNnqN6bJAyflBlEkpSolTlxrn69Z5GQWVGM0HWemDQBTR8VTVR0yhKtVH8OyuBznT1tHDaPGRN6HB6XeqrYUMaGMR2vH4+4P6s4ymVjdLejUhLlq1MQ5hpt8FGmslqnnPohEx+PZWXGrMyIeTGlO73PZnxKq2t2qiIph04WolxzpURzQUXkzAWsQQmRd0qMQkftW2bdAjd/yKS9pI5rqrgSkmZd0uiaX857/v6q4ZoR/fiMTSoYWc1RXTGziu3lU8Y6MipgZCOFgcJKygLakpKhRbPygX/6L/47/tl//9/z+nffo42K8fSUX330KddXV4wnY9588w3W6xXT2RTrXNa4YLvb4nuP1lrSAvZCSN6mmPCxw4eGzrcoNDGKlSUlA1i8T/Rech232x0KzWa74+Gjh/zyV7+i9553332X8XjE5dUljx495A/+4CcSla01ZVkwqku+8+67HB/PcNbkZy0IqKm0VwEAuQ/pRnlIkAv5DpI8qy17oBs8vcPvZWuDL3gvhzOpAUlSJvZ7HPpf0bIHX/b4VSv9mvaNNLV9U/Jn+Pfqnw1HMnz5qpWk71XammDly/3Drl9aN/fJp4MrID959edXgVpGQZkJi/aiYs6Ez6HKhY7o0LB68Zjt5RPC5hraNe36Gt+uUalHqygVrDUCBdk/4mMC6+iToveRrg90PuKTAm2lUvSu58XlnF9+8BG//OBDPvrkM55fXtL5kDUdoYeyRUlR1GhlKZ0kLyetUbagi7DziXXr2XaR5ComJ2dMj88YTY9wRUWIkeurOX/+H/4Djx5+wagquXPnjjjm1WCqk6CHlINShlwqq8DpiEmB1K5Q3YbKaQojVcIHAayMQWUfYhTJJywiSWG1zcE2QXwwRI4mFXfOT5iNS66vnvP0yWO0QkrXV5UUWnQFxjoKV1CUFUVZYVzBfLVmvd2hnOPo9ARTOoyT8HzxnQmRsmhakp+nrUVbMfmZfUCJEWb/ENBGU9YVo9Eoa5wHz4cWyiGbeSmNREegyBGSQ/Skkmu419CMpIfcHEuOntRZk1TZb5e1ygSQCYMHH5vU4ZN9ka+ejxCVwSub2TsM0RQoJ1GNrqxxRSkpKkpjVaRUwqhfxga9vWYUNrw2tbz/xjnfOhszo6HwG6rQUJuASV1OqBatRmkl2rBJOf9IqkrEpPBJ09mKUEwIo2PC9IS+lAARr2+0NJO1NCnsyJ68WjThm+vjtKImMMIzTg1lt6D0awpaXGrpYySaglYXPN0Gnm4Dna3xbkSXFIVSjIzGRY/frKh1orKKwiBJ3hkIjJWipdFoVFHwz//0z3jnve9J7p6xYBx/8zd/i3OWt956i77vs8afi31mxhVJ3I5SCft6zscff0xd1dT1CJsLh8rkRKKZJa9RZFBMQhHVe0/bteyaHbvdlr7vCVEqzt+9e8HZ2SlHx0dcX12xWM558803Rd5kDdoazfnZGa+9/gBnZaIlkyZxheSHeS9Z5Xc3sjdDyl5M3gY0afvvBjeNFq1aKZXl9LCe/C4PoVf60Q7bjZry2zfzr1+ufH3QhpO+3XGz0/3hDWrs4KPJJyfX6vbGEzJ1HVTWAeUPT+Xlvq/qH/p4Wde8vcvbn/PMWSHht0OU0q3tJiBKUrHREU1P7NfMn37O5vIJ/eqKuF3Q7xaEdguxywnKSRKps/mBbE/3ScCG7CRP2pKMow+J9a7l+eWcpy+umK/WbNsOtJVgifGEqh5R1jVFJUIcbSCJESpF8CGT0SYlM3Pt6DE0AdZNz7OrBT4qqnrCeDKjKEq00oyqGt+1PPricz797FPefOttxpMJWpMj9MQHKCHO4pDSRHQO36bbQLfBqoDF41TIEZo3YehBkcvdWBIyC5VabTIAjEZqLKcOZ+FoWnHv7hmlM6yXC9bLBX3b7k2WQx6ZdY6irNGuxLiKLibm6w2XiwXaWoqqwhUl2gjFzmDeAZUJfYW42RZCKo0Sv1bMLCF1XXN0cszR8THT2RS0RJgmwBWOoiyzT+4mIpWUxESaSwkpLTRLErwigFoWBaNRzbiuKcsSrSXZnBhFgGfTJsPgVxLEYI2iKIQiTB5WqQQdMATt8MbhlSXYEl2OSbZEFWLqQxlClORYqxK1CpSxxTZzRmHNG8eO7792zHfvHXGnSlRxQ5UaKuUpTaAwCTv4I/NEQBkkV05LUv6QT2dcSdQFjS7p7Rimp/jRjM6NSLogmUL8mJhsflTZxIqcq0FkQh6fKkmaQJ08pW/Qm2vqsKYKGxwdTvUEpQm6ZBsMTzaey06T6hm9LUnGUWkpVaO6Btot08pSFVpKKlkxGWstk8YAtBHe+d4P+J0f/5jJ2TnRWop6zNNnz1lvNhwfHzObzei6jslE6pqllOT5SGkf/eisk2fVWp4/f8Hl1RXb7RaUoqoqkYNKCytMYG8pCLk+mA8e7yX4qutavPeklPBBiIv7vuP6+poQPPfv3xOzYw5qmk6nvP76a4zqek/lppB9yPMjsvdAiuZX8rRUQEwmVnJP8gZuyXallEyAh895Wnuo0WWJv4eBwz2/LKZvta/Hvle0G+1PaLK+qg0ndPD5ljNKyR856FdoQPk72dntizgkBr78o1f1fVX/zczipfZyx+FnRXbKZ2d8Nu2gZKYjM+LBd5EwypP8lt3iBdv5U/zmiridE3cLUrdDJ4/RUi8NldV2kZ/ZH5dIpqBD0ytLRKNNgTIF14s18+Wa5aZh13l8Am0LinpEORpTVDlYIleTVlkrI2UTTRATYZ+U5B4pi1eGPhnaqGh8Ytf2rLcNPiTJq5kdQZL6Ub7v2a5XzOcLfIycnp9RVYUMIMRkmDLHYESjVcSohNOg/A66LSZ2lCbitASKoBDKLaOIRoNyezYMpR2aIQk9oXXEao+lxelI5RJ16ZhNxpTO4duW5WLJerXCOgdKZ0CrMKVUAsCWeLQUtmxb5sslSSnKqqKqSrQ2InAiWCeBMtpo6nFNOarQWkwz4sMSzW06m3F6esb0aEpdV6gcNKO0oqzKfaSamFjzfVbkKEwJTQfhEyzLIi+idY5HI8ajWmo/AcRAzKVIRnXFaCQk0AGJijNaUTjLZDSmKMocto/ouMbhtaPD4m1BKmqSK0k2188bApEQmqtRobH9Ft0sONIt3zqrePfOmAcTw5ntmCjR0MrUUGiZqBgVMVpSNZTYl0BD0hG0VFLWBplsGUkbaU2NL2aoo3O6YkLnapJ2oCWi1ygplIsSDWcwBuicMKxT9jGScCSq2FH0W8zumnHcUIY1lh6Tejya3pRsguXpNnLlrQSlaEc0hpJEkQK6a7CxY1IYCqMkUdwo3MDyrg1dSGx94I//7M94893vUE5nUJRENP/pr/6ayWTK8fGxaNfGCNt+lh9J/C57zQUGrd5htDCN/OqDD/jrv/4bFoulRDjbksLKM+qDML/0XkrNhCjFcYWJvyfEgPeerutAKV5cvqDveyaTKZPJOINLoiwKTo6P91WtpcksQee84pdVBpVXOWwvKyzD2od/1aGGtv/F7Q0pbgDtVkdWgG61AUXzPn7jJmj8m4DaK3a2/3i4zvC74fPh7w4v5z80qB3uSy4a2feX5wr7iynmAgU5OTIlYQjR+cYbNeT/eJJvaLdzVldPiLsFYTvHb5fEdoMhSAiykoNJKKKPSCqSkRrXSRNUQRsN0VZoV+GTYrHa8OxqzmbXCZi5AlfWlHVNNZLcrSGYQeXIOpXNUjEieSoh0sVAF3NuUgIfcjVpDzGI32W72WXbvOLk7BStFF0/zP6ED/Dh48dU1YjpbEo9qgkMYepSeA9k5lwYjdPsc/Hod9Q2ZU0tX2Ytv1Va8u6kZIwZjO4yM5eLLabJnISukoJkGI/GTKcTCqvw/Y7ddslyfolvG5xOVDlPTMiQRevSxhFRLJYrdk2H95IUPpnOcGUlS1VjyxJbFhyfHDOZTHBliTImJ6Qr6smEk7NTTk5PqUejfA8kXN86Rz0aMTs6YpTZ2mMusphixGazppizLFVdM5pMGI1GVHXFaDKW91UlqRT5+fO+pygKZtMps9mMonL4FEhK6nCNxyNmx8ckbSQoQll6ZWmSpsHQmwIySXDMQSykhEpCAVWoQOG3FH7NJG24qAJvn5V8+86IeyMY0+D8hgKPSV5qX6nh/kg0kVLiPxMfmiR/D4U9tVaZW9QRTEXrJoT6GD07p3W5np+WOn1aSW6apI/kZ0QrVE6ryJ5iqaCuJJilCg22XWN3c6kQEbZoegw++4xL1sHwoknMvSEUI5lAKk1JpIge1TdUOlJbhZP4pX2QTxyqg2tNfXTMP/vv/ozR6Tm2HhNNwdX1kg8//IgHrz1gNBoRY2A8HsGQ5ykO0r08EjCSqGRjLJPJlN57Pv30U754+AVGO7abhuurJW3rhTAhCcWa1NEThpDDxXtJN/A52vnZs+cUruT87A5aCaGA1jCZTjg7P2M2m2UZKTJPohNfYdVCJmWH0nPff0v+H/QfvA7Ws1e1V8DWN2gvH8Vv3n4DUPtyU7dywF5+d3PqA1IrDkPvvx6oXm6v6r8BtS+vPwSH3AoayaAlNyI76KMkJGqVsg8toVMUwa0C3XbO8uop2/kzVL+mXV0RmzUm9RRWZtIh9ISQ1TPk4dTaoJImhEQTNE0yVLNTtC25Wqz54ONP2e46krbYoqKsx4ymU8pRNjeWJbaQGlAq8xHGhBSB9J7tdkvb9+x6z673dD7Q+SRLH+l7GQhBsrRpmoa+6xiPx4xGNT70YtYIHqU01/MFT54+ZXZ8xNvvvCNRmIhw1lpKm+gUKZyUALHRo/qWfrti5BKWHp3DelHiT5KZuEFl7SxP6fajaBhkaItKMnt3RhK5nVEczUbcOZtRl4aPPvgFm/WS0LeA1I1CW5SRyYAtRuL3cyXL5Zrnz1+w2zUcn5xy9949Ts5OKaoKZQz1eMTp6SnT6ZTxZIorCzrvSUpxcnbG2Z07TGZTbFFgC7cHtDID02QyZTyZUJQlSmlC8LRNg7U5wtNqxtMJs6Mjjo4FAEfjmslUNDznHFpLYn/IeYx1VXF8dMRsNpOSPyrS+ZaqKjk7PWN6fEIfElFbki3psCy7wC5pVDVGlRXBiM8GJR43Q8IQcWEH2yvU5pI3jgt+9M5dvnt3wrHaMvIrqthQ0aNDhx3MSVrsw2LVQDSyrF1jsmqaE7+1ViRTEEyJNxVdMSWOzwTUdEVvapSWKMx9btoQ2bkHtmxBEV0eqxD2/OQp/RbbLDG7OWMairgTszWBHkOnS1Zec9nCPDhiUdNpQ1TCV+lCj+q2jJ2izoBmtfjvEgq0oQmRcjzl+z/6fd7+3vdpkiLqgl0X+fDjT5jOjjg/PxftXCnGkzHee0yeaEpUoXijYjYhhjCQLGiePn1GWVW89973ePONt/ngVx/zs7/7JU+fvcB7qdWGUrkKhBQH7XsPKLyX9yEEQGf2kB2j8UQIF0i4QvInz85Oubi4szdVH5oKbyTy7ZaNkvumIAcCviRvX+qRof5K6fuKvpfaV/rWXt7Lb96+Iah9xY6+1CVgATIwbr7Pb/amS3n9OqB6ub2q/7Dv9nHeaGrc0tRk4IDU44kxonKtM51nXCkKK31pErHbsHj+mOWLx2i/w28WpHaNTr0knBpN8D1t0xBC2uebKWTm1feRrk8EXTA9u0eyNZ89fMyHH31CH8AUUh26Go2pxxMBtMyqofeh4ZaUq/E2TcuuaWialvV6Q9N1NL2Xwo4hClGtFzDzQQbWYFPP6iOQODo+wvse7z0+eNquo3AFH3/8CePphG+9+y71eJIrKGcfG1FmhDkPzRHAt7TrK2obsSlHfIqhLl9vMfHuH3slvpikhkGDBD2kYZFJj0w2RGg5l5hNRrzz5pvEruXFs8dcvXhGDEHCwY2R9ATjMEZqtRWlmPAWixUffvQRr73xOhf37lNPpuisbU0mY5ndOimBE2KiqEpOz84YT6cUpQCa+Hw0xjnKqqSqa8qyoqhKqe/mLErBeiWldpKCoqq4c/eC2dGM8XSS2VKkGOTAHSiSBnyQorDTqVQprqsK7XIJIKOZzI6YHZ+iiwpdjNh6eL7ccrVp0dUYU0+IRngEIWGU5FEWeFxsUc0SP3/Cie35wx+8xftvnnNehr1vaqx6KhPF75RS9gnu6UEkUk6JdjYobmgyAfeQW6ZJuiDoklYV9NURTM5I9TE7VeBNtSdt1kqjVNbulJJ96ZshK+ThCqeSLPQU3RbXLrHtihENRWpy/mcQ0m5dsew1V51iFQq8LWWKlVlwnG/RfcOkNJSZVUbSLcTHq61j23vGJyf88Z/9D5y99iafP73kxfWSR09e8PO//wU/+cmP0UZAqyiFMWQwOaosO0KQJGuxgJCjOyVd5u9+9jOqqubdd9+lKmtee+1N3nzjbYw2fPDBB/xv/9v/xtMnTwFFXddU1Qhj7J7XMcYkHKvW8fTpM8bjCZPxhMIVVFWBNYrpZMTFxR1OT0+zX3+QxV8SnfuPL2tpapibv7Q+r+hSvAxqAlS31xvA66D3a6Ifv3Lnv0H7hqD2irYP8f91TQ5SycYO+n49UP26/tugJn8l2HTgyxsAbfhBXieJkFekbPIQMNaKXJ4+YkLL8ulDVpdP8JsFqtsSdishKUaAL/QdXduImUGLmY2kSRh6D33UKFdRTk8Jpubzxy948uyStgsYV2JsQZkDQcqyxpVlzpUSzSamRN/3bHc7VqsVy8WS5WrFZrNls93RdD1t7wXIQiIEITsW+3vINZNUtst7Qujp+p6qrogx0nlP34sDemB1n50cc3pxwd37D+h6oeExRuWUM0nDUCQKIir0dJs5pe4o6EUzSCFrZOLPkYd+GFj5mVGZqV68PXk9ETApSv6TMRBjR4otpdXYlLg4OeZkOib2Ox4//JzVciH1vbIp0hVOBEkGOWUsbR/4+S9+Rdt76smUo5NTSZjVOhMwi/B2ZcloMqUaj/KkQgAyZn+bBDWIEHauyMU2JcDEWctms6Hve1xZcHJ2ytmdO5jCSX2twmFLJ1XFcxDN3j+lRIjNjo6oRyO0zXRMzmGKmmo8oxxNibbi4fM5Hz18xnzXQTnGlGOaPkgiMwkTPUVsqWKD3l2TNi8Ys+P7D475o++/xeszy1Q1VGlLlRpqJSH9VmWWf20AIbbO7jgBmszpqBAhpjMLiPi9lISl6wJvSnYU+OqYODmjcxMBOS1E1ezNYIMkzQYqhaQtqJtST3ZIo0k9rltj2xWFX1OlliK1gBTK9KqgUxWLVnHdataUeFPgc9Sq9R2mbzCxZ1QoKjfkFkrEY0gSzKTKigdvf4s//JM/xU1mmHrMk2fXfPTpQ6p6xA/e/z5d12RfWiX1+LK2MYAb2b82MIlI1QXNZrNlvpjLxGV2RNd1tG1LionpbMr9+/e4f/8eRVnw6NEjfvHLX/LZ559njkcJbrJW/JFt23H54pKTkxMm06lQuVmDc5qLi3POTk9lYqSE1WTw9SdB2SwzbySpjOf8+WX8OVj3QIrum9zS2wiR72hutzHiK5WzW+2r9vbN228Hal8HaLdOMmtsDA+0XISDVb90Aq/q+6r+233yOgySg66bN3k2mJIkBA4gRhItxORoHht7dtfPWT77gn49R7U7wm4F3Q4dupwX1hPzg21zqLhKWkp7BEVAKIlsPUEVE754esVnj56x2bZoW2BsgSvKPaAVZYl1MuNOgA+BpmlYLJdcX19zfT1nsViyXm3Y7HY0bUfbe7o+0Hup4eWHyCk/gJjkpfR9JxpbivTZ6Rxy6HDvO1m37yWpt6yYnhzz5rfeYdd0meg4onUUYZSvptOgYyQ0K0zcUupO2BmQGk8MhSyzMBuu/RApl7K/LWVmFZ0yCOo8wcCjlMeoDhV6bAyMrGFUWsaFwWnFdrNms5YaVIPpMSmLdiXaOpQtUcay3m65mi9oe085GnF0NKNwBpWJcMmamC0EeIx1GCuRkeIXlHsiZy/+TZ19hDr7sDbrNd57pkczzu/dZTKbiuC3BlNIuDjmRogP18U6x3gyZjTO/jsl7PnJlrjRhKKa0EbFk8slHz18yrIJBFujirEEBYWIUkIOYGNPGXao7RVjdrx2VPDea8e89+BIAC1uqNKWWjUUqaWgp1AJw1D2I4cyZqAXQuvMYJJN92K+v0kaV/m3XheZwLgkjk+JIzE9dqok6CLf+OHcD9QDbsia1QBoIP5qFTChxbUrXLuSIBYaClqp/Eykz6A2b2DRGzapxGsn11ApbN9ifEOBZ+QUVTEk0wuoJRSbpuP8wWv88A/+gLfe+z7BlNjRlOW65cXlEh8CR8dTnMtlaazF96Jh7wEtS+wh0hAlfuWE4pNPPkUrTT0a0/c9L56/QCFVtRXiNy1KqequtZYJmTZ0Xc/V1TXPn79gs9nSth3L1QprLUdHRxRFgTGGsnKMxzX3791hOp1KQIgc3d4fLj4/kYN5OO5vg9yFg9fsFdiLzQOwG27b4WRVVhsk18stH8lhgOHXtv2D8Vu33xLUXu6QJocznOXNZcpwdnCV8sut9b6676v6Xwa14UbsBdDB6sOgUYJqqAximhy+nwcsKRC2SxaPPyMsLknNDpodYbdFhZ7kO2IvzPgKhEFCm1sh9l1UKFuiqxHJVix3Pb/41adczzeAltITxlFUUq21rCqKokQpRdf19L5nt92xWCy4vLzk8vKSxXzJZr1m1zS0bSt0WXkRclMBsr739F624UMvkVPB51pMkgS83WwIXn4XfKDvelLIidPGMjk55dvfeY9d00tyMkGAbRDrSlFk36Pq16TmmlJ7HBGbfPa3DLaqYRGtTDHUBxOwEDdbEpototS5UcJ2qAcA9BGXNMp7rILpqOL4aIbWit1uw3y5YL3d5vwziy2FOUPZAmsdZVWzWK5ZLFc0bYvVitOjCc5kImctEZ7i28laSObmFHPhTQ21wQ8kPI/CHAKw223ROvvkzs8z04nkyGkrJs4hbYBsflVa4wopQy+AJs9w1FYqK5RT1k3g8bMrPnn0nOtVS7I1uJqIk1IlMaFjwPY7TLvGNtccm5a3Tyu+//op792fcVFB2a0o445C9RLVmM3JUkVZNDSZjEj0rxkKxKrB7JiDf3J9twyBezAM2tHpEl9MiJMz+vqERpV4XRJUIVqtUlnQyiORtwD7VCCNVQqLQqeATR4dGky7xA7HHxuK1COQlvBK6rXNm8TSa7aU9DnhPAHGN5i+odCR2mlqN7C8CHgkhBz8Oz/8Ib//h39EOT2m15ZoS3a7nraJFKWjqhxHR1NGdY1C7UP4dT6nW1pbfuZTTDRNw0cff8TR0RFVXbPb7Vgs52idSMnT9w1Nu6VtG4zRjMYjprMZdT2ClNisN2w2GzbbLcvlitVqxYPX7lPVVQZmTVUWnJ8dC3tIrv4cBxDL8m4YtxyMyGEZ+vavL4Na/k7uGQLYIPdyGL+H6+3BbXgd2s0aX90Oj+q3a98Y1G5dhK/dZ17r1pXIs4X9tvLrKzb2qr6v6j/sS3mf+8t48F5ukKync2XaIakVkpRP0VJZutnt2Fw+ZffsIa7dkJodfiuARt9D9OLvSRHnLIXLxQRDIvhEVIaoHKYak1zFovV88vApXzx8RoxaaIqsmKXKUiIch+CBruvZ7XZsN1sW8zlXl5dcXV2xmC/Y5pmazyDWe9HSut7TdWJW7LqOrm/puo6+b+l7AbeUEiGJ09oVToJM2o7ggxx377N/0JOc4+TiLu9857u0vceHCMmjCehsElVKYUnolND9lnb1nFoLhZiJPWrvIks5olFByoIz5QlAvm8CXBHNwCoxmC9FYKcEhTK4GHFhYLWIFM5y50K47hbLJU9ePKfpPRiHKUe4skbZiqRkRl6UFU3T8vjxE549ecSd02Mmo1Ly/6z4LdWgoQxBDEb8LntAUzkASItvw+SIVFIkBL/PbxtNJ0LBVYhvVGmdC3/q/X1ASeVz54SeS+X6eEmBshW4MZsWPv78Cb/8+HMWW48ZzehxdEETkoEEKkZS26CbJXq3oOoX/O5bd/jdt05589hxxJqyX1LFLbUSFhGNzyHgoi0LE4oEcSiFmDKVkBSbHAwi18aStPiTdJL7P0wUvS5olCONs+mxOqJV4meLWqoti5AlsxqIOUwrMRPuQR4tBunYY1KH6raYdonpVpSxEVCjz1XHI16XoqntIktv2FHRKU3UhgjofocJDaWKjApNlXPTTJ6U+Aind+7yw3/yY771/R/QJPCmYLnrWC53FHbEu+9+m6OjCaNxiTE5BSSDhTEC8GnIB1MS/ZgSdH3Pi8tLlssVp2dnuKIghIgxsNutSHQkpOL7drvBBxnLfdejlOSbTSdTjo6OCTEyn89p2oa3334L54RezFpNVRW89uA+4/EIpVWO6L7RzAY5OGht6qVl6Nu/fiWoZfUki00yZt7exlcBGodb+pp2eFS/XfvGoJY/3jrZL7fbp/elv3s9Nke/yZ9by6v68o/lYn5Fn5jG8vZll7ndnIHKNuV0UG5cIaTDTidS37Cev2D56BPqsEHvlnTbNb7dkkKPVglyUUbnJNINlJCNBghJo2yNKkZQ1Gx7ePzimo8+/owQEmVRSYXnHL5cj2qqssRoLQEbbctut5WSFtdXXF9ds16v6ToBIMldEWql7a6hbTvarqVtG9pml18burah6xq6riV4L4wEwWOMYTqZMJvNWMznNLudMLwHT1EUNG1HOZly9/U3uHP3Pru2lWul5boKi5ORIpIpYWLEhC2768fUWsieVfQCaipJWfssvzhYQk5yHv4ONFGiCeYblPkxyZFy5LpUJjPKyyTEU5eWi4tzJuOKzz77hOViIeYcJ8mvCqlwbbLfTRvHdrPhb/7mr5lOZ8xOTrFFQYgySQlRcvR0BqKUDrgYs35irRXNKvvEtBFqovGkpqhr8Z2ZoVSJCGtx3MujGaLkoFmX0zRyPqBPmqSkqOvTqw1//Xcf8PmTF0RdYOsJrZdgoBQTyXvCboPzLe3VU+zukm+dFvzpP/ku338w5cR1WL9EdyuK1FFphc3UYRLFmCsqCyzlUZKED1TLPR9C+9UtLc3K5CbmfEwEGL2p2FBgZneI4zN2dkqvSoJ2Uk3i1tjNE4c8HmUcSoCIpNIkVOwwYYfp1phmTtEtqJKAmlM+s3IkATVKrraBVTDsVEWXxLwdQ8D0W2xoKFQUn5qVskPGSsj/1XLND3/8B7z3o99ndH5Oi4Gi5qNPvyAFuLhzj1FdcnQ0xjrh2gxB/Hly/URbSSnSNjvIidjEyHaz5tnjR5ydHFGXJd1uy2Y5p92uiN2Obrum3Wxod1v6tpXaiV2P7zvapmG72dD3Uq6mrisu7t7h7sUdyNqzUgnnLCfHR7z22n1srhyfYkRpIU8wOZcyIUFAg9Ymt0Ek414+5leUrM8twMpamWI/kAff6GCcvyV2b7Xhxv+69qUj+a3a14Mat7c/QNKX0UUe0nzGkIfIcBGGbjVcgPwTMbPePoH9PnIbEnpRctn20HXQN3wjkXeSSM2t/d/YfhVi300p5grWgUIHSh3YXT9n9ewLbLNAbS6J2zmhb3J5CEgqElPI9axk1t77wGbXsush2RHF5ARdT/HK8ezymi8ePWG92YjfTkv5E1cYqrKkLAusNaByCK/vubq6Eu1ssWCz3dA0DU3bstmsmc/nXF1dMp9LHafFcsV6tWS7WdM2W7pmR9fs2G03bDcNu12D71v6XjQ8rTVHsxnnpyf0XUvXbPFdgzaiOTV94OTOXd741reZnZzQdB0R4UZMyuCjxgdRw2yUascVHWF9je53EOXayJDINFhZKIqEhCh5EzfmqPwsSR05iZ9EyfGIsFckVK5nJVqFzhqKiR6Hp7CJ2dhy9+yIzeKK+eUzut2Kwhom40pMzEoRkvg60ZbWJz59+JiQFHcuLqjrKgsLKQQ7mBmFGlK0IuFmlGcrDkUglZLf6SQTlsLBYHLUOeJPS14WKRL6VqiZjEZbjSlKlKvokwE7AjPmeu353//Df2bdREw9RheV8HCGXHE9emzocP2W/voJ50Xg998+5Q+/e8EbMyi6F9RpjcVnn1jWqlMOFshjTvxBNwJKq+w3zcJqEFXiD5EOlTXNpA1R2z0/ZatLttSk8RldecLOTuhUQUiSDnIzrnOQkNICrkNU7UDSrBJRJywdFR16N6ds50zCmjJuKWgxUao0KBReVaw6xXUbWQXLTg2J51ImynRbXOqYloZKJ0bFTURxlwzztucP/uTPePDd9/BFjTeOqByPnzyjLkdcnF1A8hSFztls8sjGPJ7JnIoheEhCk+e7FqcVJkWWVy948fghn37wSz74u7/lo7//Oz7/4Jc8+uRjHn3yMU8++5wXj5+wvLpiu1rRrDc0OxnLfdvQdy0pT0ZEAxRW/yElxBgZ03cv7uyPRWUSAbW/7vnqHwDaIA0H6ZsltrwOMjOvJZOgG/k9AJysupfIB9u92f7NflQ2N5MF/6uWoR2+/83brwe13A79fILwLy37728uxq3DHSKoDgbMrz34fHHJ+791LWC4ytnfI6z47MvdywCWQ7uh3uEAOJVOFFZyrLbz56xfPCKsLnHdinb+hNQsidHLNkn46PHR73OL2rYHbbHliHp6xuj4Dm58xM7Di/mazx8+5unT5/i+R+9Ln0jZk6IQ/kBjNJAIUUyKm+2Gpm1o8wzNe49RiqqqGY/HzGYzTk5Pubi4y507d7i4c8bF+Tl378hycXbK2ekppydHnB4fcXZ6mvOiNEXhGI9qppMxhbWk4OmaDb73KOPYtD33Xn+Tt9/9DhhD73uZJiRFSIYYDTFZNJaCSEmkTB1xOxfarCRs7Sr7bIySAbZnGsnh/GSgE+1FHvaEaCvyOoCbgF5UmqANURtUUpImlQIuthR0IgBdYDYqmNQFKvaslnNWy6VEh5WFbFs5ki5RpgRdsNp1XF5ds1mvubg4YzKqSFFyDmXiJGkG1jhMZqBRZL/azQ3NPqKIsVqEfY7uFDiRoazJ7CG+EwYaa1BWwNorB25EGxyfP77mP/7Vz2i9phjNhNMzKfoQ8L1E3trQEdZL+uunvHlc8/vv3ON3Xp/w+rhjGhdUfk4R1zIetBSSlSs7XNLDMXozLgdAk+F9cw5qn5oh6yalSZmaS7YAna5ozAQ1vqArT9iaCV45sqc0j7shIln8eEOtPUPCIeTfUSe8SdjYMooNZnNF1c2ZxDVF2OLo0MkjXNmanoKV1yw6WEXLVpUy+QkBFXqM31GknrFTjAtN5cR87GOiQfPm997nx3/ypxzde43WFOAqnjy/5Od//0ucsTy4e5eqcjinSMmTkgC/UpKbJlaGQIqBlAK+6zAktqsFn3zwS/7mL/8jl08esXz+jNXVc3bLOX67Zjef0yyW7JZLtnlZL2SC2jW7XOQzCmB6kTkxZVAbora1Yrvd8ujhQ9799rexRguY6yzpcuzAcM9flroil4enWtbbv0oa4h7A5JG4eU4GgLs9XTl8d7DIYHppz1+3/KbtdorANwa1W/vKQPGl9oquoQ0zgOFTGj7fOo+XNnAAai9/te/KA/SmM/trhru5F0X567xbowJOC9tC3K24evIFzeIK1e0IuzW75ZwUAxGxu/dDdn/284DCOMdoPGV6dML4+AxbT2l94mq+5vOHT3n0+CmL5VoYS7Ig1JkPzhgh3dXakJRETcUY6PteZlpaS62romSaq9fevXvBvXv3uHfvPg/uP+De3Qvunp9z9/yMizNZzk9POD0+3i/HsxnWGAprKZ3DAIXRHI3HlFYTupbNdgvGMTk64c133+X8/mtsuy4z9OdHNzPuq3wNrQpYJflpsV0RmyUmNpR5Jm11xEDm1pQZiRoWhlDwm8/ymu9WnoUrstI9vFFSx0s08iBEuioQtWiAylhOTs6pR2O6tmNxfc1mvaLKPIsS9ZbNklp8WtdXz3j+7AlVYTk9OcLI5BuShLmbTLA7gPMQjq+MFqYRnfOuSMIMkUsHDdFeKmVQy4Syw/1V1oFxojnampAsDx+/4Od//xGffvGEOw9eR5Ulne9puxblO2xssX4Dmxe49poHM8U/+d4DfvDWCRejQOGXmLClNAGTrQtGyQRA5NyQI3iw3Nye7Ns6fM1DSLB9vy55nZtQ/0SnCvpyipqd0ZdTNqbGD5pcTq/ZD0DkWDQBlUK+05oARJVIKlL4hpHfodfXlP1aAC606KyphCTcl42qWEbDda9YRsdWlWIjCEFcBqHFKk9lFXVOUMaI6dHUY/7b/+Ff8u3vv48djfEolLH88he/YjFfQpRAkHpUUlaOlIa6aDKxkQTrg1zQGIl9T991fPzBh/zn//SXfPLhRxCjBKbkiFGtFcH3e+aRru/YNQ3b7ZZds6Pr+1yDbW+Jh0FmAjEqyrLG+8jjR0/51a9+xe//6PckD9IMUCQ/Fr/pIAuH23coE4d3Bz35Hg+f9+/3HdwCs6Hd+vpLbXhw/pFavi/81qDGAdjc6ny543ZTB1fnUPOTL28u8k3f14MaQ/fBDdhnwqthmzc3UJFTg5I4wS0e1e/YXD9nc/mM1K5R3Y7dck7sWxTgo6LthaJmKK5ZVhWz2RF3Lu4ymswoqrGU3Nj2PH1xzdMX13zx6Cnz5SrT2sjMRoNE1BkjbO17h7VID9EHhQi3Ho2YzY44Oz3j7OyMk+MTJpMpo9GIUV2LX0nSvMVhnyI6Joh51pht69F7VErUZUHhLL5tUDEwrktmoxGltTRdD9bxw9//J9x/8228NjS9zwJJ54s7wJuYoAxShsTSYfwWv5tj/CaXoekyA7oEitwEi2RsOlC7b+7QS2C2fx1uXMwBJRKVhxJQQ0VS9vmhhLFzPB4zm07RwONHjwjBY43FuRJjSrSRmXpESo+EvuWzTz9mXJUcHU0FBLMvzlonYJCDOATvDoQF4myU6FnRbMJwbkMkIRJhG7LfFKVIxoF1KFuj3YiHTy75L3/7C548veaNd97FG8um72naRkoZhZZa9ajtFWyf8caJ4X/8Fz/iOw8mTNQa55eUcYtLLaVJlAacVmiCBDYpIZqOg79zD2ZJxkwGrn3Uqsrq5cF6e1VviPhHzKEqJQkSGR2jpue0xYSNFlALcPAMDTcTeZ6SBK2QFDGJRi5+Vk/RN9T9NoPahnFsUKFDI768IEH/NKpkGayAWrCsVSnPbQwk36FCR6Gi5DrqRGENyTiKasS9t97mj/7kzxgdn+biqoq+D3zwwYe89957BO/5+KOPUSoxnY4xTiY3g34i9FVZi/Iy3nSCTz/6mL/+T3/JF598yvnpCcezGZPxiMIVOZBDfHLDiB9KCglISiBY23d0XU+ISVJ+CuGIJPswp7Njnj275Be//BVt2/LD97/P6ckxRVGCksmkPKdyzVN2ybBXAob78Ap4ywPv8Jbtx+FB363PX/74UnvFD/6r25eBlX9wUPsGTS7OXjy+6tuDj9nvkr/6usuyF4HDHUFlfWBYYfCrJYgei8cmj98sePHwM1S3RbVb+vWS0DYYLTWO2s6TlKUajZlOZ5yd3+HOnXNmsyOUtrR9ZNt6Vrue69WWZ5cLHj+95NmLa9q2k6i2KH4DKQqZWTCsFSbvgdU/awB1XVMUBVVZUdcjJuMxdVVn8BM/njVWZmHcUH2lgTUks6IkJMzYWqGdgpzCkGeJKkXGdcX56QkX9+/z1rff5ej8Dn0Sdv+oZObcdjJoITOwKMQXqcQEYvEUytNvrjHdmjrtMMmL0WmIjiM/fy89g191L281pVA56GSYGMjvErnyGCkDiEKTQiL2gco5zrIJ9rNPPqVpGqwpqMoRSluCQnggNZACfdvyy1/8nLOTE85OTqjKEpAgEBDfrs6USKLl3eSw6XxuOptOhyPUubTMEIzTe48PksenXIEuapQb8fDZNf/+z/8zq3XH+cVrKFdyvdqwazti12J8h+02dFePqMOKn3z3Nf70J+9xf6qw7RWFX1KmhhKPI0hZn5RIQd5bK/yGw0x/f+HVMG7yxzzeZJzsh9HtloeYfC8m/phgR4E+ukscn7K1I9Y5tD7miebhplKSI9EpoJDqBzf+Uw+xpw4N5XaFXV9ThQ2jDGoq+wFDMoRkaFXBMhjmPSyDYaNKecyCJ3kBtJHTVFbhrJjgdz5STmb8wT//F3z/939CdAVRW/qQeP78OaTEd77zHd5959vMZlM+++wTNtuNFO4sBTQGjsaBmSgF0dT6Zsf/43/9X/noV79iOhpx784dXE5UD3mcGq335soYIiEORBASyOFDoG07djthD9JaU1UV48mM6fSIyWRGjPBXf/XX/N3P/p779+7x9ltvcv/+XcqqJCVJME/cyAIQE8R+PN667/J56BcRmiexe3DLM9Jbv7ndXtF10F71MP3XtbT/c7v91qA29B0Oim/WhvXlJG/9G847L/u+myt7awu3Pu+nF8N2c3TVwdoqezmIHaWKqG7H8tlj/HqBard06yXNao5vWwl3j4qyHnN8doc7F3eZTGdCYpupcLo+0LSebdMzX+24WmyYr7Y8fnrJeiPUWSkpyOH/dq+huVyOJOc5DflJOUR40OYkqXswcQkggTycg+njhsVbkq1DFIJin00bIcbsF4v46AHxe3Vti3OG6XRMNRqhMhluH6FLEBJ7YBsAVJvhWgrAoDU2eSoT6ddzTLekjlsMg7nrIBhEDUm28l7lQJGUb+Ae815+BvIuVULY2/daXn6aFXnykolw0RBEa62MZjIaMa5rVsslm01DTAbjHEkbtCv2OVhWa1KMbDdbiqLg9PgYYw0hSH08bSSHKyEJrRJIovLEAlKIchxagiAUUv9MKwUx0HedRKv6Xthk6jFeOZ5erviLv/452w7KaoayFbs2sGlkpm77Fttt0etLJmnLH3z3dX70zl3ujaHo5thuQRm22NBhgs9aIWhlsEq0+RgSKeWJEwcacb6WrzIBD6aU/foH60iTCVXE4NFsUok7fUBXHrPWtYAaBxGgg097EEJJNDWFRJsGclHQ2KNiz8g3uPU15W5J5XdUYYfOz29KSSp8J0OjC1ZBc93DKhi2qoDEXktzmfKuKiylk6jVNiZO7z/gz/6n/5nJ2R16JbmNq82Wv/27n/Huu+9ydnKKtZayKri4uODoaEbwgcurK9brDZPpBGOMRCR7TwqB0LZ8/vEn/Oe/+At2qzXH4wlVUezPPWYiBIlU3tF1knYTsjUn7atgS+WGECSHNHgpUgtidjw6PmUyOSIllQOZ4O7dc+7evcNoPEEpRUgSLax0jt4dbtttUTrc7f3rfrzt189ToT2gZb9r/nTYXtV30+TJ+odp2Yf2Faj2/wNQG5qc5HCq+2t4IwMPAOpmva/cXY6o2g++/a/kN0kliToj4IiY0NGtF6xfPMV0Df16IYC2W0NMlGXFZHbM7PiU8eyIoqhQWksBv7bNpgFousB217NY77heblmuGy7nS5rOZ2EiSd1SMl5lTsdBYxMf26CNpjy718ZgcoLryy3GiM8BJD4zguxZQUJOps60WH0IQrUVAj6IDR+ERDd4ERCFsxydnGamepXL2Ai4+aSISghtJdoqR5emJL5LpTEEKgN+s8A0c2q/xqq4Dw5RSlhCkkJAbBBy2SQlBhh5MAcTyWDmG/4qBrNl7to/x+JwEEBTmKRQIUqqQZT7XDpLXUkNue22YbHYEpVGVzU4lxNS88BHS7Lreo3RigcP7uc7kI9SiS9lCGdXSoRz6H2uiWVQWnLOhomAAtHS2o6u70lK4+oRuJoXyy1/8/MPuV62lKNjtK3YNYHVthFS6rYjbRbozZwj1fBH33+T33njlIs6UPfX+/wz26/R0TME6A+G6X0Fd2WISe1r2e3BbZgOZC1337sfQ3L1h/cD6MkVkeTnqCxeWRo9ojh7na2bslYVG1XhM6NMyvdQZ7/HEHUpoBaIgM/mURV7TOgY+QazuKTuVlRhRxkadBKzXUqSPiM+tYJV1My7xCoadqqQ58l36NBjoiSbV85QFo627yhnx7z3uz/ij/7kz4iuJLkSHxNX13NePH/B++//gKqsSEqiC+tc/85Zx65pWK5XdH32dapsD4qBdrvj7//2b/ns44/BB8ZFKZpljJnsQPJGu05Sbnzf4YMnhpxXljWrwUeXotDk+d7TtR4fEq6ocIVobbPZCaPxFO97RqOKk+NjprMZVWVzPpxoiANCSWL4l0Wo4sYiphhWv9HMJKI59+WVXt5G7v6aJuPsH6x9BaDxDwFq8nLw5Tc+9pdXOtjKy1/tu/Y73O9mv7s9AB6YqLLZY5CGEtocsCoRd1uaxTX9ZkVqt+zmc7rdFqNhPBpzfHzK9OiYqh5JtFTf47s+54C1hN4TEngfWa63LFZbFuuG5XrHetPg/ZB7JWH8Yl4QcBg0LzWYp3Q2cZFBQEm4bgw3D/igmfne03UtbSdCss+LkBOLhtaHQO8DfYyECF0vIBejMA30XSdmjr5HacXxyQmFEyaCPiS6EAgxieM+iYY4mE9ubsNtUAvNBpoVpt9KYq9W+boPIJZF/HCf8iCKeYY6gNitx3R4DpKCqFAps6p/aR0BpIRURZD+iEo9kYA2MJlUJCKbzYrVdi2J0cZitcIICaTkW4XEfD5n1+y4d+8+9agSkE3yPBljhH4s5TyulISRJYn5aDBLDuYlEIHW9x2djyTjMMWIVRP4+PNn/Oqjh4xn5xg7om0869WWbruFfkvcXGHWjznWK95/85g/fP8tTiqP9mtULxqxQiLikjIkYyXM3hR4ZfKkZPhsicbKetqQlJVF59dMWZaURJlGnaNRlcmEAjd9QVt6Zeh1QadrOl3TFsfYszdY6zEbSna6ImUQHcboAGoyMZExSRKfnpBLJUzoscFT9Q1pcUUVGlzssKmVcP+UwRRFTJpOWTYeFl1k4zUNhQBm6MB3Yh7XwvxTFAWbpuW1d7/DH/zxn/Dau9+lTQpVVFxfz7l8ccVsOuX05FQi/LT4GFNMEthl7L6umfe9aFxNQ9+2JO+JXcfP/+a/8PzxY/ABqzWh7/C9VMSQcdrnSWmfmYBEK0sxkeJNwFjKAWnC+iOUdt5HEgofIkVZcXR0xOzoGGMUKQWquuDoaMZkOiJFhTY31hDx68s1fmkE7acteWiK2ZFD+Xlr5QNJ/ZJJ8ktbHnBn6H/F9/8I7b8O1Hj5JA8+f9X6t9rLK30dsA2XPn/18vfDjJtMWDD8Ypj1K0RTSxGTAu1yQbucY4Nne31Js15iNBzPpty5c8HxyQmg6Puetu2EhDSXb4lB6mcJ32LixdWC+WrLatuxWG7oOmHWVgmpAKBVJhcWUBPgEs1tb8YaTHC5pLv3Hp/LTQj9lURVdW1H0zRs24Y2s4d0fSfaWZQaa7IEqcGUAU6q6uZ6TFHCkH3fk1JkVNdMJmO01rRtL74cpUnaSrJvGnx0N5ddwr0NlkRpNKnbkbZLTLfDabVPas83R87tYCEnhAqMDQNjcGwfNEUGNQ1JfENRydDc+wqGiNe0fzpQKgAdIbRoFagqw9HxjKpyPH3xnF3bo01BWZTYopSAd+2wRU3X96xWK7bbLXfunAkr+96nKcmspCQkwCR815NS9qFlhokYelKUsGwfvExAYiLi6JPhk4fP+fCzZ6BrxtMzNjvPYr5is96ifEPczvHLJ8xY8v5rE/70D95jojaYbo4Ou2zilWoGxgg4BaVItsBj8BiCsgQsQVmSkYVcAiZpK+CmpW/4Lg58nPoQAPOiZRFQs/SmpNU1vanx9Rn6+AFraraUtKaUlIf8zEgw08HNZ5gp3IzPlAI2eFwMFN2OtLyiCi02dZjUoRUS1k7MEabQK8c6wLKLbIKAmmhHHbGX+nt1Tp3RxpKM4ff+6R/xkz/+F6SiokMCR7744gvm8zk/+P73ub66JEXJOzTOEqNEti6XK1AwO54xnU4IIfDs6RMWV1eErkOFyGcffsSTzz+n3W7RKRG9p9nt6Fph+2m7lq7vSCCTnU6o7eLgnxsCvAZgi5ITOZSd2u2EIi9GKb80mc44PT0mxp6YQq5FeIy1MlEm1/uTc8jBI/tvpA2jZugX+foVsvhVoj1PXr8EasON3bcv/fIfpf2jgZpcmIP1fm27uaRf99thX+pg4UDFlr4MfvtNyozCECm0ot9t6FZL/HpFt16xmc/RMXBycszFxQWjyYi2bWmaHc1OuBZ91+WlxWeGDu8DTdvz9Pklq21L52G7E99Jn6MONQiLgx4A7jAwRMCNYTYVJW0gpSRmxKyBCbC2Unpmt2Oz2UoJmraTGWC2u8eYpBx8vGHsb5pun4YQQ2Y7yI56GTiRqix4cPeCwhhCjNm04klKIvmUEuBQWeMyB4TFViGg1veE3YbUtzjniEk0PUmPFhNVn6y8H/pwBCVh7UHl90qSX6V/eC0IsZDXXN077JcsuHGileiCgNTnslaqRmslOYzGKCbjmpPTM/7mb3+GsYVUxzYFSlk6n4gI3+Nu1/Dhhx9wenrCyckRo1GN0lIqxmidUTlCFkYpJ8JKYEnC+y6beOU+9CHgk6GcHPP0xZJfffyI+brn/mvfomkDi/ma3WaLb1vSbk5cP6V98TG/89YJf/Lj73JSJUIzRyfJjQzK0gZFkOIsdLqkNxWdqujtiM5UeFMR3JjgKnpd4k2J19LvdZn7qn1fryt6VUi/LumNrNPrkt4c9lc0uqI1NY2q6cyYODpHze6yoaLB0WupBShMMEOEbp687HPYRViLSRpSDNiU0za6HXGzQu6mcI+ib9hoYpIx0yvLJsCijWyCpaEkkYh9Q+jEZFkYRVEUbJuG1996m5/88b/g3R/+Lm3SmLJmsdlydXmFNYa3335bXAU5sMtk1hetNM+fvUApmM6mKAWzyZjj2YyjyZj1YsFf/fmfY2Lis48+Yr1YoPMYC8HTtU0uGyVMQCmJBSX0whIkj9Ngdswm/iSWG9EMZXLa+R6ytoaCoiiYTEdMpxO6tkFpTT0aMRrV+xqPMYr/cx/olMXiMLkYXPU3Enj4fDCLFYS66d+34f0rQO3WFl/+7h+vmZ/+63/z775yhwNWfMXXr2pfPrGvaHnbsoimcvh+uEgZng62/PL2ZX1rTH4QZEaoyAwQQ9ScBqMS+J7V9RXdeonfbtgu5xgSZycnTKdTlFa0TUvb7ui7NuehiDM4hJ7gO3zfEfoeHyKX13Oev7his+to+sh229Bnc4KKYc+yIXrFMKizjpIdw3ttbE9KPPjMBMy2221eNjS7RmZ9XTZj9OJHE/qeiO89fR+kP0g9tOCj0Gx5CfVXeQYZfcBoTV1YTqZjYd7Xon1IFYCAj2Ji7byYP0Hs/CFIWHuhDVZrnDHErqNrOmLWEjyOTldiolI1naoyT0RNqypaJQUk5buaXtX0HLzXVe4b0SV5721Fbys6ZaUopS7xekTQNb2q8KYm6CJXAZCrbjSoJLNgTaQsS45mJ6yWa7q2x9pCgtN1QTKOhFB0+eB5+PBz4f0bjcS3kCIp+H0oe8padczUV0orYBBOQx6SJ8SELkb00fAf/vJvWW48J+evEaNhOV+xXizpNmtCs0FtL4mLz/mjH7zGP33/bR4cO2K3JUaPj9BSslMjdqlmm0rWsWIdS1bRsYoly+BYBsc6OlaxYBUdm+RY5/dD3yqvtwx2/7qOjlUqWKeCdXSsU8EmFayj9G1SwSqVrKJlFRzrWLJJFRs1Zp1KNrFgFzW7IMFIXduKCa7r8W1H07S0nd9XcRZhLSb04D3JB2IfCLsd3WaDyd67Pnoa7+mTmOASmhQT2wDLPnLdeDbB0FKJ7yj0pCiVI1wmpf7Vxx/zL/+n/5kf//P/ltHJKdE4lC345Qcf43vPaw8ecJKLblZVSVGVYBS+82y3O8pCCMghoXItRmKgNAYVAs16ze/+8H2uX7zg8vkztqvVPve063t8GCwvgb4P9L1MRAdAC97nsTxYU8RsGEM8oJaTCh4++8vJGRiTyUQirZM4e2dHRxSFlu0rIX2IOTp6AKJh0j+4AgYZzC1Au1l//37ff9hug9rgv/uSvH75Zy+14ZhebrccE9nK81VNLebrQzi+3bLWdSCOf33Lv/m6tr9Ew2r7N0PLV3ZYV+U/r1xPXowxxBCEtTyH8scYpfS8Eo+504lus2T+9DH9/Jq0XtKvFkxLx/FEhFbb7ei7LYQWnQ5KtHQCZF0rJr+YEklZnr645tOHz1g2gTY61ruO3kdiSKiU2dCNRhl5+gbmd2NzEnau27WvoTbcwGyG7HvR/Lo2M4z0EkIcslYmSaZSViZGqeUkD70MmITM9ELvSTEzfRCJvoPoKZ3hzvGMb71xj+mowlRjuqR5vGh4tGhoTKYOciX1qMY5jTUKV5TUVc1sVDEtLVOn0JsrzOaKsfFUuqPUIZ9rPj+dS8sY4VUcQuKHkTQwVzBMbpCnXCctPjUUyiYwkRR7rM6pBTkwgpQkFyh6RnrH2HaUqsPRknwjJjkMW8asmfLXHzzn06uOnT7CHT8gFMe0qaBtt2w3S7bL58yff8rvvf9tfvTD7/Lm63cYleKHK52lMAaVIm3XCqgZI7RnQN8JwbTP5YFCUnhKfvHRIz76/AWqmFFOzlivdsyvrlnPF/TbJbvlJd3zD/gn35rwL37vDV6/M6ZMGwFOZVhue662isVOs2sjKSmZvERhu0hG2Ff6zJ2Z9snfMgwSYrYbgjXSICzzoFRKilpKu+mXZzJHsAKBJNRd0RFUQXBTfDmjd2M65WgxhOhzLlqSHMqh7l9mj0Hl6gcpkHIidqGgIFF1G8zqipnqmNie2rRUtLjQUCYpRWS8Zxktj3eJzzeJZ2HEtT4haUW3WxC7DaWGOoNaNR7xf/m//t/40X/zx6R6QjAFO5/4T3/9X5iNRnz3nXcY1xUx9GK+s5pt1/LixTXzqwWv3X+dqqqklJPvJDc0Bfpmx/LqkvmzZ7z54AF/8e//Pf/v/+f/i1/+7GeklChKIXSW6g9DRflSAouyhqRkwKNydCfEnOZg6EKkDYkeTVCWqB2unnB8es7d+w+49+B1vvPd9yjrmpgio9GIt7/1FncuTlGDW0Pl1J8kbhEG5pjskUZG4M2xKLnrB9L69vsDX5p03YDaHtD28vpluf01TR3s5qDJ83fzhbx9xYr8/wuofenDzcW42a9c7tvt5rPOLPvC4CAhrDEECYokoHTCqcjy+VNWV8/pF9ew22BCz8lkTKGh71t2zZbkG3RqKYzMitquE8LR4GkbcfiCImnH5WLDLz76nMtlQxMdbS8+rRgTJkXswCVoNBywiugs7CWsX8L4U+aAjEn8dSHILK/vO/pOoqCCD4SUxKRINlnkwqBiZjgwd3mJ9w1BkrCJMbOvS+QZwVMYxdlszIPTGUeTmnp6hHYll1vPh0+uuGwCu2RJxYgyF7G01grVlysYVyW101QGitBQhIbaJkzqcTruAW1IXVBZm1Fa2NkHhobhXgqY3dx/pSTqzior5iuTSCZC6kWzTDEH8osvqyxLut2GOqy4GCvevDNiantUv9qzgexSSW9nPF4G/u6zaz696lDT++jZfXbUtF3Hrmlpt9csLh9RW8/3v/sWv/uDd7lzOmNUWurCURYWDXRdQ1KS8qDzbLlrO7q2Fy0tGcmBut7xH//zLxgf38cUU1bbyGo+p1ktaddzmvkzmsUzxvGKf/Uvf8y7FyVGRXy3pU+G613g6WLHs1XkcgvbJoKy+2clpQhGE7XCD2Y6JFhJJwmrH67zIHhSDtJJKY9dNRDgIqJkEB65TwzXItRigpDE/Nurkk5X9LogKC1FOhFNRmdBqqKwYYS0J7XLsiXl0I+ETYlCQY2n6DaM6RgVgXEZmNrImJ4qtBTBU/ieTTQ8aSKfrzxP/Yi5OQGt6HZz+mZJZcXv62Pg//yv/hX/p//lf+H89bfZYUi25Isnz3j+4op75+e88eA+BMmx1EYqjy82az795DNCn/jW299iVNd0zQ7ftRgiBM/i8gUvnj5ht1xSGM2Tz7/gr/7yL/nZf/kvbLdbjJGJpcqcjCiLK2qUFnJonX3tJvuUB7BJSnzXXYh0IdGjCDmFQtmS8eyI07MLzu/e57vfe5+zO3dlEukMd+6c8847b1PVlpS1u5QG7kq5u8Pr4H1Tw3jL9/4WiN1CgH9EUPuK9puA2q83P37Vd1/VfpPfHK6mXtkhxz3oxF/a7s3nlFVruWnDxZV8KZlRRVTfcf3siUQ8dg2WQF2KcPJdS9M09D6XlwktKvX0fUvb7PBdQ/R5hgZYK2XglXE8v5qz3DZ0UaK4UpRpsoRSZFEwMDUcpA+TQTshUYkxDgEeXgJAcoXcrh0ipoZctCgRjTkopA/ibPa5+GeIiT5rbL0XM4VodyJGQBKnVR5EpVFURlHmKDFnBWj7ELi8uma72+ETtJ2A+UA/oXIofMrHHZHill5XNKqgUTU7M2KnRmxVxZZSzFqUe5PW0htWwbEKllWwrL1j5S2r/Lr0lnVvaGLB2huWHhY9LFvY9DDfRRaNYtEo5juYbxO//OQRv/rlh8yvF9w7O+doVKJ9j04Jq6EwFkVkMqqJaNbbhsVqiy5HBAwpIebIHLxwfXVF37ZUheNoMs2VAuQpj/l+aZMwVn4j/lCZZPiYUKZgvev4+w8+Y91EJsd3CdEyn2/ZLhco35J2S3ZXDxnrhj/9yXv/X/L+K9iyLM3vw35rre2Ou96krbTlu0yb6mo/PT3TA2BmgAGGGAADkIqgSIICQwBEQgxQT6KexEe+iA8MgnyhGKEQERJEEJwBMANw/LR35U1mpTfXHrfdMnr41j73ZlZ2dXV3DQaQVsbOc88+5+yzz95rffb//T9efuYsfUq5byHlsNG8efOQGweOnSbnMAyZ0GcWeszVkFINqOgzo2AWCkpVUGpp2lnpgtb0aXRf8mC6oNI96sXj0VYpyZdVOn/036pYdLOWfFuPRhfUZDTB0PpYTh3JoYNtI7uNdFdHCUuNRBpkbgak8wRK4ayPQCuZy7X3zGzL1La0ntgmR6O8QrlA5TUVKTvThrFNaMxQZKlvsU0Fce6bLOff/Zt/kzMXL+FTKQwPyvDKa2+wtbnFya1telkGXuo45awUZVWxv3fA2bNnKfIiNgduUc6Ctezfu8f1K1d49803eP2VV3jl+9/nrbfeZDI+lK7nSYL3jrKqxHO3LdYG6VZvJcfd5dBEGQRActdKqbimxZANSFlJh4gWkRkIaNKsIMl6i+7v1rYsLS/FPo1Hn+lAaZ3iFCl09ChG5QcptDgeFsWdn3dM8Tx45J90POK7f8T4U1Jq8UQfeNujLsCDxwnvO3b3d6fFBbYaEA+mu3mpCmhvaaaH7N+9jSunpDh6iSJPFG1dUs4m2KiwFBbfzqnLKeV8Tl2XeNsuSEaFPknAEkne4879XQ5nFTZ0vakkxCOBBnGElT5inGdRhyVWjQ8dwCMWlsa8muTOuh5q4qm1tqWxVry1IKHROtbMtG1L3bY0VjyExlrx0mIoNgQhI/XeYm1D01R415IbxajI6WcpeZ6SJJokS8mLnMl0wrysaK1HK2lwmqYFWZaR57nU8GQZaZqR9/vkgyFJ0UcXA0wxxPSG6GKAygeQFpD1jm1FbHpZQNpDpdIAk8W+uD/pEUyONynWpLQmJSQ5KpX9pANIB3hT0PiEm3d2ePfNN9i7e4dTm6tsLQ8otMNoL8W+XkiixbNJcAF29g5oPSiTEYDWyZzy1tFUNeVsSnCWrc0N0sSQdEjI6GWYRPIWoHA+SJjNAyqhcYrb9w94/Z1rnDhzERtS9vcmjA9nYGvsdJ/m8C69MOWZx9b46ueeQ5c7ZKHC6ZxxDVfvTZknS7B0gpnqcXvccHN3ws60Zu4VjUpjGxaB2/skx6cpLklxOoEkJ5hMtlQ2sgKyApX1ULlsIc0JcT9ZHu9ZAWke31ug0gJMik4LVNaPWw+VZiRZRpbLPCry5KhVUKQcM4m07AlBkIwC0A/UVSWC11ps67C2ZTqfUrY1pWtplMKYBGcdmUmENc06vMmYe83utGTiEhrTF4WKg2CZlyVZUfDS5z7HL/zSL5H2h7gItBlPZrzzzhVWl1fJkgTXNKSZICW9F55HnaQsL6/Q6/WE5KBpUN6TAvdv3eYPf+93+cYf/xHvvfsO88kEheTwkjQhSQ1ZntEfDOj3+wJKQkkRfisQfeesMI1E2iyRZlEmBOnP1inYThOJ/S6yTuShxqQFOslJU2Ep6tIRg36fLE8lOhKPf1ypyd/xWN2+BxTa8fEoud0NiQQsPhFkX/faTzMe0JMfYvwphR8fddGOkZ4ec1uPfpCoG/mChxVbpIhCwAshIBaXgoRAhsNXcw7u3uTg7g1CPSc3nl6iMHjqcoaPzTRDCLh2jq+nNNUEa60oqAgSUIBSCWiDUxmVN3z9u69x8/6YOmT4IJY+AYy3mGDFOo19s+QAMbcUH2VmIZZqTALbtoP7RqRlVGjWWlrnaYMXbyxyzwmgRTw357xwG3pQSoiRk0hAq2MeoMut5alma9TnsY1VtpaHDIYD0jzDa0OD5u7BhLdv7HBrv0T3V0gHq5jeEnnRo+j16PdyssyQ54aiV1AUmRAopwlJF2rVwmQfooI/uo3RAIkeNsh1E4vvaGF0r3nnaJFNxfygb1spCvaKpm4YH4558wffo777Lhtpywtnl/nVr3yCE31LYlqUqnA+gE6prWamhuxUmtdvTfjBtQPS9cegWGUeclrrqaqS+XTC/PA+o0Lx8eee5ImLZ1hb7jMa9MjzBKUseWFAebwHa6FpPXUjhNg37+7xznu32Bs3bJ68yP29kr3dQ6bjOWG2D9O7XH/t67xwcY0//+WP8+TZVfz0HgmWfdfjxthzda9l6bGnefX6Lq9euUFrCj756c9y/tLjDIcrFHlvwVPZdQxQJoCOaDoXAVRRoqlj3sDxNdWtzePhnaNQZbwRITKoKC3lARI4WxhlYKVOECFxlhIYJWUTsZawaYUQwHmhyZJaP2kMK2Blx3x6wHx6yP29O7x3/R1uvfU6W5nhzLDHGp5hU+K0YRLgrTu73G0zpvma1Ja1c6rZIXsHu5w7/xh/+//wH/PFr3xFwCFZQdkGrl67SVnWnDp5Ct82qOC4dPECSsV1FQFDLrZzca00CnZ1zf69e/zLf/qb3Lr2Hm1dkiVS3I0SxGPbNtRNg2stZVlK8X1ZSfrCChNLWTWUpXS9JnjyLKUoomKK4fo0y3AhYOUW4gI0LtaPpil50ScfrrK2fY7VrVNsbW+yvrHGYNAnL1IuXb7I9okt8jyhtdITUnEUPhQQ29Gy5NjjkXxeLMb4Yrc/vro4XPzk8b95+O8fdxwLgR/f+4h93fjoldqHGd0FPbZLrkP0ZCAqtkcpNYQ95H2f7kJr8TPexdbwntQ1tON97l2/QjPeQ9uSVAtLP76lravowUghbVvP8O0c28yjxydXoTs7UU4Gp3LuHsz57uvvsHNY06oePsjCVSiMb4UHUWtc4IhsWXcw+SNlRpeAd1KjYq0gGG3b0rQShhQmk4a6bZnWFXUMR4bI7dh93sW6loDCWk+apGSpoBQ1nlRDnij6ecrysM+p1WVOry6xMepFiLuEkGwIVM5z7d6EK7f3Oag1yWgL018l6/XJih69XkaeJxS9lLxfkBUZaZLQy0S5SUcCyakppVCmy6lFpRaOzDu5OnIhOjqmY/al1HvhaWOuhhgK0kE4H6eTKffu3OX173+HdHqPrbRl00z5t//sZzm/buj1PFqXAuogwTrNnIKpy7kz1/zRqzeo8jXob1Eny8wbT+ugKivmh/dx9ZTNlT5fePlFTmwus7I0oN/PSJJA3tOAw0pUisaCxzCdN7z21lWu395huHICrwfcvLPP5GBCWzWEyT0mN19jyR/w5U+c42c+/hg9VRGqKdpobtd9rs0y9hiRbJznd779BtPG8vQLH+cXfvGXWFlbJ0kLtEpiaFsMPK0DSnuBwgcJc3VpkIUi47jJLg9H603+CB2o5Pg+r4RBpQN8IM0yhYfUQmgJoYWusD4EQpBgPBiCl7yv89LsE8C2Lt530STeW9q2oqpLxvMxV2+8xw/++A8Yv3eVNRXYMrDmW1rvmGvFO/d2uF1rpukKymh8W7G3c5ckS/j8z3yev/v3/o9snDyJQ6PTHrv7E779ne/x7LPPsbK0jG1qFI7trU2UhrqupF4zQK/XI+CwbQNNw8G9+/zgm9/ka7//e2hrGfQLhv2CrMjxeFmvjTTwbaqG+WxOU9XYWsqCmsbhlaZuhLC6qqpFlChJDGmSRo8rIUnS6Pl7rPfC9OMCLihMkpLmOUlvhf7qCZY3TrK5tcHG1garqytoozhz5hRnz51mdW1ZYP0KyWaqAF0OL8q1znw88tS6Ie99OI8WODZhupxa4Ghu/dQj6p2j/45eecS+bnz04ccPO6I8f3Df8Yvx8IU59vyB9x0NFV+LS08IfIO0uy8P9pnu3kPZisQ3KN+ArXBthbUVKjhc28TmfCXeSXO+bs37yKxNvKA+QOPh+u173NsbUzvwRqDhRwwhXW1OlxQ/Ou3OUFgk6jnuu8vkCBHh2IUj2y4MGTkfNZBqTZ6kFHlOL8vJ05Q8zUjTlCxJ5Zy91FMp70nwjHoFw17B6tKI7fU1Tm1tsrG6wmjQl4LTJLKgKE9iFEmaEQLsj2d4I2G/Lp+oE4OJNWHKCMpKa7Wg+dLE2rzYP810mzEk2qCVPE+UxijZl+gEoxMSncTnhiwew+gEk2SkOkUHRYImS3K0MpSzObs7u9y7c4fM1fR1gPKQi6c2WOknJLlCmZh7DWJ6uBA5N9OcxnlmVYsNWkKbGAIG7xUET1NVHOzvsbm+wqDfNXnVJIlGbnnAOWhtwAeNTjLu3t/n5u0dytazvHaC3YMZ+wcz2qqWsorZHoe33+bl587zyadOsTVo8eUY5RyonPt1wl5boEfb7NeGd27ucP7iZX7hq3+G5z/2HGmSLL47MihilEcHi3YebR3KQxCrSt4mZKAP/S1uQHBCzxRih/XghKz3gX2+4yiUEJ0U90pYV4rOG7xvCSF2aw9iZHkvhcCh60EW688EwRpIY9mNlNg78jwhyxOWVpdZXl+hl6Tcee8afl7S84G+UrgQaAgczkumNlAhiMLgLPt7e5y/dIGf/zO/wCc+/Wm80mASmtazu3fAzs4eTz/5FL2iR5Fn9IpChLxSjCcTxofSZaPX70lhgW2xVc2d69f52h/8AfPDQ3pZxrBX0C8KslyU0ZHhFruRRMNARz7QDoqvEumtmGYCvDKJIU0SsjwjLwqKokCbBGI7o6NrGBaNW5XccZxKMVkhqGpjSLNUwrvekWYJvV6PNJUO5OKpRUnT2dWLox0TUnTzKo73i9xj4+jTR0f8CMaRlfWhx7+RSq1TDu87t+j9SO6NSIvlaSdjZns7VON96UnlG7A13lYEW9E2Jc7W2KbCNhXBtYQgDCBC4yfekw9Sp+WD9FebzGquXL/FuGykaNjkEhZQBu8F0q+IlioceaG8f66EOCk6Roqj98nnFYokMeRZzqDfZ3Njnc2NdU5sbXFye5uT29tsbW6ysb7B6vIKS6MlRoMhw/5APLQgIrqXZZzc2uDE+jonNzc4tbXJyc0N1paXKYqcJBUhnecGowP4VpLQScrhrGJSOkLaQ+mUoCVMopRDG+mD5XBoEKUW+5s8DJSSEXd6uY8SchI1qENHUXy0JYD2AaUMWgvRMzaggyZNUlSA8XjCzZs3OdzbpQiOgYbEznlsa4X15R5ZYVBG7qEOAd1FOSPNVN4bsD+eMq0c3uQkeZ/GBpyXBLhtGmbTMYkJLI369PuFNHtNjCDJFFgHzoEPBuc1b1+5xsGkJO2NUKbg7s4h87IlWEtbl8z3blL4MZ97/gIXtnMKu4N2tbCnqB5354Z7dYbrrXProOKw8rzw/Au8/NJLwr7vLC4SWoeuHZAKkf8ykPiA9lJ4HzpjOy4g1aEiEbJohWDsVeiw9vHv44+CwZd7FwMmAWKiR2i7lBK2E7VoZyMUZgEVc7tdqkBynARPlmhh7fcWExyJlvpC51uCBp2l5Npw9Y23qA7GZNYyiN0SSmuZVBUT66ni2nFty2w25cVPfYqv/tk/w+aJE9ggPffu7+yxu3fAie2TbG1sYYw5UrTx3O7dvcd0OkMpQxYVhHMN5WTMtXfe4bvf+Aa9JCFTmkRLmUsgoOKjj9lCpdSC/koFIteo8FzKJY2pk1hrmxc5vX6fwWBA0estCBqCkgiU92KDxOBMtEU0QWekRZ8klX6BSZpgEk1rW4zR9HsF/X5PWm/J7YdOZC6ka5Q8C/Hz0MJ9SNw+OBaffkBW/2mMDs35ocZiPXwE4+GfrOgW0YNe7oOu8LG/JS6y2BeiQDyioOruXqBtKqpyhgqOVIH2lmBrfFRgti6pyylNPce7BoJFK2nVYpQg3RKlhIk7FoyWZcX9nR12d/domiaG0aQgU8W4uiC7Osvq6Dce/xnqoV/ofQDEq0mTlF6vx/LyMidOnODihYs88/QzPP/88zz77DM89eSTXLxwnlMnT7C6ssxoOGA46DMcDo7+HvRZW1tlc2ONldGIVCvyxLC6POLUiS1OnzrB+voqS0tDer1cOmOPBgz7Pfp5yiDPSPEMU83ls6dQbQnNHN9KPV/b1tQx3NI0HUJTLHsf2RHEYhRwSmul3q6NOUPnpCRhYfl7KWkQ6z4yR0RLN4gGXHBRhhg+EUERkXN1S2JSUpNilFzDpumoztoFKlEraX2SKE+qLbRThonn5EqPUeqx80NCM0cHT57lpGlOVgwZrWzw1pVr3Lh7j/F0TlU3VHUtwsVGRhg5SfYPJ9y5u4P1mv5ghdm8YTYvRYDamtneHQ7uXOELn3yaiyeX6FFDU2KCAIwEBGSpHVQ2MJm3mHxAr79MmuR4F8E7SUqWJqTGLJqCJliy0FL4hsJXDKgYhJJeqMhDRRaNO+VaiIX4wQaUjzybXqGkhd2i3YsYWJ1CitdQEUOcDu9aXCTOXoQs44PMchHgHSemtC/q8tUO6xpRYggVVt3Wi9Y/wUlfsd5giFeK2lvaYPFIJ+rgXCRwVtjWUbeWta1tLj/5FKfPXcDFnm0ow97ePgf7B5w79xhKgW0j2Xc0ikHR6/VZX19naWnEdDJhPpmifKCczTjc38coaOs6Aq5qynLOfDZjfHhAFXNotm4I1pFqTRZp1ojygZhHNlrCjTLHZM4G52li6xm5eDH/GblFtdbSsiqSpANY28bvFaLkqpzTy3O8tcwmEw4PDiinQtauiHL2ffI1ft3DO0D2hge3rsvDEQYivu9PePwo502HQAyFHf1bzMTFaw8qsx9xzAdGp6Qe3hZKaaGcuoscPxcvuFJSPCqhvPi48Hm6z4sl6Sy4NgpJ54RJwFvqpqRpSkJo8a7BtQ2uqWnKknI6wTY1vm0JzkJccCp04UvQTro4Z0YEh5KUHcEHytkc31qBLrc1JnhcU4uXqKN1GpAb77uJEC9iDOV0YZ0Oeh+CJOGTNKEoCkbDEUujJZaGI0bDIf2e9HVSiSaogAsOFzwukr1K40cIRuEjRVdiNFliSDRMxwdo5Sl6GXk/Je+lFEXCsJ8z6GX0soTUaDKTkOmEnjGM8ozNUZ+nzp0iaafU012CndHaOa1rqVphEcdrfKybEihyiwuSCQvK4rF4BK5tvZQjNNbSOEvrW9lcS+NaamupWkvZtpSupcXhtMMpS+0qqmaGC62Em3ygrmrmkznKKxJtUEEsdtkavJW8UqJ0dKccKrQY5ehnip62nFjqsZSCbibkypEbMWyUTtARQVg5uHF/j9s7O4ynU6azOVXVYh1Sf6XBBrh7fw8XEtJsgCdlNq/l2rQNrjwgbQ84tay5fKLHkp6RuoqMBBM03lm8b+K1clR1w7xq0UmByXp4neKDoW19zGeIZ2xQJATSYClUTarnZP6AZHKd+vYP4OAKQ3dAz09I3YwUAUh4J8cJXoPTGJWQqhTVhSC78CIWF4RBxXuHdxa81HaFrrdYECCD5N1MDH0GjAqRssxBkBC6cx6lNVVdo5MEk6c4o6i9x2uNDVLbpoN0rsjzHBKN055Gt9S+BuXJUyMeaeXBa+7tHXDhqad4/JlnGYxWCCRkeZ/DwwnOOpaXlkhTQ2PrWM13RDE3nkxpmgatNEWe0S8KjFL41tKUFU1VYW2LD5a6rZhVM6bljLKOtHqzOe28wpcNdlZhywrfiNyxvoUIztBKfpOE2RNSk0iJjPNSvF/VNLXQrQnDiBh2IfYX9AjpQsBjtAJvcU1NW5W0VUlwluAs1WzG5OCAcjZbUPdpJR0cJBJyTPY+oJO6vce24/IrHL1Hda996PGw1nnEv0coGtn3sEZ6cMRKy+Nb9/b4oWOf/TDn/D7l9f7LItft4XN6WPEt3itWoYJIUyT7HriyIZ7ccSsCUCHQNBV1NadtBb7uXSvhRdGA+LaRm+8tPm6LztFWtq4/lw4I/ChAlmasLK9y+tQpYeOua2hbcK2EUWLIsvPSgu8M1YcU2QPPj3IXcvcEZquV/J4QAt5Kjq2sSuZVySw+Vo0QHMvWUNuG1rbSzkXJNTRaOj03dUlVzvHBknYgj8zQL1L6RUqeGvHoTEKRZgyynGGaspQlPLa5wtYwo6dblC8hNAQ8NiAdn70iOCLLRQcGaPE0uNDiQxuVcFhsNgTcsX82uMV7rFe0PtDiaZXDKouot4baltIRW0PTtsymc+qyRnnJ6WlinCY4gnfgvbwWFMoLlZIKFqMsCS1ZaFjJYK1n6GuHrybi1XuHUhE2nfZQxYDbe/vcvHefyXwm9VSRf9P5gA2eqm25fusOJilIswFl5ZjN68jg32LnB/SZ8bHz65xd0SwnJZlvMC6GAAmghTQA1SHfFOgMZTLQqZAOBwlv4YV0IAGS4Eh8hZ/vUd19lzuv/TFv/NFv8Prv/U+8+ce/yZ03vg6TO+RhLuTIvpW+azYQHNINwSl86/BWcrLBO5xvsV68KetaUWghcjNKj2tZylEROSuEvHhQPoJ7gl14bRLyk/C6NlLRaUOgCQGrlXQdUFqiMGJrohMDicIaR6NarG7RJpBqjQkK47SwyyQpH/vUp7jw+JPxWqVkWZ9bN+8QguL06dMSEkTC5kHiAFjn2N3dBaTRprMtwTt0vAkahQqBcj6jbmuqpmRez5nOZ4wnY+azGeVsTj0taacl7XROOy+xVaxz9XYBjlJB2HK6fypI6yyJ5EZ2oFbaRElu0kX1K4oNhXQwR2jvOuPNNRW2Lmmqkizyb7qmEeUcw3M6NjKX6XU8dChDEVsQLbbjMlYvNjnn+PxBCf+jR4iT5YdtDymJI4X2weMR4cfugO8fnZL6kxnHDv4IrSeX6Xgi7v0/WiE5MKMjDsy11PMZTTnHt/WicNI7K9uCfT5uXbjMSfirbaVlSAc99pGcFB/IUsPK8ohLFy9w8sQ2/V4Ru0ML/DeEI+8rKIUNnhaHDT5unVCPz6Pn0nlcLghLSOscddtSNTXzqmRSzpjMpownU6bTKbPpnHJeUZUNTdXSxs3WLa5pUUFCN94FAgptBE11OB5TzkuMkm7AaZ6QFAlJnmLyFJ2lmDwj7RXkRS51R6lhpZ9zZnOV9UFO6mpS15B4i/Ee5QLBa5xX8fe4+BjEi4mYFe+i4vYheq8ilBf5nONzu7uzMSzmrdSOyW8S7kofHGU5Yzw5pGoqfCS/9RDDSbFYPGih3AoKpYw0zuzCKM6jvCXVsDzMWeonzCe74CsIDVp5ScKnKUXRYzyece/eHocHU2wbsG2gbRzOgm0D48MZO7v7pFkPk6TM5yV1XZEoaYTpmjm9DJ64dI6lUY8s1RjtCSoKLpMQdIbSkttMtSNVLZluSbUl0ZZEy/MslAzChJHbZ1DdJd19G/ved5m+/ofsfOdfcvcbv83Ot36H8ff/mN3v/AF3v/W7HLz+TfT99+jPdxj5CQOmJO4QHWYEVWFDTR0czmi8kXY0oUuSBQFTdJdXuhMk0gg3IvaSJNKixXY9guRLMCYhS9OjbhWRcDfLMmHb0XpRtCzLvRO3EvqUTgkxB+uDKDIkPWC0EqPItVx+/DIvvvgi2ydO4EMgMYa2bbl+7QZlWbK8vCTGYtcGSimITDCz+ZwkFSacJvI2Oi8lNEma0xuMQCcCyY/bbF4yns6ZzOZMZiXTecmsrJlXDWXd0lgfYfkCbnGha6Mjska8sCgvCFG6HW8GHBmDopEsqyJeQ6Wi5yzlPa2VutVyPifNEpaXl1hdXWF5aSmGK98vOxfjh+yGH/Han/D4sAoNCT9+0BuPfvxx3fsh9fBPOI6fzyOU1iP2Q9R3Mdci+TBhM6hmE6lDaxt828R+aAKhdU6sMLHRYvFj9JJCCDI52oa6lbi5jcXXKuYGEq3ZWFvj2Wee4rGzp0kTE3MGMYsrJ0VQ4Ii1ZQulJh5JGwW/i0ixTrlJXzQJzVVtw7ypmFZzJvMpk9mU6WzGfFYKQWwda9oah22c9HqLFl5n7bWtxVm/uJuHh2Om4wnBCrAjzQxJptG5wWQpSZGRFDlJkZPmmdTQpIZBqjm1tsTmqEfhW1RVotoG7YV301nZhOlEerrZWGbgXIhhW1G0ISq3GPGNIdqj29st7MUTrwhOOhg4K8aF1gpnLdPZlMPJAfN6LlZsxwoRBZZ0II8KzEubGaWTRbF8lw81yrE8zFkeZlSzA5SvMSqyxCMeRZLmWAsHBxPu3d9jMilxraeuLM4G6tpx5+4OzimSrCDEglvXthLedg2GlqVBztnTmxSZJjGBJFEkaQQQ6IRgMpTWQsqrHJm2ZLoh0S1Gt1HJNeS6JrFjzOQW9tZr7L3y+1z7w3/Ce7//T9j9zr+Eaz/gRLPLeVWyVe/jr73Oe3/029z9/h+jdq+h6z0Ke0jOnFTXeF9iaXEGWhWYWyudwhMBIRgtLWXE6BMG+aaRxrkLYuIgfKxa6yhw5fp1XllHYGAS4TwNXu5rV1sZCxtlzXf5pLg9AG4IAZyTVIFW1E3FdD7jZ3/2Z7l08SJFTxCBaZZx984dxuND9vf22Nvbi7Wi4pFpLVRW08mEPM9J0hQFkTk/UDeWumlJs5zNrW1OnDxN3VhRWlVDWTdUdfOAQivrRsLyVvoa+iBo2zZ21Fhsx/g3g2QlFopuodAWeef4piBXQIwK6Z1mpMGf1Lq2LbP5jDzPOHfuMS5fvkReZFGAypparK0fOT7s+/5kxo+j0ADMf/b3/09H6MfjjtAD++SFI6Xyw8ejXn/UPnjEC50FGK1AGd3fj/r2o9c6i0UQVVJYTFsz3rlLfbhPqOaotiS0pYBEXCM5iyhRpcZGvDUfmfOb2OBP8hsC79da42PzPutBpylp1sN5mJc1B4djtEljjy8JvwT5hmMWWAzRdLL6mKXWeY1HQAnx2ITN3Ea2EOmgKw0GxQvrlIW3xxZCZPy2sV+ThDUl/m6bmpXlISe21hkOCnpFijZBzluLJ0NEXMnnEF5DL59XWtE6y/7BAVlekKY5Sif4YCCi0oi1aIsQquoCLSaSTsfQBsScaXjE/RaFo1HCZB55L23T4GzLoNfDWse9eztcuXKV/f0DBv2CUaJIXE1qp5zbXmFzlDPopWRp9OS1Bh3zo97HvGe0aZKC0gau390hHawQUlFMrYPWtTFM7VDOYggsRZSpRnrQHUxmvPX2NZJsQG+wSllbDiczaVvUlFSTXXp+yvnNAR+7uEXhx6RhhomK1aFwKsPqnP1aM7YJPu2zN6shzbl08RwXLpzFaIv2c2gmzG68zrvf/F957ff/Kfde/zph7zpDV7JsHL1gGZmExHkyY8iTFN823Ll5ncnhPmlw9Po5WS/DtjWOgEoSDuZzvv297/Hd73+f/mDAoN/DALa1vP7GG7z77jvMZzN2d3f47d/6bV5/43XefPNNXn/9De7evctoOGQyGfPKK6/yyiuv8NZbb3Hz5k1CCAyHQ9I0kzINY7h75y6v/OAVvvXt7/Du1SukacrmxiYATdPgrBTcX7/yLru3b8JsTD84iiQheE9rPTuzhpsHU+oQ+Dt/7z/mzPlzJJEs3Af4xte/wdmzZzk4OOT1115jbW2N1dXVSNjgmYwn3Lx5g/Pnz5Ol6UIO2Mj1Kj0Sg+Sas5RvffObeCecjiIvhOlHIt0yTzvgV4gh5NZ7mqj0u3Uvii16bP64DDiamz4WXnefkyUiyj5og/VCMp6mcm69fkHTlLz44gs88dQTjEZD6roSUJUiClsWsv3h8XBU7gN9n3/NRlRq3ThSXg/vk52P+PUPjR/9jmPj+JtD3BEVWqALccQ3LW7G0cckrNwJzS6SKu1F0uAJTclk5x7t5ABVz1BthfY12ksDx+CtxKlDbMwX2Thc5PPrPDMJlago9To6K1DGoGIjzfF0xt7BmMl0FgtNJVQjZA4C3JDfcJQR5GH7I8hiWEz2bsJ39WqRfd85aTwpRLYBbyWH5W3ARYoh8dKkoHVh3cXGpIRA8Jb11WVObK0zGvYo8lTQVMagTYLSkbUynqwJQZRZ8KRGo4zBe8u8KmNhuUGZFKUznA/oaIF3SEXdKTSlUUGUmkauqUJWaweLXyRV45Xq7q93gotz3lFXFanR9PKCprbcuX2Xd95+h9msFEBNCoktSeyM81vLbAwzBr2EPEGQe8g97QAP3Q8NAXySUXs4nDc0JELlpVM8CS7Cr7132LpEe8/K0hKj/oAszXEISOGtd6+xsnYSnfSYzEoOxxOpf6xnHNy7wVrW8vT5dS6dHJG0+6R+FhP7rfSFCwZLxn6tOGgNNhuyM6txaY8LF85x7vxZklBhD25z9bu/z86b30TvXqFf7ZDP91g1lkJ5lLUEC6iU3b0ph9M5znnyLCPRgXK6z97ObZrZAavLQ9LMoNMErw3T1nHj9h3+b//Vf8XW9gnOnDpBP0vZ3d3hP//P/3Pm85ITJ05w7/59/uv/+r+mKArm85L79+/Tti1nzp5lf2+f//7//t/zyiuv4pzj1q1b/A//w//A3t4e6+trjJaWePWVV/gv/q//Bbdu3aGsKt56523+8T/+xywtLbGyvExR9AiAqyuuvfs2+3dvY6oZQzyZNhgUdeu4sT/h0Cme/fjH+Xf+t/8u/eFw0QVjMhmzt7vHuXPnOHv2MQaDAbdv30YpJf3/nKeqK4L3ixZUMgUllSBtciRvhXf08hx84M7t24zHYwJgnURCunUrskTWbQeMshGM4r2EU4+v806ZySaz33tJG8hx47HjqiEaiuiENC9I8py8yEhTQ5JoPvPZl3n+hedYXVlZ1KwdhR/jWIjYByW3vCu+7wEh9a92/CTK9KGcmlzJB4/zExz1JxndNT32/d2NXbwQBVyX2BQvQPbHxEx0VzwaD7YF26Jci3YWbCNCw0vCVtp1dL2LpCi325RCwhZpSmKkaFGS5QIqIQh6ztuGppxRzafYupLkazz54DtrSyZhZ3H5h0IMDysv5zzW+mP9pqTXWttRaEUGfmHiD7K1Adt4bOsFAWqlaJYOwhvzHiZJcV7QlYGAs11vOIE0mzQjyQtMnmOygiTLpRg0FwBJP1MUxjFMPevDlK3lPrQlrprjIpy4MwrkvCUvKMpYQpNd6BEfgTdOPEixUmOtULCyIdfaixVBCIq2cbSNpZf3UCiqsmI6mTKbzWURxE7Y0kgyNkmM+dLOeJHrGy3pWFNogiVRLUmoGaSBU5vLsct0Q5pAkmnSLCXLCtKsByqlrCyHh3PKsqVtPPOyYTKtaNpAVgyEkaSSLgvBWUJb0c4OGGSwtdInoQHfEHyL95K7Fff+aC7ShaKixy9ZNweuYrp3g/L+FZLpLTbUPifTGetMGLkxWTOFuhIAS0hpybl7b593336X8c49Mjun1xzC3nX23vomb3/tn7P33quE+Q7Gz8kzzfrGGpPZlHevXuVg/wBFYPf+fd54/XWGwyHLKytMJmPu3LnNxz72LF/84hf5uZ/7Cp95+WU2NzdpreXatetkacrLL7/Ml770JS5evMg3vv51Xn3lVQ4ODvjjP/4aRic888wzfO7zn+dTL32a9fUN/uE//Idcu349Ft3LfNWxYWfn5ZtY0JyZBO8t61tr/MVf/RUGw0EMcSa0bcO9u/fY2tpiZWWFEye2uXTpIo89dpaiKCIpdUuWpWxtbaF1VxMmSkfrowLobj6nec7zL7zIk08/TVb02D04YF5WzMuaeVVLA1/raJ2naqSbfNW2tLE32sM5dPHUjkpZFre+k3wL/RK1UJcHjJGQJDFoHWjbGpNonnjycT7+8RdYX1uRkocgTXKPHfEDZHuMKX3QW/6Ex9FX//gn8WMBRf6khpx2zCU8YDD8sPMQ20Xsl04fhkUho4oKxzWSRxOmcAGJuFaafFrb4HwkEyWgYm1Yog2pSUiThKKQpoBJksS8TLzZEY3onaWtK8aH+4wP9qjLmdQJqSiIunBjF0roFNmR7sU7QQvKJvmlYGMYsRUl1W1SB9UpPwk7iiUoilCYvyXuLuVEsZygWwRaSGWVUmRZSmL0gmU+uIAKBqNT0kTCiWmWk+ayJVmKSTU6UaAcWnuKImF1ZUieKJytaKopri7BNQJhblpcY3FR0Tor5yqMKELm+sBijgWr3aNkGixeSc7RqwhAcQ6tNf3egGAD04MJ470xtrKxBY0g5rppLLVvkkjvmC9cBP1IuyKZM0b6Z5N4S98EtldGxL7cGC2drZMkQScpaVZg0hzrYf9wLIKsbTmcTJnM5hT9ATpJqa2laVt85NxUriajZXWQsT7KoZ2jvSBsxZiK1GExHCuz3CBcMNLmxUeuRUKgreYYHEUm3IMmkyaqhz5nX42Y9E/Rbj+JuvRJ+i98iXDmKW67lLfv7jKeTsmwjHSDObzN7R/8Me9+83eY3XwbUx4yShVntzd5/mPPcvfOXe7cvk1TN9y5fZuTJ0/y7LPPsLGxQdtajEk4c+Ysly5d4oknnuDS5Utsb293gRe2T5zgE5/4BF/4wuf5whc+z87ODtdvXOfunTv84R/+IZ/97Gf5yld+js9//vN8+cs/y5/7c3+Ob3/rW9y6eRNnrXj8qMVa7FyMEA0XFzzLqys89+Lz/OzPfyXmVRWBwGw25+DggBMntimKAgUMR0MuXbzExvo6SWJig04b54sYuV1YMMS0QBdR6ML6o9GQ8+fOsby8JDVq4zGz2YzZdMa8LKnremHc1U27qOPsDFgfQ+mLvztPLIjx8oDMOC4NF8qsyzMqlA4435IXKecvPMbnPvcZTp06QZIafLCCINfq/XHFqLzkG7rxoNf2r3rI9P/J9ZD+CT/3vqE6Z+nHHMfV0ocbXYhqIashWiJytA7wIeEhQT1KyxjpWl1HpRZhyTH0pLRYg6lJSNOUNM3Isow0TRYJ6o6/sGvf4F1LXc7Z373Pwe4O9VwKvJ2VvIucT0dvEyfvAgUY82AxfNjlxXAdLD6GE62PXayl8WiHZDwKlYqiEzBGl4BmcYEkfIHkHGPR5mDQF+LiNBXvs7UC1nAagkGphCSJSi3LBQmWGGl0qgLaBLQWYMNwWLC+tgRePFbXzHF1LQZFI+3qbStekXhHsnWeZ4cAc3gJLUZV5vGEWP0b4mtNl48AhsMRvaygmdcc7Bww3hvj20Ci0thUVIwJunDQgjFCQs4oqecjBAGIBGHiSJQjpaVQnuUioZ9AGhtYQlh0WzBpTpb38Rj2DibM5iVVXbO3f8h4MmN5dR2nFI2zuCAtPxIN2Iq1UcH26pDlwkBbibIjSIhWSy7zCCCtxENVCZ4Up1KCMhLeVopelpIoL4XPvsVrTWNyZmZA2d9En3iS1ee+yOmf/Us89Sv/Gz75l/4dzr30Je5Xjv3xGOoZfV+ypuYs2TFXv/X77F95jTDdpacc60tDvvT5z7Nz/z5Xrlxhf2+Pmzdv8emXPs25c+fI8wzvHE3T8LU//mN+8zd/k3/0j/4//NEf/VFs3Cvcqffv3+cHP/gBr77yKtevXRcaqLzg7r17fPe73+X0mTOMRkvY1pGYhIsXL5ImKfPZjKapSYwARGTtdekAvYhsHByOuXDpIj//Z7/K5sntmNc11HXDbDYlSQyjpREq9iwUyLwlTcwif3ZwcMiNG9c5ODigqipZN1rHyEMr6Esl82o+m3HtvauMDw9Jk5SiKJjNpsxmU8aT8ULB1XUtHe1dF3GR6MuDBAPH8uvxUby0owiO94gCj8pMaWm0Kw2I9SLqdPnyBb7ysz/Dc88/i1JBDLdYVxF8LLvohHWMcr1PocnuP5UhS/an+/IuUva+wzxq30c6OhNuodA6TfXweNRZdFf9SJt3LAVyhADBH+WWohUmNzi+P1pfi3/HerF1ZxJiWJAYd0+SDLEOxaJOjEErYhjSUldzDg/2mM8meCuErgr5vI9RNhfDkc7HfNsxBecdBASI4uPr4o2JQuhyaPJc2E2O8n+ycKyT+i5x1ETrC1O+WHTGGNZWV1leGtEr8kWOTYVOkTrwAaMFvq4TEeJeg9cashRd9Ej6fZKiR5oXrK6vk6cZtqmp53OCbRateuS6y3m1kZTVhiO059GdVFKTJGXr0vU3HCkmbRJBotY1iTFsrK5iQqAcj5kdHNDMZihnhTEmdBM4WqGdtU2XxxAKJ2NUpA0KGIV42d6RBE+GIwmWfmpQVrx9Fc9V0HmSewxKMytLDqdT5lXF4WTCeDojKwqc9zRWvDRjNAqPq+ZsLvXZWO7TSwK5FlBTx4MZUGidRKUVt/i3QOAl9Cb5SE1tA7MmMLWGaegxMSPqwTbFmacYXXyB7MxTVMunYes8nHmcUy9/iS/8yq/x8s/9GbKlFYI2UmvmGnras9pLKEJD6hqMa1C+5TOf/hRlOeett97ivWvX2N/f5/Ljl1lfXydNM5RWlGXJ//SP/zH/3X/33/Lf/oN/wG/91m/hvafX76GU4p/8z/8zf/tv/23+/n/293n1tVf5j/6j/4hf+Yt/EedcXL+BphW2GX+srEbCfzoamsmiuFspg9JGavW0Ye9wzMrGBs8+/zGyIkfHcPtsNmM6nbKxsbHwgpPEUBQ5xhhcbCS8urrCyZMnyPOcN954g7feeovd3V1CiB661oTIt1rOZ3zrm9/gn/3mb/LNb3ydcj5je2uLjY0NrG2ZTaeMDw84PDhgMplQVxVtK0XU3bYIMXbz/wEvTdaDhNCjB7dQPULjonTsfmEkdz2dTjh/4Ryf/8LneO75j0VuzQ4PAM5ZmjYyHz1Sph4fj5LD/+YMAcMcYTCOjc4tjYLlAUHx4EVRQa7DQk/FsajVe9QWb9wPHVGzLJTUI7djb1UiclSEuKKI1rnAujvutIAIeSIPnffSv8z72JssMuFXdSVWVisow7aVQmod0VTdKIqcs6dP8fEXn+dLX/gcX/r853j26adYGg5E2TmL6uLkiDBEm0WM3jpoHVh/tPkgndhcUFgnvblsVGytjd2wG+mILc1DG9pWCJh1ojGpdNbWiSEvikWoLUsSVpeXSBPDoCckrgoiRVIsMo9FmcQGqyZN0XlGSFOsMdgko01zXNbH531aJQG64dIqRdbDVg3NvGI+nTKfzZjOJhyOD9nd3+NgcsjhbMrhZMzBZMy0nHE4nXA4nXI4nXE4nXM4jXU+04rZrGI+rZhNS2azOVppNtbXObm9SYLn7o1r3Ll2hcneXRLfsL40YHnQI0tA+a4W0UluxSTCnRAEwi1ku51HHcNNXccDZzHOkuFZHw1I8FKoHZWiMZJrTYsCnaSUTcu8qpmUJWXd4HxAGYP1jsYey5O5lno2Zn2pz8ZSn8IEUgUJsQavs8Yj+71H44M01PRWCKl9U+OblmA9BEM+3GDl9BNk249TLZ2nWXuc7NyL3M82efPQ8+2b+/ze6+/y//oXv8tv/cEf8+q773GvagmjVfTSGk1SUAeDRXoBGiWMJAke7VpCU3Fqe5Pz586yu7fLb/2Lf8H3fvB9Ll9+nNFotJAT/X6fv/W3/nf8l//lf8l/8w/+G/7O3/m7kVNRDMCv/NxX+Ht/7z/hq1/9KuPxhH6/z/LSEuvrazz33HPsH+zjvWdpaUSv12M6maKQsgAI2LbFWbmXSglBuFeGoA27h2POXrzIx158ga0TJ5jN55gkIYRAVdcopTh58tQi2kIssgZRWCb2xUvShBMxTLq9vc3Ozg7f/e53ufLuu9hWipcP9vd49fvf49qVK2xtrHPu7BnOnT3DY2fPcOHcY1y+eJEL58+xvbVJL8+iobvPZHxIVZVCIxbiGo4G3yLEGYVoiNB/IXmJaOuYn9dJEg1WQCvqpmZvf5dPfPLj/Mqv/AVeeOF5kkQL4bkWRiHrLIFAFgmNZTyk2Bai/WHP7aMYx5yHhXH58Hs+uvGInNrxcWTtPqzQHvBgu7ce/+QH6Ksjr+z49vA75N8Hjq4P1+IKHVnigUDTNLQu9kPTEq7xISy6QXc/vwNkSD2XNObslJmL4Tu/+H1dvkbAB4nW9IvIeL8pLeHPP3aWM6dO0u8V2LaOCDuZlN1kFRCDCJKghJPBBmiso7FS6CmsHNGj60KMcT+BBR2YQrouJ4khSWXhBgV10zCZTTk8HHNwsM98Nl30ferl0iJGwFBBQpDW41uh2nG2lV+baHSaQJZB0cPnPUqVMm4Dh7VnbmFeO7TOKPI+/SwnM4Z+ryAvUnr9HsOlIUsrSwyXlxiMhgyWRwyXRvQGffrDAf3hkP5wxGC4xGC0zGC4wmCwTL+/RL83YtAbMhousby8TC/PaOZz7ty4xp3rV9m/e4t6ckCGZaWf0880iYp5VSRc1NUhHZ9OEuC0MQ/bzW2B1OvghVQXz6jIJPzohAlDQl86WsoJyhhcgFldM57NqNoWtCEoFRWahH8CnuBamvmE5V7GUi8jCQJiUtFTlqCjlvmBxistAixAcAJpV20LrUU5j3eauU0wo5OsnH+ezWe/wNozn2fzhS8zuPwpxv1N3psHbpaeN+/t8/1rN/nGm+/wnSvXuV87GK7Spn3mXlPagA0Ake9UQUogVYFenvLxF56nriv+19/5He7v7nHi5EmyLJc5YgzGaAaDAcvLy6ysrJAkCTv374snpBRnzz7GF7/4Jb70pZ8hSQzf//73uHHzJltb2zz99NP81m/9Ft/57ne4eesm7125yte+9jV6vR6rKyukSYpthQ5NIV4KyuCA2nkmdc3lp5/m8lNPMVgaxbCcYTKZYtuWXq8v9FpxzbpobErerKPrcmil6Pd7jEYjVlZWWV9fY3l5GYB33nqT2zevc+Wdt7nyzttoAhtrq5zY3GR7a5MT25ucPnmCs2dOc/rkNtubG2xurLG+ukqvyHG2ZTabMJ2MqSppfySIyBhtiemD7tF1efMgvzcgXbAbK/0ZPYGqqbHes33yBL/4S7/ICy8+x/LKEoHIL0mMQMVSJPWjCq9/6P6PYLxPh3zQefx040cotR8yQvffQycVn36wQvvohnzNkUJTCgJSrY/SWKAN4JQSRgQtDQ2tkxYhKC2sEijxxpyL4T2/AHPQWc6d1RwU7ljY0DkvirCuaMoZbV1i8KyMBgyKDJyVUCSS15ECa2EW8SrgtSJohVdCEWRDoIlMIjZyOUpC+QgarIKwzCdB4AMpnkxDmkAIlqatmMym7Oztce/+fVlIsynV5JByckBhoJ8Z8kSLUsPjXEPblFTVnKouJZRJwCpNa1Jak1OZglL3qJMhtRlQ6z42GWBVjjIFvd6QfjGIyl6RGEgTTa/IGA569IuMIjP0M8OwMPQzTT/VDFLNIDUMsoRhmjJIEvrG0FeGvtL0CPR8i56Pmdy+zu23XuHG699j5703KHdukLQTRqljkDky3WJoUcqidVgQwHahO0JsIksknz4eL+gKWgPC/UmglyUYPMG3gBOOvW72K7UIf03mJXuHExorrBM+CHWX87GyPEjey9YlgyKlnyfiTdpGQDqxfo8ghchH9CtHm4rIAQlba9qQMG0N794Zs9tkFCefYPXSC6yef5ozT7/IyctPM9zYhCTBO0s5mbCzd8hh6Sk2H2PtiU/Su/QJ1JnnaLafZr5ygXJ0mnmxRp30sSYlmATnPc888xRra6vUTcPjj19mZXUlek2a4WDAysoq3/3u9/jt3/ptfuM3foPf/d3f4ep77xECjIZDekXBYDDg8uXLPPP0M3zzm9/iW9/6FsPhkE+99CnGkzG//we/xz/6f/8j/pf/5Z/wzttv87nPfJbTp09Lgb2XejAf13bQ0uG7QlGsrPL48y9w8tx5dJKRpDmg2d3dxXnP8vJSNHZjyuEYEtY5AX10xrD3krbIsozNzS3Onj3Lxvo63jt279/n9s0bjA8OGPZ7pIkhz1P6Rc6w32dpNGR5aSRcrUsjVlZWWF9fk9KF0ZAsTQjBi9e5YAo5yoUf1ah10rX7vaLYPIrWWjwwnc1xIfDY+fP80i//Mp9++dOsLC8fOR1RFopclNKa/38ZD9Wp/bAhcdkfvu/oxY9KoUk48aF9D2JEHnwt1jJJbi2QJpq6nDM5PKCp5hARkFp5QiymBgGIKLSEI7wcQ8WYrFIxXR8UAZEtofOyosfV2pamboVwdl5ycDjmcDylaSyz6YzZfI4NQnvk0IsC4s7ziyncRSxd6fhdnZuuYqzdS2hMia8ItiFTCqOEV09a5Yj1Np5O2NnbY2d8QNvUZElCL03IVYC2jGG6gkEvJ88S8jShlwloxKsAicLkGd5oau+pHZQWxrWnDCmqt4wqlgjpkKALrDMEEmm8WVt29naoXU3jpUi8sQLMKeczytmUZj7BljNcXVHPJ9TzKVU5pypL6tmcajqjGk8px4dUB2Pmhwcc7Nzj9nvvcvvqm9y/cYXp/ZtM793EzfYZFCmjfkFra7HSE0h8jfEVfd1y8cQam0uFEDVrAbkIp6KwqUR6RejyGCQEZbAqx5qCO/szpk5qxYJKsVaMIu8sbVvT1FWsd/SQZBT9IXm/z6yqqFtpM4Nt8bMDJneu8NnnLnN+e0jmJoRa0I8SAIt5VK+xQWFJ2KsVB42hNT0O55Y2GC5cOM+FCxdBGyrr+V9++19y7e4+g41TLG+fpSKlWFlnaX0LUxTc39unnM9JtGZtZZmLFy/z4sc/yfnLT7J28iyj7bNkayeoixXGIWfp1AWKjTOE3hKVlyiCNhlNXbG5tcEv//Kf58KFCxhjsNYyn8+YTmfMZjN2dna4c+cuTd1w4uRJhsMhe3u7nDh5kkuXLrG2tsba2moEkmief/45nnjiSfq9Hq+//jq///u/z62bt3jhuef5G3/919nc3BSAQwj4puH6lavcv30bFynHgtacf/IJvvDVr7J+4RJNIj0NrQtcu3adPM85sb0td7fzVKK3IApE8p0+CIBJcngmAlAcQUG/KLjw2FkOdu9z4733mE8O6eVZJGiOURN/lNt2Tph8vJfsWJZmDIcD+rFfoUcM4hDLkrSKZQrR+FrkUlUEesUia7R47o2zHI7HnL94kb/4q7/KX/vrv06e50IIEGtqxUNmocxBvLXu7wel6MN/v1++/ps01P7e+EP4gI9WakRl8uMqtQ/6wsWlfeALo/Xxwz6okJAEAe8tKjgyFagnh7z2nW8yvXuLzFaYtsTND9G2ivVPklNxbYNzFuUlAS/J4cio0Vnl3Xd1iyGGDOq6jlZ5oGocZQskBaWFm7fvc3f3EFUMKIPG6lQOESeRJIOPeeSLr5CarcU7Yr7HO2HrNt6hbEOqAt7JQvJIz6nGew5mc3YPJ5Tzkl6W00sShgaWc8PqsGC5n3Hx/Gk2t9cZLfVZGg4Y9vvS9LJfYHoFqihQeY+59ZQtBJOTD1fxpsfueM7BuGQyq6nmNbPDqaAPy5r5wZirN6/iUk86SFFJikoFHaa8I1GQq0ChhIRWoBFKAAsmkUUdAsoHtHNoa8E7qrqkqee01ZSmHOOrKUMDwzyjN1zB64z704o26dMqjWommHrKuin5mY+d48ntIavDhH7qSFKHzhwoiwkK3UHOEIPFkeLImJklxskKX3v7Ljfqgln/JI3qUdaK1kJbzZiN9zk8uE9TjVldGbK5dZLNrRP0lpbZn0yZVTWqaQhVjdt9j903vsbf+itf5RMXV8mqm1BN5Xci4SbnA06lVE5TqwFvTzLemeXMs03e26uZhR4/+5Wf4ee/+nNkeULA8c/++T/l+6+9ynBpiS9/+cucP/dYhL5DXdXcunmL3/rnv82pk6d48vJFTm5vUujAIFMkoYV6xmTvLlffu8pb77zLuctPcurikxSr2ziVYjE4NLYVWrkkSTFGclaCzBOS7RACbSuAGqnny3HOUlUVznmSWCbjrGN/fx+tNYPhkCRNmM9EKVbzGjz0+z2yLKWuY6dyraBt+Prv/j7f//rXKXfvk7QVgcCv/Y1f50tf/Xn6px5jbjIsmr29A+7d32FzfYOTJ05QVVXMMcWmp8GLfot5O0k1eIxJcM4xL6uYXwLfVBRG84Nvf4vvfu1r3L72Hr0sWXSz0LE3Wnf/ylLY+tumjemCrmOFAKSsD0KV1aGiI5q5Qzp2ZQoBUEpjfTRugdq27Ozv89wLz/Nv/dpf5ue/+lWWV5ZBEaMCMqyzYiAHHyMVougkR8kDiqyTR0f7pSPKRze6HNoHH/RIBn7w+37U+PCe2vFnDwBLOoUX93wIpfZB49FKrdvHo39whNi7rr4kejZ5ntE2DfPJmPlkjCYs2jF0t7JjxTdG0Gf4ABFEYp2jbbvaL/HMrA00rdQe1U1DVdXY1mK7SRnkyGVZce/+ffb39iGGDrobu4BrH0NayosyAUXQdzkeCYMlsVWECh7lLIlz+KoUVotgyVJNwNO6lmlZMSkrCIEiy8m1pm9gKdWMUoMtp/QTzaDfoz/oLeLtyhi8SXBJQkPCuHaUXpMN1uitbGFNn/1Zy7zVtMHQekPTekJQeGsFJm1bZvMJV669S1XNqauK2WTC7GCP8mCfcu8+9e49mr27tAf3qfbuUe/dZb53l9nuHWY7t5jv3mK+e5tq9yb13i3K/dtU+7dw0x1MfUARSpYTz1phGKViSWdpivVgigIbFNgKXE3fOM5vrwijSK7JTSAx4qkp5Rcs4yHOCK8kOR+UwqoUa3Luj+dMvaFOethgsF5KH5xztE1LVVXs7O6SZjmj5TVGSysoY5jXwoeItYS2wU/20OUen372ItvLKaY5QLkGvBMwkZeaPZSW+aQS9hrNfmOodY+D0lOFhHMXznPh4iVMkgAKk6YcjCfcuHmTg8ND1tbW6ff7GJOgtWF5aYX11U3OPXaBtfVN8t4QkxWUbeD+wZQ3r93mlXevceXOHgc1bD12maXN0+h8gMOgjRAQGKMXwIpOABmTLAAhdV0veBO98zR1vVCAaWxe6aIHUxQFWZaJLFECnc/yjKXREsvDJYzWKGKEIkjfNeUC16++x92bt5hNJxhj2Dxziq/+8i+xcvIkIevhTYYLildffY2VlVVWV1akDCOIO+4iGEi8mGOghShuJG/toqEpoUod193O3TvcuHaNg90dUmMo5zPpXVbXUpPmHHXVUDWNwPaPhROVUqDFG0PYY4FI+LyoN+vC5EdKzbqunZRiWs65t3Ofz3/xi/y1v/7rvPzZz7C8uhIvoEiS7l+HdkapOA+E4u5Iri4kz0N/H+35VzEe1GOPkO0/wfiQOTVZ8p0iePC7uxiw/PtxTuw4GvLR4+HjPRR/PNII0a2OjBxBuOtUkrJx4iQnzj7GYHmVed3S2CDMkF7jrIQUtZaCXe8ERNK0lqax1HUbiyYdTeNpGi/eWN0yL2vKql7ExLVSpIkhNRrfNpjgWB0NOLm1ztrSgFGR00sTUkUsDreS+I/ghK4a2ygwWpL1hhC7ATshDHYW2oZQ19A0qLYlVzBMEwZ5QmYCCotzDS44kkSKyJX3JAR6WpMFTx48s71dDnfuU89maCTEWVnLvLXMase4ajksrYQYsyXmPuegDExbQ+lTWgp80kNlPYJO0GmKzhKyImN1dYVhr08ChKbBVxV2OqHe38FUU5ZVy1YS2NAtJ1LLibRlO2nYSiq2k4qtpGIrLTmRV5wsak71Gh4bBR4beS6saC5vZFxcL7i42efy9gpn1gas9hP6qaJfZKSJiAWUhJxkzXd0W8emTsyhiQDReKXwXfNRPGBRoSFLoiIMUrgtTTNVpENLCKSMZw1lC15J3raNbCUCEhJP29mWYb8gNaAiY0qIvckCHlT83mDBt7FNi+TkfPB4FVFxQSENXwyNC2xsnuDxx59kc/MEN27c5Nvf+Q63bt2hbS1JmpFlPc49doET26fpD1apneHm7ozvv3uLr715g+9e2+WdA899N2CWrdEW6/hihZAMcCTM59WikXm4dAAAhXVJREFUdgvvqaqS2WxK21pmsxkHB/vMZjOuX7/G7du3OTg4YDafMy9L2rblrbfe4sqVd5lNp1hrOTg4oG4aUIqmabhz5w5lNef6zevcvnNb2iI5y+HhAa1tYyROhIRGEzxUrcP0Bzz18U+w8dg56ImH3rrAbF4yL8sFcYKz4rV0UQBUNChFsx2VEHS5tiDREr+gxBPQmRgKmvl8LuVCzlHXDXVVU5YV0+mU6XxGWZY0TYONytEHAXkdL7lZwOAWylM2EXdybkKBJejH2XyO0ppPvvQSv/IXf4VPvvQpNjY3Y0iyA4SIkhRFKs+NSURJRhTqv05jocei7P6oxof01B7U3Au/7eFrpDoX7uEX3n/KDyuy7uni8X03ICrUHzZiLLmzatIkIRDI84x+lqGDZ7y/TzmZoL3013K2kY65WhO8QF+7uLhMdBFMAjYUeH1rhZm8jcwAZsEeHuuMArTWobShPxiwtLRElvdIklTQckGSccEJSEFqqgSYoELAKOHEMHh0CGjvMd5Ha7/FN6LQMgKF1tKdukgwibS3KZua8bykstKxOTeGJASWjGIlNfQN9BJFaGt88KR5xtLKKmnRx2JoVUKDYW4VzvTIhuu05IxLx7T2tCGhdZHZIwiHZFtJx/Bga1SwpKnGtQ0JCoMmVYqeAl3NObk84NLmKhc3lzi11OOxtQGnlgu2V3qcWOlzcq3HydWC0+s9zqwVnFkvOL3e5+zWiFNrfU5vjDizucSptSVOb6yxvb5K3hvROsW4tKhixLwN2LpE+ZZRGji/tcLGMGWQK3Jj0Vpqk1ARdRhi/iLmMIlhZ6tSapWyO28YW8NcZbQhxfkU6wy29TSNo6wqbt+5w/LyMhubW4xGS3jvqRuhx1LO4ZsaO91lLXN87NIpVvugmgOCrRe5UlklPhLfgjUFe23KfmuodcG49tRBc/78OS5dvkCSGKxtSNKEfr+PUnDr1i32dnZRSrM0WmZlaQUQppimdRyO97lz+yZX3n2LG9ffY2/nLnVVoggkScLy0gqPPXae5eU10jSDIB0d7t65K6AK77l58xYhwHw+53B8yHw+x/vAe++9t0AOV2VJ3TRkWcb3vvtdprMZ/X6fspyzt7dPXVc0Tc1sNmf/YA9lFO+++w7VbI4Oir29PZq2Ic2kZY0CXGO5de06t67fYDwZc+LUSX7hl3+JM5cuENIUr1PmtePunXskScLa+toRQjNGcxZ56UjKvSj7Ecuc0BU8R3CWj6Ad29QY4NaNG9y4dp0k1q75CN5yXoxh67wQG0ewmSi0jipOQGLORcXpHyZRkIjQkXsgMm0ynRKAx596ir/61/4an//iFyTkaCSiIIqsS88cSVphEBGl4SMK8mioh6Tug9L1A2XtRzUeOt+PanxIT+3B0V30n3Q8rNA+eHw4La5jkXGSpegkEQSh9wRtGK6ucvb8RS5cfoIky6kaS1U32NYt2me4yHygYx2M6pK3MRzgFl6ckw7PSsIy2iSkSSoKLSaG8ywhTTR5ltDr5RRZyqgoGOUZgzQl15oMSIIQHomtD6lSKCcemfaeJMh+4xy6tei2xThHrhTDvGC5P2CpV5AbJcrONdimWjCHG2PwzpGnKUWSkgEZ0NOGQZrSliX379xhZ2dXvFed0gZD2cK8AZ0vcTBz3NsvOZw5Gpdgg1A1OSUWoiegEoVOIGhH0C1FkbAyHDHMegxMyjDJWEozRkZzctDn0uYqHzu9zScunOQT50/wyfNbfOrCFi9d3uSly5t8+oktPv3EBp9+YoOXnljnpSc3+PRT23zm2dN8+qnTfPKJ03zq6fM8//hZzp9YZ2PUZ5Dl5ElKmmTSYSDWBGqTYBIj4SvlgDZ6YKLQZPnGgK+KVG2LOeeFIFv7+Fmp3UMiw3iv4t1LcF7jVYJSaUTYIq1+xOwXAWatMN1rYaNxTiD/4jDI1ewYVKR9nJwPyOvSgcLJuSi/8D6tbVlZXuLJJx7n8sWLBB947Qev8uorr7O7e4CPhNvXblzne9/7Lt/4+h/x5ms/YDbeJcWRJ5osMfSLPhcvXGZ9/QRpWhCCIUly6spy8+Ydbt68zY0bt/jBK6/StC1Xrlzh7t17gFoYgkrBwcEBV65e5cb161RVCUqRZRl1XfPG62+wv7/He+9d49VXX+PGjRsMh0PaVpraKgWz2ZRXX/mBEIov5LLUkzrraJoWk2ZsnjrFxaeehiynQeFRlPOKmzdvceHCRXpFT66bVpLTsk7Ed1QEUpgsN1S8eaJ3JjyoEFvieE9AUfT6rG9ssrK6Kq2EvCisxra0zglJQXS2nA+0zkmaohWvTd4v6Yu2aWON6YNtZXzH/erEyG7alvl8zvkLF/gLf+Ev8Od+8c+xtLwsYJMg6F4JaSKteyIeIIl1et57QgSJLIBv/z8+fiKl9pOM45fygfq2Hzk+7E3oejLJpJDWKUYKmIMmW1rl0ouf4IXPfAEzXGZqoVYJLQl16wnBoEhIlCHPCtIsE77DyDZPkHyRj6wCaZLSK/rkubBqmDRDGSE+dc6jUNi6Zj4eY+czQlOTuJYczyDRDDJDP5FcV09DYaDQgVw5jGvRbQX1HF9O8eUU6jkZjpVextbKiLVhnyJRECzOCeWXC0EUeVy4zlqpSzOaIjUUaUKqFRppmphow+H+Id/85nfY3Z9QW0PZKMpaocyQw0nL/rhmXntsVxDupXC1Q2UFpVBpEpuK5iR5jkkTNjbWBPZsEpRX+LqFpo3MFY7lPLCSw2oRWO/BRh82B7A9VGyPFNsjzeaSYWOUsD5MWBtoNkYpa0uGpX6gl7akqiKhRocGvJWeWkoq+xVI80gtzSNl3Ys2CrH2UHz/qKW6sbC4omKLeU3ZeCDX44OP4XO1YPw4jlpzXsKUCmlCincUeYLGiUKLbBraSD5UvIgYmoq936QYXopK5My6pHvMnShFnqQYZdhc3+QrP/sVzpw5iw/wve99n3/2z/453/72t/l//o//I7/5T/8pb775Jq1tWFpekjykbUnThIsXLvBzP/9zvPDCC/T6fQmb+cDu3h7f/f732N3bYzovsT5w6tRpTp48Rd00jEYjnnrqKU6eOklRFJw8eYql0ZKE5OYVWhm2t7bZ3t4mSRPu3b9P0zRsbKyTGINrW5568kmeePwJtre2OHHiBM88+wwvffolfvCDH3D92jXKsowC2oHW3N3dZbS6yvOf/BSrm1u0XhFUwrxqmMxmJGlKr9eDWIPqvIdoqJqY4xNvPCIOI9qxaVvpfuG9sJvYFhvDx62VtjLnLl7kmRdeoLSWw/mcynoaG6hrS13bSGUXC6g9tM7TuoD1cb7F0pIQ1II1SJroHpEc2yC0cK2zvH3lHX7mK1/mf/93/za//Bf+/IL82CQGpaV2zXmH1oY0zxbKrI3AneC7ua3F60TmztH4sPL1ox0yh/9kxodWakf+UpfZffgdx970iDNW8cti7lL2ReX2KAXXJViPHuO2yIE8tMWYtEaTqATVJfO9pgmGRieEtMfW40/xxMufY+Wxi4y9ZtwELBlNA64OqFZaxzvvabzFBbGKjQpkWtEzhl6SkpsUhcIHTeOgtlBZqFtPYz1N3eAai3GBDEiDJVOOXgKDVDGMW98E+sYx0I6B8YySwEBbitBQ0DBKPKv9hM2lnM1RzuogZalQIsyp8aGlCY5Waeogm8eQmJTMJMJpGBy6Y02OZMEuItdCgLYNfP/Vt7m/X9G4nNYV1E1C3Sb4kOG9jkwmDcE36CCFyKDAGEzeQ+V9QpJjSbFB0Rv2yfspaGFNcV4JDyCB4BusneLtBO+mEEoSVZOphlTXpKomNS2J8bEdTiRS1h60haQBU4EqUapCqRZ0vE+dEgviQ+XGkBqF0aKQtEoA6XotKLMgHJNEQuEYEu6g/kYZ8jTHYAhtQHmE9Vw5+U7tFlyYxmiCEmEkeY5Y/uGkuL2tKwa9FK2ESBk0CgFZSO5N+uPhpEAiRZNpQ6Y0JijyNEOrBK0knKiVIdUpJmh86/CtZzhY4tMvf5YTp07jvOP6zWt881tfZzYbiy+jRdg21lEMRjzx9Md46eXP8vRzzzEYjWhciwstQUtxetWUeBXI+wW9QZ+sKEjzgjwvOHv6DPsHB/zO7/0ub7/zLnlRkOUFRdFnebTC8tIqiUrp5X2qsmY+L3ns3GPkRU6WZZw6eYLRYMDv/a+/w9tvvIXyivF4zDtX3mU6n9Hri2LyzqEjE5BOE8bljPUTJ3nquRdxJLQWlMo4nMyYzGacO3/+yGCIrP7OeV559VXevXKVyWyO0mkkQYi0dERqNqUXtWEhCHdi52WVdYPp9Thz6RLPfPKTzH1g3LRUNmCdxrfgW4VvYscMK+QJQnOlsM7TNtIy6ohJSBGUIH89Chu7MUzmc27du8uf/0u/wl/967/OCx9/gbTIUIkQKwQVUQy+K/45IgYPdKVJ0YuLZBFHntoxMMMj5K+K/0Vn9ccc8byO/4th3QfVw5FG+WnH4rhx+9A5taPxKHj/g0MpsSK7a7K4SPLpo/c9Ynv/eMQ7VHecB/d333r8HxEA4JTGKY3JC4rREmle0DrP+HAMNmBcQHt59CFQ+RarIjuJFCXFtvFHrS98ABuE1aC2ThRaK4wfURdiJP+/gOOrIP3eRPV0watAorywNySaTAWBvRt53k8VRQKZjgrKtwRbgbe0OOoQqFDMg2J/3tBYMCajZwx5CAyMYphATwtpL3FBuMi3WJNy5fYeM5uQ9lboDzdxusCqHG9yuX5xyhilRDkqQUuyYM6PsGQrHkmWBObTQ2azkqb2aG+hmbG9XLC1ZFjJGwrTkqiaRDUYYzG6xSiL1i1Gu7gwI8GvUYCEN4NupCQj5inGVWB36tgrLT4fMqlaXDkhCQ1rPcW57RFrA00vNWRaBBaRmBhCDOcdzTeF3DOrMpwuGFeKvVIzaXOC6dF6ReO7HImlrkt2du6xvrbK2voqRT/HId2SvfMYa3HzOXZ8h0snB5zbKhgkAWOr6IFFstkg4BUfDM5plOkxbgyHtaZWBfOQM23g3LmLXHr8CTKToKMX2Rl/KE1/MCSgmM4m7B/sUdc1WZqQGEPRK1hZXeX02bOcv3CRM2ceY2VtnTTPI/RcWDZEQErdU5ZnrG+ss7W1zcrqGoPBgKXhiDwT/kSdGpaWhEmk3x9QZAVLgyXWVtcYjZYo8oJev8dg2GdtfZXRcCiFyaurjAYDvPdSsDwa0St6pFlKr1eQ5xmrKysM+gPx6pzjxq2bzKuaT778Mp/+zOdQJqWNyml3/4Cyrjlz9owYJxGu30VbOmDXbD5nMp3iXBT0kYqqM/REiUUl4WOT0BA7ritQmVCklZWAxdraEmwAr1ASN46M+8IgZL1wsTofYjmBBgw+iOcWIu0XWuMVzKqS3mjIL/zin+VXf+0v87EXnmOwPFrgBQQGrUVNKMnrw0M6Imqk43JSQYxEvH87/mzxcX5cvSOK69h/x196/76PYBwpyKPxEyg15CIshMAjRoSqH5MUcf/79vxkY6HUjoYQvHa/79gtWpxovHEK8jxjNBzQy3Lq+ZzZZCIw3qioxPWPNR8RmBikMpoQEWgSVohEva2VJHHMzcERpNMH8YoaK2EMsVriGSlJ5upjzTTTJJEktNFkSUKaGBKtpW9cRNF5a4WvMWaI6gB10JQucDCrcC6QZhmF0aTBMTTC2tFTSNOSiLQMSEjGKcP1O/fZOTykKHI211dJMh2584X5xCnxSlEGHxKUFo9BExW2s2AtseUACYH5dMZ0WlHXlsS3qHbGxlLBxtCw2lP0U4UJDqO8pMAUAt7QHWpRUKlKEa3MAMqBclF4QNvCQaXYnXn2S4/PhozLBltOSEPLWt/w2PaI1b6hSBWpjnDumK/qfH1igf3RDA1YldHqgoMqsFsqJi7DJwWt1zSRtkxg3BX3799nbW2VtfU1in5B8EFazjiHcRZXldjpPS6eGHJ2s8cg7ZSai0pN6qZA+rY3XtGajL1Ws9cq5qbHjIT92nL2/DkuPfE4JtGx64CN/rcU7Zs0ZTAc4mzL4f4BdVUx7A9YXlpie2ubc4+d5cL585zaPkm/14MAznZGl3iswUmZQZ5lrK2ssLq8wmg4pF/06Pd7OGfJ84zhSHqqLY2WGAwGKKUoioKV5WX6/R7aaPqDHoNhj16/R7/XYzgYUESW/o5aqz/oMxwOGQwGDHryHd1708SAF6Vy9ep7nD17lk+99GnOnjtH6xw6SZjOZkxmc5IsY2N9Q8LF0VMTmrQEgDTNqKqK8XgSqfCERg9xWhYlBwL9j0quteC7fFvAo0jTnH5/SFnVzKYlVd3EaiAV39M5QnIecn8XK79b/BHMIREDH5vrLi0v89LLn+Zv/of/Ic987GPkeS652S7fe0ymaa0x2sRjf5B0/fEUilKPDLj9kCFvFP3yoT/0U49HKTR+nPDjg6OL6/+QEV1g+cJuk4cP+tiPNx5xpEBUXseUWqALfEpOCAkXmrzPqXMX+PhnPsfaqTP4vMc8KOYo6qBxXhFaCE5JuEoZGh+onaeyLWVTMS3nlJUQH9tGCFeJcF2i9WVjC3cbFwmdBam0JHSjAku0JtFK+nsRSIwmjfvVwhjockICQZZFpxZEyHXjaK3kD4wRclqNJzGSW9JRMUrRXUA5abmSG8OgyDjc2+XGlTe4c/1N7HwP3xzimjHeVVjnqFpLWXucTwg+kWvjFZlJJa9jhEQ5yTK80iSpEP4GjgxEpSJwIkKMu8R4VxrRQamlOFbClWIJHJtDnWfSza74UoeYXSx5JeTFRusu1bWYFkfjKDxybNePOToI9pHV1p3jw2NBV3TstaM/47VRQKppsFjlCAk45XDaY3E45fA6EEzAKkcbWtrQYoMVLzw4lpdGPHH5cZ5+8mmKrGB9dY3Lly7x3LPPcPniJZYGQ9q6oSkrgnWk2pAnCTiHDgGDQvmAb9tIdB3wTUtTlrRVJehG27G+S7GvwNyFRFrCYUIa7ZwwyrSNEHB772mahnkpsH/nJbRtbUtwgkz2zlFkGYmJMPyoHKyzPPPsM1y8dIk0Swmxme/e/j5KKTbWN+T+LcKHYnTWTc3Ozg6j0YgLFy5y+vQp2rbl3r173Llzl8l4IkCLWMullOSgvBOGkdbK2mptjMYEw9bJM5w5f4m17ZMk/QHeJFgUjReD1wfxohKTSC1aPG5AvMKgQMXWMUEpatuwsrrKL/35X+bf+/f/fS4/fhljNNYLs4mgtLuQqACMhKj7g0a3Sn48ffPh3ivHljV4bI3+Kxg/TKHxkyu1DzEekkXH9//U42Hl2N23Lj4cgQIyxGsKKImXo4Xd22SY3pDVE2f4zJd/jpMXH6dNC/ZqRxk081pq06raMS9b6tZTNZZ53TCdV0zLasGY72xXIBrrQrQElVwINE5ISEUIi8LrkFcdsEEv6qcC3sYOyU5a5ti2EcYTayEEWRgRqtuFP23QtE4xq1pc0BidYJRCBU+ilDDBK7nZEpaR71RBQq4aj1Ge0SDDlhOuv/0K7776LVS5T8/P0PUUP5+grVA+CWIrLIwFoxPyvKDf75PlBWiDMhl5f0SS5TgkB6ANJIlGa/DW0tS15EI7RRXRlA+SDHdbDAUHufmykCIjQ1RwKlKMccwDS2LBcAfp7q79A3PnfZPy4ec/YigpHhbz9ui3dCPQKTjJuyne/56Hh4olBmjQRi1yJqgg8HHbCmhAXok0XdIEta1rmqpkNBjy8edf4Ff/4l/i53/+53n66adYWlrCW+l/JuEHpJylbbFNiwpCnkzXO8x72rpasInIZwJZnkdvQ/I3Ut8VhF0jBFxwmESjjaK1TczHiiHWsY/4EGi99BnzXjgR226ra9qmoW0aiO1fUNIN4NyFCyyvrlC3LSZJqOqa2XyOTgzD4QhASimipzadTnnzjTeYTqcA9Ho91tc3uHjxEhcvXEIpxY2bt3jnnXfZ2zugaSzBs2hv46QbU+yqoWJJi2Jee8o2cPrcRV586WVWNreorOs6OuLjB5uqEk/YxfkrExEbOV7Lumb/8IDhaIm//m//DX7tr/wa58+fl3pZa0nTjDRNQSm0iR3stbSTIqJC3ydn4+jWyQ97/acdcVr/azV+KqX2wRfqA37tD9n9Y41OeIROgx19X/f0CLKtIGLIXFCSEwmKViVQ9BluneTZlz/H5Rc/RbKywd1xSUtK6/RiEs/LlqoWSL80KVbS4yyyiHTf40MkObYSkmyt0GkROd46i17kQYeqE6GtCKRGkXScjjEMFDrvyov3EgIEpUWhefk9tQ3MqxalUxKTCvmtc+RGkWlpJ6KDxwCJ1qRawpoa8d7EM5SQYOFrZnfe49r3vs70+tsk01167RRTTjC2hlYarrbWUscW9UobkjQjzwuK3gBtcpKsj05yMBqTJhJq1bH8Akk6dF4tCzh9twrjb41dVTuhufDkfBTIx7w2MSa6/JJcz8RoAY4odTRHjnlUD4wPmLI/anT3VYTIkRIjTs/O49THugWoxdSVLz3+9c45EmUwykhuNuZzlQfX2gUpbiBIqyGj5ZrFgv5gLSYEhkWfrY1NekUBsOi7t/i+BeuF5I+IIfMQ65qkVEaiBWJUyFwmGhBCDeVRSjwS+TnCfN+0zaJnnsRPROGBkrrOBZONIBDFDDm6ASqeHzE0F0LgxY9/nLX1dVRUci54xtMJVV3hvScxRspoihwVWTTatqWqa7TWvPX2W1y5coWqqtGxE/zGxianTp1mZWWNcl7x7jtXuX79JuPDKd4Jw4sPUtjdxs4ZjYWbd+7jdUZvaY217dM8+bHneeq55xgsjaS8SGu8syRK1jRIaNJ5Qc2aLOMwtmD65Esv8bf/7t/hCz/zJTa2tqQzhpIOCMJLKYofJAzqg4RIrYvlB++bz9Fo+gnn848eD5ptD49uLst6ePjVP9nxUyg1OeXjC7Hb+/B49Ds/wvGA1SuPi6xeVGzSLkYJyskkOJ1gTYpLcnw+YOXUY1x+8ZM8+dJnWDtznoN5Q1l7GqdpLTRWFIgL0usKzKI1RIht2a2TAsy6aWiaVhRahI8LdLjLRR55H92mYj5DfJ8YJgySbzkS8LGeJQhvXOODbE5RtZ7GgtaZFHn7gAmewhgyLbk0A9JWRGuSTqkpUIvOy54MSxFainZOe/8Gu2/9gMP33oTDHQpXkdgK18xp2xrrpchcugwIcCTLcvr9AUnWQyU5JAkYg4pWu9ZgNCQqhlaPRP5inoTOtPQevAjcED0EFkorXsIQhTCIYuyq54II906pHR39ESHNxYhnsTiZDxYKx+XIwlPj6HMPHD4qOb1I6h+9uPjN8Vn3oNFSnO+FCzNVGh3BBnT8pPHzSkUqKYSVRnvhddPxc3RAiGNrRRTaMUCEs7H3W3w9BPEAu3AwR0aFjRB3UYCy3iQnd+xzQaILUlIR1+MiPcCi/EG6akTSXmKXgo7qSXWlOsIKcuHiRfqDAT7EvBVgvaM3HDCZTHjnnXc4PBhjtFkQLld1RfCejY0NekVP6ujevcLNmzep6pqi6DEcjOj3BwwGI0ajZUJQ7O3tc/36TW7fvhvLGZA+d15Tt4Gdgyk665P2R6isx2B5jbPnL3D5ySc4cfKEkB4HMU5ViAaCFmBKUIp7O/fJegWf+8IX+Ct/7a/yuS98nvX1dUJH+RejMgGZ213+TejKTDQSJM/+yHn6qH0/9ZD5Ezia0w++GveE+PriPX8iJ/PI8VMotTjiiR9fk+/7md17uucf+YgXTUWooZQmPiAqu+9VyqC7Gja0KDdlIC3YOHWWZz/+KV74zOdZOXUWW/SZBy1kxCoh6FTq2YJBK+HLgA444qhbR93aWKAtjAI6KLG2F8E/WfQSiumUWQclj0i22O9JWmJ0AjJSgDmP9UEQjyFQeahcoLKegEx2EyDxjkJDP9EUClIVIqu4yBKMIAq1FhGjQyz2DoECWDKaUbC43dvMr79Fc+N19O5VislteuUOebVP2k5JaUiUBxxKBZLUkKYZ3gfquhUv1WjQ8n2qc1TiNZCC0+hkxLKMznOQe/ZwKPIoxEwQYM/x8KOEIzvgRRTw0SsOoYM/c7Qwj02f4+OB1x8aingOxGlHx1ghwrq7x4sDd38HoUATFXvsS48dK/quGKWFYSZA4gM0ljQoEg+uamjKhtRkQKR7CzpyjMZaOW2icJT6J+9DTGzG/HK83t217yo+VJD2PHgIEcXrXYhRRxVrrKS/n3dyTBU0wSvE0eta/Mjfgai84vcqZaT9jxdjBmUkxRujH95LyUFAoXWCTrIItTf0BiNW1tcxkeneBU9rWxJjOLG1RZHn7Ny7y9UrV7DWYrSmaYTGajgcsra2xvb2tjCbVBX7+/vcu3uX/b09ZrMZIcBwOOLEiZMsjZaxrefwcMpkOmNv/4C9gwP2Dw45OBwznkyx1pPnfZIkiwAxGAwGnD19Wjqzx+gIkcFIKdCJIWhovaM/GvLy5z7LX/lrf5Uv/syXGK0s41SsA41z1UfBqrQofaUUSXIUflQxd/jgePj5RzcCHFNWH/Ta+1//VzHCR6LUFqOzNo8rsIfGsf0RWf6RbPHgsXbDy6OScxGrPL4vFsL6cASusEETTEaDocEwWN3khZc/x8/9hb/E5oXLuLxPo1KsSkFnwiIRNEanJEkmYUgfaJ2nsY42NhZFCSopjfFvdUyhdQK9Q0SpIF6UVgoVwoIn0FpBz3XWsaCvhJ6qcp7SR6XmobIenWRoZYTrMXgGScIgMRRamEQSkBqrEKI8kdCSVkos+qAolKavNH08a6nidD9hWO4zv/oD9l//Bv7eOwzK+xTNIbo6hHoa+5cJwwVBOhfcv7/D3bv3mc1L0BKWVUaugneWtmmoy1qKY2PBvAjZTsrKdTry447t90HsFmK+NOZM0UdFzJL/EQYQ3SE+u7ycfPjBERXmjxzH3hPFMsQ86YOjO3+ZhyFOQh2Lt48OdHRAmR8AikQbdIAUTY4mVA3GenJlmO6PuXfrHkI7oo81mzWRC1A6JJskjddErlHHkkOICisqOUGYSm406eovO6XV+VZBY5S8nhihrpLXNFoZMeBUglFCoixNVEWpdeF5rQ1GJyJ2ghIStdhsVfoYSt5KxJIBLb9BmYy8N2Bj+wRZ0VuUY1jvmM5mZHnO1uYmTz/5BGfPnObe3ds0TU1rLbP5DOccp0+fxhhDlmWcPn2Gp596io2NDe7eu8fVq1e5c+cu0+mUum7wPpDnPZaXV9naPMH29ikmsxnXbt7k6nvXuHb9Bnfu3KPfH5JlBT4aV9oksUO3pS5nlJMxvm1EtQdBEltvqZqavFfwl/6tX+Xf+w/+A77wpS+hjMYFH9el1Jd1HrHUPIrMAMlhEsPDxohHejRkPj1C5/yU4/icfXDIvH20ovvTGD8hpP/DDInzPrzUUcfCDx/VOKbdYug6LrjuOkchTpf7kBc6AULMIwAobUizjLWNdda3NpnMZly/eRPrHGmaLgQAXU1LZAFwrsutaYyRvFYSYe+iSGMuLHTEpceEthLRopAuzXTNC6PSE/koIc4QoEUxbR1lQEAtNlA2LUmaYZQidQ09HGtFynKq6ccauNgIXgSskVwGRiD9B9MKpQybwwGboz6F8vRNoNCSlyu0B9swPdwnTxR5akhTQ2ICWjlBcAbH5GCft994g+9841vcuXWH1jakeUriK0wzYb1vWM01y9qTJ9JhWUulAMQiZq2CoDW1iZRX8TZpJaD14MVLDoa6CRzUmv1aMbWayieMyxo3OyTHcmp9wOn1PsPMk5iA0aJYOkGrgrB1xLsfN3lmVYbVBQdlYK9SjF2GNwVtEEi/cx5rHXVds7+3y8rKMisry+R5thBIeI9xLW4+w03v8fS5dbaXE3rak/gKLS7RMZmhFrnfoFJalTGtYXdc4Uyf2humZQU64fEnniDPM4peLnMzsmMUvT5JpHBLkgydJHgCSZaRplkEMxlhbzfymCYpSSrnrbXBJPIaSnhNTZKg43uSBWjBkJqM1GRkqbBZdOtbogASjpZQoDB5KCWefJbm0dMgEm8LxVka/zZaoiDeC5eqyTI2trbRaYJkEhVN2zKZTNnY2CBEIb80WuLsmTP0+31u37rN3t4eaZ6xubUVuVllDWmtGfT7nD17lsFwxGw2587tu+zt7UNQzGZzmqYlMQm9QZ80y1hZW2U0WsZaz87OHqdOnSFLM4IT2rUi0RRGMT/c4/q773D3xnWUkq70jsC0rri9u8POwQH/yX/6n/Jnf/GXeOyxx2SueS/KSakYkZGO4SYxR/ZWNJx8h9BECsW984va2U7c/UmMR+msR+370xrduai9h/qpfbTq5lFardv14GuPUnSSnH547/tHUMKZJ+a7FoohulqxI/QjSrbQKbXoySlYADa0kkJooxy2nrN76xbvvPIqr3zzm9y9do2eUmQacAJRjo0hFrkFWYjiSZiY2G9aYSSHGFbzYrnFmJvMwiBejnMCjOhCaCIcYwPCSE9VoditamZo5k4xbaBqHGmSkhlD39csK8d2P2VVO/qhJdWi1IJWeK3wWkOiwSjqkHLtzj5K55zfXOHM2ojEzimMxahWiqyNpvKGRvVQvRVY3kStbMJoBYZL2DTn+q3bvHf9Jm3lsZXn/t1dnHLkg5y+m5DPbvPMdp+nVjLOFZ5RrshSTZqCKRSmUGRpIDOe1EgBuVHibSSpsJN4JFfjrEL5jPEs8O5+4N19uFsnTOlz4/4B9b1rrJmWTz6xzScfX2d76MmMw6hGQjZKhKbCo0NsNaI6r0YmXaUHzJMV3jsMvLEL16o+rlhlbg3zFqq6paxaptMJb771BufPP8a5c2cZLQ0kl1PV+KYhqeY0ezvY+6/yl3/2SZ45aVg2DXk7xkjdSMyZIiFVDJUL+GTAVK1yc2J4/XbJAcschhETp1D9Zc5cOM+lJy+zvLZM0SuEbisEMaQi6kZ7yVtZ7wi6Q2cKoTYheu3HFplzkgejQ6LGvBkhlhpEpe+dIBg770wh/Ire+1hLKMAehYQ5JSQpJRzBAwSsF/YSozRGaULsBt1FJXwI7O3vMxgNuXDpIucvXiTNMwajIT4EZrMpVVmxvb0lbDVBjNZOyB8ejrl3/y7T+YzlpWW2trZJsyzC4mUtOeup6oa6bqmqhslkxt7eAVevvgco1tfWWVpdRiUaNNRly+HBmP29Q1ZW1+S8bUNoaxJXMzCeP/oX/5x3XvsBrpwyHA3QWcaNe3for6/z7Kc+yUuf/Twvf+4LrK5vkKVdj0U594AYsHHPgzLwuIiM90KUdBe0/qgU2g+LtC3++1BD3v7h3/9B44GjLJ48eGz5qoDa2x13dsBC0bxfvXzUowNMdE9/iPcm6+dHjqAcQXmC8uiOdR0eRD8GSeYIT9/xDx89Fatdjod2GAOqrpncv8/V117nB1/7OneuXsVXJZkKONuK1xDj2p4glDyRpFQFSXJb20p4SkXhcAwYQuwX1YXWhCpJOgAQBYJw0sXW79YxCYF955gEqFpF5VTMhyjSEFhNPBuZZi0NLGPp0ZJENhGvFc4YnFYEowiJxoaUG7cOMLrg3NYyZ9eGJG5Gz7Qk1CSJgFxapwi6oFU5TT7E9VZwoxXC0ip7ree1d65y494uW5tn2Fg7ye3bO+xPDmmVY8icfH6HZ7f6PLGc8ljWHim1BHShMIUmSwO58aQmoHWK0eKBmIgGCyqCEKyGkDOeBd7ZD7x7APfrhKkecOPuHs29a6wnLZ968gSfuByVWuLR1GLMxDCYgHOc2BkIlyVBlnWth5RRqb2+G0Sp5WvMnaFsFWXdUFUt0/mUN954nfPnH+Oxc2dYWhoulJprapJyTru3g9t5jV/7ylM8ta1EqTVjdJDQrYRGhe/RoWhDoPaauV5jvx1wdc/zyo0ZZbpObXrMyWiVZmljjd5oQJpnklMMMge1joot5qc6tKDopzjfvEiCI8V29Bg6FCRirEX/XkRt8OAcynu0TtE6Q6GwzorRFruKE+u0QiDmlI14GUFsPO9bApZEazIjLWJch/CLtVzj6ZRnn3uOz37+c6ysr7F/cMD2yRM421JWJWsrK4LsDFIuIKtd8tetdcxmU6azKU3TLDzHRS+3+J4u9Ok8NHXL1avXuH7tOlobhqMRLnhm9QyTSvQFJ+FZoxOC80Ib51tUPUPXM/7nf/j/4N7Na6wMe2RFxsFswmB1hRc++1m++Au/wMde/ARZ0Qclc1rkzyPk3w8ZYlw8sEduzIeQlR9udAb6T3fAj+IYdEf4Ecc6/p6HlBrvVzh/IuPh7zj+/Mf/clFoothEqXWeGsc8NuFMI1pDx6eSQu6ARvSO155gAsoEjHUoa6EseeeVV/jWH/wh199+i3oyIVGywHX8fKfgfKxHCRHY4WMo4YFcUddHrUObiZmOd+KVeR8ZIoKitdLSokNXTqxjqhVjF2giv5zyEFpLTmCjMGzmhpGyjJSlFyzGgFFEpaZwRhOMJiSaNqRcv30AKuXi5hLn14dkvqSnW1LVCFRegfcapXOCzqh1Qmsy2qJPWwzYqSxXbt3n3uGcpdVTnD3/FDsHc27u7nBYzRnqinx+j2e2BzyxZDhjKoYZ5JkoNVOYqNQgTzypDsKwH0NlHXqULm/qEwg5h7PAO/uIUmsSZqrP9bu7tPeusZG0vPTECV68tMb2KJClHq0aEcydpxZRkiITOr9d7mdlHlJqZR9XPKjUyqplNpsuPLXHHjtzzFOr8HVDUs1o93ew91/nr0SltqRrslaUmo65yE6peQJBw6yxVGqZWq+wU/f4+mu3uT2BNhvh82XmzlNaCyYhaEER+hAWdUx4Maq8khzbQhiGKHFEW3XSR/6OQlauxxEIp7PdJcrR1bIBOkObjIAWgoGIou2UWkewq0gkxhxrLYUMwKGw5BpyrfFNgwMwBqc0s6piZWOTn/uFX+DzP/NlPIGr771HEomYe0XOk48/Hr1L8e4IXpRNNGgDYF3LdDrj8PAQF9MIaZqhtSbLCpTSWOtprXhub7/zLt4FsiwnBDgYH3IwOcQFT3CQJRnLS8sE53Fti/GWBIcvp1x/+zV+55/9BvPJPsuDHjY4ljfW+ezPfInP/OzPculjz5L3R4KkDBJ+/VEy7/1K7GgEBFkZn3xE46dXaj/t54+PD3OsLrrCRwsU+WlGdxHl759sLNRTPMZCPMXnHZRblIeIL3nfcYUmR1GYRIh5W6UJaU6+ssYzn/kcX/7FX+LCs8/RJilVUDReCjE7ML5zsvy1NsLaf0zYiDdwbAQeUK4EaNtWABMoaQYZEBgxmtYh9EwoHAalRXglSpEET45ltZexUqQMEkVhFCkSZUyUEP0ac+wxEXiwTjQqFVSWNpBnijxTomDSjtlEGqDmBnrasaRb1tSc5faQ/PAWW2HG0+sDLq8MsLu3KXfu4MspxlupEQuSH4mQGAJqEVZ10Qv1tkPbdZHZrqeVWO9iqggwQXKVRlB3XUQ30px1c0l3abhOgKOgY9OP9/vYjTgaMWz28O6FmHz47Q/viHvl+LGtSfQfHn7PwweTswwo31IYT6Fb+qZha6h47uIWebtPfe8Kfv8m6XyPZRqWaBmFliXlWNGwrAIjPEPlGenAkoEeLQUNvdDSo6WHpa8cfWXpK09feQbK08fRC44iOAofH4Ml95bUW1LXkroW7aQOTgy6birLnFRa7o9WRuayk3ywEAgrQgwTJlqTa0UWPFlbUbia3DUkrkbZisP9XS5fusBTTz/F+voqo9ESp06d5s7tu9y8fhPXOrLoPWm6AnvxGCUUKoXJ3sPS0hIXLpxnc3OD1lpu377NjRs3GI/HlOVcIiHWcnCwz+7uzoK+q1f0WFtd45mnn2VjfRPvHFU5J000WWroZUnMDQeUt7zy/e/hXEvRK7DB4bXir/6Nv8Ff/vVf57kXXyQtcqq2FkX/Uyi06EPHv983jf5Ux4dRQn+S4xGeGiI+fsjF/GjGo44fhfuHuNEPD/HUQlRcHW5EApoSgkRUnIrvWBxexGT3GR2VmtcBVaQ4JOelY18z7aSn2fj+Dq98+9v89m/8Boc7O+RdsXSUxh2cXHIDTr4nRCEXEXHqWAhSBS/8fx2tT0RQ+qjUGmuFosc56rZlYh11kjD3AeU9wTpcOaenYWPYZz1PGOlA7hty31Ioj45M9d7EnFqi8cZAYqhUxtU7+1iveebkCk+dWCZppuKpYSP9soh0HQRGbIzCGGiUpsTQJj0a1WPmMnYrzWvXdtipoM5ybH9IESo4vM3T20OeWjGcTSoK1ZCnijSFJE9I8pQ8gzwJpCbE2jZB0YllbQQdrgLeJ3iXszu2vLXvuHKo2LUZ01Bw894ufuc626nlU09s8/z5FbZGgSxXaGPjpOnmhkMF4f0UFGU3M6DSQ+bpkad2vexj81XmLqG0R57adDblrbfejJ7a6eiptdRlhWsasnpOu7+Lvf8af/nLT/LUCcWSbsjbQ3Roo1bwIsGCikhSR1CBuc2ofUHI17HpGu/cPOB7b13nrWv3GVcOkhxvMqkFNEnkOJSQnygPoWFqcXgJRMp3dKvsgWiGWLxxmuIjb6mHBxjgndLUThGSnJAUeJPjouGFUhjlMcIjs6jL85FqTgUweFINmbIkoSFrK4ZYesrTaEOjFDMXePP6Tf7+//n/wi/84i8zWt/EB0WSaq5evckbr70GIfDFL36efq9Y9KbzwWGt5O2UknCnD35R9O5jk86qqjjYP2R3d5fZbE6e98mLPlXVMBwukaXipVVVw2xekuYZr7z6GlmasL21LRGaSGag/r/tvVmXJEl23/czM19izT0rK7OqurpnehozPQNgQAoEBiOAWAiCwACDQwoHlKijo4+gJxHUGz+FztGLPor4oiO9iSJFEMtMb1W91ZJ7bO5uix6umUdEZmRW1NI9A5K3yjPczc3Nzc3M7e/32l1shZ2OeP7Fp/zv/9v/SqEDBwf7/PIvf48//OM/5rvf/z6qLGi0wmot/aSiFugL5robQW2BMyHOX2+OXo9Te51rr9JtZS2fkp0AmL+4UftxPvnf0K6vQfOCr5edAO/6mRsplaNSDCq1pDCSAC3EvIs8XEsRZVUcSGJMbQmunR3ipKrpdLts7+5x9+gI6wNfPH3KeDrFZFm81zy4IyCyfqXk2eI90ia9JvcIAZomKi2g8dGtl0MvmCCAVZoqyvSNt9BUdHDsD3vs9AqGuaajAnlwGDyZEtGj0eJ7UGxexD+kNgavDKeTCqfgcHvA4dYA42s6RtbhlDHoLIsTlCfLNEY7VGjQGvJMobzDECi0pshLyt6AygUaFM7kmGAxtmJv0GWvoxnqBh0assg5KqNF3Bi9nGjENodo8pTWgdLCuHcaaxWjqeX5JHBaKaY+o/Kai9EEJpdsZHB/b8jBVod+EZBwd/EtiD/JRlDGSRoBct7qHGu6nFfwfAoXNsdnXZqgsV6Jl34rsbdOz07Y2tpic2uDoshF9GwtwUl8PD+bEKbPef/tXfb6UCqLcZWIP2UgxFqoaHAv4jutMjG09QFbV2z0OuxvDdjb6DEsFIMchnlgqCV80VBbBtoyoGGgGwaqoa9qhqqJm2UDy1A1bKgm7ls2VMMQyyDU9EPDgIZ+FF8PlGWgHUPtGWpPJxMN4bLXp+z1ybt9ik6HotOl2+vR63bodUu63Q7dTodOt0u3N6A/3GBjOGRjOGB7c8DOsMdWv2SnUOznsFsoBt2CXjen2+vy3V/8Hr/7+/+Iw/v3ZUQoMaf59NFnFHlBmRf8v//236K1ptvtkhUS7T6gCB4RQyLagUSXdKKoIu+zyTKGwyHdbg8f4PT0nCdPntLUDbPZjBCCaGIaw+effYlznkF/SLfTwUfbM+9qjAqcnzzn//6//k/+6q/+A9///i/zR3/yx/zBH/4h7333e+T9XlzDFg1S0XUWyc6L6OpUGFjBg7zcbPmV0hWsfSVaxqnVBc5Pzc+nw1tALZEAwlfXaDdwbTFtDjU3k4pAotCoEO1uokw9XR8iqM3BJu0s/Kb5LIJaElPJOXFxE5TooOedDju7e2xsbwGK2lqmVUVtG3ErBFH9XABLRRdZcoP4ZwHQiCYCzsn3dPJT6VDYoATMUDg0QWci2gS0bejg2e4WbHdy+jpQ4snxFIro1xGMUWQR1LTWaB0NtXWG1Rmns4pGKQ63+tzd7JP5mkIHDB5lDCrLot85WQ/JjCMz4mG/yBS5hhxFgRKThk6PcS22dJXKxPDbVmx3C3YL2NANGS6CmphSGGPiWgtoJdp2KW5UK7sNiJGuU1irGE8cz6eBs1pC6Eyd4nI0Rc8u2cwVD+5ssL9RCKiZBGryASEfPQJq8jJGvj32j1XFjaDWeGSdswW1M7a2t9jc3KAsc5x3WOsIzmKcJVQCat95eyeCmiPzVeTSoyApPl/i5ElKFd4RXAO2oZspBoVhq5ez08vZ7Rfs9nL2ehl73Yw7/Zy9bsZe17DbM+x2DbtdzW6p2Oso9krNXim/u4WOv4q9QrFbarZz2ClVu22XWraOZqcw7JSafq9Lb3Ob/vYeg61tehtb9IYbDDY2GW5usrkxZGMwYDgYMBgMGA6HDDe2GGxJ+2wO+2xtDNgddtnqFmwbz46q2c08vW5OFkXiP/ztf8j7v/SLDIYbuPh+N43j2dPnbPSH3Nk/oGlqLi8vOL84xwdP0RHzBhPXTFvDfCWcZxvcNYqYsyx+NMT30xgRmVZVxXg8YTqb4qznk48fM+gO6fa6ApTe4myN0QFvKz7/9BP+3b/7f/j+93+JH/34j/nBb/4mD975BnmvS6MUVimI721SZHnRvLY0B66X9WdGV6DlGq1OvYGugNVKupJnfhgwf/EX/+oFoIa87F9pq91U/vpcm0xHC+r8MW1pZLTAFkFOyX5kouRPy9FFjoYomoxajcSvwICi6JTs7u+zvS/xqKbVlIuLC+pqFiekgAkyIWstNihyqwRkMnGFmCfN2/IrnJrzUDWOJt4zaLEdishLR8NmJ2e7V9LVgRKHCY4MLwBBELdUbQRocfBrovNlYwxe5xKDLMCdjR77G30y5ckMKO0gTjKZhtyo6PkfMiPGvmiNygxBGwIBZ3IaXTCqPJdNYBI0RgH1lK1ewW4Jm7ohVw6jvdimGTHYNSk8DgGvPE6JfZ+AjXxcEMAHjW00o5njZBo4t4ZaFYybwOVkip6N2So0D/Y32N8o6RUekwKNxndBRkpU3lkcJJFuAjVxIA3WJuWdhtPTU7FT2xxSFLmIuRoJBmqcJcymhMkx33m4w95ALYEaCuHUY42C1KoVP/s0RlT8zAmWzAQG3YyNfs5G17DZy9ju52z3M7Z6hq2+Ybtv2B4YtnqajS5s9nS7bXU1G13NZlexEfeHXcWwpxl2NRs9zbBnGPY0g65i2E2/irLfp7u9T2/ngP7mNp3hJp1+n95gQH84ZNjvMuiKg+tet0uv16fb70ueXpduJ6ffyRmWhn4GfTth003YCBXKKLzymLLgd//JH7B3dITKCmyQDz1rPc56hv0Bu7t77O/vczm65Oz8jPPRBdN6htaGXneAvGbyUeTbcDLJLZj0u6zpepTWrYu35JqqqiSwaTVrGF1M2BxuURR51PK0BN+gdGB0ecbp6XMGwz5//s//nF//wW+wd/cuXmtqHwja4MWNj3g0iqFi0mhb3BKpq4yE4taJfinv10zy+txcN7gOQm+cFljENTg15PX/yltt1T3WBTVR41fJhLkFNrmu/eJXorKdHl+4Nskz35XrlFZtKBmtdFyIFs8JKCUuiRQErdja2+Hg8JD+sM/J8XOeffkE3zTCuUQg0zoZphJBTV6qZbEa0ZNAwAXVKovULhCUBpNLhFwPs8mMMsvZG/bY7XcolaOjHCUuihvF+75WYtCdGdX6QRRFESMhMXRGMDmjytJ4z3avZHfQo8wV2niUFk8hyaxN1hE8WolHdmU0NkbSTgoxVhmsKhlVgfPaMXICrqGestvvst/TbGWOTDnhPXVA6aQAMnfw7PE4pA+SnRPx1fBexI+Tmeek0lz6HGtKLivH5XiKqcZslxHUNgt6eUBH8aN8padPnwQhsWeCal++20DNenFnJJzaHNQ2F0HNCqhlzhKqKWHynG+/tcNeX1HqK6BGkHEXQc0G6XuFuDLTGggWjSX4GtwMQ0NpLIW2dI1jUAT6RaBnLIPCMSg8w8LTLzzd3NEvAoO49QpPP5etl3t6eZDfMjDoQK+EXhHoFp5uEWTLZd90e5Sb+xQbexT9AbrbQxclWadDXpaUmaHMjBhS5zlZkaPzHJXn5JkW7t5AV3sKX1NMz9lyE/rNmNpVYBSHbz3gV3/v99CDAcEH6ugK1OiMwWBIp5CYdVorDg4O6A/7fP7lF/zNT39CXTcM+wPRAFVErlk0ir0XbeSkqeyck/ONaBY75yiKgm63R6fbRStNNa3Z3tilV/ai9q0T36LK42zN5cUpu7tb/Pk//3Pe/+77lL0uTQjUQZS6VJ6LDWRQougUQ8isIhWnl2tznlrg5lfQldxfG60FaF8z/acDaku/S6fmv4kli7/zq+b9ooifSEq+kHV0d5UASCnxYxgSWAKzuqYsC47uHfH+d77LYDAQtzvjibj50aaNEk28V2LUgke0HFE4ZdBlh5AXTK1jXDdkZYd3vvkudw8O6RYlobHkSnG4v8fe5lDWz7Snl0HmLdo3S+towqHJbxbFkHNuzWCMxpuMy9oytY5ep2Rjc4Oi2xWFEqVxKiMogzYFqAyvDFZpLAqrDd4UeJNjEW5Nd7ew2YCTieV4WjNyArLK1WwNOux2DQOTPHmIWAZTEHQu6pdKvsqd0lil8d7gLDivcF5i3dUhp3I5F7Xi1GZcUmJ1h8tJxXQ8Jq9G7JSat/aH7A0LerlHZ4oQQS0NDPmbXsoFsXcApwus7nJeKZ5P4dzmhAhqdQQ1Z8UL/NnZKVvbG2xubFAUBSF6G8F5Mt+I+HFyzLcf7rDbF07N+ApCDFra1iCu8CVNQqXiR494bfFe1NeNhlwjK66hIVOOXHky7TBYChPoZFDmgTILFBl08kCZIemZKOSURs53skCRBQrjKIzY9JVG0jo5lDl0ckUnV6iyTzbcRw920J0+Pu+AyTBZhslEhGyUeO1I4kAdPZSkyBC5gq5ylL6imJ7Rrc7phZqTyQQz3OC3/vBH9O8/BCOKMEEX1I3D6FzWueUNxLqG2tZ0uh0O7x1y5+AOJ8fH/Jv/498wGU0py4Jev0dZdgTE7NzA28X4aM4FrAui1t9E+0I390OqgqLf6cnQ0OLoIdAQcBzdO+CXful7/Mqv/DL7B/tt7DMLEiXbGPlkSgozLkkeVgPBfLq7NpPdSi+X+z8dWoWpt4NaVJFdfOlW0Ztp0DSbrEhfSFsBW60lvmBGSOqPcRMuTTLOi1IL2yoJt4qAqpWaqxYp4n7yrpB8FUa5IYqsKNndP+DOvQdcVjUffvoFM+vI8jyql8evNZWTmRJPRjAF3pTM0MyC5uOnzyiGG3z/1/4Bv/07v0dZlHSyjJ7J2MhzNsqCYWEolScPDcY3aG/RwWFwGBUioEFuIDNBnIeYqChiZMIRhRGwxjAJihkai2g0qrKP7m7QqA7e9CEb0FBisw7WFDRZQW0KGlNgTYkzJd50CFmPOhswy4acVIrz2jINgTxT+GbK9rDLZqeg1OK8FlPiKSTUDyaGBdLUXlEFQ+0yrDVYp1GqwIaMymomruDSFTyrFM9txgUd6iCxs2YXF3TtmIOe5u07m+wPCzpZQPxYK5Q28mGB9KGs2yVb5BgSJ4Alx6rIqc0Up1bEqnVQ1FYUEILzNE3NydlzNrciqOWFlO8CeIdxM/zsAjt6wi883GOvbyiNQ4daONPkfCC9ZPPlw7lYJX6IidAqenoPooRETG3PKsQdmJJ9TUAp4dq1OJGRPErckhnlZczoQKYcmfZRfO2FOyeOH6XQAWpVUmwf4DtDGl1QqYKgNZkx0c2ZTOLKiBunoNKaqBcN46DIAhS2wswuMeNTinoEbsYkK9l48A7f++HvoLfuUpkuDQVOZeIPMs5iEl1AgpGig/hNxFHmJkbq3mY6nfHBhx/y+PFjOmXJzs4umclFCcwGQtDib9JrMTmwnqZxNI04TxA3aBKQ0xhFUJbaznChZjDo8s1vPOThwwfs7G5Tdgvx34iElQlK+mz5Q13mo6WkKxT5sSt7LyY1/1Z/SZrf52dPgjerHmKpjmGh1nE8LNLtoLbIPa24uKUoVnvzdGVQ3OZ5BOKgmYPZ1awp6abtet6YuljeYubYHBInTROCrIOV/SFb+wcMdvYoN7cwec7xs2eEpkYrg1EZhIwQDEEVNGRMvabWOcODu7z9/vf4wT/8LX71v/4N7t27x/nxMVQ1WWPphkA/U2S+JvMV2tVo36CDI4uTT26gMIrCKIz2ZFqUJIxR6AVA01rU8n2WY/OSi8YxcZ6RV1zWcD71nE/hchoYz2BiNaPGc2E9I+sZ+8DEwcxpKqepfE4VMsahZEyX0ypwUdVUzorXDFcz6Bb0i5xcaXwwOHJsyGmCETALiiZoqqCpfU7tc6w1OKtoLExrmMwC543h2UzxtNach5Kx7lA1ltH5OX58wTDMOBwUvLW/wc6goDBeNCm1vP1J+iMvR1RKif+0lw9yR06ju1xUimczxUkEtSYomhQCxnmapuL47DmbiVPLSwjgrY+KIjP87Bw7fsa3H95hb5BRao/xlTiBTgMqEEEsuuqKdUovQTIoljXVeX7R4JQCFCIuFoCLm4pmIyk9iqaVElMSsbIUpZ+oa4tWojlron2nEUVUlA9UqiDfukNT9KlUwVSV0YF3VHCJa9UhKmcAogLvBdQIBu0VZTMhn12gp2cUbkywU8ZZl969t3n37/8GvrfNzPRpMFgnH4N4j1GKoEQ0HZT4MQ3R6DvTUOYlvd6AXn9AnmU0jeXk+JS/+duf0DQuapTm5HkH7xVVLRy39xKRwHuJQtDUDXXd4L3FhxrrK8pOxv7+Dg8f3ufw6ID+oIfJRObgwiKgLQqGUmeltFU2aqvFi1Hi/kJqp6UbpujVtHjPl7rwK6IXIf5CHW+p8wtADbgKLKvo6wK1peOv5o6JlsF0Yf8qRW7OxNhPPsrqu50Oh3cPefvtt9kcDhhdXuCDxD9rfMBqEd/pTonp9+jtbHP0zkO++/f+Hr/9B/+IX//hDzk4OuLycsTnn3/BdDajthbnYyRkW6F9gwo2ihvFaXGug2giRnDTyIueadFaFAURATjZNJgC8h6zOjCtA6M6cD6xnI4sZ1PP+cRyPnVc1J7jScXJtOFk5jmpAqfRmfDpTHMyU5xO4bjSnDaak5njsvFUsrqHR6GNqDRbB1OnGTWKS6u5cJoLrxk5zcgbRs4wdoaxNYxczsh3OG1yzhrDhcs59yWnjWEccqpQMLOayWjC5PQUVU/ZzD2Hmx3u3dlgo2/ITEMwHq+d2DMGH03AJWZd8v2pgoQA0sFjVU6jS85reDYNnLoMp8uo/SieY5z3VE3N8dkJm9vbbGxsURQdQqD1JmN8ha9G+PEx33l4h/2+pqMbcj/DBCctE0QmrUL8KIsCKll/TS/0qoEoL/bS671gE9kmIQbs8+OFnQVQTKRUBE8VbRSViRq5iqnuYjbvUuUbzOhQURKUxOaTiTLxjFKiUioJOFqZvQqe3E3Q9Qg1PSNrRig7ZWwD5XCTd7/9XbLeEG0yMY+IPlJD/MAUj6tStkF8R2qlUD7QWAfKsL2zIzHUuj3Ozs748IMPsdbS1A1VVQkX2To8iD5cUzQMZ6nqiqapAeE+B/0eBwcHvPXWA+7ePRDTjehgG4R7nM+FLczIb0K6eDzPs0Cr5uhVXb6CYtOvSQtjZhEofp7pajUVc/b0yrYGqK1BXxuoXU27dvKN0bqgllSDU4PK4IrrNgq6vR5vPbjPt977FllRcDGZMqpqyv6Asj9gc3+f++9+g+//2j/gd//wD/h7v/7rHLz1AFOWjKdTnh8f8+WTJ0xnFU30NKKDg2ZG5msROSYv/DqQSZQ4DE6852vxeJ8ZJfZlUYVepzStwZQE00EXfWZec1FDRYfG9Bm7nJk3TKzmeFxxWllOK8dJFTiZwckUjieB52PP85Hl2ajhyajheOo4rzyzoLBa1uSCMjQ2MJ1ZRlPL2dRxPgucVl62OnBWB87rwEUD5zVc1sKVXfouZ67k0hdMVZc6G2DzAY3pMm0U56MZFycnVKNzunh2u5p7Oz3uH2zQKTx57gja47VtORYBk8StyKyrEGUYFTxOifLJeQ3PZoozK8c2iJjUOdGoq5qak/MztlpQK+PXvkyQxteEeoQfP+c7b+2xP9B0lSX30whqccZPoCZTZDvpXBt+EYhkP8RJ8+pbv0iptChxaFPTZfNnb8ewUiJ9SKCmBdRcgJnuYjYPqfMNKlUyU+ImS7XcrrwLEaejaHUu1hXc9uR2jK4vYXoG0zPyUHMymjCznv3De2zdPcLkhdQ1cn5KK4kPFwSkdXSGrIIiOI+PIYxA01iHd45ev8fDt97mm+9+k9l0xuPHj/n008+4OL9AIcFNQ3Jr552ErWnqCHaOosjY2d3mG994h7feesDGxgYuakBKc0YTASWchqSlhr4OaJBWNFLaLX13rfNXU1ohuZ3S2FoYP18rrfkwV2g+RueUWnTldnJ8/vpP9zWDGnLLV26kdWgZ1G5pogBFnoxtJX6X0Voi9aYaOkeZacbn5zz+5BHPnjyjU3YYDoZsb++ysb1NZ9CHzOAI4skkBMbjMZ999DE/+cv/yOXxCZPTc+x4QqeZwsUzzOQC18zwtgJXo1wNtpK1mtCIar8WkWRSGNFagRL/ezoaX1vTF+8ZZsATq/l07HkybrioFU6XmODJCOS5EhV/7WSSMUpEr0GL3mmaJZVCmYzaeVzwEjtBBXIt7ryK4CmiuYOOX9ho+QrXOq7vKLmnAVA5ZB28yiRd+Rh/KlA1lmnVMBrPqC9PyZsJ+z3NW1sZv3B3wLff2adfNnQKS8gCzgSMUmCjR5c4oYsWqvSngJqLbbLNJ5eavzozfDjrM8s2mPqCiVXYuqGpGi4nIz78+EPeeuch9+89oN8b4p2nrmp8PaPTnOPOP6f58q/40x/+At++k7FpZnTsGSZYAYN2YpXlJ/n2XxhmsW7tQaquDxDFle1klZiyhbUH8Wwj17Qmf2lNLmriqkBUTInAFDlsGxReZbLvFad6i/zB9znvHnJKn5PQw2LQWjQN3dxXMt6LLxrxGOzEwbIH4xp61Qn5+AnZ2WP64yf0/ZgLn3HeKMLGPv/j//Q/03/wLq7oMNUFlF1m1uOiiY3Rmdij+RRwVgyrHYHprEZnomiTtBu992RZTl3XHB+f8Pjxp3z22edMJhO6vR47OztsbG6SZRmTyRTbWLq9LkdHh7z7zW/Q7ZTSV0Hs1ERhJD5QEikuSdBWAVqcv5amlGQneZ3WFj/ecP0yLd5nrQteSKsA5yZqx+dL0MuUn8j8y7/4X/71mu12M32FoJYKvl7+upqRr0bLYHq9EjKVRK8XiOF0El1oY+aTDCGuyht0ntPf3OLO4T32D48Y7uyysbdD1uvijMYqhTdicK2yjMZ5jk9OOTu/pGo806oW7b7pRDyaB08TxPWO14ag45e1ig+gwGRG7NOi4bSo9Ed/kFqRR9u11rNHt0e+sUl3a5dsuElna4ei10MVudQxuvqpjaHCUAVN5RUzr5jFiNy1EyfBtppgZ5eE2SW6nsD0EjUdQTUlzKbYakqwFbae0jRTbDPD1RW2ll9XV/hqRl3XTCYVVWWpZ2Nm4wum43Oa2ZhqfE4zvoBqwtA4druKu5sF93a6HO502BrmFGVA6YYQY8iFGFUh9aPMHOLHRCZz4eQaVVDpDmc1PJtqTm2O1RJPrfECFNZb6qbi9OyUra0thsNN8lw4NWuXOTU3PuEXHkRFkajSn0ZSQGzvkqupRVqaB65OCoH5ZBnSs0h6mzNEgWBi1BaXnYOc18l8AClDpXqEqIouAe/EnER3UZuHzPIhM3JmIRenBNHYOQGaYG8E4LgGGeRBwXsyN0XVY/TknE4zpuMbccLsAvWs5vzikp3tbXrDIWTRhCa+HykytNYK7xyNtYLl0SQmRYkmahxa20gTRefVeS7eRPZ2d9nY3CDLMyaTEZ99/hn/8S//A7PZlHv3jnj//e/w1oN7FEUuZhUK4fTbLgoSaDyuUc/pZkBLR2mGuHXOXh4KN9KLs7V3W3nD6ylvnhTxo+nK+L6JVgFaOrqtBPMX//Jf/et0k9sy3kpfGagt0g1cW0x7zSe4TjcWJc0qc4cAgkyQku6DcCohSlwCEHR0eaUNuuiQd3uYbgddFFDkWKWoQ8AbDZkBk6GzjFljefLsmIvRhNp5aheonKepLXVV01hHFQJNQF50pQgx7HvyGJJeNrFTE68iWVT1X97kZXVFBzXYpNjaJdvYId/YpjsYUA4GdIZDOhtDOpsblBvbFBtblMMtOhvbdDa26G5u0t3cZDgcsr3RF2NwZekpy0YOfe0Z5pp+biiNIteBMtPkmYrx0+Txk0p4FkQLT6HxXgJ7qtDEzaKD+Kbs6sBmx7A/yLm7VXK03eVwp8veZkGvq8hyT1BWTDF0DBMUAqS1n2gTuLwWFGhUTq1Lzuqo/dgU2HZNLfkRtOJR5PSMzc0tBoug5kT8ZXyFn43x42Pee7DHbs/Q0Q7j63bcit9JAbUErEuv8OK7nfbbtDRY579xlMphIK4VxoklFq3acwsglzjuCHEhRhYXp5sa7xVT1UUvgZr0EnH8t5xm5DwDAmLBL6jJe09mp6h6gpme07NTurZCo8mCANGzZ89RSoux9+YmuiiovMNpcXmlVATI9JxKLA7DgkKZjyJFLxURA+wQNUONpsgLer0eZSGhe5SCzc0N3vnGO3zrW+9ydHRIWRaRkxZ/lknxI8RGTBric7oN0NK5xf67hZbKvZluzrYAZlc/iBarEJaOvlJSSF+tqvVt9ZmD3NX2XiZ1/PxsfuWrgtOrXvfSdNPDfLVcm1B6cRa/eOKXR5SnKyVfjW17xEEkNirxMy8VoyPqiUSeQAzNnuVoIxPL6ekFf/WXf8XTL54wvhgxvhwxOr9gdnbK7PQYZmN8MyO4GuMb8mDJsRQ0dHAUWIyvKZSjUJ4iqWpHbbYseuvXUSGg1hlnnV1GgwPsxgGzzjaXlDgX0VnTqlHL17JMeLJmkr5gPZ1Q07MTmpMvac6foWcX4unENhRa1mq8CzgnojeUfN07lRZcxAG08Y7MOzwGGyRqgtbinkspj/cNuVEUWU4nz+mXhmFp2O4XbPXFi0a3o1BK4nYFrWWLBoIyN4m/0DlnATpYdLDMdI+x2eTRBfz1acbH0wGzbJOpz5lYRW0bqqZiPB7z4Ycf8fbDdzg8uk+vP8C5QF3XhKamY88JF19in/w1P/7Be3xnP2Mrm9Gx5xKLCwEAceNEHGui0EKsFym5lQDMuaF0Tr6toogpnhCx6jyjgE2c/EP8CPNSpoBZ5KzieHVR/IjOpB88nOhtzFvf57xzyHnoch6Eew0xarONGvw+ilRViFyasygfwHmMt3TqM8z4OfnpZ2xXJwybyyjihJGH57OGcv+QB7/8X/GtX/8hD779i9R5SWPEubVGPiiTSzwbAjYg4XtiEFQxkJeApqIAEoOQhkDTNFRVHV1jCVed5RlbW9viE7LXxWiDtU00mJYQUiLCB2cbQBS3VLRrnc+Ei79X9kMQkeUa9LriR+GUV5+U7l597usgufXy/VelXU+/CQeE/o6BGjc80NcIagsDLRBk7Uyp6ENOY60Tx79x8lGK+MUb7YqYy96tFY/x4mRYAjsWeUFm5HbPn53zH/6/v+T4+Qnn5xeMR2Om4wmz0QhXzbDTCfVsTDObEOoZmW/IQ0OJpas9He3JI6iVylMo8QmZKXFUnMLRZCqAtwSTcd7Z5rK3RzPYJ2weMAol1oMyuRgVp69UZUQ5APFzmcApKE/fT+hVF6izL9Cj55TVOd3QYGxFFlwr2grBY10Tr0PESwjoKSDzgSwIpxZUJmrjOegs4EOD843UXxuKLKOTG3LtGXRzyjwaEhca62rENE2UHmQdJHqVCBqCkQk+rk2pYNE4ZrrLZAHUPpkOmJlNpqFg3ChqWzOzFePRmA8/+Ii3H77N4b37dHsDnPM0dUOwNV17gb/4Evfkr/nTH7zHd+5kbJkZneYMjYyf4FN4ojThxS0CrbzVCXylD9JxGp4CYAnD0oUy5pIPxBD9p4QgZg2+zZsyJ1BTgMYFhY3tH5RwqKd6m+zBr3DROeTCdzj3JQ2GoBTWefEuQ1wnlBvIfgwsqryAWllfYCbPyU6/YGN6yjYV1lnx/lGUXHo4riyXWZeDb/8iv/enf8b9997H5h2IUhIV3dc570VFSon4MniPt8KVhRj9AgJ13VA1NS7GOJxOZ0Agzwu2tja5e/cuZVlirXB3PkiMw6IocNZCXDNXGpqmluUGLR+G6XNjGdiu7AcVO+vqqulqenVQk4T52Lly5kraz4LmVZjXRdKu1Pda2ioMmJOIH1uSnLddsJL+swC1NECTTFieOcvE/VUgilbi0A7IZCHb/JoQB6rJDNpotBFPAyFqudmmweiMzChmU8uXX37JZDpjVtXUTUPjPB5F5RwWEWmqvCDrdMg6XUzRQRcl5AVkBVZl+KwgZCU+K3FZRzbTweVdbN7Fm5KQFfi8pO5sUJcDmqzEF12czgRwTUaW58KRanGEnOmMPHrWN1EBRWnIQ0PHz8jqEaWb0A8zulrid3VoyLW4SSqyQK/UdAvoFopurujmhm5h6OWGfq5kKwxb/ZJBxzDoKvqleMcYdDM2hyWb/YJBJ6NXaDq5olcaCTyqA9rEMa3FQwcYZFpJAjPhokP68EBClAA0KqdSHc5rxfHUcN4UWNXBRe1H6x3We+q64fTklK3NTYbDDfKoOOSdA2/JfdVqP377wT77UfyY+aodsfLKJrUVxLga8eiSNBDlOIopVVoD1ES30xGwYppK+/LrVdrE+kxCxaQtmlzE8DEuaMR7qMGpTHRptfzaoJioHmrziCrbYBYy6mCEa0/LZfHjLQSiJmJ6DwTgVFTGMV4Um3w1xUSurkJToZiimTiwWcE0ZHx+fMG/+8u/xauCo3tvsbWxjXeB2awiy3LRNAUCCttIdIQUHSNxUSEEnLc4Z2mahul0Qgie3d0djo4O2d3dxRgdNRtF+YNosqOUPBMhKocQoqs5ccQtzs/D7ZzakkhyTVBJ2V9Aq7Ktwq1VaT8rSh/3L0+rMGBOV0CNF16wmq6ubX2VtKRetEDL6a8EsxF7XvT8qv2znKpAXqI2SQqTtNiDCnnJF+EvGbYiL5BG4R1MJxNOTk44Pj5mVlUSAds6WasJQcSWiSPUGpXlsuU5uuigyi6q7KA6fULZxxU9XDnAlQMxnM17VHkPW6atz6yzQdMZ4MseIe8STI7O8ugiSyZYoo9N4dOioCoCWjCKHEdBg3YVmavIfSV2dEaTZRpMJgtoRqGy5N5CRy8U4lJMJgxNnhlMbsiLHJNpVKbQucLkhqzIMLkEStVanDPnRYGOLsnShC6WaAYfTASuBQ4HgwomAoNM5AkUGt2hUh0ureFklnFhS5zuYIOhshLA1AWwjeXs9JTtrW0GgwFZZmLYGUuwDdpNcZNz3OVzvnW0w27PUGpPFprWBisEWQsKihiJIcfpPGodZniVRSDKcDHNpS2meyUg5LWkyX4um8rxFHglW1B53JdzQYsrKmJaUAWOHKcKnMqjkXyGJWNmhqiNIya6R+U1M6+xXgKBJtuv9E5EKIjDvH0LwDtCUxFsDSFIO2YFdV5SlyV10cV2+vjuAF8OcdF046cfPuajjz6jqR1bG9t0Oz20NrL2p8QzSF3VrbhQAtAKx+a9p66FSyuLgr09cYgskRVKtBYuPr2XgbjYiDzA/L2XtATSLWAvUZoF2idOYpt4/dX8N9C1eWaZBGivpi7SqpOr0l6NXrukhQKuNeENaazAqMVsK0GtnXtfmq7f7Ouhq/ddfIaXq9C69Vcxb3xl53dJJxa2pZc5itrSwE7ZUUngQ1zzkePMZDTWMqsqqqqithbrfdT2EjGPi6IzZXLIMkJWEPICig6h6BKKHr7s4zsDfDnAdgbYcoDtDGnKIa7s4yKw1eUA1+lB0SNkOSor0DoXLkdpxNeUqOEbZMFe3C4piAEEMuXIsWhXY3xFERpyFSiinVwwhmAMZBplFGQiflXR43/04yVRubWSAKe5iHwwAQwSrTsz0dWXBBJVWktMOxX9ZKhkWi0cSAhGRI1LnzzCvYUIHB4RswWlaVTBlILLWgunVuc4XeLI5qDmRaR1fnrKztYWg+Eg+miUeFvBNRg3xc9GuNEx7x7tsdOPHkUiqFkfuQwlE2UTFE4VWJW3nJJXVwFs8VwuILYIbCrDacnnybDe4IKUYclagHIhwwWDjautbZ4gm0MAzamYn5ypGcDGXSa6Rx09wdjEnaWWDfInSSAWZx0VEO/ErgFvQWuy7oDQ6VMXHeq8oM47uLKHL3qEYgBZj6BKJlPH+dmEi7NLJuMZIPENtRGJidhoSw+HIK6u0noZSsxv+r0uw40NNjc36Pa65Hn0sdnyevP3UbZ55dv3+IWUct10xcrZ+jqtujTSHNCisf3PguL9X5ekhFXlrEpbnu+lCgt9tLSmtkBJHXaRXizfXZ8/WjffenQV1K6mXTt5OylpqfDCKxcBaoHiF1lKVYgyAiFOXHFdSki0qdpiotRDa4NWGc4Hnj57zqPHn/H5F1/y9Plzzk7OGF2OpDzvRNziXYyPNo9HZlJE7rifRbV+YYwiB6lEFJQpcaMUsoxgMokIoPO4lpUR4mRPdLIrCt5RcBfv4Qw4HchDTddXmOkF+eyMTn1J6RuKKNRyEm9aJg4V1xbiV28anApZ68uUF+A0mfSnOA9s3XwpBFxNVEeXNfzUkGndInHDsqah8KAkSrn0S+ToQnQ+i4PgJJSNL/hy7PnwuePTUYbNBtRkjGrHrLFU1jIej/jko494+623ODhMazKyNuRsTd6MaS6eUT39kB/94Hu8dzBgq3CUfgK+wXkH8Rso4EUxwxTJSi8OwjgS2w/zNDJVO2DTe524BnnZpTWcE8AJUcHHQ/srzS/X6Liu6H0UH8YPmZbjDTAxQ/TOW4z0gKk3TL2stblYfkgShCAfaCGIaN6HgPJxcw2qmaCbMco7ep0u3nkaN6N2Fc6LLaRH4aOrNOs0gZxZ5ahdQ3fQ5+E3HvLed97j4OguG1ubdHpdMqPwtsY1VfTOL6r/eZ7T7XYoyzL6YlWIgn/bWu1H6kJSpMWZYOnEEs3PLPZPOiH7Ko33NeimOXcR0GDVmtpqktuumXkNehPlSRGry7jOASOzw2KzXsmzNqjd1LivRgucyxuhVaAmNH+OGzLcQIHI6q3y6NDS9aZbEptHYFPxhEovfByBCdzSl6B8wYo2lwQt1GIfZAxN4/jyyRN+8tMP+Nu//ltOj0/x0fFqq2UWFU6E8xPwAtH4Ukpsc+SrNNnVJFueELmiKMaMC99RBSROrrJ2Y4oClMKEgASkl7MJ1KyBDEdHBTJbkTcTOm5GERVUNAGvFF7L2pX3CVyiN41oU6VVwBDEu78S0RxKiTp1ck2mFEZpAdgAKi7qR1WI9gshIGUs9mPwUT1buqC1EQsg0aiDxaqcioKnlw0/eTLm0zOPNSJ+nNSWWdNQNQ2T8ZiPP/qItx8+4ODuXcpOiXWWxlqcbTB2xuzimNmzx/z4t3+Vdw82GeSB3M8gyLqcNLXU1QXQRrx0CMkHSNqXH+kbYyQYJu0LLqfDglQqxHVQWXeT9bkEapJPAEhF8fccjKLyjJJrfVQuqVRJpXtMQ8HMKaoIaok7Fj3+CGYIoDkvQKlaYHNoV6HcTHQmdCEiyNBgsfgg49Y5D86AN6iQEbyIkC2ema0ZTUfowvDed97j/e9+h4fvPGR7Y0CuA8GKqFEbiYzd7/Wj5mKUnmgVdY9jO7HQaNdoafQs7CeKb/G1SXjxuvl+8hzzIro+70bYXezsNHesQW8ChBbpdctb3WZzug3Ubrr2RlCbvzyyd71xX4fePKgt7i6XKwnr85BCYkwqrb4ofngxRe4t3S4Vk8JmxXPpizAkLi1OsDo6qxUAVPLFDOIDL0DdWEYXl/z7f/vv+enf/JQnT5/SNJZut4syRnzkqQhOqQuj8bUYh0r0X6P1POqvoFl7jVbikd1ExkhaQL6as7IUTi2I0E4njk3J3ON0BKQgwUpzbymis2UT3VN5LWtWRAUbiE6EF9bnjIrlRPZLQveIf0EV1T2MUmQR1DQyUWglLdeilWIObLFLYsNL20QgTc8XAujg0EEUceqQ8eXJiL95/JyPn41pgqwfTauGWS3bZDLm8Sef8PCtBxwcHtDplDTOiajYWpSrmV6cMT3+gv/hn/4R3zjcoZsptBe/gi5O/kTtUe8FcOSplusLsu6GPF38M59QAyq+6PEDKmYRq4z5M7YgJZe1k4OITZPILrWL2Ai6djOQd2m8RFOoU/ikEKsZvKyZEVAovPftmpt8Z8hHjA4SXcJ5aGyM8I7HKdFMldA+FuU1WcgwKid4jW0cloA34JSnthWVrej0Cg7u3uFb7zzkvXcecnhnl83NTTrdDlkmSk4tegfxfqLj187tb/jSyEmNvkDpDV5x6gZaG4Su3HoZeOeFrFPefP5fI/Oa9Dqgtk59VoMaC31y/fwtoJYoziJX+/W16E2D2iLNUW1e/jLSye7td18GNdm5/QqhOVjFBBUAEenI8Txv+7UBsXOkXbQS+5sQJGK2j+IbYzKUVjS15fJ8xNnpOR99+DF/8zd/w6eff06WZeRFKZF7lWhmeidiySxpW8ZJX8X7Z8ZgsqIVMyklXJpRkALPp6cKClQuShg6RGAJEfyUwumA16BSKBMlXJxJXBjxC16FqL6PNEgQ8NQhAlsbvkQ2kafKQRIzCugKsM3FjpGBidS2r0r9kEiMikGJV/kkdIzzhfECagGFw/Ds9JK/ffSET56cCjcX1zSrWrbpdMIHH/yUB/fvc/fwgE5XQK1qLDbaZ00uLxgdP+W//2d/wsO7+xSZFjMKkOCqStotKFGDF9ur+UAKkaOK/+ebj+Mt5kl5JW1RaQMZhwtcWgI2AUO5QgX56Encv2gySj6X7M+CfGS5gEQAT+lpFHtHCBai/abzHuvAejHGlpYP7ceD9wrnFdYG6uCw0VtI4tawoINCKwNByzqZEqUkh8eGhmk14XJ0RrdX8mt//1f4/X/4W9y7e4dO2WnBPc+y2D7peefjRY7XecNvptD+WUXLJ2Q4vvh+N4PaqvKuU5u84po3Qa8PardfezOo3UxrgFrs+Re3/0vQmwe1cK28xKGtoDiSF/9epeugJi/iOiS5Ftbb1A19t3DrdD9hYOTr1vtAZuK6ig9oI+JCZ+VprQ1cnF/wxRdf8smjR3zx5Zecnp4xrWYopSiKAh8CeZZF1WMtIKBERKSCiB2zoov1YouklNjLZUqRRcBI61NeSZgPdJxk0BHURFTpdSDoACpFxiYqYRhxaxQBROKXiXhLaRGfaR/LDB6d1veMhIqRcDGiNt0CqZpza1GiJO2XAmQvcDYy2GLvKaLNoI4d4FDBEZKaQADjLSb6SlTKcHJ2wU8ffcbjJ8fSZV7EilVlqaqG6WzGT3/6Ex48EFDrdksa55nWEk08eBiNRpwfP+e/+2/+KfcP7pBlRkTHUZnFIeuLAXExJiFaZBNAk8qlCVk8kMwHVYgcWDv25IJ0Mn5URM5rAdCknPjgsRXCAqiJVqHkE2ALECRmH961HFgqPYSACk44tSDroc4HGk/0wiLcm8BriFyd6ItYG2iCx6ZnJMYrdOIQM80a3svHkyXQuBplYGNzwO7eFkf37vCttx/y7ltvsdXvo42MPec9WusYJkrazrtoUxo1ZYXkdw4eb4IWC5J9hbqOWCtoMctynZYrtwrU5kNgxck3ROsA0ypat27/eYNamM9fS3SbDV2rar9MIZ6LRUKSYiE3un7FMoUr4kUWyllJCyIQpYUTEDdO8iLrCETpvoGAdRLmIs8KlNJcXo746Ycf8eGHH/H06TNGozF106BQFHlBnok9mY7lKcR0OjMihpR1HSXOg00e477FcCLKgrLCRURQU2hUMBL2I2i0IB1BR4upOKEFleMwBC+ApnXijORLXusMgkZJrMf4dS9rYU4rnBGWTWmDSkohCdSiqFSJ7FE4yagWnyaNeavN21h2hEMRSBG/gS7Impr2ARPXlEJQnF1c8sGjz3j85JmofTuLa2pmlWU2a5jNKj766EPu37/P4eEdej3h1KZVTeM9BMXl5Yjz42P+xZ/9M47u3MEYI6rmSuGVcGsKGxVYQjQKXwQ0ecFjE8XxJc+W3vt0Lu23B8gaFiGuZy6CGnHiiDcJEYySg2UAsZmbiyDxsioXfDQtia6wpAhBKLmfjCmfQC3IvtQ7PVwA7/HWEpzHeeH8Qpj7kJyv0cl9mqbBhUBeFAyGfXb3tnn48AHvf+dbvPPOfTpFQTWdRlG2gJgYtidgk+d2zklU+8WxEdJHUWy616bFgub7Lwtqc0BbXbGVoHZL/jdFr3IPuWS9a14F1PSrXPRzSwtfsremLVG43int5Bd/l8beiwdi1GWQ/XQcZIVExGxqaVPC3IiynguyOB492BPEO4K4GnIEa8WkVlmUtlg/pbFTev2CX/mVX+T3f/93+a9/84d84xvv0Ot0yLNc+CivZAsa7TUZBYUuyVWJ8YoST0dZCp08jcxV7EXTEJQJ6MyjMo/KQOXz8NoqN6hMjMmFI9QYDIoMKAiqQGmxd8uzjDIz5Fr8/GVAjiILSZNRY5RB6Rx0IRuZbEHKlHIlnI1T4mjZaU2jEafLSuPiloyMXTCiAo8o4cjHAqjkFFGLn86gDV6LWnztkcCl0XGVbBEcEONoTLIHixqicX2SxEEqWddEiS2VaFqqVjklKagEEkcla15OGXyKY6YNQWcQN2mbLK5lyXqUCxGi47ENSswDQqy3mtd/eYvPhIhBPdG7S9on4PHtr0PcUcVIdNfeoAi1srXi3ZQjAbGAqvVgvSdgUapBKyuRC5xFWYv2UfFHOYJqUNriQoXRnrt3dvid3/wN/sWf/TP+9J/8Pt/95tv0dMDYGh1BML3/CvEEEnwQBR7nyKIZwFJ10/5aFDt3LVq70Gv0IkD7u0TyGF/tc6jnz07ljV7F5ST6u8KppU5fyZ1JyuKay3La/IRwWgvnkaIVCbBu75QkdgzEC5Y4vXSf5fulK3xIHEc6KRzV4lqYNiLqq20NKIwWlY2mcWRZgVKGumo4Pj7l8aPHfProM54/e041nVEWBWVetBxgbjKKXKFoUNrjdYnX5dwuDUA1KNXglQMTCBpkxS1DBxE+GjREsaGAtwCoJaMJBu+dRCY2AaMsiib65wMVJB6WCnFcxEUyl2U4I+6XgosTU+LUtGhCKg2hFXvKBAzIylvreT6tDMqmCejIbSgcYPGIOyjf1qVlIji/HPHhJ4/47MkTtFJ420gctcpR1566afjggw+4d/+Io7t79Hsl1lsm0yoGt1RcXo45ff6c//bP/oy7+/torfHOtwbXPnjpAywhKJzjyipuGkHLad4LGM2HpGgoLouqPN7VKMQbzdzrRzvwIE78Ojp8bkPhRI4pXeNC8nGIcE/RQXF7s6gkonz0ygGypuYFZH3MGgISlsgH8A3K16hg8U7hfbQ3i5qYjaup6imNbdje2ea73/0u333/u7zz9jvsbm8SvMXbBnyDVg6UBOBFif0iSJ119PFonYWAeH6RlzS2UzRDWGziF5KaP/tKSucW88T5aY0biUBhVRnLdJVTm+PGzde8CXoZTm2edb388PKcWmBd8SO3gNpi+nK/3UiLQqE3RS8GNeTO107c9GwL6Vc4r6u0ugHTmprQ1UG3qqSlMS6jvr23PFGchjSiJRciKCgFpJAbJiqaQNNYZpMZlxeXHD8/4dnTZzx//pzxaARAZvK43qbE3yTRp2M0sFYqcRs+igQRKzOlUCp68VDiV4QgAihFkOuS547IiYgoKq6XRTBJYi/5UJiPivSR4bWW9TSiiUPMoWM/tn2pFzRO0xYb8+pICC2oOXRIHIQ4zUocVBBGOXas4uzsgk8ePeLLJ09FvBmjK9e1o6o9s9mEjx99xL17B9y9u0+vV+KcnHdODLRHlyPOTk/4p3/6Y47uHmBMhrOijIKSUEWEhhCa9kWWIb3wCRWfKb3nIYJDe3rhfHod5LTHB4v4vJyfawtI+205cXKH6LlmrgjiEaNmrcA7K6AdATEgacFHizWlcFbWJn0QRRERP8ZbtuGaYsBNJVIK2ziaxsZ2bijLnDt39nn3W+/y7rvfZGd3h83hBr1el9yYKDKVtUgQkadLAyJ2f4jvSSCCcEC8jrRPnRo87i4Pm7Vp8bL5ky6TapNvusmyZOmmclq6eiqsSvxqaGnevYHas2vkvYnWuU+iNUFtFa3m7kJYGks30CpweT1aeuiXArVVlPK9IPOCmPKNkeLaRHyd4mR8FSnbmX1OKmrrzaqa0cWI45MTTk6Oubi4ZDKeMKsqnLUURS4iRzW3iUr7i8charTpGN5mbusmkyEhtH4ERdk/AV1adZG6t1/38VeaOxqpSw/Mn0HF+7CIZJK/ba+UHJnLOV03kNfBC6gRB2vSCgzLqutEsD07PefTR4949uSpQGJQNNZT1Y5Z7ZhORzz69APu3bvDwd19er1OnJxlknbWcXE54vz8lB//+I85PLpLpg3WOggarYRjCMESfCMhTlRqnzmoLTaZjPdFh8apD+bn2mMV8Djh0+KELvZi6Tig0rpYWstKnx4hiR8F0IT3Sg6hxb/ivH4CUsGL9qICAbXE8SUOkGQPJ170G9vggkNpRVXXNHVDnmfs7e6ys7PN3Tt3uHfviKOjQ3Z2djAmrYcyH1/tI0tqMkd4U7QuyMloiqPtyuu5Hl1R8lmTXuWaN0Evuq+cvvn8uvQy5bwGqEW6AiDtQ94ILMiUdfPJV6Klxr3x3uved01QY/3BvjatVZ68yC8GNUFd8Y04597G4zFnZ6c8f37C6ekpl5eXNNVMrlACIiqq9kuMKSkzAVo6J66pBODSefnyRvwvMreVE3leBLQoZpVOS88gGRMvtpSmEme20K8q8m0LHdp2WUoK6nobEdetQhShKbkgENXcQ1SxD/OX6Pz0jMePHvHs6RP5SAiq5dRmtTjGffT4Y+4dHXBwVxRFJDClF6/11nN5OeLs7IQ/+dM/5ujwLsZkEdQUWokNYgg2cmrz1pAmEuAIQVpP/kvd0nveciBtvpge8wYEnAQrY1+0v9ImgeSUm1YrMrSiynm5IXicF4/1SvAlcnfp/uLMudWgXBBlpmdJYs6msVSNeOc3mSHPc/q9Hnfu3OHhw4c8eHCfO/v7DAd9lFIS7JMIxPHJl35VfDt+hqDWNv7aNL9AmvClC3jl616XbruvnFp97mXptvtcpdcHtURxwlm6+Y3gsi6tC0KvcN9b86y677UEYP3B/mZJAE2CFS4mywQtJL/eeVkQR8wEnHMYk5HnOdZaRpcjjo+P+ejDD5mMR1R1CqchWpEJsOIIlXIjwCRODaIoKXqRUCgyI97wUdLWcm3iBKJ2Zys6lbrKJKSiJZrsB6VaTk+APPWbgFoC3EQ6HQfJM/87pxAneCFNSBMzRPX0OVehlOLs9EQ4tadPIreqsNFOra4bptMpnzx6xL2joyh+LIRTswJo1gmonZ6d8uMf/4jDo0OyLKOJoCbiWyKoWUIAhdhkSZtF0Ei1jgCECBbjMwl3JOBGBL90rKIJg4iB23MR2NIxEdQWDhf2QzvYfQi44NpvD3GpJfVQUTzpnChjyNphFDUT1+O0Ek/48TrrHUFBr9/jG++8w/vfeZ+HDx/S6/VQCpq6xjsrETGujJb5r+wnEinn1Z5/dVr3Pb/6Sq6m65lS+7wqvcykvw69Tnmvc+1VepV2Uc+fnbUmWa9HqZDFSsRJ5ZXLXwUuq+mlQW0hx/V7XEm4RSS47mB/s7QK1JIsVC3VP3jRokyTcZwxW25MMoFzlovzc548fcqTJ084PTmhaRpMlpFnEn6GyKm1XkiCOPVVCGem4qTlnXgsUXENgzg4ZV+ALcQ+01oMviWXSitmSy6iUKJjt/i8EdKugdqcm5s/28JRTIr2Vi2XFrmSCGbey3pliBPm2ekpnz7+JIKacLy2sdRNQ103zKYVn3zymKOje9y9u0evW+K9o2nimprzXFyMOD074U9+/COOjg7JshzrnHRH666qEaNlNIQsAlHEE+Zup+Sh5m2Zgq60wBbbN50HDT7Z5qXzqbykui+b9xHFUlN7GUPpliooPAEX2yeEmD/2gxynRUkhpUR93jnxMjKbTanrmizL2N7a5sHDB7z37ffYv3OHQb9PnosoHBQ+rc8lQIz3WRzl8c7xSH5/3kHt+lx9LQFi369PL5X5VpL7rl/ecvb1r1uk1c+6MvFWWtJ+5JZhcLXom/Jdp/WB6Tqtf+1SJ6wFaole/OzX88xzrjvY3yxdAbW2Etd/VTwKCOglDxQqOgNOZ5PdVF3XTKdTxuMx5+dnnJ+fMx6PqaroR69dR5M2TxPNXASZjMaFO5RpeHHyi1VL9RMjs/ZYCk7p0qMJctKKjvRv7Ik0QNabTYTC/ANg8XtfQC26iGonezg7O+Px40c8e/q09fbirKNpGmmvScXHHz/m6Og+d6P2o3MO11ickwCV5xeXnJ2d8KM/+SPu3TsSTtmlIJrSbgRLwIIS84Pk0HgOVAmkxPPH4jEL3FtouTG5mqDnOvrxGskhHHNA/JGGCOiSJ7ZVBLX2OAhwyUfS4uQcr4/Apdu+CVR1FceOOAQYDgfs7e1xePcud/bvMNwYMtgcRl+Mcp2It6ObuCgqTlxgosXRvjSsIjd5PfXVad33/MXDMPbS/M/CmRW0It/XQeuC2kL3r5X/Kr3u9asoglp7mP5fo+WHvDrJ30Y3l/lieokLF+v3UqC2SGs811WUVe2fr5EWQG1J5JgoHavW7ilhSogf1SqujSVqxYwoYB57ajQac3FxLoolkzGTyZS6rmga0dLTWjyVyD3S5KswJo8ANZ9sE82bLNY9yL6KgCb9IHWTv3NeKiW2Pdw+fgTMNJe3iinXSQUldoEhglpUHQ+JUwuRUwuiSXd2dsajx495+kxAjSAKEE1T0yRQ++hTjg4fCKfWK/AR1LwTH4YXlxecnZ3wR3/8R9y7d0heiIgyeLEbCMFHDUCLVwYbA3Qm1BAASx0ZFYXSMfIrr0Ds5AVNRxVAufhRE8taBDWv5sJL4VJTu8k9hXtLt4vrcsndVcuhiS9FZ210Ui195ryjLAuGwyE7O9vs7u6ws7PDzs4uW5ubdDtdlBHnwtbZCKoR2KI3nTbgp05jRerXuhJbmCZkXMQ10TdIrw9qC6Oxbd/0JIsHNxbwtdLyfH8zvShfOrOq+eaX3nz9Iq2X6xqoIcNiRQ1urPy6ALJuvjdBr32v1W1wjVR6m9bJ/CYpgVrqkqv3nx8HL7zIcvclQJs/p1Lx63ZBxJhlGSFIdOHxeBy5t3NGoxGTyZiqquLaU4hrKDIhpfD2qVwRE84nQNrxNNfem3ONKc8C6Ea3WvMZI9U75ZF04R5ilhshTe4VXDq7uKYmXEEIyVuGlHl6ds6jx5/y5NlztDYQwFqHq2uapmI6qfjoo8ccHkbxY68gOIezDmdlHfPiUji1P/rRP+He/SPyvJDgoD4qZ3hPoBFTB60lUCgi6iSCi+wufJ0QQSb+puO2s+MzERbT0+UCYu1vvIcELJ23nUgj5ThETUhCILjIPcnNBdCcgFmWGcqioCgLssywt7fL3bsHHNy5w87uDt1uV2wro2/HgLiAa+sTAiChhWSMzJVN2nEVH3FxrMchAe34enP0uqAm/bB8MvXtzyOtW7fb8skp6ctV8+lt116ll8n7+qCWaB0gWSfPm6Bb7tM+xy15bmqDa/QzBTUi97Lq3vM0WVOTyT/E4xAn6zZPkHhTIQJaIh+Na1VSCokcWV3V4svw/LzVnpzNZjS2ieI0ceKrlXhxMCYG8YxlhxQh2ad6LG5Cc5BDRGNmHrIH5LrkmVLyXwG1+CslLLdRQBRoUNGvIQrShOqjurqX9S7QnJ5d8Mmnn/Pk2YmAGqIo4uoa21RMJzM++OgTjo6OFjg1j2scPoHaxYizs+MIaofkRTkHNSdi3ECDUg6lxbQg8adEMV+a7OOBPIuoabbPRZtvPtYDYugciJNuC3LyzNKs0v/OSb4Qr/dRlBci95PuJP4hhbNKrrWUUvR6XREtHt7l7t0D9vZ26fd7dDodMqOl3ZzDWgvIuNNaozMxjBaQizZksY7S5sIday0Bka6L3L9aenVQW+yb+ckXzqc/Y1q3fqvyXU9bPZ9ez3ed0lh+GVoBaqysxIsrEKePFZWf0+uIIl+CbgGs+XPcVpd1niVmUHxtL9aclpZBV9D8hRfnxSz03fJaiACOomkaiHHKWvCJk17aEqloMxZieJCmaRiPRpycnnJ8fMz5yQnT6YhMKfKoaJJlprVN8s7J2osPZEbW1FSs9bzmsY9CXBIy85ArLRDG38W/IapyK9Ijz0tMFAAfxO9iAjVFBGMfw6YEF9XaDSdnl3zy6Zd88ew0OmDWsmZW19i6YjKd8sFHH3F4A6h557iMoPajP/rH3L9/SNGKH6P2YHQVJV5ZFoStC5ySgFl6CNlpxXVpAlhiCBKHFzVTVbw+SS9TeUkBJHJq8XSrUCPAJunJ+HpWzZhOJxA8G8Mh9x/c46233mJ/b4/NrQ0Ggz6dbqcNZSO+P9NH0/zjKSQxqZqPNx+5TwEwGTMkzznp4f4Ogdpif7R7qXNX0OKpF85BXxHdVr9FWpXvetqr4InQK4Has6enaa1cEhb3FiuyViWuV3512pumr+oetyKH0JUbL3I6Xx2lER+kjiu7RerRqrgnipPc/KUREJuvZVzL3v4Jsbx0TZxKRcXbinp7Xdc0dcV0MmYyuhRlk7NTxpeXuKZGBd86IzYKCqPJjSLTSnxaRvdVRsmkppVEX27Q+KSxGbk0FTXkRJNT9kMAFh31tu2THkwRVIimyH7ODcV7i+ael3WuuK717OSCjz97ypOTS7zKQInhtK0qmmrGaDLmk08fcffwgLuH4lHENhZbW3AQvGNyecnF6TF/8I9/h7cfHNEpCvG+EYgG8kG8MCpPUOKeS5p9PtELQs1RS0XukggCCbNEhBqB0ocIHCEqo8jl0n9Jw1CcEvsQCEpRNTb6gFRU1jKtK2prCUpRdEo2NrfZPzhkc3OL7a0tNrc2GQ76lJ1SjPiNiREa4niK9YEoMo+1j7Vt/6bnneeYc+Lz49Sn8/78yineYl6zm2jhoyMepue7RvHc101r33GN+oU0l1yla9fePD+vD24s5JuXJ8nL16tnT08WUm7jXtahVZV/3TLXoa/jHitIXb3p/PhmXvFNUFjq4OXfZVLX6rL45fjy1GqoLfxdLD7temepZlPGo0suz88ZXZwxHV0wG11STUY00zG+mVFoiZRt8JjgSS6HJR4bGA1e59TkOCWBHlsQW5iY02/8xo+/qX6LokqFVwGnBNakJRUEL8Erk5cNAh6DJePJySWffHnK07MJXhcElWFtwNYR1KYjPvn0Yw6OxE1Wt9ehqRtsZaU2zjO9vGR09pzf+a1f5xsPjugUOaFpIICKbrJ861pYnkPwKnHKyVg69n1UxPAuRfAWMWLKK2JB2VQEaRVFkLJONvcB6bxE2xbvIVA7i1UKTIbOc8pej8HmJsPNDQYbQ4abO2zvHdIfbtPvdymKAqUETJWSic574cbFtIMrYzaRpM3/LpL437w+rmO/fs2gdrV2q6n9qpinvM7L9hXQuiDyIpJi0lzyovJW4YJQKuc2mt8i5VsAtRX3vwJq3FCBawk30o2cykqR4O0P89K08h5fIV0DNaSt0lx6/eQbolXttvpeMgWopWteMIZup5WPfOVJlUKbTO7pPd5ZfFNRTUaMz8+4PH3O6PyEenxJaGa4aoKbCcjhGvHSHkRVwqgQ/T4KkCUu8SpQt4+3+HAL/aBU5EpReKWwIUQP8+IOCiRcjvgPBAhYCmpV8OX5lE+ejnhy2eBMF6dKageuqWmqivFszEePPuLO0QF3796h2yuxVYOrrUQhcA316Jzp6Zf88Fe/xzfv79PPNdRTAZvoykz83wt4KRWdKl978ZNIUdKS70Ui3glXF0EtCEoF4jHyzM4HGgeNDxIWSOeQFWAKVFZgyi5Zp0veGzDY2GR3/4D9u4fs7O3R7w9QWY7Ocmm7pOwR202UO4jcmYQfkn5on2SBJG3VGcLV9+fK/tcJaqwrfvzPA9QWx+N65a3CFKF1rr+eR8q7nh7PvhyoXTtxjW4EtQWaZ7leoTdCVyfZr4riC5ueYume8SG/mpqsarfV91Fxu6H/X5JkQpVHW77fYlpQCrTBOgE0hSfXim5uyFUAV0MzJcwmjM6OmVycMDo7Znx+TDW+wNVTgq3BWfAOExxF8Jjg2uehFRwKGMmxwBTBx+jNEqwy8W/JpVdQGVVDDEkj62ow536CktIaVVJnfb68aPj4eMYXY2hMn0Z1mFqwTY2ta8bTMR88+oiDo7scHAiouaohNJbMewo3w1+eUp19xq997x2+dW+bYRZQ9QjlHCog64xI5GsVvEQTJ8jTxrGU1glaTq49ToAmXJeYJcQJNYiJmkfC5TjE2W/tFVZl6LJP0d+gGGxRDjYZbt9h9+A+W/sHDLb26PY3UKbABSUcJVBbBzos2fKptF4a1fm1UmizaFcmfbVMkjaf91eP4eX0uP9zAmqLHKaShJ9bUHvduqwCkVVp1+k6prxMXda7x5xWgBorKjGfSl5E64AapPd0xa3fCM3rsGZ1XpHmygtc42CSSPQrrcAL6c0282JBq0S+chSUQhkT/SfKGpXyUaxIIFceo0TtANdAM4N6AtWYZjbB1TPq6Zjx6ILJ6IL68hw7Pkc3M7y1OCehRkJw6FZUKVuukXAy3hG8gKIKsk6XVs/AgC7wIRMoVCJ+JHgCnpDEcLpDlQ35YuT56KTh87GhygbMKJk0iiauH46nEz74+CMO7onGX7fXxdcCasZaymaMHx3jTh/zg+894Nv3N9nMPVl9GR0ry/29ikH3QgDr0AGCitEOokKLj7HR2kCf8bwnRqb2YINEBkgRArxSYHLybpfuYIPecJPucItisEF3uEN3c4fOxjZ5b5OsOyQrB2AKfIxnZ12gbrxEZTAZPnhqV+NxaKUwRhSBQvRME1ovM1pArgW0+fiZT1Qp7bb3ZMX88/MCalcmZxGZLj7nG3v5XomWq/PydXnR9esDztUGXOealyl/TjeAGkuztEzMVyt1E12Z5m647KsFtUVannlvqM4r03ywL99Ejl7hbm8YCK9rYy3SlZWMmzprgRSSb2XONj2WmgyYoyKDiUE5dVq/Ck4Mt4MTcLMNwTXiOSR4nG2wTY2vRtSXJ4R6gq0rqtmEajqmmggI2mqCr2dgK2w1QXuLTmtzODJkfU6nSNkxxpqCBY4niR6FswhArXvMIqh9cOJ4PDbMzIAZXUaNmDY0dcV4IqB2eO+Iu4d36fZ7uNoSGotqKsr6Ei6fEc4e8YP3j3j/3pCtwlM0F+ggwBCCJ2glkcUx2DqgggQIDQsclvWBOkATwAZF5QJOGYLKJGJ5UZB3unR6fdk6XbKiT29jh6I7oNMf0O0PyLsDdNFBFSUqKyEvCaYAnRNMTkhheFIIIU+7lhkQTcok0lTRpixANBmZ27Atc2pxb2Gil/XLlaNp+d26CVVWXnt9he4mWvc9Xbx9YEHcHVMSXX3ffpagFpb/vBS1V7zg+lcBnRfRuve+iW4BtUQi/rhhGluD4rC5cvmbBrWw1tC8yoG+HqXahyXcjHvXuJh16M1zd1dfsvhKLhwmFyOs14Ix78o6xnQVHDo4VBBHtiHeQwxn5br0skugRrF7akOWyJBLOdGhwlcXaDcjuAZva1w1pZlNaKZj7HSEryZQT2mmI5SdoWxFaGYCdk1FaMQpLt4K1+htGx1ZauJRwQqwRRX6SneZZZt8fhn4yYnj0SRjajaY6R6jRkdOrWEymfDBhx9ydO8eB0dHAmqNxTcO6hmd+hw1eoY+/4Rf+9Yu3z3qs11YiuYc7RuUElV6pxUhM6BKCCUhFAJqWqJrYwrICkJeELICnxVQdAl5ico7mE6PvNsj7/UpewPKbp+i7KDzAWV3G5330VmOynLIMtAxCrfSMayMxrV2ezI0kvG+VvIRoOK4D8nMIPZ77Koo8owlqJh4hVqR5fVTSxRIN0w3WDHmVtLLKjDcXm560uXSVpd99ZleF9TWvXrVE6zXBqvpRde2Z16Qbx26dvVrlrkGqBE7f1m99uVpGVDeOKiFNKneRm8e1NoniOXOi59XZv1b3gIYr0jzl2ze1tdeNJU65MX3TdqPS2lXGl5Cu0SxU7yX/MjHUZpIZN1FlCTki174JtovfAG4TAW0b9CtV5FYvrOyPmcrsDW4CqqpHDczbDVpga+eTqirGbapwdYoO0P7RhQ0vEc5uV7ZGqLYsqJkpvp8dmH5yXPLo5FmqodUuse4MTRV1ZovfPjhBxzdu8f+0RFlf4BtHN4FQtNQ1heYyQlm9Cm/9t4e798fslN6CneJCg60cEUuywh5DqZDVgwE3LRBZRkmL8nLLnm3T97tkZU9VNGlHGwIoBVdTNGFsgtFCVkO2oAyoHIgj79JdJlaO21zMec8kGc0Rm9NQxJYaayTCNNzH6LSyYtczHxILI+3EFgQBd9OCWCFro+91fTmQS21yIvojYPaSz3HMq137Wq67Vo5tfrcy9Jt93kVCnytoJZIOuArAbX2bboJFlZ3/qtSaO+YnmNV+avSbqKvDtRksrmhvZW02YtebkhVXJFvKV1EhypxblcmJpW4NiUvvazBBLQW7TmlEEWPCGyGIGK64OLal3CBOkSQS+tzWAG1qBovqn9OAM/W0DRxDa+C2SgCopVz9QyqCaGa4JqKYGtmPufSFTw+qfirJzM+PguMVZ9p6DCqoZpOqWYzJqMRH3/yEUdHR+wdHlH0+zSNGFbjHF07IpudUc6+5Ld/+S1+6eEme31NT03JjSYrSuGeOh0oO1D0oBiC6UCeQ15A0ZlvuWgqonNZH1TZ/FdpATO0bEoDhsZpvMrkPdbRHEJJnhBogc1kGdbaCGyRy44jPSSj6LheGrFvrpGqJGvi1sIVDzVSRhoF69N81K571X8Bta/ivqvSXpVet343UQDUL/7Ct5ZKv1Ua/TIVabO+xDVfEb2pGtw49G88wYtO3kxXR+kC3Xzm9utupVe97kZ6tfJeqq/WyLxGlkivmXNl4mvSDe/b6tRXpTVKWyPLy9MNhd6QfDPJBa942QtorUx/R+nm9/PmMzedXJk4p1vmlpUfyKQiV5yLSTdfd9Vk/03RLWMh/Ay2N0VXy223W5igV67FLYWuTo10wzUvpFe97ka61kortut0w1B9ZVJrlbm6LjfRi8v7u0Iv99w/f/QK9b956P0Xemla7+16Y7Tmrf5/a+Oex8W5ESsAAAAASUVORK5CYII=" alt="Bearo assistant profile">
                </span>

                <div>
                    <strong>Bearo</strong>

                    <span>
                        <i></i>
                        Online
                    </span>
                </div>

            </div>


            <div class="chatbot-header-actions">

                <button
                    type="button"
                    id="chatbotClear"
                    aria-label="Clear Bearo conversation"
                    title="Clear conversation"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M4 7h16"></path>
                        <path d="M9 7V4h6v3"></path>
                        <path d="M7 7l1 13h8l1-13"></path>
                        <path d="M10 11v5M14 11v5"></path>
                    </svg>
                </button>

                <button
                    type="button"
                    id="chatbotMinimize"
                    aria-label="Minimize chatbot"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M5 12h14"></path>
                    </svg>
                </button>

                <button
                    type="button"
                    id="chatbotClose"
                    aria-label="Close chatbot"
                >
                    <svg viewBox="0 0 24 24">
                        <path d="M6 6l12 12M18 6L6 18"></path>
                    </svg>
                </button>

            </div>

        </header>


        <div class="chatbot-body" id="chatbotBody">

            <div class="chatbot-welcome-card">

                <span class="chatbot-welcome-label">
                    BEARO / AI ASSISTANT
                </span>

                <strong>
                    Hi! I’m Bearo. How can I help?
                </strong>

                <p>
                    I can explain ArchiTrack, show its features,
                    guide visitors, and point you to the
                    right section of this page.
                </p>

            </div>


            <div
                class="chatbot-messages"
                id="chatbotMessages"
                aria-live="polite"
            >

                <div class="chat-message bot-message">

                    <span class="chat-message-label">
                        BEARO
                    </span>

                    <div class="chat-bubble">
                        Hi! I’m Bearo 👋 You can ask me anything about ArchiTrack or Vero Designs.
                    </div>

                </div>

            </div>


            <div
                class="bearo-followups"
                id="bearoFollowups"
                aria-live="polite"
            ></div>


            <div class="chatbot-quick-actions">

                <button
                    type="button"
                    class="chatbot-chip"
                    data-chat-question="what is architrack"
                >
                    What is ArchiTrack?
                </button>

                <button
                    type="button"
                    class="chatbot-chip"
                    data-chat-question="how do i access my project"
                >
                    Project access
                </button>

                <button
                    type="button"
                    class="chatbot-chip"
                    data-chat-question="show me the features"
                >
                    View features
                </button>

                <button
                    type="button"
                    class="chatbot-chip"
                    data-chat-question="how is my data protected"
                >
                    Data privacy
                </button>

                <button
                    type="button"
                    class="chatbot-chip"
                    data-chat-question="contact vero designs"
                >
                    Contact Vero
                </button>

            </div>

        </div>


        <form
            class="chatbot-input-bar"
            id="chatbotForm"
        >

            <input
                type="text"
                id="chatbotInput"
                placeholder="Ask Bearo about ArchiTrack..."
                autocomplete="off"
                maxlength="180"
                aria-label="Ask Bearo Assistant"
            >

            <button
                type="submit"
                aria-label="Send message"
            >
                <svg viewBox="0 0 24 24">
                    <path d="M4 12l15-7-4 14-3-5z"></path>
                    <path d="M12 14l7-9"></path>
                </svg>
            </button>

        </form>

    </section>

</div>


<script>

    let sections = document.querySelectorAll('section');
    let navLinks = document.querySelectorAll('.main-nav a[href^="#"]');
    let header = document.querySelector('.main-header');


    function changeNav()
    {
        let current = '';

        sections.forEach(function(section) {

            if (section.id !== '') {

                let top = section.offsetTop;

                if (window.scrollY >= top - 160) {

                    current = section.id;

                }

            }

        });


        navLinks.forEach(function(link) {

            link.classList.remove('active-link');

            if (link.getAttribute('href') === '#' + current) {

                link.classList.add('active-link');

            }

        });
    }


    function changeHeader()
    {
        if (window.scrollY > 25) {

            header.classList.add('header-scroll');

        } else {

            header.classList.remove('header-scroll');

        }
    }


    window.addEventListener('scroll', function() {

        changeNav();

        changeHeader();

    });


    /*
    |--------------------------------------------------------------------------
    | REPEATABLE SCROLL TRANSITIONS
    |--------------------------------------------------------------------------
    |
    | Sections animate when entering from below OR above.
    | The class is removed after leaving the viewport so the
    | animation can play again when the user scrolls back.
    |
    */

    let lastScrollY =
        window.scrollY;

    let scrollDirection =
        'down';


    window.addEventListener(
        'scroll',
        function() {

            scrollDirection =
                window.scrollY
                >=
                lastScrollY
                    ? 'down'
                    : 'up';

            lastScrollY =
                window.scrollY;
        },
        {
            passive: true
        }
    );


    const sectionObserver =
        new IntersectionObserver(
            function(entries) {

                entries.forEach(
                    function(entry) {

                        const section =
                            entry.target;

                        if (
                            entry.isIntersecting
                        ) {

                            section.classList.remove(
                                'enter-from-top',
                                'enter-from-bottom'
                            );

                            section.classList.add(
                                scrollDirection === 'down'
                                    ? 'enter-from-bottom'
                                    : 'enter-from-top'
                            );

                            requestAnimationFrame(
                                function() {

                                    section.classList.add(
                                        'show-section'
                                    );
                                }
                            );

                        } else {

                            section.classList.remove(
                                'show-section'
                            );
                        }
                    }
                );
            },
            {
                threshold: 0.16,
                rootMargin: '-6% 0px -8% 0px'
            }
        );


    sections.forEach(
        function(section) {

            if (
                !section.classList.contains(
                    'hero-section'
                )
            ) {

                sectionObserver.observe(
                    section
                );

            } else {

                section.classList.add(
                    'show-section'
                );
            }
        }
    );


    /*
    |--------------------------------------------------------------------------
    | ARCHITECT SPOTLIGHT SLIDER
    |--------------------------------------------------------------------------
    |
    | AUTO-ADVANCES EVERY 5 SECONDS.
    | Manual navigation resets the 5-second timer.
    | Hovering does NOT pause autoplay.
    |
    */

    const architectSlider =
        document.getElementById(
            'architectSlider'
        );

    if (architectSlider) {

        const architectSlides =
            Array.from(
                architectSlider
                    .querySelectorAll(
                        '[data-architect-slide]'
                    )
            );

        const architectDots =
            Array.from(
                architectSlider
                    .querySelectorAll(
                        '[data-architect-dot]'
                    )
            );

        const architectPrev =
            document.getElementById(
                'architectPrev'
            );

        const architectNext =
            document.getElementById(
                'architectNext'
            );

        const architectProgressFill =
            document.getElementById(
                'architectProgressFill'
            );

        const architectDelay =
            5000;

        let architectIndex =
            0;

        let architectTimer =
            null;


        function restartArchitectProgress()
        {
            if (
                !architectProgressFill
            ) {
                return;
            }

            architectProgressFill
                .classList
                .remove(
                    'run'
                );

            void architectProgressFill
                .offsetWidth;

            architectProgressFill
                .classList
                .add(
                    'run'
                );
        }


        function showArchitectSlide(
            index
        )
        {
            if (
                architectSlides.length
                ===
                0
            ) {
                return;
            }

            architectIndex =
                (
                    index
                    +
                    architectSlides.length
                )
                %
                architectSlides.length;


            architectSlides
                .forEach(
                    function (
                        slide,
                        slideIndex
                    ) {

                        const isActive =
                            slideIndex
                            ===
                            architectIndex;

                        slide
                            .classList
                            .toggle(
                                'active',
                                isActive
                            );

                        slide
                            .setAttribute(
                                'aria-hidden',
                                isActive
                                    ? 'false'
                                    : 'true'
                            );
                    }
                );


            architectDots
                .forEach(
                    function (
                        dot,
                        dotIndex
                    ) {

                        const isActive =
                            dotIndex
                            ===
                            architectIndex;

                        dot
                            .classList
                            .toggle(
                                'active',
                                isActive
                            );

                        dot
                            .setAttribute(
                                'aria-current',
                                isActive
                                    ? 'true'
                                    : 'false'
                            );
                    }
                );


            restartArchitectProgress();
        }


        function stopArchitectTimer()
        {
            if (
                architectTimer
            ) {

                clearTimeout(
                    architectTimer
                );

                architectTimer =
                    null;
            }
        }


        function startArchitectTimer()
        {
            stopArchitectTimer();

            architectTimer =
                setTimeout(
                    function () {

                        showArchitectSlide(
                            architectIndex
                            +
                            1
                        );

                        startArchitectTimer();

                    },
                    architectDelay
                );
        }


        function goToArchitect(
            index
        )
        {
            showArchitectSlide(
                index
            );

            startArchitectTimer();
        }


        architectPrev
            ?.addEventListener(
                'click',
                function () {

                    goToArchitect(
                        architectIndex
                        -
                        1
                    );
                }
            );


        architectNext
            ?.addEventListener(
                'click',
                function () {

                    goToArchitect(
                        architectIndex
                        +
                        1
                    );
                }
            );


        architectDots
            .forEach(
                function (
                    dot
                ) {

                    dot
                        .addEventListener(
                            'click',
                            function () {

                                goToArchitect(
                                    Number(
                                        dot
                                            .dataset
                                            .architectDot
                                    )
                                );
                            }
                        );
                }
            );


        /*
        |--------------------------------------------------------------------------
        | MOBILE SWIPE
        |--------------------------------------------------------------------------
        */

        let architectTouchStartX =
            0;


        architectSlider
            .addEventListener(
                'touchstart',
                function (
                    event
                ) {

                    architectTouchStartX =
                        event
                            .changedTouches[0]
                            .screenX;
                },
                {
                    passive:
                        true
                }
            );


        architectSlider
            .addEventListener(
                'touchend',
                function (
                    event
                ) {

                    const endX =
                        event
                            .changedTouches[0]
                            .screenX;

                    const difference =
                        architectTouchStartX
                        -
                        endX;


                    if (
                        Math.abs(
                            difference
                        )
                        <
                        45
                    ) {
                        return;
                    }


                    if (
                        difference
                        >
                        0
                    ) {

                        goToArchitect(
                            architectIndex
                            +
                            1
                        );

                    } else {

                        goToArchitect(
                            architectIndex
                            -
                            1
                        );
                    }
                },
                {
                    passive:
                        true
                }
            );


        /*
        |--------------------------------------------------------------------------
        | KEYBOARD NAVIGATION
        |--------------------------------------------------------------------------
        */

        document
            .addEventListener(
                'keydown',
                function (
                    event
                ) {

                    if (
                        event.key
                        ===
                        'ArrowLeft'
                    ) {

                        goToArchitect(
                            architectIndex
                            -
                            1
                        );
                    }

                    if (
                        event.key
                        ===
                        'ArrowRight'
                    ) {

                        goToArchitect(
                            architectIndex
                            +
                            1
                        );
                    }
                }
            );


        /*
        |--------------------------------------------------------------------------
        | START SLIDER
        |--------------------------------------------------------------------------
        */

        showArchitectSlide(
            0
        );

        startArchitectTimer();
    }



    /*
    |--------------------------------------------------------------------------
    | INTERACTIVE PRIVACY SHIELD
    |--------------------------------------------------------------------------
    |
    | Auto rotates slowly.
    | Mouse/touch drag controls rotation.
    | Releasing returns to automatic motion.
    |
    */

    const privacyShieldStage =
        document.getElementById(
            'privacyShieldStage'
        );

    const privacyShield =
        document.getElementById(
            'privacyShield'
        );

    const privacyPoints =
        Array.from(
            document.querySelectorAll(
                '[data-privacy-point]'
            )
        );

    const privacyStatusTitle =
        document.getElementById(
            'privacyStatusTitle'
        );

    const privacyStatusText =
        document.getElementById(
            'privacyStatusText'
        );


    if (
        privacyShieldStage
        &&
        privacyShield
    ) {

        let shieldRotateX =
            -7;

        let shieldRotateY =
            0;

        let shieldDragging =
            false;

        let shieldStartX =
            0;

        let shieldStartY =
            0;

        let shieldStartRotateX =
            0;

        let shieldStartRotateY =
            0;

        let shieldFrame =
            null;

        let shieldAutoRotate =
            true;


        function drawShield()
        {
            privacyShield.style.transform =
                'rotateX('
                +
                shieldRotateX
                +
                'deg) rotateY('
                +
                shieldRotateY
                +
                'deg)';

            shieldFrame =
                requestAnimationFrame(
                    function() {

                        if (
                            shieldAutoRotate
                            &&
                            !shieldDragging
                        ) {

                            shieldRotateY +=
                                0.12;
                        }

                        drawShield();
                    }
                );
        }


        function beginShieldDrag(
            clientX,
            clientY
        )
        {
            shieldDragging =
                true;

            shieldAutoRotate =
                false;

            shieldStartX =
                clientX;

            shieldStartY =
                clientY;

            shieldStartRotateX =
                shieldRotateX;

            shieldStartRotateY =
                shieldRotateY;

            privacyShieldStage
                .classList
                .add(
                    'dragging'
                );
        }


        function moveShieldDrag(
            clientX,
            clientY
        )
        {
            if (
                !shieldDragging
            ) {
                return;
            }

            const moveX =
                clientX
                -
                shieldStartX;

            const moveY =
                clientY
                -
                shieldStartY;

            shieldRotateY =
                shieldStartRotateY
                +
                moveX
                *
                0.45;

            shieldRotateX =
                Math.max(
                    -35,
                    Math.min(
                        35,
                        shieldStartRotateX
                        -
                        moveY
                        *
                        0.28
                    )
                );
        }


        function endShieldDrag()
        {
            if (
                !shieldDragging
            ) {
                return;
            }

            shieldDragging =
                false;

            privacyShieldStage
                .classList
                .remove(
                    'dragging'
                );

            setTimeout(
                function() {

                    shieldAutoRotate =
                        true;

                },
                650
            );
        }


        privacyShieldStage
            .addEventListener(
                'mousedown',
                function(event) {

                    beginShieldDrag(
                        event.clientX,
                        event.clientY
                    );
                }
            );


        window.addEventListener(
            'mousemove',
            function(event) {

                moveShieldDrag(
                    event.clientX,
                    event.clientY
                );
            }
        );


        window.addEventListener(
            'mouseup',
            endShieldDrag
        );


        privacyShieldStage
            .addEventListener(
                'touchstart',
                function(event) {

                    const touch =
                        event.touches[0];

                    beginShieldDrag(
                        touch.clientX,
                        touch.clientY
                    );
                },
                {
                    passive: true
                }
            );


        privacyShieldStage
            .addEventListener(
                'touchmove',
                function(event) {

                    const touch =
                        event.touches[0];

                    moveShieldDrag(
                        touch.clientX,
                        touch.clientY
                    );
                },
                {
                    passive: true
                }
            );


        privacyShieldStage
            .addEventListener(
                'touchend',
                endShieldDrag,
                {
                    passive: true
                }
            );


        privacyShieldStage
            .addEventListener(
                'keydown',
                function(event) {

                    if (
                        event.key
                        ===
                        'ArrowLeft'
                    ) {

                        shieldRotateY -=
                            8;
                    }

                    if (
                        event.key
                        ===
                        'ArrowRight'
                    ) {

                        shieldRotateY +=
                            8;
                    }

                    if (
                        event.key
                        ===
                        'ArrowUp'
                    ) {

                        shieldRotateX =
                            Math.max(
                                -35,
                                shieldRotateX
                                -
                                5
                            );
                    }

                    if (
                        event.key
                        ===
                        'ArrowDown'
                    ) {

                        shieldRotateX =
                            Math.min(
                                35,
                                shieldRotateX
                                +
                                5
                            );
                    }
                }
            );


        drawShield();
    }


    const privacyInfo =
        {
            collection: {
                title:
                    'Data Collection',
                text:
                    'Only necessary information is collected for account, project, and communication activities.'
            },

            access: {
                title:
                    'Controlled Access',
                text:
                    "Access depends on the user's role and assigned permissions."
            },

            security: {
                title:
                    'Data Security',
                text:
                    'Authentication, passwords, and role restrictions help protect system information.'
            },

            rights: {
                title:
                    'User Rights',
                text:
                    'Users may request access to or correction of their personal information, where applicable. The DPA recognizes rights such as being informed, accessing personal information, and requesting correction.'
            },

            retention: {
                title:
                    'Data Retention',
                text:
                    'Information is retained only as long as necessary for its intended purpose.'
            },

            handling: {
                title:
                    'Responsible Handling',
                text:
                    'Users and authorized personnel are expected to handle project and client information responsibly.'
            }
        };


    privacyPoints.forEach(
        function(point) {

            point.addEventListener(
                'click',
                function() {

                    privacyPoints
                        .forEach(
                            function(item) {

                                item
                                    .classList
                                    .remove(
                                        'active'
                                    );
                            }
                        );

                    point
                        .classList
                        .add(
                            'active'
                        );

                    const key =
                        point
                            .dataset
                            .privacyPoint;

                    const info =
                        privacyInfo[key];

                    if (
                        !info
                    ) {
                        return;
                    }

                    if (
                        privacyStatusTitle
                    ) {

                        privacyStatusTitle
                            .textContent =
                            info.title;
                    }

                    if (
                        privacyStatusText
                    ) {

                        privacyStatusText
                            .textContent =
                            info.text;
                    }
                }
            );
        }
    );







    /*
    |--------------------------------------------------------------------------
    | FEATURE BANNER CAROUSEL
    |--------------------------------------------------------------------------
    |
    | Compact, drag/swipe-based feature showcase.
    |
    */

    const featureBannerStage =
        document.getElementById(
            'featureBannerStage'
        );

    const featureBannerCards =
        Array.from(
            document.querySelectorAll(
                '.feature-banner-card'
            )
        );

    const featureBannerDots =
        Array.from(
            document.querySelectorAll(
                '.feature-banner-dot'
            )
        );

    const featureBannerCurrent =
        document.getElementById(
            'featureBannerCurrent'
        );

    const featureBannerPrev =
        document.getElementById(
            'featureBannerPrev'
        );

    const featureBannerNext =
        document.getElementById(
            'featureBannerNext'
        );


    let featureBannerIndex =
        0;

    let featureBannerDragging =
        false;

    let featureBannerStartX =
        0;

    let featureBannerDistance =
        0;


    function showFeatureBanner(
        index
    )
    {
        if (
            featureBannerCards.length
            ===
            0
        ) {
            return;
        }

        featureBannerIndex =
            (
                index
                +
                featureBannerCards.length
            )
            %
            featureBannerCards.length;


        featureBannerCards.forEach(
            function(card, cardIndex) {

                card.classList.toggle(
                    'active',
                    cardIndex
                    ===
                    featureBannerIndex
                );
            }
        );


        featureBannerDots.forEach(
            function(dot, dotIndex) {

                dot.classList.toggle(
                    'active',
                    dotIndex
                    ===
                    featureBannerIndex
                );
            }
        );


        if (
            featureBannerCurrent
        ) {

            featureBannerCurrent.textContent =
                String(
                    featureBannerIndex
                    +
                    1
                )
                .padStart(
                    2,
                    '0'
                );
        }
    }


    function nextFeatureBanner()
    {
        showFeatureBanner(
            featureBannerIndex
            +
            1
        );
    }


    function previousFeatureBanner()
    {
        showFeatureBanner(
            featureBannerIndex
            -
            1
        );
    }


    if (
        featureBannerNext
    ) {
        featureBannerNext.addEventListener(
            'click',
            nextFeatureBanner
        );
    }


    if (
        featureBannerPrev
    ) {
        featureBannerPrev.addEventListener(
            'click',
            previousFeatureBanner
        );
    }


    featureBannerDots.forEach(
        function(dot) {

            dot.addEventListener(
                'click',
                function() {

                    showFeatureBanner(
                        Number(
                            dot.dataset.featureDot
                        )
                    );
                }
            );
        }
    );


    function beginFeatureBannerDrag(
        clientX
    )
    {
        featureBannerDragging =
            true;

        featureBannerStartX =
            clientX;

        featureBannerDistance =
            0;

        if (
            featureBannerStage
        ) {

            featureBannerStage
                .classList
                .add(
                    'dragging'
                );
        }
    }


    function moveFeatureBannerDrag(
        clientX
    )
    {
        if (
            !featureBannerDragging
            ||
            !featureBannerStage
        ) {
            return;
        }

        featureBannerDistance =
            clientX
            -
            featureBannerStartX;

        const limited =
            Math.max(
                -90,
                Math.min(
                    90,
                    featureBannerDistance
                )
            );

        featureBannerStage.style.setProperty(
            '--banner-drag-x',
            limited
            +
            'px'
        );
    }


    function endFeatureBannerDrag()
    {
        if (
            !featureBannerDragging
        ) {
            return;
        }

        featureBannerDragging =
            false;

        if (
            featureBannerStage
        ) {

            featureBannerStage
                .classList
                .remove(
                    'dragging'
                );

            featureBannerStage.style.setProperty(
                '--banner-drag-x',
                '0px'
            );
        }


        if (
            Math.abs(
                featureBannerDistance
            )
            <
            48
        ) {
            return;
        }


        if (
            featureBannerDistance
            <
            0
        ) {

            nextFeatureBanner();

        } else {

            previousFeatureBanner();
        }
    }


    if (
        featureBannerStage
    ) {

        featureBannerStage
            .addEventListener(
                'mousedown',
                function(event) {

                    if (
                        event.button
                        !==
                        0
                    ) {
                        return;
                    }

                    beginFeatureBannerDrag(
                        event.clientX
                    );
                }
            );


        window.addEventListener(
            'mousemove',
            function(event) {

                moveFeatureBannerDrag(
                    event.clientX
                );
            }
        );


        window.addEventListener(
            'mouseup',
            endFeatureBannerDrag
        );


        featureBannerStage
            .addEventListener(
                'touchstart',
                function(event) {

                    if (
                        !event.touches[0]
                    ) {
                        return;
                    }

                    beginFeatureBannerDrag(
                        event.touches[0].clientX
                    );
                },
                {
                    passive: true
                }
            );


        featureBannerStage
            .addEventListener(
                'touchmove',
                function(event) {

                    if (
                        !event.touches[0]
                    ) {
                        return;
                    }

                    moveFeatureBannerDrag(
                        event.touches[0].clientX
                    );
                },
                {
                    passive: true
                }
            );


        featureBannerStage
            .addEventListener(
                'touchend',
                endFeatureBannerDrag,
                {
                    passive: true
                }
            );


        featureBannerStage
            .addEventListener(
                'keydown',
                function(event) {

                    if (
                        event.key
                        ===
                        'ArrowLeft'
                    ) {

                        previousFeatureBanner();
                    }

                    if (
                        event.key
                        ===
                        'ArrowRight'
                    ) {

                        nextFeatureBanner();
                    }
                }
            );
    }


    showFeatureBanner(
        0
    );



    /*
    |--------------------------------------------------------------------------
    | BEARO — SMART AI CHATBOT
    |--------------------------------------------------------------------------
    |
    | AI replies come from Laravel/OpenAI.
    | Page actions, follow-ups, greeting, and inactivity reset are handled here.
    |
    */

    const bearoRoot = document.getElementById('landingChatbot');
    const bearoLauncher = document.getElementById('chatbotLauncher');
    const bearoPanel = document.getElementById('chatbotPanel');
    const bearoClose = document.getElementById('chatbotClose');
    const bearoMinimize = document.getElementById('chatbotMinimize');
    const bearoClear = document.getElementById('chatbotClear');
    const bearoForm = document.getElementById('chatbotForm');
    const bearoInput = document.getElementById('chatbotInput');
    const bearoMessages = document.getElementById('chatbotMessages');
    const bearoGreeting = document.getElementById('bearoGreeting');
    const bearoGreetingTitle = document.getElementById('bearoGreetingTitle');
    const bearoGreetingText = document.getElementById('bearoGreetingText');
    const bearoFollowups = document.getElementById('bearoFollowups');

    const bearoQuestions = Array.from(
        document.querySelectorAll('[data-chat-question]')
    );

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');

    let bearoBusy = false;
    let bearoGreetingTimer = null;
    let bearoIdleTimer = null;

    const BEARO_IDLE_MS = 20 * 60 * 1000;


    function getBearoDaypart()
    {
        const hour = new Date().getHours();

        if (hour >= 5 && hour < 12) {
            return 'Good morning';
        }

        if (hour >= 12 && hour < 18) {
            return 'Good afternoon';
        }

        return 'Good evening';
    }


    function updateBearoGreeting()
    {
        const greeting = getBearoDaypart();

        if (bearoGreetingTitle) {
            bearoGreetingTitle.textContent =
                greeting + '! I’m Bearo. 👋';
        }

        if (bearoGreetingText) {
            bearoGreetingText.textContent =
                'Ask me anything about ArchiTrack.';
        }
    }


    function waveBearo()
    {
        if (!bearoRoot) {
            return;
        }

        bearoRoot.classList.remove('bearo-waving');

        void bearoRoot.offsetWidth;

        bearoRoot.classList.add('bearo-waving');

        setTimeout(function () {
            bearoRoot.classList.remove('bearo-waving');
        }, 1700);
    }


    function showBearoGreeting()
    {
        if (
            !bearoGreeting
            ||
            !bearoRoot
            ||
            bearoRoot.classList.contains('chatbot-open')
        ) {
            return;
        }

        updateBearoGreeting();

        bearoGreeting.classList.add('show');
        bearoGreeting.setAttribute('aria-hidden', 'false');

        waveBearo();

        if (bearoGreetingTimer) {
            clearTimeout(bearoGreetingTimer);
        }

        bearoGreetingTimer = setTimeout(function () {
            hideBearoGreeting();
        }, 6500);
    }


    function hideBearoGreeting()
    {
        if (!bearoGreeting) {
            return;
        }

        bearoGreeting.classList.remove('show');
        bearoGreeting.setAttribute('aria-hidden', 'true');
    }


    function openBearo()
    {
        if (!bearoRoot || !bearoPanel) {
            return;
        }

        hideBearoGreeting();

        bearoRoot.classList.add('chatbot-open');
        bearoPanel.setAttribute('aria-hidden', 'false');

        if (bearoLauncher) {
            bearoLauncher.setAttribute('aria-expanded', 'true');
        }

        waveBearo();
        resetBearoIdleTimer();

        setTimeout(function () {
            if (bearoInput) {
                bearoInput.focus();
            }
        }, 280);
    }


    function closeBearo()
    {
        if (!bearoRoot || !bearoPanel) {
            return;
        }

        bearoRoot.classList.remove('chatbot-open');
        bearoPanel.setAttribute('aria-hidden', 'true');

        if (bearoLauncher) {
            bearoLauncher.setAttribute('aria-expanded', 'false');
        }
    }


    function scrollBearoBottom()
    {
        if (!bearoMessages) {
            return;
        }

        bearoMessages.scrollTop = bearoMessages.scrollHeight;
    }


    function addBearoMessage(text, sender)
    {
        if (!bearoMessages) {
            return;
        }

        const message = document.createElement('div');

        message.className =
            'chat-message '
            +
            (
                sender === 'user'
                    ? 'user-message'
                    : 'bot-message'
            );

        const label = document.createElement('span');
        label.className = 'chat-message-label';
        label.textContent = sender === 'user' ? 'YOU' : 'BEARO';

        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble';
        bubble.textContent = text;

        message.appendChild(label);
        message.appendChild(bubble);

        bearoMessages.appendChild(message);

        scrollBearoBottom();
    }


    function addBearoNotice(text)
    {
        if (!bearoMessages) {
            return;
        }

        const notice = document.createElement('div');
        notice.className = 'bearo-system-notice';
        notice.textContent = text;

        bearoMessages.appendChild(notice);

        scrollBearoBottom();
    }


    function showBearoTyping()
    {
        if (!bearoMessages) {
            return null;
        }

        const typing = document.createElement('div');

        typing.className =
            'chat-message bot-message chatbot-typing-message';

        typing.innerHTML =
            '<span class="chat-message-label">BEARO</span>'
            +
            '<div class="chat-bubble chatbot-typing">'
            +
            '<i></i><i></i><i></i>'
            +
            '</div>';

        bearoMessages.appendChild(typing);
        scrollBearoBottom();

        return typing;
    }


    function setBearoBusy(busy)
    {
        bearoBusy = busy;

        if (bearoInput) {
            bearoInput.disabled = busy;
            bearoInput.placeholder =
                busy
                    ? 'Bearo is typing...'
                    : 'Ask Bearo about ArchiTrack...';
        }

        const sendButton =
            bearoForm?.querySelector('button[type="submit"]');

        if (sendButton) {
            sendButton.disabled = busy;
        }
    }


    function normalizeBearoText(text)
    {
        return String(text || '')
            .toLowerCase()
            .replace(/[^a-z0-9\s]/g, ' ')
            .replace(/\s+/g, ' ')
            .trim();
    }


    function getBearoFollowups(question, reply)
    {
        const text = normalizeBearoText(
            question + ' ' + reply
        );

        if (
            text.includes('revision')
            ||
            text.includes('feedback')
        ) {
            return [
                {
                    label: 'Show revision feature',
                    action: 'feature',
                    index: 2
                },
                {
                    label: 'How do clients send revisions?',
                    question: 'How do clients send revision requests?'
                },
                {
                    label: 'What can AI help with?',
                    question: 'How does AI-assisted feedback work?'
                }
            ];
        }

        if (
            text.includes('file')
            ||
            text.includes('version')
        ) {
            return [
                {
                    label: 'Show file management',
                    action: 'feature',
                    index: 1
                },
                {
                    label: 'How does version history work?',
                    question: 'How does file version history work?'
                }
            ];
        }

        if (
            text.includes('meeting')
            ||
            text.includes('schedule')
        ) {
            return [
                {
                    label: 'Show meeting feature',
                    action: 'feature',
                    index: 3
                },
                {
                    label: 'How do clients request meetings?',
                    question: 'How do clients request meetings?'
                }
            ];
        }

        if (
            text.includes('privacy')
            ||
            text.includes('security')
            ||
            text.includes('protected')
        ) {
            return [
                {
                    label: 'View Data Privacy',
                    action: 'section',
                    target: 'privacy'
                },
                {
                    label: 'How does role access work?',
                    question: 'How does role-based access work in ArchiTrack?'
                }
            ];
        }

        if (
            text.includes('access')
            ||
            text.includes('login')
            ||
            text.includes('account')
        ) {
            return [
                {
                    label: 'Go to Log In',
                    action: 'login'
                },
                {
                    label: 'How do clients get invited?',
                    question: 'How do clients get invited to ArchiTrack?'
                }
            ];
        }

        if (
            text.includes('contact')
            ||
            text.includes('vero')
        ) {
            return [
                {
                    label: 'View Contact',
                    action: 'section',
                    target: 'contact'
                }
            ];
        }

        return [
            {
                label: 'Explore Features',
                action: 'section',
                target: 'features'
            },
            {
                label: 'How do I access a project?',
                question: 'How do I access my project?'
            },
            {
                label: 'How is my data protected?',
                question: 'How is my data protected?'
            }
        ];
    }


    function renderBearoFollowups(items)
    {
        if (!bearoFollowups) {
            return;
        }

        bearoFollowups.innerHTML = '';

        items.forEach(function (item) {
            const button = document.createElement('button');

            button.type = 'button';
            button.className = 'bearo-followup-chip';
            button.textContent = item.label;

            button.addEventListener('click', function () {
                if (item.question) {
                    askBearo(item.question);
                    return;
                }

                runBearoAction(item);
            });

            bearoFollowups.appendChild(button);
        });
    }


    function runBearoAction(action)
    {
        if (!action) {
            return;
        }

        if (action.action === 'section') {
            const section =
                document.getElementById(action.target);

            if (section) {
                section.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                closeBearo();
            }

            return;
        }

        if (action.action === 'feature') {
            const section =
                document.getElementById('features');

            if (section) {
                section.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            if (
                typeof showFeatureBanner === 'function'
                &&
                Number.isInteger(action.index)
            ) {
                setTimeout(function () {
                    showFeatureBanner(action.index);
                }, 450);
            }

            closeBearo();

            return;
        }

        if (action.action === 'login') {
            const loginLink =
                document.querySelector('a[href*="login"]');

            if (loginLink && loginLink.href) {
                window.location.href = loginLink.href;
            }
        }
    }


    async function askBearo(question)
    {
        const clean = String(question || '').trim();

        if (clean === '' || bearoBusy) {
            return;
        }

        openBearo();
        resetBearoIdleTimer();

        addBearoMessage(clean, 'user');

        if (bearoFollowups) {
            bearoFollowups.innerHTML = '';
        }

        setBearoBusy(true);

        const typing = showBearoTyping();

        try {
            const response = await fetch(
                '{{ route("bearo.chat") }}',
                {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || ''
                    },

                    body: JSON.stringify({
                        message: clean
                    })
                }
            );

            let data = {};

            try {
                data = await response.json();
            } catch (error) {
                data = {};
            }

            if (typing) {
                typing.remove();
            }

            if (response.status === 429) {
                addBearoMessage(
                    'I’m getting a lot of messages right now 😅 Please wait a moment, then try again.',
                    'bot'
                );

                return;
            }

            if (!response.ok || !data.reply) {
                throw new Error(
                    data.message
                    ||
                    'Bearo could not reply right now.'
                );
            }

            addBearoMessage(
                data.reply,
                'bot'
            );

            renderBearoFollowups(
                getBearoFollowups(
                    clean,
                    data.reply
                )
            );

            waveBearo();

        } catch (error) {
            if (typing && typing.isConnected) {
                typing.remove();
            }

            addBearoMessage(
                'Sorry, I lost the connection for a moment. You can try sending that again.',
                'bot'
            );

            console.error(
                'Bearo chatbot error:',
                error
            );

        } finally {
            setBearoBusy(false);

            if (bearoInput) {
                bearoInput.focus();
            }
        }
    }


    async function clearBearoConversation(showNotice = true)
    {
        if (bearoBusy) {
            return;
        }

        try {
            await fetch(
                '{{ route("bearo.reset") }}',
                {
                    method: 'POST',

                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || ''
                    }
                }
            );
        } catch (error) {
            console.warn(
                'Bearo reset request failed:',
                error
            );
        }

        if (bearoMessages) {
            bearoMessages.innerHTML = '';
        }

        if (bearoFollowups) {
            bearoFollowups.innerHTML = '';
        }

        addBearoMessage(
            getBearoDaypart()
            + '! I’m Bearo 👋 What would you like to know about ArchiTrack?',
            'bot'
        );

        if (showNotice) {
            addBearoNotice(
                'Conversation cleared'
            );
        }

        resetBearoIdleTimer();
    }


    function resetBearoIdleTimer()
    {
        if (bearoIdleTimer) {
            clearTimeout(bearoIdleTimer);
        }

        bearoIdleTimer = setTimeout(
            async function () {

                await clearBearoConversation(
                    false
                );

                addBearoNotice(
                    'Conversation reset after inactivity'
                );

            },
            window.BEARO_ADMIN_IDLE_MS || BEARO_IDLE_MS
        );
    }


    if (bearoLauncher) {
        bearoLauncher.addEventListener(
            'click',
            function (event) {
                event.preventDefault();
                event.stopPropagation();
                openBearo();
            }
        );
    }


    if (bearoGreeting) {
        bearoGreeting.addEventListener(
            'click',
            openBearo
        );
    }


    if (bearoClose) {
        bearoClose.addEventListener(
            'click',
            function (event) {
                event.preventDefault();
                event.stopPropagation();
                closeBearo();
            }
        );
    }


    if (bearoMinimize) {
        bearoMinimize.addEventListener(
            'click',
            function (event) {
                event.preventDefault();
                event.stopPropagation();
                closeBearo();
            }
        );
    }


    if (bearoClear) {
        bearoClear.addEventListener(
            'click',
            function (event) {
                event.preventDefault();
                event.stopPropagation();
                clearBearoConversation(true);
            }
        );
    }


    if (bearoForm) {
        bearoForm.addEventListener(
            'submit',
            function (event) {
                event.preventDefault();

                if (!bearoInput) {
                    return;
                }

                const question = bearoInput.value;
                bearoInput.value = '';

                askBearo(question);
            }
        );
    }


    bearoQuestions.forEach(
        function (button) {
            button.addEventListener(
                'click',
                function (event) {
                    event.preventDefault();

                    askBearo(
                        button.dataset.chatQuestion
                    );
                }
            );
        }
    );



    async function loadBearoPublicSettings()
    {
        try {
            const response = await fetch(
                '{{ route("bearo.settings.public") }}',
                {
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );

            if (!response.ok) {
                return;
            }

            const data = await response.json();

            if (
                data.enabled === false
                &&
                bearoRoot
            ) {
                bearoRoot.style.display = 'none';
                return;
            }

            if (
                data.greeting_title
                &&
                bearoGreetingTitle
            ) {
                bearoGreetingTitle.textContent =
                    getBearoDaypart()
                    +
                    '! '
                    +
                    data.greeting_title
                        .replace(
                            /^(hi|hello|good morning|good afternoon|good evening)[^!?.]*[!?.]?\s*/i,
                            ''
                        );
            }

            if (
                data.greeting_text
                &&
                bearoGreetingText
            ) {
                bearoGreetingText.textContent =
                    data.greeting_text;
            }

            if (
                Number(data.idle_reset_minutes)
                >
                0
            ) {
                window.BEARO_ADMIN_IDLE_MS =
                    Number(
                        data.idle_reset_minutes
                    )
                    *
                    60
                    *
                    1000;
            }

        } catch (error) {
            console.warn(
                'Bearo public settings could not be loaded:',
                error
            );
        }
    }

    window.addEventListener(
        'load',
        async function () {
            await loadBearoPublicSettings();
            updateBearoGreeting();
            resetBearoIdleTimer();

            setTimeout(
                showBearoGreeting,
                1600
            );
        }
    );

</script>





<script>
document.addEventListener('DOMContentLoaded', function () {
    const slides = Array.from(document.querySelectorAll('[data-vero-slide]'));
    const tabs = Array.from(document.querySelectorAll('[data-vero-tab]'));
    const current = document.getElementById('veroStoryCurrent');
    const progress = document.getElementById('veroStoryProgress');
    const shell = document.getElementById('veroStoryShell');

    if (!slides.length || !tabs.length) {
        return;
    }

    let activeIndex = 0;
    let timer = null;
    const interval = 6000;

    function restartProgress() {
        if (!progress) return;

        progress.classList.remove('run');
        void progress.offsetWidth;
        progress.classList.add('run');
    }

    function applySlidePositions(nextIndex, previousIndex) {
        slides.forEach((slide, index) => {
            slide.classList.remove('active', 'is-prev', 'is-next');

            if (index === nextIndex) {
                slide.classList.add('active');
                return;
            }

            /*
             * Keep panels arranged like architectural sheets:
             * previously viewed sheets on the left,
             * upcoming sheets on the right.
             */
            const forwardDistance =
                (index - nextIndex + slides.length) % slides.length;

            if (forwardDistance > 0 && forwardDistance <= slides.length / 2) {
                slide.classList.add('is-next');
            } else {
                slide.classList.add('is-prev');
            }
        });

        /*
         * During wrap-around (04 -> 01), force the old sheet left
         * so the transition still reads as a forward horizontal move.
         */
        if (previousIndex !== nextIndex && slides[previousIndex]) {
            slides[previousIndex].classList.remove('is-next');
            slides[previousIndex].classList.add('is-prev');
        }
    }

    function showSlide(index) {
        const previousIndex = activeIndex;
        const nextIndex = (index + slides.length) % slides.length;

        activeIndex = nextIndex;

        applySlidePositions(nextIndex, previousIndex);

        tabs.forEach((tab, i) => {
            tab.classList.toggle('active', i === activeIndex);
        });

        if (current) {
            current.textContent = String(activeIndex + 1).padStart(2, '0');
        }

        restartProgress();
    }

    function startAuto() {
        clearInterval(timer);

        timer = setInterval(() => {
            showSlide(activeIndex + 1);
        }, interval);
    }

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', function () {
            showSlide(index);
            startAuto();
        });
    });

    /*
     * Pause only while the user is interacting with the section.
     * Once the pointer leaves, automatic next continues.
     */
    shell?.addEventListener('mouseenter', function () {
        clearInterval(timer);
    });

    shell?.addEventListener('mouseleave', function () {
        startAuto();
    });

    slides.forEach((slide, index) => {
        slide.classList.remove('active', 'is-prev', 'is-next');

        if (index === 0) {
            slide.classList.add('active');
        } else {
            slide.classList.add('is-next');
        }
    });

    restartProgress();
    startAuto();
});
</script>

</body>
</html>