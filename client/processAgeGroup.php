<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$ageGroupID = '';
$ageRange = '';
$update = false;

if (isset($_POST['save'])) {
    $ageGroupID = $_POST['ageGroupID'];
    $ageRange = $_POST['ageRange'];

    $mysqli->query("INSERT INTO AgeGroup (ageGroupID, ageRange) VALUES('$ageGroupID', '$ageRange')") or
        die($mysqli->error);

    $_SESSION['message'] = "New Age Group has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: ageGroup.php");
}

if (isset($_GET['delete'])) {
    $ageGroupID = $_GET['delete'];
    $mysqli->query("DELETE from AgeGroup WHERE ageGroupID=$ageGroupID") or
        die($mysqli->error);

    $_SESSION['message'] = "Age Group has been Deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: ageGroup.php");
}

if (isset($_GET['edit'])) {
    $ageGroupID = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from AgeGroup WHERE ageGroupID=$ageGroupID") or
        die($mysqli->error);
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $ageGroupID = $row['ageGroupID'];
        $ageRange = $row['ageRange'];
    }
}

if (isset($_POST['update'])) {
    $ageGroupID = $_POST['ageGroupID'];
    $ageRange = $_POST['ageRange'];

    $mysqli->query("UPDATE AgeGroup SET ageGroupID = $ageGroupID, ageRange='$ageRange' WHERE ageGroupID=$ageGroupID") or
        die($mysqli->error);
    $_SESSION['message'] = "AgeGroup record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: ageGroup.php");
}
