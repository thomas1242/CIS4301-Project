<?php

session_start();

$conn = oci_connect("cdurr", "cordyceps", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.cise.ufl.edu)(PORT=1521))(CONNECT_DATA=(SID=orcl)))");
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

if (!isset($_GET['flight']))
{
	echo "<h1> Go away hacker </h1>";
}
else
{
	if (isset($_GET['information']))
	{
		$sql = 'select * from flights where flight_id = ' . $_GET['flight'];

		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);

		$flightInfo = oci_fetch_array($stmt);
		oci_close($conn);
	}

	/*elseif (isset($_GET['orders']))
	{
		$sql = 'select customers.* from customers, orders, where flight_id = ' . $_GET['flight'] . 
			   ' and orders.customer_id = customers.customer_id';

		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);
	}*/
}


?>

<!DOCTYPE HTML>
<html>
<head>
</head>
<body>

<!-- Form for information tab -->

<div id="tabs" style="display:inline;">
<form style="display:inline;">
	<input type="hidden" name="flight" value="<?= $_GET['flight']; ?>">
	<input type="hidden" name="information" value="true">	
	<input type="submit" value="Information" id="infoTab">
</form>

<!-- Form for order tab, make sure to pass flight through get as well as -->
<form style="display:inline;">
	<input type="hidden" name="flight" value="<?= $_GET['flight']; ?>">
	<input type="hidden" name="orders" value="true">
	<input type="submit" value="Orders" id="orderTab">
</form>
</div>

<?php if (isset($_GET['information'])): ?>

<h1> Flight Information </h1>

<p>
	Flight Id: <?php echo $flightInfo['FLIGHT_ID']; ?>
<br><br>
	Flight Distance: <?php echo $flightInfo['DISTANCE'];?> 
<br><br>
	Flight Departure Airport: <?php echo $flightInfo['DEPARTURE_AIRPORT'];?>
<br><br>
	Flight Departure City: <?php echo $flightInfo['DEPARTURE_CITY_STATE']; ?>
<br><br>
	Flight Departure State: <?php echo $flightInfo['DEPARTURE_STATE']; ?>
<br><br>
	Flight Arrival Airport: <?php echo $flightInfo['ARRIVAL_AIRPORT']; ?>
<br><br>
	Flight Arrival City: <?php echo $flightInfo['ARRIVAL_CITY_STATE']; ?>
<br><br>
	Flight Arrival State: <?php echo $flightInfo['ARRIVAL_STATE']; ?>
<br><br>
	Flight Date: <?php echo $flightInfo['DEPARTURE_DATE']; ?>
<br><br>
	Seats Left: <?php echo $flightInfo['SEATS_LEFT']; ?>
<br><br>
	Price: <?php echo $flightInfo['PRICE']; ?>
</p>

<?php else: ?>

<h1> Flight Orders </h1>

	<?php

		$sql = 'select customers.* from customers, orders where flight_id = ' . $_GET['flight'] . 
			   ' and orders.customer_id = customers.customer_id';

		$stmt = oci_parse($conn, $sql);
		oci_execute($stmt);

		while($res = oci_fetch_array($stmt, OCI_NUM))
		{
			for($i = 1; $i<sizeof($res)-2; $i++)
			{
				echo $res[$i] . "   ";
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
		document.location.href = 'http://localhost:8080/managers/managers.php';
	});
</script>
</body>
</html>



