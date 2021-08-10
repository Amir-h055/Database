<?php
    $currentPage = 'Detail 1';
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
                SELECT Person.firstName, Person.lastName, Person.dateOfBirth, Person.email, 
                Person.telephone, Person.city,Vaccination.date,Vaccination.name,
                CASE WHEN EXISTS(
		                SELECT  *
		                FROM Infection
		                WHERE Person.passportNumOrSSN = Infection.passportNumOrSSN
	              ) THEN 'Yes' ELSE 'No' END as WasInfected
                FROM Person JOIN Vaccination on Person.passportNumOrSSN=Vaccination.passportNumOrSSN
                LEFT JOIN Infection ON Person.passportNumOrSSN=Infection.passportNumOrSSN
                WHERE ageGroupID BETWEEN 1 AND 3
                AND Person.passportNumOrSSN in (
	                  SELECT passportNumOrSSN
	                  FROM Vaccination 
	                  GROUP BY Vaccination.passportNumOrSSN
	                  HAVING COUNT(Vaccination.passportNumOrSSN)=1
                )    
            ") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <h2>One dose - Age Group 1 to 3</h2>
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
