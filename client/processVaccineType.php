<?php

session_start();
$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$update = false;

$name = '';

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    
    # Insert the person
    $mysqli->query("INSERT INTO VaccinationDrug VALUES('$name');") or
        die($mysqli->error);

    $_SESSION['message'] = "New Vaccine Type has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: vaccineType.php");
}

if (isset($_GET['delete'])) {
    $name = $_GET['delete'];
    
    # Delete the related infection
    $mysqli->query('DELETE FROM VaccinationDrug WHERE name="'.$name.'"') or
        die($mysqli->error);

    $_SESSION['message'] = "Vaccination Type has been Deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: vaccineType.php");
}

if (isset($_GET['edit'])) {
    $name = $_GET['edit'];

    $update = true;
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];

    # update the Vaccine Type
    $mysqli->query("UPDATE VaccinationDrug SET name = '$name';") or
        die($mysqli->error);
    $_SESSION['message'] = "Vaccine Type record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: vaccineType.php");
}
?>
