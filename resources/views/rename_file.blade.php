<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (isset($cari_file))
        <title>Rename — {{ $cari_file->file }}</title>
    @else
        <title>Rename File</title>
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0a0d14;
            --surface:   #111621;
            --border:    #1e2636;
            --border-hi: #2e3f5c;
            --accent:    #3b82f6;
            --accent-glow: rgba(59,130,246,0.25);
            --accent-dim:  rgba(59,130,246,0.12);
            --text:      #e2e8f4;
            --muted:     #5a6a8a;
            --danger:    #f87171;
        }

        html, body {
            height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Mono', monospace;
            font-size: 14px;
            line-height: 1.6;
        }

        /* Animated grid background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
            z-index: 0;
        }

        /* Radial glow at top */
        body::after {
            content: '';
            position: fixed;
            top: -200px;
            left: 50%;
            transform: translateX(-50%);
            width: 700px;
            height: 500px;
            background: radial-gradient(ellipse at center, rgba(59,130,246,0.12) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .page {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        /* ── Top bar ────────────────────────────────── */
        .topbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 56px;
            background: rgba(10,13,20,0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 10px;
            z-index: 100;
        }

        .topbar-logo {
            display: flex;
            align-items: center;
            gap: 9px;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: .02em;
            color: var(--text);
            text-decoration: none;
        }

        .topbar-logo svg { flex-shrink: 0; }

        .topbar-sep {
            width: 1px;
            height: 20px;
            background: var(--border);
            margin: 0 4px;
        }

        .topbar-breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            font-size: 12px;
        }

        .topbar-breadcrumb span.active {
            color: var(--accent);
        }

        /* ── Card ───────────────────────────────────── */
        .card {
            width: 100%;
            max-width: 500px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow:
                0 0 0 1px rgba(255,255,255,0.03),
                0 24px 64px rgba(0,0,0,0.6),
                0 0 48px var(--accent-glow);
            animation: slideUp .45s cubic-bezier(.22,1,.36,1) both;
        }

        @keyframes slideUp {
            from { opacity:0; transform:translateY(28px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ── Card header ─────────────────────────── */
        .card-header {
            padding: 28px 28px 24px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, rgba(59,130,246,0.06) 0%, transparent 60%);
        }

        .file-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: var(--accent-dim);
            border: 1px solid rgba(59,130,246,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .card-label {
            font-size: 11px;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 6px;
            font-weight: 500;
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
            word-break: break-all;
        }

        .card-filename {
            font-size: 12px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .filename-chip {
            background: var(--accent-dim);
            border: 1px solid rgba(59,130,246,0.2);
            color: var(--accent);
            border-radius: 5px;
            padding: 2px 8px;
            font-size: 11px;
            max-width: 280px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* ── Card body ───────────────────────────── */
        .card-body {
            padding: 24px 28px;
        }

        .field-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .field-label span {
            font-size: 11px;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .field-label .char-count {
            font-size: 11px;
            color: var(--muted);
            font-variant-numeric: tabular-nums;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap svg.input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
            transition: color .2s;
        }

        .rename-input {
            width: 100%;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 13px 14px 13px 42px;
            font-family: 'DM Mono', monospace;
            font-size: 14px;
            color: var(--text);
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
            caret-color: var(--accent);
        }

        .rename-input:focus {
            border-color: var(--accent);
            background: rgba(59,130,246,0.05);
            box-shadow: 0 0 0 3px var(--accent-glow);
        }

        .rename-input:focus + .input-icon-dummy,
        .input-wrap:focus-within svg.input-icon {
            color: var(--accent);
        }

        .hint {
            margin-top: 8px;
            font-size: 11px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ── Actions ─────────────────────────────── */
        .card-footer {
            padding: 0 28px 28px;
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 10px;
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: transform .15s, box-shadow .15s, background .15s, opacity .15s;
            text-decoration: none;
            padding: 12px 20px;
        }

        .btn:active { transform: scale(.97); }

        .btn-primary {
            flex: 1;
            background: var(--accent);
            color: #fff;
            box-shadow: 0 4px 20px rgba(59,130,246,0.4);
        }

        .btn-primary:hover {
            background: #5b9cf8;
            box-shadow: 0 6px 28px rgba(59,130,246,0.55);
        }

        .btn-ghost {
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border);
            color: var(--muted);
        }

        .btn-ghost:hover {
            background: rgba(255,255,255,0.07);
            border-color: var(--border-hi);
            color: var(--text);
        }

        /* ── Loading spinner inside btn ─────────── */
        .btn-primary .spinner {
            display: none;
            width: 15px;
            height: 15px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            border-radius: 50%;
            animation: spin .6s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .btn-primary.loading .spinner { display: block; }
        .btn-primary.loading .btn-text { opacity: 0; position: absolute; }

        /* ── Toast ───────────────────────────────── */
        .toast {
            position: fixed;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%) translateY(80px);
            background: #1a2235;
            border: 1px solid var(--border-hi);
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 13px;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
            transition: transform .35s cubic-bezier(.22,1,.36,1);
            z-index: 200;
            white-space: nowrap;
        }

        .toast.show { transform: translateX(-50%) translateY(0); }
        .toast-dot { width: 8px; height: 8px; border-radius: 50%; background: #4ade80; flex-shrink: 0; }

        /* ── Divider ─────────────────────────────── */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 0 28px 24px;
        }
    </style>
</head>
<body>

    <!-- Top bar -->
    <nav class="topbar">
        <a href="#" class="topbar-logo">
            <!-- Cloud icon -->
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/>
            </svg>
            NimbusDrive
        </a>
        <div class="topbar-sep"></div>
        <div class="topbar-breadcrumb">
            <span>My Files</span>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 18 6-6-6-6"/></svg>
            <span class="active">Rename</span>
        </div>
    </nav>

    <main class="page">
        <div class="card">

            <!-- Header -->
            <div class="card-header">
                <div class="file-icon-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <div class="card-label">File Rename</div>
                @if (isset($cari_file))
                    <h1 class="card-title">Rename File</h1>
                    <div class="card-filename">
                        <span>Current name:</span>
                        <span class="filename-chip">{{ $cari_file->file }}</span>
                    </div>
                @else
                    <h1 class="card-title">Rename File</h1>
                    <div class="card-filename"><span>No file selected</span></div>
                @endif
            </div>

            <!-- Form body -->
            @if (isset($cari_file))
            <form action="/rename_sekarang/{{ $cari_file->id }}" method="GET" id="renameForm">
                <div class="card-body">
                    <div class="field-label">
                        <span>New filename</span>
                        <span class="char-count" id="charCount">—</span>
                    </div>

                    <div class="input-wrap">
                        <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        <input
                            class="rename-input"
                            type="text"
                            name="rename"
                            id="renameInput"
                            value="{{ $cari_file->file }}"
                            autocomplete="off"
                            autofocus
                            placeholder="Enter new name…"
                        >
                    </div>

                    <p class="hint">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Avoid special characters: <code>/ \ : * ? " &lt; &gt; |</code>
                    </p>
                </div>

                <div class="divider"></div>

                <div class="card-footer">
                    <a href="/beranda/{{ auth()->id() }}" class="btn btn-ghost">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        Beranda
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <div class="spinner"></div>
                        <span class="btn-text">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Rename Sekarang
                        </span>
                    </button>
                </div>
            </form>
            @else
            <div class="card-body">
                <p style="color:var(--muted); text-align:center; padding: 12px 0;">File tidak ditemukan.</p>
            </div>
            <div class="card-footer">
                <a href="/beranda/{{ auth()->id() }}" class="btn btn-ghost" style="width:100%;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Kembali ke Beranda
                </a>
            </div>
            @endif

        </div><!-- /card -->
    </main>

    <!-- Toast notification -->
    <div class="toast" id="toast">
        <div class="toast-dot"></div>
        <span id="toastMsg">File berhasil direname!</span>
    </div>

    <script>
        const input     = document.getElementById('renameInput');
        const charCount = document.getElementById('charCount');
        const form      = document.getElementById('renameForm');
        const submitBtn = document.getElementById('submitBtn');
        const toast     = document.getElementById('toast');

        // Character counter
        function updateCount() {
            if (!input) return;
            charCount.textContent = input.value.length + ' chars';
        }

        if (input) {
            input.addEventListener('input', updateCount);
            updateCount();

            // Select all on focus for quick replace
            input.addEventListener('focus', () => input.select());
        }

        // Loading state + toast on submit
        if (form) {
            form.addEventListener('submit', (e) => {
                const val = input.value.trim();
                if (!val) { e.preventDefault(); return; }

                submitBtn.classList.add('loading');
                submitBtn.disabled = true;

                // Show toast after short delay
                setTimeout(() => {
                    toast.classList.add('show');
                    setTimeout(() => toast.classList.remove('show'), 3000);
                }, 600);
            });
        }
    </script>

</body>
</html>