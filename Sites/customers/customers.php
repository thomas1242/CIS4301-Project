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

            <?php 

            $loc = $_GET["locSelect"];
            $dept = $_GET["dept"];
            $arv = $_GET["arv"];
            $month = $_GET["month"];
            $day = $_GET["day"];
            $date = $day . "-" . $month . "-16";
            $conn = oci_connect("cdurr", "cordyceps", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.cise.ufl.edu)(PORT=1521))(CONNECT_DATA=(SID=orcl)))");
                if (!$conn) {
                    $m = oci_error();
                    echo $m['message'], "\n";
                    exit;
                } 

            if($loc === "airport") {
                $stid = oci_parse($conn, "SELECT * FROM flights WHERE departure_airport= :dptair and arrival_airport= :arvair");
            }
            else {
                $stid = oci_parse($conn, "SELECT * FROM flights WHERE departure_city_state= :dptair and arrival_city_state= :arvair");
            }

            oci_bind_by_name($stid, ":dptair", $dept);
            oci_bind_by_name($stid, ":arvair", $arv);
            //oci_bind_by_name($stid, ":depdate", $date);

            oci_execute($stid);							// execute the query 
            oci_fetch_all($stid, $res);


            $count = 0;
            echo "<table border='1'>\n";
            foreach ($res as $col) {
                echo "<tr>\n";
                $count = 0;
                foreach ($col as $item) {
                    echo "    <td>".($item !== null ? htmlentities($item, ENT_QUOTES) : "")."</td>\n";
                    $count++;
                }
                echo "</tr>\n";
            }

            for ($x = 0; $x < $count; $x++) {
                    echo '<td><button formaction="http://localhost/login.php" type="submit" class="btn navbar-btn btn-info" name="logout" id="logout" value="Log Out">Order</button></td>';
            } 
            echo "<tr>";
            for ($x = 0; $x < $count; $x++) {
                    echo '<td><button formaction="http://localhost/login.php" type="submit" class="btn navbar-btn btn-info" name="logout" id="logout" value="Bookmark">Bookmark</button></td>';
            } 
            echo "</tr>";

            echo "</table>\n";


            oci_free_statement($stid);
            oci_close($conn);
            ?>
    </body>
</html>