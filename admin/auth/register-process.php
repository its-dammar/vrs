<?php include('../config/config.php'); ?>

<?php
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
    $liscence_no = $_POST['liscence_no'];

    // Check for duplicate username or email
    $check_sql = "SELECT * FROM users WHERE username='$username' OR email='$email' OR liscence_no='$liscence_no'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Redirect to signup page with an error message
        header('Location: ../signup.php?sms=duplicate');
    } else {
        // SQL to insert data
        $sql = "INSERT INTO users (name, username, email, password, liscence_no)
                VALUES ('$name', '$username', '$email', '$password', '$liscence_no')";
        $result = $conn->query($sql);

        if ($result === TRUE) {
            // Redirect to index page with a success message
            header('Refresh: 1; url=../index.php?sms=registered');
        } else {
            // Redirect to signup page with an error message
            header('Refresh: 1; url=../signup.php?sms=error');
        }
    }

    $conn->close();
}
?>
