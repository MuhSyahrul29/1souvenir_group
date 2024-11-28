<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'tb_pelanggan';

    // Tentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'name_customer',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Penawaran
    public function penawaran()
    {
        return $this->hasMany(Penawaran::class, 'id_customer', 'id');
    }
}
