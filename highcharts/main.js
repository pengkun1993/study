Highcharts.setOptions({
    global: {
        useUTC: false
    }
});
function activeLastPointToolip(chart) {
    for(var i=0;i<chart.series.length;i++){
        var points = chart.series[i].points;
        chart.tooltip.refresh(points[points.length -1]);
    }
}
$('#container').highcharts({
    chart: {
        type: 'spline',
        animation:true , // Highcharts.svg 
        marginRight: 10,
        events: {
            load: function () {
                var series = this.series,
                    chart = this;
                var timer=setInterval(function () {
                    var x = (new Date()).getTime(); 
                    for(var i=0;i<series.length;i++){
                        var y = Math.random();
                        series[i].addPoint([x, y], false, true);
                        activeLastPointToolip(chart);
                    }
                    chart.redraw()
                }, 1000);
            }
        }
    },
    title: {
        text: '动态模拟实时数据'
    },
    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },
    yAxis: {
        title: {
            text: '值'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        formatter: function () {
            console.log(this.x);
            return  '<b>' + this.series.name + '</b><br/>' +
                Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                Highcharts.numberFormat(this.y, 2);
        }
    },
    legend: {
        enabled: false
    },
    exporting: {
        enabled: false
    },
    series: [{
        name: '随机数据1',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;
            for (i = -15; i <= 0; i += 1) {
                data.push({
                    x: time + i * 1000,
                    y: Math.random()
                });
            }
            return data;
        }())
    },{
        name: '随机数据2',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;
            for (i = -15; i <= 0; i += 1) {
                data.push({
                    x: time + i * 1000,
                    y: Math.random()
                });
            }
            return data;
        }())
    }]
}, function(c) {
    activeLastPointToolip(c);
});
