<?php

namespace Laravolt\Cms\Tests\Feature\Meta;

use Laravolt\Cms\Tests\TestCase;

class MenuTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_create_multi_level_menu()
    {
        $sport = app('laravolt.cms')->create('Sport');
        $race = app('laravolt.cms')->parent($sport)->create('Race');
        $fighting = app('laravolt.cms')->parent($sport)->create('Fighting');
        $formula1 = app('laravolt.cms')->parent($race)->create('Formula 1');
        $motogp = app('laravolt.cms')->create(['title' => 'Moto GP', 'parent' => $formula1]);
        $boxing = app('laravolt.cms')->create(['title' => 'Boxing', 'parent' => $fighting]);

        $sport->refresh();
        $race->refresh();
        $boxing->refresh();
        $motogp->refresh();

        $this->assertTrue($race->isDescendantOf($sport));
        $this->assertTrue($boxing->isDescendantOf($sport));
        $this->assertTrue($race->isAncestorOf($motogp));
    }
}
