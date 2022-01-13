<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('or_name')->nullable();
            $table->unsignedInteger('number');
            $table->text('description')->nullable();
            $table->timestamp('realease_date')->nullable();
            $table->string('picture')->nullable();
            $table->foreignId('season_id')->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series');
    }
}
