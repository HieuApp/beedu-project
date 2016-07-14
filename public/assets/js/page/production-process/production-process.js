/**
 * Created by CaoLong on 7/4/2016.
 */
google.charts.load('current', {'packages':['gantt']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Task ID');
    data.addColumn('string', 'Task Name');
    data.addColumn('string', 'Resource');
    data.addColumn('date', 'Start Date');
    data.addColumn('date', 'End Date');
    data.addColumn('number', 'Duration');
    data.addColumn('number', 'Percent Complete');
    data.addColumn('string', 'Dependencies');

    data.addRows([
        ['1', 'cắt', 'cat', new Date(2014, 11, 22), new Date(2014, 12, 28), null, 100, null],
        ['2', 'may', 'may', new Date(2014, 6, 1), new Date(2014, 7, 20), null, 100, null],
        ['3', 'là', 'la', new Date(2014, 8, 21), new Date(2014, 9, 20), null, 100, null],
        ['4', 'đóng thùng', 'dong thung', new Date(2014, 10, 21), new Date(2014, 11, 21), null, 100, null]
    ]);

    var options = {
        height: 600,
        gantt: {
            trackHeight: 30
        }
    };

    var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

    chart.draw(data, options);
}