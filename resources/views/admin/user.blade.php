@extends('layouts.app')
@section('title','History Log')
@section('content')
    
<div class="row">
    <div class="col-lg-6 mx-auto">
      <div class="card">
        <div class="card-header">
          User
        </div>
        <div class="card-body">
          <table class="table">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($user as $i=> $u)
                      <tr>
                          <td>{{$i+1}}</td>
                          <td>{{$u->name}}</td>
                          <td>{{$u->email}}</td>
                          <td><a href="{{url('user/detail/'.$u->id)}}" class="btn btn-primary btn-sm">Detail</a></td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection