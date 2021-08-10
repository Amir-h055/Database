<?php
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
                        <form action="processAgeGroup.php" method="POST">
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="text" name="dateInfection" class="form-control" value="<?php echo $dateInfection; ?>" placeholder="Date">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="passportNumOrSSN" class="form-control" value="<?php echo $passportNumOrSSN; ?>" placeholder="Passport Num or SSN">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="variantTypeID" class="form-control" value="<?php echo $variantTypeID; ?>" placeholder="Variant Type ID">
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
            $result = $mysqli->query("SELECT * FROM Infection") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Passport Num or SSN</th>
                            <th>Variant ID</th>
                            <th colspan=2>Actions</th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['dateInfection']; ?></td>
                            <td><?php echo $row['passportNumOrSSN']; ?></td>
                            <td><?php echo $row['variantTypeID']; ?></td>
                            <td>
                                <a href="infections.php?edit=1&passportNumOrSSN=<?php echo $row['passportNumOrSSN']; ?>&dateInfection=<?php echo $row['dateInfection']; ?>" class="btn btn-info"> Edit </a>
                                <a href="processInfections.php?delete=<?php echo $row['passportNumOrSSN']; ?>" class="btn btn-danger"> Delete </a>
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
