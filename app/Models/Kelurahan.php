<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $table = 'tbl_kelurahan';
    protected $primaryKey = 'id';

    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class, "kecamatan_id");
    }

    public function costumer() {
        return $this->hasMany(Costumer::class, "id_costumer");
    }

    public function sales() {
        return $this->hasMany(Sales::class, "id_kelurahan");
    }

}
