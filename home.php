<?php

//  include("dbconnection.php");
// include("functions.php");

//  $user_data = check_login($conn) ;



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"> -->
    <title>Index</title>
    
<style>
    .homeContainer{
        display: flex;
        flex-direction: row;
        width: 80%;
        justify-content: center;
        align-content: center;
        margin: auto;
    }
    .studentsContainer, .registerContainer{
        display: flex;
        text-align: center;
        font-family: Georgia, 'Times New Roman', Times, serif;
        width: 60%;
        height: auto;
        background-color: whitesmoke;
        /* background-image: linear-gradient(coral,white) ; */
        padding: 2rem;
        margin: 2%;
        color: #860753;
        align-items: center;
        border: 2px solid #860753;
        border-radius: 10px;
        flex-direction: column;
        justify-content: center;
        
        
    }
    .studentsContainer:hover ,.registerContainer:hover{
        box-shadow: 0 0 7px #860753; 
        
    }
    .imgDiv{
        width: 100%;
        
        
    }
    img{
        object-fit: contain ;
        max-width: 100%;
    }
    #editUserImage{
        width: 15rem;
    }
    #tagline{
        text-align: center;
        color: coral;
        font-family: Georgia, 'Times New Roman', Times, serif;
        padding-top: 20px;
    }
    h3{
        /* color: black; */
        text-decoration: underline;
    }
   

  
    
</style>


<body>
<?php include('header.php') ?>
<div id="tagline">
        <h4>Please select a service</h4>
    </div>
<div class="homeContainer">
    
    <div class="studentsContainer">
        <div  class="imgDiv"><img id="editUserImage" src="Images/TenantRegistration.png" alt=""></div>
        <h3>Register as a New Tenant</h3> 
        <p>This form will require you to input information such as your personal details, contact information, desired property specifications, and any additional required information.
        Carefully fill out the form, ensuring that all the required fields are completed accurately. Double-check your information for any errors or typos. Once you have filled out the form, remember to submit it electronically through the portal by clicking Submit. Make sure to review the provided terms and conditions, and agree to them before submitting. </p>   
        <p><a href="tenantRegistration.php"><i class="bi bi-credit-card-2-front"> Click to register</i></a><br></p> 
    </div>
    <div class="registerContainer">
        <div  class="imgDiv"><img id="editUserImage" src="Images/TenantServices.png" alt=""></div>
        <h3>Request a service</h3> 
        <p>This form will provides a convenient and efficient way to communicate and resolve any issues you may have with the property management team. You tenants can easily submit service requests, ensuring accurate and detailed information is provided. This process will streamline the process, reduce response times, and allow us to better track your requests while maintaining transparency of request statuses. Overally, this portal purposes to enhances communication between us and you, expedite issue resolution, and contribute to a better living experience for you.</p>
        <p><a href="tenantServices.php"><i class="bi bi-pencil-square"> Click to request a service</i></a><br></p>
    </div>
</div>




<?php include('footer.php') ?>
</body>
</html>