<?php

namespace Test\Unit;


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
        Mail::to($user)->send(new MailTest());
    }
}