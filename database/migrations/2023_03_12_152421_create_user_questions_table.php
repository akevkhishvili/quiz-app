<?php

use App\Models\Question;
use App\Models\User;
use App\Models\UserQuizSession;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserQuizSession::class)
                ->constrained()
                ->CascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->CascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignIdFor(Question::class)
                ->constrained()
                ->CascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('is_correct')->nullable();
            $table->string('answer_id')->nullable();
            $table->string('confirmed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_questions');
    }
};
