<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity')->index();
            $table->boolean('isDesktop')->nullable();
            $table->boolean('isTablet')->nullable();
            $table->boolean('isMobile')->nullable();
            $table->string('browserName')->nullable();
            $table->string('platformName')->nullable();
            $table->boolean('isWindows')->nullable();
            $table->boolean('isLinux')->nullable();
            $table->boolean('isMac')->nullable();
            $table->boolean('isAndroid')->nullable();
            $table->boolean('isChrome')->nullable();
            $table->boolean('isFirefox')->nullable();
            $table->boolean('isOpera')->nullable();
            $table->boolean('isSafari')->nullable();
            $table->boolean('isIE')->nullable();
            $table->boolean('isEdge')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}