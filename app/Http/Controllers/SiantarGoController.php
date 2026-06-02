<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiantarGoController extends Controller
{
    public function formRegistrasi()
    {
        return view('registrasi');
    }

    // Memproses Simpan Data Driver + Berkas (Foto Wajah, SIM, STNK)
    public function simpanRegistrasi(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'foto_wajah'      => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi foto wajah
            'nik'             => 'required|numeric|digits:16|unique:drivers,nik',
            'no_whatsapp'     => 'required|numeric|digits_between:10,15',
            'jenis_kendaraan' => 'required|string',
            'tipe_kendaraan'  => 'nullable|string|max:255',
            'nomor_plat'      => 'required|string|max:15',
            'alamat'          => 'required|string',
            'foto_sim'        => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_stnk'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nik.unique'      => 'NIK ini sudah terdaftar sebagai driver.',
            'nik.digits'      => 'NIK harus tepat 16 digit.',
            'required'        => 'Kolom ini wajib diisi.',
            'image'           => 'Berkas harus berupa gambar (JPG/PNG).',
            'max'             => 'Ukuran file maksimal 2MB.'
        ]);

        // Proses simpan file foto wajah
        if ($request->hasFile('foto_wajah')) {
            $validated['foto_wajah'] = $request->file('foto_wajah')->store('wajah', 'public');
        }

        // Proses simpan file foto SIM
        if ($request->hasFile('foto_sim')) {
            $validated['foto_sim'] = $request->file('foto_sim')->store('sim', 'public');
        }

        // Proses simpan file foto STNK
        if ($request->hasFile('foto_stnk')) {
            $validated['foto_stnk'] = $request->file('foto_stnk')->store('stnk', 'public');
        }

        Driver::create($validated);

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Data Anda sedang ditinjau oleh pihak RSUD Chasan Boesoirie.');
    }

    // Dashboard Admin dengan Fitur Pencarian Nama/NIK
    public function dashboardAdmin(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $drivers = Driver::where('nama_lengkap', 'LIKE', "%{$search}%")
                             ->orWhere('nik', 'LIKE', "%{$search}%")
                             ->latest()
                             ->get();
        } else {
            $drivers = Driver::latest()->get();
        }

        return view('admin_dashboard', compact('drivers', 'search'));
    }

    public function verifikasiDriver(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->update(['status_verifikasi' => $request->status]);

        return redirect()->back()->with('info', 'Status driver ' . $driver->nama_lengkap . ' berhasil diubah menjadi: ' . $request->status);
    }

    public function formLogin()
    {
        return view('admin_login');
    }

    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function cekStatus(Request $request)
    {
        $request->validate(['nik' => 'required|numeric|digits:16']);
        $driver = Driver::where('nik', $request->nik)->first();

        if (!$driver) {
            return back()->withErrors(['nik' => 'NIK Anda belum terdaftar di sistem Siantar.Go.']);
        }

        return view('status_driver', compact('driver'));
    }
}
