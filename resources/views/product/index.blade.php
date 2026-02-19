@extends('layouts.app')

@section('title', 'Productos — MiTienda')

@push('styles')
<style>
    /* ── Breadcrumb ── */
    .breadcrumb {
        font-size: 13px;
        color: var(--amazon-muted);
        margin-bottom: 16px;
    }
    .breadcrumb a { color: var(--amazon-link); text-decoration: none; }
    .breadcrumb a:hover { color: var(--amazon-blue-hover); text-decoration: underline; }
    .breadcrumb span { margin: 0 5px; color: #999; }

    /* ── Toolbar ── */
    .products-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
    }
    .products-toolbar h1 {
        font-size: 22px;
        font-weight: 400;
        color: var(--amazon-text);
    }
    .toolbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .sort-label { font-size: 13px; color: var(--amazon-muted); }
    .sort-select {
        padding: 6px 10px;
        border: 1px solid var(--amazon-border);
        border-radius: 4px;
        font-size: 13px;
        background: #fff;
        cursor: pointer;
    }
    .btn-add {
        background: var(--amazon-orange-btn);
        border: 1px solid #a88734;
        border-radius: 4px;
        padding: 8px 18px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        color: var(--amazon-text);
        transition: background .15s, box-shadow .15s;
        white-space: nowrap;
    }
    .btn-add:hover {
        background: #e68a00;
        box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    }

    /* ── Layout ── */
    .products-layout {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    /* ── Sidebar filtros ── */
    .sidebar {
        width: 220px;
        flex-shrink: 0;
    }
    .filter-card {
        background: #fff;
        border: 1px solid var(--amazon-border);
        border-radius: 4px;
        padding: 16px;
        margin-bottom: 14px;
    }
    .filter-card h3 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eee;
    }
    .filter-item {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        font-size: 13px;
        cursor: pointer;
    }
    .filter-item:hover { color: var(--amazon-blue-hover); }
    .filter-item input[type="checkbox"] { accent-color: var(--amazon-orange-btn); }
    .price-range {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .price-range label { font-size: 12px; color: var(--amazon-muted); }
    .price-range input[type="range"] {
        width: 100%;
        accent-color: var(--amazon-orange-btn);
    }
    .price-range-vals {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: var(--amazon-muted);
    }
    .stars-filter { display: flex; flex-direction: column; gap: 6px; }
    .star-row {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        cursor: pointer;
        text-decoration: none;
        color: var(--amazon-text);
    }
    .star-row:hover { color: var(--amazon-blue-hover); }
    .stars { color: var(--amazon-star); font-size: 14px; letter-spacing: -1px; }

    /* ── Grid productos ── */
    .products-grid {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .product-card {
        background: #fff;
        border: 1px solid var(--amazon-border);
        border-radius: 4px;
        padding: 14px;
        display: flex;
        flex-direction: column;
        transition: box-shadow .2s;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .product-card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        z-index: 1;
    }

    .product-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: var(--amazon-red);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 2px;
    }
    .badge-new { background: #067d62; }

    .product-img-wrap {
        width: 100%;
        padding-top: 100%;
        position: relative;
        margin-bottom: 12px;
        background: #f6f6f6;
        border-radius: 3px;
        overflow: hidden;
    }
    .product-img-placeholder {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 52px;
        color: #ccc;
    }
    .product-img-placeholder svg {
        width: 64px; height: 64px; opacity: .3;
    }

    .product-title {
        font-size: 13px;
        color: var(--amazon-text);
        margin-bottom: 6px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
        flex: 1;
    }
    .product-title:hover { color: var(--amazon-blue-hover); }

    .product-stars {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 4px;
    }
    .product-stars .stars { font-size: 13px; }
    .product-stars .rating-count {
        font-size: 12px;
        color: var(--amazon-link);
    }

    .product-prime {
        font-size: 11px;
        font-weight: 700;
        color: #007eb9;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .product-price-block { margin-bottom: 10px; }
    .product-price-old {
        font-size: 12px;
        color: var(--amazon-muted);
        text-decoration: line-through;
        margin-bottom: 1px;
    }
    .product-price {
        font-size: 18px;
        font-weight: 700;
        color: var(--amazon-text);
    }
    .product-price sup { font-size: 12px; vertical-align: super; font-weight: 400; }
    .product-price-discount {
        font-size: 12px;
        color: var(--amazon-red);
        font-weight: 500;
    }

    .btn-cart {
        background: var(--amazon-orange-btn);
        border: 1px solid #a88734;
        border-radius: 20px;
        padding: 7px;
        font-size: 13px;
        cursor: pointer;
        text-align: center;
        width: 100%;
        margin-top: auto;
        transition: background .15s;
        font-weight: 500;
    }
    .btn-cart:hover { background: #e68a00; }

    /* ── Banner ── */
    .hero-banner {
        background: linear-gradient(135deg, #232f3e 0%, #37475a 60%, #131921 100%);
        border-radius: 6px;
        padding: 32px 40px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        overflow: hidden;
        position: relative;
        color: #fff;
    }
    .hero-banner::before {
        content: '';
        position: absolute;
        right: -40px; top: -40px;
        width: 250px; height: 250px;
        background: radial-gradient(circle, rgba(254,189,105,.15) 0%, transparent 70%);
    }
    .hero-text h2 { font-size: 28px; font-weight: 700; margin-bottom: 6px; }
    .hero-text p { font-size: 15px; color: #ccc; margin-bottom: 18px; }
    .hero-text a {
        display: inline-block;
        background: var(--amazon-orange-btn);
        color: #111;
        text-decoration: none;
        padding: 10px 24px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 14px;
        transition: background .15s;
    }
    .hero-text a:hover { background: #e68a00; }
    .hero-icon { font-size: 90px; opacity: .6; }

    /* ── Paginación ── */
    .pagination-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 4px;
        margin-top: 28px;
    }
    .page-btn {
        padding: 7px 14px;
        border: 1px solid var(--amazon-border);
        border-radius: 4px;
        background: #fff;
        font-size: 13px;
        cursor: pointer;
        color: var(--amazon-link);
        transition: background .12s;
        text-decoration: none;
    }
    .page-btn:hover { background: #f0f0f0; }
    .page-btn.active {
        background: var(--amazon-orange-btn);
        border-color: #a88734;
        color: #111;
        font-weight: 700;
    }

    /* ── Empty state ── */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: var(--amazon-muted);
    }
    .empty-state .empty-icon { font-size: 64px; margin-bottom: 16px; }
    .empty-state h3 { font-size: 20px; color: var(--amazon-text); margin-bottom: 8px; }
    .empty-state p { font-size: 14px; margin-bottom: 20px; }

    @media (max-width: 1024px) {
        .products-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
        .sidebar { display: none; }
        .products-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 480px) {
        .products-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="/">Inicio</a>
        <span>›</span>
        <strong>Todos los Productos</strong>
    </div>

    {{-- Hero Banner --}}
    <div class="hero-banner">
        <div class="hero-text">
            <h2>🔥 Ofertas de la Semana</h2>
            <p>Hasta 60% de descuento en miles de productos seleccionados.</p>
            <a href="#">Ver Ofertas</a>
        </div>
        <div class="hero-icon">🛍️</div>
    </div>

    {{-- Toolbar --}}
    <div class="products-toolbar">
        <h1>Resultados <span style="font-size:14px;color:#666;">1–20 de más de 1,200 resultados</span></h1>
        <div class="toolbar-right">
            <span class="sort-label">Ordenar por:</span>
            <select class="sort-select">
                <option>Relevancia</option>
                <option>Precio: menor a mayor</option>
                <option>Precio: mayor a menor</option>
                <option>Más valorados</option>
                <option>Más recientes</option>
            </select>
            <a href="/product/create" class="btn-add">+ Agregar Producto</a>
        </div>
    </div>

    {{-- Layout principal --}}
    <div class="products-layout">

        {{-- Sidebar --}}
        <aside class="sidebar">
            <div class="filter-card">
                <h3>Categorías</h3>
                @foreach(['Electrónica','Ropa','Hogar','Libros','Deportes','Juguetes'] as $cat)
                <label class="filter-item">
                    <input type="checkbox"> {{ $cat }}
                </label>
                @endforeach
            </div>

            <div class="filter-card">
                <h3>Precio</h3>
                <div class="price-range">
                    <input type="range" min="0" max="1000" value="500" id="price-slider">
                    <div class="price-range-vals">
                        <span>$0</span>
                        <span>Hasta $500</span>
                    </div>
                </div>
                <div style="margin-top:10px;">
                    @foreach(['Menos de $25','$25 a $50','$50 a $100','$100 a $200','Más de $200'] as $rango)
                    <label class="filter-item">
                        <input type="radio" name="price"> {{ $rango }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="filter-card">
                <h3>Valoración media</h3>
                <div class="stars-filter">
                    @for($s = 4; $s >= 1; $s--)
                    <a href="#" class="star-row">
                        <span class="stars">{{ str_repeat('★', $s) }}{{ str_repeat('☆', 5 - $s) }}</span>
                        <span>y más</span>
                    </a>
                    @endfor
                </div>
            </div>

            <div class="filter-card">
                <h3>Envío</h3>
                <label class="filter-item"><input type="checkbox"> Prime</label>
                <label class="filter-item"><input type="checkbox"> Envío Gratis</label>
                <label class="filter-item"><input type="checkbox"> Entrega mañana</label>
            </div>
        </aside>

        {{-- Grid --}}
        <div class="products-grid">
            {{--
                Cuando tengas datos reales, cambia este bloque por:
                @forelse($products as $product)
                    ... tu tarjeta ...
                @empty
                    <div class="empty-state">...</div>
                @endforelse
            --}}

            @php
            $demo = [
                ['emoji'=>'💻','name'=>'Laptop UltraBook Pro 15" Intel Core i7, 16GB RAM, 512GB SSD','price'=>'2,499','old'=>'3,100','discount'=>'20%','stars'=>4,'votes'=>'3,842','prime'=>true,'badge'=>''],
                ['emoji'=>'📱','name'=>'Smartphone Galaxy X12 128GB, Pantalla AMOLED 6.7"','price'=>'899','old'=>'1,200','discount'=>'25%','stars'=>5,'votes'=>'12,540','prime'=>true,'badge'=>'Oferta'],
                ['emoji'=>'🎧','name'=>'Audífonos Bluetooth Noise Cancelling Premium Edition','price'=>'249','old'=>'399','discount'=>'38%','stars'=>4,'votes'=>'876','prime'=>true,'badge'=>''],
                ['emoji'=>'⌚','name'=>'Reloj Inteligente Deportivo con GPS y Monitor de Salud','price'=>'349','old'=>null,'discount'=>null,'stars'=>4,'votes'=>'2,210','prime'=>false,'badge'=>'Nuevo'],
                ['emoji'=>'🖥️','name'=>'Monitor 4K 27" HDR 144Hz para Diseño y Gaming','price'=>'1,099','old'=>'1,399','discount'=>'21%','stars'=>5,'votes'=>'654','prime'=>true,'badge'=>''],
                ['emoji'=>'⌨️','name'=>'Teclado Mecánico Retroiluminado RGB Switches Blue','price'=>'189','old'=>'240','discount'=>'21%','stars'=>4,'votes'=>'4,321','prime'=>true,'badge'=>''],
                ['emoji'=>'📷','name'=>'Cámara Digital Mirrorless 24MP 4K Video con Lente 18-55mm','price'=>'3,200','old'=>'3,800','discount'=>'16%','stars'=>5,'votes'=>'198','prime'=>false,'badge'=>''],
                ['emoji'=>'🔊','name'=>'Bocina Bluetooth Portátil Waterproof 360° Sonido Envolvente','price'=>'159','old'=>null,'discount'=>null,'stars'=>4,'votes'=>'7,801','prime'=>true,'badge'=>'Nuevo'],
            ];
            @endphp

            @foreach($demo as $p)
            <div class="product-card" onclick="window.location='/product/{{ $loop->index + 1 }}'">
                @if($p['badge'])
                    <div class="product-badge {{ $p['badge'] === 'Nuevo' ? 'badge-new' : '' }}">{{ $p['badge'] }}</div>
                @endif

                <div class="product-img-wrap">
                    <div class="product-img-placeholder">{{ $p['emoji'] }}</div>
                </div>

                <div class="product-title">{{ $p['name'] }}</div>

                <div class="product-stars">
                    <span class="stars">{{ str_repeat('★', $p['stars']) }}{{ str_repeat('☆', 5 - $p['stars']) }}</span>
                    <span class="rating-count">({{ $p['votes'] }})</span>
                </div>

                @if($p['prime'])
                <div class="product-prime">
                    <span style="background:#007eb9;color:#fff;padding:0 4px;border-radius:2px;font-size:10px;">prime</span>
                    Envío GRATIS mañana
                </div>
                @endif

                <div class="product-price-block">
                    @if($p['old'])
                    <div class="product-price-old">Precio sin descuento: <strong>${{ $p['old'] }}</strong></div>
                    @endif
                    <div class="product-price"><sup>$</sup>{{ $p['price'] }}</div>
                    @if($p['discount'])
                    <div class="product-price-discount">Ahorra {{ $p['discount'] }}</div>
                    @endif
                </div>

                <button class="btn-cart" onclick="event.stopPropagation()">Añadir al Carrito</button>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Paginación --}}
    <div class="pagination-wrap">
        <a href="#" class="page-btn">← Anterior</a>
        @for($i = 1; $i <= 7; $i++)
            <a href="#" class="page-btn {{ $i === 1 ? 'active' : '' }}">{{ $i }}</a>
        @endfor
        <a href="#" class="page-btn">Siguiente →</a>
    </div>

@endsection