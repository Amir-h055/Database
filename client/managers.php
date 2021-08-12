<?php
    session_start();
    $currentPage = 'Managers';
    include('common/header.php');
?>
        <!-- Page Content -->
        <div id="content">
            <?php require_once 'processManagers.php'; ?>
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
                        <form action="processManagers.php" method="POST">
                            <div class="form-row justify-center">
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
                                <div class="col-auto form-group">
                                    <input type="text" name="date" class="form-control" value="<?php echo $date; ?>" placeholder="Start Date">
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
            $result = $mysqli->query("SELECT * FROM Managers LEFT JOIN Employee ON Managers.EID = Employee.EID LEFT JOIN Person ON Employee.SSN = Person.passportNumOrSSN;") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Manager EID</th>
                            <th>Manager Name</th>
                            <th>Health Facility </th>
                            <th>Address</th>
                            <th colspan=2>Actions</th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['EID']; ?></td>
                            <td><?php echo $row['firstName']." ".$row['lastName']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td>
                                <a href="processManagers.php?delete=<?php echo true; ?>&EID=<?php echo $row['EID']; ?>&name=<?php echo $row['name']; ?>&address=<?php echo $row['address']; ?>" class="btn btn-danger"> Delete </a>
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
