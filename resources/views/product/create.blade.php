@extends('layouts.app')

@section('title', 'Nuevo Producto — MiTienda')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --bg:        #0d0d14;
        --surface:   #13131c;
        --surface2:  #1a1a26;
        --surface3:  #212130;
        --border:    rgba(255,255,255,0.07);
        --border-hi: rgba(255,255,255,0.14);
        --accent:    #ff6b35;
        --accent-lo: rgba(255,107,53,0.10);
        --accent-md: rgba(255,107,53,0.22);
        --green:     #3ddc84;
        --red:       #ff4d6a;
        --text:      #eeeef5;
        --muted:     #7878a0;
        --dim:       #44445c;
        --r:         10px;
        --r-sm:      7px;
    }

    .create-wrap {
        display: grid;
        grid-template-columns: 1fr 288px;
        gap: 24px;
        align-items: flex-start;
    }

    /* Page header */
    .pg-header { margin-bottom: 28px; }
    .pg-eyebrow {
        font-family: 'Sora', sans-serif;
        font-size: 11px; font-weight: 700;
        letter-spacing: 1.8px; text-transform: uppercase;
        color: var(--accent); margin-bottom: 8px;
    }
    .pg-header h1 {
        font-family: 'Sora', sans-serif;
        font-size: 30px; font-weight: 800;
        color: var(--text); line-height: 1.1;
        margin-bottom: 6px; letter-spacing: -0.5px;
    }
    .pg-header p { font-size: 14px; color: var(--muted); }

    /* Cards */
    .f-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
        margin-bottom: 14px;
        overflow: hidden;
        transition: border-color .2s;
    }
    .f-card:focus-within { border-color: var(--border-hi); }
    .f-card-head {
        display: flex; align-items: center; gap: 12px;
        padding: 16px 22px;
        background: var(--surface2);
        border-bottom: 1px solid var(--border);
    }
    .f-num {
        width: 26px; height: 26px; border-radius: 50%;
        background: var(--accent-lo);
        border: 1px solid var(--accent-md);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Sora', sans-serif;
        font-size: 11px; font-weight: 700; color: var(--accent);
        flex-shrink: 0;
    }
    .f-card-head h2 {
        font-family: 'Sora', sans-serif;
        font-size: 14px; font-weight: 700; color: var(--text);
    }
    .f-card-body { padding: 22px; }

    /* Fields */
    .field { margin-bottom: 18px; }
    .field:last-child { margin-bottom: 0; }

    label {
        display: block;
        font-size: 11px; font-weight: 700;
        color: var(--muted); margin-bottom: 7px;
        letter-spacing: 0.8px; text-transform: uppercase;
    }
    .req { color: var(--accent); margin-left: 1px; }

    input[type=text],
    input[type=number],
    textarea,
    select {
        width: 100%;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: var(--r-sm);
        color: var(--text);
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        padding: 11px 14px;
        outline: none;
        transition: border-color .18s, box-shadow .18s;
        -webkit-appearance: none; appearance: none;
    }
    input[type=text]:focus, input[type=number]:focus,
    textarea:focus, select:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-lo);
    }
    input::placeholder, textarea::placeholder { color: var(--dim); }
    textarea { resize: vertical; line-height: 1.6; }
    select { cursor: pointer; }
    select option { background: var(--surface2); color: var(--text); }

    .counter {
        text-align: right; font-size: 11px;
        color: var(--dim); margin-top: 5px;
    }

    /* Precio */
    .price-wrap { position: relative; }
    .price-sym {
        position: absolute; left: 14px; top: 50%;
        transform: translateY(-50%);
        font-size: 14px; font-weight: 600;
        color: var(--muted); pointer-events: none;
    }
    .price-wrap input { padding-left: 28px; }

    /* Categorías como pills */
    .cat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 8px;
    }
    .cat-pill input[type=radio] { display: none; }
    .cat-pill label {
        display: flex; align-items: center;
        justify-content: center;
        padding: 10px 12px;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: var(--r-sm);
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; font-weight: 500;
        color: var(--muted);
        cursor: pointer;
        text-transform: none; letter-spacing: 0;
        text-align: center;
        transition: border-color .15s, color .15s, background .15s;
        margin: 0;
    }
    .cat-pill label:hover {
        border-color: var(--border-hi); color: var(--text);
    }
    .cat-pill input[type=radio]:checked + label {
        background: var(--accent-lo);
        border-color: var(--accent);
        color: var(--accent);
        font-weight: 600;
    }

    /* Upload */
    .upload-zone {
        border: 2px dashed var(--border);
        border-radius: var(--r);
        padding: 40px 20px;
        text-align: center;
        position: relative; cursor: pointer;
        transition: border-color .18s, background .18s;
    }
    .upload-zone:hover, .upload-zone.drag-over {
        border-color: var(--accent); background: var(--accent-lo);
    }
    .upload-zone input[type=file] {
        position: absolute; inset: 0;
        opacity: 0; cursor: pointer;
        width: 100%; height: 100%;
    }
    .upload-ico {
        width: 52px; height: 52px;
        background: var(--surface3);
        border: 1px solid var(--border-hi);
        border-radius: var(--r);
        display: flex; align-items: center; justify-content: center;
        font-size: 24px; margin: 0 auto 14px;
    }
    .upload-title {
        font-size: 15px; font-weight: 600;
        color: var(--text); margin-bottom: 5px;
    }
    .upload-sub { font-size: 12px; color: var(--muted); }

    /* Preview */
    .preview-wrap {
        display: none; margin-top: 16px;
        border: 1px solid var(--border);
        border-radius: var(--r); overflow: hidden;
        background: var(--surface2);
    }
    .preview-wrap.visible { display: block; }
    .preview-img {
        width: 100%; max-height: 260px;
        object-fit: contain; display: block; padding: 12px;
    }
    .preview-name {
        padding: 10px 14px; font-size: 12px; color: var(--muted);
        border-top: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
    }
    .preview-clear {
        color: var(--red); font-size: 12px; cursor: pointer;
        background: none; border: none;
        font-family: inherit; padding: 0;
    }
    .preview-clear:hover { text-decoration: underline; }

    /* Actions */
    .f-actions {
        display: flex; align-items: center; gap: 10px;
        padding: 18px 22px;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r); flex-wrap: wrap;
    }
    .btn-pub {
        display: inline-flex; align-items: center; gap: 8px;
        height: 40px; padding: 0 24px;
        background: var(--accent); color: #fff;
        border: none; border-radius: 50px;
        font-family: 'Sora', sans-serif;
        font-size: 13px; font-weight: 700; cursor: pointer;
        box-shadow: 0 4px 18px rgba(255,107,53,.35);
        transition: background .15s, transform .12s, box-shadow .15s;
    }
    .btn-pub:hover {
        background: #ff8055; transform: translateY(-1px);
        box-shadow: 0 6px 24px rgba(255,107,53,.45);
    }
    .btn-draft {
        display: inline-flex; align-items: center; gap: 6px;
        height: 40px; padding: 0 18px;
        background: var(--surface2); color: var(--muted);
        border: 1px solid var(--border); border-radius: 50px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; font-weight: 500; cursor: pointer;
        transition: border-color .15s, color .15s;
    }
    .btn-draft:hover { border-color: var(--border-hi); color: var(--text); }
    .btn-cancel {
        margin-left: auto; font-size: 13px;
        color: var(--dim); text-decoration: none;
        transition: color .15s;
    }
    .btn-cancel:hover { color: var(--red); }

    /* Sidebar */
    .create-sidebar { position: sticky; top: 90px; }
    .s-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--r);
        margin-bottom: 12px; overflow: hidden;
    }
    .s-head {
        padding: 12px 18px; border-bottom: 1px solid var(--border);
        font-family: 'Sora', sans-serif;
        font-size: 11px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 1px; color: var(--muted);
    }
    .s-body { padding: 18px; }

    /* Progress */
    .prog-label {
        display: flex; justify-content: space-between;
        font-size: 12px; color: var(--muted); margin-bottom: 8px;
    }
    #prog-pct { font-weight: 700; color: var(--accent); }
    .prog-track {
        height: 5px; background: var(--surface3);
        border-radius: 3px; overflow: hidden; margin-bottom: 16px;
    }
    .prog-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--accent), #ffb347);
        border-radius: 3px; width: 0%;
        transition: width .35s ease;
    }
    .chklist { list-style: none; }
    .chklist li {
        display: flex; align-items: center; gap: 9px;
        font-size: 13px; color: var(--dim);
        padding: 5px 0; transition: color .2s;
    }
    .chklist li::before {
        content: ''; width: 16px; height: 16px;
        border: 1.5px solid var(--dim); border-radius: 50%;
        flex-shrink: 0; transition: all .2s;
    }
    .chklist li.done { color: var(--green); }
    .chklist li.done::before {
        background: var(--green); border-color: var(--green);
        background-image: url("data:image/svg+xml,%3Csvg width='8' height='6' viewBox='0 0 8 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 3l2 2 4-4' stroke='%230d0d14' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: center;
    }

    /* Status rows */
    .s-row {
        display: flex; align-items: center;
        justify-content: space-between;
        font-size: 13px; color: var(--muted);
        padding: 8px 0; border-bottom: 1px solid var(--border);
    }
    .s-row:last-child { border-bottom: none; padding-bottom: 0; }
    .s-row:first-child { padding-top: 0; }
    .s-pill {
        font-size: 10px; font-weight: 700;
        padding: 3px 9px; border-radius: 50px;
        text-transform: uppercase; letter-spacing: 0.5px;
        background: var(--surface3); border: 1px solid var(--border);
        color: var(--dim);
    }
    .s-pill.live {
        background: rgba(61,220,132,.12);
        border-color: rgba(61,220,132,.3);
        color: var(--green);
    }

    /* Tips */
    .s-tip {
        padding: 14px 18px;
        border-left: 2px solid var(--accent);
        border-top: 1px solid var(--border);
        border-right: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        border-radius: 0 var(--r-sm) var(--r-sm) 0;
        background: var(--surface);
        margin-bottom: 12px;
        font-size: 12.5px; color: var(--muted); line-height: 1.6;
    }
    .s-tip strong {
        color: var(--text); display: block;
        margin-bottom: 4px; font-size: 12px;
    }

    @media (max-width: 920px) {
        .create-wrap { grid-template-columns: 1fr; }
        .create-sidebar { position: static; }
    }
    @media (max-width: 560px) {
        .cat-grid { grid-template-columns: repeat(2, 1fr); }
        .f-actions { flex-direction: column; align-items: stretch; }
        .btn-cancel { margin-left: 0; text-align: center; }
    }
</style>
@endpush

@section('content')

<div class="breadcrumb">
    <a href="/">Inicio</a>
    <span>/</span>
    <a href="/product">Productos</a>
    <span>/</span>
    <strong>Nuevo producto</strong>
</div>

<div class="pg-header">
    <div class="pg-eyebrow">✦ Vendedor</div>
    <h1>Agregar producto</h1>
    <p>Completa los campos para publicar tu producto en MiTienda.</p>
</div>

<div class="create-wrap">

    {{-- ══ FORMULARIO ══ --}}
    <div>
        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data" id="product-form">
            @csrf

            {{-- 1 · Nombre --}}
            <div class="f-card">
                <div class="f-card-head">
                    <span class="f-num">1</span>
                    <h2>Nombre del producto</h2>
                </div>
                <div class="f-card-body">
                    <div class="field" style="margin-bottom:0">
                        <label for="nombre">Nombre <span class="req">*</span></label>
                        <input type="text" id="nombre" name="nombre" maxlength="200"
                               placeholder='Ej: Laptop UltraBook Pro 15" Intel i7, 16GB RAM'
                               oninput="cnt(this,'nc',200);prog()">
                        <div class="counter"><span id="nc">0</span> / 200</div>
                    </div>
                </div>
            </div>

            {{-- 2 · Categoría — viene de $categoryList del controlador --}}
            <div class="f-card">
                <div class="f-card-head">
                    <span class="f-num">2</span>
                    <h2>Categoría</h2>
                </div>
                <div class="f-card-body">
                    @if($categoryList->isNotEmpty())
                        <div class="cat-grid">
                            @foreach($categoryList as $cat)
                            <div class="cat-pill">
                                <input type="radio"
                                       name="categoria"
                                       id="cat-{{ $cat->id }}"
                                       value="{{ $cat->id }}"
                                       onchange="prog()">
                                <label for="cat-{{ $cat->id }}">
                                    {{-- compatible con columnas: nombre, name o categoria --}}
                                    {{ $cat->nombre ?? $cat->name ?? $cat->categoria ?? '—' }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p style="font-size:13px;color:var(--muted)">
                            No hay categorías registradas aún.
                        </p>
                    @endif
                </div>
            </div>

            {{-- 3 · Descripción --}}
            <div class="f-card">
                <div class="f-card-head">
                    <span class="f-num">3</span>
                    <h2>Descripción</h2>
                </div>
                <div class="f-card-body">
                    <div class="field" style="margin-bottom:0">
                        <label for="descripcion">Descripción <span class="req">*</span></label>
                        <textarea id="descripcion" name="descripcion"
                                  rows="5" maxlength="5000"
                                  placeholder="Describe materiales, características, usos, dimensiones…"
                                  oninput="cnt(this,'dc',5000);prog()"></textarea>
                        <div class="counter"><span id="dc">0</span> / 5,000</div>
                    </div>
                </div>
            </div>

            {{-- 4 · Precio --}}
            <div class="f-card">
                <div class="f-card-head">
                    <span class="f-num">4</span>
                    <h2>Precio</h2>
                </div>
                <div class="f-card-body">
                    <div class="field" style="margin-bottom:0">
                        <label for="precio">Precio <span class="req">*</span></label>
                        <div class="price-wrap">
                            <span class="price-sym">$</span>
                            <input type="number" id="precio" name="precio"
                                   min="0" step="0.01" placeholder="0.00"
                                   oninput="prog()">
                        </div>
                    </div>
                </div>
            </div>

            {{-- 5 · Imagen --}}
            <div class="f-card">
                <div class="f-card-head">
                    <span class="f-num">5</span>
                    <h2>Imagen del producto</h2>
                </div>
                <div class="f-card-body">
                    <div class="upload-zone" id="drop-zone">
                        <input type="file" name="img" id="img-input"
                               accept="image/*" onchange="handleImg(this)">
                        <div class="upload-ico">🖼️</div>
                        <div class="upload-title">Arrastra tu imagen aquí o haz clic</div>
                        <div class="upload-sub">PNG · JPG · WEBP &nbsp;·&nbsp; hasta 10 MB &nbsp;·&nbsp; mín. 500 × 500 px</div>
                    </div>

                    <div class="preview-wrap" id="preview-wrap">
                        <img id="preview-img" class="preview-img" src="" alt="Vista previa">
                        <div class="preview-name">
                            <span id="preview-fname"></span>
                            <button type="button" class="preview-clear" onclick="clearImg()">
                                ✕ Quitar imagen
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Acciones --}}
            <div class="f-actions">
                <button type="submit" class="btn-pub" name="estado" value="publicado">
                    🚀 Publicar producto
                </button>
                <button type="submit" class="btn-draft" name="estado" value="borrador">
                    💾 Guardar borrador
                </button>
                <a href="/product" class="btn-cancel">✕ Cancelar</a>
            </div>

        </form>
    </div>

    {{-- ══ SIDEBAR ══ --}}
    <aside class="create-sidebar">

        <div class="s-card">
            <div class="s-head">Progreso</div>
            <div class="s-body">
                <div class="prog-label">
                    <span>Completado</span>
                    <span id="prog-pct">0%</span>
                </div>
                <div class="prog-track">
                    <div class="prog-fill" id="prog-fill"></div>
                </div>
                <ul class="chklist">
                    <li id="chk-nombre">Nombre</li>
                    <li id="chk-cat">Categoría seleccionada</li>
                    <li id="chk-desc">Descripción</li>
                    <li id="chk-precio">Precio definido</li>
                    <li id="chk-img">Imagen subida</li>
                </ul>
            </div>
        </div>

        <div class="s-card">
            <div class="s-head">Estado</div>
            <div class="s-body">
                <div class="s-row">
                    <span>Estado</span>
                    <span class="s-pill" id="s-pill">Borrador</span>
                </div>
                <div class="s-row">
                    <span>Visibilidad</span>
                    <span style="font-size:12px;color:var(--muted)">Público</span>
                </div>
                <div class="s-row">
                    <span>Publicación</span>
                    <span style="font-size:12px;color:var(--muted)">Inmediata</span>
                </div>
            </div>
        </div>

        <div class="s-tip">
            <strong>💡 Imagen</strong>
            Fondo blanco y mínimo 800 × 800 px. Las fotos de calidad aumentan las ventas un 40%.
        </div>

        <div class="s-tip" style="border-left-color:#ffb347">
            <strong>🔍 SEO interno</strong>
            Incluye palabras clave en el nombre y los primeros 150 caracteres de la descripción.
        </div>

    </aside>
</div>

<script>
    /* Contador de caracteres */
    function cnt(el, id, max) {
        const s = document.getElementById(id);
        s.textContent = el.value.length.toLocaleString();
        s.style.color = el.value.length > max * .9 ? '#ff4d6a' : '';
    }

    /* Barra de progreso */
    function prog() {
        const catRadio   = document.querySelector('input[name="categoria"]:checked');
        const catSelect  = document.getElementById('categoria');
        const catOk      = catRadio !== null || (catSelect && catSelect.value !== '');

        const checks = {
            'chk-nombre': document.getElementById('nombre').value.trim().length > 0,
            'chk-cat':    catOk,
            'chk-desc':   document.getElementById('descripcion').value.trim().length > 20,
            'chk-precio': parseFloat(document.getElementById('precio').value) > 0,
            'chk-img':    document.getElementById('preview-wrap').classList.contains('visible'),
        };

        let done = 0;
        for (const [id, ok] of Object.entries(checks)) {
            document.getElementById(id).classList.toggle('done', ok);
            if (ok) done++;
        }
        const pct = Math.round(done / 5 * 100);
        document.getElementById('prog-fill').style.width  = pct + '%';
        document.getElementById('prog-pct').textContent   = pct + '%';
    }

    /* Preview de imagen */
    function handleImg(input) {
        const file = input.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview-img').src        = e.target.result;
            document.getElementById('preview-fname').textContent = file.name;
            document.getElementById('preview-wrap').classList.add('visible');
            prog();
        };
        reader.readAsDataURL(file);
    }

    function clearImg() {
        document.getElementById('img-input').value = '';
        document.getElementById('preview-wrap').classList.remove('visible');
        document.getElementById('preview-img').src = '';
        prog();
    }

    /* Drag & drop visual */
    const dz = document.getElementById('drop-zone');
    dz.addEventListener('dragover',  e => { e.preventDefault(); dz.classList.add('drag-over'); });
    dz.addEventListener('dragleave', ()  => dz.classList.remove('drag-over'));
    dz.addEventListener('drop',      e  => { e.preventDefault(); dz.classList.remove('drag-over'); });

    /* Badge estado */
    document.querySelectorAll('[name="estado"]').forEach(btn => {
        btn.addEventListener('click', () => {
            const p = document.getElementById('s-pill');
            if (btn.value === 'publicado') { p.textContent = 'Publicado'; p.classList.add('live'); }
            else                           { p.textContent = 'Borrador';  p.classList.remove('live'); }
        });
    });
</script>

@endsection