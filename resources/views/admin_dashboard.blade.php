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
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center shadow-md">
                <span class="text-white font-black text-xl tracking-tighter">S</span>
            </div>
            <h1 class="text-xl font-black text-slate-950 tracking-tight">Siantar.<span class="text-emerald-600">Go</span> <span class="text-xs font-semibold text-slate-400">| Panel RSUD</span></h1>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('driver.form') }}" target="_blank" class="text-xs sm:text-sm text-emerald-600 font-bold">Form Driver &rarr;</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold text-rose-600 bg-rose-50 cursor-pointer">🚪 Keluar</button>
            </form>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6">
        <!-- Pencarian -->
        <div class="mb-6">
            <form action="{{ route('admin.dashboard') }}" method="GET" class="w-full md:w-auto flex gap-2">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau NIK..." class="w-full md:w-80 px-4 py-2 border border-slate-300 rounded-xl bg-white text-sm focus:outline-emerald-500 font-medium">
                <button type="submit" class="px-5 py-2 bg-slate-900 text-white rounded-xl text-sm font-bold cursor-pointer">Cari</button>
            </form>
        </div>

        <!-- Tabel Admin Utama -->
        <div class="bg-white shadow-xl rounded-2xl border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto w-full">
                <table class="min-w-full text-left text-xs sm:text-sm text-slate-600">
                    <thead class="bg-slate-50 text-xs uppercase text-slate-500 font-bold border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4">Driver (Profil)</th>
                            <th class="px-6 py-4">WhatsApp</th>
                            <th class="px-6 py-4">Kendaraan</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($drivers as $driver)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <!-- Kolom Profil Driver -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($driver->foto_wajah)
                                            <img src="{{ asset('storage/' . $driver->foto_wajah) }}" class="w-11 h-11 rounded-full object-cover border">
                                        @else
                                            <div class="w-11 h-11 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold text-xs">No Pic</div>
                                        @endif
                                        <div>
                                            <div class="font-bold text-slate-900 text-sm sm:text-base">{{ $driver->nama_lengkap }}</div>
                                            <div class="text-[11px] text-slate-400 font-mono">NIK: {{ $driver->nik }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- UPDATE 1: KOLOM WHATSAPP BISA DIKLIK LANGSUNG KONEK OBROLAN -->
                                <td class="px-6 py-4 font-bold text-emerald-700">
                                    @php
                                        // Bersihkan nomor dari spasi atau karakter aneh
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $driver->no_whatsapp);
                                        // Ubah otomatis awalan 08 menjadi 628 agar link wa.me tidak error
                                        if (strpos($cleanPhone, '0') === 0) {
                                            $cleanPhone = '62' . substr($cleanPhone, 1);
                                        }
                                    @endphp
                                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="inline-flex items-center gap-1.5 hover:text-emerald-500 transition-colors group" title="Klik untuk chat WhatsApp">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span class="underline decoration-dotted group-hover:decoration-solid">{{ $driver->no_whatsapp }}</span>
                                    </a>
                                </td>

                                <!-- UPDATE 2: PERBAIKAN KOLOM KENDARAAN AGAR MERK & TIPE MUNCUL PASTI -->
                                <td class="px-6 py-4">
                                    <span class="px-2 py-0.5 text-[10px] bg-slate-100 border border-slate-200 font-bold rounded uppercase tracking-wider text-slate-700">{{ $driver->jenis_kendaraan }}</span>

                                    <!-- Memaksa kemunculan merk tipe kendaraan secara eksplisit -->
                                    <div class="text-xs text-slate-900 font-bold mt-1.5">
                                        {{ $driver->tipe_kendaraan ?? 'Tipe Tidak Diisi' }}
                                    </div>

                                    <div class="text-[11px] text-slate-400 font-mono mt-0.5 uppercase">{{ $driver->nomor_plat }}</div>
                                </td>

                                <!-- Kolom Status -->
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-[11px] font-black rounded-full uppercase border {{ $driver->status_verifikasi == 'Pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : ($driver->status_verifikasi == 'Disetujui' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-red-50 text-red-700 border-red-200') }}">
                                        {{ $driver->status_verifikasi }}
                                    </span>
                                </td>

                                <!-- Kolom Aksi -->
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-1.5">
                                        @if($driver->status_verifikasi == 'Pending')
                                            <button onclick="openApprovalModal({{ $driver->id }}, '{{ $driver->nama_lengkap }}')" class="px-3 py-1.5 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700 cursor-pointer">Setuju</button>
                                            <form action="{{ route('admin.verifikasi', $driver->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="Ditolak">
                                                <button class="px-3 py-1.5 bg-white text-rose-600 border border-slate-200 text-xs font-bold rounded-lg hover:bg-rose-50 cursor-pointer">Tolak</button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-400 font-medium">Selesai Diverifikasi</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-12 text-center text-slate-400 font-bold">Data driver kosong.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL BOX POPUP UNTUK TANDA TANGAN DIGITAL ADMIN -->
    <div id="approvalModal" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl border border-slate-200 overflow-hidden transform transition-all p-6">
            <h3 class="text-lg font-black text-slate-900 uppercase">Persetujuan Kemitraan</h3>
            <p class="text-xs text-slate-500 mt-1">Anda menyetujui <span id="modal-driver-name" class="font-bold text-slate-800"></span> sebagai Driver Pengantar Obat. Silakan bubuhkan TTD Elektronik Admin di bawah ini:</p>

            <form action="" method="POST" id="formApprove" class="mt-4 space-y-4">
                @csrf
                <input type="hidden" name="status" value="Disetujui">
                <input type="hidden" name="ttd_admin" id="ttd_admin_input">

                <div class="border-2 border-dashed border-slate-300 rounded-xl p-2 bg-slate-50">
                    <canvas id="signature-pad-admin" class="w-full h-36 bg-white rounded-lg border border-slate-200 cursor-crosshair"></canvas>
                </div>

                <div class="flex justify-between items-center">
                    <button type="button" id="clear-admin-btn" class="px-2.5 py-1 text-[10px] font-bold text-rose-600 bg-rose-50 border border-rose-200 rounded-md cursor-pointer">Reset Coretan</button>
                    <div class="flex gap-2">
                        <button type="button" onclick="closeApprovalModal()" class="px-4 py-2 bg-slate-100 text-slate-700 font-bold rounded-xl text-xs cursor-pointer">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white font-bold rounded-xl text-xs shadow-md cursor-pointer">Kunci & Validasi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script TTD Admin -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script>
        const modal = document.getElementById('approvalModal');
        const adminCanvas = document.getElementById('signature-pad-admin');
        const adminSignaturePad = new SignaturePad(adminCanvas, { backgroundColor: 'rgba(255, 255, 255, 0)' });

        function openApprovalModal(id, name) {
            document.getElementById('modal-driver-name').innerText = name;
            document.getElementById('formApprove').action = `/admin/verifikasi/${id}`;
            modal.classList.remove('hidden');

            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            adminCanvas.width = adminCanvas.offsetWidth * ratio;
            adminCanvas.height = adminCanvas.offsetHeight * ratio;
            adminCanvas.getContext("2d").scale(ratio, ratio);
            adminSignaturePad.clear();
        }

        function closeApprovalModal() {
            modal.classList.add('hidden');
        }

        document.getElementById('clear-admin-btn').addEventListener('click', function() {
            adminSignaturePad.clear();
        });

        document.getElementById('formApprove').addEventListener('submit', function(e) {
            if (adminSignaturePad.isEmpty()) {
                e.preventDefault();
                alert("Wajib membubuhkan tanda tangan penanggung jawab RSUD terlebih dahulu sebelum disetujui!");
            } else {
                document.getElementById('ttd_admin_input').value = adminSignaturePad.toDataURL('image/png');
            }
        });
    </script>
</body>
</html>
