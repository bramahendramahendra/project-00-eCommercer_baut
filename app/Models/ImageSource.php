<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;   

class ImageSource extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['name' ,'image', 'image_mime', 'image_size', 'updated_by'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions 
    {
        return SlugOptions::create()    
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
