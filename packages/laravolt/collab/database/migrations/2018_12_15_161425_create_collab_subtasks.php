<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollabSubtasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collab_subtasks', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger("task_id")->nullable();
            $table->unsignedInteger("project_id")->nullable();
            $table->text("name")->nullable();
            $table->string('class', 255)->nullable();
            $table->string('url_path', 255)->nullable();
            $table->unsignedInteger("assignee_id")->nullable();
            $table->unsignedInteger("delegated_by_id")->nullable();
            $table->unsignedInteger("completed_on")->nullable();
            $table->unsignedInteger("completed_by_id")->nullable();
            $table->unsignedInteger("is_completed")->nullable();
            $table->boolean("is_trashed")->nullable();
            $table->unsignedInteger("trashed_on")->nullable();
            $table->unsignedInteger("trashed_by_id")->nullable();
            $table->unsignedInteger("created_on")->nullable();
            $table->unsignedInteger("created_by_id")->nullable();
            $table->string("created_by_name", 255)->nullable();
            $table->string("created_by_email", 255)->nullable();
            $table->unsignedInteger("updated_on")->nullable();
            $table->unsignedInteger("due_on")->nullable();
            $table->unsignedInteger("position")->nullable();
            $table->string("fake_assignee_name", 255)->nullable();
            $table->string("fake_assignee_email", 255)->nullable();
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
        Schema::dropIfExists('collab_subtasks');
    }
}
