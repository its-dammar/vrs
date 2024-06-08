<?php
include("../config/config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = " delete from cars where id ='$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('Refresh: 0; url=index.php');
    } else {
        echo "your data is not delete";
    }
}
