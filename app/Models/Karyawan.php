<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'tb_karyawan';
    protected $fillable = [
        'name',
        'inisial',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Penawaran
    public function penawaran()
    {
        return $this->hasMany(Penawaran::class, 'id_karyawan', 'id');
    }
}
