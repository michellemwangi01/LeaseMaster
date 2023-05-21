<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
include("dbconnection.php");
include("functions.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Styles/bootstrapOverride.css">
    <title>Header</title>
    
<style>
    nav{
        background-color: coral;
        padding: 50px;
        
    }
    a{
        color: white;
    }
    .navbar-collapse{
      flex-basis: 10%;
    /* flex-grow: 1; */
    /* align-items: center; */
    }
    #kemuHeader{
        width: 10%;
    }
    .navMainContainer{
      display: flex;
      justify-content: space-between;
    }
    
  
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
<img id="kemuHeader" src="Images/LeaseMasterLogo.png.png" alt="kemuLogo">
  <div class="container-fluid">
  
    <a class="navbar-brand" href="#">LEASEMASTER</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navMainContainer collapse navbar-collapse navCustom" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        <a class="nav-link active" href="tenantRegistration.php">Application</a>
        <a class="nav-link active" href="tenantServices.php">Tenant Services</a>
        <a class="nav-link active" href="tenants.php">Tenants</a>
      </div>
      <div class="navbar-nav">
      <a class="nav-link active" href="login.php">Logout <?php echo $_SESSION['user_id'] ?></a>
      </div>
    </div>
  </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

