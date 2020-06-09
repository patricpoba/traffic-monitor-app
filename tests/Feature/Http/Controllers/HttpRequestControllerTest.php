<?php

namespace Tests\Feature\Http\Controllers;

use App\HttpRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HttpRequestController
 */
class HttpRequestControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $httpRequests = factory(HttpRequest::class, 3)->create();

        $response = $this->get(route('http-requests.index'));

        $response->assertOk();
        $response->assertViewIs('http-requests.index');
    }
}
