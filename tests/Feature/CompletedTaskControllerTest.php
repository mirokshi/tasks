<?php
/**
 * Created by PhpStorm.
 * User: mirokshi
 * Date: 2/10/18
 * Time: 20:40
 */

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CompletedTaskControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_completed_a_task()
    {
        //1
        $task=Task::create([

        ]);



    }

    /**
     * @test
     */
    public function cannot_completed_a_unexisting_task()
    {

    }

    /**
     * @test
     */
    public function can_uncompleted_a_task()
    {

    }

    /**
     * @test
     */
    public function cannot_uncompleted_a_unexisting_tasks()
    {

    }


}