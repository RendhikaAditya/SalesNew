<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
