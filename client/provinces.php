<?php
    $currentPage = 'Provinces';
    include('common/header.php');
?>
        <!-- Page Content -->
        <div id="content">
            <?php require_once 'processProvinces.php'; ?>
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
                        <form action="processProvinces.php" method="POST">
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="text" name="provinceID" class="form-control" value="<?php echo $provinceID; ?>" placeholder="Province ID">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Province Name">
                                </div>
                                <div class="col-auto form-group">
                                    <select class="form-control" name="ageGroupID" placeholder="Choose Age Group" value="<?php echo $ageGroupID; ?>">
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT * FROM AgeGroup") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['ageGroupID'] == $ageGroupID ? 'selected': '' ?> value=<?php echo $row['ageGroupID']; ?>><?php echo $row['ageRange']; ?></option>
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
            $result = $mysqli->query("SELECT * FROM Province") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Province ID</th>
                            <th>Province Name</th>
                            <th>Age Range</th>
                            <th colspan=2>Actions</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['provinceID']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['currentAgeGroupID']; ?></td>
                            <td>
                                <a href="provinces.php?edit=<?php echo $row['provinceID']; ?>" class="btn btn-info"> Edit </a>
                                <a href="processProvinces.php?delete=<?php echo $row['provinceID']; ?>" class="btn btn-danger"> Delete </a>
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
