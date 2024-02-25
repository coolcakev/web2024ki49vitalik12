<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - MYSQL - CRUD</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</head>

<body>
    <section>
        <h1 style="text-align: center;margin: 50px 0;">Hello my friend</h1>
        <div class="container">
          <div>
               <span>Email :</span>
               <span id="email"></span>
          </div>
          <div>
               <span>Password :</span>
               <span id="password"></span>
          </div>
          <div>
               <span>Name :</span>
               <span id="name"></span>
          </div>
          <div class="row">
               <form id="myForm">
                    <div class="form-group col-lg-4">
                        <label for="">Email</label>
                        <input type="text" name="email" id="emailField" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="">Password</label>
                        <input type="text" name="password" id="passwordField" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="nameField" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-2" style="display: grid;align-items:  flex-end;">
                        <input type="submit" name="submit" id="submit" class="btn btn-primary">
                    </div>
               </div>
               </form>
        </div>
    </section>
</body>
 <script>
        // Function to make the AJAX request
        function fetchData() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'data.php', true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                   const result=JSON.parse(xhr.response)
                    console.log(result)

                   document.getElementById("email").innerHTML=result.email
                    document.getElementById("password").innerHTML=result.password
                     document.getElementById("name").innerHTML=result.name

                } else {
                    // Request failed, handle the error
                    console.error('Request failed with status:', xhr.status);
                }
            };

            xhr.onerror = function() {
                // Handle network errors
                console.error('Request failed');
            };

            xhr.send();
        }

        // Call the fetchData function when the page loads
        window.onload = fetchData;


        // Function to make the AJAX request
        function sendData() {
            var xhr = new XMLHttpRequest();
            var formData = new FormData(document.getElementById('myForm'));
            xhr.open('POST', 'data.php', true);

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                   fetchData()
                } else {
                    // Request failed, handle the error
                    console.error('Request failed with status:', xhr.status);
                }
            };

            xhr.onerror = function() {
                // Handle network errors
                console.error('Request failed');
            };

            xhr.send(formData);
        }

        // Call the sendData function when the form is submitted
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault();
            sendData();
        });
    </script>
</html>