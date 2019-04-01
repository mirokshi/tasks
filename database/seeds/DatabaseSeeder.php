<?php

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
        // $this->call(UsersTableSeeder::class);
        initialize_roles();
        create_primary_user();
        create_example_tasks();
        create_example_tags();
        create_sample_tasks();
        sample_users_and_tasks();
        create_example_tasks_with_tags();
        initialize_sample_chat_channels();
        //Crea usuario para profesor
        pikachusorprendido();

        //TODO -> Como hacerlo en el register
    }
}
