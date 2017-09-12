<?php
require_once('db_con.php');
	
if(isset($_POST['submitdel'])){
	
	// delete category
		$cid = filter_input(INPUT_GET, 'idPoster', FILTER_VALIDATE_INT)
			or die('Missing/illegal idposter parameter');
		$sql = ("DELETE FROM poster WHERE idPoster=?");
		$stmt = $con->prepare($sql);
		$stmt->bind_param('i', $cid);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Deleted category '.$cid;
			echo '<meta http-equiv="refresh" content="0; url=upload.php" />';
			exit();
		}
		else {
			echo 'Error deleting category';
		}
		
	}
	else {
		die('Unknown cmd parameter'.$cmd);
	}
	
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 960px)">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 1500px)">
<title>Category list</title>
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



</body>