<?php

namespace App\Http\Controllers\Staff\API\V1\Faq;

use App\Models\Answer;
use App\Models\Question;
use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\FAQRequest;
use App\Services\ApiIndexQueryService;
use App\Services\Faq\FaqService;

class FaqController extends Controller
{
    use Formatter;

    public function __construct(
       public FaqService $service
    ){}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return ApiIndexQueryService::indexQuery(Answer::query(), ['question'], ['ans', 'question.question']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FAQRequest $request)
    {

        return $this->service->store($request->validated());
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
    public function update(FAQRequest $request, Answer $answer)
    {
        return $this->service->update($request->validated(), $answer);
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
