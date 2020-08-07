<?php

namespace App\Models\Categories\Subcategories\Repositories\Interfaces;

use App\Models\Categories\Subcategories\Subcategory;
use App\Models\Categories\Subcategories\Subcategoryimage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface SubcategoryRepositoryInterface
{
    public function listSubcategories(string $order = 'id', string $sort = 'desc', $except = []) : Collection;

    public function createSubcategory(array $params) : Subcategory;

    public function findSubcategoryById(int $id) : Subcategory;

    public function updateSubcategory(array $params): bool;

    public function deleteSubcategory() : bool;

    public function saveCoverImage(UploadedFile $file) : string;

    public function deleteFile(string $get_data);

    public function createSubcategoryimage(array $data);

    public function updateSubcategoryimages(array $params, int $id): bool;

    public function deleteSubcategoryimage(string $image_link) : bool;
}
