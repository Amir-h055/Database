<?php
    $currentPage = 'Variant Type';
    include('common/header.php');
?>
        <!-- Page Content -->
        <div id="content">
            <?php require_once 'processVariantType.php'; ?>
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
                        <form action="processVariantType.php" method="POST">
                            <div class="form-row justify-center">
                                <div class="col-auto form-group">
                                    <input type="number" name="variantTypeID" class="form-control" value="<?php echo $variantTypeID; ?>" placeholder="Variant Type ID">
                                </div>
                                <div class="col-auto form-group">
                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Name">
                                </div>
                                <div class="col-auto form-group">
                                    <?php
                                    if ($update == true) :
                                    ?>
                                        <button type="submit" name="update" class="btn btn-info">Update</button>
                                    <?php else : ?>
                                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                                    <?php endif; ?>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $mysqli = new mysqli('c353.c9ohujn2mpyl.us-east-1.rds.amazonaws.com', 'admin', 'hello123', 'PROJECT') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM VariantType") or die($mysqli->error);
            ?>
            <div class="row justify-content-center">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Variant Type ID</th>
                            <th>Name</th>
                            <th colspan=2>Actions</th>
                        </tr>
                    </thead>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['variantTypeID']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>
                                <a href="variantType.php?edit=<?php echo $row['variantTypeID']; ?>" class="btn btn-info"> Edit </a>
                                <a href="processVariantType.php?delete=<?php echo $row['variantTypeID']; ?>" class="btn btn-danger"> Delete </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            </div>
        </div>
<?php
    include('common/footer.php');
?>
