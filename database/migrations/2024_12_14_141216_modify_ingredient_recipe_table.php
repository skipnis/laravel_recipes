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
        Schema::table('ingredient_recipe', function (Blueprint $table) {
            // Изменяем столбец 'quantity' с float на decimal
            $table->decimal('quantity', 8, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ingredient_recipe', function (Blueprint $table) {
            // Возвращаем обратно к float, если нужно
            $table->float('quantity')->nullable()->change();
        });
    }
};
