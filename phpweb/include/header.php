<?php 
include("include/connect.php"); 
session_start();
if (!isset($_SESSION["user_login"])) {

}
else 
{
  $username = $_SESSION["user_login"];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SplashBook</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">SplashBook</h3>
              <ul class="nav masthead-nav">
                <li class="active"><a href="index.php">Home</a></li>
		<li><a href="profile.php">Profile</a></li>
                <li><a href="index.php">Sign In</a></li>
                <li><a href="http://lamp.cse.fau.edu/~kleine2014/project5/">Post a Photo!</a></li>
              </ul>
            </div>
          </div>