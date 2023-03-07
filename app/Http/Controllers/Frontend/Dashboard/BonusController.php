<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    public function index ()
    {
        $bonuses = Bonuse::where('given_id', auth()->id())->latest()->paginate(15);

        return view('frontend.contents.dashboard.bonus_report', compact('bonuses'));
    }
}
