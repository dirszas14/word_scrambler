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
        $request->session()->flush();
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
            return response()->json([
                'message'=>"Tepat Sekali <br> Jawabannya adalah <b>{$data['word']}</b>",
                'id'=>$nextword->id ?? null
            ],200);
        }
        // dd($request->all());
    }
    public function start_now()
    {
        $user=Auth::user();
        $countstages=ScramblerStage::where('user_id',$user->id)->whereDate('created_at',date('Y-m-d'))->count()+1;
        $stage=ScramblerStage::create([
            'stage_name'=>"Stage {$countstages}",
            'score'=>0,
            'user_id'=>$user->id
        ]);
        session([
            'score'=>0,
            'stage_id'=>$stage->id
        ]);

    }
    public function finish()
    {
        $stage=ScramblerStage::find(session('stage_id'));
        return view('finish',compact('stage'));
    }
}
