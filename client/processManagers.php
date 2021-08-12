<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$update = false;

if (isset($_POST['save'])) {
    $EID = $_POST['EID'];
    $facility = explode(":", $_POST['facility']);
    $facilityName = $facility[0];
    $facilityAddress = $facility[1];
    $result = $mysqli->query("SELECT * FROM Managers WHERE name='$facilityName' AND address = '$facilityAddress'");
    $row = $result->fetch_assoc();
    if ($row) {
        $_SESSION['message'] = "ERROR: Facility $facilityName already has a manager.";
        $_SESSION['msg_type'] = "danger";
        header("location: managers.php");
        return;
    }
    $myqli->query("INSERT INTO Managers (EID, name, address, startDate) VALUES ('$EID', '$facilityName', '$facilityAddress', '$date');");
    $_SESSION['message'] = "$EID is now the manager of $facilityName";
    $_SESSION['msg_type'] = "success";
    header("location: managers.php");
}

if (isset($_GET['delete'])) {
    $EID = $_GET['EID'];
    $name = $_GET['name'];
    $address = $_GET['address'];
    # Delete the related manager
    $mysqli->query("DELETE FROM Managers WHERE EID='$EID' AND name='$name' AND address='$address';") or
        die($mysqli->error);
    echo $EID." ".$name." ".$address;
    $_SESSION['message'] = "Manager $EID has been deleted from $name";
    $_SESSION['msg_type'] = "danger";
    header("location: managers.php");
}

if (isset($_GET['edit'])) {
    $EID = $_GET['EID'];
    $name = $_GET['name'];
    $address = $_GET['address'];

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
    $EID= $_POST['passportNumOrSSN'];
    $name = $_POST['dateInfection'];
    $address = $_POST['variantTypeID'];

    # update the person
    $mysqli->query('UPDATE Infection SET passportNumOrSSN = '. $passportNumOrSSN.',
        dateInfection="'. $dateInfection. '",variantTypeID=' . $variantTypeID .'
        WHERE passportNumOrSSN='.$passportNumOrSSN.' AND dateInfection="'.$dateInfection.'"') or
        die($mysqli->error);
    
    $_SESSION['message'] = "Infection record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: infections.php");
}
