@extends('layouts.app')


@section('content')

<div class="row" style="padding-top:300px;">
    <div class="col-lg-6 mx-auto">
        <div class="card  h-100">
            <h5 class="card-header">Guess Word</h5>
            <div class="card-body">
                @php
                    $shuffle_word=(str_shuffle($word->word)==$word->word) ? str_shuffle($word->word) : str_shuffle($word->word);
                @endphp
              <h5 class="card-title text-center">{{$shuffle_word}}</h5>
              <form id="form-word">
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$word->id}}">
                    <label for="">Guess the word!</label>
                    <input type="text" class="form-control" name="word" id="word-input" max="{{strlen($word->$word)}}" required>
                </div>
                <div class="d-grid gap-2 my-3">
                    <button type="submit" class="btn btn-primary btn-block" id="btn-submit">Submit</button>

                  </div>
            </form>
             
            </div>
          </div>
        
    </div>
    <div class="col-lg-3 ">
        <div class="card text-center h-100">
            <div class="card-header">
              Featured
            </div>
            <div class="card-body">
              <h5 class="card-title">Score</h5>
                <h3 id="score">{{session('score')}}</h3>
            </div>
          </div>
    </div>
</div>

    @endsection
    @section('footer')
        <script>
            let score={{session('score')}};
            $('#form-word').submit(function(e){
                e.preventDefault();
                let data=$(this).serialize();
                $.ajax({
                    url:"{{route('check_word')}}",
                    type:'POST',
                    data:data,
                    beforeSend:()=>{
                        $.blockUI();
                    },
                    complete:()=>{
                        $.unblockUI();
                        $('#word-input').val('');
                    },
                    success:(data)=>{
                        
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        html: data.message,
                    });
                    setTimeout(() => {
                        if(data.id===null){
                            location.href="scrambler/finish";
                        } else {
                        location.href=`{{url('scrambler')}}?ref=${data.id}`;
                        }
                    }, 1500);
                    },
                    error:(e, xhr, options, exc)=>{
                        console.log(e, xhr, options, exc);
                        if(e.status==400){
                        console.log('error');
                        score--;
                        $('#score').html(score);
                        }
                    }
                })
            })
        </script>
    @endsection