<?php

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
	$custId = $_GET['flight'];
}



?>
