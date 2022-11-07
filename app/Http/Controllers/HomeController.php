<?php

namespace App\Http\Controllers;

use App\Models\QuestionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {   
        $user = Auth::user();
        $questions = DB::table('question')
                        ->join('users', 'users.id', '=', 'question.user_id')
                        ->where('question.active', '=', '1')
                        ->orderByRaw('question.created_at DESC')->get([
                            'question.id', 
                            'question',  
                            'user_id', 
                            'name', 
                            'email', 
                            'question.created_at',
                        ]);

        return view('index', ['user' => $user, 'questions' => $questions]);
    }

    public function homeFilter(Request $request)
    {   
        $date = 'DESC';
        $searchQuestion = '';
        $searchName = '';
        if (isset($request->date)) {
            $date = $request->date;
        }
        if (isset($request->search)) {
            $searchName = $request->search;
        }
        $user = Auth::user();
        $questions = DB::table('question')
                        ->join('users', 'users.id', '=', 'question.user_id')
                        ->where('question.active', '=', '1')
                        ->where('users.name', 'LIKE', '%' . $searchName . '%')
                        ->orderByRaw('question.created_at ' . $date)->get([
                            'question.id', 
                            'question',  
                            'user_id', 
                            'name', 
                            'email', 
                            'question.created_at',
                        ]);

        return view('index', ['user' => $user, 'questions' => $questions, 'date' => $date]);
    }
}
