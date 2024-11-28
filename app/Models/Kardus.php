<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardus extends Model
{
    use HasFactory;

    protected $table = 'tb_kardus';

    protected $fillable = [
        'nama_kardus',
    ];

    public function penawaran()
    {
        return $this->hasMany(Penawaran::class, 'id_kardus');
    }
}
