<html>
    <head>
    </head>
		<body>

<?php

// connect to the database to access CUSTOMERS and MANAGERS table to verfiy login credentials
$conn = oci_connect("cdurr", "cordyceps", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.cise.ufl.edu)(PORT=1521))(CONNECT_DATA=(SID=orcl)))");

// while ($row = oci_fetch_array($stid_max_customer, OCI_NUM) )
// 	{
// 		$max_customer_id = $row[0] . "<br>";
// 	}
// echo $max_customer_id;					// get a single value

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

$count_one = oci_fetch_all($stid_one, $res_one);	// put result in $res
$count_two = oci_fetch_all($stid_two, $res_two);	// put result in $res

echo "customer count = " . $count_one . "\n";
echo "manager count = " . $count_two . "\n";

if($count_one == 1) {
	echo "VALID CUSTOMER LOGIN,\nWELCOME.";
	header("Location: http://localhost/customers/index.php");
	exit();
}
else if ($count_two == 1) {
	echo "VALID MANAGER LOGIN,\nWELCOME.";
	header("Location: http://localhost/managers/managers.php");
	exit();
}
else {
	echo "INVALID LOGIN ATTEMPT,\nPLEASE TRY AGAIN.";
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