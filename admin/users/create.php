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


                                if (isset($_GET['sms'])) {
                                    $sms = $_GET['sms'];
                                    if ($sms == 'error') {
                                        echo "<div class='alert alert-danger'>Something went wrong, please try again</div>";
                                        echo "<meta http-equiv=\"refresh\" content=\"1;url=create.php\">";
                                    }
                                    if ($sms == 'duplicate') {
                                        echo "<div class='alert alert-success'>Username or email or liscence No is already exist</div>";
                                        echo "<meta http-equiv=\"refresh\" content=\"1;url=create.php\">";
                                    }
                                    if ($sms == 'empty') {
                                        echo "<div class='alert alert-success'>Enter all information</div>";
                                        echo "<meta http-equiv=\"refresh\" content=\"1;url=create.php\">";
                                    }
                                }


                                if (isset($_POST['register'])) {
                                    $name = $_POST['name'];
                                    $username = $_POST['username'];
                                    $email = $_POST['email'];
                                    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
                                    $liscence_no = $_POST['liscence_no'];

                                    if ($name != '' && $username != '' && $email != '' && $password != '' && $liscence_no != '' ){
                                        // Check for duplicate username or email
                                        $check_sql = "SELECT * FROM users WHERE username='$username' OR email='$email' OR liscence_no='$liscence_no'";
                                        $check_result = $conn->query($check_sql);

                                        if ($check_result->num_rows > 0) {
                                            // Redirect to signup page with an error message
                                            echo "<meta http-equiv=\"refresh\" content=\"0;URL=create.php?sms=duplicate\">";

                                        } else {
                                            // SQL to insert data
                                            $sql = "INSERT INTO users (name, username, email, password, liscence_no) VALUES ('$name', '$username', '$email', '$password', '$liscence_no')";
                                            $result = $conn->query($sql);

                                            if ($result === TRUE) {
                                                // Redirect to index page with a success message
                                                echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?sms=registered\">";

                                            } else {
                                                // Redirect to signup page with an error message
                                                echo "<meta http-equiv=\"refresh\" content=\"0;url=create.php?sms=error\">";

                                            }
                                        }
                                    } else {
                                        // Redirect to create page with an error message
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

                    <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">

                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell">#15346</td>
                                                <td class="cell"><span class="truncate">Lorem ipsum dolor sit amet eget volutpat erat</span></td>
                                                <td class="cell">John Sanders</td>
                                                <td class="cell"><span>17 Oct</span><span class="note">2:16 PM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$259.35</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                            </tr>

                                            <tr>
                                                <td class="cell">#15344</td>
                                                <td class="cell"><span class="truncate">Pellentesque diam imperdiet</span></td>
                                                <td class="cell">Teresa Holland</td>
                                                <td class="cell"><span class="cell-data">16 Oct</span><span class="note">01:16 AM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$123.00</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                            </tr>

                                            <tr>
                                                <td class="cell">#15343</td>
                                                <td class="cell"><span class="truncate">Vestibulum a accumsan lectus sed mollis ipsum</span></td>
                                                <td class="cell">Jayden Massey</td>
                                                <td class="cell"><span class="cell-data">15 Oct</span><span class="note">8:07 PM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$199.00</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                            </tr>


                                            <tr>
                                                <td class="cell">#15341</td>
                                                <td class="cell"><span class="truncate">Morbi vulputate lacinia neque et sollicitudin</span></td>
                                                <td class="cell">Raymond Atkins</td>
                                                <td class="cell"><span class="cell-data">11 Oct</span><span class="note">11:18 AM</span></td>
                                                <td class="cell"><span class="badge bg-success">Paid</span></td>
                                                <td class="cell">$678.26</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->

                    <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="cell">#15345</td>
                                                <td class="cell"><span class="truncate">Consectetur adipiscing elit</span></td>
                                                <td class="cell">Dylan Ambrose</td>
                                                <td class="cell"><span class="cell-data">16 Oct</span><span class="note">03:16 AM</span></td>
                                                <td class="cell"><span class="badge bg-warning">Pending</span></td>
                                                <td class="cell">$96.20</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                    <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">Order</th>
                                                <th class="cell">Product</th>
                                                <th class="cell">Customer</th>
                                                <th class="cell">Date</th>
                                                <th class="cell">Status</th>
                                                <th class="cell">Total</th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td class="cell">#15342</td>
                                                <td class="cell"><span class="truncate">Justo feugiat neque</span></td>
                                                <td class="cell">Reina Brooks</td>
                                                <td class="cell"><span class="cell-data">12 Oct</span><span class="note">04:23 PM</span></td>
                                                <td class="cell"><span class="badge bg-danger">Cancelled</span></td>
                                                <td class="cell">$59.00</td>
                                                <td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->
                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//tab-pane-->
                </div><!--//tab-content-->



            </div><!--//container-fluid-->
        </div><!--//app-content-->



    </div><!--//app-wrapper-->


    <?php require('../includes/footer.php'); ?>