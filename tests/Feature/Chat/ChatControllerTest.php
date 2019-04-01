<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

/**
 * Class ChatControllerTest.
 *
 * @package Tests\Feature
 */
class ChatControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;

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

    /** @test */
    public function chat_user_can_see_chats()
    {
        $this->loginAsSuperAdmin();
        initialize_sample_chat_channels();

        $response = $this->get('/chat');

        $response->assertSuccessful();
        $response->assertViewIs('chat.index');
        $response->assertViewHas('channels', function($channels) {
            return is_array($channels->toArray()) &&
                $channels[0]->name === 'Pepe Pardo Jeans';
        });
    }
}
