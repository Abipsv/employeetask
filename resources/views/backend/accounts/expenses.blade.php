@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* ... (styles remain the same) ... */
    </style>
    <title>Expense Tracker</title>
</head>
<body>
    <div id="loginContainer">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" required>
    
        <label for="password">Password:</label>
        <input type="password" id="password" required>
    
        <button onclick="login()">Login</button>
        <p id="loginMessage"></p>
    </div>
    <div id="expenseContainer">

    <button class="lea" onclick="openExpenseForm()">Add Expense</button>

    <!-- Expense Form Popup -->
    <div id="expenseFormPopup" style="display: none;">
        <h2 id="formTitle">Add Expense</h2>
        <form id="expenseForm">
            <label for="expenseId">Expense ID:</label>
            <input type="text" id="expenseId" required><br>

            <label for="item">Item:</label>
            <input type="text" id="item" required><br>

            <label for="date">Date:</label>
            <input type="date" id="date" required><br>

            <label for="orderBy">Order By:</label>
            <input type="text" id="orderBy" required><br>

            <label for="status">Status:</label>
            <select id="status" required>
                <option value="in-process" class="status-in-process">In Process</option>
                <option value="completed" class="status-completed">Completed</option>
            </select><br>

            <button class="lea" type="button" onclick="saveExpense()">Save</button>
            <button class="lea" type="button" onclick="closeExpenseForm()">Cancel</button>
        </form>
    </div>

    <!-- Expense Table -->
    <table id="expenseTable">
        <tr>
            <th>Expense ID</th>
            <th>Item</th>
            <th>Date</th>
            <th>Order By</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </table>

</div>

<script>

const validCredentials = { username: 'expense000', password: 'psv000' };

function login() {
    const usernameInput = document.getElementById('username').value;
    const passwordInput = document.getElementById('password').value;
    const loginMessage = document.getElementById('loginMessage');
    const loginContainer = document.getElementById('loginContainer');
    const expenseContainer = document.getElementById('expenseContainer');

    if (usernameInput === validCredentials.username && passwordInput === validCredentials.password) {
        // Show the expense container and hide the login container
        loginContainer.style.display = 'none';
        expenseContainer.style.display = 'block';
    } else {
        loginMessage.textContent = 'Invalid username or password';
    }
}
    const expenseFormPopup = document.getElementById('expenseFormPopup');
    const expenseForm = document.getElementById('expenseForm');
    const expenseTable = document.getElementById('expenseTable');
    let editingIndex = -1; // Initialize as -1 for new expense

    // Retrieve expenses from local storage on page load
    const expenses = JSON.parse(localStorage.getItem('expenses')) || [];

    // Populate the table with existing expenses
    renderExpenseTable();

    function openExpenseForm() {
        expenseForm.reset(); // Clear the form
        editingIndex = -1; // Reset editing index
        document.getElementById('formTitle').textContent = 'Add Expense';
        expenseFormPopup.style.display = 'block';
    }

    function closeExpenseForm() {
        expenseFormPopup.style.display = 'none';
    }

    function saveExpense() {
        const expenseId = document.getElementById('expenseId').value;
        const item = document.getElementById('item').value;
        const date = document.getElementById('date').value;
        const orderBy = document.getElementById('orderBy').value;
        const status = document.getElementById('status').value;

        const newExpense = {
            expenseId,
            item,
            date,
            orderBy,
            status,
        };

        if (editingIndex !== -1) {
            // Editing an existing expense
            expenses[editingIndex] = newExpense;
        } else {
            // Adding a new expense
            expenses.push(newExpense);
        }

        localStorage.setItem('expenses', JSON.stringify(expenses));

        renderExpenseTable();
        closeExpenseForm();
    }

    function deleteExpense(index) {
        expenses.splice(index, 1);
        localStorage.setItem('expenses', JSON.stringify(expenses));
        renderExpenseTable();
    }

    function editExpense(index) {
        const expense = expenses[index];
        document.getElementById('expenseId').value = expense.expenseId;
        document.getElementById('item').value = expense.item;
        document.getElementById('date').value = expense.date;
        document.getElementById('orderBy').value = expense.orderBy;
        document.getElementById('status').value = expense.status;

        editingIndex = index;
        document.getElementById('formTitle').textContent = 'Edit Expense';
        expenseFormPopup.style.display = 'block';
    }

    function renderExpenseTable() {
        // Clear existing rows
        while (expenseTable.rows.length > 1) {
            expenseTable.deleteRow(1);
        }

        // Populate the table with expenses
        expenses.forEach((expense, index) => {
            const row = expenseTable.insertRow(-1);
            row.insertCell(0).textContent = expense.expenseId;
            row.insertCell(1).textContent = expense.item;
            row.insertCell(2).textContent = expense.date;
            row.insertCell(3).textContent = expense.orderBy;
            const statusCell = row.insertCell(4);
            statusCell.textContent = expense.status;
            statusCell.className = `status-${expense.status}`;

            const actionsCell = row.insertCell(5);
            const deleteButton = document.createElement('span');
            deleteButton.textContent = 'Delete';
            deleteButton.className = 'delete';
            deleteButton.onclick = () => deleteExpense(index);

            const editButton = document.createElement('span');
            editButton.textContent = 'Edit';
            editButton.className = 'edit';
            editButton.onclick = () => editExpense(index);

            actionsCell.appendChild(deleteButton);
            actionsCell.appendChild(editButton);
        });
    }
</script>
<style>
     
        

        #loginContainer {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            width: 300px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
        }
        #expenseContainer {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            display: none;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: midnightblue;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: navy;
        }

        #loginMessage {
            color: red;
            margin-top: 10px;
        }
     #expenseFormPopup {
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

      body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            
            margin: 0 auto;
            padding: 20px;
            overflow-y: auto; /* Enable vertical scrolling */
            max-height: 80vh; /* Set maximum height for scrolling */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .status-in-process {
          color: #cce5ff; /* Light blue */
           background-color:goldenrod; 
           font-weight: 800;/* Dark blue */
        }

        .status-completed {
            background-color: dodgerblue; /* Light green */
            color:black;
            font-weight: 800; /* Dark green */
        }

        .actions {
            display: flex;
        }

        .delete, .edit {
            cursor: pointer;
            margin-right: 10px;
            color: #007bff; /* Blue */
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
        .lea {
                background-color: midnightblue;
                color: white;
                border-style: none;
                border-color: none;
                padding: 10px;
                border-radius: 3px;
            }
        label {
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        /* ... Other styles remain the same ... */

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
        .delete, .edit {
            cursor: pointer;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition-duration: 0.4s;
        }

        .delete {
            background-color: #f44336; /* Red */
        }

        .edit {
            background-color: #4CAF50; /* Green */
        }

        .delete:hover, .edit:hover {
            background-color: #d32f2f; /* Darker Red for delete, Darker Green for edit */
        }
</style>
</body>
</html>



    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>

    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>

@endsection
