<?php

namespace App\Http\Controllers;

use App\Models\QuestionModel;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function add() {
        return view('add-question');
    }

    public function create(Request $request){
        $form = $request->validate([
            'question' => 'required',
            'user_id' => 'required',
        ]);
        QuestionModel::create($form);
        return redirect('/home');
    }

    public function edit(QuestionModel $question) {
        return view('edit-question', ['question' => $question]);
    }

    public function update(Request $request, QuestionModel $question){
        $form = $request->validate([
            'question' => 'required',
            'user_id' => 'required',
        ]);
        $question->update($form);
        return redirect('/home');
    }

    public function delete(QuestionModel $question){
        $form = ([
            'question' => $question['question'],
            'user_id' => $question['user_id'],
            'active' => false,
        ]);
        $question->update($form);
        return redirect('/home');
    }
}
