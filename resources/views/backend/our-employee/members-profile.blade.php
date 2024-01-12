@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
  


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--Rating Style -->
<style>
    /* Your existing styles */
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
    }

    .rating>input {
        display: none;
    }

    .rating>label {
        position: relative;
        width: 1.3em;
        font-size: 36px;
        color: #FFD600;
        cursor: pointer;
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0;
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important;
    }

    .rating>input:checked~label:before {
        opacity: 1;
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.4;
    }

    h1,
    p {
        text-align: center;
    }

    h1 {
        margin-top: 150px;
    }

    p {
        font-size: 1.2rem;
    }

   

    .card {
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
transition: 0.3s;
display: flex;
 /* Adjust the width percentage as needed */
}

.card:hover {
box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}

    .container {
        padding: 2px 16px;
    }

    .card img {
        border-radius: 100px;
        height: 100px;
        width: 100px;
    }

    .container {
        font-size: 16px;
    }

    .container h6 {
        background-color: #f0e5ff;
        padding: 5px 10px;
        width: max-content;
        border-radius: 5px;
    }

    .container p {
        font-size: 14px;
        text-align: left;
        background-color: #feffff;
        height: 40px;
    }

    .btn {
        margin-right: auto;

    }

    .button {
        background-color: #4c4e7c;
        color: antiquewhite;
        border-radius: 3px;
    }

    .count-list {
        font-size: 12px;
        text-align: center;
    }

    #preview {
        max-width: 100%;
        display: none;
    }
    #viewProfileModal {
    font-family: 'Arial', sans-serif;
}

#viewProfileModal .modal-content {
    background-color: #f8f9fa; /* Light gray background color */
    border-radius: 10px;
}

#viewProfileModal .modal-header {
    background-color: #343a40; /* Dark background color for the header */
    color: #ffffff; /* White text color for the header */
    border-bottom: 2px solid #343a40; /* Green border */
}

#viewProfileModal .modal-title {
    font-size: 1.8rem;
    font-weight: bold;
}

#viewProfileModal .modal-body {
    padding: 20px;
}

#viewProfileModal img {
    max-width: 100%;
    height: auto;
    max-height: 200px; /* Set the maximum height as needed */
    border-radius: 10px;
    margin-bottom: 20px;
}
#addEmployeeModal,
#listemp {
    display: none;
}

#viewProfileModal h5,
#viewProfileModal h6 {
    color: #343a40; /* Dark text color for headings */
    margin-bottom: 10px;
}

#viewProfileModal p {
    font-size: 16px;
    margin-bottom: 10px;
    border: 1px solid black;
    padding: 10px;
    color: white;
    background-color: rgb(24, 24, 133);
}

#viewProfileModal .btn-secondary {
    background-color: #6c757d; /* Gray background color for the Close button */
    color: #ffffff; /* White text color for the Close button */
    border-radius: 5px;
}

#viewProfileModal .btn-secondary:hover {
    background-color: #495057; /* Darker gray background color on hover */
}
/* Existing styles */

<style>
    /* Your existing styles */
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
    }

    .rating>input {
        display: none;
    }

    .rating>label {
        position: relative;
        width: 1.3em;
        font-size: 36px;
        color: #FFD600;
        cursor: pointer;
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0;
    }
    #employeeListContainer{
width: 400px;
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important;
    }

    .rating>input:checked~label:before {
        opacity: 1;
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.4;
    }

    h1,
    p {
        text-align: center;
    }

    h1 {
        margin-top: 150px;
    }

    p {
        font-size: 1.2rem;
    }

   .my-custom-class{
    width: 800px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    
   }

    .card {
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
transition: 0.3s;

 /* Adjust the width percentage as needed */
}

.card:hover {
box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}

    .container {
        padding: 2px 16px;
    }

    .card img {
        border-radius: 100px;
        height: 100px;
        width: 100px;
    }

    .container {
        font-size: 16px;
       
    }

    .container h6 {
        background-color: #f0e5ff;
        padding: 5px 10px;
        width: max-content;
        border-radius: 5px;
    }

    .container p {
        font-size: 14px;
        text-align: left;
        background-color: #feffff;
        height: 40px;
    }

    .btn {
        margin-right: auto;

    }

    .button {
        background-color: #4c4e7c;
        color: antiquewhite;
        border-radius: 3px;
    }

    .count-list {
        font-size: 12px;
        text-align: center;
    }

    #preview {
        max-width: 100%;
        display: none;
    }
    #viewProfileModal {
    font-family: 'Arial', sans-serif;
}

#viewProfileModal .modal-content {
    background-color: #f8f9fa; /* Light gray background color */
    border-radius: 10px;
}

#viewProfileModal .modal-header {
    background-color: #343a40; /* Dark background color for the header */
    color: #ffffff; /* White text color for the header */
    border-bottom: 2px solid #343a40; /* Green border */
}

#viewProfileModal .modal-title {
    font-size: 1.8rem;
    font-weight: bold;
}

#viewProfileModal .modal-body {
    padding: 20px;
}

#viewProfileModal img {
    max-width: 100%;
    height: auto;
    max-height: 200px; /* Set the maximum height as needed */
    border-radius: 10px;
    margin-bottom: 20px;
}
#addEmployeeModal,
#listemp {
    display: none;
}

#viewProfileModal h5,
#viewProfileModal h6 {
    color: #343a40; /* Dark text color for headings */
    margin-bottom: 10px;
}

#viewProfileModal p {
    font-size: 16px;
    margin-bottom: 10px;
    border: 1px solid black;
    padding: 10px;
    color: white;
    background-color: rgb(24, 24, 133);
}

#viewProfileModal .btn-secondary {
    background-color: #6c757d; /* Gray background color for the Close button */
    color: #ffffff; /* White text color for the Close button */
    border-radius: 5px;
}

#viewProfileModal .btn-secondary:hover {
    background-color: #495057; /* Darker gray background color on hover */
}
/* Existing styles */

@media only screen and (max-width: 600px) {
    h1 {
        font-size: 14px;
        margin-top: 50px;
    }

    p {
        font-size: 12px;
    }

    .card {
        width: 100%; /* Full width for each card in mobile view */
        margin-bottom: 10px; /* Adjust the margin between cards for smaller screens */
        box-sizing: border-box; /* Include padding and border in the total width */
        padding: 10px; 
      
    }

    .card img {
        height: 80px;
        width: 80px;
        border-radius: 50%; /* Make the image circular */
    }

    .container {
        font-size: 14px;
        padding: 5px;
    }

    .count-list {
        font-size: 10px;
    }

    #listemp .card {
        margin-bottom: 10px;
    }

    /* Add more styles as needed for mobile view */
}
/* Your existing styles */

/* Add the following media query for mobile view */
@media only screen and (max-width: 600px) {
    .card {
        width: 100%; /* Set the width to 100% for mobile screens */
        margin-bottom: 20px; /* Add some bottom margin for better spacing */
    }

    .modal-body form .inputField {
        flex-basis: 100%; /* Adjusted the flex-basis property for small screens */
        border-left: none; /* Remove left border for better mobile appearance */
        padding-left: 0; /* Remove left padding */
    }

    form .inputField > div {
        width: 100%; /* Adjusted width for better mobile appearance */
        flex-direction: column; /* Change flex-direction to column for better stacking */
    }

    form .inputField > div input {
        width: 100%; /* Set input width to 100% */
    }

    .modal-footer .submit {
        width: 100%; /* Adjusted the width for small screens */
    }

    .imgholder {
        margin-bottom: 20px; /* Add bottom margin for better spacing */
    }

    .modal-body form .imgholder {
        width: 100%; /* Set image holder width to 100% */
    }

    .modal-body form .imgholder .upload {
        width: 100%; /* Set upload width to 100% */
        left: 0; /* Adjust left position */
    }
}
#loginSection{
    background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            max-width: 300px;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 100px;
}
#loginSection{
    background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            max-width: 300px;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 100px;
}
#filby{
    left: 0;
}
#filhead{
    font-size: 20px;
    font-weight: bold;
}

</style>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<!-- Button trigger modal -->
<section class="full">
    <!-- Login Section -->
<div id="loginSection" class="w-75 mx-auto mt-3">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" required>
    </div>
    <button class="btn btn-primary" onclick="login()">Login</button>
</div>

<div id="addEmployeeModal1" style="display: none;">
<div class="w-75 mx-auto mt-5 px-3">
    <div class="ml-auto" style="width: max-content;">
        <button class="button" data-toggle="modal" data-target="#addEmployeeModal"><i
                class="fa fa-plus-circle mr-1"></i>Add employee</button>
    </div>
</div>
<div class=" justify-content-start" id="filby" style="width: max-content;">
    <label for="empIdFilter" id="filhead">Filter by :</label><br>
    <input type="text" id="empIdFilter" placeholder="Filter by Emp ID">
</div>
<div id="listemp" class="row w-75 mx-auto mt-3"></div>

<!-- Modal Popup-->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog"
    aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="employeeForm">
                    <div class="container">
                        <div class="row">
                           <div class="col-sm">

                                <div class="form-group">
                                    <label for="empname">Employee Name:</label>
                                    <input type="text" class="form-control" id="empname" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address:</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="empid">Employee id:</label>
                                    <input type="text" class="form-control" id="empid" required>
                                </div>
                                <div class="form-group">
                                    <label for="cmpname">Company Name:</label>
                                    <input type="text" class="form-control" id="cmpname" required>
                                </div>
                                <div class="form-group">
                                    <label for="joindt">Star Rating:</label>

                                    <div class="rating">

                                        <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                                        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                    </div>
                                </div>
                            </div>
                           <div class="col-sm">
                                <div class="form-group">
                                    <label for="designtion">Designation:</label>
                                    <input type="text" class="form-control" id="designtion" required>
                                </div>
                                <div class="form-group">
                                    <label for="addprofile">Add profile:</label>
                                    <input type="file" class="form-control" id="addprofile"
                                        onchange="changeFile(event)">
                                    <img id="preview" src="" alt="Profile Image">
                                </div>
                                <div class="form-group">
                                    <label for="phnum">Mobile number:</label>
                                    <input type="tel" class="form-control" id="phnum" required>
                                </div>
                                <div class="form-group">
                                    <label for="joindt">Joining date:</label>
                                    <input type="date" class="form-control" id="joindt" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">location:</label>
                                    <textarea class="form-control" id="description" required></textarea>
                                </div>

                            </div>
                        </div></div>
                     
                    <h3>Personal info</h3>
                    <div class="form-group">
                        <label for="bloodGroup">Blood Group:</label>
                        <input type="text" class="form-control" id="bloodGroup" required>
                    </div>
                    <div class="form-group">
                        <label for="nationality">Nationality:</label>
                        <input type="text" class="form-control" id="nationality" required>
                    </div>
                    <div class="form-group">
                        <label for="religion">Religion:</label>
                        <input type="text" class="form-control" id="religion" required>
                    </div>
                    <div class="form-group">
                        <label for="maritalStatus">Marital Status:</label>
                        <input type="text" class="form-control" id="maritalStatus" required>
                    </div>
                    <div class="form-group">
                        <label for="passportNumber">Passport Number:</label>
                        <input type="text" class="form-control" id="passportNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="emergencyContact">Emergency Contact:</label>
                        <input type="text" class="form-control" id="emergencyContact" required>
                    </div>
                    <h3>Bank Info</h3>
                    <!-- Bank Details -->
                    <div class="form-group">
                        <label for="bankName">Bank Name:</label>
                        <input type="text" class="form-control" id="bankName" required>
                    </div>
                    <div class="form-group">
                        <label for="branch">Branch:</label>
                        <input type="text" class="form-control" id="branch" required>
                    </div>
                    <div class="form-group">
                        <label for="accountNumber">Account Number:</label>
                        <input type="text" class="form-control" id="accountNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="ifscCode">IFSC Code:</label>
                        <input type="text" class="form-control" id="ifscCode" required>
                    </div>
                    <div class="form-group">
                        <label for="panNumber">PAN Number:</label>
                        <input type="text" class="form-control" id="panNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="upiId">UPI ID:</label>
                        <input type="text" class="form-control" id="upiId" required>
                    </div>

                  
<!-- Add this input in the Personal Info section -->
<div class="form-group">
    <label for="documents">Documents (Upload multiple):</label>
    <input type="file" class="form-control" id="documents" multiple>
</div>

<!-- Add a textarea for document report description -->
<div class="form-group">
    <label for="documentReportDescription">Document Report Description:</label>
    <textarea class="form-control" id="documentReportDescription" rows="4" placeholder="Enter document report description"></textarea>
</div>


                        <div class="checkbox">
                            <label><input type="checkbox"> Remember me</label>
                        </div>

                        <div class="modal-footer px-0">
                            <div class="ml-auto" style="width: max-content;">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
    

    <script>



function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Check if the username and password are correct (you can set your own values)
    if (username ==="employee777" && password === "psv777") {
        // Show the elements related to employee management
        document.getElementById("addEmployeeModal1").style.display = "block";
        document.getElementById("listemp").style.display = "block";
        document.getElementById("loginSection").style.display = "none";
    } else {
        alert("Invalid credentials. Please try again.");
    }
}

 // Add a variable to store document files
// Add a variable to store document files
var documents = [];

// Add an event listener to handle document file change
document.getElementById("documents").addEventListener("change", function (e) {
    // Reset the documents array on each change
    documents = [];

    // Loop through the selected files and add them to the documents array
    for (let i = 0; i < e.target.files.length; i++) {
        documents.push({
            url: URL.createObjectURL(e.target.files[i]),
            name: e.target.files[i].name
        });
    }
});


        var empList = JSON.parse(localStorage.getItem('empList')) || [];

getEmployeeList(empList);

function getEmployeeList(list) {
    let listhtml = '';

    list.forEach((item, i) => {
        listhtml += `
        <div class="col-12 my-custom-class">
            <div class="card p-3">
                <div class="d-flex align-items-center">
                    <div>
                        <img src="${item.profilepic}" alt="Avatar">
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <div class="">
                                <i class="fa fa-calendar" aria-hidden="true" style="color: #c7a6af;"></i>
                                <div class="count-list">24</div>
                            </div>
                            <div class="mx-2">
                                <i class="fa fa-star  ml-2 " style="color:#fec309;"></i>
                                <div class="count-list ml-1">${item.rating}</div>
                            </div>
                            <div>
                                <i class="fa fa-user ml-2" style="color:#fda693;"></i>
                                <div class="count-list ml-1">24</div>
                            </div>
                        </div>
                    </div>
                    <div class="container ml-3">
                        <h5><b>${item.empname}</b></h5>
                        <h6>${item.designtion}</h6>
                        <p>${item.email}</p>
                        <p>Emp id: ${item.empid}</p>
                 
                        <button class="btn btn-danger" onclick="deleteEmployee(${i})">Delete</button>
                        <button class="btn btn-info" onclick="editEmployee(${i})" data-toggle="modal" data-target="#editEmployeeModal">Edit Profile</button>
                        <button class="btn btn-primary" onclick="viewProfile(${i})">View Profile</button>
                    </div>
                </div>
            </div>
        </div>`;
    });

    // Assuming you have a container with the id "employeeListContainer"


    let empelement = document.getElementById("listemp");
    empelement.innerHTML = listhtml;
}

let employeeForm = document.getElementById("employeeForm");

var profileimg = '';

function changeFile(e) {
    var input = document.getElementById("addprofile");

    profileimg = URL.createObjectURL(input.files[0]);
    document.getElementById("preview").src = profileimg;
    document.getElementById("preview").style.display = "block";

    var fReader = new FileReader();
    fReader.readAsDataURL(input.files[0]);
    fReader.onloadend = function (event) {
        profileimg = event.target.result;
    }
}

employeeForm.addEventListener("submit", (e) => {
        e.preventDefault();
        let empname = document.getElementById("empname");
        let email = document.getElementById("email");
        let empid = document.getElementById("empid");
        let cmpname = document.getElementById("cmpname");
        let rating = document.querySelector('input[name="rating"]:checked');
        let designtion = document.getElementById("designtion");
        let phnum = document.getElementById("phnum");
        let joindt = document.getElementById("joindt");
        let description = document.getElementById("description");
        let bloodGroup = document.getElementById("bloodGroup").value;
        let nationality = document.getElementById("nationality").value;
        let religion = document.getElementById("religion").value;
        let maritalStatus = document.getElementById("maritalStatus").value;
        let passportNumber = document.getElementById("passportNumber").value;
        let emergencyContact = document.getElementById("emergencyContact").value;

        let bankName = document.getElementById("bankName").value;
        let branch = document.getElementById("branch").value;
        let accountNumber = document.getElementById("accountNumber").value;
        let ifscCode = document.getElementById("ifscCode").value;
        let panNumber = document.getElementById("panNumber").value;
        let upiId = document.getElementById("upiId").value;

        let addemployee = {
    empname: empname.value,
    email: email.value,
    empid: empid.value,
    cmpname: cmpname.value,
    rating: rating.value,
    designtion: designtion.value,
    profilepic: profileimg,
    phnum: phnum.value,
    description: description.value,
    bloodGroup: bloodGroup,
    nationality: nationality,
    religion: religion,
    maritalStatus: maritalStatus,
    passportNumber: passportNumber,
    emergencyContact: emergencyContact,
    documents: documents,
    documentReportDescription: document.getElementById("documentReportDescription").value, // Include document report description
    bankDetails: {
        bankName: bankName,
        branch: branch,
        accountNumber: accountNumber,
        ifscCode: ifscCode,
        panNumber: panNumber,
        upiId: upiId
    }
};


    if (employeeForm.dataset.mode === "edit") {
        // Editing existing employee
        let editIndex = employeeForm.dataset.editIndex;
        empList[editIndex] = addemployee;
    } else {
        // Adding new employee
        empList.push(addemployee);
    }

    localStorage.setItem('empList', JSON.stringify(empList));
    getEmployeeList([...empList]);

    $('#addEmployeeModal').modal('hide');
    employeeForm.dataset.mode = ""; // Reset mode after save
    employeeForm.dataset.editIndex = ""; // Reset edit index after save
    employeeForm.reset(); // Reset form fields
});

function editEmployee(index) {
    // Set form fields with existing data for editing
    let employee = empList[index];
    document.getElementById("empname").value = employee.empname;
    document.getElementById("email").value = employee.email;
    document.getElementById("empid").value = employee.empid;
    document.getElementById("cmpname").value = employee.cmpname;
    document.querySelector(`input[name="rating"][value="${employee.rating}"]`).checked = true;
    document.getElementById("designtion").value = employee.designtion;
    document.getElementById("phnum").value = employee.phnum;
    document.getElementById("joindt").value = employee.joindt;
    document.getElementById("description").value = employee.description;
    document.getElementById("preview").src = employee.profilepic;
    document.getElementById("preview").style.display = "block";
    document.getElementById("bloodGroup").value = employee.bloodGroup;
    document.getElementById("nationality").value = employee.nationality;
    document.getElementById("religion").value = employee.religion;
    document.getElementById("maritalStatus").value = employee.maritalStatus;
    document.getElementById("passportNumber").value = employee.passportNumber;
    document.getElementById("emergencyContact").value = employee.emergencyContact;
    document.getElementById("bankName").value = employee.bankName;
    document.getElementById("branch").value = employee.branch;
    document.getElementById("accountNumber").value = employee.accountNumber;
    document.getElementById("ifscCode").value = employee.ifscCode;
    document.getElementById("panNumber").value = employee.panNumber;
    document.getElementById("upiId").value = employee.upiId;
    // Set the form mode to edit and save the index for later use
    employeeForm.dataset.mode = "edit";
    employeeForm.dataset.editIndex = index;
    $('#addEmployeeModal').modal('show');
}

function deleteEmployee(index) {
    // Implement the logic to delete an employee
    empList.splice(index, 1);
    localStorage.setItem('empList', JSON.stringify(empList));
    getEmployeeList([...empList]);
}

        function viewProfile(index) {
            // Get the employee details using the index
            let employee = empList[index];

            // Create HTML content for the detailed view
            let detailedView = `
                <div class="modal fade" id="viewProfileModal" tabindex="-1" role="dialog" aria-labelledby="viewProfileModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewProfileModalLabel">Employee Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <img src="${employee.profilepic}" alt="Profile">
                                            <!-- Add rating display based on employee.rating -->
                                            <div class="col-sm">
                                    <h6>Documents:</h6>
                                    <ul>
                                        ${employee.documents.map((doc, docIndex) => `
                                            <li>
                                                <span>${doc.name}</span>
                                                <a href="${doc.url}" download="${doc.name}">Download</a>
                                            </li>`).join('')}
                                    </ul>
                                </div>  
                                            <!-- Include document report description box -->
                                    <h6>Document Report Description:</h6>
                                    <textarea class="form-control" rows="4" readonly>${employee.documentReportDescription}</textarea></div>
                                        <div class="col-sm">
                                            <h5><b>${employee.empname}</b></h5>
                                            <h6>${employee.designtion}</h6>
                                            <p>Emp id:${employee.empid}</p>
                                            <p>Email:${employee.email}</p>
                                            <p>Company Name:${employee.cmpname}</p>
                                            <p>Phone Number:${employee.phnum}</p>
                                            <p>JoiningDate:${employee.joindt}</p>
                                            <p>Location:${employee.description}</p>
                                            <!-- Display new properties -->
                                            <h6>Personal Information:</h6>
                                            <p>Blood Group: ${employee.bloodGroup}</p>
                                            <p>Nationality: ${employee.nationality}</p>
                                            <p>Religion: ${employee.religion}</p>
                                            <p>Marital Status: ${employee.maritalStatus}</p>
                                            <p>Passport Number: ${employee.passportNumber}</p>
                                            <p>Emergency Contact: ${employee.emergencyContact}</p>

                                            <!-- Display bank details -->
                                            <h6>Bank Details:</h6>
                                            <p>Bank Name: ${employee.bankDetails.bankName}</p>
                                            <p>Branch: ${employee.bankDetails.branch}</p>
                                            <p>Account Number: ${employee.bankDetails.accountNumber}</p>
                                            <p>IFSC Code: ${employee.bankDetails.ifscCode}</p>
                                            <p>PAN Number: ${employee.bankDetails.panNumber}</p>
                                            <p>UPI ID: ${employee.bankDetails.upiId}</p>

                                          
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Remove any existing modal with the same ID
            $('#viewProfileModal').remove();

            // Append the detailed view to the body
            document.body.insertAdjacentHTML('beforeend', detailedView);

            // Show the modal
            $('#viewProfileModal').modal('show');
        }

        // Your existing JavaScript code
        document.getElementById("empIdFilter").addEventListener("input", function () {
        filterEmployees(this.value);
    });

    function filterEmployees(empId) {
        // Filter the employee list based on the entered empId
        let filteredList = empList.filter(employee => employee.empid.includes(empId));
        getEmployeeList(filteredList);
    }
    </script>
</body>

</html>
@endsection
