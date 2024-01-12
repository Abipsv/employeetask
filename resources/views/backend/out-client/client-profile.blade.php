@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
   

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-2S8DAqgGvxh43WnONF4O6nDBtg8ojNc5poyab6+RdciJl9TK/sKe4T5gMkBy3j5YHzVz1N4GTkByiFv0u98fg==" crossorigin="anonymous" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    #achieveForm {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .card {
      border: none;
      padding: 15px;
      margin: 15px;
      width: 300px;
      float: left;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
      transition: transform 0.3s ease-in-out;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      background-color: #FFEFD5;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card img {
      width: 120px; /* Adjust the size as needed */
      border-radius: 50%; /* Creates a circular image */
      margin-bottom: 15px;
    }

    .card p {
      margin-bottom: 5px;
      text-align: center;
    }

    .card strong {
      color: #333;
      text-align: center;
    }


    .achieve-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .achieve-icon {
      font-size: 24px;
      color: gold;
      margin-bottom: 10px;
    }

    #achieveForm {
      background: rgba(255, 255, 255, 0.9);
    }
    #achieveForm {
      background: rgba(255, 255, 255, 0.9);
    }

    #loginForm {
      background: rgba(255, 255, 255, 0.9);
    }
    .add{
      display: none;
    }
    #addAchievementButton {
  display: none;
}
#loginForm {
  display: none;
}

#addAchievementButton {
  display: none;
}
#loginForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 999;
            width: 300px;
        }

        #loginForm label {
            display: block;
            margin-bottom: 5px;
        }

        #loginForm input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #loginForm button, #logbut {
            background-color: midnightblue;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 3px;
            cursor: pointer;
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
        #leaveType, #assignedByText, #status, #monthYear {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .empid1{
          margin: 10px;
          width: 100px;
          color:wheat;
          font-size: 20px;
        }
        .empname1{
          color: maroon;
          font-style: italic;
          font-size: 20px;
        }
.achieve-title{
  font-style: italic;
  background-color: skyblue;
padding: 3px;
border-radius: 5px;
  border-color: maroon;
  font-size: 16px;

}
  </style>
</head>
<body>
  <button type="button" id="logbut" onclick="openLoginForm()">Login</button>
  <!-- Add this form to your existing HTML -->
<div id="loginForm">
  <h2>Login</h2>
  <form >
    <label for="username">Username:</label>
    <input type="text" id="username" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" required><br>

    <button type="button" onclick="authenticateUser()">Login</button>
  </form>
</div>

<br><br>
<button id="addAchievementButton" class="lea" onclick="openAchieveForm()">Add Achievement</button>


<div id="achieveForm">
  <h2>Add Achievement</h2>
  <form id="form">
    <label for="employeeId">Employee ID:</label>
    <input type="text" id="employeeId" required><br>

    <label for="image">Upload Image:</label>
    <input type="file" id="image" accept="image/*" onchange="previewImage()" required><br>
    <img id="imagePreview" style="max-width: 100%; max-height: 200px; margin-top: 10px; display: none;" alt="Image Preview">

    <label for="employeeName">Employee Name:</label>
    <input type="text" id="employeeName" required><br>

    <label for="monthYear">Month and Year:</label>
    <select id="monthYear" required>
      <option value="January">January</option>
      <option value="February">February</option>
      <option value="March">March</option>
      <option value="April">April</option>
      <option value="May">May</option>
      <option value="June">June</option>
      <option value="July">July</option>
      <option value="August">August</option>
      <option value="September">September</option>
      <option value="October">October</option>
      <option value="November">November</option>
      <option value="December">December</option>
    </select><br>

    <label for="reason">Reason of Achievement:</label>
    <textarea id="reason" required></textarea><br>

    <button type="button" class="lea" onclick="saveAchievement()">Save</button>
  </form>
</div>

<div id="achieveCards"></div>

<script>
  // Load saved achievements on page load
  // Add these global variables
// Add these global variables
// Add this global variable
let isLoginFormVisible = false;

function openLoginForm() {
  isLoginFormVisible = true;
  document.getElementById('loginForm').style.display = 'block';
}

function openAchieveForm() {
  if (isLoggedIn) {
    document.getElementById('achieveForm').style.display = 'block';
  } else if (isLoginFormVisible) {
    document.getElementById('loginForm').style.display = 'block';
  } else {
    alert('Please login first.'); // or handle as per your requirement
  }
}

function authenticateUser() {
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  // Replace this with your actual authentication logic
  if (username === 'employee@month' && password === 'employee@psv') {
    isLoggedIn = true;
    isLoginFormVisible = false;
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('addAchievementButton').style.display = 'block'; // Show the "Add Achievement" button
  } else {
    alert('Invalid credentials. Please try again.');
  }
}


  window.onload = function () {
    loadAchievements();
  };

  function openAchieveForm() {
    document.getElementById('achieveForm').style.display = 'block';
  }

  function saveAchievement() {
    // Get form values
    const employeeId = document.getElementById('employeeId').value;
    const image = document.getElementById('imagePreview').src;
    const employeeName = document.getElementById('employeeName').value;
    const monthYear = document.getElementById('monthYear').value;
    const reason = document.getElementById('reason').value;

    // Create a card and display data
    const card = document.createElement('div');
    card.className = 'card';
    card.innerHTML = `
      
      <img src="${image}" alt="Achievement Image">
      <div class="achieve-icon">&#127942;</div>
      <div class="achieve-title">Employee of the Month</div>
      <div class="achieve-icon">&#11088;&#11088;&#11088;&#11088;&#11088;</div>

      <p class="empid1"><span style="background-color: midnightblue;font-weight: bold;">${employeeId}</span></p>
      <p class="empname1"><span style="font-weight: bold;">${employeeName}</span></p>
      <p><strong>Month</strong> <span style="font-weight: bold; color:green; font-size:18px;"> ${monthYear}</span></p>
      <p><strong>Reason:</strong> <span style="font-weight: bold; color:midnightblue"> ${reason}</span></p>
    `;

    // Add card to the list
    document.getElementById('achieveCards').appendChild(card);

    // Save achievement data to localStorage
    saveToLocalStorage(employeeId, image, employeeName, monthYear, reason);

    // Reset form values
    document.getElementById('form').reset();
    document.getElementById('imagePreview').style.display = 'none';

    // Close the form
    document.getElementById('achieveForm').style.display = 'none';
  }

  function previewImage() {
    const input = document.getElementById('image');
    const preview = document.getElementById('imagePreview');
    const file = input.files[0];

    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  }

  function saveToLocalStorage(employeeId, image, employeeName, monthYear, reason) {
    // Retrieve existing achievements from localStorage
    const achievements = JSON.parse(localStorage.getItem('achievements')) || [];

    // Add the new achievement to the list
    const newAchievement = {
      employeeId,
      image,
      employeeName,
      monthYear,
      reason,
    };
    achievements.push(newAchievement);

    // Save the updated list back to localStorage
    localStorage.setItem('achievements', JSON.stringify(achievements));
    const deleteButton = document.createElement('button');
    deleteButton.innerText = 'Delete';
    deleteButton.onclick = function () {
      deleteAchievement(employeeId);
    };
    card.appendChild(deleteButton);
  }
  function deleteAchievement(employeeId) {
    // Retrieve existing achievements from localStorage
    let achievements = JSON.parse(localStorage.getItem('achievements')) || [];

    // Find the index of the achievement to be deleted
    const index = achievements.findIndex((achievement) => achievement.employeeId === employeeId);

    // Remove the achievement from the list
    achievements.splice(index, 1);

    // Save the updated list back to localStorage
    localStorage.setItem('achievements', JSON.stringify(achievements));

    // Reload achievements on the page
    document.getElementById('achieveCards').innerHTML = '';
    loadAchievements();
  }
  function loadAchievements() {
    // Retrieve achievements from localStorage
    const achievements = JSON.parse(localStorage.getItem('achievements')) || [];

    // Display each achievement
    achievements.forEach((achievement) => {
      const card = document.createElement('div');
      card.className = 'card';
      card.innerHTML = `
       
        <img src="${achievement.image}" alt="Achievement Image">
         <div class="achieve-icon">&#127942;</div>
        <div class="achieve-title">Employee of the Month</div>
        <div class="achieve-icon">&#11088;&#11088;&#11088;&#11088;&#11088;</div>

        <p class="empid1"><span style="background-color: midnightblue;font-weight: bold;">${achievement.employeeId}</span></p>
        <p class="empname1"><span style="font-weight: bold;">${achievement.employeeName}</span></p>
        <p><strong>Month </strong> <span style="font-weight: bold; color:green; font-size:18px;"> ${achievement.monthYear}</span></p>
        <p><strong>Reason:</strong> <span style="font-weight: bold; color:midnightblue"> ${achievement.reason}<span></p>
        
        <!-- Add the delete button to each card -->
      
      `;
      document.getElementById('achieveCards').appendChild(card);
    });
  }
</script>

</body>
</html>



@endsection
