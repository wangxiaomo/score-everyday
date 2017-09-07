<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add user';

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
    public function handle()
    {
        $name = $this->ask("user name?");
        $email = $this->ask("email address?");
        $password = $this->secret("user password?");

        $u = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        dump($u);
    }
}
