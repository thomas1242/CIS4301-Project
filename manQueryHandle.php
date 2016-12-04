<!-- 
	file to handle the search request from manager search interface.
	Should take in all variables passed through POST, and construct an appropriate
	query for the POSTed variables.
-->

<?php

// handle the searchField and condition_number since they are the only assured values
if ($_POST['searchTable'] == "customers")
	$search = "customer_id";
else
	$search = "flight_id";

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

		// check if the condition attribute is date (it will have different condition fields)
		if ($newdata['attribute'] == "date")
		{
			$newdata['month'] = $_POST['condition_month_' . $i];
			$newdata['day'] = $_POST['condition_day_' . $i];
		}
		// else, extract values from operand and value
		else
		{
			$newdata['operand'] = $_POST['conditionOperand_' . $i];
			$newdata['value'] = $_POST['conditionValue_' . $i];
		}

		$conditions[$i] = $newdata;

		unset($newdata);
	}

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

	$partSqlQuery .= "with ";

	foreach ($conditions as $j => $values)
	{
		$conditions_togo -= 1;

		// if the table is from orders, create the aggregate sql query
		if ($values['table'] == "orders")
		{
			// handle flight count attribute in orders
			if ($values['attribute'] == "orders")
			{

			}
			// hardcoded flights since managers would not add orders condition if searching for flight
			$partSqlQuery = $partSqlQuery . "tablename" . $tablename . " as (select orders." . $search . " from orders, flights where orders.flight_id = flights.flight_id group by " . $search . " having sum(" . $values['attribute'] . ") " . $values['operand'] . " " . $values['value'] . " order by " . $search . ")";
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
				|| $values['attribute'] == "departure_city_state" || $values['attribute'] == "arrival_airport" || $values['attribute'] == "departure_airport" || $values['attribute'] == "departure_state" || $values['attribute'] == "arrival_state")
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
	$partSqlQuery .= "select tablename1." . $search . " from ";

	for ($i=1; $i<$condition_number+1; $i++)
	{
		if ($i != $condition_number)
			$partSqlQuery .= "tablename" . $i . ", ";
		else
			$partSqlQuery .= "tablename" . $i ." ";
	}

	$partSqlQuery .= "where ";

	// put where clause of join condition
	for ($i=1; $i<$condition_number; $i++)
	{
		if ($i != 1)
			$partSqlQuery .= "and ";

		$partSqlQuery .= "tablename" . $i . "." . $search . " = " . "tablename" . ($i+1) . "." . $search . " ";
	}

	$finalSqlQuery .= $partSqlQuery . ";";
	print $finalSqlQuery;
}



?>