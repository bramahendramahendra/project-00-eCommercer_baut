<?php

namespace App\Http\Controllers;

use App\Models\TermsAndConditions;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function index(Request $request) {
        $descTermsAndCondition = TermsAndConditions::where('id', 1)->get();
        $termsAndConditions = TermsAndConditions::whereNot('id', 1)->get();

        // dump($descTermsAndCondition);
        // dump($termsAndConditions);
        // exit;

        return view('terms_and_conditions.index', compact('descTermsAndCondition', 'termsAndConditions'));

    }
}
