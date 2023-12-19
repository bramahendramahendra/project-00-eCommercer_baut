<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ThreadDirection;
use App\Http\Requests\ThreadDirectionRequest;
use App\Http\Resources\ThreadDirectionListResource;
use App\Http\Resources\ThreadDirectionResource;

class ThreadDirectionController extends Controller
{
    public function getOptionThreadDirections()
    {
        return ThreadDirection::all(['id', 'name']);
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

        $query = ThreadDirection::query();
        $query->orderBy($sortField, $sortDirection);
        if($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return ThreadDirectionListResource::collection($query->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ThreadDirectionRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $threadDirection = ThreadDirection::create($data);

        return new ThreadDirectionResource($threadDirection);
    }

    /**
     * Display the specified resource.
     */
    public function show(ThreadDirection $threadDirection)
    {
        return new ThreadDirectionResource($threadDirection);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ThreadDirectionRequest $request, ThreadDirection $threadDirection)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $threadDirection->update($data);

        return new ThreadDirectionResource($threadDirection);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThreadDirection $threadDirection)
    {
        if ($threadDirection->product()->count() > 0) {
            throw new \Exception("Thread Direction ini memiliki product terkait dan tidak dapat dihapus.");
        }

        $threadDirection->delete();
        return response()->noContent();
    }
}
