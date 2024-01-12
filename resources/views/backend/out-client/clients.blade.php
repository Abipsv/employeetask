@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Your existing styles here */
     
        #loginContainer {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            max-width: 300px;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 100px;
        }

        h2 {
            text-align: center;
        }

        label, input {
            display: block;
            width: 50%;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: midnightblue;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
            width: 100%;
        }

        #employeeCards1 {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center; /* Center the cards on the screen */
        }

        .card1 {
            width: calc(20.33% - 20px); /* Each card takes 33.33% width with gap of 20px */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #CCCCFF;
            text-align: center;
            border-radius: 15px;
            overflow-x: auto;
            padding: 15px;
            margin-bottom: 20px;
        }

        @media screen and (max-width: 600px) {
            .card1 {
                width: 100%; /* Each card takes 100% width on screens <= 600px */
            }
            .popup1{
                margin-top: 100px;
            }
        }
         
        .popup1 {
            /* Updated popup class */
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
            
        }

        /* Updated button and apply styles */
        #starRateBtn1,
        #apply1,
        .dash1 {
            background-color: midnightblue;
            color: white;
            border: none;
            border-radius: 4px;
        }

        /* Updated card styles */
        
        .card-rating1 {
            color: green;
            font-size: 30px;
        }
        
        .employee-cards-row1 .card1 p,
                        .employee-cards-row1 .card1 h6 {
                            font-weight: bold;
                            font-size: 16px;
                        }
.delcol1{
    width: 70px;
background-color: #F88379;
border: none;
border-radius: 4px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.card1 img {
width: 85px; /* Set the maximum width to 100% of the container */
/* Set the maximum height to 100% of the container */
border-radius: 80%; /* Optional: Apply a border-radius for a circular image */
object-fit: cover; /* Optional: Maintain aspect ratio while covering the container */
}
.card-performance1{
background-color: #011F5B;
color: goldenrod;
}

.popup1 input, textarea {
width: 100%;
padding: 10px;
margin-bottom: 10px;
box-sizing: border-box;
border: 1px solid #ccc;
border-radius: 4px;
}

.popup1 label {
margin-bottom: 5px;
color: #333;
font-weight: bold;
}
.log label{
    margin-bottom: 5px;
color: #333;
font-weight: bold;
}
.log input, textarea {
width: 100%;
padding: 10px;
margin-bottom: 10px;
box-sizing: border-box;
border: 1px solid #ccc;
border-radius: 4px;
}


.popup1 {
/* Updated popup class */
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
}

/* Updated button and apply styles */
#starRateBtn1,
#apply1,
.dash1 {
background-color: midnightblue;
color: white;
border: none;
border-radius: 4px;
width: 200px;
}

/* Updated card styles */

.employee-cards-row1 .card1 p:first-child {
background-color: #011F5B;
color: white;
padding: 5px;
border-radius: 20px;
box-sizing: content-box;
width: 80px;
display: block;
margin-left: auto;
margin-right: auto;
font-size: 17px;
font-weight: bold;
}

/* Updated responsive styles */


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
        
            margin-top: 100px;
}

.lea {
            background-color: midnightblue;
            color: white;
            border-style: none;
            border-color: none;
            padding: 10px;
            border-radius: 3px;
        }
        .filter-input{
            width: 100%;
padding: 10px;
margin-bottom: 10px;
box-sizing: border-box;
border: 1px solid #ccc;
border-radius: 4px;
width: 180px;
        }
    
        .filters1 {
        background-color: #f0f0f0;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
        margin-right: -10px;
        margin-top: -72px;

    }

    .right-button {
      text-align: right;
    }

    .button1 {
      display: inline-block;
      padding: 10px 20px;
      background-color: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
    </style>
    <title>Employee Star Rating</title>
</head>

<body>
 
<div id="loginContainer" class="log">
    <h2>Login</h2>
    <label for="username">Username:</label>
    <input type="text" id="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" required>
    <button class="lea" onclick="login()">Login</button>
</div>
<div id="contentContainer" style="display: none;">
    <div class="container1">
        <div class="right-button">
        <button id="starRateBtn1"  class="button1"onclick="openPopup1()">Add monthly star Rate</button><br><br>
        </div>
        <div id="popup1" class="popup1">
            <form id="ratingForm1">
                <label for="employeeId1">Employee ID:</label>
                <input type="text" id="employeeId1" required><br>
                <label for="image1">Upload Image:</label>
                <input type="file" id="image1" accept="image/*"><br>
                <label for="employeeName1">Employee Name:</label>
                <input type="text" id="employeeName1" required><br><br>

                <label for="starRating1">Star Rating:</label>
                <label><input type="radio" name="rating1" value="1" onclick="setStarRating1(1)"></label>
                <label><input type="radio" name="rating1" value="2" onclick="setStarRating1(2)"></label>
                <label><input type="radio" name="rating1" value="3" onclick="setStarRating1(3)"></label>
                <label><input type="radio" name="rating1" value="4" onclick="setStarRating1(4)"></label>
                <label><input type="radio" name="rating1" value="5" onclick="setStarRating1(5)"></label><br><br>

                <label for="month1">Month:</label>
                <input type="month" id="month1" required><br><br>

                <button class="dash1" type="button" onclick="saveData1()">Save</button>
                <button class="dash1" type="button" onclick="closePopup1()">Close</button>
            </form>
        </div>
        <div class="filters1">
            <button id="apply1" onclick="applyFilters1()">Apply Filters</button><br><br>
            <input type="text" id="empIdFilter1" class="filter-input" placeholder="Employee ID">
            <input type="month" id="monthFilter1" class="filter-input">
           <hr>
        </div><br>
        <div id="employeeCards1" class="employee-cards-row1"></div>
    </div>

    <script>
          function login() {
                   
                    var username = document.getElementById('username').value;
                    var password = document.getElementById('password').value;

                  
                    if (username === 'star@month' && password === 'star@psv') {
                        document.getElementById('loginContainer').style.display = 'none';
                        document.getElementById('contentContainer').style.display = 'block';

                       
                        loadEmployeeData1();
                        applyFilters1();
                    } else {
                        alert('Invalid credentials. Please try again.');
                    }
                }
        var selectedStarRating1 = 5;
        var performancePerStar1 = 20;

        document.addEventListener('DOMContentLoaded', function () {
            loadEmployeeData1();
            applyFilters1(); // Call applyFilters1 on page load
        });

        function loadEmployeeData1() {
            var storedData1 = JSON.parse(localStorage.getItem('employeeData1')) || [];
            var employeeCards1 = document.getElementById('employeeCards1');
            employeeCards1.innerHTML = '';

            storedData1.forEach(function (data1) {
                var card1 = createCard1(data1);
                employeeCards1.appendChild(card1);
            });
        }

        function openPopup1() {
            document.getElementById('popup1').style.display = 'block';
        }

        function closePopup1() {
            document.getElementById('popup1').style.display = 'none';
        }

        function setStarRating1(rating1) {
            selectedStarRating1 = rating1;

            var stars1 = document.querySelectorAll('.rating1');
            stars1.forEach(function (star1) {
                star1.style.position = 'relative';
                star1.style.color = 'gold';
                star1.style.fontSize = '100px';
            });

            for (var i = 1; i <= rating1; i++) {
                var star1 = document.querySelector('.rating1:nth-child(' + i + ')');
                star1.style.position = 'relative';
                star1.style.color = '#333';
                star1.style.fontSize = '100px';
            }
        }

        async function saveData1() {
var employeeId1 = document.getElementById('employeeId1').value;
var employeeName1 = document.getElementById('employeeName1').value;
var imageInput1 = document.getElementById('image1');
var image1 = imageInput1.files[0];
var month1 = document.getElementById('month1').value;

var calculatedPerformance1 = selectedStarRating1 * performancePerStar1;

var employeeCards1 = document.getElementById('employeeCards1');
var card1 = document.createElement('div');
card1.className = 'card1';
card1.setAttribute('data-employee-id1', employeeId1);

card1.innerHTML = `
<p class="empid">ID: ${employeeId1}</p>
<img src="${image1 ? await getImageDataUrl1(image1) : ''}" alt="Employee Image">
<p>${employeeName1}</p>
<h1 class="card-rating1"> ${getStarSymbols1(selectedStarRating1)}</h1>
<p class="card-performance1">Performance: ${calculatedPerformance1}%</p>
<p class="card-month1">Month: ${month1}</p>
<div class="card-actions1">
<button type="button" onclick="saveEditedData1()">Save</button>
<button type="button" onclick="closePopup1()">Close</button>
</div>
`;

employeeCards1.appendChild(card1);

var storedData1 = JSON.parse(localStorage.getItem('employeeData1')) || [];
storedData1.push({
employeeId1: employeeId1,
employeeName1: employeeName1,
image1: image1 ? await getImageDataUrl1(image1) : '',
starRating1: selectedStarRating1,
performance1: calculatedPerformance1,
month1: month1
});
localStorage.setItem('employeeData1', JSON.stringify(storedData1));

closePopup1();
applyFilters1(); // Call applyFilters1 after saving data
}


        function getStarSymbols1(count1) {
            return '★'.repeat(count1);
        }

        function createCard1(data1) {
            var card1 = document.createElement('div');
            card1.className = 'card1';
            card1.setAttribute('data-employee-id1', data1.employeeId1);

            card1.innerHTML = `
                <p>ID: ${data1.employeeId1}</p>
                <img src="${data1.image1}" alt="Employee Image">
                <p>${data1.employeeName1}</p>
                <h1 class="card-rating1"> ${getStarSymbols1(data1.starRating1)}</h1>
                <p class="card-performance1">Performance: ${data1.performance1}%</p>
                <p class="card-month1">Month: ${data1.month1}</p>
                <div class="card-actions1">
                    
                    <button class="delcol1" onclick="deleteData1(event)">Delete</button>
                </div>
            `;

            return card1;
        }

        function editData1(card1) {
            var employeeId1 = card1.querySelector('p:nth-child(1)').textContent.split(":")[1].trim();
            var employeeName1 = card1.querySelector('p:nth-child(3)').textContent.trim();
            var starRating1 = parseInt(card1.querySelector('.card-rating1').textContent.split(":")[1].trim());
            var performance1 = parseInt(card1.querySelector('.card-performance1').textContent.split(":")[1].trim());

            document.getElementById('employeeId1').value = employeeId1;
            document.getElementById('employeeName1').value = employeeName1;
            setStarRating1(starRating1);

            openPopup1();

            card1.remove();

            var storedData1 = JSON.parse(localStorage.getItem('employeeData1')) || [];
            storedData1 = storedData1.filter(function (data1) {
                return data1.employeeId1 !== employeeId1;
            });
            localStorage.setItem('employeeData1', JSON.stringify(storedData1));
        }

        function deleteData1(event1) {
            var card1 = event1.target.closest('.card1');
            if (!card1) return;

            var employeeId1 = card1.getAttribute('data-employee-id1');

            var index1 = Array.from(card1.parentNode.children).indexOf(card1);

            card1.remove();

            var storedData1 = JSON.parse(localStorage.getItem('employeeData1')) || [];
            storedData1.splice(index1, 1);

            localStorage.setItem('employeeData1', JSON.stringify(storedData1));

            applyFilters1();
        }

        async function getImageDataUrl1(file1) {
            return new Promise((resolve, reject) => {
                const reader1 = new FileReader();

                reader1.onloadend = () => {
                    resolve(reader1.result);
                };

                reader1.onerror = reject;

                reader1.readAsDataURL(file1);
            });
        }

        function applyFilters1() {
            var empIdFilter1 = document.getElementById('empIdFilter1').value.toLowerCase();
            var monthFilter1 = document.getElementById('monthFilter1').value;

            localStorage.setItem('empIdFilter1', empIdFilter1);
            localStorage.setItem('monthFilter1', monthFilter1);

            var storedData1 = JSON.parse(localStorage.getItem('employeeData1')) || [];
            var filteredData1 = storedData1.filter(function (data1) {
                return (empIdFilter1 === '' || data1.employeeId1.toLowerCase().includes(empIdFilter1)) &&
                    (monthFilter1 === '' || (new Date(data1.month1).toISOString().slice(0, 7) === monthFilter1));
            });

            var employeeCards1 = document.getElementById('employeeCards1');
            employeeCards1.innerHTML = '';

            filteredData1.forEach(function (data1) {
                var card1 = createCard1(data1);
                employeeCards1.appendChild(card1);
            });
        }
    </script>

</body>

</html>


@endsection
