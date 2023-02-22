@extends('layouts.app')

@section('content')
<body style="background-color:rgb(255, 255, 255)">
<div class="card" style="margin-left:20%;margin-right:20%;margin-top:5%;height:200px;background-color:rgb(0, 0, 0)">
    <div style="margin:auto;color:white">
        <div>
            <h3>Poll Url </h3>
        </div>
        <div >
        <input type="text" size="50" value={{$url}} id="myInput" >
        <button onclick="myFunction()" class="btn btn-primary">Copy text</button>
        <a href="/home">
            <button class="btn btn-secondary">Back</button>
        </a>
        </div>
    </div>
</div>
<script type="text/javascript">
   
function myFunction() {
    var copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    alert("Copied the text: " + copyText.value);
    // window.location.href = "{{ route('home') }}";
}
</script>


@endsection
