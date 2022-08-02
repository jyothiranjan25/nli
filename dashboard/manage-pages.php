<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if ($_POST['submit'] == "Update") {
        $pagetype = $_GET['type'];
        $pagedetails = $_POST['pgedetails'];
        $sql = "UPDATE tblpages SET detail=:pagedetails WHERE type=:pagetype";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
        $query->bindParam(':pagedetails', $pagedetails, PDO::PARAM_STR);
        $query->execute();
        $msg = "Page data updated  successfully";
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

        <title>NLI | Manage webpages</title>

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
        <script type="text/JavaScript">
            function MM_findObj(n, d) { //v4.01
            var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
            d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
            if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
            for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
            if(!x && d.getElementById) x=d.getElementById(n); return x;
            }

            function MM_validateForm() { //v4.0
            var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
            for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
                if (val) { nm=val.name; if ((val=val.value)!="") {
                if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
                    if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
                } else if (test!='R') { num = parseFloat(val);
                    if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
                    if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
                    min=test.substring(8,p); max=test.substring(p+1);
                    if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
                } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
            } if (errors) alert('The following error(s) occurred:\n'+errors);
            document.MM_returnValue = (errors == '');
            }

            function MM_jumpMenu(targ,selObj,restore){ //v3.0
            eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
            if (restore) selObj.selectedIndex=0;
            }
        </script>
        <script type="text/javascript" src="nicEdit.js"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(function() {
                nicEditors.allTextAreas()
            });
        </script>

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
                            <h1 class="h3 mb-0 text-gray-800">Update Web Page Data</h1>
                        </div>

                        <div class="grid-form">
                            <div class="grid-form1">
                                <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                <br>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="horizontal-form">
                                        <form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Select page</label>
                                                    <div class="col-sm-8">
                                                        <select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
                                                            <option value="" selected="selected" class="form-control">***Select One***</option>
                                                            <option value="manage-pages.php?type=terms">terms and condition</option>
                                                            <option value="manage-pages.php?type=privacy">privacy and policy</option>
                                                            <option value="manage-pages.php?type=aboutus">about us</option>
                                                            <option value="manage-pages.php?type=contact">Contact us</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Selected Page</label>
                                                    <div class="col-sm-8">
                                                        <?php

                                                        switch ($_GET['type']) {
                                                            case "terms":
                                                                echo "Terms and Conditions";
                                                                break;

                                                            case "privacy":
                                                                echo "Privacy And Policy";
                                                                break;

                                                            case "aboutus":
                                                                echo "About US";
                                                                break;
                                                            case "software":
                                                                echo "Offers";
                                                                break;
                                                            case "aspnet":
                                                                echo "Vission And MISSION";
                                                                break;
                                                            case "objectives":
                                                                echo "Objectives";
                                                                break;
                                                            case "disclaimer":
                                                                echo "Disclaimer";
                                                                break;
                                                            case "vbnet":
                                                                echo "Partner With Us";
                                                                break;
                                                            case "candc":
                                                                echo "Super Brand";
                                                                break;
                                                            case "contact":
                                                                echo "Contact Us";
                                                                break;




                                                            default:
                                                                echo "";
                                                                break;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label for="focusedinput" class="col-sm-2 control-label">Package Details</label>
                                                </div>
                                                <div class="col-sm-8">


                                                    <textarea class="form-control" rows="5" cols="50" name="pgedetails" id="pgedetails" placeholder="Package Details" required>
										<?php
                                        $pagetype = $_GET['type'];
                                        $sql = "SELECT detail from tblpages where type=:pagetype";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                                echo htmlentities($result->detail);
                                            }
                                        }
                                        ?>

										</textarea>
                                                </div>
                                            </div>




                                            <div class="container-button">
                                                <div class="col-sm-5">
                                                    <button type="submit" name="submit" value="Update" id="submit" class="btn-primary btn">Update</button>


                                                </div>
                                            </div>





                                    </div>

                                    </form>





                                    <div class="panel-footer">

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