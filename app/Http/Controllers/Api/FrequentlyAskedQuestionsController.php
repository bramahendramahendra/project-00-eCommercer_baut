<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrequentlyAskedQuestions;
use App\Http\Requests\FrequentlyAskedQuestionsRequest;
use App\Http\Resources\FrequentlyAskedQuestionsListResource;
use App\Http\Resources\FrequentlyAskedQuestionsResource;

class FrequentlyAskedQuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'id');
        $sortDirection = request('sort_direction', 'asc');

        $query = FrequentlyAskedQuestions::query()
            ->where('question', 'like', "%{$search}%")
            ->orWhere('answer', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);
        
        return FrequentlyAskedQuestionsListResource::collection($query);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(FrequentlyAskedQuestionsRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $frequentlyAskedQuestion = FrequentlyAskedQuestions::create($data);

        return new FrequentlyAskedQuestionsResource($frequentlyAskedQuestion);
    }
    /**
     * Display the specified resource.
     */
    public function show(FrequentlyAskedQuestion $frequentlyAskedQuestion)
    {
        return new FrequentlyAskedQuestionsResource($frequentlyAskedQuestion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FrequentlyAskedQuestionsRequest $request, FrequentlyAskedQuestion $frequentlyAskedQuestion)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $frequentlyAskedQuestion->update($data);

        return new FrequentlyAskedQuestionsResource($frequentlyAskedQuestion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FrequentlyAskedQuestion $frequentlyAskedQuestion)
    {
        $frequentlyAskedQuestion->delete();
        return response()->noContent();
    }
}
