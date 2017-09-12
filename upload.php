<?php
require_once('db_con.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 960px)">
            <link rel="stylesheet" href="style.css" media="screen and (min-width: 1500px)">
<title>Images upload with PHP</title>
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
	$loginId = $_SESSION["loginId"];

	$cmd = filter_input(INPUT_POST, 'upload');

	// variable to check if there were upload problems/errors!
 	$uploadOk = 0;
	
	if($cmd){
		$headline = filter_input(INPUT_POST, 'headline')
	or die('Missing/illegal title parameter!!!');
		// storing the path to image directory 
		$target_dir = "poster/";
 		$target_file = $target_dir . basename($_FILES['fileToUpload']['name']); //specifies the path of the file to be uploaded (ex. lamb.jpg)
		
		// Check if file is an image
		 $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		 if($check !== false) {
		 echo "File is an image type " . $check["mime"] . ". ";
		 $uploadOk = 1;
		 } else {
		 echo "File is not an image. ";
		 $uploadOk = 0;
		 }
		
		// Check if file already exists
		 if (file_exists($target_file)) {
		 echo "The file already exists. ";
		 $uploadOk = 0; 
		 } 
		
		// Check if $uploadOk is set to 0 by an error
		 if ($uploadOk == 0) {
		 echo "Sorry, your file was not uploaded. ";
		 // if everything is ok, try to upload file
		 } else {
		 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

		// the query inserting target path into database!
		
		$stmt = $con->prepare('INSERT INTO poster (headline, url, login_idLogin) VALUES (?, ?, ?)');
		$stmt->bind_param('ssi', $headline, $target_file, $_SESSION["loginId"]);
		$stmt->execute();
		
		$stmt->close();
		

		 echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		 } else {
		 echo "Sorry, there was an error uploading your file.";
		 }
		 }
		
	// end if cmd:	
	}

?>

<!-- enctype multipart must be used in connection with a file/ image upload -->
<div class="background">
<div class="form">
	<fieldset>
	<legend>Upload image</legend>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
	<input class="input_upload" type="text" name="headline" placeholder="Headline"><br><br>
	<input class="input_upload" type="file" name="fileToUpload"><br><br>
	<input class="input_upload" type="submit" name="upload" value="Upload">
	<a class="logud_upload" href="login.php">log ud</a>
	</fieldset>
</form>
</div>

<br><br><br><br><br><br><br><br>
<h2 class="display_text">Here is your images</h2><br><br>
<?php 
	$stmt = $con->prepare('SELECT idPoster, headline, url FROM poster');
	$stmt->execute(); 
	$stmt->bind_result($pid, $headlinetekst, $url);
	
	while ($stmt->fetch()) {
		echo '<p class="headline_text">' . $headlinetekst . '</p>';
		echo '<p><img class="image_display" src="' . $url . '" width="200" ></p>';
		?>
		<br>
		<div class="style_image"><br>
		<br>
		<a href="renameheadline.php?idposter=<?=$pid?>">Rename</a><br><br>
				<form action="delete.php?idPoster=<?=$pid?>" method="post" enctype="multipart/form-data">
					<button type="submit" name="submitdel">Delete</button><br><br><br><br><br><br>
		<hr>
		</div>
		<?php
	}
	
	$stmt->close();
	$con->close();
	
?>
</body>
</html>