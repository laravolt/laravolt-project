<?php

namespace Laravolt\Cms\Tests\Feature\Category;

use Laravolt\Cms\Tests\TestCase;

class PostCategoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_set_category_by_array()
    {
        $post = app('laravolt.cms')->create(['title' => 'Foo', 'category' => 'Uncategorized']);

        $this->assertEquals('Uncategorized', $post->category);
    }

    /**
     * @test
     */
    public function it_can_set_category_fluently()
    {
        $post = app('laravolt.cms')->category('Uncategorized')->create('Foo');

        $this->assertEquals('Uncategorized', $post->category);
    }

    /**
     * @test
     */
    public function it_can_update_category()
    {
        $post = app('laravolt.cms')->category('Uncategorized')->create('Foo');
        $this->assertEquals('Uncategorized', $post->category);

        $post = app('laravolt.cms')->category('New Category')->update($post);
        $this->assertEquals('New Category', $post->category);

        $post = app('laravolt.cms')->update($post, ['category' => 'New Category 2']);
        $this->assertEquals('New Category 2', $post->category);

        $post = app('laravolt.cms')->update($post, ['category' => null]);
        $this->assertEquals(null, $post->category);
    }
}
