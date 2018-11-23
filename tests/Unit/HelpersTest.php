<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


class HelpersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_primary_user()
    {
        //1
        initialize_roles();
        //2
        create_primary_user();
        //3
        $user = User::where('email','mirokshirojas@iesebre.com')->first();
        $this->assertEquals($user->name,'Mirokshi Rojas');
        $this->assertEquals($user->email,'mirokshirojas@iesebre.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD','123456'),$user->password));
//        $this->assertEquals($user->password, env('PRIMARY_USER_PASSWORD','123456'));

    }
}