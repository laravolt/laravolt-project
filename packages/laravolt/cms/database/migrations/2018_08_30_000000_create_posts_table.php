<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'posts', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('author_id');
                $table->string('type', 40);
                $table->string('status', 40)->index();
                $table->unsignedInteger('position');
                $table->nestedSet();
                $table->text('title');
                $table->string('slug', 180)->nullable()->index();
                $table->text('content')->nullable();
                $table->schemalessAttributes('meta');
                $table->timestamps();
                $table->timestamp('published_at')->nullable();

                $table->foreign('author_id')
                    ->references('id')->on(app(config('auth.providers.users.model'))->getTable())
                    ->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
