function onScanSuccess(decodedText, decodedResult) {
    $.post("../ConTeacherTeacherJob/CheckNameFrontSchoolInsert", {
                IdStu: decodedText
            },
            function(data, status) {
                if (status === "success") {
                    if (data == 0) {
                        Swal.fire(
                            'แจ้งเตือน!',
                            'นักเรียนได้สแกนชื่อเข้าโรงเรียนแล้ว!',
                            'success'
                        )
                    } else {
                        let tableRef = document.getElementById('AddStu').getElementsByTagName('tbody')[0];
                        tableRef.insertRow(0).innerHTML =
                            "<td>" + data[0].StudentClass + "</td>" +
                            "<td>" + data[0].StudentCode + "</td>" +
                            "<td>" + data[0].StudentPrefix + data[0].StudentFirstName + ' ' + data[0].StudentLastName + "</td>" +
                            "<td>" + data[0].cnfs_date + "</td>" +
                            "<td>" + data[0].cnfs_time + "</td>" +
                            "<td>" + data[0].cnfs_status + "</td>";
                    }
                }
            },
            "json")
        .fail(function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
        });


    // let tableRef = document.getElementById('AddStu').getElementsByTagName('tbody')[0];
    // tableRef.insertRow().innerHTML =
    //     "<th scope='row'>" + 5 + "</th>" +
    //     "<td>" + 5 + "</td>" +
    //     "<td>" + 6 + "</td>" +
    //     "<td>" + 2 + "</td>" +
    //     "<td>" + 1 + "</td>" +
    //     "<td>" + 1 + "</td>";

    // Handle on success condition with the decoded text or result.
    // console.log(`Scan result: ${decodedText}`, decodedResult);
    //html5QrcodeScanner.clear();
}

function onScanError(errorMessage) {
    // handle on error condition, with error message
    alert('Error มึงเนี้ย');
}

var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", {
        fps: 10,
        qrbox: 250
    });
html5QrcodeScanner.render(onScanSuccess);