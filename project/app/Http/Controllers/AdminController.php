<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Quastion;
use App\Models\Quizze;


class AdminController extends Controller
{
    public function dashboard()
    {
        $questions = Quastion::with('answers')->get();
        $quizzes = Quizze::with('quastions')->get();
        return view('admin.dashboard', compact('questions', 'quizzes'));
    }

    public function storeQuastion(StoreQuestionRequest $request)
    {
        $question = Quastion::create([
            'designation' => $request->questionDesignation,
            'type' => $request->type,
        ]);

        $responses = [];

        if ($request->type === 'choices') {
            // Handling multiple-choice questions (2 to 4 responses)
            foreach ($request->designation as $index => $designation) {
                $responses[] = [
                    'designation' => $designation,
                    'is_correct' => ($index == $request->is_correct) ? 1 : 0
                ];
            }
        } elseif ($request->type === 'bool') {
            $responses = [
                [
                    'designation' => 'True',
                    'is_correct' => (0 == $request->is_correct) ? 1 : 0
                ],
                [
                    'designation' => 'False',
                    'is_correct' => (1 == $request->is_correct) ? 1 : 0
                ]
            ];
        }

        $question->answers()->createMany($responses);

        return redirect()->back()->with('success', 'Question et réponses enregistrées avec succès!');
    }
    public function edit($id)
    {
        $question = Quastion::findOrFail($id); // Find the question by ID
        return view('layouts.editQuestion', compact('question'));
    }
    public function createPage()
    {
        return view('layouts.createQuestion');
    }
    public function update(StoreQuestionRequest $request, $id)
    {
        $question = Quastion::with('answers')->findOrFail($id);
        $question->update([
            'designation' => $request->input(key: 'questionDesignation'),
        ]);
        if ($question->type === 'choices') {
            foreach ($request->response as $index => $designation) {
                $question->answers[$index]->update([
                    'designation' => $designation,
                    'updated_at' => now(),
                ]);

            }
        }
        return redirect()->back()->with('success', 'Question et modifier avec succès!');
    }
    public function destroy()
    {
    }
    public function createQuize()
    {
        $questions = Quastion::with('answers')->get();
        return view('layouts.createQuize', compact('questions'));
    }

    public function quizzesStore(Request $request)
    {
        $quizze = Quizze::create([
            'title' => $request->title,
            'type' => $request->type,
        ]);

        $quizze->quastions()->attach($request->selected_questions);

        return redirect()->back()->with('success', 'Quizze enregistrées avec succès!');

    }

    public function quizzesDelete($id)
    {
        // Find the Quizze by ID
        $quizze = Quizze::find($id);

        if (!$quizze) {
            return redirect()->back()->with('error', 'Quizze non trouvé!');
        }

        $quizze->quastions()->detach();

        $quizze->delete();

        return redirect()->back()->with('success', 'Quizze supprimé avec succès!');
    }

    public function quizzesView($id)
    {
        $quiz = Quizze::with('quastions')->find($id);
        return view('layouts.quiz_view', compact('quiz'));
    }

    public function toggleStatus($id)
    {
        Quizze::query()->update(['status' => false]);

        $quiz = Quizze::find($id);

        if ($quiz) {
            $quiz->status = true;
            $quiz->save();
        }

        return redirect()->back()->with('success', 'Statut du quizze modifié avec succès!');
    }
}
