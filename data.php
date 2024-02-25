<?php
 require_once "database.php";
   session_start();
$user123=$_SESSION["user"]["id"];
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $fullName = $_POST["name"];
           $email = $_POST["email"];
           $password = $_POST["password"];
    $sql = "UPDATE users SET email='$email',password='$password',name='$fullName' WHERE id=$user123";

if (mysqli_query($conn, $sql)) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
    die();
  }


            $sql = "SELECT * FROM users WHERE id = '$user123'";
            $result = mysqli_query($conn, $sql);
            $userResponse = mysqli_fetch_array($result, MYSQLI_ASSOC);
            echo json_encode($userResponse);

?>