@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management</title>
</head>

<style>
    a {
    text-decoration: none;
}
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
    }

    .container {
       
      
        background-color: #fff;
      
        border-radius: 8px;
      
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    button {
        background-color:  rgb(35, 35, 139);
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .button-primary {
        background-color: rgb(35, 35, 139);
    }

    .form-popup {
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

    form {
        max-width: 400px;
        margin: 0 auto;
    }

    form label {
        display: block;
        margin-bottom: 8px;
    }

    form input,
    form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    form button {
        background-color: rgb(35, 35, 139);
        color: white;
        border: none;
        padding: 10px;
        width: 100%;
        border-radius: 4px;
        cursor: pointer;
    }

    form button[type="button"] {
        background-color: #f44336;
    }

    .filter-btn {
        margin-top: 10px;
    }
    .sep{
        background-color:  rgb(35, 35, 139);
        padding: 10px;
        border: none;
        color:white;
        border-radius: 5px;
    }
    .dele{
        background-color: red;
    }
    #loginContainer{
    background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            max-width: 300px;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
    }
</style>

<body>
    <div id="loginContainer" class="container">
        <h2>Login</h2>
        <form id="loginForm">
            <label for="username">Username:</label>
            <input type="text" id="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" required>
            <button type="button" onclick="login()">Login</button>
        </form>
    </div>
<div id="attendanceContainer" class="container" style="display: none;">
    <div class="container" id="att">
        <h2>Attendance Management (Admin)</h2>
        <div>
            <button id="addRecordBtn" onclick="openForm()">Add Attendance Record</button>
            <button class="filter-btn" onclick="filterRecords('All')">All</button>
            <button class="filter-btn" onclick="filterRecords('Present')">Present</button>
            <button class="filter-btn" onclick="filterRecords('Absent')">Absent</button><br><hr>
            <label for="employeeIDFilter">Employee ID:</label>
<input type="text" id="employeeIDFilter"class="sep" placeholder="enter emp id">
<button class="filter-btn" onclick="filterRecordsByEmployeeID()">Filter by Employee ID</button>


        </div>
        <table id="attendanceTable">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="attendanceList"></tbody>
        </table>
    </div>

    <!-- Form for adding/editing records -->
    <div class="form-popup" id="attendanceForm">
        <form id="recordForm" onsubmit="saveRecord(); return false;">
            <h2>Add Attendance Record</h2>
            <label for="studentID">Employee ID:</label>
            <input type="text" id="studentID" required>
            <label for="date">Date:</label>
            <input type="date" id="date" required>
            <label for="status">Status:</label>
            <select id="status" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="HalfDayPresent">Half Day Present</option>
            </select>
            <button type="submit">Save</button>
            <button type="button" onclick="closeForm()">Close</button>
        </form>
    </div>

    <script>

        // Add this at the beginning of your existing script
        var isLoggedIn = false;

function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    // Replace this with your actual authentication logic
    if (username === "psvmember" && password === "psv@111") {
        isLoggedIn = true;
        document.getElementById("loginContainer").style.display = "none";
        document.getElementById("attendanceContainer").style.display = "block";
        displayAttendancePage();
    } else {
        alert("Invalid username or password");
    }
}

function displayAttendancePage() {
    if (isLoggedIn) {
        // Initialize the attendance-related functionalities
        displayRecords();
    }
}


        let attendanceRecords = JSON.parse(localStorage.getItem("attendanceRecords")) || [];

        function openForm() {
            document.getElementById("attendanceForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("attendanceForm").style.display = "none";
            clearForm();
        }

        function saveRecord() {
            const studentID = document.getElementById("studentID").value;
            const date = document.getElementById("date").value;
            const status = document.getElementById("status").value;

            if (!studentID || !date || !status) {
                alert("Please fill in all fields.");
                return;
            }

            const record = {
                studentID,
                date,
                status
            };

            // Check if record already exists for the given date and student ID
            const existingRecordIndex = attendanceRecords.findIndex(
                (r) => r.studentID === studentID && r.date === date
            );

            if (existingRecordIndex !== -1) {
                // Update existing record
                attendanceRecords[existingRecordIndex] = record;
            } else {
                // Add new record
                attendanceRecords.push(record);
            }

            // Save records to localStorage
            localStorage.setItem("attendanceRecords", JSON.stringify(attendanceRecords));

            displayRecords();
            closeForm();
            clearForm();
        }

        function deleteRecord(index) {
    attendanceRecords.splice(index, 1);
    // Save records to localStorage
    localStorage.setItem("attendanceRecords", JSON.stringify(attendanceRecords));
    // Reload the page to reflect the changes
    location.reload();
}

        function filterRecords(filter) {
            let filteredRecords = [];

            if (filter === "All") {
                filteredRecords = attendanceRecords;
            } else {
                filteredRecords = attendanceRecords.filter(record => record.status === filter);
            }

            displayRecords(filteredRecords);
        }
       
        function filterRecordsByEmployeeID() {
    const employeeIDFilter = document.getElementById("employeeIDFilter").value.trim();

    if (!employeeIDFilter) {
        alert("Please enter an employee ID.");
        return;
    }

    const filteredRecords = attendanceRecords.filter(record => record.studentID === employeeIDFilter);
    displayRecords(filteredRecords);
}


        function displayRecords(records) {
            const tableBody = document.getElementById("attendanceList");

            // Clear existing rows
            while (tableBody.firstChild) {
                tableBody.removeChild(tableBody.firstChild);
            }

            // Add new rows
            (records || attendanceRecords).forEach((record, index) => {
                const row = tableBody.insertRow(index);

                const studentIDCell = row.insertCell(0);
                studentIDCell.textContent = record.studentID;

                const dateCell = row.insertCell(1);
                dateCell.textContent = record.date;

                const statusCell = row.insertCell(2);
                statusCell.textContent = record.status;

                const actionsCell = row.insertCell(3);
                actionsCell.innerHTML = `
                    <button onclick="editRecord(${index})">Edit</button>
                    <button class="dele" onclick="deleteRecord(${index})">Delete</button>
                `;
            });
        }

        function editRecord(index) {
            const record = attendanceRecords[index];
            document.getElementById("studentID").value = record.studentID;
            document.getElementById("date").value = record.date;
            document.getElementById("status").value = record.status;
            openForm();
        }

        function clearForm() {
            document.getElementById("studentID").value = "";
            document.getElementById("date").value = "";
            document.getElementById("status").value = "Present";
        }

        // Initial display
        displayRecords();

    </script>
</body>

</html>

@endsection