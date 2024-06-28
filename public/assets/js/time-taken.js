
function renderChart(procedureIndex, typeIndex, scores) {
    
   const span = document.querySelector(`#chart_student_time_taken${procedureIndex}_${typeIndex}`);
    var options = {

        series: scores,

        chart: {

            foreColor: '#000000',

            height: 350,

            type: 'radialBar',

        },

        // Rest of your options

    };

 

    var chart = new ApexCharts(span, options);

    chart.render();

}