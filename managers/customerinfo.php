<!--
	Customer information page:

-->

<?php

$conn = oci_connect("cdurr", "cordyceps", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.cise.ufl.edu)(PORT=1521))(CONNECT_DATA=(SID=orcl)))");
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

if (!isset($_GET['customer']))
{
	echo "<h1> Go away hacker </h1>";
}
else
{	
	// display the information
	if (isset($_GET['information']))
	{
		// get the information of the customer
		$sql = 'select * from customers where customer_id = ' . $_GET['customer'];

		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);

		// customer info in associative array with attributes as indices
		$custInfo = oci_fetch_array($stmt);
		oci_close($conn);
	}
	// display the orders
	elseif (isset($_GET['orders']))
	{
		$sql = 'select flights.* from flights, orders where customer_id = ' . $_GET['customer'] .
		       ' and orders.flight_id = flights.flight_id';

		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	}
}

?>

<!DOCTYPE HTML>
<html>
<head>
</head>
<body>

<!-- Form for information tab -->

<div id="tabs" style="display: inline">
<form>
	<input type="hidden" name="customer" value="<?= $_GET['customer']; ?>">
	<input type="hidden" name="information" value="true">	
	<input type="submit" value="Information" id="infoTab">
</form>

<!-- Form for order tab, make sure to pass customer through get as well as -->
<form>
	<input type="hidden" name="customer" value="<?= $_GET['customer']; ?>">
	<input type="hidden" name="orders" value="true">
	<input type="submit" value="Orders" id="orderTab">
</form>
</div>

<?php if (isset($_GET['information'])): ?>

<h1> Customer Information </h1>

<p>
	Customer Name: <?php echo $custInfo['FIRST_NAME'] . " " . $custInfo['LAST_NAME'];?> 
<br><br>
	Customer Email: <?php echo $custInfo['CUSTOMER_EMAIL'];?>
</p>

<?php else: ?>

<h1> Customer Orders </h1>

	<?php

		while($res = oci_fetch_array($stmt, OCI_ASSOC))
		{
			foreach($res as $key => $value)
			{
				echo $value . "   ";
			}
			echo "<br><br>";
		}

		oci_close($conn);
	?>

<?php endif; ?>


<button id="backToSearch">Back to search</button>
<script>
	var searchBtn = document.getElementById('backToSearch');
	searchBtn.addEventListener('click', function() {
		document.location.href = 'http://localhost:8080/managers.php';
	});
</script>
</body>
</html>






