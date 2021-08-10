<?php
    $currentPage = 'Project 1';
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
SELECT Province.name,VaccineStored.nameDrug,SUM(VaccineStored.count) AS total
FROM Province,HealthFacility,VaccineStored
WHERE Province.provinceID = HealthFacility.provinceID
AND HealthFacility.name = VaccineStored.nameHSO
AND HealthFacility.address = VaccineStored.address
group by Province.name, VaccineStored.nameDrug
order by Province.name asc, total desc;            
") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <h2>Inventory Per Province</h2>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Province</th>
                            <th>Name Vaccine</th>
                            <th>Vaccine Count</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['nameDrug']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
