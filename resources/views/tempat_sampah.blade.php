<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Sampah — Storage.</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #F4F4F6;
            min-height: 100vh;
            color: #1a1a1a;
        }

        /* ── Navbar ── */
        .navbar {
            background: #fff;
            border-bottom: 1px solid #E5E5E7;
            padding: 0 2rem;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.5px;
            text-decoration: none;
            color: #1a1a1a;
        }
        .logo-icon {
            width: 32px; height: 32px;
            background: #2563EB;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
        }
        .logo-dot { color: #2563EB; }
        .user-badge {
            background: #1a1a1a;
            color: #fff;
            border-radius: 6px;
            padding: 5px 14px;
            font-size: 13px;
            font-weight: 500;
        }

        /* ── Page wrapper ── */
        .page { max-width: 860px; margin: 0 auto; padding: 2rem 1.5rem; }

        /* ── Flash message ── */
        .flash {
            background: #ECFDF5;
            border: 1px solid #6EE7B7;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 13px;
            color: #065F46;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .flash-dot {
            width: 7px; height: 7px;
            background: #10B981;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ── Top bar ── */
        .topbar {
            background: #fff;
            border: 1px solid #E5E5E7;
            border-radius: 12px;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .topbar-icon {
            width: 38px; height: 38px;
            background: #FEE2E2;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
        }
        .topbar-icon svg { width: 18px; height: 18px; }
        .topbar-title { font-size: 16px; font-weight: 600; }
        .topbar-sub { font-size: 12px; color: #888; margin-top: 1px; }

        .btn-beranda {
            margin-left: auto;
            background: #fff;
            border: 1px solid #E5E5E7;
            border-radius: 8px;
            padding: 7px 16px;
            font-size: 13px;
            font-weight: 500;
            color: #1a1a1a;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-beranda:hover { background: #F4F4F6; }

        /* ── Info banner ── */
        .info-banner {
            background: #FFF8E1;
            border: 1px solid #FDE68A;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 13px;
            color: #78350F;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── File list ── */
        .file-list { display: flex; flex-direction: column; gap: 8px; }

        .file-card {
            background: #fff;
            border: 1px solid #E5E5E7;
            border-radius: 10px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: border-color 0.15s;
        }
        .file-card:hover { border-color: #C7D2FE; }

        .file-icon {
            width: 40px; height: 40px;
            background: #EEF2FF;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .file-icon svg { width: 20px; height: 20px; }

        .file-name {
            font-size: 14px;
            font-weight: 500;
            color: #1a1a1a;
            flex: 1;
            min-width: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-actions { display: flex; gap: 8px; flex-shrink: 0; }

        .btn-restore {
            background: #EFF6FF;
            border: 1px solid #BFDBFE;
            color: #1D4ED8;
            border-radius: 7px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
        }
        .btn-restore:hover { background: #DBEAFE; }

        .btn-hapus {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #DC2626;
            border-radius: 7px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
        }
        .btn-hapus:hover { background: #FEE2E2; }

        /* ── Empty state ── */
        .empty-state {
            background: #fff;
            border: 1px solid #E5E5E7;
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
        }
        .empty-folder {
            width: 64px; height: 64px;
            margin: 0 auto 1rem;
        }
        .empty-folder svg { width: 64px; height: 64px; }
        .empty-label { font-size: 14px; color: #888; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="logo">
            <div class="logo-icon">S</div>
            Storage<span class="logo-dot">.</span>
        </a>
        <div class="user-badge">{{ auth()->user()->name ?? 'User' }}</div>
    </nav>

    <!-- Page content -->
    <div class="page">

        <!-- Flash -->
        @if (session('status'))
            <div class="flash">
                <div class="flash-dot"></div>
                {{ session('status') }}
            </div>
        @endif

        <!-- Top bar -->
        <div class="topbar">
            <div class="topbar-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14H6L5 6"/>
                    <path d="M10 11v6M14 11v6"/>
                    <path d="M9 6V4h6v2"/>
                </svg>
            </div>
            <div>
                <div class="topbar-title">Tempat Sampah</div>
                <div class="topbar-sub">File yang dihapus tersimpan di sini</div>
            </div>

            <!-- Beranda — backend tetap sama -->
            <form action="/beranda/{{ auth()->id() }}" style="margin-left:auto;">
                <button type="submit" class="btn-beranda">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        <polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Beranda
                </button>
            </form>
        </div>

        <!-- Info banner -->
        <div class="info-banner">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#B45309" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            File di tempat sampah akan dihapus permanen setelah 30 hari.
        </div>

        <!-- File list -->
        @if ($file->isEmpty())
            <div class="empty-state">
                <div class="empty-folder">
                    <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="20" width="56" height="36" rx="5" fill="#F3F4F6" stroke="#D1D5DB" stroke-width="1.5"/>
                        <path d="M4 28h56" stroke="#D1D5DB" stroke-width="1.5"/>
                        <path d="M4 25c0-2.76 2.24-5 5-5h14l4 5H55c2.76 0 5 2.24 5 5" fill="#E5E7EB"/>
                    </svg>
                </div>
                <div class="empty-label">Tempat sampah kosong.</div>
            </div>
        @else
            <div class="file-list">
                @foreach ($file as $files)
                    <div class="file-card">
                        <div class="file-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/>
                                <polyline points="13 2 13 9 20 9"/>
                            </svg>
                        </div>
                        <span class="file-name">{{ $files->nama_tampilan }}</span>
                        <div class="file-actions">

                            <!-- Restore — backend tetap sama -->
                            <form action="/restore/{{ $files->id }}" method="GET">
                                <button type="submit" class="btn-restore">Pulihkan</button>
                            </form>

                            <!-- Hapus permanen — backend tetap sama -->
                            <form action="/hapus_asli/{{ $files->id }}" method="GET">
                                <button type="submit" class="btn-hapus">Hapus Permanen</button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</body>
</html>