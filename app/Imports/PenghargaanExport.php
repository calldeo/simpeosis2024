<?php

namespace App\Imports;

use App\Models\Pelanggaran;
use App\Models\Penghargaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenghargaanExport implements FromCollection, WithHeadings,WithMapping
{
    public function collection()
    {
        return Penghargaan::with('siswa','ketpenghargaan','user')->get();
    }
    public function map($row): array{
        if($row->siswa != null){
            return [
                $row->id_penghargaan,
                $row->siswa->nama,
                $row->ketpenghargaan->kategori_penghargaan,
                $row->user->name,
                $row->point,
                $row->catatan,
                $row->waktu,
    
            ];
        }return[];
       
      
    }

    public function headings(): array
    {
        return [
            'Id_penghargaan',
            'Nama Siswa',
            'Nama Penghargaan',
            'Nama Guru',
            'Point',
            'Catatan',
            'Waktu',
        ];
    }
}

