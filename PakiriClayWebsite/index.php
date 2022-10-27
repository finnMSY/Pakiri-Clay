<?php 
$pageID = 1;
include('navigation.php');  
$_SESSION['scroll'] = "smooth";

$hasErrors = $loginError = "no";
$hasErrorsName = $hasErrorsEmail = $hasErrorsPasswordConfirm = '';
$namePlaceholder = "Your name";
$emailPlaceholder = "Your email address";
$passwordPlaceholder = "One more time?";
$loginPlaceholder = "Your name";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['signup'])) {
    // Get the values from form
    $signup_name = $_POST["signup_name"];
    $signup_email = $_POST["signup_email"];
    $signup_password = $_POST["signup_password"];
    $signup_password_confirm = $_POST["signup_password_confirm"];

    // Error checking
    // Check name is has no numbers in it
    if(!preg_match("/^[A-Za-z\s]{1,50}$/", $signup_name)) {
      $hasErrors = "yes";
      $hasErrorsName = "yes";
    }
    //Check email is valid
    else if(!filter_var($_REQUEST['signup_email'], FILTER_VALIDATE_EMAIL)) {
      $hasErrors = "yes";
      $hasErrorsEmail = "yes";
    }
     //Check both passwords match
    else if ($signup_password_confirm != $signup_password) {
        $hasErrors = "yes";
        $hasErrorsPasswordConfirm = "yes";
    }
    else {
      $hasErrors = "no";
    }

    //Check for duplicate Email
    $duplicate_sql = "SELECT * FROM `user_accounts` WHERE email='$signup_email'";
    $duplicate_query = mysqli_query($conn, $duplicate_sql);
    $count = mysqli_num_rows($duplicate_query);

    if ($count >= 1) {
        $hasDuplicates = "yes";
        $hasErrors = "yes";
    }

    //Styling the inputs if there is an error and displaying the error message
    if ($hasErrorsName == "yes") {
      $nameBorder= "#CA0202";
      $namePlaceHolder = "errorPlaceholder";
    }
    if ($hasErrorsEmail == "yes" OR $hasDuplicates == "yes") {
      $emailBorder= "#CA0202";
      $emailPlaceHolder = "errorPlaceholder";
    }
    if ($hasErrorsPasswordConfirm == "yes") {
      $passwordConfirmBorder= "#CA0202";
      $passwordConfirmPlaceHolder = "errorPlaceholder";
    }

    if ($hasErrorsName == "yes") {
      $namePlaceholder = "Please re-enter your name";
    }
    if ($hasErrorsEmail == "yes") {
      $emailPlaceholder = "Please re-enter your email";
    }
    if ($hasErrorsPasswordConfirm == "yes") {
      $passwordPlaceholder = "This does not match your password";
    }
    if ($hasDuplicates == "yes") {
      $emailPlaceholder = "This email is in use";
    }

    //If there are no errors the data will be inserted into the database
    if ($hasErrors == "no") {

      $signup_password = password_hash($_POST["signup_password"], PASSWORD_DEFAULT);
      $randNum = hash('md5', generateRandomString());

      $sql = "INSERT INTO user_accounts (username, email, password, hash, active) VALUES ('$signup_name', '$signup_email', '$signup_password', '$randNum', 0)";

      if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
        header("Location: index.php#footer");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      // $to = $signup_email;
      // $subject = 'Signup | Verification';
      // $message = '

      // Thanks for signing up!
      // Your account has been created.

      // To activate your account please click the link below...
      // http://localhost/PakiriClayWebsite/verify.php?email='.$signup_email.'&hash='.$randNum.'
      // ';

      // $headers = 'From:noreply@pakiriclay.com' . "\r\n";
      // mail($to, $subject, $message, $headers);   
    }
  }
  else if (isset($_POST['login'])) {
    $login_name = $_POST["login_name"];
    $login_email = $_POST["login_email"];
    $login_password = $_POST["login_password"];

    $sql = "SELECT * FROM user_accounts where email = '$login_email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $password = $row["password"];
      $name = $row["username"];
      $id = $row["id"];

      $verify = password_verify($login_password, $row["password"]);
      if ($verify == 1 AND $name == $login_name) {
        $_SESSION['account'] = $id;
        header("Location: index.php"); //Will take the user to their account page
      }
      else {
        $loginError = "yes";
      }
    } else {
      $loginError = "yes";
    }
    
    if ($loginError == "yes") {
      $loginBorder= "#CA0202";
      $loginPlaceHolder = "errorPlaceholder";
      $loginPlaceholder = "Your login details are incorrect";
    }
  }
  $conn->close();
}
?>
  <main class="scroll-container">
    <section data-index="1" id="home" style="z-index: 2;">
      <!-- <img src="Images/mainimage.jpg"> -->
      <h2 id="title">Pakiri Clay</h2>
      <p id="subtitle"><b style="color: #86C02A;">~</b> The finest pottery money can buy <b style="color: #86C02A;">~</b></p>
      <a id="title_scrollbtn" href="#messages"><span></span><span></span><span></span></a>
    </section>
    <section id="messages" data-index="2">
      <h2 id="messages">Messages</h2>
    </section>
    <section id="store" data-index="3">
      <div class="store_div">
        <h2>Want your own?</h2>
        <p>Have your very own collection of unforgettable items</p>
        <a href="store.php">Shop</a>
      </div>
      <div class="store_div store_div_image">
      </div>
    </section>
    <section id="contact" data-index="4">
      <h2>Contact</h2>
    </section>
    <section id="footer" data-index="5">
      <!-- <span><i id="triangle-down"></i></span>
      <div id="login_table">
        <div style="grid-area: login_header;"><span>Sign In</span></div>
        <div style="grid-area: login_email;"><input type="" name="" placeholder="Email"></div>
        <div style="grid-area: login_password;"><input type="" name="" placeholder="Password"></div>
        <div style="grid-area: login_submit;"><input type="submit" name="" value="Login"></div>
      </div>
      <div id="left_half">
      </div> -->
      <div id="footer_table">
        <div id="login">
          <div class="div_left">
            <div><img src="Images/mainimage.jpg" alt="Logo"></div>
            <h2>Consider an account?</h2>
            <ul>
              <li>Faster and easier purchasing</li>
              <li>Moniter unavailible items</li>
              <li>Recieve information from the creater.</li>
            </ul>
          </div>
          <div class="div_right">
            <button class="loginbuttons" id="signupButton" onclick="displaySignup()">Sign up</button> <span style="color: darkgrey">/</span><button class="loginbuttons" id="loginButton" onclick="displayLogin()">Login</button>
            <div id="signup" style="display: block;">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="post">
                <div style="" class="signupline">
                  <h2>We will need...</h2>
                  <input type="" name="signup_name" placeholder="<?php print($namePlaceholder); ?>" required style="border-color: <?php print($nameBorder);?>;" class="<?php print($namePlaceHolder); ?>">
                  <input type="" name="signup_email" placeholder="<?php print($emailPlaceholder); ?>" required style="border-color: <?php print($emailBorder);?>;" class="<?php print($emailPlaceHolder); ?>">
                  <input type="password" name="signup_password" placeholder="Your password" required style="border-color: <?php print($passwordBorder);?>;" class="<?php print($passwordPlaceHolder); ?>">
                  <input type="password" name="signup_password_confirm" placeholder="<?php print($passwordPlaceholder); ?>" required style="border-color: <?php print($passwordConfirmBorder);?>;" class="<?php print($passwordConfirmPlaceHolder); ?>">
                </div>
                <div style="padding-left: 50px;" class="signupextra">
                  <h2>Or you can...</h2>
                  <a href="#store">Browse as a guest</a>
                  <a onclick="displayLogin()">Login</a>
                </div>
                <button type="submit" name="signup">Signup</button>
              </form>
            </div>
            <div id="logindiv" style="display: none;">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="post">
                <h2>Enter your details...</h2>
                <input type="text" name="login_name" placeholder="<?php print($loginPlaceholder)?>" required style="border-color: <?php print($loginBorder);?>;" class="<?php print($loginPlaceHolder); ?>">
                <input type="email" name="login_email" placeholder="Your email address" required>
                <input type="password" name="login_password" placeholder="Your password" required>
                <button name="login" type="submit">Login</button>
              </form>
              <a href="">Forgot password?</a>
            </div>
          </div>
        </div>
        <div id="footerdiv">
           <div class="w3hubs-footer">
             <div class="w3hubs-icon">
              <ul>
                 <li><a href="www.facebook.com" target="black"><i class="fa fa-facebook"></i></a></li>
                 <li><a href="#" target="black"><i class="fa fa-google-plus"></i></a></li>
                 <li><a href="#" target="black"><i class="fa fa-twitter"></i></a></li>
                 <li><a href="#" target="black"><i class="fa fa-instagram"></i></a></li>
                 <li><a href="#" target="black"><i class="fa fa-youtube-play"></i></a></li>
              </ul>
             </div>
             <div class="w3hubs-nav2">
              <ul>
                 <li><a href="#home" title="To Top"><i class="fa fa-chevron-down"></i></a></li>
              </ul>
             </div>
             <div class="CreativeLicense">
              <ul>
                 <p>Creative Commons License: Pakiri Clay</p>
              </ul>
             </div>
           </div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>

<!-- <script src="javascript.js"></script>
 -->
 <script language="JavaScript">

function displaySignup() {
  document.getElementById("signup").style.display = "block";
  document.getElementById("logindiv").style.display = "none";
  document.getElementById("loginButton").style.color = "darkgrey";
  document.getElementById("signupButton").style.color = "#86C02A";
}

function displayLogin() {
  document.getElementById("logindiv").style.display = "block";
  document.getElementById("signup").style.display = "none";
  document.getElementById("signupButton").style.color = "darkgrey";
  document.getElementById("loginButton").style.color = "#86C02A";
}
// Javascript preventing form resubmit on refresh
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

let timer;
window.addEventListener('scroll', () => {
  clearTimeout(timer);
  timer = setTimeout(() => {
    callback();
  }, 300);
}, {passive: true});
</script>