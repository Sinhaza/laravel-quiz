<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id', 'text', 'type'];


    public function quizzes() {
        return $this->belongsToMany(Quiz::class);
    }
    
    public function options()
    {
        return $this->belongsToMany(QuestionOption::class, 'question_question_option')->withPivot('is_correct');
    }
}
