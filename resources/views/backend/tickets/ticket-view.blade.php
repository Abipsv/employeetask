@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
           #ticketForm{
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1;
            width: 400px;
            height: 600px;
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
        .lea {
                background-color: midnightblue;
                color: white;
                border-style: none;
                border-color: none;
                padding: 10px;
                border-radius: 3px;
            }
        label {
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }
           
    
            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
    
            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
    
            #ticketTable {
                border-collapse: collapse;
                width: 80%;
                margin-top: 20px;
            }
    
            #ticketTable th, #ticketTable td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
    
            #ticketTable th {
                background-color: midnightblue;
                color: white;
            }
    
            #ticketTable tr:nth-child(even) {
                background-color: #f2f2f2;
            }
    
            #ticketTable tr:hover {
                background-color: #ddd;
            }
    
            button {
                background-color: midnightblue;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 10px;
            }
    
            button:hover {
                background-color: blue;
            }
    
            button.edit {
                background-color: #2196F3;
            }
    
            button.edit:hover {
                background-color: #0b7dda;
            }
    
            button.delete {
                background-color: #f44336;
            }
    
            button.delete:hover {
                background-color: #da190b;
            }
            #loginForm {
            display: flex;
            flex-direction: column;
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 50px;
        }

        #loginForm label,
        #loginForm input {
            margin-bottom: 10px;
        }

        #ticketSystem {
            display: none;
        }
        #filterTicketId{
            width: 300px;
        }
        </style>
        <title>Ticket System</title>
    </head>
    <body>
        <div id="loginForm">
            <label for="username">Username:</label>
            <input type="text" id="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" required>
            <button type="button" onclick="login()">Login</button>
        </div>
        <div id="ticketSystem">

      <button type="button" onclick="openForm()">Add Ticket</button>
      <label for="filterTicketId">Filter by Ticket ID:</label>
      <input type="text" id="filterTicketId" oninput="filterTickets()">
      <!-- Add a filter button -->
      <button type="button" onclick="filterTickets()">Filter</button>
        <div id="ticketForm" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeForm()">&times;</span>
                <form id="ticketFormContent">
                    <label for="ticketId">Ticket ID:</label>
                    <input type="text" id="ticketId" name="ticketId" required>
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required>
                    <label for="assignedBy">Assigned By:</label>
                    <input type="text" id="assignedBy" name="assignedBy" required>
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
                    <button type="button" onclick="saveTicket()">Save</button>
                </form>
            </div>
        </div>
    
        <table id="ticketTable">
            <!-- Table header -->
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>Subject</th>
                    <th>Assigned By</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <!-- Table body will be populated dynamically -->
            <tbody></tbody>
        </table>
    
     
    
        <script>
  function login() {
                var username = document.getElementById('username').value;
                var password = document.getElementById('password').value;

                // Simulated authentication (replace this with actual authentication logic)
                if (username === 'ticket555' && password === 'psv555') {
                    document.getElementById('loginForm').style.display = 'none';
                    document.getElementById('ticketSystem').style.display = 'block';
                    loadTickets();
                } else {
                    alert('Invalid username or password');
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                loadTickets();
            });

            function openForm() {
                document.getElementById('ticketForm').style.display = 'block';
            }

            function closeForm() {
                document.getElementById('ticketForm').style.display = 'none';
            }

            function saveTicket() {
                // Get form values
                const ticketId = document.getElementById('ticketId').value;
                const subject = document.getElementById('subject').value;
                const assignedBy = document.getElementById('assignedBy').value;
                const date = document.getElementById('date').value;
                const description = document.getElementById('description').value;

                // Validate form
                if (!ticketId || !subject || !assignedBy || !date || !description) {
                    alert('Please fill in all fields.');
                    return;
                }

                // Create ticket object
                const ticket = { ticketId, subject, assignedBy, date, description };

                // Save ticket to localStorage (you may replace this with a server request)
                const tickets = JSON.parse(localStorage.getItem('tickets')) || [];
                tickets.push(ticket);
                localStorage.setItem('tickets', JSON.stringify(tickets));

                // Close form and reload tickets
                closeForm();
                loadTickets();
            }

            function loadTickets(filter = "") {
                // Get tickets from localStorage
                const tickets = JSON.parse(localStorage.getItem('tickets')) || [];

                // If a filter is provided, use it to filter the tickets
                const filteredTickets = filter
                    ? tickets.filter(ticket => ticket.ticketId.includes(filter))
                    : tickets;

                // Populate table body with filtered tickets
                const tbody = document.querySelector('#ticketTable tbody');
                tbody.innerHTML = '';

                filteredTickets.forEach((ticket, index) => {
                    const row = tbody.insertRow();
                    row.innerHTML = `
                        <td>${ticket.ticketId}</td>
                        <td>${ticket.subject}</td>
                        <td>${ticket.assignedBy}</td>
                        <td>${ticket.date}</td>
                        <td>${ticket.description}</td>
                        <td>
                            <button class="edit" onclick="editTicket(${index})">Edit</button>
                            <button class="delete" onclick="deleteTicket(${index})">Delete</button>
                        </td>
                    `;
                });
            }

            function editTicket(index) {
                // Populate form with existing data for editing
                const tickets = JSON.parse(localStorage.getItem('tickets')) || [];
                const ticket = tickets[index];

                document.getElementById('ticketId').value = ticket.ticketId;
                document.getElementById('subject').value = ticket.subject;
                document.getElementById('assignedBy').value = ticket.assignedBy;
                document.getElementById('date').value = ticket.date;
                document.getElementById('description').value = ticket.description;

                // Delete the existing ticket before editing
                tickets.splice(index, 1);
                localStorage.setItem('tickets', JSON.stringify(tickets));

                // Open the form for editing
                openForm();
            }

            function deleteTicket(index) {
                // Remove ticket from localStorage
                const tickets = JSON.parse(localStorage.getItem('tickets')) || [];
                tickets.splice(index, 1);
                localStorage.setItem('tickets', JSON.stringify(tickets));

                // Reload tickets
                loadTickets();
            }

            function filterTickets() {
                const filterTicketId = document.getElementById('filterTicketId').value;
                loadTickets(filterTicketId);
            }
        </script>
    </body>
    </html>
    
@endsection
