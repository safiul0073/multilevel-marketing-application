<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Epin;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class EpinController extends Controller
{
    use Formatter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $epins = Epin::with('use_by:id,username')->orderBy('id', 'desc')->paginate(15);

        return $this->withSuccess($epins);
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
            'type'  => 'required|string',
            'code'  => 'required|string|unique:epins,code',
            'cost'  => 'required|numeric',
        ]);

        Epin::create($att);

        return $this->withCreated('Successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Epin  $epin
     * @return \Illuminate\Http\Response
     */
    public function show(Epin $epin)
    {
        return $this->withSuccess($epin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Epin  $epin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $att = $this->validate($request, [
            'id'    => 'required|numeric|exists:epins,id',
            'type'  => 'required|string',
            'code'  => 'required|string|unique:epins,code,' . $request->id,
            'cost'  => 'required|numeric',
        ]);
        $epin = Epin::find((int) $request->id);
        unset($att['id']);
        $epin->update($att);

        return $this->withCreated('Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Epin  $epin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Epin $epin)
    {
        $epin->delete();

        return $this->withSuccess('Successfully deleted.');
    }
}
