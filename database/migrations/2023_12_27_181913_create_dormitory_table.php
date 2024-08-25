<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::create('dormitory', function (Blueprint $table) {
                $table->uuid('id_dormitory')->primary();
                $table->string('nama_dormitory');
                $table->string('alamat');
                $table->integer('jarak_ke_yarsi_mobil');
                $table->integer('jarak_ke_yarsi_motor');
                $table->integer('jarak_ke_yarsi_jk');
                $table->integer('ipl');
                $table->integer('listrik');
                $table->integer('wifi');
                $table->string('kelebihan')->nullable();
                $table->string('kekurangan')->nullable();
                $table->integer('harga');
                $table->timestamp('created_at')->default(Carbon::now());
                $table->timestamp('updated_at')->default(Carbon::now());
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dormitory');
    }
};
