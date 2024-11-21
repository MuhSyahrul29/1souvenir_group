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
        'name_customer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
