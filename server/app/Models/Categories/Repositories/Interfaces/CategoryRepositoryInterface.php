<?php

namespace App\Models\Categories\Repositories\Interfaces;

use App\Models\Categories\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function listCategories(string $order = 'id', string $sort = 'desc', $except = []) : Collection;

    public function createCategory(array $params) : Category;

    public function findCategoryById(int $id) : Category;

    public function updateCategory(array $params): bool;

    public function deleteCategory() : bool;

    public function saveCoverImage(UploadedFile $file) : string;

    public function deleteFile(string $get_data);
}
