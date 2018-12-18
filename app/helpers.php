<?php

use App\Tag;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
            $user->admin = true;
            $user->save();
    }
    }
}
if (!function_exists('create_example_tasks')) {
    function create_example_tasks() {
        $user1= factory(User::class)->create();
        Task::create([
            'name' => 'comprar pa',
            'completed' => false,
            'description' => 'Bla bla bla',
            'user_id' => $user1->id
        ]);

        Task::create([
            'name' => 'comprar llet',
            'completed' => false,
            'description' => 'Bla bla bla',
            'user_id' => $user1->id
        ]);

        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true,
            'description' => 'JORL JORL JORL',
            'user_id' => $user1->id
        ]);

        $user1= factory(User::class)->create();
        Task::create([
            'name' => 'comprar pa',
            'completed' => false,
            'description' => 'Bla bla bla',
            'user_id' => $user1->id
        ]);

        Task::create([
            'name' => 'comprar llet',
            'completed' => false,
            'description' => 'Bla bla bla',
            'user_id' => $user1->id
        ]);

        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true,
            'description' => 'JORL JORL JORL',
            'user_id' => $user1->id
        ]);
    }
}
if (!function_exists('create_example_tags')) {
    function create_example_tags()
    {
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
if (!function_exists('pikachusorprendido')){
    function pikachusorprendido(){

        try {
            $profe = factory(User::class)->create([
                'name' => 'Sergi Tur',
                'email' => 'sergiturbadenas@gmail.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD', 'secret'))
            ]);
        }catch (Exception $e){

        }
        try {
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
if (! function_exists('git')) {
    function git() {
        return Cache::remember('git_info', 5, function () {
            Carbon::setLocale(config('app.locale'));
            return collect([
                'branch' => git_current_branch(),
                'commit' => git_current_commit(),
                'commit_short' => git_current_commit(true),
                'full_info' => git_current_commit_full_info(),
                'author_name' => git_current_commit_author_name(),
                'author_email' => git_current_commit_author_email(),
                'message' => git_current_commit_message(),
                'timestamp' => $timestamp = git_current_commit_timestamp(),
                'date' => $carbonDate = Carbon::createFromTimestamp($timestamp),
                'date_human_original' => git_current_commit_date_human(),
                'date_human' => $carbonDate->diffForHumans(Carbon::now()),
                'date_formatted' => $carbonDate->format('h:i:sA d-m-Y'),
                'origin' => git_remote_origin_url()
            ]);
        });
    }
}
if (! function_exists('git_current_branch')) {
    function git_current_branch() {
        exec('git name-rev --name-only HEAD', $output);
        return $output[0];
    }
}
if (! function_exists('git_current_commit')) {
    function git_current_commit($short = false) {
        $short ? exec('git rev-parse --short HEAD', $output) : exec('git rev-parse HEAD', $output) ;
        return $output[0];
    }
}
if (! function_exists('git_current_commit_full_info')) {
    function git_current_commit_full_info() {
        exec('git log -1', $output);
        return $output;
    }
}
if (! function_exists('git_current_commit_author_name')) {
    function git_current_commit_author_name() {
        exec("git log -1 --pretty=format:'%an'", $output);
        return $output[0];
    }
}
if (! function_exists('git_current_commit_author_email')) {
    function git_current_commit_author_email() {
        exec("git log -1 --pretty=format:'%ae'", $output);
        return $output[0];
    }
}
if (! function_exists('git_current_commit_message')) {
    function git_current_commit_message()
    {
        exec("git log -1 --pretty=format:'%s'", $output);
        return $output[0];
    }
}
if (! function_exists('git_current_commit_timestamp')) {
    function git_current_commit_timestamp()
    {
        exec("git log -1 --pretty=format:'%at'", $output);
        return $output[0];
    }
}
if (! function_exists('git_current_commit_date')) {
    function git_current_commit_date()
    {
        exec("git log -1 --pretty=format:'%ad'", $output);
        return $output[0];
    }
}
if (! function_exists('git_current_commit_date_human')) {
    function git_current_commit_date_human()
    {
        exec("git log -1 --pretty=format:'%ar'", $output);
        return $output[0];
    }
}
if (! function_exists('git_remote_origin_url')) {
    function git_remote_origin_url()
    {
        exec("git config --get remote.origin.url", $output);
        return $output[0];
    }
}

if (!function_exists('create_sample_tags')){
    function create_sample_tasks_with_tags(){

    }
}
