<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollabProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collab_projects', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('class', 255)->nullable();
            $table->string('url_path', 255)->nullable();
            $table->string("name", 255)->nullable();
            $table->unsignedInteger("completed_on")->nullable();
            $table->unsignedInteger("completed_by_id")->nullable();
            $table->boolean("is_completed")->nullable();
            $table->json('members')->nullable();
            $table->unsignedInteger("category_id")->nullable();
            $table->unsignedInteger("label_id")->nullable();
            $table->boolean("is_trashed")->nullable();
            $table->unsignedInteger("trashed_on")->nullable();
            $table->unsignedInteger("trashed_by_id")->nullable();
            $table->unsignedInteger("created_on")->nullable();
            $table->unsignedInteger("created_by_id")->nullable();
            $table->string("created_by_name", 255)->nullable();
            $table->string("created_by_email", 255)->nullable();
            $table->unsignedInteger("updated_on")->nullable();
            $table->unsignedInteger("updated_by_id")->nullable();
            $table->text('body')->nullable();
            $table->text('body_formatted')->nullable();
            $table->unsignedInteger("company_id")->nullable();
            $table->unsignedInteger("leader_id")->nullable();
            $table->unsignedInteger("currency_id")->nullable();
            $table->unsignedInteger("template_id")->nullable();
            $table->unsignedInteger("based_on_type")->nullable();
            $table->unsignedInteger("based_on_id")->nullable();
            $table->string("email", 255)->nullable();
            $table->boolean('is_tracking_enabled')->nullable();
            $table->boolean('is_client_reporting_enabled')->nullable();
            $table->boolean('is_sample')->nullable();
            $table->unsignedBigInteger('budget')->nullable();
            $table->unsignedInteger('count_tasks')->default(0);
            $table->unsignedInteger('count_discussions')->default(0);
            $table->unsignedInteger('count_files')->default(0);
            $table->unsignedInteger('count_notes')->default(0);
            $table->unsignedInteger('last_activity_on')->nullable();
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
        Schema::dropIfExists('collab_projects');
    }
}
