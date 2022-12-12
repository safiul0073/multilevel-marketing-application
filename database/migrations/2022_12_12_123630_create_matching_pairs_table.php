<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matching_pairs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'matcher_id')->constrained('users')->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'match_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matching_pairs');
    }
};
