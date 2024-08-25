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

        Schema::create('homestay', function (Blueprint $table) {
            $table->uuid('id_homestay')->primary();
            $table->string('nama_homestay');
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
        Schema::dropIfExists('homestay');
    }
};
