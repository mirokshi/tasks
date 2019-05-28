<?php

namespace Tests\Feature;

use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    use CanLogin;

    /**
     * @test
     */
    public function video()
    {

        $this->login('web');

        $response = $this->get('/video');

        $response->assertSuccessful();


    }

}
