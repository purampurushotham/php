<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employeeDB";

$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}

if(isset($_POST['user_email']))
{
 $emailId=$_POST['user_email'];

 $checkdata=" SELECT id FROM employees WHERE email='$emailId' ";
$result = $conn->query($checkdata);
if ($result->num_rows > 0) {
  echo "Email Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}
?>