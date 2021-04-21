<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScramblerStage extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function logs()
    {
        return $this->hasMany(StageLog::class,'scrambler_stage_id')->orderBy('created_at','DESC');
    }
}
