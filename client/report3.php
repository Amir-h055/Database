<?php
    $currentPage = 'Report 3';
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
SELECT hf.city, SUM(vs.count) as c
FROM HealthFacility hf, VaccineShipment vs 
WHERE hf.name = vs.nameHSO AND hf.address  = vs.address
GROUP BY hf.city
") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <h2>Vaccine Received per cities (QC, 01-01-2021/22-07-2021)</h2>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>Vaccine Received</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['city']; ?></td>
                            <td><?php echo $row['c']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
