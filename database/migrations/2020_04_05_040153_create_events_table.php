<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('artist', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('location', 150);
            $table->dateTime('when');
            $table->dateTime('end_at')->nullable();
            $table->string('sale_link')->nullable();
            $table->boolean('indicated')->default(false);
            $table->boolean('featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('events_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('event_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->on('categories')
                ->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('event_id')->on('events')
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
        Schema::dropIfExists('events_categories');
        Schema::dropIfExists('events');
    }
}
