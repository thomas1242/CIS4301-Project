    
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
        <link href="/resources/css/login.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="/resources/css/logo-nav.css" rel="stylesheet">
        <div class="container">
            <h1 class="welcome text-center">Welcome</h1>
        </div><!-- /container -->

    </head>
    <body>

    <div class="container">
        <div class="card card-container">
        <h2 class='login_title text-center'>Login</h2>
        <hr>

            <form class="form-signin" name="form1" method="post" action="checklogin.php">
                <span id="reauth-email" class="reauth-email"></span>
                <p class="input_title">Username</p>
                <input type="text" id="myusername" name="myusername" class="login_box" placeholder="" required autofocus>
                <p class="input_title">Password</p>
                <input type="password" id="mypassword" name="mypassword" class="login_box" placeholder="" required>
                <div id="remember" class="checkbox">
                    <label>
                   </label>
                </div>
                <button class="btn btn-lg btn-primary" type="submit">Login</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>
</html

