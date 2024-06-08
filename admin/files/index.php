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
                        <h1 class="app-page-title mb-0">Mange Files</h1>
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
                            <div class="app-card-body">
                                <?php
                                if (isset($_GET['sms'])) {
                                    $sms = $_GET['sms'];
                                    if ($sms == 'registered') {
                                        echo "<div class='alert alert-danger'>Something went wrong, please try again</div>";
                                        header('Refresh: 1; url=create.php');
                                    }
                                }

                                ?>
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">S.N</th>
                                                <th class="cell"> title</th>
                                                <th class="cell">Description</th>
                                                <th class="cell">Image</th>
                                                <th class="cell">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $sql = "SELECT * FROM files";
                                            $result = mysqli_query($conn, $sql);
                                            $i = 1;
                                            while ($file = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td class="cell"><?php echo $i++; ?></td>
                                                    <td class="cell"><span class="truncate"><?php echo $file['title']; ?></span></td>
                                                    <td class="cell"><?php echo $file['description']; ?></td>
                                                    <td class="cell"><img src="<?php echo '../uploads/'.$file['image_link']; ?>" alt="" width="100" height="100"></td>
                                                    <td class="cell">
                                                        <a class="btn btn-primary text-white btn-sm " href="edit.php?id=<?php echo $file['id']; ?>" role="button"> Edit</a>
                                                        <a class="btn btn-info text-white btn-sm " href="#" role="button"> View</a>
                                                        <a class="btn btn-danger text-white btn-sm " onclick="return confirm('do you want to delete this image??')" href="delete.php?id=<?php echo $file['id']; ?>" role="button"> Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>



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