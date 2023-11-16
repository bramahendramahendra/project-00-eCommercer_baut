<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeListResource;
use App\Http\Resources\TypeResource;

class TypeController extends Controller
{
    public function getOptionTypes()
    {
        $types = Type::all(['id', 'code', 'name']);
        return TypeListResource::collection($types);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return TypeListResource::collection(Type::query()->paginate(10));
        $search = request('search', false);
        $perPage = request('per_page', 10);
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Type::query();
        $query->orderBy($sortField, $sortDirection);
        if($search) {
            $query->where('code', 'like', "%{$search}%")
            ->orWhere('name', 'like', "%{$search}%");
        }

        return TypeListResource::collection($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $type = Type::create($data);

        return new TypeResource($type);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return new TypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        $type->update($request->validated());
        $data['updated_by'] = $request->user()->id;

        $type->update($data);
        return new TypeResource($type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        // Cek jika Unit memiliki Product
        if ($unit->product()->count() > 0) {
            // Lempar Exception dengan pesan error
            throw new \Exception("Unit ini memiliki tipe terkait dan tidak dapat dihapus.");
            // return response()->json(['error' => 'Kategori ini memiliki tipe terkait dan tidak dapat dihapus.'], 409);
        }
        
        $type->delete();
        return response()->noContent();
    }
}
