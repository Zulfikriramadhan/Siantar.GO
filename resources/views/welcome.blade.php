<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Siantar.Go</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="font-sans min-h-screen flex flex-col justify-between bg-cover bg-center bg-no-repeat relative text-slate-800"
      style="background-image: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1920&q=80');">

    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/85 to-slate-900/75 z-0"></div>

    <header class="bg-white/90 backdrop-blur-md shadow-xs border-b border-slate-200/80 py-4 px-4 sm:px-12 flex justify-between items-center relative z-10 sticky top-0">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center shadow-md shadow-emerald-200">
                <span class="text-white font-black text-lg tracking-tighter">S</span>
            </div>
            <h1 class="text-lg sm:text-xl font-black text-slate-950 tracking-tight">
                Siantar.<span class="text-emerald-600">Go</span>
                <span class="text-xs font-semibold text-slate-400 block sm:inline sm:ml-2 border-l sm:border-slate-200 sm:pl-2">RSUD Chasan Boesoirie</span>
            </h1>
        </div>
        <div>
            <a href="{{ route('login') }}" class="px-4 py-2 bg-slate-900 text-white rounded-xl hover:bg-slate-800 font-bold text-xs sm:text-sm shadow-md transition-all duration-300 hover:-translate-y-0.5 flex items-center gap-1 cursor-pointer">
                🔒 Panel Admin RSUD
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-12 sm:py-20 text-center flex-grow flex flex-col justify-center items-center relative z-10">
        <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 text-xs font-bold rounded-full border border-emerald-500/20 uppercase tracking-widest mb-4">Official Mitra Portal</span>
        <h1 class="text-4xl sm:text-5xl font-black text-white tracking-tight leading-tight">
            Selamat Datang di Website <span class="bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">Siantar.Go</span>
        </h1>
        <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl font-medium leading-relaxed">
            Sistem Informasi Manajemen Kombinasi dan Registrasi Mandiri Driver Pengantar Obat Terintegrasi internal RSUD Chasan Boesoirie Ternate.
        </p>

        <div class="mt-10 bg-white/95 backdrop-blur-md p-6 sm:p-8 rounded-2xl shadow-2xl border border-slate-100 text-left w-full max-w-3xl transform transition-all duration-500 hover:scale-[1.01]">
            <h3 class="text-md font-bold text-slate-900 uppercase tracking-wide border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <span class="p-1.5 bg-emerald-50 text-emerald-600 rounded-lg text-sm">📦</span> Apa itu Driver Pengantar Obat Siantar.Go?
            </h3>
            <p class="text-sm text-slate-600 leading-relaxed font-medium">
                Mitra Driver Siantar.Go adalah layanan pengantaran obat resmi yang bertugas menjembatani instalasi farmasi rumah sakit langsung ke tangan pasien di rumah. Layanan ini dibentuk untuk memangkas waktu antrean panjang di loket obat RSUD Chasan Boesoirie, sekaligus memastikan sediaan obat kronis maupun reguler sampai ke alamat pasien secara cepat, higienis, dan aman menggunakan moda transportasi yang telah terverifikasi kelayakannya oleh manajemen RSUD.
            </p>
        </div>

        <div class="mt-10 w-full max-w-md">
            <a href="{{ route('driver.form') }}" class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-black text-sm tracking-wide shadow-lg shadow-emerald-900/30 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 text-center block cursor-pointer">
                🚗 DAFTAR MENJADI MITRA DRIVER
            </a>
        </div>
    </main>

    <footer class="bg-slate-950/90 text-center py-4 text-xs text-slate-500 relative z-10 border-t border-slate-900">
        &copy; {{ date('Y') }} Siantar.Go | RSUD Chasan Boesoirie Ternate. All Rights Reserved.
    </footer>

</body>
</html>
