<?php

use App\Task;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Task::truncate();
        factory(User::class, 2)->create();
        factory(Task::class, 10)->create();
    }
}
