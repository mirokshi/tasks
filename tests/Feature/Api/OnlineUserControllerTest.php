<?php

namespace Tests\Feature\Api;

use App\User;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;
use Cache;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class OnlineUserControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;
    /**
     * @test
     */
    public function user_can_see_online_users()
    {
        $this->withoutExceptionHandling();
        $user = $this->login('api');
        //1
        $user1= factory(User::class)->create();
        $user2= factory(User::class)->create();

        $expiresAt = Carbon::now()->addMinutes(5);
        Cache::put(User::USERS_CACHE_KEY.'-user-is-online'.$user1,Carbon::now(),$expiresAt);
        Cache::put(User::USERS_CACHE_KEY.'-user-is-online'.$user2,Carbon::now(),$expiresAt);

        $response = $this->json('GET','/api/v1/users/online');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(3,$result);

    }
}
