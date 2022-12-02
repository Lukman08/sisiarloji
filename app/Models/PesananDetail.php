<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    public function pesanan(){
        return $this->hasMany(Pesanan::class, 'pesanan_id', 'id');
    }
}
