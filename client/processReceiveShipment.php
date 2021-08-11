<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$count = '';
$vaccineType = '';
$facility = '';
$update = false;

if (isset($_POST['save'])) {
    $count = $_POST['count'];
    $vaccineType = $_POST['vaccineType'];
    $date = $_POST['date'];
    $facility = explode(":", $_POST['facility']);
    $facilityName = $facility[0];
    $facilityAddress = $facility[1];
    $mysqli->query("INSERT INTO VaccineShipment (nameHSO, address, date, count, nameDrug) VALUES ('$facilityName', '$facilityAddress', '$date', $count, '$vaccineType');") or
        die($mysqli->error);
    $result = $mysqli->query("SELECT * FROM VaccineStored WHERE nameHSO = '$facilityName' AND address = '$facilityAddress' AND nameDrug = '$vaccineType';")or
        die($mysqli->error);
    $row = $result->fetch_assoc();
    if(!$row) {
        echo "here1";
        $mysqli->query("INSERT INTO VaccineStored (nameHSO, address, nameDrug, count) VALUES ('$facilityName', '$facilityAddress', '$vaccineType', $count);") or
            die($mysqli->error);
    } else {
        echo "here";
        $mysqli->query("UPDATE VaccineStored SET count=count+".$count." WHERE nameHSO = '$facilityName' AND address = '$facilityAddress' AND nameDrug = '$vaccineType';") or
            die($mysqli->error);
    }
    $_SESSION['message'] = "VaccineShipment has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: receiveShipment.php");
}
