<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama', 'no_hp', 'alamat',
        'kecamatan', 'kota', 'provinsi', 'kode_pos',
        'status'
    ];

    public static function DeliveryAddreses()
    {
        $deliveryAddress = Delivery::where('user_id', Auth::user()->id)->get()->toArray();
        return $deliveryAddress;
    }
}
