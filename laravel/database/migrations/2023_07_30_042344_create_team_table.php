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
        Schema::create('team', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->tinyInteger("status", 1);
            $table->timestamps();
        });

        Schema::create('team_user', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger("user_id");
          $table->unsignedBigInteger("team_id");
        })
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team');
    }
};
