<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    div {

        margin: auto;
    }

    table {
        margin: auto;
        width: 100%;
        height: 100%;
    }

    .butt {
        width: 100%;
        height: 100%;
    }

    .ss {
        text-align: left;
        padding: 8px;
        width: 300px;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        height: 50px;
        border: 1px solid;
    }

    .sf {
        text-align: left;
        padding: 8px;
        width: 300px;
    }


    tr:nth-child(even) {
        background-color: white;
    }
    </style>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Test 3</title>
    <?php 
include('db_conn.php');

$company_id = $_GET["company_id"];

?>
</head>

<body>



    <br /><br />
    <div class="container" style="width:700px;">

        <div align="right">
            <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"
                class="btn btn-warning">Add</button>
        </div>
    </div>

    <div class="container" style="width:700px;">


        <br>
        <a onclick="load_report();">รายงาน</a>
        </br>
        <div class="w3-container">

            <br>

            <table style="padding-top:10px">
                <thead>
                    <tr>
                        <th>รหัสรอบหลัก</th>
                        <th>ชื่อรอบหลัก</th>
                        <th>รหัสcompany</th>
                        <th>วันที่สร้าง</th>
                        <th>ดูรอบนับ</th>
                    </tr>
                    </thesd>
                <tbody id="result"></tbody>
            </table>
            <br>

            <tbody colspan="5" id="invoiceBody"> </tbody>


        </div>


</body>

</html>

<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">เพิ่มรอบหลัก</h4>
            </div>
            <div class="modal-body">
                <div method="post">
                    <label>ชื่อรอบหลัก</label>
                    <input type="text" name="name" id="name" class="form-control" />
                    <br />
                    <br />
                    <input type="hidden" name="company_id" id="company_id" value="<?php echo $company_id; ?>" />
                    <br>
                    <input onclick="send();" type="submit" name="send" id="send" value="เพิ่มข้อมูล"
                        class="btn btn-success" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





<script>
//บันทึกรอบหลัก
function send() {

    //ประกาศตัวแปร
    var name = $("#name").val();
    var company_id = $("#company_id").val();


    var temp = {};
    temp["name"] = name;
    temp["company_id"] = company_id;

    //ประกาศตัวแปรjsonเพื่อเก็บข้อมูลจากtemp
    var json = JSON.stringify(temp);

    $.ajax({
        url: "insert.php",
        method: "POST",
        data: {
            "json": json
        },
        dataType: "json",
        success: function(response) {

            if (response.success == 1) {
                alert(response.message);
            } else {
                alert(response.message);

            }
            location.reload();
        }

    });
}
//บันทึกรอบนับ
function send_sub() {

    //ประกาศตัวแปร
    var sub_name = $("#sub_name").val();
    var inv_id = $("#inv_id").val();
    var company_id = $("#company_id").val();


    var temp = {};
    temp["sub_name"] = sub_name;
    temp["inv_id"] = inv_id;
    temp["company_id"] = company_id;



    //ประกาศตัวแปรjsonเพื่อเก็บข้อมูลจากtemp
    var json = JSON.stringify(temp);

    $.ajax({
        url: "create_sub.php",
        method: "POST",
        data: {
            "json": json
        },
        dataType: "json",

        success: function(response1) {

            if (response1.success == 1) {
                alert(response1.message);
            } else {
                alert(response1.message);

            }

            location.reload();
        }

    });
}


//กึงข้อมูลมาแสดง
$(document).ready(function() {

    load_data();

    function load_data(query = "") {

        var company_id = $("#company_id").val();

        //ประกาศตัวแปร object 
        var data = {};
        data["query"] = query;
        data["company_id"] = company_id
        //ประกาศตัวแปรjson ช
        var query = JSON.stringify(data);

        $.ajax({
            url: "load_main.php",
            method: "POST",
            async: false,
            data: {
                "query": query
            },
            dataType: "json",
            success: function(res) {

                var result = res.result;

                var html = "";
                result.forEach(ele => {

                    html += "<tr>" +
                        "<td>" + ele.inv_id + "</td>" +
                        "<td>" + ele.name + "</td>" +
                        "<td>" + ele.company_id + "</td>" +
                        "<td>" + ele.create_dt + "</td>" +
                        "<td ><button onclick='load(" + ele.inv_id +
                        ");' type='button' class='butt'  name='butsave' id='show' >" +
                        "<i class='fas fa-plus'></i></button>" +
                        "</td>" +
                        "</tr>" +
                        "<br>" +
                        "<tr class='ss' colspan ='5'  id='invoiceBody" + ele.inv_id +
                        "' style='display:none' >" +
                        "</tr>" +
                        "<tr>";
                });

                $("#result").html(html);
                // load button

            }

        });

    }



});

//ดึงรอบนับมาแสดง
function load(id) {

    var company_id = $("#company_id").val();

    var x = document.getElementById("invoiceBody" + id);

    // ajax
    $.ajax({
        url: "get_sub.php",
        type: "POST",
        data: 'id=' + id,
        dataType: 'json',
        success: function(data) {


            //ประกาศตัวแปรเพื่อดเอาข้อมลที่ส่งมา มาใช้งาน
            var rsp = data.res;
            var res = data.res;
            console.log(res);

            if (x.style.display == "none") {

                x.style.display = "block";

                var html = "";

                if (rsp == "") {
                    console.log(rsp);
                    //แสดงส่วนsubถ้าไม่มีข้อมูล
                    html =
                        //ปุ่มเพิ่มรอบนับ
                        `
                <div>
                <button type="button" name="age" id="ag2" data-toggle="modal" data-target="#add_data_Modal2">เพิ่มรอบนับ</button>
                <br>
                ไม่มีข้อมูล` +
                        //แบบฟอร์มสร้างรอบนับ ดึงidจากรอบใหญ่แล้วบันทึกเข้าไปในรอบนับ
                        `<div id="add_data_Modal2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">เพิ่มรอบนับ</h4>
            </div>
            <div class="modal-body">
                <div method="post">
                    <label>ชื่อรอบนับ</label>
                    <input type="text" name="sub_name" id="sub_name" class="form-control" />

                    <input type="hidden" name="inv_id" id="inv_id" value="` + id + `" />

                    
                    <input type="hidden" name="company_id" id="company_id" value="` + company_id + `" />

                    <input onclick="send_sub();" type="submit" name="send_sub" id="send_sub" value="เพิ่มข้อมูล"
                        class="btn btn-success" />

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>`

                } else {
                    //แสดงส่วนsubถ้ามีข้อมูล
                    html =
                        `
                <div>
                <button type="button" name="age" id="ag2" data-toggle="modal" data-target="#add_data_Modal2">เพิ่มรอบนับ</button>
                <br>` +
                        //แบบฟอร์มสร้างรอบนับ ดึงidจากรอบใหญ่แล้วบันทึกเข้าไปในรอบนับ
                        `<div id="add_data_Modal2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">เพิ่มรอบนับ</h4>
            </div>
            <div class="modal-body">
                <div method="post">
                    <label>ชื่อรอบนับ</label>
                    <input type="text" name="sub_name" id="sub_name" class="form-control" />
                    <input class="w3-input w3-border" type="hidden" name="inv_id" id="inv_id" value="` + id + `" disabled='disabled' />
                    <input type="hidden" name="inv_id" id="inv_id" value="` + id + `" />
                    <input class="w3-input w3-border" type="hidden" name="company_id" id="company_id" value="` +
                        company_id + `" disabled='disabled' />
                    <input type="hidden" name="company_id" id="company_id" value="` + company_id + `" />
                    <input onclick="send_sub();" type="submit" name="send_sub" id="send_sub" value="เพิ่มข้อมูล"
                        class="btn btn-success" />

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>`;
                    //หัวตารางที่จะเอาลูปมาใส่/*


                    rsp.forEach(ele => {
                        //ลูปเอาข้อมูลไปใส่ในตารางโดยมีไอดี resu
                        html +=
                            `<br>` +
                            `<tr >
                           <td class="sf">` + ele.sub_id + `</td>
                           <td class="sf">` + ele.sub_name + `</td>
                           <td class="sf">` + ele.company_id + `</td>
                           <td class="sf">` + ele.create_dt + `</td>
                           <td class="sf"><button onclick='load_sub(` + ele.sub_id + `);
                           ' type='button' class='butt'  name='butsave' id='show' >จัดการ
                           </button></td>
                           </tr>`




                    });
                }

                $("#invoiceBody" + id).html(html)
                $("#rsp").html(html);


            } else {
                x.style.display = "none";
            }



        }
    });

}
//redirectไปที่ subpage พร้อม id
function load_sub(id) {

    var company_id = $("#company_id").val();

    var x = "sub_page.php?id=" + id + "&company_id=" + company_id;

    //var x = "sup_page.php?id='+id+'";

    window.location.href = x;

}

//redirectไปที่  report พร้อม id
function load_report() {

var company_id = $("#company_id").val();

var x = "report.php?company_id=" + company_id;

//var x = "sup_page.php?id='+id+'";

window.location.href = x;
}

</script>