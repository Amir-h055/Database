<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$update = false;

$variantTypeID = '';
$name = '';

if (isset($_POST['save'])) {
    $variantTypeID = $_POST['variantTypeID'];
    $name = $_POST['name'];
    
    # Insert the person
    $mysqli->query("INSERT INTO VariantType VALUES('$variantTypeID','$name')") or
        die($mysqli->error);

    $_SESSION['message'] = "New Varant Type has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: variantType.php");
}

if (isset($_GET['delete'])) {
    $variantTypeID = $_GET['delete'];
    
    # Delete the related infection
    $mysqli->query('DELETE FROM VariantType WHERE variantTypeID="'.$variantTypeID.'"') or
        die($mysqli->error);

    $_SESSION['message'] = "Vaccination Type has been Deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: variantType.php");
}

if (isset($_GET['edit'])) {
    $variantTypeID = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from VariantType WHERE variantTypeID=$variantTypeID") or
        die($mysqli->error);
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $name = $row['name'];
    }

}

if (isset($_POST['update'])) {
    $variantTypeID = $_POST['variantTypeID'];
    $name = $_POST['name'];
    echo $name;
    # update the person
    $mysqli->query("UPDATE VariantType SET variantTypeID=$variantTypeID, name='$name' WHERE variantTypeID=$variantTypeID;") or
        die($mysqli->error);
    $_SESSION['message'] = "Variant Type record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: variantType.php");
}
?>
