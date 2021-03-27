<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_costumer',
        'id_sales',
        'total_harga',
        'tgl_order',
    ];

    public function detail_order() {
        return $this->hasOne(Detail_Order::class, "id_order");
    }

    public function sales() {
        return $this->belongsTo(Sales::class, "id_sales");
    }

    public function costumer() {
        return $this->BelongsTo(Costumer::class, "id_costumer");
    }


}
