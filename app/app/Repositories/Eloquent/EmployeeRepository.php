<?php


namespace App\Repositories\Eloquent;

use App\Employee;
use App\Repositories\EmployeeRepositoryInterface;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    /**
     * EmployeeRepository constructor.
     *
     * @param Employee $model
     */
    public function __construct(Employee $model)
    {
        parent::__construct($model);
    }

    /**
     * Returns a collection of all Products.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|mixed
     */
    public function all()
    {
        return Parent::all();
    }

    /**
     * Finds and returns a specific product with the default relation.
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
        return parent::create($attributes);
    }

    /**
     * @return |null
     */
    public function findForInstantCall()
    {
        $employee = $this->model
                ->where('is_busy', false)
                ->orderBy('priority')
                ->first() ?? false;

        if (!$employee) {
            return null;
        }

        $employee->is_busy = true;
        $employee->save();

        return $employee->id;
    }

    /**
     * @return |null
     */
    public function findForNonInstantCall()
    {
        $employee = $this->model
                ->where('is_busy', false)
                ->where('is_ready', true)
                ->orderBy('priority')
                ->first() ?? false;

        if (!$employee) {
            return null;
        }

        $employee->is_busy = true;
        $employee->save();

        return $employee->id;
    }
}