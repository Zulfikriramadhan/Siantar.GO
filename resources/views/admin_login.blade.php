<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Siantar.Go</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-cover bg-center bg-no-repeat flex flex-col justify-center min-h-screen py-12 sm:px-6 lg:px-8 relative"
      style="background-image: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1920&q=80');">

    <div class="absolute inset-0 bg-gray-900/60 z-0"></div>

    <div class="relative z-10 sm:mx-auto w-full max-w-md text-center">
        <h1 class="text-4xl font-black text-white tracking-tight">Siantar.Go</h1>
        <p class="mt-1 text-sm text-gray-200">Panel Khusus Pegawai RSUD Chasan Boesoirie</p>
    </div>

    <div class="relative z-10 mt-6 sm:mx-auto w-full max-w-md px-4 sm:px-0">
        <div class="bg-white/95 backdrop-blur-xs py-8 px-4 shadow-2xl rounded-2xl border border-gray-200 sm:px-10">
            <form action="{{ route('admin.login-proses') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email Resmi</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-emerald-500 text-sm bg-white">
                    @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-emerald-500 text-sm bg-white">
                </div>
                <button type="submit" class="w-full py-2.5 px-4 rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 font-bold text-sm transition-colors shadow-sm cursor-pointer">Masuk Dashboard</button>
            </form>

            <div class="mt-4 text-center">
                <a href="{{ route('beranda') }}" class="text-xs text-gray-500 hover:text-emerald-600 transition-colors">&larr; Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>
