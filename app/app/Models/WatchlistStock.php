<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchlistStock extends Model
{
    use HasFactory;

    protected $table = 'watchlist';

    protected $fillable = [
        'email',
        'stock_name',
        'ticker'
    ];

    public $timestamps = true;
}