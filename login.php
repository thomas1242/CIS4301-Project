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
        <title>CIS4301 Project Login Page</title>
        <!-- Bootstrap Core CSS -->
        <link href="/resources/css/bootstrap.min.css" rel="stylesheet">
        <link href="/resources/css/login.css" rel="stylesheet">
        <!-- Custom CSS -->
        <div class="container">
        <h1 class="welcome text-center">Welcome</h1>
        </div><!-- /container -->
    </head>

    <body>
        <div class="container">
            <div class="card card-container">
            <h2 class='login_title text-center'>Login</h2>
            <hr>

                <form class="form-signin" name="form1" method="post" action="checklogin.php">
                    <span id="reauth-email" class="reauth-email"></span>
                    <p class="input_title">Username</p>
                    <input type="text" id="myusername" name="myusername" class="login_box" placeholder="" required autofocus>
                    <p class="input_title">Password</p>
                    <input type="password" id="mypassword" name="mypassword" class="login_box" placeholder="" required>
                    <div id="remember" class="checkbox">
                        <label>
                       </label>
                    </div>
                    <button class="btn btn-lg btn-primary" type="submit">Login</button>
                     <p></p>Need an account? <a href="newCustomer.php">Register</a></p>
                </form><!-- /form -->
            </div><!-- /card-container -->
        </div><!-- /container -->
        <?php
            $conn = oci_connect("cdurr", "cordyceps", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.cise.ufl.edu)(PORT=1521))(CONNECT_DATA=(SID=orcl)))");
               
              $cust_count = oci_parse($conn, "SELECT count(*) from customers ");   
              $flight_count = oci_parse($conn, "SELECT count(*) from flights ");
              $man_count = oci_parse($conn, "SELECT count(*) from managers ");
              $order_count = oci_parse($conn, "SELECT count(*) from orders ");

              oci_execute($cust_count);          // execute the query 
              oci_execute($flight_count);    
              oci_execute($man_count); 
              oci_execute($order_count); 

                $num_customers;
                $num_flights;
                $num_managers;
                $num_orders;
     
                while ($row = oci_fetch_array($cust_count, OCI_NUM) )
                {
                        $num_customers = $row[0];
                }
                while ($row = oci_fetch_array($flight_count, OCI_NUM) )
                {
                        $num_flights   = $row[0];
                }
                while ($row = oci_fetch_array($man_count, OCI_NUM) )
                {
                        $num_managers  = $row[0];
                }
                while ($row = oci_fetch_array($order_count, OCI_NUM) )
                {
                        $num_orders    = $row[0];
                }
                echo     '<div class="container">
                          <h3>Database statistics: </h3>
                          <div class="panel panel-default">
                          <div class="panel-body"> 
                          # of customers in the database:  '  . $num_customers . '
                          </div> </div> </div>';

                echo     '<div class="container">
                          <div class="panel panel-default">
                          <div class="panel-body"> 
                          # of flights in the database:   ' . $num_flights . '
                          </div> </div> </div>';
                          


                echo     '<div class="container">
                          <div class="panel panel-default">
                          <div class="panel-body"> 
                          # of managers in the database:  ' . $num_managers . '
                          </div> </div> </div>';        

                echo     '<div class="container">
                          <div class="panel panel-default">
                          <div class="panel-body"> 
                          # of orders in the database:    ' . $num_orders . '
                          </div> </div> </div>';                             
                
                oci_close($conn);
        ?>
    </body>
</html


    </body>
</html>