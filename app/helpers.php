<?php

use App\Task;

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