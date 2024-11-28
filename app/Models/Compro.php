<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compro extends Model
{
    use HasFactory;

    protected $table = 'tb_compro';

    protected $fillable = [
        'nama_compro',
    ];

    public function penawaran()
    {
        return $this->hasMany(Penawaran::class, 'id_compro');
    }
}
