<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Core\Exceptions\ExceptionCode;
use Modules\User\Exceptions\UserException;

class ExceptionTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->withoutExceptionHandling();

        $this->expectExceptionObject(
            UserException::userAlreadyExists()
        );

        $this->get('/test');
    }
}
