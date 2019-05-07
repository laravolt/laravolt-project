<?php

namespace Laravolt\Cms\Tests\Feature\Post;

use Laravolt\Cms\Models\Post;
use Laravolt\Cms\Tests\TestCase;

class CreatePostTest extends TestCase
{
    /**
     * @test
     * @expectedException  \InvalidArgumentException
     */
    public function it_cannot_create_post_without_title()
    {
        app('laravolt.cms')->create();
    }

    /**
     * @test
     */
    public function it_can_create_post_with_just_title()
    {
        app('laravolt.cms')->create('Foo');

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title'       => 'Foo',
            'content'     => null,
            ]
        );
    }

    /**
     * @test
     */
    public function it_can_create_post_from_array()
    {
        $data = ['title' => 'Foo', 'content' => 'Bar'];
        app('laravolt.cms')->create($data);

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title'       => 'Foo',
            'content'     => 'Bar',
            ]
        );
    }

    /**
     * @test
     */
    public function it_can_create_post_fluently()
    {
        app('laravolt.cms')
            ->title('Foo')
            ->content('Bar')
            ->create();

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title'       => 'Foo',
            'content'     => 'Bar',
            ]
        );
    }

    /**
     * @test
     */
    public function it_can_create_post_fluently_combined_with_array()
    {
        app('laravolt.cms')
            ->title('Foo')
            ->content('Bar')
            ->create(['title' => 'Baz', 'content' => 'Dat']);

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title' => 'Baz',
            'content' => 'Dat',
            ]
        );
    }
}
