<?php
    $currentPage = 'Detail 2';
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
            SELECT firstName, lastName, dateOfBirth, email, telephone, city, Vaccination.date, Vaccination.name,
	              CASE WHEN EXISTS(
		                SELECT  *
		                FROM Infection
		                WHERE Person.passportNumOrSSN = Infection.passportNumOrSSN
	              ) THEN 'Yes' ELSE 'No' END as WasInfected
            FROM Person,
		            (
			              SELECT Person.passportNumOrSSN as p, COUNT(DISTINCT(Vaccination.name)) as c 
			              FROM Vaccination, Person
			              WHERE Person.passportNumOrSSN = Vaccination.passportNumOrSSN
			              GROUP BY Person.passportNumOrSSN
		            ) as DV, Vaccination
            WHERE Person.city ='Montreal' AND DV.p = Person.passportNumOrSSN AND DV.c > 1 AND 
	          Vaccination.passportNumOrSSN = Person.passportNumOrSSN") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <h2>Two different doses - Montreal</h2>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>City</th>
                            <th>Date of Vaccination</th>
                            <th>Vaccine Type</th>
                            <th>Been Infected Before</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['firstName']; ?></td>
                            <td><?php echo $row['lastName']; ?></td>
                            <td><?php echo $row['dateOfBirth']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['telephone']; ?></td>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['WasInfected']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
