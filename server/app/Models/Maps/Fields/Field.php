<?php

namespace App\Models\Maps\Fields;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'field';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'area_name'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function markers()
    {
        return $this->belongsTo('App\Models\Maps\Markers\Marker', 'id');
    }
}
