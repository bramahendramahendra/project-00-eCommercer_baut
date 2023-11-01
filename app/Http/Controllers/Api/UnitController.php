<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Http\Requests\UnitRequest;
use App\Http\Resources\UnitListResource;
use App\Http\Resources\UnitResource;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search', false);
        $perPage = request('per_page', 10);
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Unit::query();
        $query->orderBy($sortField, $sortDirection);
        if($search) {
            $query->where('short_name', 'like', "%{$search}%")
            ->orWhere('full_name', 'like', "%{$search}%")
            ->orWhere('symbol', 'like', "%{$search}%");
        }

        return UnitListResource::collection($query->paginate($perPage));
        
        // return UnitListResource::collection(Unit::query()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $unit = Unit::create($data);

        return new UnitResource($unit);

        // return new UnitResource(Unit::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        return new UnitResource($unit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, Unit $unit)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $unit->update($data);
        // $unit->update($request->validated());
        return new UnitResource($unit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        // Cek jika Unit memiliki Product
        if ($unit->product()->count() > 0) {
            // Lempar Exception dengan pesan error
            throw new \Exception("Unit ini memiliki tipe terkait dan tidak dapat dihapus.");
            // return response()->json(['error' => 'Kategori ini memiliki tipe terkait dan tidak dapat dihapus.'], 409);
        }

        $unit->delete();
        return response()->noContent();
    }
}
