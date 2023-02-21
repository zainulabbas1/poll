@if(!$errors->any())
@extends('layouts.app')

@section('content')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="card" style="width:100%;margin-left:30%;margin-top:5%;border:0px">
    <form  method="POST" action="/submit">
        @csrf
        <div class="row" >
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div  class="dynamic-div">
                            <p class="card-text" style="font-size: 18px">
                                {{$data[0]->question}}
                            </p>
                        </div>
                        <input type="hidden" name="q_id" value="{{$data[0]->id}}" />
                    </div>
                    <div class="panel-body" style="width: auto">
                        <ul class="list-group">
                            @foreach($data[0]->options as $option)
                                <li class="list-group-item">
                                <div class="radio dynamic-div">
                                    <label>
                                        <input type="radio" value={{$option->id}} name="optionsRadios">
                                        <p class="card-text">{{$option->answer}}</p>
                                    </label>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="abcd@gmail.com" required>
                            <button type="submit" class="btn btn-primary btn-sm">Vote</button>
                </div>
            </div>
        </div>
    </form>
</div>
<style>
    .dynamic-div {
  display: inline-block;
  max-width: 100%;
  word-wrap: break-word;
}
 body { margin-top:20px; }
.panel-body:not(.two-col) { padding:0px }
.panel-body .radio,.panel-body .checkbox {margin-top: 0px;margin-bottom: 0px;}
.panel-body .list-group {margin-bottom: 0;}
.margin-bottom-none { margin-bottom: 0; }
.panel-body .radio label,.panel-body .checkbox label { display:block; }
</style>
@endsection
@endif
@if($errors->any())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{$errors->first()}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif