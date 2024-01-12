@extends('backend.layouts.app')

@section('title', __('User Management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
   
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Add your existing styles here */

        .container {
            margin-top: 50px;
            width: 100%;
        }

        .form-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 3px solid white;
            z-index: 9;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        .form-container {
            max-width: 300px;
            margin: 0 auto;
        }

        .container button {
            background-color: rgb(35, 35, 139);
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .container button:hover {
            opacity: 0.8;
        }

        .form-container label {
            display: block;
            margin-top: 10px;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 3px;
        }

        /* Style for the switch-style checkboxes */
        .form-container input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 40px;
            height: 20px;
            background-color: #ccc;
            border-radius: 10px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container input[type="checkbox"]:checked {
            background-color: rgb(35, 35, 139);
        }

        .form-container input[type="checkbox"]::before {
            content: '';
            width: 18px;
            height: 18px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 2px;
            transition: transform 0.3s;
        }

        .form-container input[type="checkbox"]:checked::before {
            transform: translate(20px, -50%);
        }
        /* End of switch-style checkbox styling */

        .form-container button {
            background-color: rgb(35, 35, 139);
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-container button:hover {
            opacity: 0.8;
        }

        .table-container {
            margin-top: 20px;
            width: 100%;
        }

        #userTable {
            border-collapse: collapse;
          
        }

        #userTable th,
        #userTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #userTable th {
            background-color: rgb(35, 35, 139);
            color: white;
        }

        .usbut {
            background-color: rgb(35, 35, 139);
            color: white;
        }

        .usedit {
            background-color: rgb(35, 35, 139);
            color: white;
        }

        .usedel {
            background-color: rgb(230, 3, 3);
            color: white;
        }
        @media only screen and (max-width: 600px) {
        .form-popup {
            width: 80%;
        }

        .form-container {
            max-width: none;
        }

        .table-container {
            overflow-x: auto; /* Add horizontal scroll for small screens */
        }

        .container button,
        .usedit,
        .usedel {
            width: 100%; /* Make buttons take full width on small screens */
            margin-bottom: 10px; /* Add some spacing between buttons */
        }
    }
    </style>
    <title>User CRUD</title>
</head>

<body>
    <div class="container">
        <button class="usbut" onclick="openForm()">Create User</button>
        <div class="form-popup" id="userForm">
            <form id="createForm" class="form-container">
                <h2>Create User</h2>
                <label for="type">Type:</label>
                <select id="type" name="type">
                    <option value="administrator">Administrator</option>
                    <option value="allUser">All User</option>
                </select>

                <label for="name">Name:</label>
                <input type="text" placeholder="Enter Name" name="name" required>

                <label for="email">Email Address:</label>
                <input type="email" placeholder="Enter Email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label for="confirmPassword">Password Confirmation:</label>
                <input type="password" placeholder="Confirm Password" name="confirmPassword" required>

                <label for="active">Active:</label>
                <input type="checkbox" name="active">

                <label for="verified">Verified:</label>
                <input type="checkbox" name="verified">

                <label for="emailVerified">Email Verified:</label>
                <input type="checkbox" name="emailVerified">

                <label for="sendConfirmationEmail">Send Confirmation Email:</label>
                <input type="checkbox" name="sendConfirmationEmail">

                <button type="button" onclick="createUser()">Create</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>

        <div class="table-container">
            <h2>User Data</h2>
            <table id="userTable">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Password Confirmation</th>
                        <th>Active</th>
                        <th>Verified</th>
                        <th>Email Verified</th>
                        <th>Send Confirmation Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userDataBody"></tbody>
            </table>
        </div>
    </div>

    <script>
        let userData = JSON.parse(localStorage.getItem('userData')) || [];
        let editingIndex = JSON.parse(localStorage.getItem('editingIndex'));

        function openForm() {
            document.getElementById("userForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("userForm").style.display = "none";
            resetForm();
        }

        function resetForm() {
            document.getElementById("createForm").reset();
            editingIndex = null;
            localStorage.removeItem('editingIndex');
        }

        function createUser() {
            const type = document.getElementById("type").value;
            const name = document.getElementsByName("name")[0].value;
            const email = document.getElementsByName("email")[0].value;
            const password = document.getElementsByName("password")[0].value;
            const confirmPassword = document.getElementsByName("confirmPassword")[0].value;
            const active = document.getElementsByName("active")[0].checked;
            const verified = document.getElementsByName("verified")[0].checked;
            const emailVerified = document.getElementsByName("emailVerified")[0].checked;
            const sendConfirmationEmail = document.getElementsByName("sendConfirmationEmail")[0].checked;

            if (editingIndex !== null) {
                userData[editingIndex] = {
                    type,
                    name,
                    email,
                    password,
                    confirmPassword,
                    active,
                    verified,
                    emailVerified,
                    sendConfirmationEmail
                };

                const tableRow = document.getElementById(`userRow${editingIndex}`);
                if (tableRow) {
                    tableRow.innerHTML = `
                        <td>${type}</td>
                        <td>${name}</td>
                        <td>${email}</td>
                        <td>${password}</td>
                        <td>${confirmPassword}</td>
                        <td>${active ? 'Yes' : 'No'}</td>
                        <td>${verified ? 'Yes' : 'No'}</td>
                        <td>${emailVerified ? 'Yes' : 'No'}</td>
                        <td>${sendConfirmationEmail ? 'Yes' : 'No'}</td>
                        <td>
                            <button class="usedit" onclick="editUser(${editingIndex})">Edit</button>
                            <button class="usedel" onclick="deleteUser(${editingIndex})">Delete</button>
                        </td>
                    `;
                }

                // Update local storage after editing
                localStorage.setItem('userData', JSON.stringify(userData));
            } else {
                userData.push({
                    type,
                    name,
                    email,
                    password,
                    confirmPassword,
                    active,
                    verified,
                    emailVerified,
                    sendConfirmationEmail
                });

                // Update local storage after creating
                localStorage.setItem('userData', JSON.stringify(userData));
                updateTable();
            }

            closeForm();
        }

        function updateTable() {
            const tableBody = document.getElementById("userDataBody");
            tableBody.innerHTML = "";

            userData.forEach((user, index) => {
                const row = document.createElement("tr");
                row.id = `userRow${index}`;
                row.innerHTML = `
                    <td>${user.type}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.password}</td>
                    <td>${user.confirmPassword}</td>
                    <td>${user.active ? 'Yes' : 'No'}</td>
                    <td>${user.verified ? 'Yes' : 'No'}</td>
                    <td>${user.emailVerified ? 'Yes' : 'No'}</td>
                    <td>${user.sendConfirmationEmail ? 'Yes' : 'No'}</td>
                    <td>
                        <button class="usedit" onclick="editUser(${index})">Edit</button>
                        <button class="usedel" onclick="deleteUser(${index})">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function editUser(index) {
            editingIndex = index;
            localStorage.setItem('editingIndex', JSON.stringify(editingIndex));
            const userToEdit = userData[index];
            if (userToEdit) {
                openForm();
                document.getElementById("type").value = userToEdit.type;
                document.getElementsByName("name")[0].value = userToEdit.name;
                document.getElementsByName("email")[0].value = userToEdit.email;
                document.getElementsByName("password")[0].value = userToEdit.password;
                document.getElementsByName("confirmPassword")[0].value = userToEdit.confirmPassword;
                document.getElementsByName("active")[0].checked = userToEdit.active;
                document.getElementsByName("verified")[0].checked = userToEdit.verified;
                document.getElementsByName("emailVerified")[0].checked = userToEdit.emailVerified;
                document.getElementsByName("sendConfirmationEmail")[0].checked = userToEdit.sendConfirmationEmail;
            }
        }

        function deleteUser(index) {
            userData.splice(index, 1);
            localStorage.setItem('userData', JSON.stringify(userData));
            updateTable();
        }

        // Initial table update on page load
        updateTable();
    </script>
</body>

</html>

    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
