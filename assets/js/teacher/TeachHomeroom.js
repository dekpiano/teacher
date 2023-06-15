$(document).on("change", "#show_date", function() {
    window.location.href = $(this).val();

});

$('.ShowDashborad').DataTable({
    paging: false,
    dom: 'Bfrtip',
    buttons: [
        'copyHtml5', 'excelHtml5', 'print'
    ],
    "autoWidth": true,
    "footerCallback": function(row, data, start, end, display) {
        var api = this.api();
        nb_cols = api.columns().nodes().length;
        var j = 1;
        while (j < nb_cols) {
            var pageTotal = api
                .column(j)
                .data()
                .reduce(function(a, b) {
                    return Number(a) + Number(b);
                }, 0);
            // Update footer
            $(api.column(j).footer()).html(pageTotal);
            j++;
        }
    }
});

$(document).on("click", ".ShowStudent", function() {
    $('#ShowStudent').modal('show');
    $('.DelTableRow').remove();
    $.post('../ConTeacherTeaching/CHR_CheckStudent', {
            id: $(this).attr('homeroom-id'),
            keyword: $(this).attr('homeroom-keyword')
        }, function(data) {
            //console.log(data);

            $.each(data, function(key, val) {
                //console.log(val[0].StudentFirstName);
                $('#TB_showstudent').append('<tr class="DelTableRow"><td>' + val[0].StudentNumber + '</td><td>' + val[0].StudentCode + '</td><td>' + val[0].StudentPrefix + val[0].StudentFirstName + ' ' + val[0].StudentLastName + '</td></tr>');
            });
        }, 'json')
        .fail(function(xhr, textStatus, errorThrown) {
            console.log(xhr.responseText);
        });
});

$(document).on("click", ".ShowStudentLeader", function() {
    $('#ShowStudent').modal('show');
    $('.DelTableRow').remove();
    $.post('../../ConTeacherTeaching/CHR_CheckStudent', {
            id: $(this).attr('homeroom-id'),
            keyword: $(this).attr('homeroom-keyword')
        }, function(data) {
            //console.log(data);

            $.each(data, function(key, val) {
                //console.log(val[0].StudentFirstName);
                $('#TB_showstudent').append('<tr class="DelTableRow"><td>' + val[0].StudentNumber + '</td><td>' + val[0].StudentCode + '</td><td>' + val[0].StudentPrefix + val[0].StudentFirstName + ' ' + val[0].StudentLastName + '</td></tr>');
            });
        }, 'json')
        .fail(function(xhr, textStatus, errorThrown) {
            console.log(xhr.responseText);
        });
});


var pathArray = window.location.pathname.split('/');
//console.log(pathArray[5]);
if (pathArray[5]) {
    $.post('../ConTeacherTeaching/ChartHomeRoomAll', { key: pathArray[6] }, function(show) {
            console.log(show);
            var BARCHARTEXMPLE = $('#chart-doughnut');
            var barChartExample = new Chart(BARCHARTEXMPLE, {
                type: 'bar',
                data: {
                    labels: ["มา", "ขาด", "สาย", "ลา", "กิจกรรม", "ไม่เข้าแถว"],
                    datasets: [{
                        label: 'จำนวน',
                        data: show,
                        backgroundColor: [
                            'rgba(121, 106, 238, 1)',
                            'rgba(255, 118, 118, 1)',
                            'rgba(84, 230, 157, 1)',
                            'rgba(255, 195, 109, 1)',
                            'rgba(109, 242, 255, 1)',
                            'rgba(255, 109, 244, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            });

        }, "json")
        .fail(function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
        });
}

//ครูที่ปรึกษา
var pathArray = window.location.pathname.split('/');
console.log(pathArray[3]);
if (pathArray[3] != 'CheckHomeRoomDashboard') {
    console.log($('#DateToDay').val());
    $.post('../ConTeacherTeaching/ChartHomeRoom', { DateToDay: $('#DateToDay').val() }, function(show) {

        var BARCHARTEXMPLE = $('#barChartExample');
        var barChartExample = new Chart(BARCHARTEXMPLE, {
            type: 'bar',
            data: {
                labels: ["มา", "ขาด", "สาย", "ลา", "กิจกรรม", "ไม่เข้าแถว"],
                datasets: [{
                    label: 'จำนวนของวันนี้',
                    data: show,
                    backgroundColor: [
                        'rgba(121, 106, 238, 1)',
                        'rgba(255, 118, 118, 1)',
                        'rgba(84, 230, 157, 1)',
                        'rgba(255, 195, 109, 1)',
                        'rgba(109, 242, 255, 1)',
                        'rgba(255, 109, 244, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        });

    }, "json")
}



$(document).on("submit", ".Add_RoomOnline", function(e) {
    e.preventDefault(e);
    $.ajax({
        url: '../ConTeacherTeaching/AddRoomOnline',
        type: "post",
        data: new FormData(this), //this is formData
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            //console.log(data);
            if (data > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'บันทึกข้อมูลไว้แล้ว',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload();
                    }
                })
            }
        }
    });
});


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

//alert(pathArray[4]);

ChartStatisticsHomeRoom($('#show_date').val());


function ChartStatisticsHomeRoom(Day) {

    $.post('../../ConTeacherTeaching/bar_chart_js', { KeyDay: Day },
        function(data, status) {
            var ma = data;
            var result = [data.ma, data.khad, data.la, data.sahy, data.kid, data.hnee];
            //console.log(ma);
            myChart.data.labels.push('มา', 'ขาด', 'ลา', 'สาย', 'กิจกรรม', 'ไม่เข้า');

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