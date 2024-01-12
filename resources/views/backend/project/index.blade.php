
@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Task Popup</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      z-index: 999;
    }

    .task-card {
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 15px;
      margin: 10px;
      display: inline-block;
      position: relative;
      background-color: #f8f8f8;
    }

    .view-project-content {
      display: none;
      margin-top: 10px;
    }

    .view-project-btn {
      margin-top: 5px;
      cursor: pointer;
      color: blue;
      text-decoration: underline;
    }

    .reply-btn {
      margin-top: 5px;
      cursor: pointer;
      color: green;
      text-decoration: underline;
    }

    .view-replies-btn {
      margin-top: 5px;
      cursor: pointer;
      color: purple;
      text-decoration: underline;
    }

    .action-icons {
      position: absolute;
      top: 5px;
      right: 5px;
    }

    .action-icons button {
      cursor: pointer;
      margin-left: 5px;
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
    #loginContainer input, textarea, #status{
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                box-sizing: border-box; /* Include padding and border in the element's total width and height */
                border: 1px solid #ccc;
                border-radius: 4px;
            }
           #loginContainer label {
               /* Make labels appear on a new line */
                margin-bottom: 5px;
                color: #333; /* Text color */
                font-weight: bold; /* Bold text */
            }
            .lea {
                background-color: midnightblue;
                color: white;
                border-style: none;
                border-color: none;
                padding: 10px;
                border-radius: 3px;
            }
            .task-card {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px;
    background-color: #f9f9f9;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
  }

  /* Style for task data inside the task card */
  .task-card strong {
    color: #333;
  }

  /* Style for the "View Project" button */
  .view-project-btn {
    background-color: #4caf50;
    color: white;
    border: none;
 
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
 
    cursor: pointer;
    border-radius: 4px;
  }

  /* Style for the reply button */
  .reply-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
  }

  /* Style for the "View Replies" button */
  .view-replies-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
  }

  /* Style for the action icons (edit and delete buttons) */
  .action-icons button {
    background-color: #ff9800;
    color: white;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin-right: 5px;
    cursor: pointer;
    border-radius: 3px;
  }

  /* Style for the reply card */
  .reply-card {
    border: 1px solid #007bff;
    padding: 10px;
    margin: 10px;
    background-color: #e6f7ff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
  }
  .task-card {
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
    margin: 20px;
    transition: box-shadow 0.3s ease-in-out;
    width: 420px;
  }

  /* Hover effect for the task card */
  .task-card:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  /* Style for task data inside the task card */
  .task-card strong {
    color: #333;
  }

  /* Style for the "View Project" button */
  .view-project-btn {
    background-color: midnightblue;
    color: white;
  
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 8px 4px;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.3s ease-in-out;
  }

  /* Hover effect for the "View Project" button */
  .view-project-btn:hover {
    background-color: #45a049;
  }

  /* Style for the reply button */
  .reply-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 8px 4px;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.3s ease-in-out;
  }

  /* Hover effect for the reply button */
  .reply-btn:hover {
    background-color: #0056b3;
  }

  /* Style for the "View Replies" button */
  .view-replies-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 8px 4px;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.3s ease-in-out;
  }

  /* Hover effect for the "View Replies" button */
  .view-replies-btn:hover {
    background-color: #0056b3;
  }

  /* Style for the action icons (edit and delete buttons) */
  .action-icons button {
    background-color: pink;
    color: white;
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin-right: 8px;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.3s ease-in-out;
  }

  /* Hover effect for the action icons */
  .action-icons button:hover {
    background-color: #e68a00;
  }

  /* Style for the reply card */
  .reply-card {
    background-color: #e6f7ff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 20px;
    margin: 20px;
    transition: box-shadow 0.3s ease-in-out;
  }

  /* Hover effect for the reply card */
  .reply-card:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
  label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
  }

  /* Style for text input fields */
  input[type="text"],
  input[type="password"],
  input[type="date"],
  textarea {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    transition: border-color 0.3s ease-in-out;
  }

  /* Hover effect for text input fields */
  input[type="text"]:hover,
  input[type="password"]:hover,
  input[type="date"]:hover,
  textarea:hover {
    border-color: #007bff;
  }

  /* Focus effect for text input fields */
  input[type="text"]:focus,
  input[type="password"]:focus,
  input[type="date"]:focus,
  textarea:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }

  /* Style for password input field */
  input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    transition: border-color 0.3s ease-in-out;
  }

  /* Style for buttons */
  button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 12px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 8px 0;
    cursor: pointer;
    border-radius: 6px;
    transition: background-color 0.3s ease-in-out;
  }

  /* Hover effect for buttons */
  button:hover {
    background-color: #0056b3;
  }

  /* Style for file input */
  input[type="file"] {
    margin-top: 8px;
  }

  /* Style for select dropdown */
  select {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    transition: border-color 0.3s ease-in-out;
  }

  /* Hover effect for select dropdown */
  select:hover {
    border-color: #007bff;
  }

  /* Focus effect for select dropdown */
  select:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }
  #filterEmployee{
    width: 200px;
  }
  </style>
</head>
<body>
  <div id="loginContainer">
    <label for="username">Username:</label>
    <input type="text" id="username">
    <label for="password">Password:</label>
    <input type="password" id="loginPassword">
    <button class="lea"onclick="login()">Login</button>
  </div>

  <div id="mainContainer" style="display: none;">
    <!--<button onclick="refreshPage()">Refresh</button>-->

    <button class="lea" onclick="openPopup()">Add Task</button>
  <div id="taskPopup" class="popup">
    <label for="taskNo">Task No:</label>
    <input type="text" id="taskNo">

    <label for="taskName">Task Name:</label>
    <input type="text" id="taskName">

    <label for="description">Description:</label>
    <textarea id="description"></textarea>

    <label for="assignedEmployees">Assigned Employees:</label>
    <input type="text" id="assignedEmployees">

    <label for="startDate">Start Date:</label>
    <input type="date" id="startDate">

    <label for="endDate">End Date:</label>
    <input type="date" id="endDate">

    <label for="password">Password:</label>
    <input type="password" id="password">

    <!--<div id="fileInputs">
      <label for="fileInput">Attach File:</label>
      <input type="file" class="fileInput" multiple>
    </div>

    <button onclick="addFileInput()">Attach Another File</button>-->

    <button onclick="addTask()">Add Task</button>
    <button onclick="closePopup()">Close</button>
  </div>

  <div id="replyPopup" class="popup">
    <label for="replyDetails">Details:</label>
    <textarea id="replyDetails"></textarea>

   <label for="replyStatus">Status:</label>
    <select id="replyStatus">
      
      <option value="onProcess">On Process</option>
      <option value="complete">Complete</option>
    </select>

    <label for="replyFile">Choose File:</label>
    <input type="file" id="replyFile">

    <button onclick="submitReply()">Submit</button>

    <button onclick="closeReplyPopup()">Close</button>
  </div>
<br>
  <label for="filterEmployee" style="font-weight: bold">Filter by Assigned Employee:</label>
  <input type="text" id="filterEmployee" oninput="filterByEmployee()" placeholder="Enter employee name">

  <div id="taskContainer"></div>
 <!-- <button onclick="refreshPage()">Refresh</button>-->
  <script>
    function login() {
      // Perform your login validation here
      var enteredUsername = document.getElementById('username').value;
      var enteredPassword = document.getElementById('loginPassword').value;

      // Replace this condition with your actual login validation
      if (enteredUsername === 'task@psv' && enteredPassword === 'psv@101') {
        document.getElementById('loginContainer').style.display = 'none';
        document.getElementById('mainContainer').style.display = 'block';
      } else {
        alert('Invalid credentials. Please try again.');
      }
    }
    window.onload = function () {
  // Other initialization code...

  var uploadedFiles = getFiles();
  renderTasks(null, uploadedFiles);

  // Rest of the code...
};


    window.onload = function () {
      var isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

      if (isLoggedIn) {
        document.getElementById('loginContainer').style.display = 'none';
        document.getElementById('mainContainer').style.display = 'block';
      }
    };

     function saveFiles(files) {
      localStorage.setItem('uploadedFiles', JSON.stringify(files));
    }

    function getFiles() {
      return JSON.parse(localStorage.getItem('uploadedFiles')) || [];
    }

    var tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    var replyDetailsVisible = localStorage.getItem('replyDetailsVisible') === 'true';
    var currentIndex = -1;

    window.onload = function () {
      tasks = JSON.parse(localStorage.getItem('tasks')) || [];
      var replyDetailsVisible = localStorage.getItem('replyDetailsVisible') === 'true';
      currentIndex = -1;

      var uploadedFiles = getFiles();
      renderTasks(null, uploadedFiles);

      if (replyDetailsVisible) {
        openReplyPopup(currentIndex);
      }
    };

    function openPopup() {
      document.getElementById('taskPopup').style.display = 'block';
    }

    function closePopup() {
      document.getElementById('taskPopup').style.display = 'none';
    }

    function openReplyPopup(index) {
      currentIndex = index;
      document.getElementById('replyDetails').value = tasks[index].replyDetails || '';
      document.getElementById('replyPopup').style.display = 'block';
      renderReplies(index);
      localStorage.setItem('replyDetailsVisible', 'true');
    }

    function closeReplyPopup() {
      document.getElementById('replyPopup').style.display = 'none';
      localStorage.setItem('replyDetailsVisible', 'false');
    }

    function addFileInput() {
      var fileInputsContainer = document.getElementById('fileInputs');
      var newFileInput = document.createElement('input');
      newFileInput.type = 'file';
      newFileInput.className = 'fileInput';
      newFileInput.multiple = true;
      fileInputsContainer.appendChild(newFileInput);
    }

    function uploadFiles() {
      var fileInputs = document.getElementsByClassName('fileInput');
      var uploadedFiles = [];

      for (var i = 0; i < fileInputs.length; i++) {
        var files = fileInputs[i].files;

        for (var j = 0; j < files.length; j++) {
          var file = files[j];
          readFile(file, function (dataUrl) {
            uploadedFiles.push({
              name: file.name,
              type: file.type,
              data: dataUrl,
            });
          });
        }
      }

      console.log("Uploaded Files:", uploadedFiles);
    }

    function readFile(file, callback) {
      var reader = new FileReader();
      reader.onload = function (e) {
        callback(e.target.result);
      };
      reader.readAsDataURL(file);
    }

    function addTask() {
      var uploadedFiles = getFiles();

      var fileInputs = document.getElementsByClassName('fileInput');
      for (var i = 0; fileInputs && i < fileInputs.length; i++) {
        var files = fileInputs[i].files;

        for (var j = 0; j < files.length; j++) {
          var file = files[j];
          readFile(file, function (dataUrl) {
            uploadedFiles.push({
              name: file.name,
              type: file.type,
              data: dataUrl,
            });
          });
        }
      }

      var task = {
        taskNo: document.getElementById('taskNo').value,
        taskName: document.getElementById('taskName').value,
        description: document.getElementById('description').value,
        assignedEmployees: document.getElementById('assignedEmployees').value,
        startDate: document.getElementById('startDate').value,
        endDate: document.getElementById('endDate').value,
        password: document.getElementById('password').value,
        files: uploadedFiles,
        replies: [],
        replyDetails: ""
      };
      tasks.push(task);
  localStorage.setItem('tasks', JSON.stringify(tasks));
  saveFiles(uploadedFiles);  // Save combined files to local storage
  closePopup();
    }

    function renderTasks(filteredTasks, uploadedFiles) {
      var taskContainer = document.getElementById('taskContainer');
      taskContainer.innerHTML = '';

      var tasksToRender = filteredTasks || tasks;

      for (var i = 0; i < tasksToRender.length; i++) {
        var taskCard = document.createElement('div');
        taskCard.className = 'task-card';

        taskCard.innerHTML = '<strong>Task No:</strong> ' + tasksToRender[i].taskNo + '<br>' +
          '<strong>Task Name:</strong> ' + tasksToRender[i].taskName + '<br>' +
          '<strong>Assigned Employee:</strong> ' + tasksToRender[i].assignedEmployees +
          '<br><button class="view-project-btn" onclick="viewProject(' + i + ')">View Project</button>' +
          '<div class="view-project-content" id="viewProjectContent' + i + '"></div>' +
          '<div class="action-icons">' +
          '<button onclick="editTask(' + i + ')">🖊️ </button>' +
          '<button onclick="deleteTask(' + i + ')">🗑️ </button>' +
          '</div>';

        // Display uploaded files
        var filesHtml = '';
        for (var j = 0; j < uploadedFiles.length; j++) {
          filesHtml += '<li><a href="#" onclick="downloadFile(\'' + uploadedFiles[j].name + '\', \'' + uploadedFiles[j].type + '\', \'' + uploadedFiles[j].data + '\')">' + uploadedFiles[j].name + '</a></li>';
        }

        taskCard.innerHTML += '<strong></strong> <ul>' + filesHtml + '</ul>';

        taskContainer.appendChild(taskCard);
      }
    }

    function viewProject(index) {
      currentIndex = index;

      var enteredPassword = prompt('Enter the password to view the project:');

      if (enteredPassword === tasks[index].password) {
        var projectContent = '<strong>Task No:</strong> ' + tasks[index].taskNo + '<br>' +
          '<strong>Task Name:</strong> ' + tasks[index].taskName + '<br>' +
          '<strong>Description:</strong> ' + tasks[index].description + '<br>' +
          '<strong>Assigned Employees:</strong> ' + tasks[index].assignedEmployees + '<br>' +
          '<strong>Start Date:</strong> ' + tasks[index].startDate + '<br>' +
          '<strong>End Date:</strong> ' + tasks[index].endDate + '<br>' ;
          //'<strong>Files:</strong> <ul>';

        for (var i = 0; i < tasks[index].files.length; i++) {
          var file = tasks[index].files[i];
          projectContent += '<li><a href="#" onclick="downloadFile(\'' + file.name + '\', \'' + file.type + '\', \'' + file.data + '\')">' + file.name + '</a></li>';
        }

        projectContent += '</ul>' +
          '<button class="reply-btn" onclick="openReplyPopup(' + index + ')">Add file</button>' +
          '<button class="view-replies-btn" onclick="viewReplies(' + index + ')">View files</button>' +
          '<div class="view-project-content" id="viewProjectContent' + index + '">' + renderReplies(index) + '</div>';

        var projectCard = document.createElement('div');
        projectCard.className = 'task-card';
        projectCard.innerHTML = projectContent;

        document.getElementById('taskContainer').appendChild(projectCard);
      } else {
        alert('Incorrect password. Access denied.');
      }
    }

    function submitReply() {
      var replyDetails = document.getElementById('replyDetails').value;
      var replyStatus = document.getElementById('replyStatus').value;
      var replyFile = document.getElementById('replyFile').files[0];

      var replyContent = '<strong>Details:</strong> ' + replyDetails + '<br>' +
        '<strong>Status:</strong> ' + replyStatus;

      if (replyFile) {
        var reader = new FileReader();
        reader.onload = function (e) {
          replyContent += '<br><strong>File:</strong> <a href="#" onclick="downloadFile(\'' + replyFile.name + '\', \'' + replyFile.type + '\', \'' + e.target.result + '\')">' + replyFile.name + '</a>';
          tasks[currentIndex].replies.push(replyContent);
          tasks[currentIndex].replyDetails = replyDetails;
          tasks[currentIndex].replyFiles = [{
            name: replyFile.name,
            type: replyFile.type,
            data: e.target.result,
          }];
          var viewProjectContent = document.getElementById('viewProjectContent' + currentIndex);
          if (viewProjectContent) {
            viewProjectContent.innerHTML = renderReplies(currentIndex);
            viewProjectContent.style.display = 'block';
          }
          localStorage.setItem('tasks', JSON.stringify(tasks));
          closeReplyPopup();
        };
        reader.readAsDataURL(replyFile);
      } else {
        tasks[currentIndex].replies.push(replyContent);
        tasks[currentIndex].replyDetails = replyDetails;
        var viewProjectContent = document.getElementById('viewProjectContent' + currentIndex);
        if (viewProjectContent) {
          viewProjectContent.innerHTML = renderReplies(currentIndex);
          viewProjectContent.style.display = 'block';
        }
        localStorage.setItem('tasks', JSON.stringify(tasks));
        closeReplyPopup();
      }
    }

    function renderReplies(index) {
      var replies = tasks[index].replies;
      var replyHtml = '<strong>files:</strong>';

      if (replies.length === 0) {
        replyHtml += ' No replies yet.';
      } else {
        for (var i = 0; i < replies.length; i++) {
          replyHtml += '<div>' + replies[i] + '</div>';
        }
      }

      return replyHtml;
    }

    function viewReplies(index) {
      currentIndex = index;
      var replies = tasks[index].replies;

      var replyContainer = document.createElement('div');
      replyContainer.className = 'reply-card';

      if (replies.length === 0) {
        replyContainer.innerHTML = '<strong>files:</strong> No replies yet.';
      } else {
        replyContainer.innerHTML = '<strong>files details:</strong>';
        for (var i = 0; i < replies.length; i++) {
          replyContainer.innerHTML += '<div>' + replies[i] + '</div>';
        }
      }

      document.getElementById('taskContainer').appendChild(replyContainer);
    }

    function downloadFile(fileName, fileType, fileData) {
      var link = document.createElement('a');
      link.href = fileData;
      link.download = fileName;
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }

    function saveTasks() {
      localStorage.setItem('tasks', JSON.stringify(tasks));
    }

    function editTask(index) {
      var enteredPassword = prompt('Enter the password to edit the task:');

      if (enteredPassword === tasks[index].password) {

        document.getElementById('taskNo').value = tasks[index].taskNo;
        document.getElementById('taskName').value = tasks[index].taskName;
        document.getElementById('description').value = tasks[index].description;
        document.getElementById('assignedEmployees').value = tasks[index].assignedEmployees;
        document.getElementById('startDate').value = tasks[index].startDate;
        document.getElementById('endDate').value = tasks[index].endDate;
        document.getElementById('password').value = tasks[index].password;

        tasks.splice(index, 1);
        localStorage.setItem('tasks', JSON.stringify(tasks));
        renderTasks(null, getFiles());
        openPopup();
      } else {
        alert('Incorrect password. Access denied.');
      }
    }

    function deleteTask(index) {
      var enteredPassword = prompt('Enter the password to delete the task:');

      if (enteredPassword === tasks[index].password) {
        tasks.splice(index, 1);
        localStorage.setItem('tasks', JSON.stringify(tasks));
        renderTasks(null, getFiles());
      } else {
        alert('Incorrect password. Access denied.');
      }
    }

    function filterByEmployee() {
      var filterValue = document.getElementById('filterEmployee').value.toLowerCase();
      var filteredTasks = tasks.filter(function (task) {
        return task.assignedEmployees.toLowerCase().includes(filterValue);
      });
      renderTasks(filteredTasks, getFiles());
    }

    renderTasks(null, getFiles());

    function refreshPage() {
      localStorage.clear();
      tasks = [];
      renderTasks();
    }
  </script>

</body>
</html>


@endsection

