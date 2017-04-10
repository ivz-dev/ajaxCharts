$(document).ready(function () {
    google.charts.load('current', {'packages':['corechart']});

    var paramArray = {"type":"temp", "date1":"2017-02-01", "date2":"2017-02-10"};

   $("#ok").click(function () {
       $.ajax({
           url : "http://test.com/handle.php",
           type: "GET",
           data: paramArray,
           success: successFunc
       });

       var data = new google.visualization.DataTable();
       data.addColumn('datetime', 'Time of Day');
       data.addColumn('number', 'Motivation Level');

       var chart = new google.visualization.LineChart(
           document.getElementById('chart_div'));
       var options = {
           width: 900,
           height: 500,
           legend: {position: 'none'},
           enableInteractivity: false,
           chartArea: {
               width: '85%'
           },
           hAxis: {
               viewWindow: {
                   min: new Date(2017,2, 1),
                   max: new Date(2017, 2, 10)
               },
               gridlines: {
                   count: -1,
                   units: {
                       days: {format: ['MMM dd']},
                       hours: {format: ['HH:mm', 'ha']},
                   }
               },
               minorGridlines: {
                   units: {
                       hours: {format: ['hh:mm:ss a', 'ha']},
                       minutes: {format: ['HH:mm a Z', ':mm']}
                   }
               }
           }
       };


       function successFunc(dataArr) {
            jsonData = JSON.parse(dataArr);
            for(i=0; i<Object.keys(jsonData).length; i++)
            {
                data.addRows([[new Date(jsonData[i].year, jsonData[i].month, jsonData[i].day), Number(jsonData[i].val)]]);
            }
           chart.draw(data, options);
       }
     });
});