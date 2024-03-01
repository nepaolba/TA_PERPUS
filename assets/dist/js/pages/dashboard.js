/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

  'use strict';

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    containment: $('section.content'),
    placeholder: 'sort-highlight',
    connectWith: '.connectedSortable',
    handle: '.box-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex: 999999
  });
  $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

  // jQuery UI sortable for the todo list
  // $('.todo-list').sortable({
  //   placeholder: 'sort-highlight',
  //   handle: '.handle',
  //   forcePlaceholderSize: true,
  //   zIndex: 999999
  // });

  // bootstrap WYSIHTML5 - text editor
  // $('.textarea').wysihtml5();

  // $('.daterange').daterangepicker({
  //   ranges: {
  //     'Today': [moment(), moment()],
  //     'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
  //     'Last 7 Days': [moment().subtract(6, 'days'), moment()],
  //     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
  //     'This Month': [moment().startOf('month'), moment().endOf('month')],
  //     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  //   },
  //   startDate: moment().subtract(29, 'days'),
  //   endDate: moment()
  // }, function (start, end) {
  //   window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  // });

  /* jQueryKnob */
  // $('.knob').knob();


  // Sparkline charts
  // var myvalues = [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021];
  // $('#sparkline-1').sparkline(myvalues, {
  //   type: 'line',
  //   lineColor: '#92c1dc',
  //   fillColor: '#ebf4f9',
  //   height: '50',
  //   width: '80'
  // });
  // myvalues = [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921];
  // $('#sparkline-2').sparkline(myvalues, {
  //   type: 'line',
  //   lineColor: '#92c1dc',
  //   fillColor: '#ebf4f9',
  //   height: '50',
  //   width: '80'
  // });
  // myvalues = [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21];
  // $('#sparkline-3').sparkline(myvalues, {
  //   type: 'line',
  //   lineColor: '#92c1dc',
  //   fillColor: '#ebf4f9',
  //   height: '50',
  //   width: '80'
  // });

  // The Calender
  // $('#calendar').datepicker();

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '250px'
  });

  /* Morris.js Charts */
  // Sales chart
  // var area = new Morris.Area({
  //   element: 'revenue-chart',
  //   resize: true,
  //   data: [
  //     { y: '2011 Q1', item1: 2666, item2: 2666 },
  //     { y: '2011 Q2', item1: 2778, item2: 2294 },
  //     { y: '2011 Q3', item1: 4912, item2: 1969 },
  //     { y: '2011 Q4', item1: 3767, item2: 3597 },
  //     { y: '2012 Q1', item1: 6810, item2: 1914 },
  //     { y: '2012 Q2', item1: 5670, item2: 4293 },
  //     { y: '2012 Q3', item1: 4820, item2: 3795 },
  //     { y: '2012 Q4', item1: 15073, item2: 5967 },
  //     { y: '2013 Q1', item1: 10687, item2: 4460 },
  //     { y: '2013 Q2', item1: 8432, item2: 5713 }
  //   ],
  //   xkey: 'y',
  //   ykeys: ['item1', 'item2'],
  //   labels: ['Item 1', 'Item 2'],
  //   lineColors: ['#a0d0e0', '#3c8dbc'],
  //   hideHover: 'auto'
  // });
  // var line = new Morris.Line({
  //   element: 'line-chart',
  //   resize: true,
  //   data: [
  //     { y: '2011 Q1', item1: 2666 },
  //     { y: '2011 Q2', item1: 2778 },
  //     { y: '2011 Q3', item1: 4912 },
  //     { y: '2011 Q4', item1: 3767 },
  //     { y: '2012 Q1', item1: 6810 },
  //     { y: '2012 Q2', item1: 5670 },
  //     { y: '2012 Q3', item1: 4820 },
  //     { y: '2012 Q4', item1: 15073 },
  //     { y: '2013 Q1', item1: 10687 },
  //     { y: '2013 Q2', item1: 8432 }
  //   ],
  //   xkey: 'y',
  //   ykeys: ['item1'],
  //   labels: ['Item 1'],
  //   lineColors: ['#efefef'],
  //   lineWidth: 2,
  //   hideHover: 'auto',
  //   gridTextColor: '#fff',
  //   gridStrokeWidth: 0.4,
  //   pointSize: 4,
  //   pointStrokeColors: ['#efefef'],
  //   gridLineColor: '#efefef',
  //   gridTextFamily: 'Open Sans',
  //   gridTextSize: 10
  // });

  // Donut Chart
  // var donut = new Morris.Donut({
  //   element: 'sales-chart',
  //   resize: true,
  //   colors: ['#3c8dbc', '#f56954', '#00a65a'],
  //   data: [
  //     { label: 'Download Sales', value: 12 },
  //     { label: 'In-Store Sales', value: 30 },
  //     { label: 'Mail-Order Sales', value: 20 }
  //   ],
  //   hideHover: 'auto'
  // });

  // Fix for charts under tabs
  // $('.box ul.nav a').on('shown.bs.tab', function () {
  //   area.redraw();
  //   donut.redraw();
  //   line.redraw();
  // });

  /* The todo list plugin */
  // $('.todo-list').todoList({
  //   onCheck: function () {
  //     window.console.log($(this), 'The element has been checked');
  //   },
  //   onUnCheck: function () {
  //     window.console.log($(this), 'The element has been unchecked');
  //   }
  // });


  var Data = {
    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    datasets: [{
      label: 'Peminjaman',
      fillColor: 'rgba(210, 214, 222, 1)',
      strokeColor: 'rgba(210, 214, 222, 1)',
      pointColor: 'rgba(210, 214, 222, 1)',
      pointStrokeColor: '#c1c7d1',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data: peminjamanData
    },
    {
      label: 'Pengembalian',
      fillColor: 'rgba(60,141,188,0.9)',
      strokeColor: 'rgba(60,141,188,0.8)',
      pointColor: '#3b8bba',
      pointStrokeColor: 'rgba(60,141,188,1)',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data: [100, 48, 40, 60, 30]
    }
    ]
  }
  // console.log(labels)
  //-------------
  //- BAR CHART -
  //-------------
  const barChartCanvas = $('#barChart').get(0).getContext('2d')
  const barChart = new Chart(barChartCanvas)
  const barChartData = Data
  barChartData.datasets[1].fillColor = '#39cccc'
  barChartData.datasets[0].fillColor = '#00c0ef'
  barChartData.datasets[0].strokeColor = '#00c0ef'
  barChartData.datasets[1].strokeColor = '#39cccc'
  barChartData.datasets[1].pointColor = '#00a65a'
  const barChartOptions = {
    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
    scaleBeginAtZero: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: true,
    //String - Colour of the grid lines
    scaleGridLineColor: 'rgba(0,0,0,.05)',
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - If there is a stroke on each bar
    barShowStroke: true,
    //Number - Pixel width of the bar stroke
    barStrokeWidth: 2,
    //Number - Spacing between each of the X value sets
    barValueSpacing: 10,
    //Number - Spacing between data sets within X values
    barDatasetSpacing: 1,
    //String - A legend template
    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
    //Boolean - whether to make the chart responsive
    responsive: true,
    maintainAspectRatio: true
  }

  barChartOptions.datasetFill = false
  barChart.Bar(barChartData, barChartOptions)

});

$(document).ready(function () {
  console.log($('.peminjaman_wrapper'));
})
