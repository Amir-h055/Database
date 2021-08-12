<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$address = '';
$city = '';
$name = '';
$provinceID = '';
$postalCode = '';
$telephone = '';
$type = '';
$webAddress = '';
$update = false;

if (isset($_POST['save'])) {
    $address = $_POST['address'];
    $city = $_POST['city'];
    $name = $_POST['name'];
    $provinceID = $_POST['provinceID'];
    $telephone = $_POST['telephone'];
    $type = $_POST['type'];
    $webAddress = $_POST['webAddress'];
    $result = $mysqli->query("SELECT * FROM PostalCode WHERE address = '$address' AND city = '$city' AND provinceID = $provinceID AND postalCode = '$postalCode';")or
        die($mysqli->error);
    $row = $result->fetch_assoc();
    if(!$row) {
        $mysqli->query("INSERT INTO PostalCode (address, city, provinceID, postalCode) VALUES ('$address', '$city', $provinceID, '$postalCode');") or
            die($mysqli->error);
    } else {
        $mysqli->query("UPDATE PostalCode SET address='$address', city='$city', provinceID=$provinceID WHERE postalCode = '$postalCode';") or
            die($mysqli->error);
    }
    $mysqli->query("INSERT INTO HealthFacility (address, city, name, provinceID, telephone, type, webAddress) VALUES('$address', '$city', '$name', $provinceID, '$telephone', '$type', '$webAddress');") or
        die($mysqli->error);
    $_SESSION['message'] = "New Public Health Facility has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: publicHealthFacility.php");
}

if (isset($_GET['delete'])) {
    $name = $_GET['name'];
    $address = $_GET['address'];
    $mysqli->query("DELETE from HealthFacility WHERE name='$name' AND address = '$address';") or
        die($mysqli->error);
    $_SESSION['message'] = "Public Health Facility has been Deleted";
    $_SESSION['msg_type'] = "danger";
    header("location: publicHealthFacility.php");
}

if (isset($_GET['edit'])) {
    $name = $_GET['name'];
    $address = $_GET['address'];
    $update = true;
    $result = $mysqli->query("SELECT HealthFacility.name, HealthFacility.address, HealthFacility.city, HealthFacility.provinceID, PostalCode.postalCode, Province.name AS provinceName, HealthFacility.telephone, HealthFacility.webAddress, HealthFacility.type FROM HealthFacility, PostalCode, Province WHERE HealthFacility.address = PostalCode.address AND HealthFacility.provinceID = Province.provinceID AND HealthFacility.city = PostalCode.city AND HealthFacility.provinceID = PostalCode.provinceID AND HealthFacility.name = '$name' AND HealthFacility.address='$address';") or
        die($mysqli->error);
    if (count($result) == 1) {
        $row = $result->fetch_array();
        $address = $row['address'];
        $city = $row['city'];
        $name = $row['name'];
        $provinceID = $row['provinceID'];
        $postalCode = $row['postalCode'];
        $telephone = $row['telephone'];
        $type = $row['type'];
        $webAddress = $row['webAddress'];
    }
}

if (isset($_POST['update'])) {
    $address = $_POST['address'];
    $city = $_POST['city'];
    $name = $_POST['name'];
    $provinceID = $_POST['provinceID'];
    $telephone = $_POST['telephone'];
    $type = $_POST['type'];
    $webAddress = $_POST['webAddress'];
    $postalCode = $_POST['postalCode'];
    $result = $mysqli->query("SELECT * FROM PostalCode WHERE address = '$address' AND city = '$city' AND provinceID = $provinceID AND postalCode = '$postalCode';")or
        die($mysqli->error);
    $row = $result->fetch_assoc();
    if(!$row) {
        $mysqli->query("INSERT INTO PostalCode (address, city, provinceID, postalCode) VALUES ('$address', '$city', $provinceID, '$postalCode');") or
            die($mysqli->error);
    } else {
        $mysqli->query("UPDATE PostalCode SET address='$address', city='$city', provinceID=$provinceID WHERE postalCode = '$postalCode';") or
            die($mysqli->error);
    }
    $mysqli->query("UPDATE HealthFacility SET address='$address', city='$city', name='$name', provinceID='$provinceID', telephone='$telephone', type='$type', webAddress='$webAddress' WHERE name='$name' AND address='$address';") or
        die($mysqli->error);
    $_SESSION['message'] = "Public Health Facility record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: publicHealthFacility.php");
}
