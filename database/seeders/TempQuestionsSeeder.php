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

        //dd($array);

        foreach($array as $value){
            $question = Question::create([
                "question"=>"1 + $value = " . 1 + $value,
                'question_mode_id'=>1,
            ]);

           foreach([1,2] as $item){
               Answer::create([
                   'question_id'=>$question->id,
                   'text'=>$item + $value,
                   'is_correct'=>$item,
               ]);
           }
        }
    }
}
