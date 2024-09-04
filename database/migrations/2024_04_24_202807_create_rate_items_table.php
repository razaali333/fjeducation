<?php

use App\Models\Rate;
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
        Schema::create('rate_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Rate::class);
            $table->string('title');
            $table->boolean('is_checked')->default(false);
            $table->timestamps();

            $table->foreign('rate_id')->references('id')->on('rates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_items');
    }
};
