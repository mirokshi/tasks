<?php

namespace Tests\Feature\Tenants\Api\Curriculum\Studies;

use App\ChatMessage;
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
        $this->login('api');
        $channel = create_sample_channel();
        $response = $this->json('GET', '/api/v1/channel/' . $channel->id . '/messages');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertTrue(is_array($result));
        $this->assertEquals('Hola que tal!',$result[0]->text);
    }

    /**
     * @test
     * @group chat
     */
    public function superadmin_can_list_chat_messages()
    {
        $this->loginAsSuperAdmin('api');
        $channel = create_sample_channel();
        $response = $this->json('GET', '/api/v1/channel/' . $channel->id . '/messages');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertTrue(is_array($result));
        $this->assertEquals('Hola que tal!',$result[0]->text);
    }

    /**
     * @test
     * @group curriculum
     */
    public function regular_user_cannot_list_chat_messages()
    {
        $this->login('api');
        $channel = create_sample_channel();
        $response = $this->json('GET', '/api/v1/channel/' . $channel->id . '/messages');
        $response->assertStatus(403);
    }

    /**
     * @test
     * @group curriculum
     */
    public function regular_user_can_list_chat_messages_on_chat_on_participates()
    {

        $user = $this->login('api');

        $channel = create_sample_channel($user);
        $response = $this->json('GET', '/api/v1/channel/' . $channel->id . '/messages');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertTrue(is_array($result));
        $this->assertEquals('Hola que tal!',$result[0]->text);
    }

    /**
     * @test
     * @group curriculum
     */
    public function guest_user_cannot_list_chat_messages()
    {
        $this->withoutExceptionHandling();
        $channel = create_sample_channel();
        $response = $this->json('GET','/api/v1/channel/' . $channel->id . '/messages');
        $response->assertStatus(401);
    }

    /**
     * @test
     * @group curriculum
     */
    public function can_add_message_to_channel()
    {
        $this->loginAsChatUser('api');

        $channel = create_sample_channel();
        $response = $this->json('POST', '/api/v1/channel/' . $channel->id . '/messages', [
            'text' => 'Hola que tal!'
        ]);
        $response->assertSuccessful();
        $message = json_decode($response->getContent());
        $this->assertEquals('Hola que tal!', $message->text);
        $this->assertNotNull($message->id);
        $this->assertEquals($channel->id, $message->channel_id);
        $this->assertEquals('Hola que tal!', $channel->lastMessage()->text);
    }

    /**
     * @test
     * @group curriculum
     */
    public function user_of_chat_can_add_message_to_channel()
    {
        $this->withoutExceptionHandling();
        $user = $this->login('api');

        $channel = create_sample_channel($user);
        $response = $this->json('POST', '/api/v1/channel/' . $channel->id . '/messages', [
            'text' => 'Hola que tal!'
        ]);
        $response->assertSuccessful();
        $message = json_decode($response->getContent());
        $this->assertEquals('Hola que tal!', $message->text);
        $this->assertNotNull($message->id);
        $this->assertEquals($channel->id, $message->channel_id);
        $this->assertEquals('Hola que tal!', $channel->lastMessage()->text);
    }

    /**
     * @test
     */
    public function regular_user_cannot_add_message_to_channel()
    {
        $channel = create_sample_channel();
        $response = $this->json('POST', '/api/v1/channel/' . $channel->id . '/messages', [
            'text' => 'Hola que tal!'
        ]);
        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function guest_user_cannot_add_message_to_channel()
    {
        $channel = create_sample_channel();
        $response = $this->json('POST', '/api/v1/channel/' . $channel->id . '/messages', [
            'text' => 'Hola que tal!'
        ]);
        $response->assertStatus(401);
    }

    /**
     * @test
     * @group curriculum
     */
    public function can_delete_message_from_channel()
    {
        $this->loginAsChatUser('api');

        $channel = create_sample_channel();
        $channel->addMessage(ChatMessage::create([
            'text' => 'Missatge anterior'
        ]));
        $message = ChatMessage::create([
            'text' => 'Nou missatge'
        ]);
        $channel->addMessage($message);
        $originalNumberOfMessages = count($channel->messages);
        $response = $this->json('DELETE', '/api/v1/channel/' . $channel->id . '/messages/' .$message->id);
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertEquals('Nou missatge', $result->text);
        $this->assertNotNull($result->id);
        $this->assertEquals($channel->id, $result->channel_id);
        $channel = $channel->fresh();
        $this->assertEquals($originalNumberOfMessages-1, count($channel->messages));
        $this->assertEquals(false, $channel->messages->search(function ($message) {
            $message->text === 'Hola que tal!';
        }));
//        dd($channel->messages->pluck('text'));
    }

    /**
     * @test
     * @group curriculum
     */
    public function user_of_chat_can_delete_message_from_channel()
    {
        $user = $this->loginAsChatUser('api');

        $channel = create_sample_channel($user);
        $channel->addMessage(ChatMessage::create([
            'text' => 'Missatge anterior'
        ]));
        $message = ChatMessage::create([
            'text' => 'Nou missatge'
        ]);
        $channel->addMessage($message);
        $originalNumberOfMessages = count($channel->messages);
        $response = $this->json('DELETE', '/api/v1/channel/' . $channel->id . '/messages/' .$message->id);
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertEquals('Nou missatge', $result->text);
        $this->assertNotNull($result->id);
        $this->assertEquals($channel->id, $result->channel_id);
        $channel = $channel->fresh();
        $this->assertEquals($originalNumberOfMessages-1, count($channel->messages));
        $this->assertEquals(false, $channel->messages->search(function ($message) {
            $message->text === 'Hola que tal!';
        }));
//        dd($channel->messages->pluck('text'));
    }

    /**
     * @test
     * @group curriculum
     */
    public function regular_user_can_delete_message_from_channel()
    {
        $this->login('api');

        $channel = create_sample_channel();
        $channel->addMessage(ChatMessage::create([
            'text' => 'Missatge anterior'
        ]));
        $message = ChatMessage::create([
            'text' => 'Nou missatge'
        ]);
        $channel->addMessage($message);
        $originalNumberOfMessages = count($channel->messages);
        $response = $this->json('DELETE', '/api/v1/channel/' . $channel->id . '/messages/' .$message->id);
        $response->assertStatus(403);
//        dd($channel->messages->pluck('text'));
    }

    /**
     * @test
     * @group curriculum
     */
    public function guest_user_can_delete_message_from_channel()
    {
        $channel = create_sample_channel();
        $channel->addMessage(ChatMessage::create([
            'text' => 'Missatge anterior'
        ]));
        $message = ChatMessage::create([
            'text' => 'Nou missatge'
        ]);
        $channel->addMessage($message);
        $originalNumberOfMessages = count($channel->messages);
        $response = $this->json('DELETE', '/api/v1/channel/' . $channel->id . '/messages/' .$message->id);
        $response->assertStatus(401);
//        dd($channel->messages->pluck('text'));
    }


}
