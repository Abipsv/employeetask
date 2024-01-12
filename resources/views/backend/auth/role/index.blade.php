@extends('backend.layouts.app')

@section('title', __('Role Management'))

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
            font-family: Arial, sans-serif;
        }

        .popup-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            z-index: 1000;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 900;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            display: flex;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select{
            width: 100%;
           padding-top:10px ;
           padding-bottom:10px ;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .edit {
            cursor: pointer;
            margin-right: 10px;
          background-color:rgb(35, 35, 139) ;
          color: white;
          padding: 10px;
          border: none;
          border-radius: 5px;
          width: 90px;
        }
        .rolbt {
            cursor: pointer;
            margin-right: 10px;
            background-color: rgb(35, 35, 139);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            
            display: block;
            
            width: 100px;
        }
        .delete{
background-color: red;
color: white;
padding: 10px;
border: none;
border-radius: 5px;
width: 90px;
        }
        @media only screen and (max-width: 600px) {
        /* Add specific styles for mobile view */

        body {
            font-size: 14px; /* Adjust font size for better readability on smaller screens */
        }

        .popup-form {
            width: 90%; /* Adjust the width of the popup form */
            padding: 10px; /* Adjust padding for smaller screens */
        }

        table {
            margin-top: 10px; /* Adjust margin for the table on smaller screens */
        }

        th, td {
            padding: 8px; /* Adjust cell padding for better spacing on smaller screens */
        }

        .edit, .delete, .rolbt {
            width: 100%; /* Make buttons full-width on mobile */
            margin-bottom: 10px; /* Add spacing between buttons on mobile */
        }
    }
    </style>
    <title>Role Management</title>
</head>
<body>

<button class="rolbt" onclick="openPopup()">Create Role</button>

<div id="popup" class="popup-form">
    <h2>Create Role</h2>
    <label for="roleType">Type:</label>
    <select id="roleType">
        <option value="administrator">Administrator</option>
        <option value="user">User</option>
    </select>
    <label for="roleName">Name:</label>
    <input type="text" id="roleName" required>
    <label for="permissions">Permissions:</label>
    <select id="permissions" multiple>
        <option value="all">All</option>
        <option value="view">View User</option>
        <option value="deactivate">Deactivate User</option>
        <option value="reactivate">Reactivate User</option>
        <option value="clear">Clear User Session</option>
        <option value="changePassword">Change User Passwords</option>
    </select>

    <label for="numUsers">Number of Users:</label>
    <input type="number" id="numUsers">

    <div class="actions">
        <button class="edit" id="saveButton" onclick="saveRole()">Save</button>
        <button class="delete"  onclick="closePopup()">Close</button>
    </div>
</div>

<div id="editPopup" class="popup-form">
    <h2>Edit Role</h2>
    <label for="editRoleType">Type:</label>
    <select id="editRoleType">
        <option value="administrator">Administrator</option>
        <option value="user">User</option>
    </select>

    <label for="editRoleName">Name:</label>
    <input type="text" id="editRoleName" required>

    <label for="editPermissions">Permissions:</label>
    <select id="editPermissions" multiple>
        <option value="all">All</option>
        <option value="view">View User</option>
        <option value="deactivate">Deactivate User</option>
        <option value="reactivate">Reactivate User</option>
        <option value="clear">Clear User Session</option>
        <option value="changePassword">Change User Passwords</option>
    </select>

    <label for="editNumUsers">Number of Users:</label>
    <input type="number" id="editNumUsers">

    <div class="actions">
        <button class="edit" id="updateButton" onclick="updateRole()">Update</button>
        <button  class="delete" onclick="closeEditPopup()">Cancel</button>
    </div>
</div>

<div id="overlay" class="overlay"></div>

<table>
    <thead>
        <tr>
            <th>Type</th>
            <th>Name</th>
            <th>Permissions</th>
            <th>Number of Users</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="roleTableBody">
        <!-- Table data will be dynamically populated here -->
    </tbody>
</table>

<script>
    var roles = JSON.parse(localStorage.getItem('roles')) || [];

    displayRoles();

    function openPopup() {
        document.getElementById('popup').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('saveButton').style.display = 'block';
        document.getElementById('updateButton').style.display = 'none';

        // Clear form fields
        document.getElementById('roleType').value = 'administrator';
        document.getElementById('roleName').value = '';
        document.getElementById('permissions').selectedIndex = -1;
        document.getElementById('numUsers').value = '';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function closeEditPopup() {
        document.getElementById('editPopup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function saveRole() {
        var roleType = document.getElementById('roleType').value;
        var roleName = document.getElementById('roleName').value;
        var permissions = Array.from(document.getElementById('permissions').options)
            .filter(option => option.selected)
            .map(option => option.value);
        var numUsers = document.getElementById('numUsers').value;

        var newRole = {
            type: roleType,
            name: roleName,
            permissions: permissions,
            numUsers: numUsers
        };

        roles.push(newRole);
        localStorage.setItem('roles', JSON.stringify(roles));

        displayRoles();
        closePopup();
    }

    function editRow(index) {
        document.getElementById('editPopup').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('saveButton').style.display = 'none';
        document.getElementById('updateButton').style.display = 'block';

        // Populate edit form with existing data
        var role = roles[index];
        document.getElementById('editRoleType').value = role.type;
        document.getElementById('editRoleName').value = role.name;
        document.getElementById('editPermissions').value = role.permissions;
        document.getElementById('editNumUsers').value = role.numUsers;

        // Save the index of the role being edited for later use
        document.getElementById('editPopup').setAttribute('data-edit-index', index);
    }

    function updateRole() {
        var index = document.getElementById('editPopup').getAttribute('data-edit-index');
        var roleType = document.getElementById('editRoleType').value;
        var roleName = document.getElementById('editRoleName').value;
        var permissions = Array.from(document.getElementById('editPermissions').options)
            .filter(option => option.selected)
            .map(option => option.value);
        var numUsers = document.getElementById('editNumUsers').value;

        // Update the role data
        roles[index] = {
            type: roleType,
            name: roleName,
            permissions: permissions,
            numUsers: numUsers
        };

        // Save roles to local storage
        localStorage.setItem('roles', JSON.stringify(roles));

        // Update the displayed roles
        displayRoles();

        // Close the edit popup
        closeEditPopup();
    }

    function deleteRow(index) {
        roles.splice(index, 1);
        localStorage.setItem('roles', JSON.stringify(roles));
        displayRoles();
    }

    function displayRoles() {
        var tableBody = document.getElementById('roleTableBody');
        tableBody.innerHTML = '';

        roles.forEach(function(role, index) {
            var row = tableBody.insertRow(tableBody.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);

            cell1.innerHTML = role.type;
            cell2.innerHTML = role.name;
            cell3.innerHTML = role.permissions.join(', ');
            cell4.innerHTML = role.numUsers;
            cell5.innerHTML = '<button class="edit" onclick="editRow(' + index + ')">Edit</button>' +
                              '<button class="delete" onclick="deleteRow(' + index + ')">Delete</button>';
        });
    }
</script>

</body>
</html>


@endsection
