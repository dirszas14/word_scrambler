@extends('welcome')

@section('content')
<div class="row ">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <h5 class="card-header">Congratulation!</h5>
            <div class="card-body">
              <h5 class="card-title text-center">You've got {{$stage->score}} Point </h5>
              <div class="row">
                  <div class="col-lg-6 text-center ">
                      <a href="{{url('start')}}" class="btn btn-primary" >Play Again!</a>
                  </div>
                  <div class="col-lg-6 text-center ">
                    <a href="{{url('myprofile')}}" class="btn btn-primary" >Log</a>
                </div>
              </div>
             
            </div>
          </div>
        
    </div>
</div>
@endsection