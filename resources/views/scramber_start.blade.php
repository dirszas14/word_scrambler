@extends('layouts.app')

@section('content')

<div class="row ">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <h5 class="card-header">Start Scrambler</h5>
            <div class="card-body">
              <h5 class="card-title text-center"></h5>
              <div class="row">
                  <div class="col-lg-6 text-center mx-auto">
                      <a href="#" class="btn btn-primary" id="start">Start Now!</a>
                  </div>
              </div>
             
            </div>
          </div>
        
    </div>
</div>

    @endsection
    @section('footer')
       <script>
           $('#start').click(function(e){
               e.preventDefault();
               $.ajax({
                   url:"{{url('/start_now')}}",
                   type:'POST',
                   beforeSend:()=>{
                       $.blockUI();
                   },
                   complete:()=>{
                       $.unblockUI();
                   },
                   success:()=>{
                    location.href="{{url('scrambler?ref=1')}}"
                   }
               });
           })
       </script>
    @endsection