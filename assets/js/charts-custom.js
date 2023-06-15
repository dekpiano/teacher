"use strict";
let ma;
let values = [];
const ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
                label: 'ห้อง 1',
                data: [],
                borderWidth: 1,
                backgroundColor: [
                    "#ff6384",
                ]
            },
            {
                label: 'ห้อง 2',
                data: [],
                borderWidth: 1,
                backgroundColor: [
                    "#36a2eb",
                ]
            },
            {
                label: 'ห้อง 3',
                data: [],
                borderWidth: 1,
                backgroundColor: [
                    "#cc65fe",
                ]
            },
            {
                label: 'ห้อง 4',
                data: [],
                borderWidth: 1,
                backgroundColor: [
                    "#ffce56",
                ]
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

ChartStatisticsHomeRoom();

function ChartStatisticsHomeRoom(params) {
    $.post('../../ConTeacherTeaching/bar_chart_js', {},
        function(data, status) {
            var ma = data;
            var result = [data.ma, data.khad, data.la, data.sahy, data.kid, data.hnee];
            //console.log(ma);
            myChart.data.labels.push('มา', 'ขาด', 'สาย', 'ลา', 'กิจกรรม', 'ไม่เข้า');

            $.each(result, function(key, value) {
                //console.log(value[0]);
                myChart.data.datasets[0].data.push(value[0]);
                myChart.data.datasets[1].data.push(value[1]);
                myChart.data.datasets[2].data.push(value[2]);
                myChart.data.datasets[3].data.push(value[3]);
            });
            myChart.update();
        },
        'json');
}