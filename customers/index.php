<!DOCTYPE html>
<html lang="en">

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

    <!-- Navigation -->
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
                        <a href="profile.php">Profile</a>
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

    <!-- Page Content -->
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Search for flights</h1>
            </div>
            <div class="panel-body">
                <form action="customers.php" method="get">
                <div id="selections">
                    <p>
                        <select id = "locSelect" name = "locSelect" class="btn btn-primary btn-sm dropdown-toggle" onchange="placeholderFill()">
                            <option value="placeholder">Search by: </option>
                            <option value="airport">Airport</option>
                            <option value="city">City</option>
                        </select>
                    </p>
                </div>
                <div class="form-group">
                    <label for="dept">From:</label>
                    <input type="text" class="form-control" id="dept" name = "dept" placeholder="">
                </div>
                <div class="form-group">
                    <label for="arv">To:</label>
                    <input type="text" class="form-control" id="arv" name = "arv" placeholder="">
                </div>
                <label for="month">Depart by:</label>
                <div id="monthdropdown">
                    <p>
                        <select id = "month" name = "month" class="btn btn-primary btn-sm dropdown-toggle" onchange="changeDays()">
                            <option value="placeholder">Month</option>
                            <option value="jan">January</option>
                            <option value="feb">February</option>
                            <option value="mar">March</option>
                            <option value="apr">April</option>
                            <option value="may">May</option>
                            <option value="jun">June</option>
                            <option value="jul">July</option>
                            <option value="aug">August</option>
                            <option value="sep">September</option>
                            <option value="oct">October</option>
                            <option value="nov">November</option>
                            <option value="dec">December</option>
                        </select>
                    </p>
                </div>
                <div id="daydropdown">
                    <label for="month">Arrive by:</label>
                    <div>
                        <p>
                            <select id = "day" name = "day" class="btn btn-primary btn-sm dropdown-toggle">
                                <option value="placeholder">Day</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29" id = "29">29</option>
                                <option value="30" id = "30">30</option>
                                <option value="31" id = "31">31</option>
                        </p>
                    </div>
                </div>
                
                <input type = "submit" class = "btn btn-default" id = "searchbtn">


                </form>
            </div>
        </div>


    </div>
    <!-- /.container -->
    <script>
            function changeDays() {
                var x = document.getElementById("month").value;
                if(x === "jan") {
                    document.getElementById("29").style.display = "block";
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "block";
                }
                else if(x === "feb") {
                    document.getElementById("29").style.display = "none";
                    document.getElementById("30").style.display = "none";
                    document.getElementById("31").style.display = "none";
                }
                else if(x === "mar") {
                    document.getElementById("29").style.display = "block";
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "block";
                }
                else if(x === "apr") {
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "none";
                }
                else if(x === "may") {
                    document.getElementById("29").style.display = "block";
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "block";
                }
                else if(x === "jun") {
                    document.getElementById("29").style.display = "block";
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "none";
                }
                else if(x === "jul") {
                    document.getElementById("29").style.display = "block";
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "block";
                }
                else if(x === "aug") {
                    document.getElementById("29").style.display = "block";
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "block";
                }
                else if(x === "september") {
                    document.getElementById("29").style.display = "block";
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "none";
                }
                else if(x === "oct") {
                    document.getElementById("29").style.display = "block";
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "block";
                }
                else if(x === "nov") {
                    document.getElementById("29").style.display = "block";
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "none";
                }
                else if(x === "dec") {
                    document.getElementById("29").style.display = "block";
                    document.getElementById("30").style.display = "block";
                    document.getElementById("31").style.display = "block";
                }

            }
            function placeholderFill() {
                var selectby = document.getElementById("locSelect").value;
                if(selectby === "airport") {
                    document.getElementById("dept").placeholder = "Departure Airport (ie. MIA, LAX)";
                    document.getElementById("arv").placeholder = "Enter Name of Arrival Airport (ie. MIA, LAX)";
                }
                else if(selectby === "city") {
                    document.getElementById("dept").placeholder = "Departure City (ie. Miami, New York)";
                    document.getElementById("arv").placeholder = "Enter Name of Arrival City (ie. Miami, New York)";
                }
                else {
                    document.getElementById("dept").placeholder = "";
                    document.getElementById("arv").placeholder = "";
                }
            }
        </script>
    <!-- jQuery -->
    <script src="/resources/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/resources/js/bootstrap.min.js"></script>

</body>

</html>
