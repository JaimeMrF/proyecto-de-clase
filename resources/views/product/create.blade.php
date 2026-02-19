@extends('layouts.app')

@section('title', 'Agregar Producto — MiTienda')

@push('styles')
<style>
    /* ── Breadcrumb ── */
    .breadcrumb {
        font-size: 13px;
        color: var(--amazon-muted);
        margin-bottom: 20px;
    }
    .breadcrumb a { color: var(--amazon-link); text-decoration: none; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb span { margin: 0 5px; color: #999; }

    /* ── Layout ── */
    .create-layout {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    /* ── Panel principal ── */
    .create-main { flex: 1; }

    .page-title {
        font-size: 24px;
        font-weight: 400;
        color: var(--amazon-text);
        margin-bottom: 4px;
    }
    .page-subtitle {
        font-size: 13px;
        color: var(--amazon-muted);
        margin-bottom: 20px;
    }

    /* ── Cards de sección ── */
    .form-card {
        background: #fff;
        border: 1px solid var(--amazon-border);
        border-radius: 4px;
        margin-bottom: 16px;
        overflow: hidden;
    }
    .form-card-header {
        padding: 14px 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-card-header h2 {
        font-size: 17px;
        font-weight: 700;
        color: var(--amazon-text);
    }
    .card-icon {
        width: 28px; height: 28px;
        background: var(--amazon-orange);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }
    .form-card-body { padding: 20px; }

    /* ── Campos ── */
    .form-group {
        margin-bottom: 18px;
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
    label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: var(--amazon-text);
        margin-bottom: 6px;
    }
    label .required {
        color: var(--amazon-red);
        margin-left: 2px;
    }
    label .optional {
        color: var(--amazon-muted);
        font-weight: 400;
        font-size: 12px;
        margin-left: 4px;
    }
    .field-hint {
        font-size: 12px;
        color: var(--amazon-muted);
        margin-top: 4px;
    }

    input[type="text"],
    input[type="number"],
    input[type="url"],
    select,
    textarea {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #adb5bd;
        border-radius: 3px;
        font-size: 14px;
        font-family: inherit;
        color: var(--amazon-text);
        background: #fff;
        transition: border-color .15s, box-shadow .15s;
        outline: none;
    }
    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="url"]:focus,
    select:focus,
    textarea:focus {
        border-color: var(--amazon-orange-btn);
        box-shadow: 0 0 0 3px rgba(255,153,0,.25);
    }
    input[type="text"]::placeholder,
    input[type="number"]::placeholder,
    textarea::placeholder { color: #aaa; }
    textarea { resize: vertical; min-height: 100px; }

    .char-counter {
        text-align: right;
        font-size: 11px;
        color: var(--amazon-muted);
        margin-top: 3px;
    }

    /* ── Price input con símbolo ── */
    .input-prefix-wrap {
        display: flex;
        align-items: center;
    }
    .input-prefix {
        background: #f3f3f3;
        border: 1px solid #adb5bd;
        border-right: none;
        padding: 8px 10px;
        border-radius: 3px 0 0 3px;
        font-size: 14px;
        color: #555;
        flex-shrink: 0;
    }
    .input-prefix-wrap input {
        border-radius: 0 3px 3px 0;
    }

    /* ── Upload de imagen ── */
    .upload-area {
        border: 2px dashed #adb5bd;
        border-radius: 6px;
        padding: 36px 20px;
        text-align: center;
        cursor: pointer;
        transition: border-color .15s, background .15s;
        position: relative;
    }
    .upload-area:hover {
        border-color: var(--amazon-orange-btn);
        background: #fffbf2;
    }
    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }
    .upload-icon { font-size: 40px; margin-bottom: 10px; }
    .upload-text {
        font-size: 15px;
        font-weight: 700;
        color: var(--amazon-link);
        margin-bottom: 4px;
    }
    .upload-subtext { font-size: 13px; color: var(--amazon-muted); }
    .upload-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 14px;
    }
    .preview-thumb {
        width: 80px; height: 80px;
        background: #f6f6f6;
        border: 1px solid #ddd;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        position: relative;
    }

    /* ── Variantes ── */
    .variant-row {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 10px;
        padding: 12px;
        background: #f9f9f9;
        border-radius: 4px;
        border: 1px solid #eee;
    }
    .variant-row input, .variant-row select {
        margin: 0;
    }
    .btn-remove {
        background: none;
        border: 1px solid #ddd;
        border-radius: 3px;
        padding: 8px 10px;
        cursor: pointer;
        color: var(--amazon-muted);
        font-size: 14px;
        flex-shrink: 0;
        transition: color .15s, border-color .15s;
    }
    .btn-remove:hover { color: var(--amazon-red); border-color: var(--amazon-red); }
    .btn-add-variant {
        background: none;
        border: 1px dashed var(--amazon-link);
        border-radius: 3px;
        color: var(--amazon-link);
        padding: 8px 16px;
        font-size: 13px;
        cursor: pointer;
        transition: background .15s;
        width: 100%;
        margin-top: 6px;
    }
    .btn-add-variant:hover { background: #f0f8fa; }

    /* ── SEO / Tags ── */
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding: 8px;
        border: 1px solid #adb5bd;
        border-radius: 3px;
        min-height: 42px;
        background: #fff;
        cursor: text;
    }
    .tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #e8f4f8;
        border: 1px solid #b8d8e3;
        border-radius: 12px;
        padding: 3px 10px;
        font-size: 13px;
        color: #0a7fa0;
    }
    .tag-remove { cursor: pointer; font-size: 14px; line-height: 1; }
    .tag-remove:hover { color: var(--amazon-red); }
    .tag-input-hidden {
        border: none !important;
        outline: none !important;
        padding: 4px 6px !important;
        font-size: 13px;
        flex: 1;
        min-width: 100px;
        box-shadow: none !important;
    }

    /* ── Sidebar ── */
    .create-sidebar {
        width: 260px;
        flex-shrink: 0;
    }
    .sidebar-card {
        background: #fff;
        border: 1px solid var(--amazon-border);
        border-radius: 4px;
        padding: 18px;
        margin-bottom: 14px;
    }
    .sidebar-card h3 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 14px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eee;
    }

    /* ── Publicar ── */
    .publish-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
        font-size: 13px;
    }
    .publish-option:last-child { border-bottom: none; }
    .status-badge {
        background: #eaf5ea;
        color: #1e7e34;
        border: 1px solid #c3e6c3;
        border-radius: 12px;
        padding: 2px 10px;
        font-size: 12px;
        font-weight: 700;
    }
    .status-badge.draft {
        background: #fff8e1;
        color: #856404;
        border-color: #ffeaa7;
    }

    /* ── Toggle switch ── */
    .toggle-wrap {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 13px;
    }
    .toggle {
        position: relative;
        width: 40px; height: 22px;
        flex-shrink: 0;
    }
    .toggle input { display: none; }
    .toggle-slider {
        position: absolute;
        inset: 0;
        background: #ccc;
        border-radius: 22px;
        cursor: pointer;
        transition: background .2s;
    }
    .toggle-slider::before {
        content: '';
        position: absolute;
        left: 2px; top: 2px;
        width: 18px; height: 18px;
        background: #fff;
        border-radius: 50%;
        transition: transform .2s;
    }
    .toggle input:checked + .toggle-slider { background: var(--amazon-orange-btn); }
    .toggle input:checked + .toggle-slider::before { transform: translateX(18px); }

    /* ── Botones principales ── */
    .form-actions {
        display: flex;
        gap: 10px;
        padding: 18px 20px;
        background: #f9f9f9;
        border-top: 1px solid #eee;
    }
    .btn-primary {
        background: var(--amazon-orange-btn);
        border: 1px solid #a88734;
        border-radius: 4px;
        padding: 10px 28px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        color: var(--amazon-text);
        transition: background .15s, box-shadow .15s;
        flex: 1;
    }
    .btn-primary:hover { background: #e68a00; box-shadow: 0 2px 6px rgba(0,0,0,.15); }
    .btn-secondary {
        background: #fff;
        border: 1px solid #adb5bd;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
        color: var(--amazon-text);
        transition: background .15s, border-color .15s;
    }
    .btn-secondary:hover { background: #f7f7f7; border-color: #999; }
    .btn-danger {
        background: #fff;
        border: 1px solid #adb5bd;
        border-radius: 4px;
        padding: 10px 16px;
        font-size: 14px;
        cursor: pointer;
        color: var(--amazon-red);
        transition: background .15s;
    }
    .btn-danger:hover { background: #fef0f0; border-color: var(--amazon-red); }

    /* ── Tips ── */
    .tip-box {
        background: #e8f4f8;
        border-left: 4px solid var(--amazon-blue);
        border-radius: 0 4px 4px 0;
        padding: 12px 14px;
        margin-bottom: 14px;
    }
    .tip-box h4 { font-size: 13px; font-weight: 700; margin-bottom: 4px; color: #0a5f6a; }
    .tip-box p { font-size: 12px; color: #0a5f6a; line-height: 1.5; }

    .checklist { list-style: none; }
    .checklist li {
        font-size: 12px;
        color: var(--amazon-muted);
        padding: 3px 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .checklist li::before { content: '○'; color: #ccc; }
    .checklist li.done { color: #067d62; }
    .checklist li.done::before { content: '✓'; color: #067d62; }

    /* ── Progreso ── */
    .progress-wrap { margin-bottom: 8px; }
    .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        color: var(--amazon-muted);
        margin-bottom: 4px;
    }
    .progress-bar {
        height: 8px;
        background: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        width: 0%;
        background: var(--amazon-orange-btn);
        border-radius: 4px;
        transition: width .4s;
    }

    @media (max-width: 900px) {
        .create-sidebar { display: none; }
        .form-row-3 { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 600px) {
        .form-row, .form-row-3 { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="/">Inicio</a>
        <span>›</span>
        <a href="/product">Productos</a>
        <span>›</span>
        <strong>Agregar Nuevo Producto</strong>
    </div>

    <div class="create-layout">

        {{-- ═══ MAIN FORM ═══ --}}
        <div class="create-main">
            <h1 class="page-title">Agregar Nuevo Producto</h1>
            <p class="page-subtitle">Completa la información para publicar tu producto en MiTienda.</p>

            <form action="/product" method="POST" enctype="multipart/form-data" id="product-form">
                @csrf

                {{-- ──────── Información Básica ──────── --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon">📦</div>
                        <h2>Información Básica</h2>
                    </div>
                    <div class="form-card-body">

                        <div class="form-group">
                            <label for="nombre">Nombre del Producto <span class="required">*</span></label>
                            <input type="text" id="nombre" name="nombre" maxlength="200"
                                   placeholder="Ej: Laptop UltraBook Pro 15&quot; Intel Core i7, 16GB RAM"
                                   oninput="updateCharCount(this, 'nombre-count', 200); updateProgress()">
                            <div class="char-counter"><span id="nombre-count">0</span>/200 caracteres</div>
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
                                        <option>Cámaras y Fotografía</option>
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

                {{-- ──────── Descripción ──────── --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon">📝</div>
                        <h2>Descripción y Características</h2>
                    </div>
                    <div class="form-card-body">

                        <div class="form-group">
                            <label for="descripcion">Descripción del Producto <span class="required">*</span></label>
                            <textarea id="descripcion" name="descripcion" rows="5" maxlength="5000"
                                      placeholder="Describe tu producto en detalle: características principales, materiales, usos, etc."
                                      oninput="updateCharCount(this, 'desc-count', 5000); updateProgress()"></textarea>
                            <div class="char-counter"><span id="desc-count">0</span>/5,000 caracteres</div>
                        </div>

                        <div class="form-group">
                            <label>Características Destacadas <span class="optional">(una por línea)</span></label>
                            <textarea name="caracteristicas" rows="5"
                                      placeholder="• Procesador Intel Core i7 de 12ª generación&#10;• 16GB RAM DDR5&#10;• Pantalla Full HD IPS 15.6&quot;&#10;• Batería de larga duración 72Wh"></textarea>
                            <div class="field-hint">Usa viñetas para que los compradores puedan escanear rápidamente las características.</div>
                        </div>

                    </div>
                </div>

                {{-- ──────── Precio e Inventario ──────── --}}
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
                                    <input type="number" id="precio" name="precio"
                                           min="0" step="0.01" placeholder="0.00"
                                           oninput="updateProgress()">
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <label for="precio_original">Precio Original <span class="optional">(opcional)</span></label>
                                <div class="input-prefix-wrap">
                                    <span class="input-prefix">$</span>
                                    <input type="number" id="precio_original" name="precio_original"
                                           min="0" step="0.01" placeholder="0.00">
                                </div>
                                <div class="field-hint">Para mostrar el descuento</div>
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <label for="stock">Stock <span class="required">*</span></label>
                                <input type="number" id="stock" name="stock"
                                       min="0" placeholder="0"
                                       oninput="updateProgress()">
                            </div>
                        </div>

                        <div style="margin-top:16px;" class="form-row">
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

                {{-- ──────── Imágenes ──────── --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon">🖼️</div>
                        <h2>Imágenes del Producto</h2>
                    </div>
                    <div class="form-card-body">
                        <div class="upload-area" id="upload-area">
                            <input type="file" name="imagenes[]" multiple accept="image/*" onchange="previewImages(this)">
                            <div class="upload-icon">📸</div>
                            <div class="upload-text">Arrastra imágenes aquí o haz clic para seleccionar</div>
                            <div class="upload-subtext">PNG, JPG, WEBP — máx. 10MB por imagen — mín. 500×500px recomendado</div>
                        </div>
                        <div class="upload-preview" id="image-preview"></div>
                        <div class="field-hint" style="margin-top:10px;">
                            La primera imagen será la imagen principal del producto. Puedes subir hasta 9 imágenes.
                        </div>
                    </div>
                </div>

                {{-- ──────── Variantes ──────── --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon">🎨</div>
                        <h2>Variantes <span style="font-size:13px;font-weight:400;color:#666;">(opcional)</span></h2>
                    </div>
                    <div class="form-card-body">
                        <div id="variants-container">
                            <div class="variant-row">
                                <div style="flex:1">
                                    <label style="font-size:12px;margin-bottom:4px;">Tipo</label>
                                    <select name="variante_tipo[]">
                                        <option>Color</option>
                                        <option>Talla</option>
                                        <option>Capacidad</option>
                                        <option>Material</option>
                                    </select>
                                </div>
                                <div style="flex:2">
                                    <label style="font-size:12px;margin-bottom:4px;">Valores (separados por coma)</label>
                                    <input type="text" name="variante_valores[]" placeholder="Rojo, Azul, Verde, Negro">
                                </div>
                                <div style="padding-top:20px;">
                                    <button type="button" class="btn-remove" onclick="removeVariant(this)">✕</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-add-variant" onclick="addVariant()">
                            + Añadir otra variante
                        </button>
                    </div>
                </div>

                {{-- ──────── SEO / Envío ──────── --}}
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
                            <label>Etiquetas / Tags <span class="optional">(presiona Enter para añadir)</span></label>
                            <div class="tags-container" id="tags-container" onclick="document.getElementById('tag-input').focus()">
                                <input type="text" id="tag-input" class="tag-input-hidden"
                                       placeholder="laptop, gaming, oferta..."
                                       onkeydown="handleTagInput(event)">
                            </div>
                            <input type="hidden" name="tags" id="tags-hidden">
                        </div>

                        <div class="form-group" style="margin-bottom:0">
                            <label for="url_video">URL de Video del Producto <span class="optional">(YouTube/Vimeo)</span></label>
                            <input type="url" id="url_video" name="url_video" placeholder="https://youtube.com/watch?v=...">
                        </div>
                    </div>
                </div>

                {{-- ──────── Acciones ──────── --}}
                <div class="form-card">
                    <div class="form-actions">
                        <button type="submit" class="btn-primary" name="estado" value="publicado">
                            🚀 Publicar Producto
                        </button>
                        <button type="submit" class="btn-secondary" name="estado" value="borrador">
                            💾 Guardar Borrador
                        </button>
                        <a href="/product"><button type="button" class="btn-danger">✕ Cancelar</button></a>
                    </div>
                </div>

            </form>
        </div>

        {{-- ═══ SIDEBAR ═══ --}}
        <aside class="create-sidebar">

            {{-- Progreso --}}
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
                <ul class="checklist" id="checklist">
                    <li id="chk-nombre">Nombre del producto</li>
                    <li id="chk-categoria">Categoría seleccionada</li>
                    <li id="chk-descripcion">Descripción añadida</li>
                    <li id="chk-precio">Precio definido</li>
                    <li id="chk-stock">Stock indicado</li>
                </ul>
            </div>

            {{-- Opciones de publicación --}}
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
                <div class="toggle-wrap" style="margin-bottom:0">
                    <span>Permitir reseñas</span>
                    <label class="toggle"><input type="checkbox" name="resenas" checked><span class="toggle-slider"></span></label>
                </div>
            </div>

            {{-- Estado --}}
            <div class="sidebar-card">
                <h3>Estado</h3>
                <div class="publish-option">
                    <span>Visibilidad</span>
                    <select style="width:auto;padding:3px 6px;font-size:12px;border:1px solid #ddd;">
                        <option>Público</option>
                        <option>Privado</option>
                        <option>Solo con enlace</option>
                    </select>
                </div>
                <div class="publish-option">
                    <span>Estado</span>
                    <span class="status-badge draft">Borrador</span>
                </div>
                <div class="publish-option">
                    <span>Publicar</span>
                    <span style="font-size:12px;color:var(--amazon-muted)">Inmediatamente</span>
                </div>
            </div>

            {{-- Tips --}}
            <div class="tip-box">
                <h4>💡 Consejo Pro</h4>
                <p>Los productos con al menos 5 imágenes de alta calidad venden un 40% más. Usa fondo blanco para la imagen principal.</p>
            </div>

            <div class="tip-box" style="background:#fff8e1;border-color:#f0c14b;">
                <h4 style="color:#665c00">🌟 Visibilidad</h4>
                <p style="color:#665c00">Añade palabras clave relevantes en el nombre y descripción para aparecer en más búsquedas.</p>
            </div>
        </aside>

    </div>

    <script>
        /* ── Char counter ── */
        function updateCharCount(el, spanId, max) {
            const count = el.value.length;
            const span = document.getElementById(spanId);
            span.textContent = count.toLocaleString();
            span.style.color = count > max * 0.9 ? '#b12704' : '';
        }

        /* ── Progress ── */
        function updateProgress() {
            const checks = {
                'chk-nombre': document.getElementById('nombre').value.trim().length > 0,
                'chk-categoria': document.getElementById('categoria').value !== '',
                'chk-descripcion': document.getElementById('descripcion').value.trim().length > 30,
                'chk-precio': parseFloat(document.getElementById('precio').value) > 0,
                'chk-stock': document.getElementById('stock').value !== '',
            };
            let done = 0;
            for (const [id, val] of Object.entries(checks)) {
                const li = document.getElementById(id);
                if (val) { li.classList.add('done'); done++; }
                else li.classList.remove('done');
            }
            const pct = Math.round((done / Object.keys(checks).length) * 100);
            document.getElementById('progress-fill').style.width = pct + '%';
            document.getElementById('progress-pct').textContent = pct + '%';
        }

        /* ── Image preview ── */
        function previewImages(input) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            Array.from(input.files).slice(0, 9).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const thumb = document.createElement('div');
                    thumb.className = 'preview-thumb';
                    thumb.style.backgroundImage = `url(${e.target.result})`;
                    thumb.style.backgroundSize = 'cover';
                    thumb.style.backgroundPosition = 'center';
                    preview.appendChild(thumb);
                };
                reader.readAsDataURL(file);
            });
        }

        /* ── Variants ── */
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

        /* ── Tags ── */
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
            const tagEl = document.createElement('span');
            tagEl.className = 'tag'; tagEl.dataset.val = val;
            tagEl.innerHTML = `${val} <span class="tag-remove" onclick="removeTag('${val}')">×</span>`;
            container.insertBefore(tagEl, document.getElementById('tag-input'));
        }
        function removeTag(val) {
            const i = tags.indexOf(val);
            if (i > -1) tags.splice(i, 1);
            document.querySelector(`.tag[data-val="${CSS.escape(val)}"]`)?.remove();
            document.getElementById('tags-hidden').value = tags.join(',');
        }

        /* ── Status badge ── */
        document.querySelectorAll('[name="estado"]').forEach(btn => {
            btn.addEventListener('click', () => {
                const badge = document.querySelector('.status-badge');
                if (btn.value === 'publicado') {
                    badge.textContent = 'Publicado';
                    badge.classList.remove('draft');
                } else {
                    badge.textContent = 'Borrador';
                    badge.classList.add('draft');
                }
            });
        });
    </script>

@endsection