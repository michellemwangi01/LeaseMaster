<?php
include('header.php');




$errors = array("firstName" => '',"lastName" => '', "phoneNumber" => '', "email" => '', "identification" => '', "identificationNo" => '', "DoB" => '' );
$firstName = $lastName = $phoneNumber = $email = $identification = $identificationNo = $DoB = '';
//--------------------------FORM VALIDATION-------------------
if($_SERVER["REQUEST_METHOD"] == "POST"){

    echo print_r($_POST);


        //check first name
        $firstName = $_POST['firstName'];
        if(empty($firstName)){
            $errors['firstName'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $firstName )){
                $errors['firstName'] = '*Name not valid';
            }
                
        }
        //check last name
        $lastName = $_POST['lastName'];
        if(empty($lastName)){
            $errors['lastName'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $lastName )){
                $errors['lastName'] = '*Name not valid';
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
        
        //check identification
        $identification = $_POST['identification'];
        if(empty($identification)){
            $errors['identification'] = "*Required" ;
        } 

        //check identificationNo
        $identificationNo = $_POST['identificationNo'];
        if(empty($identificationNo)){
            $errors['identificationNo'] = '*Required';
        }
        else{
            if(!preg_match('/^[A-Za-z]+\-\d\-\d\d\d\d\-\d\/\d\d\d\d$/', $identificationNo )){
                $errors['regID'] = '*ID is required or not valid';
            }
        }
         //check date of Birth
         $DoB = $_POST['DoB'];
         if(empty($DoB)){
             $errors['DoB'] = '*Required';
         }
      
         
    if (array_filter($errors))
    {
        //if there are errors, they will be handled as defined above
        //If you don't pass a callback function to array_filter(), the function will remove all the elements from the input array that have a "falsey" value. The falsey values in PHP are false, 0, empty strings '', NULL, empty arrays [], and the string "0".
        //print_r($errors);
    }
    else{
        $firstName = mysqli_real_escape_string($link, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($link, $_POST['lastName']);
        $phoneNumber = mysqli_real_escape_string($link, $_POST['phoneNumber']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $identification = mysqli_real_escape_string($link, $_POST['identification']);
        $identificationNo = mysqli_real_escape_string($link, $_POST['identificationNo']); 
        $DoB = mysqli_real_escape_string($link, $_POST['DoB']); 


        //write sql query to insert values into sql table
        $sqlquery = "INSERT INTO student_reg (studentName, studentEmail, studentRegID, studentMobile, studentCourse) 
        VALUES ('$firstName','$lastName', '$phoneNumber', '$email','$identification', '$identificationNo', '$DoB' ); ";
        
        
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
    <link rel="stylesheet" href="Styles/bootstrapOverride.css">
    <title>Registration LeaseMaster</title>
</head>
<body>
<div class="mainApplicationDiv">
    <!-- <div class="TnCs">
        <h2>NEW TENANT APPLICATION</h2>
            <h4>Terms and Conditions</h4>
            <p>
                Please carefully read and review the following terms and conditions before filling out the form. These terms and conditions govern your use of the form and the information you provide. By submitting the form, you agree to be bound by these terms and conditions.

                <br><br>Information Accuracy: You certify that all information provided in the form is true, accurate, and complete to the best of your knowledge. Any false or misleading information may result in the termination of your application or tenancy.

                <br> <br>Data Privacy: The information you provide in the form will be collected and processed in accordance with applicable data protection laws. The information will be used for the purpose of evaluating your application and managing the tenancy. Your personal information will be kept confidential and will not be disclosed to third parties without your consent, except as required by law.

                <br><br>Application and Approval: Submitting the form does not guarantee approval of your application or the availability of the property. The landlord or authorized agents reserve the right to conduct background checks, credit checks, and verification of the information provided. The approval of your application is at the sole discretion of the landlord.
        </p>
    </div> -->
    <div id="formsContainer">
        <form class="" action="tenantRegistration.php" method="POST">
            <fieldset id="personalInfo" class="scheduler-border">
            <legend class="scheduler-border">Personal Information</legend>
            <div class="row g-3">            
                <div class="col-md-6">
                    <span class="" id="">First Name</span>
                    <input value = '<?php echo htmlspecialchars($firstName) ?>' type="text" name="firstName" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['firstName'] ?></p></span>
                </div>

                <div class="col-md-6">
                    <span class="" id="">Last Name</span>
                    <input value = '<?php echo htmlspecialchars($lastName) ?>' type="text" name="lastName"class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['lastName'] ?></p></span>
                </div>
                
                <div class="col-md-6">
                    <span class="" id="">Mobile Number</span>
                    <input value = '<?php echo htmlspecialchars($phoneNumber) ?>' type="text" name="phoneNumber" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['phoneNumber'] ?></p></span>
                </div>
                <div class="col-md-6">
                    <span class="" id="">Email</span>
                    <input value = '<?php echo htmlspecialchars($email) ?>' type="text" name="email" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['email'] ?></p></span>
                </div>
            
                <div class="col-md-6">
                    <span class="" id="">Identification Type</span>
                    <select class="myformselect" aria-label="Default select example" name="identification" >
                        <option selected>Select a type</option>
                        <option value = "National ID">National ID</option>
                        <option value="Passport">Passport</option>
                    </select>
                    <span><p class='errorMessages'><?php echo $errors['identification'] ?></p></span>
                </div>
                <div class="col-md-6">
                    <span class="" id="">ID/Passport Number</span>
                    <input value = '<?php echo htmlspecialchars($identificationNo) ?>' type="text" name="identificationNo" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['identificationNo'] ?></p></span>
                </div>
                <div class="">
                    <span class="" id="">Date of Birth</span>
                    <input value = '<?php echo htmlspecialchars($DoB) ?>' type="date" name="DoB" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['DoB'] ?></p></span>
                </div>
                
            </div>
            </fieldset>

            <!-- <fieldset id="IdentityKinInfo" class="row g-3 scheduler-border">
                <legend class="scheduler-border"> Next of Kin</legend>
        
                <div class="">
                    <span class="" id="">Full Names</span>
                    <input value = '<?php echo htmlspecialchars($fullNames) ?>' type="text" name="fullNames"class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
                </div>
                <div class="col-md-6">
                    <span class="" id="">Relationship</span>
                    <input value = '<?php echo htmlspecialchars($fullNames) ?>' type="text" name="fullNames"class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
                </div>
                
                <div class="col-md-6">
                    <span class="" id="">Mobile Number</span>
                    <input value = '<?php echo htmlspecialchars($phoneNumber) ?>' type="text" name="phoneNumber" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['phoneNumber'] ?></p></span>
                </div>
            

        </fieldset>

            <fieldset id="RentalHistorty" class="scheduler-border ">
                    <legend class="scheduler-border">Rental History</legend>

                <div class="row g-3">
                        
                    
                    <div class="col-md-6">
                        <span class="" id="">Previous Address</span>
                        <input value = '<?php echo htmlspecialchars($fullNames) ?>' type="text" name="fullNames"class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
                    </div>
                    
                    <div class="col-md-6">
                        <span class="" id="">Contact Number</span>
                        <input value = '<?php echo htmlspecialchars($phoneNumber) ?>' type="text" name="phoneNumber" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['phoneNumber'] ?></p></span>
                    </div>
                    <div class="col-md-6">
                        <span class="" id="">Length of Stay</span>
                        <input value = '<?php echo htmlspecialchars($email) ?>' type="text" name="email" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['email'] ?></p></span>
                    </div>
                    <div class="col-md-6">
                        <span class="" id="">Reason for Leaving</span>
                        <input value = '<?php echo htmlspecialchars($courseName) ?>' type="text" name="courseName" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['courseName'] ?></p></span>
                    </div>
                </div>
            </fieldset>

            <fieldset id="employementIncome" class="scheduler-border ">
                <legend class="scheduler-border">Employment & Income</legend>
                <div class="row g-3">

                <div class="col-md-6">
                    <span class="" id="">Employer Name</span>
                    <input value = '<?php echo htmlspecialchars($fullNames) ?>' type="text" name="fullNames"class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
                </div>
                <div class="col-md-6">
                    <span class="" id="">Job Title</span>
                    <input value = '<?php echo htmlspecialchars($courseName) ?>' type="text" name="courseName" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['courseName'] ?></p></span>
                </div>
                <div class="col-md-6">
                    <span class="" id="">Mobile Number</span>
                    <input value = '<?php echo htmlspecialchars($phoneNumber) ?>' type="text" name="phoneNumber" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['phoneNumber'] ?></p></span>
                </div>
                <div class="col-md-6">
                    <span class="" id="">Email</span>
                    <input value = '<?php echo htmlspecialchars($email) ?>' type="text" name="email" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['email'] ?></p></span>
                </div>  
                </div> 
            
            </fieldset>
            
            <fieldset id="employementIncome" class="scheduler-border ">
                <legend class="scheduler-border">Reservation Details</legend>
                <div class="row g-3">

                <div class="col-md-6">
                    <span class="" id="">House Type</span>
                    <select class="myformselect" aria-label="Default select example">
                        <option selected>Select a type</option>
                        <option value="1">Studio</option>
                        <option value="2">Superior Studio </option>
                        <option value="3">One Bedroom</option>
                        <option value="4">Two Bedroom </option>
                        <option value="5">Three Bedroom</option>
                    </select>
                    <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
                </div>
                <div class="col-md-6">
                    <span class="" id="">House Number</span>
                    <input value = '<?php echo htmlspecialchars($courseName) ?>' type="text" name="courseName" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['courseName'] ?></p></span>
                </div>
            </fieldset>
            
            <fieldset id="employementIncome" class="scheduler-border ">
                <legend class="scheduler-border">Financial Information</legend>
                <div class="row g-3">

                <div class="col-md-6">
                    <span class="" id="">Bank Name</span>
                    <select class="myformselect" aria-label="Default select example">
                        <option selected>Select a bank</option>
                        <option value="1">Equity Bank Kenya</option>
                        <option value="2">Kenya Commercial Bank (KCB) </option>
                        <option value="3">Cooperative Bank of Kenya</option>
                        <option value="4">Standard Chartered Bank Kenya </option>
                        <option value="5">Absa Bank Kenya</option>
                    </select>
                    <span><p class='errorMessages'><?php echo $errors['fullName'] ?></p></span>
                </div>
                <div class="col-md-6">
                    <span class="" id="">Branch</span>
                    <input value = '<?php echo htmlspecialchars($courseName) ?>' type="text" name="courseName" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['courseName'] ?></p></span>
                </div>
                <div class="col-md-6">
                    <span class="" id="">Account Number</span>
                    <input value = '<?php echo htmlspecialchars($courseName) ?>' type="text" name="courseName" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                    <span><p class='errorMessages'><?php echo $errors['courseName'] ?></p></span>
                </div>
            </fieldset> -->

            <div class="agreeDisagreeClause">
                <p>By submitting the form, you acknowledge that you have read, understood, and agreed to these terms and conditions. <br><br></p>  
                <div class="agreeDisagreeButtons">
                <button class="TnCBtn agree-button" id="agreeBtn" type="submit">Agree and Submit</button>
                <button  class="TnCBtn disagree-button" id="agreeBtn">I Disagree</button>
                </div>
                
            </div>
    
        </form>
    </div> 
    
        
   
</div>

</div>

<?php include('footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>