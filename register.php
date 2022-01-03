<?php

session_start();
require_once('header.php');

require_once('config.php');
// print_r($_POST);
if(isset($_SESSION['user_status'])){

    header('location: admin/dashboard.php');

}

if(isset($_POST['submit'])){

    $first_name=filter_var($_POST['first_name'],FILTER_SANITIZE_STRING );
    $first_name_lenth=strlen($first_name);
    // $_SESSION['first_name']=$first_name;  
    $last_name=filter_var($_POST['last_name'],FILTER_SANITIZE_STRING);
    // $_SESSION['last_name']=$last_name;  
    $number=filter_var($_POST['number'],FILTER_SANITIZE_NUMBER_INT);
    // $_SESSION['number']=$number;   
    $date=$_POST['date'];
    $country=$_POST['country'];
    $_SESSION['country']=$country;
    // $country=filter_var($_POST['country'],FILTER_SANITIZE_STRING);    
    $city=filter_var($_POST['city'],FILTER_SANITIZE_STRING);
    $state=filter_var($_POST['state'],FILTER_SANITIZE_STRING);  
    $post_code=filter_var($_POST['post_code'],FILTER_SANITIZE_NUMBER_INT);    
    $region=filter_var($_POST['region'],FILTER_SANITIZE_STRING);    
    $address=filter_var($_POST['address'],FILTER_SANITIZE_STRING);   
    $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $email_lower=strtolower($email);
    $valid_email=filter_var($email_lower,FILTER_VALIDATE_EMAIL);       
    $password=$_POST['password'];
    $pass_upper= preg_match('@[A-Z]@',$password);
    $pass_lower= preg_match('@[a-z]@',$password);
    $pass_num= preg_match('@[0-9]@',$password);  
    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
    $pass_char= preg_match($pattern,$password);
    // $_SESSION['password']=$password; 
    $confirm_password=$_POST['confirm_password'];

    if(empty($first_name)){
        $_SESSION['error_msg_fname']='First Name is Required!';
    }
    else if(!preg_match("/^[a-zA-Z ]*$/",$first_name)){
        $_SESSION['error_msg_fname']='Only letters  are allowed!';
        // header('location:index.php'); 
    }else if($first_name_lenth < 3 || $first_name_lenth >10){
        $_SESSION['error_msg_fname']='First Name is min 3 char and max 5!';
        // header('location:index.php');

    }else if(empty($last_name)){
        $_SESSION['error_msg_lname']='Last Name is Required!';
        // header('location:index.php');
    }else if(!preg_match("/^[a-zA-Z ]*$/",$last_name)){
        $_SESSION['error_msg_lname']='Only letters  are allowed!';
        // header('location:index.php'); 
    }else if(empty($number)){
        $_SESSION['error_msg_num']='Number Required!';
        // header('location:index.php');          
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
    else if(empty($email)){
        $_SESSION['error_msg_email']='Email is Required!';
        // header('location:index.php');  
    }else if(empty($password)){
        $_SESSION['error_msg_pass']='Password is Required!';
        // header('location:index.php');
    }else if(empty($confirm_password)){
        $_SESSION['error_msg_cpass']='Confirm Password is Required!';
        // header('location:index.php');
    }
    else{
        
        if($valid_email){

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
            }else if($password!== $confirm_password){
                $_SESSION['error_msg_cpass']="Password Does not match!";
                // header('location:index.php'); 
            }
            else{
            
                $pass_encrypt=md5($password);
                $conf_pass_encrypt=md5($confirm_password);
                $duplicate_email_check="SELECT COUNT(*) AS total_email FROM users WHERE email='$valid_email'";
                $db_query_result=mysqli_query($db_conect,$duplicate_email_check);

                // if($db_query_result){
                //     echo "ok";

                // }else{
                //     echo 'vejal ace';
                // }
                // print_r($db_query_result);
               $after_associte_res=mysqli_fetch_assoc($db_query_result);
            //    print_r($after_associte_res);
    
                if($after_associte_res['total_email']==0){

                    // echo 'data insert kora jabe';

                   $insert_query= "INSERT INTO `users`(`first_name`, `last_name`,`number`, `date_of_birth`, `country`,`city`, `state`,`post_code`,`region`,`address`,`email`,`password`, `confirm_password`) VALUES ('$first_name','$last_name','$number','$date','$country','$city','$state','$post_code','$region','$address','$valid_email','$pass_encrypt','$conf_pass_encrypt')";

                   mysqli_query($db_conect,$insert_query);  
                   $_SESSION['success_msg']='Congarts!! Your Registration Sucessfully!!';

                //    if($sql){
                //     $_SESSION['success_msg']='Congarts!! Your Registration Sucessfully!!';
                //    }else{
                //     $_SESSION['error_msg']='opps!! database connection faild!!';
                //    }      
                    
                    // header('location:index.php');
    
                }else{
    
                    $_SESSION['error_msg_email']='Email Already Register';
                    // header('location:index.php');
                    // echo 'Email Already Register';
                }    
                // echo 'Strong password.';
        
            }
    
        }else{
            // echo 'invalid email';
            $_SESSION['error_msg_email']='Email Invalid';
            // header('location:index.php');
    
        }
    }
    
}

?>
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-md-5 m-auto">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center">

                        <img width="100px" class="m-auto center" src="img/pic1.jpg"/>

                        </div>

                    </div>

                    <div class="row">
                    <div >
                    
                        <h4 class="text-center">User Registration</h4>
                        
                        <h6 class="text-center">Account Details - </h6>
                        
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <hr>
                    </div>
                </div>

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
                    <?php 

                        if(isset($_SESSION['error_msg'])){

                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                                echo $_SESSION['error_msg'];
                                unset($_SESSION['error_msg']);

                            ?>
                        </div>

                    <?php
                        }

                    ?>

                    <form action=" " method="POST">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="first_name">First Name<span style="color:red;">*</span></label>
                                <div class="form-group">
                                        <input class="form-control" type="text" name="first_name" id="first_name" value="<?php if(isset($first_name))echo $first_name;?>">

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
                                        <input class="form-control" type="text" name="last_name" id="last_name" value="<?php if(isset($last_name))echo $last_name;?>" >
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
                        

                        <div class="row mt-1">
                            <div class="col-md-6">
                                <label for="number">Contact No<span style="color:red;">*</span></label>
                                <div class="form-group">
                                        <input class="form-control" type="text" name="number" id="number" value="<?php if(isset($number))echo $number;?>"  >
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
                                        <input class="form-control" type="date" name="date" id="date_of_birth" value="<?php if(isset($date))echo $date;?>" >
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

                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="country">Country<span style="color:red;">*</span></label>
                                    <div class="form-group">
                                    <select class="form-select" name="country" aria-label="Default select example" >
                                        <option selected>Enter country</option>
                                        <option  value="Bangladesh">Bangladesh</option>
                                        <option  value="India">India</option>
                                        <!-- <option <?php if( $_SESSION['country'] === "Pakistan" ) { echo ' selected="selected"'; } ?> value="Pakistan">Pakistan</option> -->
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
                                        <input class="form-control" type="text" name="city" id="city" value="<?php if(isset($city))echo $city;?>">

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
                                        <input class="form-control" type="text" name="state" id="state" value="<?php if(isset($state))echo $state;?>">
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

                        <div class="row mt-1">
                            <div class="col-md-6">
                            <label for="post_code">Post Code<span style="color:red;">*</span></label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="post_code" id="post_code" value="<?php if(isset($post_code))echo $post_code;?>">
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
                            <div class="col-md-6">
                            <label for="region">Region<span style="color:red;">*</span></label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="region" id="region"  value="<?php if(isset($region))echo $region;?>">
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
                            
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-12">
                            
                                    <label for="address">Address<span style="color:red;">*</span></label>
                                    <div class="form-group">

                                            <textarea class="form-control"  name="address" id=""  cols="3" rows="" value="<?php if(isset($address))echo $address;?>"></textarea>
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

                        <div class="row mt-2">
                            <div  class="d-flex justify-content-center">
                            <!-- <span class="badge badge-info" style="width:100%;">Info</span> -->
                            <span class="badge bg-warning text-dark">Login Credentials</span>
                                <!-- <p class="badge badge-warning"  >Login Credentials</p>  -->
                                
                            </div>
                        </div>

                        <div class="row mt-1">
                            
                            
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <label for="password">Password<span style="color:red;">*</span></label>
                                <div class="form-group" >
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">

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
                            <div class="col-md-4">
                                <label for="confirm_password">Confirm Password<span style="color:red;">*</span></label>
                                <div class="form-group" >
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password"  placeholder="Confirm Password" >
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
                            <div class="col-6">
                            
                                <input type="submit" style="width:100%;" name="submit" class="btn btn-success" value="SINGUP">
                            </div>
                            <div class="col-6">
                                <a href="login.php" style="width:100%;" class="btn btn-danger">LOGIN</a>
                            <!-- <input style="width:100%;" style="width: 350px;" class="btn btn-danger" value="LOGIN">  -->
                            
                        </div>
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