<?php

namespace App\Repositories;

use App\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @codeCoverageIgnore
 */
abstract class Repository
{
    /** @var int  */
    protected const DEFAULT_PAGINATION_SIZE = 25;

    /** @var \Illuminate\Database\Eloquent\Model */
    public $model;

    /**
     * Repository constructor.
     * @param App $app
     * @throws RepositoryException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract protected function model();

    /**
     * @return Model
     * @throws RepositoryException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeModel(): Model
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Create Model
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function fill(array $data): Model
    {
        return $this->model->fill($data);
    }

    /**
     * @param array $data
     * @return array
     */
    public function createArraysModels(array $data):  array
    {
        $idsCreatedModels = [];
        collect($data)->each(function ($item) use (&$idsCreatedModels) {
            $idsCreatedModels[] = $this->create($item)->id;
        });
        return $idsCreatedModels;
    }

    /**
     * @param array $fields
     * @return mixed
     */
    public function whereFirst(array $fields)
    {
        return $this->model->where($fields)->first();
    }

    /**
     * @param array $data
     * @return Collection
     */
    public function all(array $data = ['*']): Collection
    {
        return $this->model::all($data);
    }

    /**
     * @param int $paginate
     * @return LengthAwarePaginator
     */
    public function allPaginated(int $paginate = self::DEFAULT_PAGINATION_SIZE): LengthAwarePaginator
    {
        return $this->model->paginate($paginate);
    }

    /**
     * @param array $data
     *
     * @return Builder
     */
    public function whereArray(array $data): Builder
    {
        return $this->model->where($data);
    }

    /**
     * @param Collection $collection
     * @param string $key
     * @param array $data
     * @return Collection
     */
    public function whereArrayFromModel(Collection $collection, string $key, string $value): Collection
    {
        return $collection->where($key, $value);
    }

    /**
     * Update model
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function updateByArray(Model $model, array $data): Model
    {
        $model->fill($data)->save();
        return $model;
    }

    /**
     * get list of model with relations
     *
     * @param array $data
     * @return Collection
     */
    public function with(array $data): Collection
    {
        return $this->model->with($data)->get();
    }

    /**
     * get list of model with relations
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function load(Model $model, array $data): Model
    {
        return $model->load($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @param $arrayRelatedModels
     * @return void
     */
    public function updateRelatedModels(Model $model, array $data, $arrayRelatedModels): void
    {
        foreach ($arrayRelatedModels as $value) {
            if (isset($data[$value])) {
                $method = \Str::camel($value);
                $model->$method()->sync($data[$value]);
            }
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function modelWithSelectedPublicFields(int $id, array $data): Model
    {
        return $this->model->with($data)->find($id);
    }

    /**
     * @param string $key
     * @param array $values
     * @return Builder
     */
    public function whereIn(string $key, array $values): Builder
    {
        return $this->model->whereIn($key, $values);
    }

    /**
     * @param string $key
     * @param array $values
     * @return Builder
     */
    public function whereNotIn(string $key, array $values): Builder
    {
        return $this->model->whereNotIn($key, $values);
    }

    /**
     * @param BelongsToMany $collection
     * @param int $id
     * @param array $data
     * @return int|mixed
     */
    public function updateExistingPivot(BelongsToMany $collection, int $id, array $data)
    {
        return $collection->updateExistingPivot($id, $data);
    }
}
