@extends('layouts.app')
@section('title','History Log')
@section('content')
    
<div class="row">
    <div class="col-lg-6 mx-auto">
      <div class="card">
        <div class="card-header">
          Stage History
        </div>
        <div class="card-body">
          <table class="table">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Created At</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($user->stages as $i=> $s)
                      <tr>
                          <td>{{$i+1}}</td>
                          <td>{{$s->stage_name}}</td>
                          <td>{{$s->created_at}}</td>
                          <td><a href="{{url('user/history_log/'.$s->id)}}" class="btn btn-primary btn-sm">Detail</a></td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection