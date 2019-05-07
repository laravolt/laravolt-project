<?php

namespace Laravolt\Cms\Tests\Feature\Status;

use Laravolt\Cms\Models\Post;
use Laravolt\Cms\Tests\TestCase;

class PostStatusTest extends TestCase
{
    /**
     * @test
     */
    public function it_have_default_status()
    {
        $post = app('laravolt.cms')->create('Foo');
        $this->assertEquals('DRAFT', $post->status);
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['status' => 'DRAFT']);
    }

    /**
     * @test
     */e
    public function it_can_have_custom_status()
    {
        $post = app('laravolt.cms')->status('PENDING')->create('Foo');
        $this->assertEquals('PENDING', $post->status);
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['status' => 'PENDING']);

        $post = app('laravolt.cms')->create(['title' => 'Foo', 'status' => 'PENDING']);
        $this->assertEquals('PENDING', $post->status);
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['status' => 'PENDING']);
    }

    /**
     * @test
     */
    public function it_can_update_status()
    {
        $post = app('laravolt.cms')->create('Foo');
        app('laravolt.cms')->status('PENDING')->update($post);

        $this->assertEquals('PENDING', $post->status);
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['status' => 'PENDING']);
    }

    /**
     * @test
     */
    public function it_can_keep_old_status_when_updated()
    {
        $post = app('laravolt.cms')->status('APPROVED')->create('Foo');
        app('laravolt.cms')->title('Foo Bar')->update($post);

        $this->assertEquals('APPROVED', $post->status);
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['status' => 'APPROVED']);
    }
}
