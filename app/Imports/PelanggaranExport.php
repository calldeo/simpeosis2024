<?php

namespace App\Imports;

use App\Models\Pelanggaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PelanggaranExport implements FromCollection, WithHeadings,WithMapping
{
    public function collection()
    {
        return Pelanggaran::with('siswa','ketpelanggaran','user')->get();
    }
    public function map($row): array{
        if($row->siswa != null){
            return [
                $row->id_pelanggaran,
                $row->siswa->nama,
                $row->ketpelanggaran->kategori_pelanggaran,
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
            'ID',
            'Nama Siswa',
            'Nama Pelanggaran',
            'Nama Guru',
            'Point',
            'Catatan',
            'Waktu',
        ];
    }
}

