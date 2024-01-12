@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Leave Request and Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .custom-page {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: none;
        }

        .custom-input,
        .custom-select,
        .custom-button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        .custom-button {
            background-color: rgb(20, 20, 71);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: auto;
        }

        .custom-button:hover {
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

        .custom-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        .custom-th,
        .custom-td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .custom-th {
            background-color: rgb(20, 20, 71);
            color: white;
        }

        .custom-adbtn {
            width: auto;
            background-color: rgb(20, 20, 71);
        }

        .custom-adbtn:hover {
            width: auto;
            background-color: rgb(20, 20, 71);
        }

        .custom-logout-btn {
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

    <button class="custom-adbtn" onclick="showEmployeePage()">Employee Page</button>
    <button class="custom-adbtn" onclick="showAdminPage()">Admin Page</button>

    <div id="employeePage" class="custom-page">
        <h2>Employee Page - Submit Leave Request</h2>

        <label for="empName">Employee Name:</label>
        <input type="text" id="empName" class="custom-input" required>

        <label for="empId">Employee ID:</label>
        <input type="text" id="empId" class="custom-input" required>

        <label for="leaveReason">Reason for Leave:</label>
        <input type="text" id="leaveReason" class="custom-input" required>

        <label for="leaveDate">Date:</label>
        <input type="date" id="leaveDate" class="custom-input" required>

        <button onclick="submitNewRequest()" class="custom-button">Submit Request</button>

        <hr>

        <h2>Your Leave Requests</h2>
        <table class="custom-table">
            <thead>
                <tr>
                    <th class="custom-th">Employee Name</th>
                    <th class="custom-th">Employee ID</th>
                    <th class="custom-th">Reason for Leave</th>
                    <th class="custom-th">Date</th>
                    <th class="custom-th">Status</th>
                    <th class="custom-th">Action</th>
                </tr>
            </thead>
            <tbody id="employeeTableBody"></tbody>
        </table>
    </div>

    <div id="loginPage" class="custom-page">
        <h2>Admin Login</h2>
        <label for="adminUsername">Username:</label>
        <input type="text" id="adminUsername" class="custom-input" required>

        <label for="adminPassword">Password:</label>
        <input type="password" id="adminPassword" class="custom-input" required>

        <button onclick="adminLogin()" class="custom-button">Login</button>
        <button class="custom-logout-btn" onclick="logout()">Logout</button>
    </div>

    <div id="adminPage" class="custom-page">
        <h2>Admin Page - Employee Leave Requests</h2>

        <button class="custom-logout-btn" onclick="logout()">Logout</button>

        <table class="custom-table">
            <thead>
                <tr>
                    <th class="custom-th">Employee Name</th>
                    <th class="custom-th">Employee ID</th>
                    <th class="custom-th">Reason for Leave</th>
                    <th class="custom-th">Date</th>
                    <th class="custom-th">Status</th>
                    <th class="custom-th">Action</th>
                    <th class="custom-th">Remove</th>
                </tr>
            </thead>
            <tbody id="requestTableBody"></tbody>
        </table>

        <div id="popupForm" style="display: none;">
            <h2>Confirm Leave Request</h2>
            <p><strong>Employee Name:</strong> <span id="popupEmpName"></span></p>
            <p><strong>Employee ID:</strong> <span id="popupEmpId"></span></p>
            <p><strong>Reason for Leave:</strong> <span id="popupLeaveReason"></span></p>
            <p><strong>Date:</strong> <span id="popupLeaveDate"></span></p>

            <button onclick="acceptRequest()" class="custom-button">Accept</button>
            <button onclick="rejectRequest()" class="custom-button">Reject</button>
            <button onclick="closePopup()" class="custom-button">Close</button>
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
            var employeeName = document.getElementById('empName').value;
            var employeeId = document.getElementById('empId').value;
            var leaveReason = document.getElementById('leaveReason').value;
            var leaveDate = document.getElementById('leaveDate').value;

            var newRequest = { employeeName: employeeName, employeeId: employeeId, reason: leaveReason, date: leaveDate, status: 'Pending' };
            requestData.push(newRequest);

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
                var actionCell = row.insertCell(5);

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

                var actionButton = document.createElement('button');
                actionButton.innerText = 'View';
                actionButton.onclick = function () {
                    // Implement any action needed for the employee view
                    alert('View request details or take specific action here.');
                };
                actionCell.appendChild(actionButton);
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
            var employeeId = document.getElementById('popupEmpId').innerText;

            for (var i = 0; i < requestData.length; i++) {
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

            document.getElementById('popupEmpName').innerText = request.employeeName;
            document.getElementById('popupEmpId').innerText = request.employeeId;
            document.getElementById('popupLeaveReason').innerText = request.reason;
            document.getElementById('popupLeaveDate').innerText = request.date;

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

            if (enteredUsername === 'yourAdminUsername' && enteredPassword === 'yourAdminPassword') {
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
