@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
         @media only screen and (max-width: 600px) {
        /* Adjust styles for smaller screens */
        #ptaskPopup {
            width: 90%;
            max-width: 100%;
        }

        #ptaskTable {
            overflow-x: auto;
            display: block;
        }

        #ptaskTable th, #ptaskTable td {
            white-space: nowrap;
        }
        /* Add more responsive styles as needed */
    }
        body {
            font-family: Arial, sans-serif;
        }

        #ptaskPopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 999;
            width: 450px;
        }

        #ptaskPopup label {
            display: block;
            margin-bottom: 5px;
        }

        .lea {
            background-color: midnightblue;
            color: white;
            border-style: none;
            border-color: none;
            padding: 10px;
            border-radius: 3px;
        }

        .input area {
            background-color: #ddd;
        }

        .lable {
            color: black;
            font-weight: 800;
        }

        input,
        textarea,
        #leaveType, #assignedByText, #status {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        label {
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }

        .popup-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            z-index: 1;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        #ptaskTable {
    width: 60%; /* Adjust the width as needed */
    margin: 0 auto; /* Center the table */
    border-collapse: collapse;
    margin-top: 20px;
}
        #ptaskTable th, #ptaskTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #ptaskTable th {
            background-color: #f2f2f2;
        }

        #ptaskTable tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        #ptaskTable button {
            cursor: pointer;
        }
        .edit-button {
            background-color: #4caf50; /* Green */
            display: inline-block;
            padding: 5px 10px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border: none;
            border-radius: 5px;
        }

        .delete-button {
            background-color: #f44336; /* Red */
            display: inline-block;
            padding: 5px 10px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border: none;
            border-radius: 5px;
        }

        #status {
            /* Add default styles for the dropdown */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-weight: 700;
            
        }

        .status-working {
            background-color: #ffd700; /* Yellow for 'Working' */
            font-weight: 800; 
            font-size: 15px;
        }

        .status-finished {
            background-color:deepskyblue;
            font-weight: 800; 
            font-size: 15px; /* Green for 'Finished' */
        }

        .status-pending {
            text-align: center;
            justify-content: center;
            font-size: 15px;
            color:black;
            background-color:coral;
            font-weight: 800; /* Red for 'Pending' */
        }

        /* Add styles for selected options */
        #ptaskTable .selected-working {
            background-color: #ffd700; 
            font-weight: 800;/* Yellow for 'Working' */
        }

        #ptaskTable .selected-finished {
            background-color:deepskyblue; 
            font-weight: 800;/* Green for 'Finished' */
        }

        #ptaskTable .selected-pending {
            background-color:firebrick; /* Red for 'Pending' */
        }
        
        /* Additional styles for the login form */
        #loginForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 999;
            width: 300px;
        }

        #loginForm label {
            display: block;
            margin-bottom: 5px;
        }

        #loginForm input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #loginForm button {
            background-color: midnightblue;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        #ptaskPopup,
        #ptaskTable {
            display: none;
        }
    </style>
    <title>PTask Popup</title>
</head>
<body>
    <button class="lea" onclick="showLoginForm()">Login</button>

    <div id="loginForm">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username">
    
        <label for="password">Password:</label>
        <input type="password" id="password">
    
        <button onclick="login()">Login</button>
    </div>
<button class="lea" id="ptaskbut"onclick="showPTaskPopup()">Add PTask</button>

<div id="ptaskPopup">
    <h2>Add PTask</h2>
    <label for="teamLeader">Team Leader Name:</label>
    <input type="text" id="teamLeader">

    <label for="projectName">Project Name:</label>
    <input type="text" id="projectName">

    <label for="numTasks">Number of Tasks:</label>
    <input type="number" id="numTasks">

    <label for="email">Email:</label>
    <input type="email" id="email">

    <label for="givenDate">Given Date:</label>
    <input type="date" id="givenDate">

    <label for="status">Status:</label>
    <select id="status">
        <option value="working">Working</option>
        <option value="finished">Finished</option>
        <option value="pending">Pending</option>
    </select>

    <!-- Change the Assigned By label to a text input field -->
    <label for="assignedByText">Assigned By:</label>
    <input type="text" id="assignedByText">

    <button class="lea" onclick="savePTask()">Save</button>
    <button class="lea" onclick="closePTaskPopup()">Close</button>
</div>

<table id="ptaskTable" >
    <thead>
        <tr>
            <th>Team Leader</th>
            <th>Project Name</th>
            <th>Num Tasks</th>
            <th>Email</th>
            <th>Given Date</th>
            <th>Status</th>
            <th>Assigned By</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Existing or dynamically added rows go here -->
    </tbody>
</table>

<script>
    function showLoginForm() {
        document.getElementById("loginForm").style.display = "block";
    }

    function closeLoginForm() {
        document.getElementById("loginForm").style.display = "none";
    }

    function login() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            // Add your authentication logic here
            if (username === 'leader999' && password === 'psv999') {
                closeLoginForm();
                // Show the elements that should be visible after login
                document.getElementById('ptaskPopup').style.display = 'block';
                document.getElementById('ptaskTable').style.display = 'block';
                document.getElementById('ptaskbut').style.display = 'block'; // Show the "Add PTask" button
            } else {
                alert('Invalid credentials. Please try again.');
            }
        }
    window.onload = function () {
        loadSavedData();
        updateButtonStyles();
        highlightStatus();
    };

    function showPTaskPopup() {
        document.getElementById("ptaskPopup").style.display = "block";
    }

    function closePTaskPopup() {
        document.getElementById("ptaskPopup").style.display = "none";
    }

    function savePTask() {
        // Retrieve values from the form
        var teamLeader = document.getElementById('teamLeader').value;
        var projectName = document.getElementById('projectName').value;
        var numTasks = document.getElementById('numTasks').value;
        var email = document.getElementById('email').value;
        var givenDate = document.getElementById('givenDate').value;
        var status = document.getElementById('status').value;
        var assignedBy = document.getElementById('assignedByText').value;

        // Add the data to the table
        var table = document.getElementById('ptaskTable').getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);
        var cells = newRow.insertCell(0);
        cells.innerHTML = teamLeader;
        cells = newRow.insertCell(1);
        cells.innerHTML = projectName;
        cells = newRow.insertCell(2);
        cells.innerHTML = numTasks;
        cells = newRow.insertCell(3);
        cells.innerHTML = email;
        cells = newRow.insertCell(4);
        cells.innerHTML = givenDate;
        cells = newRow.insertCell(5);
        cells.innerHTML = status;
        cells = newRow.insertCell(6);
        cells.innerHTML = assignedBy;
        cells = newRow.insertCell(7);
        cells.innerHTML = '<button class="edit-button" onclick="editTask(this)">Edit</button>' +
                          '<button class="delete-button" onclick="deleteTask(this)">Delete</button>';

        // Save data to localStorage
        saveDataToLocalStorage();

        // Clear the form
        document.getElementById('teamLeader').value = '';
        document.getElementById('projectName').value = '';
        document.getElementById('numTasks').value = '';
        document.getElementById('email').value = '';
        document.getElementById('givenDate').value = '';
        document.getElementById('status').value = 'working';
        document.getElementById('assignedByText').value = '';

        closePTaskPopup();

        // Update the style of the buttons
        updateButtonStyles();
        highlightStatus();
    }

    function editTask(button) {
        var row = button.parentNode.parentNode;
        var cells = row.getElementsByTagName('td');
        document.getElementById('teamLeader').value = cells[0].innerHTML;
        document.getElementById('projectName').value = cells[1].innerHTML;
        document.getElementById('numTasks').value = cells[2].innerHTML;
        document.getElementById('email').value = cells[3].innerHTML;
        document.getElementById('givenDate').value = cells[4].innerHTML;
        document.getElementById('status').value = cells[5].innerHTML;
        document.getElementById('assignedByText').value = cells[6].innerHTML;

        // Delete the row after editing
        row.parentNode.removeChild(row);

        // Save data to localStorage
        saveDataToLocalStorage();

        // Show the popup after setting values
        showPTaskPopup();

        // Update the style of the buttons
        updateButtonStyles();
        highlightStatus();
    }

    function deleteTask(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);

        // Save data to localStorage
        saveDataToLocalStorage();

        // Update the style of the buttons
        updateButtonStyles();
        highlightStatus();
    }

    function saveDataToLocalStorage() {
        // Get the current data from the table and save it to localStorage
        var tableData = [];
        var table = document.getElementById('ptaskTable').getElementsByTagName('tbody')[0];

        for (var i = 0; i < table.rows.length; i++) {
            var rowData = [];
            for (var j = 0; j < table.rows[i].cells.length - 1; j++) {
                rowData.push(table.rows[i].cells[j].innerHTML);
            }
            tableData.push(rowData.join(','));
        }

        localStorage.setItem('ptaskData', JSON.stringify(tableData));
    }

    function loadSavedData() {
        // Load data from localStorage and populate the table
        var storedData = localStorage.getItem('ptaskData');

        if (storedData) {
            var tableData = JSON.parse(storedData);
            var table = document.getElementById('ptaskTable').getElementsByTagName('tbody')[0];

            for (var i = 0; i < tableData.length; i++) {
                var rowData = tableData[i].split(',');
                var newRow = table.insertRow(table.rows.length);
                for (var j = 0; j < rowData.length; j++) {
                    var cell = newRow.insertCell(j);
                    cell.innerHTML = rowData[j];
                }
                newRow.insertCell(rowData.length).innerHTML = '<button class="edit-button" onclick="editTask(this)">Edit</button>' +
                                                                '<button class="delete-button" onclick="deleteTask(this)">Delete</button>';
            }
        }
    }

    function updateButtonStyles() {
        // Update the style of the buttons after loading data
        var editButtons = document.getElementsByClassName('edit-button');
        var deleteButtons = document.getElementsByClassName('delete-button');

        for (var i = 0; i < editButtons.length; i++) {
            editButtons[i].classList.add('edit-button');
        }

        for (var i = 0; i < deleteButtons.length; i++) {
            deleteButtons[i].classList.add('delete-button');
        }
    }

    function highlightStatus() {
        // Highlight the status in the table based on selected values
        var table = document.getElementById('ptaskTable').getElementsByTagName('tbody')[0];
        var rows = table.getElementsByTagName('tr');

        for (var i = 0; rows[i]; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var statusCell = cells[5]; // Assuming the status is in the sixth column (index 5)
            var statusValue = statusCell.innerHTML.trim().toLowerCase();

            // Remove existing status classes
            statusCell.classList.remove('status-working', 'status-finished', 'status-pending');

            // Add the appropriate class based on the status value
            if (statusValue === 'working') {
                statusCell.classList.add('status-working');
            } else if (statusValue === 'finished') {
                statusCell.classList.add('status-finished');
            } else if (statusValue === 'pending') {
                statusCell.classList.add('status-pending');
            }
        }
    }
</script>

@endsection
