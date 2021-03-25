<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    use HasFactory;
    protected $table = 'costumer';
    protected $primaryKey = 'id_costumer';
    protected $fillable = [
        'nama_costumer',
        'alamat_costumer',
        'target_harga_costumer',
    ];
}
