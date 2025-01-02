<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $table = 'portfolios';

    protected $fillable = [
        'email',
        'stock_name',
        'stock_price',
        'ticker',
        'stock_quantity',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}