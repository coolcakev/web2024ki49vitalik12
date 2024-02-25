<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<?php
        if (isset($_POST["submit"])) {
            $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
           if ($user) {
                if ($password== $user["password"]) {
                    $_SESSION["user"] = $user;
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
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
        <script src="https://accounts.google.com/gsi/client" async></script>
</head>

<body>

    <section>
        <h1 style="text-align: center;margin: 50px 0;">Login</h1>
        <div class="container">
            <form action="login.php" method="post">
               <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="">Password</label>
                        <input type="text" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-2" style="display: grid;align-items:  flex-end;">
                        <input type="submit" name="submit" id="submit" class="btn btn-primary">
                    </div>
               </div>
            </form>
            <!-- Sign In With Google button with HTML data attributes API -->
<div id="g_id_onload"
    data-client_id="1001316671342-n81164s1791o2sb7k7edm2121cr506j9.apps.googleusercontent.com"
    data-context="signin"
    data-ux_mode="popup"
    data-callback="handleCredentialResponse"
    data-auto_prompt="false">
</div>

<div class="g_id_signin"
    data-type="standard"
    data-shape="rectangular"
    data-theme="outline"
    data-text="signin_with"
    data-size="large"
    data-logo_alignment="left">
</div>
        </div>
    </section>
</body>
<script>
// Credential response handler function
async function handleCredentialResponse(response){
      const response123= JSON.parse(atob(response.credential.split('.')[1]))
    console.log(response123)
    var formData = new FormData();
    formData.append("email",response123.email)
            var xhr = new XMLHttpRequest();
            xhr.open('Post', 'auth-google.php', true);
 xhr.onload = function() {
              window.location.reload()
            };
            xhr.send(formData);

}
</script>
</html>