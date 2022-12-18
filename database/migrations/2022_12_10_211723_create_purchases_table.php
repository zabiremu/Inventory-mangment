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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('purchase_no')->nullable();
            $table->date('date')->nullable();
            $table->string('description')->nullable();
            $table->integer('buying_qty')->nullable();
            $table->integer('unit_price')->nullable();
            $table->integer('buying_price')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0=pending,1=Approved');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('purchases');
    }
};
