<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Models\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Models\Categories\Repositories\CategoryRepository;
use App\Models\Categories\Subcategories\Repositories\Interfaces\SubcategoryRepositoryInterface;
use App\Models\Categories\Subcategories\Repositories\SubcategoryRepository;
use App\Models\Categories\Requests\CreateCategoryRequest;
use App\Models\Categories\Requests\UpdateCategoryRequest;


use App\Http\Controllers\Controller;
use App\Models\Tools\UploadableTrait;
use Illuminate\Http\UploadedFile;

class CategoryController extends Controller
{
    use UploadableTrait;
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
        // Spatie ACL
        $this->middleware('permission:category-list',['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);

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
        $subcategories = $this->subcategoryRepo->listSubcategories('id');

        return view('admin.categories.category.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $data = $request->except('_token', '_method');
        $i = 0;

        if($request->is_active == "on") {
            $status = 1;
        } else {
            $status = 0;
        }

        if(!empty($request->instagram)) {
            $instagram = $request->instagram;
        } else {
            $instagram = null;
        }

        if(!empty($request->whatsapp)) {
            $whatsapp = $request->whatsapp;
        } else {
            $whatsapp = null;
        }

        if(!empty($request->link_youtube)) {
            $youtube = $request->link_youtube;
        } else {
            $youtube = null;
        }

        $category = [
            "name" => $data['name'],
            "image" => $data['image'],
            "is_active" => $status
        ];
        if ($request->hasFile('image') && $request->file('image') instanceof UploadedFile) {
            $category['image'] = $this->categoryRepo->saveCoverImage($request->file('image'));
        }

        $get_category = $this->categoryRepo->createCategory($category);

        $sub_category = [
            "category_id" => $get_category->id,
            "name" => $data['name'],
            "schedule" => $data['schedule'],
            "description" => $data['description'],
            "instagram" => $instagram,
            "whatsapp" => $whatsapp,
            "link_youtube" => $youtube,
            "is_active" => $status
        ];
        
        $get_sub_category = $this->subcategoryRepo->createSubcategory($sub_category);

        if ($request->hasFile('category_images')) {

            foreach($data['category_images'] as $key => $value) {
                $sub_category_images[] = [
                    "sub_category_id" => $get_sub_category->id,
                    "image_link" => $value,
                    "is_active" => $status
                ];

                $sub_category_images[$i]['image_link'] = $this->subcategoryRepo->saveCoverImage($value);

                $this->subcategoryRepo->createSubcategoryimage($sub_category_images[$i]);
                $i++;
            }
        }
        
        return redirect()->route('admin.category.index')->with([
            'status'    => 'success',
            'message'   => 'Create Category successful!'
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
        $category = $this->categoryRepo->findCategoryById($id);
        $subcategory = $this->subcategoryRepo->findSubcategoryById($category->id);

        return view('admin.categories.category.show', [
            'category'  => $category,
            'subcategory'   => $subcategory
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepo->findCategoryById($id);
        $subcategory = $this->subcategoryRepo->findSubcategoryById($category->id);

        return view('admin.categories.category.edit', [
            'category'  => $category,
            'subcategory'   => $subcategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $data = $request->except('_token', '_method');
        $category = $this->categoryRepo->findCategoryById($id);
        $subcategory = $this->subcategoryRepo->findSubcategoryById($category->id);
        $i = 0;

        if($request->is_active == "on") {
            $status = 1;
        } else {
            $status = 0;
        }

        if(!empty($request->instagram)) {
            $instagram = $request->instagram;
        } else {
            $instagram = null;
        }

        if(!empty($request->whatsapp)) {
            $whatsapp = $request->whatsapp;
        } else {
            $whatsapp = null;
        }

        if(!empty($request->link_youtube)) {
            $youtube = $request->link_youtube;
        } else {
            $youtube = null;
        }

        $category_arr = [
            "name" => $data['name'],
            "image" => (!empty($request->image) ? $request->image : $category->image),
            "is_active" => $status
        ];

        $category_repo = new CategoryRepository($category);
        if ($request->hasFile('image') && $request->file('image') instanceof UploadedFile) {
            if(!empty($category->image)) {
                $category_repo->deleteFile($category->image);
            }
            $category_arr['image'] = $this->categoryRepo->saveCoverImage($request->file('image'));
        }
        $category_repo->updateCategory($category_arr);

        $sub_category_arr = [
            "category_id" => $id,
            "name" => $data['name'],
            "schedule" => $data['schedule'],
            "description" => $data['description'],
            "instagram" => $instagram,
            "whatsapp" => $whatsapp,
            "link_youtube" => $youtube,
            "is_active" => $status
        ];
        
        $sub_category_repo = new SubcategoryRepository($subcategory);
        $sub_category_repo->updateSubcategory($sub_category_arr);

        if ($request->has('old_image')) {

            $old_image = $delete_image = array();

            foreach($subcategory->subCategoryImages as $image) {
                array_push($old_image, $image->image_link);
            }

            if(!empty($data['old_image'])) {
                $delete_image = array_diff($old_image, $data['old_image']);
            }

            if( !empty($delete_image) ) {
                foreach($delete_image as $delete) {
                    $sub_category_repo->deleteFile($delete);
                    $sub_category_repo->deleteSubcategoryimage($delete);
                }
            }
        } else {
            // Delete all category images
            foreach($subcategory->subCategoryImages as $image) {
                $sub_category_repo->deleteFile($image->image_link);
            }
            $subcategory->subCategoryImages()->delete();
        }

        if ($request->has('category_images')) {

            foreach($data['category_images'] as $key => $value) {
                $sub_category_images[] = [
                    'sub_category_id'   => $id,
                    "image_link"        => $value,
                    "is_active"         => $status
                ];
                $sub_category_images[$i]['image_link'] = $this->subcategoryRepo->saveCoverImage($value);
                
                $this->subcategoryRepo->createSubcategoryimage($sub_category_images[$i]);
                $i++;
            }
        }
        
        return redirect()->route('admin.category.index')->with([
            'status'    => 'success',
            'message'   => 'Create Category successful!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepo->findCategoryById($id);
        $subcategory = $this->subcategoryRepo->findSubcategoryById($category->id);
        $set_category = new CategoryRepository($category);
        $set_sub_category = new SubcategoryRepository($subcategory);
        $message = '';
        if(!empty($category->image) ) {
            $set_category->deleteFile($category->image);
        }

        if(!empty($subcategory->subCategoryImages())) {
            foreach($subcategory->subCategoryImages as $value) {
                $set_sub_category->deleteFile($value->image_link);
            }
        }

        $message = 'Category successfully destroy';
        $set_category->deleteCategory();

        return response()->json([
            'status'      => 'success',
            'message'     => $message
        ]);
    }
}
