@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Department Management</title>
      <style>
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
    
        body {
          font-family: Arial, sans-serif;
          background-color: #f4f4f4;
          margin: 0;
          padding: 0;
        }
    
        .container {
          background-color: #fff;
          padding: 20px;
          border-radius: 8px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    
        label {
          display: block;
          margin-bottom: 8px;
        }
    
        input {
          width: 100%;
          padding: 8px;
          margin-bottom: 16px;
          box-sizing: border-box;
        }
    
        button {
          background-color: rgb(35, 35, 139);
          color: #fff;
          padding: 10px 15px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          width: 70px;
        }
    
        button:hover {
          background-color: rgb(35, 35, 139);
        }
    
        .adddep {
          background-color: rgb(35, 35, 139);
          color: #fff;
          padding: 10px 15px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          width: auto;
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
    
        th {
          background-color: rgb(35, 35, 139);
          color: white;
        }
    
        .department-card {
          margin-bottom: 20px;
        }
    
        .deleted {
          background-color: red;
        }
    
        .deleted:hover {
          background-color: red;
        }
    
        .thumbnail {
          max-width: 100px;
          max-height: 100px;
        }
    
        /* Filter Styles */
        label[for="filterByName"] {
          margin-right: 10px;
          font-weight: bold;
          color: rgb(35, 35, 139);
        }
    
        #filterByName {
          padding: 8px;
          border: 1px solid #ccc;
          border-radius: 4px;
        }
      </style>
    </head>
    <body>
    
    <div class="container">
      <h2>Department Management</h2>
      <label for="filterByName">Filter by Department Name:</label>
      <input type="text" id="filterByName" oninput="filterDepartmentsByName()">
      <button class="adddep" onclick="openPopup()">Add Department</button>
    
      <!-- Popup Form -->
      <div id="popupForm" class="popup" style="display: none;">
        <h3>Add Department</h3>
        <form id="departmentForm">
          <label for="departmentImage">Head Image:</label>
          <input type="file" id="departmentImage" name="departmentImage" accept="image/*">
    
          <label for="departmentHead">Head Name:</label>
          <input type="text" id="departmentHead" name="departmentHead" required>
    
          <label for="departmentName">Department Name:</label>
          <input type="text" id="departmentName" name="departmentName" required>
    
          <label for="employeesUnderWork">Employees Under Work:</label>
          <input type="number" id="employeesUnderWork" name="employeesUnderWork" min="0" required>
    
          <button type="button" onclick="saveDepartment()">Save</button>
          <button type="button" class="deleted" onclick="closePopup()">Close</button>
        </form>
      </div>
    
      <!-- Display Department Data -->
      <table id="departmentTable">
        <thead>
          <tr>
            <th>Department Head Profile</th>
            <th>Head name</th>
            <th>Department Name</th>
            <th>Employees Under Work</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="departmentList"></tbody>
      </table>
    
      <script>
        let departments = JSON.parse(localStorage.getItem('departments')) || [];
    
        function openPopup() {
          document.getElementById('popupForm').style.display = 'block';
        }
    
        function closePopup() {
          document.getElementById('popupForm').style.display = 'none';
        }
    
        function saveDepartment() {
          const departmentHead = document.getElementById('departmentHead').value;
          const departmentImageInput = document.getElementById('departmentImage');
          const departmentImage = departmentImageInput.files[0];
          const departmentName = document.getElementById('departmentName').value;
          const employeesUnderWork = document.getElementById('employeesUnderWork').value;
    
          const reader = new FileReader();
          reader.onload = function (e) {
            const department = {
              departmentHead,
              departmentName,
              employeesUnderWork,
              departmentImage: e.target.result,
            };
    
            departments.push(department);
    
            localStorage.setItem('departments', JSON.stringify(departments));
    
            displayDepartments();
    
            closePopup();
          };
    
          if (departmentImage) {
            reader.readAsDataURL(departmentImage);
          } else {
            const department = {
              departmentHead,
              departmentImage: null,
              departmentName,
              employeesUnderWork,
            };
    
            departments.push(department);
    
            localStorage.setItem('departments', JSON.stringify(departments));
    
            displayDepartments();
    
            closePopup();
          }
        }
    
        function displayDepartments(filteredDepartments = departments) {
          const departmentList = document.getElementById('departmentList');
          departmentList.innerHTML = '';
    
          filteredDepartments.forEach((department, index) => {
            const row = document.createElement('tr');
    
            row.innerHTML = `
              <td>
                <img src="${department.departmentImage}" alt="Image" class="thumbnail">
              </td>
              <td>${department.departmentHead}</td>
              <td>${department.departmentName}</td>
              <td>${department.employeesUnderWork}</td>
              <td>
                <button onclick="editDepartment(${index})">Edit</button><br>
                <br><button class="deleted" onclick="deleteDepartment(${index})">Delete</button>
              </td>
            `;
    
            departmentList.appendChild(row);
          });
        }
    
        function editDepartment(index) {
          const department = departments[index];
          document.getElementById('departmentHead').value = department.departmentHead;
          document.getElementById('departmentName').value = department.departmentName;
          document.getElementById('employeesUnderWork').value = department.employeesUnderWork;
    
          openPopup();
    
          departments.splice(index, 1);
    
          localStorage.setItem('departments', JSON.stringify(departments));
    
          displayDepartments();
        }
    
        function deleteDepartment(index) {
          departments.splice(index, 1);
    
          localStorage.setItem('departments', JSON.stringify(departments));
    
          displayDepartments();
        }
    
        function filterDepartmentsByName() {
          const filterInput = document.getElementById('filterByName');
          const filterValue = filterInput.value.toLowerCase();
    
          const filteredDepartments = departments.filter((department) => {
            return department.departmentName.toLowerCase().includes(filterValue);
          });
    
          displayDepartments(filteredDepartments);
        }
    
        displayDepartments();
      </script>
    </div>
    
    </body>
    </html>
@endsection
