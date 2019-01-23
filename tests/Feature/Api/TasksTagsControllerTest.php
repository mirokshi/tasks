<?php

namespace Tests\Feature\Api;

use App\Tag;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasksTagsControllerTest extends TestCase{

    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function can_add_tag_to_tasks()
    {
        $this->withoutExceptionHandling();
        $this->loginAsTaskManager('api');

        //1 Prepare
        $task = Task::create([
            'name' => 'Comprar pan'
        ]);
        $tag = Tag::create ([
            'name' => 'home'
        ]);

        //2
        $response = $this->json('PUT','/api/v1/tasks/'.$task->id.'/tags/',[
            'tags'=>[$tag->id]
        ]);

        //3
        $response->assertSuccessful();

        $task = $task->fresh();

        $this->assertCount(1,$task->tags);
        $this->assertEquals('home',$task->tags[0]->name);
        $this->assertTrue($task->tags[0]->is($tag));
    }

    /**
     * @test
     */
    public function guest_user_cannoot_add_tag_to_tasks()
    {
        //1 Prepare
        $task = Task::create([
            'name' => 'Comprar pan'
        ]);
        $tag = Tag::create ([
            'name' => 'home'
        ]);

        //2
        $response = $this->json('PUT','/api/v1/tasks'.$task->id.'/tags/',[
            'tags'=>[$tag->id]
        ]);

        //3
        $response->assertSuccessful();

        $task = $task->fresh();

        $this->assertCount(1,$task->tags);
        $this->assertEquals('home',$task->tags[0]->name);
        $this->assertTrue($task->tags[0]->is($tag));


    }

}
