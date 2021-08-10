<?php
    $currentPage = 'Detail 3';
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
                p.passportNumOrSSN,
                p.firstName,
                p.lastName,
                p.dateOfBirth,
                p.email,
                p.telephone,
                p.city,
                GROUP_CONCAT(DISTINCT v.date, ': ', v.name) AS vaccinations,
                COUNT(DISTINCT (i.variantTypeID)) AS numberVariantInfections,
                GROUP_CONCAT(DISTINCT i.variantTypeID) AS variants
            FROM
                Person p
                    LEFT JOIN
                Vaccination v ON v.passportNumOrSSN = p.passportNumOrSSN
                    LEFT JOIN
                Infection i ON i.passportNumOrSSN = p.passportNumOrSSN
            WHERE
                p.passportNumOrSSN IN (SELECT
                        passportNumOrSSN
                    FROM
                        Vaccination)
                    AND p.passportNumOrSSN IN (SELECT
                        passportNumOrSSN
                    FROM
                        Infection
                    GROUP BY passportNumOrSSN
                    HAVING COUNT(DISTINCT (variantTypeID)) >= 2)
            ") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <h2>Two different variants - Vaccinated</h2>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date of Birth</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>City</th>
                            <th>Vaccinations</th>
                            <th>Number of infections</th>
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
                            <td><?php echo $row['vaccinations']; ?></td>
                            <td><?php echo $row['numberVariantInfections']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
