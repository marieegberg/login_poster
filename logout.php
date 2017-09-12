<?php
require_once('db_con.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 960px)">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 1500px)">
</head>

<body>

<div class="navbar-left">
        </div>
    <div class="navbar">
        <div class="active">
        <ul class="navbar-right">
            <li><a href="createuser.php">Create user</a></li>
        </ul>
    </div>
    </div>


<?php

session_start();
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
		);
}
	sleep(3); 
	header("Location: login.php");
	die();
	echo 'du er logget ud';

session_destroy();
?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

Du er nu logget ud

</body>
</html>
</body>
</html>