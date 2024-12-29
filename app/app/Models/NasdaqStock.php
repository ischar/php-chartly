<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasdaqStock extends Model
{
    use HasFactory;

    protected $table = 'nasdaq'; 

    protected $fillable = [
      'Symbol',
      'Name',
      'market Cap',
      'Country',
      'IPO Year',
      'Volume',
      'Sector',
      'Industry' 
    ];

    public $timestamps = false;
}