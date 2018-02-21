function getEmployee(){
    if(localStorage.getItem("employee") !== null){
        var employee =JSON.parse(localStorage.getItem('employee'));
        var obj = employee!== null ? employee[0]: '';
        if(obj !== ''){
            document.getElementById('fname').textContent = obj['firstname'];
            document.getElementById('lname').textContent= obj['lastname'];
            document.getElementById('email').textContent = obj['email'];
            document.getElementById('mob').textContent = obj['mobno'];
            document.getElementById('doj').textContent = obj['doj'];
            document.getElementById('dept').textContent = obj['department'];
            document.getElementById('mname').textContent=obj['middlename'];
            document.getElementById('gender').textContent = obj['gender'];
            document.getElementById('altemail').textContent = obj['alternateEmail'];
            document.getElementById('job').textContent = obj['job'];
            localStorage.setItem("employee",null)
        }
    }
}