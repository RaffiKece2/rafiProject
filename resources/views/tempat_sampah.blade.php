<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Sampah</title>
</head>
<body>

    <h1>Tempat Sampah</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    
    @endif

    <form action="/beranda/{{ auth()->id() }}">
        <button>Beranda</button>
    </form>

    @foreach ($file as  $files)
        <button>{{ $files->nama_tampilan }}</button>
        
        <form action="/hapus_asli/{{ $files->id }}">
            <button>Delete Asli</button>
        </form>

        <form action="/restore/{{ $files->id }}">
            <button>Restore</button>
        </form>
    
    @endforeach
    
</body>
</html>