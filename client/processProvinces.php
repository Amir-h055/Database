<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$provinceID = '';
$ageGroupID = '';
$update = false;

if (isset($_POST['save'])) {
    $provinceID = $_POST['provinceID'];
    $ageGroupID = $_POST['ageGroupID'];
    $mysqli->query("INSERT INTO ProvinceCurrentAgeGroup (provinceID, ageGroupID) VALUES('$provinceID', $ageGroupID)") or
        die($mysqli->error);

    $_SESSION['message'] = "New Province has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: provinces.php");
}

if (isset($_GET['delete'])) {
    $provinceID = $_GET['delete'];
    $mysqli->query("DELETE from ProvinceCurrentAgeGroup WHERE provinceID='$provinceID'") or
        die($mysqli->error);
    $_SESSION['message'] = "Province has been Deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: provinces.php");
}

if (isset($_GET['edit'])) {
    $provinceID = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from ProvinceCurrentAgeGroup WHERE provinceID='$provinceID'") or
        die($mysqli->error);
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $provinceID = $row['provinceID'];
        $ageGroupID = $row['ageGroupID'];
    }
}

if (isset($_POST['update'])) {
    $provinceID = $_POST['provinceID'];
    $ageGroupID = $_POST['ageGroupID'];

    $mysqli->query("UPDATE ProvinceCurrentAgeGroup SET provinceID='$provinceID', ageGroupID = $ageGroupID WHERE provinceID='$provinceID'") or
        die($mysqli->error);
    $_SESSION['message'] = "Province record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: provinces.php");
}
