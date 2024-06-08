<?php
include("../config/config.php");
 
 if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query1="SELECT * from files where id= $id";
    $result= mysqli_query($conn, $query1);
    $row= $result->fetch_assoc();
    
    $filelink= $row['image_link'];
    $finallink= '../uploads/'.$filelink;
    unlink($finallink);

    $query=" delete from files where id =$id";
    $result= mysqli_query($conn, $query);
    if($result){
        header('Refresh: 0; url=index.php');
    }
    else{
        echo "your data is not delete";
    }
    }