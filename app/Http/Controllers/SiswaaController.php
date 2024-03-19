<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;


class SiswaaController extends Controller
{
    public function siswaa(Request $request)
    {
        // Mengambil semua data user dengan level admin
        $users = User::where('level', 'siswa')->get();

        // Meneruskan data ke tampilan
        return view('halaman.siswaa', compact('users'));
    }

public function destroy($id)
{
    try {
        $user = User::find($id);
        
        if ($user) {
            $user->forceDelete(); // Menghapus data secara permanen
            return redirect('/siswaa')->with('uccess', 'Data berhasil dihapus secara permanen');
        } else {
            return redirect('/siswaa')->with('error', 'Data tidak ditemukan.');
        }
    } catch (\Exception $e) {
        return redirect('/siswaa')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
    }
}



    public function add_siswaa()
    {
        return view('tambah.add_siswaa');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'min:3', 'max:30'],
        'level' => 'required',
        'email' => 'required|unique:users,email',
        'password' => ['required', 'min:8', 'max:12'],
    ]);


        $user = User::where('name', $request->name)->orWhere('email', $request->email)->first();
        if ($user) {
            // Jika nama atau email sudah digunakan, tampilkan pesan kesalahan
            return back()->withInput()->with('error', 'Nama atau email sudah digunakan.');
        }

        DB::table('users')->insert([
            'name' => $request->name,
            'level' => $request->level,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirect dengan pesan sukses
        return redirect('/siswaa')->with('success', 'Data Berhasil Ditambahkan');
   

}


    public function edit($id)
{
    $siswaa = User::find($id);
    // Jangan mengirimkan password ke tampilan
    unset($guruu->password);
    return view('edit.edit_siswaa', compact('siswaa'));
}

public function update(Request $request, $id)
{
    $siswaa = User::find($id);

    $request->validate([
        'name' => ['required', 'min:3', 'max:30'],
        'level' => 'required',
        'email' => 'required|email|unique:users,email,' . $siswaa->id,
        'password' => ['required', 'min:8', 'max:12'],
    ]);

    $data = [
        'name' => $request->name,
        'level' => $request->level,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ];

    $siswaa->update($data);

    return redirect('/siswaa')->with('update_success', 'Data Berhasil Diupdate');
    
}
}
