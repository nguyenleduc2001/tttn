<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_sale extends Model
{
    use HasFactory;

    protected $table = 'product_sale';
    public $timestamps = false;

    protected $fillable = ['price_sale', 'date_begin', 'date_end'];
}
