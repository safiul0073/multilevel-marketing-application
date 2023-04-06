<?php

namespace App\Http\Controllers\API\V1\Staff\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\ApiIndexQueryService;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class ContactController extends Controller
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
            Contact::query(),
            [],
            ['email']
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->withSuccess("Successfully deleted.");
    }
}
