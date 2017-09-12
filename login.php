<?php require_once('db_con.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 960px)">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 1500px)">
<title>Log in</title>
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
if(filter_input(INPUT_POST, 'submit')){
	$un = filter_input(INPUT_POST, 'un') 
		or die('Missing/illegal un parameter');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	$sql = 'SELECT idLogin, pwhash FROM login WHERE username=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $pwhash);
	
	while($stmt->fetch()) { }
	
	if (password_verify($pw, $pwhash)){  //fører videre til næste side som nu bliver: login.php
		$_SESSION["loginId"] = $uid;
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('Du er logget ind');";
		echo "</script>";
		$URL="upload.php";
		echo "<script>location.href='$URL'</script>";
	}
	else{
		echo 'Illegal username/password. Please try again combination';
	}
	echo '<hr>';
}
	
?>

<div class="background">
<div class="form">
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Login</legend>
    	<input name="un" type="text" placeholder="Brugernavn" size="30" required /><br>
    	<input name="pw" type="password" placeholder="Password" size="30"  required /><br><br>
    	<input name="submit" type="submit" value="Login" /><br>
    	<a class="create" href="createuser.php">Create user</a>
	</fieldset>
</form>
</div>
</div>
</body>
</html>