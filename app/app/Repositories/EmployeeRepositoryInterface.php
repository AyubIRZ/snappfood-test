<?php


namespace App\Repositories;


interface EmployeeRepositoryInterface
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
     * Should inserts an array of objects into the database.
     *
     * @param $collection
     * @return mixed
     */
    public function createMany(array $collection);
}