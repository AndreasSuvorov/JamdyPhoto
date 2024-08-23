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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('location');
            $table->string('description');
            // Start and end date of the album
            $table->date('start_date');
            $table->date('end_date')->nullable();

            // Activated
            $table->boolean('active')->default(true);
            // Upload Activated
            $table->boolean('upload_active')->default(true);
            // Download Activated
            $table->boolean('download_active')->default(true);
            // Password
            $table->boolean('password_active')->default(false);
            $table->string('password')->nullable();

            // show Hero Image
            $table->boolean('show_hero_image')->default(true);

            // sort by
            $table->string('sort_by')->default('created_at');
            $table->string('sort_order')->default('desc');

            // Show images without verification
            $table->boolean('images_without_verification')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
