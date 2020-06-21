<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Local repository instance.
     *
     * @var EmployeeRepositoryInterface
     */
    private $employee;

    /**
     * EmployeeController constructor.
     * @param EmployeeRepositoryInterface $employee
     */
    public function __construct(EmployeeRepositoryInterface $employee)
    {
        $this->employee = $employee;
    }

    public function show($employee)
    {
        $employee = $this->employee->find($employee);

        if ($employee == null) {
            return response()->json([
                'ok' => false,
                'message' => 'The requested employees was not found!',
                'data' => $employee,
            ]);
        }

        return response()->json([
            'ok' => true,
            'message' => 'The requested employees was found!',
            'data' => $employee,
        ]);
    }
}
