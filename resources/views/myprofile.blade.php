@extends('welcome')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->stages as $s)
                <tr>
                    <td><a href="{{url('myprofile/stages/detail/'.$s->id)}}">{{$s->stage_name}}</a></td>
                    <td>{{$s->created_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection