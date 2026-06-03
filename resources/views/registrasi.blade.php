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
        <a href="{{ route('beranda') }}" class="text-xs sm:text-sm text-emerald-400 font-bold flex items-center gap-1 group">
            <span>&larr;</span> Kembali ke Beranda Utama
        </a>
    </div>

    <div class="sm:mx-auto w-full max-w-md text-center relative z-10 px-4">
        <h1 class="text-4xl font-black text-white tracking-tight">Siantar.<span class="text-emerald-400">Go</span></h1>
        <p class="mt-2 text-sm text-slate-200">Pendaftaran Driver Pengantar Obat <br><span class="font-bold text-white">RSUD Chasan Boesoirie</span></p>
    </div>

    <div class="mt-8 sm:mx-auto w-full max-w-md px-4 sm:px-0 relative z-10">
        <div class="bg-white/95 backdrop-blur-md py-8 px-4 shadow-2xl rounded-2xl border border-slate-200 sm:px-10">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-xl text-emerald-800 text-xs sm:text-sm font-semibold">🎉 {{ session('success') }}</div>
            @endif

            <form action="{{ route('driver.simpan') }}" method="POST" enctype="multipart/form-data" id="formReg" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase">Nama Lengkap (Sesuai KTP)</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm focus:outline-emerald-500">
                    @error('nama_lengkap') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase">NIK (KTP)</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm font-mono focus:outline-emerald-500">
                    @error('nik') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase">No. WhatsApp</label>
                    <input type="text" name="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="Contoh: 0812345678" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm focus:outline-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase">Jenis Kendaraan</label>
                    <select name="jenis_kendaraan" required class="mt-1 block w-full px-3 py-2 border border-slate-300 bg-white rounded-xl text-sm">
                        <option value="">-- Pilih Kendaraan --</option>
                        <option value="Motor">Sepeda Motor</option>
                        <option value="Mobil">Mobil / Ambulans</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase">Merk & Tipe Kendaraan</label>
                    <input type="text" name="tipe_kendaraan" value="{{ old('tipe_kendaraan') }}" placeholder="Contoh: Honda Vario 150" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm focus:outline-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase">Nomor Plat Kendaraan</label>
                    <input type="text" name="nomor_plat" value="{{ old('nomor_plat') }}" placeholder="DG XXXX XX" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm font-mono uppercase focus:outline-emerald-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase">Alamat Lengkap Domisili</label>
                    <textarea name="alamat" rows="2" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-xl bg-white text-sm focus:outline-emerald-500">{{ old('alamat') }}</textarea>
                </div>

                <div class="grid grid-cols-1 gap-3 pt-2">
                    <div class="p-3 border border-dashed border-emerald-300 rounded-xl bg-emerald-50/30">
                        <label class="block text-xs font-bold text-emerald-800 uppercase mb-1">Pas Foto Wajah Resmi</label>
                        <input type="file" name="foto_wajah" accept="image/*" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-600 file:text-white">
                    </div>
                    <div class="p-3 border border-dashed border-slate-200 rounded-xl bg-slate-50/50">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Foto SIM Aktif</label>
                        <input type="file" name="foto_sim" accept="image/*" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-800 file:text-white">
                    </div>
                    <div class="p-3 border border-dashed border-slate-200 rounded-xl bg-slate-50/50">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Foto STNK Aktif</label>
                        <input type="file" name="foto_stnk" accept="image/*" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-800 file:text-white">
                    </div>
                </div>

                <div class="p-3 border-2 border-dashed border-slate-300 rounded-xl bg-slate-50/70">
                    <label class="block text-xs font-bold text-slate-800 uppercase text-center mb-1">✍️ Goreskan Tanda Tangan Anda Disini</label>
                    <div class="bg-white rounded-lg border border-slate-200 shadow-2xs overflow-hidden relative">
                        <canvas id="signature-pad-driver" class="w-full h-32 cursor-crosshair bg-white"></canvas>
                    </div>
                    <div class="flex justify-end mt-1.5">
                        <button type="button" id="clear-btn" class="px-2.5 py-1 text-[10px] font-bold text-rose-600 bg-rose-50 border border-rose-200 rounded-md cursor-pointer">Hapus Ulang</button>
                    </div>
                    <input type="hidden" name="ttd_driver" id="ttd_driver_input">
                    @error('ttd_driver') <span class="text-xs text-rose-500 text-center block mt-1">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full py-3 px-4 rounded-xl text-white bg-gradient-to-r from-emerald-600 to-teal-600 font-black text-sm tracking-wide shadow-md shadow-emerald-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5 cursor-pointer text-center block">KIRIM BERKAS PENDAFTARAN</button>
            </form>
        </div>
    </div>

    <div class="mt-6 sm:mx-auto w-full max-w-md mb-12 px-4 sm:px-0 relative z-10">
        <div class="bg-slate-900/90 backdrop-blur-md py-6 px-4 shadow-2xl rounded-2xl border border-slate-800 sm:px-10">
            <h3 class="text-xs font-bold text-slate-300 mb-3 text-center uppercase tracking-widest">🔍 Periksa Hasil Kelayakan Seleksi</h3>
            <form action="{{ route('driver.cek-status') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <input type="text" name="nik" placeholder="Masukkan 16 digit NIK KTP Anda..." required class="block w-full px-4 py-2.5 border border-slate-700 rounded-xl bg-slate-800 text-white text-sm font-mono focus:outline-none focus:border-emerald-500 placeholder-slate-500">
                </div>
                <button type="submit" class="w-full py-2 px-4 rounded-xl text-emerald-400 bg-emerald-500/10 border border-emerald-500/30 font-bold text-xs tracking-wide cursor-pointer text-center block">PERIKSA STATUS DRIVER</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script>
        const canvas = document.getElementById('signature-pad-driver');
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 0)'
        });

        // Menyesuaikan ukuran resolusi internal kanvas
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear();
        }
        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();

        // Tombol hapus ulang kanvas
        document.getElementById('clear-btn').addEventListener('click', function() {
            signaturePad.clear();
        });

        // Kunci gambar ttd jadi data string sebelum form dikirim
        document.getElementById('formReg').addEventListener('submit', function(e) {
            if (signaturePad.isEmpty()) {
                e.preventDefault();
                alert("Harap isi dan bubuhkan tanda tangan pendaftaran Anda terlebih dahulu!");
            } else {
                document.getElementById('ttd_driver_input').value = signaturePad.toDataURL('image/png');
            }
        });
    </script>
</body>
</html>
