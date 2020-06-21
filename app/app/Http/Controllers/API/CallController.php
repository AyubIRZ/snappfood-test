<?php

namespace App\Http\Controllers\API;

use App\Call;
use App\Http\Controllers\Controller;
use App\Http\Requests\CloseCallRequest;
use App\Http\Requests\MakeCallRequest;
use App\Repositories\CallRepositoryInterface;
use App\Services\EmployeeService;

class CallController extends Controller
{
    /**
     * Local repository instance.
     *
     * @var CallRepositoryInterface
     */
    private $call;

    /**
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * CallController constructor.
     * @param CallRepositoryInterface $call
     * @param EmployeeService $employeeService
     */
    public function __construct(CallRepositoryInterface $call, EmployeeService $employeeService)
    {
        $this->call = $call;
        $this->employeeService = $employeeService;
    }

    /**
     * Makes a new incoming call and assigns it to a call center employee.
     *
     * @param MakeCallRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function make(MakeCallRequest $request)
    {
        $call = $this->call->create($request->all());

        if ($call->employee_id == null) {
            $response = [
                'ok' => true,
                'message' => 'A new call has been made and added to the call center queue!',
                'data' => $call
            ];
        } else {
            $response = [
                'ok' => true,
                'message' => 'A new call has been made and assigned to an employee!',
                'data' => $call
            ];
        }

        return response()->json($response, 201);
    }

    /**
     * Makes a new incoming call and assigns it to a call center employee.
     *
     * @param MakeCallRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function close(CloseCallRequest $request)
    {
        $callId = $request->only('call');

        $employeeId = $this->call->close($callId);

        if (!$employeeId) {
            $response = [
                'ok' => false,
                'message' => 'The requested call is already closed!',
            ];
            return response()->json($response, 422);
        }

        $assigned = $this->employeeService->assignCallOrIdle($employeeId);

        $response = [
            'ok' => true,
            'message' => 'The requested call has been closed successfully!',
        ];

        return response()->json($response, 201);
    }
}
