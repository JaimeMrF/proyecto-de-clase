@extends('layouts.app')

@section('title', 'Productos — MiTienda')

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
        <h1>Resultados <small>1–20 de más de 1,200 resultados</small></h1>
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
                    <input type="range" min="0" max="1000" value="500">
                    <div class="price-range-vals"><span>$0</span><span>Hasta $500</span></div>
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

        {{-- Grid de productos --}}
        <div class="products-grid">
            {{--
                Con datos reales:
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
                <div class="prime-label">
                    <span class="prime-box">prime</span> Envío GRATIS mañana
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