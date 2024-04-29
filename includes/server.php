<?php
$db_host = 'sql201.infinityfree.com';
$db_username = 'if0_36392188';
$db_password = 'mMQYhBc9c1kFd';
$db_name = 'if0_36392188_cms' ;

$connect = mysqli_connect($db_host, $db_username,$db_password,$db_name);


if (mysqli_connect_error()){
    exit('Failed to connect to MySQL:' . mysqli_connect_error());
}
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?> 