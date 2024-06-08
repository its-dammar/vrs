<?php require('../includes/header.php'); ?>

<body class="app">
    <header class="app-header fixed-top">
        <?php require('../includes/navbar.php'); ?>
        <?php require('../includes/sidebar.php'); ?>
    </header><!--//app-header-->

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="row g-3 mb-4 align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="app-page-title mb-0">Add User</h1>
                    </div>
                    <div class="col-auto">
                        <div class="page-utilities">
                            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                                <div class="col-auto">
                                    <form class="table-search-form row gx-1 align-items-center">
                                        <div class="col-auto">
                                            <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </form>

                                </div><!--//col-->
                            </div><!--//row-->
                        </div><!--//table-utilities-->
                    </div><!--//col-auto-->
                </div><!--//row-->

                <div class="tab-content" id="orders-table-tab-content">
                    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body p-5">
                                <?php
                                if (isset($_POST['register'])) {
                                    $name = $_POST['name'];
                                    $username = $_POST['username'];
                                    $email = $_POST['email'];
                                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
                                    $liscence_no = $_POST['liscence_no'];

                                    if ($name != '' && $username != '' && $email != '' && $password != '' && $liscence_no != '') {
                                        // Check for duplicate username or email
                                        $check_sql = "SELECT * FROM users WHERE username='$username' OR email='$email' OR liscence_no='$liscence_no'";
                                        $check_result = $conn->query($check_sql);

                                        if ($check_result->num_rows > 0) {
                                            // Redirect to signup page with an error message
                                ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Warning!</strong> Username or email or liscence No is already exist
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php
                                            echo "<meta http-equiv=\"refresh\" content=\"0;url=create.php?sms=duplicate\">";

                                        } else {
                                            // SQL to insert data
                                            $sql = "INSERT INTO users (name, username, email, password, liscence_no) VALUES ('$name', '$username', '$email', '$password', '$liscence_no')";
                                            $result = $conn->query($sql);

                                            if ($result === TRUE) {
                                                // Redirect to index page with a success message
                                            ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>Success!</strong> User registered successfully
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php
                                                echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?sms=registered\">";
                                            } else {
                                                // Redirect to signup page with an error message
                                            ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>Warning!</strong> Something went wrong, please try again
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                        <?php
                                                echo "<meta http-equiv=\"refresh\" content=\"0;url=create.php?sms=error\">";
                                            }
                                        }
                                    } else {
                                        // Redirect to create page with an error message
                                        ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Warning!</strong> Enter all information required
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                <?php
                                        echo "<meta http-equiv=\"refresh\" content=\"0;url=create.php?sms=empty\">";
                                    }

                                    $conn->close();
                                }
                                ?>
                                <form class="auth-form auth-signup-form" action="#" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <label class="sr-only" for="signup-email">Your Name</label>
                                            <input id="signup-name" name="name" type="text" class="form-control signup-name" placeholder="Full name">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <label class="sr-only" for="signup-email">Username</label>
                                            <input id="signup-name" name="username" type="text" class="form-control signup-name" placeholder="Username">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <label class="sr-only" for="signup-email">Liscense No.</label>
                                            <input id="signup-name" name="liscence_no" type="text" class="form-control signup-name" placeholder="liscence_no">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <label class="sr-only" for="signup-email">Your Email</label>
                                            <input id="signup-email" name="email" type="email" class="form-control signup-email" placeholder="Email">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 password mb-3">
                                            <label class="sr-only" for="signup-password">Password</label>
                                            <input id="signup-password" name="password" type="password" class="form-control signup-password" placeholder="Create a password">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" name="register" class="btn app-btn-primary btn-sm theme-btn mx-auto">Sign Up</button>
                                        </div>
                                    </div>

                                </form><!--//auth-form-->

                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                        <nav class="app-pagination">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav><!--//app-pagination-->

                    </div><!--//tab-pane-->

                   
                </div><!--//tab-content-->



            </div><!--//container-fluid-->
        </div><!--//app-content-->



    </div><!--//app-wrapper-->


    <?php require('../includes/footer.php'); ?>