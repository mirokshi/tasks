<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksVueController extends TestCase{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_show_vue_tasks()
    {
        $this->withoutExceptionHandling();
        //1 prepare


        //2 execute
        $response = $this->get('/tasks_vue');

        //3 assert
        $response->assertSuccessful();

        $response->assertViewIs('tasks_vue');
    }
}