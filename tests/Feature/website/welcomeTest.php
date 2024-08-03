<?php

namespace Tests\Feature\website;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class welcomeTest extends TestCase
{
    //  php artisan test .\tests\Feature\website

    public function test_index(): void
    {
        $response = $this->get('/ShowDoctorTable');
        $response->assertStatus(200);

    }
}