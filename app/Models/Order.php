<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $fillable = [
        "id_order",
        'id_costumer',
        'id_sales',
        'total_harga',
        'tgl_order',
        'bentuk_pembayaran'
    ];

    public function detail_order()
    {
        return $this->hasMany(Detail_Order::class, "id_order", "id_order");
    }

    // public function sales()
    // {
    //     return $this->belongsTo(Sales::class, "id_sales");
    // }

    // public function costumer()
    // {
    //     return $this->BelongsTo(Costumer::class, "id_costumer");
    // }

    // public function detail_order()
    // {
    //     return $this->belongsTo('App\Models\Detail_Order', 'id_order', 'id_order');
    // }

    public function costumer()
    {
        return $this->belongsTo('App\Models\Costumer', 'id_costumer', 'id_costumer');
    }

    public function sales()
    {
        return $this->belongsTo('App\Models\Sales', 'id_sales', 'id_sales');
    }
}
