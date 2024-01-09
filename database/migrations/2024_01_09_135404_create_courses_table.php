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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('instructor_id');
            $table->text('course_image')->nullable();
            $table->text('course_title')->nullable();
            $table->string('course_name')->nullable();
            $table->string('course_name_slug')->unique()->nullable();

            $table->longText('description')->nullable();
            $table->text('video')->nullable();
            $table->string('label')->nullable();
            $table->string('duration')->nullable();
            $table->string('resources')->nullable();
            $table->string('certificate')->nullable();

            $table->string('selling_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->text('prerequisites')->nullable();
            $table->string('bestseller')->nullable();
            $table->text('featured')->nullable();
            $table->text('highestrated')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=Inactive', '1=Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
