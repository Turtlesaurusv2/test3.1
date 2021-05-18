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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>subpage</title>
</head>

<?php
include('db_conn.php'); 

$id = $_GET['id'];
$company_id = $_GET['company_id'];

?>

<body>

    <br /><br />
    <div class="container" style="width:700px;">

        <div align="right">
            <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal"
                class="btn btn-warning">Add</button>
        </div>
    </div>



    <div class="container">

        <div align="center">
            <button onclick="group_by();" type="button" name="gb" id="gb" class="btn btn-warning">group by</button>
        </div>
    </div>

    <div class="w3-container">

        <br>

        <table style="padding-top:10px">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>จำนวน</th>
                    <th>รหัสรอบนับ</th>
                    <th>รหัสสินค้าเช็ค</th>
                    <th>company_id</th>
                </tr>
                </thesd>
            <tbody id="result"></tbody>
        </table>
        <br>
        <h1 id="id"></h1>
        <tbody colspan="5" id="invoiceBody"> </tbody>

        <div id="add_data_Modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">เพิ่มสินค้า</h4>
                    </div>
                    <div class="modal-body">
                        <div method="post">
                            <label>เช็ค product id</label>
                            <input type="text" name="pd_c" id="pd_c" class="form-control" />
                            <br />
                            <label>จำนวนสินค้า</label>
                            <input type="text" name="quantity" id="quantity" class="form-control" />
                            <br />
                            <input type="hidden" name="sub_id" id="sub_id" value="<?php echo $id; ?>" />
                            <br />
                            <input type="hidden" name="company_id" id="company_id" value="<?php echo $company_id; ?>" />
                            <br />

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

        <br>




    </div>
    <div class="container">


    </div>

</body>

<script>
function send() {

    //ประกาศตัวแปร
    var pd_c = $("#pd_c").val();
    var quantity = $("#quantity").val();
    var sub_id = $("#sub_id").val();
    var company_id = $("#company_id").val();


    var temp = {};
    temp["pd_c"] = pd_c;
    temp["quantity"] = quantity;
    temp["sub_id"] = sub_id;
    temp["company_id"] = company_id;



    //ประกาศตัวแปรjsonเพื่อเก็บข้อมูลจากtemp
    var json = JSON.stringify(temp);

    $.ajax({
        url: "add_pd.php",
        method: "POST",
        data: {
            "json": json
        },
        dataType: "json",
        success: function(response) {

            console.log(response);

            if (response.success == 1) {

                alert(response.message);
            } else {

                alert(response.message);
            }

            location.reload();
        }

    });
}

function group_by(query = "") {

    //ประกาศตัวแปร
    var sub_id = $("#sub_id").val();
    var company_id = $("#company_id").val();



    var data = {};

    data["query"] = query;
    data["sub_id"] = sub_id;
    data['company_id'] = company_id;
    //ประกาศตัวแปรjson ช
    var query = JSON.stringify(data);


    $.ajax({

        url: "group_by.php",
        method: "POST",
        data: {
            "query": query
        },
        dataType: "json",
        success: function(res) {

            
            location.reload();

            // load button
        }

    });
}


$(document).ready(function() {

    load_data();

    function load_data(query = "") {


        var sub_id = $("#sub_id").val();

        //ประกาศตัวแปร object 
        var data = {};
        data["sub_id"] = sub_id;
        data["query"] = query;
        //ประกาศตัวแปรjson ช
        var query = JSON.stringify(data);

        $.ajax({
            url: "load_product.php",
            method: "POST",
            async: false,
            data: {
                "query": query
            },
            dataType: "json",
            success: function(data) {

                var result = data.res;

                var html = "";
                if (result == "") {
                    html = `ไม่มีข้อมูล`;
                } else {

                    result.forEach(ele => {

                        html += "<tr>" +
                            "<td>" + ele.pd_id + "</td>" +
                            "<td>" + ele.quantity + "</td>" +
                            "<td>" + ele.sub_id + "</td>" +
                            "<td>" + ele.pd_c + "</td>" +
                            "<td>" + ele.company_id + "</td>" +
                            "</tr>";
                    });
                }

                $("#result").html(html);
                // load button

            }

        });

    }



});
</script>

</html>