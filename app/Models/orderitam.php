<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderitam extends Model
{
    use HasFactory;

    protected $fillable = [
        'orders_id',
        'products_id',
        'quantity',
        'size',
    ];
    
}