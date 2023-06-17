<?php

function check_login($conn){//funtion to check if user is logged in to the system, we call the function when loading every single page so confirm the user is still logged in.
   if(isset($_SESSION['user_id'])){
    echo $_SESSION['user_id'];
    $username = $_SESSION['user_id'];//store the id in the session global variable in the variable 'id'

    $query = "SELECT username FROM LM_Users WHERE username = '$username' limit 1"; //if the session variable[user_id] is set, check that the value exists in the database

    $result = mysqli_query($conn, $query); //pass the query to the connection

    if ($result && mysqli_num_rows($result) > 0){//if we get back a result that's greater than zero
        $user_data = mysqli_fetch_assoc($result); //we store the result as an associative array which is an array where the keys of the array are the column names from the result set and the values are the corresponding values from the row.
        echo print_r($user_data);
        return $user_data; //return the result stored in assoc form
        
    }else{
       header('location: login.php');
        die; 
    }
   }
   //if the result is empty, i.e. the user is not in the database, we redirect to the login page
   
}

