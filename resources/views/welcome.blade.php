<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiTienda — Compra lo que importa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0b0b10;
            --surface:   #111118;
            --surface2:  #17171f;
            --surface3:  #1e1e28;
            --border:    rgba(255,255,255,0.06);
            --border-hi: rgba(255,255,255,0.12);
            --accent:    #ff6b35;
            --accent-lo: rgba(255,107,53,0.08);
            --accent-md: rgba(255,107,53,0.20);
            --accent-hi: rgba(255,107,53,0.35);
            --gold:      #f0c040;
            --green:     #3ddc84;
            --text:      #eeeef5;
            --muted:     #7878a0;
            --dim:       #44445c;
            --white:     #ffffff;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ── NOISE OVERLAY ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.6;
        }

        /* ── NAV ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 48px;
            height: 64px;
            background: rgba(11,11,16,0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }

        .nav-logo {
            font-family: 'Sora', sans-serif;
            font-size: 20px; font-weight: 800;
            color: var(--text);
            text-decoration: none;
            letter-spacing: -0.5px;
        }
        .nav-logo span { color: var(--accent); }

        .nav-links {
            display: flex; align-items: center; gap: 32px;
            list-style: none;
        }
        .nav-links a {
            font-size: 13px; font-weight: 500;
            color: var(--muted); text-decoration: none;
            letter-spacing: 0.02em;
            transition: color .15s;
        }
        .nav-links a:hover { color: var(--text); }

        .nav-cta {
            display: flex; gap: 12px; align-items: center;
        }
        .btn-ghost {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500;
            color: var(--muted);
            background: none; border: 1px solid var(--border);
            border-radius: 50px; padding: 8px 20px;
            text-decoration: none; cursor: pointer;
            transition: border-color .15s, color .15s;
        }
        .btn-ghost:hover { border-color: var(--border-hi); color: var(--text); }
        .btn-primary {
            font-family: 'Sora', sans-serif;
            font-size: 13px; font-weight: 700;
            color: #fff;
            background: var(--accent);
            border: none; border-radius: 50px;
            padding: 8px 22px;
            text-decoration: none; cursor: pointer;
            box-shadow: 0 4px 20px var(--accent-hi);
            transition: background .15s, transform .12s, box-shadow .15s;
        }
        .btn-primary:hover {
            background: #ff8055; transform: translateY(-1px);
            box-shadow: 0 6px 28px rgba(255,107,53,.5);
        }

        /* ── HERO ── */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex; align-items: center;
            padding: 120px 48px 80px;
            overflow: hidden;
        }

        /* Big diagonal accent shape */
        .hero::after {
            content: '';
            position: absolute;
            right: -120px; top: -60px;
            width: 700px; height: 700px;
            background: radial-gradient(ellipse at center, rgba(255,107,53,0.12) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .hero-grid-bg {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 80% 60% at 60% 40%, black 30%, transparent 80%);
        }

        .hero-content {
            position: relative; z-index: 1;
            max-width: 680px;
        }

        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 8px;
            font-family: 'DM Mono', monospace;
            font-size: 11px; font-weight: 500;
            color: var(--accent);
            letter-spacing: 2px; text-transform: uppercase;
            margin-bottom: 28px;
            padding: 6px 14px;
            background: var(--accent-lo);
            border: 1px solid var(--accent-md);
            border-radius: 50px;
        }
        .hero-eyebrow::before {
            content: '';
            width: 6px; height: 6px;
            background: var(--accent);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.7); }
        }

        .hero h1 {
            font-family: 'Sora', sans-serif;
            font-size: clamp(42px, 6vw, 72px);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -2px;
            color: var(--text);
            margin-bottom: 24px;
        }
        .hero h1 em {
            font-style: normal;
            color: var(--accent);
            position: relative;
        }
        .hero h1 em::after {
            content: '';
            position: absolute;
            bottom: 4px; left: 0; right: 0;
            height: 3px;
            background: var(--accent);
            opacity: 0.4;
            border-radius: 2px;
        }

        .hero-sub {
            font-size: 17px; font-weight: 300;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 40px;
            max-width: 480px;
        }

        .hero-actions {
            display: flex; gap: 14px; flex-wrap: wrap;
            align-items: center; margin-bottom: 64px;
        }
        .btn-hero {
            font-family: 'Sora', sans-serif;
            font-size: 14px; font-weight: 700;
            color: #fff; background: var(--accent);
            border: none; border-radius: 50px;
            padding: 14px 32px;
            text-decoration: none; cursor: pointer;
            box-shadow: 0 8px 32px var(--accent-hi);
            transition: background .15s, transform .12s, box-shadow .15s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-hero:hover {
            background: #ff8055; transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(255,107,53,.55);
        }
        .btn-hero-ghost {
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 500;
            color: var(--muted);
            background: none;
            border: 1px solid var(--border-hi);
            border-radius: 50px;
            padding: 14px 32px;
            text-decoration: none; cursor: pointer;
            transition: border-color .15s, color .15s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-hero-ghost:hover { border-color: rgba(255,255,255,0.3); color: var(--text); }

        .hero-stats {
            display: flex; gap: 40px; flex-wrap: wrap;
        }
        .stat {
            border-left: 2px solid var(--accent-md);
            padding-left: 16px;
        }
        .stat-num {
            font-family: 'Sora', sans-serif;
            font-size: 28px; font-weight: 800;
            color: var(--text); line-height: 1;
            margin-bottom: 4px;
        }
        .stat-num span { color: var(--accent); }
        .stat-label { font-size: 12px; color: var(--muted); font-weight: 400; }

        /* Hero right: floating product cards */
        .hero-visual {
            position: absolute;
            right: 48px; top: 50%;
            transform: translateY(-50%);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            width: 420px;
            z-index: 1;
        }

        .hero-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            transition: transform .3s, border-color .3s;
            animation: float 6s ease-in-out infinite;
        }
        .hero-card:nth-child(2) { animation-delay: -2s; margin-top: 28px; }
        .hero-card:nth-child(3) { animation-delay: -4s; }
        .hero-card:nth-child(4) { animation-delay: -1s; margin-top: 28px; }
        .hero-card:hover { transform: translateY(-4px); border-color: var(--border-hi); }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        .hero-card:nth-child(2):hover,
        .hero-card:nth-child(4):hover { transform: translateY(calc(28px - 4px)); }

        .card-emoji { font-size: 32px; margin-bottom: 12px; }
        .card-name {
            font-family: 'Sora', sans-serif;
            font-size: 12px; font-weight: 600;
            color: var(--text); margin-bottom: 6px;
            line-height: 1.3;
        }
        .card-price {
            font-family: 'DM Mono', monospace;
            font-size: 14px; color: var(--accent);
            font-weight: 500;
        }
        .card-badge {
            display: inline-block;
            font-size: 9px; font-weight: 700;
            font-family: 'DM Mono', monospace;
            letter-spacing: 0.5px; text-transform: uppercase;
            color: var(--green);
            background: rgba(61,220,132,0.1);
            border: 1px solid rgba(61,220,132,0.25);
            border-radius: 50px; padding: 2px 8px;
            margin-bottom: 10px;
        }

        /* ── PROMO STRIP ── */
        .promo-strip {
            background: var(--accent);
            padding: 14px 48px;
            display: flex; align-items: center; justify-content: center; gap: 16px;
            position: relative; z-index: 1;
            overflow: hidden;
        }
        .promo-strip::before {
            content: '';
            position: absolute; inset: 0;
            background: repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 20px,
                rgba(255,255,255,0.04) 20px,
                rgba(255,255,255,0.04) 40px
            );
        }
        .promo-strip-text {
            font-family: 'Sora', sans-serif;
            font-size: 14px; font-weight: 700;
            color: #fff; position: relative;
            letter-spacing: -0.2px;
        }
        .promo-strip-badge {
            font-family: 'DM Mono', monospace;
            font-size: 10px; font-weight: 500;
            background: rgba(0,0,0,0.25);
            color: #fff;
            padding: 4px 12px; border-radius: 50px;
            letter-spacing: 1px; text-transform: uppercase;
            position: relative;
        }
        .promo-strip a {
            font-family: 'Sora', sans-serif;
            font-size: 12px; font-weight: 700;
            color: var(--accent);
            background: #fff;
            padding: 6px 18px; border-radius: 50px;
            text-decoration: none; position: relative;
            transition: background .15s;
        }
        .promo-strip a:hover { background: #f5f5f5; }

        /* ── SECTION COMMONS ── */
        section { position: relative; z-index: 1; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 48px; }
        .section-pad { padding: 96px 0; }

        .section-label {
            font-family: 'DM Mono', monospace;
            font-size: 11px; font-weight: 500;
            color: var(--accent); letter-spacing: 2px;
            text-transform: uppercase; margin-bottom: 12px;
        }
        .section-title {
            font-family: 'Sora', sans-serif;
            font-size: clamp(28px, 3vw, 40px);
            font-weight: 800; letter-spacing: -1px;
            color: var(--text); line-height: 1.1;
            margin-bottom: 16px;
        }
        .section-sub {
            font-size: 15px; color: var(--muted);
            max-width: 480px; line-height: 1.7;
        }

        /* ── CATEGORIES ── */
        .categories-section { background: var(--surface); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }

        .cats-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            margin-top: 48px;
        }
        .cat-item {
            background: var(--surface);
            padding: 28px 20px;
            text-align: center;
            cursor: pointer;
            transition: background .15s;
            text-decoration: none;
            display: flex; flex-direction: column;
            align-items: center; gap: 12px;
        }
        .cat-item:hover { background: var(--surface2); }
        .cat-icon {
            width: 52px; height: 52px;
            background: var(--surface2);
            border: 1px solid var(--border-hi);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            transition: background .15s, border-color .15s;
        }
        .cat-item:hover .cat-icon {
            background: var(--accent-lo);
            border-color: var(--accent-md);
        }
        .cat-name {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500;
            color: var(--muted);
            transition: color .15s;
        }
        .cat-item:hover .cat-name { color: var(--text); }
        .cat-count {
            font-family: 'DM Mono', monospace;
            font-size: 10px; color: var(--dim);
        }

        /* ── FEATURED PRODUCTS ── */
        .products-header {
            display: flex; align-items: flex-end;
            justify-content: space-between; margin-bottom: 40px;
            flex-wrap: wrap; gap: 16px;
        }
        .view-all {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500;
            color: var(--accent); text-decoration: none;
            display: flex; align-items: center; gap: 6px;
            transition: gap .15s;
        }
        .view-all:hover { gap: 10px; }

        .prod-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }

        .prod-card {
            background: var(--surface);
            padding: 24px 20px 20px;
            display: flex; flex-direction: column;
            cursor: pointer;
            transition: background .15s;
            position: relative;
        }
        .prod-card:hover { background: var(--surface2); }

        .prod-badge {
            position: absolute; top: 0; left: 0;
            font-family: 'DM Mono', monospace;
            font-size: 9px; font-weight: 500;
            padding: 4px 10px;
            letter-spacing: 0.5px; text-transform: uppercase;
        }
        .badge-sale { background: var(--accent); color: #fff; }
        .badge-new { background: var(--green); color: #0d1a10; }
        .badge-hot { background: var(--gold); color: #1a1200; }

        .prod-img {
            width: 100%; padding-top: 85%;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 48px; margin-bottom: 16px;
            position: relative; overflow: hidden;
        }
        .prod-img-inner {
            position: absolute; inset: 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 52px;
        }

        .prod-cat {
            font-family: 'DM Mono', monospace;
            font-size: 10px; color: var(--dim);
            text-transform: uppercase; letter-spacing: 1px;
            margin-bottom: 6px;
        }
        .prod-name {
            font-family: 'Sora', sans-serif;
            font-size: 13px; font-weight: 600;
            color: var(--text); line-height: 1.4;
            margin-bottom: 10px; flex: 1;
        }
        .prod-stars {
            font-size: 11px; color: var(--gold);
            margin-bottom: 10px; letter-spacing: 1px;
        }
        .prod-stars span { color: var(--dim); font-size: 11px; margin-left: 4px; }
        .prod-price-row {
            display: flex; align-items: baseline; gap: 8px;
            margin-bottom: 14px;
        }
        .prod-price {
            font-family: 'Sora', sans-serif;
            font-size: 20px; font-weight: 800;
            color: var(--text);
        }
        .prod-price sup { font-size: 12px; font-weight: 400; vertical-align: super; }
        .prod-old {
            font-family: 'DM Mono', monospace;
            font-size: 12px; color: var(--dim);
            text-decoration: line-through;
        }
        .prod-discount {
            font-family: 'DM Mono', monospace;
            font-size: 10px; color: var(--accent);
            font-weight: 500;
        }
        .btn-add {
            width: 100%; padding: 10px;
            background: var(--surface3);
            border: 1px solid var(--border-hi);
            color: var(--muted);
            font-family: 'DM Sans', sans-serif;
            font-size: 12px; font-weight: 500;
            border-radius: 8px; cursor: pointer;
            transition: background .15s, border-color .15s, color .15s;
        }
        .btn-add:hover {
            background: var(--accent-lo);
            border-color: var(--accent-md);
            color: var(--accent);
        }

        /* ── VALUE PROPS ── */
        .value-section {
            background: var(--surface);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }
        .value-grid {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 1px; background: var(--border);
            border: 1px solid var(--border); border-radius: 12px;
            overflow: hidden;
        }
        .value-item {
            background: var(--surface);
            padding: 36px 28px;
            transition: background .15s;
        }
        .value-item:hover { background: var(--surface2); }
        .value-icon {
            font-size: 28px; margin-bottom: 14px;
        }
        .value-title {
            font-family: 'Sora', sans-serif;
            font-size: 15px; font-weight: 700;
            color: var(--text); margin-bottom: 8px;
        }
        .value-desc { font-size: 13px; color: var(--muted); line-height: 1.6; }

        /* ── BIG CTA BANNER ── */
        .cta-section {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 16px;
            margin: 0 48px;
            padding: 72px 64px;
            display: grid; grid-template-columns: 1fr auto;
            align-items: center; gap: 40px;
            position: relative; overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute; right: -80px; top: -80px;
            width: 400px; height: 400px;
            background: radial-gradient(ellipse, rgba(255,107,53,0.15) 0%, transparent 65%);
            border-radius: 50%;
        }
        .cta-section::after {
            content: '';
            position: absolute; left: -40px; bottom: -40px;
            width: 240px; height: 240px;
            background: radial-gradient(ellipse, rgba(240,192,64,0.08) 0%, transparent 65%);
            border-radius: 50%;
        }
        .cta-label {
            font-family: 'DM Mono', monospace;
            font-size: 11px; color: var(--accent);
            letter-spacing: 2px; text-transform: uppercase;
            margin-bottom: 14px;
        }
        .cta-title {
            font-family: 'Sora', sans-serif;
            font-size: clamp(26px, 3vw, 42px);
            font-weight: 800; letter-spacing: -1px;
            color: var(--text); line-height: 1.1;
            margin-bottom: 14px;
            position: relative; z-index: 1;
        }
        .cta-sub { font-size: 15px; color: var(--muted); position: relative; z-index: 1; }
        .cta-actions { display: flex; flex-direction: column; gap: 10px; position: relative; z-index: 1; flex-shrink: 0; }

        /* ── TRUST STRIP ── */
        .trust-strip {
            border-top: 1px solid var(--border);
            padding: 28px 48px;
            display: flex; align-items: center; justify-content: center; gap: 48px;
            flex-wrap: wrap;
        }
        .trust-item {
            display: flex; align-items: center; gap: 10px;
            font-size: 13px; color: var(--muted);
        }
        .trust-item strong { color: var(--text); }
        .trust-icon { font-size: 16px; }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--border);
            padding: 48px;
            display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
        }
        .footer-brand .nav-logo { display: block; margin-bottom: 14px; font-size: 22px; }
        .footer-desc { font-size: 13px; color: var(--muted); line-height: 1.7; max-width: 260px; }
        .footer-col h4 {
            font-family: 'Sora', sans-serif;
            font-size: 12px; font-weight: 700;
            color: var(--text); letter-spacing: 0.5px;
            text-transform: uppercase; margin-bottom: 16px;
        }
        .footer-col ul { list-style: none; }
        .footer-col li { margin-bottom: 10px; }
        .footer-col a {
            font-size: 13px; color: var(--muted);
            text-decoration: none; transition: color .15s;
        }
        .footer-col a:hover { color: var(--text); }
        .footer-bottom {
            border-top: 1px solid var(--border);
            padding: 20px 48px;
            display: flex; align-items: center; justify-content: space-between;
            font-size: 12px; color: var(--dim);
        }

        /* ── TICKER ── */
        .ticker-wrap {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            overflow: hidden; padding: 10px 0;
            background: var(--surface);
        }
        .ticker {
            display: flex; gap: 48px;
            animation: ticker 30s linear infinite;
            white-space: nowrap;
        }
        @keyframes ticker {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        .ticker-item {
            font-family: 'DM Mono', monospace;
            font-size: 11px; color: var(--dim);
            letter-spacing: 1px; text-transform: uppercase;
            display: flex; align-items: center; gap: 12px;
        }
        .ticker-item::after {
            content: '✦';
            color: var(--accent); font-size: 8px;
        }

        /* ── ANIMATIONS ── */
        .fade-up {
            opacity: 0; transform: translateY(24px);
            transition: opacity .7s ease, transform .7s ease;
        }
        .fade-up.visible { opacity: 1; transform: translateY(0); }

        /* ── RESPONSIVE ── */
        @media (max-width: 1100px) {
            .hero-visual { display: none; }
            .prod-grid { grid-template-columns: repeat(2, 1fr); }
            .cats-grid { grid-template-columns: repeat(3, 1fr); }
            .value-grid { grid-template-columns: repeat(2, 1fr); }
            footer { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            nav { padding: 0 24px; }
            .nav-links { display: none; }
            .hero { padding: 100px 24px 60px; }
            .container { padding: 0 24px; }
            .cta-section { margin: 0 24px; padding: 40px 32px; grid-template-columns: 1fr; }
            footer { padding: 40px 24px; grid-template-columns: 1fr; }
            .footer-bottom { padding: 16px 24px; flex-direction: column; gap: 8px; text-align: center; }
            .trust-strip { padding: 20px 24px; gap: 24px; }
        }
        @media (max-width: 520px) {
            .prod-grid { grid-template-columns: 1fr; }
            .cats-grid { grid-template-columns: repeat(2, 1fr); }
            .value-grid { grid-template-columns: 1fr; }
            .hero h1 { letter-spacing: -1px; }
        }
    </style>
</head>
<body>

    <!-- NAV -->
    <nav>
        <a href="/" class="nav-logo">Mi<span>Tienda</span></a>
        <ul class="nav-links">
            <li><a href="/product">Productos</a></li>
            <li><a href="#">Categorías</a></li>
            <li><a href="#">Ofertas</a></li>
            <li><a href="#">Nosotros</a></li>
        </ul>
        <div class="nav-cta">
            <a href="#" class="btn-ghost">Iniciar sesión</a>
            <a href="/product/create" class="btn-primary">Vender</a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="hero-grid-bg"></div>
        <div class="hero-content">
            <div class="hero-eyebrow">Semana de Ofertas activa</div>
            <h1>Compra lo que<br><em>realmente</em><br>importa.</h1>
            <p class="hero-sub">Miles de productos en un solo lugar. Envío gratis a Bucaramanga, pagos seguros y vendedores verificados.</p>
            <div class="hero-actions">
                <a href="/product" class="btn-hero">
                    Explorar productos
                    <span>→</span>
                </a>
                <a href="/product/create" class="btn-hero-ghost">
                    Empezar a vender
                    <span>↗</span>
                </a>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <div class="stat-num">12<span>K+</span></div>
                    <div class="stat-label">Productos activos</div>
                </div>
                <div class="stat">
                    <div class="stat-num">3<span>.4K</span></div>
                    <div class="stat-label">Vendedores verificados</div>
                </div>
                <div class="stat">
                    <div class="stat-num">98<span>%</span></div>
                    <div class="stat-label">Clientes satisfechos</div>
                </div>
            </div>
        </div>

        <!-- Floating cards -->
        <div class="hero-visual">
            <div class="hero-card">
                <div class="card-badge">Nuevo</div>
                <div class="card-emoji">💻</div>
                <div class="card-name">Laptop UltraBook Pro 15"</div>
                <div class="card-price">$2,450.000</div>
            </div>
            <div class="hero-card">
                <div class="card-badge">−30%</div>
                <div class="card-emoji">📱</div>
                <div class="card-name">Smartphone Galaxy X12</div>
                <div class="card-price">$890.000</div>
            </div>
            <div class="hero-card">
                <div class="card-badge">Oferta</div>
                <div class="card-emoji">🎧</div>
                <div class="card-name">Audífonos Noise Pro</div>
                <div class="card-price">$340.000</div>
            </div>
            <div class="hero-card">
                <div class="card-badge">Popular</div>
                <div class="card-emoji">⌚</div>
                <div class="card-name">Smartwatch Series 8</div>
                <div class="card-price">$580.000</div>
            </div>
        </div>
    </section>

    <!-- TICKER -->
    <div class="ticker-wrap">
        <div class="ticker">
            <span class="ticker-item">Envío gratis a Bucaramanga</span>
            <span class="ticker-item">Pagos 100% seguros</span>
            <span class="ticker-item">Semana de Ofertas hasta 60% OFF</span>
            <span class="ticker-item">Vendedores verificados</span>
            <span class="ticker-item">Devoluciones sin preguntas</span>
            <span class="ticker-item">Soporte 24/7</span>
            <span class="ticker-item">Envío gratis a Bucaramanga</span>
            <span class="ticker-item">Pagos 100% seguros</span>
            <span class="ticker-item">Semana de Ofertas hasta 60% OFF</span>
            <span class="ticker-item">Vendedores verificados</span>
            <span class="ticker-item">Devoluciones sin preguntas</span>
            <span class="ticker-item">Soporte 24/7</span>
        </div>
    </div>

    <!-- PROMO STRIP -->
    <div class="promo-strip">
        <span class="promo-strip-badge">Semana de Ofertas</span>
        <span class="promo-strip-text">Hasta 60% de descuento en miles de productos seleccionados.</span>
        <a href="/product">Ver Ofertas →</a>
    </div>

    <!-- CATEGORIES -->
    <section class="categories-section section-pad">
        <div class="container">
            <div class="fade-up">
                <div class="section-label">Explorar</div>
                <div class="section-title">Todas las categorías</div>
                <p class="section-sub">Encuentra exactamente lo que buscas entre nuestras categorías cuidadosamente organizadas.</p>
            </div>
            <div class="cats-grid fade-up">
                <a href="/product?cat=electronica" class="cat-item">
                    <div class="cat-icon">💻</div>
                    <div class="cat-name">Electrónica</div>
                    <div class="cat-count">412 productos</div>
                </a>
                <a href="/product?cat=ropa" class="cat-item">
                    <div class="cat-icon">👕</div>
                    <div class="cat-name">Ropa</div>
                    <div class="cat-count">318 productos</div>
                </a>
                <a href="/product?cat=hogar" class="cat-item">
                    <div class="cat-icon">🏠</div>
                    <div class="cat-name">Hogar</div>
                    <div class="cat-count">204 productos</div>
                </a>
                <a href="/product?cat=deportes" class="cat-item">
                    <div class="cat-icon">⚽</div>
                    <div class="cat-name">Deportes</div>
                    <div class="cat-count">140 productos</div>
                </a>
                <a href="/product?cat=libros" class="cat-item">
                    <div class="cat-icon">📚</div>
                    <div class="cat-name">Libros</div>
                    <div class="cat-count">96 productos</div>
                </a>
                <a href="/product?cat=juguetes" class="cat-item">
                    <div class="cat-icon">🧸</div>
                    <div class="cat-name">Juguetes</div>
                    <div class="cat-count">78 productos</div>
                </a>
            </div>
        </div>
    </section>

    <!-- FEATURED PRODUCTS -->
    <section class="section-pad">
        <div class="container">
            <div class="products-header fade-up">
                <div>
                    <div class="section-label">Destacados</div>
                    <div class="section-title">Más vendidos</div>
                </div>
                <a href="/product" class="view-all">Ver todos los productos <span>→</span></a>
            </div>
            <div class="prod-grid fade-up">
                <div class="prod-card">
                    <div class="prod-badge badge-sale">−25%</div>
                    <div class="prod-img"><div class="prod-img-inner">💻</div></div>
                    <div class="prod-cat">Electrónica</div>
                    <div class="prod-name">Laptop UltraBook Pro 15" Intel i7 16GB RAM</div>
                    <div class="prod-stars">★★★★★ <span>(248)</span></div>
                    <div class="prod-price-row">
                        <div class="prod-price"><sup>$</sup>2,450.000</div>
                        <div class="prod-old">$3,200.000</div>
                    </div>
                    <div class="prod-discount">Ahorras $750.000</div>
                    <button class="btn-add" style="margin-top:14px">Añadir al carrito</button>
                </div>
                <div class="prod-card">
                    <div class="prod-badge badge-new">Nuevo</div>
                    <div class="prod-img"><div class="prod-img-inner">📱</div></div>
                    <div class="prod-cat">Electrónica</div>
                    <div class="prod-name">Smartphone Galaxy X12 Ultra 256GB</div>
                    <div class="prod-stars">★★★★☆ <span>(134)</span></div>
                    <div class="prod-price-row">
                        <div class="prod-price"><sup>$</sup>890.000</div>
                    </div>
                    <button class="btn-add" style="margin-top:28px">Añadir al carrito</button>
                </div>
                <div class="prod-card">
                    <div class="prod-badge badge-hot">Popular</div>
                    <div class="prod-img"><div class="prod-img-inner">🎧</div></div>
                    <div class="prod-cat">Tecnología</div>
                    <div class="prod-name">Audífonos Noise Pro Cancelación de Ruido</div>
                    <div class="prod-stars">★★★★★ <span>(89)</span></div>
                    <div class="prod-price-row">
                        <div class="prod-price"><sup>$</sup>340.000</div>
                        <div class="prod-old">$420.000</div>
                    </div>
                    <div class="prod-discount">−19%</div>
                    <button class="btn-add" style="margin-top:14px">Añadir al carrito</button>
                </div>
                <div class="prod-card">
                    <div class="prod-img" style="margin-top:0"><div class="prod-img-inner">⌚</div></div>
                    <div class="prod-cat">Accesorios</div>
                    <div class="prod-name">Smartwatch Series 8 GPS + Cellular 45mm</div>
                    <div class="prod-stars">★★★★☆ <span>(212)</span></div>
                    <div class="prod-price-row">
                        <div class="prod-price"><sup>$</sup>580.000</div>
                    </div>
                    <button class="btn-add" style="margin-top:28px">Añadir al carrito</button>
                </div>
            </div>
        </div>
    </section>

    <!-- VALUE PROPS -->
    <section class="value-section section-pad">
        <div class="container">
            <div class="fade-up" style="text-align:center; margin-bottom:48px;">
                <div class="section-label" style="justify-content:center; display:flex;">¿Por qué MiTienda?</div>
                <div class="section-title">Todo lo que necesitas, aquí.</div>
            </div>
            <div class="value-grid fade-up">
                <div class="value-item">
                    <div class="value-icon">🚀</div>
                    <div class="value-title">Envío Express Gratis</div>
                    <div class="value-desc">Envío gratuito a toda Bucaramanga. Recibe tu pedido en menos de 48 horas sin costo adicional.</div>
                </div>
                <div class="value-item">
                    <div class="value-icon">🔒</div>
                    <div class="value-title">Pagos 100% Seguros</div>
                    <div class="value-desc">Tus datos siempre protegidos. Aceptamos todas las tarjetas, PSE y pagos en efectivo.</div>
                </div>
                <div class="value-item">
                    <div class="value-icon">↩️</div>
                    <div class="value-title">Devoluciones Fáciles</div>
                    <div class="value-desc">¿No te gustó? Devuelve tu compra sin preguntas dentro de los 30 días siguientes.</div>
                </div>
                <div class="value-item">
                    <div class="value-icon">✅</div>
                    <div class="value-title">Vendedores Verificados</div>
                    <div class="value-desc">Todos los vendedores pasan por un proceso de verificación. Compra con total confianza.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA BANNER -->
    <section class="section-pad">
        <div class="cta-section fade-up">
            <div>
                <div class="cta-label">Únete hoy</div>
                <div class="cta-title">¿Tienes algo para vender?</div>
                <p class="cta-sub">Crea tu tienda en minutos, sube tus productos y empieza a generar ingresos desde hoy. Sin comisiones el primer mes.</p>
            </div>
            <div class="cta-actions">
                <a href="/product/create" class="btn-hero" style="text-align:center; justify-content:center;">
                    Publicar mi primer producto
                </a>
                <a href="/product" class="btn-hero-ghost" style="text-align:center; justify-content:center;">
                    Ver cómo funciona
                </a>
            </div>
        </div>
    </section>

    <!-- TRUST STRIP -->
    <div class="trust-strip fade-up">
        <div class="trust-item">
            <span class="trust-icon">🏆</span>
            <span><strong>+5 años</strong> en el mercado</span>
        </div>
        <div class="trust-item">
            <span class="trust-icon">👥</span>
            <span><strong>+50,000</strong> compradores activos</span>
        </div>
        <div class="trust-item">
            <span class="trust-icon">📦</span>
            <span><strong>+200,000</strong> pedidos entregados</span>
        </div>
        <div class="trust-item">
            <span class="trust-icon">⭐</span>
            <span>Calificación <strong>4.8/5.0</strong></span>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-brand">
            <a href="/" class="nav-logo">Mi<span>Tienda</span></a>
            <p class="footer-desc">La plataforma de comercio electrónico más confiable de Bucaramanga. Conectamos compradores y vendedores de forma segura.</p>
        </div>
        <div class="footer-col">
            <h4>Tienda</h4>
            <ul>
                <li><a href="/product">Todos los productos</a></li>
                <li><a href="#">Ofertas del día</a></li>
                <li><a href="#">Más vendidos</a></li>
                <li><a href="#">Nuevos ingresos</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Vender</h4>
            <ul>
                <li><a href="/product/create">Publicar producto</a></li>
                <li><a href="#">Guía del vendedor</a></li>
                <li><a href="#">Comisiones</a></li>
                <li><a href="#">Estadísticas</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Ayuda</h4>
            <ul>
                <li><a href="#">Centro de ayuda</a></li>
                <li><a href="#">Envíos y entregas</a></li>
                <li><a href="#">Devoluciones</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </div>
    </footer>
    <div class="footer-bottom">
        <span>© 2025 MiTienda. Todos los derechos reservados.</span>
        <span>Hecho con ♥ en Bucaramanga, Colombia</span>
    </div>

    <script>
        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    </script>
</body>
</html>