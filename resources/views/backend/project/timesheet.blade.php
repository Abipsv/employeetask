@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<!-- Body: Body -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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
        #leaveType {
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
     
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        /* Add a media query for mobile devices */
        @media only screen and (max-width: 600px) {
            body {
                font-size: 14px;
            }

            .popup-form {
                width: 90%;
                max-width: 100%;
            }

            table {
                font-size: 12px;
                overflow-x: auto;
            display: block;
            }
        }

        /* Added button styles */
        .edit-button {
            background-color: #4caf50; 
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
            /* Green */
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

        .email-button {
            background-color: #2196f3; /* Blue */
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
        #loginForm {
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
</head>

<body>
    <div class="login-form" id="loginForm">
        <h2>Login</h2>
        <form>
            <label for="username">Username:</label>
            <input type="text" id="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" required><br>

            <button type="button" class="lea" onclick="login()">Login</button>
        </form>
    </div>
    <div id="taskSection" style="display: none;">
    <div class="popup-form" id="taskForm">
        <h2>Add Task</h2>
        <form id="taskForm">
            <label for="employeeId">Employee ID:</label>
            <input type="text" id="employeeId" required><br>

            <label for="projectName">Project Name:</label>
            <input type="text" id="projectName" required><br>

            <label for="projectDescription">Project Description:</label>
            <textarea id="projectDescription" required></textarea><br>

            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" required><br>

            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" required><br>

            <button type="button" class="lea" onclick="addTask()">Add Task</button>
        </form>
    </div>

    <div class="overlay" id="overlay"></div>

    <button class="lea" onclick="showTaskForm()">Add Task</button>
    <button class="lea" onclick="sendAllData()">Send All</button>

    <table id="taskTable">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Project Name</th>
                <th>Project Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Hours</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Task rows will be added here dynamically -->
        </tbody>
    </table>

    <script>

function login() {
            // Add your login validation logic here
            // For simplicity, let's assume a hardcoded username and password
            const usernameInput = document.getElementById('username').value;
            const passwordInput = document.getElementById('password').value;

            if (usernameInput === 'time888' && passwordInput === 'psv888') {
                document.getElementById('loginForm').style.display = 'none';
                document.getElementById('taskSection').style.display = 'block';
            } else {
                alert('Invalid credentials. Please try again.');
            }
        }
    
        function calculateTotalHours(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);

            const workHoursPerDay = 8;
            const millisecondsInHour = 1000 * 60 * 60;

            let totalHours = 0;
            let currentDate = new Date(start);

            while (currentDate <= end) {
                if (currentDate.getDay() !== 0 && currentDate.getDay() !== 6) {
                    totalHours += workHoursPerDay;
                }

                currentDate = new Date(currentDate.getTime() + 24 * millisecondsInHour);
            }

            return totalHours;
        }

        function showTaskForm() {
            document.getElementById('taskForm').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function addTask() {
            const employeeId = document.getElementById('employeeId').value;
            const projectName = document.getElementById('projectName').value;
            const projectDescription = document.getElementById('projectDescription').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            const totalHours = calculateTotalHours(startDate, endDate);

            const table = document.getElementById('taskTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow(table.rows.length);
            const cells = [
                employeeId,
                projectName,
                projectDescription,
                startDate,
                endDate,
                totalHours,
                '<button class="edit-button" onclick="editTask(this)">Edit</button>' +
                '<button class="delete-button" onclick="deleteTask(this)">Delete</button>' +
                '<button class="email-button" onclick="sendViaEmail(this)">Send via Email</button>'
            ];

            for (let i = 0; i < cells.length; i++) {
                const cell = newRow.insertCell(i);
                cell.innerHTML = cells[i];
            }

            saveToLocalStorage();

            document.getElementById('taskForm').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function saveToLocalStorage() {
            const rows = document.getElementById('taskTable').rows;
            const tasks = [];

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].cells;

                const task = {
                    employeeId: cells[0].textContent,
                    projectName: cells[1].textContent,
                    projectDescription: cells[2].textContent,
                    startDate: cells[3].textContent,
                    endDate: cells[4].textContent,
                    timePeriod: cells[5].textContent,
                };

                tasks.push(task);
            }

            localStorage.setItem('tasks', JSON.stringify(tasks));
        }

        window.onload = function () {
            const savedTasks = localStorage.getItem('tasks');

            if (savedTasks) {
                const tasks = JSON.parse(savedTasks);
                const table = document.getElementById('taskTable').getElementsByTagName('tbody')[0];

                tasks.forEach(task => {
                    const newRow = table.insertRow(table.rows.length);
                    const cells = [
                        task.employeeId,
                        task.projectName,
                        task.projectDescription,
                        task.startDate,
                        task.endDate,
                        task.timePeriod,
                        '<button class="edit-button" onclick="editTask(this)">Edit</button>' +
                        '<button class="delete-button" onclick="deleteTask(this)">Delete</button>' +
                        '<button class="email-button" onclick="sendViaEmail(this)">Send via Email</button>'
                    ];

                    for (let i = 0; i < cells.length; i++) {
                        const cell = newRow.insertCell(i);
                        cell.innerHTML = cells[i];
                    }
                });
            }
        };

    
        function sendAllData() {
        const rows = document.getElementById('taskTable').rows;
    
        let emailBody = 'Task Information:\n\n';
    
        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].cells;
    
            const taskInfo = `Employee ID: ${cells[0].textContent}\n` +
                             `Project Name: ${cells[1].textContent}\n` +
                             `Project Description: ${cells[2].textContent}\n` +
                             `Start Date: ${cells[3].textContent}\n` +
                             `End Date: ${cells[4].textContent}\n` +
                             `Time Period: ${cells[5].textContent} days\n\n`;
    
            emailBody += taskInfo;
        }
    
        const emailSubject = 'All Tasks Information';
        const mailtoLink = `mailto:?subject=${encodeURIComponent(emailSubject)}&body=${encodeURIComponent(emailBody)}`;
    
        // Open the default email client with the data pre-filled for all rows
        window.location.href = mailtoLink;
    }
    
    
        function editTask(button) {
            const row = button.closest('tr');
            const cells = row.cells;
    
            document.getElementById('employeeId').value = cells[0].textContent;
            document.getElementById('projectName').value = cells[1].textContent;
            document.getElementById('projectDescription').value = cells[2].textContent;
            document.getElementById('startDate').value = cells[3].textContent;
            document.getElementById('endDate').value = cells[4].textContent;
    
            document.getElementById('taskForm').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
    
            row.remove();
        }
    
        function deleteTask(button) {
            button.closest('tr').remove();
            saveToLocalStorage();
        }
    
        function sendViaEmail(button) {
            const row = button.closest('tr');
            const cells = row.cells;
    
            const emailData = {
                employeeId: cells[0].textContent,
                projectName: cells[1].textContent,
                projectDescription: cells[2].textContent,
                startDate: cells[3].textContent,
                endDate: cells[4].textContent,
                timePeriod: cells[5].textContent,
            };
    
            console.log('Sending email with data:', emailData);
    
            // Simulate sending an email - replace the following line with your email sending logic
            sendEmailViaGmail(emailData);
        }
    
        function sendEmailViaGmail(data) {
            const emailSubject = 'Task Information';
            const emailBody = `Employee ID: ${data.employeeId}\n` +
                               `Project Name: ${data.projectName}\n` +
                               `Project Description: ${data.projectDescription}\n` +
                               `Start Date: ${data.startDate}\n` +
                               `End Date: ${data.endDate}\n` +
                               `Time Period: ${data.timePeriod} days`;
    
            const mailtoLink = `mailto:?subject=${encodeURIComponent(emailSubject)}&body=${encodeURIComponent(emailBody)}`;
    
            // Open the default email client with the data pre-filled
            window.location.href = mailtoLink;
        }
    </script>
    
    </body>
    </html>
    
@endsection
