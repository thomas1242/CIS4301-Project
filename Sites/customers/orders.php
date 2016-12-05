 <?php
 session_start();
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Orders</title>
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

        $conn = oci_connect("cdurr", "cordyceps", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.cise.ufl.edu)(PORT=1521))(CONNECT_DATA=(SID=orcl)))");
        if (!$conn) {
            $m = oci_error();
            echo $m['message'], "\n";
            exit;
        } 

        $temp = (int)$_SESSION['user_ID'];

        $stid = oci_parse($conn, "SELECT flights.* 
                                  FROM (select orders.flight_id
                                        FROM orders 
                                        WHERE customer_id= :userID) q1, flights
                                  WHERE q1.flight_id = flights.flight_id"
                         );

        oci_bind_by_name( $stid, ":userID", $temp );

        oci_execute($stid);                         // execute the query 
        oci_fetch_all($stid, $res);

        // Pretty-print the results
        echo "<table border='1'>\n";
        foreach ($res as $col) {
            echo "<tr>\n";
            foreach ($col as $item) {
                echo "    <td>".($item !== null ? htmlentities($item, ENT_QUOTES) : "")."</td>\n";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    ?>

    <!-- jQuery -->
    <script src="/resources/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/resources/js/bootstrap.min.js"></script>

</body>

</html>
