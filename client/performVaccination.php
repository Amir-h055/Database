<?php
    session_start();
    $currentPage = 'Perform Vaccination';
    include('common/header.php');
?>
        <!-- Page Content -->
        <div id="content">
            <?php require_once 'processPerformVaccination.php'; ?>
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
                        <form action="processPerformVaccination.php" method="POST">
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <select class="form-control" name="passportNumOrSSN" placeholder="Person" value="<?php echo $passportNumOrSSN; ?>">
                                        <option value="" <?php echo $passportNumOrSSN == '' ? 'selected': '' ?> disabled>Person</option>
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT passportNumOrSSN, firstName, lastName FROM Person") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['passportNumOrSSN'] == $passportNumOrSSN ? 'selected': '' ?> value=<?php echo $row['passportNumOrSSN']; ?>><?php echo $row['passportNumOrSSN'].": ".$row['firstName']." ".$row['lastName']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-auto form-group">
                                    <select class="form-control" name="vaccineType" placeholder="vaccineType" value="<?php echo $vaccineType; ?>">
                                        <option value="" <?php echo $vaccineType == '' ? 'selected': '' ?> disabled>Vaccine Type</option>
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT * FROM VaccinationDrug") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['name'] == $vaccineType ? 'selected': '' ?> value="<?php echo $row['name']; ?>"><?php echo $row['name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-auto form-group">
                                    <select class="form-control" name="facility" placeholder="facility" value="<?php echo $facilityName; ?>">
                                        <option value="" <?php echo $facilityName == '' ? 'selected': '' ?> disabled>Health Facility</option>
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT * FROM HealthFacility") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['name'] == $facilityName ? 'selected': '' ?> value="<?php echo $row['name'].":".$row['address']; ?>"><?php echo $row['name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="text" name="date" class="form-control" value="<?php echo $date; ?>" placeholder="Date">
                                </div>
                                <div class="col-auto form-group">
                                    <select class="form-control" name="EID" placeholder="Employee" value="<?php echo $EID; ?>">
                                        <option value="" <?php echo $EID == '' ? 'selected': '' ?> disabled>Employee</option>
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT *, firstName, lastName FROM Employee, Person WHERE Employee.SSN = Person.passportNumOrSSN;") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['EID'] == $EID ? 'selected': '' ?> value=<?php echo $row['EID']; ?>><?php echo $row['EID'].": ".$row['firstName']." ".$row['lastName']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-auto form-group">
                                    <?php
                                    if ($update == true) :
                                    ?>
                                        <button type="submit" name="update" class="btn btn-info">Update</button>
                                    <?php else : ?>
                                        <button type="submit" name="save" class="btn btn-primary">Vaccinate</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM Vaccination;") or die($mysqli->error);
            ?>
            <div class="row justify-content-center table-row">
                <table class="table  table-sm table-fit">
                    <thead>
                        <tr>
                            <th>PassportNumOrSSN</th>
                            <th>Dose Number</th>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Vaccine Type</th>
                            <th>Health Facility</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <p></p>
                        <tr>
                            <td><?php echo $row['passportNumOrSSN']; ?></td>
                            <td><?php echo $row['doseNumber']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['EID']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['Hname']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
