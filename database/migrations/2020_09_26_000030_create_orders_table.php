<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('status')->default(\App\Models\Order::STATUS_NEW);
            // Additional
            $table->string('city')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('address')->nullable();
            $table->text('comment')->nullable();

            $table->string('delivery_type')->nullable();
            $table->string('pay_type')->nullable();
            // User device info
            $table->string('ip')->nullable();
            $table->text('user_agent')->nullable();
            // Management
            $table->foreignId('manager_id')->nullable(true)->constrained('users')->onDelete('cascade');
            // Time
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
        Schema::dropIfExists('orders');
    }
}
