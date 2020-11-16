<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:user {--id=} {--email=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove a user*, profile and socials from the database by user id. *All other user data remains.';

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
        $id = $this->option('id');
        if (! is_numeric($id) === true) {
            $model = User::select('id')->where('email', $this->option('id'))->first();
            if ($model === null) {
                $this->error('User '.$id.' didn`t exist.');
                dd();
            }
        }
        $model = User::withTrashed()->find($id);
        if ($model === null) {
            $this->error('User '.$id.' didn`t exist.');
            dd();
        }
        //DELETE USER & STATUSES
        $statuses = $model->statuses;
        $model->deleteStatus($statuses);
        $model->forceDelete();

        $this->info('User:'.$model->id.' ('.$model->email.') was deleted');
    }
}
