@extends('layouts.app')

@section('content')
<!DOCTYPE html>
</html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>Report</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Answers', 'Votes'],
          <?php echo $option ?>
        ]);

        var options = {
          title:  '{!! json_encode($data[0]->question) !!}',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body style="background-color:rgb(222, 228, 248)">
    <div id="piechart" style="width: 900px; height: 500px;margin:auto;"></div>
  </body>
</html>
@endsection
