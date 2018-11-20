<?php
/**
 * Created by PhpStorm.
 * User: mirokshi
 * Date: 20/11/18
 * Time: 20:01
 */

namespace Tests\Feature\Api;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
use RefreshDatabase;

/**
 * @test
 */
    public function can_list_users()
    {

        $user1 = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user2 = factory(User::class)->create([
            'name' => 'Papa Cerdito',
            'email' => 'papa@cerdito.com'
        ]);
        $user3 = factory(User::class)->create([
            'name' => 'Mama Cerdito',
            'email' => 'mama@cerdito.com'
        ]);

        $users = [$user1, $user2, $user3];
    $this->actingAs($user1,'api');
        $response = $this->json('GET', '/api/v1/users');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());

        $this->assertEquals($result[0]->name, 'Pepe Pardo Jeans');
        $this->assertEquals($result[0]->email, 'pepepardo@jeans.com');
        $this->assertEquals($result[0]->avatar, 'https://www.gravatar.com/avatar/'.md5('pepepardo@jeans.com'));
}

}
