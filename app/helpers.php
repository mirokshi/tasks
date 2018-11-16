<?php

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

if (!function_exists('create_primary_user')){
    function create_primary_user() {
        $user = User::where('email','mirokshirojas@iesebre.com')->first();
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
            'completed' => false,
            'description' => 'fui a comprar a la esquina',
            'user_id' => 1
        ]);

        Task::create([
            'name' => 'Comprar leche',
            'completed' => false,
            'description' => 'Compre leche en el mercadona',
            'user_id' => 1
        ]);

        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true,
            'description' => 'Debo comprobar todos los tests',
            'user_id' => 1
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

if (!function_exists('initialize_roles')){
    function initialize_roles() {
        //CREAR ROLES
        try {

            $taskManager =Role::create([
                'name' => 'TasksManager'
            ]);
        } catch (Exception $e){

        }

        try {

            $tasks = Role::create([
                'name' => 'Tasks'
            ]);
        }catch (Exception $e){

        }


        //CREAR PERMISOS
        //--CRUD de tasques
       try {
           Permission::create([
               'name' => 'tasks.index'
           ]);
           Permission::create([
               'name' => 'tasks.show'
           ]);
           Permission::create([
               'name' => 'tasks.store'
           ]);
           Permission::create([
               'name' => 'tasks.update'
           ]);
           Permission::create([
               'name' => 'tasks.complete'
           ]);
           Permission::create([
               'name' => 'tasks.uncomplete'
           ]);

           Permission::create([
               'name' => 'tasks.destroy'
           ]);
       }catch (Exception $e){

       }

        try {
            //ASIGNAR PERMISOS A TasksManager
            $taskManager->givePermissionTo('tasks.index');
            $taskManager->givePermissionTo('tasks.show');
            $taskManager->givePermissionTo('tasks.store');
            $taskManager->givePermissionTo('tasks.update');
            $taskManager->givePermissionTo('tasks.complete');
            $taskManager->givePermissionTo('tasks.uncomplete');
            $taskManager->givePermissionTo('tasks.destroy');
        }catch (Exception $e){

        }


        try {
            //--CRUD Tasques de un usuario en concreto
            Permission::create([
                'name' => 'user.tasks.index'
            ]);
            Permission::create([
                'name' => 'user.tasks.show'
            ]);
            Permission::create([
                'name' => 'user.tasks.store'
            ]);
            Permission::create([
                'name' => 'user.tasks.update'
            ]);
            Permission::create([
                'name' => 'user.tasks.complete'
            ]);
            Permission::create([
                'name' => 'user.tasks.uncomplete'
            ]);
            Permission::create([
                'name' => 'user.tasks.destroy'
            ]);
        }catch (Exception $e){

        }
        //Asignar
        try {
            $tasks->givePermissionTo('user.tasks.index');
            $tasks->givePermissionTo('user.tasks.show');
            $tasks->givePermissionTo('user.tasks.store');
            $tasks->givePermissionTo('user.tasks.update');
            $tasks->givePermissionTo('user.tasks.complete');
            $tasks->givePermissionTo('user.tasks.uncomplete');
            $tasks->givePermissionTo('user.tasks.destroy');
        }catch (Exception $e){

        }


    }
}

if (!function_exists('sample_users')){
    function sample_users(){
        //Superadmin no hace falta -> soy yo

       try {
           //Pepe pringao -> No tiene ningun permiso
           $pepepringao = factory(User::class)->create([
               'name' => 'Pepe Pringao',
               'email' => 'pepepringao@hotmail.com'
           ]);
       } catch (Exception $e){

       }

       try {
           $bartsimpson = factory(User::class)->create([
               'name' => 'Bart Simpson',
               'email' => 'bart@hotmail.com'
           ]);
       }catch (Exception $e){

       }

       
        try {
            $bartsimpson->assignRole('Tasks');
        }catch (Exception $e){

        }

        try {
            $homersimpson = factory(User::class)->create([
                'name' => 'Bart Simpson',
                'email' => 'homer@hotmail.com'
            ]);
        }catch (Exception $e){

        }

        try {
            $homersimpson->assignRole('TasksManager');
        }catch (Exception $e){

        }

    }
}


if (!function_exists('profe')){
    function profe(){

        try {
            $profe = factory(User::class)->create([
                'name' => 'Sergi Tur',
                'email' => 'sergiturbadenas@gmail.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD', 'secret'))
            ]);
        }catch (Exception $e){

        }
        try {
            $profe->assignRole('TasksManager');
        }catch (Exception $e) {

        }
    }
}
//TODO:  Crear multiples usuarios con diferentes roles
// TODO: Como gestionar el superAdmin