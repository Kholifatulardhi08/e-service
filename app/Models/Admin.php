<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Penyedia;
use App\Models\JasaDetail;
use App\Models\BankDetail;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';

    public function penyedia()
    {
        return $this->belongsTo(Penyedia::class);
    }
    
    public function jasadetail()
    {
        return $this->belongsTo(JasaDetail::class, 'penyedia_id');
    }

    public function bankdetail()
    {
        return $this->belongsTo(BankDetail::class, 'penyedia_id');
    }
}
