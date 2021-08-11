<?php
    session_start();
    $currentPage = 'Infections';
    include('common/header.php');
?>
        <!-- Page Content -->
        <div id="content">
            <?php require_once 'processInfections.php'; ?>
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
                        <form action="processInfections.php" method="POST">
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="text" name="dateInfection" class="form-control" value="<?php echo $dateInfection; ?>" placeholder="Date">
                                </div>
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
                                    <select class="form-control" name="variantTypeID" placeholder="variantTypeID" value="<?php echo $variantTypeID; ?>">
                                        <option value="" <?php echo $variantTypeID == '' ? 'selected': '' ?> disabled>Variant Type</option>
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT * FROM VariantType") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['variantTypeID'] == $variantTypeID ? 'selected': '' ?> value=<?php echo $row['variantTypeID']; ?>><?php echo $row['variantTypeID'].": ".$row['name']; ?></option>
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
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT Infection.dateInfection, Infection.passportNumOrSSN, Infection.variantTypeID, VariantType.name as variantName, Person.firstName, Person.lastName FROM Infection LEFT JOIN Person on Infection.passportNumOrSSN = Person.passportNumOrSSN LEFT JOIN VariantType on Infection.variantTypeID = VariantType.variantTypeID;") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Passport Num or SSN</th>
                            <th> Name </th>
                            <th>Variant ID</th>
                            <th>Variant Name</th>
                            <th colspan=2>Actions</th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['dateInfection']; ?></td>
                            <td><?php echo $row['passportNumOrSSN']; ?></td>
                            <td><?php echo $row['firstName']." ".$row['lastName']; ?></td>
                            <td><?php echo $row['variantTypeID']; ?></td>
                            <td><?php echo $row['variantName']; ?></td>
                            <td>
                                <a href="infections.php?edit=1&passportNumOrSSN=<?php echo $row['passportNumOrSSN']; ?>&dateInfection=<?php echo $row['dateInfection']; ?>" class="btn btn-info"> Edit </a>
                                <a href="processInfections.php?delete=<?php echo true; ?>&passportNumOrSSN=<?php echo $row['passportNumOrSSN']; ?>&dateInfection=<?php echo $row['dateInfection']; ?>" class="btn btn-danger"> Delete </a>
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
