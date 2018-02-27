<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employeeDB";
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
$sql="SELECT * FROM employees";
$result = $conn->query($sql);
if(isset($_POST['id'])) // here passed id is an array so we need to use a loop and for each iteration we will execute delete query.
{
foreach($_POST['id'] as $id){ // $id is each id from passed array id
 $sql_query="DELETE FROM employees WHERE id='".$id."'";
 $conn->query($sql_query);
}// closing for loop 
}