<?php

namespace App\Imports;

use App\Models\siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new siswa([
            'id_siswa'=> $row[0],
            'nisn'=> $row[1],
            'nama'=> $row[2],
            'kelas'=> $row[3],
            'email'=> $row[4],
            'password'=>bcrypt($row[5]),
            // 'updated_at'=>$row[6],
            // 'created_at'=>$row[7],


        ]);
    }
}
