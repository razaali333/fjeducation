<?php

use App\Models\ContentCategory;
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
        Schema::create('content_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        ContentCategory::query()->create(['name' => 'Book']);
        ContentCategory::query()->create(['name' => 'Video']);

        Schema::create('contents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(ContentCategory::class);
            $table->string('title');
            $table->string('cover');
            $table->text('description');
            $table->string('file');
            $table->timestamps();

            $table->foreign('content_category_id')->references('id')->on('content_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
        Schema::dropIfExists('content_categories');
    }
};
