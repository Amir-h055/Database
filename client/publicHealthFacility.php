<?php
    session_start();
    $currentPage = 'Public Health Facilities';
    include('common/header.php');
?>
        <!-- Page Content -->
        <div id="content">
            <?php require_once 'processPublicHealthFacility.php'; ?>
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
                        <form action="processPublicHealthFacility.php" method="POST">
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Name">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="type" class="form-control" value="<?php echo $type; ?>" placeholder="Type">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="address" class="form-control" value="<?php echo $address; ?>" placeholder="address">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="city" class="form-control" value="<?php echo $city; ?>" placeholder="city">
                                </div>
                            </div>
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="text" name="postalCode" class="form-control" value="<?php echo $postalCode; ?>" placeholder="postalCode">
                                </div>
                                <div class="col-auto form-group">
                                    <select class="form-control" name="provinceID" placeholder="Choose your Province" value="<?php echo $provinceID; ?>">
                                        <option value="" <?php echo $provinceID == '' ? 'selected': '' ?> disabled>Province</option>
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT * FROM Province") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['provinceID'] == $provinceID ? 'selected': '' ?> value=<?php echo $row['provinceID']; ?>><?php echo $row['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="telephone" class="form-control" value="<?php echo $telephone; ?>" placeholder="Telephone">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="webAddress" class="form-control" value="<?php echo $webAddress; ?>" placeholder="Web Adress">
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
            $result = $mysqli->query("SELECT HealthFacility.name, HealthFacility.address, HealthFacility.city, HealthFacility.provinceID, PostalCode.postalCode, Province.name AS provinceName, HealthFacility.telephone, HealthFacility.webAddress, HealthFacility.type FROM HealthFacility, PostalCode, Province WHERE HealthFacility.address = PostalCode.address AND HealthFacility.provinceID = Province.provinceID AND HealthFacility.city = PostalCode.city AND HealthFacility.provinceID = PostalCode.provinceID;") or die($mysqli->error);
            ?>
            <div class="row justify-content-center table-row">
                <table class="table  table-sm table-fit">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Province</th>
                            <th>PostalCode</th>
                            <th>Telephone</th>
                            <th>Web Address</th>
                            <th colspan=2>Actions</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <p></p>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['type'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['city'] ?></td>
                            <td><?php echo $row['provinceName'] ?></td>
                            <td><?php echo $row['postalCode'] ?></td>
                            <td><?php echo $row['telephone'] ?></td>
                            <td><?php echo $row['webAddress'] ?></td>
                            <td>
                                <a href="publicHealthFacility.php?edit=<?php echo true; ?>&name=<?php echo $row['name']; ?>&address=<?php echo $row['address']; ?>" class="btn btn-info"> Edit </a>
                                <a href="processPublicHealthFacility.php?delete=<?php echo true; ?>&name=<?php echo $row['name']; ?>&address=<?php echo $row['address']; ?>" class="btn btn-danger"> Delete </a>
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