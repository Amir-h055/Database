<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$update = false;

$dateInfection = '';
$passportNumOrSSN = '';
$variantTypeID = '';

if (isset($_POST['save'])) {
    $passportNumOrSSN= $_POST['passportNumOrSSN'];
    $dateInfection = $_POST['dateInfection'];
    $variantTypeID = $_POST['variantTypeID'];
    
    # Insert the person
    $mysqli->query("INSERT INTO Infection VALUES('$dateInfection', '$passportNumOrSSN',
        $variantTypeID") or
        die($mysqli->error);

    $_SESSION['message'] = "New Infection has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: infections.php");
}

if (isset($_GET['delete'])) {
    $passportNumOrSSN = $_GET['delete'];
    
    # Delete a person
    $mysqli->query("DELETE FROM Person WHERE passportNumOrSSN=$passportNumOrSSN") or
        die($mysqli->error);
    # Delete the related infection
    $mysqli->query("DELETE FROM Infection WHERE passportNumOrSSN=$passportNumOrSSN") or
        die($mysqli->error);

    $_SESSION['message'] = "Person has been Deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: infections.php");
}

if (isset($_GET['edit'])) {
    $passportNumOrSSN = $_GET['passportNumOrSSN'];
    $dateInfection = $_GET['dateInfection'];

    $update = true;
    $result = $mysqli->query('SELECT * FROM Infection WHERE passportNumOrSSN='.$passportNumOrSSN.' AND
        dateInfection="'.$dateInfection.'"') or
        die($mysqli->error);
    if ($result->num_rows == 1 ) {
        $row = $result->fetch_array();
        $passportNumOrSSN= $row['passportNumOrSSN'];
        $dateInfection = $row['dateInfection'];
        $variantTypeID = $row['variantTypeID'];
    }
}

if (isset($_POST['update'])) {
    $passportNumOrSSN= $_POST['passportNumOrSSN'];
    $dateInfection = $_POST['dateInfection'];
    $variantTypeID = $_POST['variantTypeID'];

    # update the person
    $mysqli->query('UPDATE Infection SET passportNumOrSSN = '. $passportNumOrSSN.',
        dateInfection="'. $dateInfection. '",variantTypeID=' . $variantTypeID .'
        WHERE passportNumOrSSN='.$passportNumOrSSN.' AND dateInfection="'.$dateInfection.'"') or
        die($mysqli->error);
    
    $_SESSION['message'] = "Infection record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: infections.php");
}
