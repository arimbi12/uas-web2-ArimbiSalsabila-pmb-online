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
    Schema::table('mahasiswas', function (Blueprint $table) {
        $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
        // Sekarang kita tidak butuh kolom string 'jurusan' lagi, bisa dihapus atau dibiarkan
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            //
        });
    }
};
