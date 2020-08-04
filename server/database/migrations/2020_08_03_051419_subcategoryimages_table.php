<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubcategoryimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategoryimages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sub_category_id')->unsigned();
            $table->foreign('sub_category_id')
                ->references('id')
                ->on('subcategories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('image_link')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('subcategoryimages');
    }
}
