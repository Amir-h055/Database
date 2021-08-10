<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$provinceID = '';
$currentAgeGroupID = '';
$name = '';
$update = false;

if (isset($_POST['save'])) {
    $provinceID = $_POST['provinceID'];
    $ageGroupID = $_POST['ageGroupID'];
    $name = $_POST['name'];
    
    $mysqli->query("INSERT INTO Province VALUES($provinceID,'$name', $ageGroupID)") or
        die($mysqli->error);

    $_SESSION['message'] = "New Province has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: provinces.php");
}

if (isset($_GET['delete'])) {
    $provinceID = $_GET['delete'];
    $mysqli->query("DELETE from Province WHERE provinceID='$provinceID'") or
        die($mysqli->error);
    $_SESSION['message'] = "Province has been Deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: provinces.php");
}

if (isset($_GET['edit'])) {
    $provinceID = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from Province WHERE provinceID='$provinceID'") or
        die($mysqli->error);
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $provinceID = $row['provinceID'];
        $currentAgeGroupID = $row['currentAgeGroupID'];
        $name = $row['name'];
    }
}

if (isset($_POST['update'])) {
    $provinceID = $_POST['provinceID'];
    $ageGroupID = $_POST['ageGroupID'];
    $name = $_POST['name'];
    $mysqli->query("UPDATE Province SET provinceID=$provinceID,
        currentAgeGroupID = $ageGroupID, name='$name' WHERE provinceID=$provinceID") or
        die($mysqli->error);
    $_SESSION['message'] = "Province record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: provinces.php");
}
