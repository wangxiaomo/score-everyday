<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class CheckUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check user';

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
        $email = $this->ask("email address?");
        $password = $this->secret("user password?");

        $this->info("login as $email");
        if(Auth::attempt([
            'email' =>  $email, 'password' => $password
        ])){
            $this->question("login success!");
        }else{
            $this->error("login failed!");
        }
    }
}
