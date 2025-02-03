<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;

    protected $fillable = ['text'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_question_option');
    }
}
