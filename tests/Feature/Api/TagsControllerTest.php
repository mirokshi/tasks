<?php


namespace Tests\Feature\Api;


use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TagsControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;
    
    
    //FIELDS
    //name
    //description
    //color: #11111

    //SHOW
    /**
     * @test
     */
    public function can_show_a_tag ()
    {

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $tag = factory(Tag::class)->create();

        //2
        $response = $this->json('GET','/api/v1/tag/'.$tag->id);

        //3


        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($tag->name,$result->name);


    }

    /**
     * @test
     */
    public function can_delete_Tag()
    {
        $this->login('api');
        //1
        $tag = factory(Tag::class)->create();

        //2
        $response = $this->json('DELETE','/api/v1/tag/'.$tag->id);

        //3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('',$result);

    $this->assertDatabaseMissing('Tags', array($tag) );
        $this->assertNull(Tag::find($tag->id));

    }

    /**
     * @test
     */
    public function cannot_create_tags_whitout_name()
    {
        $this->login('api');

        $response = $this->json('POST','/api/v1/tag/',[
            'name' => ''
        ]);

        $result = json_decode($response->getContent());
        $response->assertStatus(422);
    }


    /**
     * @test
     */
    public function can_create_tag()
    {
        $this->withoutExceptionHandling();
        $this->login('api');
        $response = $this->json('POST','/api/v1/tag/',[
            'name' => 'Compras',
            'description' => 'Aqui van las compras',
            'color' => '#2EFEC8'
        ]);

        $result = json_decode($response->getContent());

        $response->assertSuccessful();

        $this->assertNotNull($tag = Tag::find($result->id));
        $this->assertEquals('Compras',$result->name);

    }

    /**
     * @test
     */
    public function can_list_Tag()
    {
        //1
        $this->login('api');
        create_example_tags();

        $response = $this->json('GET','/api/v1/tag');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3,$result);

        $this->assertEquals('Compras', $result[0]->name);


        $this->assertEquals('Estudios', $result[1]->name);


        $this->assertEquals('Trabajo', $result[2]->name);

    }


    /**
     * @test
     */
    public function can_edit_tag()
    {

        // 1
        $this->login('api');
        $oldTag = factory(Tag::class)->create([
            'name' => 'Estudios'
        ]);

        // 2

        $response = $this->json('PUT','/api/v1/tag/' . $oldTag->id, [
            'name' => 'Trabajo'
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();


        $newTag = $oldTag->refresh();
        $this->assertNotNull($newTag);
        $this->assertEquals('Trabajo',$result->name);
        $this->assertFalse((boolean) $newTag->completed);
    }

    /**
     * @test
     */
    public function cannot_edit_a_tag_whithout_name()
    {

        //1
        $this->login('api');
        $oldTag = factory(Tag::class)->create();
        //2
        $response = $this->json('PUT','/api/v1/tag/' . $oldTag->id, [
            'name' => ''
        ]);
        //3
        $response->assertStatus(422);

    }


}