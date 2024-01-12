@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    button {
      background-color: midnightblue;
      color: white;
      padding: 10px 20px;
      margin: 5px;
      cursor: pointer;
      border: none;
      border-radius: 5px;
    }

    /* Style the popup form */
    #popup {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      position: fixed;
      top: 50%;
      left: 50%;
      padding: 20px;
    }

    /* Style the form input fields */
    input {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      box-sizing: border-box;
    }

    #popup button:nth-of-type(1) {
      background-color: #008CBA;
      color: white;
    }

    /* Style the Delete button in the popup */
    #popup button:nth-of-type(2) {
      background-color: #f44336;
      color: white;
    }

    /* Style the Close button in the popup */
    #popup button:nth-of-type(3) {
      background-color: #555;
      color: white;
    }

    #calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 5px;
      width: 70%;
      height: 70%;
      margin-top: 20px;
    }

    .day {
      position: relative;
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
      cursor: pointer;
    }

    .label {
      font-weight: bold;
    }

    .highlight {
      background-color: pink;
    }

    .date-text {
      font-size: 18px;
    }

    #monthYear {
      margin-top: 10px;
      font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
      #calendar {
        max-width: 300px;
      }
    }
  </style>
  <title>Calendar with Popup Form</title>
</head>

<body>

  <div id="monthYear"></div>

  <button onclick="prevMonth()">Previous Month</button>
  <button onclick="nextMonth()">Next Month</button>

  <div id="calendar"></div>

  <div id="popup" class="popup">
    <label for="eventDate">Event Date:</label>
    <input type="date" id="eventDate" required>
    <br>
    <label for="eventName">Event Name:</label>
    <input type="text" id="eventName" required>
    <br>
    <button onclick="saveEvent()">Save</button>
    <button onclick="deleteEvent()">Delete</button>
    <button onclick="closePopup()">Close</button>
  </div>

  <script>
    // Retrieve events from localStorage
    const storedEvents = localStorage.getItem('events');
    const events = storedEvents ? JSON.parse(storedEvents) : {};

    let currentEventDate = '';
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    document.addEventListener('DOMContentLoaded', function () {
      buildCalendar();
      updateMonthYear();
    });

    function buildCalendar() {
      const calendar = document.getElementById('calendar');

      // Create days in the calendar
      const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

      for (let i = 1; i <= daysInMonth; i++) {
        const day = document.createElement('div');
        day.classList.add('day');
        day.addEventListener('click', function () {
          openPopup(i);
        });

        // Get the day of the week for the current date
        const dayOfWeek = new Date(currentYear, currentMonth, i).getDay();
        const dayOfWeekText = getDayOfWeekText(dayOfWeek);

        // Check if events are stored for this day
        const dayDate = getDayDate(i, currentMonth, currentYear);
        if (events[dayDate]) {
          day.classList.add('highlight');
          day.innerHTML = `<span class="date-text">${i}</span><br>${dayOfWeekText}<br>${events[dayDate].join('<br>')}`;
        } else {
          day.innerHTML = `<span class="date-text">${i}</span><br>${dayOfWeekText}`;
        }

        calendar.appendChild(day);
      }
    }

    function getDayOfWeekText(dayOfWeek) {
      const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      return daysOfWeek[dayOfWeek];
    }

    function openPopup(day) {
      const popup = document.getElementById('popup');
      popup.style.display = 'block';

      // Set the default date in the popup
      const eventDateInput = document.getElementById('eventDate');
      const defaultDate = getDayDate(day, currentMonth, currentYear);
      eventDateInput.value = defaultDate;

      currentEventDate = defaultDate;
    }

    function saveEvent() {
      const eventDate = document.getElementById('eventDate').value;
      const eventName = document.getElementById('eventName').value;

      // Store the event in the events object using the date as the key
      if (!events[eventDate]) {
        events[eventDate] = [];
      }
      events[eventDate].push(eventName);

      // Store events in localStorage
      localStorage.setItem('events', JSON.stringify(events));

      updateCalendar();

      closePopup();
    }

    function deleteEvent() {
      // Check if the current event date is set
      if (currentEventDate && events[currentEventDate]) {
        // Remove the entire entry for the current date
        delete events[currentEventDate];

        // Store events in localStorage
        localStorage.setItem('events', JSON.stringify(events));

        updateCalendar();
      }

      closePopup();
    }

    function closePopup() {
      const popup = document.getElementById('popup');
      popup.style.display = 'none';
    }

    function updateCalendar() {
      const calendar = document.getElementById('calendar');

      // Reset the calendar
      calendar.innerHTML = '';

      buildCalendar();
    }

    function getDayDate(day, month, year) {
      const paddedMonth = month < 9 ? '0' + (month + 1) : month + 1;
      const paddedDay = day < 10 ? '0' + day : day;
      return `${year}-${paddedMonth}-${paddedDay}`;
    }

    function updateMonthYear() {
      const monthYearElement = document.getElementById('monthYear');
      const monthYearString = new Date(currentYear, currentMonth).toLocaleDateString('en-US', {
        month: 'long',
        year: 'numeric'
      });
      monthYearElement.textContent = monthYearString;
    }

    function prevMonth() {
      currentMonth--;
      if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
      }
      updateCalendar();
      updateMonthYear();
    }

    function nextMonth() {
      currentMonth++;
      if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
      }
      updateCalendar();
      updateMonthYear();
    }
  </script>

</body>

</html>


@endsection