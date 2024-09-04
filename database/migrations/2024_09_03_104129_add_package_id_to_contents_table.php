<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            // Add package_id column with UUID type to match the rates table
            $table->uuid('package_id')->nullable()->after('id');

            // Set foreign key constraint referencing the UUID id column in the rates table
            $table->foreign('package_id')->references('id')->on('rates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['package_id']);

            // Drop package_id column
            $table->dropColumn('package_id');
        });
    }
};
