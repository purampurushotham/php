<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employeeDB";
$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}if(isset($_GET['delete_id']))
{
     $sql_query="SELECT * from employees WHERE id=".$_GET['delete_id'];
     $result = $conn->query($sql_query);
    $outp = array();
$outp = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($outp);
}

$conn->close();
?>