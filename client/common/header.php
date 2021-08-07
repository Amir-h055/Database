<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="index.css">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <title>COMP 353 Project</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3> COVID-19 System</h3>
            </div>
            <ul class="list-unstyled components">
                <p>COMP 353 Final Project</p>
                <li class="<?php echo $currentPage == 'Home' ? 'active': ''?>">
                    <a href="index.php">Home</a>
                </li>
                <li class="<?php echo $currentPage == 'Age Group' ? 'active': ''?>">
                    <a href="ageGroup.php">Age Groups</a>
                </li>
                <li class="<?php echo $currentPage == 'Provinces' ? 'active': ''?>">
                    <a href="provinces.php">Provinces</a>
                </li>
                <li class="<?php echo $currentPage == 'Person' ? 'active': ''?>">
                    <a href="person.php">Person</a>
                </li>
                <li>
                    <a href="#">Infections</a>
                </li>
                <li>
                    <a href="#">Vaccine Types</a>
                </li>
                <li>
                    <a href="#">Variant Types</a>
                </li>
                <li>
                    <a href="#">Public Health Workers</a>
                </li>
                <li>
                    <a href="#">Public Health Facilities</a>
                </li>
                <li>
                    <a href="#pageSubmenuOp" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Operations</a>
                    <ul class="collapse list-unstyled" id="pageSubmenuOp">
                        <li>
                            <a href="#">Receive a Shipment</a>
                        </li>
                        <li>
                            <a href="#">Transfer Vaccines</a>
                        </li>
                        <li>
                            <a href="#">Perform Vaccination</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenuDetails" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Details</a>
                    <ul class="collapse list-unstyled" id="pageSubmenuDetails">
                        <li>
                            <a href="#">One dose - Age Group 1 to 3</a>
                        </li>
                        <li>
                            <a href="#">Two different doses - Montreal</a>
                        </li>
                        <li>
                            <a href="#">Two different variants - Vaccinated</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenuReports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reports</a>
                    <ul class="collapse list-unstyled" id="pageSubmenuReports">
                        <li>
                            <a href="#">Inventory per province</a>
                        </li>
                        <li>
                            <a href="#">Vaccination per province (01-01-2021/22-07-2021)</a>
                        </li>
                        <li>
                            <a href="#">Vaccination per cities (QC, 01-01-2021/22-07-2021)</a>
                        </li>
                        <li>
                            <a href="#">Health Workers per Facilities</a>
                        </li>
                        <li>
                            <a href="#">Health Workers QC (&lt; 2 doses)</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
