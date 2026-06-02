<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin RSUD - Siantar.Go</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        @media print {
            nav, .no-print, form, th:last-child, td:last-child, .stat-card {
                display: none !important;
            }
            body { background-color: white; }
            .print-container { max-w: 100% !important; padding: 0 !important; }
        }
    </style>
</head>
<body class="bg-slate-50 font-sans min-h-screen text-slate-800">

    <!-- Navbar -->
    <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 shadow-xs border-b border-slate-200/80 py-4 px-4 sm:px-8 flex flex-col sm:flex-row justify-between items-center gap-3">
        <div class="flex items-center gap-3 w-full sm:w-auto justify-center sm:justify-start">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center shadow-md shadow-emerald-200">
                <span class="text-white font-black text-xl tracking-tighter">S</span>
            </div>
            <h1 class="text-xl font-black text-slate-950 tracking-tight text-center sm:text-left">
                Siantar.<span class="text-emerald-600">Go</span>
                <span class="text-xs font-semibold text-slate-400 block sm:inline sm:ml-2 border-sm border-slate-200 sm:pl-2">Panel RSUD Chasan Boesoirie</span>
            </h1>
        </div>

        <div class="flex items-center justify-between sm:justify-end w-full sm:w-auto gap-4 pt-3 sm:pt-0">
            <a href="{{ route('driver.form') }}" target="_blank" class="text-xs sm:text-sm text-emerald-600 hover:text-emerald-700 font-bold">Form Driver &rarr;</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-rose-600 bg-rose-50 hover:bg-rose-100 cursor-pointer">🚪 Keluar</button>
            </form>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 print-container">
        <!-- Statistik -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8 no-print stat-card">
            <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs flex items-center gap-4">
                <div class="text-xl bg-blue-50 p-2 rounded-xl">👥</div>
                <div><p class="text-xs font-bold text-slate-400 uppercase">Total</p><h3 class="text-xl font-black">{{ $drivers->count() }}</h3></div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs flex items-center gap-4">
                <div class="text-xl bg-emerald-50 p-2 rounded-xl">✅</div>
                <div><p class="text-xs font-bold text-slate-400 uppercase">Disetujui</p><h3 class="text-xl font-black text-emerald-600">{{ $drivers->where('status_verifikasi', 'Disetujui')->count() }}</h3></div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs flex items-center gap-4">
                <div class="text-xl bg-amber-50 p-2 rounded-xl">⏳</div>
                <div><p class="text-xs font-bold text-slate-400 uppercase">Pending</p><h3 class="text-xl font-black text-amber-600">{{ $drivers->where('status_verifikasi', 'Pending')->count() }}</h3></div>
            </div>
            <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs flex items-center gap-4">
                <div class="text-xl bg-rose-50 p-2 rounded-xl">❌</div>
                <div><p class="text-xs font-bold text-slate-400 uppercase">Ditolak</p><h3 class="text-xl font-black text-rose-600">{{ $drivers->where('status_verifikasi', 'Ditolak')->count() }}</h3></div>
            </div>
        </div>

        <!-- Aksi & Pencarian -->
        <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4 no-print">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="w-full md:w-auto flex gap-2">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau NIK..." class="w-full md:w-80 px-4 py-2 border border-slate-300 rounded-xl bg-white text-sm focus:outline-emerald-500 font-medium">
                <button type="submit" class="px-5 py-2 bg-slate-900 text-white rounded-xl text-sm font-bold cursor-pointer">Cari</button>
            </form>
            <button onclick="window.print()" class="w-full md:w-auto px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-xl text-sm shadow-md cursor-pointer text-center">🖨️ Cetak Laporan Resmi</button>
        </div>

        <!-- Tabel Admin Utama -->
        <div class="bg-white shadow-xl rounded-2xl border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto w-full">
                <table class="min-w-full text-left text-xs sm:text-sm text-slate-600 whitespace-nowrap sm:whitespace-normal">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500 font-bold border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4">Driver (Profil)</th> <!-- Kolom Diubah -->
                            <th class="px-6 py-4">WhatsApp</th>
                            <th class="px-6 py-4">Kendaraan</th>
                            <th class="px-6 py-4">Alamat</th>
                            <th class="px-6 py-4">Berkas Legalitas</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center no-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($drivers as $driver)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <!-- UPDATE: KOLOM NAMA + RENDERING FOTO WAJAH DRIVER -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($driver->foto_wajah)
                                            <img src="{{ asset('storage/' . $driver->foto_wajah) }}" alt="Foto Driver" class="w-11 h-11 rounded-full object-cover border border-slate-200 shadow-2xs">
                                        @else
                                            <div class="w-11 h-11 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold text-xs">No Pic</div>
                                        @endif
                                        <div>
                                            <div class="font-bold text-slate-900 text-sm sm:text-base tracking-tight">{{ $driver->nama_lengkap }}</div>
                                            <div class="text-[11px] sm:text-xs text-slate-400 font-mono">NIK: {{ $driver->nik }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <a href="https://wa.me/{{ $driver->no_whatsapp }}" target="_blank" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200/40">
                                        {{ $driver->no_whatsapp }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-0.5 text-[10px] bg-slate-100 text-slate-700 font-bold rounded border border-slate-200 uppercase">{{ $driver->jenis_kendaraan }}</span>
                                    <div class="text-xs text-slate-800 font-bold mt-1">{{ $driver->tipe_kendaraan ?? '-' }}</div>
                                    <div class="text-[11px] text-slate-400 font-mono">{{ $driver->nomor_plat }}</div>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-500 max-w-xs truncate">{{ $driver->alamat }}</td>
                                <td class="px-6 py-4 space-y-1">
                                    @if($driver->foto_sim) <a href="{{ asset('storage/' . $driver->foto_sim) }}" target="_blank" class="text-xs text-blue-600 font-bold block hover:underline">🪪 Berkas SIM</a> @endif
                                    @if($driver->foto_stnk) <a href="{{ asset('storage/' . $driver->foto_stnk) }}" target="_blank" class="text-xs text-teal-600 font-bold block hover:underline">📄 Berkas STNK</a> @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-[11px] font-black rounded-full uppercase border {{ $driver->status_verifikasi == 'Pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : ($driver->status_verifikasi == 'Disetujui' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200') }}">
                                        {{ $driver->status_verifikasi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center no-print">
                                    <div class="flex items-center justify-center space-x-1.5">
                                        <form action="{{ route('admin.verifikasi', $driver->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="Disetujui">
                                            <button class="px-2.5 py-1.5 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700 cursor-pointer">Setuju</button>
                                        </form>
                                        <form action="{{ route('admin.verifikasi', $driver->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="Ditolak">
                                            <button class="px-2.5 py-1.5 bg-white text-rose-600 border border-slate-200 text-xs font-bold rounded-lg hover:bg-rose-50 cursor-pointer">Tolak</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-6 py-12 text-center text-slate-400 font-bold">Data driver tidak ditemukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
