<?php
require_once('db_con.php');
ob_start();
session_start();
?>

<?php
if($cmd = filter_input(INPUT_POST, 'cmd')){
	
		$cid = filter_input(INPUT_POST, 'idposter', FILTER_VALIDATE_INT)
			or die('Missing/illegal idposter parameter');
		$cnam = filter_input(INPUT_POST, 'posterheadline')
			or die('Missing/illegal categoryname parameter');
		
		$sql = 'UPDATE poster SET headline=? WHERE idPoster=?';
		$stmt = $con->prepare($sql);
		$stmt->bind_param('si', $cnam, $cid);
		$stmt->execute();
		
		if($stmt->affected_rows >0){
			echo 'Category name updated to '.$cnam;
		}
		else {
			echo 'Could not change name of category '.$cid;
		}
	
}
	
	
	
if(empty($cid)){	
	$cid = filter_input(INPUT_GET, 'idposter', FILTER_VALIDATE_INT)
		or die('Missing/illegal categoryid parameter');
}
	
	require_once('db_con.php');
	$sql = 'SELECT headline FROM poster WHERE idPoster=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('i', $cid);
	$stmt->execute();
	$stmt->bind_result($cnam);
	while($stmt->fetch()) {}
	
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 960px)">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 1500px)">
<title>Rename category</title>
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

<div class="background">
<div class="form">
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Rename headline</legend>
    	<input type="hidden" name="idposter" value="<?=$cid?>" />
    	<input name="posterheadline" type="text" value="<?=$cnam?>" placeholder="Categoryname" required /><br><br>
		<button name="cmd" value="rename_category" type="submit">Update image name</button>
		<a class="all_image" href="upload.php"> Go back and see all images </a>
	</fieldset>
</form>
	</div>
	</div>
</body>
</html>
<?php ob_flush(); ?>