<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    protected $fillable = [
        'type_id',
        'code', 'code' ,'title', 'description', 
        'image', 'image_mime', 'image_size', 'price_retail', 'quantity_limit', 'price_wholesale', 'unit_id', 'material_id',
        'weight',
        'unit_weight_id',
        'contents_per_box',
        'unit_contents_per_box_id',
        'grade',
        'thread_direction_id',
        'thread_density_id',
        'diameter',
        'inner_diameter',
        'outer_diameter',
        'unit_diameter_id',
        'length',
        'unit_length_id',
        'thick_head',
        'unit_thick_head_id',
        'drat_length',
        'unit_drat_length_id',
        'drat_size',
        'dimensional_standart',
        'head_style',
        'drive_type',
        'across_flats',
        'drat_type',
        'color_id',
        'published', 'created_by', 'updated_by'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions 
    {
        return SlugOptions::create()    
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName() 
    {
        return  'slug';
    }

    // public function type(): HasOne
    // {
    //     return $this->hasOne(Type::class, 'id', 'type_id');
    // }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    // public function unit(): HasOne
    // {
    //     return $this->hasOne(Unit::class, 'id', 'unit_id');
    // }    

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    // public function material(): HasOne
    // {
    //     return $this->hasOne(Material::class, 'id', 'material_id');
    // }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    // public function threadDensity(): HasOne
    // {
    //     return $this->hasOne(ThreadDensity::class, 'id', 'thread_density_id');
    // }

    public function threadDensity(): BelongsTo
    {
        return $this->belongsTo(ThreadDensity::class, 'thread_density_id');
    }

    // public function threadDirection(): HasOne
    // {
    //     return $this->hasOne(ThreadDirection::class, 'id', 'thread_direction_id');
    // }

    public function threadDirection(): BelongsTo
    {
        return $this->belongsTo(ThreadDirection::class, 'thread_direction_id');
    }

    // public function color(): HasOne
    // {
    //     return $this->hasOne(Color::class, 'id', 'color_id');
    // }
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    // public function weightUnit(): HasOne
    // {
    //     return $this->hasOne(Unit::class, 'id', 'unit_weight_id');
    // }

    public function weightUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_weight_id');
    }

    // public function contentsPerBoxUnit(): HasOne
    // {
    //     return $this->hasOne(Unit::class, 'id', 'unit_contents_per_box_id');
    // }

    public function contentsPerBoxUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_contents_per_box_id');
    }

    // public function diameterUnit(): HasOne
    // {
    //     return $this->hasOne(Unit::class, 'id', 'unit_diameter_id');
    // }

    public function diameterUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_diameter_id');
    }

    // public function lengthUnit(): HasOne
    // {
    //     return $this->hasOne(Unit::class, 'id', 'unit_length_id');
    // }

    public function lengthUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_length_id');
    }

    // public function thickHeadUnit(): HasOne
    // {
    //     return $this->hasOne(Unit::class, 'id', 'unit_thick_head_id');
    // }

    public function thickHeadUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_thick_head_id');
    }

    // public function dratLengthUnit(): HasOne
    // {
    //     return $this->hasOne(Unit::class, 'id', 'unit_drat_length_id');
    // }

    public function dratLengthUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_drat_length_id');
    }

    public function orderItem(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

     /**
     * Mendapatkan kategori dengan setidaknya satu produk.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getTopSellingProducts($limit = 4)
    {
        return self::query()
            ->select(
                'products.id',
                'products.code',
                'products.title',
                'products.slug',
                'products.image',
                DB::raw('IFNULL(SUM(oi.quantity), 0) as total_quantity'),
                DB::raw('MAX(oi.updated_at) as last_update')
            )
            ->leftJoin('order_items as oi', 'products.id', '=', 'oi.product_id')
            ->groupBy('products.id', 'products.code','products.title', 'products.slug', 'products.image')
            ->orderByDesc('total_quantity')
            ->orderByDesc('last_update')
            ->limit($limit);
    }
}

