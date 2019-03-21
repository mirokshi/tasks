<?php

namespace Tests\Feature\Api\Chat;

use App\Events\Studies\StudyCodeUpdated;
use Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Console\Kernel;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

/**
 * Class ChatMessagesControllerTest.
 *
 * @package Tests\Feature\Tenants\Api
 */
class ChatMessagesControllerTest extends TestCase {

    use RefreshDatabase, CanLogin;

    /**
     * Refresh the in-memory database.
     *
     * @return void
     */
    protected function refreshInMemoryDatabase()
    {
        $this->artisan('migrate',[
            '--path' => 'database/migrations/tenant'
        ]);

        $this->app[Kernel::class]->setArtisan(null);
    }

    /**
     * @test
     * @group curriculum
     */
    public function can_list_chat_messages()
    {
        $this->loginAsChatUser('api');

        $channel = create_sample_channel();

        $response = $this->json('GET','/api/v1/channel/' . $channel->id . '/messages');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        dump($result);
    }

}
