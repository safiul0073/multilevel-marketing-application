<?php

namespace App\Http\Controllers\API\V1\Staff;

use App\Http\Controllers\Controller;
use App\Models\SocialIcon;
use App\Services\ApiIndexQueryService;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class SocialIconController extends Controller
{
    use Formatter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApiIndexQueryService::indexQuery(
            SocialIcon::query(),
            [],
            ['title']
        );
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
            'title'     => 'required|string',
            'icon'      => 'required|string',
            'link'      => 'required|string|url'
        ]);

        SocialIcon::create($att);

        return $this->withSuccess('Social link added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialIcon  $socialIcon
     * @return \Illuminate\Http\Response
     */
    public function show(SocialIcon $socialIcon)
    {
        return $this->withSuccess($socialIcon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialIcon  $socialIcon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialIcon $socialIcon)
    {
        $att = $this->validate($request, [
            'title'     => 'required|string',
            'icon'      => 'required|string',
            'link'      => 'required|string|url'
        ]);

        $socialIcon->update($att);

        return $this->withSuccess('Social link updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialIcon  $socialIcon
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialIcon $socialIcon)
    {
        $socialIcon->delete();

        return $this->withSuccess(__("Successfully deleted."));
    }
}
