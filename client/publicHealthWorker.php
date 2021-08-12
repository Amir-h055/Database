<?php
    $currentPage = 'Public Health Worker';
    include('common/header.php');
?>
        <!-- Page Content -->
        <div id="content">
            <?php require_once 'processPublicHealthWorker.php'; ?>
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
                        <form action="processPublicHealthWorker.php" method="POST">
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="text" name="EID" class="form-control" value="<?php echo $EID; ?>" placeholder="EID">
                                </div>
                                <div class="col-auto form-group">
                                    <select class="form-control" name="SSN" placeholder="Person" value="<?php echo $SSN; ?>">
                                        <option value="" <?php echo $SSN == '' ? 'selected': '' ?> disabled>Person</option>
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT passportNumOrSSN, firstName, lastName FROM Person") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['passportNumOrSSN'] == $SSN ? 'selected': '' ?> value=<?php echo $row['passportNumOrSSN']; ?>><?php echo $row['passportNumOrSSN'].": ".$row['firstName']." ".$row['lastName']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT e.EID, e.SSN, p.medicaidNum, p.firstName, p.lastName, p.dateOfBirth, p.address, p.city, p.provinceID, pr.name as provinceName, p.citizenship, p.email, p.telephone, pc.postalCode FROM PROJECT.Employee e LEFT JOIN Person p ON e.SSN = p.passportNumOrSSN LEFT JOIN Province pr ON p.provinceID = pr.provinceID LEFT JOIN PostalCode pc ON p.address = pc.address AND p.city = pc.city AND p.provinceID = pc.provinceID;") or die($mysqli->error);
            ?>
            <div class="row justify-content-center table-row">
                <table class="table table-sm table-fit">
                    <thead>
                        <tr>
                            <th>INFO</th>
                            <th>Name</th>
                            <th>D.O.B</th>
                            <th>Telephone</th>
                            <th>Address</th>
                            <th>Postal Code</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Email</th>
                            <th>Citizenship</th>
                            <th colspan=2>Actions</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <p></p>
                        <tr>
                            <td>
                                <span> <?php echo "EID: ".$row['EID']; ?></span> <br />
                                <span> <?php echo "SSN: ". $row['SSN']; ?></span> <br />
                                <span> <?php echo "Medicare: ".$row['medicaidNum']; ?></span> <br />
                            </td>
                            <td><?php echo $row['firstName']." ".$row['lastName']; ?></td>
                            <td><?php echo $row['dateOfBirth']; ?></td>
                            <td><?php echo $row['telephone']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['postalCode']; ?></td>
                            <td><?php echo $row['provinceName']; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['citizenship']; ?></td>
                            <td>
                                <a href="publicHealthWorker.php?edit=<?php echo $row['EID']; ?>" class="btn btn-info"> Edit </a>
                                <a href="processPublicHealthWorker.php?delete=<?php echo $row['EID']; ?>" class="btn btn-danger"> Delete </a>
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
