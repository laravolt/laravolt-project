<?php

namespace Laravolt\Cms\Tests\Feature\Meta;

use Laravolt\Cms\Tests\TestCase;

class PostMetaTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_have_meta()
    {
        $post = app('laravolt.cms')->meta(['location' => 'Indonesia'])->create('Foo');

        $this->assertEquals('Indonesia', $post->meta->location);
    }

    /**
     * @test
     */
    public function it_can_update_meta()
    {
        $post = app('laravolt.cms')->meta(['location' => 'Indonesia'])->create('Foo');
        app('laravolt.cms')->meta(['location' => 'Palestine'])->update($post);

        $this->assertEquals('Palestine', $post->meta->location);
    }

    /**
     * @test
     */
    public function it_can_add_meta()
    {
        $post = app('laravolt.cms')->addMeta('location', 'Indonesia')->create('Foo');

        $this->assertEquals('Indonesia', $post->meta->location);
    }

    /**
     * @test
     */
    public function it_can_add_meta_multiple_times()
    {
        $post = app('laravolt.cms')
            ->addMeta('location', 'Indonesia')
            ->addMeta('location', 'Palestine')
            ->addMeta('topic', 'Politic')
            ->create('Foo');

        $this->assertEquals('Palestine', $post->meta->location);
        $this->assertEquals('Politic', $post->meta->topic);
    }

    /**
     * @test
     */
    public function it_can_add_and_remove_meta()
    {
        $post = app('laravolt.cms')
            ->addMeta('location', 'Indonesia')
            ->addMeta('topic', 'Politic')
            ->removeMeta('location')
            ->create('Foo');

        $this->assertEquals(null, $post->meta->location);
    }
}
