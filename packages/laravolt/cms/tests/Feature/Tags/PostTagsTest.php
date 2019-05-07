<?php

namespace Laravolt\Cms\Tests\Feature\Tags;

use Laravolt\Cms\Tests\TestCase;

class PostTagsTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_set_tags_by_array()
    {
        $post = app('laravolt.cms')->create(['title' => 'Foo', 'tags' => ['one', 'two']]);
        $this->assertCount(2, $post->tags);
    }

    /**
     * @test
     */
    public function it_can_set_tags_fluently()
    {
        $post = app('laravolt.cms')->tags(['one', 'two'])->create('Foo');

        $this->assertCount(2, $post->tags);
    }

    /**
     * @test
     */
    public function it_can_update_tags()
    {
        $post = app('laravolt.cms')->tags(['one', 'two'])->create('Foo');
        $this->assertCount(2, $post->tags);

        $post = app('laravolt.cms')->tags(['three'])->update($post);
        $this->assertCount(1, $post->tags);

        $post = app('laravolt.cms')->update($post, ['tags' => ['four', 'five']]);
        $this->assertCount(2, $post->tags);

        $post = app('laravolt.cms')->update($post, ['tags' => null]);
        $this->assertCount(0, $post->tags);
    }

    /**
     * @test
     */
    public function it_can_present_tags_as_array()
    {
        $post = app('laravolt.cms')->tags(['one', 'two'])->create('Foo');
        $this->assertEquals(['one', 'two'], $post->tags_array);
    }
}
