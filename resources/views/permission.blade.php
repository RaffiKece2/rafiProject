<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perizinan File</title>

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

        .user {
            background: #e2e8f0;
            padding: 8px 16px;
            border-radius: 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            max-width: 500px;
        }

        h1 {
            margin: 0 0 10px;
        }

        .file-name {
            color: #64748b;
            margin-bottom: 25px;
        }

        /* RADIO STYLE */
        .radio-group {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .radio-card {
            flex: 1;
            padding: 15px;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            cursor: pointer;
            transition: 0.2s;
            text-align: center;
        }

        .radio-card:hover {
            border-color: #2563eb;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]:checked + .radio-card {
            border-color: #2563eb;
            background: #eff6ff;
        }

        .status {
            margin-bottom: 20px;
            color: #64748b;
        }

        .success {
            color: #16a34a;
            margin-bottom: 15px;
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

        .btn-gray {
            background: #e2e8f0;
        }

        .btn-gray:hover {
            background: #cbd5f5;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

    </style>
</head>

<body>

<div class="container">

    <div class="topbar">
        <h2>Storage</h2>

        <div class="user">
            {{ auth()->user()->name ?? 'User' }}
        </div>
    </div>

    <div class="card">

        <h1>Perizinan File</h1>

        <div class="file-name">
            Nama File: {{ $isi_file->nama_tampilan }}
        </div>

        <form action="/ubah_perizinan/{{ $isi_file->id }}" method="POST">
            @csrf

            <div class="radio-group">

                <label>
                    <input type="radio" name="izin" value="0"
                        {{ $isi_file->izin == 0 ? 'checked' : '' }}>
                    <div class="radio-card">
                        🔒 Private
                    </div>
                </label>

                <label>
                    <input type="radio" name="izin" value="1"
                        {{ $isi_file->izin == 1 ? 'checked' : '' }}>
                    <div class="radio-card">
                        🌐 Public
                    </div>
                </label>

            </div>

            <button type="submit" class="btn-primary">
                Simpan Perizinan
            </button>

        </form>

        @if (isset($isi_file->izin))
            <div class="status">
                Status: {{ $isi_file->izin == 1 ? 'Public' : 'Private' }}
            </div>
        @endif

        @if (session('status'))
            <div class="success">
                {{ session('status') }}
            </div>
        @endif

        <div class="actions">
            <form action="/beranda/{{ auth()->id() }}">
                <button class="btn-gray">Beranda</button>
            </form>
        </div>

    </div>

</div>

</body>
</html>