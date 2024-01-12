@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
 
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Daily Report Form</title>
      <style>
            body {
             
               /* Arrange elements in a column */
              align-items: center;
              justify-content: center;
             
          }
  
          .popup {
              display: none;
              position: fixed;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              background-color: #fff;
              padding: 20px;
              border-radius: 8px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
              z-index: 1;
          }
  
          form {
              width: 100%;
          }
  
          table {
              width: 100%;
              margin-top: 20px;
              border-collapse: collapse;
             
            
          }
  
          table, th, td {
              border: 1px solid #ddd;
              text-align: left;
          }
  
          th, td {
              padding: 12px;
          }
  
          th {
              background-color: #f2f2f2;
          }
  
          .button-container {
              text-align: right;
          }
  
          button {
              padding: 10px 20px;
              margin-top: 10px;
              background-color: rgb(21, 21, 138);
              color: #fff;
              border: none;
              border-radius: 4px;
              cursor: pointer;
              display: block; /* Display the button as a block element */
          }
  
          button.close-btn {
              background-color: #f44336;
          }
  
          button.edit-btn {
              background-color: #2196f3;
              width: 80px;
          }
  
          button.delete-btn {
              background-color: #f44336;
              width: 80px;
          }
  
          .filter-container {
     display: flex;
     width:800px;
      margin-bottom: 20px;
      margin-left: 10px;
  }
  .filter-container label{
      margin-left: 20px;
      margin-right: 5px;
  }
  
  .filter-container button{
      margin-left: 20px;
     width: 80px;
     background-color: orange;
     height: 40px;
     margin-top: -1px;
  }
  
  
  input, textarea {
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
      font-size: 16px; /* Adjust the font size as needed */
  }
  @media only screen and (max-width: 768px) {
        table {
            overflow-x: auto;
            display: block;
            width: 100%;
            margin-top: 10px; /* Add margin for better spacing on small screens */
        }

        th, td {
            min-width: 120px; /* Set a minimum width for cells to prevent them from becoming too narrow */
            box-sizing: border-box;
        }

        .button-container {
            text-align: center; /* Center the buttons on small screens */
        }

        button {
            width: 100%; /* Make the buttons full width on small screens */
            margin-top: 10px;
        }

        .popup {
            width: 80%; /* Adjust the width of the popup for small screens */
        }

        .filter-container {
            width: 100%; /* Make the filter container full width on small screens */
            flex-direction: column; /* Stack filter elements vertically on small screens */
        }

        .filter-container label,
        .filter-container input,
        .filter-container button {
            width: 100%; /* Make filter elements full width on small screens */
            margin: 5px 0; /* Add vertical margin for spacing */
        }
    }
          
      </style>
  </head>
  <body>
  
      <button onclick="openDailyReportForm()">Add Daily Report </button><br>
       <!-- Filter form -->
       <div class="filter-container">
          <label for="filterEmployeeId">Employee ID:</label>
          <input type="text" id="filterEmployeeId">
      
          <label for="filterEmployeeName">Employee Name:</label>
          <input type="text" id="filterEmployeeName">
          <label for="filterDate">Filter Date:</label>
          <input type="date" id="filterDate">
      
          <button onclick="filterData()">Filter</button>
      </div>
      <div id="dailyReportPopup" class="popup">
          <form id="dailyReportForm">
              <h3>Add Hourly Report</h3>
              <label for="employeeId">Employee ID:</label>
              <input type="text" id="employeeId" required>
      
              <label for="employeeName">Employee Name:</label>
              <input type="text" id="employeeName" required>
      
              <label for="date">Date:</label>
              <input type="date" id="date" required>
      
              <label for="inTime">In Time:</label>
              <input type="time" id="inTime" required>
      
              <label for="lunchTime">Lunch Time:</label>
              <input type="time" id="lunchTime" required>
      
              <label for="lunchTimeEnd">Lunch Time End:</label>
              <input type="time" id="lunchTimeEnd" required>
      
              <label for="outTime">Out Time:</label>
              <input type="time" id="outTime" required>
      
              <div class="button-container">
                  <button type="button" onclick="saveData()">Save</button>
                  <button type="button" class="close-btn" onclick="closeDailyReportForm()">Close</button>
              </div>
          </form>
      </div>
      
      <table id="reportTable">
          <thead>
              <tr>
                  <th>Employee ID</th>
                  <th>Employee Name</th>
                  <th>Date</th>
                  <th>In Time</th>
                  <th>Lunch Time</th>
                  <th>Lunch Time End</th>
                  <th>Out Time</th>
                  <th>Total Hours</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              <!-- Saved data will be displayed here -->
          </tbody>
      </table>
     
      <script>
          // Load saved data from local storage on page load
          window.onload = function() {
              loadSavedData();
          };
      
          function openDailyReportForm() {
              document.getElementById('dailyReportPopup').style.display = 'block';
          }
      
          function saveData() {
              // Get form values
              const employeeId = document.getElementById('employeeId').value;
              const employeeName = document.getElementById('employeeName').value;
              const date = document.getElementById('date').value;
              const inTime = document.getElementById('inTime').value;
              const lunchTime = document.getElementById('lunchTime').value;
              const lunchTimeEnd = document.getElementById('lunchTimeEnd').value;
              const outTime = document.getElementById('outTime').value;
      
              // Calculate total hours
              const totalHours = calculateTotalHours(inTime, lunchTime, lunchTimeEnd, outTime);
      
              // Create a new row for the table
              const newRow = document.createElement('tr');
              newRow.innerHTML = `
                  <td>${employeeId}</td>
                  <td>${employeeName}</td>
                  <td>${date}</td>
                  <td>${inTime}</td>
                  <td>${lunchTime}</td>
                  <td>${lunchTimeEnd}</td>
                  <td>${outTime}</td>
                  <td>${totalHours}</td>
                  <td>
                      <button class="edit-btn" onclick="editData(this.parentNode.parentNode)">Edit</button>
                      <button class="delete-btn" onclick="deleteData(this.parentNode.parentNode)">Delete</button>
                  </td>
              `;
      
              // Append the new row to the table
              document.getElementById('reportTable').getElementsByTagName('tbody')[0].appendChild(newRow);
      
              // Clear the form
              document.getElementById('dailyReportForm').reset();
      
              // Save data to local storage
              saveToLocalStorage();
      
              // Close the popup after saving
              closeDailyReportForm();
          }
      
          function calculateTotalHours(inTime, lunchTime, lunchTimeEnd, outTime) {
              // Calculate total hours (you may need to adjust this based on your requirements)
              const inTimeObj = new Date(`2000-01-01 ${inTime}`);
              const lunchTimeObj = new Date(`2000-01-01 ${lunchTime}`);
              const lunchTimeEndObj = new Date(`2000-01-01 ${lunchTimeEnd}`);
              const outTimeObj = new Date(`2000-01-01 ${outTime}`);
      
              const lunchBreak = lunchTimeEndObj - lunchTimeObj;
              const workingHours = (outTimeObj - inTimeObj - lunchBreak) / (1000 * 60 * 60);
      
              return workingHours.toFixed(2);
          }
      
          function closeDailyReportForm() {
              document.getElementById('dailyReportPopup').style.display = 'none';
          }
      
          function addEditDeleteButtons(row) {
              // Add Edit button
              const editButton = document.createElement('button');
              editButton.innerHTML = 'Edit';
              editButton.className = 'edit-btn';
              editButton.addEventListener('click', function () {
                  editData(row);
              });
  
              // Add Delete button
              const deleteButton = document.createElement('button');
              deleteButton.innerHTML = 'Delete';
              deleteButton.className = 'delete-btn';
              deleteButton.addEventListener('click', function () {
                  deleteData(row);
              });
  
              // Add buttons to the row
              row.appendChild(editButton);
              row.appendChild(deleteButton);
          }
          function editData(row) {
              // Extract data from the row
              const columns = row.getElementsByTagName('td');
              const employeeId = columns[0].innerText;
              const employeeName = columns[1].innerText;
              const date = columns[2].innerText;
              const inTime = columns[3].innerText;
              const lunchTime = columns[4].innerText;
              const lunchTimeEnd = columns[5].innerText;
              const outTime = columns[6].innerText;
  
              // Fill the form with the existing data
              document.getElementById('employeeId').value = employeeId;
              document.getElementById('employeeName').value = employeeName;
              document.getElementById('date').value = date; // Use value for date input
              document.getElementById('inTime').value = inTime;
              document.getElementById('lunchTime').value = lunchTime;
              document.getElementById('lunchTimeEnd').value = lunchTimeEnd;
              document.getElementById('outTime').value = outTime;
  
              // Store the edited row temporarily in the form's dataset
              document.getElementById('dailyReportForm').dataset.editedRow = row.rowIndex;
  
              // Display the popup
              document.getElementById('dailyReportPopup').style.display = 'block';
          }
      
          function saveData() {
              // Get form values
              const employeeId = document.getElementById('employeeId').value;
              const employeeName = document.getElementById('employeeName').value;
              const date = document.getElementById('date').value;
              const inTime = document.getElementById('inTime').value;
              const lunchTime = document.getElementById('lunchTime').value;
              const lunchTimeEnd = document.getElementById('lunchTimeEnd').value;
              const outTime = document.getElementById('outTime').value;
      
              // Calculate total hours
              const totalHours = calculateTotalHours(inTime, lunchTime, lunchTimeEnd, outTime);
      
              // Check if this is an edit operation
              const editedRowIndex = document.getElementById('dailyReportForm').dataset.editedRow;
              if (editedRowIndex !== undefined) {
                  // Update the existing row with the edited data
                  const editedRow = document.getElementById('reportTable').rows[editedRowIndex];
                  editedRow.cells[0].innerText = employeeId;
                  editedRow.cells[1].innerText = employeeName;
                  editedRow.cells[2].innerText = date;
                  editedRow.cells[3].innerText = inTime;
                  editedRow.cells[4].innerText = lunchTime;
                  editedRow.cells[5].innerText = lunchTimeEnd;
                  editedRow.cells[6].innerText = outTime;
                  editedRow.cells[7].innerText = totalHours;
      
                  // Clear the dataset indicating the end of the edit operation
                  document.getElementById('dailyReportForm').removeAttribute('data-edited-row');
              } else {
                  // Create a new row for the table
                  const newRow = document.createElement('tr');
                  newRow.innerHTML = `
                      <td>${employeeId}</td>
                      <td>${employeeName}</td>
                      <td>${date}</td>
                      <td>${inTime}</td>
                      <td>${lunchTime}</td>
                      <td>${lunchTimeEnd}</td>
                      <td>${outTime}</td>
                      <td>${totalHours}</td>
                      <td>
                          <button class="edit-btn" onclick="editData(this.parentNode.parentNode)">Edit</button>
                          <button class="delete-btn" onclick="deleteData(this.parentNode.parentNode)">Delete</button>
                      </td>
                  `;
      
                  // Append the new row to the table
                  document.getElementById('reportTable').getElementsByTagName('tbody')[0].appendChild(newRow);
              }
      
              // Clear the form
              document.getElementById('dailyReportForm').reset();
      
              // Save data to local storage
              saveToLocalStorage();
      
              // Close the popup after saving or updating
              closeDailyReportForm();
          }
          function deleteData(row) {
              // Remove the row from the table
              row.remove();
      
              // Save updated data to local storage
              saveToLocalStorage();
          }
      
          function saveToLocalStorage() {
              // Get current data from the table
              const tableRows = document.getElementById('reportTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
              const savedData = [];
      
              for (let i = 0; i < tableRows.length; i++) {
                  const columns = tableRows[i].getElementsByTagName('td');
                  savedData.push({
                      employeeId: columns[0].innerText,
                      employeeName: columns[1].innerText,
                      date: columns[2].innerText,
                      inTime: columns[3].innerText,
                      lunchTime: columns[4].innerText,
                      lunchTimeEnd: columns[5].innerText,
                      outTime: columns[6].innerText,
                      totalHours: columns[7].innerText,
                  });
              }
      
              // Save data to local storage
              localStorage.setItem('savedData', JSON.stringify(savedData));
          }
      
          function loadSavedData() {
              // Load saved data from local storage
              const savedData = JSON.parse(localStorage.getItem('savedData'));
      
              // Populate the table with saved data
              if (savedData) {
                  savedData.forEach(data => {
                      const newRow = document.createElement('tr');
                      newRow.innerHTML = `
                          <td>${data.employeeId}</td>
                          <td>${data.employeeName}</td>
                          <td>${data.date}</td>
                          <td>${data.inTime}</td>
                          <td>${data.lunchTime}</td>
                          <td>${data.lunchTimeEnd}</td>
                          <td>${data.outTime}</td>
                          <td>${data.totalHours}</td>
                          
                      `;
      
                      // Add Edit and Delete buttons to the new row
                      addEditDeleteButtons(newRow);
      
                      // Append the new row to the table
                      document.getElementById('reportTable').getElementsByTagName('tbody')[0].appendChild(newRow);
                  });
              }
          }
          function filterData() {
              // Get filter values
              const filterEmployeeId = document.getElementById('filterEmployeeId').value.toLowerCase();
              const filterEmployeeName = document.getElementById('filterEmployeeName').value.toLowerCase();
              const filterDate = document.getElementById('filterDate').value;
      
              // Get all rows from the table
              const tableRows = document.getElementById('reportTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
      
              // Loop through each row and check if it matches the filter criteria
              for (let i = 0; i < tableRows.length; i++) {
                  const columns = tableRows[i].getElementsByTagName('td');
                  const employeeId = columns[0].innerText.toLowerCase();
                  const employeeName = columns[1].innerText.toLowerCase();
                  const date = columns[2].innerText;
      
                  const matchesFilter =
                      (filterEmployeeId === '' || employeeId.includes(filterEmployeeId)) &&
                      (filterEmployeeName === '' || employeeName.includes(filterEmployeeName)) &&
                      (filterDate === '' || date === filterDate);
      
                  // Show/hide the row based on the filter result
                  tableRows[i].style.display = matchesFilter ? '' : 'none';
              }
          }
      </script>
      
      </body>
      </html>

    
@endsection
