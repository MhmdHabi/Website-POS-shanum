<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pembeli', 'produk_id', 'jumlah_produk', 'total_harga',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id', 'id');
    }
}
