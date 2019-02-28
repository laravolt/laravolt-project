<?php

namespace Laravolt\Collab\Console\Commands;

use Illuminate\Console\Command;
use Laravolt\Collab\Models\Project;
use Laravolt\Collab\Models\SubTask;
use Laravolt\Collab\Models\Task;

class Pull extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravolt:collab:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull active collab projects, tasks, and subtasks.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Cleaning previous data');
        Project::truncate();
        Task::truncate();
        SubTask::truncate();

        $whitelist = [
            162,
            180,
            193,
            205,
            211,
            198,
            179,
            204,
            138,
        ];

        $this->info("Pull projects");
        $projects = app('laravolt.collab')->client()->get('projects')->getJson();
        $this->info("Pull projects done");

        $totalProjects = count($projects);
        foreach ($projects as $i => $project) {
            Project::create($project);

            try {
                $this->info(sprintf("Processing %d/%d: %s", $i + 1, $totalProjects, $project['name']));
                $tasks = app('laravolt.collab')->client()->get("projects/{$project['id']}/tasks")->getJson();
                $tasks = $tasks['tasks'];

                $bar = $this->output->createProgressBar(count($tasks));
                $bar->start();

                foreach ($tasks as $task) {
                    Task::create($task);

                    $taskDetail = app('laravolt.collab')->client()->get("projects/{$project['id']}/tasks/".$task['id'])->getJson();
                    $subtasks = $taskDetail['subtasks'];

                    foreach ($subtasks as $subtask) {
                        SubTask::create($subtask);
                    }
                    $bar->advance();
                }
                $bar->finish();
                $this->line();

            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }
    }
}
