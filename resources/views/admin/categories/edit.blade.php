@extends('layouts.admin')

@section('title', 'Editar Categoría')
@section('page-title', 'Editar Categoría')

@push('styles')
<style>
    .form-card {
        background: var(--surface);
        border: 1px solid var(--border);
        padding: 32px;
        max-width: 520px;
    }
    .form-title {
        font-family: var(--font-display);
        font-size: 36px;
        letter-spacing: 0.04em;
        margin-bottom: 28px;
        line-height: 1;
    }
    .form-title span { color: var(--accent); }
    .form-group { margin-bottom: 20px; }
    .form-label {
        display: block;
        font-family: var(--font-mono);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--text-faint);
        margin-bottom: 8px;
    }
    .form-input {
        width: 100%;
        background: var(--surface2);
        border: 1.5px solid var(--border2);
        color: var(--text);
        padding: 11px 14px;
        font-size: 14px;
        font-family: var(--font-sans);
        outline: none;
        transition: border-color .12s;
    }
    .form-input:focus { border-color: var(--accent); }
    .form-error {
        color: var(--red);
        font-size: 12px;
        font-family: var(--font-mono);
        margin-top: 6px;
    }
    .form-actions { display: flex; gap: 12px; margin-top: 28px; }
    .btn-primary {
        background: var(--accent);
        color: white;
        border: none;
        padding: 12px 28px;
        font-size: 13px;
        font-weight: 600;
        font-family: var(--font-sans);
        cursor: pointer;
        transition: background .12s;
    }
    .btn-primary:hover { background: var(--accent2); }
    .btn-secondary {
        padding: 12px 24px;
        border: 1.5px solid var(--border2);
        background: transparent;
        color: var(--text-muted);
        font-size: 13px;
        font-family: var(--font-sans);
        text-decoration: none;
        transition: all .12s;
    }
    .btn-secondary:hover { border-color: var(--text); color: var(--text); }
</style>
@endpush

@section('content')

<div class="form-card">
    <div class="form-title">Editar <span>Categoría</span></div>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label" for="name">Nombre</label>
            <input class="form-input" type="text" id="name" name="name"
                   value="{{ old('name', $category->name) }}">
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">Guardar cambios</button>
            <a href="{{ route('admin.categories.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

@endsection
