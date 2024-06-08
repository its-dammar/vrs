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

                                if (isset($_GET['id'])) {

                                    $id = $_GET['id'];
                                    $query = "SELECT * FROM files WHERE id=$id";
                                    $result = mysqli_query($conn, $query);
                                    $data = $result->fetch_assoc();
                                }


                                if (isset($_POST['submit'])) {
                                    $title = $_POST['title'];
                                    $description = $_POST['description'];

                                    $filename = $_FILES['dataFile']['name'];
                                    $filesize = $_FILES['dataFile']['size'];

                                    // submit previous file
                                    if ($title != "" && $description !== "" && $filename == "") {
                                        $querry = "UPDATE  files  SET  title='$title', description='$description' WHERE id=$id";

                                        $result = mysqli_query($conn, $querry);
                                        if ($result) {
                                ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>data is changed</strong> successfully
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            <?php
                                        } else
                                            echo "not 1st";
                                    }

                                    $explode = explode('.', $filename);
                                    $firstname = strtolower(@$explode[0]);
                                    $ext = strtolower(@$explode[1]);
                                    $rep = str_replace(' ', '', $filename);

                                    $finalfilename = $rep . time() . '.' . $ext;
                                    $targrt_file = '../uploads/' . $finalfilename;

                                    if ($title != '' && $description != '' && $finalfilename != '') {

                                        if ($filesize > 50000) {
                                            if ($ext == "jpg" || $ext == "png") {

                                                // replace old file
                                                $oldfilelink = $data['image_link']; //file link from database
                                                $finallink = '../uploads/' . $oldfilelink;
                                                unlink($finallink);

                                                if (move_uploaded_file($_FILES['dataFile']['tmp_name'], $targrt_file)) {
                                                    $querry = "UPDATE  files  SET  title='$title', description='$description', image_link='$$targrt_file' WHERE id=$id";

                                                    $result = mysqli_query($conn, $query); // connect to database
                                                    if ($result) {
                                            ?>
                                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                            <strong>Image is Updated</strong> successfully
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    <?php
                                                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=index.php\">";
                                                    } else {
                                                    ?>
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <strong>Image is not updated</strong> successfully
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                <?php
                                                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=index.php\">";
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>Image is not uploaded </strong> successfully
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php
                                                echo "<meta http-equiv=\"refresh\" content=\"1;URL=index.php\">";
                                            }
                                        } else {
                                            ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Image size must be 2MB</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php
                                            echo "<meta http-equiv=\"refresh\" content=\"1;URL=index.php\">";
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Fill all the fields</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>

                                <?php
                                        echo "<meta http-equiv=\"refresh\" content=\"1;URL=index.php\">";
                                    }





                                    $conn->close();
                                }
                                ?>
                                <form class="auth-form auth-signup-form" action="#" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <label class="sr-only" for="signup-email">Title</label>
                                            <input id="signup-name" name="title" value="<?php echo $data['title'];  ?>" type="text" class="form-control signup-name" placeholder="Full name">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 email mb-3">
                                            <label class="sr-only" for="signup-email">Choose Image</label>
                                            <img src="<?php echo '../uploads/' . $data['image_link'];  ?>" alt="" width="100" height="100">
                                            <input id="signup-name" name="dataFile" type="file" class="form-control signup-name" placeholder="Choose File">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"> <?php echo $data['description'];  ?></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" name="submit" class="btn app-btn-primary btn-sm theme-btn mx-auto">Update</button>
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