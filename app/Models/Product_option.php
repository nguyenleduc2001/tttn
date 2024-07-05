<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_option extends Model
{
    use HasFactory;
    protected $table = 'product_option';
    public $timestamps = false;
    protected $fillable = ['size', 'color'];
}