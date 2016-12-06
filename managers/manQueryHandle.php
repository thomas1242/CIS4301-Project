<!-- 
	file to handle the search request from manager search interface.
	Should take in all variables passed through POST, and construct an appropriate
	query for the POSTed variables.
-->

<?php

// create session to hold post data between pages
session_start();

// execute this only if the session does not have a final query 
if (!isset($_SESSION['finalquery']) && !isset($_SESSION['singular']))
{

// handle the searchField and condition_number since they are the only assured values
if ($_POST['searchTable'] == "customers")
{
	$search = "customer_id";
	$singularTable = "customer";
}
else
{
	$search = "flight_id";
	$singularTable = "flight";
}


$condition_number = $_POST['condition_number'];
$finalSqlQuery = "";
$partSqlQuery = "";
$tablename = 1;
$conditions_togo = $condition_number;

// if condition_number has a value
if ($condition_number)
{
	// loop through the conditions
	for ($i=1; $i<$condition_number + 1; $i++)
	{
		$newdata = array();

		$newdata['table'] = $_POST['conditionTable_' . $i];
		$newdata['attribute'] = $_POST['conditionAttribute_' . $i];
		$newdata['operand'] = $_POST['conditionOperand_' . $i];
		$newdata['value'] = $_POST['conditionValue_' . $i];

		$conditions[$i] = $newdata;

		unset($newdata);
	}

	/*

	foreach ($conditions as $j => $values)
	{
    	print "$j {\n";
    	foreach ($values as $key => $value)
    	{
       		print "    $key=>$value \n";
  		}
   		print "}\n";
   		print "<br>";
	}
	print "<br><br><br>";
	*/

	$partSqlQuery .= "with ";

	foreach ($conditions as $j => $values)
	{
		$conditions_togo -= 1;

		// if the table is from orders, create the aggregate sql query
		if ($values['table'] == "orders")
		{
			// handle flight count attribute in orders
			if ($values['attribute'] == "flight_count")
			{
				$partSqlQuery = $partSqlQuery . "tablename" . $tablename . " as (select orders." . $search . " from orders, flights where orders.flight_id = flights.flight_id group by " . $search . " having count(*) " . $values['operand'] . " " . $values['value'] . " order by " . $search . ")";
			}
			elseif ($values['attribute'] == "price" || $values['attribute'] == "distance")
			{
				// hardcoded flights since managers would not add orders condition if searching for flight
				$partSqlQuery = $partSqlQuery . "tablename" . $tablename . " as (select orders." . $search . " from orders, flights where orders.flight_id = flights.flight_id group by " . $search . " having sum(" . $values['attribute'] . ") " . $values['operand'] . " " . $values['value'] . " order by " . $search . ")";
			}
		}
		// else the partial sql query simply has where clauses
		else
		{
			if ($values['table'] == "flights")
				$tableid = "flight_id";
			else
				$tableid = "customer_id";

			$partSqlQuery = $partSqlQuery . "tablename" . $tablename . " as (select orders." . $search . " from orders, " . $values['table'] . " where orders." . $tableid . " = " . $values['table'] . "." . $tableid . " and " . $values['table'] . "." . $values['attribute'] . " " . $values['operand'] . " ";

			// if the attribute of the condition is text it requires quotes around value
			if ($values['attribute'] == "email" || $values['attribute'] == "first_name" || 
				$values['attribute'] == "last_name" || $values['attribute'] == "arrival_city_state"
				|| $values['attribute'] == "departure_city_state" || $values['attribute'] == "arrival_airport" || $values['attribute'] == "departure_airport" || $values['attribute'] == "departure_state" || $values['attribute'] == "arrival_state"
				|| $values['attribute'] == "departure_date")
			{
				$partSqlQuery = $partSqlQuery . "'" . $values['value'] . "')";
			}
			else 
			{
				$partSqlQuery = $partSqlQuery . $values['value'] . ")";
			}
		}
		if ($conditions_togo != 0)
			$partSqlQuery = $partSqlQuery . ", ";

		$finalSqlQuery = $finalSqlQuery . $partSqlQuery;
		$tablename += 1;

		$partSqlQuery = "";
	}

	// join all the conditions together (select from part)
	$partSqlQuery .= "select distinct " . $_POST['searchTable'] . ".* from " . $_POST['searchTable'] . ", ";

	for ($i=1; $i<$condition_number+1; $i++)
	{
		if ($i != $condition_number)
			$partSqlQuery .= "tablename" . $i . ", ";
		else
			$partSqlQuery .= "tablename" . $i ." ";
	}

	// put where clause of join condition
	for ($i=1; $i<$condition_number+1; $i++)
	{
		if ($i == 1)
			$partSqlQuery .= "where " . $_POST['searchTable'] . "." . $search . " = tablename" . $i . "." . $search;

		if ($i != $condition_number)
			$partSqlQuery .= " and tablename" . $i . "." . $search . " = " . "tablename" . ($i+1) . "." . $search . " ";
	}

	$finalSqlQuery .= $partSqlQuery;

	// save this final query in the session
	$_SESSION['finalquery'] = $finalSqlQuery;
	$_SESSION['singular'] = $singularTable;
	print $finalSqlQuery . "<br><br>";
}
}
?>

<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<h1> Search Results </h1>
<div id=results>

<?php

$conn = oci_connect("cdurr", "cordyceps", "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=oracle.cise.ufl.edu)(PORT=1521))(CONNECT_DATA=(SID=orcl)))");
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}

// check if there are sorting conditions
if (isset($_GET['sort_number']))
{
	$numsorts = $_GET['sort_number'];
	if ($numsorts != 0)
	{// sorting conditions exist

		// Modify $_SESSION['sort'] to hold array of sorting conditions
		for ($i=1;$i < $numsorts + 1;$i++)
		{
			$newdata = array();

			$newdata['attribute'] = $_GET['sortAttribute_' . $i];
			$newdata['order'] = $_GET['sortOrder_' . $i];

			$conditions[$i] = $newdata;

			unset($newdata);
		}

		// add additional order by clause at the end of $_SESSION['finalquery']
		$partSqlQuery = " order by ";

		$conditions_left = $numsorts;

		// loop through conditions and append ordering to partSqlQuery
		foreach ($conditions as $j => $values)
		{
			$conditions_left--;

			$partSqlQuery .= $_SESSION['singular'] . "s." . $values['attribute'] . " " . $values['order'];

			if ($conditions_left)
				$partSqlQuery .= ",";

			$partSqlQuery .= " ";
		}

		// save query in new $_SESSION variable in order to maintain ordering throughout pagination
		$_SESSION['sortfinalquery'] = $_SESSION['finalquery'] . $partSqlQuery;
	}
	else
	{
		// applied sort conditions of nothing, change nothing
	}
}
else
{
	
}


// pagination and display

if (!isset($_GET['offset']))
    $offset = 0;
else
    $offset = $_GET['offset'];

$limit = 10;
$ending = $offset + $limit;

// rows returned wont depend on sorting
$sql = "select count(*) from (" . $_SESSION['finalquery'] . ")";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);
$total_rows = oci_fetch_array($stmt);
if (!$total_rows[0])
{
	echo "<h1> Error- no rows returned!</h1>";
	exit;
}

oci_free_statement($stmt);

// conditional to check for the presence of a sorted query
if (!isset($_SESSION['sortfinalquery']))
{
	// first time accessing this search, no sorting conditions
	$rowFinalQuery = 'select * from( select rownum rnum, a.* from 
	                          (' . $_SESSION['finalquery'] .') a where rownum <= :end)
	                          where rnum >=:beg';
}
else
{	// sorting conditions exist, display the sorted query
	$rowFinalQuery = 'select * from( select rownum rnum, a.* from 
                          (' . $_SESSION['sortfinalquery'] .') a where rownum <= :end)
                          where rnum >=:beg';
}

$stid = oci_parse($conn, $rowFinalQuery);

oci_bind_by_name($stid, ":end", $ending);
oci_bind_by_name($stid, ":beg", $offset);

oci_execute($stid);

$a = 0;
$b = 0;
while ($r = oci_fetch_array($stid, OCI_NUM))
{
    //print_r($r);
    //echo "<br><br>";

    if ($a>= 0) {
        if ($b < $limit) {
        	// conditional statement to hide password and credit card if searching for customer
        	if ($_SESSION['singular'] == "customer")
        	{
	            for ($k=1; $k < count($r) - 2; $k++) {
	                echo $r[$k]." &nbsp";
	            }
	            echo "<a href=http://localhost:8080/" . $_SESSION['singular'] . "info.php?" . $_SESSION['singular'] . "=" . $r[1] . "&information=true> info </a>";
	            echo "<br><br>";
	            $b++;
	        }
	        else
	        {
	            for ($k=1; $k < count($r); $k++) {
	                echo $r[$k]." &nbsp";
	            }
	            echo "<a href=http://localhost:8080/" . $_SESSION['singular'] . "info.php?" . $_SESSION['singular'] . "=" . $r[1] . "&information=true> info </a>";
	            echo "<br><br>";
	            $b++;
	        }
        }
    }
    $a++;
}

// PAGINATION
$pages = intval($total_rows[0]/$limit);

if ($total_rows[0] % $limit)
    $pages++;

// initialize counter for pages
$pageamount = 5;

// initialize conditional for page links, set to middle page always
if ($offset == 0 || $offset == $limit || $offset == $limit * 2)
    $p = 1;
else
    $p = ($offset/$limit) - 2;

// display previous link if not first page
if ($offset != 0)
{
    $prevoffset = $offset - $limit;
    echo "<a href=" . $_SERVER['PHP_SELF'] . "?offset=" . $prevoffset . ">PREV</a> ";
}

// add the links to other pages
for ($c=$p; $c<=$pages; $c++)
{
    if (($offset/$limit)==($c-1))
        echo $c . " ";
    else
    {
        $newoffset = $limit*($c-1);
        echo "<a href=" . $_SERVER['PHP_SELF'] . "?offset=" . $newoffset . "> " . $c . "</a> ";
    }

    if (($c - $p) == $pageamount+1)
        break;
}

// display next page if not last page
if (!((($offset/$limit)+1)==$pages) && $pages!=1)
{
    $newoffset = $offset + $limit;
    echo "<a href=" . $_SERVER['PHP_SELF'] . "?offset=" . $newoffset . "> NEXT </a><br>";
}

oci_free_statement($stid);
oci_close($conn);

echo "<br>";

?>

</div>
<form method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
<div id=sort>
<h3> Sort by: </h3>
	<p> in order of importance</p>
	<div id=sortField>
	</div>
	<?php if ($_SESSION['singular'] == "flight"): ?>
	<input type="button" value="Add Sort Condition" id="addSortCond" onclick="addFlightSort();">
	<?php else: ?>
	<input type="button" value="Add Sort Condition" id="addSortCond" onclick="addCustSort();">
	<?php endif; ?>
	<input type="hidden" name="sort_number" id="sort_number" value="0">
	<input type="submit" value="Apply" id="applySort">
</div>
</form>
<script src="./results.js" language="Javascript" type="text/javascript"></script>
</body>
</html>





