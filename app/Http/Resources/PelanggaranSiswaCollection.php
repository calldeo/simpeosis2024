<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PelanggaranSiswaCollection extends JsonResource
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
            'id_pelanggaran' => $this->id_pelanggaran,
            'waktu' => $this->formattedCreatedAt(),
            'kategori_pelanggaran' => $this->ketpelanggaran->kategori_pelanggaran,
            'id_siswa' => $this->siswa->id_siswa,
            'point' => $this->point,
            'catatan' => $this->catatan,

        ];
    }
    public function formattedCreatedAt()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
    }
}
