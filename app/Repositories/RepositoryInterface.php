<?php
// app/Repositories/RepositoryInterface.php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    /**
     * Получить все элементы.
     *
     * @return Collection
     */
    public function all();

    /**
     * Найти элемент по ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Создать новый элемент.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Обновить элемент.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Удалить элемент.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
