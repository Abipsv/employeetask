@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<!-- Body: Body -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holiday CRUD</title>
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
            border: 1px solid #ccc;
            z-index: 2;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .popup label {
            display: block;
            margin-bottom: 10px;
            width: 500px;
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

        #holidayTable {
            margin-top: 30px;
            border-collapse: collapse;
            width: 100%;
            overflow-x: auto;
        }

        #holidayTable th, #holidayTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #holidayTable th {
            background-color: midnightblue;
            color: white;
        }

        .starbut {
            background: rgb(35, 35, 139);
            color: white;
            border: none;
            padding: 10px;
            width: 100px;
            border-radius: 10px;
        }

        .edit {
            background-color: green;
            color: white;
            padding: 5px;
            margin: 5px;
            border: none;
            width: 50px;
        }

        .delete {
            background-color: red;
            color: white;
            padding: 5px;
            margin: 5px;
            border: none;
            width: 50px;
        }

        #holidayTable td:nth-child(2) {
            background-color: plum;
            font-weight: 800;
            text-align: center;
        }

        @media only screen and (max-width: 600px) {
            #holidayTable {
                overflow-x: auto;
            }
            .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            z-index: 2;
        }
        .popup label {
            display: block;
            margin-bottom: 10px;
            width: 300px;
        }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: midnightblue;
            color: #fff;
        }

        /* Filter Styles */
        label[for="filterByMonth"] {
            margin-right: 10px;
            font-weight: bold;
            color: rgb(35, 35, 139);
            
        }

        #filterByMonth {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div>
    <h2 style="color: rgb(35, 35, 139);">Holidays</h2>
    <label for="filterByMonth">Filter by Month:</label>
    <input type="month" id="filterByMonth" onchange="filterByMonth()" />
    <button onclick="openPopup()" class="starbut">Add Holiday</button>
    <table id="holidayTable">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Holiday Name</th>
                <th>Holiday Date</th>
                <th>Holiday Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="holidayList"></tbody>
    </table>
</div>

<div class="overlay" id="overlay"></div>
<div class="popup" id="popup">
    <h2 style="color: rgb(35, 35, 139)">Add Holiday</h2>
    <label for="popupHolidayName" class="len">Holiday Name:</label>
    <input type="text" id="popupHolidayName" name="popupHolidayName" required>

    <label for="popupHolidayDate">Holiday Date:</label>
    <input type="date" id="popupHolidayDate" name="popupHolidayDate" required>

    <label for="popupHolidayDay">Holiday Day:</label>
    <input type="text" id="popupHolidayDay" name="popupHolidayDay" required>

    <input type="hidden" id="popupHolidayIndex" name="popupHolidayIndex">

    <button class="save" onclick="saveHoliday()">Save</button>
    <button class="close" onclick="closePopup()">Close</button>
</div>

<script>
    let holidays = JSON.parse(localStorage.getItem("holidays")) || [];
    let popup = document.getElementById("popup");
    let overlay = document.getElementById("overlay");

    displayHolidays();

    function openPopup() {
        document.getElementById("popupHolidayName").value = "";
        document.getElementById("popupHolidayDate").value = "";
        document.getElementById("popupHolidayDay").value = "";
        document.getElementById("popupHolidayDate").removeAttribute("disabled");
        document.getElementById("popupHolidayIndex").value = "";

        popup.style.display = "block";
        overlay.style.display = "block";
    }

    function closePopup() {
        popup.style.display = "none";
        overlay.style.display = "none";
    }

    function saveHoliday() {
        var holidayName = document.getElementById("popupHolidayName").value;
        var holidayDate = document.getElementById("popupHolidayDate").value;
        var holidayDay = document.getElementById("popupHolidayDay").value;
        var holidayIndex = document.getElementById("popupHolidayIndex").value;

        if (holidayName === "" || holidayDate === "") {
            alert("Please fill in all fields");
            return;
        }

        var holiday = {
            name: holidayName,
            date: holidayDate,
            day: holidayDay
        };

        if (holidayIndex === "") {
            holidays.push(holiday);
        } else {
            holidays[holidayIndex] = holiday;
        }

        localStorage.setItem("holidays", JSON.stringify(holidays));
        displayHolidays();
        closePopup();
        document.getElementById("popupHolidayName").value = "";
        document.getElementById("popupHolidayDate").value = "";
        document.getElementById("popupHolidayDay").value = "";
        document.getElementById("popupHolidayIndex").value = "";
    }

    function displayHolidays(filteredHolidays) {
        var holidayList = document.getElementById("holidayList");
        while (holidayList.firstChild) {
            holidayList.removeChild(holidayList.firstChild);
        }

        var holidaysToDisplay = filteredHolidays || holidays;

        holidaysToDisplay.forEach(function (holiday, index) {
            var row = holidayList.insertRow(index);
            var sNoCell = row.insertCell(0);
            sNoCell.textContent = index + 1;
            var nameCell = row.insertCell(1);
            nameCell.textContent = holiday.name;
            var dateCell = row.insertCell(2);
            dateCell.textContent = holiday.date;
            var dayCell = row.insertCell(3);
            dayCell.textContent = holiday.day;
            var actionsCell = row.insertCell(4);
            actionsCell.innerHTML = '<button class="edit" onclick="editHoliday(' + index + ')">Edit</button>' +
                '<button class="delete" onclick="deleteHoliday(' + index + ')">Delete</button>';
        });
    }

    function editHoliday(index) {
        var holiday = holidays[index];
        document.getElementById("popupHolidayName").value = holiday.name;
        document.getElementById("popupHolidayDate").value = holiday.date;
        document.getElementById("popupHolidayDay").value = holiday.day;
        document.getElementById("popupHolidayDate").setAttribute("disabled", "disabled");
        document.getElementById("popupHolidayIndex").value = index;
        openPopup();
    }

    function deleteHoliday(index) {
        holidays.splice(index, 1);
        localStorage.setItem("holidays", JSON.stringify(holidays));
        displayHolidays();
    }

    function filterByMonth() {
        var selectedMonth = document.getElementById("filterByMonth").value;
        var filteredHolidays = holidays.filter(function (holiday) {
            return holiday.date.startsWith(selectedMonth);
        });

        displayHolidays(filteredHolidays);
    }
</script>

</body>
</html>
@endsection
