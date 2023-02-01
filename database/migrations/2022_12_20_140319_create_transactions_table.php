<?php

use App\Models\Product;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->index()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'member_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('type')->index()->default('transfer')->comment('transfer, add, sub');
            $table->double('amount', 15)->default(0);
            $table->float('charge')->default(0);
            $table->longText('message')->nullable();
            $table->boolean('status')->index()->default(true);
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
        Schema::dropIfExists('transactions');
    }
};
