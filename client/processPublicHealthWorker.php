<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$EID = '';
$SSN = '';
$medicare = '';
$firstName = '';
$lastName = '';
$dateOfBirth = '';
$telephone = '';
$address = '';
$postalCode = '';
$provinceID = '';
$email = '';
$citizenship = '';
$update = false;

if (isset($_POST['save'])) {
    $EID = $_POST['EID'];
    $SSN = $_POST['SSN'];
    $mysqli->query("INSERT INTO Employee (EID, SSN) VALUES('$EID', '$SSN')") or
        die($mysqli->error);
    $_SESSION['message'] = "New Public Health Worker has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: publicHealthWorker.php");
}

if (isset($_GET['delete'])) {
    $EID = $_GET['delete'];
    $mysqli->query("DELETE from Employee WHERE EID='$EID'") or
        die($mysqli->error);
    $_SESSION['message'] = "Public Health Worker has been Deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: publicHealthWorker.php");
}

if (isset($_GET['edit'])) {
    $EID = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM Employee where EID = '$EID';") or
        die($mysqli->error);
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $EID = $row['EID'];
        $SSN = $row['SSN'];
    }
}

if (isset($_POST['update'])) {
    $EID = $_POST['EID'];
    $SSN = $_POST['SSN'];
    $mysqli->query("UPDATE Employee SET EID='$EID', SSN='$SSN' WHERE EID='$EID';") or
        die($mysqli->error);
    $_SESSION['message'] = "Public Health Worker record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: publicHealthWorker.php");
}
