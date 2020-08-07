<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Categories\Subcategories\Repositories\Interfaces\SubcategoryRepositoryInterface;
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
     * Categories Controller Constructor
     *
     * @param CategoryRepositoryInterface $CategoryRepository
     * @param SubcategoryRepositoryInterface $SubcategoryRepository
     * @return void
     */
    public function __construct(
        CategoryRepositoryInterface $CategoryRepository,
        SubcategoryRepositoryInterface $SubcategoryRepository
    )
    {

        $this->categoryRepo = $CategoryRepository;
        $this->subcategoryRepo = $SubcategoryRepository;
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
            'data'          => $categories
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
        $images = array();
        if(!empty($subcategory->subCategoryImages())) {
            
            foreach($subcategory->subCategoryImages as $image) {
                array_push($images, $image->image_link);
            }
        }

        return response()->json([
            'url'           => URL::to('/'.$id.'/show'),
            'example-image' => URL::to('/storage/[folder]/[image.jpg]'),
            'data'          => [
                'subcategory'   => $subcategory,
                'images'         => $images
            ]
        ]);
    }
}
