
calcular();
function graficar() {

var capas1=[1,2,3,4];
var capas2=[100,50,30,10];
var capas3=[50,70,20,0];
  var areaChartData = {
    labels  : capas1,
    datasets: [
      {
        label               : 'Electronics',
        fillColor           : 'rgba(210, 214, 222, 1)',
        strokeColor         : 'rgba(210, 214, 222, 1)',
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : capas2
      },
      {
        label               : 'Digital Goods',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : capas3
      }
    ]
  }

  var areaChartOptions = {
    showScale               : true,
    scaleShowGridLines      : false,
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    scaleGridLineWidth      : 1,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines  : true,
    bezierCurve             : true,
    bezierCurveTension      : 0.3,
    pointDot                : false,
    pointDotRadius          : 4,
    pointDotStrokeWidth     : 1,
    pointHitDetectionRadius : 20,
    datasetStroke           : true,
    datasetStrokeWidth      : 2,
    datasetFill             : true,
    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    maintainAspectRatio     : true,
    responsive              : true
  }

  var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
  var lineChart                = new Chart(lineChartCanvas)
  var lineChartOptions         = areaChartOptions
  lineChartOptions.datasetFill = false
  lineChart.Line(areaChartData, lineChartOptions)
}

function calcular() {
  cargardatos();
  /*factor_recuperacion = $('#fact_recup').val();
  porosidad = $('#porosidad').val();
  sw = $('#sw').val(); // Saturacio
  bg = $('#bg').val();  // Beta sub G
  h = $('#h').val();*/
  graficar();

}
