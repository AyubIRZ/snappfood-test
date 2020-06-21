<?php


namespace App\Repositories;

interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     */
    public function create(array $attributes);

    /**
     * @param $id
     */
    public function find($id);

    /**
     * @return mixed
     */
    public function all();
}