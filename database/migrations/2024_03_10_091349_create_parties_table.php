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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('surname');
            $table->string('title');
            $table->string('gender');
            $table->string('party_type')->nullable();
            $table->string('profession');
            $table->string('email');
            $table->string('mobile');
            $table->string('location');
            $table->string('branch');
            $table->text('mailing_addr');
            $table->boolean('deceased')->default(false);
            $table->string('member_since')->nullable();
            $table->string('trans_member')->nullable();
            $table->string('trans_status')->nullable();
            $table->string('trans_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
