<?php

session_start();

$_SESSION;

include("dbconnection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];


    if(!empty($username) && !empty($password)){
        //check that the user name is in the database
        //then check that the password matches that username
        
        $query = "SELECT * FROM  users WHERE username = '$username' limit 1 ";
       
        //store the reuslts in a variable and convert the result into associative array
        $result = mysqli_query($conn, $query);

        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            echo print_r($user_data, true);
 
        }
        if( $user_data['password'] === $password){
           echo 'Login Successful!';
           header("Location: home.php");
           $_SESSION['user_id'] = $user_data['username'];
           die;
        }else{
            echo "Incorrect username orrrrr password";
        }

        
    }else{
        echo "Incorrect username or password";
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
    <title>Login LeaseMaster</title>
</head>
<body>

 
<div id="signupDiv">
<div>
    <h1 id="loginPageHeader">LOGIN TO LEASEMASTER</h1>
 </div>
<form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input  name="username" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input  name="password" type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div id="buttonDiv">
  <button id="submitSignup" type="submit" class="btn">Login</button>
  <a href="./signup.php"> Don't have an account? </a>
  </div>
  
</form>
</div>


<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</body>
</html>