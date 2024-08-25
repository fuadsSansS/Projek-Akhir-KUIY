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
        Schema::create('rincian', function (Blueprint $table) {
            $table->uuid('id_rincian')->primary();
            $table->uuid('id_user');
            $table->uuid('id_asuransi')->nullable();
            $table->uuid('id_keimigrasian')->nullable();
            $table->uuid('id_homestay')->nullable();
            $table->uuid('id_dormitory')->nullable();
            $table->uuid('id_hotel')->nullable();
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());

            // $table->foreign('id_user')->references('id')->on('users')->constrained()->onDelete('set null');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_asuransi')->references('id_asuransi')->on('asuransi')->constrained()->onDelete('set null');
            $table->foreign('id_keimigrasian')->references('id_keimigrasian')->on('keimigrasian')->constrained()->onDelete('set null');
            $table->foreign('id_homestay')->references('id_homestay')->on('homestay')->constrained()->onDelete('set null');
            $table->foreign('id_dormitory')->references('id_dormitory')->on('dormitory')->constrained()->onDelete('set null');
            $table->foreign('id_hotel')->references('id_hotel')->on('hotel')->constrained()->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rincian');
    }
};
