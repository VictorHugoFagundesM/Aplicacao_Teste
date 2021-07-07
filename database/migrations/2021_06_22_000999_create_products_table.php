<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            
            // Tabela
            $table->id();
            $table->string('name', 30);
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('size_id');
            $table->unsignedInteger('color_id');
            $table->float('price');
            $table->integer('amount');
            $table->text('description');
            $table->timestamps();

            // Constraints de relacionamento
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('RESTRICT');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
