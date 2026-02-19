<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MiTienda') — Todo lo que necesitas</title>
    <link href="https://fonts.googleapis.com/css2?family=Ember+Display:wght@400;700&family=Amazon+Ember:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --amazon-dark: #131921;
            --amazon-nav: #232f3e;
            --amazon-nav-hover: #37475a;
            --amazon-orange: #febd69;
            --amazon-orange-btn: #ff9900;
            --amazon-orange-btn-hover: #e68a00;
            --amazon-blue: #007185;
            --amazon-blue-hover: #c7511f;
            --amazon-link: #007185;
            --amazon-star: #f0c14b;
            --amazon-bg: #eaeded;
            --amazon-white: #fff;
            --amazon-border: #ddd;
            --amazon-text: #0f1111;
            --amazon-muted: #565959;
            --amazon-footer-bg: #232f3e;
            --amazon-footer-dark: #131921;
            --amazon-footer-mid: #37475a;
            --amazon-red: #b12704;
        }

        body {
            font-family: 'Amazon Ember', Arial, sans-serif;
            background: var(--amazon-bg);
            color: var(--amazon-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ───── HEADER ───── */
        header {
            background: var(--amazon-dark);
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-top {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            max-width: 1500px;
            margin: 0 auto;
            width: 100%;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            border: 2px solid transparent;
            padding: 4px 6px;
            border-radius: 3px;
            transition: border-color .15s;
            flex-shrink: 0;
        }
        .logo:hover { border-color: var(--amazon-orange); }
        .logo-text {
            font-size: 26px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.5px;
        }
        .logo-text span { color: var(--amazon-orange); }

        .header-deliver {
            display: flex;
            flex-direction: column;
            color: #ccc;
            font-size: 11px;
            padding: 4px 6px;
            border: 2px solid transparent;
            border-radius: 3px;
            cursor: pointer;
            white-space: nowrap;
            transition: border-color .15s;
        }
        .header-deliver:hover { border-color: var(--amazon-orange); }
        .header-deliver strong { color: #fff; font-size: 13px; }

        .search-bar {
            flex: 1;
            display: flex;
            height: 40px;
            border-radius: 4px;
            overflow: hidden;
        }
        .search-category {
            background: #f3f3f3;
            border: none;
            padding: 0 10px;
            font-size: 12px;
            color: #555;
            cursor: pointer;
            border-right: 1px solid #cdba96;
            border-radius: 4px 0 0 4px;
        }
        .search-input {
            flex: 1;
            border: none;
            padding: 0 14px;
            font-size: 15px;
            outline: none;
        }
        .search-btn {
            background: var(--amazon-orange-btn);
            border: none;
            padding: 0 16px;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
            transition: background .15s;
        }
        .search-btn:hover { background: var(--amazon-orange-btn-hover); }
        .search-btn svg { display: block; }

        .header-actions {
            display: flex;
            align-items: stretch;
            gap: 2px;
            margin-left: auto;
            flex-shrink: 0;
        }
        .header-action {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 4px 8px;
            text-decoration: none;
            color: #fff;
            border: 2px solid transparent;
            border-radius: 3px;
            transition: border-color .15s;
            white-space: nowrap;
            cursor: pointer;
        }
        .header-action:hover { border-color: var(--amazon-orange); color: #fff; }
        .header-action span:first-child { font-size: 11px; color: #ccc; }
        .header-action span:last-child { font-size: 13px; font-weight: 700; }
        .header-action.cart {
            flex-direction: row;
            align-items: center;
            gap: 6px;
            font-weight: 700;
            font-size: 14px;
        }
        .cart-icon { position: relative; }
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--amazon-orange-btn);
            color: var(--amazon-dark);
            font-size: 12px;
            font-weight: 700;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Sub-nav */
        .header-subnav {
            background: var(--amazon-nav);
            padding: 0 14px;
        }
        .subnav-inner {
            max-width: 1500px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 0;
            overflow-x: auto;
        }
        .subnav-item {
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            padding: 9px 10px;
            white-space: nowrap;
            border: 2px solid transparent;
            border-radius: 3px;
            transition: border-color .15s;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .subnav-item:hover { border-color: var(--amazon-orange); color: #fff; }
        .subnav-item.bold { font-weight: 700; }

        /* ───── MAIN ───── */
        main {
            flex: 1;
            max-width: 1500px;
            width: 100%;
            margin: 0 auto;
            padding: 20px 14px;
        }

        /* ───── FOOTER ───── */
        footer {
            margin-top: auto;
        }
        .footer-back-top {
            background: var(--amazon-footer-mid);
            color: #fff;
            text-align: center;
            padding: 13px;
            font-size: 13px;
            cursor: pointer;
            transition: background .15s;
        }
        .footer-back-top:hover { background: #485769; }

        .footer-main {
            background: var(--amazon-footer-bg);
            color: #ddd;
            padding: 40px 14px 30px;
        }
        .footer-columns {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            max-width: 1100px;
            margin: 0 auto 30px;
        }
        .footer-col h4 {
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 14px;
        }
        .footer-col a {
            display: block;
            color: #ddd;
            text-decoration: none;
            font-size: 13px;
            margin-bottom: 7px;
            transition: color .15s;
        }
        .footer-col a:hover { color: #fff; }

        .footer-divider {
            border: none;
            border-top: 1px solid #3a4553;
            margin: 0 auto 20px;
            max-width: 1100px;
        }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 12px;
        }
        .footer-logo { font-size: 22px; font-weight: 700; color: #fff; }
        .footer-logo span { color: var(--amazon-orange); }
        .footer-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 6px;
        }
        .footer-links a {
            color: #ddd;
            text-decoration: none;
            font-size: 12px;
            padding: 2px 8px;
            border-right: 1px solid #555;
        }
        .footer-links a:last-child { border-right: none; }
        .footer-links a:hover { color: #fff; }
        .footer-copy {
            color: #999;
            font-size: 12px;
            text-align: center;
        }

        .footer-dark {
            background: var(--amazon-footer-dark);
            padding: 16px 14px;
        }

        @media (max-width: 768px) {
            .footer-columns { grid-template-columns: repeat(2, 1fr); }
            .header-deliver { display: none; }
        }
        @media (max-width: 480px) {
            .footer-columns { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- ═══ HEADER ═══ -->
<header>
    <div class="header-top">
        <a href="/" class="logo">
            <div class="logo-text">Mi<span>Tienda</span></div>
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
                <svg width="20" height="20" fill="#111" viewBox="0 0 24 24">
                    <path d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z" stroke="#111" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                </svg>
            </button>
        </form>

        <div class="header-actions">
            <a href="#" class="header-action">
                <span>Hola, Inicia sesión</span>
                <span>Cuenta y Listas ▾</span>
            </a>
            <a href="#" class="header-action">
                <span>Devoluciones</span>
                <span>y Pedidos</span>
            </a>
            <a href="#" class="header-action cart">
                <div class="cart-icon">
                    <svg width="36" height="32" viewBox="0 0 36 32" fill="none">
                        <path d="M2 2h4l3 15h18l3-10H8" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="14" cy="28" r="2" fill="#fff"/>
                        <circle cx="26" cy="28" r="2" fill="#fff"/>
                    </svg>
                    <span class="cart-count">0</span>
                </div>
                <span>Carrito</span>
            </a>
        </div>
    </div>

    <nav class="header-subnav">
        <div class="subnav-inner">
            <a href="#" class="subnav-item bold">☰ Todos</a>
            <a href="/" class="subnav-item">Inicio</a>
            <a href="/product" class="subnav-item">Productos</a>
            <a href="/product/create" class="subnav-item">Vender</a>
            <a href="#" class="subnav-item">Ofertas del Día</a>
            <a href="#" class="subnav-item">Servicio al Cliente</a>
            <a href="#" class="subnav-item">Electrónica</a>
            <a href="#" class="subnav-item">Moda</a>
            <a href="#" class="subnav-item">Hogar</a>
            <a href="#" class="subnav-item">Libros</a>
        </div>
    </nav>
</header>

<!-- ═══ MAIN CONTENT ═══ -->
<main>
    @yield('content')
</main>

<!-- ═══ FOOTER ═══ -->
<footer>
    <div class="footer-back-top" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        Volver arriba ↑
    </div>

    <div class="footer-main">
        <div class="footer-columns">
            <div class="footer-col">
                <h4>Conócenos</h4>
                <a href="#">Sobre MiTienda</a>
                <a href="#">Trabaja con nosotros</a>
                <a href="#">Prensa</a>
                <a href="#">Relaciones con inversores</a>
                <a href="#">Dispositivos</a>
            </div>
            <div class="footer-col">
                <h4>Gana dinero con nosotros</h4>
                <a href="#">Vende tus productos</a>
                <a href="#">Vende en la nube</a>
                <a href="#">Publicita tus productos</a>
                <a href="#">Programa de afiliados</a>
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
                <a href="#">Condiciones de Uso</a>
                <a href="#">Aviso de Privacidad</a>
                <a href="#">Preferencias de Cookies</a>
                <a href="#">Anuncios basados en intereses</a>
            </div>
            <p class="footer-copy">© 2024 MiTienda.com, S.A.S. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

</body>
</html>