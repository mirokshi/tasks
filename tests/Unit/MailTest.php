<?php

namespace Test\Unit;


use App\Mail\TestDinamicEmail;
use App\Mail\TestMail;
use App\Mail\WelcomeEmail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase{
    use RefreshDatabase;

    /**
     * @test
     */
    public function send_email()
    {

        //1
        $user = factory(User::class)->create();
        //2
        Mail::to($user)->send(new TestMail());
        //3
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function send_markdown_dinamic_email()
    {

        //1
        $user = factory(User::class)->create();
        //2
        Mail::to($user)->send(new TestDinamicEmail($user));
        //3
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function send_welcome_email()
    {

        //1
        $user = factory(User::class)->create();
        //2
        Mail::to($user)->send(new WelcomeEmail($user));
        //3
        $this->assertTrue(true);

    }
}
