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
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Customer Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/resources/css/logo-nav.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="plane.jpeg" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Search Flights</a>
                    </li>
                    <li>
                        <a href="#">Orders</a>
                    </li>
                    <li>
                        <a href="#">Bookmarks</a>
                    </li>
                     </ul>
                        <div class="pull-right">
                            <ul class="nav navbar-nav">
                                 <li><form><button formaction="http://localhost/login.php" type="submit" class="btn navbar-btn btn-danger" name="logout" id="logout" value="Log Out">Log Out</button></form></li>
                                 </ul>     
                        </div>
               
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
    	<div class="panel panel-default">
			<div class="panel-heading" id="man-search-page-head"><h3>Manager Search Interface</h3></div>
		
			<form method="post" action="manQueryHandle.php">
			<div id="searchField" class="panel panel-default">
				<div class="panel-body">
					<h4>Describe object to search</h4>
					<label for="searchTable">Search for: </label>
					<select name="searchTable" id="searchTable" class="btn btn-primary btn-sm dropdown-toggle">
						<option value="">Table</option>
						<option value="customers">Customers</option>
						<option value="flights">Flights</option>
					</select>
				</div>	
			</div>
			
			<div class="panel-group" id="conditions">
				<div id="conditionField" class="panel panel-default">
					<h4 id="conditionTitle">Describe conditions that the search object must have</h4>
				
					<div id="submitField">
						<input type="hidden" name="condition_number" id="condition_number" value="">
						<input type="button" value="Add a Condition" class = "btn btn-default" id="addConditionButton" onclick="addCondition();">
						<input type="submit" value="Search" class = "btn btn-default" id="submitButton">
					</div>
				</div>
			</form>
			</div>

		</div>
		<pre>
			<?php 
			if ($_POST) {
				echo 'POST array content: <br><br>'; 
				print_r($_POST);
			}
			?>
		</pre>
		<script src="./manAddElements.js" language="Javascript" type="text/javascript"></script>
	</div>
</body>
</html>
