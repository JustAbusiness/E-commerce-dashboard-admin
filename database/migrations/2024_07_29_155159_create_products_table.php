<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('cannonical');
            $table->string('name');
            $table->unsignedBigInteger('product_catalogue_id');
            $table->foreign('product_catalogue_id')->references('id')->on('product_catalogues');
            $table->string('measure', 50)->nullable();
            $table->float('weight')->default(0);
            $table->string('mass', 5)->nullable();
            $table->text('description');
            $table->tinyInteger('publish');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
