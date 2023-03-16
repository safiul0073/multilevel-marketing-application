<?php

namespace App\Services\Faq;

use App\Models\Answer;
use App\Models\Question;
use App\Services\TryCatchBlock;
use App\Traits\Formatter;

class FaqService {

    use Formatter;

    public function store (array $att) {

        TryCatchBlock::withDBBlock(function () use($att) {
            $qusId = Question::insertGetId([
                'question' => $att['question']
            ]);

            Answer::create([
                'question_id' => $qusId,
                'ans' => $att['ans'],
                'status' => isset($att['status']) ? $att['status'] : 1
            ]);
            
        });
    }
}
