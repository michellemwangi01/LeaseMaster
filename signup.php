<?php

session_start();

include("dbconnection.php");
include("functions.php");



if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordDuplicate = $_POST['passwordDuplicate'];


    $queryCheckUsername = "SELECT * FROM users where username = '$username'";
    $usernameCheckResult = mysqli_query($conn, $queryCheckUsername);
    $checkResult = mysqli_fetch_assoc($usernameCheckResult);
    //echo print_r($checkResult);

    if (!mysqli_num_rows($usernameCheckResult) > 0){
        if($password !== $passwordDuplicate){
            echo "Passwords do not match";
        }
        else if(!empty($username) && !empty($password) && !empty($passwordDuplicate) && $password === $passwordDuplicate ){
             //save information to database
             echo ($username);
             $queryInsert = "INSERT INTO users (username, password) 
             VALUES ('$username','$password')";
            
             mysqli_query($conn, $queryInsert);
             header("Location: login.php");
             die;
        }else{
            echo "please enter valid username. Username must not contain spaces and special characters";
        }
    }
    else{
        echo 'Username exists, enter a different username';
    }   
    

    


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Signup LeaseMaster</title>
</head>
<body>
<div id="signupDiv">
<div>
    <h1 id="loginPageHeader">SIGN UP TO LEASEMASTER</h1>
 </div>
<form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input  name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <!-- <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span> -->
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input  name="password" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Re-type Password</label>
    <input  name="passwordDuplicate" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <button id="submitSignup" type="submit" class="btn">Sign Up</button>
</form>
</div>


<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</body>
</html>