<?php

use App\Models\Nominee;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('sponsor_id')->index()->nullable();
            $table->string('first_name')->nullable()->index();
            $table->string('last_name')->nullable()->index();
            $table->string('username')->unique()->index();
            $table->string('email')->index();
            $table->string('phone')->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('sms_verified_at')->nullable();
            $table->string('password');
            $table->longText('address')->nullable();
            $table->string('city')->index()->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->foreignIdFor(Nominee::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('left_ref_id')->index()->nullable();
            $table->string('right_ref_id')->index()->nullable();
            $table->unsignedBigInteger('left_group')->default(0);
            $table->unsignedBigInteger('right_group')->default(0);
            $table->double('total_income', 15)->default(0);
            $table->float('total_withdraw')->default(0);
            $table->float('balance')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
