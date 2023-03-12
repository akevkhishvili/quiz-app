<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserQuestion extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->hasOne(Question::class, 'id', 'question_id');
    }

    public function answer(): HasMany
    {
        return $this->hasMany(Answer::class, 'question_id', 'question_id');
    }

    public function user_question_session()
    {
        return $this->hasOne(UserQuizSession::class, 'id', 'this_table_related_id');
    }
}
