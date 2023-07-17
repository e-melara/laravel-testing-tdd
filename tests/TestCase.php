<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function assertClassUsersTrait($trait, $class): void
    {
      $this->assertArrayHasKey(
        $trait,
        class_uses($class),
        "The {$class} class must use the {$trait} Trait"
      );
    }
}
