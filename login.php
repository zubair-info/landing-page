

<?php

    session_start();
    require_once('header.php');

    require_once('config.php');
    // print_r($_POST);
    if(isset($_SESSION['user_status'])){

        header('location: admin/dashboard.php');
    
    }

    if(isset($_POST['submit'])){

        $email=$_POST['email'];
        $password=$_POST['password'];

        $password_encypt=md5($_POST['password']);

        if(empty($email)){
            $_SESSION['error_msg_email']='Email is Required!';
        }
        elseif(empty($password)){
            $_SESSION['error_msg_pass']='Password is Required!';
        }else{

            $check_query= "SELECT COUNT(*) AS total_user FROM users WHERE email='$email' AND password='$password_encypt' ";

            $db_form= mysqli_query($db_conect,$check_query);
            // print_r($db_form);

            $after_assoc= mysqli_fetch_assoc($db_form);

            // print_r($after_assoc);

            if($after_assoc['total_user']==1){

                $_SESSION['email']=$email;
                $_SESSION['user_status']='yes';

                header('location:admin/dashboard.php');
            }else{
                // echo 'login kora jabe na';
                $_SESSION['login_error']='Your Email and Password are Invalid';
                // header('location:login.php');

            }

        }
        


        
    }



?>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-md-3 m-auto">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center">

                        <img width="100px" class="m-auto center"src="img/pic1.jpg"/>

                        </div>

                    </div>

                    <div class="row">
                    <div >                   
                        <h4 class="text-center">User Login</h4>                                           
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <hr>
                    </div>
                </div>

                    <form action=" " method="POST">

                         <div class="row m-2">
                            <div  class="d-flex justify-content-center">
                            <!-- <span class="badge badge-info" style="width:100%;">Info</span> -->
                            <span class="badge bg-warning text-dark">Login Credentials</span>
                                 <!-- <p class="badge badge-warning"  >Login Credentials</p>  -->
                                
                            </div>
                        </div>

                        <?php 

                            if(isset($_SESSION['login_error'])){

                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                    echo $_SESSION['login_error'];
                                    unset($_SESSION['login_error']);

                                ?>
                            </div>

                        <?php
                            }

                        ?>

                        <div class="row mt-4">
                            
                            
                            <div class="col-md-12">
                                <label for="email">Email<span style="color:red;">*</span></label>
                                <div class="form-group">
                                    <input  type="text"  class="form-control"  id="email"  name="email" value="<?php if(isset($email))echo $email;?>" />

                                <span class="text-danger" style="color:red;">
                                        <?php 
                                            if (isset($_SESSION['error_msg_email'])) {
                                                echo $_SESSION['error_msg_email']; 
                                                unset($_SESSION['error_msg_email']);
                                            }
                                        ?>
                                </span>

                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="password">Password<span style="color:red;">*</span></label>
                                <div class="form-group" >
                                    <input type="password"class="form-control" name="password" id="password" placeholder="Password">

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
                        
                        </div>
                        
                        
                        <div class="row mt-4 ">

                            <div class="d-grid gap-2">
                            <input type="submit"  name="submit" class="btn btn-danger"  value="LOGIN">
                            <a href="register.php" class="btn btn-success">SINGUP</a>
                             <!-- <input style="width:100%;" style="width: 350px;" class="btn btn-danger" value="LOGIN"> -->
                            
                            </div>
                            <!-- <div class="col-6">
                               
                                <a href="index.php"   class="btn btn-danger">SINGUP</a>
                                
                            </div> -->
                            
                        </div>


                    </form>
                

                </div>
            </div>
        </div>
    </div>
</div>

<?php

    require_once('footer.php');

?>