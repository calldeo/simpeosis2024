<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingWaktu extends Model
{

    // use HasFactory;
    // Nama tabel di basis data
    protected $table = 'setting_waktu';

    // Nama kolom yang merupakan primary key
    protected $primaryKey = 'id_setting';

    // Atur agar model tidak menggunakan timestamp (created_at dan updated_at)
    public $timestamps = false;

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = ['waktu'];

    // Metode untuk memeriksa apakah waktu sudah diatur
    public static function isWaktuSet()
    {
        return self::whereNotNull('waktu')->exists();
    }
}