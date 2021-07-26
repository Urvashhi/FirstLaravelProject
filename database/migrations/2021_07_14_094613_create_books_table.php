<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
			$table->string('isbn');
			$table->string('title');
			$table->string('author');
			$table->string('publisher');
			$table->string('year');
			$table->text('description');
			$table->string('lang');
			$table->string('category');
			$table->string('quantity');
			$table->string('image');
			//$table->file('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
