<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollabTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collab_tasks', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('project_id');
            $table->text("name")->nullable();
            $table->string('class', 255)->nullable();
            $table->string('url_path', 255)->nullable();
            $table->unsignedInteger("assignee_id")->nullable();
            $table->unsignedInteger("delegated_by_id")->nullable();
            $table->unsignedInteger("completed_on")->nullable();
            $table->unsignedInteger("completed_by_id")->nullable();
            $table->boolean("is_completed");
            $table->unsignedInteger('comments_count')->default(0);
            $table->json('attachments')->nullable();
            $table->json('labels')->nullable();
            $table->boolean("is_trashed")->nullable();
            $table->unsignedInteger("trashed_on")->nullable();
            $table->unsignedInteger("trashed_by_id")->nullable();
            $table->boolean("is_hidden_from_clients")->nullable();
            $table->text('body')->nullable();
            $table->text('body_formatted')->nullable();
            $table->unsignedInteger("created_on")->nullable();
            $table->unsignedInteger("created_by_id")->nullable();
            $table->string("created_by_name", 255)->nullable();
            $table->string("created_by_email", 255)->nullable();
            $table->unsignedInteger("updated_on")->nullable();
            $table->unsignedInteger("updated_by_id")->nullable();
            $table->unsignedInteger("task_number")->nullable();
            $table->unsignedInteger("task_list_id")->nullable();
            $table->unsignedInteger("position")->nullable();
            $table->boolean('is_important');
            $table->unsignedInteger("start_on")->nullable();
            $table->unsignedInteger("due_on")->nullable();
            $table->float('estimate');
            $table->unsignedInteger('job_type_id');
            $table->string("fake_assignee_name", 255)->nullable();
            $table->string("fake_assignee_email", 255)->nullable();
            $table->unsignedInteger('total_subtasks');
            $table->unsignedInteger('completed_subtasks');
            $table->unsignedInteger('open_subtasks');
            $table->boolean('created_from_recurring_task_id');
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
        Schema::dropIfExists('collab_tasks');
    }
}
