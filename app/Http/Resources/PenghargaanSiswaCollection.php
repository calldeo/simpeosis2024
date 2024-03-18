<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PenghargaanSiswaCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_siswa' => $this->siswa->id_siswa,
            'nama' => $this->siswa->nama,
            'waktu' => $this->formattedCreatedAt(),
            'kategori_penghargaan' => $this->ketpenghargaan->kategori_penghargaan,
            'kelas' => $this->siswa->kelas
        ];
    }
    public function formattedCreatedAt()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
    }
}
