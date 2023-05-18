<?php


session_start();
include("dbconnection.php");
include("functions.php");

$user_data = check_login($conn);


$errors = array("fullName" => '', "phoneNumber" => '', "email" => '', "courseName" => '', "regID" => '', "regDate" => '' );
$fullNames = $phoneNumber = $email = $courseName = $regID = $regDate = '';
//--------------------------FORM VALIDATION-------------------
if(isset($_POST['submit'])){
         
        // echo $_POST['fullNames'];
        // echo $_POST['phoneNumber'];
        // echo $_POST['email'];
        // echo $_POST['courseName'];
        // echo $_POST['regID'];
        // echo $_POST['regDate'];


        //check names
        $fullNames = $_POST['fullNames'];
        if(empty($fullNames)){
            $errors['fullName'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $fullNames )){
                $errors['fullName'] = '*Name not valid';
            }
                
        }
        //check phone Number
        $phoneNumber = $_POST['phoneNumber'];
        if(empty($phoneNumber)){
            $errors['phoneNumber'] = '*Required';
        }
        else{
            if(!preg_match('/^[0-9]+$/',$phoneNumber)){
                $errors['phoneNumber'] = '*Phone number not valid';
            }
            
        }
        //check email
        $email = $_POST['email'];
        if(empty($email)){
            $errors['email'] = '*Required';
        }else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = '*Email not valid';
            }
        }
        
        //check courseName
        $courseName = $_POST['courseName'];
        if(empty($courseName)){
            $errors['courseName'] = "*Required" ;
        } else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $courseName )){
                $errors['courseName'] = '*Course name not valid';
            }
                
        }

        //check regID
        $regID = $_POST['regID'];
        if(empty($regID)){
            $errors['regID'] = '*Required';
        }
        else{
            if(!preg_match('/^[A-Za-z]+\-\d\-\d\d\d\d\-\d\/\d\d\d\d$/', $regID )){
                $errors['regID'] = '*RegID is not valid';
            }
        }
         //check date
         $regDate = $_POST['regDate'];
         if(empty($regDate)){
             $errors['regDate'] = '*Required';
         }
      
         
    if (array_filter($errors))
    {
        //if there are errors, they will be handled as defined above
        //If you don't pass a callback function to array_filter(), the function will remove all the elements from the input array that have a "falsey" value. The falsey values in PHP are false, 0, empty strings '', NULL, empty arrays [], and the string "0".
        //print_r($errors);
    }
    else{
        $fullNames = mysqli_real_escape_string($link, $_POST['fullNames']);
        $phoneNumber = mysqli_real_escape_string($link, $_POST['phoneNumber']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $courseName = mysqli_real_escape_string($link, $_POST['courseName']);
        $regID = mysqli_real_escape_string($link, $_POST['regID']); 
        $regDate = mysqli_real_escape_string($link, $_POST['regDate']); 


        //write sql query to insert values into sql table
        $sqlquery = "INSERT INTO student_reg (studentName, studentEmail, studentRegID, studentMobile, studentCourse) 
        VALUES ('$fullNames', '$email','$regID', '$phoneNumber', '$courseName' ); ";
        
        
        //save to db and check that it works
        if(mysqli_query($link, $sqlquery)){
            //success - data inserted into db
       }else{
            echo 'SQL query error: ' .mysqli_error($link);
        }
       

        header('Location: registrationList.php');


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
    <title>Registration LeaseMaster</title>
<style>
    .formContainer{
        width: 60%;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #860753;
        box-shadow: 10px;
        border-radius: 12px;
        text-align: center;
    }
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
        margin-left: 5px;
    }
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin:  0.5rem 0.5rem 1.5em 0.5rem !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
        margin-top: 30px !important;
        width: 60%;
        border-radius: 10px;

    }

    legend.scheduler-border {
        font-size: 1rem !important;
        font-weight: light !important;
        text-align: left !important;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
        margin-top: -15px;
        background-color: whitesmoke;
        color: black;
    }
    #formsContainer{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }
    .input-group-text {
        background-color: red;
    }
</style>

</head>
<body>
<?php include('header.php') ?>

<div id="formsContainer">
    <fieldset id="personalInfo" class="scheduler-border">
            <legend class="scheduler-border">Personal Information</legend>
        <form class="registrationForm" action="register.php" method="POST">
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Full Names</span>
            <input value = '<?php echo htmlspecialchars($fullNames) ?>' type="text" name="fullNames"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
        </div>
        
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Mobile Number</span>
            <input value = '<?php echo htmlspecialchars($phoneNumber) ?>' type="text" name="phoneNumber" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['phoneNumber'] ?></p></span>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
            <input value = '<?php echo htmlspecialchars($email) ?>' type="text" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['email'] ?></p></span>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Course</span>
            <input value = '<?php echo htmlspecialchars($courseName) ?>' type="text" name="courseName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['courseName'] ?></p></span>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Reg ID.</span>
            <input value = '<?php echo htmlspecialchars($regID) ?>' type="text" name="regID" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['regID'] ?></p></span>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Registration Date</span>
            <input value = '<?php echo htmlspecialchars($regDate) ?>' type="date" name="regDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['regDate'] ?></p></span>
        </div>
        <!-- <div>
            <button class="mybtn" type="Submit" name="submit" value="submit">Register</button>
        </div> -->
        </form>
    </fieldset>

    <fieldset id="IdentityKinInfo" class="scheduler-border">
        <legend class="scheduler-border">Identification & Next of Kin</legend>
    <form class="registrationForm" action="register.php" method="POST">
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Full Names</span>
        <input value = '<?php echo htmlspecialchars($fullNames) ?>' type="text" name="fullNames"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
    </div>
    
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Mobile Number</span>
        <input value = '<?php echo htmlspecialchars($phoneNumber) ?>' type="text" name="phoneNumber" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['phoneNumber'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
        <input value = '<?php echo htmlspecialchars($email) ?>' type="text" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['email'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Course</span>
        <input value = '<?php echo htmlspecialchars($courseName) ?>' type="text" name="courseName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['courseName'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Reg ID.</span>
        <input value = '<?php echo htmlspecialchars($regID) ?>' type="text" name="regID" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['regID'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Registration Date</span>
        <input value = '<?php echo htmlspecialchars($regDate) ?>' type="date" name="regDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['regDate'] ?></p></span>
    </div>
    <!-- <div>
        <button class="mybtn" type="Submit" name="submit" value="submit">Register</button>
    </div> -->
    </form>
</fieldset>

    <fieldset id="RentalHistorty" class="scheduler-border">
            <legend class="scheduler-border">Rental History</legend>
        <form class="registrationForm" action="register.php" method="POST">
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Full Names</span>
            <input value = '<?php echo htmlspecialchars($fullNames) ?>' type="text" name="fullNames"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
        </div>
        
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Mobile Number</span>
            <input value = '<?php echo htmlspecialchars($phoneNumber) ?>' type="text" name="phoneNumber" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['phoneNumber'] ?></p></span>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
            <input value = '<?php echo htmlspecialchars($email) ?>' type="text" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['email'] ?></p></span>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Course</span>
            <input value = '<?php echo htmlspecialchars($courseName) ?>' type="text" name="courseName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['courseName'] ?></p></span>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Reg ID.</span>
            <input value = '<?php echo htmlspecialchars($regID) ?>' type="text" name="regID" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['regID'] ?></p></span>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Registration Date</span>
            <input value = '<?php echo htmlspecialchars($regDate) ?>' type="date" name="regDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span><p class='errorMessages'><?php echo $errors['regDate'] ?></p></span>
        </div>
        <!-- <div>
            <button class="mybtn" type="Submit" name="submit" value="submit">Register</button>
        </div> -->
        </form>
    </fieldset>

    <fieldset id="employementIncome" class="scheduler-border">
        <legend class="scheduler-border">Employment & Income</legend>
    <form class="registrationForm" action="register.php" method="POST">
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Full Names</span>
        <input value = '<?php echo htmlspecialchars($fullNames) ?>' type="text" name="fullNames"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
    </div>
    
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Mobile Number</span>
        <input value = '<?php echo htmlspecialchars($phoneNumber) ?>' type="text" name="phoneNumber" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['phoneNumber'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
        <input value = '<?php echo htmlspecialchars($email) ?>' type="text" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['email'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Course</span>
        <input value = '<?php echo htmlspecialchars($courseName) ?>' type="text" name="courseName" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['courseName'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Reg ID.</span>
        <input value = '<?php echo htmlspecialchars($regID) ?>' type="text" name="regID" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['regID'] ?></p></span>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Registration Date</span>
        <input value = '<?php echo htmlspecialchars($regDate) ?>' type="date" name="regDate" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <span><p class='errorMessages'><?php echo $errors['regDate'] ?></p></span>
    </div>
    <!-- <div>
        <button class="mybtn" type="Submit" name="submit" value="submit">Register</button>
    </div> -->
    </form>
</fieldset>


</div>



<?php include('footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>