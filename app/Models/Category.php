<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    //
	use Sluggable;
	
	protected $table = 'categories';
	
	protected $fillable = ['id','title']; 

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => false,
            ]
        ];
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }


}
