<?php
    $currentPage = 'Report 5';
    include('common/header.php');
?>
        <!-- Page Content -->
        <div id="content">
            <?php
            if (isset($_SESSION['message'])) : ?>
                <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>
            <?php
            $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
            $result = $mysqli->query("
SELECT HealthFacility.name, Person.*, Employee.EID , PostalCode.postalCode
FROM HealthFacility,Employee,JobHistory,PostalCode, Person
WHERE
	Employee.SSN = Person.passportNumOrSSN
	AND Person.address = PostalCode.address
	AND Person.city= PostalCode.city
	AND Person.provinceID = PostalCode.provinceID
    AND HealthFacility.name = JobHistory.name
    AND HealthFacility.address = JobHistory.address
    AND JobHistory.EID = Employee.EID
  ORDER BY HealthFacility.name;
") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <h2>Health Workers Per Facilities</h2>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Name Facilitiy</th>
                            <th>Employee ID</th>
                            <th>SSN</th>
                            <th>Medicaid</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Telephone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Province ID</th>
                            <th>Citizenship</th>
                            <th>Email</th>
                            <th>Postal Code</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['EID']; ?></td>
                            <td><?php echo $row['SSN']; ?></td>
                            <td><?php echo $row['medicare']; ?></td>
                            <td><?php echo $row['firstName']; ?></td>
                            <td><?php echo $row['lastName']; ?></td>
                            <td><?php echo $row['dateOfBirth']; ?></td>
                            <td><?php echo $row['telephone']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $row['provinceID']; ?></td>
                            <td><?php echo $row['citizenship']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['postalCode']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
