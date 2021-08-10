<?php

session_start();

$mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
$update = false;

$passportNumOrSSN = '';
$medicaidNum = '';
$telephone = ''; 
$firstName = '';
$lastName = '';
$address = '';
$city = '';
$ageGroupID = '';
$provinceID = '';
$citizenship = '';
$email = '';
$dateOfBirth = '';
$postalCode = '';

$pc = '';

if (isset($_POST['save'])) {
    $passportNumOrSSN= $_POST['passportNumOrSSN'];
    $medicaidNum = $_POST['medicaidNum'];
    $telephone = $_POST['telephone'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $ageGroupID = $_POST['ageGroupID'];
    $provinceID = $_POST['provinceID'];
    $citizenship = $_POST['citizenship'];
    $email = $_POST['email'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $postalCode = $_POST['postalCode'];
    
    # Insert the person
    $mysqli->query("INSERT INTO Person (passportNumOrSSN, medicaidNum, telephone, firstName, lastName, address, city, provinceID, citizenship, email, dateOfBirth) VALUES('$passportNumOrSSN',
        '$medicaidNum', '$telephone', '$firstName', '$lastName', '$address',
        '$city', $provinceID, '$citizenship', '$email', '$dateOfBirth')") or
        die($mysqli->error);

    # Check if the postal code already exist
    $result = $mysqli->query('SELECT * FROM PostalCode WHERE address = "'. $address. '" AND
        city = "' .$city.'" AND provinceID = '. $provinceID) or die($mysqli->error);
    if(count($result) == 0) {
        # Insert the new postal code tuple
        $mysqli->query('INSERT INTO PostalCode VALUES ("'. $address .'", "'. $city .'",
             "' .$provinceID . '", "' . $postalCode. '")') or die($mysqli->error);
    }

    $_SESSION['message'] = "New Person has been saved!";
    $_SESSION['msg_type'] = "success";
    header("location: person.php");
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
    header("location: person.php");
}

if (isset($_GET['edit'])) {
    $passportNumOrSSN = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from Person WHERE passportNumOrSSN=$passportNumOrSSN") or
        die($mysqli->error);
    if ($result->num_rows == 1 ) {
        $row = $result->fetch_array();
        $passportNumOrSSN= $row['passportNumOrSSN'];
        $medicaidNum = $row['medicaidNum'];
        $telephone = $row['telephone'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $address = $row['address'];
        $city = $row['city'];
        $ageGroupID = $row['ageGroupID'];
        $provinceID = $row['provinceID'];
        $citizenship = $row['citizenship'];
        $email = $row['email'];
        $dateOfBirth = $row['dateOfBirth'];
        # Get the postal Code
        $result = $mysqli->query('SELECT * from PostalCode WHERE address="'. $address .
        '" AND city="' . $city. '" AND provinceID ='.$provinceID) or
        die($mysqli->error);
        if ($result->num_rows == 1) {
            $row = $result->fetch_array();
            $postalCode = $row['postalCode'];
        }
    }
}

if (isset($_POST['update'])) {
    $passportNumOrSSN= $_POST['passportNumOrSSN'];
    $medicaidNum = $_POST['medicaidNum'];
    $telephone = $_POST['telephone'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $ageGroupID = $_POST['ageGroupID'];
    $provinceID = $_POST['provinceID'];
    $citizenship = $_POST['citizenship'];
    $email = $_POST['email'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $postalCode = $_POST['postalCode'];

    # update the person
    $mysqli->query("UPDATE Person SET passportNumOrSSN = '$passportNumOrSSN', medicaidNum = '$medicaidNum', telephone = '$telephone', firstName='$firstName', lastName='$lastName', address='$address', city='$city', ageGroupID=$ageGroupID, provinceID=$provinceID, citizenship=$citizenship, email='$email', dateOfBirth='$dateOfBirth' WHERE passportNumOrSSN='$passportNumOrSSN';") or
        die($mysqli->error);
    # Check if address exist
    $result = $mysqli->query("SELECT * FROM PostalCode WHERE address = '$address' AND city='$city' AND provinceID = $provinceID; ") or
        die($mysqli->error);
    if ($result->num_rows == 1) {
        #update the postal code
        $mysqli->query("UPDATE PostalCode SET postalCode = '$postalCode' WHERE address = '$address' AND city='$city' AND provinceID = $provinceID;") or
            die($mysqli->error);
    } else {
        # If new address not exist, Insert the new postal code tuple
        $mysqli->query("INSERT INTO PostalCode (address, city, provinceID, postalCode) VALUES ('$address', '$city', $provinceID, '$postalCode');") or 
            die($mysqli->error);
    }
    $_SESSION['message'] = "Person record has been updated";
    $_SESSION['msg_type'] = "warning";
    header("location: person.php");
}
