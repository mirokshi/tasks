<?php
/**
 * Created by PhpStorm.
 * User: mirokshi
 * Date: 12/03/19
 * Time: 18:55
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class ClockControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    public function show_user__photo()
    {
        $this->login('web');

        $response = $this->get('/clock');

        $response->assertSuccessful();


    }

}
