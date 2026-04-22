<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Modern Storage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        
        /* Animasi Muncul Teratur (Fade In) */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-item { animation: fadeIn 0.4s ease forwards; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#F8FAFC]">

    <nav class="bg-white/80 backdrop-blur-md border-b sticky top-0 z-50 px-6 py-3 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="bg-blue-600 p-2 rounded-lg text-white font-bold text-xl">S</div>
            <h1 class="font-bold text-gray-800 tracking-tight">Storage.</h1>
        </div>
        <div class="flex items-center gap-4">
            <form action="/pencarian" class="hidden md:block">
                <input name="cari" type="text" placeholder="Search files..." class="bg-gray-100 border-none rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 w-64 transition-all">
            </form>
            <a href="/lihat_akun/{{ auth()->id() }}" class="text-sm font-semibold bg-gray-100 px-4 py-2 rounded-full hover:bg-gray-200 transition">
                {{ auth()->user()->name }}
            </a>
        </div>
    </nav>

    <div class="max-w-[1440px] mx-auto flex flex-col md:flex-row min-h-screen">
        
        <main class="flex-1 p-6 md:p-8">
            <div class="flex justify-between items-end mb-8">
                <p>Storage Digunakan: {{ $user->storage_use }} / {{ $user->storage_total }}</p>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Semua File</h2>
                    <p class="text-gray-500 text-sm">Total {{ $angka }} file tersedia</p>
                </div>


                <form action="/upload" method="POST" enctype="multipart/form-data" class="flex gap-2">
                    @csrf
                    <label class="cursor-pointer bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-200 transition-all active:scale-95 flex items-center gap-2">
                        <span>Upload File</span>
                        <input name="upload" type="file" class="hidden" onchange="this.form.submit()">
                    </label>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach (auth()->user()->galleries as $index => $hasil_file)
                <div class="animate-item bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-blue-200 transition-all duration-300 group" style="animation-delay: {{ $index * 0.05 }}s">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-blue-50 p-3 rounded-xl text-2xl group-hover:scale-110 transition-transform">📄</div>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="/download/{{ $hasil_file->id }}" class="p-2 bg-gray-50 rounded-lg hover:bg-blue-100 text-blue-600 transition">⬇️</a>
                            <a href="/hapus/{{ $hasil_file->id }}" class="p-2 bg-gray-50 rounded-lg hover:bg-red-100 text-red-600 transition">🗑️</a>
                        </div>
                    </div>
                    <a href="/open_file/{{ $hasil_file->id }}" class="font-semibold text-gray-800 block truncate mb-1 hover:text-blue-600 transition">
                        {{ $hasil_file->nama_tampilan }}
                    </a>
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <span>{{ $hasil_file->ukuran_format }}</span>
                        <span>•</span>
                        <span>{{ $hasil_file->created_at->format('d M Y') }}</span>
                    </div>
                </div>
                @endforeach
            </div>

            @if($angka == 0)
            <div class="flex flex-col items-center justify-center py-20 opacity-40">
                <span class="text-6xl mb-4">📂</span>
                <p>Belum ada file di sini.</p>
            </div>
            @endif
        </main>

        <aside class="w-full md:w-80 bg-white border-l p-6">
            <div class="sticky top-24">
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Folders</h3>
                    <form action="/folder" method="POST" class="space-y-3">
                        @csrf
                        <input name="nama" type="text" placeholder="Folder baru..." class="w-full bg-gray-50 border-none rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                        <button class="w-full bg-gray-900 text-white py-2.5 rounded-xl text-sm font-medium hover:bg-black transition active:scale-95 shadow-md">
                            + Buat Folder
                        </button>
                    </form>
                </div>

                <div class="space-y-3 max-h-[60vh] overflow-y-auto pr-2">
                    @foreach (auth()->user()->folders->where('parent_id', null) as $index => $newFolder)
                    <div class="animate-item group flex items-center justify-between p-3 rounded-xl hover:bg-blue-50 transition-all duration-200 border border-transparent hover:border-blue-100" style="animation-delay: {{ $index * 0.05 }}s">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <span class="text-xl">📂</span>
                            <div class="truncate">
                                <a href="/folder_open/{{ $newFolder->id }}" class="text-sm font-semibold text-gray-700 truncate hover:text-blue-600 block">
                                    {{ $newFolder->nama_folder }}
                                </a>
                                <p class="text-[10px] text-gray-400">{{ $newFolder->created_at->format('d/m/y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="/rename_folder/{{ $newFolder->id }}" class="p-1.5 hover:bg-white rounded text-[10px]">✏️</a>
                            <a href="/hapus_folder/{{ $newFolder->id }}" class="p-1.5 hover:bg-white rounded text-red-500 text-[10px]">🗑️</a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if (session('status') || session('notif'))
                <div class="mt-6 p-4 bg-blue-50 rounded-2xl border border-blue-100 text-xs text-blue-700 animate-bounce">
                    ✨ {{ session('status') ?? session('notif') }}
                </div>
                @endif
            </div>
        </aside>

    </div>

</body>
</html>