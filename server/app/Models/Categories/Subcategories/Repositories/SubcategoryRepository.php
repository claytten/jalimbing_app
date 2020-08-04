<?php

namespace App\Models\Categories\Subcategories\Repositories;

use App\Models\Categories\Subcategories\Subcategory;
use App\Models\Categories\Subcategories\Subcategoryimage;
use App\Models\Categories\Subcategories\Exceptions\SubcategoryNotFoundException;
use App\Models\Categories\Subcategories\Repositories\Interfaces\SubcategoryRepositoryInterface;
use App\Models\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class SubcategoryRepository implements SubcategoryRepositoryInterface
{
    use UploadableTrait;
    /**
     * SubcategoryRepository constructor.
     *
     * @param Subcategory $subcategory
     */
    public function __construct(Subcategory $subcategory)
    {
        $this->model = $subcategory;
    }

    /**
     * List all the subcategorys
     *
     * @param string $order
     * @param string $sort
     *
     * @return Collection
     */
    public function listSubcategories(string $order = 'id', string $sort = 'desc', $except = []) : Collection
    {
        return $this->model->orderBy($order, $sort)->get()->except($except);
    }

    /**
     * Create the subcategory
     *
     * @param array $data
     *
     * @return Subcategory
     */
    public function createSubcategory(array $data): Subcategory
    {
        return $this->model->create($data);
    }

    /**
     * Save the subcategoryimages
     *
     * @param array $data
     *
     * @return Subcategory
     */
    public function createSubcategoryimage(array $data)
    {
        $subcategoryimage = new Subcategoryimage($data);
        return $subcategoryimage->save();
    }

    /**
     * Find the subcategory by id
     *
     * @param int $id
     *
     * @return Subcategory
     */
    public function findSubcategoryById(int $id): Subcategory
    {
        try {
            return $this->model->where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new SubcategoryNotFoundException;
        }
    }

    /**
     * Update subcategory
     *
     * @param array $params
     *
     * @return bool
     */
    public function updateSubcategory(array $params): bool
    {
        $filtered = collect($params)->all();

        return $this->model->update($filtered);
    }

    /**
     * Update subcategoryimages
     *
     * @param array $params
     *
     * @return bool
     */
    public function updateSubcategoryimages(array $params, int $id): bool
    {
        $filtered = collect($params)->all();

        return Subcategoryimage::where('id',$id)->update($filtered);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function deleteSubcategory() : bool
    {
        return $this->model->delete();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function deleteSubcategoryimage(string $image_link) : bool
    {
        return Subcategoryimage::where('image_link',$image_link)->delete();
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function saveCoverImage(UploadedFile $file) : string
    {
        return $file->store('sub_categories', ['disk' => 'public']);
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
