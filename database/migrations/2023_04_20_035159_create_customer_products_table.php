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
        Schema::create('customer_products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->integer('published')->default(0);
            $table->integer('status')->default(0);
            $table->string('added_by', 50)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('subsubcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('photos', 255)->nullable();
            $table->string('thumbnail_img', 150)->nullable();
            $table->string('conditon', 50)->nullable();
            $table->text('location')->nullable();
            $table->string('video_provider', 100)->nullable();
            $table->string('video_link', 200)->nullable();
            $table->string('unit', 200)->nullable();
            $table->string('tags', 255)->nullable();
            $table->mediumText('description')->nullable();
            $table->double('unit_price', 28, 2)->nullable()->default(0);
            $table->string('meta_title', 200)->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_img', 150)->nullable();
            $table->string('pdf', 200)->nullable();
            $table->string('slug', 200)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories');
            $table->foreign('subsubcategory_id')->references('id')->on('sub_sub_categories');
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_products');
    }
};
