<?php


namespace App\Repositories\Eloquent;

use App\Call;
use App\Repositories\CallRepositoryInterface;
use App\Repositories\EmployeeRepositoryInterface;

class CallRepository extends BaseRepository implements CallRepositoryInterface
{
    /**
     * @var EmployeeRepositoryInterface
     */
    private $employee;

    /**
     * CallRepository constructor.
     * @param Call $model
     * @param EmployeeRepositoryInterface $employee
     */
    public function __construct(Call $model, EmployeeRepositoryInterface $employee)
    {
        parent::__construct($model);
        $this->employee = $employee;
    }

    /**
     * Finds and returns a specific call.
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function find($id)
    {
        return parent::find($id);
    }

    /**
     * Creates a new object from the given attributes and saves it to the database.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function create(array $attributes)
    {
        $isInstant = ($attributes['is_instant'] == 1)? true : false;

        if ($isInstant) {
            $employee = $this->employee->findForInstantCall();
        } else {
            $employee = $this->employee->findForNonInstantCall();
        }

        $call = parent::create([
            'is_instant' => $isInstant,
            'employee_id' => $employee,
        ]);

        return $call;
    }
}