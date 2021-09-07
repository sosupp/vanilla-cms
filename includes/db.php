<?php
// connecting to DB

// $db['db_host'] = "localhost";
// $db['db_user'] = "root";
// $db['db_pass'] = "";
// $db['db_name'] = "cms";

// foreach($db as $key => $value){
//     define(strtoupper($key), $value);
// }

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "cms";

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// if ($connection){
//     echo "we are connected";
// } else {
//     echo "No connection"; 
// }


?>