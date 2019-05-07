<?php

namespace Laravolt\Cms\Tests\Feature\Post;

use Laravolt\Cms\Models\Post;
use Laravolt\Cms\Tests\TestCase;

class DeletePostTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_delete_post()
    {
        $post = app('laravolt.cms')->create('Foo');
        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title' => 'Foo',
            ]
        );

        app('laravolt.cms')->delete($post);
        $this->assertDatabaseMissing(
            app(Post::class)->getTable(), [
            'title' => 'Foo',
            ]
        );
    }

}
