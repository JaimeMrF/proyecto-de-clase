@extends('layouts.app')

@section('title', 'Productos — MiTienda')

@push('styles')
<style>
    /* ── Banner ── */
    .promo-strip {
        background: var(--ink);
        color: var(--white);
        padding: 14px 28px;
        margin-bottom: 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }
    .promo-strip-text {
        font-family: var(--font-serif);
        font-size: 17px;
        font-style: italic;
    }
    .promo-strip-text strong {
        font-style: normal;
        font-family: var(--font-sans);
        font-weight: 600;
        color: #f0c040;
        font-size: 13px;
        margin-right: 10px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }
    .promo-strip-cta {
        background: var(--white);
        color: var(--ink);
        text-decoration: none;
        padding: 7px 20px;
        font-size: 13px;
        font-weight: 600;
        flex-shrink: 0;
        transition: background .12s, color .12s;
        white-space: nowrap;
    }
    .promo-strip-cta:hover { background: #f0c040; }

    /* ── Toolbar ── */
    .products-toolbar {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--rule);
        gap: 16px;
        flex-wrap: wrap;
    }
    .toolbar-left h1 {
        font-family: var(--font-serif);
        font-size: 22px;
        font-weight: 400;
        color: var(--ink);
        font-style: italic;
    }
    .toolbar-left h1 span {
        font-style: normal;
        font-family: var(--font-sans);
        font-size: 13px;
        font-weight: 400;
        color: var(--ink-muted);
        margin-left: 10px;
    }
    .toolbar-right { display: flex; align-items: center; gap: 14px; }
    .sort-label { font-size: 13px; color: var(--ink-muted); }
    .sort-select {
        padding: 6px 10px;
        background: var(--white);
        border: 1.5px solid var(--rule-dark);
        color: var(--ink);
        font-size: 13px;
        font-family: var(--font-sans);
        outline: none;
        cursor: pointer;
        transition: border-color .12s;
        border-radius: 2px;
    }
    .sort-select:focus { border-color: var(--ink); }
    .btn-add-product {
        background: var(--accent);
        color: var(--white);
        text-decoration: none;
        padding: 8px 20px;
        font-size: 13px;
        font-weight: 600;
        transition: background .12s;
        white-space: nowrap;
        letter-spacing: 0.01em;
    }
    .btn-add-product:hover { background: var(--accent-dark); }

    /* ── Layout ── */
    .products-layout {
        display: flex;
        gap: 32px;
        align-items: flex-start;
    }

    /* ── Sidebar ── */
    .sidebar {
        width: 196px;
        flex-shrink: 0;
    }
    .filter-section { margin-bottom: 28px; }
    .filter-section-title {
        font-size: 11px;
        font-weight: 600;
        font-family: var(--font-mono);
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--ink-muted);
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--rule);
    }
    .filter-item {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 8px;
        font-size: 13.5px;
        color: var(--ink-secondary);
        cursor: pointer;
        transition: color .12s;
        user-select: none;
    }
    .filter-item:hover { color: var(--ink); }
    .filter-item input { accent-color: var(--accent); cursor: pointer; }
    .filter-count {
        margin-left: auto;
        font-size: 11px;
        font-family: var(--font-mono);
        color: var(--ink-faint);
    }

    .price-inputs {
        display: flex;
        gap: 6px;
        align-items: center;
        margin-top: 10px;
    }
    .price-input {
        width: 70px;
        border: 1.5px solid var(--rule-dark);
        padding: 5px 8px;
        font-size: 13px;
        font-family: var(--font-mono);
        color: var(--ink);
        outline: none;
        transition: border-color .12s;
        background: var(--white);
    }
    .price-input:focus { border-color: var(--ink); }
    .price-dash { color: var(--ink-muted); font-size: 12px; }

    .stars-filter { display: flex; flex-direction: column; gap: 7px; }
    .star-row {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        text-decoration: none;
        color: var(--ink-secondary);
        transition: color .12s;
    }
    .star-row:hover { color: var(--ink); }
    .stars { color: #c8880a; letter-spacing: 1px; font-size: 13px; }

    /* ── Products grid ── */
    .products-grid {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1px;
        background: var(--rule);
        border: 1px solid var(--rule);
    }

    .product-card {
        background: var(--white);
        padding: 20px 16px 16px;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        position: relative;
        transition: background .12s;
    }
    .product-card:hover { background: var(--paper); }

    .product-badge {
        position: absolute;
        top: 0; left: 0;
        background: var(--accent);
        color: var(--white);
        font-size: 10px;
        font-weight: 600;
        font-family: var(--font-mono);
        padding: 3px 8px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
    }
    .badge-new { background: var(--green); }

    .product-img-wrap {
        width: 100%;
        padding-top: 90%;
        position: relative;
        margin-bottom: 14px;
        background: var(--off-white);
        overflow: hidden;
    }
    .product-img-placeholder {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 52px;
        color: var(--rule-dark);
    }
    /* Placeholder icon style */
    .product-img-placeholder svg {
        width: 48px; height: 48px;
        stroke: var(--ink-faint);
        fill: none;
    }

    .product-title {
        font-size: 13px;
        line-height: 1.5;
        color: var(--blue);
        margin-bottom: 7px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
        text-decoration: none;
        transition: text-decoration .12s;
    }
    .product-card:hover .product-title { text-decoration: underline; }

    .product-stars {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 4px;
    }
    .product-stars .stars { font-size: 12px; }
    .rating-count { font-size: 12px; color: var(--blue); }

    .product-prime {
        font-size: 11.5px;
        font-weight: 500;
        color: #1a5276;
        margin-bottom: 7px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .prime-tag {
        font-family: var(--font-mono);
        font-size: 10px;
        font-weight: 600;
        background: #1a5276;
        color: white;
        padding: 1px 5px;
        letter-spacing: 0.05em;
    }

    .product-price-block { margin-bottom: 12px; }
    .product-price-old {
        font-size: 12px;
        color: var(--ink-muted);
        text-decoration: line-through;
        font-family: var(--font-mono);
        margin-bottom: 2px;
    }
    .product-price {
        font-family: var(--font-serif);
        font-size: 21px;
        font-weight: 700;
        color: var(--ink);
        line-height: 1;
    }
    .product-price sup {
        font-size: 13px;
        vertical-align: super;
        font-family: var(--font-sans);
        font-weight: 400;
    }
    .product-discount {
        font-size: 12px;
        color: var(--accent);
        font-family: var(--font-mono);
        margin-top: 3px;
        font-weight: 500;
    }

    .btn-cart {
        width: 100%;
        background: var(--off-white);
        border: 1.5px solid var(--rule-dark);
        color: var(--ink);
        font-family: var(--font-sans);
        font-size: 13px;
        font-weight: 500;
        padding: 9px;
        cursor: pointer;
        transition: background .12s, border-color .12s, color .12s;
        margin-top: auto;
        letter-spacing: 0.01em;
    }
    .btn-cart:hover {
        background: var(--ink);
        border-color: var(--ink);
        color: var(--white);
    }

    /* ── Pagination ── */
    .pagination-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2px;
        margin-top: 40px;
        padding-top: 24px;
        border-top: 1px solid var(--rule);
    }
    .page-btn {
        padding: 7px 13px;
        border: 1.5px solid var(--rule-dark);
        background: var(--white);
        font-size: 13px;
        font-family: var(--font-mono);
        cursor: pointer;
        color: var(--ink-secondary);
        text-decoration: none;
        transition: all .12s;
    }
    .page-btn:hover { border-color: var(--ink); color: var(--ink); background: var(--off-white); }
    .page-btn.active {
        background: var(--ink);
        border-color: var(--ink);
        color: var(--white);
    }
    .page-btn.nav { font-family: var(--font-sans); font-size: 13px; }

    /* ── Empty state ── */
    .empty-state {
        grid-column: 1/-1;
        padding: 80px 24px;
        text-align: center;
    }
    .empty-state h3 {
        font-family: var(--font-serif);
        font-size: 22px;
        font-style: italic;
        color: var(--ink);
        margin-bottom: 10px;
    }
    .empty-state p { font-size: 14px; color: var(--ink-muted); margin-bottom: 24px; }

    @media (max-width: 1100px) { .products-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 860px) { .sidebar { display: none; } .products-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 520px) { .products-grid { grid-template-columns: 1fr; } .promo-strip { flex-direction: column; text-align: center; } }
</style>
@endpush

@section('content')

<div class="breadcrumb">
    <a href="/">Inicio</a>
    <span>/</span>
    <strong>Todos los productos</strong>
</div>

{{-- Promo strip --}}
<div class="promo-strip">
    <div class="promo-strip-text">
        <strong>Semana de Ofertas</strong>
        Hasta 60% de descuento en miles de productos seleccionados.
    </div>
    <a href="#" class="promo-strip-cta">Ver Ofertas</a>
</div>

{{-- Toolbar --}}
<div class="products-toolbar">
    <div class="toolbar-left">
        <h1>Resultados <span>1–{{ count($misProductos) }} de {{ count($misProductos) }}</span></h1>
    </div>
    <div class="toolbar-right">
        <span class="sort-label">Ordenar por</span>
        <select class="sort-select">
            <option>Relevancia</option>
            <option>Precio: menor a mayor</option>
            <option>Precio: mayor a menor</option>
            <option>Mejor valorados</option>
            <option>Más recientes</option>
        </select>
        <a href="/product/create" class="btn-add-product">+ Agregar producto</a>
    </div>
</div>

<div class="products-layout">

    {{-- Sidebar --}}
    <aside class="sidebar">
        <div class="filter-section">
            <div class="filter-section-title">Categorías</div>
            @foreach(['Electrónica' => 412, 'Ropa' => 318, 'Hogar' => 204, 'Libros' => 96, 'Deportes' => 140, 'Juguetes' => 78] as $cat => $n)
            <label class="filter-item">
                <input type="checkbox"> {{ $cat }}
                <span class="filter-count">{{ $n }}</span>
            </label>
            @endforeach
        </div>

        <div class="filter-section">
            <div class="filter-section-title">Precio</div>
            <div class="price-inputs">
                <input class="price-input" type="text" placeholder="Min">
                <span class="price-dash">—</span>
                <input class="price-input" type="text" placeholder="Max">
            </div>
            <div style="margin-top:14px">
                @foreach(['Menos de $25','$25 – $50','$50 – $100','$100 – $200','Más de $200'] as $rango)
                <label class="filter-item">
                    <input type="radio" name="price"> {{ $rango }}
                </label>
                @endforeach
            </div>
        </div>

        <div class="filter-section">
            <div class="filter-section-title">Valoración</div>
            <div class="stars-filter">
                @for($s = 4; $s >= 1; $s--)
                <a href="#" class="star-row">
                    <span class="stars">{{ str_repeat('★', $s) }}{{ str_repeat('☆', 5 - $s) }}</span>
                    <span style="font-size:12px;color:var(--ink-muted)">y más</span>
                </a>
                @endfor
            </div>
        </div>

        <div class="filter-section">
            <div class="filter-section-title">Envío</div>
            <label class="filter-item"><input type="checkbox"> Prime</label>
            <label class="filter-item"><input type="checkbox"> Envío gratis</label>
            <label class="filter-item"><input type="checkbox"> Entrega mañana</label>
        </div>
    </aside>

    {{-- Grid --}}
    <div class="products-grid">
        @forelse($misProductos as $p)
        <div class="product-card" onclick="window.location='/tienda/{{ $p['id'] }}'">

            {{-- Badge de estado --}}
            <div class="product-badge {{ $p['state'] == 'Disponible' ? 'badge-new' : 'badge-out' }}">
                {{ $p['state'] }}
            </div>

            {{-- Imagen --}}
            <div class="product-img-wrap">
                <a href="/tienda/{{ $p['id'] }}" onclick="event.stopPropagation()">
                    <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}"
     style="position:absolute;inset:0;width:100%;height:100%;object-fit:contain;padding:12px;">
                </a>
            </div>

            {{-- ID --}}
            <p style="font-size:11px;color:var(--ink-muted);margin-bottom:4px">ID: #{{ $p['id'] }}</p>

            {{-- Título --}}
            <a href="/tienda/{{ $p['id'] }}" onclick="event.stopPropagation()" style="text-decoration:none">
                <div class="product-title">{{ $p['nombre'] }}</div>
            </a>

            {{-- Descripción truncada --}}
            <p style="font-size:12px;color:var(--ink-muted);margin-bottom:10px;line-height:1.5">
                {{ Str::limit($p['description'], 80) }}
            </p>

            {{-- Precio --}}
            <div class="product-price-block">
                <div class="product-price">
                    <sup>$</sup>{{ number_format($p['price'], 2) }}
                </div>
            </div>

            {{-- Envío gratis --}}
            <p style="font-size:12px;color:#3ddc84;margin-bottom:12px;font-weight:600">
                ✓ Envío gratis a Bucaramanga
            </p>

            <button class="btn-cart" onclick="event.stopPropagation()">Añadir al carrito</button>
        </div>

        @empty
        <div class="empty-state">
            <h3>No hay productos disponibles</h3>
            <p>Aún no se han agregado productos. ¡Sé el primero en publicar!</p>
            <a href="/product/create" class="btn-add-product">+ Agregar producto</a>
        </div>
        @endforelse
    </div>
</div>

{{-- Pagination --}}
<div class="pagination-wrap">
    <a href="#" class="page-btn nav">← Anterior</a>
    @for($i = 1; $i <= 7; $i++)
        <a href="#" class="page-btn {{ $i === 1 ? 'active' : '' }}">{{ $i }}</a>
    @endfor
    <a href="#" class="page-btn nav">Siguiente →</a>
</div>

@endsection