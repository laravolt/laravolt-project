<?php

namespace Laravolt\Cms\Tests\Feature\PostTranslatable;

use Laravolt\Cms\Models\MultilanguagePost;
use Laravolt\Cms\Models\Post;
use Laravolt\Cms\Tests\TestCase;

class CreatePostTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.locale', 'en');
        $app['config']->set('laravolt.cms.binding.post', MultilanguagePost::class);
        parent::getEnvironmentSetUp($app);
    }

    /**
     * @test
     */
    public function it_can_create_post_with_just_title()
    {
        app('laravolt.cms')->create('Foo');

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title'       => json_encode(['en' => 'Foo']),
            ]
        );
    }

    /**
     * @test
     */
    public function it_can_create_post_with_translatable_title()
    {
        app('laravolt.cms')->create(['title' => ['en' => 'Hello', 'id' => 'Halo']]);

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title' => json_encode(['en' => 'Hello', 'id' => 'Halo']),
            ]
        );
    }

    /**
     * @test
     */
    public function it_can_create_post_with_translatable_title_and_content()
    {
        app('laravolt.cms')->create(
            [
                'title'   => ['en' => 'Hello', 'id' => 'Halo'],
                'content' => ['en' => 'World', 'id' => 'Dunia'],
            ]
        );

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title'   => json_encode(['en' => 'Hello', 'id' => 'Halo']),
            'content' => json_encode(['en' => 'World', 'id' => 'Dunia']),
            ]
        );
    }

    /**
     * @test
     */
    public function it_can_create_post_with_translatable_title_and_content_fluently()
    {
        app('laravolt.cms')
            ->title(['en' => 'Hello', 'id' => 'Halo'])
            ->content(['en' => 'World', 'id' => 'Dunia'])
            ->create();

        $this->assertDatabaseHas(
            app(Post::class)->getTable(), [
            'title'   => json_encode(['en' => 'Hello', 'id' => 'Halo']),
            'content' => json_encode(['en' => 'World', 'id' => 'Dunia']),
            ]
        );
    }

}
