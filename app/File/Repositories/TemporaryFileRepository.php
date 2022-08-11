<?php

declare(strict_types=1);

namespace App\File\Repositories;

use App\Base\Models\Eloquent\TemporaryFile ;
use App\Base\Traits\RepositoryBase;
use Illuminate\Support\Collection;

class TemporaryFileRepository
{
    use RepositoryBase;

    public function __construct(private TemporaryFile $model)
    {
    }

    /**
     * @param string $field
     * @param string|null $value
     * @return Collection|null
     */
    public function fetchBy(string $field, ?string $value): ?Collection
    {
        return $this->model->where($field, $value)->get();
    }

    /**
     * @param string $path
     * @return bool
     */
    public function forceDeleteByPath(string $path): bool
    {
        return (bool) $this->model->where('path', $path)->forceDelete();
    }

    /**
     * @param int $fileId
     * @return TemporaryFile|null
     */
    public function fetchById(int $fileId): ?TemporaryFile
    {
        return $this->model->select()
            ->where('id', $fileId)
            ->get()
            ->first();
    }

    public function fetchAllByIdIn(array $files): Collection
    {
        return $this->model
            ->selectRaw("
                id,
                original_name AS label,
                path
            ")
            ->whereIn('id', $files)
            ->get();
    }
}
