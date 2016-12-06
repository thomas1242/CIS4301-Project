<?php

	session_start();
	// clear query from session so the new search does not contain old conditions and entries
	if (isset($_SESSION['finalquery']) && isset($_SESSION['singular']))
	{
		unset($_SESSION['finalquery']);
		unset($_SESSION['singular']);

		if (isset($_SESSION['sortfinalquery'])) 
		{
			unset($_SESSION['sortfinalquery']);
		}
	}
?>

<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<h2 id="man-search-page-head">Manager Search Interface</h2>
<p class="warning">All items need a value</p>
<form method="post" action="manQueryHandle.php">
<div id="searchField">
	<h3>Describe object to search</h3>
	<label for="searchTable">Search for: </label>
	<select name="searchTable" id="searchTable">
		<option value="">Table</option>
		<option value="customers">Customers</option>
		<option value="flights">Flights</option>
	</select>
</div>
<br>
<div id="conditionField">
	<h3>Describe conditions that the search object must have</h3>
</div>
<br>
<div id="submitField">
	<input type="hidden" name="condition_number" id="condition_number" value="">
	<input type="button" value="Add a Condition" id="addConditionButton" onclick="addCondition();">
	<input type="submit" value="Search" id="submitButton">
</div>
</form>
<pre>
	<?php 
	if ($_POST) {
		echo 'POST array content: <br><br>'; 
		print_r($_POST);
	}
	?>
</pre>
<script src="./manAddElements.js" language="Javascript" type="text/javascript"></script>
</body>
</html>