<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['nama_produk', 'harga'];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'produk_id');
    }

    // public function penjualans()
    // {
    //     return $this->belongsToMany(Penjualan::class)->withPivot('jumlah', 'harga');
    // }
}
