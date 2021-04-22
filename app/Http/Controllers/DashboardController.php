<?php

namespace App\Http\Controllers;

use App\Models\Scrambler;
use App\Models\ScramblerStage;
use App\Models\StageLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function user()
    {
        $user=User::where('type','Player')->get();
        return view('admin.user',compact('user'));
    }
    public function detail(User $user)
    {
        return view('admin.detailuser',compact('user'));
    }
    public function history_log(ScramblerStage $stage)
    {
        // dd($stage);
        return view('admin.history_log',compact('stage'));
    }
    public function words()
    {
        $word=Scrambler::all();
        return view('admin.word',compact('word'));
    }
    public function store_words(Request $request)
    {
        // dd($request->all());
        $id=$request->id;
        $data=$request->validate([
            'word'=>['required', Rule::unique('scramblers')->ignore($id)]
        ]);
        $data['hint']=$request->hint;
        Scrambler::updateOrCreate(
            ['id'=>$id],
            $data);
        return response()->json([
            'message'=>'Success add word'
        ]);
    }
    public function edit_word(Request $request)
    {
        $id=$request->id;
        $scrambler=Scrambler::find($id);
        return response()->json([
            'word'=>$scrambler->word,
            'hint'=>$scrambler->hint,
            'id'=>$id
        ]);
    }
    public function delete_word(Request $request)
    {
        $id=$request->id;
        $scrambler=Scrambler::find($id);
        $scrambler->delete();
    }
}
