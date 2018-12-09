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

        // Crear usuarios de prueba
        sample_users_and_tasks();

        //Crea usuario para profesor
        profe();

        //TODO -> Como hacerlo en el register
    }
}
