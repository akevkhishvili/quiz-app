<?php

namespace App\Console\Commands;

use App\Actions\CalculateQuizScore;
use App\Models\UserQuizSession;
use Illuminate\Console\Command;

class FinishQuiz extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'finish:quiz';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command will finish all unsaved quiz when start date is 55 min behind';

    /**
     * Execute the console command.
     */
    public function handle(CalculateQuizScore $calculate): void
    {
        $quiz_sessions = UserQuizSession::query()
            ->whereNull('total_quiz_time')
            ->get();
        foreach ($quiz_sessions as $session) {
            $calculate($session);
        }
    }
}
