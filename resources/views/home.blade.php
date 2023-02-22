@extends('layouts.app')

@section('content')
<body style="background-color:rgb(255, 255, 255)">
<br><br>
@if($errors->any())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{$errors->first()}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card"  style="margin-left:10%;margin-right:10%;;background-color:rgb(15, 1, 1)">
  <h5 class="card-title" style="margin-top:10px;margin-left:20px;color:white">Create Poll</h5>
  <form action="poll" method="POST">
    @csrf
    <div>
      <div class="col-md-6 mb-3 " style="margin: 20px">
        <input type="text" name="question" class="form-control " placeholder="Enter question" required>
      </div>
      <div id="options">
        <div  class="col-md-3 remov input-group w-25" style="margin: 20px">
          <input type="text" name="option[]" size="50%" class="form-control" placeholder="Enter option" required>
          {{-- <button type="button" name="remove" class="btn btn-danger remove-option ">remove</button> --}}
        <button type="button" name="add" class="btn btn-success add-option">Add More</button>
        </div>
        <div  class="col-md-3 remov input-group w-25" style="margin: 20px">
          <input type="text" name="option[]" class="form-control" placeholder="Enter option" required>
        </div>
      </div>
    </div>
    <div style="margin-left:20px;color:white">
      <label>From</label>
      <input type="datetime-local" name="start_time" required>
      <label>To</label>
      <input type="datetime-local" name="end_time" required>
      <label> Note : Time will be considerd according to UTC</label>
    </div>
    <button style="margin: 20px"type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

@if(!$data->isEmpty())
<table class="table table-striped" style="width: 40%;margin-left: 10%;margin-top:20px;color:rgb(0, 0, 0)">
  <thead>
    <tr>
      <th scope="col" >#</th>
      <th scope="col">Question</th>
      <th scope="col" style="width: 10%">Report</th>
      <th scope="col" style="width: 10%">Update</th>
      <th scope="col" style="width: 10%">Delete</th>
      <th scope="col" style="width: 10%">Poll Url</th>
    </tr>
  </thead>
  <tbody>
    
    @foreach($data as $key=>$data)
    <tr class=".w-auto" >
      <th scope="row" style="color:rgb(0, 0, 0)">{{++$key}}</th>
      <td style="color:rgb(0, 0, 0)">{{$data->question}}</td>
      <td><a href="report/{{$data->id}}">
        <button class="btn btn-success">Report</button>
        </a></td>
      <td><a href="edit/{{$data->id}}">
        <button class="btn btn-primary">Edit</button>
        </a></td>
        <td><a href="delete/{{$data->id}}">
          <button class="btn btn-danger">Delete</button>
          </a></td>
          <td><a href="url/{{$data->id}}">
            <button class="btn btn-secondary">Link</button>
            </a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
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
