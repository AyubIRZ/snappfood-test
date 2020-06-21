<?php

namespace Tests\Feature\API;

use App\Repositories\CallRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CallTest extends TestCase
{
    protected $call;

    protected function setUp(): void
    {
        parent::setUp();
        $this->call = app(CallRepositoryInterface::class);
    }

    /**
     * Test that making a new Non Instant call returns adding to the queue response.
     *
     * @return void
     */
    public function testMakeNewNonInstantCallReturnsAddingToTheQueueResponse()
    {
        $response = $this->json('Post','/api/calls/',
            [
                'is_instant' => false,
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'ok' => true,
            ]);
    }

    /**
     * Test that making a new Instant call returns assigned to employee response.
     *
     * @return void
     */
    public function testMakeNewInstantCallReturnsAssignedToEmployeeResponse()
    {
        $response = $this->json('Post','/api/calls/',
            [
                'is_instant' => true,
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'ok' => true,
            ]);
    }

    /**
     * Test that closing a call returns correct response.
     *
     * @return void
     */
    public function testClosingCallReturnsCorrectResponse()
    {
        $call = $this->json('Post','/api/calls/',
            [
                'is_instant' => true,
            ])->content();

        $response = $this->json('put','/api/calls/close/',
            [
                'call' => json_decode($call)->data->id,
            ]);

        $response->assertStatus(201)->assertJson([
            'ok' => true,
        ]);
    }
}
