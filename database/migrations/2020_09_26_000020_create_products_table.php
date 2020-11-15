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
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();
            // Params
            $table->string('type')->default(\App\Models\Category::TYPE_DEFAULT);
            $table->string('code')->unique();
            $table->integer('price')->nullable();
            $table->integer('rating')->default(0);
            $table->integer('amount')->nullable();
            // Settings
            $table->string('unit')->nullable();
            $table->boolean('is_new')->default(false);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_enabled')->default(true);
            $table->integer('old_price')->nullable()->default(null);
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
        Schema::dropIfExists('products');
    }
}
