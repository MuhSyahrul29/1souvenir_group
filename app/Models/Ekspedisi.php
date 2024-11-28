<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspedisi extends Model
{
    use HasFactory;

    protected $table = 'tb_ekspedisi';

    protected $fillable = [
        'nama_ekspedisi',
    ];

    public function penawaran()
    {
        return $this->hasMany(Penawaran::class, 'id_ekspedisi');
    }
}
