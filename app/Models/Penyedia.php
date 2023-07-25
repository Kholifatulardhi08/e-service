<?php

namespace App\Models;

use App\Models\JasaDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penyedia extends Model
{
    use HasFactory;

    public function jasadetail()
    {
        return $this->belongsTo(JasaDetail::class, 'id', 'penyedia_id');
    }

    public static function jasadetails($penyedia_id)
    {
        $jasadetails = JasaDetail::select('nama_toko')->where('penyedia_id', $penyedia_id)->first()->toArray();
        return $jasadetails['nama_toko'];
    }
}
