<?php

// Getting the root of my php mysql
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "registration_db";
$connection = "";

//Try catch to connect it successfully
try {
    // Connecting everything using the mysqli_connect function
    $connection = mysqli_connect($db_server, $db_user,$db_pass,$db_name);
}
catch(mysqli_sql_exception) {
    // If anything goes wrong this code will run..
    echo "ERROR! COULD NOT CONNECT TO THE DATABASE";
}
?>