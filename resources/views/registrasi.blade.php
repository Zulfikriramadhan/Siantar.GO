<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siantar.Go - Registrasi Driver RSUD</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-cover bg-center bg-no-repeat flex flex-col justify-center py-12 relative min-h-screen text-slate-800"
      style="background-image: url('https://images.unsplash.com/photo-1524645343120-a4ae9f7d4343?auto=format&fit=crop&w=1920&q=80');">

    <div class="absolute inset-0 bg-slate-950/70 z-0"></div>

    <div class="sm:mx-auto w-full max-w-md mb-4 px-4 sm:px-0 relative z-10">
        <a href="{{ route('beranda') }}" class="text-xs sm:text-sm text-emerald-400 hover:text-emerald-300 font-bold flex items-center gap-1 transition-colors group">
            <span class="group-hover:-translate-x-1 transition-transform">&larr;</span> Kembali ke Beranda Utama
        </a>
    </div>

    <div class="sm:mx-auto w-full max-w-md text-center relative z-10 px-4">
        <h1 class="text-4xl font-black text-white tracking-tight">Siantar.<span class="text-emerald-400">Go</span></h1>
        <p class="mt-2 text-sm text-slate-200">Pendaftaran Driver Pengantar Obat <br><span class="font-bold text-white">RSUD Chasan Boesoirie</span></p>
    </div>

    <div class="mt-8 sm:mx-auto w-full max-w-md px-4 sm:px-0 relative z-10">
        <div class="bg-white/95 backdrop-blur-md py-8 px-4 shadow-2xl rounded-2xl border border-slate-200/80 sm:px-10">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl text-emerald-800 text-xs sm:text-sm font-semibold shadow-xs">🎉 {{ session('success') }}</div>
            @endif

            <form action="{{ route('driver.simpan') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Nama Lengkap (Sesuai KTP)</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 font-medium transition-all">
                    @error('nama_lengkap') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm font-mono focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                    @error('nik') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide">No. WhatsApp Aktif</label>
                    <input type="text" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="Contoh: 0812345678" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                    @error('no_whatsapp') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Jenis Kendaraan</label>
                    <select name="jenis_kendaraan" required class="mt-1 block w-full px-3 py-2 border border-slate-300 bg-white rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 text-sm font-medium transition-all">
                        <option value="">-- Pilih Kendaraan --</option>
                        <option value="Motor">Sepeda Motor</option>
                        <option value="Mobil">Mobil / Ambulans</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Merk & Tipe Kendaraan</label>
                    <input type="text" name="tipe_kendaraan" value="{{ old('tipe_kendaraan') }}" placeholder="Contoh: Honda Vario 150 / Toyota Avanza" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 font-medium transition-all">
                    @error('tipe_kendaraan') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Nomor Plat Kendaraan</label>
                    <input type="text" name="nomor_plat" value="{{ old('nomor_plat') }}" placeholder="Contoh: DG 1234 AA" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm font-mono uppercase focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide">Alamat Lengkap Domisili</label>
                    <textarea name="alamat" rows="2" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 font-medium transition-all">{{ old('alamat') }}</textarea>
                </div>

                <!-- Bagian File Input (Ditambahkan Unggah Foto Wajah) -->
                <div class="grid grid-cols-1 gap-3 pt-2">
                    <div class="p-3 border border-dashed border-emerald-300 rounded-xl bg-emerald-50/30">
                        <label class="block text-xs font-bold text-emerald-800 uppercase mb-1">Pas Foto Wajah Resmi (Terlihat Jelas)</label>
                        <input type="file" name="foto_wajah" accept="image/*" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 transition-all file:cursor-pointer">
                        @error('foto_wajah') <span class="text-xs text-rose-500 block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="p-3 border border-dashed border-slate-200 rounded-xl bg-slate-50/50">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Foto SIM Aktif</label>
                        <input type="file" name="foto_sim" accept="image/*" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-800 file:text-white hover:file:bg-slate-900 transition-all file:cursor-pointer">
                        @error('foto_sim') <span class="text-xs text-rose-500 block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="p-3 border border-dashed border-slate-200 rounded-xl bg-slate-50/50">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Foto STNK Aktif</label>
                        <input type="file" name="foto_stnk" accept="image/*" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-800 file:text-white hover:file:bg-slate-900 transition-all file:cursor-pointer">
                        @error('foto_stnk') <span class="text-xs text-rose-500 block mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="w-full py-3 px-4 rounded-xl text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 font-black text-sm tracking-wide shadow-md shadow-emerald-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5 cursor-pointer text-center block">KIRIM BERKAS PENDAFTARAN</button>
            </form>
        </div>
    </div>

    <div class="mt-6 sm:mx-auto w-full max-w-md mb-12 px-4 sm:px-0 relative z-10">
        <div class="bg-slate-900/90 backdrop-blur-md py-6 px-4 shadow-2xl rounded-2xl border border-slate-800 sm:px-10">
            <h3 class="text-xs font-bold text-slate-300 mb-3 text-center uppercase tracking-widest">🔍 Periksa Hasil Kelayakan Seleksi</h3>
            <form action="{{ route('driver.cek-status') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <input type="text" name="nik" placeholder="Masukkan 16 digit NIK KTP Anda..." required
                        class="block w-full px-4 py-2.5 border border-slate-700 rounded-xl bg-slate-800 text-white text-sm font-mono focus:outline-none focus:border-emerald-500 placeholder-slate-500">
                    @error('nik') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="w-full py-2 px-4 rounded-xl text-emerald-400 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/30 font-bold text-xs tracking-wide transition-all duration-300 cursor-pointer text-center block">
                    PERIKSA STATUS DRIVER
                </button>
            </form>
        </div>
    </div>
</body>
</html>
