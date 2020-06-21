<?php

namespace Tests\Feature\API;

use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    protected $employee;

    protected function setUp(): void
    {
        parent::setUp();
        $this->employee = app(EmployeeRepositoryInterface::class);
    }

    /**
     * Test that requesting an employee data returns correct info.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $employee = $this->employee->find(1);

        $response = $this->json('Get','/api/employees/1');

        $response->assertStatus(200)
        ->assertJson([
            'ok' => true,
            'data' => $employee->toArray()
        ]);
    }
}
