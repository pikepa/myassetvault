<?php

use App\Models\User;
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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('asset_type');
            $table->text('description');
            $table->text('location');
            $table->text('acquired_year');
            $table->text('acquired_month');
            $table->integer('qty')->default(1);
            $table->bigInteger('acquired_value');
            $table->foreignIdFor(User::class)->constrained();
            $table->text('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
