<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('instructions', function (Blueprint $table) {
            $table->dropColumn('step_number'); // Удаляем колонку step_number
            $table->integer('time')->nullable(); // Добавляем колонку time
        });
    }

    public function down()
    {
        Schema::table('instructions', function (Blueprint $table) {
            $table->integer('step_number')->nullable(); // Восстанавливаем step_number
            $table->dropColumn('time'); // Удаляем колонку time
        });
    }
};
