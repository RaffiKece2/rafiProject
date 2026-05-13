<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($isi_folder) ? $isi_folder->nama_folder : 'Folder' }} - Storage</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-item { animation: fadeIn 0.4s ease forwards; opacity: 0; }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#F8FAFC]">

    {{-- NAVBAR --}}
    <nav class="bg-white/80 backdrop-blur-md border-b sticky top-0 z-50 px-6 py-3 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="bg-blue-600 p-2 rounded-lg text-white font-bold text-xl">S</div>
            <h1 class="font-bold text-gray-800 tracking-tight">Storage.</h1>
        </div>
        <div class="flex items-center gap-4">
            <form action="/pencarian" class="hidden md:block">
                <input name="cari" type="text" placeholder="Search files..."
                    class="bg-gray-100 border-none rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 w-64 transition-all">
            </form>
            <a href="/beranda/{{ auth()->id() }}"
                class="text-sm font-semibold bg-gray-100 px-4 py-2 rounded-full hover:bg-gray-200 transition">
                ← Beranda
            </a>
        </div>
    </nav>

    <div class="max-w-[1440px] mx-auto flex flex-col md:flex-row min-h-screen">

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 md:p-8">

            {{-- Breadcrumb & Header --}}
            <div class="mb-8">
                <div class="flex items-center gap-2 text-sm text-gray-400 mb-2">
                    <a href="/beranda/{{ auth()->id() }}" class="hover:text-blue-600 transition">🏠 Beranda</a>
                    <span>/</span>
                    @if (isset($isi_folder))
                        <span class="text-gray-700 font-medium">📂 {{ $isi_folder->nama_folder }}</span>
                    @endif
                </div>

                <div class="flex justify-between items-end flex-wrap gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">
                            {{ isset($isi_folder) ? $isi_folder->nama_folder : 'Folder' }}
                        </h2>
                        <p class="text-gray-500 text-sm">
                            @if (isset($isi_folder))
                                {{ $isi_folder->files->count() }} file •
                                {{ $isi_folder->children->count() }} subfolder
                            @endif
                        </p>
                    </div>

                    {{-- Upload File --}}
                    @if (isset($isi_folder))
                    <form action="/upload_subfolder" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input name="folder_id" value="{{ $isi_folder->id }}" type="hidden">
                        <label class="cursor-pointer bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-200 transition-all active:scale-95 flex items-center gap-2">
                            <span>Upload File</span>
                            <input name="upload" type="file" class="hidden" onchange="this.form.submit()">
                        </label>
                    </form>
                    @endif
                </div>
            </div>

            {{-- Notifikasi --}}
            @foreach (['error' => 'red', 'notif' => 'blue', 'status' => 'green', 'status_subfolder' => 'blue', 'status_file' => 'green'] as $key => $color)
                @if (session($key))
                <div class="mb-4 p-3 bg-{{ $color }}-50 border border-{{ $color }}-100 rounded-xl text-sm text-{{ $color }}-700">
                    {{ session($key) }}
                </div>
                @endif
            @endforeach

            @if (isset($berubah))
            <div class="mb-4 p-3 bg-green-50 border border-green-100 rounded-xl text-sm text-green-700">
                {{ $berubah }}
            </div>
            @endif

            {{-- SUBFOLDERS --}}
            @if (isset($isi_folder) && $isi_folder->children->count() > 0)
            <div class="mb-8">
                <h3 class="text-base font-semibold text-gray-700 mb-3">📁 Subfolder</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($isi_folder->children as $index => $subfolder)
                    <div class="animate-item bg-white p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-yellow-200 transition-all duration-300 group"
                        style="animation-delay: {{ $index * 0.05 }}s">
                        <div class="flex justify-between items-start mb-3">
                            <div class="bg-yellow-50 p-3 rounded-xl text-2xl group-hover:scale-110 transition-transform">📂</div>
                            <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="/rename_subfolder/{{ $subfolder->id }}"
                                    class="p-1.5 bg-gray-50 rounded-lg hover:bg-blue-100 text-blue-600 transition text-xs">✏️</a>
                                <a href="/pindah_perizinan/{{ $subfolder->id }}"
                                    class="p-1.5 bg-gray-50 rounded-lg hover:bg-purple-100 text-purple-600 transition text-xs">👁️</a>
                                <a href="/hapus_subfolder/{{ $subfolder->id }}"
                                    class="p-1.5 bg-gray-50 rounded-lg hover:bg-red-100 text-red-500 transition text-xs">🗑️</a>
                            </div>
                        </div>
                        <a href="/folder_open/{{ $subfolder->id }}"
                            class="font-semibold text-gray-800 block truncate mb-1 hover:text-blue-600 transition">
                            {{ $subfolder->nama_folder }}
                        </a>
                        <p class="text-xs text-gray-400">{{ $subfolder->created_at->format('d M Y') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- FILES --}}
            @if (isset($isi_folder))
            <div>
                <h3 class="text-base font-semibold text-gray-700 mb-3">📄 File</h3>

                @if ($isi_folder->files->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ($isi_folder->files as $index => $isi_file)
                    <div class="animate-item bg-white p-5 rounded-2xl border border-blue-500 shadow-sm hover:shadow-xl hover:border-blue-200 transition-all duration-300 group"
                        style="animation-delay: {{ ($isi_folder->children->count() + $index) * 0.05 }}s">
                        <div class="flex justify-between items-start mb-4">
                            <div class="bg-blue-50 p-3 rounded-xl text-2xl group-hover:scale-110 transition-transform">📄</div>
                            <div class="flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="/download_subfile/{{ $isi_file->id }}"
                                    class="p-2 bg-gray-50 rounded-lg hover:bg-blue-100 text-blue-600 transition">⬇️</a>
                                <a href="/rename_subfile/{{ $isi_file->id }}"
                                    class="p-2 bg-gray-50 rounded-lg hover:bg-yellow-100 text-yellow-600 transition">✏️</a>
                                <a href="/perizinan_subfile/{{ $isi_file->id }}"
                                    class="p-2 bg-gray-50 rounded-lg hover:bg-purple-100 text-purple-600 transition">👁️</a>
                                <a href="/hapus_file/{{ $isi_file->id }}"
                                    class="p-2 bg-gray-50 rounded-lg hover:bg-red-100 text-red-500 transition">🗑️</a>
                            </div>
                        </div>
                        <a href="/open_file/{{ $isi_file->id }}" class="font-semibold text-gray-800 block truncate mb-1 hover:text-blue-600 transition">
                            {{ $isi_file->nama_tampilan }}
                        </a>
                       
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <span>{{ $isi_file->ukuran_format }}</span>
                            <span>•</span>
                            <span>{{ $isi_file->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                @else
                <div class="flex flex-col items-center justify-center py-16 opacity-40">
                    <span class="text-6xl mb-4">📄</span>
                    <p class="text-sm">Belum ada file di folder ini.</p>
                </div>
                @endif
            </div>
            @endif

        </main>

        {{-- SIDEBAR --}}
        <aside class="w-full md:w-80 bg-white border-l p-6">
            <div class="sticky top-24">

                {{-- Buat Subfolder --}}
                @if (isset($isi_folder))
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Subfolder Baru</h3>
                    <form action="/folder" method="POST" class="space-y-3">
                        @csrf
                        <input name="nama" type="text" placeholder="Nama subfolder..."
                            class="w-full bg-gray-50 border-none rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 transition-all">
                        <input name="parent_id" value="{{ $isi_folder->id }}" type="hidden">
                        <button class="w-full bg-gray-900 text-white py-2.5 rounded-xl text-sm font-medium hover:bg-black transition active:scale-95 shadow-md">
                            + Buat Subfolder
                        </button>
                    </form>
                </div>
                @endif

                {{-- Daftar Subfolder di Sidebar --}}
                @if (isset($isi_folder) && $isi_folder->children->count() > 0)
                <div>
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Di Folder Ini</h3>
                    <div class="space-y-2 max-h-[50vh] overflow-y-auto pr-1">
                        @foreach ($isi_folder->children as $index => $subfolder)
                        <div class="animate-item group flex items-center justify-between p-3 rounded-xl hover:bg-blue-50 transition-all duration-200 border border-gray-100 hover:border-blue-200"
                            style="animation-delay: {{ $index * 0.05 }}s">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <span class="text-lg">📂</span>
                                <div class="truncate">
                                    <a href="/folder_open/{{ $subfolder->id }}"
                                        class="text-sm font-semibold text-gray-700 truncate hover:text-blue-600 block">
                                        {{ $subfolder->nama_folder }}
                                    </a>
                                    <p class="text-[10px] text-gray-400">{{ $subfolder->created_at->format('d/m/y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="/rename_subfolder/{{ $subfolder->id }}" class="p-1.5 hover:bg-white rounded text-[10px]">✏️</a>
                                <a href="/hapus_subfolder/{{ $subfolder->id }}" class="p-1.5 hover:bg-white rounded text-red-500 text-[10px]">🗑️</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Notifikasi Session --}}
                @if (session('status') || session('notif') || session('nama_tampil'))
                <div class="mt-6 p-4 bg-blue-50 rounded-2xl border border-blue-100 text-xs text-blue-700 animate-bounce">
                    ✨ {{ session('status') ?? session('notif') ?? session('nama_tampil') }}
                </div>
                @endif

            </div>
        </aside>

    </div>

</body>
</html>