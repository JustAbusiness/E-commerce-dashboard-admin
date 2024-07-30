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
        Schema::table('products', function (Blueprint $table) {
            $table->smallInteger('tax_status');
            $table->unsignedBigInteger('input_tax_id')->nullable();
            $table->foreign('input_tax_id')->references('id')->on('product_catalogues')->onDelete('cascade');
            $table->unsignedBigInteger('output_tax_id')->nullable();
            $table->foreign('output_tax_id')->references('id')->on('product_catalogues')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['input_tax_id']);
            $table->dropColumn('input_tax_id');
            $table->dropForeign(['output_tax_id']);
            $table->dropColumn('output_tax_id');
            $table->dropColumn('tax_status');
        });
    }
};
