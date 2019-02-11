<?php

namespace Tests\Feature\Api;

use App\User;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class OnlineUserControllerTest extends TestCase
{
    /**
     * @test
     */
    public function todo()
    {
        $this->withoutExceptionHandling();
        //1
        $user1= factory(User::class)->create([
            'email'=>'useruno@prueba.com'
        ]);
        $user2= factory(User::class)->create([
            'email'=>'userdos@prueba.com'
        ]);
        $user3= factory(User::class)->create([
            'email'=>'usertres@prueba.com'
        ]);

        $response = $this->json('GET','/api/v1/user/online');
        $response->assertSuccessful();


    }
}
