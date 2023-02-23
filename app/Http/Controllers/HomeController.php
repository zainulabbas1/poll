<?php

namespace App\Http\Controllers;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Question::where('user_id', Auth::id())->where('is_delete',0)->get();
        $url = "";
        return view('home', compact('data', 'url'));
    }
}
