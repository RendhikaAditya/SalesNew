<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_barang',
        'jml_barang',
    ];
}
