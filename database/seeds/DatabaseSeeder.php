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
        create_primary_user();
        create_example_tasks();
        initialize_roles();


        // Crear usuarios de prueba
        sample_users();

        //Crea usuario para profesor
        profe();

        //TODO -> Como hacerlo en el register
    }
}
