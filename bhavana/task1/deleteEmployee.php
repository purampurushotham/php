<?php
$id=$_GET['id']
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employeeDB";
$conn = new mysqli($servername, $username, $password, $dbname);
if(isset($_GET['delete_id']))
{
     $sql_query="UPDATE employees WHERE id=".$_GET['delete_id'];
     mysql_query($sql_query);
     header("Location: index.php");
}

$conn->close();