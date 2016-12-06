 <?php
 session_start();
 ?>

<html>
    <head>
    </head>
        <body>    
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Customer Registration</title>
        <!-- Bootstrap Core CSS -->
        <link href="/resources/css/bootstrap.min.css" rel="stylesheet">
        <link href="/resources/css/newCustomer.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="/resources/css/logo-nav.css" rel="stylesheet">
            <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://bootsnipp.com/dist/bootsnipp.min.css?ver=7d23ff901039aef6293954d33d23c066">
    
    </head>
    <body>

    <div class="container">
    <div class="row">
      <div class="panel panel-primary">
        <div class="panel-body">
          <form method="POST" action="insertCustomer.php" role="form">
            <div class="form-group">
              <h2>Customer Registration</h2>
            </div>
            <div class="form-group">
              <label class="control-label" for="signupName">First name</label>
              <input id="signupFirstName" name="signupFirstName" type="text" maxlength="50" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label" for="signupName">Last name</label>
              <input id="signupLastName" name="signupLastName" type="text" maxlength="50" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label" for="signupEmail">Email</label>
              <input id="signupEmail" name="signupEmail" type="email" maxlength="50" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label" for="signupEmailagain">Email again</label>
              <input id="signupEmailagain" name="signupEmailagain" type="email" maxlength="50" class="form-control">
            </div>
            <div class="form-group">
              <label class="control-label" for="signupPassword">Password</label>
              <input id="signupPassword" name="signupPassword" type="password" maxlength="25" class="form-control" placeholder="at least 6 characters" length="40">
            </div>
            <div class="form-group">
              <label class="control-label" for="signupPasswordagain">Credit Card Number</label>
              <input id="CCnumber" name="CCnumber" type="text" maxlength="25" class="form-control">
            </div>
            <div class="form-group">
              <button id="signupSubmit" name="signupSubmit" type="submit" class="btn btn-info btn-block">Create your account</button>
            </div>
            <hr>
            <p></p>Already have an account? <a href="login.php">Sign in</a></p>
          </form>
        </div>
      </div>
    </div>
  </div>





    </body>
</html>