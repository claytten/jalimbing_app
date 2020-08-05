<?php

namespace App\Http\Controllers\Admin\Maps;

use App\Models\Maps\Fields\Repositories\Interfaces\FieldRepositoryInterface;

use App\Http\Controllers\Controller;

class MapController extends Controller
{
    /**
     * @var FieldRepositoryInterface
     */
    private $fieldRepo;
    /**
     * Map Controller Constructor
     *
     * @param FieldRepositoryInterface $fieldRepository
     * @return void
     */
    public function __construct(
        FieldRepositoryInterface $fieldRepository
    )
    {
        // Spatie ACL
        $this->middleware('permission:map-list');
        $this->middleware('permission:map-create', ['only' => ['create','store']]);
        $this->middleware('permission:map-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:map-delete', ['only' => ['destroy']]);

        $this->fieldRepo = $fieldRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $getFields = $fields = $this->fieldRepo->listFields()->sortBy('name');
        return view('admin.maps.index');

    }
}
