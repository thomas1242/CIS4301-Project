<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Customer Query Results</title>

    <!-- Bootstrap Core CSS -->
    <link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/resources/css/logo-nav.css" rel="stylesheet">

</head>
<body>

<?php 
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
    } else {
        print "Connected to Oracle!";
    }

//day-month-year
//$stid = oci_parse($conn, "SELECT * FROM flights WHERE departure_airport= :dptair and arrival_airport= :arvair and departure_date= :depdate");
$stid = oci_parse($conn, "SELECT * FROM flights WHERE departure_airport= :dptair");

oci_bind_by_name($stid, ":dptair", $dept);
//oci_bind_by_name($stid, ":arvair", $arv);
//oci_bind_by_name($stid, ":depdate", $date);

oci_execute($stid);							// execute the query 

oci_fetch_all($stid, $res);

// foreach ($res['FLIGHT_ID'] as $c) {
//     print "flight id:" . $c . "<br>\n";
// }


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


oci_free_statement($stid);
oci_close($conn);
?>
</body>
</html>
