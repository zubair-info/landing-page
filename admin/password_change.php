<?php
    session_start();
    require_once('../header.php');
    require_once('../config.php');
    require_once('navbar.php');
    if(!isset($_SESSION['user_status'])){

        header('location: ../login.php');
        
    }

    // print_r($_POST);

    $login_email=$_SESSION['email'];

    $get_query="SELECT * FROM users WHERE email='$login_email'";
    $db_from=mysqli_query($db_conect,$get_query); 
    $after_assoc=mysqli_fetch_assoc($db_from);


    if(isset($_POST['submit'])){

        $old_password=$_POST['old_password'];
        $password=$_POST['password'];
        $confirm_password=$_POST['confirm_password'];

        if(empty($old_password)){
            $_SESSION['error_msg_old_pass']='Old Password is Required!';
        }
        else if(empty($password)){
            $_SESSION['error_msg_pass']='New Password is Required!';

        }else if(empty($confirm_password)){
            $_SESSION['error_msg_cpass']='Confirm Password is Required!';

        }else{

            $password=$_POST['password'];
            $pass_upper= preg_match('@[A-Z]@',$password);
            $pass_lower= preg_match('@[a-z]@',$password);
            $pass_num= preg_match('@[0-9]@',$password);  
            $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
            $pass_char= preg_match($pattern,$password);

            if(strlen($password)<5){
                $_SESSION['error_msg_pass']='Password should be at least 5 characters!';
                    // header('location:index.php');
            }elseif(!$pass_upper==1){
                $_SESSION['error_msg_pass']="Password must include at least  one upper letter!";
                    // header('location:index.php');
            }elseif(!$pass_lower==1){
                $_SESSION['error_msg_pass']="Password should include at least one lower case letter!";
                    // header('location:index.php');
            }elseif(!$pass_num==1){
                $_SESSION['error_msg_pass']="Password should include at least one number!";
                    // header('location:index.php');
            }elseif(!$pass_char==1){
                $_SESSION['error_msg_pass']="Password should include at least one doller sing!";
                    // header('location:index.php');
            }else if($password !== $confirm_password){
                $_SESSION['error_msg_cpass']="Password Does not match!";
                // header('location:index.php'); 
            }else{

                if($old_password != $password){
                    $old_pass_encrypt=md5($_POST['old_password']);
                    $check_query="SELECT COUNT(*) AS total_user FROM users WHERE email='$login_email' AND password='$old_pass_encrypt'";
                    $db_result=mysqli_query($db_conect,$check_query);
                    $after_assocs=mysqli_fetch_assoc($db_result);
                    if($after_assocs['total_user']==1){

                        $new_pass_encrypt=md5($_POST['password']);
                        $confirm_pass_encrypt=md5($_POST['confirm_password']);
                        $update_query="UPDATE users SET password='$new_pass_encrypt',confirm_password='$confirm_pass_encrypt' WHERE email='$login_email'";
                        mysqli_query($db_conect,$update_query);
                        $_SESSION['success_msg']="Password Change Sucesfully!";
                        header('location:profile.php'); 
                        
                    }else{
                        $_SESSION['error_msg_old_pass']='Old Password Did Not Match!';
                    }

                }else{
                    $_SESSION['error_msg_pass']='Old Password And New Passwor Same Try Again!!';
                }
            }

        }
        // else{


        //     // $update_query="UPDATE users SET first_name='$first_name',last_name='$last_name',number='$number',date='$date',first_name='$first_name',country='$country',city='$city',state='$state',region='$region',post_code='$post_code',address='$address' WHERE email='$email'";
        //     $update_query="UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`number`='$number',`date_of_birth`='$date',`country`='$country',`city`='$city',`state`='$state',`post_code`='$post_code',`region`='$region',`address`='$address' WHERE email='$email'";
        //     mysqli_query($db_conect,$update_query);
        //     $_SESSION['success_msg']="Your Profile Update Sucessfully Done!!!";
        //     header('location:profile.php');
            

        // }

        
    }



?>

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item "><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="profile.php">User Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Password Change</li>
            </ol>
            </nav>
        </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
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
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">                         
                        <form action=" " method="POST">

                            <div class="row">
                                <div class="col-md-12 mt-4">
                                    <label for="old_password">Old Password<span style="color:red;">*</span></label>
                                    <div class="form-group" >
                                        <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password">

                                        <span class="text-danger" style="color:red;">
                                            <?php 
                                                if (isset($_SESSION['error_msg_old_pass'])) {
                                                    echo $_SESSION['error_msg_old_pass']; 
                                                    unset($_SESSION['error_msg_old_pass']);
                                                }
                                            ?>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="password">New Password<span style="color:red;">*</span></label>
                                    <div class="form-group" >
                                        <input type="password" class="form-control" name="password" id="password" placeholder="New Password">

                                        <span class="text-danger" style="color:red;">
                                            <?php 
                                                if (isset($_SESSION['error_msg_pass'])) {
                                                    echo $_SESSION['error_msg_pass']; 
                                                    unset($_SESSION['error_msg_pass']);
                                                }
                                            ?>
                                        </span>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="confirm_password">Confirm Password<span style="color:red;">*</span></label>
                                    <div class="form-group" >
                                        <input class="form-control" id="confirm_password" name="confirm_password"  placeholder="Confirm Password" >
                                        <span class="text-danger" style="color:red;">
                                            <?php 
                                                if (isset($_SESSION['error_msg_cpass'])) {
                                                    echo $_SESSION['error_msg_cpass']; 
                                                    unset($_SESSION['error_msg_cpass']);
                                                }
                                            ?>
                                        </span>
                                    </div>
                                    
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="d-grid gap-2">
                                   <input type="submit" name="submit" class="btn btn-warning" value="UPDATE PASSWORD">
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