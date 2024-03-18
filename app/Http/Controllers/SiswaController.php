<?php

namespace App\Http\Controllers;

use App\API\ApiFormatter;
use App\Imports\UserImport;
use App\Imports\SiswaImport;
use App\Models\Pelanggaran;
use App\Models\Penghargaan;
use App\Models\Penanganan;
use DB;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\SiswaAPImodel;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use lluminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr;

class SiswaController extends Controller
{
    public function updateSelected(Request $request)
    {
        $selectedIds = explode(',', $request->input('selected'));
        $newKelas = $request->input('kelas');
    
        // Update the selected records with the new kelas
        Siswa::where('id_siswa', $selectedIds)->update(['kelas' => $newKelas]);
    
        return redirect()->back()->with('success', 'Selected records updated successfully');
    }
    public function deleteSelected(Request $request)
    {
        // Ambil id siswa yang dipilih dari input form
        $selectedIds = $request->input('selected_students', []);

        // Hapus siswa yang dipilih dari database
        Siswa::whereIn('id_siswa', $selectedIds)->delete();

        // Redirect kembali ke halaman daftar siswa dengan pesan sukses
        return redirect('/siswa')->with('success', 'Siswa berhasil dihapus');
    }
    public function siswaimportexcel(Request $request ) {
        

        // DB::table('tb_siswa')->Truncate();
        // DB::table('tb_pelanggaran')->Truncate(); 
        Siswa::query()->delete();
          Pelanggaran::query()->delete();
        Penghargaan::query()->delete();
        Penanganan::query()->delete();
        
        // DB::table('tb_siswa')->where('nisn')->delete();
        $file=$request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('DataSiswa', $namafile);

        Excel::import(new SiswaImport, public_path('/DataSiswa/'.$namafile));
        return redirect('/siswa')->with('toast_success', 'Data Berhasil Ditambahkan');;
        
    }

    public function checkNISN($nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->exists();
        return response()->json(['exists' => $siswa]);
    }
    




    public function siswa(Request $request)
    {
        $search = $request->search;
        $data = Siswa::query()
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->orWhere('nisn', 'LIKE', '%' . $search . '%')
            ->paginate(10);
    
        $data->appends(['search' => $search]); // Append the search query parameter to the pagination links
    
        return view('halaman.siswa', compact('data', 'search'));
    }
    
    public function tambahsiswa(){
        
        $siswa = DB::table('tb_siswa')->get();
        return view('tambah.tambah_siswa',compact('siswa'));
      }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => ['required', 'min:9', 'max:12', 'unique:tb_siswa,nisn'],
            'nama' => ['required', 'min:3', 'max:30'],
            'kelas' => 'required',
            'email' => 'required|unique:tb_siswa,email|unique:tb_siswa,email',
            'password' => ['required', 'min:8', 'max:12'],
            // 'password_confirmation' => 'required|same:password',
        ]);
    
        // try {
            DB::table('tb_siswa')->insert([
                'nisn' => $request->nisn,
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
    
            return redirect('/siswa')->with('toast_success', 'Data Berhasil Ditambahkan');
        // } catch (\Illuminate\Database\QueryException $e) {
        //     $errorCode = $e->errorInfo[1];
        //     if ($errorCode === 1062) { // Unique constraint violation (nisn or email already exists)
        //         return redirect('/siswa')->with('toast_error', 'NISN or Email already exists');
        //     }
        //     return redirect('/siswa')->with('toast_error', 'Failed to add data');
        // }
    }
    

    public function destroy($id)
    {
        // Find the record
        $siswa = Siswa::findOrFail($id);
        
        // Delete the record
        $siswa->delete();
        Pelanggaran::where('id_siswa',$id)->delete();
        Penghargaan::where('id_siswa',$id)->delete();
        
        // Redirect to the index page with a success message
        return redirect()->route('siswa')->with('toast_success', 'Data Berhasil Dihapus');
    }
    
      
      public function edit($id)  ///EDIT
      {
          $siswa = Siswa::find($id);
          return view('edit.edit_siswa',compact(['siswa']));
      }
      
      public function update(Request $request, $id)
  {
    $data = $request->validate([
        'nisn' => ['required','min:9','max:12',],
        'nama' => ['required','min:3','max:30'],
        'kelas'=> 'required',
        'email' => 'required',
        'password' => ['required','min:8','max:12'],
        
        
    ]);
     DB::table('tb_siswa')->where('id_siswa',$request->id_siswa)->update([
        'nisn' => $request->nisn,
        'nama' =>$request->nama,
        'kelas' =>$request->kelas,
        'email' => $request->email,
        'password' => bcrypt($request->password),
     ]);
      return redirect('/siswa')->with('toast_success', 'Data Berhasil Diupdate');
  }
  public function search(Request $request)
  {
    if($request->has('search')){
        $siswa = Siswa::where('nama','LIKE','%'.$request->search.'%')->get();
    }
    else{
        $siswa= Siswa::all();
    }
    return view('halaman.siswa',['siswa' =>$siswa]);
  }

  public function viewimport(){
        return view('import.importsiswa');
    
  }
  public function SiswaAPI()
    {
      // username
      // password
      // cek di db 
      // kalo username sapa passwordnya benar nampiling smua datanya
      $data = SiswaAPImodel::all();
        if($data){
            return ApiFormatter::createApi(200, 'Succes',$data);
        }else{
            return ApiFormatter::createApi(400, 'Gagal');
        }   
     }


     public function updateAPI(Request $request,$id_siswa)
     {
        // if($request->wantsJson()) {
        //     return response()->json(['P+'], 200);
        // }
        
            $request ->validate([
                // 'nisn' => ['required','min:9','max:12','unique:tb_siswa,nisn'],
                //  'nama' => ['required','min:3','max:30'],
                //  'kelas'=> 'required',
                //  'email' => 'required|unique:tb_siswa,email',
                'password' => ['required','min:8','max:12'],
        
            ]);
            
            $tb_siswa = Siswa::findOrFail($id_siswa);

            $tb_siswa->update([
                // 'nisn' => $request->nisn,
                // 'nama' =>$request->nama,
                // 'kelas' =>$request->kelas,
                // 'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

        $data_siswa = Siswa::where('id_siswa','=',$tb_siswa->id_siswa)->get();
        
        if($data_siswa){
            return ApiFormatter::createApi(200, 'Success',$data_siswa);
        }else{
            return ApiFormatter::createApi(400,'Failed'); 
        }
       
     }

     public function loginapi(Request $request)
     {
         // $credentials = $request->only('email', 'password');
 
         if (Auth::guard('siswa')->attempt(['email' => $request->email, 'password' => $request->password])) {
             $auth = Auth::guard('siswa')->user();
             $auth['token']=$auth->createToken('auth_token')->plainTextToken;
 
             return response()->json([
                 'success' => true,
                 'message' => 'Login berhasil' ,
                 'data_siswa' => $auth
             ]);
         } else {
             return response()->json([
                
                 'success' => false,
                 'message' => 'Email atau password salah',
                 'data_siswa' => null
                 
             ]);
         }
     }
    
}

        
