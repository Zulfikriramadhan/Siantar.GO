<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Kelayakan Driver - Siantar.Go</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* CSS Khusus Optimasi Cetak Ukuran Kertas A5 */
        @media print {
            /* Atur spesifikasi ukuran kertas A5 secara landscape agar pas membagi dua HVS */
            @page {
                size: A5 landscape;
                margin: 0.5cm;
            }

            /* Sembunyikan semua elemen tombol dan background luar */
            .no-print {
                display: none !important;
            }

            body {
                background-color: white !important;
                color: #0f172a !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            /* Paksa card surat tugas memenuhi area kertas A5 secara presisi */
            .print-card {
                box-shadow: none !important;
                border: 1px solid #cbd5e1 !important;
                margin: 0 !important;
                max-w: 100% !important;
                width: 100% !important;
                padding: 1rem !important;
                border-radius: 0.5rem !important;
            }

            /* Penyesuaian ukuran teks dan gambar khusus saat dicetak di kertas kecil A5 */
            .print-kop-title { font-size: 14px !important; }
            .print-kop-sub { font-size: 10px !important; }
            .print-driver-img { width: 75px !important; height: 75px !important; }
            .print-text { font-size: 11px !important; }
            .print-badge { padding: 2px 6px !important; font-size: 9px !important; }
        }
    </style>
</head>
<body class="bg-slate-100 font-sans min-h-screen py-12 px-4 flex flex-col justify-center text-slate-800">

    <div class="max-w-xl mx-auto w-full">

        <!-- CASE 1: JIKA STATUS DISETUJUI (HALAMAN SURAT TUGAS A5) -->
        @if($driver->status_verifikasi == 'Disetujui')
            <div class="bg-white shadow-2xl rounded-3xl p-6 sm:p-8 border border-slate-200 print-card relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-full -mr-10 -mt-10 pointer-events-none no-print"></div>

                <!-- Kop Surat Resmi Rumah Sakit -->
                <div class="text-center border-b-4 border-double border-slate-800 pb-3 mb-4">
                    <h1 class="text-lg sm:text-xl font-black text-slate-950 tracking-wide uppercase print-kop-title">RSUD CHASAN BOESOIRIE TERNATE</h1>
                    <p class="text-[11px] text-slate-500 font-medium print-kop-sub">Jl. Cempaka, Tanah Tinggi, Kota Ternate, Maluku Utara</p>
                    <div class="mt-2 inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-extrabold rounded-md uppercase tracking-wider border border-emerald-200/50 print-badge">
                        SURAT TUGAS DIGITAL MITRA DRIVER
                    </div>
                </div>

                <!-- Bagian Profil Driver (Foto Wajah + Nama/NIK) -->
                <div class="flex flex-row items-center gap-4 bg-slate-50 p-3 rounded-2xl border border-slate-200/60 mb-4">
                    @if($driver->foto_wajah)
                        <img src="{{ asset('storage/' . $driver->foto_wajah) }}" alt="Foto Driver" class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl object-cover border-2 border-white shadow-md print-driver-img">
                    @else
                        <div class="w-20 h-20 bg-slate-200 flex items-center justify-center text-slate-400 font-bold text-xs border border-slate-300 rounded-xl print-driver-img">No Photo</div>
                    @endif
                    <div class="text-left flex-1">
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Pengemudi Resmi</div>
                        <h2 class="text-base sm:text-lg font-black text-slate-900 tracking-tight mt-0.5 print-kop-title">{{ $driver->nama_lengkap }}</h2>
                        <p class="text-[10px] text-emerald-600 font-mono font-bold mt-1 bg-emerald-50 inline-block px-2 py-0.5 rounded border border-emerald-200/40 print-badge">ID-SYSTEM: SG-00{{ $driver->id }}</p>
                    </div>
                </div>

                <!-- Detail Kendaraan & Penjelasan -->
                <div class="space-y-3 text-xs sm:text-sm text-slate-700 leading-relaxed font-medium print-text">
                    <p class="m-0">Menerangkan bahwa identitas kendaraan operasional di bawah ini:</p>

                    <table class="w-full text-left font-semibold border-collapse print-text">
                        <tr class="border-b border-slate-100"><td class="py-1 w-28 text-slate-400">NIK KTP</td><td class="py-1 text-slate-900 font-mono">: {{ $driver->nik }}</td></tr>
                        <tr class="border-b border-slate-100"><td class="py-1 w-28 text-slate-400">No. WhatsApp</td><td class="py-1 text-slate-900">: {{ $driver->no_whatsapp }}</td></tr>
                        <tr class="border-b border-slate-100"><td class="py-1 w-28 text-slate-400">Jenis Kendaraan</td><td class="py-2 text-slate-900">: {{ $driver->jenis_kendaraan }}</td></tr>
                        <tr class="border-b border-slate-100"><td class="py-1 w-28 text-slate-400">Merk & Tipe</td><td class="py-1 text-slate-900">: {{ $driver->tipe_kendaraan ?? '-' }}</td></tr>
                        <tr class="border-b border-slate-100"><td class="py-1 w-28 text-slate-400">Nomor Plat</td><td class="py-1 text-slate-900 font-mono uppercase">: {{ $driver->nomor_plat }}</td></tr>
                    </table>

                    <div class="p-3 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl text-emerald-900 text-xs font-semibold leading-normal print-text">
                        <strong class="text-emerald-800 block text-xs mb-0.5">STATUS VERIFIKASI: DISETUJUI (AKTIF)</strong>
                        Dinyatakan sah dan layak sebagai mitra resmi pengantar obat RSUD Chasan Boesoirie. Surat tugas ini berlaku sebagai akses validasi pengambilan sediaan obat di instalasi farmasi.
                    </div>

                    <!-- Bagian Tanda Tangan Mandiri -->
                    <div class="mt-4 flex justify-end pt-2">
                        <div class="text-center">
                            <p class="text-[10px] text-slate-400">Ternate, {{ date('d M Y') }}</p>
                            <p class="text-[11px] font-black text-slate-800 mt-0.5">Sistem Administrasi RSUD</p>
                            <div class="mt-1 text-emerald-600 font-black tracking-widest text-[9px] border border-dashed border-emerald-400 px-2 py-0.5 rounded-md uppercase bg-emerald-50/50 inline-block">
                                VALID & VERIFIED
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Navigasi Publik -->
                <div class="mt-6 flex gap-3 no-print">
                    <button onclick="window.print()" class="flex-1 py-3 px-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-xl text-xs sm:text-sm tracking-wide shadow-md transition-all duration-300 hover:-translate-y-0.5 cursor-pointer text-center">
                        🖨️ Cetak Surat Tugas (A5 Landscape)
                    </button>
                    <a href="{{ route('driver.form') }}" class="py-3 px-5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs sm:text-sm transition-all duration-300 text-center">
                        Kembali
                    </a>
                </div>
            </div>

        <!-- CASE 2: JIKA STATUS PENDING -->
        @elseif($driver->status_verifikasi == 'Pending')
            <div class="bg-white shadow-2xl rounded-3xl p-8 border border-amber-200 text-center max-w-md mx-auto">
                @if($driver->foto_wajah)
                    <img src="{{ asset('storage/' . $driver->foto_wajah) }}" alt="Foto Driver" class="w-20 h-20 rounded-full object-cover border-2 border-amber-200 mx-auto mb-3 shadow-sm">
                @else
                    <div class="w-16 h-16 bg-amber-50 border border-amber-200 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl shadow-sm">⏳</div>
                @endif
                <h2 class="text-xl font-black text-slate-900 tracking-tight">Berkas Sedang Ditinjau</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2 font-medium">Halo <strong>{{ $driver->nama_lengkap }}</strong>, pendaftaran Anda saat ini masih berstatus <span class="px-2 py-0.5 bg-amber-50 text-amber-700 border border-amber-200 rounded-md font-bold text-xs uppercase">Pending</span>.</p>
                <p class="text-xs text-slate-400 mt-2 leading-relaxed">Tim verifikator farmasi RSUD Chasan Boesoirie sedang meneliti keabsahan berkas KTP, SIM, dan STNK Anda. Silakan muat ulang halaman ini secara berkala.</p>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('driver.form') }}" class="inline-block py-2.5 px-6 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all duration-300">Kembali ke Beranda</a>
                </div>
            </div>

        <!-- CASE 3: JIKA STATUS DITOLAK -->
        @else
            <div class="bg-white shadow-2xl rounded-3xl p-8 border border-rose-200 text-center max-w-md mx-auto">
                @if($driver->foto_wajah)
                    <img src="{{ asset('storage/' . $driver->foto_wajah) }}" alt="Foto Driver" class="w-20 h-20 rounded-full object-cover border-2 border-rose-200 mx-auto mb-3 shadow-sm grayscale">
                @else
                    <div class="w-16 h-16 bg-rose-50 border border-rose-200 rounded-2xl flex items-center justify-center mx-auto mb-4 text-3xl shadow-sm">❌</div>
                @endif
                <h2 class="text-xl font-black text-rose-600 tracking-tight">Permohonan Ditolak</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2 font-medium">Maaf <strong>{{ $driver->nama_lengkap }}</strong>, pendaftaran kemitraan driver Anda ditolak oleh manajemen rumah sakit.</p>
                <p class="text-xs text-slate-400 mt-2 leading-relaxed">Penolakan disebabkan dokumen kurang jelas atau tidak valid. Silakan daftarkan ulang berkas Anda.</p>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ route('driver.form') }}" class="inline-block py-2.5 px-6 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition-all duration-300">Kembali</a>
                </div>
            </div>
        @endif

    </div>

</body>
</html>
