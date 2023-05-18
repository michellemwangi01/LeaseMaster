<?php   

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'leasemaster';

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
    die("Failed to connect");
}

?>