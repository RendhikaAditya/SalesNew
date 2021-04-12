<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'tbl_provinsi';
    protected $primaryKey = 'id';

    public function kota() {
        return $this->hasMany(Kota::class, "provinsi_id");
    }

    public function costumer() {
        return $this->hasMany(Costumer::class, "id_provinsi");
    }

    public function sales() {
        return $this->hasMany(Sales::class, "id_provinsi");
    }

}
