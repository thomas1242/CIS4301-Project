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

				// new customer data received from newCustomer.php
				$signupFName = $_POST['signupFirstName'];
				$signupLName = $_POST['signupLastName'];
				$signupEmail = $_POST['signupEmail'];
				$signupEmailagain = $_POST['signupEmailagain'];
				$signupPassword = $_POST['signupPassword'];
				$signupCC = $_POST['CCnumber'];

				 
				if( $signupEmail != $signupEmailagain ) {
					header("Location: http://localhost/newCustomer.php");
					exit();
				}

				$highest_cust_id = oci_parse($conn, "SELECT customer_id 
													 FROM customers 
													 WHERE customer_id >= ( SELECT max(customer_id) 
													 						FROM customers )");	
				oci_execute($highest_cust_id);			// execute the query 
	            
	            $new_customer_id;
	            while ($row = oci_fetch_array($highest_cust_id, OCI_NUM) )
				{
						$new_customer_id = $row[0] + 1;
						$_SESSION['user_ID'] = $new_customer_id;
				}
				
				// insert customer into customer table
				$insert_customer_query = oci_parse($conn, "INSERT INTO Customers (customer_id, first_name, last_name, customer_email, customer_password, ccnumber) VALUES ( '" . $new_customer_id . "' , '" . $signupFName . "' , '" . $signupLName . "' , '" . $signupEmail . "' , '" . $signupPassword . "' , '" . $signupCC . "' ) ");
				oci_execute($insert_customer_query);			// execute the query 


				header("Location: http://localhost/customers/index.php");
				exit();
			?>

		    <!-- jQuery -->
		    <script src="js/jquery.js"></script>
		    <!-- Bootstrap Core JavaScript -->
		    <script src="js/bootstrap.min.js"></script>
		    <script src="checklogin.js"></script>

	</body>
</html>




</html>