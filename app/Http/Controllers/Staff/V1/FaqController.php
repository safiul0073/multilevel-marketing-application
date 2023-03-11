<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    use Formatter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 10;
        if (request()->perPage) {
            $perPage = request()->perPage;
        }
        $blog = Answer::with('image')->orderBy('id', 'DESC')->paginate($perPage);

        return $this->withSuccess($blog);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $att = $this->validate($request, [
            'question' => 'required|string',
            'ans'      => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            $qusId = Question::insertGetId([
                'question' => $att['question']
            ]);

            Answer::create([
                'question_id' => $qusId,
                'ans' => $att['ans']
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withSuccess($ex->getMessage());
        }

        return $this->withSuccess('Successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        return $this->withSuccess($answer->load('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $att = $this->validate($request, [
            'question' => 'required|string',
            'ans'      => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            $answer->update([
                'ans' => $att['ans']
            ]);

            $answer->question()->update([
                'question' => $att['question']
            ]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withSuccess($ex->getMessage());
        }

        return $this->withSuccess('Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        try {
            DB::beginTransaction();
            $answer->question()->delete();
            $answer->delete();
            DB::commit();
        } catch (\Exception $ex) {
           DB::commit();
           return $this->withSuccess($ex->getMessage());
        }

        return $this->withSuccess('Successfully deleted.');
    }
}
