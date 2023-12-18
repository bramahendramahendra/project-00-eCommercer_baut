<?php

namespace App\Http\Controllers\Api;

use App\Enums\ContactStatus;
use App\Http\Controllers\Controller;
use App\Models\ContactMe;
use App\Http\Resources\ContactUsListResource;
use App\Http\Resources\ContactUsResource;
use Illuminate\Http\Request;

class ContactUsController extends Controller
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
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = ContactMe::query()
            ->where('id', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);
        
        return ContactUsListResource::collection($query);
    }

    public function view(ContactMe $contactUs) 
    {
        return new ContactUsResource($contactUs);   
    }

    public function getStatuses() 
    {
        return ContactStatus::getStatuses();
    }

    public function changeStatus(ContactMe $contactUs, $status) 
    {
        $contactUs->status = $status;
        $contactUs->save();

        return response('', 200);
    }
}
