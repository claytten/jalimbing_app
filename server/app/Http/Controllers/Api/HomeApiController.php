<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Categories\Subcategories\Repositories\Interfaces\SubcategoryRepositoryInterface;
use App\Models\Maps\Fields\Repositories\Interfaces\FieldRepositoryInterface;
use Illuminate\Support\Facades\URL;

class HomeApiController extends Controller
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * @var SubcategoryRepositoryInterface
     */
    private $subcategoryRepo;

    /**
     * @var FieldRepositoryInterface
     */
    private $fieldRepo;

    /**
     * Categories Controller Constructor
     *
     * @param CategoryRepositoryInterface $CategoryRepository
     * @param SubcategoryRepositoryInterface $SubcategoryRepository
     * @return void
     */
    public function __construct(
        CategoryRepositoryInterface $CategoryRepository,
        SubcategoryRepositoryInterface $SubcategoryRepository,
        FieldRepositoryInterface $fieldRepository
    )
    {

        $this->categoryRepo = $CategoryRepository;
        $this->subcategoryRepo = $SubcategoryRepository;
        $this->fieldRepo = $fieldRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'index' => route('api.index'),
            'homescreen' => route('api.home'),
            'detail'    => [
                'pattern'   => URL::to('/[id]/show'),
                'example'   => URL::to('/2/show')
            ],
            'maps'      => route('api.maps'),
            'source'    => 'https://github.com/claytten/jalimbing_app'            
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $categories = $this->categoryRepo->listCategories('id');
        return response()->json([
            'url'           => route('api.home'),
            'example-image' => URL::to('/storage/[folder]/[image.jpg]'),
            'data'          => $categories->where('is_active', 1)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = $this->subcategoryRepo->findSubcategoryById($id);
        $getcategory = array();
        $images = array();

        if($subcategory->is_active == 1) {
            $getcategory = $subcategory;
            
            if(!empty($subcategory->subCategoryImages())) {
                
                foreach($subcategory->subCategoryImages as $image) {
                    array_push($images, $image->image_link);
                }
            }
        }

        return response()->json([
            'url'           => URL::to('/'.$id.'/show'),
            'example-image' => URL::to('/storage/[folder]/[image.jpg]'),
            'data'          => [
                'subcategory'   => $getcategory,
                'images'         => $images
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function maps()
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
            'url'           => route('api.maps'),
            'data'          => $field_response
        ]);
    }
}
