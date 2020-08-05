<?php

namespace App\Models\Maps\Fields\Repositories;

use App\Models\Maps\Fields\Field;
use App\Models\Maps\Fields\Exceptions\FieldNotFoundException;
use App\Models\Maps\Fields\Repositories\Interfaces\FieldRepositoryInterface;
use App\Models\Tools\UploadableTrait;
use App\Models\Maps\Markers\Marker;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class FieldRepository implements FieldRepositoryInterface
{
    use UploadableTrait;
    /**
     * FieldRepository constructor.
     *
     * @param Field $field
     */
    public function __construct(Field $field)
    {
        $this->model = $field;
    }

    /**
     * List all the Fields
     *
     * @param string $order
     * @param string $sort
     *
     * @return Collection
     */
    public function listFields(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection
    {
        return $this->model->all($columns, $order, $sort);
    }

    /**
     * Create the Field
     *
     * @param array $data
     *
     * @return Field
     */
    public function createField(array $data): Field
    {
        try {
            $field = $this->model->create([
                "area_name"     => $data['namePlace'],
            ]);
            $this->createGeo($field->id,$data['coordinates']);
            return $field;
        } catch (QueryException $e) {
            throw new FieldNotFoundException($e);
        }
    }

    /**
     * Create the Geometries
     *
     * @param array $data
     *
     *
     */
    private function createGeo($id, $coordinates) {

        $marker = new Marker;
        $marker->geo_type     = "Point";
        $marker->coordinates  = $coordinates;
        $marker->field_id     = $id;
        $marker->save();

    }
    /**
     * Find the field by id
     *
     * @param int $id
     *
     * @return Field
     */
    public function findFieldById(int $id): Field
    {
        try {
            return $this->model->where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new FieldNotFoundException;
        }
    }

    /**
     * Update field
     *
     * @param array $params
     *
     * @return bool
     */
    public function updateField(array $data): bool
    {
        return $this->model->where('id', $this->model->id)->update([
            "area_name"         => $data['namePlace'],
        ]);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function deleteField() : bool
    {
        return $this->model->delete();
    }
}
