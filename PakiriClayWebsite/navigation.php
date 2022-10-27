<!DOCTYPE html>
<html>
<head>
  <title>Pakiri Clay</title>
  <link rel="stylesheet" type="text/css" href="Css/stylesheet.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="javascript.js"></script>
</head>

<?php 
include("setup.php"); 
session_start();
$scrollBehavior = "";

if (isset($_SESSION['scroll'])) {
  $scrollBehavior = $_SESSION['scroll'];
}
else {
  $scrollBehavior = "smooth";
}

?>
<style type="text/css">
  * {
   scroll-behavior: <?php print($scrollBehavior) ?>;
  }
</style>
<?php

if (isset($_GET['signout'])) {
  session_destroy();
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if ($pageID == 1) {
  $homeLink = "#home";
  $storeLink = "#store";
  $contactLink = "#contact";
  $aboutLink = "#messages";
}
else {
  $homeLink = "index.php";
  $storeLink = "store.php";
  $contactLink = "contact.php";
  $aboutLink = "about.php";
}

if (isset($_SESSION['account'])) {
  $account_ID = $_SESSION['account'];
  $sql = "SELECT * FROM user_accounts where id = '$account_ID'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["username"];
  }
}

?>
<body> 
  <div class="nav_backdrop" style="position: fixed;"></div>
  <div class="container">
    <div class="topnav" id="myTopnav">
      <a href="<?php print($homeLink) ?>" id="logo">Logo</a>
      <a href="<?php print($storeLink) ?>">Store</a>
      <a href="<?php print($contactLink) ?>">Contact</a>
      <a href="<?php print($aboutLink) ?>">Bookings</a>
      <a href="cart.php" style="float: right;"><img src="Images/cart.png" width="18"></a>
      <div class="dropdown" style="float: right;">
        <?php 
          if (isset($_SESSION['account'])) {
            ?>
            <button class="dropbtn">
              <?php print($name);?>
              <i class="fa fa-caret-down"></i>
            </button>
            <?php
          }
          else {
            ?>
            <button class="dropbtn">
              <a href="scroll_behaviour.php"><u>Sign in</u> or <u>Register</u></a>
            </button>
            <?php
          }
          ?>
        <div style="display: <?=isset($_SESSION['account']) ? 'block' : 'none'?>">
          <div class="dropdown-content">
            <a href="#account">Account</a>
            <a href="index.php#footer" style="display: <?=!isset($_SESSION['account']) ? 'block' : 'none'?>">Sign In</a>
            <a href="index.php?signout=true" style="display: <?=!isset($_SESSION['account']) ? 'none' : 'block'?>">Sign Out</a>
                    <?php
                  function runMyFunction() {
                    session_destroy();  
                      header("Location: index.php");
                  }

                  if (isset($_GET['signout'])) {
                    runMyFunction();
                  }
                  ?>
          </div>
        </div>
        
      </div> 
      <a href="javascript:void(0);" style="font-size:15px;" class="icon topbuttons" onclick="myFunction()">&#9776;</a>
    </div>
  </div>

