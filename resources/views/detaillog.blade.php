@extends('layouts.app')


@section('content')
<div class="card">
    <div class="card-header">
        <h5>Detail</h5>
    </div>
<div class="card-body">
        <div class="row">
            <div class="col-lg-6 text-center">
                <h4>Stage Name</h4>
                <h5>{{$stage->stage_name}}</h5>
            </div>
            <div class="col-lg-6 text-center">
                <h4>Final Score</h4>
                <h5>{{$stage->score}}</h5>
            </div>
        </div>
    </div>
</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Old Score</th>
                <th>Differences</th>
                <th>Tipe</th>
                <th>Word</th>
                <th>Word Input</th>
                <th>New Score</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stage->logs as $l)
                <tr class="@if($l->tipe=='correct') table-success @elseif($l->tipe=='wrong') table-danger @endif">
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