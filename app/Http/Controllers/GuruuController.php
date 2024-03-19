<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;


class GuruuController extends Controller
{
    public function guruu(Request $request)
    {
        // Mengambil semua data user dengan level admin
        $users = User::where('level', 'guru')->get();

        // Meneruskan data ke tampilan
        return view('halaman.guruu', compact('users'));
    }

public function destroy($id)
{
    try {
        $user = User::find($id);
        
        if ($user) {
            $user->forceDelete(); // Menghapus data secara permanen
            return redirect('/guruu')->with('uccess', 'Data berhasil dihapus secara permanen');
        } else {
            return redirect('/guruu')->with('error', 'Data tidak ditemukan.');
        }
    } catch (\Exception $e) {
        return redirect('/guruu')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
    }
}



    public function add_guruu()
    {
        return view('tambah.add_guruu');
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
        return redirect('/guruu')->with('success', 'Data Berhasil Ditambahkan');
   

}


    public function edit($id)
{
    $guruu = User::find($id);
    // Jangan mengirimkan password ke tampilan
    unset($guruu->password);
    return view('edit.edit_guruu', compact('guruu'));
}

public function update(Request $request, $id)
{
    $guruu = User::find($id);

    $request->validate([
        'name' => ['required', 'min:3', 'max:30'],
        'level' => 'required',
        'email' => 'required|email|unique:users,email,' . $guruu->id,
        'password' => ['required', 'min:8', 'max:12'],
    ]);

    $data = [
        'name' => $request->name,
        'level' => $request->level,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ];

    $guruu->update($data);

    return redirect('/guruu')->with('update_success', 'Data Berhasil Diupdate');
    
}
}
