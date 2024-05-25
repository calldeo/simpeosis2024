<?php

namespace App\Http\Controllers;

use App\Models\Osis;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SettingWaktu;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data calon OSIS dari database
        $calonOsis = Osis::all();

        // Menghitung total jumlah vote dari semua calon
        $totalJumlahVote = Osis::sum('jumlah_vote');
    
        // Hitung presentase vote untuk setiap calon
        $presentaseVotePerCalon = [];
        if ($totalJumlahVote > 0) {
            foreach ($calonOsis as $calon) {
                $presentaseVote = ($calon->jumlah_vote / $totalJumlahVote) * 100;
                $presentaseVotePerCalon[$calon->id] = $presentaseVote;
            }
        } else {
            foreach ($calonOsis as $calon) {
                $presentaseVotePerCalon[$calon->id] = 0;
            }
        }
    
        // Query untuk mendapatkan jumlah suara untuk user yang sudah dan belum memilih
        $jumlahSuaraSudahMemilih = User::where('status_pemilihan', 'Sudah Memilih')->count();
        $jumlahSuaraBelumMemilih = User::where('status_pemilihan', 'Belum Memilih')->count();
        $totalUsers = $jumlahSuaraSudahMemilih + $jumlahSuaraBelumMemilih;
    
        // Hitung persentase suara yang sudah dan belum memilih
        if ($totalUsers > 0) {
            $persentaseSuaraSudahMemilih = ($jumlahSuaraSudahMemilih / $totalUsers) * 100;
            $persentaseSuaraBelumMemilih = ($jumlahSuaraBelumMemilih / $totalUsers) * 100;
        } else {
            $persentaseSuaraSudahMemilih = 0;
            $persentaseSuaraBelumMemilih = 0;
        }
    $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }
        // Return view dengan data calon OSIS, presentase vote, jumlah suara yang sudah dan belum memilih
        return view('home', compact(
            'calonOsis', 
            'presentaseVotePerCalon', 
            'jumlahSuaraSudahMemilih', 
            'persentaseSuaraSudahMemilih', 
            'jumlahSuaraBelumMemilih', 
            'persentaseSuaraBelumMemilih',
            'expired',
            'settings'
        ));
    }
 public function petunjuk()
    {
        // return view('tambah.add_guruu');
         $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }
        // Meneruskan data ke tampilan
        return view('halaman.petunjuk', compact('expired','settings'));
    }

}