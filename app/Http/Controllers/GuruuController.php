<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SettingWaktu;
use Carbon\Carbon;

class GuruuController extends Controller
{
    public function guruu(Request $request)
    {

        $users = User::where('level', 'guru')->paginate(10);
 $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }
        // Meneruskan data ke tampilan
        return view('halaman.guruu', compact('users','expired','settings'));
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
        return view('tambah.add_guruu', compact('expired','settings'));
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

       User::create([
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
      $settings = SettingWaktu::all();

            $expired = false;
    foreach ($settings as $setting) {
        if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
            $expired = true;
            break;
        }
    }

    return view('edit.edit_guruu', compact('settings', 'expired','guruu'));
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
        // Dapatkan input pencarian
        $searchTerm = $request->input('search');

        // Lakukan pencarian hanya jika input tidak kosong
        if (!empty($searchTerm)) {
            // Validasi input
            $request->validate([
                'search' => 'string', // Sesuaikan aturan validasi sesuai kebutuhan Anda
            ]);

            // Lakukan pencarian dengan mempertimbangkan validasi input, level 'admin', dan status_pemilihan
            $users = User::where('level', 'guru')
                        ->where(function ($query) use ($searchTerm) {
                            $query->where('name', 'like', "%{$searchTerm}%")
                                ->orWhere('status_pemilihan', 'like', "%{$searchTerm}%"); // Ubah sesuai dengan tipe data status_pemilihan
                        })
                        ->get();
        } else {
            // Jika input kosong, ambil semua data user dengan level 'admin'
            $users = User::where('level', 'guru')->get();
        }

        // Memberikan respons berdasarkan hasil pencarian
        return response()->json($users);
    }


    public function guruimportexcel(Request $request) {
        try {
            // Validasi file yang diupload
            $request->validate([
                'file' => 'required|mimes:xlsx,xls|max:2048'
            ]);

            // Memproses file Excel yang diunggah langsung dari request
            $file = $request->file('file');
            
            // Baca file Excel langsung dari temporary file
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            
            // Mulai dari baris ke-3
            $highestRow = $worksheet->getHighestRow();
            $data = [];
            
            for ($row = 3; $row <= $highestRow; $row++) {
                $nama = $worksheet->getCell('A'.$row)->getValue();
                $level = $worksheet->getCell('B'.$row)->getValue();
                $email = $worksheet->getCell('C'.$row)->getValue();
                $password = $worksheet->getCell('D'.$row)->getValue();
                
                if (!empty($nama)) {
                    $data[] = [
                        'name' => $nama,
                        'level' => $level,
                        'email' => $email,
                        'password' => bcrypt($password)
                    ];
                }
            }

            // Menghapus data guru yang ada
            User::query()->where('level','guru')->forceDelete();
        
            // Import data baru
            User::insert($data);
        
            return redirect('/guruu')->with('success', 'Data Berhasil Ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function downloadTemplate()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Guru');
        $sheet->setCellValue('A1', 'Import Data Guru');
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true);
        
        $sheet->setCellValue('A2', 'Nama');
        $sheet->setCellValue('B2', 'Level');
        $sheet->setCellValue('C2', 'Email');
        $sheet->setCellValue('D2', 'Password');
        
        $sheet->setCellValue('F2', 'Keterangan')->getStyle('F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
        $sheet->setCellValue('F3', '1. Pengisian data dimulai dari baris ke-3');
        $sheet->setCellValue('F4', '2. Kolom Level harus diisi "guru"');
        $sheet->setCellValue('F5', '3. Email dan Password wajib diisi');
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'template-guru.xlsx';
        $filePath = storage_path('app/public/' . $filename);
        $writer->save($filePath);
        
        return response()->download($filePath, $filename)->deleteFileAfterSend(true);
    }
}