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
        Schema::create('nominees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('nominee_name');
            $table->string('relation');
            $table->string('nominee_profession');
            $table->string('nominee_birthday');
            $table->string('nominee_gender');
            $table->string('nominee_nid');
            $table->string('nominee_father');
            $table->string('nominee_mother');
            $table->string('nominee_phone');
            $table->string('nominee_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nominees');
    }
};
