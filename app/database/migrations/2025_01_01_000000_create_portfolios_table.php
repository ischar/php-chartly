<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
  
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id(); 
            $table->string('email'); 
            $table->string('stock_name');
            $table->string('ticker'); 
            $table->decimal('stock_price', 15, 2); 
            $table->integer('stock_quantity'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}
