<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

abstract class TestCase extends BaseTestCase
{
    use DatabaseTransactions, CreatesApplication;

    public function setUp() : void
    {
        parent::setUp();
        $this->prepareForTests();
    }
}
