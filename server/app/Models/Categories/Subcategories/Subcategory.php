<?php

namespace App\Models\Categories\Subcategories;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $guard_name = 'subcategories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'schedule',
        'link_youtube',
        'instagram',
        'whatsapp',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Catgories\Category', 'category_id');
    }

    public function subCategoryImages()
    {
        return $this->hasMany('App\Models\Categories\Subcategories\Subcategoryimage', 'sub_category_id');
    }
}
