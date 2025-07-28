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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('thumb_url')->nullable();
            $table->string('poster_url')->nullable();
            $table->enum('status', ['public', 'draft', 'private'])->default('public');
            $table->enum('type', ['single', 'series'])->default('single');
            $table->year('release_year')->nullable();
            $table->foreignId('country_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->bigInteger('view_count')->default(0);
            $table->float('rating_avg')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
