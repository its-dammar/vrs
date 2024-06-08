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
                        <h1 class="app-page-title mb-0">Add Image</h1>
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
                                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=create.php\">";
                                    }
                                    if ($sms == 'duplicate') {
                                        echo "<div class='alert alert-success'>Username or email or liscence No is already exist</div>";
                                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=create.php\">";
                                    }
                                    if ($sms == 'empty') {
                                        echo "<div class='alert alert-success'>Enter all information</div>";
                                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=create.php\">";
                                    }
                                }


                                if (isset($_POST['submit'])) {
                                    $title = $_POST['title'];
                                    $description = $_POST['description'];

                                    $filename = $_FILES['dataFile']['name'];
                                    $filesize = $_FILES['dataFile']['size'];

                                    $explode = explode('.', $filename);
                                    $firstname = strtolower($explode[0]);
                                    $ext = strtolower($explode[1]);
                                    $rep = str_replace(' ', '', $filename);

                                    $finalfilename = $rep . time() . '.' . $ext;

                                    if ($title != '' && $description != '' && $filename != '') {

                                        if ($filesize > 50000) {
                                            if ($ext == "jpg" || $ext == "png") {
                                                if (move_uploaded_file($_FILES['dataFile']['tmp_name'], '../uploads/' . $finalfilename)) {
                                                    $query = "INSERT INTO files (title, description, image_link) 
                                                VALUES ('$title','$description', '$finalfilename')"; // variable

                                                    $result = mysqli_query($conn, $query); // connect to database
                                                    if ($result) {
                                ?>
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                            <strong>Image is added</strong> successfully
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php
                                                      echo "<meta http-equiv=\"refresh\" content=\"1;URL=index.php\">";

                                                    } else {
                                                    ?>
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <strong>Image is not added</strong> successfully
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                <?php
                                                  echo "<meta http-equiv=\"refresh\" content=\"1;URL=create.php?sms=error\">";
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>Image is not uploaded </strong> successfully
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php
                                              echo "<meta http-equiv=\"refresh\" content=\"1;URL=create.php?sms=error\">";
                                            }
                                        } else {
                                            ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Image size must be 2MB</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php
                                          echo "<meta http-equiv=\"refresh\" content=\"1;URL=create.php?sms=error\">";
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Fill all the fields</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                <?php
                                  echo "<meta http-equiv=\"refresh\" content=\"1;URL=create.php?sms=error\">";
                                    }





                                    $conn->close();
                                }
                                ?>
                                <form class="auth-form auth-signup-form" action="#" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <label class="sr-only" for="signup-email">Title</label>
                                            <input id="signup-name" name="title" type="text" class="form-control signup-name" placeholder="Full name">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <label class="sr-only" for="signup-email">Choose Image</label>
                                            <input id="signup-name" name="dataFile" type="file" class="form-control signup-name" placeholder="Choose File">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" name="submit" class="btn app-btn-primary btn-sm theme-btn mx-auto">Add Image</button>
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