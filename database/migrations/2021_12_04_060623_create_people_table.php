<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name', 400);
            $table->string('name_original')->nullable();
            $table->string('slug')->unique();
            $table->string('birthday')->nullable();
            $table->text('biography')->nullable();
            $table->string('inst')->nullable();
            $table->string('twitter')->nullable();
            $table->string('picture')->nullable();
            $table->enum('status', ["PUBLISHED","DISABLE","MODERATION"])->default('MODERATION');
            $table->unsignedBigInteger('author_id');
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
        Schema::dropIfExists('people');
    }
}
