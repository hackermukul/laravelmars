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
        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->string('registrations_type', 100)->nullable();
            $table->string('father_name', 250)->nullable();
            $table->string('mobile_no', 10)->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->string('course', 255)->nullable();
            $table->string('semester', 50)->nullable();
            $table->string('roll_no', 50)->nullable();
            $table->string('academic_session', 100)->nullable();
            $table->string('user_id', 100)->unique()->nullable();
            $table->string('password', 255)->nullable();
            $table->string('department', 150)->nullable();
            $table->string('child_name', 250)->nullable();
            $table->string('session', 100)->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->foreignId('added_by')->nullable()->index();
            $table->integer('updated_by')->length(11)->nullable();
            $table->tinyInteger('is_deleted')->default(0)->nullable();
            $table->integer('is_deleted_by')->length(11)->nullable();
            $table->timestamp('is_deleted_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
