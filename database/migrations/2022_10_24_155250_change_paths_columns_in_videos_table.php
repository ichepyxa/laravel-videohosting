<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->text('description')->nullable()->default(null)->change();
            $table->string('video_path', 100)->nullable()->default(null)->change();
            $table->string('cover_path', 100)->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->text('description')->nullable(false)->default(false);
            $table->string('video_path', 50)->nullable()->default(null);
            $table->string('cover_path', 50)->nullable()->default(null);
        });
    }
};