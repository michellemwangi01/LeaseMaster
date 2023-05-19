<?php
include('header.php');
include('dbconnection.php');

$errors = array("firstName" => '',"lastName" => '', "phoneNumber" => '', "email" => '', "identification" => '', "identificationNo" => '', "DoB" => '',"kinFullNames" => '',"kinRelationship" => '',"kinMobile" => '',"prevAddress" => '',"prevAddressContact" => '',"lengthofStay" => '',"reasonForLeaving" => '',
"employerName" => '',"jobTitle" => '',"employerMobile" => '',"employerEmail" => '', "houseType" => '',"houseNumber" => '',"bankName" => '', "bankBranch" => '',"bankAcctNumber" => '' );

$firstName = $kinFullNames = $kinRelationship = $kinMobile = $lastName = $phoneNumber = $email = $identification = $identificationNo = $DoB = $prevAddress = $prevAddressContact = $lengthofStay = $reasonForLeaving = 
$employerName = $jobTitle = $employerMobile = $employerEmail = 
$houseType = $houseNumber = $bankName = $bankBranch = $bankAcctNumber =  '';
//--------------------------FORM VALIDATION-------------------
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //echo print_r($_POST);


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
        
          //check kinFullNames
        $kinFullNames = $_POST['kinFullNames'];
        if(empty($kinFullNames)){
            $errors['kinFullNames'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $kinFullNames )){
                $errors['kinFullNames'] = '*Name not valid';
            }
                
        }
        //check kinRelationship
        $kinRelationship = $_POST['kinRelationship'];
        if(empty($kinRelationship)){
            $errors['kinRelationship'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $kinRelationship )){
                $errors['kinRelationship'] = '*Name not valid';
            }
                
        }
        //check kinMobile
        $kinMobile = $_POST['kinMobile'];
        if(empty($kinMobile)){
            $errors['kinMobile'] = '*Required';
        }
        else{
            if(!preg_match('/^[0-9]+$/',$kinMobile)){
                $errors['kinMobile'] = '*Phone number not valid';
            }
            
        }
            //check prevAddress
            $prevAddress = $_POST['prevAddress'];
            if(empty($prevAddress)){
                $errors['prevAddress'] = '*Required'; 
            }
            else{
                if(!preg_match('/^[a-zA-Z\s]+$/', $prevAddress )){
                    $errors['prevAddress'] = '*Name not valid';
                }
                    
            }
            //check prevAddressContact
            $prevAddressContact = $_POST['prevAddressContact'];
            if(empty($prevAddressContact)){
                $errors['prevAddressContact'] = '*Required'; 
            }
            else{
                if(!preg_match('/^[0-9]+$/', $prevAddressContact )){
                    $errors['prevAddressContact'] = '*Name not valid';
                }
                    
            }
            //check lengthofStay
            $lengthofStay = $_POST['lengthofStay'];
            if(empty($lengthofStay)){
                $errors['lengthofStay'] = '*Required'; 
            }
            else{
                if(!preg_match('/^[0-9]+$/', $lengthofStay)){
                    $errors['lengthofStay'] = '*Name not valid';
                }
                    
            }
            //check reasonForLeaving
            $reasonForLeaving = $_POST['reasonForLeaving'];
            if(empty($reasonForLeaving)){
                $errors['reasonForLeaving'] = '*Required'; 
            }
            
        //check employerName 
        $employerName = $_POST['employerName'];
        if(empty($employerName)){
            $errors['employerName'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $employerName )){
                $errors['employerName'] = '*Name not valid';
            }
                
        }
        //check jobTitle
        $jobTitle = $_POST['jobTitle'];
        if(empty($jobTitle)){
            $errors['jobTitle'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $jobTitle )){
                $errors['jobTitle'] = '*Name not valid';
            }
                
        }
        //check employerMobile 
        $employerMobile = $_POST['employerMobile'];
        if(empty($employerMobile)){
            $errors['employerMobile'] = '*Required';
        }
        else{
            if(!preg_match('/^[0-9]+$/',$employerMobile)){
                $errors['employerMobile'] = '*Phone number not valid';
            }
            
        }
        //check employerEmail
        $employerEmail = $_POST['employerEmail'];
        if(empty($employerEmail)){
            $errors['employerEmail'] = '*Required';
        }else{
            if(!filter_var($employerEmail, FILTER_VALIDATE_EMAIL)){
                $errors['employerEmail'] = '*Email not valid';
            }
        }
        //check houseType
        $houseType = $_POST['houseType'];
        if(empty($houseType)){
            $errors['houseType'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $houseType )){
                $errors['houseType'] = '*Name not valid';
            }
                
        }
        //check houseNumber
        $houseNumber = $_POST['houseNumber'];
        if(empty($houseNumber)){
            $errors['houseNumber'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z0-9\s]+$/', $houseNumber )){
                $errors['houseNumber'] = '*Name not valid';
            }
                
        } 
        //check bankName 
        $bankName = $_POST['bankName'];
        if(empty($bankName)){
            $errors['bankName'] = '*Required'; 
        }
        
        //check bankBranch
        $bankBranch = $_POST['bankBranch'];
        if(empty($bankBranch)){
            $errors['bankBranch'] = '*Required'; 
        }
        else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $bankBranch)){
                $errors['bankBranch'] = '*Name not valid';
            }
                
        }
        //check bankAcctNumber 
        $bankAcctNumber = $_POST['bankAcctNumber'];
        if(empty($bankAcctNumber)){
            $errors['bankAcctNumber'] = '*Required';
        }
        else{
            if(!preg_match('/^[0-9]+$/',$bankAcctNumber)){
                $errors['bankAcctNumber'] = '*Acct not valid';
            }
            
        }
      
         
    if (array_filter($errors)) {
        // echo "no errors!";
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $identification = mysqli_real_escape_string($conn, $_POST['identification']);
        $identificationNo = mysqli_real_escape_string($conn, $_POST['identificationNo']); 
        $DoB = mysqli_real_escape_string($conn, $_POST['DoB']); 
        $kinFullNames = mysqli_real_escape_string($conn, $_POST['kinFullNames']); 
        $kinRelationship = mysqli_real_escape_string($conn, $_POST['kinRelationship']); 
        $kinMobile = mysqli_real_escape_string($conn, $_POST['kinMobile']); 
        $prevAddress = mysqli_real_escape_string($conn, $_POST['prevAddress']); 
        $prevAddressContact = mysqli_real_escape_string($conn, $_POST['prevAddressContact']); 
        $lengthofStay = mysqli_real_escape_string($conn, $_POST['lengthofStay']); 
        $reasonForLeaving = mysqli_real_escape_string($conn, $_POST['reasonForLeaving']); 
        $employerName = mysqli_real_escape_string($conn, $_POST['employerName']); 
        $jobTitle = mysqli_real_escape_string($conn, $_POST['jobTitle']); 
        $employerMobile = mysqli_real_escape_string($conn, $_POST['employerMobile']); 
        $employerEmail = mysqli_real_escape_string($conn, $_POST['employerEmail']); 
        $houseType = mysqli_real_escape_string($conn, $_POST['houseType']); 
        $houseNumber = mysqli_real_escape_string($conn, $_POST['houseNumber']); 
        $bankName = mysqli_real_escape_string($conn, $_POST['bankName']); 
        $bankBranch = mysqli_real_escape_string($conn, $_POST['bankBranch']); 
        $bankAcctNumber = mysqli_real_escape_string($conn, $_POST['bankAcctNumber']); 


        //write sql query to insert values into sql table
        
        
        try{
            mysqli_report(MYSQLI_REPORT_ERROR);

            $sqlquery = "INSERT INTO `clientapplications`(`FirstName`, `LastName`, `Mobile`, 
            `email`, `identification`, `identificationNo`, `DateofBirth`, `prevAddress`, `prevAddressContact`, `lengthofStay`, `reasonForLeaving`, `employerName`, `jobTitle`, `employerMobile`, `employerEmail`, `houseType`, `houseNumber`, `bankName`, 
            `bankBranch`, `bankAcctNumber`) 
            VALUES (
            '$firstName','$lastName', $phoneNumber, 
            '$email','$identification', '$identificationNo',
            $DoB,'$prevAddress', '$prevAddressContact',    $lengthofStay, '$reasonForLeaving', '$employerName', 
            '$jobTitle', '$employerMobile', '$employerEmail', '$houseType', '$houseNumber', '$bankName', '$bankBranch', '$bankAcctNumber' )";

            mysqli_query($conn, $sqlquery);
            echo "Data inserted successfully!";
        }catch(Exception $e){
            // Step 4: Catch database errors
            echo "Error: " . $e->getMessage();
        }

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
        <div class="TnCs">
            <h2>NEW TENANT APPLICATION</h2>
                <h4>Terms and Conditions</h4>
                <p>
                    Please carefully read and review the following terms and conditions before filling out the form. These terms and conditions govern your use of the form and the information you provide. By submitting the form, you agree to be bound by these terms and conditions.

                    <br><br>Information Accuracy: You certify that all information provided in the form is true, accurate, and complete to the best of your knowledge. Any false or misleading information may result in the termination of your application or tenancy.

                    <br> <br>Data Privacy: The information you provide in the form will be collected and processed in accordance with applicable data protection laws. The information will be used for the purpose of evaluating your application and managing the tenancy. Your personal information will be kept confidential and will not be disclosed to third parties without your consent, except as required by law.

                    <br><br>Application and Approval: Submitting the form does not guarantee approval of your application or the availability of the property. The landlord or authorized agents reserve the right to conduct background checks, credit checks, and verification of the information provided. The approval of your application is at the sole discretion of the landlord.
            </p>
        </div>
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

                <fieldset id="IdentityKinInfo" class="row g-3 scheduler-border">
                    <legend class="scheduler-border"> Next of Kin</legend>
            
                    <div class="">
                        <span class="" id="">Full Names</span>
                        <input value = '<?php echo htmlspecialchars($kinFullNames) ?>' type="text" name="kinFullNames"class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['kinFullNames'] ?></p></span>
                    </div>
                    <div class="col-md-6">
                        <span class="" id="">Relationship</span>
                        <input value = '<?php echo htmlspecialchars($kinRelationship) ?>' type="text" name="kinRelationship"class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['kinRelationship'] ?></p></span>
                    </div>
                    
                    <div class="col-md-6">
                        <span class="" id="">Mobile Number</span>
                        <input value = '<?php echo htmlspecialchars($kinMobile) ?>' type="text" name="kinMobile" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['kinMobile'] ?></p></span>
                    </div>
                

            </fieldset>
            
                <fieldset id="RentalHistorty" class="scheduler-border ">
                        <legend class="scheduler-border">Rental History</legend>

                    <div class="row g-3">
                            
                        
                        <div class="col-md-6">
                            <span class="" id="">Previous Address</span>
                            <input value = '<?php echo htmlspecialchars($prevAddress) ?>' type="text" name="prevAddress"class="myformControl" aria-label="Sizing example input" aria-describedby="">
                            <span><p class='errorMessages'><?php echo $errors['prevAddress'] ?></p></span>
                        </div>
                        
                        <div class="col-md-6">
                            <span class="" id="">Contact Number</span>
                            <input value = '<?php echo htmlspecialchars($prevAddressContact) ?>' type="text" name="prevAddressContact" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                            <span><p class='errorMessages'><?php echo $errors['prevAddressContact'] ?></p></span>
                        </div>
                        <div class="col-md-6">
                            <span class="" id="">Length of Stay (in months)</span>
                            <input value = '<?php echo htmlspecialchars($lengthofStay) ?>' type="number" name="lengthofStay" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                            <span><p class='errorMessages'><?php echo $errors['lengthofStay'] ?></p></span>
                        </div>
                        <div class="col-md-6">
                            <span class="" id="">Reason for Leaving</span>
                            <input value = '<?php echo htmlspecialchars($reasonForLeaving) ?>' type="text" name="reasonForLeaving" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                            <span><p class='errorMessages'><?php echo $errors['reasonForLeaving'] ?></p></span>
                        </div>
                    </div>
                </fieldset>
        
                <fieldset id="employementIncome" class="scheduler-border "> 
                    <legend class="scheduler-border">Employment & Income</legend>
                    <div class="row g-3">

                    <div class="col-md-6">
                        <span class="" id="">Employer Name</span>
                        <input value = '<?php echo htmlspecialchars($employerName) ?>' type="text" name="employerName"class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['employerName'] ?></p></span>
                    </div>
                    <div class="col-md-6">
                        <span class="" id="">Job Title</span>
                        <input value = '<?php echo htmlspecialchars($jobTitle) ?>' type="text" name="jobTitle" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['jobTitle'] ?></p></span>
                    </div>
                    <div class="col-md-6">
                        <span class="" id="">Mobile Number</span>
                        <input value = '<?php echo htmlspecialchars($employerMobile) ?>' type="text" name="employerMobile" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['employerMobile'] ?></p></span>
                    </div>
                    <div class="col-md-6">
                        <span class="" id="">Email</span>
                        <input value = '<?php echo htmlspecialchars($employerEmail) ?>' type="text" name="employerEmail" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['employerEmail'] ?></p></span>
                    </div>  
                    </div> 
                
                </fieldset>
                
                <fieldset id="Reservation Details" class="scheduler-border ">
                    <legend class="scheduler-border">Reservation Details</legend>
                    <div class="row g-3">

                    <div class="col-md-6">
                        <span class="" id="">House Type</span>
                        <select class="myformselect" aria-label="Default select example" name="houseType">
                            <option selected>Select a type</option>
                            <option value="Studio">Studio</option>
                            <option value="Superior Studio">Superior Studio </option>
                            <option value="One Bedroom">One Bedroom</option>
                            <option value="Two Bedroom">Two Bedroom </option>
                            <option value="Three Bedroom">Three Bedroom</option>
                        </select>
                        <span><p class='errorMessages'><?php echo $errors['houseType'] ?></p></span>
                    </div>
                    <div class="col-md-6">
                        <span class="" id="">House Number</span>
                        <input value = '<?php echo htmlspecialchars($houseNumber) ?>' type="text" name="houseNumber" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['houseNumber'] ?></p></span>
                    </div>
                </fieldset>
                
                <fieldset id="Financial Information" class="scheduler-border ">
                    <legend class="scheduler-border">Financial Information</legend>
                    <div class="row g-3">

                    <div class="col-md-6">
                        <span class="" id="">Bank Name</span>
                        <select class="myformselect" aria-label="Default select example" name="bankName">
                            <option selected>Select a bank</option>
                            <option value="Equity Bank Kenya">Equity Bank Kenya</option>
                            <option value="Kenya Commercial Bank (KCB)">Kenya Commercial Bank (KCB) </option>
                            <option value="Cooperative Bank of Kenya">Cooperative Bank of Kenya</option>
                            <option value="Standard Chartered Bank Kenya">Standard Chartered Bank Kenya </option>
                            <option value="Absa Bank Kenya">Absa Bank Kenya</option>
                        </select>
                        <span><p class='errorMessages'><?php echo $errors['bankName'] ?></p></span>
                    </div>
                    <div class="col-md-6">
                        <span class="" id="">Branch</span>
                        <input value = '<?php echo htmlspecialchars($bankBranch) ?>' type="text" name="bankBranch" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['bankBranch'] ?></p></span>
                    </div>
                    <div class="col-md-6">
                        <span class="" id="">Account Number</span>
                        <input value = '<?php echo htmlspecialchars($bankAcctNumber) ?>' type="text" name="bankAcctNumber" class="myformControl" aria-label="Sizing example input" aria-describedby="">
                        <span><p class='errorMessages'><?php echo $errors['bankAcctNumber'] ?></p></span>
                    </div>
                </fieldset> 

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