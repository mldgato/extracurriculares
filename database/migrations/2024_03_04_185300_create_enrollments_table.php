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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('classroom_student_id');
            $table->unsignedBigInteger('activity_user_id');
            $table->enum('status', [0, 1])->default(1);
            $table->dateTime('registrationdate');

            $table->foreign('classroom_student_id')->references('id')->on('classroom_students')->onDelete('cascade');
            $table->foreign('activity_user_id')->references('id')->on('activity_user')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
