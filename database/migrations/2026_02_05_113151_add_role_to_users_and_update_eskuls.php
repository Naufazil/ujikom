<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up(): void
{
    // Tambah kolom role ke users (enum: admin, pembina, siswa)
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'role')) {
            $table->enum('role', ['admin', 'pembina', 'siswa'])->default('siswa')->after('is_admin');
        }
    });

    // Ubah nama_pembina di eskuls menjadi pembina_id (foreign key)
    Schema::table('eskuls', function (Blueprint $table) {
        if (Schema::hasColumn('eskuls', 'nama_pembina')) {
            $table->dropColumn('nama_pembina');
        }
        if (!Schema::hasColumn('eskuls', 'pembina_id')) {
            $table->unsignedBigInteger('pembina_id')->nullable()->after('nama_eskul'); // After nama_eskul yang ada
            $table->foreign('pembina_id')->references('id')->on('users')->onDelete('set null');
        }
    });

    // Pastikan daftar_eskul punya status default 'pending'
    Schema::table('daftar_eskul', function (Blueprint $table) {
        if (Schema::hasColumn('daftar_eskul', 'status')) {
            $table->string('status')->default('pending')->change();
        }
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'role')) {
            $table->dropColumn('role');
        }
    });

    Schema::table('eskuls', function (Blueprint $table) {
        if (Schema::hasColumn('eskuls', 'pembina_id')) {
            $table->dropForeign(['pembina_id']);
            $table->dropColumn('pembina_id');
        }
        if (!Schema::hasColumn('eskuls', 'nama_pembina')) {
            $table->string('nama_pembina', 255)->nullable()->after('nama_eskul');
        }
    });

    Schema::table('daftar_eskul', function (Blueprint $table) {
        if (Schema::hasColumn('daftar_eskul', 'status')) {
            $table->string('status')->change();
        }
    });
}
};