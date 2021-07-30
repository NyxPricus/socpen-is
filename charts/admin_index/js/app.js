$(function() {
    $.ajax({

        url: 'chart_data.php',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "REMAINING ALLOTMENT OF PPD UNITS",
                "xAxisName": "SAA NUMBER",
                "yAxisName": "Allotment Received",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'chart-container',
                width: '800',
                height: '450',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            });
            apiChart.render();
        }
    });
});