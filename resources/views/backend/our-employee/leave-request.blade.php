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
        .leave-page {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            display: none;
        }

        .leave-input,
        .leave-select,
        .leave-button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 4px;
        }

        .leave-button {
            background-color: midnightblue;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: auto;
            margin-top: 10px;
        }

        .leave-button:hover {
            background-color: midnightblue;
        }

        .accepted-leave {
            background-color: #00FF7F;
            color: black;
            font-weight: bold;
            padding: 15px;
        }

        .rejected-leave {
            background-color: #E86100;
            color: black;
            font-weight: bold;
            padding: 15px;
        }

        .leave-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        .leave-th,
        .leave-td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        .leave-th {
            background-color: midnightblue;
            color: white;
            padding: 15px;
        }

        .leave-adbtn {
            width: auto;
            background-color: midnightblue;
            color: white;
            margin-right: 10px;
        }

        .leave-adbtn:hover {
            background-color: midnightblue;
        }

        .leave-logout-btn {
            background-color: #f44336;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: auto;
            margin-top: 10px;
        }

        #leavePage,
        #loginPage {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            z-index: 2;
            width: 500px;
        }

        #adminPage {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            z-index: 2;
            width: 1200px;
        }

        #popupForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            z-index: 2;
        }

        #popupForm h2 {
            color: midnightblue;
        }

        #popupForm label {
            color: midnightblue;
        }

        #popupForm .leave-button {
            background-color: #008080;
        }

        #popupForm .leave-button:hover {
            background-color: #006666;
        }

        @media only screen and (max-width: 600px) {
            .leave-page {
                padding: 10px;
            }

            .leave-input,
            .leave-select,
            .leave-button {
                width: 100%;
                padding: 8px;
                margin: 6px 0;
            }

            .leave-button {
                padding: 12px;
            }

            .leave-table {
                margin-top: 10px;
            }

            .leave-logout-btn {
                margin-top: 5px;
            }

            #leavePage,
            #loginPage {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
                background: #fff;
                border: 1px solid #ccc;
                z-index: 2;
                width: 300px;
                overflow-y: auto;
            }

            #adminPage {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
                background: #fff;
                border: 1px solid #ccc;
                z-index: 2;
                width: 500px;
                overflow-y: auto;
            }

            #popupForm {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
                background: #fff;
                border: 1px solid #ccc;
                z-index: 2;
                width: 300px;
            }
        }

        .leave-action-view {
            background-color: #3498db;
            color: white;
        }

        .leave-action-viewact {
            background-color: #2ecc71;
            color: white;
        }

        .leave-action-delete {
            background-color: #e74c3c;
            color: white;
        }

        .view {
            background-color: #3498db;
        }
       
    </style>
</head>

<body>

    <button class="leave-adbtn" onclick="showLeavePage()">Leave Page</button>
    <button class="leave-adbtn" onclick="showAdminPage()">Admin Page</button><br><hr>
    <label for="filterEmpId">Filter by Employee ID:</label>
    <input type="text" id="filterEmpId" oninput="filterLeaveRequests()">
    <label for="filterMonth">Filter by Month (Date):</label>
    <input type="month" id="filterMonth" onchange="filterLeaveRequests()">

    <div id="leavePage" class="leave-page">
        <h2>Leave Page - Submit Leave Request</h2>

        <label for="leaveEmpName">Employee Name:</label>
        <input type="text" id="leaveEmpName" class="leave-input" required>

        <label for="leaveEmpId">Employee ID:</label>
        <input type="text" id="leaveEmpId" class="leave-input" required>

        <label for="leaveReason">Reason for Leave:</label>
        <input type="text" id="leaveReason" class="leave-input" required>

        <label for="leaveDate">Date:</label>
        <input type="date" id="leaveDate" class="leave-input" required>

        <button onclick="submitLeaveRequest()" class="leave-button">Submit Request</button>

        <hr><br><br>
    </div>

    <h2>Your Leave Requests</h2>
    <div class="table-container">
        <table class="leave-table">
            <thead>
                <tr>
                    <th class="leave-th">Employee Name</th>
                    <th class="leave-th">Employee ID</th>
                    <th class="leave-th">Reason for Leave</th>
                    <th class="leave-th">Date</th>
                    <th class="leave-th">Status</th>
                </tr>
            </thead>
            <tbody id="leaveTableBody"></tbody>
        </table>
    </div>
    </div>

    <div id="loginPage" class="leave-page">
        <h2>Admin Login</h2>
        <label for="adminUsername">Username:</label>
        <input type="text" id="adminUsername" class="leave-input" required>

        <label for="adminPassword">Password:</label>
        <input type="password" id="adminPassword" class="leave-input" required>

        <button onclick="adminLogin()" class="leave-button">Login</button>
        <button class="leave-logout-btn" onclick="logout()">Logout</button>
    </div>

    <div id="adminPage" class="leave-page">
        <h2>Admin Page - Employee Leave Requests</h2>

        <button class="leave-logout-btn" onclick="logout()">Logout</button>
        <div class="table-container">
            <table class="leave-table">
                <thead>
                    <tr>
                        <th class="leave-th">Employee Name</th>
                        <th class="leave-th">Employee ID</th>
                        <th class="leave-th">Reason for Leave</th>
                        <th class="leave-th">Date</th>
                        <th class="leave-th">Status</th>
                        <th class="leave-th">Action</th>
                        <th class="leave-th">Remove</th>
                    </tr>
                </thead>
                <tbody id="adminTableBody"></tbody>
            </table>
        </div>
        <div id="popupForm">
            <h2>Confirm Leave Request</h2>
            <p><strong>Employee Name:</strong> <span id="popupLeaveEmpName"></span></p>
            <p><strong>Employee ID:</strong> <span id="popupLeaveEmpId"></span></p>
            <p><strong>Reason for Leave:</strong> <span id="popupLeaveReason"></span></p>
            <p><strong>Date:</strong> <span id="popupLeaveDate"></span></p>

            <button onclick="acceptLeaveRequest()" class="leave-button">Accept</button>
            <button onclick="rejectLeaveRequest()" class="leave-button">Reject</button>

        </div>
    </div>

    <script>
        var leaveData = [];
        var isAdminLoggedIn = false;

        window.onload = function () {
            leaveData = JSON.parse(localStorage.getItem('leaveData')) || [];
            populateAdminTable();
            populateLeaveTable();
        };

        function submitLeaveRequest() {
            var employeeName = document.getElementById('leaveEmpName').value;
            var employeeId = document.getElementById('leaveEmpId').value;
            var leaveReason = document.getElementById('leaveReason').value;
            var leaveDate = document.getElementById('leaveDate').value;

            var newLeaveRequest = { employeeName: employeeName, employeeId: employeeId, reason: leaveReason, date: leaveDate, status: 'Pending' };
            leaveData.push(newLeaveRequest);

            localStorage.setItem('currentEmployeeId', employeeId);

            localStorage.setItem('leaveData', JSON.stringify(leaveData));

            populateAdminTable();
            populateLeaveTable();
        }

        function populateLeaveTable(filteredData) {
            var tableBody = document.getElementById('leaveTableBody');

            tableBody.innerHTML = '';

            (filteredData || leaveData).forEach(function (data) {
                var row = tableBody.insertRow();

                var nameCell = row.insertCell(0);
                var idCell = row.insertCell(1);
                var reasonCell = row.insertCell(2);
                var dateCell = row.insertCell(3);
                var statusCell = row.insertCell(4);

                nameCell.innerText = data.employeeName;
                idCell.innerText = data.employeeId;
                reasonCell.innerText = data.reason;
                dateCell.innerText = data.date;
                statusCell.innerText = data.status;

                if (data.status === 'Accepted') {
                    row.className = 'accepted-leave';
                } else if (data.status === 'Rejected') {
                    row.className = 'rejected-leave';
                }
            });
        }

        function deleteLeaveRequest(employeeId) {
            var index = findIndexToDeleteLeave(employeeId);
            if (index !== -1) {
                leaveData.splice(index, 1);
                localStorage.setItem('leaveData', JSON.stringify(leaveData));

                populateAdminTable();
                populateLeaveTable();
            }
        }

        function findIndexToDeleteLeave(employeeId) {
            for (var i = 0; i < leaveData.length; i++) {
                if (leaveData[i].employeeId === employeeId && leaveData[i].status === 'Pending') {
                    return i;
                }
            }

            return -1;
        }

        function showLeavePage() {
            document.getElementById('leavePage').style.display = 'block';
            document.getElementById('adminPage').style.display = 'none';
            document.getElementById('loginPage').style.display = 'none';
        }

        function showAdminPage() {
            if (isAdminLoggedIn) {
                document.getElementById('leavePage').style.display = 'none';
                document.getElementById('adminPage').style.display = 'block';
                populateAdminTable();
                document.getElementById('loginPage').style.display = 'none';
            } else {
                document.getElementById('leavePage').style.display = 'none';
                document.getElementById('adminPage').style.display = 'none';
                document.getElementById('loginPage').style.display = 'block';
            }
        }

        function acceptLeaveRequest() {
            updateLeaveRequestStatus('Accepted');
        }

        function rejectLeaveRequest() {
            updateLeaveRequestStatus('Rejected');
        }

        function updateLeaveRequestStatus(status) {
            var index = findIndexToUpdateLeave();
            if (index !== -1) {
                leaveData[index].status = status;
                localStorage.setItem('leaveData', JSON.stringify(leaveData));

                closePopup();
                populateAdminTable();
                populateLeaveTable();
            }
        }

        function findIndexToUpdateLeave() {
            var employeeId = document.getElementById('popupLeaveEmpId').innerText;

            for (var i = 0; i < leaveData.length; i++) {
                if (leaveData[i].employeeId === employeeId && leaveData[i].status === 'Pending') {
                    return i;
                }
            }

            return -1;
        }

        function closePopup() {
            document.getElementById('popupForm').style.display = 'none';
        }

        function populateAdminTable() {
            var tableBody = document.getElementById('adminTableBody');

            tableBody.innerHTML = '';

            leaveData.forEach(function (data, index) {
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
                    openPopupLeave(index);
                };

                actionCell.appendChild(actionButton);

                var deleteButtonAdmin = document.createElement('button');
                deleteButtonAdmin.innerText = 'Delete';
                deleteButtonAdmin.onclick = function () {
                    deleteLeaveRequestAdmin(index);
                };
                deleteCell.appendChild(deleteButtonAdmin);
            });
        }

        function openPopupLeave(index) {
            var request = leaveData[index];

            document.getElementById('popupLeaveEmpName').innerText = request.employeeName;
            document.getElementById('popupLeaveEmpId').innerText = request.employeeId;
            document.getElementById('popupLeaveReason').innerText = request.reason;
            document.getElementById('popupLeaveDate').innerText = request.date;

            document.getElementById('popupForm').style.display = 'block';
        }

        function deleteLeaveRequestAdmin(index) {
            leaveData.splice(index, 1);
            localStorage.setItem('leaveData', JSON.stringify(leaveData));

            populateAdminTable();
            populateLeaveTable();
        }

        function adminLogin() {
            var enteredUsername = document.getElementById('adminUsername').value;
            var enteredPassword = document.getElementById('adminPassword').value;

            if (enteredUsername === 'psv@01' && enteredPassword === 'psv@01') {
                isAdminLoggedIn = true;
                showAdminPage();
            } else {
                alert('Invalid username or password. Please try again.');
            }
        }

        function logout() {
            isAdminLoggedIn = false;
            showAdminPage();
            document.getElementById('loginPage').style.display = 'none';
        }

        function filterLeaveRequests() {
            var filterEmpIdValue = document.getElementById('filterEmpId').value.toLowerCase();
            var filterMonthValue = document.getElementById('filterMonth').value;

            var filteredLeaveData = leaveData.filter(function (data) {
                var empIdMatch = data.employeeId.toLowerCase().includes(filterEmpIdValue);
                var monthMatch = filterMonthValue === '' || (new Date(data.date).toISOString().slice(0, 7) === filterMonthValue);

                return empIdMatch && monthMatch;
            });

            populateAdminTable(filteredLeaveData);
            populateLeaveTable(filteredLeaveData);
        }
    </script>

</body>

</html>

@endsection
