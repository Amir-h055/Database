<?php
    $currentPage = 'Person';
    include('common/header.php');
?>
        <!-- Page Content -->
        <div id="content">
            <?php require_once 'processPerson.php'; ?>
            <?php
            if (isset($_SESSION['message'])) : ?>
                <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>
            <div class="container">
                <div class="container mt-2 mb-4 p-2 shadow bg-white">
                    <div class="row justify-content-center">
                        <form action="processAgeGroup.php" method="POST">
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="text" name="passportNumOrSSN" class="form-control" value="<?php echo $passportNumOrSSN; ?>" placeholder="Passport Num or SSN">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="medicaidNum" class="form-control" value="<?php echo $medicaidNum; ?>" placeholder="Medicaid">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="telephone" class="form-control" value="<?php echo $telephone; ?>" placeholder="Telephone">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>" placeholder="First Name">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>" placeholder="Last Name">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="address" class="form-control" value="<?php echo $address; ?>" placeholder="Address">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="city" class="form-control" value="<?php echo $city; ?>" placeholder="City">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="postalCode" class="form-control" value="<?php echo $postalCode; ?>" placeholder="Postal Code">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="ageGroupID" class="form-control" value="<?php echo $ageGroupID; ?>" placeholder="Age Group ID">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="provinceID" class="form-control" value="<?php echo $provinceID; ?>" placeholder="Province ID">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="citizenship" class="form-control" value="<?php echo $citizenship; ?>" placeholder="Citizenship">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="dateOfBirth" class="form-control" value="<?php echo $dateOfBirth; ?>" placeholder="Date Of Birth">
                                </div>
                                <div class="col-auto form-group">
                                    <?php
                                    if ($update == true) :
                                    ?>
                                        <button type="submit" name="update" class="btn btn-info">Update</button>
                                    <?php else : ?>
                                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                                    <?php endif; ?>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM Person") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Passport Num or SSN</th>
                            <th>Medicaid</th>
                            <th>Telephone</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>PostalCode</th>
                            <th>Age Group ID</th>
                            <th>Province ID</th>
                            <th>Citizenship</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th colspan=2>Actions</th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                        <?php
                            $pc = $mysqli->query('SELECT postalCode FROM PostalCode WHERE address="' . $row['address']. '" AND ' .
                            'city="' . $row['city'] . '" AND provinceID=' . $row['provinceID']) or die($mysqli->error);
                        ?>
                            <td><?php echo $row['passportNumOrSSN']; ?></td>
                            <td><?php echo $row['medicaidNum']; ?></td>
                            <td><?php echo $row['telephone']; ?></td>
                            <td><?php echo $row['firstName']; ?></td>
                            <td><?php echo $row['lastName']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $pc->fetch_array()[0];?></td>
                            <td><?php echo $row['ageGroupID']; ?></td>
                            <td><?php echo $row['provinceID']; ?></td>
                            <td><?php echo $row['citizenship']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['dateOfBirth']; ?></td>
                            <td>
                                <a href="person.php?edit=<?php echo $row['passportNumOrSSN']; ?>" class="btn btn-info"> Edit </a>
                                <a href="processPerson.php?delete=<?php echo $row['passportNumOrSSN']; ?>" class="btn btn-danger"> Delete </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
