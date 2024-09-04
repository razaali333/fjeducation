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
        Schema::table('transactions', function (Blueprint $table) {
              // Add package_id column with UUID type to match the rates table
              $table->uuid('rate_id')->nullable()->after('id');

              // Set foreign key constraint referencing the UUID id column in the rates table
              $table->foreign('rate_id')->references('id')->on('rates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
             // Drop foreign key constraint
             $table->dropForeign(['rate_id']);

             // Drop package_id column
             $table->dropColumn('rate_id');
        });
    }
};
