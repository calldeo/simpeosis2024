<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PenangananSiswaCollection extends JsonResource
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
            'waktu' => $this->formattedCreatedAt(),
            'status' => $this->status,
            'point' => $this->point,
            'tindak_lanjut' => $this->tindak_lanjut
        ];
    }
    public function formattedCreatedAt()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d H:i:s');
    }
}
