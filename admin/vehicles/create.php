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
                        <h1 class="app-page-title mb-0">Add Vehicle</h1>
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
                                // Check if the form is submitted
                                if (isset($_POST['add_vehicle'])) {
                                    // Check if the user is logged in
                                    if (isset($_SESSION['username'])) {
                                        // Retrieve the user_id from the session (or any other identifier)
                                        $username = $_SESSION['username']; // Change this according to your session variable

                                        // Retrieve other form data
                                        $image = $_POST['image'];
                                        $vehicle_name = $_POST['vehicle_name'];
                                        $reg_no = $_POST['reg_no'];
                                        $description = $_POST['description'];

                                        // Validate form data
                                        if ($image != '' && $description != '' && $vehicle_name != '' && $reg_no != '') {
                                            // Sanitize form data (to prevent SQL injection)


                                            // Check if the user exists
                                            $sql_check_user = "SELECT id FROM users WHERE username = '$username'";
                                            $result_check_user = $conn->query($sql_check_user);

                                            if ($result_check_user->num_rows > 0) {
                                                // User exists, fetch the user_id
                                                $row = $result_check_user->fetch_assoc();
                                                $user_id = $row['id'];

                                                // Proceed with insertion into the cars table
                                                $sql_insert_car = "INSERT INTO cars (user_id, image, vehicle_name, reg_no, description) 
                                                VALUES ('$user_id', '$image', '$vehicle_name', '$reg_no', '$description')";

                                                if ($conn->query($sql_insert_car) === TRUE) {
                                ?>
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Success!</strong> Vehicle added successfully.
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                <?php
                                                    echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php?sms=registered\">";
                                                } else {
                                                ?>
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong> vehicle is not added </strong> 
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                <?php
                                                    echo "<meta http-equiv=\"refresh\" content=\"0;url=create.php\">";
                                                }
                                            } else {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>User not found!</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php
                                                echo "<meta http-equiv=\"refresh\" content=\"0;url=create.php\">";
                                            }
                                        } else {
                                            ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>all field are required!</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php
                                            echo "<meta http-equiv=\"refresh\" content=\"0;url=create.php\">";
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>not Found!</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                <?php
                                        echo "<meta http-equiv=\"refresh\" content=\"0;url=create.php\">";
                                    }
                                    $conn->close();
                                }
                                ?>


                                <form class="auth-form auth-signup-form" action="#" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <label class="sr-only" for="signup-email">Vehicle Name</label>
                                            <input id="signup-name" name="vehicle_name" type="text" class="form-control signup-name" placeholder="Full name">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <label class="sr-only" for="signup-email">Registration Number</label>
                                            <input id="signup-name" name="reg_no" type="text" class="form-control signup-name" placeholder="Username">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <!-- Modal trigger button -->

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalTitleId">
                                                                Modal title
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">

                                                                <style>
                                                                    [type=radio]:checked+img {
                                                                        outline: 2px solid #f00;
                                                                    }
                                                                </style>

                                                                <?php
                                                                $select_query = "SELECT * FROM files";
                                                                $select_result = mysqli_query($conn, $select_query);
                                                                $i = 0;
                                                                while ($data_select = mysqli_fetch_array($select_result)) {
                                                                    $i++;
                                                                ?>
                                                                    <div class="col-md-4 p-2">
                                                                        <label>
                                                                            <input type="radio" name="filename1" value="<?php echo $data_select['image_link']; ?>" style="opacity: 0;" />
                                                                            <img src="<?php echo "../uploads/" . $data_select['image_link']; ?>" alt="" height="100px;" width="100px;" style="margin-right:20px;">
                                                                        </label>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="firstFunction()">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Optional: Place to the bottom of scripts -->
                                            <script>
                                                const myModal = new bootstrap.Modal(
                                                    document.getElementById("modalId"),
                                                    options,
                                                );
                                            </script>

                                            <div class="form-group col-12 mb-0">
                                                <label class="col-form-label"> Image</label>
                                                <!-- <div>
                                                <input id="imagebox" class="form-control" name="img" type="text" value="">
                                            </div> -->
                                            </div>

                                            <div class="input-group mb-3 col-12">
                                                <input id="sliderbox" type="text" class="form-control" name="image" readonly>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalId">Choose Image
                                                    </button>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-12">
                                            <button type="submit" name="add_vehicle" class="btn app-btn-primary btn-sm theme-btn mx-auto">Sign Up</button>
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

    <script>
        function firstFunction() {
            var selectedOption1 = document.querySelector('input[name=filename1]:checked').value;
            //var selectedOption = $("input:radio[name=filename]:checked").val()
            document.getElementById('sliderbox').value = selectedOption1; // use .innerHTML if we want data on label
        }
    </script>


    <?php require('../includes/footer.php'); ?>