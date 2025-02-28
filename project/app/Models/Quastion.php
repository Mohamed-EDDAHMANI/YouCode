<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quastion extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'type',
    ];

    public function quizze()
    {
        return $this->belongsToMany(Quizze::class, 'quastion_quizze');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class, 'quastion_quizze');
    }
}
