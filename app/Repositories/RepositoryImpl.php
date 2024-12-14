<?php

// app/Repositories/RepositoryImpl.php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class RepositoryImpl implements RepositoryInterface
{
    protected $model;

    /**
     * Создаем новый репозиторий с моделью.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Получить все элементы.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Найти элемент по ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Создать новый элемент.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Обновить элемент.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $item = $this->find($id);
        $item->update($data);
        return $item;
    }

    /**
     * Удалить элемент.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $item = $this->find($id);
        return $item->delete();
    }
}
