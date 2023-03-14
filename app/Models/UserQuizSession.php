<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserQuizSession extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user_question(): HasOne
    {
        return $this->hasOne(UserQuestion::class, 'user_quiz_session_id', 'id');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
