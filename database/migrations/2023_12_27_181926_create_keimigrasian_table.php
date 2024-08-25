<?php

use Carbon\Carbon;
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
        Schema::create('keimigrasian', function (Blueprint $table) {
            $table->uuid('id_keimigrasian')->primary();
            $table->string('item');
            $table->text('keimigrasian');
            $table->text('kemenaker');
            $table->integer('biaya_keimigrasian');
            $table->integer('biaya_kemenaker');
            $table->integer('total_biaya');
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keimigrasian');
    }
};
