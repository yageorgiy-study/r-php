<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user with admin permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new User();
        $user->password = Hash::make($this->ask("Password?"));
        $user->email = $this->ask("Email?");
        $user->name = $this->ask("Name?");
        $user->save();

        $user->assignRole("admin");
        $user->save();
    }
}
