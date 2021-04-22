@extends('layouts.app')
@section('title','History Log')
@section('content')
    
<div class="row">
    <div class="col-lg-6 mx-auto">
      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                    Words for Scrumbler
                </div>
                <div class="col-lg-6 text-right">
                    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal">Add</button>
                </div>
            </div>
          
        </div>
        <div class="card-body">
          <table class="table">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Hints</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($word as $i=> $u)
                      <tr>
                          <td>{{$i+1}}</td>
                          <td>{{$u->word}}</td>
                          <td>{{$u->hint}}</td>
                          <td>
                            <a href="#" class="btn btn-info btn-sm" onclick="edit({{$u->id}})">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm" onclick="deleteWord({{$u->id}},'{{$u->word}}')">Delete</a>
                        </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('footer')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Word Scrambler</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="add-word">
              <input type="hidden" name="id" id="id_word">
              <div class="form-group">
                  <label for="">Words <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="word" id="word" placeholder="e.g Guitar,Drums,etc">
              </div>
              <div class="form-group">
                <label for="">Hints</label>
                <input type="text" class="form-control" name="hint" id="hint" placeholder="e.g Music">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>

        </div>
      </div>
    </div>
  </div>
  <script>
    function deleteWord(id,name)
    {
      Swal.fire({
  title: `Are you sure delete ${name}?`,
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    
    $.ajax({
            url:"{{route('delete.word')}}",
            type:'POST',
            data:{id:id},
            beforeSend:()=>{
                $.blockUI();
            },
            complete:()=>{
                $.unblockUI();
            },
            success:(data)=>{
              Swal.fire(
            'Deleted!',
            'the word has been deleted.',
            'success'
          );
          setTimeout(() => {
            location.reload();
          }, 1500);
            }
        })
  }
})
    }
      function edit(id){
        $.ajax({
            url:"{{route('edit.word')}}",
            type:'POST',
            data:{id:id},
            beforeSend:()=>{
                $.blockUI();
            },
            complete:()=>{
                $.unblockUI();
            },
            success:(data)=>{
               $('#id_word').val(data.id);
               $('#word').val(data.word);
               $('#hint').val(data.hint);
                $('#exampleModal').modal('show');
            }
        })
      }
      $('#add-word').submit(function(e){
        e.preventDefault();
        let value=$(this).serialize();
        $.ajax({
            url:"{{route('store.word')}}",
            type:'POST',
            data:value,
            beforeSend:()=>{
                $('#exampleModal').block();
            },
            complete:()=>{
                $('#exampleModal').unblock();
            },
            success:(data)=>{
                Swal.fire(
                'Good job!',
                data.message,
                'success'
                )
                setTimeout(() => {
                    location.reload();
                }, 1500);

            }
        })
      })
  </script>
@endsection