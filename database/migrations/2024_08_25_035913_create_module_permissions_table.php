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
        Schema::create('module_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id')->length(11)->nullable();
            $table->integer('user_role_id')->length(11)->nullable();
            $table->integer('view_module')->length(11)->nullable();
            $table->integer('add_module')->length(11)->nullable();
            $table->integer('update_module')->length(11)->nullable();
            $table->integer('delete_module')->length(11)->nullable();
            $table->integer('approval_module')->length(11)->nullable();
            $table->integer('import_data')->length(11)->nullable();
            $table->integer('export_data')->length(11)->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('added_by')->nullable()->index();
            $table->integer('updated_by')->length(11)->nullable();
            $table->tinyInteger('is_deleted')->default(0); // `birth_day` tinyint(3)
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
        Schema::dropIfExists('module_permissions');
    }
};
