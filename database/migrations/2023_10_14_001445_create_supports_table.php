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
        if (!Schema::hasTable('supports')) {
            Schema::create('supports', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('lesson_id');
                $table->uuid('user_id');
                $table->text('description');
                $table->enum('status', ['P', 'A', 'C'])->default('P');

                $table->foreign('lesson_id')
                ->references('id')
                ->on('lessons');

                $table->foreign('user_id')
                ->references('id')
                ->on('users');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supports', function (Blueprint $table) {
            $table->dropForeign(['lesson_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('supports');
    }
};
