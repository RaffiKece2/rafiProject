<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: white;
            padding: 30px;
            width: 350px;
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
            border-color: #4f46e5;
            box-shadow: 0 0 5px rgba(79,70,229,0.3);
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #4f46e5;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #4338ca;
        }

        .register {
            margin-top: 15px;
            text-align: center;
        }

        .register button {
            background: none;
            border: none;
            color: #4f46e5;
            cursor: pointer;
            font-size: 14px;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert {
            background: #fee2e2;
            color: #b91c1c;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Login</h1>

    @if (session('error') && !session('status'))
        <div class="alert">{{ session('error') }}</div>
    @endif

    <form action="/masuk" method="POST">
        @csrf

        <div class="input-group">
            <input name="email" placeholder="Email" type="email"
                oninput="this.value = this.value.replace(/\s/g, '')">
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

        <div class="remember">
            <input name="ingat" type="checkbox" id="ingat">
            <label for="ingat">Ingat Saya</label>
        </div>

        <button class="btn" type="submit">Login</button>
    </form>

    <div class="register">
        <form action="/">
            <button type="submit">Belum punya akun? Register</button>
        </form>
    </div>
</div>

</body>
</html>