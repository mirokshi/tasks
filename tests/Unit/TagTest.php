<?php

namespace Tests\Unit;
use App\File;
use App\Tag;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;



class TagTest extends TestCase
{
use RefreshDatabase;

    /**
     * @test
     */
    public function can_assign_user_to_tag ()
    {
        //1
        $tag = Tag::create([
            'name' => 'Compras',
            'description' => 'bla bla bla',
            'color' => '#E0F8E0'
        ]);

        $userOriginal = factory(User::class)->create();

        //2

        $tag->assignUser($userOriginal);

        $user = $tag-> user;
        //3

        $this->assertTrue($user->is($userOriginal));

    }


    /**
     * @test
     */
    public function can_asign_tag_to_Tag()
    {
        //1 Prepare
        $Tag = Tag::create([
            'name' => 'Comprar pan'
        ]);
        $tag = Tag::create ([
            'name' => 'home'
        ]);

        //2
        $Tag->addTag($tag);
        //3
        $tags = $Tag->tags;

        $this->assertTrue($tags[0]->is($tag));

    }

    /**
     * @test
     */
    public function a_Tag_can_have_tags()
    {
        //1 Prepare
        $Tag = Tag::create([
            'name' => 'Comprar pan'
        ]);
        $tag1 = Tag::create ([
           'name' => 'home'
        ]);
        $tag2 = Tag::create ([
            'name' => 'work'
        ]);
        $tag3 = Tag::create ([
            'name' => 'studies'
        ]);

        $tags = [$tag1,$tag2, $tag3];

        //2
        $Tag->addTags($tags);

        //3
        $tags = $Tag->tags;

        $this->assertTrue($tags[0]->is($tag1));
        $this->assertTrue($tags[1]->is($tag2));
        $this->assertTrue($tags[2]->is($tag3));


    }



    /**
     * @test
     */
    public function a_Tag_can_have_one_file()
    {
        //1 Prepare
        $Tag = Tag::create([
            'name' => 'Comprar pan'
        ]);

        $fileOriginal = File::create([
            'path' => 'archivo1.pdf'
        ]);
//        add_file_a_Tag($file,$Tag);
        $Tag->assignFile($fileOriginal);

        //2 Execute -> wishful programing

        //IMPORTANTE - 2 meneras
        //a Regresa toda la relacion
//        $file->$Tag->files()->where('path','');
        //b regresa el objeto
        $file = $Tag->file;

        //3 Assertion
        $this->assertTrue($file->is($fileOriginal));

    }

    /**
     * @test
     */
    public function a_Tag_file_returns_null_when_no_file_is_assigned()
    {
        // 1 Prepare
        $Tag = Tag::create([
            'name' => 'Comprar pan'
        ]);
        // 2 Execute -> Wishful programming
        $file = $Tag->file;

        // 3 Assert
        $this->assertNull($file);

    }
    /**
     * @test
     */
    public function can_toggle_completed()
    {
        $Tag = factory(Tag::class)->create([
            'completed' => false
        ]);
        $Tag->toggleCompleted();
        $this->assertTrue($Tag->completed);

        $Tag = factory(Tag::class)->create([
            'completed' => true
        ]);
        $Tag->toggleCompleted();
        $this->assertFalse($Tag->completed);
    }

    /**
     *@test
     */
    public function map()
    {
        $user = factory(User::class)->create();
        $Tag = factory(Tag::class)->create([
           'name' => 'Comprar pan',
            'completed' => false,
            'user_id' => $user->id
        ]);
        $mappedTag = $Tag->map();

        $this->assertEquals($mappedTag['id'],1);
        $this->assertEquals($mappedTag['name'],'Comprar pan');
        $this->assertEquals($mappedTag['completed'],false);
        $this->assertEquals($mappedTag['user_id'],$user->id);
        $this->assertEquals($mappedTag['user_name'],$user->name);
        $this->assertEquals($mappedTag['user_email'],$user->email);


    }


}