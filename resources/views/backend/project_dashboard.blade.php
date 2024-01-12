@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->



<div class="body d-flex py-3">
<div class="container-xxl">
    <div class="row g-3 mb-3 row-deck">
        <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar lg  rounded-1 no-thumbnail bg-lightyellow color-defult"><i class="bi bi-journal-check fs-4"></i></div>
                        <div class="flex-fill ms-4">
                            <div class="">Total Task</div>
                            <h5 class="mb-0 ">122</h5>
                        </div>
                        <a href="{{ route('admin.project.tasks') }}" title="view-members" class="btn btn-link text-decoration-none  rounded-1"><i class="icofont-hand-drawn-right fs-2 "></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar lg  rounded-1 no-thumbnail bg-lightblue color-defult"><i class="bi bi-list-check fs-4"></i></div>
                        <div class="flex-fill ms-4">
                            <div class="">Completed Task</div>
                            <h5 class="mb-0 ">376</h5>
                        </div>
                        <a href="{{ route('admin.project.tasks') }}" title="space-used" class="btn btn-link text-decoration-none  rounded-1"><i class="icofont-hand-drawn-right fs-2 "></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-4">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar lg  rounded-1 no-thumbnail bg-lightgreen color-defult"><i class="bi bi-clipboard-data fs-4"></i></div>
                        <div class="flex-fill ms-4">
                            <div class="">Progress Task</div>
                            <h5 class="mb-0 ">74</h5>
                        </div>
                        <a href="{{ route('admin.project.tasks') }}" title="renewal-date" class="btn btn-link text-decoration-none  rounded-1"><i class="icofont-hand-drawn-right fs-2 "></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row End -->

   
    <div class="row g-3 mb-3 row-deck">
        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-3 fw-bold ">Income Analytics</h6>
                    <div class="d-flex justify-content-end text-center">
                        <div class="p-2">
                            <h6 class="mb-0 fw-bold">$5,318</h6>
                            <small class="text-muted">Income</small>
                        </div>
                        <div class="p-2 ms-4">
                            <h6 class="mb-0 fw-bold">$2,840</h6>
                            <small class="text-muted">Expense</small>
                        </div>
                    </div>
                    <div class="mt-3" id="incomeanalytics"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <div class="info-header">
                        <h6 class="mb-0 fw-bold ">Project Timeline</h6>
                    </div>
                    <button class="btn btn-sm btn-link  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                    <ul class="dropdown-menu border-0 shadow dropdown-menu-end">
                        <li><a class="dropdown-item py-2 rounded" href="#">Last 7 days</a></li>
                        <li><a class="dropdown-item py-2 rounded" href="#">Last 30 days</a></li>
                        <li><a class="dropdown-item py-2 rounded" href="#">Last 60 days</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div id="apex-timeline"></div>
                </div>
            </div>
        </div>
    </div><!-- Row End -->
    <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 row-cols-xxl-4">
        <div class="col">
            <div class="card bg-primary">
                <div class="card-body text-white d-flex align-items-center">
                    <i class="icofont-data fs-3"></i>
                    <div class="d-flex flex-column ms-3">
                        <h6 class="mb-0">Total Projects</h6>
                        <span class="text-white">550</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-primary">
                <div class="card-body text-white d-flex align-items-center">
                    <i class="icofont-chart-flow fs-3"></i>
                    <div class="d-flex flex-column ms-3">
                        <h6 class="mb-0">Coming Projects</h6>
                        <span class="text-white">210</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-primary">
                <div class="card-body text-white d-flex align-items-center">
                    <i class="icofont-chart-flow-2 fs-3"></i>
                    <div class="d-flex flex-column ms-3">
                        <h6 class="mb-0">Progress Projects</h6>
                        <span class="text-white">8456 Files</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-primary">
                <div class="card-body text-white d-flex align-items-center">
                    <i class="icofont-tasks fs-3"></i>
                    <div class="d-flex flex-column ms-3">
                        <h6 class="mb-0">Finished Projects</h6>
                        <span class="text-white">88 Files</span>
                    </div>
                </div>
            </div>
        </div>             
    </div>         
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        button{
    background-color: midnightblue;
    color: white;
          
          border: none;
          border-radius: 4px;

}
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 2;
            width: 450px;
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

        label {
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
        
        .card {
           
            margin: 10px;
      
            display: inline-block;
            position: relative;
          
            overflow: hidden;
        }

        .card img {
            width: 100px;
            height: auto;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .card-actions {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .card-actions span {
            cursor: pointer;
            margin-right: 10px;
            color: blue;
        }

        .project-actions {
            margin-top: 10px;
        }

        .project-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 3;
            width: 700px;
        }

        .complete-status {
            background-color: #8BC34A;
        }

        .live-status {
            background-color: #FF4081;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        #addpro{
            width: 100px;
        }
        #viewprojectinfo{
width: 700px;

        }
    </style>
    <title>Employee Management</title>
</head>

<body>

    <button id="addpro" onclick="openPopup()">Add Project</button>

    <div id="popup" class="popup">
        <h2>Add Employee</h2>
        <form id="employeeForm">
            <label for="employeeImage">Employee Image:</label>
            <input type="file" id="employeeImageInput" accept="image/*" required><br>

            <label for="employeeName">Employee Name:</label>
            <input type="text" id="employeeName" required><br>

            <label for="employeeId">Employee ID:</label>
            <input type="text" id="employeeId" required><br>

            <button type="button" onclick="submitForm()">Submit</button>
            <button type="button" onclick="closePopup()">Close</button>
        </form>
    </div>

    <div id="projectPopup" class="project-popup">
        <h2>Add Project Information</h2>
        <form id="projectForm">
            <label for="projectName">Project Name:</label>
            <input type="text" id="projectName" required><br>

            <label for="projectCategory">Project Category:</label>
            <input type="text" id="projectCategory" required><br>

            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" required><br>

            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" required><br>

            <label for="empSubmissionDate">Employee Submission Date:</label>
            <input type="date" id="empSubmissionDate" required><br>

            <button type="button" onclick="submitProjectInfo()">Submit</button>
            <button type="button" onclick="closeProjectPopup()">Close</button>
        </form>
    </div>

    <div id="viewProjectInfoPopup" class="project-popup">
        <h2>Project Information</h2>
        <div id="projectInfoTableContainer"></div>
        <button onclick="closeViewProjectInfoPopup()">Close</button>
    </div>

    <div id="employeeCards"></div>

    <script>
        let employeeData = JSON.parse(localStorage.getItem('employeeData')) || [];

        function openPopup() {
            document.getElementById('popup').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            clearForm();
        }

        function clearForm() {
            document.getElementById('employeeForm').reset();
            document.getElementById('employeeImageInput').value = '';
        }

        function submitForm() {
            const imageInput = document.getElementById('employeeImageInput');
            const name = document.getElementById('employeeName').value;
            const id = document.getElementById('employeeId').value;

            if (imageInput.files.length > 0 && name && id) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const employee = {
                        image: e.target.result,
                        name,
                        id,
                        projects: []
                    };
                    employeeData.push(employee);

                    localStorage.setItem('employeeData', JSON.stringify(employeeData));
                    displayCards();
                    closePopup();
                };
                reader.readAsDataURL(imageInput.files[0]);
            } else {
                alert('Please fill in all fields.');
            }
        }

        function displayCards() {
            const cardsContainer = document.getElementById('employeeCards');
            cardsContainer.innerHTML = '';

            employeeData.forEach((employee, index) => {
                const card = document.createElement('div');
                card.className = 'card';

                const imageElement = document.createElement('img');
                imageElement.src = employee.image;
                card.appendChild(imageElement);

                card.innerHTML += `<div class="card-actions">
                                    <span onclick="editEmployee(${index})">&#9998;</span>
                                    <span onclick="deleteEmployee(${index})">&#128465;</span>
                                  </div>
                                  <br><strong>ID:</strong> ${employee.id}<br>
                                  <strong>Name:</strong> ${employee.name}
                                  <div class="project-actions">
                                    <button onclick="addProjectInfo(${index})">&#43; Add Project Info</button>
                                    <button onclick="viewProjectInfo(${index})">&#128269; View Project Info</button>
                                  </div>`;

                cardsContainer.appendChild(card);
            });
        }

        function editEmployee(index) {
            const employee = employeeData[index];
            document.getElementById('employeeImageInput').value = '';
            document.getElementById('employeeName').value = employee.name;
            document.getElementById('employeeId').value = employee.id;

            const submitButton = document.querySelector('#employeeForm button[type="button"]');
            submitButton.innerHTML = 'Edit';
            submitButton.onclick = function () {
                const editedName = document.getElementById('employeeName').value;
                const editedId = document.getElementById('employeeId').value;

                if (editedName && editedId) {
                    employeeData[index].name = editedName;
                    employeeData[index].id = editedId;

                    localStorage.setItem('employeeData', JSON.stringify(employeeData));
                    displayCards();
                    closePopup();

                    clearForm();
                    submitButton.innerHTML = 'Submit';
                    submitButton.onclick = submitForm;
                } else {
                    alert('Please fill in all fields.');
                }
            };

            openPopup();
        }

        function deleteEmployee(index) {
            employeeData.splice(index, 1);

            localStorage.setItem('employeeData', JSON.stringify(employeeData));
            displayCards();
        }

        function addProjectInfo(index) {
            openProjectPopup(index);
        }

        function viewProjectInfo(index) {
    const employee = employeeData[index];
    const table = document.createElement('table');
    const headerRow = table.insertRow();
    const headerCell1 = headerRow.insertCell(0);
    const headerCell2 = headerRow.insertCell(1);
    const headerCell3 = headerRow.insertCell(2);
    const headerCell4 = headerRow.insertCell(3);
    const headerCell5 = headerRow.insertCell(4);
    const headerCell6 = headerRow.insertCell(5);
    const headerCell7 = headerRow.insertCell(6);
    const headerCell8 = headerRow.insertCell(7);
    const headerCell9 = headerRow.insertCell(8);
    const headerCell10 = headerRow.insertCell(9);

    headerCell1.innerHTML = '<strong>Project Name</strong>';
    headerCell2.innerHTML = '<strong>Category</strong>';
    headerCell3.innerHTML = '<strong>Start Date</strong>';
    headerCell4.innerHTML = '<strong>End Date</strong>';
    headerCell5.innerHTML = '<strong>Emp Submission Date</strong>';
    headerCell6.innerHTML = '<strong>Total Days</strong>';
    headerCell7.innerHTML = '<strong>Delayed Days</strong>';
    headerCell8.innerHTML = '<strong>Status</strong>';
    headerCell9.innerHTML = '<strong>Edit</strong>';
    headerCell10.innerHTML = '<strong>Delete</strong>';

    // Sort projects based on status
    employee.projects.sort((a, b) => {
        const statusA = calculateStatus(a.endDate, a.empSubmissionDate);
        const statusB = calculateStatus(b.endDate, b.empSubmissionDate);
        return statusA === 'Live' && statusB === 'Complete' ? -1 : 0;
    });

    employee.projects.forEach((project, projectIndex) => {
        const row = table.insertRow();
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        const cell3 = row.insertCell(2);
        const cell4 = row.insertCell(3);
        const cell5 = row.insertCell(4);
        const cell6 = row.insertCell(5);
        const cell7 = row.insertCell(6);
        const cell8 = row.insertCell(7);
        const cell9 = row.insertCell(8);
        const cell10 = row.insertCell(9);

        cell1.textContent = project.projectName;
        cell2.textContent = project.category;
        cell3.textContent = project.startDate;
        cell4.textContent = project.endDate;
        cell5.textContent = project.empSubmissionDate;

        const totalDays = calculateTotalDays(project.startDate, project.empSubmissionDate);
        const delayedDays = calculateDelayedDays(project.endDate, project.empSubmissionDate);
        const status = calculateStatus(project.endDate, project.empSubmissionDate);

        cell6.textContent = totalDays;
        cell7.textContent = delayedDays;
        cell8.textContent = status;

        if (status === 'Complete') {
            row.classList.add('complete-status');
        } else {
            row.classList.add('live-status');
        }

        const editIcon = document.createElement('span');
        editIcon.innerHTML = '&#9998;';
        editIcon.className = 'edit-icon';
        editIcon.onclick = function () {
            editProjectInfo(index, projectIndex);
        };
        cell9.appendChild(editIcon);

        const deleteIcon = document.createElement('span');
        deleteIcon.innerHTML = '&#128465;';
        deleteIcon.className = 'delete-icon';
        deleteIcon.onclick = function () {
            deleteProjectInfo(index, projectIndex);
        };
        cell10.appendChild(deleteIcon);
    });

    document.getElementById('projectInfoTableContainer').innerHTML = '';
    document.getElementById('projectInfoTableContainer').appendChild(table);

    openViewProjectInfoPopup();
}


        function calculateTotalDays(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const timeDifference = end.getTime() - start.getTime();
            const totalDays = timeDifference / (1000 * 3600 * 24);
            return Math.round(totalDays);
        }

        function calculateDelayedDays(endDate, submissionDate) {
            const end = new Date(endDate);
            const submission = new Date(submissionDate);
            const timeDifference = submission.getTime() - end.getTime();
            const delayedDays = timeDifference / (1000 * 3600 * 24);
            return Math.round(Math.max(delayedDays, 0));
        }

        function calculateStatus(endDate, submissionDate) {
            const end = new Date(endDate);
            const submission = new Date(submissionDate);
            const today = new Date();

            if (submission <= today) {
                return 'Complete';
            } else {
                return 'Live';
            }
        }

        function openProjectPopup(index, projectIndex) {
            document.getElementById('projectPopup').style.display =
            'block';
            const submitButton = document.querySelector('#projectForm button[type="button"]');
            submitButton.onclick = function () {
                if (typeof projectIndex !== 'undefined') {
                    submitEditedProjectInfo(index, projectIndex);
                } else {
                    submitProjectInfo(index);
                }
            };
        }
        function submitProjectInfo(index) {
    const projectName = document.getElementById('projectName').value;
    const category = document.getElementById('projectCategory').value;
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    const empSubmissionDate = document.getElementById('empSubmissionDate').value;

    if (projectName && category && startDate && endDate && empSubmissionDate) {
        const project = {
            projectName,
            category,
            startDate,
            endDate,
            empSubmissionDate
        };
        employeeData[index].projects.push(project);

        localStorage.setItem('employeeData', JSON.stringify(employeeData));
        displayCards();
        closeProjectPopup();
    } else {
        alert('Please fill in all fields.');
    }
}

        function submitEditedProjectInfo(employeeIndex, projectIndex) {
            const projectName = document.getElementById('projectName').value;
            const category = document.getElementById('projectCategory').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const empSubmissionDate = document.getElementById('empSubmissionDate').value;

            if (projectName && category && startDate && endDate && empSubmissionDate) {
                const project = {
                    projectName,
                    category,
                    startDate,
                    endDate,
                    empSubmissionDate
                };

                employeeData[employeeIndex].projects[projectIndex] = project;

                localStorage.setItem('employeeData', JSON.stringify(employeeData));
                displayCards();
                closeProjectPopup();
            } else {
                alert('Please fill in all fields.');
            }
        }

        function editProjectInfo(employeeIndex, projectIndex) {
            const project = employeeData[employeeIndex].projects[projectIndex];

            document.getElementById('projectName').value = project.projectName;
            document.getElementById('projectCategory').value = project.category;
            document.getElementById('startDate').value = project.startDate;
            document.getElementById('endDate').value = project.endDate;
            document.getElementById('empSubmissionDate').value = project.empSubmissionDate;

            openProjectPopup(employeeIndex, projectIndex);
        }

        function deleteProjectInfo(employeeIndex, projectIndex) {
            employeeData[employeeIndex].projects.splice(projectIndex, 1);

            localStorage.setItem('employeeData', JSON.stringify(employeeData));
            displayCards();
            closeViewProjectInfoPopup();
        }

        function closeProjectPopup() {
            document.getElementById('projectPopup').style.display = 'none';
            clearProjectForm();
        }

        function openViewProjectInfoPopup() {
            document.getElementById('viewProjectInfoPopup').style.display = 'block';
        }

        function closeViewProjectInfoPopup() {
            document.getElementById('viewProjectInfoPopup').style.display = 'none';
        }

        function clearProjectForm() {
            document.getElementById('projectForm').reset();
        }

        displayCards();
    </script>

</body>

</html>

    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script> 
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script> 
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/index.js') }}"></script>
@endsection
