<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'tbl_kecamatan';
    protected $primaryKey = 'id';

    public function kota() {
        return $this->belongsTo(Kota::class, "kabkot_id");
    }

    public function kelurahan() {
        return $this->hasMany(Kelurahan::class, "kecamatan_id");
    }

    public function costumer() {
        return $this->hasMany(Costumer::class, "id_costumer");
    }

    public function kecamatan() {
        return $this->hasMany(Sales::class, "id_kecamatan");
    }

}
