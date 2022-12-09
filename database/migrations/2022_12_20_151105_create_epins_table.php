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
        Schema::create('epins', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'use_by')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('type');
            $table->string('code')->unique();
            $table->float('cost')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0=unused, 1=used');
            $table->date('activation_date')->nullable();
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
        Schema::dropIfExists('epins');
    }
};
