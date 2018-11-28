<?php

namespace Tests\Feature;



use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasquesControllerTest extends TestCase
{

    use RefreshDatabase, CanLogin;

    //
    //1) Guest_user
    //2) regular user -> No tiene nigun rol (pepe pringao)
    //3) super admin
    //2) TaskManager
    //4) Rol Taks

    /**
     * @test
     */
    public function  guest_user_cannot_index_tasques()
    {
        $response = $this->get('tasques');
        $response->assertRedirect('login');
    }


    /**
     * @test
     */
    public function regular_user_cannot_index_tasques()
    {
         $this->login();
        $response = $this->get('/tasques');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function super_admin_can_index_tasques()
    {
        $this->withExceptionHandling();
        $this->loginAsSuperAdmin();
        create_example_tasks();
        $response= $this->get('tasques');
        $response->assertSuccessful();
        $response->assertViewIs('tasques');
        $response->assertViewHas('tasques', function ($tasques) {
            return $this->count($tasques) === 3 &&
                $tasques[0]['name'] === 'Compar pan' &&
                $tasques[1]['name'] === 'Compar leche' &&
                $tasques[2]['name'] === 'Estudiar PHP' ;
        });
    }

    /**
     * @test
     */
    public function tasks_manager_can_show_tasques()
    {

    }

    public function rol_task_user_can_index_tasques()
    {

    }
}
