<?php

namespace Tests\Unit;
use App\File;
use App\Tag;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;



use Tests\TestCase;


class TaskTest extends TestCase
{
use RefreshDatabase;

    /**
     * @test
     */
    public function can_assign_user_to_task ()
    {
        //1
        $task = Task::create([
            'name' => 'Comprar pan'
        ]);

        $userOriginal = factory(User::class)->create();

        //2

        $task->assignUser($userOriginal);

        $user = $task-> user;
        //3

        $this->assertTrue($user->is($userOriginal));

    }


    /**
     * @test
     */
    public function can_asign_tag_to_rask()
    {
        //1 Prepare
        $task = Task::create([
            'name' => 'Comprar pan'
        ]);
        $tag = Tag::create ([
            'name' => 'home'
        ]);

        //2
        $task->addTag($tag);
        //3
        $tags = $task->tags;

        $this->assertTrue($tags[0]->is($tag));

    }

    /**
     * @test
     */
    public function a_task_can_have_tags()
    {
        //1 Prepare
        $task = Task::create([
            'name' => 'Comprar pan'
        ]);
        $tag1 = Tag::create ([
           'name' => 'home'
        ]);
        $tag2 = Tag::create ([
            'name' => 'work'
        ]);
        $tag3 = Tag::create ([
            'name' => 'studies'
        ]);

        $tags = [$tag1,$tag2, $tag3];

        //2
        $task->addTags($tags);

        //3
        $tags = $task->tags;

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
            'name' => 'Comprar pan'
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
        // 2 Execute -> Wishful programming
        $file = $task->file;

        // 3 Assert
        $this->assertNull($file);

    }


}