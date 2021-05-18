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

?>
<br>

<div class="container">
  <label for="company_id">เลือกรหัสcompany</label>
  <select class="w3-input w3-border" name="company_id" id="company_id">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
  </select>
  <br><br>
  <button onclick="load_index(company_id)" type="submit" value="Submit">submit</button>
</div>


</body>

<script>
function load_index() {


    var company_id = $("#company_id").val();

    console.log(company_id);

    var x = "index.php?company_id=" + company_id;

//var x = "sup_page.php?id='+id+'";

window.location.href = x ;
}
</script>
</html>

