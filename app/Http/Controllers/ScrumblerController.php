<?php

namespace App\Http\Controllers;

use App\Models\Scrambler;
use App\Models\ScramblerStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScrumblerController extends Controller
{
    public function index ()
    {
        return view('scramber_start');
    }
    public function scrambler(Request $request)
    {
        $id=$request->query('ref');
        $word=Scrambler::find($id);
        return view('scrambler',compact('word'));
    }
    public function check_word(Request $request)
    {
       $data= $request->validate([
            'id'=>'required',
            'word'=>'required'
        ]);
        $stage=ScramblerStage::find(session('stage_id'));
        $word=Scrambler::find($data['id']);
        $insert['word_input']=$data['word'];
        $insert['word']=$word->word;
        $check=$data['word']===$word->word;
        $insert['old_score']=session('score');
        if(!$check){

            $insert['diffrences']=1;
            $insert['new_score']=$insert['old_score'] - $insert['diffrences'];
            $insert['tipe']='wrong';
            $stage->logs()->create($insert);
            session([
                'score'=>$insert['new_score']
            ]);
            return response('Kurang Tepat!',400);
        } else {
            $scrambler_id=session('scrambler_id');
            

            $nextword=Scrambler::find($data['id']+1);
            $insert['diffrences']=2;
            $insert['new_score']=$insert['old_score'] + $insert['diffrences'];
            $insert['tipe']='correct';
            $stage->logs()->create($insert);
            session([
                'score'=>$insert['new_score']
            ]);
            $stage->score=$insert['new_score'];
            $stage->save();
            $stage_at=session('stage_at') + 1;
            session(['stage_at'=>$stage_at]);
            return response()->json([
                'message'=>"Tepat Sekali <br> Jawabannya adalah <b>{$data['word']}</b>",
                'id'=>$scrambler_id[$stage_at]?? null
            ],200);
        }
        // dd($request->all());
    }
    public function start_now()
    {
        $user=Auth::user();
        $countstages=ScramblerStage::where('user_id',$user->id)->whereDate('created_at',date('Y-m-d'))->count()+1;
        $scrambler_id=Scrambler::inRandomOrder()
        ->limit(5)->get()->pluck('id');
        $stage=ScramblerStage::create([
            'stage_name'=>"Stage {$countstages}",
            'score'=>0,
            'user_id'=>$user->id
        ]);
        session([
            'score'=>0,
            'stage_id'=>$stage->id,
            'scrambler_id'=>$scrambler_id,
            'stage_at'=>0
        ]);
            return response()->json([
                'id'=>$scrambler_id[0]
            ]);
    }
    public function finish(Request $request)
    {
        $stage=ScramblerStage::find(session('stage_id'));
        if($stage==null){
            return redirect('/dashboard');
        }
        $request->session()->forget(['score', 'stage_id','scrambler_id','stage_at']);
        return view('finish',compact('stage'));
    }
}
