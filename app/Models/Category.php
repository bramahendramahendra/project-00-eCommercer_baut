<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\DB;

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

    public function type(): HasMany
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

    /**
     * Mendapatkan kategori dengan setidaknya satu produk.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getShopByCategory($limit = 5)
    {
        return self::query()
            ->select('categories.id', 'categories.name', 'categories.slug')
            ->selectSub(function ($query) {
                $query->select('image')
                    ->from('products')
                    ->join('types', 'products.type_id', '=', 'types.id')
                    ->whereColumn('types.category_id', 'categories.id')
                    ->orderBy('products.updated_at', 'desc')
                    ->limit(1);
            }, 'image')
            ->selectSub(function ($query) {
                $query->selectRaw('MAX(products.updated_at)')
                    ->from('products')
                    ->join('types', 'products.type_id', '=', 'types.id')
                    ->whereColumn('types.category_id', 'categories.id');
            }, 'latest_update')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('types')
                    ->join('products', 'products.type_id', '=', 'types.id')
                    ->whereColumn('types.category_id', 'categories.id');
            })
            ->with('type')
            ->groupBy('categories.id', 'categories.code', 'categories.name', 'categories.slug', 'categories.description')
            ->orderBy('latest_update', 'desc')
            ->limit($limit);
    }

  
}
