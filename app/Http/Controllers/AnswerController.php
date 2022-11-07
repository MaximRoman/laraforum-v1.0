<?php

namespace App\Http\Controllers;

use App\Models\QuestionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AnswerModel;

class AnswerController extends Controller
{
    public function add(QuestionModel $question) {
        return view('add-answer', ['question' => $question]);
    }

    public function create(Request $request) {
        $form = $request->validate([
            'answer' => 'required',
            'question_id' => 'required',
            'answer_user_id' => 'required',
        ]);
        AnswerModel::create($form);
        return redirect('/answers' . '/' . $request->question_id);
    }

    public function edit(AnswerModel $answer) {
        $question = DB::table('question')
                            ->join('users', 'users.id', '=', 'question.user_id')
                            ->where('question.id', '=', $answer->question_id)
                            ->get([
                                'question.id', 
                                'question',  
                                'user_id', 
                                'name', 
                                'email', 
                                'question.created_at',
                            ]);
        return view('edit-answer', ['answer' => $answer, 'question' => $question]);
    }

    public function update(Request $request, AnswerModel $answer) {
        $form = $request->validate([
            'answer' => 'required',
            'question_id' => 'required',
            'answer_user_id' => 'required',
        ]);
        $answer->update($form);
        return redirect('/answers' . '/' . $request->question_id);
    }

    public function delete(AnswerModel $answer) {
        $form = ([
            'answer' => $answer->answer,
            'question_id' => $answer->question_id,
            'answer_user_id' => $answer->answer_user_id,
            'active' => false,
        ]);
        $answer->update($form);
        return redirect('/answers' . '/' . $answer->question_id);
    }

    public function show(Request $request, QuestionModel $question){
        $date = 'DESC';
        if (isset($request->date)) {
            $date = $request->date;
        }
        $user = Auth::user();
        $answers = DB::table('answer')
                        ->join('users', 'users.id', '=', 'answer.answer_user_id')
                        ->where('answer.question_id', '=', $question->id)
                        ->where('answer.active', '=', '1')
                        ->orderByRaw('answer.created_at ' . $date)
                        ->get([
                            'answer.id',
                            'answer.answer',
                            'users.name',
                            'answer.answer_user_id',
                            'answer.created_at',
                        ]);
        $questionUser = DB::table('users')
                            ->join('question', 'users.id', '=', 'question.user_id')
                            ->where('question.id', '=', $question->user_id)
                            ->get(['name']);
        return view('answers', ['question' => $question, 'answers' => $answers, 'user' => $user, 'questionUser' => $questionUser, 'date' => $date]);
    }
}
