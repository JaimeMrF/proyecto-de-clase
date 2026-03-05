<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MiTienda') — Todo lo que necesitas</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0a0a0f;
            --surface: #111118;
            --surface2: #18181f;
            --surface3: #1e1e28;
            --border: rgba(255,255,255,0.07);
            --border-hover: rgba(255,255,255,0.15);
            --accent: #ff6b35;
            --accent-soft: rgba(255,107,53,0.12);
            --accent2: #ffb347;
            --text: #f0f0f8;
            --text-muted: #7a7a96;
            --text-dim: #4a4a62;
            --link: #8b9cf4;
            --star: #ffd060;
            --green: #3ddc84;
            --red: #ff4d6a;
            --radius: 12px;
            --radius-sm: 8px;
            --radius-lg: 16px;
            --shadow: 0 4px 24px rgba(0,0,0,0.4);
            --shadow-lg: 0 8px 48px rgba(0,0,0,0.6);
            --glow: 0 0 30px rgba(255,107,53,0.2);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--surface3); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--text-dim); }

        /* ══════════════════════════════
           HEADER
        ══════════════════════════════ */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(10,10,15,0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }

        .header-top {
            max-width: 1400px;
            margin: 0 auto;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Logo */
        .logo {
            text-decoration: none;
            flex-shrink: 0;
        }
        .logo-text {
            font-family: 'Sora', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.5px;
        }
        .logo-text span {
            color: var(--accent);
        }
        .logo-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
            margin-left: 2px;
            vertical-align: middle;
            margin-bottom: 3px;
        }

        /* Deliver */
        .header-deliver {
            display: flex;
            flex-direction: column;
            font-size: 12px;
            color: var(--text-muted);
            white-space: nowrap;
            flex-shrink: 0;
        }
        .header-deliver strong {
            font-size: 13px;
            color: var(--text);
            font-weight: 500;
        }

        /* Search */
        .search-bar {
            flex: 1;
            display: flex;
            align-items: center;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 50px;
            overflow: hidden;
            transition: border-color .2s, box-shadow .2s;
        }
        .search-bar:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(255,107,53,0.1);
        }
        .search-category {
            background: transparent;
            border: none;
            border-right: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 12px;
            padding: 0 14px;
            height: 42px;
            outline: none;
            cursor: pointer;
            font-family: inherit;
        }
        .search-category option { background: var(--surface2); }
        .search-input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            color: var(--text);
            font-size: 14px;
            padding: 0 18px;
            height: 42px;
            font-family: inherit;
        }
        .search-input::placeholder { color: var(--text-dim); }
        .search-btn {
            background: var(--accent);
            border: none;
            width: 48px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            flex-shrink: 0;
            transition: background .2s;
        }
        .search-btn:hover { background: #ff8055; }
        .search-btn svg path { stroke: #fff; }

        /* Actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-shrink: 0;
        }
        .header-action {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 8px 12px;
            text-decoration: none;
            color: var(--text);
            border-radius: var(--radius-sm);
            transition: background .15s;
            font-size: 12px;
            line-height: 1.5;
        }
        .header-action span:last-child {
            font-weight: 600;
            font-size: 13px;
        }
        .header-action:hover { background: var(--surface2); }
        .header-action.cart {
            flex-direction: row;
            align-items: center;
            gap: 8px;
        }
        .cart-icon {
            position: relative;
            display: flex;
            align-items: center;
        }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Subnav */
        .header-subnav {
            border-top: 1px solid var(--border);
            background: var(--surface);
        }
        .subnav-inner {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            gap: 2px;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .subnav-inner::-webkit-scrollbar { display: none; }
        .subnav-item {
            padding: 10px 14px;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 13px;
            white-space: nowrap;
            border-radius: 0;
            transition: color .15s;
            border-bottom: 2px solid transparent;
        }
        .subnav-item:hover { color: var(--text); border-bottom-color: var(--accent); }
        .subnav-item.bold { font-weight: 600; color: var(--text); }
        .subnav-item.bold:hover { color: var(--accent); }
        .subnav-item.active { color: var(--accent); border-bottom-color: var(--accent); }

        /* ══════════════════════════════
           MAIN
        ══════════════════════════════ */
        main {
            flex: 1;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            padding: 28px 24px;
        }

        /* ══════════════════════════════
           FOOTER
        ══════════════════════════════ */
        footer {
            background: var(--surface);
            border-top: 1px solid var(--border);
            margin-top: auto;
        }
        .footer-back-top {
            background: var(--surface2);
            text-align: center;
            padding: 14px;
            font-size: 13px;
            color: var(--text-muted);
            cursor: pointer;
            transition: color .2s, background .2s;
            border-bottom: 1px solid var(--border);
        }
        .footer-back-top:hover { color: var(--accent); background: var(--accent-soft); }

        .footer-main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 48px 24px 24px;
        }
        .footer-columns {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }
        .footer-col h4 {
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .footer-col a {
            display: block;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 13px;
            margin-bottom: 10px;
            transition: color .15s;
        }
        .footer-col a:hover { color: var(--accent); }

        .footer-divider { border: none; border-top: 1px solid var(--border); margin-bottom: 24px; }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }
        .footer-logo {
            font-family: 'Sora', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: var(--text-muted);
        }
        .footer-logo span { color: var(--accent); }
        .footer-links { display: flex; gap: 20px; flex-wrap: wrap; }
        .footer-links a {
            font-size: 12px;
            color: var(--text-dim);
            text-decoration: none;
            transition: color .15s;
        }
        .footer-links a:hover { color: var(--text-muted); }
        .footer-copy { font-size: 12px; color: var(--text-dim); }

        @media (max-width: 900px) {
            .footer-columns { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 480px) {
            .footer-columns { grid-template-columns: 1fr; }
            .header-deliver { display: none; }
        }

        /* ══════════════════════════════
           SHARED UTILITIES
        ══════════════════════════════ */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text-dim);
            margin-bottom: 24px;
        }
        .breadcrumb a { color: var(--link); text-decoration: none; }
        .breadcrumb a:hover { text-decoration: underline; }
        .breadcrumb span { color: var(--text-dim); }
        .breadcrumb strong { color: var(--text-muted); }
    </style>
    @stack('styles')
</head>
<body>

<header>
    <div class="header-top">
        <a href="/" class="logo">
            <div class="logo-text">Mi<span>Tienda</span><span class="logo-dot"></span></div>
        </a>
        <div class="header-deliver">
            <span>Entregar a</span>
            <strong>📍 Colombia</strong>
        </div>
        <form class="search-bar" action="/product" method="GET">
            <select class="search-category" name="category">
                <option>Todo</option>
                <option>Electrónica</option>
                <option>Ropa</option>
                <option>Hogar</option>
                <option>Libros</option>
            </select>
            <input class="search-input" type="text" name="q" placeholder="Buscar productos, marcas y más...">
            <button class="search-btn" type="submit">
                <svg width="18" height="18" viewBox="0 0 24 24">
                    <path d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"
                          stroke="#fff" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                </svg>
            </button>
        </form>
        <div class="header-actions">
            <a href="#" class="header-action">
                <span style="color:var(--text-muted)">Hola, Inicia sesión</span>
                <span>Cuenta y Listas ›</span>
            </a>
            <a href="#" class="header-action">
                <span style="color:var(--text-muted)">Devoluciones</span>
                <span>y Pedidos</span>
            </a>
            <a href="#" class="header-action cart">
                <div class="cart-icon">
                    <svg width="28" height="26" viewBox="0 0 36 32" fill="none">
                        <path d="M2 2h4l3 15h18l3-10H8" stroke="var(--text)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="14" cy="28" r="2" fill="var(--text)"/>
                        <circle cx="26" cy="28" r="2" fill="var(--text)"/>
                    </svg>
                    <span class="cart-count">0</span>
                </div>
                <span style="font-weight:600">Carrito</span>
            </a>
        </div>
    </div>

    <nav class="header-subnav">
        <div class="subnav-inner">
            <a href="#" class="subnav-item bold">☰ Todo</a>
            <a href="/" class="subnav-item">Inicio</a>
            <a href="/product" class="subnav-item">Productos</a>
            <a href="/product/create" class="subnav-item">Vender</a>
            <a href="#" class="subnav-item">🔥 Ofertas</a>
            <a href="#" class="subnav-item">Soporte</a>
            <a href="#" class="subnav-item">Electrónica</a>
            <a href="#" class="subnav-item">Moda</a>
            <a href="#" class="subnav-item">Hogar</a>
            <a href="#" class="subnav-item">Libros</a>
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <div class="footer-back-top" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        ↑ Volver arriba
    </div>
    <div class="footer-main">
        <div class="footer-columns">
            <div class="footer-col">
                <h4>Conócenos</h4>
                <a href="#">Sobre MiTienda</a>
                <a href="#">Trabaja con nosotros</a>
                <a href="#">Prensa</a>
                <a href="#">Inversores</a>
                <a href="#">Dispositivos</a>
            </div>
            <div class="footer-col">
                <h4>Gana con nosotros</h4>
                <a href="#">Vende tus productos</a>
                <a href="#">Vende en la nube</a>
                <a href="#">Publicidad</a>
                <a href="#">Afiliados</a>
                <a href="#">Publica con nosotros</a>
            </div>
            <div class="footer-col">
                <h4>Métodos de pago</h4>
                <a href="#">Tarjeta de crédito</a>
                <a href="#">Recarga de saldo</a>
                <a href="#">Contraentrega</a>
                <a href="#">PSE</a>
                <a href="#">Nequi / Daviplata</a>
            </div>
            <div class="footer-col">
                <h4>Atención al cliente</h4>
                <a href="#">Accesibilidad</a>
                <a href="#">Centro de ayuda</a>
                <a href="#">Devolver artículos</a>
                <a href="#">Seguir pedidos</a>
                <a href="#">Contáctanos</a>
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-bottom">
            <div class="footer-logo">Mi<span>Tienda</span></div>
            <div class="footer-links">
                <a href="#">Términos de Uso</a>
                <a href="#">Privacidad</a>
                <a href="#">Cookies</a>
                <a href="#">Anuncios</a>
            </div>
            <p class="footer-copy">© {{ date('Y') }} MiTienda.com, S.A.S.</p>
        </div>
    </div>
</footer>

</body>
</html>