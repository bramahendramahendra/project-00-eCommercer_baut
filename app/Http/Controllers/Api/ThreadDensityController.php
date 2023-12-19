<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ThreadDensity;
use App\Http\Requests\ThreadDensityRequest;
use App\Http\Resources\ThreadDensityListResource;
use App\Http\Resources\ThreadDensityResource;

class ThreadDensityController extends Controller
{
    public function getOptionThreadDensities()
    {
       return ThreadDensity::all(['id', 'name']);
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

        $query = ThreadDensity::query();
        $query->orderBy($sortField, $sortDirection);
        if($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return ThreadDensityListResource::collection($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ThreadDensityRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $threadDensity = ThreadDensity::create($data);

        return new ThreadDensityResource($threadDensity);
    }

    /**
     * Display the specified resource.
     */
    public function show(ThreadDensity $threadDensity)
    {
        return new ThreadDensityResource($threadDensity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ThreadDensityRequest $request, ThreadDensity $threadDensity)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $threadDensity->update($data);

        return new ThreadDensityResource($threadDensity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThreadDensity $threadDensity)
    {
        if ($threadDensity->product()->count() > 0) {
            throw new \Exception("Thread Density ini memiliki product terkait dan tidak dapat dihapus.");
        }
        $threadDensity->delete();
    }
}
