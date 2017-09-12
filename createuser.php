<?php
require_once('db_con.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Create user</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <link rel="stylesheet" href=style.css">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 960px)">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 1500px)">
</head>
<body>

    <div class="navbar">
        <div class="active">
        <ul class="navbar-right">
            <li><a class="active" href="createuser.php">Create user</a></li>
        </ul>
    </div>
    </div>

<?php
	
if (filter_input(INPUT_POST, 'submit')){
	
	$un = filter_input(INPUT_POST, 'un')
		or die('Missing/illegal un parameter');
	
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	
	$pw = password_hash($pw, PASSWORD_DEFAULT);
	
	echo 'Creating user '.$un.' with password: '.$pw;
	
	$sql= 'INSERT INTO login (username, pwhash) VALUES (?, ?)';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('ss', $un, $pw);
	$stmt->execute(); 
	
	if ($stmt->affected_rows > 0) {  //fører videre til næste side som nu bliver: login.php
		echo 'user '.$un.' added ';
		echo "<script language='javascript' type='text/javascript'>";
		echo "alert('Du er nu oprettet som bruger');";
		echo "</script>";
		$URL="login.php";
		echo "<script>location.href='$URL'</script>";
	}
	else {
		echo 'could not add user';
	}
}
?>

<div class="background">
<div class="form">
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Create user</legend><br>
    	<input name="un"  type="text" placeholder="Brugernavn" size="30" required /><br>
    	<input name="pw" type="password"  placeholder="Password" size="30" required /><br><br>
    	<input name="submit" type="submit" value="Opret bruger" /><br>
	</fieldset>
</div>
</div>
</form>
</body>
</html>