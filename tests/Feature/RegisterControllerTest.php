<?php

namespace Test\Feature;

use App\Mail\WelcomeEmail;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;


class RegisterControllerTest extends TestCase
{
    use refreshdatabase;

    /**
     * @test
     */
    public function can_resgister_a_user()
    {

         //1
        initialize_roles();
        $this->assertNull(Auth::user());

        Mail::fake();
        //2

        $response = $this->post( '/register', $user = [
            'name' => 'Jose',
            'email' => 'jose@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);

        Mail::assertSent(WelcomeEmail::class, function ($mail){
           return  Auth::user()->name == 'Jose';
        });

        //3
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());

        //comprovar que se ha creado
        $this->assertEquals($user['email'], Auth::user()->email);
        $this->assertEquals($user['name'], Auth::user()->name);

//        $this->assertEquals(bcrypt($user['password']),Auth::user()->password);
        $this->assertTrue(Hash::check($user['password'],Auth::user()->password));

        $this->assertTrue(Auth::user()->hasRole('Tasks'));

    }





}
