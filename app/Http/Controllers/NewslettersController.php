<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Newsletters;
use App\Http\Requests\NewslettersRequest;
use Illuminate\Http\Request;

class NewslettersController extends Controller
{
    //  public function create(Request $request)
     public function create(NewslettersRequest $request)
    {
        $NewslettersData = $request->validated();
        $email = $NewslettersData['email'];

        $data = [
            'email' => $email,
            'is_registered' => User::where('email', $email)->exists() ? 1 : 0
        ];

        Newsletters::create($data);

        $request->session()->flash('flash_message', 'berhasil terkirim.');

        return redirect()->back();
    }
}
