<?php

namespace Laravolt\Collab\Http\Controllers;

use Illuminate\Routing\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = app('laravolt.collab')->client()->get('projects')->getJson();

        return view('collab::projects.index', compact('projects'));
    }

    public function show($id)
    {
        $tasks = app('laravolt.collab')->client()->get("projects/$id/tasks")->getJson();
        $project = $tasks['project'];
        $tasks = $tasks['tasks'];

        $subtasks = app('laravolt.collab')->subtasks($id);

        return view('collab::projects.show', compact('project', 'tasks', 'subtasks'));
    }
}
