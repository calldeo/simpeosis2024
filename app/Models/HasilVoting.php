<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilVoting extends Model
{
    protected $table = 'hasil_voting';

    protected $fillable = [
        'id_user',
        'id_calon',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function calonOsis()
    {
        return $this->belongsTo(Osis::class, 'id_calon');
    }
}