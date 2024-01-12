@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
   
<style>
    form {
    max-width: 600px;
    margin: 0 auto;
    }
    
    label {
    display: block;
    margin-bottom: 8px;
    }
    
    input, select {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
    }
    
    button {
    background-color: midnightblue;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    }
    
    button:hover {
    background-color:midnightblue;
    }
    
    #invoice {
    display: none;
    margin-top: 20px;
    border: 1px solid #ddd;
    padding: 20px;
    position: relative; /* Add this line */
    }
    
    #invoiceHeader {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    }
    
    #invoiceHeader div {
    flex: 1;
    }
    
    #totalAmount {
    text-align: right;
    font-size: 18px;
    margin-top: 20px;
    }
    
    /* New styles */
    #dateStatusContainer {
    position: absolute;
   
    right: 0;
    text-align: left;
    }
    
    #invoiceList {
    margin-bottom: 20px;
    }
    
    #invoiceList ul {
    list-style: none;
    padding: 0;
    margin: 0;
    }
    
    #invoiceList li {
    display: inline-block;
    margin-right: 10px;
    }
    
    @media print {
    form,
    button {
        display: none;
    }
    }
    #popupContainer {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        z-index: 1000;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        max-width: 600px; /* Adjust the max-width as needed */
        width: 100%;
    }

    #overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
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
            input, textarea, #status{
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                box-sizing: border-box; /* Include padding and border in the element's total width and height */
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            label {
               /* Make labels appear on a new line */
                margin-bottom: 5px;
                color: #333; /* Text color */
                font-weight: bold; /* Bold text */
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
            #loginForm{
                background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            max-width: 300px;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 80px;
            
            }
</style>


    
    </head>
    <body>
        <div id="invoiceList">
            <h2>Invoice List</h2>
            <ul id="invoices"></ul>
        </div>
      

        <div id="loginOverlay"></div>
        <div id="loginForm">
            <form id="userLoginForm">
                <label for="username">Username:</label>
                <input type="text" id="username" required>
    
                <label for="password">Password:</label>
                <input type="password" id="password" required>
    
                <button type="button" onclick="checkLogin()">Login</button>
                <button type="button" onclick="closeLoginForm()">Cancel</button>
            </form>
        </div>
        <div id="generateInvoiceForm" style="display: none;">
    <button onclick="openPopup()">Generate Invoice</button>
    
    
      <div id="overlay"></div>
      <div id="popupContainer">
        <form id="invoiceForm">
            <label for="fromAddress">From Address:</label>
            <input type="text" id="fromAddress" required>
    
            <label for="toAddress">To Address:</label>
            <input type="text" id="toAddress" required>
    
            <label for="projectName">Project Name:</label>
            <input type="text" id="projectName" required>
    
            <label for="members">Members:</label>
            <input type="text" id="members" required>
    
            <label for="date">Date:</label>
            <input type="date" id="date" required>
    
            <label for="status">Status:</label>
            <select id="status" required>
                <option value="pending">Pending</option>
                <option value="paid">Paid</option>
            </select>
    
            <label for="clientName">Client Name:</label>
            <input type="text" id="clientName" required>
    
            <label for="itemName">Item Name:</label>
            <input type="text" id="itemName" required>
    
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" required>
    
            <label for="price">Price per Unit:</label>
            <input type="number" id="price" required>
    
            <button type="button" onclick="generateInvoice()">Generate Invoice</button>
        </form>
    
        <div id="invoice">
            <div id="dateStatusContainer">
                <p><strong>Date:</strong> <span id="outputDate"></span></p>
                <p><strong>Status:</strong> <span id="outputStatus"></span></p>
            </div>
            
            <div id="invoiceHeader">
                <div>
                    <p><strong>From Address:</strong> <span id="outputFromAddress"></span></p>
                    <p><strong>To Address:</strong> <span id="outputToAddress"></span></p>
                </div>
                <div></div>
            </div>
    <div>
            <h2>Invoice</h2>
            <p><strong>Client Name:</strong> <span id="outputClientName"></span></p>
            <p><strong>Item Name:</strong> <span id="outputItemName"></span></p>
            <p><strong>Quantity:</strong> <span id="outputQuantity"></span></p>
            <p id="totalAmount"><strong>Total Amount:</strong> $<span id="outputTotalAmount"></span></p><br>
          </div>
          <div>
            <button onclick="printInvoice()">Print</button>
            <button onclick="sendEmail()">Send via Email</button>
            <button onclick="editInvoice()">Edit</button>
            <button onclick="deleteInvoice()">Delete</button>
          </div>
        </div>
      </div>
        <script>
                function openLoginForm() {
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('loginOverlay').style.display = 'block';
        }

        function closeLoginForm() {
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('loginOverlay').style.display = 'none';
        }
        function checkLogin() {
    // Add your authentication logic here
    var enteredUsername = document.getElementById('username').value;
    var enteredPassword = document.getElementById('password').value;

    // Example: Check if the entered username and password are correct
    if (enteredUsername === 'invoice111' && enteredPassword === 'psv111') {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('loginOverlay').style.display = 'none';
        document.getElementById('generateInvoiceForm').style.display = 'block';
    } else {
        alert('Invalid username or password. Please try again.');
    }
}

function openPopup() {
    // Show the invoice form and hide the invoice
    document.getElementById('invoiceForm').style.display = 'block';
    document.getElementById('invoice').style.display = 'none';
}

            function populateForm() {
                const savedData = JSON.parse(localStorage.getItem('invoiceData')) || {};
                document.getElementById('fromAddress').value = savedData.fromAddress || '';
                document.getElementById('toAddress').value = savedData.toAddress || '';
                document.getElementById('projectName').value = savedData.projectName || '';
                document.getElementById('members').value = savedData.members || '';
                document.getElementById('date').value = savedData.date || '';
                document.getElementById('status').value = savedData.status || 'pending';
                document.getElementById('clientName').value = savedData.clientName || '';
                document.getElementById('itemName').value = savedData.itemName || '';
                document.getElementById('quantity').value = savedData.quantity || '';
                document.getElementById('price').value = savedData.price || '';
            }
    
            function saveFormData() {
                const formData = {
                    fromAddress: document.getElementById('fromAddress').value,
                    toAddress: document.getElementById('toAddress').value,
                    projectName: document.getElementById('projectName').value,
                    members: document.getElementById('members').value,
                    date: document.getElementById('date').value,
                    status: document.getElementById('status').value,
                    clientName: document.getElementById('clientName').value,
                    itemName: document.getElementById('itemName').value,
                    quantity: document.getElementById('quantity').value,
                    price: document.getElementById('price').value
                };
    
                localStorage.setItem('invoiceData', JSON.stringify(formData));
            }
            
            function openPopup() {
        document.getElementById('popupContainer').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('popupContainer').style.display = 'none';
    }
            function generateInvoice() {
                const fromAddress = document.getElementById('fromAddress').value;
                const toAddress = document.getElementById('toAddress').value;
                const projectName = document.getElementById('projectName').value;
                const members = document.getElementById('members').value;
                const date = document.getElementById('date').value;
                const status = document.getElementById('status').value;
                const clientName = document.getElementById('clientName').value;
                const itemName = document.getElementById('itemName').value;
                const quantity = parseFloat(document.getElementById('quantity').value);
                const price = parseFloat(document.getElementById('price').value);
    
                const totalAmount = quantity * price;
    
                document.getElementById('outputFromAddress').innerText = fromAddress;
                document.getElementById('outputToAddress').innerText = toAddress;
                document.getElementById('outputDate').innerText = date;
                document.getElementById('outputStatus').innerText = status;
                document.getElementById('outputClientName').innerText = clientName;
                document.getElementById('outputItemName').innerText = itemName;
                document.getElementById('outputQuantity').innerText = quantity;
                document.getElementById('outputTotalAmount').innerText = totalAmount.toFixed(2);
    
                document.getElementById('invoiceForm').style.display = 'none';
                document.getElementById('invoice').style.display = 'block';
    
                saveFormData();
                
            }
            function printInvoice() {
        // Retrieve details from the form
        const fromAddress = document.getElementById('fromAddress').value;
        const toAddress = document.getElementById('toAddress').value;
        const date = document.getElementById('date').value;
        const status = document.getElementById('status').value;
        const clientName = document.getElementById('clientName').value;
        const itemName = document.getElementById('itemName').value;
        const quantity = parseFloat(document.getElementById('quantity').value);
        const totalAmount = parseFloat(document.getElementById('outputTotalAmount').innerText);

        // Create a new window for printing
        const printWindow = window.open('', '_blank');

        // Build the HTML content for the print window
        const printContent = `
            <html>
                <head>
                    <title>Print Invoice</title>
                    <style>
                        body {
                            font-family: 'Arial', sans-serif;
                            color: #333;
                            background-color: #fff;
                        }

                        #invoice {
                            margin: 20px;
                            border: 2px solid #000;
                            padding: 20px;
                            background-color: #f5f5f5;
                        }

                        #invoiceHeader {
                            border-bottom: 1px solid #000;
                            margin-bottom: 20px;
                            padding-bottom: 10px;
                        }

                        #dateStatusContainer {
                            text-align: right;
                            margin-top: 20px;
                            color: #777;
                        }

                        #invoiceList {
                            margin-bottom: 20px;
                        }

                        #invoiceList ul {
                            list-style: none;
                            padding: 0;
                            margin: 0;
                        }

                        #invoiceList li {
                            display: inline-block;
                            margin-right: 10px;
                        }
                    </style>
                </head>
                <body>
                    <h2 style="text-align:center; font-style:bold;">PSV Media</h4>
                        <h4 style="text-align:center; font-style:italic; background-color:orange;">Innovate web & Ads</h4>
                    <div id="invoice">
                        <div id="dateStatusContainer">
                            <p><strong>Date:</strong> ${date}</p>
                            <p><strong>Status:</strong> ${status}</p>
                        </div>

                        <div id="invoiceHeader">
                            <p><strong>From Address:</strong> ${fromAddress}</p>
                            <p><strong>To Address:</strong> ${toAddress}</p>
                        </div>

                        <h2>Invoice</h2>
                        <p><strong>Client Name:</strong> ${clientName}</p>
                        <p><strong>Item Name:</strong> ${itemName}</p>
                        <p><strong>Quantity:</strong> ${quantity}</p>
                        <p id="totalAmount"><strong>Total Amount:</strong> $${totalAmount.toFixed(2)}</p>

                    </div>
                    
    
    printWindow.document.write('<h4>2024 PSV Mediaa.com All rights reserved.</h4>');
    
                </body>
            </html>
        `;

        // Write the content to the print window
        printWindow.document.open();
        printWindow.document.write(printContent);
        printWindow.document.close();

        // Trigger the print dialog
        printWindow.print();
    }
   

        function sendEmail() {
        // Add your logic to send the invoice via Gmail
        var fromAddress = document.getElementById('fromAddress').value;
        var toAddress = document.getElementById('toAddress').value;
        var clientName = document.getElementById('clientName').value;
        var itemName = document.getElementById('itemName').value;
        var quantity = document.getElementById('quantity').value;
        var totalAmount = document.getElementById('outputTotalAmount').innerText;
    
        var subject = "Invoice for " + clientName;
        var body = "Dear " + clientName + ",\n\nAttached is the invoice details:\n\n" +
            "From: " + fromAddress + "\n" +
            "To: " + toAddress + "\n" +
            "Item Name: " + itemName + "\n" +
            "Quantity: " + quantity + "\n" +
            "Total Amount: " + totalAmount;
    
        // Open the default email client with pre-filled data
        var mailtoLink = "mailto:?subject=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);
        window.location.href = mailtoLink;
    }
    
    
            function editInvoice() {
                document.getElementById('invoiceForm').style.display = 'block';
                document.getElementById('invoice').style.display = 'none';
            }
    
            function deleteInvoice() {
                if (confirm("Are you sure you want to delete this invoice?")) {
                    localStorage.removeItem('invoiceData');
                    populateForm();
                    document.getElementById('invoiceForm').style.display = 'block';
                    document.getElementById('invoice').style.display = 'none';
                }
            }
    
            window.onload = function () {
                populateForm();
    
                // Check if there is saved data; if yes, generate the invoice
                const savedFormData = JSON.parse(localStorage.getItem('invoiceData'));
    if (savedFormData) {
        generateInvoice();
    }
            };
            function updateInvoiceList() {
                    const invoicesContainer = document.getElementById('invoices');
                    invoicesContainer.innerHTML = '';
    
                    const invoices = JSON.parse(localStorage.getItem('allInvoices')) || [];
    
                    for (const invoice of invoices) {
                        const listItem = document.createElement('li');
                        listItem.textContent = invoice.clientName;
                        listItem.addEventListener('click', () => loadInvoice(invoice));
                        invoicesContainer.appendChild(listItem);
                    }
                }
    
                function saveInvoiceToStorage(invoiceData) {
          const allInvoices = JSON.parse(localStorage.getItem('allInvoices')) || [];
          allInvoices.push(invoiceData);
          localStorage.setItem('allInvoices', JSON.stringify(allInvoices));
          updateInvoiceList();
        }
        function saveInvoiceToStorage(invoiceData) {
          const allInvoices = JSON.parse(localStorage.getItem('allInvoices')) || [];
          allInvoices.push(invoiceData);
          localStorage.setItem('allInvoices', JSON.stringify(allInvoices));
          updateInvoiceList();
        }
    
        function updateInvoiceList() {
          const invoicesContainer = document.getElementById('invoices');
          invoicesContainer.innerHTML = '';
    
          const invoices = JSON.parse(localStorage.getItem('allInvoices')) || [];
    
          for (const invoice of invoices) {
            const listItem = document.createElement('li');
            listItem.textContent = invoice.clientName;
            listItem.addEventListener('click', () => loadInvoice(invoice));
            invoicesContainer.appendChild(listItem);
          }
        }
    
        function loadInvoice(invoiceData) {
          populateFormFromInvoice(invoiceData);
          generateInvoice();
        }
    
        function deleteInvoice() {
          if (confirm("Are you sure you want to delete this invoice?")) {
            const allInvoices = JSON.parse(localStorage.getItem('allInvoices')) || [];
            const clientNameToDelete = document.getElementById('outputClientName').innerText;
    
            const updatedInvoices = allInvoices.filter(invoice => invoice.clientName !== clientNameToDelete);
            localStorage.setItem('allInvoices', JSON.stringify(updatedInvoices));
    
            populateForm();
            document.getElementById('invoiceForm').style.display = 'block';
            document.getElementById('invoice').style.display = 'none';
    
            updateInvoiceList();
          }
        }
    
        window.onload = function () {
          populateForm();
          updateInvoiceList();
        };
        </script>
    </body>
    </html>
    
@endsection
