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
        User::create([
            'name' => 'Sabuz',
            'email' => 'sabuzremotejob@gmail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'admin' => '1',
        ]);
        factory(User::class, 2)->create();
        factory(Task::class, 10)->create();
    }
}
