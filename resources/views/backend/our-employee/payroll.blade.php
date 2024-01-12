@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Slip</title>
    <style>
       /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }*/
        .container {
        }
        
        .header, .footer {
            background-color: #f2f2f2;
            padding: 10px;
        }
       
        .lable{
            color: black;
            font-weight: 800;
        }

        .options {
            text-align: center;
            margin-top: 10px;
        }
        button {
            padding: 8px 16px;
            margin-left: 10px;
        }
        address {
            margin-top: 10px;
        }
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fefefe;
            padding: 30px;
          margin: 20px;
            z-index: 1;
            width: 700px;
          
        }
        .modal-content {
            display: flex;
            flex-direction: column;
            margin: 20px;
        }
        .modal input {
            margin-bottom: 10px;
            margin: 20px;
        }
        input, textarea{
           
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
            margin-left: 20px;
            margin-right:20px;
        }
        .lea{
            background-color:midnightblue;
            color:white;
            border-style: none;
            border-color: none;
            padding: 10px;
            border-radius: 3px;
        }
        .lea1{
            background-color:midnightblue;
            color:white;
            border-style: none;
            border-color: none;
            padding: 10px;
            border-radius: 3px;
            width: 150px;
            display: block;
            margin-left: auto;
            margin-right: auto;

        }
        @media only screen and (max-width: 600px) {
    .modal {
        width: 90%; /* Adjust the width as needed for smaller screens */
        padding: 15px; /* Adjust padding for smaller screens */
        margin: 0;
       /* Remove margin for smaller screens */
    }
}
    </style>
        <style>
    @media print {
        body {
            font-family: Arial, sans-serif;
            text-align: center; /* Center align text in the printed page */
        }

        .container {
            border: 2px solid #3498db; /* Add a blue border to the container */
            padding: 10px;
            margin: 10px;
        }

        .header, .footer {
            background-color: #3498db; /* Set a blue background color for header and footer */
            color: #fff; /* Set white text color for header and footer */
            padding: 10px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .modal {
            width: 450px;
            border: 2px solid #e74c3c; /* Add a red border to the modal */
        }

        .content {
            padding: 20px;
        }

        .modal-content {
            text-align: center; /* Left-align text in the modal for print */
        }

        .header img {
            display: block;
            margin: 0 auto;
        }

        /* Add a logo to the header for print */
        .header-logo {
            content: url('public/images/xs/PSV LOGO.png');
            display: block;
            margin: 0 auto;
            width: 100px; /* Adjust the width as needed */
            height: auto;
        }
    }
#salarySlipListModal{
    list-style-type: square;
    font-weight: bold;
    font-size: 20px;
    text-align: justify;
    
}
#salarySlipListModalContent button {
            display: block;
            margin: 10px auto;
            padding: 10px;
            background-color: #3498db; /* Blue background color for buttons */
            color: #fff; /* White text color for buttons */
            border: none;
            border-radius: 3px;
            cursor: pointer;
}
#loginPage{
    background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            max-width: 300px;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 80px;
            text-align: center;
}
</style>
  
</head>
<body>
    <div class="container" id="loginPage">
        <h2>Login</h2>
        <form onsubmit="return loginUser()">
            <label for="username">Username:</label>
            <input type="text" id="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" required><br>

            <button type="submit" class="lea">Login</button>
        </form>
    </div>
    <div class="container" id="salarySlipPage" style="display: none;">

    <div class="header">
        <h2>Salary Slip</h2>

        <button onclick="openForm()" class="lea">Create New Salary Slip</button>
        <!-- Add a new button for the salary slip list -->
        <button onclick="openSalarySlipList()" class="lea">Salary Slip List</button>
        <p id="currentDate" style="font-size: 16px; margin-top: 5px;"></p>
    </div>
    <div class="content1">
        <!-- Display Salary Slip List -->
        <ul id="salarySlipList">
            <!-- Salary Slip entries will be dynamically added here -->
        </ul>
    </div>
    <div class="content">
        <div>
            <strong>From:</strong>
            <address id="fromAddress">
                <!-- From address will be dynamically filled -->
            </address>
        </div>

        <div>
            <strong>To:</strong>
            <address id="toAddress">
                <!-- To address will be dynamically filled -->
            </address>
        </div>

        <hr>

        <div>
            <h3>Employee Details</h3>
            <p><strong>Name:</strong> <span id="employeeName"></span></p>
            <p><strong>ID:</strong> <span id="employeeID"></span></p>
            <p><strong>Department:</strong> <span id="employeeDepartment"></span></p>
            <p><strong>Basic Salary:</strong> <span id="basicSalary"></span></p>
            <p><strong>Allowance:</strong> <span id="allowance"></span></p>
            <p><strong>Deduction:</strong> <span id="deduction"></span></p>
            <p><strong>Net Salary:</strong> <span id="netSalary"></span></p>
        </div>
    </div>

    <div class="options">
        <button onclick="edit()" class="lea">Edit</button>
        <button onclick="deleteEntry()"class="lea">Delete</button>
        <button onclick="print()"class="lea">Print</button>
        <button onclick="sendViaGmail()"class="lea">Send via Gmail</button>
    </div>

    <div class="footer">
        &copy; 2024 PSV Mediaa.com All rights reserved.
    </div>

    <!-- Modal for the salary slip form -->
    <div id="salarySlipForm" class="modal">
        <div class="modal-content">
            <label for="fromAddressInput">From Address:</label>
            <input type="text" id="fromAddressInput">

            <label for="toAddressInput">To Address:</label>
            <input type="text" id="toAddressInput">

            <label for="employeeNameInput">Employee Name:</label>
            <input type="text" id="employeeNameInput">

            <label for="employeeIDInput">Employee ID:</label>
            <input type="text" id="employeeIDInput">

            <label for="employeeDepartmentInput">Department:</label>
            <input type="text" id="employeeDepartmentInput">

            <label for="basicSalaryInput">Basic Salary:</label>
            <input type="text" id="basicSalaryInput">

            <label for="allowanceInput">Allowance:</label>
            <input type="text" id="allowanceInput">

            <label for="deductionInput">Deduction:</label>
            <input type="text" id="deductionInput">

            <label for="netSalaryInput">Net Salary:</label>
            <input type="text" id="netSalaryInput">
            <button onclick="deleteEntry()"class="lea1">Delete</button><br>
            <button onclick="createSalarySlip()"class="lea1">Create Salary Slip</button><br>
            <button onclick="closeForm()"class="lea1">Close</button><br>
        </div>
    </div>

    <!-- Modal for the salary slip list -->
    <div id="salarySlipListModal" class="modal">
        <div class="modal-content">
            <h3 style="text-align: center; color: midnightblue;">Salary Slip List</h3>
            <div id="salarySlipListModalContent">
                <!-- Salary Slip entries will be dynamically added here -->
            </div>
            <button onclick="closeSalarySlipList()" class="lea1">Close</button><br>
        </div>
    </div>

<script>
       function loginUser() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;

        // Check if the username and password match
        if (username === "salary333" && password === "psv333") {
            // If the credentials are correct, show the salary slip page
            document.getElementById('loginPage').style.display = 'none';
            document.getElementById('salarySlipPage').style.display = 'block';
            return false; // Prevent form submission
        } else {
            // If the credentials are incorrect, display an error message
            alert("Incorrect username or password. Please try again.");
            return false; // Prevent form submission
        }
    }

    function logout() {
        // Hide the salary slip page when logging out
        document.getElementById('loginPage').style.display = 'block';
        document.getElementById('salarySlipPage').style.display = 'none';
    }
    var salarySlips = JSON.parse(localStorage.getItem('salarySlips')) || [];

    function openForm() {
        document.getElementById('salarySlipForm').style.display = 'block';
    }

    function closeForm() {
        document.getElementById('salarySlipForm').style.display = 'none';
    }

    function openSalarySlipList() {
        updateSalarySlipListModal();
        document.getElementById('salarySlipListModal').style.display = 'block';
    }

    function closeSalarySlipList() {
        document.getElementById('salarySlipListModal').style.display = 'none';
    }

    function createSalarySlip() {
        var fromAddress = document.getElementById('fromAddressInput').value;
        var toAddress = document.getElementById('toAddressInput').value;
        var employeeName = document.getElementById('employeeNameInput').value;
        var employeeID = document.getElementById('employeeIDInput').value;
        var employeeDepartment = document.getElementById('employeeDepartmentInput').value;
        var basicSalary = document.getElementById('basicSalaryInput').value;
        var allowance = document.getElementById('allowanceInput').value;
        var deduction = document.getElementById('deductionInput').value;
        var netSalary = document.getElementById('netSalaryInput').value;

        var newSalarySlip = {
            fromAddress: fromAddress,
            toAddress: toAddress,
            employeeName: employeeName,
            employeeID: employeeID,
            employeeDepartment: employeeDepartment,
            basicSalary: basicSalary,
            allowance: allowance,
            deduction: deduction,
            netSalary: netSalary
        };

        salarySlips.push(newSalarySlip);

        localStorage.setItem('salarySlips', JSON.stringify(salarySlips));

        updateSalarySlipList();
        closeForm();
    }
    function updateSalarySlipList() {
        var listContainer = document.getElementById('salarySlipListModalContent');
        // Clear the existing list
        listContainer.innerHTML = '';

        // Populate the list with the latest salary slips as buttons
        salarySlips.forEach(function (salarySlip, index) {
            var button = document.createElement('button');
            button.innerHTML = salarySlip.employeeName;
            button.onclick = function () {
                viewSalarySlip(index);
                closeSalarySlipList(); // Optionally close the modal when a button is clicked
            };
            listContainer.appendChild(button);
        });
    }

    function closeSalarySlipList() {
        document.getElementById('salarySlipListModal').style.display = 'none';
    }

    function updateSalarySlipListModal() {
        var listContainer = document.getElementById('salarySlipListModalContent');
        listContainer.innerHTML = '';

        salarySlips.forEach(function (salarySlip, index) {
            var listItem = document.createElement('li');
            listItem.innerHTML = `<a href="#" onclick="viewSalarySlip(${index})">${salarySlip.employeeName}</a>`;
            listContainer.appendChild(listItem);
        });
    }

    function viewSalarySlip(index) {
        var selectedSalarySlip = salarySlips[index];
        document.getElementById('fromAddress').innerText = selectedSalarySlip.fromAddress;
        document.getElementById('toAddress').innerText = selectedSalarySlip.toAddress;
        document.getElementById('employeeName').innerText = selectedSalarySlip.employeeName;
        document.getElementById('employeeID').innerText = selectedSalarySlip.employeeID;
        document.getElementById('employeeDepartment').innerText = selectedSalarySlip.employeeDepartment;
        document.getElementById('basicSalary').innerText = selectedSalarySlip.basicSalary;
        document.getElementById('allowance').innerText = selectedSalarySlip.allowance;
        document.getElementById('deduction').innerText = selectedSalarySlip.deduction;
        document.getElementById('netSalary').innerText = selectedSalarySlip.netSalary;

        closeSalarySlipList();
    }

    function deleteEntry() {
        document.getElementById('fromAddress').innerText = '';
        document.getElementById('toAddress').innerText = '';
        document.getElementById('employeeName').innerText = '';
        document.getElementById('employeeID').innerText = '';
        document.getElementById('employeeDepartment').innerText = '';
        document.getElementById('basicSalary').innerText = '';
        document.getElementById('allowance').innerText = '';
        document.getElementById('deduction').innerText = '';
        document.getElementById('netSalary').innerText = '';
    }
    function print() {
       
        var currentDate = new Date();
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    var formattedDate = currentDate.toLocaleDateString('en-US', options);

    // Print only the necessary details
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>salary slip </title>');
    printWindow.document.write('<style>');
    printWindow.document.write('body { text-align: center; font-family: Arial, sans-serif; }');
    printWindow.document.write('.container { border: 1px solid #000; padding: 20px; margin: 20px; width: 80%; margin: 0 auto; }');
    printWindow.document.write('.header { background-color: #f2f2f2; padding: 10px; }');
    printWindow.document.write('.content { padding: 20px; }');
    printWindow.document.write('.footer { background-color: #f2f2f2; padding: 10px; }');
    printWindow.document.write('h2 { color: midnightblue; font-weight: bold; }');
    printWindow.document.write('h3 { color: #333; }');
    printWindow.document.write('p { color: #555; }');
    printWindow.document.write('address { color: #777; }');
    printWindow.document.write('.address-container { display: flex; justify-content: space-between; margin-bottom: 20px; }');
    printWindow.document.write('img { max-width: 10%; height: auto; margin-bottom: 20px; }');
    printWindow.document.write('</style></head><body>');

    printWindow.document.write('<div class="container">');
    printWindow.document.write('<div class="header">');

    printWindow.document.write('<h2 style="background-color:orange;">PSV Media</h2>');
    printWindow.document.write('<img class="avatar rounded-circle" src="{{ asset('/images/xs/PSV LOGO.png') }}" alt="">');
    printWindow.document.write('<h4 style="font-style: italic;">Innovate Web & Ads</h4>');
    printWindow.document.write('<h2>Employee Salary Slip</h2>');
    printWindow.document.write('<p id="currentDate" style="font-size: 16px; margin-top: 5px;"></p>');
    printWindow.document.write('</div>');
   
    printWindow.document.write('<div class="content">');
    printWindow.document.write('<div class="address-container">');
    printWindow.document.write('<div style="text-align: right;"><strong>From:</strong><address>' + document.getElementById('fromAddress').innerText + '</address></div>');
    printWindow.document.write('<div style="text-align: left;"><strong>To:</strong><address>' + document.getElementById('toAddress').innerText + '</address></div>');
    printWindow.document.write('</div>');
    printWindow.document.write('<hr>');

    printWindow.document.write('<div><h3>Employee Details</h3>');
    printWindow.document.write('<p><strong>Name:</strong> ' + document.getElementById('employeeName').innerText + '</p>');
    printWindow.document.write('<p><strong>ID:</strong> ' + document.getElementById('employeeID').innerText + '</p>');
    printWindow.document.write('<p><strong>Basic Salary:</strong> ' + document.getElementById('basicSalary').innerText + '</p>');
    printWindow.document.write('<p><strong>Allowance:</strong> ' + document.getElementById('allowance').innerText + '</p>');
    printWindow.document.write('<p><strong>Deduction:</strong> ' + document.getElementById('deduction').innerText + '</p>');
    printWindow.document.write('<p><strong>Net Salary:</strong> ' + document.getElementById('netSalary').innerText + '</p></div>');
    printWindow.document.write('</div>');

   
    printWindow.document.write('<div class="footer">');
    printWindow.document.write('<p>' + formattedDate + '</p>');
    printWindow.document.write('<h4>2024 PSV Mediaa.com All rights reserved.</h4>');
    printWindow.document.write('</div>');

    printWindow.document.write('</div>'); // Close container

    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}



    function edit() {
        // Populate the edit form with current details
        document.getElementById('fromAddressInput').value = document.getElementById('fromAddress').innerText;
        document.getElementById('toAddressInput').value = document.getElementById('toAddress').innerText;
        document.getElementById('employeeNameInput').value = document.getElementById('employeeName').innerText;
        document.getElementById('employeeIDInput').value = document.getElementById('employeeID').innerText;
        document.getElementById('employeeDepartmentInput').value = document.getElementById('employeeDepartment').innerText;
        document.getElementById('basicSalaryInput').value = document.getElementById('basicSalary').innerText;
        document.getElementById('allowanceInput').value = document.getElementById('allowance').innerText;
        document.getElementById('deductionInput').value = document.getElementById('deduction').innerText;
        document.getElementById('netSalaryInput').value = document.getElementById('netSalary').innerText;

        // Open the edit form
        openForm();
    }
    function sendViaGmail() {
        // Add your logic to send salary slip via Gmail
        var fromAddress = document.getElementById('fromAddress').innerText;
        var toAddress = document.getElementById('toAddress').innerText;
        var employeeName = document.getElementById('employeeName').innerText;
        var subject = "Salary Slip for " + employeeName;
        var body = "Dear " + employeeName + ",\n\nAttached is your salary slip.\n\nFrom: " + fromAddress + "\nTo: " + toAddress;

        // Open the default email client with pre-filled data
        var mailtoLink = "mailto:?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);
        window.location.href = mailtoLink;
    }

    function setCurrentDate() {
        var currentDate = new Date();
        var options = { year: 'numeric', month: 'long', day: 'numeric' };
        var formattedDate = currentDate.toLocaleDateString('en-US', options);

        document.getElementById('currentDate').innerText = formattedDate;
    }

    // Call setCurrentDate when the page loads
    window.onload = function () {
        setCurrentDate();
    };

    // ... (unchanged functions) ...
</script>

</body>
</html>


@endsection