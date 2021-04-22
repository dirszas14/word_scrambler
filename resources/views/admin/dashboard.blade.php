@extends('layouts.app')
{{-- @section('title','Dashboard') --}}
@section('content')
<div class="row">
  <div class="col-lg-6 mx-auto">
    <div class="card">
      <div class="card-header">
        Dashboard
      </div>
      <div class="card-body">
        <p class="card-text">Hello, {{Auth::user()->name}}</p>
      </div>
    </div>
  </div>
</div>

@endsection