<?php

use App\Task;
use App\User;

if (!function_exists('create_primary_user')){
    function create_primary_user() {
        $user = User::where('email', 'mirokshirojas@iesebre.com')->first();
        if (!$user) {

         User::firstOrCreate ([
            'name' => 'Mirokshi Rojas',
            'email' => 'mirokshirojas@iesebre.com',
            'password' => bcrypt(env('PRIMARY_USER_PASSWORD', '123456'))
        ]);
    }
    }
}

if (!function_exists('create_example_tasks')) {
    function create_example_tasks() {
        Task::create([
            'name' => 'Comprar pan',
            'completed' => false
        ]);

        Task::create([
            'name' => 'Comprar leche',
            'completed' => false
        ]);

        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true
        ]);
    }
}