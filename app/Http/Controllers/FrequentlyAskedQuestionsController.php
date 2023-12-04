<?php

namespace App\Http\Controllers;

use App\Models\FrequentlyAskedQuestions;
use Illuminate\Http\Request;

class FrequentlyAskedQuestionsController extends Controller
{
      public function index(Request $request) {
        $frequentlyAskedQuestions = FrequentlyAskedQuestions::get();

        // dump($frequentlyAskedQuestions);
        // exit;

        return view('frequently_asked_questions.index', compact('frequentlyAskedQuestions'));
    }
}
