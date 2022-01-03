<?php
        session_start();


        require_once('../header.php');
        require_once('../config.php');
        require_once('navbar.php');

        if(!isset($_SESSION['user_status'])){

            header('location:../login.php');
            
        }

        $sql_query= "SELECT * FROM users";
        $db_from= mysqli_query($db_conect,$sql_query);
        // $after_assoc=mysqli_fetch_assoc($db_from);
        // print_r($after_assoc);
    ?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 m-auto">
                        <div class="card mt-5">
                            <div class="card-header bg-success">
                                <h5 class="card-tittle text-white">All Users List</h5>

                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Date Of Birth</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Post Code</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $count=0;

                                    foreach($db_from as $user){

                                        $count++
                                        
                                        ?>

                                            <tr>
                                                <td><?= $count?></td>
                                                <td><?= $user['first_name']?></td>
                                                <td><?= $user['last_name']?></td>
                                                <td><?= $user['date_of_birth']?></td>
                                                <td><?= $user['country']?></td>
                                                <td><?= $user['city']?></td>
                                                <td><?= $user['state']?></td>
                                                <td><?= $user['post_code']?></td>                                               
                                                <td><?= $user['email']?></td>
                                                <td><?= $user['number']?></td>

                                            </tr>
                                        <?php

                                            }

                                        ?>
                                        
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>



    <?php
        require_once('../footer.php');
    ?>