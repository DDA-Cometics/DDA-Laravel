<?php
namespace App\Repositories\Implements;
use App\Repositories\Interfaces\IBaseRepository;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements IBaseRepository {
    protected $model;
    protected Builder $query;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->setModel();
        $this->query = $this->model->newQuery();
    }

    abstract protected function getModel(): string;

    /**
     * @throws BindingResolutionException
     */
    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    public function getQuery(): Builder|\Illuminate\Database\Query\Builder
    {
        return $this->query->getQuery();
    }

    public function clearQuery(): \Illuminate\Database\Query\Builder
    {
        $this->query = $this->model->newQuery();
        return $this->query->getQuery();
    }

    public function all($toArray = false): Collection|array|null
    {
        $all = $this->model->all();
        return $toArray ? $all->toArray() : $all;
    }

    public function findById($id): mixed
    {
        return $this->model->find($id);
    }

    public function create($attributes = []): mixed
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes = []): mixed
    {
        // return $this->model->update($id, $attributes);
        $model = $this->model->find($id);

        if ($model) {
            // Cập nhật dữ liệu
            $model->update($attributes);

            // Trả về model đã được cập nhật
            return $model;
        }

        // Hoặc có thể trả về một giá trị khác để thể hiện kết quả cập nhật
        return null;
    }


    public function updateWhere(array $attributes, array $params): mixed
    {
        return $this->model->where($attributes)->update($params);
    }

    public function findBy(array $filter, bool $toArray = true): Collection|array|null
    {
        $builder = $this->model->newQuery();
        foreach ($filter as $key => $val) {
            $builder->where($key, $val);
        }
        $find = $builder->get();

        if (!$toArray) {
            return $find;
        }
        return $find ? $find->toArray() : null;
    }

    public function findOneBy(array $filter): mixed
    {
        $builder = $this->model->newQuery();
        foreach ($filter as $key => $val) {
            $builder->where($key, $val);
        }
        $data = $builder->first();

        return $data;
    }
    public function paginate($page): LengthAwarePaginator
    {
        return $this->query->paginate($page);
    }
    public function with($relationship): mixed
    {
        return $this->model->$relationship;
    }

    public function delete($id): mixed
    {
        return $this->model->destroy($id);
    }
}