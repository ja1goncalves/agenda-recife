<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            $table->binary('image');
            $table->string('title')->default('event.jpg');
            $table->string('mimetype')->default('jpg');
            $table->unsignedInteger('size')->default(0);
            $table->string('path')->nullable();
            $table->unsignedBigInteger('imageable_id')->nullable();
            $table->string('imageable_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('main_picture_id')->nullable()->after('sale_link');
            $table->foreign('main_picture_id')->on('pictures')
                ->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
