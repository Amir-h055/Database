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
    $passportNumOrSSN = $_POST['passportNumOrSSN'];
    $vaccineType = $_POST['vaccineType'];
    $date = $_POST['date'];
    $facility = explode(":", $_POST['facility']);
    $facilityName = $facility[0];
    $facilityAddress = $facility[1];
    $EID = $_POST['EID'];
    $result = $mysqli->query("SELECT passportNumOrSSN, Count(*) as count FROM Vaccination WHERE passportNumOrSSN = '$passportNumOrSSN' GROUP BY passportNumOrSSN;");
    $row_cnt = $result->num_rows;
    $doseCount = 0;
    if ($row_cnt > 0 ) {
        $row = $result->fetch_array();
        $count = $row['count'];
        echo $count;
        if ($count >= 2) {
            $_SESSION['message'] = "ERROR: Person $passportNumOrSSN has already received 2 doses.";
            $_SESSION['msg_type'] = "danger";
            header("location: performVaccination.php");
            return;
        } else if ($count == 1) {
            $doseCount = 1;
        }
    }
    $result = $mysqli->query("SELECT * FROM JobHistory WHERE EID = '$EID' AND name = '$facilityName' AND address = '$facilityAddress';");
    $row = $result->fetch_assoc();
    if (!$row) {
        $_SESSION['message'] = "ERROR: Employee $EID does not work at facility $facilityName.";
        $_SESSION['msg_type'] = "danger";
        header("location: performVaccination.php");
        return;
    }

    $mysqli->query("UPDATE VaccineStored SET count = count - 1 WHERE nameHSO = '$facilityName' AND address = '$facilityAddress' AND nameDrug = '$vaccineType' and count >= 1;")  or
        die($mysqli->error);
    echo $mysqli->affected_rows;
    if ($mysqli->affected_rows < 1) {
         $_SESSION['message'] = "ERROR: Facility $facilityFromName does not have $count doses of $vaccineType available for vaccination";
        $_SESSION['msg_type'] = "danger";
        header("location: performVaccination.php");
        return;
    }
    $doseCount = $doseCount + 1;
    $mysqli->query("INSERT INTO Vaccination (passportNumOrSSN, doseNumber, date, EID, name, Hname, address) VALUE ('$passportNumOrSSN', $doseCount, '$date', '$EID', '$vaccineType', '$facilityName', '$facilityAddress')") or
        die($mysqli->error);

    $_SESSION['message'] = "Vaccine $vaccineType has been administered to $passportNumOrSSN at facility $facilityName";
    $_SESSION['msg_type'] = "success";
    header("location: performVaccination.php");
    return;
}
