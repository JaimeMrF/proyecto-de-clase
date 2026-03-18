@extends('layouts.admin')

@section('title', 'Categorías')
@section('page-title', 'Categorías')

@push('styles')
<style>
    .page-header {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-bottom: 28px;
    }
    .page-header h1 {
        font-family: var(--font-display);
        font-size: 42px;
        letter-spacing: 0.04em;
        line-height: 1;
    }
    .page-header h1 span { color: var(--accent); }
    .btn-primary {
        background: var(--accent);
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        font-size: 13px;
        font-weight: 600;
        font-family: var(--font-sans);
        transition: background .12s;
    }
    .btn-primary:hover { background: var(--accent2); }

    .alert-success {
        background: rgba(61,220,132,.1);
        border: 1px solid rgba(61,220,132,.3);
        color: var(--green);
        padding: 12px 16px;
        font-family: var(--font-mono);
        font-size: 12px;
        margin-bottom: 24px;
    }

    .admin-table { width: 100%; border-collapse: collapse; border: 1px solid var(--border); }
    .admin-table th {
        background: var(--surface2);
        padding: 12px 16px;
        text-align: left;
        font-family: var(--font-mono);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--text-faint);
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
    .td-name { color: var(--text); font-weight: 500; }
    .td-id { font-family: var(--font-mono); font-size: 11px; color: var(--text-faint); }
    .td-count {
        font-family: var(--font-mono);
        font-size: 12px;
        color: var(--gold);
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

<div class="page-header">
    <h1>Cate<span>gorías</span></h1>
    <a href="{{ route('admin.categories.create') }}" class="btn-primary">+ Nueva categoría</a>
</div>

@if(session('success'))
    <div class="alert-success">✓ {{ session('success') }}</div>
@endif

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Productos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $cat)
        <tr>
            <td class="td-id">#{{ str_pad($cat->id, 4, '0', STR_PAD_LEFT) }}</td>
            <td class="td-name">{{ $cat->name }}</td>
            <td class="td-count">{{ $cat->products_count }}</td>
            <td>
                <div class="td-actions">
                    <a href="{{ route('admin.categories.edit', $cat) }}" class="tbl-btn">Editar</a>
                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="tbl-btn danger"
                            onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="empty-table">No hay categorías aún.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection