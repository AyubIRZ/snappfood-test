<?php


namespace App\Repositories\Eloquent;


use Illuminate\Database\Eloquent\Model;
use \App\Repositories\EloquentRepositoryInterface;
use phpDocumentor\Reflection\Types\Integer;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * The concrete object of type Model.
     *
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Creates a new object from the given attributes and saves it to the database.
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Finds and returns a specific model object.
     *
     * @param $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Returns a collection of all model objects.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Returns a collection of model objects with the given relations.
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allWithRelations(array $relations)
    {
        return $this->model->with($relations)->get();
    }

    /**
     * Finds and returns a specific model object with the given relations.
     *
     * @param Integer $id
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function findWithRelations(Integer $id, array $relations)
    {
        return $this->model->with($relations)->find($id);
    }

    /**
     * Inserts an array of objects into the database.
     *
     * @param array $collection
     * @return Model
     */
    public function createMany(array $collection)
    {
        return $this->model->insert($collection);
    }
}