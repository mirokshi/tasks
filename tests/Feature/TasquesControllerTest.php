<?php

namespace Tests\Feature;



use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasquesControllerTest extends TestCase
{

    use RefreshDatabase, CanLogin;

    //
    //1) super admin
    //2) TaskManager
    //3) regular user -> No tiene nigun rol (pepe pringao)
    //4) Rol Taks
    //5) Guest_user

    /**
     * @test
     */
    public function super_admin_can_show_tasques()
    {

    }
    /**
     * @test
     */
    public function taskManager_can_show_tasques()
    {

    }

    /**
     * @test
     */
    public function regular_user_can_show_tasques()
    {

    }

    public function rol_task_user_can_show_tasques()
    {

    }

    /**
     * @test
     */
    public function  guest_user_can_show_tasques()
    {
        
    }
}
