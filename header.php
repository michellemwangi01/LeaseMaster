<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
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
    <div class="collapse navbar-collapse navCustom" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        <a class="nav-link active" href="register.php">Registration</a>
        <a class="nav-link active" href="registrationList.php">Tenants</a>
        
        
      </div>
    </div>
  </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

