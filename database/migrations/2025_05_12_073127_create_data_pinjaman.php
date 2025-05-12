<?php

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
        Schema::create('data_pinjaman', function (Blueprint $table) {
            $table->id();

            // Foreign keys to user and book
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');

            // Borrowing info
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable(); // Optional if book not returned yet
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('data_personals')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('data_stock')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pinjaman');
    }
};
