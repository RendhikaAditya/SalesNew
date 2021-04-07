<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Order extends Model
{
    use HasFactory;
    protected $table = 'detail_order';
    protected $primaryKey = 'id';
    protected $fillable = [
        "id_order",
        'id_barang',
        'jml_barang',
        'harga',
        "status"
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, "id_order");
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, "id_barang");
    }
}
