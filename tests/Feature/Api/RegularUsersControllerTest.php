<?php

namespace Tests\Feature\Api;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegularUsersControllerTest extends TestCase
{
use RefreshDatabase;

/**
 * @test
 */
    public function can_list_regular_users()
    {

        $user1 = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user2 = factory(User::class)->create([
            'name' => 'Pepa Pardo Jeans',
            'email' => 'pepapardo@jeans.com'
        ]);
        $user3 = factory(User::class)->create([
            'name' => 'Paco Pardo Jeans',
            'email' => 'pacopardo@jeans.com'
        ]);
        $user3->admin= true;
        $user3->save();
        $this->actingAs($user1,'api');
        $response = $this->json('GET', '/api/v1/users');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        //DEBERIA SER 2
        $this->assertCount(3,$result);
        $this->assertEquals($result[0]->name, 'Pepe Pardo Jeans');
        $this->assertEquals($result[0]->email, 'pepepardo@jeans.com');
        $this->assertEquals($result[0]->gravatar, 'https://www.gravatar.com/avatar/'.md5('pepepardo@jeans.com'));
        $this->assertEquals($result[1]->name, 'Pepa Pardo Jeans');
        $this->assertEquals($result[1]->email, 'pepapardo@jeans.com');
        $this->assertEquals($result[1]->gravatar, 'https://www.gravatar.com/avatar/'.md5('pepapardo@jeans.com'));
}

}
