<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guard_name = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'is_active'
    ];

    public function subCategory()
    {
        return $this->belongsToMany('App\Models\Catgories\Subcategories\Subcategory', 'category_id');
    }
}
