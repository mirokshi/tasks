<?php

namespace Tests\Unit;
use App\File;
use App\Tag;
use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;



class TagTest extends TestCase
{
use RefreshDatabase;
    /**
     *@test
     */
    public function map()
    {
        $task = Tag::create([
            'name' => 'Etiqueta',
            'description' => 'Descripció',
            'color' => '#000000'
        ]);
        $mappedTask = $task->map();

        $this->assertEquals($mappedTask['id'],1);
        $this->assertEquals($mappedTask['name'],'Etiqueta');
        $this->assertEquals($mappedTask['description'],'Descripció');
        $this->assertEquals($mappedTask['color'],'#000000');
    }

    /**
     * @test
     */
    public function can_add_a_task_a_tag_asign_id()
    {
//        $tag->addTask($task); //Donde $task sea id o model
//        $tag->addTasks($task); //Donde $task sea un vector de id's o de model

        //1 Prepare
        $task = Task::create([
            'name' => 'Comprar pan'
        ]);
        $tag = Tag::create ([
            'name' => 'home'
        ]);

        //2
        $tag->addTask($task->id);
        //3
        $tasks = $tag->tasks;

        $this->assertTrue($tasks[0]->is($task));
    }

    /**
     * @test
     */
    public function can_add_a_task_a_tag()
    {
//        $tag->addTask($task); //Donde $task sea id o model
//        $tag->addTasks($task); //Donde $task sea un vector de id's o de model

        //1 Prepare
        $task = Task::create([
            'name' => 'Comprar pan'
        ]);
        $tag = Tag::create ([
            'name' => 'home'
        ]);

        //2
        $tag->addTask($task);
        //3
        $tasks = $tag->tasks;

        $this->assertTrue($tasks[0]->is($task));
    }




}
