<?php

namespace App\Console\Commands;

use App\Models\Operator;
use App\Models\User;
use Illuminate\Console\Command;

class AsOperator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:operator {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set user as operator';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $user = User::whereEmail($email);
        if (!$user->exists()) {
            return $this->error('User doesnt exist');
        }

        $user = $user->first();

        $operator = Operator::whereEmail($user->email)->firstOrCreate([
            'email' => $user->email,
        ], [
            'name' => $user->name,
            'email' => $user->email,
            'active' => true,
        ]);

        if ($operator) {
            $this->info('successfuly');
        } else {
            $this->error('fail');
        }
    }
}
