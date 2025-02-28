<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'is_correct',
        'quastion_id',
    ];

    public function quastion()
    {
        return $this->hasOne(Quastion::class, 'quastion_quizze');
    }

    public function candidat()
    {
        return $this->belongsToMany(Candidat::class, 'quizze_result');
    }
}
