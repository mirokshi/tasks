<?php

namespace Tests\Feature\Api\Notifications;

use App\Notifications\HelloNotification;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Notification;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

/**
 * Class HelloNotificationControllerTest.
 *
 * @package Tests\Feature
 */
class HelloNotificationControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * Refresh the in-memory database.
     *
     * @return void
     */
    protected function refreshInMemoryDatabase()
    {
        $this->artisan('migrate',[
            '--path' => 'database/migrations'
        ]);

        $this->app[Kernel::class]->setArtisan(null);
    }

    /**
     * @test
     * @group notifications
     */
    public function user_can_send_hello_notification_to_himself()
    {
        $user = $this->loginAsSuperAdmin('api');
        Notification::fake();
        $response = $this->json('POST','/api/v1/notifications/hello');
        $response->assertSuccessful();
        Notification::assertSentTo($user,HelloNotification::class);
    }

    /**
     * @test
     * @group notifications
     */
    public function guest_user_can_send_hello_notification_to_himself()
    {
        Notification::fake();
        $response = $this->json('POST','/api/v1/notifications/hello');
        $response->assertStatus(401);
        Notification::assertNothingSent();
    }

}
