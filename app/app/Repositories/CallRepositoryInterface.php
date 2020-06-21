<?php


namespace App\Repositories;


interface CallRepositoryInterface
{
    /**
     * Should return a collection of all products.
     *
     * @return mixed
     */
    public function all();

    /**
     * Should return an Employee object.
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Should create and store a new Employee.
     *
     * @param $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @return mixed
     */
    public function findInstantCall();
}