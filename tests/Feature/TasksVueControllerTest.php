<?php

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksVueControllerTest extends TestCase{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_show_vue_tasks()
    {
        $this->withoutExceptionHandling();
        // 1 PREPARE
        create_example_tasks();

        $this->login();

        // 2 EXECUTE
        $response = $this->get('/tasks_vue');

        // 3 ASSERT
        $response->assertSuccessful();

        $response->assertViewIs('tasks_vue');
        $response->assertViewHas('tasks',Task::all());


    }

    public function login(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user); //web
        //        $this->actingAs($user, 'api'); //api
    }
}