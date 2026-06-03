<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'drivers';

    protected $fillable = [
        'nama_lengkap',
        'foto_wajah',
        'nik',
        'no_whatsapp',
        'jenis_kendaraan',
        'tipe_kendaraan',
        'nomor_plat',
        'alamat',
        'foto_sim',
        'foto_stnk',
        'status_verifikasi',
        'ttd_driver',
        'ttd_admin',
    ];
}
