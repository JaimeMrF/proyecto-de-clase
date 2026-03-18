@extends('layouts.app')

@section('title', $producto->name . ' — MiTienda')

@push('styles')
<style>
    .breadcrumb { margin-bottom: 28px; }

    .product-detail {
        display: flex;
        gap: 48px;
        align-items: flex-start;
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Imagen */
    .detail-img-wrap {
        width: 420px;
        flex-shrink: 0;
        border: 1px solid var(--rule);
        background: var(--off-white);
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 380px;
    }
    .detail-img-wrap img {
        width: 100%;
        height: 360px;
        object-fit: contain;
    }

    /* Info */
    .detail-info { flex: 1; }

    .detail-category {
        font-size: 11px;
        font-family: var(--font-mono);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--ink-muted);
        margin-bottom: 10px;
    }

    .detail-title {
        font-family: var(--font-serif);
        font-size: 26px;
        font-weight: 400;
        color: var(--ink);
        line-height: 1.35;
        margin-bottom: 14px;
    }

    .detail-id {
        font-size: 12px;
        color: var(--ink-faint);
        font-family: var(--font-mono);
        margin-bottom: 16px;
    }

    .detail-divider {
        border: none;
        border-top: 1px solid var(--rule);
        margin: 20px 0;
    }

    .detail-price {
        font-family: var(--font-serif);
        font-size: 36px;
        font-weight: 700;
        color: var(--ink);
        line-height: 1;
        margin-bottom: 6px;
    }
    .detail-price sup {
        font-size: 18px;
        vertical-align: super;
        font-family: var(--font-sans);
        font-weight: 400;
    }

    .detail-shipping {
        font-size: 13px;
        color: #3ddc84;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .detail-state {
        display: inline-block;
        font-size: 11px;
        font-family: var(--font-mono);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 4px 10px;
        margin-bottom: 20px;
        background: var(--accent);
        color: var(--white);
    }
    .detail-state.disponible { background: var(--green); }

    .detail-desc-label {
        font-size: 11px;
        font-family: var(--font-mono);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--ink-muted);
        margin-bottom: 8px;
    }
    .detail-desc {
        font-size: 14px;
        line-height: 1.7;
        color: var(--ink-secondary);
        margin-bottom: 28px;
    }

    .detail-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-cart-lg {
        flex: 1;
        background: var(--accent);
        color: var(--white);
        border: none;
        padding: 14px 24px;
        font-size: 14px;
        font-weight: 600;
        font-family: var(--font-sans);
        cursor: pointer;
        transition: background .12s;
        letter-spacing: 0.01em;
    }
    .btn-cart-lg:hover { background: var(--accent-dark); }

    .btn-back {
        padding: 14px 24px;
        border: 1.5px solid var(--rule-dark);
        background: var(--white);
        color: var(--ink);
        font-size: 13px;
        font-weight: 500;
        font-family: var(--font-sans);
        text-decoration: none;
        transition: all .12s;
        white-space: nowrap;
    }
    .btn-back:hover { background: var(--ink); color: var(--white); border-color: var(--ink); }

    .btn-delete {
        padding: 14px 24px;
        border: 1.5px solid #e53e3e;
        background: var(--white);
        color: #e53e3e;
        font-size: 13px;
        font-weight: 500;
        font-family: var(--font-sans);
        cursor: pointer;
        transition: all .12s;
    }
    .btn-delete:hover { background: #e53e3e; color: var(--white); }

    @media (max-width: 860px) {
        .product-detail { flex-direction: column; }
        .detail-img-wrap { width: 100%; }
    }
</style>
@endpush

@section('content')

<div class="breadcrumb">
    <a href="/">Inicio</a>
    <span>/</span>
    <a href="{{ route('product.index') }}">Productos</a>
    <span>/</span>
    <strong>{{ $producto->name }}</strong>
</div>

<div class="product-detail">

    {{-- Imagen --}}
    <div class="detail-img-wrap">
        @if($producto->image)
            <img src="{{ asset('storage/' . $producto->image) }}" alt="{{ $producto->name }}">
        @else
            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:80px;height:80px;stroke:var(--ink-faint)">
                <rect x="4" y="4" width="56" height="56" rx="2" stroke-width="2"/>
                <circle cx="22" cy="22" r="6" stroke-width="2"/>
                <path d="M4 44l16-12 12 10 10-8 18 14" stroke-width="2" stroke-linejoin="round"/>
            </svg>
        @endif
    </div>

    {{-- Info --}}
    <div class="detail-info">

        <div class="detail-category">
            {{ $producto->category->name ?? 'Sin categoría' }}
        </div>

        <h1 class="detail-title">{{ $producto->name }}</h1>

        <div class="detail-id">SKU: #{{ str_pad($producto->id, 6, '0', STR_PAD_LEFT) }}</div>

        <span class="detail-state {{ strtolower($producto->state ?? '') === 'disponible' ? 'disponible' : '' }}">
            {{ $producto->state ?? 'Sin estado' }}
        </span>

        <hr class="detail-divider">

        <div class="detail-price">
            <sup>$</sup>{{ number_format($producto->price, 2) }}
        </div>
        <div class="detail-shipping">✓ Envío gratis a Bucaramanga</div>

        <hr class="detail-divider">

        <div class="detail-desc-label">Descripción</div>
        <div class="detail-desc">{{ $producto->description }}</div>

        <div class="detail-actions">
            <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-cart-lg">Añadir al carrito</button>
            </form>
            <a href="{{ route('product.index') }}" class="btn-back">← Volver</a>

            <form action="{{ route('product.destroy', $producto) }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn-delete">Eliminar</button>
            </form>
        </div>

    </div>
</div>

@endsection