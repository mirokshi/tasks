<?php

namespace Tests\Unit;
use InvalidArgumentException;
use Tests\TestCase;

/**
 * Class ImgOptimizeTest.
 *
 * @package Tests\Unit
 */
class ImgOptimizeTest extends TestCase
{
    /**
     * @test
     * @group slow
     */
    public function command_img_optimize_exists_and_arguments_are_optional()
    {
        $this->artisan('img:optimize')
            ->expectsQuestion('Please enter image path: ', base_path('tests/__Fixtures__/ImgOptimizeTests/test.jpg'))
            ->expectsOutput('Optimizing...')
            ->assertExitCode(0);
        $this->assertTrue(true);
    }

    /**
     * @test
     * @group slow
     */
    public function file_not_exists()
    {
        $path = base_path('tests/__Fixtures__/ImgOptimizeTests/NOTEXISTINGFILE.jpg');
        try {
            $this->artisan('img:optimize', [
                    'path' => $path]
            );
        } catch (\InvalidArgumentException $e ) {
            $this->assertEquals('`/home/mirokshi/code/mirokshi/tasks/tests/__Fixtures__/ImgOptimizeTests/NOTEXISTINGFILE.jpg` does not exist',$e->getMessage());
            dump($e->getMessage());
            return;
        }
        $this->fail('InvalidArgumentException. Error. Path argument does not exists');

    }

    /**
     * @test
     * @group slow
     */
    public function test_jpeg_image_is_optimized()
    {
        $path = base_path('tests/__Fixtures__/ImgOptimizeTests/test.jpg');

        // RESTORE IMAGE
        $original = base_path('tests/__Fixtures__/picture.jpeg');
        passthru("/bin/mv $original $path");

        try {
            $this->artisan('img:optimize', [
                    'path' => $path]
            );
        } catch (InvalidArgumentException $e ) {
            $this->fail('InvalidArgumentException. Error. Path argument does not exists');
        }
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $filename = pathinfo($path, PATHINFO_FILENAME);
        $dirname = pathinfo($path, PATHINFO_DIRNAME);
        $backupPath = $dirname . '/' . $filename . '.backup.' . $ext;

        $originalSize = filesize($backupPath);
        $finalSize =  filesize($path);


        $this->assertTrue($originalSize == $finalSize);


        // RESTORE IMAGE
        $original = base_path('tests/__Fixtures__/picture.jpeg');
        passthru("/bin/mv $original $path");
    }

}
