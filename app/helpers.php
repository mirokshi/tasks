<?php

use App\Tag;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

if (!function_exists('create_primary_user')){
    function create_primary_user() {
        $user = User::where('email','mirokshirojas@iesebre.com')->first();
        if (!$user) {

         $user =User::firstOrCreate ([
            'name' => 'Mirokshi Rojas',
            'email' => 'mirokshirojas@iesebre.com',
            'password' => bcrypt(env('PRIMARY_USER_PASSWORD', 'secret'))
        ]);
         $user->assignRole('TasksManager');
         $user->assignRole('Tasks');
         $user->assignRole('TagsManager');
         $user->assignRole('Tags');
         $user->admin=true;
         $user->save();
    }
    }
}

if (!function_exists('create_example_tasks')) {
    function create_example_tasks() {

        Task::create([
            'name' => 'Comprar pan',
            'completed' => false,
            'description' => 'Fui a comprar pan',
            'user_id' => '1'
        ]);

        Task::create([
            'name' => 'Comprar leche',
            'completed' => false,
            'description' => 'Compre leche en el mercadona',
            'user_id' => '2'
        ]);

        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true,
            'description' => 'Debo comprobar todos los tests',
            'user_id' => '3'
        ]);
    }
}

if (!function_exists('create_example_tags')) {
    function create_example_tags() {
        Tag::create([
            'name' => 'Tag1',
            'description' => 'Aqui van las compras',
            'color' => '#4b4a9b'
        ]);

        Tag::create([
            'name' => 'Tag2',
            'description' => 'Aqui van los estudios',
            'color' => '#04B404'
        ]);

        Tag::create([
            'name' => 'Tag3',
            'description' => 'Aqui van los trabajos',
            'color' => '#48a89b'
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

if (!function_exists('create_role')) {
    function create_role($role)
    {
        try {
            return Role::create([
                'name' => $role
            ]);
        } catch(Exception $e) {
            return Role::findByName($role);
        }
    }
}
if (!function_exists('create_permission')) {
    function create_permission($permission)
    {
        try {
            return Permission::create([
                'name' => $permission
            ]);
        } catch(Exception $e) {
            return Permission::findByName($permission);
        }
    }
}

if (!function_exists('initialize_roles')) {
    function initialize_roles() {
        $roles = [
            'TasksManager',
            'Tasks',
            'TagsManager',
            'Tags'
        ];
        foreach ($roles as $role) {
            create_role($role);
        }
        $taskManagerPermissions = [
            'tasks.index',
            'tasks.show',
            'tasks.store',
            'tasks.update',
            'tasks.complete',
            'tasks.uncomplete',
            'tasks.destroy'
        ];
        $tagsManagerPermissions = [
            'tags.index',
            'tags.show',
            'tags.store',
            'tags.update',
            'tags.destroy'
        ];
        $userTaskPermissions = [
            'user.tasks.index',
            'user.tasks.show',
            'user.tasks.store',
            'user.tasks.update',
            'user.tasks.complete',
            'user.tasks.uncomplete',
            'user.tasks.destroy'
        ];
        $userTagsPermissions = [
            'user.tags.index',
            'user.tags.show',
            'user.tags.store',
            'user.tags.update',
            'user.tags.destroy'
        ];
        $permissions = array_merge($taskManagerPermissions, $userTaskPermissions, $tagsManagerPermissions, $userTagsPermissions);
        foreach ($permissions as $permission) {
            create_permission($permission);
        }
        $rolePermissions = [
            'TasksManager' => $taskManagerPermissions,
            'Tasks' => $userTaskPermissions,
            'TagsManager' => $tagsManagerPermissions,
            'Tags' => $userTagsPermissions,
        ];
        foreach ($rolePermissions as $role => $rolePermission) {
            $role = Role::findByName($role);
            foreach ($rolePermission as $permission) {
                $role->givePermissionTo($permission);
            }
        }
    }
}

if (!function_exists('initialize_gates')){
    function initialize_gates(){
        Gate::define('tasks.manage',function ($user){
            return $user->isSuperAdmin() || $user->hasRole('TasksManager');
        });
        Gate::define('tags.manage',function ($user){
            return $user->isSuperAdmin() || $user->hasRole('TagsManager');
         })  ;
    }
}
if (!function_exists('sample_users_and_tasks')) {
    function sample_users_and_tasks() {
        // Superadmin no cal -> soc jo mateix

        // Pepe Pringao -> No té cap permis ni cap rol

        try {
            factory(User::class)->create([
                'name' => 'Pepe Pringao',
                'email' => 'pepepringao@hotmail.com'
            ]);
        } catch (Exception $e) {}

        try {
            $bartsimpson = factory(User::class)->create([
                'name' => 'Bart Simpson',
                'email' => 'bartsimpson@simpson.com'
            ]);
        } catch (Exception $e) {}

        Task::create([
            'name' => 'Patinar pels carrers',
            'completed' => false,
            'description' => 'Bla bla bla',
            'user_id' => $bartsimpson->id
        ]);

        Task::create([
            'name' => 'Escriure 100 vegades no...',
            'completed' => false,
            'description' => 'Bla bla bla',
            'user_id' => $bartsimpson->id
        ]);

        try {
            $bartsimpson->assignRole('Tasks');
        } catch (Exception $e) {}

        try {
            $homersimpson = factory(User::class)->create([
                'name' => 'Homer Simpson',
                'email' => 'homersimpson@simpson.com'
            ]);
        } catch (Exception $e) {}

        try {
            $homersimpson->assignRole('TasksManager');
            $homersimpson->assignRole('Tasks');
        } catch (Exception $e) {}

        Task::create([
            'name' => 'Anar a treballar a la central nuclear',
            'completed' => false,
            'description' => 'quin pal',
            'user_id' => $homersimpson->id
        ]);

        Task::create([
            'name' => 'Gestionar les tasques',
            'completed' => false,
            'description' => 'Hey you!',
            'user_id' => $homersimpson->id
        ]);
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
            $profe->assignRole('Tasks');
            $profe->assignRole('TagsManager');
            $profe->assignRole('Tags');
            $profe->admin=true;
            $profe->save();
        }catch (Exception $e) {

        }
    }
}
//TODO:  Crear multiples usuarios con diferentes roles
// TODO: Como gestionar el superAdmin

if (!function_exists('map_collection')){
  function  map_collection($collection){
      return $collection -> map(function ($item){
          return $item->map();
      });
  }
}

if (!function_exists('logged_user')){
    function logged_user(){
        return json_encode(optional(Auth::user())->map());
    }
}