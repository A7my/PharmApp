<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->integer('client_id');
            $table->integer('items');
            $table->integer('total_price');
            $table->text('address');
            $table->foreignId('delivery_man_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->enum('status' , ['delivered' , 'not_delivered'])->default('not_delivered');
            $table->enum('pay',['paid' , 'not_paid'])->default('not_paid');
            $table->timestamps();

            // $product->decreament('quantity' , $item->quantity);
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
};
