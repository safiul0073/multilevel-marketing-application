<?php

use App\Models\User;
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
            $table->foreignIdFor(User::class, 'parent_id')->constrained('users')->cascadeOnDelete();
            $table->string('parent_position');
            $table->unsignedInteger('match_count')->default(1);
            $table->tinyInteger('status')->default(0)->comment('0=matched, 1=unmatched');
            $table->foreignIdFor(User::class, 'user_id')->constrained('users')->cascadeOnDelete();
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
