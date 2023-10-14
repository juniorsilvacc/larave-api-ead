<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('lessons')) {
            Schema::create('lessons', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('module_id');
                $table->string('name')->unique();
                $table->string('url')->unique();
                $table->text('description')->nullable();
                $table->string('video')->unique();

                $table->foreign('module_id')
                ->references('id')
                ->on('modules');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['module_id']);
        });

        Schema::dropIfExists('lessons');
    }
};
