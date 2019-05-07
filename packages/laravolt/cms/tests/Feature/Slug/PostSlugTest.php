<?php

namespace Laravolt\Cms\Tests\Feature\Slug;

use Laravolt\Cms\Models\Post;
use Laravolt\Cms\Tests\TestCase;

class PostSlugTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_generate_slug()
    {
        app('laravolt.cms')->create('Foo');
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['slug' => 'foo']);

        app('laravolt.cms')->create('Foo Bar');
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['slug' => 'foo-bar']);
    }

    /**
     * @test
     */
    public function it_can_generate_unique_slug()
    {
        app('laravolt.cms')->create('Foo');
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['slug' => 'foo']);

        app('laravolt.cms')->create('Foo');
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['slug' => 'foo-1']);

        app('laravolt.cms')->create('Foo Bar');
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['slug' => 'foo-bar']);

        app('laravolt.cms')->create('Foo Bar');
        $this->assertDatabaseHas(app(Post::class)->getTable(), ['slug' => 'foo-bar-1']);
    }
}
