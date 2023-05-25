<?php 
require_once 'functions.php';
include("dbconnection.php");

check_login($conn);

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 


$sqlquery = "SELECT * FROM clientapplications order by clientID desc";
$results = mysqli_query($conn, $sqlquery);
$tenants = mysqli_fetch_all($results, MYSQLI_ASSOC);
//PRINT_R( $tenants);//print out our Aarray version of the result
//echo $tenants[0]['studentName']



if(isset($_POST['delete'])){


    function deleteConfirm(){
        //echo 'Record has been deleted';
        echo ' <script>alert("Do you want too delete the selected record?")</script> ';
    }
    
    function deletenotConfirm(){
        echo ' <script>alert("Record has not been deleted")</script> ';
    }

    
    //echo '<script> confirm("Please confirm deletion of student No.' .$recordtoDelete.' by clicking \'OK\'")  </script>';
    //echo $_POST['recordtoDelete'];
    $recordtoDelete = mysqli_real_escape_string($conn, $_POST['recordtoDelete']);
    //echo $recordtoDelete;
    
    $sqldeleteQuery = "DELETE FROM clientapplications where clientID = '{$recordtoDelete}'";
    
    if(mysqli_query($conn, $sqldeleteQuery)){
        //sucessful delete
        //echo '<script> alert("Record has not been deleted")</script>';
        header('Location: tenants.php');
        
    }else{
       
        echo 'Database Error: '.mysqli_error($conn);
    } 
    mysqli_free_result($results);
    //mysqli_close($link);


   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>Registered Students</title>
    
<style>
    .studentDetailsDiv{
        display: flex;
        flex-wrap: wrap;
        width: 90%;
        margin:  20px auto;
        border: 1px solid coral;
        border-radius: 7px;
        padding: 20px;
    }
    .pageHeader{
        text-align: center;
        padding: 10px;
        margin: 5px;
        font-family: Georgia, 'Times New Roman', Times, serif;
    }
    img{
        display: block;
    }
    button{
        border: none;
        background-color: transparent;
        color: #860753;
    }
   table{
    margin:0;
   }
   thead{
    
    text-align: center;
   }
   th{
    font-family: Georgia, 'Times New Roman', Times, serif;
    font-weight: lighter;

   }
   td{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-align: center;
    justify-content: left;
   }
   
</style>
</head>
<body>
    <?php include('header.php') ?>
    <div class="pageHeader">
        <h3>Tenant Records</h3>
    </div>
    <div class="studentDetailsDiv table-responsive">
    <table class="table table-hover table-striped table-responsive" >
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>identification</th>
                <th>identificationNo</th>
             
            </tr>
            </thead>
            <tbody class="table-striped">
            <?php foreach($tenants as $tenantElement): ?>
             <tr>
                <td> <?php echo '0'.htmlspecialchars($tenantElement['clientID']); ?> </td>
                <td> <?php echo htmlspecialchars($tenantElement['FirstName']); ?> </td>
                <td> <?php echo htmlspecialchars($tenantElement['LastName']); ?> </td>
                <td> <?php echo htmlspecialchars($tenantElement['Mobile']); ?> </td>
                <td> <?php echo htmlspecialchars($tenantElement['email']); ?> </td>
                <td> <?php echo htmlspecialchars($tenantElement['identification']); ?> </td>
                <td> <?php echo htmlspecialchars($tenantElement['identificationNo']); ?> </td>
               
                <td>
                    <form action="tenants.php" method="POST">   
                        <a href="editTenantDetails.php?id=<?php echo htmlspecialchars($tenantElement['clientID'])?>"><i class="bi bi-pencil"></i></a>
                    </form> 
                    
                </td>
                <td>
                    <form action="tenants.php" method="POST">
                        <input 
                        type="hidden" 
                        name="recordtoDelete" 
                        value="<?php echo $tenantElement['clientID'] ?>">
                        <button onclick="alert('Selected record will be deleted')" type="submit" name="delete"><i class="bi bi-trash"></i></button>
                    </form>
                </td> 
                <td>
                    <button>Due for Appr</button>
                </td>
            </tr>
            </tbody>
            <?php endforeach ?> 
        
    </table>


    </div>
   
<?php include('footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>
</html>
