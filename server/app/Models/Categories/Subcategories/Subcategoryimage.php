<?php

namespace App\Models\Categories\Subcategories;

use Illuminate\Database\Eloquent\Model;

class Subcategoryimage extends Model
{
    protected $guard_name = 'subcategoryimages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sub_category_id',
        'image_link',
        'is_active'
    ];

    public function subCategory() {
        return $this->belongsTo('App\Models\Categories\Subcategories\Subcategory', 'sub_category_id');
    }
}
