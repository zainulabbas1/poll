@extends('layouts.app')

@section('content')

<body style="background-color:rgb(255, 255, 255)">
  @if($errors->any())
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{$errors->first()}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card"  style="margin-left:10%;margin-right:10%;background-color:rgb(0, 0, 0)">
  <h5 class="card-title" style="margin-top:10px;margin-left:20px;color:white">Edit Poll</h5>
  <form action="update" method="POST">
    @csrf
    <div>
      <div class="col-md-6 mb-3 " style="margin: 20px">
        <input type="text" name="question" class="form-control " value="{{$data[0]->question}}" placeholder="Enter question" required>
        <input type="hidden" name="q_id" value="{{$data[0]->id}}" />
      </div>
      @foreach($data[0]->options as $d)
      <div>
        <div  class="col-md-3 remov input-group w-25" style="margin: 20px">
          <input type="text" name="option[]" class="form-control" value="{{$d->answer}}" placeholder="Enter option" required>
          <button type="button" name="remove" class="btn btn-danger remove-option ">remove</button>
          <button type="button" name="add" class="btn btn-success add-option">Add More</button>
        </div>
      </div>
      @endforeach
      <div id="options"></div>
    </div>
    <div style="margin-left:20px;color:white">
      <label>From</label>
      <input type="datetime-local" value="{{$data[0]->start_time}}" name="start_time" required>
      <label>To</label>
      <input type="datetime-local" value="{{$data[0]->end_time}}" name="end_time" required>
    </div>
    <button style="margin: 20px"type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
            $('.add-option').click(function() {
                var option = $('<div  class="col-md-2 remov input-group w-25" style="margin: 20px"><input type="text" name="option[]" class="form-control" placeholder="Enter option" required><button type="button" name="remove" class="btn btn-danger remove-option">remove</button></div>');
                $('#options').append(option);
            });
            $('#options').on('click', '.remove-option', function() {
                $(this).closest('.remov').remove();
            });
        });
    </script>
@endsection
