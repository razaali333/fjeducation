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
            // Add the user_id column as an unsignedBigInteger and set it as a foreign key
            $table->unsignedBigInteger('user_id')->after('id');

            // Set foreign key to reference users table with cascade on delete
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Drop foreign key and user_id column if rolling back the migration
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
