<?php
    session_start();
    require_once('../header.php');
    require_once('../config.php');
    require_once('navbar.php');
    if(!isset($_SESSION['user_status'])){

        header('location: ../login.php');
        
    }

    $login_email=$_SESSION['email'];

    $get_query="SELECT * FROM users WHERE email='$login_email'";
    $db_from=mysqli_query($db_conect,$get_query); 
    $after_assoc=mysqli_fetch_assoc($db_from);


?>

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
            </nav>
        </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3 title text-capitalize"><?= $after_assoc['first_name']?> <?= $after_assoc['last_name']?></h5>
                    <p>Email: <?= $after_assoc['email']?></p>
                    <p class="my-3 title text-capitalize">Address: <?= $after_assoc['address']?></p>

                    <div class="d-flex justify-content-center mb-2">
                        <a class="badge bg-warning text-dark" style="width:20%;text-decoration:none;padding:10px;" href="profile_edit.php">Edit</a>
                    </div>
                </div>
                </div>
            
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                <div class="card-body">
                    <?php 

                        if(isset($_SESSION['success_msg'])){

                        ?>
                        <div class="alert alert-success" role="alert">
                            <?php
                                echo $_SESSION['success_msg'];
                                unset($_SESSION['success_msg']);

                            ?>
                        </div>

                        <?php
                        }

                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">First Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 title text-capitalize"><?= $after_assoc['first_name']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Last Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 title text-capitalize"><?= $after_assoc['last_name']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $after_assoc['email']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Number</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 title text-capitalize"><?= $after_assoc['number']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Date Of Birth</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 title text-capitalize"><?= $after_assoc['date_of_birth']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Country</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 title text-capitalize"><?= $after_assoc['country']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">State</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 title text-capitalize"><?= $after_assoc['state']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">city</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 title text-capitalize"><?= $after_assoc['city']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">post Code</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 title text-capitalize"><?= $after_assoc['post_code']?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Region</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0 title text-capitalize"><?= $after_assoc['region']?></p>
                            </div>
                        </div>
                        <hr>
                    
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</section>


<?php

    require_once('../footer.php');
?>