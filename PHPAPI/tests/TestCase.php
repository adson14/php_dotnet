<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;


use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use  DatabaseTransactions;
    use WithFaker;
    protected $faker;

    /**
     * Set up the test
     */
/*
   public function setUp():void
    {
        $this->createAuthenticatedUser();
    }
*/


}
