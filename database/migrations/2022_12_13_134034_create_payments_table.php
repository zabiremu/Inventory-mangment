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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customer_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('paid_status',51)->nullable();
            $table->integer('paid_ammount')->nullable();
            $table->integer('due_ammount')->nullable();
            $table->integer('total_ammount')->nullable();
            $table->integer('discount_ammount')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
