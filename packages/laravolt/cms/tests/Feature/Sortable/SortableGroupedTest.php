<?php

namespace Laravolt\Cms\Tests\Feature\Type;

use Laravolt\Cms\Models\Post;
use Laravolt\Cms\Tests\Dummy\GroupedPost;
use Laravolt\Cms\Tests\TestCase;

class SortableGroupedTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        $app['config']->set('laravolt.cms.binding.post', GroupedPost::class);
    }

    /**
     * @test
     */
    public function it_has_default_position_for_each_group()
    {
        $news = app('laravolt.cms')->type('NEWS')->create('Foo');
        $event = app('laravolt.cms')->type('EVENT')->create('Foo');

        $this->assertEquals(1, $news->position);
        $this->assertEquals(1, $event->position);
    }

    /**
     * @test
     */
    public function it_can_auto_generate_position()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $this->assertEquals(1, $post1->position);
        $this->assertEquals(2, $post2->position);
    }

    /**
     * @test
     */
    public function it_can_sort_models()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        app('laravolt.cms')->sort([$post1, $post3, $post2]);

        $post1->refresh();
        $post2->refresh();
        $post3->refresh();

        $this->assertEquals(1, $post1->position);
        $this->assertEquals(3, $post2->position);
        $this->assertEquals(2, $post3->position);
    }

    /**
     * @test
     */
    public function it_can_sort_ids()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        app('laravolt.cms')->sort([$post3->getKey(), $post2->getKey(), $post1->getKey()]);

        $post1->refresh();
        $post2->refresh();
        $post3->refresh();

        $this->assertEquals(3, $post1->position);
        $this->assertEquals(2, $post2->position);
        $this->assertEquals(1, $post3->position);
    }

    /**
     * @test
     */
    public function it_can_sort_mixed_ids_and_models()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        app('laravolt.cms')->sort([$post3, $post1->getKey(), $post2]);

        $post1->refresh();
        $post2->refresh();
        $post3->refresh();

        $this->assertEquals(2, $post1->position);
        $this->assertEquals(3, $post2->position);
        $this->assertEquals(1, $post3->position);
    }

    /**
     * @test
     */
    public function it_can_sort_models_start_from_custom_position()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        app('laravolt.cms')->sort([$post3, $post2, $post1], 7);

        $post1->refresh();
        $post2->refresh();
        $post3->refresh();

        $this->assertEquals(7, $post3->position);
        $this->assertEquals(8, $post2->position);
        $this->assertEquals(9, $post1->position);
    }

    /**
     * @test
     */
    public function model_can_move_to_first()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        $post3->moveToFirst();

        $post1->refresh();
        $post2->refresh();

        $this->assertEquals(1, $post3->position);
        $this->assertEquals(2, $post1->position);
        $this->assertEquals(3, $post2->position);
    }

    /**
     * @test
     */
    public function model_can_move_to_last()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        $post1->moveToLast();

        $post2->refresh();
        $post3->refresh();

        $this->assertEquals(1, $post2->position);
        $this->assertEquals(2, $post3->position);
        $this->assertEquals(3, $post1->position);
    }

    /**
     * @test
     */
    public function model_can_move_to_position()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        $post1->moveToPosition(2);

        $post2->refresh();
        $post3->refresh();

        $this->assertEquals(1, $post2->position);
        $this->assertEquals(2, $post1->position);
        $this->assertEquals(3, $post3->position);
    }

    /**
     * @test
     */
    public function model_cannot_move_to_invalid_position()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        $post1->moveToPosition(-2);
        $this->assertEquals(1, $post1->position);

        $post1->moveToPosition(0);
        $this->assertEquals(1, $post1->position);

        // If model trying to move to position higher then max position,
        // it will automatically moved to that max position
        $post1->moveToPosition(4);
        $this->assertEquals(3, $post1->position);
    }

    /**
     * @test
     */
    public function it_can_move_up_before_another_model()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        $post1->moveBefore($post3);
        $post2->refresh();
        $post3->refresh();

        $this->assertEquals(2, $post1->position);
        $this->assertEquals(1, $post2->position);
        $this->assertEquals(3, $post3->position);
    }

    /**
     * @test
     */
    public function it_can_move_down_before_another_model()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        $post3->moveBefore($post2);
        $post1->refresh();
        $post2->refresh();

        $this->assertEquals(1, $post1->position);
        $this->assertEquals(3, $post2->position);
        $this->assertEquals(2, $post3->position);
    }

    /**
     * @test
     */
    public function it_can_move_up_after_another_model()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        $post1->moveAfter($post2);
        $post2->refresh();
        $post3->refresh();

        $this->assertEquals(2, $post1->position);
        $this->assertEquals(1, $post2->position);
        $this->assertEquals(3, $post3->position);
    }

    /**
     * @test
     */
    public function it_can_move_down_after_another_model()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        $post3->moveAfter($post1);
        $post1->refresh();
        $post2->refresh();

        $this->assertEquals(1, $post1->position);
        $this->assertEquals(3, $post2->position);
        $this->assertEquals(2, $post3->position);
    }

    /**
     * @test
     */
    public function it_can_get_models_sorted_by_position()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');

        app('laravolt.cms')->sort([$post3, $post2, $post1]);

        $ids = Post::sorted()->pluck((new Post)->getKeyName())->toArray();

        $this->assertEquals([3,2,1], $ids);
    }
}
