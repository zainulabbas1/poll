<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Option;
use App\Models\Question;
use App\Models\Vote;
Use Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\isEmpty;

class PollController extends Controller
{
    //
    public function save(Request $request)
    {
        $q=Question::create(['user_id'=>Auth::id(),'question'=>$request->question,'start_time'=>$request->start_time,'end_time'=>$request->end_time]);
        foreach ($request->option as $op) {
            Option::create(['question_id'=>$q->id, 'answer'=>$op]);
        }
        $url="http://127.0.0.1:8000/poll/".$q->id;
        return view("submit", compact('url'));
    }

    public function vote($id)
    {
        $mytime = Carbon\Carbon::now();
        $mytime = $mytime->toDateTimeString();
        $data = Question::with('options')->where('id', $id)->where('start_time', '<=', $mytime)->where('end_time', '>=', $mytime)->get();
        if ($data->isEmpty()) {
            return redirect('vote')->withErrors(['msg'=>'May be the poll is Expired or not Activated.']);
        }
        return View("vote", compact('data'));
    }

    public function submit(Request $request)
    {
        $emailCheck =Vote::where('email', $request->email)->where('question_id', $request->q_id)->get();
        if (!$emailCheck->isEmpty()) {
            return Redirect::back()->with('status', 'Already Voted');
        }
        Vote::create(['email'=>$request->email,'question_id'=>$request->q_id,'option_id'=>$request->optionsRadios]);
        $count = Option::select('count')->where('id', $request->optionsRadios)->first();
       
        $count1 = $count->count + 1;
        Option::where('id', $request->optionsRadios)->update(array('count' => $count1));
        return Redirect::back()->with('status', 'Vote Submitted');
    }

    public function edit($id)
    {
        $data = Question::with('options')->where('id', $id)->get();
        return View("edit", compact('data'));
    }

    public function update(Request $request)
    {
        Question::where('id', $request->q_id)->update(['question'=>$request->question,'start_time'=>$request->start_time,'end_time'=>$request->end_time]);
        Option::where('question_id', $request->q_id)->delete('question_id', $request->q_id);
        foreach ($request->option as $op) {
            Option::create(['question_id'=>$request->q_id, 'answer'=>$op]);
        }
        return Redirect::back()->withErrors(['msg' => 'Successfully updated.']);
    }

    public function delete($id)
    {
        Option::where('question_id', $id)->delete();
        Question::where('id', $id)->delete();
        Vote::where('question_id', $id)->delete();
        return Redirect::back()->withErrors(['msg'=>'deleted successfully']);
    }

    public  function report($id)
    {
        $data = Question::with('options')->where('id', $id)->get();
        $option = "";
        foreach ($data[0]->options as $d){
            $option .="['".$d->answer."',".$d->count."],";
        }
        $option = rtrim($option, ",");
        $chart['option']=$option;
        return View("reports", $chart, compact('data'));
    }
}