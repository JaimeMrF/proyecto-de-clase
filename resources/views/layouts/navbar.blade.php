
<!-- ═══ HEADER ═══ -->

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
