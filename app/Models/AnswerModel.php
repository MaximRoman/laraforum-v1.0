<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerModel extends Model
{
    use HasFactory;
    protected $table = 'answer';
    protected $fillable = ['answer', 'question_id', 'answer_user_id', 'active'];
}
