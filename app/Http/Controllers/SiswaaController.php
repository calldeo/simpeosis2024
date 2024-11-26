<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SettingWaktu;
use Carbon\Carbon;


class SiswaaController extends Controller
{
    public function siswaa(Request $request)
    {
        // Mengambil semua data user dengan level siswa
        $search = $request->search; 
        $users = User::where('level', 'siswa')->paginate(10);
        $settings = SettingWaktu::all();

        $expired = false;
        foreach ($settings as $setting) {
            if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
                $expired = true;
                break;
            }
        }
        // Meneruskan data ke tampilan
        return view('halaman.siswa', compact('users','expired','settings'));
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            
            if ($user) {
                $user->forceDelete(); // Menghapus data secara permanen
                return redirect('/siswa')->with('success', 'Data berhasil dihapus secara permanen');
            } else {
                return redirect('/siswa')->with('error', 'Data tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect('/siswa')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    public function add_siswaa()
    {
        $settings = SettingWaktu::all();

        $expired = false;
        foreach ($settings as $setting) {
            if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
                $expired = true;
                break;
            }
        }
        // Meneruskan data ke tampilan
        return view('tambah.add_siswa', compact('expired','settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'level' => 'required',
            'kelas' => 'required', 
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
            'kelas' => $request->kelas,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Redirect dengan pesan sukses
        return redirect('/siswa')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $siswa = User::find($id);
        // Jangan mengirimkan password ke tampilan
        unset($siswa->password);
        $settings = SettingWaktu::all();

        $expired = false;
        foreach ($settings as $setting) {
            if (Carbon::now()->greaterThanOrEqualTo($setting->waktu)) {
                $expired = true;
                break;
            }
        }

        return view('edit.edit_siswa', compact('settings', 'expired','siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = User::find($id);

        $request->validate([
            'name' => ['required', 'min:3', 'max:30'],
            'level' => 'required',
            'email' => 'required|email|unique:users,email,' . $siswa->id,
            'kelas' => 'required',
            'password' => ['nullable', 'min:8', 'max:12'], // Mengubah menjadi nullable
        ]);

        $data = [
            'name' => $request->name,
            'level' => $request->level,
            'email' => $request->email,
            'kelas' => $request->kelas,
        ];

        // Menambahkan password ke data hanya jika ada input password
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $siswa->update($data);

        return redirect('/siswa')->with('update_success', 'Data Berhasil Diupdate');
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

            // Lakukan pencarian dengan mempertimbangkan validasi input, level 'siswa', dan status_pemilihan
            $users = User::where('level', 'siswa')
                        ->where(function ($query) use ($searchTerm) {
                            $query->where('name', 'like', "%{$searchTerm}%")
                                ->orWhere('status_pemilihan', 'like', "%{$searchTerm}%"); // Ubah sesuai dengan tipe data status_pemilihan
                        })
                        ->get();
        } else {
            // Jika input kosong, ambil semua data user dengan level 'siswa'
            $users = User::where('level', 'siswa')->get();
        }

        // Memberikan respons berdasarkan hasil pencarian
        return response()->json($users);
    }

    public function siswaimportexcel(Request $request) {
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
                $kelas = $worksheet->getCell('C'.$row)->getValue();
                $email = $worksheet->getCell('D'.$row)->getValue();
                $password = $worksheet->getCell('E'.$row)->getValue();
                
                if (!empty($nama)) {
                    $data[] = [
                        'name' => $nama,
                        'level' => $level,
                        'kelas' => $kelas,
                        'email' => $email,
                        'password' => bcrypt($password)
                    ];
                }
            }

            // Menghapus data siswa yang ada
            User::query()->where('level','siswa')->forceDelete();
        
            // Import data baru
            User::insert($data);
        
            return redirect('/siswa')->with('success', 'Data Berhasil Ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Siswa');
        $sheet->setCellValue('A1', 'Import Data Siswa');
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true);
        
        $sheet->setCellValue('A2', 'Nama');
        $sheet->setCellValue('B2', 'Level');
        $sheet->setCellValue('C2', 'Kelas');
        $sheet->setCellValue('D2', 'Email');
        $sheet->setCellValue('E2', 'Password');
        
        $sheet->setCellValue('G2', 'Keterangan')->getStyle('G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
        $sheet->setCellValue('G3', '1. Pengisian data dimulai dari baris ke-3');
        $sheet->setCellValue('G4', '2. Kolom Level harus diisi "siswa"');
        $sheet->setCellValue('G5', '3. Kolom Kelas diisi sesuai kelas siswa');
        $sheet->setCellValue('G6', '4. Email dan Password wajib diisi');

        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'template-siswa.xlsx';
        $filePath = storage_path('app/public/' . $filename);
        $writer->save($filePath);
        
        return response()->download($filePath, $filename)->deleteFileAfterSend(true);
    }
}