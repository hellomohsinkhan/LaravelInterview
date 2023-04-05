<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    //
	use Sluggable;
	
	protected $table = 'products';
	
	protected $fillable = ['id','title','description','featured_image','gallery']; 

	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => false,
            ]
        ];
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

}
