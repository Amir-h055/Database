<?php
    $currentPage = 'Report 6';
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
SELECT 
    e.EID,
    Person.firstName,
    Person.lastName,
    Person.dateOfBirth,
    Person.telephone,
    Person.city,
    Person.email,
    JobHistory.name
FROM
    Person,
    Province,
    Employee e,
    (SELECT DISTINCT
        (EV.ssn) AS ssn
    FROM
        (SELECT 
        e.SSN AS ssn, COUNT(e.SSN) AS c
    FROM
        Employee e, Vaccination v
    WHERE
        e.SSN = v.passportNumOrSSN
    GROUP BY (e.SSN)) AS EV
    WHERE
        EV.c > 1) AS FV,
    JobHistory
WHERE
    e.SSN NOT IN (FV.ssn)
        AND e.EID = JobHistory.EID
        AND Person.passportNumOrSSN = e.SSN
        AND Province.name = 'QC'
        AND Province.provinceID = Person.provinceID;
") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <h2>Health Worker QC (&lt; 2 doses)</h2>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Telephone</th>
                            <th>City</th>
                            <th>Email</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['EID']; ?></td>
                            <td><?php echo $row['firstName']; ?></td>
                            <td><?php echo $row['lastName']; ?></td>
                            <td><?php echo $row['dateOfBirth']; ?></td>
                            <td><?php echo $row['telephone']; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
