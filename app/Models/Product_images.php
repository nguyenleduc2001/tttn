<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_images extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    public $timestamps = false;
    protected $fillable = ['image'];
}