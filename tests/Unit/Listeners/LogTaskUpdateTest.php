<?php
namespace Tests\Feature\Api;

use App\Log;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogTaskUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_update_log_has_been_created()
    {

        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskUncompleted($task));

        $listener = new \App\Listeners\LogTaskUpdate();
        $listener->handle(new \App\Events\TaskUpdate($task));
        // 3 ASSERT
        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"Se ha modificado una tarea 'Comprar pa'");
        $this->assertEquals($log->action_type,'Modificar');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals($log->old_value,'Antiguo');
        $this->assertEquals($log->new_value,$task->name);
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'edit');
        $this->assertEquals($log->color,'#6699ff');
    }
}
