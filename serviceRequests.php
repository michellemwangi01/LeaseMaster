<?php


if(!isset($_SESSION)) 
{ 
    session_start(); 
} 



include("dbconnection.php");


$username = $_SESSION['user_id'];
//echo $username;
$errors = array("contactName" => '',"phoneNumber" => '', "houseNumber" => '', "service" => '', "serviceIssue" => '', "description" => '', "requestDate" => '' );
$contactName = $phoneNumber =$houseNumber = $service = $serviceIssue = $description = $requestDate = '';

$sqlSelectQuery = "SELECT * FROM clientapplications WHERE username = '{$username}'";
$result = mysqli_query($conn, $sqlSelectQuery);
$tenantRecord = mysqli_fetch_assoc($result);
//print_r($tenantRecord);

$contactName = mysqli_real_escape_string($conn, $tenantRecord['FirstName']);
$phoneNumber = mysqli_real_escape_string($conn, $tenantRecord['Mobile']);
$houseNumber = mysqli_real_escape_string($conn, $tenantRecord['houseNumber']);


if(isset($_GET)){
    $service = $_GET['service'];

    $sqlServiceIssuesQuery = "SELECT si.serviceissuename
        FROM lm_serviceissues si
        JOIN lm_services s ON si.serviceid = s.serviceid
        WHERE s.servicename = '{$service}';" ;


        $result = mysqli_query($conn, $sqlServiceIssuesQuery);
        //echo print_r($result);

        // $serviceIssues = mysqli_fetch_assoc($result);
        // echo print_r($serviceIssue);

       
        
}



//--------------------------FORM VALIDATION-------------------
if(isset($_POST['submit'])){
         
       echo print_r($_POST);
       


        //check contactName
        $contactName = $_POST['contactName'];
        if(empty($contactName)){
            $errors['contactName'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $contactName )){
                $errors['contactName'] = '*Name not valid';
            }
                
        }
        //check phoneNumber
        $phoneNumber = $_POST['phoneNumber'];
        if(empty($phoneNumber)){
            $errors['phoneNumber'] = '*Required';
        }
        else{
            if(!preg_match('/^[0-9]+$/',$phoneNumber)){
                $errors['phoneNumber'] = '*Phone number not valid';
            }
            
        }
        //check houseNumber
        $houseNumber = $_POST['houseNumber'];
        if(empty($houseNumber)){
            $errors['houseNumber'] = '*Required';
        }
        
        //check service
        $service = $_POST['service'];
        if(empty($service)){
            $errors['service'] = "*Required" ;
        } else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $service )){
                $errors['service'] = '*Course name not valid';
            }
                
        }

        //check description
        $description = $_POST['description'];
        if(empty($description)){
            $errors['description'] = "*Required" ;
        } 

        //check serviceIssue
        $serviceIssue = $_POST['serviceIssue'];
        if(empty($serviceIssue)){
            $errors['serviceIssue'] = '*Required';
        }
        
         //check requestDate
         $requestDate = $_POST['requestDate'];
         if(empty($requestDate)){
             $errors['requestDate'] = '*Required';
         }
      
         
    if (array_filter($errors))
    {
        //if there are errors, they will be handled as defined above
        //If you don't pass a callback function to array_filter(), the function will remove all the elements from the input array that have a "falsey" value. The falsey values in PHP are false, 0, empty strings '', NULL, empty arrays [], and the string "0".
        //print_r($errors);
    }
    else{
        $contactName = mysqli_real_escape_string($conn, $_POST['contactName']);
        $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $houseNumber = mysqli_real_escape_string($conn, $_POST['houseNumber']);
        $service = mysqli_real_escape_string($conn, $_POST['service']);
        $serviceIssue = mysqli_real_escape_string($conn, $_POST['serviceIssue']); 
        $requestDate = mysqli_real_escape_string($conn, $_POST['requestDate']); 
        $description = mysqli_real_escape_string($conn, $_POST['description']); 


        
        $sqlqueryuserID = "SELECT userID FROM users where username = '$username'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sqlqueryuserID));
        echo print_r($result['userID']);
        $userID = $result['userID'];


        $formattedDate = date('Y-m-d', strtotime($requestDate));

        //write sql query to insert values into sql table
        $sqlquery = "INSERT INTO `servicerequests`
                (`clientID`, `ContactName`, `mobileNumber`, `houseNumber`, `category`, `subCategory`, `description`, `occurenceDate`) 
        VALUES ($userID,'$contactName',' $phoneNumber','$houseNumber','$service','$serviceIssue',' $description','$formattedDate');";
        
        
        //save to db and check that it works
        if(mysqli_query($conn, $sqlquery)){
            echo "success - data inserted into db";
       }else{
            echo 'SQL query error: ' .mysqli_error($conn);
        }
       
       
        header('Location: home.php');

        



    }
 } //End of POST check


    

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
    <title>Register New Student</title>
<style>

    .mybtn{
        color: white;
        border-radius: 20px;
        border: 1px solid #860753;
        background-color: #860753;
        padding: 5PX 10px;
        border-radius: 10px;
    }
    .errorMessages{
        color: red;
        margin-left: 3px;
        font-size: 10px;
    }
</style>

</head>
<body>
<?php include('header.php') ?>

<section class="formServiceRequests">
    <h4>New Service Request</h4>
    <form class="registrationForm" action="serviceRequests.php?service=<?php echo htmlspecialchars($service)?>" method="POST">
    <div class="">
        <span class="" id="">Contact Name</span>
        <input value = '<?php echo htmlspecialchars($contactName) ?>' type="text" name="contactName"class="myformControl" aria-label="Sizing example input" aria-describedby="">
        <span><p class='errorMessages'><?php echo $errors['contactName'] ?></p></span>
    </input>
        
    </div>
    
    <div class="">
        <span class="" id="">Mobile Number</span>
        <input value = '<?php echo htmlspecialchars($phoneNumber) ?>' type="text" name="phoneNumber" class="myformControl" aria-label="Sizing example input" aria-describedby="">
        <span><p class='errorMessages'><?php echo $errors['phoneNumber'] ?></p></span>
    </div>
    <div class="">
        <span class="" id="">House Number</span>
        <input value = '<?php echo htmlspecialchars($houseNumber) ?>' type="text" name="houseNumber" class="myformControl" aria-label="Sizing example input" aria-describedby="">
        <span><p class='errorMessages'><?php echo $errors['houseNumber'] ?></p></span>
    </div>
    <div class="">
        <span class="" id="">Service</span>
        <input value = '<?php echo htmlspecialchars($service) ?>' type="text" name="service" class="myformControl" aria-label="Sizing example input" aria-describedby="">
        <span><p class='errorMessages'><?php echo $errors['service'] ?></p></span>
    </div>
    <div class="">
        <span class="" id="">Service Issue </span>
        <select class="myformselect" aria-label="Default select example" name="serviceIssue">
            <optgroup>
            <option selected>Select</option>
                <?php
                    if($result){
                        while($row =mysqli_fetch_assoc($result) ){
                            echo '<option value="Studio">'. $row['serviceissuename'].'</option>';
                        }
                    }
                    ?>
            </optgroup>
           
            

        </select>
        <span><p class='errorMessages'><?php echo $errors['serviceIssue'] ?></p></span>
    </div>
    <div class="">
        <span class="" id="">Description</span>
        <textarea value = '<?php echo htmlspecialchars($description) ?>' name="description" rows="4" cols="50" class="myformControl" aria-label="Sizing example input" aria-describedby=""></textarea>
        <span><p class='errorMessages'><?php echo $errors['description'] ?></p></span>
    </div>
    <div class="">
        <span class="" id="">Occurence Date</span>
        <input value = '<?php echo htmlspecialchars($requestDate) ?>' type="date" name="requestDate" class="myformControl" aria-label="Sizing example input" aria-describedby="">
        <span><p class='errorMessages'><?php echo $errors['requestDate'] ?></p></span>
    </div>
    <div>
        <button class="mybtn" type="Submit" name="submit" value="submit">Submit</button>
    </div>
    </form>

</section>

<?php  ?>

<?php include('footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>