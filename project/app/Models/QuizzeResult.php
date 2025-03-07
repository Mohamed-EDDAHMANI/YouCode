<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizzeResult extends Model
{
    use HasFactory;

    protected $table = 'quizze_result';

    protected $fillable = ['candidat_id', 'answer_id'];

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
}
