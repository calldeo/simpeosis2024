<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Polling; // Import model Polling
use App\Models\User;
use App\Models\Osis; // Import model User
use DB;
use App\Models\SettingWaktu;
use Carbon\Carbon;

class DataVoteController extends Controller
{
    public function view()
    {   
        // Mengambil data hasil voting beserta nama calon dan jumlah suara
        $hasilVotings = Polling::all();

        // Ambil nama calon dari model User
        foreach ($hasilVotings as $hasilVoting) {
            $user = User::find($hasilVoting->id_user); // Mengambil data calon dari model User
            $hasilVoting->name = $user ? $user->name : 'Tidak Ditemukan';
            $hasilVoting->email = $user ? $user->email : 'Tidak Ditemukan'; 
            $hasilVoting->level = $user ? $user->level : 'Tidak Ditemukan';// Menyimpan nama calon dalam atribut baru
        }
          foreach ($hasilVotings as $hasilVoting) {
            $user = Osis::find($hasilVoting->id_calon); // Mengambil data calon dari model User
            $hasilVoting->nama_calon = $user ? $user->nama_calon : 'Tidak Ditemukan'; // Menyimpan nama calon dalam atribut baru
        }

      
        $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }

    return view('halaman.datavoted',['hasilVotings' => $hasilVotings], compact('settings', 'expired'));
    }
}