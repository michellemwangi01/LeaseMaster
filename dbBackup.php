<?php
// Database credentials
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'leasemaster';

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

// Backup file name and path
$backupFile = '/home/michelle/Amirah' . date('Y-m-d_H-i-s') . '.sql';

// Create the backup command
$command = "mysqldump --opt -h $dbhost -u $dbuser -p$dbpass $dbname > $backupFile";

// Execute the backup command
exec($command);
?>