<!-- database connection -->

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vrs";

$conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn) {
//     echo "Database is connected successfully";
// } else {

//     echo "Database is not connected, please check the connection";
// }

?>