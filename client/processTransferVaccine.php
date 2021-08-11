<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$count = '';
$vaccineType = '';
$facilityFrom = '';
$facilityTo = '';
$date = '';
$update = false;

if (isset($_POST['save'])) {
    $count = $_POST['count'];
    $vaccineType = $_POST['vaccineType'];
    $date = $_POST['date'];
    $facilityFrom = explode(":", $_POST['facilityFrom']);
    $facilityTo = explode(":", $_POST['facilityTo']);
    $facilityFromName = $facilityFrom[0];
    $facilityFromAddress = $facilityFrom[1];
    $facilityToName = $facilityTo[0];
    $facilityToAddress = $facilityTo[1];
    echo $count." ".$vaccineType." ".$date." ".$facilityFromName." ".$facilityFromAddress." ".$facilityToName." ".$facilityToAddress." ";
    if ($facilityFromName == $facilityToName and $facilityFromAddress == $facilityToAddress) {
        $_SESSION['message'] = "ERROR: TO and FROM locations are the same";
        $_SESSION['msg_type'] = "danger";
        header("location: transferVaccine.php");
        return;
    }
    $mysqli->query("UPDATE VaccineStored SET count = count - $count WHERE nameHSO = '$facilityFromName' AND address = '$facilityFromAddress' AND nameDrug = '$vaccineType' and count >= $count;")  or
        die($mysqli->error);
    echo $mysqli->affected_rows;
    if ($mysqli->affected_rows < 1) {
         $_SESSION['message'] = "ERROR: Facility $facilityFromName does not have $count doses of $vaccineType available for transfer";
        $_SESSION['msg_type'] = "danger";
        header("location: transferVaccine.php");
        return;
    }
    $result = $mysqli->query("SELECT * FROM VaccineStored WHERE nameHSO = '$facilityToName' AND address = '$facilityToAddress' AND nameDrug = '$vaccineType';") or
        die($mysqli->error);
    $row = $result->fetch_assoc();
    if(!$row) {
        echo "here1";
        $mysqli->query("INSERT INTO VaccineStored (nameHSO, address, nameDrug, count) VALUES ('$facilityToName', '$facilityToAddress', '$vaccineType', $count);") or
            die($mysqli->error);
    } else {
        echo "here2";
        $mysqli->query("UPDATE VaccineStored SET count = count + $count WHERE nameHSO = '$facilityToName' AND address = '$facilityToAddress' AND nameDrug = '$vaccineType';") or
            die($mysqli->error);
    }
    $mysqli->query("INSERT INTO VaccineTransfer (nameHSOFrom, nameHSOTo, addressFrom, addressTo, nameDrug, date, count) VALUES ('$facilityFromName', '$facilityToName', '$facilityFromAddress', '$facilityToAddress', '$vaccineType', '$date', '$count');") or
            die($mysqli->error);
    $_SESSION['message'] = "$count doses of $vaccineType transferred from $facilityFromName to $facilityToName!";
    $_SESSION['msg_type'] = "success";
    header("location: transferVaccine.php");
    return;
}
