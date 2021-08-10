<?php
    $currentPage = 'Report 2';
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
    SELECT p.name , v.name as nameD, COUNT(DISTINCT(v.passportNumOrSSN)) as p
FROM Vaccination v, HealthFacility hf, Province p
WHERE v.Hname  = hf.name AND v.address = hf.address AND
	hf.provinceID = p.provinceID AND
	date > '2021-01-01' AND date < '2021-07-22'
GROUP BY v.name;
") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <h2>Vaccination Per Province (01-01-2021/22-07-2021)</h2>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Province</th>
                            <th>Name Vaccine</th>
                            <th>Vaccination Count</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['nameD']; ?></td>
                            <td><?php echo $row['p']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
