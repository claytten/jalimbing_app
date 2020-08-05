<?php

namespace App\Http\Controllers\Admin\Maps;

use App\Models\Maps\Fields\Requests\CreateFieldRequest;
use App\Models\Maps\Fields\Requests\UpdateFieldRequest;
use App\Models\Maps\Fields\Repositories\FieldRepository;
use App\Models\Maps\Fields\Repositories\Interfaces\FieldRepositoryInterface;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Maps\Fields\Field;
use App\Models\Maps\Geometries\Geometry;
use App\Models\Tools\UploadableTrait;
use Illuminate\Http\UploadedFile;

class MapApiController extends Controller
{
  use UploadableTrait;
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
      $fields = $this->fieldRepo->listFields()->sortBy('name');

      $field_response = array(
        "type" => "FeatureCollection",
        "features" => array()
      );
      foreach($fields as $item){
        $temp = array(
          "type" => "Feature",
          "properties" => array(
            "popupContent" => array(
              "id"          => $item->id,
              "namePlace"   => $item->area_name,
            )
          ),
          "geometry" => array(
            "type" => $item->markers->geo_type,
            "coordinates" => json_decode($item->markers->coordinates)
          )
        );

        $field_response["features"][] = $temp;

      }
      return response()->json([
          'code'    => 200,
          'status'  => 'success',
          'data'    => $field_response
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      if($request->action == "post") {
        $message = "Field Succesfully created";
        $this->fieldRepo->createField($request->all());
      } else if( $request->action == "update") {
        $field = $this->fieldRepo->findFieldById($request->id);
        $updateField = new FieldRepository($field);
        $updateField->updateField($request->all());

        $message = "Field Succesfully updated";

        return response()->json([
            'code'        => 200,
            'status'      => 'success',
            'message'     => $message,
            'data'        => $request->id
        ]);
        
      } else {
        $field = $this->fieldRepo->findFieldById($request->id);
        $message = 'Field successfully Deleted';
        $getField = new FieldRepository($field);
        $getField->deleteField();
      }


      return response()->json([
          'code'        => 200,
          'status'      => 'success',
          'message'     => $message,
          'data'        => $request->all()
      ]);
    }
}
