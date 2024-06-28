@extends('institution.layouts.app')
@section('institution-content')

<div class="position-sticky d-flex justify-content-between bg-white"style="top:60px;z-index:999;border-radius:10px;padding:10px;margin-bottom: 10px;box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
<h3> Trial Progress Report</h3>
<div>
    <select class="form-select" id="procedure-select">
        <option value="#">--Select--</option>
        @foreach($procedures as $procedure)
            <option value="{{ $procedure['procedure_name'] }}">{{ $procedure['procedure_name'] }}</option>
        @endforeach
    </select>
</div>
</div>
@foreach ($procedures as $item)
<!-- <div class="row procedure-section"> -->
<div class="row procedure-section" data-procedure="{{ $item['procedure_name'] }}" style="display: none;">
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
                        max: 100, 
                    },
                },
                plugins: {
                    legend: {
                        display: false, 
                    },
                    tooltip: {
                        enabled: true, 
                    },
                },
            },
        });
    });
});
</script>
<script>
    const procedureSelect = document.getElementById('procedure-select');
        const procedureSections = document.querySelectorAll('.procedure-section');

        procedureSelect.addEventListener('change', function() {
            const selectedProcedure = this.value;
            console.log(selectedProcedure);
            
            // Show or hide sections based on the selected procedure
            procedureSections.forEach(section => {
                console.log(section.dataset.procedure);
                if (section.dataset.procedure === selectedProcedure || selectedProcedure === '#') {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        });

        // Show all sections initially
        procedureSections.forEach(section => {
            section.style.display = 'block';
        });
</script>
@endsection