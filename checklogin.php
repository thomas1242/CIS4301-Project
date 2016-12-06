 <?php

 session_start();

 ?>

<html>
    <head>
    </head>
		<body>

			<?php

			// connect to the database to access CUSTOMERS and MANAGERS table to verfiy login credentials
			$conn = oci_connect("cdurr", "cordyceps", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.cise.ufl.edu)(PORT=1521))(CONNECT_DATA=(SID=orcl)))");

			// username and password received from login.php
			$myusername = $_POST['myusername'];
			$mypassword = $_POST['mypassword'];

			// search customer table and manager table for valid info
			$stid_one = oci_parse($conn, "SELECT * FROM customers WHERE customer_email = :userName AND customer_password = :userPass");	
			$stid_two = oci_parse($conn, "SELECT * FROM managers  WHERE manager_email  = :userName AND  manager_password = :userPass");	
			// oci_bind_by_name: Binds a PHP variable to an Oracle placeholder
			oci_bind_by_name($stid_one, ":userPass", $mypassword);
			oci_bind_by_name($stid_one, ":userName", $myusername);

			oci_bind_by_name($stid_two, ":userPass", $mypassword);
			oci_bind_by_name($stid_two, ":userName", $myusername);

			oci_execute($stid_one);							// execute the query 
			oci_execute($stid_two);							// execute the query 

			while ($row = oci_fetch_array($stid_one, OCI_NUM) )
			{
					$customer_id = $row[0] . "<br>";
					$_SESSION['user_ID'] = $customer_id;
			}
			while ($row = oci_fetch_array($stid_two, OCI_NUM) )
			{
					$manager_id = $row[0] . "<br>";
					$_SESSION['manager_ID'] = $manager_id;
			}

			if($customer_id != "") {
				header("Location: http://localhost/customers/index.php");
				exit();
			}
			else if ($manager_id != "") {
				header("Location: http://localhost/managers/managers.php");
				exit();
			}
			else {
				header("Location: http://localhost/login.php");
				exit();
			}
				
			?>

		    <!-- jQuery -->
		    <script src="js/jquery.js"></script>

		    <!-- Bootstrap Core JavaScript -->
		    <script src="js/bootstrap.min.js"></script>
		    <script src="checklogin.js"></script>

	</body>
</html>




</html>