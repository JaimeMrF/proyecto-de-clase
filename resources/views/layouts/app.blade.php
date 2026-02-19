<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MiTienda') — Todo lo que necesitas</title>
    <link href="https://fonts.googleapis.com/css2?family=Amazon+Ember:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
                <svg width="20" height="20" viewBox="0 0 24 24">
                    <path d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"
                          stroke="#111" stroke-width="2.5" fill="none" stroke-linecap="round"/>
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

<!-- ═══ CONTENT ═══ -->
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
            <p class="footer-copy">© {{ date('Y') }} MiTienda.com, S.A.S. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

</body>
</html>