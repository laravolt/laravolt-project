<?php

namespace Laravolt\Collab;

class Collab
{
    protected $client;

    /**
     * Collab constructor.
     */
    public function __construct($config)
    {
        [
            'org_name' => $orgName,
            'app_name' => $appName,
            'username' => $username,
            'password' => $password,
            'host'     => $host,
        ] = $config;

        $authenticator = new \ActiveCollab\SDK\Authenticator\SelfHosted(
            $orgName,
            $appName,
            $username,
            $password,
            $host
        );

        $token = $authenticator->issueToken();

        if ($token instanceof \ActiveCollab\SDK\TokenInterface) {

            $this->client = new \ActiveCollab\SDK\Client($token);

        } else {
            throw new \Exception('Authentication failed');
        }
    }

    public function client()
    {
        return $this->client;
    }

    public function subtasks($id)
    {
        $tasks = $this->client()->get("projects/$id/tasks")->getJson();

        foreach($tasks['tasks'] as $task)
        {
            $task = $this->client()->get("projects/$id/tasks/".$task['id'])->getJson();
            foreach($task['subtasks'] as $subtask) {
                $subtasks[] = $subtask;
            }
        }

        return $subtasks;
    }
}
