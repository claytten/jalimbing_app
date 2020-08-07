<?php

namespace App\Models\Maps\Fields\Repositories\Interfaces;

use App\Models\Maps\Fields\Field;
use App\Models\Maps\Markers\Marker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface FieldRepositoryInterface
{
    public function listFields(): Collection;

    public function createField(array $data) : Field;

    public function findFieldById(int $id) : Field;

    public function updateField(array $data): bool;

    public function deleteField() : bool;
}
