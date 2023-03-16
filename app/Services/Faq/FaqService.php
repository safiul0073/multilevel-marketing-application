<?php

namespace App\Services\Faq;

use App\Models\Answer;
use App\Models\Question;
use App\Services\TryCatchBlock;
use App\Traits\Formatter;
use Illuminate\Support\Facades\DB;

class FaqService {

    use Formatter;

    public function store (array $att) {

        try {
            DB::beginTransaction();
            $qusId = Question::insertGetId([
                'question' => $att['question']
            ]);

            Answer::create([
                'question_id' => $qusId,
                'ans' => $att['ans'],
                'status' => isset($att['status']) ? $att['status'] : 1
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }
        return $this->withSuccess('Successfully created.');
    }

    public function update (array $att, Answer $answer) {

        try {
            DB::beginTransaction();
            $answer->update([
                'ans' => $att['ans'],
                'status' =>  isset($att['status']) ? $att['status'] : 1
            ]);

            $answer->question()->update([
                'question' => $att['question']
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }
        return $this->withSuccess('Successfully updated.');
    }
}
