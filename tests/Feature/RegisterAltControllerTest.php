<?php

namespace Test\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


class RegisterAltControllerTest extends TestCase
{
    use refreshdatabase;

    /**
     * @test
     */
    public function can_resgister_a_user()
    {
        $this->withoutExceptionHandling();
        //1
        $this->assertNull(Auth::user());

        //2
        $response = $this->post( '/register_alt', $user = [
            'name' => 'Jose',
            'email' => 'jose@gmail.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);

        //3

        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());

        //comprovar que se ha creado
        $this->assertEquals($user['email'], Auth::user()->email);
        $this->assertEquals($user['name'], Auth::user()->name);
//        $this->assertEquals(bcrypt($user->password),Auth::user()->password);
        $this->assertTrue(Hash::check($user['password'],Auth::user()->password));


    }





}
