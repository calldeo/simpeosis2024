<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilVoting;
use App\Models\Osis;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\DB;
use App\Models\SettingWaktu;
use Carbon\Carbon;

class VotingController extends Controller
{   
    public function index(Request $request)
    {
        // Ambil semua data calon OSIS dari database
        $calonOsis = Osis::all();
             $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }
        // Return view dengan data calon OSIS
        return view('halaman.vote', compact('calonOsis','settings','expired'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required',
            'id_calon' => 'required',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Cek apakah pengguna sudah melakukan voting sebelumnya
        $existingVote = HasilVoting::where('id_user', $request->id_user)->exists();
        if ($existingVote) {
            return redirect('/vote')->with('update_success', 'Anda sudah melakukan voting sebelumnya');
        }

        // Simpan hasil voting ke dalam tabel hasil_voting
        HasilVoting::create([
            'id_user' => $request->id_user,
            'id_calon' => $request->id_calon,
            'tanggal' => now(), // Menggunakan tanggal saat ini
            // tambahkan field lainnya sesuai kebutuhan
        ]);

        // Set nilai status pemilihan pengguna menjadi 'sudah memilih'
        User::where('id', $request->id_user)->update(['status_pemilihan' => 'Sudah Memilih']);

        return redirect('/vote')->with('success', 'Anda Telah Melakukan Vote');
    }
}