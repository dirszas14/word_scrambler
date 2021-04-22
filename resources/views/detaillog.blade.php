@extends('layouts.app')


@section('content')
<div class="row my-3">
<div class="col-lg-12">


<div class="card">
    <div class="card-header">
        <h5>Detail</h5>
    </div>
<div class="card-body">
        <div class="row">
            <div class="col-lg-4 text-center">
                <h3>Stage Name</h3>
                <h4>{{$stage->stage_name}}</h4>
            </div>
            <div class="col-lg-4 text-center">
                <h3>Final Score</h3>
                <h4>{{$stage->score}}</h4>
            </div>
            <div class="col-lg-4 text-center">
                <h3>Steps :</h3>
                <h4>{{$stage->logs->count()}}</h4>
            </div>
        </div>
        <hr>
            <div class="row">
                
            <div class="col-lg-6 text-center">
                <h3>Correct Answer:</h3>
                <h4 class="text-success">{{$stage->logs->where('tipe','correct')->count()}}</h4>
            </div>
            <div class="col-lg-6 text-center">
                <h3>Wrong Answer:</h3>
                <h4 class="text-danger">{{$stage->logs->where('tipe','wrong')->count()}}</h4>
            </div>
        </div>
    </div>
</div>
</div>
</div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Old Score</th>
                <th>Differences</th>
                <th>Tipe</th>
                <th>Word</th>
                <th>Word Inputted</th>
                <th>New Score</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stage->logs as $i=> $l)
                <tr class="@if($l->tipe=='correct') table-success @elseif($l->tipe=='wrong') table-danger @endif">
                    <td>{{$i+1}}</td>
                    <td>{{$l->old_score}}</td>
                    <td>{{$l->diffrences}}</td>
                    <td>{{$l->tipe}}</td>
                    <td>{{$l->word}}</td>
                    <td>{{$l->word_input}}</td>
                    <td>{{$l->new_score}}</td>
                    <td>{{$l->created_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection