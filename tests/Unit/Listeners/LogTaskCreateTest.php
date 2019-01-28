<?php



use App\Log;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogTaskCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_create_log_has_been_created()
    {

        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskUncompleted($task));

        $listener = new \App\Listeners\LogTaskDestroy();
        $listener->handle(new \App\Events\TaskDestroy($task));
        // 3 ASSERT
        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"Se ha creado  la tarea 'Comprar pa'");
        $this->assertEquals($log->action_type,'Eliminar');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals($log->old_value,'Comprar pa');
        $this->assertEquals($log->new_value,"");
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'delete_forever');
        $this->assertEquals($log->color,'#B40404');
    }
}
