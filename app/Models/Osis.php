<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Osis extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [  
        'id_user',  
        'nama_calon',
        'visimisi',
        'NIS',
        'kelas',
        'gambar',
        'slogan',
        'jumlah_vote',
        'periode',
        
         
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'calon_osis';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    public function hasilVoting()
    {
        return $this->hasMany(HasilVoting::class, 'id_calon');
    }
}