@extends('layouts.app')

@section('title', 'Agregar Producto — MiTienda')

@section('content')
    @include("layouts.navbar")
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

                {{-- Descripción --}}
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
                                      oninput="updateCharCount(this,'desc-count',5000); updateProgress()"></textarea>
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
                                <label for="precio_original">Precio Original <span class="optional">(opcional)</span></label>
                                <div class="input-prefix-wrap">
                                    <span class="input-prefix">$</span>
                                    <input type="number" id="precio_original" name="precio_original" min="0" step="0.01" placeholder="0.00">
                                </div>
                                <div class="field-hint">Para mostrar el descuento</div>
                            </div>
                            <div class="form-group" style="margin-bottom:0">
                                <label for="stock">Stock <span class="required">*</span></label>
                                <input type="number" id="stock" name="stock" min="0" placeholder="0"
                                       oninput="updateProgress()">
                            </div>
                        </div>

                        <div class="form-row" style="margin-top:16px;">
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
                            <div class="upload-text">Arrastra imágenes aquí o haz clic para seleccionar</div>
                            <div class="upload-subtext">PNG, JPG, WEBP — máx. 10MB por imagen — mín. 500×500px recomendado</div>
                        </div>
                        <div class="upload-preview" id="image-preview"></div>
                        <div class="field-hint" style="margin-top:10px;">
                            La primera imagen será la imagen principal del producto. Puedes subir hasta 9 imágenes.
                        </div>
                    </div>
                </div>

                {{-- Variantes --}}
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
                <ul class="checklist">
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
                    <span class="status-badge draft" id="status-badge">Borrador</span>
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

            <div class="tip-box tip-yellow">
                <h4>🌟 Visibilidad</h4>
                <p>Añade palabras clave relevantes en el nombre y descripción para aparecer en más búsquedas.</p>
            </div>

        </aside>

    </div>

    <script>
        /* Char counter */
        function updateCharCount(el, spanId, max) {
            const span = document.getElementById(spanId);
            span.textContent = el.value.length.toLocaleString();
            span.style.color = el.value.length > max * .9 ? '#b12704' : '';
        }

        /* Progress */
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

        /* Image preview */
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

        /* Variants */
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

        /* Tags */
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

        /* Estado badge */
        document.querySelectorAll('[name="estado"]').forEach(btn => {
            btn.addEventListener('click', () => {
                const badge = document.getElementById('status-badge');
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