<?php

namespace Laravolt\Cms\Tests\Feature\Type;

use Laravolt\Cms\Models\Post;
use Laravolt\Cms\Tests\TestCase;

class PostTypeTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_default_type()
    {
        $post = app('laravolt.cms')->create('Foo');
        $this->assertEquals('POST', $post->type);
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['type' => 'POST']);
    }

    /**
     * @test
     */
    public function it_has_custom_type()
    {
        $post = app('laravolt.cms')->type('NEWS')->create('Foo');
        $this->assertEquals('NEWS', $post->type);
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['type' => 'NEWS']);

        $post = app('laravolt.cms')->create(['title' => 'Foo', 'type' => 'BLOG']);
        $this->assertEquals('BLOG', $post->type);
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['type' => 'BLOG']);
    }

    /**
     * @test
     */
    public function it_can_update_type()
    {
        $post = app('laravolt.cms')->type('POST')->create('Foo');
        app('laravolt.cms')->type('NEWS')->update($post);

        $this->assertEquals('NEWS', $post->type);
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['type' => 'NEWS']);
    }

    /**
     * @test
     */
    public function it_can_keep_old_type_when_updated()
    {
        $post = app('laravolt.cms')->type('NEWS')->create('Foo');
        app('laravolt.cms')->title('Foo Bar')->update($post);

        $this->assertEquals('NEWS', $post->type);
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['type' => 'NEWS']);
    }
}
