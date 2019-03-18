<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravolt\Auth\Services\LdapService;

class LdapLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ldap:login {username} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test login via LDAP';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(LdapService $ldapService)
    {
        $username = $this->argument('username');
        $password = $this->argument('password');

        try {
            $user = $ldapService->getUser(['password' => $password, config('laravolt.auth.identifier') => $username]);
            dd($user);
        } catch (\Exception $e) {
            $this->error(get_class($e).":".$e->getMessage());
        }
    }
}
