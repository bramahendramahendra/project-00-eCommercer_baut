<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = ['code', 'name', 'description', 'created_by', 'updated_by'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions 
    {
        return SlugOptions::create()    
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function type()
    {
        return $this->hasMany(Type::class);
    }

    /**
     * Mendapatkan produk melalui tipe yang terkait dengan kategori ini.
     */
    public function product()
    {
        return $this->hasManyThrough(Product::class, Type::class);
    }
}
