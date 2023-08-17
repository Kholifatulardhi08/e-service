<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crawling extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk', 'website', 'rating', 'harga', 'url', 'gambar_url'
    ];
}
