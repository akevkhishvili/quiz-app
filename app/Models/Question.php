<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function QuestionMode(): HasOne
    {
        return $this->hasOne(QuestionMode::class, 'id', 'question_mode_id');
    }

    public function answer(): HasMany
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }

}
