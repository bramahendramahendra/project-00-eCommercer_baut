<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Http\Requests\MaterialRequest;
use App\Http\Resources\MaterialListResource;
use App\Http\Resources\MaterialResource;

class MaterialController extends Controller
{
    public function getOptionMaterials()
    {
        $materials = Material::all(['id', 'name']);
        return MaterialListResource::collection($materials);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search', false);
        $perPage = request('per_page', 10);
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Material::query();
        $query->orderBy($sortField, $sortDirection);
        if($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return MaterialListResource::collection($query->paginate($perPage));
        // return MaterialListResource::collection(Material::query()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $material = Material::create($data);

        return new MaterialResource($material);
        // return new MaterialResource(Material::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return new MaterialResource($material);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialRequest $request, Material $material)
    {

        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $material->update($data);
        // $material->update($request->validated());
        return new MaterialResource($material);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        // Cek jika Material memiliki Product
        if ($material->product()->count() > 0) {
            // Lempar Exception dengan pesan error
            throw new \Exception("Material ini memiliki product terkait dan tidak dapat dihapus.");
            // return response()->json(['error' => 'Kategori ini memiliki tipe terkait dan tidak dapat dihapus.'], 409);
        }
        
        $material->delete();
        return response()->noContent();
    }
}