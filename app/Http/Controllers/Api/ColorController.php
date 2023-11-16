<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Http\Requests\ColorRequest;
use App\Http\Resources\ColorListResource;
use App\Http\Resources\ColorResource;

class ColorController extends Controller
{
    public function getOptionColors()
    {
        $colors = Color::all(['id', 'name']);
        return ColorListResource::collection($colors);
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

        $query = Color::query();
        $query->orderBy($sortField, $sortDirection);
        if($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return ColorListResource::collection($query->paginate($perPage));
        // return ColorListResource::collection(Color::query()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $color = Color::create($data);

        return new ColorResource($color);
        // return new ColorResource(Color::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        return new ColorResource($color);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, Color $color)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $color->update($data);
        // $color->update($request->validated());
        return new ColorResource($color);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        // Cek jika Color memiliki Product
        if ($color->product()->count() > 0) {
            // Lempar Exception dengan pesan error
            throw new \Exception("Warna ini memiliki product terkait dan tidak dapat dihapus.");
            // return response()->json(['error' => 'Kategori ini memiliki tipe terkait dan tidak dapat dihapus.'], 409);
        }

        $color->delete();
        return response()->noContent();
    }
}
