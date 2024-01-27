<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FileUploadHelper;
use App\Http\Controllers\Controller;
use App\Models\InformationCompany;
use Illuminate\Http\Request;
use App\Http\Requests\InformationCompanyRequest;
use App\Http\Resources\InformationCompanyResource;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class InformationCompanyController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $query = InformationCompany::query()
            ->where('id', "=", 1)
            ->get();

         return InformationCompanyResource::collection($query);
    }

    /**
     * Update the specified resource in storage.
     * 
     */
    public function update(InformationCompanyRequest $request, InformationCompany $informationCompany)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $data['image'] ?? null;

         if($image) {
            $relativePath = FileUploadHelper::saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();

            if($informationCompany->imaage) {
                Storage::deleteDirectory('/public/' . dirname($informationCompany->image));
            }
        }

        $informationCompany->update($data);

        return new InformationCompanyResource($informationCompany);
    }
}
