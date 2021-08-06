<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <?php require_once 'process.php'; ?>
    <?php
    if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">COMP 353 Project</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="#">Age Groups</a>
                <a class="nav-link" href="#">Province Group</a>
                <a class="nav-link" href="#">Person</a>
                <a class="nav-link" href="#">Infections</a>
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="container mt-2 mb-4 p-2 shadow bg-white">
            <div class="row justify-content-center">
                <form action="process.php" method="POST">
                    <div class="form-row justify-center">
                        <div class="col-auto form-group">
                            <input type="number" name="ageGroupID" class="form-control" value="<?php echo $ageGroupID; ?>" placeholder="Age Group Id">
                        </div>
                        <div class="col-auto form-group">
                            <input type="text" name="ageRange" class="form-control" value="<?php echo $ageRange; ?>" placeholder="Enter Age Range">
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
    $result = $mysqli->query("SELECT * FROM AgeGroup") or die($mysqli->error);
    ?>
    <div class="row justify-content-center">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Age Group ID</th>
                    <th>Age Range</th>
                    <th colspan=2>Actions</th>
                </tr>
            </thead>
            <?php
            while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['ageGroupID']; ?></td>
                    <td><?php echo $row['ageRange']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['ageGroupID']; ?>" class="btn btn-info"> Edit </a>
                        <a href="process.php?delete=<?php echo $row['ageGroupID']; ?>" class="btn btn-danger"> Delete </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>