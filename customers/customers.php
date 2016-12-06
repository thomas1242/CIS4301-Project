 <?php

 session_start();


 ?>


<html>
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Customer Page</title>

        <!-- Bootstrap Core CSS -->
        <link href="/resources/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="/resources/css/logo-nav.css" rel="stylesheet">

    </head>

    <body>

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">
                            <img src="plane.jpeg" alt="">
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="index.php">Search Flights</a>
                            </li>
                            <li>
                                <a href="profile.php">Profile</a>
                            </li>
                             </ul>
                                <div class="pull-right">
                                    <ul class="nav navbar-nav">
                                         <li><form><button formaction="http://localhost/login.php" type="submit" class="btn navbar-btn btn-danger" name="logout" id="logout" value="Log Out">Log Out</button></form></li>
                                         </ul>     
                                </div>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>
            <form action="customers.php" method="get">
                <div id="sortdropdown">
                    <p>
                        <select id = "sort" name = "sort" class="btn btn-primary dropdown-toggle">
                            <option value="sortby">Sort By</option>
                            <option value="PRICE">Price</option>
                            <option value="departure_date">Departure Date</option>
                            <option value="departure_city_state">Departure City</option>
                            <option value="arrival_city_state">Arrival City</option>
                            <option value="deptarture_airport">Departure Airport</option>
                            <option value="arrival_airport">Arrival Airport</option>
                            <option value="distance">Distance</option>
                            <option value="SEATS_LEFT">Remaining Seats</option>
                        </select>
                    </p>
                </div>
                <div id="orderdropdown">
                    <p>
                        <select id="order" name="order" class="btn btn-primary dropdown-toggle">
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </p>
                </div>
                <input type = "submit" class = "btn btn-default" id = "sortbtn">
            </form>
            <?php 
            $month = "";
            $day = "";
            if(isset($_GET["sort"])) {
                if($_GET["sort"] != "" && $_GET["sort"] != "sortby") {
                    $_SESSION['sortCustomer'] = $_GET["sort"];
                    $sort = $_GET["sort"];
                }
            }
            if(isset($_GET["order"])) {
                if($_GET["order"] != "" && $_GET["order"] != "orderby") {
                    $_SESSION['orderCustomer'] = $_GET["order"];
                }
            }
            if(isset($_GET["locSelect"])) {
                if($_GET["locSelect"] != "") {
                    $_SESSION['loc'] = $_GET["locSelect"];
                }
            }
            if(isset($_GET["dept"])) {
                if($_GET["dept"] != "") {
                    $_SESSION['dept'] = $_GET["dept"];
                }
            }
            if(isset($_GET["arv"])) {
                if($_GET["arv"] != "") {
                    $_SESSION['arv'] = $_GET["arv"];
                }
            }
            if(isset($_GET["month"])) {
                $month = $_GET["month"];
            }
            if(isset($_GET["day"])) {
                $day = $_GET["day"];
            }
            if($month != "" && $day != "") {
                $_SESSION['date'] = $day . "-" . $month . "-16";
            }
            echo $_SESSION['sortCustomer'];
            $conn = oci_connect("cdurr", "cordyceps", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.cise.ufl.edu)(PORT=1521))(CONNECT_DATA=(SID=orcl)))");
                if (!$conn) {
                    $m = oci_error();
                    echo $m['message'], "\n";
                    exit;
                } 
            if(isset($_SESSION['sortCustomer'])) {
                if($_SESSION['loc'] == "airport") {
                    $stid = oci_parse($conn, "SELECT * FROM flights WHERE departure_airport= :dptair and arrival_airport= :arvair ORDER BY " . $_SESSION['sortCustomer'] . " " . $_SESSION['orderCustomer']);
                }
                else {
                    $stid = oci_parse($conn, "SELECT * FROM flights WHERE departure_city_state= :dptair and arrival_city_state= :arvair ORDER BY " . $_SESSION['sortCustomer'] . " " . $_SESSION['orderCustomer']);
                }
            }
            else {
                if($_SESSION['loc'] == "airport") {
                    $stid = oci_parse($conn, "SELECT * FROM flights WHERE departure_airport= :dptair and arrival_airport= :arvair");
                }
                else {
                    $stid = oci_parse($conn, "SELECT * FROM flights WHERE departure_city_state= :dptair and arrival_city_state= :arvair");
                }
            }

            oci_bind_by_name($stid, ":dptair", $_SESSION['dept']);
            oci_bind_by_name($stid, ":arvair", $_SESSION['arv']);
            if(isset($_SESSION['sortCustomer'])) {
                //oci_bind_by_name($stid, ":sort", $sort);
                //oci_bind_by_name($stid, ":order", $_SESSION['orderCustomer']);
            }
            //oci_bind_by_name($stid, ":depdate", $date);

            oci_execute($stid);							// execute the query 
          //  oci_fetch_all($stid, $res);


            $count = 0;
            echo "<table border='1'>\n";
            //foreach ($res as $col) {
            while ($res = oci_fetch_array($stid, OCI_ASSOC)) {
                echo "<tr>\n";
                $count = 0;
                foreach ($res as $item) {
                    echo "    <td>".($item !== null ? htmlentities($item, ENT_QUOTES) : "")."</td>\n";
                    $count++;
                }
                echo '<td><button formaction="http://localhost/login.php" type="submit" class="btn navbar-btn btn-info" name="logout" id="logout" value="Log Out">Order</button></td>';
                echo '<td><button formaction="http://localhost/login.php" type="submit" class="btn navbar-btn btn-info" name="logout" id="logout" value="Bookmark">Bookmark</button></td>';
                echo "</tr>\n";
            }
            echo "</table>\n";


            oci_free_statement($stid);
            oci_close($conn);
            ?>
    </body>
</html>