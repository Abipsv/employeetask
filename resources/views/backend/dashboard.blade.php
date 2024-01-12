@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row clearfix g-3">
                <div class="col-xl-8 col-lg-12 col-md-12 flex-column">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Employees Info</h6>
                                </div>
                                <div class="card-body">
                                    <div class="ac-line-transparent" id="apex-emplyoeeAnalytics"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Employees Availability</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-2 row-deck">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body ">
                                                    <i class="icofont-checked fs-3"></i>
                                                    <h6 class="mt-3 mb-0 fw-bold small-14">Attendance</h6>
                                                    <span class="text-muted">400</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body ">
                                                        <i class="icofont-stopwatch fs-3"></i>
                                                    <h6 class="mt-3 mb-0 fw-bold small-14">Late Coming</h6>
                                                    <span class="text-muted">17</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body ">
                                                        <i class="icofont-ban fs-3"></i>
                                                    <h6 class="mt-3 mb-0 fw-bold small-14">Absent</h6>
                                                    <span class="text-muted">06</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body ">
                                                    <i class="icofont-beach-bed fs-3"></i>
                                                    <h6 class="mt-3 mb-0 fw-bold small-14">Leave Apply</h6>
                                                    <span class="text-muted">14</span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Total Employees</h6>
                                    <h4 class="mb-0 fw-bold ">423</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mt-3" id="apex-MainCategories"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Top Hiring Sources</h6>
                                </div>
                                <div class="card-body">
                                    <div id="hiringsources"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="row g-3 row-deck">
                        <div class="col-md-6 col-lg-6 col-xl-12">
                            <div class="card bg-primary">
                                <div class="card-body row">
                                    <div class="col">
                                        <span class="avatar lg bg-white rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-file-text fs-5"></i></span>
                                        <h1 class="mt-3 mb-0 fw-bold text-white">1546</h1>
                                        <span class="text-white">Applications</span>
                                    </div>
                                    <div class="col">
                                        <img class="img-fluid" src="{{ url('/').'/images/interview.svg' }}" alt="interview">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-12  flex-column">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-fill">
                                        <span class="avatar lg light-success-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-users-alt-2 fs-5"></i></span>
                                        <div class="d-flex flex-column ps-3  flex-fill">
                                            <h6 class="fw-bold mb-0 fs-4">246</h6>
                                            <span class="text-muted">Interviews</span>
                                        </div>
                                        <i class="icofont-chart-bar-graph fs-3 text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-fill">
                                        <span class="avatar lg light-success-bg rounded-circle text-center d-flex align-items-center justify-content-center"><i class="icofont-holding-hands fs-5"></i></span>
                                        <div class="d-flex flex-column ps-3 flex-fill">
                                            <h6 class="fw-bold mb-0 fs-4">101</h6>
                                            <span class="text-muted">Hired</span>
                                        </div>
                                        <i class="icofont-chart-line fs-3 text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Upcomming Interviews</h6>
                            </div>
                            <div class="card-body">
                                <div class="flex-grow-1">
                                    <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                        <div class="d-flex align-items-center flex-fill">
                                            <img class="avatar lg rounded-circle img-thumbnail" src="{{ url('/').'/images/lg/avatar2.jpg' }}" alt="profile">
                                            <div class="d-flex flex-column ps-3">
                                                <h6 class="fw-bold mb-0 small-14">Natalie Gibson</h6>
                                                <span class="text-muted">Ui/UX Designer</span>
                                            </div>
                                        </div>
                                        <div class="time-block text-truncate">
                                            <i class="icofont-clock-time"></i> 1.30 - 1:30
                                        </div>
                                    </div>
                                    <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                        <div class="d-flex align-items-center flex-fill">
                                            <img class="avatar lg rounded-circle img-thumbnail" src="{{ url('/').'/images/lg/avatar9.jpg' }}" alt="profile">
                                            <div class="d-flex flex-column ps-3">
                                                <h6 class="fw-bold mb-0 small-14">Peter	Piperg</h6>
                                                <span class="text-muted">Web Design</span>
                                            </div>
                                        </div>
                                        <div class="time-block text-truncate">
                                            <i class="icofont-clock-time"></i> 9.00 - 1:30
                                        </div>
                                    </div>
                                    <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                        <div class="d-flex align-items-center flex-fill">
                                            <img class="avatar lg rounded-circle img-thumbnail" src="{{ url('/').'/images/lg/avatar12.jpg' }}" alt="profile">
                                            <div class="d-flex flex-column ps-3">
                                                <h6 class="fw-bold mb-0 small-14">Robert Young</h6>
                                                <span class="text-muted">PHP Developer</span>
                                            </div>
                                        </div>
                                        <div class="time-block text-truncate">
                                            <i class="icofont-clock-time"></i> 1.30 - 2:30
                                        </div>
                                    </div>
                                    <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                        <div class="d-flex align-items-center flex-fill">
                                            <img class="avatar lg rounded-circle img-thumbnail" src="{{ url('/').'/images/lg/avatar8.jpg' }}" alt="profile">
                                            <div class="d-flex flex-column ps-3">
                                                <h6 class="fw-bold mb-0 small-14">Victoria Vbell</h6>
                                                <span class="text-muted">IOS Developer</span>
                                            </div>
                                        </div>
                                        <div class="time-block text-truncate">
                                            <i class="icofont-clock-time"></i> 2.00 - 3:30
                                        </div>
                                    </div>
                                    <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                        <div class="d-flex align-items-center flex-fill">
                                            <img class="avatar lg rounded-circle img-thumbnail" src="{{ url('/').'/images/lg/avatar7.jpg' }}" alt="profile">
                                            <div class="d-flex flex-column ps-3">
                                                <h6 class="fw-bold mb-0 small-14">Mary Butler</h6>
                                                <span class="text-muted">Writer</span>
                                            </div>
                                        </div>
                                        <div class="time-block text-truncate">
                                            <i class="icofont-clock-time"></i> 4.00 - 4:30
                                        </div>
                                    </div>
                                    <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                                        <div class="d-flex align-items-center flex-fill">
                                            <img class="avatar lg rounded-circle img-thumbnail" src="{{ url('/').'/images/lg/avatar3.jpg' }}" alt="profile">
                                            <div class="d-flex flex-column ps-3">
                                                <h6 class="fw-bold mb-0 small-14">Youn Bel</h6>
                                                <span class="text-muted">Unity 3d</span>
                                            </div>
                                        </div>
                                        <div class="time-block text-truncate">
                                            <i class="icofont-clock-time"></i> 7.00 - 8.00
                                        </div>
                                    </div>
                                    <div class="py-2 d-flex align-items-center  flex-wrap">
                                        <div class="d-flex align-items-center flex-fill">
                                            <img class="avatar lg rounded-circle img-thumbnail" src="{{ url('/').'/images/lg/avatar2.jpg' }}" alt="profile">
                                            <div class="d-flex flex-column ps-3">
                                                <h6 class="fw-bold mb-0 small-14">Gibson Butler</h6>
                                                <span class="text-muted">Networking</span>
                                            </div>
                                        </div>
                                        <div class="time-block text-truncate">
                                            <i class="icofont-clock-time"></i> 8.00 - 9.00
                                        </div>
                                    </div>
                                </div>
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
                        /* Your existing styles here */
                
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
                        .employee-cards-row1 .card1 {
                            width: 200px;
                            margin-right: 20px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            background-color: #CCCCFF;
                            text-align: center;
                            border-radius: 15px;
                            overflow-x: auto;
                            flex: 0 0 calc(20% - 20px);
                            padding: 15px;
                            
                        }
                        .employee-cards-row1{
                            display: flex;
                            overflow: auto;
                        }
                
                        .card-img{
                            width: 100px;
                        }
                        .employee-cards-row1 .card1 p,
                        .employee-cards-row1 .card1 h6 {
                            font-weight: bold;
                            font-size: 16px;
                        }
                
                        /* Updated responsive styles */
                        @media screen and (max-width: 767px) {
                            .employee-cards-row1 {
                                flex-wrap: wrap;
                            }
                
                            .employee-cards-row1 .card1 {
                                flex: 0 0 100%;
                                margin-bottom: 10px;
                            }
                        }
                
                        .card-rating1 {
                            color: green;
                            font-size: 30px;
                        }
                        .employee-cards-row {
    display: flex;
    overflow-x: auto; 
    margin-bottom: 20px; /* Add margin at the bottom for better spacing */
}

.employee-cards-row .card {
    display:flex;
    width: 200px; 
    margin-right: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #FFDAE9;
    text-align: center;
    border-radius: 15px;
    overflow-x: auto; 
    flex: 0 0 calc(20% - 20px);
    padding: 15px;
}

@media screen and (max-width: 767px) {
    .employee-cards-row {
        flex-wrap: nowrap; /* Allow wrapping on small screens */
        justify-content: flex-start;
    }

    .employee-cards-row .card {
        flex: 0 0 100%;
        margin-right: 0;
        display:flex;
    }
}
.delcol1{
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

.employee-cards-row1 .card1 p:first-child {
    /* Styles for the first <p> element (Employee ID) */
        background-color: #011F5B; /* Background color for the employee ID */
    color: white; /* Text color for the employee ID */
    padding: 5px; /* Adjust padding as needed */
    border-radius: 20px;
    box-sizing: content-box;
    width: 80px; 
    display: block;
    margin-left: auto;
    margin-right: auto;/* Add border-radius for rounded corners */
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
        .employee-cards-row1 {
            display: flex;
            overflow-x: auto; /* Allow horizontal scrolling */
        }

        .employee-cards-row1 .card1 {
            width: 200px;
            margin-right: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #CCCCFF;
            text-align: center;
            border-radius: 15px;
            overflow-x: auto;
            flex: 0 0 calc(20% - 20px);
            padding: 15px;
        }

        .employee-cards-row1 .card1 img {
            width: 85px;
            border-radius: 80%;
            object-fit: cover;
        }

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
        }

        /* Updated responsive styles */
        @media screen and (max-width: 767px) {
            .employee-cards-row1 {
                flex-wrap: nowrap; /* Allow wrapping on small screens */
                justify-content: flex-start;
            }

            .employee-cards-row1 .card1 {
                flex: 0 0 100%;
                margin-right: 0;
                display: flex;
            }
        }
        .butstar{
            display: none;
        }
        @media screen and (max-width: 600px) {
            .card1 {
                width: 100%; /* Each card takes 100% width on screens <= 600px */
            }}
                    </style>
                    <title>Employee Star Rating</title>
                </head>
                
                <body>
                
                    <div class="container1">
                        <div class="butstar">
                        <button id="starRateBtn1" onclick="openPopup1()">Add monthly star Rate</button><br><br></div>
                    
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
                            <input type="text" id="empIdFilter1" class="filter-input" placeholder="Employee ID">
                            <input type="month" id="monthFilter1" class="filter-input">
                            <button id="apply1" onclick="applyFilters1()">Apply Filters</button>
                        </div><br>
                        <div id="employeeCards1" class="employee-cards-row1"></div>
                    </div>
                
                    <script>
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
                
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script> 
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/hr.js') }}"></script>

@endsection
