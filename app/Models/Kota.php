<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = 'tbl_kabkot';
    protected $primaryKey = 'id';

    public function provinsi() {
        return $this->belongsTo(Provinsi::class, "provinsi_id");
    }

    public function kecamatan() {
        return $this->hasMany(Kecamatan::class, 'kabkot_id');
    }

    public function costumer() {
        return $this->hasMany(Costumer::class, "id_kota");
    }

    public function sales() {
        return $this->hasMany(Sales::class, "id_kota");
    }


}
