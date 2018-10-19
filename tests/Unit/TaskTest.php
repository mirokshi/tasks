<?php

namespace Tests\Unit;
use App\File;
use App\Tag;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;



use Tests\TestCase;


class TaskTest extends TestCase
{
use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_can_have_tags()
    {
        //1 Prepare
        $task = Task::create([
            'name' => 'Comprar pan',
            'completed' => false
        ]);
        $tag1 = Tag::create ([
           'name' => 'home'
        ]);
        $tag2 = Tag::create ([
            'name' => 'home'
        ]);
        $tag3 = Tag::create ([
            'name' => 'home'
        ]);

        $tags = [$tag1,$tag2, $tag3];

        //2
        $task->assignTags($tags);

        //3
        $tags = $task->tags();

        $this->assertTrue($tags[0]->is($tag1));
        $this->assertTrue($tags[1]->is($tag2));
        $this->assertTrue($tags[2]->is($tag3));


    }



    /**
     * @test
     */
    public function a_task_can_have_one_file()
    {
        //1 Prepare
        $task = Task::create([
            'name' => 'Comprar pan',
            'completed' => false
        ]);

        $fileOriginal = File::create([

            'path' => 'archivo1.pdf'
        ]);
//        add_file_a_task($file,$task);
        $task->assignFile($fileOriginal);

        //2 Execute -> wishful programing

        //IMPORTANTE - 2 meneras
        //a Regresa toda la relacion
//        $file->$task->files()->where('path','');
        //b regresa el objeto
        $file = $task->file;

        //3 Assertion
        $this->assertTrue($file->is($fileOriginal));

    }

    /**
     * @test
     */
    public function a_task_file_returns_null_when_no_file_is_assigned()
    {
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pan'
        ]);
        // 2 Executo -> Wishful programming
        $file = $task->file();

        // 3 Comprovo
                $this->assertNull($file);

    }
}