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
        Schema::create('cart_orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name'); // Thêm trường tên khách hàng
            $table->unsignedBigInteger('product_id');
            $table->float('price');
            $table->integer('quantity');
            $table->decimal('total', 10, 2);
            $table->timestamps();
            // Định nghĩa mối quan hệ khóa ngoại với bảng products
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_orders');
    }
};
