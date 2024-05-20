<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingWaktu;
use Carbon\Carbon;

class SettingVoteController extends Controller
{
    public function index()
    {
        // Ambil semua pengaturan waktu
        $settings = SettingWaktu::all();

        // Awalnya kita asumsikan pengaturan sudah expired
        $expired = true;

        // Periksa setiap pengaturan waktu
        foreach ($settings as $setting) {
            // Jika ada pengaturan yang diatur pada hari ini atau setelahnya, maka belum expired
            if (Carbon::parse($setting->waktu)->isToday() || Carbon::parse($setting->waktu)->isFuture()) {
                $expired = false;
                break;
            }
        }

        // Kirim data pengaturan dan status expired ke tampilan
        return view('halaman.setting', compact('settings', 'expired'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'waktu' => 'required|date',
        ]);

        $id = $request->input('id');
        $tanggal = $request->input('waktu');

        $setting = SettingWaktu::find($id);

        if (!$setting) {
            return response()->json(['success' => false, 'message' => 'Setting waktu tidak ditemukan']);
        }

        $setting->waktu = $tanggal;

        if ($setting->save()) {
            // Perbarui status expired berdasarkan tanggal saat ini
            $expired = Carbon::now()->greaterThanOrEqualTo($tanggal);

            // Simpan $expired dalam session
            session()->put('expired', $expired);

            return response()->json(['success' => true, 'message' => 'Berhasil mengupdate setting waktu', 'tanggal' => $tanggal, 'expired' => $expired]);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal mengupdate setting waktu']);
        }
    }
}
