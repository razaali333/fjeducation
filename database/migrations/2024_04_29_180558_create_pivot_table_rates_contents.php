<?php

use App\Models\Content;
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
        Schema::create('content_rate', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Rate::class);
            $table->foreignIdFor(Content::class);
            $table->timestamps();

            $table->foreign('rate_id')->references('id')->on('rates')->onDelete('cascade');
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_rate');
    }
};
