@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<!-- Body: Body -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Termination Report</title>
    <style>
        

        
            header {
      background-color: midnightblue;
      color: #fff;
      padding: 1em;
      text-align: center;
    }

    section {
     
      background-color: #fff;
      box-shadow: 0 0 10px midnightblue;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
   
      text-align: left;
    }

    th {
      background-color: midnightblue;
      color: #fff;
    }

    button {
  
      background-color: midnightblue;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: midnightblue;
    }


        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 300px;
            margin: 0 auto;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: midnightblue;
            color: #fff;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
        }

        #terminationPage {
            display: none;
        }
            input, textarea, #status{
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                box-sizing: border-box; /* Include padding and border in the element's total width and height */
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            label {
               /* Make labels appear on a new line */
                margin-bottom: 5px;
                color: #333; /* Text color */
                font-weight: bold; /* Bold text */
            }
    
            .popup button {
                margin-top: 10px;
                background: rgb(35, 35, 139);
                color: white;
                border: none;
                padding: 10px;
                width: 100px;
                border-radius: 10px;
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

        th, td {
            border: 1px solid #ddd;
         
            text-align: left;
        }

        th {
            background-color: midnightblue;
            color: #fff;
        }

        button {
            padding: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            margin-right: 5px;
        }

        button.edit {
            background-color: green;
            color: #fff;
        }

        button.send {
            background-color: rgb(35, 35, 139);
            color: #fff;
        }

        button.delete {
            background-color: red;
            color: #fff;
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

        .edit {
            cursor: pointer;
            margin-right: 10px;
            color: green; /* Blue */
        }

        .reason {
            background-color: #FAD02E; /* Set background color for Reason cell */
        }

        #terminationPage {
            display: none;
        }
        .but{
            width: 250px;
            margin: 10px;
        }
        #loginForm{
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <form id="loginForm">
        <label for="username">Username:</label>
        <input type="text" id="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" required>
        <button type="button" onclick="authenticateUser()">Login</button>
    </form>
    
<section id="terminationPage">
<header>
    <h1>Employee Termination Report</h1>
</header>
<br>
<section>
    <button class="but" onclick="openPopup()">Add Termination</button>
    <div id="overlay"></div>
    <table id="terminationTable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Joining Date</th>
            <th>Termination Date</th>
            <th>Reason</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <!-- Termination records will be loaded here dynamically on page load -->
        </tbody>
    </table>

</section>

<!-- Popup Form -->
<div id="popupForm" style="display: none;">
    <form id="terminationForm" onsubmit="addTermination(); return false;">
        <label for="id">Employee ID:</label>
        <input type="text" id="id" required><br>
        <label for="name">Employee Name:</label>
        <input type="text" id="name" required><br>
        <label for="joiningDate">Joining Date:</label>
        <input type="date" id="joiningDate" placeholder="YYYY-MM-DD" required><br>
        <label for="terminationDate">Termination Date:</label>
        <input type="date" id="terminationDate" placeholder="YYYY-MM-DD" required><br>
        <label for="reason">Termination Reason:</label>
        <input type="text" id="reason" required><br>
        <button type="submit">Add Termination</button>
    </form>
</div>
</section>
<script>
  const validUsername = "termination444";
    const validPassword = "psv444";

    function authenticateUser() {
        const enteredUsername = document.getElementById("username").value;
        const enteredPassword = document.getElementById("password").value;

        // Check if the entered credentials are valid
        if (enteredUsername === validUsername && enteredPassword === validPassword) {
            // If valid, show the termination page and hide the login form
            document.getElementById("loginForm").style.display = "none";
            document.getElementById("terminationPage").style.display = "block";
        } else {
            // If invalid, display an alert
            alert("Invalid username or password. Please try again.");
        }
    }
    
    // Load saved terminations on page load
    window.onload = function () {
        loadTerminations();
    };

    function openPopup() {
        document.getElementById("popupForm").style.display = "block";
    }

    function addTermination() {
        var id = document.getElementById("id").value;
        var name = document.getElementById("name").value;
        var joiningDate = document.getElementById("joiningDate").value;
        var terminationDate = document.getElementById("terminationDate").value;
        var reason = document.getElementById("reason").value;

        if (id && name && joiningDate && terminationDate && reason) {
            var table = document.getElementById("terminationTable").getElementsByTagName('tbody')[0];

            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);

            cell1.innerHTML = id;
            cell2.innerHTML = name;
            cell3.innerHTML = joiningDate;
            cell4.innerHTML = terminationDate;
            cell5.innerHTML = reason;
            cell5.classList.add('reason'); // Add 'reason' class for styling
            cell6.innerHTML = `<button class="edit" onclick="editTermination(${table.rows.length - 1})">Edit</button>
                           <button class="send" onclick="sendReportForRow(${table.rows.length - 1})">Send</button>
                           <button class="delete" onclick="deleteTermination(${table.rows.length - 1})">Delete</button>`;

            // Save the termination data to local storage
            saveTermination(id, name, joiningDate, terminationDate, reason);

            // Close the popup form
            document.getElementById("popupForm").style.display = "none";
        } else {
            alert("Please provide all details.");
        }
    }

    function editTermination(rowIndex) {
        var table = document.getElementById("terminationTable").getElementsByTagName('tbody')[0];

        document.getElementById("id").value = table.rows[rowIndex].cells[0].innerHTML;
        document.getElementById("name").value = table.rows[rowIndex].cells[1].innerHTML;
        document.getElementById("joiningDate").value = table.rows[rowIndex].cells[2].innerHTML;
        document.getElementById("terminationDate").value = table.rows[rowIndex].cells[3].innerHTML;
        document.getElementById("reason").value = table.rows[rowIndex].cells[4].innerHTML;

        // Remove the row from the table
        table.deleteRow(rowIndex);

        // Show the popup form for editing
        openPopup();
    }

    function deleteTermination(rowIndex) {
        var table = document.getElementById("terminationTable").getElementsByTagName('tbody')[0];

        // Remove the row from the table
        table.deleteRow(rowIndex);

        // Remove the termination data from local storage
        removeTerminationFromStorage(rowIndex);
    }

    function loadTerminations() {
        var table = document.getElementById("terminationTable").getElementsByTagName('tbody')[0];

        // Retrieve terminations from local storage
        var terminations = JSON.parse(localStorage.getItem("terminations")) || [];

        // Populate the table with saved terminations
        for (var i = 0; i < terminations.length; i++) {
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);

            cell1.innerHTML = terminations[i].id;
            cell2.innerHTML = terminations[i].name;
            cell3.innerHTML = terminations[i].joiningDate;
            cell4.innerHTML = terminations[i].terminationDate;
            cell5.innerHTML = terminations[i].reason;
            cell5.classList.add('reason'); // Add 'reason' class for styling
            cell6.innerHTML = `<button class="edit" onclick="editTermination(${table.rows.length - 1})">Edit</button>
                           <button class="send" onclick="sendReportForRow(${table.rows.length - 1})">Send</button>
                           <button class="delete" onclick="deleteTermination(${table.rows.length - 1})">Delete</button>`;
        }
    }

    function saveTermination(id, name, joiningDate, terminationDate, reason) {
        // Retrieve existing terminations or initialize an empty array
        var terminations = JSON.parse(localStorage.getItem("terminations")) || [];

        // Add the new termination to the array
        terminations.push({
            id: id,
            name: name,
            joiningDate: joiningDate,
            terminationDate: terminationDate,
            reason: reason
        });

        // Save the updated array to local storage
        localStorage.setItem("terminations", JSON.stringify(terminations));
    }

    function removeTerminationFromStorage(rowIndex) {
        // Retrieve existing terminations
        var terminations = JSON.parse(localStorage.getItem("terminations")) || [];

        // Remove the termination data for the specified index
        terminations.splice(rowIndex, 1);

        // Save the updated array to local storage
        localStorage.setItem("terminations", JSON.stringify(terminations));
    }

    function sendReport() {
        // Placeholder for sending email
        var subject = "Employee Termination Report";
        var body = "Dear Employee,\n\nyou are terminated from our company.\n\n";
        body += "Your Termination Details:\n\n";

        var table = document.getElementById("terminationTable").getElementsByTagName('tbody')[0];

        for (var i = 0; i < table.rows.length; i++) {
            body += "ID: " + table.rows[i].cells[0].innerHTML + "\n";
            body += "Name: " + table.rows[i].cells[1].innerHTML + "\n";
            body += "Joining Date: " + table.rows[i].cells[2].innerHTML + "\n";
            body += "Termination Date: " + table.rows[i].cells[3].innerHTML + "\n";
            body += "Reason: " + table.rows[i].cells[4].innerHTML + "\n\n";
            body += "Thank You and All the best\n\n";
        }

        var mailtoLink = "mailto:?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);
        window.location.href = mailtoLink;
    }

    function sendReportForRow(rowIndex) {
        var subject = "Employee Termination Report";
        var body = "Dear Employee,\n\nyou are terminated from our company.\n\n";
        body += "Your Termination Details:\n\n";

        var table = document.getElementById("terminationTable").getElementsByTagName('tbody')[0];

        body += "ID: " + table.rows[rowIndex].cells[0].innerHTML + "\n";
        body += "Name: " + table.rows[rowIndex].cells[1].innerHTML + "\n";
        body += "Joining Date: " + table.rows[rowIndex].cells[2].innerHTML + "\n";
        body += "Termination Date: " + table.rows[rowIndex].cells[3].innerHTML + "\n";
        body += "Reason: " + table.rows[rowIndex].cells[4].innerHTML + "\n\n";
        body += "Thank You and All the best\n\n";

        var mailtoLink = "mailto:?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);
        window.location.href = mailtoLink;
    }
</script>

</body>
</html>

@endsection
