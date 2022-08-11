<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $pid = intval($_GET['pid']);
    if (isset($_POST['submit'])) {
        $pname = $_POST['packagename'];
        $ptype = $_POST['packagetype'];
        $plocation = $_POST['packagelocation'];
        $pprice = $_POST['packageprice'];
        $pfeatures = $_POST['packagefeatures'];
        $pdetails = $_POST['packagedetails'];
        $perday = $_POST['perday'];
        $pimage = $_FILES["packageimage"]["name"];
        $sql = "update TblTourPackages set PackageName=:pname,PackageType=:ptype,PackageLocation=:plocation,PackagePrice=:pprice,PackageFetures=:pfeatures,PackageDetails=:pdetails,perday=:perday where PackageId=:pid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pname', $pname, PDO::PARAM_STR);
        $query->bindParam(':ptype', $ptype, PDO::PARAM_STR);
        $query->bindParam(':plocation', $plocation, PDO::PARAM_STR);
        $query->bindParam(':pprice', $pprice, PDO::PARAM_STR);
        $query->bindParam(':pfeatures', $pfeatures, PDO::PARAM_STR);
        $query->bindParam(':pdetails', $pdetails, PDO::PARAM_STR);
        $query->bindParam(':perday', $perday, PDO::PARAM_STR);
        $query->bindParam(':pid', $pid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Package Updated Successfully";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>NLI | Update Packages</title>

        <script type="application/x-javascript">
            addEventListener("load", function() {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/nli-2.min.css" rel="stylesheet">

        <style>
            .sticky-footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                /* Height of the footer*/
                height: 40px;
                background: grey;
            }

            .container-button {
                display: flex;
                justify-content: center;
            }
        </style>

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">NLI Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Tour Packages</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Tour Packages:</h6>
                            <a class="collapse-item" href="create-package.php">create</a>
                            <a class="collapse-item" href="manage-package.php">manage</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Utilities</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Utilities:</h6>
                            <a class="collapse-item" href="manage-users.php">Manage Users</a>
                            <a class="collapse-item" href="manage-bookings.php">Manage Bookings</a>
                            <a class="collapse-item" href="manage-pages.php">Manage pages</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - tickets Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Tickets</span>
                    </a>
                    <div id="collapse3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Utilities:</h6>
                            <a class="collapse-item" href="manage-issues.php">Manage Issues</a>
                            <a class="collapse-item" href="manage-enquires.php">Manage Enquiries</a>
                        </div>
                    </div>
                </li>
                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

                <!-- Sidebar Message -->

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar header name -->
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">No Limits India</h1>
                                </div>
                            </div>
                        </form>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcom Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="change-password.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Update Package</h1>
                        </div>

                        <div class="grid-form">
                            <div class="grid-form1">
                                <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="horizontal-form">

                                        <?php
                                        $pid = intval($_GET['pid']);
                                        $sql = "SELECT * from TblTourPackages where PackageId=:pid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':pid', $pid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {    ?>

                                                <form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="focusedinput" class="col-sm-2 control-label">Package Name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="packagename" id="packagename" placeholder="Create Package" value="<?php echo htmlentities($result->PackageName); ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="focusedinput" class="col-sm-2 control-label">Package Type</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="packagetype" id="packagetype" placeholder=" Package Type eg- Family Package / Couple Package" value="<?php echo htmlentities($result->PackageType); ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="focusedinput" class="col-sm-2 control-label">Package Location</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="packagelocation" id="packagelocation" placeholder=" Package Location" value="<?php echo htmlentities($result->PackageLocation); ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="focusedinput" class="col-sm-2 control-label">Package Price in Rs</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="packageprice" id="packageprice" placeholder=" Package Price is Rs" value="<?php echo htmlentities($result->PackagePrice); ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="focusedinput" class="col-sm-2 control-label">Per Day Extra Charges (in Rs)</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="perday" id="perday" placeholder=" Per Day Extra Charges is Rs" value="<?php echo htmlentities($result->perday); ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="focusedinput" class="col-sm-2 control-label">Package Features</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="packagefeatures" id="packagefeatures" placeholder="Package Features Eg-free Pickup-drop facility" value="<?php echo htmlentities($result->PackageFetures); ?>" required>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="focusedinput" class="col-sm-2 control-label">Package Details</label>
                                                        <div class="col-sm-8">
                                                            <textarea class="form-control" rows="5" cols="50" name="packagedetails" id="packagedetails" placeholder="Package Details" required><?php echo htmlentities($result->PackageDetails); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="focusedinput" class="col-sm-2 control-label">Package Image</label>
                                                        <div class="col-sm-8">
                                                            <img src="../admin/pacakgeimages/<?php echo htmlentities($result->PackageImage); ?>" width="200">&nbsp;&nbsp;&nbsp;<a href="change-image.php?imgid=<?php echo htmlentities($result->PackageId); ?>">Change Image</a>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="focusedinput" class="col-sm-2 control-label">Last Updation Date</label>
                                                        <div class="col-sm-8">
                                                            <?php echo htmlentities($result->UpdationDate); ?>
                                                        </div>
                                                    </div>
                                            <?php }
                                        } ?>

                                    </div>

                                    <div class="container-button">
                                        <div class="center">
                                            <button type="submit" name="submit" class="btn-primary btn">Update</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <br><br><br><br>
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>&copy;2020 NLI. All Rights Reserved | NLI</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="../index.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/nli-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>

            <script>
                $(document).ready(function() {
                    //BOX BUTTON SHOW AND CLOSE
                    jQuery('.small-graph-box').hover(function() {
                        jQuery(this).find('.box-button').fadeIn('fast');
                    }, function() {
                        jQuery(this).find('.box-button').fadeOut('fast');
                    });
                    jQuery('.small-graph-box .box-close').click(function() {
                        jQuery(this).closest('.small-graph-box').fadeOut(200);
                        return false;
                    });

                    //CHARTS
                    function gd(year, day, month) {
                        return new Date(year, month - 1, day).getTime();
                    }

                    graphArea2 = Morris.Area({
                        element: 'hero-area',
                        padding: 10,
                        behaveLikeLine: true,
                        gridEnabled: false,
                        gridLineColor: '#dddddd',
                        axes: true,
                        resize: true,
                        smooth: true,
                        pointSize: 0,
                        lineWidth: 0,
                        fillOpacity: 0.85,
                        data: [{
                                period: '2014 Q1',
                                iphone: 2668,
                                ipad: null,
                                itouch: 2649
                            },
                            {
                                period: '2014 Q2',
                                iphone: 15780,
                                ipad: 13799,
                                itouch: 12051
                            },
                            {
                                period: '2014 Q3',
                                iphone: 12920,
                                ipad: 10975,
                                itouch: 9910
                            },
                            {
                                period: '2014 Q4',
                                iphone: 8770,
                                ipad: 6600,
                                itouch: 6695
                            },
                            {
                                period: '2015 Q1',
                                iphone: 10820,
                                ipad: 10924,
                                itouch: 12300
                            },
                            {
                                period: '2015 Q2',
                                iphone: 9680,
                                ipad: 9010,
                                itouch: 7891
                            },
                            {
                                period: '2015 Q3',
                                iphone: 4830,
                                ipad: 3805,
                                itouch: 1598
                            },
                            {
                                period: '2015 Q4',
                                iphone: 15083,
                                ipad: 8977,
                                itouch: 5185
                            },
                            {
                                period: '2016 Q1',
                                iphone: 10697,
                                ipad: 4470,
                                itouch: 2038
                            },
                            {
                                period: '2016 Q2',
                                iphone: 8442,
                                ipad: 5723,
                                itouch: 1801
                            }
                        ],
                        lineColors: ['#ff4a43', '#a2d200', '#22beef'],
                        xkey: 'period',
                        redraw: true,
                        ykeys: ['iphone', 'ipad', 'itouch'],
                        labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                        pointSize: 2,
                        hideHover: 'auto',
                        resize: true
                    });


                });
            </script>

    </body>

    </html>
<?php } ?>