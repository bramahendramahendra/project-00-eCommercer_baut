<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryListResource;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function getOptionCategories()
    {
        // $categories = Category::all(['id', 'code', 'name']);
        
        // return response()->json($categories);
        // return CategoryListResource::collection($categories);
        // return CategoryListResource::all($query->paginate($perPage));

        return Category::all(['id', 'name']);
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Category::query()
            ->where('code', 'like', "%{$search}%")
            ->orWhere('name', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);
        
        return CategoryListResource::collection($query);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // return new CategoryResource(Category::create($request->validated()));
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $category = Category::create($data);

        return new CategoryResource($category);
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // $category->update($request->validated());
        // return new CategoryResource($category);

        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $category->update($data);

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Cek jika kategori memiliki tipe
        if ($category->type()->count() > 0) {
            // Lempar Exception dengan pesan error
            throw new \Exception("Kategori ini memiliki tipe terkait dan tidak dapat dihapus.");
            // return response()->json(['error' => 'Kategori ini memiliki tipe terkait dan tidak dapat dihapus.'], 409);
        }

        $category->delete();
        return response()->noContent();
    }
}
