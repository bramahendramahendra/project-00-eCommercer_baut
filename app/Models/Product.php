<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Product extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = ['code' ,'title', 'description', 'image', 'image_mime', 'image_size', 'price_retail', 'created_by', 'updated_by'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions 
    {
        return SlugOptions::create()    
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function threadDensity()
    {
        return $this->belongsTo(ThreadDensity::class);
    }

    public function threadDirection()
    {
        return $this->belongsTo(ThreadDirection::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function weightUnit()
    {
        return $this->belongsTo(Unit::class, 'unit_weight_id');
    }

    public function contentsPerBoxUnit()
    {
        return $this->belongsTo(Unit::class, 'unit_contents_per_box_id');
    }

    public function diameterUnit()
    {
        return $this->belongsTo(Unit::class, 'unit_diameter_id');
    }

    public function lengthUnit()
    {
        return $this->belongsTo(Unit::class, 'unit_length_id');
    }

    public function thickHeadUnit()
    {
        return $this->belongsTo(Unit::class, 'unit_thick_head_id');
    }

    public function dratLengthUnit()
    {
        return $this->belongsTo(Unit::class, 'unit_drat_length_id');
    }

}
