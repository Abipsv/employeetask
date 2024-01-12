@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Relieve Request and Admin Page</title>
    <style>
        @media only screen and (max-width: 600px) {
        /* Styles for screens with a maximum width of 600px (adjust as needed) */
        body {
            margin: 10px;
        }

        .page {
            width: 100%;
            padding: 10px;
        }

        input, select, button {
            width: 100%;
            padding: 8px;
            margin: 4px 0;
            box-sizing: border-box;
        }

        table {
            overflow-x: auto;
            display: block;
            width: 100%;
        }

        th, td {
            min-width: 120px; /* Set a minimum width for cells to prevent them from becoming too narrow */
            box-sizing: border-box;
        }

        .adbtn, .logout-btn {
            width: 100%;
            margin-top: 10px;
        }
    }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .page {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: none;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        button {
            background-color: rgb(20, 20, 71);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: auto;
        }

        button:hover {
            background-color: rgb(20, 20, 71);
        }

        .accepted {
            background-color: #4caf50;
            color: white;
        }

        .rejected {
            background-color: #f44336;
            color: white;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color:  rgb(20, 20, 71);
            color: white;
        }

        .adbtn {
            width: auto;
            background-color: rgb(20, 20, 71);
        }

        .adbtn:hover {
            width: auto;
            background-color: rgb(20, 20, 71);
        }

        .logout-btn {
            background-color: #f44336;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<button class="adbtn" onclick="showEmployeePage()">Relieve Request</button>
<button class="adbtn" onclick="showAdminPage()">Admin </button>

<div id="employeePage" class="page">
    <h2>Employee Page - Submit Relieve Request</h2>

    <label for="newEmployeeName">Employee Name:</label>
    <input type="text" id="newEmployeeName" required>

    <label for="newEmployeeId">Employee ID:</label>
    <input type="text" id="newEmployeeId" required>

    <label for="newReason">Reason for Relieve:</label>
    <input type="text" id="newReason" required>

    <label for="newDate">Date:</label>
    <input type="date" id="newDate" required>

    <button onclick="submitNewRequest()">Submit Request</button>

    <hr>

    <h2>Your Relieve Requests</h2>
    <table>
        <thead>
        <tr>
            <th>Employee Name</th>
            <th>Employee ID</th>
            <th>Reason for Relief</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="employeeTableBody"></tbody>
    </table>
</div>

<div id="loginPage" class="page">
    <h2>Admin Login</h2>
    <label for="adminUsername">Username:</label>
    <input type="text" id="adminUsername" required>

    <label for="adminPassword">Password:</label>
    <input type="password" id="adminPassword" required>

    <button onclick="adminLogin()">Login</button>
    <button class="logout-btn" onclick="logout()">Logout</button>
</div>

<div id="adminPage" class="page">
    <h2>Admin Page - Employee Relieve Requests</h2>

    <button class="logout-btn" onclick="logout()">Logout</button>

    <table>
        <thead>
        <tr>
            <th>Employee Name</th>
            <th>Employee ID</th>
            <th>Reason for Relief</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody id="requestTableBody"></tbody>
    </table>

    <div id="popupForm" style="display: none;">
        <h2>Confirm Relieve Request</h2>
        <p><strong>Employee Name:</strong> <span id="popupEmployeeName"></span></p>
        <p><strong>Employee ID:</strong> <span id="popupEmployeeId"></span></p>
        <p><strong>Reason for Relief:</strong> <span id="popupReason"></span></p>
        <p><strong>Date:</strong> <span id="popupDate"></span></p>

        <button onclick="acceptRequest()">Accept</button>
        <button onclick="rejectRequest()">Reject</button>
        <button onclick="closePopup()">Close</button>
    </div>
</div>

<script>
    var requestData = [];
    var isAdminLoggedIn = false;

    window.onload = function () {
        requestData = JSON.parse(localStorage.getItem('requestData')) || [];
        populateAdminTable();
        populateEmployeeTable();
    };

    function submitNewRequest() {
        var newEmployeeName = document.getElementById('newEmployeeName').value;
        var newEmployeeId = document.getElementById('newEmployeeId').value;
        var newReason = document.getElementById('newReason').value;
        var newDate = document.getElementById('newDate').value;

        var newRequest = { employeeName: newEmployeeName, employeeId: newEmployeeId, reason: newReason, date: newDate, status: 'Pending' };
        requestData.push(newRequest);

        // Store current employee ID in local storage
        localStorage.setItem('currentEmployeeId', newEmployeeId);

        // Update local storage
        localStorage.setItem('requestData', JSON.stringify(requestData));

        populateAdminTable();
        populateEmployeeTable();
    }

    function populateEmployeeTable() {
        var tableBody = document.getElementById('employeeTableBody');

        tableBody.innerHTML = '';

        requestData.forEach(function (data) {
            var row = tableBody.insertRow();

            var nameCell = row.insertCell(0);
            var idCell = row.insertCell(1);
            var reasonCell = row.insertCell(2);
            var dateCell = row.insertCell(3);
            var statusCell = row.insertCell(4);
            var deleteCell = row.insertCell(5);

            nameCell.innerText = data.employeeName;
            idCell.innerText = data.employeeId;
            reasonCell.innerText = data.reason;
            dateCell.innerText = data.date;
            statusCell.innerText = data.status;

            if (data.status === 'Accepted') {
                row.className = 'accepted';
            } else if (data.status === 'Rejected') {
                row.className = 'rejected';
            }

            var deleteButton = document.createElement('button');
            deleteButton.innerText = 'Delete';
            deleteButton.onclick = function () {
                deleteRequest(data.employeeId);
            };
            deleteCell.appendChild(deleteButton);
        });
    }

    function deleteRequest(employeeId) {
        var index = findIndexToDelete(employeeId);
        if (index !== -1) {
            requestData.splice(index, 1);
            localStorage.setItem('requestData', JSON.stringify(requestData));

            populateAdminTable();
            populateEmployeeTable();
        }
    }

    function findIndexToDelete(employeeId) {
        for (var i = 0; i < requestData.length; i++) {
            if (requestData[i].employeeId === employeeId && requestData[i].status === 'Pending') {
                return i;
            }
        }

        return -1; // Not found
    }

    function showEmployeePage() {
        document.getElementById('employeePage').style.display = 'block';
        document.getElementById('adminPage').style.display = 'none';
        document.getElementById('loginPage').style.display = 'none'; // Hide login page
    }

    function showAdminPage() {
        if (isAdminLoggedIn) {
            document.getElementById('employeePage').style.display = 'none';
            document.getElementById('adminPage').style.display = 'block';
            populateAdminTable();
            document.getElementById('loginPage').style.display = 'none'; // Hide login page
        } else {
            document.getElementById('employeePage').style.display = 'none';
            document.getElementById('adminPage').style.display = 'none';
            document.getElementById('loginPage').style.display = 'block';
        }
    }

    function acceptRequest() {
        updateRequestStatus('Accepted');
    }

    function rejectRequest() {
        updateRequestStatus('Rejected');
    }

    function updateRequestStatus(status) {
        var index = findIndexToUpdate();
        if (index !== -1) {
            requestData[index].status = status;
            localStorage.setItem('requestData', JSON.stringify(requestData));

            closePopup();
            populateAdminTable();
            populateEmployeeTable();
        }
    }

    function findIndexToUpdate() {
        var employeeId = document.getElementById('popupEmployeeId').innerText;

        for (var i = 0; requestData.length; i++) {
            if (requestData[i].employeeId === employeeId && requestData[i].status === 'Pending') {
                return i;
            }
        }

        return -1; // Not found
    }

    function closePopup() {
        document.getElementById('popupForm').style.display = 'none';
    }

    function populateAdminTable() {
        var tableBody = document.getElementById('requestTableBody');

        tableBody.innerHTML = '';

        requestData.forEach(function (data, index) {
            var row = tableBody.insertRow();

            var nameCell = row.insertCell(0);
            var idCell = row.insertCell(1);
            var reasonCell = row.insertCell(2);
            var dateCell = row.insertCell(3);
            var statusCell = row.insertCell(4);
            var actionCell = row.insertCell(5);
            var deleteCell = row.insertCell(6);

            nameCell.innerText = data.employeeName;
            idCell.innerText = data.employeeId;
            reasonCell.innerText = data.reason;
            dateCell.innerText = data.date;
            statusCell.innerText = data.status;

            var actionButton = document.createElement('button');
            actionButton.innerText = 'View & Act';
            actionButton.onclick = function () {
                openPopup(index);
            };

            actionCell.appendChild(actionButton);

            var deleteButtonAdmin = document.createElement('button');
            deleteButtonAdmin.innerText = 'Delete';
            deleteButtonAdmin.onclick = function () {
                deleteRequestAdmin(index);
            };
            deleteCell.appendChild(deleteButtonAdmin);
        });
    }

    function openPopup(index) {
        var request = requestData[index];

        document.getElementById('popupEmployeeName').innerText = request.employeeName;
        document.getElementById('popupEmployeeId').innerText = request.employeeId;
        document.getElementById('popupReason').innerText = request.reason;
        document.getElementById('popupDate').innerText = request.date;

        document.getElementById('popupForm').style.display = 'block';
    }

    function deleteRequestAdmin(index) {
        requestData.splice(index, 1);
        localStorage.setItem('requestData', JSON.stringify(requestData));

        populateAdminTable();
        populateEmployeeTable();
    }

    function adminLogin() {
        var enteredUsername = document.getElementById('adminUsername').value;
        var enteredPassword = document.getElementById('adminPassword').value;

        if (enteredUsername === 'psv1111' && enteredPassword === 'psv@info') {
            isAdminLoggedIn = true;
            showAdminPage();
        } else {
            alert('Invalid username or password. Please try again.');
        }
    }

    function logout() {
        isAdminLoggedIn = false;
        showAdminPage();
        document.getElementById('loginPage').style.display = 'none'; // Hide login page
    }
</script>

</body>
</html>

    
@endsection
