<?php

namespace Laravolt\Collab\Http\Controllers;

use Illuminate\Routing\Controller;
use Laravolt\Collab\Models\Project;
use Laravolt\Collab\Models\SubTask;
use Laravolt\Collab\Models\Task;

class ProjectController extends Controller
{
    public function index()
    {
        Project::truncate();
        Task::truncate();
        SubTask::truncate();

        $projects = app('laravolt.collab')->client()->get('projects')->getJson();
        foreach($projects as $project) {
            Project::create($project);

            $tasks = app('laravolt.collab')->client()->get("projects/{$project['id']}/tasks")->getJson();
            $tasks = $tasks['tasks'];

            foreach ($tasks as $task) {
                Task::create($task);

                $subtasks = app('laravolt.collab')->subtasks($project['id']);
                foreach ($subtasks as $subtask) {
                    SubTask::create($subtask);
                }
            }


        }
        return view('collab::projects.index', compact('projects'));
    }

    public function show($id)
    {
        $tasks = app('laravolt.collab')->client()->get("projects/$id/tasks")->getJson();
        $project = $tasks['project'];
        $tasks = $tasks['tasks'];
        dd($tasks);

        $subtasks = app('laravolt.collab')->subtasks($id);

        return view('collab::projects.show', compact('project', 'tasks', 'subtasks'));
    }
}
