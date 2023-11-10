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
        if (!Schema::hasTable('reply_supports')) {
            Schema::create('reply_supports', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('support_id');
                $table->uuid('user_id');
                $table->text('description');

                $table->foreign('support_id')
                ->references('id')
                ->on('supports');

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
        Schema::table('reply_supports', function (Blueprint $table) {
            $table->dropForeign(['support_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('reply_supports');
    }
};
