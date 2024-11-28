<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stiker extends Model
{
    use HasFactory;

    protected $table = 'tb_stiker';

    protected $fillable = [
        'nama_stiker',
    ];

    public function penawaran()
    {
        return $this->hasMany(Penawaran::class, 'id_stiker');
    }
}
