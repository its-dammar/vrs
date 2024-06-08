
<?php
include('../config/config.php');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['liscence_no'] = $row['liscence_no'];
            header('Refresh: 1; url=../dashboard.php?sms=success');
        }else{
            header('Refresh: 0; url=../index.php?sms=pass_error');
        }
    }else{
        header('Refresh: 0; url=../index.php?sms=error');
    }
    $conn->close();
}


?>