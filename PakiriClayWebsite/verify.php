<?php 

include('setup.php');

$sql = "SELECT * FROM user_accounts where email = 'fmassey6@gmail.com'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $password = $row["password"];
  $name = $row["username"];
} else {
  echo "0 Results";
}

$verify = password_verify("thetiger", $password);

if ($verify == 1) {
	print("Valid psw");
	if ($name == 'Finn Massey') {
		print('Valid Nae');
	}
}
else {
	print("Not Valid");
}



?>