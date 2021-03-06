<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $primaryKey = 'id_sales';
    protected $fillable = [
        'nama_sales',
        'alamat_sales',
        'umur_sales',
        'gender_sales',
        'username',
        'password',
        'id_provinsi',
        'id_kota',
        'nohp'
    ];

    public function order() {
        return $this->hasMany(Order::class, "id_sales");
    }

    public function provinsi() {
        return $this->belongsTo(Provinsi::class, "id_provinsi");
    }

    public function kota() {
        return $this->belongsTo(Kota::class, "id_kota");
    }

}
