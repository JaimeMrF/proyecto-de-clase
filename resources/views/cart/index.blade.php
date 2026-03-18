@extends('layouts.app')

@section('title', 'Carrito — MiTienda')

@push('styles')
<style>
    .cart-wrap { max-width: 1000px; margin: 0 auto; }
    .cart-title {
        font-family: 'Sora', sans-serif;
        font-size: 28px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border);
    }
    .alert-success {
        background: rgba(61,220,132,0.1);
        border: 1px solid rgba(61,220,132,0.3);
        color: var(--green);
        padding: 12px 16px;
        font-size: 13px;
        margin-bottom: 20px;
        border-radius: var(--radius-sm);
    }
    .cart-layout { display: flex; gap: 32px; align-items: flex-start; }
    .cart-table-wrap { flex: 1; }
    .cart-table { width: 100%; border-collapse: collapse; border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }
    .cart-table th {
        background: var(--surface2);
        padding: 11px 14px;
        text-align: left;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-muted);
        border-bottom: 1px solid var(--border);
        font-weight: 600;
    }
    .cart-table td {
        padding: 16px 14px;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
        font-size: 14px;
        color: var(--text-muted);
        background: var(--surface);
    }
    .cart-table tr:last-child td { border-bottom: none; }
    .cart-product-info { display: flex; align-items: center; gap: 14px; }
    .cart-product-img {
        width: 64px; height: 64px;
        object-fit: contain;
        background: var(--surface2);
        border: 1px solid var(--border);
        padding: 4px;
        flex-shrink: 0;
        border-radius: var(--radius-sm);
    }
    .cart-product-name { font-size: 13.5px; color: var(--text); font-weight: 500; line-height: 1.4; }
    .cart-product-id { font-size: 11px; color: var(--text-dim); }
    .qty-form { display: flex; align-items: center; gap: 6px; }
    .qty-input {
        width: 56px;
        border: 1px solid var(--border);
        padding: 6px 8px;
        font-size: 13px;
        text-align: center;
        color: var(--text);
        outline: none;
        background: var(--surface2);
        border-radius: var(--radius-sm);
    }
    .qty-btn {
        background: var(--surface2);
        border: 1px solid var(--border);
        color: var(--text);
        font-size: 12px;
        padding: 6px 10px;
        cursor: pointer;
        transition: all .12s;
        border-radius: var(--radius-sm);
    }
    .qty-btn:hover { background: var(--accent); border-color: var(--accent); color: white; }
    .price-cell { font-size: 17px; color: var(--text); font-weight: 700; }
    .btn-remove {
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        font-size: 20px;
        padding: 4px 8px;
        transition: color .12s;
        line-height: 1;
    }
    .btn-remove:hover { color: var(--red); }
    .cart-summary {
        width: 280px;
        flex-shrink: 0;
        background: var(--surface);
        border: 1px solid var(--border);
        padding: 24px;
        border-radius: var(--radius);
    }
    .summary-title {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-muted);
        margin-bottom: 20px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        color: var(--text-muted);
        margin-bottom: 12px;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 20px;
        color: var(--text);
        font-weight: 700;
        padding-top: 16px;
        border-top: 1px solid var(--border);
        margin-top: 8px;
        margin-bottom: 20px;
    }
    .btn-checkout {
        width: 100%;
        background: var(--accent);
        color: white;
        border: none;
        padding: 14px;
        font-size: 14px;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        transition: background .12s;
        margin-bottom: 10px;
        border-radius: var(--radius-sm);
    }
    .btn-checkout:hover { background: #ff8055; }
    .btn-clear {
        width: 100%;
        background: none;
        border: 1px solid var(--border);
        color: var(--text-muted);
        padding: 10px;
        font-size: 13px;
        font-family: inherit;
        cursor: pointer;
        transition: all .12s;
        border-radius: var(--radius-sm);
    }
    .btn-clear:hover { border-color: var(--red); color: var(--red); }
    .cart-empty {
        text-align: center;
        padding: 80px 24px;
        border: 1px solid var(--border);
        border-radius: var(--radius);
        background: var(--surface);
    }
    .cart-empty h3 { font-size: 24px; font-weight: 700; color: var(--text); margin-bottom: 10px; }
    .cart-empty p { font-size: 14px; color: var(--text-muted); margin-bottom: 24px; }
    .btn-shop {
        background: var(--accent);
        color: white;
        text-decoration: none;
        padding: 12px 28px;
        font-size: 13px;
        font-weight: 600;
        transition: background .12s;
        border-radius: var(--radius-sm);
    }
    .btn-shop:hover { background: #ff8055; }
</style>
@endpush

@section('content')

<div class="breadcrumb">
    <a href="/">Inicio</a>
    <span>/</span>
    <strong>Carrito de compras</strong>
</div>

<div class="cart-wrap">
    <h1 class="cart-title">Carrito de compras</h1>

    @if(session('cart_success'))
        <div class="alert-success">✓ {{ session('cart_success') }}</div>
    @endif

    @if(count($products) > 0)
        <div class="cart-layout">

            <div class="cart-table-wrap">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $item)
                        <tr>
                            <td>
                                <div class="cart-product-info">
                                    <img class="cart-product-img"
                                         src="{{ asset('storage/' . $item['product']->image) }}"
                                         alt="{{ $item['product']->name }}">
                                    <div>
                                        <div class="cart-product-name">{{ $item['product']->name }}</div>
                                        <div class="cart-product-id">#{{ $item['product']->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="price-cell">${{ number_format($item['product']->price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="qty-form">
                                    @csrf
                                    <input class="qty-input" type="number" name="quantity"
                                           value="{{ $item['quantity'] }}" min="1">
                                    <button class="qty-btn" type="submit">↺</button>
                                </form>
                            </td>
                            <td class="price-cell">${{ number_format($item['subtotal'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn-remove" type="submit" title="Eliminar">×</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="cart-summary">
                <div class="summary-title">Resumen del pedido</div>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Envío</span>
                    <span style="color:var(--green);font-weight:600">Gratis</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>

                <button class="btn-checkout" id="btn-checkout" onclick="finalizarCompra()">Finalizar compra</button>

                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button class="btn-clear" type="submit">Vaciar carrito</button>
                </form>
            </div>

        </div>
    @else
        <div class="cart-empty">
            <h3>Tu carrito está vacío</h3>
            <p>Agrega productos desde el catálogo para comenzar.</p>
            <a href="{{ route('product.index') }}" class="btn-shop">Ver productos</a>
        </div>
    @endif
</div>
<script>
function finalizarCompra() {
    const btn = document.getElementById('btn-checkout');
    btn.textContent = '✓ Compra finalizada';
    btn.style.background = '#3ddc84';
    btn.style.cursor = 'default';
    btn.onclick = null;

    setTimeout(() => {
        fetch("{{ route('cart.clear') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(() => {
            window.location.href = "{{ route('product.index') }}";
        });
    }, 2500);
}
</script>
@endsection