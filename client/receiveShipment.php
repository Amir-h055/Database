<?php
    session_start();
    $currentPage = 'Receive Shipment';
    include('common/header.php');
?>
        <!-- Page Content -->
        <div id="content">
            <?php require_once 'processReceiveShipment.php'; ?>
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
                        <form action="processReceiveShipment.php" method="POST">
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="number" name="count" class="form-control" value="<?php echo $count; ?>" placeholder="# Doses">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="date" class="form-control" value="<?php echo $date; ?>" placeholder="Date">
                                </div>
                                <div class="col-auto form-group">
                                    <select class="form-control" name="vaccineType" placeholder="vaccineType" value="<?php echo $vaccineType; ?>">
                                        <option value="" <?php echo $vaccineType == '' ? 'selected': '' ?> disabled>Vaccine Type</option>
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT * FROM VaccinationDrug") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['name'] == $vaccineType ? 'selected': '' ?> value="<?php echo $row['name']; ?>"><?php echo $row['name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-auto form-group">
                                    <select class="form-control" name="facility" placeholder="facility" value="<?php echo $facilityName; ?>">
                                        <option value="" <?php echo $facilityName == '' ? 'selected': '' ?> disabled>Health Facility</option>
                                        <?php
                                        $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
                                        $result = $mysqli->query("SELECT * FROM HealthFacility") or die($mysqli->error);
                                        while ($row = $result->fetch_assoc()): ?>
                                            <option <?php echo $row['name'] == $facilityName ? 'selected': '' ?> value="<?php echo $row['name'].":".$row['address']; ?>"><?php echo $row['name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-auto form-group">
                                    <?php
                                    if ($update == true) :
                                    ?>
                                        <button type="submit" name="update" class="btn btn-info">Update</button>
                                    <?php else : ?>
                                        <button type="submit" name="save" class="btn btn-primary">Transfer</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT h.name, h.address, h.type, h.telephone, COALESCE(vs.totalShipments, 0) AS totalShipments, COALESCE(vs.totalDosesShipped, 0) AS totalDosesShipped, v.totalVaccinesByType FROM HealthFacility h LEFT JOIN(SELECT nameHSO AS name, address, COUNT(DISTINCT nameHSO, address, nameDrug, date) AS totalShipments, SUM(COUNT) AS totalDosesShipped FROM VaccineShipment GROUP BY nameHSO , address) vs ON vs.name = h.name AND vs.address = h.address LEFT JOIN (SELECT nameHSO AS name, address, GROUP_CONCAT(nameDrug, ': ', count) totalVaccinesByType FROM VaccineStored GROUP BY nameHSO , address) v ON v.name = h.name AND v.address = h.address GROUP BY h.name , h.address;") or die($mysqli->error);
            ?>
            <div class="row justify-content-center table-row">
                <table class="table  table-sm table-fit">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Telephone</th>
                            <th>Total Shipments</th>
                            <th>Total Doses Shipped</th>
                            <th>Vaccines By Type</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <p></p>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['type']; ?></td>
                            <td><?php echo $row['telephone']; ?></td>
                            <td><?php echo $row['totalShipments']; ?></td>
                            <td><?php echo $row['totalDosesShipped']; ?></td>
                            <td><?php echo $row['totalVaccinesByType']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
