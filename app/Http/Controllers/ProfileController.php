<?php

namespace App\Http\Controllers;

use App\Models\ScramblerStage;
use App\Models\StageLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        return view('myprofile',compact('user'));
    }
    public function detail(ScramblerStage $stage)
    {
        return view('detaillog',compact('stage'));
    }
}
