<?php include("include/header.php"); ?>
<?
if (isset($_GET['u'])) {
	$username = mysql_real_escape_string($_GET['u']);
	if (ctype_alnum($username)) {
 	//check user exists
	$check = mysql_query("SELECT username, first_name FROM users WHERE username='$username'");
	if (mysql_num_rows($check)===1) {
	$get = mysql_fetch_assoc($check);
	$username = $get['username'];
	$firstname = $get['first_name'];	
	}
	else
	{
	echo "<h2>User does not exist!</h2>";	
	exit();
	}
	}
}
?>


<?
  $get_info = mysql_query("SELECT first_name, last_name, bio FROM users WHERE username ='$username'");
  $get_row  = mysql_fetch_assoc($get_info);
  $db_firstname = $get_row['first_name'];
  $db_last_name = $get_row['last_name'];
  $db_bio = $get_row['bio'];
  //submit to database
  $senddata = @$_POST['senddata'];
  if ($senddata) {
    //if form submitted
    $bio = @$_POST['bio'];
  } else {
    //do nothing
  }

  $info_submit_query = mysql_query("UPDATE users SET bio='$bio' WHERE username='$username'");
  echo "Please refresh the page to see your new updates! ---   ";



  $about_query = mysql_query("SELECT bio FROM users WHERE username='$username'");
  $get_result = mysql_fetch_assoc($about_query);
  $about_the_user = $get_result['bio'];
  

  echo $about_the_user;
?>
<h2>Profile page for: <?php echo "$username"; ?></h2>
<hr>
<p>UPLOAD YOUR PROFILE PHOTO:</p>
<form action="" method="POST" enctyp="multipart/form-data">
<img src="img/default_pic.jpg" width="250" height="250" />
<input type="file" name="profilepic" /><br>
<input type="submit" name="uploadpic" value="Upload Image"/>
</form>

<?php
  if (isset($_POST['profilepic'])) {
        if (((@$_FILES["profilepic"]["type"]=="image/jpeg") || (@$_FILES["profilepic"]["type"]=="image/png") || (@$_FILES["profilepic"]["type"]=="image/gif"))&&(@$_FILES["profilepic"]["size"] < 1048576)) //1 Megabyte
  {
   $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   $rand_dir_name = substr(str_shuffle($chars), 0, 15);
   mkdir("users/profile_pics/$rand_dir_name");

   if (file_exists("users/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"]))
   {
    echo @$_FILES["profilepic"]["name"]." Already exists";
   }
   else
   {
    move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"users/profile_pics/$rand_dir_name/".$_FILES["profilepic"]["name"]);
    //echo "Uploaded and stored in: userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"];
    $profile_pic_name = @$_FILES["profilepic"]["name"];
    $img_id_before_md5 = "$rand_dir_name/$profile_pic_name";
    $img_id = md5($img_id_before_md5);
    $profile_pic_query = mysql_query("UPDATE users SET profile_pic='$rand_dir_name/$profile_pic_name' WHERE username='$username'");
    header("Location: profile.php");

   }
}
}
?>
<br><br><br>
<form action="profile.php" method="post">
About You: <textarea name="bio" id="bio" cols="40" rows="7"><? echo $db_bio; ?></textarea><br><br>
<input type="submit" name="senddata" id="senddata" value="Update Profile">
</form>
<script src="canvas.js"></script>