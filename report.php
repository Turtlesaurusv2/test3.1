<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    div {

        margin: auto;
    }

    table {
        margin: auto;
        width: 70%;
        height: 70%;
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootpag/1.0.7/jquery.bootpag.min.js">
    </script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>report</title>
</head>

<body>
    ิ<br>
    <?php

$company_id = $_GET['company_id'];

$inv_id = $_GET['id'];



echo $inv_id;

?>
    <input type="hidden" name="company_id" id="company_id" value="<?php echo $company_id; ?>" />
    <input type="hidden" name="inv_id" id="inv_id" value="<?php echo $inv_id; ?>" />
    <br>


    <div class=" containner">
        <table style="padding-top:10px">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>รหัสรอบหลัก</th>
                    <th>company_id</th>
                    <th>รหัสสินค้า</th>
                    <th>buy</th>
                    <th>sell</th>
                    <th>system</th>
                    <th>จำนวน</th>
                    <th>diff</th>
                </tr>
                </thesd>
            <tbody id="result"></tbody>
        </table>
    </div>
    <br>

    <br>
    <h1 class="w3-center">ข้อมูลทั้งหมด</h1>
    ิ<br>
    <table style="padding-top:10px">
        <thead>
            <tr>
                <th>company_id</th>
                <th>รหัสสินค้า</th>
                <th>system</th>

            </tr>
            </thesd>
        <tbody id="result2"></tbody>
    </table>


    <div class="w3-center" id="page-selection"></div>

    </div>



</body>


<script>
//แสดงเฉพราะ (company inv_id sub_id) รหัสต้องตรงกัน  and product_id
$(document).ready(function() {


    load_data();

    function load_data(query = "") {

        var company_id = $('#company_id').val();
        var inv_id = $('#inv_id').val();

        console.log(company_id);

        //ประกาศตัวแปร object 
        var data = {};
        data["query"] = query;
        data["company_id"] = company_id;
        data["inv_id"] = inv_id;
        //ประกาศตัวแปรjson ช
        var query = JSON.stringify(data);

        $.ajax({
            url: "load_report.php",
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



                    var diff = ele.system - ele.quantity;

                    html += "<tr>" +
                        "<td>" + ele.pd_id + "</td>" +
                        "<td>" + ele.inv_id + "</td>" +
                        "<td>" + ele.company_id + "</td>" +
                        "<td>" + ele.pd_c + "</td>" +
                        "<td>" + ele.buy + "</td>" +
                        "<td>" + ele.sell + "</td>" +
                        "<td>" + ele.system + "</td>" +
                        "<td>" + ele.quantity + "</td>" +
                        "<td>" + diff + "</td>" +
                        "<tr>";
                });

                $("#result").html(html);
                // load button

            }

        });

    }

    load_data2();




});

function createPagination(current, page) {
    // แก้ไข เรียกซ้ำซ้อน
    $("#page-selection").unbind();

    $('#page-selection').bootpag({
        total: page, //หน้า  page ทั้งหมด
        page: current, //แสดงหน้าปัจจุบัน
        maxVisible: 6, //จำนวน max หน้า page
        leaps: false,
        next: 'next',
        prev: 'prev'

    }).on('page', function(event, num) {

        var search_text = $("#search_text").val();

        console.log(num);

        load_data2(search_text, num);

    });

}

function load_data2(query = "", page = 1) {

    var company_id = $("#company_id").val();
    //ประกาศตัวแปร object 
    var data = {};
    data["query"] = query;
    data["page"] = page;
    data["company_id"] = company_id;
    //ประกาศตัวแปรjson ช
    var query = JSON.stringify(data);

    $.ajax({
        url: "load_inv.php",
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
                    "<td>" + ele.company_id + "</td>" +
                    "<td>" + ele.product_id + "</td>" +
                    "<td>" + ele.system + "</td>" +
                    "</tr>";
            });

            $("#result2").html(html);
            // load button
            createPagination(res.currentPage, res.page);

        }

    });

}
</script>

</html>