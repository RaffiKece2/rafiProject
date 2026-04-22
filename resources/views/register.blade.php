<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #06b6d4, #4f46e5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: white;
            padding: 30px;
            width: 370px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .card h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: 0.2s;
        }

        .input-group input:focus {
            border-color: #06b6d4;
            box-shadow: 0 0 5px rgba(6,182,212,0.3);
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #06b6d4;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #0891b2;
        }

        .login {
            margin-top: 15px;
            text-align: center;
        }

        .login button {
            background: none;
            border: none;
            color: #06b6d4;
            cursor: pointer;
            font-size: 14px;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert {
            background: #dcfce7;
            color: #166534;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 13px;
            text-align: center;
        }

        .warning {
            background: #fee2e2;
            color: #b91c1c;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 13px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Register</h1>

    @if(session('status'))
        <div class="alert">{{ session('status') }}</div>
    @endif

    @isset($pesan)
        <div class="warning">{{ $pesan }}</div>
    @endisset

    <form action="/register" method="POST">
        @csrf

        <div class="input-group">
            <input name="nama" placeholder="Nama" type="text"
                oninput="this.value = this.value.replace(/\s/g, '')">
            @error('nama')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-group">
            <input name="email" placeholder="Email" type="email">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-group">
            <input name="password" placeholder="Password" type="password">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-group">
            <input name="password_confirmation" placeholder="Konfirmasi Password" type="password">
        </div>

        <button class="btn" type="submit">Register</button>
    </form>

    <div class="login">
        <form action="/login" method="GET">
            <button type="submit">Sudah punya akun? Login</button>
        </form>
    </div>
</div>

</body>
</html>