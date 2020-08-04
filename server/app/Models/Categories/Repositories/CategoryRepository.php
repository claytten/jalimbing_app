<?php

namespace App\Models\Categories\Repositories;

use App\Models\Categories\Category;
use App\Models\Categories\Exceptions\CategoryNotFoundException;
use App\Models\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class CategoryRepository implements CategoryRepositoryInterface
{
    use UploadableTrait;
    /**
     * CategoryRepository constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    /**
     * List all the categorys
     *
     * @param string $order
     * @param string $sort
     *
     * @return Collection
     */
    public function listCategories(string $order = 'id', string $sort = 'desc', $except = []) : Collection
    {
        return $this->model->orderBy($order, $sort)->get()->except($except);
    }

    /**
     * Create the category
     *
     * @param array $data
     *
     * @return Category
     */
    public function createCategory(array $data): Category
    {
        return $this->model->create($data);
    }

    /**
     * Find the category by id
     *
     * @param int $id
     *
     * @return Category
     */
    public function findCategoryById(int $id): Category
    {
        try {
            return $this->model->where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new CategoryNotFoundException;
        }
    }

    /**
     * Update category
     *
     * @param array $params
     *
     * @return bool
     */
    public function updateCategory(array $params): bool
    {
        $filtered = collect($params)->all();

        return $this->model->update($filtered);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function deleteCategory() : bool
    {
        return $this->model->delete();
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function saveCoverImage(UploadedFile $file) : string
    {
        return $file->store('categories', ['disk' => 'public']);
    }

    /**
     * Destroye File on Storage
     *
     * @param string $get_data
     *
     */
    public function deleteFile(string $get_data)
    {
        return File::delete("storage/{$get_data}");
    }
}
