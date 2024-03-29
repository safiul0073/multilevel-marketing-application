<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->index()->constrained()->cascadeOnDelete();
            $table->string('name')->index();
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->longText('description')->nullable();
            $table->string('referral_type')->default('percent')->comment('percent means % and direct means direct');
            $table->unsignedInteger('refferral_commission')->default(0);
            $table->double('price', 15)->default(0);
            $table->string('video_url')->nullable();
            $table->tinyInteger('status')->index()->default(1)->comment('1=active, 0=inactive');
            $table->tinyInteger('is_package')->index()->default(0)->comment('0=product, 1=package');
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
        Schema::dropIfExists('products');
    }
};
