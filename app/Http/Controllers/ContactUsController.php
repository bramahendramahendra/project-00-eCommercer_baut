<?php

namespace App\Http\Controllers;

use App\Enums\ContactStatus;
use App\Http\Requests\ContactUsRequest;
use App\Models\InformationCompany;
use App\Models\ContactMe;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(Request $request) {
        $informationCompany = InformationCompany::where('id', 1)->get();

        // dump($informationCompany);
        // exit;
        return view('contact_us.index', compact('informationCompany'));
    }

    public function create(ContactUsRequest $request)
    {
        $ContactUsData = $request->validated();

        $data = $ContactUsData;
        // $data['status'] = 'unread'; 
        $data['status'] = ContactStatus::Unread;

        // var_dump($data);
        // exit;

        ContactMe::create($data);

        $request->session()->flash('flash_message', 'berhasil terkirim.');

        return redirect()->back();
        // return new CategoryResource(Category::create($request->validated()));
        // $data = $request->validated();
        // $data['created_by'] = $request->user()->id;
        // $data['updated_by'] = $request->user()->id;

        // $category = Category::create($data);

        // return new CategoryResource($category);
    }
}
