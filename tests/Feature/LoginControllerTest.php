<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_login_a_user()
    {

        //1
        $user = factory(User::class)->create([
            'email' => 'prueba@iesebre.com'
        ]);

        $this->assertNull(Auth::user());
        //2
        $response = $this->post('/login', [
            'email' => 'prueba@iesebre.com',
            'password' => 'secret'
        ]);
        //3
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());
        $this->assertEquals('prueba@iesebre.com', Auth::user()->email);


    }

    /**
     * @test
     */
    public function cannot_login_a_user_with_incorrect_password()
    {

        //1
        $user = factory(User::class)->create([
            'email' => 'prueba@iesebre.com'
        ]);

        $this->assertNull(Auth::user());
        //2
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
        //3

        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());
        $this->assertEquals('prueba@iesebre.com', Auth::user()->email);

    }
    /**
     * @test
     */
    public function cannot_login_a_user_with_a_incorrect_user()
    {

        //1
        $user = factory(User::class)->create([
            'email' => 'prueba@iesebre.com'
        ]);

        $this->assertNull(Auth::user());
        //2
        $response = $this->post('/login', [
            'email' => 'asdeded@iesebre.com',
            'password' => 'secret'
        ]);
        //3
//        dump(Session::get('errors'));
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());


    }

}