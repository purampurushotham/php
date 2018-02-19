

	<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='add_employee.css' type='text/css' />
</head>
<body>
<div class="rightButton">
    <a href="registration.html" class="button -fill -blue">Add Employee</a>
</div>
<div class="employeeRecords">
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
if(isset($_GET['delete_id']))
{
 $sql_query="DELETE FROM employees WHERE id=".$_GET['delete_id'];
 $conn->query($sql_query);
 header("Location: getEmployees.php");
}
echo "<table>
<tr>
<th>ID</th>
<th>First Name</th>
<th>Middle Name</th>
<th>Lastname</th>
<th>Email</th>
<th>Mobile no</th>
<th>alternateEmail</th>
<th>Department</th>
<th>Gender</th>
<th>Job</th>
<th>Date of journey</th>
<th>Actions</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['firstname'] . "</td>";
    echo "<td>" . $row['middlename'] . "</td>";
    echo "<td>" . $row['lastname'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['mobno'] . "</td>";
    echo "<td>" . $row['alternateEmail'] . "</td>";
    echo "<td>" . $row['department'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";
    echo "<td>" . $row['job'] . "</td>";
    echo "<td>" . $row['doj'] . "</td>";
    echo '<td><div class="wrapper"><span onclick="edit(' . $row['id'] .')"><i class="fa fa-edit test" style="font-size:24px">
    </i></span><span onclick="deleteRow(' . $row['id'] .')"><i class="fa fa-trash test" style="font-size:24px"></i></span></div></td>';
    echo "</tr>";
}
echo "</table>";
$conn->close();($conn);
?>
</div> 
<script>
function deleteRow($row){
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='getEmployees.php?delete_id='+$row;
     }
    }
    function edit($row){
        /*window.location.href='editEmployee.php?row.id='+$row;*/
    }
</script> 
</body>
</html>