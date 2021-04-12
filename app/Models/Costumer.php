<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    use HasFactory;
    protected $table = 'costumer';
    protected $primaryKey = 'id_costumer';
    protected $fillable = [
        'nama_costumer',
        'alamat_costumer',
        'targer_harga_costumer',
        'target_tercapai',
        'reset',
        'id_provinsi',
        'id_kota',
        'id_kecamatan',
        'id_kelurahan'
    ];

    public function order() {
        return $this->hasMany(Order::class, "id_costumer");
    }

    public function provinsi() {
        return $this->belongsTo(Provinsi::class, "id_provinsi");
    }

    public function kota() {
        return $this->belongsTo(Kota::class, "id_kota");
    }

    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class, "id_kecamatan");
    }

    public function kelurahan() {
        return $this->belongsTo(Kelurahan::class, "id_kelurahan");
    }

}
