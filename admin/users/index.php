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
                        <h1 class="app-page-title mb-0">Orders</h1>
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
                                                <th class="cell"> Name</th>
                                                <th class="cell">username</th>
                                                <th class="cell">Email</th>
                                                <th class="cell">Liscence No</th>
                                                <th class="cell">Action</th>
                                                <th class="cell"></th>
                                                <th class="cell"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $sql = "SELECT * FROM users";
                                            $result = mysqli_query($conn, $sql);
                                            $i = 1;
                                            while ($user = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td class="cell"><?php echo $i++; ?></td>
                                                    <td class="cell"><span class="truncate"><?php echo $user['name']; ?></span></td>
                                                    <td class="cell"><?php echo $user['username']; ?></td>
                                                    <td class="cell"><?php echo $user['email']; ?></td>
                                                    <td class="cell"><?php echo $user['liscence_no']; ?></td>
                                                    <td class="cell">
                                                        <a class="btn btn-primary text-white btn-sm " href="#" role="button"> Edit</a>
                                                        <a class="btn btn-info text-white btn-sm " href="#" role="button"> View</a>
                                                        <a class="btn btn-danger text-white btn-sm " onclick="return confirm('Do you want to delete this user??')" href="delete.php?id=<?php  echo $user['id'];?>" role="button"> Delete</a>
                                                    </td>
                                                    <td class="cell"><a class="btn-sm btn-secondary btn" href="#">Change</a></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>



                                        </tbody>
                                    </table>
                                </div><!--//table-responsive-->

                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                        <!-- <nav class="app-pagination">
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
                        </nav> -->

                    </div><!--//tab-pane-->

                    <div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
                        <div class="app-card app-card-orders-table mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 text-left">
                                        <thead>
                                            <tr>
                                                <th class="cell">S.N</th>
                                                <th class="cell"> Name</th>
                                                <th class="cell">username</th>
                                                <th class="cell">Email</th>
                                                <th class="cell">Liscence No</th>
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