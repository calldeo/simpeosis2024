<?php

namespace App\Imports;

use App\Models\Pelanggaran;
use App\Models\Penanganan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenangananExport implements FromCollection, WithHeadings,WithMapping
{
    public function collection()
    {
        return Penanganan::with('siswa','pelanggaran','user')->get();
    }
    public function map($row): array{
        if($row->siswa != null){
            return [
             
                $row->siswa->nama,
                $row->user->name,
                $row->point,
                $row->status,
                $row->tindak_lanjut,


              
    
            ];
        }return[];
       
      
    }

    public function headings(): array
    {
        return [
          
            'Nama Siswa',
            'Nama Guru',
            'Point',
            'Status',
            'Tindak Lanjut'
            
        ];
    }
}

