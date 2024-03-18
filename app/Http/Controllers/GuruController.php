<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use App\Models\Pelanggaran;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use lluminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{

    public function guruimportexcel(Request $request) {

        // DB::table('users')->where('level','guru')->delete();
        User::query()->where('level','guru')->delete();
        $file=$request->file('file');
        $namafile = $file->getClientOriginalName();
        $file->move('DataGuru', $namafile);

        Excel::import(new UserImport, public_path('/DataGuru/'.$namafile));
        return redirect('/login')->with('toast_success', 'Data Berhasil Ditambahkan');
        
    }

    public function guru(Request $request){
        $search=$request->search; 
        $guru = User::where('name','LIKE','%'.$request->search.'%')->Paginate(10);
        return view('halaman.guru',['users' => $guru],['search'=>$search]);
    }
    public function tambahguru(){
          return view('tambah.tambah_guru');
        }
        public function store(Request $request )
        {     $data = $request->validate([
            'name' => ['required','min:3','max:30'],
            'level' => 'required',
            'email' => 'required|unique:users,email',
            'password' => ['required','min:8','max:12'],
            
            
        ]);
            
            DB::table('users')->insert([
                'name' => $request->name,
                'level' =>$request->level,
                'email' => $request->email,
                'password' => bcrypt($request->password),
               

            ]);
        
            
            return redirect('/guru')->with('toast_success', 'Data Berhasil Ditambahkan');
        }

        public function destroy($id) ///DELETE
        {
            $guru = User::find($id);
            
            $guru->delete();
            return redirect('/guru')->with('toast_success', 'Data Berhasil Dihapus');
        }
        
        public function edit($id)  ///EDIT
        {
            $guru = User::find($id);
            return view('edit.edit_guru',compact(['guru']));
        }
        
        public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => ['required','min:3','max:30'],
            'level' => 'required',
            'email' => 'required|unique:tb_siswa,email',
            'password' => ['required','min:8','max:12'],
            
            
        ]);
        $guru = User::where('id', $id)->first();
        $guru->update($data);
        return redirect('/guru')->with('toast_success', 'Data Berhasil Diupdate');
    }
    public function search(Request $request)
  {
    if($request->has('search')){
        $guru = user::where('name','LIKE','%'.$request->search.'%')->get();
    }
    else{
        $guru= user::all();
    }
    return view('halaman.guru',['users' =>$guru]);
  }
  }
    