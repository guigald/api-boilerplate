<?php

declare(strict_types=1);

namespace App\Base\Traits;

use App\Base\Exceptions\CreateException;
use App\Base\Exceptions\UpdateException;
use App\Base\Helpers\DateHelper;
use Illuminate\Support\Collection;
use Exception;

trait RepositoryBase
{
    /**
     * @return Collection|null
     */
    public function fetchAll(): ?Collection
    {
        return $this->model->select()->get();
    }

    /**
     * @param string $field
     * @param string $value
     * @return Collection|null
     */
    public function fetchAllBy(string $field, string $value): ?Collection
    {
        return $this->model->where($field, $value)->get();
    }

    /**
     * @param array $search
     * @return Collection|null
     */
    public function fetchAllByMultiple(array $search): ?Collection
    {
        if (empty($search)) {
            return null;
        }

        $query = $this->model->select();

        foreach ($search as $key => $value) {
            $query->where($key, $value);
        }

        return $query->get()->first();
    }

    /**
     * @param array $search
     * @return Collection|null
     */
    public function fetchAllByMultipleOr(array $search): ?Collection
    {
        $isFirstWhere = true;

        if (empty($search)) {
            return null;
        }

        $query = $this->model->select();

        foreach ($search as $key => $value) {
            if ($isFirstWhere) {
                $query->where($key, $value);
                $isFirstWhere = false;
                continue;
            }

            $query->orWhere($key, $value);
        }

        return $query->get();
    }

    /**
     * @param array $data
     * @return integer
     * @throws CreateException
     */
    public function create(array $data): int
    {
        try {
            $createdAt = data_get($data, 'created_at');

            if (!$createdAt) {
                data_set($data, 'created_at', DateHelper::now());
            }

            return $this->model->insertGetId($data);
        } catch (Exception $e) {
            throw new CreateException($e->getMessage());
        }
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     * @throws UpdateException
     */
    public function update(int $id, array $data): bool
    {
        try {
            $updatedAt = data_get($data, 'updated_at');

            if (!$updatedAt) {
                data_set($data, 'updated_at', DateHelper::now());
            }

            $object = $this->model->where('id', $id)->get();

            foreach ($object as $item) {
                foreach ($data as $key => $value) {
                    $item->$key = $value;
                }

                $item->save($data);
            }

            return true;

//            return (bool) $this->model->where('id', $id)->update($data);
        } catch (Exception $e) {
            throw new UpdateException($e->getMessage());
        }
    }

    /**
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        return (bool) $this->model->where('id', $id)->delete();
    }

    /**
     * @param integer $id
     * @return boolean
     */
    public function forceDelete(int $id): bool
    {
        return (bool) $this->model->where('id', $id)->forceDelete();
    }
}
