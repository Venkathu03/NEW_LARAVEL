@extends('student.layouts.app')
@section('student-content')

@foreach ($procedures as $item)
<div class="row">
    <div class="col-12">
       <div class="card radius-10 w-100">
          <div class="card shadow-none bg-transparent border-bottom border-2">
             <div class="card-body">
                <div class="row align-items-center">
                   <div class="col-md">
                      <h4 class="mb-3 mb-md-0">{{$item['procedure_name']}}</h4>
                   </div>
                </div>
             </div>
          </div>
          @foreach($item['type_value'] as $procedure_type)
          <div class="card-body">
             <div>
                <h5 class="mb-1" style="margin-left: 30px">{{$procedure_type['procedure_type_name']}}</h5>
             </div>
             <div>
                <div class="container1">
                    <canvas class="barChart" data-scores="{{ json_encode($procedure_type['score']) }}"></canvas>

                </div>
             </div>
          </div>
          @endforeach
       </div>
    </div>
 </div>    
@endforeach
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

    // Get all the canvas elements with class 'barChart'
    const barCharts = document.querySelectorAll('.barChart');
    
    barCharts.forEach((canvas) => {
        const scores = JSON.parse(canvas.dataset.scores);

        new Chart(canvas, {
            type: 'bar',
            data: {
                labels: ['trial 1', 'trial 2', 'trial 3', 'trial 4'],
                datasets: [
                    {
                        data: scores,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100, // Set the maximum value of the y-axis to 100
                    },
                },
                plugins: {
                    legend: {
                        display: false, // Hide the legend
                    },
                    tooltip: {
                        enabled: true, // Disable tooltips
                    },
                },
            },
        });
    });
});
</script>
@endsection