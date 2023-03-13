<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['is_correct'];

    public function question(): BelongsTo
    {
        return $this->belongsTo(question::class, 'id', 'question_id');
    }
}
