<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;


class GuruuController extends Controller
{
    public function guruu(Request $request)
    {
        $search = $request->search; 
        $users = User::where('level', 'guru')->paginate(10);

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
        'password' => ['nullable', 'min:8', 'max:12'], // Mengubah menjadi nullable
    ]);

    $data = [
        'name' => $request->name,
        'level' => $request->level,
        'email' => $request->email,
    ];

    // Menambahkan password ke data hanya jika ada input password
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }

    $guruu->update($data);

    return redirect('/guruu')->with('update_success', 'Data Berhasil Diupdate');
}

 public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'LIKE', "%$query%")
                    ->where('level', 'guru')
                    ->paginate(10);

        return view('halaman.guruu', ['users' => $users]);
    }


    public function guruimportexcel(Request $request) {

        // DB::table('users')->where('level','guru')->delete();
        User::query()->where('level','guru')->delete();
        $file=$request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('DataGuru', $namafile);

        Excel::import(new UserImport, public_path('/DataGuru/'.$namafile));
        return redirect('/guruu')->with('success', 'Data Berhasil Ditambahkan');
        
    }
}
