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
}
