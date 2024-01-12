@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
   

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap 5 icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>CRUD Operations</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="loginForm">
        <h2>Login</h2>
        <form id="loginForm">
            <label for="username">Username:</label>
            <input type="text" id="username" required><br>
    
            <label for="password">Password:</label>
            <input type="password" id="password" required><br><br>
    
            <button class="lea" type="button" onclick="login()">Login</button>
        </form>
    </div>
    
    <div id="contactPage">

    <section class="p-3">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary newUser" data-bs-toggle="modal" data-bs-target="#userForm">New Contact<i class="bi bi-people"></i></button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="table1" class="table table-striped table-hover mt-3 text-center table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Birth Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="data"></tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Form -->
    <div class="modal fade" id="userForm">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Fill the Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="#" id="myForm">
                        <div class="card imgholder">
                            <label for="imgInput" class="upload">
                                <input type="file" name="" id="imgInput">
                                <i class="bi bi-plus-circle-dotted"></i>
                            </label>
                            <img src="./image/Profile Icon.webp" alt="" width="200" height="200" class="img">
                        </div>

                        <div class="inputField">
                            <div>
                                <label for="name">Name:</label>
                                <input type="text" name="" id="name" required>
                            </div>
                            <div>
                                <label for="email">E-mail:</label>
                                <input type="email" name="" id="email" required>
                            </div>
                            <div>
                                <label for="phone">Number:</label>
                                <input type="text" name="" id="phone" minlength="11" maxlength="11" required>
                            </div>
                            <div>
                                <label for="sDate">Start Date:</label>
                                <input type="date" name="" id="sDate" required>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="myForm" class="btn btn-primary submit">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Read Data Modal -->
    <div class="modal fade" id="readData">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Profile</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="#" id="myForm">
                        <div class="card imgholder">
                            <img src="./image/Profile Icon.webp" alt="" width="200" height="200" class="showImg">
                        </div>

                        <div class="inputField">
                            <div>
                                <label for="name">Name:</label>
                                <input type="text" name="" id="showName" disabled>
                            </div>
                            <div>
                                <label for="email">E-mail:</label>
                                <input type="email" name="" id="showEmail" disabled>
                            </div>
                            <div>
                                <label for="phone">Number:</label>
                                <input type="text" name="" id="showPhone" minlength="11" maxlength="11" disabled>
                            </div>
                            <div>
                                <label for="sDate">Birth Date:</label>
                                <input type="date" name="" id="showsDate" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
    

      td button {
        margin: 5px;
      }

      td button i {
        font-size: 20px;
      }

      .modal-header {
        background: darkblue;
        color: #fff;
      }

      .modal-body form {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 0;
      }
      .lea {
                background-color: midnightblue;
                color: white;
                border-style: none;
                border-color: none;
                padding: 10px;
                border-radius: 3px;
            }
      
      #loginForm {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            max-width: 300px;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
        }
        #loginForm label {
            font-size: 20px; /* Adjust the label font size as needed */
        }
      a {
    text-decoration: none;
}
      @media (max-width: 600px) {
        .modal-body form .inputField {
            flex-basis: 100%; /* Adjusted the flex-basis property for small screens */
        }

        form .inputField > div {
            margin-bottom: 10px; /* Reduced margin for better spacing on small screens */
        }

        .modal-footer .submit {
            width: 100%; /* Adjusted the width for small screens */
        }
        #table1 {
        overflow-x: auto;
    }
    }

      .modal-body form .imgholder {
        width: 200px;
        height: 200px;
        position: relative;
        border-radius: 20px;
        overflow: hidden;
      }

      .imgholder .upload {
        position: absolute;
        bottom: 0;
        left: 10;
        width: 100%;
        height: 100px;
        background: rgba(0,0,0,0.3);
        display: none;
        justify-content: center;
        align-items: center;
        cursor: pointer;
      }

      .upload i {
        color: #fff;
        font-size: 35px;
      }

      .imgholder:hover .upload {
        display: flex;
      }

      .imgholder .upload input {
        display: none;
      }

      .modal-body form .inputField {
        flex-basis: 68%;
        border-left: 5px groove darkblue;
        padding-left: 20px;
      }

      form .inputField > div {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
      }

      form .inputField > div label {
        font-size: 20px;
        font-weight: 500;
      }

      #userForm form .inputField > div label::after {
        content: "*";
        color: red;
      }

      form .inputField > div input {
        width: 75%;
        padding: 10px;
        border: none;
        outline: none;
        background: transparent;
        border-bottom: 2px solid darkblue;
      }

      .modal-footer .submit {
        font-size: 18px;
      }

      #readData form .inputField > div input {
        color: #000;
        font-size: 18px;
      }
      @media (max-width: 600px) {
            #table1 th, #table1 td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .modal-body form {
                flex-direction: column;
            }

            .modal-body form .inputField {
                border-left: none;
                padding-left: 0;
                flex-basis: 100%;
            }

            form .inputField > div {
                margin-bottom: 10px;
            }

            .modal-footer .submit {
                width: 100%;
            }

            .modal-body form .imgholder img {
                width: 100%;
                height: auto;
            }
        }
     
        #contactPage {
            display: none;
        }
    </style>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
            function login() {
        // In a real-world scenario, you would send a request to a server for authentication.
        // For simplicity, we're using hardcoded values for username and password here.
        const enteredUsername = document.getElementById('username').value;
        const enteredPassword = document.getElementById('password').value;

        // Check if the entered username and password are valid
        if (enteredUsername === 'contact666' && enteredPassword === 'psv666') {
            // Login successful
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('contactPage').style.display = 'block';
        } else {
            alert('Invalid username or password. Please try again.');
        }
    }
      var form = document.getElementById("myForm"),
        imgInput = document.querySelector(".img"),
        file = document.getElementById("imgInput"),
        userName = document.getElementById("name"),
        email = document.getElementById("email"),
        phone = document.getElementById("phone"),
        sDate = document.getElementById("sDate"),
        submitBtn = document.querySelector(".submit"),
        userInfo = document.getElementById("data"),
        modal = document.getElementById("userForm"),
        modalTitle = document.querySelector("#userForm .modal-title"),
        newUserBtn = document.querySelector(".newUser");

      let getData = localStorage.getItem('userProfile') ? JSON.parse(localStorage.getItem('userProfile')) : [];

      let isEdit = false, editId;
      showInfo();

      newUserBtn.addEventListener('click', () => {
        submitBtn.innerText = 'Submit',
        modalTitle.innerText = "Fill the Form";
        isEdit = false;
        imgInput.src = "./image/Profile Icon.webp";
        form.reset();
      });

      file.onchange = function () {
        if (file.files[0].size < 1000000) {
          // 1MB = 1000000
          var fileReader = new FileReader();

          fileReader.onload = function (e) {
            imgUrl = e.target.result;
            imgInput.src = imgUrl;
          };

          fileReader.readAsDataURL(file.files[0]);
        } else {
          alert("This file is too large!");
        }
      };

      function showInfo() {
        document.querySelectorAll('.employeeDetails').forEach(info => info.remove());
        getData.forEach((element, index) => {
          let createElement = `<tr class="employeeDetails">
            <td>${index + 1}</td>
            <td><img src="${element.picture}" alt="" width="50" height="50"></td>
            <td>${element.employeeName}</td>
            <td>${element.employeeEmail}</td>
            <td>${element.employeePhone}</td>
            <td>${element.startDate}</td>

            <td>
              <button class="btn btn-success" onclick="readInfo('${element.picture}', '${element.employeeName}', '${element.employeeEmail}', '${element.employeePhone}', '${element.startDate}')" data-bs-toggle="modal" data-bs-target="#readData"><i class="bi bi-eye"></i></button>

              <button class="btn btn-primary" onclick="editInfo(${index}, '${element.picture}', '${element.employeeName}', '${element.employeeEmail}', '${element.employeePhone}', '${element.startDate}')" data-bs-toggle="modal" data-bs-target="#userForm"><i class="bi bi-pencil-square"></i></button>

              <button class="btn btn-danger" onclick="deleteInfo(${index})"><i class="bi bi-trash"></i></button>
            </td>
          </tr>`;

          userInfo.innerHTML += createElement;
        });
      }

      function readInfo(pic, name, email, phone, sDate) {
        document.querySelector('.showImg').src = pic,
        document.querySelector('#showName').value = name,
        document.querySelector("#showEmail").value = email,
        document.querySelector("#showPhone").value = phone,
        document.querySelector("#showsDate").value = sDate;
      }

      function editInfo(index, pic, name, email, phone, sDate) {
        isEdit = true;
        editId = index;
        imgInput.src = pic;
        userName.value = name;
        email.value = email;
        phone.value = phone;
        sDate.value = sDate;

        submitBtn.innerText = "Update";
        modalTitle.innerText = "Update The Form";
      }

      function deleteInfo(index) {
        if (confirm("Are you sure want to delete?")) {
          getData.splice(index, 1);
          localStorage.setItem("userProfile", JSON.stringify(getData));
          showInfo();
        }
      }

      form.addEventListener('submit', (e) => {
        e.preventDefault();

        const information = {
          picture: imgInput.src == undefined ? "./image/Profile Icon.webp" : imgInput.src,
          employeeName: userName.value,
          employeeEmail: email.value,
          employeePhone: phone.value,
          startDate: sDate.value
        };

        if (!isEdit) {
          getData.push(information);
        } else {
          isEdit = false;
          getData[editId] = information;
        }

        localStorage.setItem('userProfile', JSON.stringify(getData));

        submitBtn.innerText = "Submit";
        modalTitle.innerHTML = "Fill The Form";

        showInfo();

        form.reset();

        imgInput.src = "./image/Profile Icon.webp";
      });
    </script>
  </body>
</html>


@endsection
