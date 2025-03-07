<?php

namespace App\Http\Controllers;

use App\Models\Quizze;
use App\Models\QuizzeResult;
use Auth;
use Illuminate\Http\Request;
use App\Models\Quastion;

class CandidatController extends Controller
{
    public function getWelcome()
    {
        return view('candidat.welcome');
    }
    public function getHome()
    {
        return view('candidat.home');
    }
    public function getReady()
    {
        return view('candidat.ready');
    }
    public function getTest()
    {
        return view('candidat.test');
    }
    public function getQestion($number)
    {
        $quizze = Quizze::where('status', true)->with('quastions.answers')->first();

        if (!$quizze) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $data = $quizze->quastions->skip($number - 1)->first();

        if (!$data) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        return response()->json($data);
    }
    public function submit_quiz(Request $request)
    {
        $candidatId = Auth::user()->candidat->id;
        $answers = json_decode($request->answers, true);
        // dd($request);
        foreach ($answers as $answer) {
            QuizzeResult::create([
                'candidat_id' => $candidatId,
                'answer_id' => $answer['answer_id'],
            ]);
        }
        return redirect('/quiz/result')->with('success', 'Quizze enregistrées avec succès!');
    }

    public function results()
    {
        $candidatId = Auth::user()->candidat->id;
        $results = QuizzeResult::where('candidat_id', $candidatId)->with('answer')->get();

        $correctAnswersCount = $results->filter(function ($result) {
            return $result->answer->is_correct;
        })->count();
        return view('candidat.result', compact('correctAnswersCount'));
    }

}
