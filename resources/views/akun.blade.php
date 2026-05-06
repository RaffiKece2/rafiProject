<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @if (isset($lihat_akun))
        <title>{{ $lihat_akun->name }}</title>
    @endif

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8fafc;
        }

        .container {
            width: 100%;
            padding: 40px 60px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .topbar h2 {
            margin: 0;
        }

        .user {
            background: #e2e8f0;
            padding: 8px 16px;
            border-radius: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            max-width: 500px;
        }

        .card h1 {
            margin: 0 0 10px;
        }

        .info {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        button {
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-gray {
            background: #e2e8f0;
        }

        .btn-gray:hover {
            background: #cbd5f5;
        }

        /* STORAGE BAR */
        .storage-box {
            margin-top: 25px;
        }

        .storage-text {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #2563eb;
            border-radius: 10px;
            transition: 0.4s;
        }

    </style>
</head>

<body>

<div class="container">

    <div class="topbar">
        <h2>Storage</h2>

        @if (isset($lihat_akun))
            <div class="user">
                {{ $lihat_akun->name }}
            </div>
        @endif
    </div>

    @if (isset($lihat_akun))
    <div class="card">
        <h1>{{ $lihat_akun->name }}</h1>

        <div class="info">
            Email: {{ $lihat_akun->email }}
        </div>

        <div class="actions">

            <form action="/beranda/{{ auth()->id() }}">
                <button class="btn-primary">Beranda</button>
            </form>

            <form action="/hapus_akun/{{ auth()->id() }}">
                <button class="btn-danger">Hapus Akun</button>
            </form>

            <form action="/logout" method="POST">
                @csrf
                <button class="btn-gray">Logout</button>
            </form>

        </div>

        <!-- STORAGE -->
        <div class="storage-box">

            <div class="storage-text">
                Storage Digunakan: 
                {{ $lihat_akun->storage_use }} / {{ $lihat_akun->storage_total }}
            </div>

            <div class="progress-bar">
                <div class="progress-fill"
                    style="width: {{ (float)$lihat_akun->storage_total > 0 
    ? ((float)$lihat_akun->storage_use / (float)$lihat_akun->storage_total) * 100 
    : 0 }}%">
                </div>
            </div>

        </div>

    </div>
    @endif

</div>

</body>
</html>