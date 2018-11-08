<?php

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Support\Facades\DB;

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

if (!function_exists('create_example_tags')) {
    function create_example_tags() {
        Tag::create([
            'name' => 'Compras',
            'description' => 'Aqui van las compras',
            'color' => '#04B404'
        ]);

        Tag::create([
            'name' => 'Estudios',
            'description' => 'Aqui van los estudios',
            'color' => '#04B404'
        ]);

        Tag::create([
            'name' => 'Trabajo',
            'description' => 'Aqui van los trabajos',
            'color' => '#04B404'
        ]);
    }
}

if (!function_exists('create_mysql_database')){
    function create_mysql_database($name){
        //PDO
        // MySQL : CREATE DATABASE IF NOT EXISTS $name
        $statement = "CREATE DATABASE IF NOT EXISTS $name";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}

if (!function_exists('drop_mysql_database')){
    function drop_mysql_database($name){
        //PDO
        // MySQL : DROP DATABASE IF NOT EXISTS $name
        $statement = "DROP DATABASE IF EXISTS $name";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}

if (!function_exists('create_mysql_user')){
    function create_mysql_user($name, $password = null, $host='localhost'){
        //PDO
        if (!$password) $password =str_random();
        $statement = "CREATE USER IF NOT EXISTS {$name}@{$host}";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        $statement = "ALTER USER '{$name}'@'{$host}' IDENTIFIED BY '{$password}'";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        return $password;
    }
}

if (!function_exists('grant_mysql_privileges')) {
    function grant_mysql_privileges($user, $database, $host = 'localhost')
    {
        //PDO
        $statement = "GRANT ALL PRIVILEGES ON {$database}.* TO '{$user}'@'{$host}' WITH GRANT OPTION";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
        $statement = "FLUSH PRIVILEGES";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}

if (!function_exists('create_database')) {
    function create_database()
    {

        create_mysql_database(env('DB_DATABASE'));
        create_mysql_user(env('DB_USERNAME'),env('DB_PASSWORD'));
        grant_mysql_privileges(env('DB_USERNAME'),env('DB_DATABASE'));
    }
}