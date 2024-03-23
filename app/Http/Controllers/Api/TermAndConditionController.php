<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TermsAndConditions;
use Illuminate\Http\Request;
use App\Http\Requests\TermAndConditionRequest;
use App\Http\Resources\TermAndConditionListResource;
use App\Http\Resources\TermAndConditionResource;


class TermAndConditionController extends Controller
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

        $query = TermsAndConditions::query();
        $query->orderBy($sortField, $sortDirection);
        $query->where('id', "!=", 1);
        if($search) {
            $query->orWhere('title', 'like', "%{$search}%")
            ->orWhere('content', 'like', "%{$search}%");
        }

        return TermAndConditionListResource::collection($query->paginate($perPage));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(TermAndConditionRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $termAndCondition = TermsAndConditions::create($data);

        return new TermAndConditionResource($termAndCondition);
    }

    /**
     * Display the specified resource.
     */
    public function show(TermsAndConditions $termAndCondition)
    {
        return new TermAndConditionResource($termAndCondition);   
    }

    /**
     * Update the specified resource in storage.
     * 
     */
    public function update(TermAndConditionRequest $request, TermsAndConditions $termAndCondition)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $termAndCondition->update($data);

        return new TermAndConditionResource($termAndCondition);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TermsAndConditions $termAndCondition)
    {
        $termAndCondition->delete();
        return response()->noContent();
    }
}
