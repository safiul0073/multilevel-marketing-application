<?php

use App\Models\Product;
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
        Schema::create('epin_mains', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->index()->constrained()->cascadeOnDelete();
            $table->string('customer_name')->index();
            $table->string('customer_phone')->index();
            $table->string('type');
            $table->string('quantity');
            $table->float('cost')->default(0);
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
        Schema::dropIfExists('epin_mains');
    }
};
