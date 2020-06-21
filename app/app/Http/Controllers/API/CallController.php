<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\MakeCallRequest;
use App\Repositories\CallRepositoryInterface;

class CallController extends Controller
{
    /**
     * Local repository instance.
     *
     * @var CallRepositoryInterface
     */
    private $call;

    /**
     * CallController constructor.
     * @param CallRepositoryInterface $call
     */
    public function __construct(CallRepositoryInterface $call)
    {
        $this->call = $call;
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
}
