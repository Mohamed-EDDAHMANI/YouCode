<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizze extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
    ];

    public function quastion()
    {
        return $this->belongsToMany(Quastion::class, 'quastion_quizze');
    }
}
