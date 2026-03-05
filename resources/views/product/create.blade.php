@extends('layouts.app')

@section('title', 'Agregar Producto — MiTienda')

@push('styles')
<style>
    .create-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 24px;
        align-items: flex-start;
    }

    /* ── Page header ── */
    .page-header { margin-bottom: 28px; }
    .page-header .section-label {
        font-family: 'Sora', sans-serif;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--accent);
        margin-bottom: 8px;
    }
    .page-header h1 {
        font-family: 'Sora', sans-serif;
        font-size: 28px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 6px;
        line-height: 1.1;
    }
    .page-header p { font-size: 14px; color: var(--text-muted); }

    /* ── Form card ── */
    .form-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        overflow: hidden;
        margin-bottom: 16px;
        transition: border-color .2s;
    }
    .form-card:hover { border-color: var(--border-hover); }

    .form-card-header {
        padding: 18px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid var(--border);
        background: var(--surface2);
    }
    .card-icon {
        width: 36px;
        height: 36px;
        background: var(--accent-soft);
        border: 1px solid rgba(255,107,53,0.2);
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .form-card-header h2 {
        font-family: 'Sora', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: var(--text);
    }
    .form-card-body { padding: 24px; }

    /* ── Form elements ── */
    .form-group {
        margin-bottom: 18px;
    }
    .form-group:last-child { margin-bottom: 0; }

    label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 7px;
    }
    .required { color: var(--accent); margin-left: 2px; }
    .optional { color: var(--text-dim); font-weight: 400; font-size: 12px; }

    input[type="text"],
    input[type="number"],
    input[type="url"],
    textarea,
    select {
        width: 100%;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text);
        font-size: 14px;
        font-family: 'DM Sans', sans-serif;
        padding: 10px 14px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
        -webkit-appearance: none;
    }
    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="url"]:focus,
    textarea:focus,
    select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(255,107,53,0.08);
    }
    input::placeholder,
    textarea::placeholder { color: var(--text-dim); }
    select option { background: var(--surface2); }
    textarea { resize: vertical; line-height: 1.6; }

    .char-counter {
        text-align: right;
        font-size: 11px;
        color: var(--text-dim);
        margin-top: 5px;
    }
    .field-hint {
        font-size: 12px;
        color: var(--text-dim);
        margin-top: 6px;
        line-height: 1.5;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .form-row-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
    }

    /* Input prefix */
    .input-prefix-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }
    .input-prefix {
        position: absolute;
        left: 14px;
        color: var(--text-muted);
        font-size: 14px;
        font-weight: 600;
        pointer-events: none;
        z-index: 1;
    }
    .input-prefix-wrap input { padding-left: 28px; }

    /* ── Upload area ── */
    .upload-area {
        border: 2px dashed var(--border);
        border-radius: var(--radius);
        padding: 40px 24px;
        text-align: center;
        cursor: pointer;
        position: relative;
        transition: border-color .2s, background .2s;
    }
    .upload-area:hover {
        border-color: var(--accent);
        background: var(--accent-soft);
    }
    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }
    .upload-icon { font-size: 40px; margin-bottom: 12px; }
    .upload-text { font-size: 15px; font-weight: 600; color: var(--text-muted); margin-bottom: 6px; }
    .upload-subtext { font-size: 12px; color: var(--text-dim); }

    .upload-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 16px;
    }
    .preview-thumb {
        width: 80px;
        height: 80px;
        border-radius: var(--radius-sm);
        background-size: cover;
        background-position: center;
        border: 1px solid var(--border);
    }

    /* ── Variants ── */
    .variant-row {
        display: flex;
        align-items: flex-end;
        gap: 12px;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 14px;
        margin-bottom: 10px;
    }
    .btn-remove {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--text-dim);
        width: 32px;
        height: 32px;
        border-radius: var(--radius-sm);
        cursor: pointer;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: border-color .2s, color .2s, background .2s;
        font-family: inherit;
    }
    .btn-remove:hover { border-color: var(--red); color: var(--red); background: rgba(255,77,106,0.08); }
    .btn-add-variant {
        background: transparent;
        border: 1px dashed var(--border);
        color: var(--text-muted);
        padding: 10px 16px;
        border-radius: var(--radius-sm);
        cursor: pointer;
        font-size: 13px;
        font-family: inherit;
        transition: border-color .2s, color .2s;
        width: 100%;
        text-align: center;
    }
    .btn-add-variant:hover { border-color: var(--accent); color: var(--accent); }

    /* ── Tags ── */
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        padding: 10px 14px;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        min-height: 46px;
        cursor: text;
        transition: border-color .2s, box-shadow .2s;
    }
    .tags-container:focus-within {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(255,107,53,0.08);
    }
    .tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--accent-soft);
        border: 1px solid rgba(255,107,53,0.3);
        color: var(--accent);
        padding: 3px 10px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
    }
    .tag-remove { cursor: pointer; opacity: 0.7; font-size: 13px; }
    .tag-remove:hover { opacity: 1; }
    .tag-input-hidden {
        background: transparent;
        border: none;
        outline: none;
        color: var(--text);
        font-size: 13px;
        font-family: inherit;
        min-width: 120px;
        flex: 1;
        padding: 0;
        box-shadow: none;
    }

    /* ── Form actions ── */
    .form-actions {
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--accent);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 12px 28px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        transition: background .2s, transform .15s, box-shadow .2s;
        box-shadow: 0 4px 16px rgba(255,107,53,0.3);
    }
    .btn-primary:hover {
        background: #ff8055;
        transform: translateY(-1px);
        box-shadow: 0 6px 24px rgba(255,107,53,0.4);
    }
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--surface2);
        color: var(--text-muted);
        border: 1px solid var(--border);
        border-radius: 50px;
        padding: 12px 24px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        transition: border-color .2s, color .2s;
    }
    .btn-secondary:hover { border-color: var(--border-hover); color: var(--text); }
    .btn-danger {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--text-dim);
        text-decoration: none;
        font-size: 13px;
        margin-left: auto;
        transition: color .2s;
    }
    .btn-danger:hover { color: var(--red); }

    /* ── Sidebar ── */
    .create-sidebar {
        position: sticky;
        top: 90px;
    }
    .sidebar-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 20px;
        margin-bottom: 14px;
    }
    .sidebar-card h3 {
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border);
    }

    /* Progress */
    .progress-wrap { margin-bottom: 16px; }
    .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 8px;
    }
    .progress-label span:first-child { color: var(--text-muted); }
    .progress-label span:last-child { color: var(--accent); font-weight: 700; }
    .progress-bar {
        height: 6px;
        background: var(--surface2);
        border-radius: 3px;
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--accent), var(--accent2));
        border-radius: 3px;
        width: 0%;
        transition: width .4s ease;
    }
    .checklist { list-style: none; }
    .checklist li {
        font-size: 13px;
        color: var(--text-dim);
        padding: 6px 0;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: color .2s;
    }
    .checklist li::before {
        content: '○';
        font-size: 14px;
        color: var(--text-dim);
        flex-shrink: 0;
        transition: content .2s, color .2s;
    }
    .checklist li.done { color: var(--green); }
    .checklist li.done::before { content: '✓'; color: var(--green); }

    /* Toggles */
    .toggle-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 13px;
        font-size: 13px;
        color: var(--text-muted);
    }
    .toggle-wrap:last-child { margin-bottom: 0; }
    .toggle { position: relative; display: inline-block; width: 38px; height: 22px; flex-shrink: 0; }
    .toggle input { opacity: 0; width: 0; height: 0; }
    .toggle-slider {
        position: absolute;
        inset: 0;
        background: var(--surface3);
        border-radius: 11px;
        cursor: pointer;
        transition: background .2s;
        border: 1px solid var(--border);
    }
    .toggle-slider::before {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        background: var(--text-dim);
        border-radius: 50%;
        top: 2px;
        left: 2px;
        transition: transform .2s, background .2s;
    }
    .toggle input:checked + .toggle-slider { background: var(--accent-soft); border-color: rgba(255,107,53,0.4); }
    .toggle input:checked + .toggle-slider::before { transform: translateX(16px); background: var(--accent); }

    /* Status */
    .publish-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 13px;
        color: var(--text-muted);
    }
    .publish-option:last-child { margin-bottom: 0; }
    .status-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-badge.draft {
        background: rgba(122,122,150,0.15);
        border: 1px solid var(--border);
        color: var(--text-dim);
    }
    .status-badge.published {
        background: rgba(61,220,132,0.12);
        border: 1px solid rgba(61,220,132,0.3);
        color: var(--green);
    }

    /* Tips */
    .tip-box {
        background: var(--surface);
        border: 1px solid var(--border);
        border-left: 3px solid var(--accent);
        border-radius: var(--radius);
        padding: 16px;
        margin-bottom: 14px;
    }
    .tip-box.tip-yellow { border-left-color: var(--accent2); }
    .tip-box h4 {
        font-size: 13px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 7px;
    }
    .tip-box p { font-size: 12px; color: var(--text-muted); line-height: 1.6; }

    /* Publish select */
    .publish-option select {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-muted);
        font-size: 12px;
        padding: 4px 8px;
        width: auto;
        font-family: inherit;
    }

    @media (max-width: 900px) {
        .create-layout { grid-template-columns: 1fr; }
        .create-sidebar { position: static; }
        .form-row-3 { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 600px) {
        .form-row { grid-template-columns: 1fr; }
        .form-row-3 { grid-template-columns: 1fr; }
        .form-actions { flex-direction: column; align-items: stretch; }
        .btn-danger { margin-left: 0; justify-content: center; }
    }
</style>
@endpush

@section('content')

    <div class="breadcrumb">
        <a href="/">Inicio</a>
        <span>›</span>
        <a href="/product">Productos</a>
        <span>›</span>
        <strong>Nuevo Producto</strong>
    </div>

    <div class="page-header">
        <div class="section-label">✦ Vendedor</div>
        <h1>Agregar Nuevo Producto</h1>
        <p>Completa la información para publicar tu producto en MiTienda.</p>
    </div>

    <div class="create-layout">

        {{-- ═══ MAIN FORM ═══ --}}
        <div class="create-main">
            <form action="/product" method="POST" enctype="multipart/form-data" id="product-form">
                @csrf

                {{-- Información Básica --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon">📦</div>
                        <h2>Información Básica</h2>
                    </div>
                    <div class="form-card-body">
                        <div class="form-group">
                            <label for="nombre">Nombre del Producto <span class="required">*</span></label>
                            <input type="text" id="nombre" name="nombre" maxlength="200"
                                   placeholder='Ej: Laptop UltraBook Pro 15" Intel Core i7, 16GB RAM'
                                   oninput="updateCharCount(this,'nombre-count',200); updateProgress()">
                            <div class="char-counter"><span id="nombre-count">0</span> / 200</div>
                        </div>
                        <div class="form-row">
                            <div class="form-group" style="margin-bottom:0">
                                <label for="categoria">Categoría <span class="required">*</span></label>
                                <select id="categoria" name="categoria" onchange="updateProgress()">
                                    <option value="">Seleccionar categoría...</option>
                                    <optgroup label="Electrónica">
                                        <option>Laptops y Computadoras</option>
                                        <option>Smartphones</option>
                                        <option>Audio y Sonido</option>
                                        <option>Cámaras</option>
                                    </optgroup>
                                    <optgroup label="Ropa y Moda">
                                        <option>Ropa Hombre</option>
                                        <option>Ropa Mujer</option>
                                        <option>Calzado</option>
                                    </optgroup>
                                    <optgroup label="Hogar">
                                        <option>Muebles</option>
                                        <option>Cocina</option>
                                        <option>Decoración</option>
                                    </optgroup>
                                    <optgroup label="Deportes">
                                        <option>Fitness</option>
                                        <option>Ciclismo</option>
                                        <option>Outdoor</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <label for="marca">Marca <span class="optional">(opcional)</span></label>
                                <input type="text" id="marca" name="marca" placeholder="Ej: Samsung, Nike, Apple...">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon">📝</div>
                        <h2>Descripción y Características</h2>
                    </div>
                    <div class="form-card-body">
                        <div class="form-group">
                            <label for="descripcion">Descripción <span class="required">*</span></label>
                            <textarea id="descripcion" name="descripcion" rows="5" maxlength="5000"
                                      placeholder="Describe tu producto: características, materiales, usos..."
                                      oninput="updateCharCount(this,'desc-count',5000); updateProgress()"></textarea>
                            <div class="char-counter"><span id="desc-count">0</span> / 5,000</div>
                        </div>
                        <div class="form-group">
                            <label>Características Destacadas <span class="optional">(una por línea)</span></label>
                            <textarea name="caracteristicas" rows="4"
                                      placeholder="• Procesador Intel Core i7&#10;• 16GB RAM DDR5&#10;• Pantalla Full HD 15.6&quot;&#10;• Batería 72Wh"></textarea>
                            <div class="field-hint">Usa viñetas para que los compradores escaneen rápido las características clave.</div>
                        </div>
                    </div>
                </div>

                {{-- Precio e Inventario --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon">💰</div>
                        <h2>Precio e Inventario</h2>
                    </div>
                    <div class="form-card-body">
                        <div class="form-row-3">
                            <div class="form-group" style="margin-bottom:0">
                                <label for="precio">Precio <span class="required">*</span></label>
                                <div class="input-prefix-wrap">
                                    <span class="input-prefix">$</span>
                                    <input type="number" id="precio" name="precio" min="0" step="0.01" placeholder="0.00"
                                           oninput="updateProgress()">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <label for="precio_original">Precio Original <span class="optional">(sin dto.)</span></label>
                                <div class="input-prefix-wrap">
                                    <span class="input-prefix">$</span>
                                    <input type="number" id="precio_original" name="precio_original" min="0" step="0.01" placeholder="0.00">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <label for="stock">Stock <span class="required">*</span></label>
                                <input type="number" id="stock" name="stock" min="0" placeholder="0"
                                       oninput="updateProgress()">
                            </div>
                        </div>
                        <div class="form-row" style="margin-top:16px">
                            <div class="form-group" style="margin-bottom:0">
                                <label for="sku">SKU / Código <span class="optional">(opcional)</span></label>
                                <input type="text" id="sku" name="sku" placeholder="Ej: LAPTOP-001-X7">
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <label for="moneda">Moneda</label>
                                <select id="moneda" name="moneda">
                                    <option>COP — Peso Colombiano</option>
                                    <option>USD — Dólar Americano</option>
                                    <option>EUR — Euro</option>
                                    <option>MXN — Peso Mexicano</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Imágenes --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon">🖼️</div>
                        <h2>Imágenes del Producto</h2>
                    </div>
                    <div class="form-card-body">
                        <div class="upload-area">
                            <input type="file" name="imagenes[]" multiple accept="image/*" onchange="previewImages(this)">
                            <div class="upload-icon">📸</div>
                            <div class="upload-text">Arrastra imágenes o haz clic para seleccionar</div>
                            <div class="upload-subtext">PNG, JPG, WEBP · máx. 10MB por imagen · mín. 500×500px</div>
                        </div>
                        <div class="upload-preview" id="image-preview"></div>
                        <div class="field-hint" style="margin-top:12px">
                            La primera imagen será la imagen principal. Puedes subir hasta 9.
                        </div>
                    </div>
                </div>

                {{-- Variantes --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon">🎨</div>
                        <h2>Variantes <span style="font-size:12px;font-weight:400;color:var(--text-dim)">(opcional)</span></h2>
                    </div>
                    <div class="form-card-body">
                        <div id="variants-container">
                            <div class="variant-row">
                                <div style="flex:1">
                                    <label style="font-size:12px;margin-bottom:6px">Tipo</label>
                                    <select name="variante_tipo[]">
                                        <option>Color</option>
                                        <option>Talla</option>
                                        <option>Capacidad</option>
                                        <option>Material</option>
                                    </select>
                                </div>
                                <div style="flex:2">
                                    <label style="font-size:12px;margin-bottom:6px">Valores (separados por coma)</label>
                                    <input type="text" name="variante_valores[]" placeholder="Rojo, Azul, Verde, Negro">
                                </div>
                                <div style="padding-top:22px">
                                    <button type="button" class="btn-remove" onclick="removeVariant(this)">✕</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-add-variant" onclick="addVariant()">
                            + Añadir variante
                        </button>
                    </div>
                </div>

                {{-- Envío y Adicionales --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon">🚚</div>
                        <h2>Envío y Detalles Adicionales</h2>
                    </div>
                    <div class="form-card-body">
                        <div class="form-row-3">
                            <div class="form-group">
                                <label for="peso">Peso <span class="optional">(kg)</span></label>
                                <input type="number" id="peso" name="peso" min="0" step="0.01" placeholder="0.00">
                            </div>
                            <div class="form-group">
                                <label for="largo">Largo <span class="optional">(cm)</span></label>
                                <input type="number" id="largo" name="largo" min="0" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label for="ancho">Ancho <span class="optional">(cm)</span></label>
                                <input type="number" id="ancho" name="ancho" min="0" placeholder="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Etiquetas / Tags <span class="optional">(Enter para añadir)</span></label>
                            <div class="tags-container" id="tags-container" onclick="document.getElementById('tag-input').focus()">
                                <input type="text" id="tag-input" class="tag-input-hidden"
                                       placeholder="laptop, gaming, oferta..."
                                       onkeydown="handleTagInput(event)">
                            </div>
                            <input type="hidden" name="tags" id="tags-hidden">
                        </div>
                        <div class="form-group" style="margin-bottom:0">
                            <label for="url_video">Video del Producto <span class="optional">(YouTube / Vimeo)</span></label>
                            <input type="url" id="url_video" name="url_video" placeholder="https://youtube.com/watch?v=...">
                        </div>
                    </div>
                </div>

                {{-- Acciones --}}
                <div class="form-card">
                    <div class="form-actions">
                        <button type="submit" class="btn-primary" name="estado" value="publicado">
                            🚀 Publicar Producto
                        </button>
                        <button type="submit" class="btn-secondary" name="estado" value="borrador">
                            💾 Guardar Borrador
                        </button>
                        <a href="/product" class="btn-danger">✕ Cancelar</a>
                    </div>
                </div>

            </form>
        </div>

        {{-- ═══ SIDEBAR ═══ --}}
        <aside class="create-sidebar">

            <div class="sidebar-card">
                <h3>Progreso del Listado</h3>
                <div class="progress-wrap">
                    <div class="progress-label">
                        <span>Completado</span>
                        <span id="progress-pct">0%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                </div>
                <ul class="checklist">
                    <li id="chk-nombre">Nombre del producto</li>
                    <li id="chk-categoria">Categoría seleccionada</li>
                    <li id="chk-descripcion">Descripción añadida</li>
                    <li id="chk-precio">Precio definido</li>
                    <li id="chk-stock">Stock indicado</li>
                </ul>
            </div>

            <div class="sidebar-card">
                <h3>Opciones de Publicación</h3>
                <div class="toggle-wrap">
                    <span>Destacado</span>
                    <label class="toggle"><input type="checkbox" name="destacado"><span class="toggle-slider"></span></label>
                </div>
                <div class="toggle-wrap">
                    <span>Envío Prime</span>
                    <label class="toggle"><input type="checkbox" name="prime" checked><span class="toggle-slider"></span></label>
                </div>
                <div class="toggle-wrap">
                    <span>Disponible en tienda</span>
                    <label class="toggle"><input type="checkbox" name="tienda"><span class="toggle-slider"></span></label>
                </div>
                <div class="toggle-wrap">
                    <span>Permitir reseñas</span>
                    <label class="toggle"><input type="checkbox" name="resenas" checked><span class="toggle-slider"></span></label>
                </div>
            </div>

            <div class="sidebar-card">
                <h3>Estado de Publicación</h3>
                <div class="publish-option">
                    <span>Visibilidad</span>
                    <select style="width:auto;padding:4px 8px;font-size:12px;">
                        <option>Público</option>
                        <option>Privado</option>
                        <option>Solo con enlace</option>
                    </select>
                </div>
                <div class="publish-option">
                    <span>Estado</span>
                    <span class="status-badge draft" id="status-badge">Borrador</span>
                </div>
                <div class="publish-option">
                    <span>Publicar</span>
                    <span style="font-size:12px;color:var(--text-dim)">Inmediatamente</span>
                </div>
            </div>

            <div class="tip-box">
                <h4>💡 Consejo Pro</h4>
                <p>Productos con 5+ imágenes de alta calidad venden un 40% más. Usa fondo blanco para la imagen principal.</p>
            </div>

            <div class="tip-box tip-yellow">
                <h4>🌟 Visibilidad</h4>
                <p>Incluye palabras clave en el nombre y descripción para aparecer en más búsquedas.</p>
            </div>

        </aside>
    </div>

    <script>
        function updateCharCount(el, spanId, max) {
            const span = document.getElementById(spanId);
            span.textContent = el.value.length.toLocaleString();
            span.style.color = el.value.length > max * .9 ? 'var(--red)' : '';
        }

        function updateProgress() {
            const checks = {
                'chk-nombre':      document.getElementById('nombre').value.trim().length > 0,
                'chk-categoria':   document.getElementById('categoria').value !== '',
                'chk-descripcion': document.getElementById('descripcion').value.trim().length > 30,
                'chk-precio':      parseFloat(document.getElementById('precio').value) > 0,
                'chk-stock':       document.getElementById('stock').value !== '',
            };
            let done = 0;
            for (const [id, val] of Object.entries(checks)) {
                const li = document.getElementById(id);
                val ? li.classList.add('done') : li.classList.remove('done');
                if (val) done++;
            }
            const pct = Math.round((done / Object.keys(checks).length) * 100);
            document.getElementById('progress-fill').style.width = pct + '%';
            document.getElementById('progress-pct').textContent = pct + '%';
        }

        function previewImages(input) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            Array.from(input.files).slice(0, 9).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const thumb = document.createElement('div');
                    thumb.className = 'preview-thumb';
                    thumb.style.backgroundImage = `url(${e.target.result})`;
                    preview.appendChild(thumb);
                };
                reader.readAsDataURL(file);
            });
        }

        function addVariant() {
            const container = document.getElementById('variants-container');
            const row = container.children[0].cloneNode(true);
            row.querySelectorAll('input').forEach(i => i.value = '');
            container.appendChild(row);
        }
        function removeVariant(btn) {
            const container = document.getElementById('variants-container');
            if (container.children.length > 1) btn.closest('.variant-row').remove();
        }

        const tags = [];
        function handleTagInput(e) {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                const val = e.target.value.trim().replace(/,$/, '');
                if (val && !tags.includes(val)) {
                    tags.push(val);
                    renderTag(val);
                    e.target.value = '';
                    document.getElementById('tags-hidden').value = tags.join(',');
                }
            }
            if (e.key === 'Backspace' && e.target.value === '' && tags.length) {
                const last = tags.pop();
                document.querySelector(`.tag[data-val="${CSS.escape(last)}"]`)?.remove();
                document.getElementById('tags-hidden').value = tags.join(',');
            }
        }
        function renderTag(val) {
            const container = document.getElementById('tags-container');
            const el = document.createElement('span');
            el.className = 'tag'; el.dataset.val = val;
            el.innerHTML = `${val} <span class="tag-remove" onclick="removeTag('${val}')">×</span>`;
            container.insertBefore(el, document.getElementById('tag-input'));
        }
        function removeTag(val) {
            const i = tags.indexOf(val);
            if (i > -1) tags.splice(i, 1);
            document.querySelector(`.tag[data-val="${CSS.escape(val)}"]`)?.remove();
            document.getElementById('tags-hidden').value = tags.join(',');
        }

        document.querySelectorAll('[name="estado"]').forEach(btn => {
            btn.addEventListener('click', () => {
                const badge = document.getElementById('status-badge');
                if (btn.value === 'publicado') {
                    badge.textContent = 'Publicado';
                    badge.classList.remove('draft');
                    badge.classList.add('published');
                } else {
                    badge.textContent = 'Borrador';
                    badge.classList.remove('published');
                    badge.classList.add('draft');
                }
            });
        });
    </script>

@endsection