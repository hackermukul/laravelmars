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
        Schema::create('admin_user_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index();
            $table->integer('user_role_id')->length(11)->nullable();
            $table->integer('company_profile_id')->length(11)->nullable();
            $table->string('slug',250);
            $table->integer('position')->length(11)->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('added_by')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_user_role');
    }
};
