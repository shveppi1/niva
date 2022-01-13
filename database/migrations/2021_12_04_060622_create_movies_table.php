<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 400);
            $table->string('name_original')->nullable();
            $table->string('alt_name')->nullable();
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained();
            $table->text('description')->nullable();
            $table->string('status_movie')->nullable()->comment('съемки');
            $table->string('tagline')->nullable()->comment('слоган');
            $table->unsignedInteger('year')->nullable();
            $table->string('chanel')->nullable();
            $table->string('language')->nullable();
            $table->string('duration')->nullable();
            $table->text('source_url')->nullable();
            $table->string('picture')->nullable();
            $table->string('screen_url')->nullable();
            $table->timestamp('date_pub_rus')->nullable();
            $table->timestamp('date_pub_world')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
