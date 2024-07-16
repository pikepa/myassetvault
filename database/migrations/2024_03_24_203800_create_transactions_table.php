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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            //  $table->unsignedInteger('party_id');
            $table->date('transaction_date');
            $table->string('document_ref');
            $table->string('year');
            $table->string('membership_type');
            $table->smallInteger('amount');
            $table->string('status');
            $table->text('comments');
            $table->timestamps();

            $table->foreignId('party_id')->references('id')->on('parties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
