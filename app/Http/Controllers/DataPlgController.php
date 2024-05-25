<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Polling; // Import model Polling
use App\Models\User;
use App\Models\Osis; // Import model User
use DB;
use App\Models\SettingWaktu;
use Carbon\Carbon;
class DataPlgController extends Controller
{
    public function view()
    {
        // Mengambil data hasil voting beserta nama calon dan jumlah suara
        $hasilVotings = Polling::all();
        
        Osis::query()->update(['jumlah_vote' => 0]);

    // Hitung jumlah suara untuk setiap calon dan tambahkan ke tabel calon_osis
        foreach ($hasilVotings as $hasilVoting) {
        // Cari calon menggunakan id_calon dari hasil voting
        $calon = Osis::find($hasilVoting->id_calon);

        // Jika calon ditemukan, tambahkan jumlah suara dari hasil voting
        if ($calon) {
            $calon->increment('jumlah_vote');
        }
    }
        $calonOsis = Osis::all();   
        // return view('halaman.datapolling', ['calonOsis' => $calonOsis]);
   $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }

    return view('halaman.datapolling',['calonOsis' => $calonOsis], compact('settings', 'expired'));
    }
    


      public function cetaklaporan()
    {
        // Dapatkan calon dengan jumlah suara terbanyak
        $calonTerpilih = Osis::orderBy('jumlah_vote', 'desc')->first();
       $cosis = Osis::all();
        
        // return view('halaman.datapolling', ['calonOsis' => $calonOsis]);
   $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }

    return view('halaman.cetaklaporan',['cosis' => $cosis],compact('settings', 'expired','calonTerpilih'));
    }
}