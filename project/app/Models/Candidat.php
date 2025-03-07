<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;

    protected $table = 'candidat';
    protected $fillable = [
        'phone',
        'address',
        'dateBorn',
        'cin',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function answer()
    {
        return $this->belongsToMany(Answer::class, 'quizze_result');
    }
}
