<?php

namespace Laravolt\Cms\Tests\Feature\Post;

use Laravolt\Cms\Models\Post;
use Laravolt\Cms\Tests\TestCase;

class Update extends TestCase
{
    /**
     * @test
     */
    public function it_can_update_post()
    {
        $post = app('laravolt.cms')->create('Foo');

        app('laravolt.cms')->title('New Title')->update($post);

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title'       => 'New Title',
            ]
        );
    }

    /**
     * @test
     */
    public function it_can_update_post_from_array()
    {
        $data = ['title' => 'Foo', 'content' => 'Bar'];
        $post = app('laravolt.cms')->create($data);

        app('laravolt.cms')->update($post, ['title' => 'New Title', 'content' => 'New Content']);

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title'       => 'New Title',
            'content'     => 'New Content',
            ]
        );
    }

    /**
     * @test
     */
    public function it_can_update_post_fluently()
    {
        $post = app('laravolt.cms')
            ->title('Foo')
            ->content('Bar')
            ->create();

        app('laravolt.cms')
            ->title('New Title')
            ->content('New Content')
            ->update($post);

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title'       => 'New Title',
            'content'     => 'New Content',
            ]
        );
    }

    /**
     * @test
     */
    public function it_can_update_post_fluently_combined_with_array()
    {
        app('laravolt.cms')
            ->title('Foo')
            ->content('Bar')
            ->create(['title' => 'New Title', 'content' => 'New Content']);

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title'   => 'New Title',
            'content' => 'New Content',
            ]
        );
    }
}
