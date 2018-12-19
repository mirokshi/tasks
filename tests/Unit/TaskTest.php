<?php

namespace Tests\Unit;
use App\File;
use App\Tag;
use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;



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
    public function can_asign_tag_to_task()
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
    /**
     * @test
     */
    public function can_toggle_completed()
    {
        $task = factory(Task::class)->create([
            'completed' => false
        ]);
        $task->toggleCompleted();
        $this->assertTrue($task->completed);

        $task = factory(Task::class)->create([
            'completed' => true
        ]);
        $task->toggleCompleted();
        $this->assertFalse($task->completed);
    }

    /**
     *@test
     */
    public function map()
    {
        $user = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);

        $task = create_sample_tasks($user);

        $task->assignUser($user);
        $mappedTask = $task->map();

        $this->assertEquals($mappedTask['id'],1);
        $this->assertEquals($mappedTask['name'],'Comprar pa');
        $this->assertEquals($mappedTask['description'],'Bla bla bla');
        $this->assertEquals($mappedTask['completed'],false);
        $this->assertEquals($mappedTask['user_id'],$user->id);
        $this->assertEquals($mappedTask['user_name'],$user->name);
        $this->assertEquals($mappedTask['user_email'],$user->email);
        $this->assertNotNull($mappedTask['created_at']);
        $this->assertNotNull($mappedTask['created_at_formatted']);
        $this->assertNotNull($mappedTask['created_at_human']);
        $this->assertNotNull($mappedTask['created_at_timestamp']);
        $this->assertNotNull($mappedTask['updated_at']);
        $this->assertNotNull($mappedTask['updated_at_formatted']);
        $this->assertNotNull($mappedTask['updated_at_human']);
        $this->assertNotNull($mappedTask['updated_at_timestamp']);
        $this->assertEquals($mappedTask['user_gravatar'],'https://www.gravatar.com/avatar/'.md5('pepepardo@jeans.com'));
        $this->assertEquals($mappedTask['full_search'],'1 Comprar pa Bla bla bla Pendiente Pepe Pardo Jeans pepepardo@jeans.com');


        $this->assertEquals($mappedTask['tags'][0]->name,'Tag1');
        $this->assertEquals($mappedTask['tags'][0]->color,'blue');
        $this->assertEquals($mappedTask['tags'][0]->description,'bla bla bla');
        $this->assertEquals($mappedTask['tags'][1]->name,'Tag2');
        $this->assertEquals($mappedTask['tags'][1]->color,'red');
        $this->assertEquals($mappedTask['tags'][1]->description,'Jorl Jorl');


        //TODO fullsearch
        $this->assertTrue($user->is($mappedTask['user']));






    }


}
