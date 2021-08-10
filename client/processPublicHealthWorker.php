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
    $medicare = $_POST['medicare'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $provinceID = $_POST['provinceID'];
    $city = $_POST['city'];
    $postalCode = $_POST['postalCode'];
    $email = $_POST['email'];
    $citizenship = $_POST['true'];
    $result = $mysqli->query("SELECT * FROM PostalCode WHERE address = '$address' AND city = '$city' AND provinceID = $provinceID AND postalCode = '$postalCode';")or
        die($mysqli->error);
    $row = $result->fetch_assoc();
    if(!$row) {
        $mysqli->query("INSERT INTO PostalCode (address, city, provinceID, postalCode) VALUES ('$address', '$city', $provinceID, '$postalCode');") or
            die($mysqli->error);
    }
    $mysqli->query("INSERT INTO Employee (address, citizenship, city, dateOfBirth, EID, email, firstName, lastName, medicare, provinceID, SSN, telephone) VALUES('$address', 1, '$city', '$dateOfBirth', '$EID', '$email', '$firstName', '$lastName', '$medicare', $provinceID, '$SSN','$telephone' )") or
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
    $result = $mysqli->query("SELECT Employee.EID, Employee.SSN, Employee.medicare, Employee.firstName, Employee.lastName, Employee.dateOfBirth, Employee.telephone, Employee.address, PostalCode.postalCode, Province.name as provinceName, Province.provinceID, Employee.city, Employee.email, Employee.citizenship FROM Employee, PostalCode, Province WHERE Employee.address = PostalCode.address AND Employee.provinceID = Province.provinceID AND Employee.city = PostalCode.city AND Employee.provinceID = PostalCode.provinceID AND Employee.EID = '$EID';") or
        die($mysqli->error);
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $EID = $row['EID'];
        $SSN = $row['SSN'];
        $medicare = $row['medicare'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $dateOfBirth = $row['dateOfBirth'];
        $telephone = $row['telephone'];
        $address = $row['address'];
        $postalCode = $row['postalCode'];
        $provinceID = $row['provinceID'];
        $email = $row['email'];
        $citizenship = $row['citizenship'];
    }
}

if (isset($_POST['update'])) {
    $EID = $_POST['EID'];
    $SSN = $_POST['SSN'];
    $medicare = $_POST['medicare'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $provinceID = $_POST['provinceID'];
    $city = $_POST['city'];
    $postalCode = $_POST['postalCode'];
    $email = $_POST['email'];
    $citizenship = $_POST['citizenship'];
    $result = $mysqli->query("SELECT * FROM PostalCode WHERE address = '$address' AND city = '$city' AND provinceID = $provinceID AND postalCode = '$postalCode';")or
        die($mysqli->error);
    $row = $result->fetch_assoc();
    if(!$row) {
        $mysqli->query("INSERT INTO PostalCode (address, city, provinceID, postalCode) VALUES ('$address', '$city', $provinceID, '$postalCode');") or
            die($mysqli->error);
    } else {
        $mysqli->query("UPDATE PostalCode SET address='$adress', city='$city', provinceID=$provinceID' WHERE postalCode ='$postalCode';") or
            die($mysqli->error);
    }
    $mysqli->query("UPDATE Employee SET EID='$EID', SSN='$SSN', medicare = '$medicare', firstName = '$firstName', lastName = '$lastName', dateOfBirth = '$dateOfBirth', telephone = '$telephone', address = '$address', provinceID=$provinceID, city='$city', email='$email', citizenship=$citizenship WHERE EID='$EID';") or
        die($mysqli->error);
    $_SESSION['message'] = "Public Health Worker record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: publicHealthWorker.php");
}
