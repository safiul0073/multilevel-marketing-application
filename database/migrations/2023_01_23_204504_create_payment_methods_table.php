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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['auto', 'manual'])->default('auto');
            $table->string('min')->default(-1)->comment('-1=no limit');
            $table->string('max')->default(-1)->comment('-1=no limit');
            $table->string('cred1')->nullable();
            $table->string('cred2')->nullable();
            $table->string('percent_charge')->default(0);
            $table->string('fixed_charge')->default(0);
            $table->string('class_name')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=disabled, 1=enabled');
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
        Schema::dropIfExists('payment_methods');
    }
};
