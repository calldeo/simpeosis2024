<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Osis;
use DB;
use Illuminate\Support\Facades\Storage;
use App\Models\SettingWaktu;
use Carbon\Carbon;
class OsisController extends Controller
{
    //
    public function osis(Request $request)
    {
       

        // Ambil semua data calon OSIS dari database
        $calonOsis = Osis::all();

        // Return view dengan data calon OSIS
        // return view('halaman.calonosis', compact('calonOsis'));
            $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }

    return view('halaman.calonosis', compact('settings', 'expired','calonOsis'));
    }
    public function vote(Request $request)
    {
       

        // Ambil semua data calon OSIS dari database
        $calonOsis = Osis::all();

        // Return view dengan data calon OSIS
        // return view('halaman.vote', compact('calonVote'));
          $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }

    return view('halaman.vote', compact('settings', 'expired','calonVote'));
    }
    public function add_osis()
    {
        // return view('tambah.add_osis');
          $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }

    return view('tambah.add_osis', compact('settings', 'expired'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_calon' => 'required',
            'visimisi' => 'required',
            'kelas'=>'required',
            'periode'=>'required',
            'slogan'=>'required',
            'NIS'=>'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses penyimpanan gambar
        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('/foto_calon'), $imageName);

        // Simpan data calon OSIS ke dalam database
        Osis::create([       
            'nama_calon' => $validatedData['nama_calon'],
            'visimisi' => $validatedData['visimisi'],
            'kelas' => $validatedData['kelas'],
            'periode' => $validatedData['periode'],
            'slogan' => $validatedData['slogan'],
            'NIS' => $validatedData['NIS'],
            'gambar' => $imageName,
        ]);

        // Redirect ke halaman daftar calon OSIS dengan pesan sukses
        return redirect('/calonosis')->with('success', 'Data calon OSIS berhasil ditambahkan.');
    }


    // Metode untuk menampilkan form edit calon OSIS
    public function edit($id_calon)
    {
        // Temukan calon OSIS berdasarkan id
        $calon = Osis::findOrFail($id_calon);

        // Tampilkan form edit calon OSIS
        // return view('edit.edit_osis', compact('calon'));
          $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }

    return view('edit.edit_osis', compact('settings', 'expired','calon'));
    }
// Metode untuk menyimpan perubahan data calon OSIS
 public function update(Request $request, $id_calon)
    {
        // Validasi data yang diterima dari form, termasuk gambar
        $validatedData = $request->validate([
            'nama_calon' => 'required',
            'visimisi' => 'required',
            'NIS' => 'required',
            'kelas' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slogan' => 'required',
            'periode' => 'required',
            // Sesuaikan validasi gambar dengan kebutuhan Anda, nullable untuk mengizinkan update tanpa gambar
        ]);

        // Temukan calon OSIS berdasarkan id
        $calon = Osis::findOrFail($id_calon);

        // Jika ada gambar yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($calon->gambar) {
                // Hapus gambar dari penyimpanan
                unlink(public_path('/foto_calon/' . $calon->gambar));
            }

            // Proses penyimpanan gambar baru
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('/foto_calon'), $imageName);

            // Perbarui nama gambar dalam data calon OSIS
            $calon->gambar = $imageName;
        }

        // Update data calon OSIS
        $calon->nama_calon = $validatedData['nama_calon'];
        $calon->visimisi = $validatedData['visimisi'];
        $calon->NIS = $validatedData['NIS'];
        $calon->kelas = $validatedData['kelas'];
        $calon->slogan = $validatedData['slogan'];
        $calon->periode = $validatedData['periode'];
        // Update data lainnya sesuai kebutuhan

        // Simpan perubahan
        $calon->save();

        // Redirect dengan pesan sukses
        return redirect('/calonosis')->with('update_success', 'Data Berhasil Diupdate');
    }



    // Metode untuk menghapus data calon OSIS
    public function destroy($id_calon)
    {
        // Temukan calon OSIS berdasarkan id dan hapus
        $calonOsis = Osis::findOrFail($id_calon);
        $calonOsis->delete();

        // Redirect dengan pesan sukses
        return redirect('/calonosis')->with('success', 'Calon OSIS berhasil dihapus.');
    }
}