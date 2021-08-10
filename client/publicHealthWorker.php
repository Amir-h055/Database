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
                                    <input type="text" name="SSN" class="form-control" value="<?php echo $SSN; ?>" placeholder="SSN">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="medicare" class="form-control" value="<?php echo $medicare; ?>" placeholder="medicare">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>" placeholder="First Name">
                                </div>
                            </div>
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>" placeholder="Last Name">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="dateOfBirth" class="form-control" value="<?php echo $dateOfBirth; ?>" placeholder="D.O.B">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="telephone" class="form-control" value="<?php echo $telephone; ?>" placeholder="Telephone">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="address" class="form-control" value="<?php echo $address; ?>" placeholder="Address">
                                </div>
                            </div>
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <select class="form-control" name="provinceID" placeholder="Choose your Province" value="<?php echo $provinceID; ?>">
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT * FROM Province") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['provinceID'] == $provinceID ? 'selected': '' ?> value=<?php echo $row['provinceID']; ?>><?php echo $row['name']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="city" class="form-control" value="<?php echo $city; ?>" placeholder="City">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="postalCode" class="form-control" value="<?php echo $postalCode; ?>" placeholder="Postal Code">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="number" name="citizenship" class="form-control" value="<?php echo $citizenship; ?>" placeholder="Citizenship">
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
            $result = $mysqli->query("SELECT Employee.EID, Employee.SSN, Employee.medicare, Employee.firstName, Employee.lastName, Employee.dateOfBirth, Employee.telephone, Employee.address, PostalCode.postalCode, Province.name as provinceName, Employee.city, Employee.email, Employee.citizenship FROM Employee, PostalCode, Province WHERE Employee.address = PostalCode.address AND Employee.provinceID = Province.provinceID AND Employee.city = PostalCode.city AND Employee.provinceID = PostalCode.provinceID;") or die($mysqli->error);
            ?>
            <div class="row justify-content-center table-row">
                <table class="table  table-sm table-fit">
                    <thead>
                        <tr>
                            <th>INFO</th>
                            <th>Name</th>
                            <th>D.O.B</th>
                            <th>Telephone</th>
                            <th>Address</th>
                            <th>Postal Code</th>
                            <th>Province</th>
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
                                <span> <?php echo "Medicare: ".$row['medicare']; ?></span> <br />
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
