<?php

namespace App\Models;

use App\Models\Detail_Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'id_kategori',
        'nama_barang',
        'harga_barang',
        'foto_barang',
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, "id_kategori");
    }

    public function detail_order() {
        return $this->hasMany(Detail_Order::class, "id_barang");
    }

}
