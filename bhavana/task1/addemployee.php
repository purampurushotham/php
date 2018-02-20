<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employeeDB";
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mname = $_POST['mname'];
$dept=$_POST['dept'];
$doj=$_POST['doj'];
$job=$_POST['job'];
$gender = $_POST['gender'];
$altemail=$_POST['altEmail'];
$email=$_POST['email'];
$mob=$_POST['mob'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$selectQuery = "SELECT * from employees where id=".$_POST['id'];
$result = $conn->query($selectQuery);
if ($result->num_rows > 0) {
$sql = "UPDATE employees SET firstname='".$fname."', middlename='".$mname."' ,lastname='".$lname."', email='".$email."',mobno='".$mob."',alternateEmail='".$altemail."', department='".$dept."', gender='".$gender."', job='".$job."', doj='".$doj."' WHERE id=".$_POST['id'];	
}
else{
$sql = "INSERT INTO employees (firstname, middlename,lastname, email,mobno,alternateEmail, department, gender, job, doj)
		VALUES ('".$fname."','".$mname."','".$lname."','".$email."','".$mob."','".$altemail."','".$dept."','".$gender."','".$job."','".$doj."')";
	}
if ($conn->query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}	

$conn->close();
?>