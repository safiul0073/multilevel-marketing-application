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
            $table->string('profession')->nullable();
            $table->string('gender')->nullable();
            $table->string('nid_number')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('birthday')->nullable();
            $table->longText('address')->nullable();
            $table->string('left_ref_id')->index()->nullable();
            $table->string('right_ref_id')->index()->nullable();
            $table->unsignedBigInteger('left_group')->default(0);
            $table->unsignedBigInteger('right_group')->default(0);
            $table->double('total_income', 15)->default(0);
            $table->float('total_withdraw')->default(0);
            $table->float('balance')->default(0);
            $table->tinyInteger('isUpdated')->default(0)->comment('0=not updated, 2=update_pending, 1=updated');
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
