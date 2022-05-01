<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Location;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LocationTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test default locations availability
     * 
     * @return void
     * 
     * @test
     * 
     */
    public function all_default_locations_have_been_inserted()
    {
        $this->withoutExceptionHandling();
        $this->assertCount(5, Location::all());
    }
}
