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
        .lea {
                background-color: midnightblue;
                color: white;
                border-style: none;
                border-color: none;
                padding: 10px;
                border-radius: 3px;
            }
        #popupForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1;
            width: 400px;
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
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 10px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
        #status {
            /* Add default styles for the dropdown */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-weight: 700;
            
        }
        /* Add styles for status colors */
        #status-paid {
            background-color: #28a745;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
        }

        #status-pending {
            text-align: center;
            justify-content: center;
            font-size: 15px;
            color:black;
            background-color:coral;
            font-weight: 800; /* Red for 'Pending' */
        }
       
        .input area {
            background-color: #ddd;
        }
        #loginForm lable{
            color: black;
            font-weight: 800; 

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

    
        @media (max-width: 600px) {
            /* Adjust styles for smaller screens */
            .container {
                padding: 10px;
            }

            table {
                margin-top: 10px;
            }

            th, td {
                padding: 5px;
            }
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

        #loginForm label {
            font-size: 20px; /* Adjust the label font size as needed */
        }
    </style>
    <title>Payment System</title>
</head>
<body>
    <div id="loginForm" style="text-align: center; margin-top: 100px;">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" required><br>
        <button class="lea" onclick="login()">Login</button>
        <p id="loginMessage" style="color: red; margin-top: 10px;"></p>
    </div>
    
    <!-- Payment Section (Initially hidden) -->
    <div id="paymentSection" style="display: none;">
<!-- Payment Button -->
<button class="btn btn-primary" onclick="openPopupForm()">Add Payment</button>

<!-- Popup Form -->
<div id="popupForm">
    <h2>Payment Details</h2>
    <form id="paymentForm">
        <label for="projectName">Project Name:</label>
        <input type="text" id="projectName" required><br>

        <label for="clientName">Client Name:</label>
        <input type="text" id="clientName" required><br>

        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" required><br>

        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" required><br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" required><br>

        <label for="status">Status:</label>
        <select id="status" required>
            <option value="paid" class="status-option-paid">Paid</option>
            <option value="pending" class="status-option-pending">Pending</option>
        </select><br>

        <button type="button" class="btn btn-primary" onclick="savePayment()">Save</button>
        <button type="button" class="btn btn-danger" onclick="closePopupForm()">Cancel</button>
    </form>
</div>

<!-- Payment Table -->
<table id="paymentTable">
    <tr>
        <th>Project Name</th>
        <th>Client Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <!-- Table rows will be dynamically added here -->
</table>
<script>
    let payments = [];

    function openPopupForm() {
        document.getElementById('popupForm').style.display = 'block';
    }

    function closePopupForm() {
        document.getElementById('popupForm').style.display = 'none';
    }

    function savePayment() {
        const projectName = document.getElementById('projectName').value;
        const clientName = document.getElementById('clientName').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const amount = document.getElementById('amount').value;
        const status = document.getElementById('status').value;

        const payment = {
            projectName,
            clientName,
            startDate,
            endDate,
            amount,
            status
        };

        payments.push(payment);

        // Save to localStorage
        localStorage.setItem('payments', JSON.stringify(payments));

        refreshTable();

        closePopupForm();
    }

    function refreshTable() {
        const table = document.getElementById('paymentTable');
        table.innerHTML = '<tr><th>Project Name</th><th>Client Name</th><th>Start Date</th><th>End Date</th><th>Amount</th><th>Status</th><th>Action</th></tr>';

        payments.forEach(payment => {
            const row = table.insertRow();
            row.insertCell(0).textContent = payment.projectName;
            row.insertCell(1).textContent = payment.clientName;
            row.insertCell(2).textContent = payment.startDate;
            row.insertCell(3).textContent = payment.endDate;
            row.insertCell(4).textContent = payment.amount;
            row.insertCell(5).textContent = payment.status;

            const actionCell = row.insertCell(6);

            // Edit button
            const editButton = document.createElement('button');
            editButton.textContent = 'Edit';
            editButton.classList.add('btn', 'btn-primary');
            editButton.onclick = function() {
                editPayment(payments.indexOf(payment));
            };
            actionCell.appendChild(editButton);

            // Delete button
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.classList.add('btn', 'btn-danger');
            deleteButton.onclick = function() {
                deletePayment(payments.indexOf(payment));
            };
            actionCell.appendChild(deleteButton);
        });
    }
    function login() {
        const enteredUsername = document.getElementById('username').value;
        const enteredPassword = document.getElementById('password').value;
        const loginMessage = document.getElementById('loginMessage');
        const loginForm = document.getElementById('loginForm');
        const paymentSection = document.getElementById('paymentSection');

        // Replace these credentials with your actual username and password
        const correctUsername = 'payment222';
        const correctPassword = 'psv222';

        if (enteredUsername === correctUsername && enteredPassword === correctPassword) {
            // Show the payment section and hide the login form
            loginForm.style.display = 'none';
            paymentSection.style.display = 'block';
        } else {
            // Display an error message for incorrect credentials
            loginMessage.textContent = 'Invalid username or password';
        }
    }
    function editPayment(index) {
        const payment = payments[index];

        document.getElementById('projectName').value = payment.projectName;
        document.getElementById('clientName').value = payment.clientName;
        document.getElementById('startDate').value = payment.startDate;
        document.getElementById('endDate').value = payment.endDate;
        document.getElementById('amount').value = payment.amount;
        document.getElementById('status').value = payment.status;

        payments.splice(index, 1);

        refreshTable();

        openPopupForm();
    }

    function deletePayment(index) {
        payments.splice(index, 1);

        // Save to localStorage after deletion
        localStorage.setItem('payments', JSON.stringify(payments));

        refreshTable();
    }

    // Load existing data from localStorage on page load
    const storedPayments = localStorage.getItem('payments');
    if (storedPayments) {
        payments = JSON.parse(storedPayments);
        refreshTable();
    }  const statusDropdown = document.getElementById('status');
    const tableStatusCell = document.getElementById('status-table-cell'); // Update with the actual ID of your status table cell

    // Initial call to set the color for the default selected option
    updateTextColor();

    // Event listener to update the color when the selection changes
    statusDropdown.addEventListener('change', updateTextColor);

    function updateTextColor() {
        const selectedOption = statusDropdown.options[statusDropdown.selectedIndex];
        const textColorClass = selectedOption.classList[0]; // Assumes only one class is present

        // Apply the text color class to the selected option
        statusDropdown.className = textColorClass;

        // Update the text color of the corresponding table cell
        tableStatusCell.classList = [textColorClass];
    }
</script>

</body>
</html>

   
@endsection
