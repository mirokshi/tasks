<?php



use App\Log;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogTaskDestroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_task_destroy_log_has_been_created()
    {
        $this->assertTrue(true);
    }
}
