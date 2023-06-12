"use strict";
let ma;
let values = [];
$.post('../../ConTeacherTeaching/bar_chart_js', {},
    function(data, status) {
        $.each(data, function(key, value) {
            console.log(value[0]);
            values.push({
                label: 'ห้อง 1',
                data: [5, 6, 4],
                borderWidth: 1,
                backgroundColor: [
                    "#22A699",
                ]
            });
        });

    },
    'json');

console.log(values);

const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['มา', 'ขาด', 'สาย', 'ลา', 'กิจกรรม', 'ไม่เข้า'],
        datasets: [values]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});