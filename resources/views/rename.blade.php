<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @if (isset($ubah_nama))
        <title>{{ $ubah_nama->file }}</title>
    @endif

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px;
            width: 350px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            color: white;
            text-align: center;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            outline: none;
            margin-bottom: 20px;
            background: rgba(255,255,255,0.1);
            color: white;
        }

        input::placeholder {
            color: #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .btn-secondary {
            margin-top: 15px;
            background: linear-gradient(135deg, #64748b, #334155);
        }

    </style>
</head>
<body>

    <div class="card">

        @if (isset($ubah_nama))
            <h1>Rename File</h1>

            <form action="/rename/{{ $ubah_nama->id }}">
                <input 
                    value="{{ $ubah_nama->nama_tampilan }}" 
                    name="ubah_nama" 
                    type="text"
                    placeholder="Masukkan nama baru..."
                >
                <button>Rename</button>
            </form>
        @endif

        <form action="/beranda/{{ auth()->id() }}">
            <button class="btn-secondary">Kembali ke Beranda</button>
        </form>

    </div>

</body>
</html>