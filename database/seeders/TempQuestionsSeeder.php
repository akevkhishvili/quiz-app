<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class TempQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array =  range(1,10);

        foreach($array as $value){
            $question = Question::create([
                "question"=>"1 + $value = " . 1 + $value,
                'question_mode_id'=>1,
            ]);

           foreach([1,2] as $item){
               $is_correct = $item;
               if($item != 1){
                   $is_correct = null;
               }
               Answer::create([
                   'question_id'=>$question->id,
                   'text'=>$item + $value,
                   'is_correct'=>$is_correct,
               ]);
           }
        }

        $question = Question::create([
            "question"=>"5 + 6 = ?",
            'question_mode_id'=>2,
        ]);

        foreach(['answer_one', 'answer_two', 'answer_tree'] as  $index => $item){
            $is_correct = null;
            if ($item == "answer_two") {
                $is_correct = 1;
            }
               Answer::create([
                   'question_id'=>$question->id,
                   'text'=>$index + 10,
                   'is_correct'=>$is_correct,
               ]);
           }
    }
}
