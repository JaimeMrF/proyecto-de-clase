<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — MiTienda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=JetBrains+Mono:wght@400;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0a0a0a;
            --surface:   #111111;
            --surface2:  #1a1a1a;
            --border:    #2a2a2a;
            --border2:   #333333;
            --accent:    #ff6b35;
            --accent2:   #ff8c5a;
            --gold:      #f0c040;
            --green:     #3ddc84;
            --red:       #ff4d4d;
            --text:      #e8e8e8;
            --text-muted:#888888;
            --text-faint:#444444;
            --font-display: 'Bebas Neue', sans-serif;
            --font-mono:    'JetBrains Mono', monospace;
            --font-sans:    'DM Sans', sans-serif;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: var(--font-sans);
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .admin-sidebar {
            width: 220px;
            flex-shrink: 0;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
        }

        .sidebar-logo {
            padding: 28px 24px 24px;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-logo-text {
            font-family: var(--font-display);
            font-size: 28px;
            letter-spacing: 0.05em;
            color: var(--text);
            line-height: 1;
        }
        .sidebar-logo-text span { color: var(--accent); }
        .sidebar-logo-sub {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--text-faint);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .nav-section-label {
            font-family: var(--font-mono);
            font-size: 9px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text-faint);
            padding: 0 24px;
            margin-bottom: 8px;
            margin-top: 20px;
        }
        .nav-section-label:first-child { margin-top: 0; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 24px;
            font-size: 13.5px;
            font-weight: 400;
            color: var(--text-muted);
            text-decoration: none;
            border-left: 2px solid transparent;
            transition: all .12s;
        }
        .nav-link:hover {
            color: var(--text);
            background: var(--surface2);
            border-left-color: var(--border2);
        }
        .nav-link.active {
            color: var(--accent);
            background: rgba(255,107,53,.07);
            border-left-color: var(--accent);
            font-weight: 500;
        }
        .nav-link-icon {
            font-size: 15px;
            width: 18px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid var(--border);
        }
        .sidebar-footer-text {
            font-family: var(--font-mono);
            font-size: 10px;
            color: var(--text-faint);
        }
        .sidebar-footer-text span {
            color: var(--accent);
        }

        /* ── Main ── */
        .admin-main {
            margin-left: 220px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        .admin-topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 32px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-title {
            font-family: var(--font-mono);
            font-size: 12px;
            color: var(--text-muted);
            letter-spacing: 0.08em;
        }
        .topbar-title strong {
            color: var(--text);
            font-weight: 600;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-btn {
            background: var(--accent);
            color: white;
            text-decoration: none;
            padding: 7px 16px;
            font-size: 12px;
            font-weight: 600;
            font-family: var(--font-sans);
            letter-spacing: 0.02em;
            transition: background .12s;
        }
        .topbar-btn:hover { background: var(--accent2); }

        .topbar-dot {
            width: 8px; height: 8px;
            background: var(--green);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--green);
        }
        .topbar-status {
            font-family: var(--font-mono);
            font-size: 11px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 7px;
        }

        /* ── Content ── */
        .admin-content {
            flex: 1;
            padding: 32px;
        }

        @yield('admin-styles')
    </style>
    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<aside class="admin-sidebar">
    <div class="sidebar-logo">
        <div class="sidebar-logo-text">Mi<span>Tienda</span></div>
        <div class="sidebar-logo-sub">Panel de control</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">General</div>
        <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
            <span class="nav-link-icon">◈</span> Dashboard
        </a>

        <div class="nav-section-label">Catálogo</div>
        <a href="{{ route('product.index') }}" class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
            <span class="nav-link-icon">▦</span> Productos
        </a>
        <a href="{{ route('product.create') }}" class="nav-link">
            <span class="nav-link-icon">＋</span> Agregar producto
        </a>

        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <span class="nav-link-icon">◈</span> Categorías
        </a>
        <div class="nav-section-label">Sistema</div>
        <a href="/" class="nav-link">
            <span class="nav-link-icon">↗</span> Ver tienda
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-footer-text">
            v1.0.0 · <span>Laravel 12</span>
        </div>
    </div>
</aside>

{{-- Main --}}
<div class="admin-main">
    <header class="admin-topbar">
        <div class="topbar-title">
            <strong>@yield('page-title', 'Dashboard')</strong>
        </div>
        <div class="topbar-actions">
            <div class="topbar-status">
                <span class="topbar-dot"></span> Sistema activo
            </div>
            <a href="{{ route('product.create') }}" class="topbar-btn">+ Nuevo producto</a>
        </div>
    </header>

    <main class="admin-content">
        @yield('content')
    </main>
</div>

</body>
</html>