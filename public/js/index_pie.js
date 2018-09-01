$(document).ready(function() {
    /* 3D饼图 */
    var chart = {
        type: 'pie',
        options3d: {
            enabled: true, // 显示图表是否设置为3D， 我们将其设置为true
            alpha: 50, // 图表视图旋转角度
            beta: 0, // 图表视图旋转角度
            depth: 100, // 图表的合计深度，默认为100
            viewDistance: 25 // 定义图表的浏览长度
        }
    };
    var title = {
        text: '浏览器访问比例饼图'
    };
    var tooltip = {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    };

    var plotOptions = {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    };
    var series = [{
        type: 'pie',
        name: '访问比例',
        data: [
            ['Firefox', 45.0],
            ['IE', 26.8], {
                name: 'Chrome',
                y: 12.8,
                sliced: true,
                selected: true
            },
            ['Safari', 8.5],
            ['Opera', 6.2],
            ['Others', 0.7]
        ]
    }];

    var json = {};
    json.chart = chart;
    json.title = title;
    json.tooltip = tooltip;
    json.plotOptions = plotOptions;
    json.series = series;
    $('#pie').highcharts(json);
});