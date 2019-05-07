<?php

namespace Laravolt\Cms\Tests\Feature\Type;

use Laravolt\Cms\Models\Post;
use Laravolt\Cms\Tests\TestCase;

class SortableTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_default_position()
    {
        $post = app('laravolt.cms')->create('Foo');
        $this->assertEquals(1, $post->position);
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
    public function it_can_set_specific_position()
    {
        // post 1 has position 1
        $post1 = app('laravolt.cms')->create('Foo');

        // post 2 has position 2
        $post2 = app('laravolt.cms')->create('Foo');

        // post 3 has position 2, so post 2 moved to position 3
        $post3 = app('laravolt.cms')->position(2)->create('Foo');
        $post2->refresh();

        $this->assertEquals(3, $post2->position);
        $this->assertEquals(2, $post3->position);
    }

    /**
     * @test
     */
    public function it_can_handle_out_of_range_position()
    {
        // post 1 has position 1
        $post1 = app('laravolt.cms')->create('Foo');

        // post 2 has position 2
        $post2 = app('laravolt.cms')->position(2)->create('Bar');

        $this->assertEquals(1, $post1->position);
        $this->assertEquals(2, $post2->position);
    }

    /**
     * @test
     */
    public function it_can_set_position_to_null_when_creating()
    {
        // post 1 has position 1
        $post1 = app('laravolt.cms')->create('Foo');

        // post 2 has position 2
        $post2 = app('laravolt.cms')->position(null)->create('Bar');

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
    public function model_can_handle_invalid_move()
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

    /**
     * @test
     */
    public function it_can_update_position_up()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');
        $post4 = app('laravolt.cms')->create('Foo');

        app('laravolt.cms')->update($post3, ['position' => 4]);

        $post1->refresh();
        $post2->refresh();
        $post3->refresh();
        $post4->refresh();

        $this->assertEquals(1, $post1->position);
        $this->assertEquals(2, $post2->position);
        $this->assertEquals(4, $post3->position);
        $this->assertEquals(3, $post4->position);
    }

    /**
     * @test
     */
    public function it_can_update_position_down()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Foo');
        $post3 = app('laravolt.cms')->create('Foo');
        $post4 = app('laravolt.cms')->create('Foo');

        app('laravolt.cms')->update($post3, ['position' => 1]);

        $post1->refresh();
        $post2->refresh();
        $post3->refresh();
        $post4->refresh();

        $this->assertEquals(2, $post1->position);
        $this->assertEquals(3, $post2->position);
        $this->assertEquals(1, $post3->position);
        $this->assertEquals(4, $post4->position);
    }

    /**
     * @test
     */
    public function it_can_set_position_to_null_when_updating()
    {
        $post1 = app('laravolt.cms')->create('Foo');
        $post2 = app('laravolt.cms')->create('Bar');
        $post3 = app('laravolt.cms')->create('Baz');

        app('laravolt.cms')->update($post2, ['position' => null]);

        $post1->refresh();
        $post2->refresh();
        $post3->refresh();

        $this->assertEquals(1, $post1->position);
        $this->assertEquals(3, $post2->position);
        $this->assertEquals(2, $post3->position);
    }
}
