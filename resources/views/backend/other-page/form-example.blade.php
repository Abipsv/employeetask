@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Daily Report System</title>
        <style>
            #popupContainer{
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

            form {
                max-width: 600px;
                margin: 0 auto;
            }

            label {
                display: block;
                margin-bottom: 8px;
            }

            input, textarea, select {
                width: 100%;
                padding: 8px;
                margin-bottom: 16px;
                box-sizing: border-box;
            }

            button {
                background-color: midnightblue;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            button:hover {
                background-color: blue;
            }
            #reportList {
            max-width: 800px; /* Adjusted max-width */
            margin: 20px auto;
        }

        #reportList table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #reportList table, th, td {
            border: 1px solid #ddd;
        }

        #reportList th, #reportList td {
            padding: 10px;
            text-align: left;
        }

            #reportList table, th, td {
                border: 1px solid #ddd;
            }

            #reportList th, #reportList td {
                padding: 10px;
                text-align: left;
            }

            .deleteButton {
                background-color: lightsalmon;
                color:black;
                padding: 5px 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-right: 5px;
            }

            .editButton {
                background-color: green;
                padding: 5px 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-right: 5px;
            }

           
    #filterContainer {
        margin-bottom: 20px;
        width: 200px;
      
 
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
        #filterContainer label {
            margin-right: 10px;
        }

        #filterContainer input, #filterContainer select {
            width: auto;
            margin-right: 10px;
        }
        #filterContainer {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
            width: 100%;
        }
        </style>
    </head>
    <body>
        <button class="pop" onclick="openPopup()">Create New Daily Report</button>

        <div id="popupContainer" style="display: none;">
            <form id="dailyReportForm">
                <label for="employeeId">Employee ID:</label>
                <input type="number" id="employeeId" name="employeeId" required>

                <label for="reportDate">Report Date:</label>
                <input type="date" id="reportDate" name="reportDate" required>

                <label for="reportContent">Report Content:</label>
                <textarea id="reportContent" name="reportContent" rows="4" required></textarea>

                <button type="button" onclick="submitReport()">Submit Report</button>
                <button type="button" onclick="closePopup()">Cancel</button>
            </form>
        </div>

        <div id="filterContainer">
            <label for="filterDate">Filter by Date:</label>
            <input type="date" id="filterDate" onchange="filterReports()">

            <label for="filterEmployee">Filter by Employee ID:</label>
            <input type="number" id="filterEmployee" onchange="filterReports()">
        </div>

        <div id="reportList">
            <h2>Employee's Daily Reports</h2>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Date</th>
                        <th>Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="reportTableBody"></tbody>
            </table>
        </div>

        <script>
          function openPopup() {
            document.getElementById('popupContainer').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popupContainer').style.display = 'none';
        }

        function submitReport() {
            const employeeId = document.getElementById('employeeId').value;
            const reportDate = document.getElementById('reportDate').value;
            const reportContent = document.getElementById('reportContent').value;

            // Validate if the employeeId and reportDate are not empty
            if (!employeeId || !reportDate) {
                alert('Please provide both employee ID and a valid date.');
                return;
            }

            // Create a new report object
            const report = {
                employeeId: parseInt(employeeId),
                date: reportDate,
                content: reportContent
            };

            // Save the report to localStorage
            saveReport(report);

            // Clear the form fields
            document.getElementById('employeeId').value = '';
            document.getElementById('reportDate').value = '';
            document.getElementById('reportContent').value = '';

            // Close the popup
            closePopup();

            // Update the report list
            updateReportList();
        }

        function saveReport(report) {
            // Get existing reports from localStorage or initialize an empty array
            const existingReports = JSON.parse(localStorage.getItem('dailyReports')) || [];

            // Check if there is an existing report for the employee on the same date
            const existingReportIndex = existingReports.findIndex(existingReport =>
                existingReport.employeeId === report.employeeId && existingReport.date === report.date
            );

            if (existingReportIndex !== -1) {
                // If an existing report is found, update it
                existingReports[existingReportIndex] = report;
            } else {
                // If no existing report is found, add the new report to the array
                existingReports.push(report);
            }

            // Save the updated array back to localStorage
            localStorage.setItem('dailyReports', JSON.stringify(existingReports));
        }

        function updateReportList() {
            const reportTableBody = document.getElementById('reportTableBody');

            // Clear the existing table rows
            reportTableBody.innerHTML = '';

            // Get reports from localStorage
            const existingReports = JSON.parse(localStorage.getItem('dailyReports')) || [];

            // Populate the table with reports
            existingReports.forEach(report => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${report.employeeId}</td><td>${report.date}</td><td>${report.content}</td>
                                <td>
                                    <button class="editButton" onclick="editReport(${report.employeeId}, '${report.date}')">Edit</button>
                                    <button class="deleteButton" onclick="deleteReport(${report.employeeId}, '${report.date}')">Delete</button>
                                </td>`;
                reportTableBody.appendChild(row);
            });
        }

        function editReport(employeeId, date) {
            const existingReports = JSON.parse(localStorage.getItem('dailyReports')) || [];

            // Find the report to edit
            const reportToEdit = existingReports.find(report =>
                report.employeeId === employeeId && report.date === date
            );

            if (reportToEdit) {
                // Populate the form with the existing report data
                document.getElementById('employeeId').value = reportToEdit.employeeId;
                document.getElementById('reportDate').value = reportToEdit.date;
                document.getElementById('reportContent').value = reportToEdit.content;

                // Open the popup for editing
                openPopup();
            }
        }

        function deleteReport(employeeId, date) {
            const existingReports = JSON.parse(localStorage.getItem('dailyReports')) || [];

            // Filter out the report to delete
            const updatedReports = existingReports.filter(report =>
                !(report.employeeId === employeeId && report.date === date)
            );

            // Save the updated array back to localStorage
            localStorage.setItem('dailyReports', JSON.stringify(updatedReports));

            // Update the report list
            updateReportList();
        }

        function filterReports() {
            const filterDate = document.getElementById('filterDate').value;
            const filterEmployee = document.getElementById('filterEmployee').value;

            // Get reports from localStorage
            const existingReports = JSON.parse(localStorage.getItem('dailyReports')) || [];

            // Filter reports based on the selected date and employee
            const filteredReports = existingReports.filter(report =>
                (filterDate === '' || filterDate === report.date) &&
                (isNaN(filterEmployee) || parseInt(filterEmployee) === report.employeeId)
            );

            // Update the report list with the filtered reports
            const reportTableBody = document.getElementById('reportTableBody');
            reportTableBody.innerHTML = '';

            filteredReports.forEach(report => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${report.employeeId}</td><td>${report.date}</td><td>${report.content}</td>
                                <td>
                                    <button class="editButton" onclick="editReport(${report.employeeId}, '${report.date}')">Edit</button>
                                    <button class="deleteButton" onclick="deleteReport(${report.employeeId}, '${report.date}')">Delete</button>
                                </td>`;
                reportTableBody.appendChild(row);
            });
        }

        // Load existing reports on page load
        window.onload = function () {
            updateReportList();
        };
        </script>
    </body>
    </html>

@endsection
