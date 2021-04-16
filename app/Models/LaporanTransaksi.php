<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTransaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_costumer",
        "nama_sales",
        "nama_barang",
        "jml_barang",
        "tgl_order",
        "status",
        "id_order",
    ];
}
