<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Type extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = ['code', 'name', 'description', 'category_id', 'created_by', 'updated_by'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions 
    {
        return SlugOptions::create()    
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Mendapatkan produk melalui tipe yang terkait dengan kategori ini.
     */
    // public function products()
    // {
    //     return $this->hasManyThrough(Product::class);
    // }
}
