@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .dash-greeting {
        margin-bottom: 32px;
    }
    .dash-greeting h1 {
        font-family: var(--font-display);
        font-size: 48px;
        letter-spacing: 0.04em;
        color: var(--text);
        line-height: 1;
        margin-bottom: 6px;
    }
    .dash-greeting h1 span { color: var(--accent); }
    .dash-greeting p {
        font-size: 13px;
        color: var(--text-muted);
        font-family: var(--font-mono);
    }

    /* ── Métricas ── */
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1px;
        background: var(--border);
        border: 1px solid var(--border);
        margin-bottom: 32px;
    }
    .metric-card {
        background: var(--surface);
        padding: 24px;
        position: relative;
        overflow: hidden;
    }
    .metric-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 2px;
        background: var(--accent);
        opacity: 0;
        transition: opacity .2s;
    }
    .metric-card:hover::before { opacity: 1; }

    .metric-label {
        font-family: var(--font-mono);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        color: var(--text-faint);
        margin-bottom: 14px;
    }
    .metric-value {
        font-family: var(--font-display);
        font-size: 52px;
        letter-spacing: 0.02em;
        color: var(--text);
        line-height: 1;
        margin-bottom: 8px;
    }
    .metric-sub {
        font-size: 12px;
        color: var(--text-muted);
        font-family: var(--font-mono);
    }
    .metric-icon {
        position: absolute;
        bottom: 16px; right: 20px;
        font-size: 40px;
        opacity: 0.04;
    }

    /* ── Tabla últimos productos ── */
    .section-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .section-title {
        font-family: var(--font-mono);
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--text-muted);
    }
    .section-link {
        font-size: 12px;
        color: var(--accent);
        text-decoration: none;
        font-family: var(--font-mono);
        transition: color .12s;
    }
    .section-link:hover { color: var(--accent2); }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid var(--border);
    }
    .admin-table th {
        background: var(--surface2);
        padding: 12px 16px;
        text-align: left;
        font-family: var(--font-mono);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--text-faint);
        font-weight: 600;
        border-bottom: 1px solid var(--border);
    }
    .admin-table td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--border);
        font-size: 13.5px;
        color: var(--text-muted);
        background: var(--surface);
    }
    .admin-table tr:last-child td { border-bottom: none; }
    .admin-table tr:hover td { background: var(--surface2); color: var(--text); }

    .td-name {
        color: var(--text);
        font-weight: 500;
    }
    .td-price {
        font-family: var(--font-mono);
        color: var(--gold);
    }
    .td-id {
        font-family: var(--font-mono);
        font-size: 11px;
        color: var(--text-faint);
    }
    .td-actions { display: flex; gap: 8px; }
    .tbl-btn {
        padding: 5px 12px;
        font-size: 11px;
        font-family: var(--font-mono);
        border: 1px solid var(--border2);
        background: transparent;
        color: var(--text-muted);
        text-decoration: none;
        cursor: pointer;
        transition: all .12s;
    }
    .tbl-btn:hover { border-color: var(--accent); color: var(--accent); }
    .tbl-btn.danger:hover { border-color: var(--red); color: var(--red); }

    .empty-table {
        text-align: center;
        padding: 48px;
        color: var(--text-faint);
        font-family: var(--font-mono);
        font-size: 13px;
    }
</style>
@endpush

@section('content')

<div class="dash-greeting">
    <h1>Panel <span>Admin</span></h1>
    <p>{{ now()->format('l, d \d\e F Y') }} · MiTienda</p>
</div>

{{-- Métricas --}}
<div class="metrics-grid">
    <div class="metric-card">
        <div class="metric-label">Productos</div>
        <div class="metric-value">{{ $totalProductos }}</div>
        <div class="metric-sub">en catálogo</div>
        <div class="metric-icon">▦</div>
    </div>
    <div class="metric-card">
        <div class="metric-label">Categorías</div>
        <div class="metric-value">{{ $totalCategorias }}</div>
        <div class="metric-sub">registradas</div>
        <div class="metric-icon">◈</div>
    </div>
    <div class="metric-card">
        <div class="metric-label">Valor total</div>
        <div class="metric-value" style="font-size:36px;margin-top:8px">
            ${{ number_format(\App\Models\Product::sum('price'), 0) }}
        </div>
        <div class="metric-sub">en inventario</div>
        <div class="metric-icon">$</div>
    </div>
    <div class="metric-card">
        <div class="metric-label">Estado</div>
        <div class="metric-value" style="color:var(--green);font-size:36px;margin-top:8px">LIVE</div>
        <div class="metric-sub">sistema activo</div>
        <div class="metric-icon">◉</div>
    </div>
</div>

{{-- Últimos productos --}}
<div class="section-header">
    <span class="section-title">Últimos productos agregados</span>
    <a href="{{ route('product.index') }}" class="section-link">Ver todos →</a>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($ultimosProductos as $p)
        <tr>
            <td class="td-id">#{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</td>
            <td class="td-name">{{ $p->name }}</td>
            <td class="td-price">${{ number_format($p->price, 2) }}</td>
            <td>{{ $p->category->name ?? '—' }}</td>
            <td>
                <div class="td-actions">
                    <a href="{{ route('product.show', $p->id) }}" class="tbl-btn">Ver</a>
                    <form action="{{ route('product.destroy', $p) }}" method="POST" style="display:inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="tbl-btn danger">Eliminar</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="empty-table">No hay productos aún.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection
