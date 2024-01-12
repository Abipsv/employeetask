@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Rating Style -->
    <style>
        /* Your existing styles */
        .custom-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: start;
        }

        .custom-rating>input {
            display: none;
        }

        .custom-rating>label {
            position: relative;
            width: 1.3em;
            font-size: 36px;
            color: #FFD600;
            cursor: pointer;
        }

        .custom-rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0;
        }

        .custom-rating>label:hover:before,
        .custom-rating>label:hover~label:before {
            opacity: 1 !important;
        }

        .custom-rating>input:checked~label:before {
            opacity: 1;
        }

        .custom-rating:hover>input:checked~label:before {
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

        @media only screen and (max-width: 600px) {
            h1 {
                font-size: 14px;
            }

            p {
                font-size: 12px;
            }
        }

        .custom-card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 30%; /* Adjust the width percentage as needed */
        }

        .custom-card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .custom-container {
            padding: 2px 16px;
        }

        .custom-card img {
            border-radius: 100px;
            height: 100px;
            width: 100px;
        }

        .custom-container {
            font-size: 16px;
        }

        .custom-container h6 {
            background-color: #f0e5ff;
            padding: 5px 10px;
            width: max-content;
            border-radius: 5px;
        }

        .custom-container p {
            font-size: 14px;
            text-align: left;
            background-color: #feffff;
            height: 40px;
        }

        .custom-btn {
            margin-right: auto;
        }

        .custom-button {
            background-color: #4c4e7c;
            color: antiquewhite;
            border-radius: 3px;
        }

        .custom-count-list {
            font-size: 12px;
            text-align: center;
        }

       
            #custom-preview {
    max-width: 100%;
    max-height: 150px; /* Set the maximum height as needed */
    display: none;
    border-radius: 5px; /* Optional: Add border-radius for a rounded appearance */

        }
        #main-container {
            display: none; /* Initially hide the container */
        }

        /* Add styles for the login form if needed */
        #login-form {
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
        #filterById{
            width: 40%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #fil{
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
    <div id="login-form" class="text-center">
        <h2>Login</h2>
        <form id="loginForm">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="login()">Login</button>
        </form>
    </div>
    <div id="main-container">
    <div class="w-75 mx-auto mt-5 px-3">
        <label for="empIdFilter" id="fil">Filter by :</label>
        <input type="text" id="filterById" class="form-control" placeholder="Filter by ID" oninput="filterEmployeesById()">
    </div>
    <div class="w-75 mx-auto mt-5 px-3">
        <div class="ml-auto" style="width: max-content;">
            <button class="custom-button" data-toggle="modal" data-target="#addEmployeeModal"><i
                    class="fa fa-plus-circle mr-1"></i>Add employee</button>
        </div>
    </div>
    <div id="employeeList2" class="row w-75 mx-auto mt-3"></div>

    <!-- Modal Popup-->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="customEmployeeForm">
                        <div class="custom-container">
                            <div class="row">
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="customEmpName">Employee Name:</label>
                                        <input type="text" class="form-control" id="customEmpName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="customEmail">Email address:</label>
                                        <input type="email" class="form-control" id="customEmail" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="customEmpId">Employee id:</label>
                                        <input type="text" class="form-control" id="customEmpId" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="customCmpName">Company Name:</label>
                                        <input type="text" class="form-control" id="customCmpName" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="customRating">Star Rating:</label>
                                        <div class="custom-rating">
                                            <input type="radio" name="customRating" value="5" id="custom5"><label
                                                for="custom5">☆</label>
                                            <input type="radio" name="customRating" value="4" id="custom4"><label
                                                for="custom4">☆</label>
                                            <input type="radio" name="customRating" value="3" id="custom3"><label
                                                for="custom3">☆</label>
                                            <input type="radio" name="customRating" value="2" id="custom2"><label
                                                for="custom2">☆</label>
                                            <input type="radio" name="customRating" value="1" id="custom1"><label
                                                for="custom1">☆</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="customDesignation">Designation:</label>
                                        <input type="text" class="form-control" id="customDesignation" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="customAddProfile">Add profile:</label>
                                        <input type="file" class="form-control" id="customAddProfile"
                                            onchange="changeCustomFile(event)">
                                        <img id="customPreview" src="" alt="Profile Image">
                                    </div>
                                    <div class="form-group">
                                        <label for="customPhNum">Mobile number:</label>
                                        <input type="tel" class="form-control" id="customPhNum" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="customJoinDt">Joining date:</label>
                                        <input type="date" class="form-control" id="customJoinDt" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="customDescription">description:</label>
                                        <textarea class="form-control" id="customDescription" required></textarea>
                                    </div>
                                </div>
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

    <script>
         function login() {
            // For simplicity, let's consider a basic username and password check
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            // Check username and password (You might want to use a more secure authentication method in a real application)
            if (username === "employee777" && password === "psv@777") {
                // Show the main content container and hide the login form
                document.getElementById("main-container").style.display = "block";
                document.getElementById("login-form").style.display = "none";
            } else {
                alert("Invalid credentials. Please try again.");
            }
        }
        var empList2 = JSON.parse(localStorage.getItem('empList2')) || [];

        getEmployeeList2(empList2);

        function getEmployeeList2(list) {
            let listhtml = '';
            list.forEach((item, i) => {
                listhtml = listhtml + `<div class="col-12 col-md-6 mb-4">
                    <div class="custom-card p-3 w-100">
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="${item.profilepic}" alt="Avatar">
                                <div class="d-flex justify-content-center align-items-center mt-3">
                                    <div class="">
                                        <i class="fa fa-calendar" aria-hidden="true" style="color: #c7a6af;"></i>
                                        <div class="custom-count-list">24</div>
                                    </div>
                                    <div class="mx-2">
                                        <i class="fa fa-star  ml-2 " style="color:#fec309;"></i>
                                        <div class="custom-count-list ml-1">${item.rating}</div>
                                    </div>
                                    <div>
                                        <i class="fa fa-user ml-2" style="color:#fda693;"></i>
                                        <div class="custom-count-list ml-1">24</div>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-container">
                                <h5><b>${item.empname}</b></h5>
                                <h6>${item.designtion}</h6>
                                <p>${item.email}</p>
                                <p>Emp id:${item.empid}</p>
                                <div class="">
                                    <button class="btn btn-info" onclick="editEmployee2(${i})"
                                        data-toggle="modal" data-target="#editEmployeeModal">Edit</button>
                                    <button class="btn btn-danger" onclick="deleteEmployee2(${i})">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            });

            let empelement = document.getElementById("employeeList2");
            empelement.innerHTML = listhtml;
        }

        let customEmployeeForm = document.getElementById("customEmployeeForm");

        var customProfileImg = '';

        function changeCustomFile(e) {
            var input = document.getElementById("customAddProfile");

            customProfileImg = URL.createObjectURL(input.files[0]);
            document.getElementById("customPreview").src = customProfileImg;
            document.getElementById("customPreview").style.display = "block";

            var fReader = new FileReader();
            fReader.readAsDataURL(input.files[0]);
            fReader.onloadend = function (event) {
                customProfileImg = event.target.result;
            }
        }

        customEmployeeForm.addEventListener("submit", (e) => {
            e.preventDefault();
            let customEmpName = document.getElementById("customEmpName");
            let customEmail = document.getElementById("customEmail");
            let customEmpId = document.getElementById("customEmpId");
            let customCmpName = document.getElementById("customCmpName");
            let customRating = document.querySelector('input[name="customRating"]:checked');
            let customDesignation = document.getElementById("customDesignation");
            let customPhNum = document.getElementById("customPhNum");
            let customJoinDt = document.getElementById("customJoinDt");
            let customDescription = document.getElementById("customDescription");

            let addemployee2 = {
                empname: customEmpName.value,
                email: customEmail.value,
                empid: customEmpId.value,
                cmpname: customCmpName.value,
                rating: customRating.value,
                designtion: customDesignation.value,
                profilepic: customProfileImg,
                phnum: customPhNum.value,
                description: customDescription.value
            };

            if (customEmployeeForm.dataset.mode === "edit") {
                // Editing existing employee
                let editIndex = customEmployeeForm.dataset.editIndex;
                empList2[editIndex] = addemployee2;
            } else {
                // Adding new employee
                empList2.push(addemployee2);
            }

            localStorage.setItem('empList2', JSON.stringify(empList2));
            getEmployeeList2([...empList2]);

            $('#addEmployeeModal').modal('hide');
            customEmployeeForm.dataset.mode = ""; // Reset mode after save
            customEmployeeForm.dataset.editIndex = ""; // Reset edit index after save
            customEmployeeForm.reset(); // Reset form fields
        });

        function editEmployee2(index) {
            // Set form fields with existing data for editing
            let employee = empList2[index];
            document.getElementById("customEmpName").value = employee.empname;
            document.getElementById("customEmail").value = employee.email;
            document.getElementById("customEmpId").value = employee.empid;
            document.getElementById("customCmpName").value = employee.cmpname;
            document.querySelector(`input[name="customRating"][value="${employee.rating}"]`).checked = true;
            document.getElementById("customDesignation").value = employee.designtion;
            document.getElementById("customPhNum").value = employee.phnum;
            document.getElementById("customJoinDt").value = employee.joindt;
            document.getElementById("customDescription").value = employee.description;
            document.getElementById("customPreview").src = employee.profilepic;
            document.getElementById("customPreview").style.display = "block";

            // Set the form mode to edit and save the index for later use
            customEmployeeForm.dataset.mode = "edit";
            customEmployeeForm.dataset.editIndex = index;
            $('#addEmployeeModal').modal('show');
        }

        function deleteEmployee2(index) {
            // Implement the logic to delete an employee
            empList2.splice(index, 1);
            localStorage.setItem('empList2', JSON.stringify(empList2));
            getEmployeeList2([...empList2]);
        }
        function filterEmployeesById() {
            let filterId = document.getElementById("filterById").value;
            if (filterId) {
                let filteredList = empList2.filter(item => item.empid.includes(filterId));
                getEmployeeList2(filteredList);
            } else {
                getEmployeeList2(empList2);
            }
        }
    </script>
</body>

</html>


@endsection