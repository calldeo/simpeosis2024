<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        $search=$request->search; 
        $users = User::where('name','LIKE','%'.$request->search.'%')->Paginate(10);
        // Mengambil semua data user dengan level admin
        $users = User::where('level', 'admin')->paginate(10);

        // Meneruskan data ke tampilan
        return view('halaman.admin', compact('users'));
    }

public function destroy($id)
{
    try {
        $user = User::find($id);
        
        if ($user) {
            $user->forceDelete(); // Menghapus data secara permanen
            return redirect('/admin')->with('uccess', 'Data berhasil dihapus secara permanen');
        } else {
            return redirect('/admin')->with('error', 'Data tidak ditemukan.');
        }
    } catch (\Exception $e) {
        return redirect('/admin')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
    }
}



    public function add_admin()
    {
        return view('tambah.add_admin');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'min:3', 'max:30', function ($attribute, $value, $fail) {
        // Memeriksa apakah nama yang dimasukkan sudah ada dalam basis data
        if (User::where('name', $value)->exists()) {
            $fail($attribute.' is registered.');
        }
    }],
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

        return redirect('/admin')->with('success', 'Data Berhasil Ditambahkan');
        // Redirect dengan pesan sukses
        //return redirect('/admin')->with('update_success', 'Data Berhasil Ditambahkan');
   

}


   public function edit($id)
{
    $admin = User::find($id);
    // Jangan mengirimkan password ke tampilan
    unset($admin->password);
    return view('edit.edit_admin', compact('admin'));
}

public function update(Request $request, $id)
{
   $admin = User::find($id);

    $request->validate([
        'name' => ['required', 'min:3', 'max:30'],
        'level' => 'required',
        'email' => 'required|email|unique:users,email,' .$admin->id,
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

   $admin->update($data);

    return redirect('/admin')->with('update_success', 'Data Berhasil Diupdate');
}
 public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'LIKE', "%$query%")
                    ->where('level', 'admin')
                    ->get();

        return view('halaman.admin', ['users' => $users]);
    }



    public function deleteSelected(Request $request)
    {
        try {
            // Ambil ID guru yang dipilih dari request
            $selectedIds = $request->input('id');
    
            // Hapus data guru secara permanen dari database
            $deleted = User::whereIn('id', $selectedIds)->forceDelete();
    
            if ($deleted) {
                // Kirim respons jika berhasil menghapus
                return response()->json(['success' => true, 'message' => 'Berhasil menghapus data guru yang dipilih secara permanen.']);
            } else {
                // Kirim respons jika gagal menghapus
                return response()->json(['success' => false, 'message' => 'Gagal menghapus data guru yang dipilih.']);
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data guru yang dipilih. Silakan coba lagi.']);
        }
    }
    

}
