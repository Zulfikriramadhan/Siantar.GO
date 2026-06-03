<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Kelayakan Driver - Siantar.Go</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        @media print {
            @page { size: A5 landscape; margin: 0.5cm; }
            .no-print { display: none !important; }
            body { background-color: white !important; color: #0f172a !important; padding: 0 !important; margin: 0 !important; }
            .print-card { box-shadow: none !important; border: 1px solid #cbd5e1 !important; margin: 0 !important; width: 100% !important; padding: 1rem !important; border-radius: 0.5rem !important; }
        }
    </style>
</head>
<body class="bg-slate-100 font-sans min-h-screen py-12 px-4 flex flex-col justify-center text-slate-800">

    <div class="max-w-xl mx-auto w-full">

        @if($driver->status_verifikasi == 'Disetujui')
            <div class="bg-white shadow-2xl rounded-3xl p-6 border border-slate-200 print-card relative overflow-hidden">

                <div class="text-center border-b-4 border-double border-slate-800 pb-2 mb-4">
                    <h1 class="text-base font-black text-slate-950 uppercase tracking-wide">RSUD CHASAN BOESOIRIE TERNATE</h1>
                    <p class="text-[10px] text-slate-500 font-medium">Jl. Cempaka, Tanah Tinggi, Kota Ternate, Maluku Utara</p>
                    <div class="mt-1.5 inline-block px-2.5 py-0.5 bg-emerald-50 text-emerald-700 text-[10px] font-extrabold rounded uppercase tracking-wider border border-emerald-200/40">
                        SURAT TUGAS DIGITAL MITRA DRIVER
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 items-start mb-3">

                    <div class="col-span-2 space-y-2 text-xs text-slate-700 font-medium">
                        <div class="flex items-center gap-3 bg-slate-50 p-2 border border-slate-200/50 rounded-xl">
                            @if($driver->foto_wajah)
                                <img src="{{ asset('storage/' . $driver->foto_wajah) }}" class="w-14 h-14 rounded-lg object-cover border-2 border-white shadow-xs">
                            @endif
                            <div>
                                <div class="text-[9px] font-bold text-slate-400 uppercase">Nama Pengemudi</div>
                                <h2 class="text-sm font-black text-slate-900 tracking-tight">{{ $driver->nama_lengkap }}</h2>
                                <p class="text-[9px] text-emerald-600 font-mono font-bold">ID: SG-00{{ $driver->id }}</p>
                            </div>
                        </div>

                        <table class="w-full text-left font-semibold border-collapse text-[11px]">
                            <tr class="border-b border-slate-100"><td class="py-1 w-24 text-slate-400">NIK KTP</td><td class="py-1 text-slate-900 font-mono">: {{ $driver->nik }}</td></tr>
                            <tr class="border-b border-slate-100"><td class="py-1 w-24 text-slate-400">No. WhatsApp</td><td class="py-1 text-slate-900">: {{ $driver->no_whatsapp }}</td></tr>
                            <tr class="border-b border-slate-100"><td class="py-1 w-24 text-slate-400">Kendaraan (Tipe)</td><td class="py-1 text-slate-900">: {{ $driver->jenis_kendaraan }} ({{ $driver->tipe_kendaraan ?? '-' }})</td></tr>
                            <tr class="border-b border-slate-100"><td class="py-1 w-24 text-slate-400">Nomor Plat</td><td class="py-1 text-slate-900 font-mono uppercase">: {{ $driver->nomor_plat }}</td></tr>
                        </table>
                    </div>

                    <div class="text-center p-2 border border-slate-200 bg-slate-50/50 rounded-xl h-full flex flex-col justify-between">
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-wide">Tanda Tangan Mitra</p>
                        @if($driver->ttd_driver)
                            <img src="{{ $driver->ttd_driver }}" alt="TTD Driver" class="w-24 mx-auto my-1 object-contain mix-blend-multiply max-h-16">
                        @else
                            <div class="h-12 flex items-center justify-center text-[10px] text-slate-300">Kosong</div>
                        @endif
                        <p class="text-[10px] font-bold text-slate-900 border-t border-slate-200 pt-1 truncate">{{ $driver->nama_lengkap }}</p>
                    </div>
                </div>

                <div class="space-y-3 text-xs text-slate-700 font-medium">
                    <div class="p-2.5 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl text-emerald-900 text-[11px] leading-normal">
                        Dinyatakan sah dan layak sebagai mitra resmi pengantar obat RSUD Chasan Boesoirie. Surat tugas ini berlaku sebagai akses validasi pengambilan obat di instalasi farmasi.
                    </div>

                    <div class="flex justify-end pt-1">
                        <div class="text-center w-40 relative">
                            <p class="text-[10px] text-slate-400">Ternate, {{ date('d M Y') }}</p>
                            <p class="text-[11px] font-black text-slate-800">Sistem Administrasi RSUD</p>

                            <div class="w-full h-14 flex items-center justify-center relative my-0.5">
                                @if($driver->ttd_admin)
                                    <img src="{{ $driver->ttd_admin }}" alt="TTD Admin" class="absolute w-24 object-contain mix-blend-multiply max-h-14 z-10">
                                @endif
                                <div class="text-emerald-600/10 font-black tracking-widest text-xs border border-dashed border-emerald-400/30 px-2 py-0.5 rounded uppercase select-none">VALIDATED</div>
                            </div>

                            <p class="text-[10px] font-black text-slate-700 border-t border-slate-200 pt-0.5 uppercase tracking-wider">Manajemen RSUD</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex gap-3 no-print">
                    <button onclick="window.print()" class="flex-1 py-3 px-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-xl text-xs sm:text-sm tracking-wide shadow-md cursor-pointer text-center">
                        🖨️ Cetak Surat Tugas (A5 Landscape)
                    </button>
                    <a href="{{ route('driver.form') }}" class="py-3 px-5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs sm:text-sm text-center">Kembali</a>
                </div>
            </div>

        @elseif($driver->status_verifikasi == 'Pending')
            <div class="bg-white shadow-2xl rounded-3xl p-8 border border-amber-200 text-center max-w-md mx-auto">
                <h2 class="text-xl font-black text-slate-900">Berkas Sedang Ditinjau</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2">Pendaftaran Anda saat ini masih berstatus <span class="px-2 py-0.5 bg-amber-50 text-amber-700 font-bold border rounded">Pending</span>.</p>
                <div class="mt-6 pt-4 border-t"><a href="{{ route('driver.form') }}" class="inline-block py-2.5 px-6 bg-slate-900 text-white rounded-xl text-xs font-bold">Kembali</a></div>
            </div>
        @else
            <div class="bg-white shadow-2xl rounded-3xl p-8 border border-rose-200 text-center max-w-md mx-auto">
                <h2 class="text-xl font-black text-rose-600">Permohonan Ditolak</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2">Maaf, pendaftaran Anda ditolak oleh manajemen rumah sakit.</p>
                <div class="mt-6 pt-4 border-t"><a href="{{ route('driver.form') }}" class="inline-block py-2.5 px-6 bg-slate-900 text-white rounded-xl text-xs font-bold">Kembali</a></div>
            </div>
        @endif
    </div>
</body>
</html>
