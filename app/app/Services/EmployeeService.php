<?php

namespace App\Services;

use App\Repositories\CallRepositoryInterface;
use \App\Repositories\EmployeeRepositoryInterface;

class EmployeeService
{
    /**
     * @var CallRepositoryInterface
     */
    private $call;
    /**
     * @var EmployeeRepositoryInterface
     */
    private $employee;

    /**
     * EmployeeService constructor.
     * @param CallRepositoryInterface $call
     * @param EmployeeRepositoryInterface $employee
     */
    public function __construct(CallRepositoryInterface $call, EmployeeRepositoryInterface $employee)
    {
        $this->call = $call;
        $this->employee = $employee;
    }

    public function assignCallOrIdle($employeeId)
    {
        $employee = $this->employee->find($employeeId);
        $call = $this->call->findInstantCall();

        if (!$call) {
            $employee->update([
                'is_busy' => false,
            ]);
            return false;
        }

        $call->update([
            'employee_id' => $employee->id
        ]);

        return true;
    }
}