

	<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
<th><span><input id='selectAll' type='checkbox' /></span></th>
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
    echo "<tr id='" .$row['id']. "'>";					/*value= each employee id */
	echo '<td><input type="checkbox" name="selectedemp[]" value='. $row['id'] .'></input></td>';	/*name="selectedemp[]" selectedemp[] array ivvali enduku ante nuvvu loop lo checkboxes istunav kabati, idi manaki jquery lo use avudi*/
    echo '<td onclick="view(' . $row['id'] .')">'. $row['id'] .' </td>';
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
<button class="btn blue" name="btn-delete" id="btn-delete">Delete Selected</button>
</div>
<script>
$(document).ready(function(){ /* jquery lo edi rayalana we will write in this ready function */
/*function when we click on each checkbox*/
	$("input[name='selectedemp[]']").click(function(){ /* we declare selectedemp in 'name' attribute at top rigtht we are using this. .click function is called when we click on check boxes */
		  $.each($("input[name='selectedemp[]']"),function(index,eachObj){ /* just like for loop we are using ,here first param should be index,and second is that input element */
			  if(eachObj.checked){					/* we have checked atteibute for input type checkbox */
			 if(index === $("input[name='selectedemp[]']").length-1){    /* logic for selectAll check boxes  when ever length matchers we are setting it true or false*/
			$('#selectAll')[0].checked = true; /*$('#selectAll') is id at top level checkbox. $('#selectAll') is inside th , span so it will return in array. Thats why we refer it by $('#selectAll')[0] */
			 }
		}
		else{
			$('#selectAll')[0].checked = false;
		}
		 })
	})
	/*function when we click on top level checkbox*/
	$('#selectAll').click(function(){
		 var id = [];
        $.each($("input[name='selectedemp[]']"), function(index,eachObj) {
			if(	$('#selectAll')[0].checked){		/* iteration to each checkbox and making true or false based on top level checkbox */
			eachObj.checked = true}
			else{
				eachObj.checked = false;
			}
        })
	});
	/*function when we click on delete button */
$('#btn-delete').click(function(){
  if(confirm('Sure To Remove Records ?'))
     {
        var id = []; // array for storing all selected empids
        $(':checkbox:checked').each(function(i){ // iterationg through only checked checkboxes
        id[i] = $(this).val();			/* $(this).val() will gives each empid. need to send this array for delete operation */
        })
        if(id.length === 0){
        alert('please select atleast one record');
        }
     else{
      $.ajax({
                    type:'POST',
                     url: "bulkDelete.php",
                     data: {id:id},
                     success: function(response){
						 /* after deleting successfully. instead of reloading the table. we are hiding the deleted rows */
                     for(var i = 0; i<id.length; i++){
                     $('tr#'+id[i]+'').css('background-color', '#ccc')
                     $('tr#'+id[i]+'').fadeOut('slow');
                     }
                     }
                 });
     }
	 }
})
})
function deleteRow($row){
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='getEmployees.php?delete_id='+$row;
     }
    }
    function edit($row){
         $.ajax({
                type: "GET",
                url: "deleteEmployee.php",
                data: {"delete_id":$row},
                success: function(response){
                    window.localStorage.setItem('employee',response) 
                    alert(window.localStorage.getItem('employee'))
                    window.location = "registration.html"

                }
            });
   
    }
    function view($row){
                      $.ajax({
                             type: "GET",
                             url: "deleteEmployee.php",
                             data: {"delete_id":$row},
                             success: function(response){
                                 window.localStorage.setItem('employee',response)
                                 alert(window.localStorage.getItem('employee'))
                                 window.location = "viewEmployee.html"

                             }
                         });
}
</script> 
</body>
</html>