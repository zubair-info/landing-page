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

    if(isset($_POST['submit'])){

        $first_name=$_POST['first_name'];       
        $last_name=$_POST['last_name'];
        $number=$_POST['number'];  
        $date=$_POST['date'];
        $country=$_POST['country'];
        $_SESSION['country']=$country;   
        $city=$_POST['city'];
        $state=$_POST['state'];  
        $post_code=$_POST['post_code'];   
        $region=$_POST['region'];   
        $address=$_POST['address'];   
        // $email=$_POST['email'];

        if(empty($first_name)){
            $_SESSION['error_msg_fname']='First Name is Required!';
        }
        else if(empty($last_name)){
            $_SESSION['error_msg_lname']='Last Name is Required!';

        }else if(empty($number)){
            $_SESSION['error_msg_num']='Number Required!';        
        }              
        elseif(empty($date)){
            $_SESSION['error_msg_date']="Date  Required!";
        }
        elseif(empty($country) || $country=="Enter country"){
            $_SESSION['error_msg_country']="Country Name Required!";
        }
        elseif(empty($city)){
            $_SESSION['error_msg_city']="City Name Required!";
        }
        elseif(empty($state)){
            $_SESSION['error_msg_state']="State Name Required!";
        }
        elseif(empty($post_code)){
            $_SESSION['error_msg_post_code']="Post Code  Required!";
        }
        elseif(empty($region)){
            $_SESSION['error_msg_region']="Region Required!";
        }
        elseif(empty($address)){
            $_SESSION['error_msg_address']="Address Required!";
        }
        elseif(empty($gender)){
            $_SESSION['error_msg_gender']="Gender requried Required!";
        }
        else{
            $email=$_POST['email'];
           
            $update_query="UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`number`='$number',`date_of_birth`='$date',`country`='$country',`city`='$city',`state`='$state',`post_code`='$post_code',`region`='$region',`address`='$address' WHERE email='$email'";
            mysqli_query($db_conect,$update_query);
            $_SESSION['success_msg']="Your Profile Update Sucessfully Done!!!";
            header('location:profile.php');
            

        }
        
    }

?>

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="profile.php">User Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Profile Edit</li>
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
                        <p class="text-muted">Email: <?= $after_assoc['email']?></p>
                        <p class="my-3 title text-capitalize text-muted">Address: <?= $after_assoc['address']?></p>

                        <div class="d-flex justify-content-center mb-2">
                            <!-- <a class="badge bg-warning text-dark" style="width:20%;text-decoration:none;padding:10px;" href="profile_edit.php">Edit</a> -->
                        </div>
                   </div>
                </div>
            
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">                         
                        <form action=" " method="POST">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="first_name">First Name<span style="color:red;">*</span></label>
                                    <div class="form-group">
                                    <input class="form-control" type="hidden" name="email" id="email" value="<?= $after_assoc['email']?>">
                                        <input class="form-control" type="text" name="first_name" id="first_name" value="<?= $after_assoc['first_name']?>">

                                        <span class="text-danger" style="color:red;">
                                            <?php 
                                                if (isset($_SESSION['error_msg_fname'])) {
                                                    echo $_SESSION['error_msg_fname']; 
                                                    unset($_SESSION['error_msg_fname']);
                                                }
                                            ?>
                                        </span>
                                            
                                    </div>
                                    
                                    </div>
                                    <div class="col-md-6">
                                    <label for="last_name">Last Name<span style="color:red;">*</span></label>
                                    <div class="form-group">
                                            <input class="form-control" type="text" name="last_name" id="last_name" value="<?= $after_assoc['last_name']?>" >
                                        <span class="text-danger" style="color:red;">
                                            <?php 
                                                if (isset($_SESSION['error_msg_lname'])) {
                                                    echo $_SESSION['error_msg_lname']; 
                                                    unset($_SESSION['error_msg_lname']);
                                                }
                                            ?>
                                    </span>
                                    </div>
                                    
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="number">Contact No<span style="color:red;">*</span></label>
                                    <div class="form-group">
                                            <input class="form-control" type="text" name="number" id="number" value="<?= $after_assoc['number']?>"  >
                                        <span class="text-danger" style="color:red;">
                                            <?php 
                                                if (isset($_SESSION['error_msg_num'])) {
                                                    echo $_SESSION['error_msg_num']; 
                                                    unset($_SESSION['error_msg_num']);
                                                }
                                            ?>
                                        </span>
                                    </div>
                                    
                                    </div>
                                    <div class="col-md-6">
                                    <label for="date_of_birth">Date Of Birth<span style="color:red;">*</span></label>
                                    <div class="form-group">
                                            <input class="form-control" type="date" name="date" id="date_of_birth" value="<?= $after_assoc['date_of_birth']?>" >
                                        <span class="text-danger" style="color:red;">
                                            <?php 
                                                if (isset($_SESSION['error_msg_date'])) {
                                                    echo $_SESSION['error_msg_date']; 
                                                    unset($_SESSION['error_msg_date']);
                                                }
                                            ?>
                                        </span>
                                    </div>
                                    
                                    </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="country">Country<span style="color:red;">*</span></label>
                                        <div class="form-group">
                                        <select class="form-select" name="country" value="<?= $after_assoc['country']?>" aria-label="Default select example" >
                                            <option selected>Enter country</option>
                                            <option  value="Bangladesh">Bangladesh</option>
                                            <option  value="India">India</option>
                                            <!-- <option <?php if( $_SESSION['country'] === "Pakistan" ) { echo ' selected="selected"'; }?> value="Pakistan">Pakistan</option> -->
                                        </select>
                                        <span class="text-danger" style="color:red;">
                                            <?php 
                                                if (isset($_SESSION['error_msg_country'])) {
                                                    echo $_SESSION['error_msg_country']; 
                                                    unset($_SESSION['error_msg_country']);
                                                }
                                            ?>
                                        </span>
                                    </div>
                                    
                                    </div>
                                    <div class="col-md-4">
                                    <label for="city">City<span style="color:red;">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="city" id="city" value="<?= $after_assoc['city']?>">

                                            <span class="text-danger" style="color:red;">
                                                <?php 
                                                    if (isset($_SESSION['error_msg_city'])) {
                                                        echo $_SESSION['error_msg_city']; 
                                                        unset($_SESSION['error_msg_city']);
                                                    }
                                                ?>
                                        </span>
                                    </div>
                                    
                                    </div>
                                    <div class="col-md-4">
                                    <label for="state">State<span style="color:red;">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="state" id="state" value="<?= $after_assoc['state']?>">
                                            <span class="text-danger" style="color:red;">
                                                <?php 
                                                    if (isset($_SESSION['error_msg_state'])) {
                                                        echo $_SESSION['error_msg_state']; 
                                                        unset($_SESSION['error_msg_state']);
                                                    }
                                                ?>
                                        </span>
                                    </div>
                                    
                                    </div>

                            </div>

                            <div class="row mt-3">
                                <div class="col-md-3">
                                <label for="post_code">Post Code<span style="color:red;">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="post_code" id="post_code" value="<?= $after_assoc['post_code']?>">
                                            <span class="text-danger" style="color:red;">
                                                <?php 
                                                    if (isset($_SESSION['error_msg_post_code'])) {
                                                        echo $_SESSION['error_msg_post_code']; 
                                                        unset($_SESSION['error_msg_post_code']);
                                                    }
                                                ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <label for="region">Region<span style="color:red;">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="region" id="region"  value="<?= $after_assoc['region']?>">
                                            <span class="text-danger" style="color:red;">
                                                <?php 
                                                    if (isset($_SESSION['error_msg_region'])) {
                                                        echo $_SESSION['error_msg_region']; 
                                                        unset($_SESSION['error_msg_region']);
                                                    }
                                                ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Email<span style="color:red;">*</span></label>
                                    <div class="form-group Disabled">
                                        <input  type="text" disabled class="form-control"  id="email"  name="email" value="<?= $after_assoc['email']?>" />
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                
                                    <label for="address">Address<span style="color:red;">*</span></label>
                                    <div class="form-group">

                                        <textarea class="form-control"  name="address"  value=""><?=$after_assoc['address']?></textarea>
                                        <span class="text-danger" style="color:red;">
                                            <?php 
                                                if (isset($_SESSION['error_msg_address'])) {
                                                    echo $_SESSION['error_msg_address']; 
                                                    unset($_SESSION['error_msg_address']);
                                                }
                                            ?>
                                            </span>
                                    </div>

                                </div>

                                
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                
                                    <label for="address">Gender<span style="color:red;">*</span></label>
                                    <div class="form-group">

                                          <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">Female
                                          <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
                                          <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other
                                            <span class="text-danger" style="color:red;">
                                                <?php 
                                                    if (isset($_SESSION['error_msg_gender'])) {
                                                        echo $_SESSION['error_msg_gender']; 
                                                        unset($_SESSION['error_msg_gender']);
                                                    }
                                                ?>
                                            </span>
                                    </div>

                                </div>

                                
                            </div>


                            <div class="row mt-4">
                                <div class="d-grid gap-2">
                                
                                    <input type="submit" name="submit" class="btn btn-success" value="UPDATE PROFILE">
                                </div>

                            </div> 


                        </form>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php

    require_once('../footer.php');
?>