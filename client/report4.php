<?php
    $currentPage = 'Report 4';
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
    h.name,
    h.address,
    h.type,
    h.telephone,
    COUNT(DISTINCT j.EID) AS employeeCount,
    COALESCE(vs.totalShipments, 0) AS totalShipments,
    COALESCE(vs.totalDosesShipped, 0) AS totalDosesShipped,
    COALESCE(vtFrom.totalTransfersFrom, 0) AS totalTransfersFrom,
    COALESCE(vtFrom.totalDosesFrom, 0) AS totalDosesFrom,
    COALESCE(vtTo.totalTransfersTo, 0) AS totalTransfersTo,
    COALESCE(vtTo.totalDosesTo, 0) AS totalDosesTo,
    v.totalVaccinesByType,
    COALESCE(vac.totalPeopleVaccinated, 0) as totalPeopleVaccinated,
    COALESCE(vac.totalDosesGiven, 0) as totalDosesGiven
FROM
    HealthFacility h
        LEFT JOIN
    JobHistory j ON j.address = h.address
        AND j.name = h.name
        LEFT JOIN
    (SELECT
        nameHSO AS name,
            address,
            COUNT(DISTINCT nameHSO, address, nameDrug, date) AS totalShipments,
            SUM(COUNT) AS totalDosesShipped
    FROM
        VaccineShipment
    GROUP BY nameHSO , address) vs ON vs.name = h.name
        AND vs.address = h.address
        LEFT JOIN
    (SELECT
        nameHSOFrom,
            addressFrom,
            COUNT(DISTINCT nameHSOFrom, nameHSOTo, addressFrom, addressTo, nameDrug, date) AS totalTransfersFrom,
            SUM(count) AS totalDosesFrom
    FROM
        VaccineTransfer
    GROUP BY nameHSOFROM , addressFROM) vtFrom ON vtFrom.nameHSOFrom = h.name
        AND vtFrom.addressFrom = h.address
        LEFT JOIN
    (SELECT
        nameHSOTo,
            addressTo,
            COUNT(DISTINCT nameHSOFrom, nameHSOTo, addressFrom, addressTo, nameDrug, date) AS totalTransfersTo,
            SUM(COUNT) AS totalDosesTo
    FROM
        VaccineTransfer
    GROUP BY nameHSOTo , addressTo) vtTo ON vtTo.nameHSOTo = h.name
        AND vtTo.addressTo = h.address
        LEFT JOIN
    (SELECT
        nameHSO AS name,
            address,
            GROUP_CONCAT(nameDrug, ': ', count) totalVaccinesByType
    FROM
        VaccineStored
    GROUP BY nameHSO , address) v ON v.name = h.name
        AND v.address = h.address
	LEFT JOIN
    (SELECT
    Hname AS name,
    address,
    COUNT(DISTINCT passportNumOrSSN) AS totalPeopleVaccinated,
    COUNT(DISTINCT passportNumOrSSN, doseNumber) AS totalDosesGiven
FROM
    Vaccination
GROUP BY Hname , address) vac
ON vac.name = h.name
AND vac.address = h.address
WHERE
    h.city = 'Montreal'
        AND j.endDate IS NULL
GROUP BY h.name , h.address;
") or die($mysqli->error);
            ?>
            <div class="row justify-content-center table-row">
                <h2>Facilities in Montreal</h2>
                <table class="table table-sm table-fit">
                    <thead>
                        <tr>
                            <th>Name Facilities</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Telephone</th>
                            <th>Employee Count</th>
                            <th>Total Shipments</th>
                            <th>Total Doses Shipped</th>
                            <th>Total Transfers From</th>
                            <th>Total Doses From</th>
                            <th>Total Transers To</th>
                            <th>Total Doses To</th>
                            <th>Total Vaccines By Type</th>
                            <th>Total People Vaccinated</th>
                            <th>Total Doses Given</th>
                        </tr>
                    </thead>
                    <?php
                    while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['type']; ?></td>
                            <td><?php echo $row['telephone']; ?></td>
                            <td><?php echo $row['employeeCount']; ?></td>
                            <td><?php echo $row['totalShipments']; ?></td>
                            <td><?php echo $row['totalDosesShipped']; ?></td>
                            <td><?php echo $row['totalTransfersFrom']; ?></td>
                            <td><?php echo $row['totalDosesFrom']; ?></td>
                            <td><?php echo $row['totalTransfersTo']; ?></td>
                            <td><?php echo $row['totalDosesTo']; ?></td>
                            <td><?php echo $row['totalVaccinesByType']; ?></td>
                            <td><?php echo $row['totalPeopleVaccinated']; ?></td>
                            <td><?php echo $row['totalDosesGiven']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
