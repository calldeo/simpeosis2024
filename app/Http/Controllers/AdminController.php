<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\SettingWaktu;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function admin(Request $request)
    {
        $search=$request->search; 
        $users = User::where('name','LIKE','%'.$request->search.'%')->Paginate(10);
        // Mengambil semua data user dengan level admin
        $users = User::where('level', 'admin')->paginate(10);
        $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }
        // Meneruskan data ke tampilan
        return view('halaman.admin', compact('users','expired','settings'));
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
               $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }

    return view('tambah.add_admin', compact('settings', 'expired'));
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

        User::create([
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
    // return view('edit.edit_guruu', compact('guruu'));
         $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }

    return view('edit.edit_admin', compact('settings', 'expired','admin'));
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
          $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }
        // Dapatkan input pencarian
        $searchTerm = $request->input('search');

        // Lakukan pencarian hanya jika input tidak kosong
        if (!empty($searchTerm)) {
            // Validasi input
            $request->validate([
                'search' => 'string', // Sesuaikan aturan validasi sesuai kebutuhan Anda
            ]);

            // Lakukan pencarian dengan mempertimbangkan validasi input, level 'admin', dan status_pemilihan
            $users = User::where('level', 'admin')
                        ->where(function ($query) use ($searchTerm) {
                            $query->where('name', 'like', "%{$searchTerm}%")
                                ->orWhere('status_pemilihan', 'like', "%{$searchTerm}%"); // Ubah sesuai dengan tipe data status_pemilihan
                        })
                        ->get();
        } else {
            // Jika input kosong, ambil semua data user dengan level 'admin'
            $users = User::where('level', 'admin')->get();
        }

        // Memberikan respons berdasarkan hasil pencarian
        return response()->json($users);
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